<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;


class RolePermissionController extends Controller
{

    public function index()
    {
        return view('backend.roles.index', [
            'roles' => Role::all(),
            'permissions' => Permission::all(),
            'users' => User::all(),
        ]);
    }

    public function storeRole(Request $request)
    {
        $request->validate(['name' => 'required|unique:roles']);
        Role::create(['name' => $request->name]);
        return back()->with('success', 'Role created successfully!');
    }

    public function storePermission(Request $request)
    {
        $request->validate(['name' => 'required|unique:permissions']);
        Permission::create(['name' => $request->name]);
        return back()->with('success', 'Permission created successfully!');
    }

    public function assignPermissions(Request $request, Role $role)
    {
        $role->syncPermissions($request->permissions);
        return back()->with('success', 'Permissions assigned successfully!');
    }

    public function assignRole(Request $request, User $user)
    {
        $user->syncRoles([$request->role]);
        return back()->with('success', 'Role assigned successfully!');
    }

    public function assignPermission(Request $request, User $user)
    {
        $user->givePermissionTo($request->permission);
        return back()->with('success', 'Permission assigned successfully!');
    }
}