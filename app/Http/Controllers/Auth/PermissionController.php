<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function create(Request $request)
    {
        if ($request->user()->cannot('create permissions')) {
            return response()->json([
                'error' => 'U bent niet gemachtigd om permissies aan te maken.'
            ], 403);
        }

        $this->validate($request, [
            'name' => 'required',
            'role' => 'required'
        ]);

        if (!$permission = Permission::create(['name' => $request->name])) {
            return response()->json([
                'error' => 'Permissie kon niet worden aangemaakt.'
            ], 400);
        }

        $role = Role::where('name', $request->role)->get();
        if ($role->isEmpty()) {
            return response()->json([
                'error' => 'Rol niet gevonden.'
            ], 404);
        }

        $permission->assignRole($role);

        return response()->json([
            'data' => $permission
        ], 200);
    }
}
