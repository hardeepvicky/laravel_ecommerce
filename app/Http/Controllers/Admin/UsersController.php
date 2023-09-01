<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends BackendController
{
    public function __construct()
    {
        $this->url_prefix = "/users";
        $this->view_prefix = "users";
    }

    public function index()
    {
        $modelName = "User";

        $conditions = $this->getConditions($modelName, [
            ["field" => "name", "type" => "string", "view_field" => "name"]
        ]);

        //dd($conditions);
        $records = User::where($conditions)->paginate(PAGINATION_LIMIT);

        $this->setForView(compact("records", "modelName"));

        return $this->view("index");
    }

    public function create()
    {
        $model = new User();
        return view("users.add", [
            'model' => $model
        ]);
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
        $model = User::findOrFail($id);

        return view("users.edit", [
            'model' => $model
        ]);
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

        $model->fill($validatedData);
        $model->save();

        return redirect("/users")->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return back()->with('success', 'User deleted successfully.');
    }
}
