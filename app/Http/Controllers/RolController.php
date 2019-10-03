<?php

namespace App\Http\Controllers;

use App\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $roles = Rol::select(
                    'roles.id',
                    'roles.nombre',
                    'roles.descripcion'
                )
                ->where('roles.condicion', '=', '1')//OBTENER LOS ROLES ACTIVOS
                ->get();

        return [
            'roles' => $roles
        ];
    }
}
