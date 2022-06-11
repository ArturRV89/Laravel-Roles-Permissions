<?php

namespace App\Http\Controllers;


use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class RoleControllerResourse extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::orderBy('name')->whereNot('name', 'super-user')->get();

        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::orderBy('name')->get();

        return view('roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'permissions' => 'required',
            'permissions.*' => 'required|integer|exists:permissions,id'
        ]);

        $newRole = Role::create(['name' => $request->name]);

        $permissions = Permission::whereIn('id', $request->permissions)->get();

        $newRole->syncPermissions($permissions);

        return redirect()->route('roles.index')->with('status', 'Роль создана');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $role = Role::whereNot('id', 'super-user')->findOrFail($role->id);
        $permissions = Permission::orderBy('name')->get();

        return view('roles.edit', compact([
            'role',
            'permissions'
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|max:255',
            'permissions' => 'required',
            'permissions.*' => 'required|integer|exists:permissions,id'
        ]);

        $role = Role::whereNot('id', 'super-user')->findOrFail($role->id)->get();
        $role->update([
            'name' => $request->name
        ]);

        $permissions = Permission::whereIn('id', $request->permissions)->get();
        $role->syncPermissions($permissions);

        return redirect()->back()->with('status', 'Изменения прошли успешно');
    }

    /**
     * Delete role
     *
     * @param  \Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $permission = Permission::orderBy('name')->get();

        $role->revokePermissionTo($permission);
        $role->delete();

        return redirect()->back()->with('status', 'Удаление прошло успешно');
    }
}
