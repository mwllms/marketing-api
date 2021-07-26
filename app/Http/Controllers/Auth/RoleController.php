<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:api']);
    }

    public function index(Request $request)
    {
        if ($request->user()->cannot('show roles')) {
            return response()->json([
                'error' => 'U bent niet gemachtigd om rollen te bekijken.'
            ], 403);
        }

        $roles = Role::all();

        return response()->json([
            'data' => $roles
        ], 200);
    }

    public function create(Request $request)
    {
        if ($request->user()->cannot('create roles')) {
            return response()->json([
                'error' => 'U bent niet gemachtigd om rollen aan te maken.'
            ], 403);
        }

        $this->validate($request, [
            'name' => 'required',
        ]);

        if (!$role = Role::create(['name' => $request->name])) {
            return response()->json([
                'error' => 'Rol kon niet worden aangemaakt.'
            ], 400);
        }

        return response()->json([
            'data' => $role
        ], 200);
    }
}
