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
                        
                    
                        <li class="nav-item dropdown">
                                <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="#" data-toggle="dropdown">
                                    <i class="mdi mdi-bell mx-0"></i>
                                    <span class="count bg-primary">1</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                                    <p class="mb-0 font-weight-normal float-left dropdown-header">Notificaciones</p>
                                    <a class="dropdown-item preview-item">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-warning">
                                            <i class="mdi mdi-information mx-0"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content">
                                        <h6 class="preview-subject font-weight-normal">Cuota por vencer</h6>
                                        <p class="font-weight-light small-text mb-0 text-muted">
                                            25/10/2019
                                        </p>
                                    </div>
                                    </a>
                                    
                                </div>
                        </li>
                        <li>

                        <nav class="bottom-navbar ">                                
                            <ul class="nav page-navigation">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                   
                                    <span class="">Usuario</span>
                                    <img src="images/dashboard/face29.png" alt="profile"/>
                                    </a>
                                    <div class="submenu">
                                        <ul>
                                            <li class=""><a class="" href="#">   <i class="mdi mdi-logout text-primary"></i>  Cerrar Sesión</a></li>                                       
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

                <!--inicio menu-->
                @include('plantilla/menu')
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