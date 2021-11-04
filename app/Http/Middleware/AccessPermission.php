<?php

namespace App\Http\Middleware;
use Auth;
use App\Users;
use App\Permission;
use DB;
use App\Roles;
use Closure;
use Illuminate\Support\Facades\Route;

class AccessPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission = null)
    {
        $listRoleOfUser = Users::find(auth()->id())->roles()->select('roles.id')->pluck('id')->toArray();
        $listRoleOfUser = DB::table('roles')
            ->join('roles_permissions', 'roles.id', '=', 'roles_permissions.role_id')
            ->join('permissions', 'roles_permissions.permission_id', '=', 'permissions.id')
            ->whereIn('roles.id', $listRoleOfUser)
            ->select('permissions.*')
            ->get()->pluck('id')->unique();
        $check_per = Permission::where('name', $permission)->value('id');
        if ( $listRoleOfUser->contains($check_per) ) {
            return $next($request);
        }    
        return redirect('/admin/dashboard');
    }
}
