<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')
            ->select(['id', 'name'])
            ->paginate($perPage = 10, $columns = ['*'], $pageName = 'roles')
            ->through(fn($role) => [
                'id' => $role->id,
                'name' => $role->name,
                'permissions' => $role->permissions
            ]);
        return Inertia::render('Admin/Roles/Show',['roles'=> $roles]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return Inertia::render('Admin/Roles/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $user = new Role([
            'name' => $request->name,
            'guard_name' => 'web',

        ]);

        $user->save();

        return back(201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $permissions = Permission::select('id', 'name')->get();
        $role= Role::with('permissions')->where('id', $id)->first();
        return Inertia::render('Admin/Roles/Role/Show')->with(['permissions'=> $permissions, 'role'=>$role]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role = Role::with('permissions')->where('id', $id)->first();

        $role->givePermissionTo($request->name);

        return response()->json([
            'message' => 'ADDED!'
        ]);
    }

    public function removePermissionFromRole(string $roleId, string $permissionId)
    {
        $role = Role::find($roleId);
        $permission = Permission::where('id', $permissionId)->first();
        $role->revokePermissionTo($permission->name);
        return response()->json([
            'message' => 'The role has not any more the ' . $permission->name . ' permission.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


}
