<template>
     <main>
        <template v-if="showlista">
            <div class="row">         
                <div class="col-lg-12 grid-margin stretch-card ">
                    <div class="card ">
                        <div class="card-body ">
                            <h4 class="card-title ">Lista de Cuentas de Ahorro</h4>
                            <p class="card-description ">
                                Información de cuentas
                            </p>
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="input-group">
                                        <select class="form-control col-md-12" v-model="criterio">
                                            <option value="numerocuenta">Número de cuenta</option>
                                            <option value="dni">DNI Socio</option>
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
                                            <th> Opciones</th>
                                            <th> N° Cuenta </th>
                                            <th> Saldo efectivo</th>
                                            <th> Fecha apertura</th>
                                            <!-- <th> Tasa </th> -->
                                            <th> DNI Socio </th>
                                            <th> Nombres Socio </th>
                                            <!-- <th> Estado</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="cuenta in arraycuentas" :key="cuenta.id">
                                            <td>
                                                <button type="button" @click="mostrarDetalleCuentaAhorros(cuenta.id)" class="btn btn-success btn-rounded btn-icon ">
                                                        <i class="mdi mdi-eye "></i>
                                                </button>
                                            </td>
                                            <td v-text="cuenta.numerocuenta"></td>
                                            <td v-text="cuenta.saldoefectivo"></td>
                                            <td v-text="cuenta.fechaapertura"></td>
                                            <!-- <td v-text="cuenta.tasa"></td> -->

                                            <td v-text="cuenta.sociodni"></td>
                                            <td v-text="cuenta.socionombre+' '+cuenta.socioapellido"></td>
                                         
                                            <!-- <td v-if="cuenta.estado==0">
                                                <label class="badge badge-danger text-white ">Inactivo</label>
                                            </td>
                                            <td v-else>
                                                <label class="badge badge-success text-white ">Activo</label>
                                            </td> -->
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
             <detallecuenta :ruta="ruta" v-bind:id="idcuentaahorro"/>
         </template>
     </main>
</template>

<script>
    export default {        
        props:['ruta'],
        data: function(){
            return {
                idcuentaahorro: 0,

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
                var url= me.ruta+'/ahorro/listar?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio + '&tipo=' + me.tipo;
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
        }
    };
</script>
