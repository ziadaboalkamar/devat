<?php

namespace App\Http\Controllers;

use App\Models\Route;
use App\Models\RouteUser;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function show_roles($id)
    {
        $user = User::findOrFail($id);
        $user_routes = $user->route;
        $routes = [];
        $all = [];
        if (is_array($user_routes) || is_object($user_routes))
        {
            foreach ($user_routes as $route) {
                $routes[] = $route->id;
            }
        }

        foreach ($user->roles->route as $route) {
            $routes[] = $route->id;
        }
        foreach (Route::all() as $item) {
            if (!in_array($item->id, $routes)) {
                $all[] = $item;
            }
        }


        return view('dashboard.pages.users.roles', [
            'user' => $user,
            'routes' => $all,
            'user_routes' => $user->route,
        ]);

    }

    public function update_role(Request $request, $id)
    {
        $roles = $request->roles ?? [];
        $user_route = RouteUser::where('user_id', $id)->delete();

        foreach ($roles as $item) {
            RouteUser::create([
                'user_id' => $id,
                'route_id' => $item
            ]);
        }
        return redirect()->route('admins.users.index');
    }
}
