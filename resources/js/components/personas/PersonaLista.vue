<template>
    <div class="">
        <button v-if="!showlista" class="btn btn-success mr-2" @click="showlista=true; showdetalle=showactualizar=false">volver</button>
        <div v-show="showlista" class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 v-if="tipo==0" class="card-title">LISTA DE SOCIOS</h4>
                        <h4 v-else class="card-title">LISTA DE USUARIOS</h4>
                        <!-- INICIO BARRA DE BÚSQUEDA -->
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="input-group">
                                    <select class="form-control col-md-3 border border-dark" v-model="criterio">
                                        <option value="dni">DNI</option>
                                        <option value="nombre">Nombre</option>
                                        <option value="apellidos">Apellidos </option>
                                        <option value="telefono">Teléfono</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarPersona(1,buscar,criterio)" 
                                    class="form-control form-control-lg border border-dark" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarPersona(1,buscar,criterio)" 
                                     class="btn btn-outline-dark btn-sm"><i class="fa fa-search"></i> Buscar</button>
                                
                                </div>
                            </div>
                        </div>
                        <!-- FIN BARRA DE BÚSQUEDA -->
                        <p v-if="tipo==0" class="card-description">
                        Información de Socios <code>Detalle</code>
                        </p>
                        <p v-else class="card-description">
                        Información de Usuarios <code>Detalle</code>
                        </p>
                        <div class="table-responsive pt-3">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="bg bg-dark text-white">
                                        <th>#</th>
                                        <th>Opciones</th>
                                        <th v-show="tipo==1">Rol</th>
                                        <th>DNI</th>
                                        <th>Nombres</th>
                                        <th>Apellidos</th>
                                        <th v-show="tipo==1">Fecha N.</th>
                                        <th>Teléfono</th>
                                        <th v-show="tipo==1">Direccion</th>
                                        <th v-show="tipo==1">Email</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(persona, index) in arraypersonas" :key="persona.id">
                                        <td>{{ index + 1 }}</td>
                                        <td>
                                            <!--detalle de socio--> 
                                            <button v-show="tipo==0" type="button" class="btn btn-success btn-rounded btn-icon" @click="mostrardetalle(persona.id)">
                                                    <i class="mdi mdi-eye"></i>
                                            </button>
                                            <!--editar de socio-->  
                                            <button type="button" class="btn btn-warning btn-rounded btn-icon" @click="cargardatosactualizar(persona.id)">
                                                    <i class="mdi mdi-lead-pencil"></i>
                                            </button>
                                            <!--eliminar de socio-->    
                                            <button v-if="persona.condicion==1 || tipo==0" type="button" class="btn btn-danger btn-rounded btn-icon" @click="eliminarpersona(persona.id)">
                                                    <i class="mdi mdi-delete-forever"></i>
                                            </button>
                                            <button v-show="tipo==0" type="button" class="btn btn-info btn-rounded btn-icon">
                                                    <i class="mdi mdi-currency-usd"></i>
                                            </button>
                                        </td>
                                        <td v-show="tipo==1" v-text="persona.rol"></td>
                                        <td v-text="persona.dni"></td>
                                        <td v-text="persona.nombre"></td>
                                        <td v-text="persona.apellidos"></td>
                                        <td v-show="tipo==1" v-text="persona.fechanacimiento"></td>
                                        <td v-text="persona.telefono"></td>
                                        <td v-show="tipo==1" v-text="persona.direccion"></td>
                                        <td v-show="tipo==1" v-text="persona.email"></td>
                                        <td v-show="tipo==0">
                                            <label v-show="persona.estadocredito == 1" class="badge badge-success text-white">Con Credito</label>
                                            <label v-if="persona.estadocredito == 1 && persona.cuotasvencidas == 0" class="badge badge-success text-white">Sin Mora</label>
                                            <label v-if="persona.estadocredito == 1 && persona.cuotasvencidas > 0" class="badge badge-danger text-white">Con Mora</label>
                                            <label v-show="persona.estadocredito == 0" class="badge badge-primary text-white">Disponible</label>
                                        </td>
                                        <td v-show="tipo==1">
                                            <label v-if="persona.condicion==1" class="badge badge-success text-white">Activo</label>
                                            <label v-else class="badge badge-danger text-white">Inactivo</label>
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

        <registrarpersona v-show="showactualizar" :key="5" :ruta='ruta' :tipo="tipo" :registrar="0" :busactualizar="busactualizar" />

        <detallepersona v-show="showdetalle && tipo==0" :ruta="ruta" :tipo="tipo" :bus="bus"/><!-- EL BUS PERMITE PASAR INFO ENTRE COMPONENTES, ESTE COMPONENTE SÓLO SE MUESTRA PARA LOS SOCIOS, NO PARA LOS USUARIOS -->
    </div>
</template>

<script>
    export default {
        props:['ruta', 'tipo'],
        data: function(){
            return {
                bus: new Vue(),
                busactualizar: new Vue(),

                arraypersonas: [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'nombre',
                buscar : '',

                showlista: true,
                showdetalle: false,
                showactualizar: false
            };
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
        methods: {
            mostrarAlerta: function(posicion, tipo, titulo, btnconfirm, tiempo){
                Swal.fire({
                    position: posicion,
                    type: tipo,
                    title: titulo,
                    showConfirmButton: btnconfirm,
                    timer: tiempo
                });
            },
            //CAMBIAR DE PAGINA Y CARGAR 10 REGISTROS DIFERENTES
            cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarPersona(page,buscar,criterio);
            },
             //CARGAR LA TABLA DE CLIENTES
            listarPersona (page,buscar,criterio){
                let me = this;
                var url= me.ruta+'/listapersonas?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio + '&tipo=' + me.tipo;
                axios.get(url).then(res => {
                    var respuesta = res.data;
                    me.arraypersonas = respuesta.personas.data;
                    me.pagination = respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            eliminarpersona(id){
                let me = this;
                me.id = id;
                var url= me.ruta+'/eliminarpersona?id=' + me.id + '&tipo=' + me.tipo;

                let tipoPersona = me.tipo == 0 ? 'Socio': 'Usuario';

                Swal.fire(
                {
                    title: 'Eliminar ' + tipoPersona,
                    text: "¿Está seguro de eliminar a este " + tipoPersona + "?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value)
                    {
                        axios.delete(url).then(res => {
                            me.listarPersona(1,'','');
                            me.mostrarAlerta('center', 'success', '¡¡¡ Eliminación correcta !!!', false, 2000);
                        })
                        .catch(function (error) {
                            me.mostrarAlerta('top-end', 'error', '¡¡¡ Ocurrió algún error, No se logró eliminar !!!', false, 2500);
                            console.log(error);
                        });
                    }
                })
            },
            listarpersonas(){
                this.listarPersona(1,'','');
            },
            cargardatosactualizar(id){
                this.busactualizar.$emit('cargardatosactualpersona', id);
                this.showactualizar = true;
                this.showlista = false;
            },

            // DETALLE DE LOS SOCIOS(CAMBIAR ESTA PARTE AL COMPONENTE PERSONADETALLE.VUE)
            mostrardetalle(id){
                this.bus.$emit('cargarDetalle', id);
                this.showdetalle = true;
                this.showlista = false;
            }
        },
        mounted() {
            let me = this;
            me.listarPersona(1,'','');
            me.busactualizar.$on('listarpersonas', me.listarpersonas);
        }
    };
</script>
