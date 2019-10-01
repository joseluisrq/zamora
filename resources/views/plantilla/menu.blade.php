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
                            <li class="nav-item"><a class="nav-link" href="">Pagar Cuota</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Agregar Credito</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Historial de Creditos</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">Configuracion</a></li>
                        </ul>
                    </div>
                </li>
                
                <!--Ahorros-->
                <li  class="nav-item">
                    <a href="pages/forms/basic_elements.html" class="nav-link">
                      <i class="mdi mdi-chart-areaspline menu-icon"></i>
                      <span class="menu-title">Ahorros</span>
                      <i class="menu-arrow"></i>
                    </a>
                    <div class="submenu">
                          <ul>
                              <li class="nav-item"><a class="nav-link"  href="#">Registrar movimientos</a></li>
                              <li class="nav-item"><a class="nav-link"  href="#">Crear cuenta de Ahorros</a></li>
                              <li class="nav-item"><a class="nav-link"  href="#">Historial de Ahorros</a></li>
                              <li class="nav-item"><a class="nav-link"  href="#">Configuracion</a></li>
                          </ul>
                      </div>
                </li>
                
                <!--Socios-->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="mdi mdi-finance menu-icon"></i>
                      <span class="menu-title">Socios</span>
                      <i class="menu-arrow"></i>
                    </a>
                    <div class="submenu">
                          <ul>
                              <li class="nav-item"><a class="nav-link"  href="#">Lista de Socios</a></li>
                              <li class="nav-item"><a class="nav-link" href="#">Agregar Socios</a></li>
                              <li class="nav-item"><a class="nav-link"  href="#">Agregar Aporte</a></li>
                              <li class="nav-item"><a class="nav-link"  href="#">Historial de Cambios</a></li>
                              <li class="nav-item"><a class="nav-link" href="#">Configuracion</a></li>
                          </ul>
                      </div>
                </li>
                
                 <!--Caja-->
                <li @click="menu=15" class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="mdi mdi-grid menu-icon"></i>
                      <span class="menu-title">Caja</span>
                      <i class="menu-arrow"></i>
                    </a>
                </li>
                
                <!--reportes-->
                <li @click="menu=16" class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="mdi mdi-emoticon menu-icon"></i>
                      <span class="menu-title">Reportes</span>
                      <i class="menu-arrow"></i>
                    </a>
                </li>
                
                <!--Acesso-->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="mdi mdi-codepen menu-icon"></i>
                      <span class="menu-title">Acceso</span>
                      <i class="menu-arrow"></i>
                    </a>
                    <div class="submenu">
                        <ul class="submenu-item">
                            <li class="nav-item"><a class="nav-link" href="pages/samples/login.html">Usuarios</a></li>
                            <li class="nav-item"><a class="nav-link" href="pages/samples/login-2.html">Roles</a></li>
                           
                        </ul>
                    </div>
                </li>
                
              </ul>
          </div>
        </nav>

  <!--  menu fin -->