<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:Delete permissions|Update permissions', ['only' => ['edit', 'update', 'destroy']]);
    }

    public function index()
    {
        $permissions = Permission::all();
        return view('user-management.permissions.index', [
            'permissions' => $permissions
        ]);
    }

    public function create()
    {
        return view('user-management.permissions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'string',
            'max:255',
            'unique:permissions.name',

        ]);

        $permission = Permission::create($request->all());

        return redirect()->route('permission.index')
            ->with('success', 'Permission created successfully.');
    }

    public function show($id)
    {
        $permission = Permission::find($id);
        return view('user-management.permissions.show', compact('permission'));
    }

    public function edit($id)
    {
        $permission = Permission::find($id);
        return view('user-management.permissions.edit', [
            'permission' => $permission
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'string',
            'max:255',
            'unique:permissions.name',
        ]);

        $permission = Permission::find($id);
        $permission->update($request->all());

        return redirect()->route('permission.index')
            ->with('success', 'Permission updated successfully');
    }

    public function destroy($id)
    {
        $permission = Permission::find($id);

        if ($permission) {
            $permission->delete();
            return response()->json(['success' => 'Permission deleted successfully.']);
        } else {
            return response()->json(['error' => 'Permission not found.'], 404);
        }
    }


}