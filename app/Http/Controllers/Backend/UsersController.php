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
        $this->routePrefix = $this->viewPrefix = "users";
    }

    public function index()
    {
        $modelName = "User";

        $accessControl = AccessControl::init();
        $accessControl->syncRouteNamesToDatabase();

        $conditions = $this->getConditions(Route::currentRouteName(), [
            ["field" => "name", "type" => "string", "view_field" => "name"],
            ["field" => "email", "type" => "string", "view_field" => "email"],
        ]);

        //dd($conditions);
        $records = User::where($conditions)->paginate(PAGINATION_LIMIT);

        $this->setForView(compact("records", "modelName"));

        return $this->view("index");
    }

    public function create()
    {
        $model = new User();

        $this->setForView(compact("model"));

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

        $role_list = Role::getList();
        
        $this->setForView(compact("role_list", "model"));

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

            foreach($request->get('roles') as $role_id)
            {
                $userRole = new UserRole();
                $userRole->insertOrUpdate([
                    'user_id' => $model->id,
                    'role_id' => $role_id
                ]);
            }

            DB::commit();

            return redirect()->route($this->routePrefix . ".index")->with('success', 'Record updated successfully.');
        }
        catch(\Exception $ex)
        {
            DB::rollBack();

            return back()->with('fail')->withInput();
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return back()->with('success', 'Record deleted successfully.');
    }
}