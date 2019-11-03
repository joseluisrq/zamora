<template>
    <div class="content-wrapper">

        <!-- INICIO NUEVO APORTE -->
        <template v-if="showregistro">
            <div class="row ">
                <div class="col-lg-12">
                    <button class="btn btn-success mr-2" @click="limpiarformulario();mostrarComponente(false, false, true)">Lista de Aportes</button>
                </div>
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-dark"><i class="mdi mdi-cash-multiple mdi-36px"></i>Registrar Aportes -Socios</h4>
                            <hr>
                            <p class="card-description text-primary">
                                Verifique la Información antes de hacer el aporte
                            </p>
                            <form id="formRegistro" @submit="prevenirDefault" class="forms-sample">
                                <div class="form-group">
                                    <label for="dnisocio" class="font-weight-bold">Socio (Ingrese N° de DNI )</label>
                                    <v-select
                                        id="dnisocio"
                                        :class="['col-md-12', 'border',errores.dni ? 'border-danger' : '']"
                                        :on-search="selectSocio"
                                        label="dni"
                                        :options="arraysocios"
                                        placeholder="Ingrese DNI del socio..."
                                        :onChange="getDatosSocio"
                                    >
                                    </v-select>
                                    <div v-if="idsocio!=0">
                                        <label class="badge badge-dark" v-text="nombre+' '+apellidos"/>
                                    </div>
                                    <span v-if="errores.dni" class="text-danger">{{ errores.dni[0] }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="montoaporte" class="font-weight-bold">Tasa de interés</label>
                                    <input id="montoaporte" type="number" step="0.01" v-model="tasa" class="form-control" disabled="">
                                </div>
                                <div class="form-group">
                                    <label for="montoaporte" class="font-weight-bold">Monto de Aporte(S/)</label>
                                    <input id="montoaporte" type="number" v-model="monto" :class="['form-control', 'border',errores.monto ? 'border-danger' : '']" placeholder="Monto">
                                    <span v-if="errores.monto" class="text-danger">{{ errores.monto[0] }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="descripcionaporte" class="font-weight-bold">Descripción</label>
                                    <input id="descripcionaporte" type="text" v-model="descripcion" :class="['form-control', 'border',errores.descripcion ? 'border-danger' : '']" placeholder="Detalle de Aporte">
                                    <span v-if="errores.descripcion" class="text-danger">{{ errores.descripcion[0] }}</span>
                                </div>                                
                            
                                <input type="submit" class="btn btn-primary mr-2" value="Registrar Aporte" @click="registraraporte"/>
                                <a class="btn btn-light" @click="limpiarformulario();mostrarComponente(false, false, true)">Cancelar</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>    
        </template>
        <!-- FIN NUEVO APORTE -->

        <!-- INICIO APORTE REGISTRADO CON ÉXITO -->
        <template v-if="showmsgregistro">
            <div class="row ">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">                            
                            <h4 class=" text-primary text-center"><i class="mdi mdi-checkbox-marked-circle-outline mdi-36px"></i>Aporte registrado con éxtio</h4>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-danger btn-icon-text" @click="descargarBoucher(idaporte)">
                                        <i class="mdi mdi-upload btn-icon-prepend"></i>   
                                        Descargar Boucher
                                    </button>
                                </div>
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-info btn-icon-text" @click="mostrarComponente(false, false, true)">
                                        <i class="mdi mdi-upload btn-icon-prepend"></i>
                                        Historial de Aportes
                                    </button>
                                </div>
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-success btn-icon-text" @click="mostrarComponente(true, false, false)">
                                        <i class="mdi mdi-upload btn-icon-prepend"></i>
                                        Nuevo Aporte
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        <!-- FIN APORTE REGISTRADO CON ÉXITO -->

        <!-- INICIO LISTA APORTES -->
        <template v-if="showlista">
            <div class="row">
                <div class="col-lg-12">
                    <button class="btn btn-success mr-2" @click="mostrarComponente(true, false, false)">Registrar Aporte</button>
                </div>
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">APORTES DE SOCIOS</h4>
                            <p class="card-description">
                            Información de Aportes <code>Detalle</code>
                            </p>
                            <div class="col-md-6 col-sm-12">
                                <div class="input-group">
                                    <select class="form-control col-md-3 border border-dark" v-model="criterio">
                                        <option value="dni">DNI</option>
                                        <option value="nombre">Nombre</option>
                                        <option value="fecharegistro">Fecha de aporte</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listaraportes(1,buscar,criterio)" 
                                    class="form-control form-control-lg border border-dark" placeholder="Texto a buscar">
                                    <button type="submit" @click="listaraportes(1,buscar,criterio)" 
                                     class="btn btn-outline-dark btn-sm"><i class="fa fa-search"></i>Buscar</button>
                                </div>
                            </div>
                            <div class="table-responsive pt-3">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="bg bg-info text-white">
                                            <th>#</th>
                                            <th>Descargar Boucher</th>
                                            <th>Fecha de registro</th>
                                            <th>DNI Socio</th>
                                            <th>Nombres y  Apellidos</th>
                                            <th>Monto</th>                                                      
                                            <th>Descripcion</th>
                                            <th>Cajero</th>    
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(aporte, index) in arrayaportes" :key="aporte.id">
                                            <td>{{ index + 1 }}</td>
                                            <td>
                                                <button type="button" @click="descargarBoucher(aporte.id)" class="btn btn-danger btn-icon-text"><i class="mdi mdi-file-pdf btn-icon-prepend"></i></button>
                                            </td>
                                            <td v-text="aporte.fecharegistro"></td>
                                            <td v-text="aporte.dni"></td>
                                            <td v-text="aporte.nombre + ' ' + aporte.apellidos"></td>
                                            <td v-text="aporte.monto"></td>
                                            <td v-text="aporte.descripcion"></td>
                                            <td v-text="aporte.usuario"></td>
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
        <!-- FIN LISTA APORTES -->

    </div>    
</template>

<script>
    import vSelect from 'vue-select'

    export default {
        props:['ruta'],
        data: function(){
            return {
                idsocio: 0,
                idaporte: '',
                dni: '',
                nombre: '',
                apellidos: '',
                monto: '',
                descripcion: '',

                tasa: '',

                socioseleccionado: false,

                arraysocios: [],

                arrayaportes: [],
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

                showregistro : false,
                showmsgregistro : false,
                showlista : true,

                errores: []
            }
        },
        components:{
            vSelect
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
            cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listaraportes(page,buscar,criterio);
            },
            mostraralerta: function(posicion, tipo, titulo, btnconfirm, tiempo){
                Swal.fire({
                    position: posicion,
                    type: tipo,
                    title: titulo,
                    showConfirmButton: btnconfirm,
                    timer: tiempo
                });
            },
            prevenirDefault(e){
                e.preventDefault();
            },
            limpiarformulario(){
                let me = this;
                me.idaporte = '';
                me.monto = '';
                me.descripcion = '';

                me.errore = [];

                me.limpiarselect();
            },
            limpiardatossocio(){
                let me = this;
                me.idsocio = 0;
                me.dni = '';
                me.nombre = '';
                me.apellidos = '';
                me.socioseleccionado = false;
                me.arraysocios = [];
            },
            limpiarselect(){
                let me = this;
                me.limpiardatossocio();//Limpiar datos del socio
                me.$nextTick(() => {
                    me.selected = null;//Limpiar el valor de label de v-select
                })
            },
            listaraportes(page,buscar,criterio){
                let me = this;
                var url= me.ruta+'/aporte/listar?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(res => {
                    var respuesta = res.data;
                    me.arrayaportes = respuesta.aportes.data;
                    me.pagination = respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            registraraporte(){
                let me = this;

                me.errores = [];

                let aporte = {
                        'idsocio': me.idsocio,
                        'dni': me.dni,
                        'monto': me.monto,
                        'descripcion': me.descripcion
                    };

                    axios.post(me.ruta + '/aporte/registrar', aporte)
                    .then(res => {
                        me.limpiarformulario();
                        me.idaporte = res.data.idaporte;
                        me.mostrarComponente(false, true, false);//Mostrar el mensaje de confirmación de aporte registrado
                    })
                    .catch(err => {
                        me.errores = err.response.data.errors;
                        console.log(err);
                    });
            },
            selectSocio(search, loading){
                let me = this;
                 loading(true)
                var url = me.ruta+'/aporte/selectsocio?filtro='+search;
                axios.get(url).then(function (response) {
                    let respuesta = response.data;
                    q:search;
                    me.socioseleccionado = false;
                    me.arraysocios = respuesta.socios;
                    loading(false)
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            getDatosSocio(value){//Capturar el valor seleccionado de la lista
                let me = this;
                if(value){//si existe un valor para socio
                    me.loading = true;
                    me.idsocio = value.id;
                    me.dni = value.dni;
                    me.nombre = value.nombre;
                    me.apellidos = value.apellidos;
                    me.socioseleccionado = true;
                }else{//en el caso de que no exista, se limpia el label de v-select
                    me.limpiarselect();
                }
            },
            mostrarComponente(valregistro, valmensaje, vallista){
                let me = this;
                me.showregistro = valregistro;
                me.showmsgregistro = valmensaje;
                me.showlista = vallista;
                if(vallista) me.listaraportes(1, '', '');
                if(valregistro) me.cargarTasaAportes();
            },
            cargarTasaAportes(){
                let me = this;
                var url = me.ruta+'/empresa/tasaAportes';
                axios.get(url).then(res => {
                    me.tasa = res.data.tasa;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            descargarBoucher(idaporte){
                let me = this;
                me.mostrarComponente(false, false, true);
                window.open(me.ruta + '/aporte/pdfDetalleAporte?id='+idaporte,'_blank');
            }
        },
        mounted() {
            this.cargarTasaAportes();
            this.listaraportes(1, '', '');
        }
    };
</script>
