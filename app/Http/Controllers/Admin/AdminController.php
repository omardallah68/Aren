<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Spatie\DiscordAlerts\DiscordAlert;
use NotificationChannels\Telegram\TelegramMessage;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function index()
    {

        $users = User::with('roles:id,name')
            ->select(['id', 'name', 'email'])
            ->paginate($perPage = 5, $columns = ['name', 'roles'], $pageName = 'users')
            ->through(fn($user) => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'roles' => $user->roles
            ]);


        $roles = Role::with('permissions')
            ->select(['id', 'name'])
            ->paginate($perPage = 5, $columns = ['name', 'permissions'], $pageName = 'roles')
            ->through(fn($role) => [
                'id' => $role->id,
                'name' => $role->name,
                'permissions' => $role->permissions
            ]);

        $permissions = Permission::select('id', 'name')
            ->paginate($perPage = 5, $columns = ['name'], $pageName = 'permissions')
            ->through(fn($permission) => [
                'id' => $permission->id,
                'name' => $permission->name,
            ]);

        $teams = Team::select('id','name')
            ->paginate($perPage = 5, $columns = ['name'], $pageName = 'teams')
            ->through(fn($team) => [
                'id' => $team->id,
                'name' => $team->name,
            ]);

        $user = Auth::user();
        (new DiscordAlert)->to('default')->message(":wrench: This user has open the admin page: ". $user['name']);


        return Inertia::render('Admin/Show',['users' => $users, 'roles'=> $roles,'permissions' => $permissions, 'teams'=>$teams]);

    }
}
