<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\Middleware;

class UsersController extends Controller //implements \Illuminate\Routing\Controllers\HasMiddleware
{
    // public static function middleware(): array
    // {
    //     return [
    //         // new Middleware('can:users.view', only: ['index', 'show']),
    //         // new Middleware('can:users.create', only: ['store', 'create']),
    //         // new Middleware('can:users.edit', only: ['update', 'edit']),
    //         // new Middleware('can:users.delete', only: ['destroy']),
    //         // new Middleware('can:system.change_user_password', only: ['resetPassword']),
    //     ];
    // }

    public function index()
    {
        $users = User::with('roles')->get();

        return Inertia::render('Admin/Users/Index', [
            'users' => $users
        ]);
    }

    public function create()
    {
        $roles = Role::all();
        return Inertia::render('Admin/Users/Create', [
            'roles' => $roles
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role_id' => 'required|exists:roles,id',
        ]);

        // Create the user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Assign the role
        $role = Role::find($validated['role_id']);
        $user->assignRole($role);

        // Return a response or redirect
        return redirect()->route('users.index')->with(['message' => 'User created successfully']);
    }

    public function edit($id)
    {
        $user = User::with('roles')->findOrFail($id);
        $roles = Role::all();
        return Inertia::render('Admin/Users/Edit', [
            'user' => $user,
            'roles' => $roles
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'role_id' => 'required|exists:roles,id',
        ]);

        // Find the user
        $user = User::findOrFail($id);

        // Update the user
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        if ($validated['password']) {
            $user->password = Hash::make($validated['password']);
        }
        $user->update();

        // Sync the role
        $role = Role::find($validated['role_id']);
        $user->syncRoles([$role]);

        return redirect()->route('users.index')->with(['message' => 'User updated successfully']);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with(['message' => 'User deleted successfully']);
    }
    public function resetPassword($id)
    {
        $user = User::findOrFail($id);
        $user->password = Hash::make('Zahin@2022');
        $user->save();

        return back()->with('message', 'Password reset to default.');
    }
}
