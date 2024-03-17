<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUsersWithRoleZero()
    {
        $users = User::where('role_as', 0)->get();
        return response()->json($users);
    }

    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string',
            'role_as' => 'required|string',
        ]);
    
        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role_as' => $request->input('role_as'),
        ]);
    
        $user->save();
    
        return response()->json(['message' => 'User created successfully', 'user' => $user]);
    }

    public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $user->fill($request->all());

    $user->save();

    return response()->json(['message' => 'User updated successfully', 'user' => $user]);
}
    public function search($keyword)
    {
        $users = User::where('name', 'LIKE', "%$keyword%")->get();
        return response()->json($users);
    }
    public function destroy($id)
{
    $user = User::find($id);

    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

    $user->delete();

    return response()->json(['message' => 'User deleted successfully']);
}

}