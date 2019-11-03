<template>
    <div class="content-wrapper">

        <template v-if="showformregistro || showtiempo">
            <button type="button" class="btn btn-warning" @click="elegirTipoCuenta">
               <i class="mdi mdi-arrow-left-bold"></i> Elegir Tipo de cuenta
            </button>
         </template>

        <!-- INICIO TIPO CUENTA -->
        <template v-if="showtipocuenta">
            <div class="row ">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">                            
                            <h4 class=" text-primary text-center"><i class="mdi mdi-checkbox-marked-circle-outline mdi-36px"></i>Seleccionar tipo de Cuenta a crear</h4>
                            <hr>
                            <div class="row">
                                <div v-if="!showtiempo" class="col-md-4">
                                    <button type="button" class="btn btn-success btn-icon-text" @click="cargarTasaCuenta(1, '', '')">
                                        <i class="mdi mdi-clock-fast btn-icon-prepend"></i>   
                                        Cuenta de Ahorros
                                    </button>
                                </div>
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-warning btn-icon-text" @click="showtiempo=true">
                                        <i class="mdi mdi-clock-end btn-icon-prepend"></i>
                                        Cuenta a Plazo Fijo
                                    </button>
                                </div>
                            </div>
                            <div v-if="showtiempo" class="row">
                                <div class="col-md-12">
                                    <h5 class=" text-primary text-center">Seleccionar Plazo</h5>
                                </div>
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-inverse-dark btn-icon-text col-md-12" @click="cargarTasaCuenta(2, 30, 'Desde 15 hasta 30 días')">
                                        <i class="mdi mdi-upload btn-icon-prepend"></i>   
                                        de 15 hasta 30 días
                                    </button>
                                    <hr>
                                      <button type="button" class="btn  btn-inverse-dark btn-icon-text col-md-12" @click="cargarTasaCuenta(2, 90, 'Desde 31 hasta 90 días')">
                                        <i class="mdi mdi-upload btn-icon-prepend"></i>   
                                        de 31 hasta 90 días
                                    </button>
                                    <hr>
                                      <button type="button" class="btn  btn-inverse-dark btn-icon-text col-md-12" @click="cargarTasaCuenta(2, 180, 'Desde 91 hasta 180 días')">
                                        <i class="mdi mdi-upload btn-icon-prepend"></i>   
                                        de 91 hasta 180 días
                                    </button>
                                    <hr>
                                         <button type="button" class="btn  btn-inverse-dark btn-icon-text col-md-12" @click="cargarTasaCuenta(2, 360, 'Desde 181 a 360 días')">
                                        <i class="mdi mdi-upload btn-icon-prepend"></i>   
                                        de 181 hasta 360 días
                                    </button>
                                    <hr>
                                     <button type="button" class="btn  btn-inverse-dark btn-icon-text col-md-12" @click="cargarTasaCuenta(2, 361, 'Desde 361 días a más de un año')">
                                        <i class="mdi mdi-upload btn-icon-prepend"></i>   
                                        más de un año
                                    </button>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        <!-- FIN TIPO CUENTA -->

        <!-- INICIO FORM REGISTRO -->
        <template v-if="showformregistro">
            <div class="row ">
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h3 class=" text-dark font-weight-bold">
                                    <i class="mdi mdi-cash-usd mdi-36px"></i>
                                    <span v-if="tipocuenta==1">Crear cuenta de Ahorros</span>
                                    <span v-if="tipocuenta==2">Crear cuenta a Plazo Fijo</span>
                            </h3>
                                    <hr>
                            <p class="card-description text-primary">
                                Verifique la Información antes de crear una cuenta de ahorros
                            </p>
                            <form id="formRegistro" @submit="prevenirDefault" class="forms-sample">
                                <div class="form-group">
                                    <label for="dnisocio " class="font-weight-bold">Socio (Ingrese N° de DNI )</label>
                                    <v-select
                                        id="dnisocio"
                                        :class="['border',errores.idsocio ? 'border-danger' : '']"
                                        :on-search="selectSocio"
                                        label="dni"
                                        :options="arraysocios"
                                        placeholder="Ingrese DNI del socio..."
                                        :onChange="getDatosSocio"
                                        clearable
                                        class="col-md-12"
                                    >
                                    </v-select>
                                    <div v-if="idsocio!=''">
                                        <label class="badge badge-dark" v-text="nombre+' '+apellidos"/>
                                    </div>
                                    <span v-if="errores.idsocio" class="text-danger">seleccione un número de DNI</span>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <label for="montoinicial" class="font-weight-bold">Monto de Aporte Incial(S/)</label>
                                    <input type="number" step="0.01" :class="['form-control', 'border',errores.monto_inicial ? 'border-danger' : '']" id="montoinicial" placeholder="Monto" v-model="monto">
                                    <span v-if="errores.monto_inicial" class="text-danger">{{ errores.monto_inicial[0] }}</span>
                                </div>
                                <!-- <div class="form-group">
                                    <label for="descripcion" class="font-weight-bold">Descripción</label>
                                    <input type="text" :class="['form-control', 'border',errores.descripcion ? 'border-danger' : '']" id="descripcion" placeholder="Detalle de Aporte" v-model="descripcion">
                                    <span v-if="errores.descripcion" class="text-danger">{{ errores.descripcion[0] }}</span>
                                </div> -->                                
                            
                                <input type="submit" class="btn btn-primary mr-2" value="Crear Cuenta" @click="crearcuentaahorros"></input>
                                <a class="btn btn-light" @click="elegirTipoCuenta">Cancelar</a>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h3 class=" text-dark font-weight-bold">
                                    <i class="mdi mdi-cash-usd mdi-36px"></i>
                                    <span v-if="tipocuenta==1">Datos de la nueva Cuenta de Ahorros</span>
                                    <span v-if="tipocuenta==2">Datos de la nueva Cuenta a Plazo Fijo</span>
                            </h3>
                                    <hr>
                            <p class="card-description text-primary">
                                La cuenta que se creará tendrá la siguiente información
                            </p>
                            <div class="row">
                                <div v-if="tipocuenta==2" class="col-md-12">
                                    <h5 class="font-weight-bold ">Plazo del depósito</h5>
                                    <p v-text="msg_plazo"></p>
                                </div>
                                <div class="col-md-12">
                                    <h5 class="font-weight-bold ">Número de cuenta</h5>
                                    <p v-text="numerocuenta"></p>
                                </div>
                                <div class="col-md-12">
                                    <h5 class="font-weight-bold ">Socio</h5>
                                     <p v-text="nombre+' '+apellidos"></p>
                                </div>
                                <div class="col-md-4">
                                    <h5 class="font-weight-bold ">Saldo efectivo</h5>
                                     <p v-text="'S/.'+monto"></p>
                                </div>
                                <div class="col-md-4">
                                    <h5 class="font-weight-bold ">Tasa Efectiva Anual</h5>
                                     <p v-text="tasa"></p>
                                </div>
                                <div class="col-md-4">
                                    <h5 class="font-weight-bold ">Monto mínimo de apertura</h5>
                                     <p v-text="'S/.'+monto_min"></p>
                                </div>
                                <div class="col-md-12">
                                    <h5 class="font-weight-bold ">Creado por:</h5>
                                     <p v-text="usuario.usuario"></p>
                                </div>
                            </div>                        
                        </div>
                    </div>
                </div>
            </div>
        </template>
        <!-- FIN FORM REGISTRO -->

        <!-- INICIO APORTE REGISTRADO CON ÉXITO -->
        <template v-if="showmsgregistro">
            <div class="row ">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">                            
                            <h4 class=" text-primary text-center"><i class="mdi mdi-checkbox-marked-circle-outline mdi-36px"></i>Cuenta de Ahorros creada exitosamente</h4>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-danger btn-icon-text" @click="descargarDetalleCuenta">
                                        <i class="mdi mdi-upload btn-icon-prepend"></i>   
                                        Descargar Detalle de la Cuenta
                                    </button>
                                </div>
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-success btn-icon-text" @click="mostrarComponente(false, false, true)">
                                        <i class="mdi mdi-upload btn-icon-prepend"></i>
                                        Crear nueva Cuenta
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        <!-- FIN APORTE REGISTRADO CON ÉXITO -->
    </div>
