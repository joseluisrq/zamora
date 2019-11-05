<!-- menu -->

<nav class="bottom-navbar">
          <div class="container">
              <ul class="nav page-navigation">
                <li @click="menu=0" class="nav-item">
                  <a class="nav-link" href="#">
                    <i class="mdi mdi-file-document-box menu-icon"></i>
                    <span class="menu-title">Escritorio</span>
                  </a>
                </li>
                
                <!--Creditos-->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="mdi mdi-cube-outline menu-icon"></i>
                      <span class="menu-title">Creditos</span>
                      <i class="menu-arrow"></i>
                    </a>
                    <div class="submenu">
                        <ul>
                         <!--   <li @click="menu=100" class="nav-item"><a class="nav-link" href="#">Pagar Cuota</a></li>-->
                            <li  @click="menu=30" class="nav-item"><a class="nav-link" href="#">Agregar Credito</a></li>
                            <li @click="menu=40"><a class="nav-link" href="#">Historial de Creditos</a></li>
                            <li @click="menu=31"><a class="nav-link" href="#">Simulador de Creditos</a></li>
                        </ul>
                    </div>
                </li>
                
                <!--Ahorros-->
                <li  class="nav-item">
                    <a href="#" class="nav-link">
                     
                      <i class="mdi mdi-cash-usd menu-icon"></i>
                      <span class="menu-title">Ahorros</span>
                      <i class="menu-arrow"></i>
                    </a>
                    <div class="submenu">
                          <ul>
                         <!--   <li class="nav-item" @click="menu=70"><a class="nav-link"  href="#">Registrar movimientos</a></li>-->
                          <!--  <li class="nav-item" @click="menu=71"><a class="nav-link"  href="#">Crear cuenta de Ahorros</a></li>-->
                            <li class="nav-item" @click="menu=72"><a class="nav-link"  href="#">Historial de Ahorros</a></li>
                         
                          </ul>
                      </div>
                </li>
                
                <!--Socios-->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                    <i class="mdi mdi-account-multiple-outline menu-icon"></i>
                      <span class="menu-title">Socios</span>
                      <i class="menu-arrow"></i>
                    </a>
                    <div class="submenu">
                          <ul>
                              <li class="nav-item" @click="menu=2"><a class="nav-link"  href="#">Lista de Socios</a></li>
                              <li class="nav-item" @click="menu=3"><a class="nav-link" href="#">Agregar Socios</a></li>
                              <li class="nav-item" @click="menu=4"><a class="nav-link"  href="#">Aportes</a></li>
                                                        
                          </ul>
                      </div>
                </li>
                
                 <!--Caja-->
          
                
                <!--reportes-->
                <li @click="menu=16" class="nav-item">
                    <a href="#" class="nav-link">
                    <i class="mdi mdi-chart-line menu-icon"></i>
                      <span class="menu-title">Reportes</span>
                      <i class="menu-arrow"></i>
                    </a>
                </li>
                
                <!--Acesso-->
              
                        <!--Configracion-->
                      
              </ul>
          </div>
        </nav>

  <!--  menu fin -->