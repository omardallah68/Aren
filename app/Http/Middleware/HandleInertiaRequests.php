<?php

namespace App\Http\Middleware;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Spatie\Permission\Models\Role;
use function PHPUnit\Framework\isNull;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public function share(Request $request)
    {
        $user_roles = [];
        $user_permissions = [];
        if(!is_null(auth()->user())) {
            $user = User::with(['roles', 'permissions'])->find(auth()->user()->id);

            foreach ($user->roles as $role) {
                array_push($user_roles, strtolower($role->name));
                $role_permissions = Role::with('permissions')->find($role->id);

                if (is_object($role_permissions->permissions)) {
                    foreach ($role_permissions->permissions as $permission) {
                        if(!in_array($permission->name,$user_permissions))
                        array_push($user_permissions, strtolower($permission->name));
                    }
                }
            }
            if (!is_null($user->permissions)) {
                foreach ($user->permissions as $permission) {
                    array_push($user_permissions, strtolower($permission->name));
                }
            }
        }
        return array_merge(parent::share($request), [
            'loading' => fn() => $request->session()->get('loading'),
            'flash' => function () use ($request) {
                return[
                    'message' => fn() => $request->session()->get('message')
                ];
            },
            'user_roles' => $user_roles,
            'user_permissions' => $user_permissions,
        ]);


    }
}
