<?php

namespace App\Http\Controllers\Backend;

use App\Acl\AccessControl;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\UserRole;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class UsersController extends BackendController
{
    public function __construct()
    {
        parent::__construct();
        $this->routePrefix = "admin.users";
        $this->viewPrefix = "backend.users";
    }

    public function index()
    {
        $conditions = $this->getConditions(Route::currentRouteName(), [
            ["field" => "name", "type" => "string", "view_field" => "name"],
            ["field" => "email", "type" => "string", "view_field" => "email"],
        ]);

        $records = $this->getPaginagteRecords(User::where($conditions));

        $this->setForView(compact("records"));

        return $this->view(__FUNCTION__);
    }

    public function create()
    {
        $model = new User();

        $form = [
            'url' => route($this->routePrefix . '.store'),
            'method' => 'POST',            
        ];

        $this->setForView(compact("model", 'form'));

        return $this->view("add");
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'password' => 'required|min:5',
            'email' => 'required|email|unique:users'
        ], [
            'name.required' => 'Name is required.',
            'password.required' => 'Password is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Email must be email address.'
        ]);
  
        $validatedData['password'] = bcrypt($validatedData['password']);
        User::create($validatedData);
            
        return back()->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $model = User::query()->findOrFail($id);

        $form = [
            'url' => route($this->routePrefix . '.update', $id),
            'method' => 'PUT',            
        ];

        $role_list = Role::getList();

        $this->setForView(compact("model", "form", "role_list"));

        return $this->view("edit");
    }

    public function update($id, Request $request)
    {
        $model = User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required',            
            'email' => 'required|email|unique:users,email,'. $model->id
        ], [
            'name.required' => 'Name is required.',            
            'email.required' => 'Email is required.',
            'email.email' => 'Email must be email address.'
        ]);

        DB::beginTransaction();

        try
        {
            $model->fill($validatedData);
            $model->save();

            $exist_user_role_list = UserRole::where("user_id", "=", $model->id)->pluck("id", "id")->toArray();

            $userRole = new UserRole();
            foreach($request->get('roles') as $role_id)
            {
                $user_role_id = $userRole->insertIgnoreIfExist([
                    'user_id' => $model->id,
                    'role_id' => $role_id
                ]);

                unset($exist_user_role_list[$user_role_id]);
            }

            if ($exist_user_role_list)
            {
                UserRole::withoutEvents(function () use ($exist_user_role_list)
                {
                    UserRole::destroy($exist_user_role_list);
                });
            }
            
            $accessControl = AccessControl::init();
            $accessControl->clearMenuCache([$model->id]);

            DB::commit();

            $this->saveSqlLog();

            return redirect()->route($this->routePrefix . ".index")->with('success', 'Record updated successfully.');
        }
        catch(\Exception $ex)
        {
            DB::rollBack();

            return back()->with('fail', $ex->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try
        {       
            $model = User::findOrFail($id); 
            
            $this->delete($model);

            $this->saveSqlLog();

            return back()->with('success', 'Record deleted successfully.');
        }
        catch(\Exception $ex)
        {
            return back()->with('fail', $ex->getMessage());
        }
    }
}
