<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'User created successfully', 'user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        // echo "<pre>";
        //  print_r($user);
        //  die();
        $user->update($request->only('name', 'email'));

        return response()->json(['message' => 'User updated successfully', 'user' => $user]);
    }

    public function softDelete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }

    public function getUser($id)
    {
        $user = User::withTrashed()->findOrFail($id); // Include soft deleted users

        return response()->json(['user' => $user]);
    }

    public function index()
    {
        $users = User::withTrashed()->get(); // Include soft deleted users
        return response()->json(['users' => $users]);
    }
}
