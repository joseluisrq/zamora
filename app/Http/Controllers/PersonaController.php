<?php

namespace App\Http\Controllers;

use App\Credito;
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
                'personas.departamento',
                'personas.ciudad',
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
                'personas.departamento',
                'personas.ciudad',
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
                'personas.departamento',
                'personas.ciudad',
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
                'personas.departamento',
                'personas.ciudad',
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

        $validar = [
            'dni' => 'required|size:8',
            'nombres' => 'required',
            'apellidos' => 'required',
            'fechanacimiento' => 'required|date',
            'departamento' => 'required',
            'ciudad' => 'required',
            'direccion' => 'required',
            'telefono' => 'required'
        ];

        if(isset($request->correo)) $validar += array('correo' => 'email');

        $tipo = $request->tipo;

        if($tipo == 1){//Si se trata de usuarios, se deve validar campos adicionales
            $validar += array(
                'correo' => 'required|email',
                'usuario' => 'required|unique:users,usuario',
                'password' => 'required',
                'repetirpassword' => 'required|same:password',
                'rol' => 'required'
            );
        }

        $request->validate($validar);

        $id = Persona::select('id')->where('personas.dni', '=', $request->dni)->get();

        if(sizeof($id) > 0)//Existe una persona registrada con ese DNI
        {
            $id = $id[0]->id;
            $socio_duplicado = Socio::where('socios.id', '=', $id)->get();

            if($tipo == 0)// SE ESTÁ REGISTRANDO UN SOCIO
            {
                if(sizeof($socio_duplicado) > 0) return ["existe" => true, "noadmin" => false];
                else
                {
                    $usuario = User::join('roles', 'roles.id', '=', 'users.idrol')
                    ->select(
                        'users.id',
                        'roles.nombre'
                    )
                    ->where([
                        ['users.id', '=', $id],
                        ['roles.nombre', 'like', 'Admin'.'%']
                    ])->get();

                    if(sizeof($usuario) == 0) return ["existe" => true, "noadmin" => true];//No se puede registrar USUARIOS que no son ADMIN

                    try {
                        DB::beginTransaction();

                        $socio = new Socio();//REGISTRAR A LA PERSONA COMO SOCIO
                        $socio->id = $id;
                        $socio->estadoahorro = '0';
                        $socio->estadocredito = '0';
                        $socio->tipo = 'socio';
                        $socio->estado = 1;
                        $socio->save();

                        DB::commit();
                    } catch (Exception $e) {
                        DB::rollBack();
                    }
                    return [
                        "existe" => false,
                        "id" => $id
                    ];
                }
            }
            return ["existe" => true, "noadmin" => false];
        }

        try{
            DB::beginTransaction();
            $persona = new Persona();
            $persona->dni = $request->dni;//OCURRIRÁ ERROR CUANDO EL DNI SEA REPETIDO
            $persona->nombre = $request->nombres;
            $persona->apellidos = $request->apellidos;
            $persona->fechanacimiento = $request->fechanacimiento;
            $persona->departamento = $request->departamento;
            $persona->ciudad = $request->ciudad;
            $persona->direccion = $request->direccion;
            $persona->telefono = $request->telefono;
            $persona->email = $request->correo;
            $persona->save();

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
                $user->idrol = $request->rol;
                $user->save();
            }            
 
            DB::commit();
 
        } catch (Exception $e){
            DB::rollBack(); 
        }

        return [
                "existe" => false,
                "id" => $persona->id
            ];
	}

	public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $validar = [
            'dni' => 'required|size:8',
            'nombres' => 'required',
            'apellidos' => 'required',
            'fechanacimiento' => 'required|date',
            'departamento' => 'required',
            'ciudad' => 'required',
            'direccion' => 'required',
            'telefono' => 'required'
        ];

        if(isset($request->correo)) $validar += array('correo' => 'email');

        $tipo = $request->tipo;

        if($tipo == 1){//Si se trata de usuarios, se deve validar campos adicionales
            $validar += array(
                'correo' => 'required|email',
                'usuario' => 'required',
                // 'password' => 'required',
                // 'repetirpassword' => 'required|same:password',
                'rol' => 'required'
            );
        }

        $request->validate($validar);

        if($request->dniprevio != $request->dni)//QUIERE DECIR QUE INTENTA CAMBIAR SU NÚMERO DE DNI
        {
            $duplicado_dni = Persona::where('personas.dni', '=', $request->dni)->get();//BUSCAMOS SI EXISTE EL DNI QUE INTENTA INGRESAR
            if(sizeof($duplicado_dni) > 0) return ["existe" => true];
        }

        $tipo = $request->tipo;

        if($tipo == 1)
        {
            if($request->usuarioprevio != $request->usuario)//QUIERE DECIR QUE INTENTA CAMBIAR DE NOMBRE DE USUARIO
            {
                $duplicado_user = User::where('users.usuario', '=', $request->usuario)->get();

                if(sizeof($duplicado_user) > 0) return ["existe" => false, "dobleuser" => true];
            }
        }
         
        try{
            DB::beginTransaction();
            $persona = Persona::findOrFail($request->id);
            $persona->dni = $request->dni;//OCURRIRÁ ERROR CUANDO EL DNI SEA REPETIDO
            $persona->nombre = $request->nombres;
            $persona->apellidos = $request->apellidos;
            $persona->fechanacimiento = $request->fechanacimiento;
            $persona->direccion = $request->direccion;
            $persona->telefono = $request->telefono;
            $persona->email = $request->correo;
            $persona->save();

            if($tipo == 1)//SI SE TRATA DE USUARIO, SE PUEDE ACTUALIZAR EL NOMBRE DE USUARIO, EL PASSWORD , EL ROL Y LA CONDICIÓN
            {
                $user = User::findOrFail($persona->id);
                $user->usuario = $request->usuario;
                // $user->password = bcrypt($request->password);//EL PASSWORD ADMIN NO PUEDE CAMBIAR EL PASSWORD EN ESTE MÓDULO
                $user->condicion = $request->condicion;//USUARIO ACTIVO
                $user->idrol = $request->rol;
                $user->save();
            }            
 
            DB::commit();
 
        } catch (Exception $e){
            DB::rollBack(); //DESHACER TODO SI HUBIERA ALGÚN ERROR
        }

        return [
            "existe" => false,
            "dobleuser" => false,
            "id" => $persona->id
        ];
	}

	public function delete(Request $request)
    {
       if (!$request->ajax()) return redirect('/'); 

       try{
            DB::beginTransaction();

            // VERIFICAR QUE NO TENGA CRÉDITOS ACTIVOS
            $creditos = Credito::where([
                ['creditos.idsocio', '=', $request->id],
                ['creditos.estado', '=', '1']
            ])->get();

            if(sizeof($creditos) > 0)
                return ["hascreditos" => true, "creditos" => $creditos];

            //CAMBIAR DATOS PARA EVITAR CONFLICTOS
            $persona = Persona::findOrFail($request->id);//REGISTRAR A LA PERSONA COMO SOCIO
            $persona->dni = substr($persona->dni, 0, 8);
            $persona->dni .= '-d-' . $request->id;
            $persona->save();

            $tipo = $request->tipo;

            if($tipo == 0)
            {
                $socio = Socio::findOrFail($request->id);//DESACTIVAR SOCIO
                $socio->estado = 0;
                $socio->save();
            }
            else if($tipo == 1)
            {
                $user = User::findOrFail($request->id);//DESACTIVAR USUARIO
                $user->usuario = 'DES-' . $request->id;
                $user->condicion = 0;
                $user->save();
            }
 
            DB::commit();

            return ["hascreditos" => false, "creditos" => $creditos];

        } catch (Exception $e){
            DB::rollBack(); //DESHACER TODO SI HUBIERA ALGÚN ERROR
        }
	}
}
