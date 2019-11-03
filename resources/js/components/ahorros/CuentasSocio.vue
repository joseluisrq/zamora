<template>
     <main>
        <template v-if="showlista">
            <div class="row">         
                <div class="col-lg-12 grid-margin stretch-card ">
                    <div class="card ">
                        <div class="card-body ">
                            <div class="row">
                                <!--INFORMACIÓN DEL SOCIO-->
                                <div class="col-md-12 ">
                                    <h4 class="text-dark font-weight-bold">
                                        <i class="mdi mdi-account-location mdi-36px"></i>INFORMACIÓN DEL SOCIO</h4>
                                    <hr>
                                </div>

                                <div class="col-md-3">
                                    <h5 class="font-weight-bold ">DNI:</h5>
                                    <p v-text="infosocio.dni"></p>
                                </div>
                                <div class="col-md-3 ">
                                    <h5 class="font-weight-bold ">Nombres y apellidos:</h5>
                                    <p v-text="infosocio.nombre+' '+infosocio.apellidos"></p>
                                </div>
                                <div class="col-md-3 ">
                                    <h5 class="font-weight-bold ">Fecha nacimiento:</h5>
                                     <p v-text="infosocio.fechanacimiento"></p>
                                </div>
                                <div class="col-md-3 ">
                                    <h5 class="font-weight-bold ">Dirección:</h5>
                                      <p v-text="infosocio.direccion"></p>
                                </div>
                                <div class="col-md-3 ">
                                    <h5 class="font-weight-bold ">Teléfono:</h5>
                                    <p v-text="infosocio.telefono"></p>
                                </div>
                                <div class="col-md-3">
                                    <h5 class="font-weight-bold ">Email:</h5>
                                    <p v-text="infosocio.email"></p>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12 ">
                                    <h4 class="text-dark font-weight-bold">
                                        <i class="mdi mdi-cash-usd mdi-36px"></i>INTERESES GANADOS POR LAS CUENTAS</h4>
                                    <hr>
                                </div>
                                <div class="col-md-3">
                                    <h5 class="font-weight-bold ">En total</h5>
                                    <p v-text="'S/. ' + interes_total"></p>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-12 ">
                                    <h4 class="text-dark font-weight-bold">
                                        <i class="mdi mdi-package-variant-closed mdi-36px"></i>CUENTAS DE AHORRO DEL SOCIO</h4>
                                    <hr>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="input-group">
                                        <select class="form-control col-md-12" v-model="criterio">
                                            <option value="numerocuenta">Número de cuenta</option>
                                            <option value="fechaapertura">Fecha de Apertura</option>
                                        </select>
                                        <input type="text" v-model="buscar" @keyup.enter="listarCuentas(1,buscar,criterio)" 
                                        class="form-control form-control-lg" placeholder="Texto a buscar">
                                        <button type="submit" @click="listarCuentas(1,buscar,criterio)" 
                                        class="btn btn-outline-primary btn-sm"><i class="fa fa-search"></i>  <i class="mdi mdi-magnify"></i> Buscar</button>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive pt-3 ">
                                <table class="table table-bordered ">
                                    <thead>
                                        <tr class="bg bg-dark text-white ">                                  
                                            <th>Opciones</th>
                                            <th>Tipo Cuenta</th>
                                            <th>N° Cuenta </th>
                                            <th>Saldo efectivo</th>
                                            <th>Tasa</th>
                                            <th>Interés ganados</th>
                                            <th>Fecha apertura</th>
                                            <th> Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="cuenta in arraycuentas" :key="cuenta.id">
                                            <td>
                                                <button type="button" @click="mostrarDetalleCuentaAhorros(cuenta.id)" class="btn btn-success btn-rounded btn-icon ">
                                                        <i class="mdi mdi-eye "></i>
                                                </button>
                                            </td>
                                            <td>
                                                <label v-show="cuenta.tipocuenta == 1" class="badge badge-success text-white">Ahorros</label>
                                                <label v-show="cuenta.tipocuenta == 2" class="badge badge-warning text-white">Plazo Fijo</label>
                                            </td>
                                            <td v-text="cuenta.numerocuenta"></td>
                                            <td v-text="cuenta.saldoefectivo"></td>
                                            <td v-text="cuenta.tasa"></td>
                                            <td v-text="cuenta.interes_ganado"></td>
                                            <td v-text="cuenta.fechaapertura"></td>
                                         
                                            <td v-if="cuenta.estado==0">
                                                <label class="badge badge-danger text-white ">Cancelada</label>
                                            </td>
                                            <td v-else>
                                                <label class="badge badge-success text-white ">Activa</label>
                                            </td>
                                        </tr>                                
                                    </tbody>
                                </table>
                                <nav>
                                    <ul class="pagination">
                                        <li class="page-item" v-if="pagination.current_page > 1">
                                            <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Anterior</a>
                                        </li>
                                        <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                            <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                                        </li>
                                        <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                            <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Siguiente</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
         </template>

         <template v-if="showdetalle">
            <button type="button" class="btn btn-warning" @click="listarCuentas(1,buscar,criterio)">
               <i class="mdi mdi-arrow-left-bold"></i> Historial de cuentas de Ahorro
            </button>  
             <detallecuentasocio :ruta="ruta" v-bind:id="idcuentaahorro"/>
         </template>

     </main>
</template>

<script>
    export default {        
        props:['ruta', 'id'],
        data: function(){
            return {
                idcuentaahorro: 0,

                infosocio: {
                    dni: '',
                    nombre: '',
                    apellidos: '',
                    fechanacimiento: '',
                    direccion: '',
                    telefono: '',
                    email: ''
                },

                interes_total: 0,

                arraycuentas: [],

                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'numerocuenta',
                buscar : '',

                showlista: true,
                showdetalle: false,
            }
        },
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            //Calcula los elementos de la paginación
            pagesNumber: function() {
                if(!this.pagination.to) {
                    return [];
                }
                
                var from = this.pagination.current_page - this.offset; 
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2); 
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }  

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            }
        },
        methods:{
            cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarCuentas(page,buscar,criterio);
            },
             //CARGAR LA TABLA DE CUENTAS
            listarCuentas (page,buscar,criterio){
                let me = this;
                var url= me.ruta+'/ahorro/cuentassocio?id='+me.id+'&criterio='+criterio+'&buscar='+buscar;
                axios.get(url).then(res => {
                    var respuesta = res.data;
                    me.arraycuentas = respuesta.cuentas.data;
                    me.pagination = respuesta.pagination;
                    me.mostrarTemplates(true, false);
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            obtenerIntereses(idcuenta){
                let me = this;
                var url= me.ruta+'/ahorro/intereses?id='+me.id;
                axios.get(url).then(res => {
                    me.interes_total = (res.data.interes_total == null) ? 0: res.data.interes_total;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            obtenerInfoSocio(){
                let me = this;
                var url= me.ruta+'/infosocio?id='+me.id;
                axios.get(url).then(res => {
                    me.infosocio = res.data.infosocio;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            mostrarDetalleCuentaAhorros(id){
                let me = this;
                me.idcuentaahorro = id;
                me.mostrarTemplates(false, true);
            },
            mostrarTemplates(lista, detalle){
                let me = this;
                me.showlista = lista;
                me.showdetalle = detalle;
            }
        },
        mounted() {
            this.listarCuentas(1,'','');
            this.obtenerInfoSocio();
            this.obtenerIntereses();
        }
    };
</script>
