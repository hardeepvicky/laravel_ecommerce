<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends BackendController
{
    public function index()
    {
        $records = User::paginate(PAGINATION_LIMIT);

        return view("users.index", [
            'records' => $records
        ]);
    }

    public function create()
    {
        $model = new User();
        return view("users.form", [
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

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return back()->with('success', 'User deleted successfully.');
    }
}
