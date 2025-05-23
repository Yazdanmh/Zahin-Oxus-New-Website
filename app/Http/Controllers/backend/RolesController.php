<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Inertia\Inertia;
use Illuminate\Routing\Controllers\Middleware;

class RolesController extends Controller// implements \Illuminate\Routing\Controllers\HasMiddleware
{
    // public static function middleware(): array
    // {
    //     // return [
    //     //     new Middleware('can:roles.view', only: ['index']),
    //     //     new Middleware('can:roles.create', only: ['create', 'store']),
    //     //     new Middleware('can:roles.edit', only: ['edit', 'update']),
    //     //     new Middleware('can:roles.delete', only: ['destroy']),
    //     // ];
    // }

    public function index()
    {
        $roles = Role::paginate(10);
        return Inertia::render('Admin/Roles/Index', [
            'roles' => $roles,
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Roles/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
        ]);
        Role::create(['name' => $request->name]);
        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return Inertia::render('Admin/Roles/Edit', [
            'role' => $role,
            'assignedPermissions' => $role->permissions->pluck('name'),
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'array',
        ]);
        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $role->update();
        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
}
