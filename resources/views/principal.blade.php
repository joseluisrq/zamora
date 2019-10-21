<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cooperativa Zamora</title>
     <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="images/logo.png" />
  </head>
  <body>
    <div id="app">
        <div class="container-scroller">
            <div class="horizontal-menu">

         
                <!--cabecera del app--->
                <nav class="navbar top-navbar col-lg-12 col-12 p-0">
                    <div class="container-fluid">
                    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">
                    <ul class="navbar-nav navbar-nav-left">
        
                        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                            <span class="navbar-brand brand-logo" href="index.html"><img src="images/logo.png" alt="logo"/> Cooperativa de ahorro Zamora</span>
                            
                            <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/logo.png"  class="img-fluid" width="20px" height="20px" alt="logo"/></a>
                        </div>  
                    </ul>
                
                    <ul class="navbar-nav navbar-nav-right">
                        
                        <notificacion ></notificacion>
                       




                        <li>

                        <nav class="bottom-navbar ">                                
                            <ul class="nav page-navigation">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                   
                                    <span class="">{{Auth::user()->usuario}} </span>
                                    <img src="images/dashboard/face29.png" alt="profile"/>
                                    </a>
                                    <div class="submenu">
                                        <ul>
                                        <li class="">
                                            <a class=""  href="{{ route('cerrarsesion') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">   <i class="mdi mdi-logout text-primary"></i>
                                            Salir
                                            </a>
                                            
                                            <form id="logout-form" action="{{ route('cerrarsesion') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>                                                                
                                        </li>                                       
                                        </ul>
                                    </div>
                                </li>    
                            </ul>                            
                        </nav>

                        </li>
                       
                     
                 
                    </ul>
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
                        <span class="mdi mdi-menu"></span>
                    </button>
                    </div>
                    </div>
                </nav>
                <!--fin de cabecera del app--->

                @if(Auth::check()) <!--si el usuario esta autentificado-->
                    @if (Auth::user()->idrol == 1)
                        @include('plantilla.menuadministrador')
                    @elseif (Auth::user()->idrol == 2)
                        @include('plantilla.menuanalista')
                    @elseif (Auth::user()->idrol == 3)
                        @include('plantilla.menucajero')
                    @else
                
                    @endif

                @endif
                <!--inicio menu-->
            
                <!--fin menu-->

            </div>

            <!--Contenido-->
            @yield('contenido')			
            <!--Fin del contenido-->
        </div>
    </div><!--cierre del app-->
  


 
    <script src="vendors/base/vendor.bundle.base.js"></script>

    <script src="http://momentjs.com/downloads/moment.min.js"></script>
    <script src="js/app.js"></script>
    <script src="js/all.js"></script>

    <!--Luego eliminaremos estos uno por uno como al congreso-->
    
    <script src="vendors/chart.js/Chart.min.js"></script>
    <script src="vendors/progressbar.js/progressbar.min.js"></script>
	<script src="vendors/chartjs-plugin-datalabels/chartjs-plugin-datalabels.js"></script>
	<script src="vendors/justgage/raphael-2.1.4.min.js"></script>
    <script src="vendors/justgage/justgage.js"></script>
    <script src="http://momentjs.com/downloads/moment.min.js"></script>

   
    
    
  </body>
</html>