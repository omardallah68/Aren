<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use DB;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('roles:id,name')
            ->select(['id', 'name', 'email'])
            ->paginate($perPage = 10, $columns = ['*'], $pageName = 'users')
            ->through(fn($user) => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'roles' => $user->roles
            ]);
        $roles = Role::all();

        return Inertia::render('Admin/Users/Show')->with(['users' => $users, 'roles'=>$roles]);

    }

    public function getAll () {
        return User::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return Inertia::render('Admin/Users/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $user->save();
        $user->assignRole('member');

        return redirect('admin/users');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $roles = Role::select('id', 'name')->get();
        $teams = Team::select('id', 'name')->get();
        $user= User::with('roles')->where('id', $id)->first();

        return Inertia::render('Admin/Users/User/Show')->with(['user'=> $user, 'roles'=>$roles, 'teams'=>$teams]);
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

        $user= User::with('roles')->where('id', $id)->first();

        setPermissionsTeamId($request->team_id);
        $user->assignRole($request->name);
        $user->save();

        if ($user->hasRole($request->name)) {
        }

        return response()->json([
            'message' => 'ADDED!'
        ]);
    }


    public function removeRoleFromUser(string $userId, string$roleId)
    {
        $user = User::find($userId);
        $role = Role::with('permissions')->where('id', $roleId)->first();
        $user->removeRole($role->name);
        return response()->json([
            'message' => 'The user has not any more the ' . $role->name . ' role.'
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
