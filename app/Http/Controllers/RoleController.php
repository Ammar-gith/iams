<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware(
            'permission:Delete roles|Update roles|Assign Permissions',
            ['only' => ['edit', 'update', 'destroy', 'assignPermission', 'addPermission']]
        );
    }
    public function index()
    {
        $roles = Role::all();
        return view('user-management.roles.index', [
            'roles' => $roles
        ]);
    }

    public function create()
    {
        return view('user-management.roles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles',
        ]);

        $role = Role::create($request->all());

        return redirect()->route('role.index')
            ->with('success', 'Role created successfully.');
    }

    public function show($id)
    {
        $role = Role::find($id);
        return view('user-management.roles.show', compact('role'));
    }

    public function edit($id)
    {
        $role = Role::find($id);
        return view('user-management.roles.edit', [
            'role' => $role
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles',
        ]);

        $role = Role::find($id);
        $role->update($request->all());

        return redirect()->route('role.index')
            ->with('success', 'Role updated successfully');
    }

    public function destroy($id)
    {
        $role = Role::find($id);

        if ($role) {
            $role->delete();
            return response()->json(['success', 'Role deleted successfully'], 200);
        } else {
            return response()->json(['error', 'Role not found'], 404);
        }
    }

    public function addPermission($id)
    {
        $role = Role::find($id);
        $permissions = Permission::all();
        $rolePermissions = DB::table('role_has_permissions')
            ->where('role_has_permissions.role_id', $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')->all(); // first method to get all permissions of a role

        // $rolePermissions = $role->permissions->pluck('id')->toArray(); // second method to get all permissions of a role

        return view('user-management.roles.assign-permissions', [
            'role' => $role,
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions
        ]);
    }

    public function assignPermission(Request $request, $id)
    {
        $request->validate([
            'permissions' => 'required',
        ]);

        $role = Role::find($id);
        $role->syncPermissions($request->permissions);

        return redirect()->route('role.index')
            ->with('success', 'Permissions assigned successfully to' . ' ' . $role->name);
    }
}