</template>

<script>
    import vSelect from 'vue-select'

    export default {        
        props:['ruta'],
        data: function(){
            return {
                idsocio: '',

                idcuentaahorro: '',
                tipocuenta: '',

                dni: '',
                nombre: '',
                apellidos: '',

                msg_plazo: '',

                numerocuenta: '',

                monto: '',//Al momnto de crear la cuenta, este es el saldo inicial
                // descripcion: '',
                tasa: '',
                monto_min: '',
                tiempo_deposito: 0,

                socioseleccionado: false,
                arraysocios: [],

                numerocuenta: '',
                usuario: {
                    id: '',
                    usuario: ''
                },

                showtiempo: false,

                showtipocuenta: true,
                showformregistro: false,
                showmsgregistro: false,

                errores: []
            }
        },
        components:{
            vSelect
        },
        computed:{
        },
        methods:{
            mostraralerta: function(posicion, tipo, titulo, btnconfirm, tiempo){
                Swal.fire({
                    position: posicion,
                    type: tipo,
                    title: titulo,
                    showConfirmButton: btnconfirm,
                    timer: tiempo
                });
            },
            limpiarformulario(){
                let me = this;
                me.idcuentaahorro = '';
                me.tipocuenta = '';
                me.numerocuenta = '';
                me.monto = '';
                // me.descripcion = '';

                me.msg_plazo = '';

                me.tasa = '';
                me.monto_min = '';
                me.tiempo_deposito = 0;

                me.showtiempo = false;

                me.limpiarselect();
            },
            limpiarselect(){
                let me = this;
                me.$nextTick(() => {
                    me.selected = null;//Limpiar el valor de label de v-select
                });
                me.limpiardatossocio();//Limpiar datos del socio
            },
            limpiardatossocio(){
                let me = this;
                me.idsocio = '';
                me.dni = '';
                me.nombre = '';
                me.apellidos = '';
                me.socioseleccionado = false;
                me.arraysocios = [];

                me.usuario = {
                    id: '',
                    usuario: ''
                };
                me.numerocuenta = '';
            },
            prevenirDefault: function (e) {
                e.preventDefault();//Esto evita que que el formulario recargue la página cunado se envía la info
            },
            crearcuentaahorros(){
                let me = this;

                let cuentaahorros = {
                    'idsocio': me.idsocio,
                    'numerocuenta': me.numerocuenta,
                    'monto_inicial': me.monto,
                    'tipocuenta': me.tipocuenta,
                    // 'descripcion': me.descripcion,
                    'tasa': me.tasa,
                    'monto_min': me.monto_min,
                    'tiempo_fijo' : me.tiempo_deposito
                };

                me.errores = [];

                axios.post(me.ruta + '/cuentaahorros/crear', cuentaahorros)
                .then(res => {
                    me.limpiarformulario();
                    me.mostraralerta('top-end', 'success', '¡¡¡ Cuenta de ahorros creada correctamente !!!', false, 2500);
                    me.idcuentaahorro = res.data.idcuenta;
                    me.mostrarComponente(false, true, false);
                })
                .catch(err => {
                    me.errores = err.response.data.errors;
                    console.log(err);
                });
            },
            selectSocio(search, loading){//CREAR SOLO PARA LOS SOCIOS QUE NO TIENEN CUENTA DE AHORROS
                let me=this;
                 loading(true)
                var url= me.ruta+'/ahorro/selectsocio?filtro='+search;
                axios.get(url).then(function (response) {
                    let respuesta = response.data;
                    q:search;
                    me.socioseleccionado = false;
                    me.arraysocios = respuesta.socios;

                    me.usuario = respuesta.usuario;

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

                    me.generarNumeroCuenta(me.idsocio+'');

                    me.errores.idsocio = null;//Para limpiar el error al seleccionar un socio

                    me.socioseleccionado = true;
                }else{//en el caso de que no exista, se limpia el label de v-select
                    me.limpiarselect();
                }
            },
            generarNumeroCuenta(id){
                let me = this;
                let numcuenta = 'C-';

                for(let i = 0; i < 5 - id.length; i++)
                    numcuenta += '0';

                numcuenta += id;

                me.numerocuenta = numcuenta;
            },
            mostrarComponente(form, msg, tipocuenta){
                let me = this;
                me.showtipocuenta = tipocuenta;
                me.showformregistro = form;
                me.showmsgregistro = msg;
            },
            elegirTipoCuenta(){
                let me = this;

                me.limpiarformulario();
                me.errores = [];
                
                me.showformregistro = false;
                me.showtiempo = false;
                me.showtipocuenta = true;
            },
            descargarDetalleCuenta(){
                let me = this;
                me.mostrarComponente(false, false, true);
                window.open(me.ruta + '/ahorro/cuenta/imprimirdetalle?id=' + me.idcuentaahorro,'_blank');
            },
            cargarTasaCuenta(tipo, tiempo, msg_plazo){
                let me = this;

                let url = me.ruta + '/empresa/tasaCuenta?tipo=' + tipo + '&tiempo=' + tiempo;

                axios.get(url).then(res => {
                    me.limpiarformulario();
                    me.tasa = res.data.tasa;
                    me.monto_min = res.data.monto_min;

                    me.tiempo_deposito = tiempo;
                    me.tipocuenta = tipo;
                    me.msg_plazo = msg_plazo;
                    
                    me.mostrarComponente(true, false, false);
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
        },
        mounted() {
        }
    };
</script>
