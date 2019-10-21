<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{  public function mostrarFormularioLogin(){
    return view('auth.login');
}

public function login(Request $request){
    
   // $this->validarLogin($request);
    //verificacion de la informacion de l usuario
    if(Auth::attempt([
        'usuario'=>$request->usuario,
        'password'=>$request->password,
        'condicion'=>1,
        
    ])){
        return redirect()->route('main');
    }

    else{
        return back()->withErrors(['usuario'=>trans('auth.failed')])//muestra error 
    ->withInput(request(['usuario'])); //regresa el nombre de usuario
    }
}   

protected function validarLogin(Request $request){
        //validacion de elementos de usuario y password
        $this->validate($request,[
            'usuario'=>'required|string',
            'password'=>'required|string'
        ]);
}

public function cerrarSesion(Request $request){
    //validacion de elementos de usuario y password
    Auth::logout();
    $request->session()->invalidate();
    return redirect('/');
}
}
