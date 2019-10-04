<?php

namespace App\Http\Controllers;

use App\Persona;
use App\Socio;
use App\User;
use Faker\Provider\date;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonaController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        
        $tipo = $request->tipo;
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        $personas = [];

        if($tipo == 0)
            $personas = $this->listarsocios($tipo, $buscar, $criterio);
        else if($tipo == 1)
            $personas = $this->listarusuarios($tipo, $buscar, $criterio);
         
        return [
            'pagination' => [
                'total'        => $personas->total(),
                'current_page' => $personas->currentPage(),
                'per_page'     => $personas->perPage(),
                'last_page'    => $personas->lastPage(),
                'from'         => $personas->firstItem(),
                'to'           => $personas->lastItem(),
            ],
            'personas' => $personas
        ];
	}

    private function listarsocios($tipo, $buscar, $criterio)
    {
        if ($buscar==''){
            $personas = Persona::join('socios', 'personas.id', '=', 'socios.id')
            ->select(
                'personas.id',
                'personas.dni',
                'personas.nombre',
                'personas.apellidos',
                'personas.telefono',
                'socios.estadoahorro',
                'socios.estadocredito',
                DB::raw('(select count(*) from cuotas inner join creditos on creditos.id = cuotas.idcredito where personas.id = creditos.idsocio and cuotas.fechacancelo is null and cuotas.fechapago < "' . date('Y-m-d') . '") as cuotasvencidas')
            )
            ->where('socios.estado', '=', 1)
            ->orderBy('personas.id', 'desc')->paginate(15);
        }
        else{
            $personas = Persona::join('socios', 'personas.id', '=', 'socios.id')
            ->select(
                'personas.id',
                'personas.dni',
                'personas.nombre',
                'personas.apellidos',
                'personas.telefono',
                'socios.estadoahorro',
                'socios.estadocredito'
            )
            ->where('socios.estado', '=', 1)
            ->where('personas.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('personas.id', 'desc')->paginate(15);
        }

        return $personas;
    }

    private function listarusuarios($tipo, $buscar, $criterio)
    {
        if ($buscar==''){
            $personas = Persona::join('users', 'personas.id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'users.idrol')
            ->select(
                'personas.id',
                'personas.dni',
                'personas.nombre',
                'personas.apellidos',
                'personas.fechanacimiento',
                'personas.telefono',
                'personas.direccion',
                'personas.email',
                'roles.nombre as rol',
                'users.condicion'
            )
            ->orderBy('personas.id', 'desc')->paginate(15);
        }
        else{
            $personas = Persona::join('users', 'personas.id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'users.idrol')
            ->select(
                'personas.id',
                'personas.dni',
                'personas.nombre',
                'personas.apellidos',
                'personas.fechanacimiento',
                'personas.telefono',
                'personas.direccion',
                'personas.email',
                'roles.nombre as rol',
                'users.condicion'
            )
            ->where('personas.'.$criterio, 'like', '%'. $buscar . '%')
            ->orderBy('personas.id', 'desc')->paginate(15);
        }

        return $personas;
    }

    public function detalle(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $tipo = $request->tipo;

        $personas = [];

        if($tipo == 0)
        {
            $personas = Persona::select(
                'personas.id',
                'personas.dni',
                'personas.nombre',
                'personas.apellidos',
                'personas.fechanacimiento',
                'personas.telefono',
                'personas.direccion',
                'personas.email'
            )
            ->where('personas.id', '=', $request->id)
            ->get();
        }
        else if($tipo == 1)
        {
            $personas = Persona::join('users', 'personas.id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'users.idrol')
            ->select(
                'personas.id',
                'personas.dni',
                'personas.nombre',
                'personas.apellidos',
                'personas.fechanacimiento',
                'personas.telefono',
                'personas.direccion',
                'personas.email',

                'users.usuario',
                'users.password',
                'users.condicion',

                'roles.id as idrol'
            )
            ->where('personas.id', '=', $request->id)
            ->get();
        }

        return [
            'personas' => $personas
        ];
    }

	public function store(Request $request)
    {
		if (!$request->ajax()) return redirect('/');

        $registros = Persona::where('personas.dni', '=', $request->dni)->get();

        if(sizeof($registros) > 0) return ["existe" => true];

        try{
            DB::beginTransaction();
            $persona = new Persona();
            $persona->dni = $request->dni;//OCURRIRÁ ERROR CUANDO EL DNI SEA REPETIDO
            $persona->nombre = $request->nombres;
            $persona->apellidos = $request->apellidos;
            $persona->fechanacimiento = $request->fec_nac;
            $persona->direccion = $request->direccion;
            $persona->telefono = $request->tel_cel;
            $persona->email = $request->correo;
            $persona->save();

            $tipo = $request->tipo;
            // SI TIPO==0, REGISTRAMOS UN SOCIO
            if($tipo == 0)
            {
                $socio = new Socio();//REISTRAR A LA PERSONA COMO SOCIO
                $socio->id = $persona->id;
                $socio->estadoahorro = '0';
                $socio->estadocredito = '0';
                $socio->tipo = 'socio';
                $socio->estado = 1;
                $socio->save();
            }
            else if($tipo == 1)// SI TIPO==1, REGISTRAMOS UN USUARIO, ES NECESARIO VERIFICAR EN EL CASO DE QUE SE QUIERA AGREGAR MÁS OPCIONES EN EL FUTURO
            {
                $user = new User();//REISTRAR A LA PERSONA COMO USUARIO
                $user->id = $persona->id;
                $user->usuario = $request->usuario;
                $user->password = bcrypt($request->password);//PASSWORD ENCRIPTADO
                $user->condicion = '1';//USUARIO ACTIVO
                $user->idrol = $request->idrol;
                $user->save();
            }            
 
            DB::commit();
 
        } catch (Exception $e){
            DB::rollBack(); //DESHACER TODO SI HUBIERA ALGÚN ERROR
        }

        return [
                "existe" => false,
                "id" => $persona->id
            ];
	}

	public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
         
        try{
            DB::beginTransaction();
            $persona = Persona::findOrFail($request->id);
            $persona->dni = $request->dni;//OCURRIRÁ ERROR CUANDO EL DNI SEA REPETIDO
            $persona->nombre = $request->nombres;
            $persona->apellidos = $request->apellidos;
            $persona->fechanacimiento = $request->fec_nac;
            $persona->direccion = $request->direccion;
            $persona->telefono = $request->tel_cel;
            $persona->email = $request->correo;
            $persona->save();

            $tipo = $request->tipo;

            if($tipo == 1)//SI SE TRATA DE USUARIO, SE PUEDE ACTUALIZAR EL NOMBRE DE USUARIO, EL PASSWORD , EL ROL Y LA CONDICIÓN
            {
                $user = User::findOrFail($persona->id);
                $user->usuario = $request->usuario;
                $user->password = bcrypt($request->password);//PASSWORD ENCRIPTADO
                $user->condicion = $request->condicion;//USUARIO ACTIVO
                $user->idrol = $request->idrol;
                $user->save();
            }            
 
            DB::commit();

            return $persona->id;
 
        } catch (Exception $e){
            DB::rollBack(); //DESHACER TODO SI HUBIERA ALGÚN ERROR
        }
	}

	public function delete(Request $request)
    {
       if (!$request->ajax()) return redirect('/'); 

       $tipo = $request->tipo;

       try{
            DB::beginTransaction();

            if($tipo == 0)
            {
                $socio = Socio::findOrFail($request->id);//REGISTRAR A LA PERSONA COMO SOCIO
                $socio->estado = 0;
                $socio->save();
            }
            else if($tipo == 1)
            {
                $user = User::findOrFail($request->id);//REGISTRAR A LA PERSONA COMO SOCIO
                $user->condicion = 0;
                $user->save();
            }
 
            DB::commit();
 
        } catch (Exception $e){
            DB::rollBack(); //DESHACER TODO SI HUBIERA ALGÚN ERROR
        }
	}
}
