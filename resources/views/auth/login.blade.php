@extends('auth.contenido')

@section('login')
<div class="container-scroller card">
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <div class="auto-form-wrapper card-body">
                <form class="form-horizontal was-validated" method="POST" action="{{route('login')}}">
                    {{ csrf_field() }} 
                    <div class="card-body">
                    <h1 class="text-center">Login</h1>
                    <div class="form-group mb-3{{$errors->has('usuario' ? 'is-invalid' : '')}}">
                        <label class="label">Usuario</label>
                      <input type="text" name="usuario" id="usuario"  value="{{old('usuario') }}"class="form-control" placeholder="Ingrese Usuario">
                        {!!$errors->first('usuario','<span class="invalid-feedback">:message</span>')!!}
                      </div>
                      <div class="form-group mb-4{{$errors->has('password' ? 'is-invalid' : '')}}">
                          <label class="label">Contraseña</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="*******">
                        {!!$errors->first('password','<span class="invalid-feedback">:message</span>')!!}
                      </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary submit-btn btn-block">Ingresar</button>
                </div>
                <div class="form-group">
                  
                    <p class="footer-text text-center text-dark">copyright © 2019 Cooperativa Zamora</p>
                </div>
              
              </div>
              </form>
            </div>
           
           
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>


@endsection
