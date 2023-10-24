<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Route;

class RolesController extends BackendController
{
    public function __construct()
    {
        parent::__construct();
        $this->routePrefix = "admin.roles";
        $this->viewPrefix = "backend.roles";
    }

    public function index()
    {
        $modelName = "Role";

        $conditions = $this->getConditions(Route::currentRouteName(), [
            ["field" => "name", "type" => "string", "view_field" => "name"],            
        ]);

        //dd($conditions);
        $records = $this->getPaginagteRecords(Role::where($conditions));

        $this->setForView(compact("records", "modelName"));

        return $this->view(__FUNCTION__);
    }

    public function create()
    {
        $model = new Role();

        $form = [
            'url' => route($this->routePrefix . '.store'),
            'method' => 'POST',            
        ];

        $this->setForView(compact("model", 'form'));

        return $this->view("form");
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([            
            'name' => 'required|min:3|unique:roles',
            "is_system_admin" => ""
        ]);
  
        Role::create($validatedData);
            
        return back()->with('success', 'Record created successfully');
    }

    public function edit($id)
    {
        $model = Role::findOrFail($id);

        $form = [
            'url' => route($this->routePrefix . '.update', $id),
            'method' => 'PUT',            
        ];

        $this->setForView(compact("model", "form"));

        return $this->view("form");
    }

    public function update($id, Request $request)
    {
        $model = Role::findOrFail($id);

        $validatedData = $request->validate([            
            'name' => 'required|min:3|unique:roles,name,' . $model->id,
            "is_system_admin" => ""
        ]);

        $model->fill($validatedData);
        $model->save();

        return redirect()->route($this->routePrefix . ".index")->with('success', 'Record updated successfully');
    }

    public function destroy($id)
    {
        try
        {       
            $model = Role::findOrFail($id); 

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
