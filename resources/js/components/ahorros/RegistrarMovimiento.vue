<template>
    <div class="content-wrapper">

        <template v-if="showFormRegistroAhorros || showFormRegistroPlazoFijo">
            <button type="button" class="btn btn-warning" @click="limpiarformulario();mostrarComponente(true, false, false, false)">
               <i class="mdi mdi-arrow-left-bold"></i> Elegir Tipo de cuenta
            </button>
         </template>

        <!-- INICIO ESCOGER TIPO CUENTA -->
        <template v-if="showElegirTipoCuenta">
            <div class="row ">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">                            
                            <h4 class=" text-primary text-center"><i class="mdi mdi-checkbox-marked-circle-outline mdi-36px"></i>REGISTRAR MOVIMIENTO</h4>
                            <hr>
                            <h6 class=" text-primary text-center">ELIJA UN TIPO DE CUENTA</h6>
                            <div class="row">
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-success btn-icon-text" @click="tipocuenta=1;mostrarComponente(false, true, false, false)">
                                        <i class="mdi mdi-square-inc-cash btn-icon-prepend"></i>   
                                        Cuenta Ahorros
                                    </button>
                                </div>
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-warning btn-icon-text" @click="tipocuenta=2;mostrarComponente(false, false, true, false)">
                                        <i class="mdi mdi-square-inc-cash btn-icon-prepend"></i>
                                        Cuenta Plazo Fijo
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        <!-- FIN ESCOGER TIPO CUENTA -->

        <!-- INICIO MOVIMIENTO AHORROS -->
        <template v-if="showFormRegistroAhorros">
            <div class="row ">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-dark"><i class="mdi mdi-cash-multiple mdi-36px"></i> Registrar Movimiento</h4>
                            <hr>
                            <p class="card-description text-primary">
                                Verifique la Información antes de hacer el registro
                            </p>
                            <div align="center"><h3>CUENTA DE AHORROS</h3></div>
                            <form id="formRegistro" @submit="prevenirDefault" class="forms-sample">
                                <div class="form-group">
                                    <label for="numcuenta" class="font-weight-bold">Ingrese DNI del socio</label>
                                    <v-select
                                        id="numcuenta"
                                        :class="['border',errores.cuenta ? 'border-danger' : '']"
                                        :on-search="selectCuenta"
                                        label="identificador"
                                        :options="arraycuentas"
                                        placeholder="Ingrese un DNI del socio"
                                        :onChange="getDatosCuenta"
                                        clearable
                                        class="col-md-12"
                                    >
                                    </v-select>
                                    <div v-if="idcuenta!=''">
                                        <label class="badge badge-dark" v-text="nombre+' '+apellidos"/>
                                    </div>
                                    <span v-if="errores.cuenta" class="text-danger">seleccione un número de cuenta</span>
                                </div>
                                <div class="form-group">
                                    <label for="montoaporte" class="font-weight-bold">Monto de Operación(S/)</label>
                                    <input id="montoaporte" type="number" step="0.01" v-model="monto" :class="['form-control', 'border',errores.monto ? 'border-danger' : '']" placeholder="Ingrese el monto">
                                    <span v-if="errores.monto" class="text-danger">{{ errores.monto[0] }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="descripcionaporte" class="font-weight-bold">Descripción</label>
                                    <input id="descripcionaporte" type="text" v-model="descripcion" :class="['form-control', 'border',errores.descripcion ? 'border-danger' : '']" placeholder="Detalle de operación">
                                    <span v-if="errores.descripcion" class="text-danger">{{ errores.descripcion[0] }}</span>
                                </div>
                                <div class="form-group">
                                    <label for="descripcionaporte" class="font-weight-bold">Tipo de operación</label>
                                    <br>
                                    <span>Aporte</span>
                                    <input id="aporte" type="radio" value="1" v-model="tipo" name="tipooper" :class="['border',errores.tipo ? 'border-danger' : '']">
                                    <span>Retiro</span>
                                    <input id="retiro" type="radio" value="0" v-model="tipo" name="tipooper" :class="['border',errores.tipo ? 'border-danger' : '']">
                                    <span v-if="errores.tipo" class="text-danger">{{ errores.tipo[0] }}</span>
                                </div>
                                <input type="submit" class="btn btn-primary mr-2" value="Registrar Operación" @click="registrarMovimientoAhorros"/>
                                <a class="btn btn-light" @click="limpiarformulario();mostrarComponente(true, false, false, false)">Cancelar</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        <!-- FIN MOVIMINETO AHORROS -->

        <!-- INICIO MOVIMINETO PLAZO FIJO -->
        <template v-if="showFormRegistroPlazoFijo">
            <div class="row ">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-dark"><i class="mdi mdi-cash-multiple mdi-36px"></i> Registrar Movimiento</h4>
                            <hr>
                            <p class="card-description text-primary">
                                Verifique la Información antes de hacer el registro
                            </p>
                            <div align="center"><h3>CUENTA A PLAZO FIJO</h3></div>
                            <form id="formRegistroFijo" @submit="prevenirDefault" class="forms-sample">
                                <div class="form-group">
                                    <label for="numcuentafijo" class="font-weight-bold">Ingrese DNI del socio</label>
                                    <v-select
                                        id="numcuentafijo"
                                        :class="['border',errores.cuenta ? 'border-danger' : '']"
                                        :on-search="selectCuenta"
                                        label="identificador"
                                        :options="arraycuentas"
                                        placeholder="Ingrese un DNI del socio"
                                        :onChange="getDatosCuenta"
                                        clearable
                                        class="col-md-12"
                                    >
                                    </v-select>
                                    <div v-if="idcuenta!=''">
                                        <label class="badge badge-dark" v-text="nombre+' '+apellidos"/>
                                    </div>
                                    <span v-if="errores.cuenta" class="text-danger">seleccione un número de cuenta</span>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Monto de Depósito(S/)</label><br>
                                    <label v-text="monto_fijo"></label>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Tasa Efectiva Anual</label><br>
                                    <label v-text="tasa_fijo"></label>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Fecha Inicio Plazo</label><br>
                                    <label v-text="fecha_inicio"></label>
                                </div>
                                <div class="form-group">
                                    <label class="font-weight-bold">Fecha Límite Plazo</label><br>
                                    <label v-text="fecha_fin"></label>
                                </div>
                                <a class="btn btn-warning mr-2 text-dark" @click="registrarMovimientoFijo(false)">Cobrar y Cancelar cuenta</a>
                                <a class="btn btn-primary text-dark" @click="registrarMovimientoFijo(true)">Cobrar y Renovar cuenta</a>
                                <a class="btn btn-light" @click="limpiarformulario();mostrarComponente(true, false, false, false)">Cancelar</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        <!-- FIN MOVIMINEOT PLAZO FIJO -->

        <!-- INICIO MOVIMIENTO REGISTRADO CON ÉXITO -->
        <template v-if="showMsgRegistro">
            <div class="row ">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">                            
                            <h4 class=" text-primary text-center"><i class="mdi mdi-checkbox-marked-circle-outline mdi-36px"></i>Operación registrada exitosamente</h4>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-danger btn-icon-text" @click="descargarBoucherMovimiento">
                                        <i class="mdi mdi-upload btn-icon-prepend"></i>   
                                        Descargar Boucher
                                    </button>
                                </div>
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-success btn-icon-text" @click="mostrarComponente(true, false, false, false)">
                                        <i class="mdi mdi-upload btn-icon-prepend"></i>
                                        Nuevo Movimieto
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        <!-- FIN MOVIMIENTO REGISTRADO CON ÉXITO -->
        
    </div>
</template>
<script>
    import vSelect from 'vue-select'

    export default {
        props:['ruta'],
        data: function(){
            return {
                idcuenta: '',
                dni: '',
                numerocuenta: '',

                nombre: '',
                apellidos: '',
                
                monto: '',
                descripcion: '',
                tipo: '',

                tipocuenta: '',
                tasa_fijo: '',
                monto_fijo: '',
                fecha_inicio: '',
                fecha_fin: '',

                cuentaseleccionada: false,

                arraycuentas: [], 

                showElegirTipoCuenta: true,
                showFormRegistroAhorros: false,
                showFormRegistroPlazoFijo: false,
                showMsgRegistro: false,

                idmovimiento: 0,

                errores: []
            }
        },
        components:{
            vSelect
        },
        computed:{
        },
        methods: {
            prevenirDefault(e){
                e.preventDefault();
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
            limpiarformulario(){
                let me = this;

                me.idcuenta = '';
                me.dni = '';
                me.numerocuenta = '';
                
                me.nombre = '';
                me.apellidos = '';

                me.monto = '';
                me.descripcion = '';
                me.tipo = '';

                me.tasa_fijo = '';
                me.monto_fijo = '';
                me.fecha_inicio = '';
                me.fecha_fin = '';

                me.cuentaseleccionada = false;

                me.arraycuentas = [];

                me.idmovimiento = 0;

                me.limpiarselect();
            },
            limpiarselect(){
                let me = this;

                me.$nextTick(() => {
                    me.selected = null;//Limpiar el valor de label de v-select
                });
            },
            registrarMovimientoAhorros(){
                let me = this;

                let movimiento = {
                    'cuenta': me.idcuenta,
                    'monto': me.monto,
                    'descripcion': me.descripcion,
                    'tipo': me.tipo
                };

                me.errores = [];

                axios.post(me.ruta + '/movimiento/registrarAhorros', movimiento)
                .then(res => {

                    if(res.data.excep){
                        me.errores = {
                            monto: ['Usted sólo dispone de S/.' + res.data.monto + " para retirar"]
                        }
                    }
                    else{
                        me.limpiarformulario();
                        me.idmovimiento = res.data.id;
                        me.mostrarComponente(false, false, false, true);
                    }
                })
                .catch(err => {
                    me.errores = err.response.data.errors;
                    console.log(err);
                });
            },
            registrarMovimientoFijo(renovar){
                let me = this;

                let movimiento = {
                    'cuenta': me.idcuenta,
                    'renovar': renovar
                };

                me.errores = [];

                axios.post(me.ruta + '/movimiento/registrarFijos', movimiento)
                .then(res => {

                    if(!res.data.plazocumplido){
                        let min_dias = res.data.minimo_dias;
                        let msg = 'No puede registrar movimientos en esta cuenta debido que aún no vence el plazo desde ' + min_dias;

                        if(min_dias == 361)
                            msg += 'días a más de un año';
                        else
                            msg += ' hasta ' + res.data.plazo_establecido + ' días';

                        msg += ', establecido desde la fecha ' + res.data.fecha_inicio + '.\n\n Podrá retirar su dinero e intereses a partir de la fecha ' + res.data.fecha_fin;

                        me.mostraralerta('center', 'error', msg);
                    } else {
                        me.limpiarformulario();
                        me.idmovimiento = res.data.id;
                        me.mostrarComponente(false, false, false, true);
                    }
                })
                .catch(err => {
                    me.errores = err.response.data.errors;
                    console.log(err);
                });
            },
            selectCuenta(search, loading){
                let me=this;
                 loading(true)
                var url= this.ruta+'/movimiento/selectCuenta?filtro='+search+'&tipocuenta='+me.tipocuenta;
                axios.get(url).then(function (response) {
                    let respuesta = response.data;
                    q:search;
                    me.cuentaseleccionada = false;
                    me.arraycuentas = respuesta.cuentas;
                    loading(false)
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            getDatosCuenta(value){//Capturar el valor seleccionado de la lista
                let me = this;
                if(value){//si existe un valor para socio
                    me.loading = true;
                    me.idcuenta = value.id;
                    me.numerocuenta = value.numerocuenta;
                    me.nombre = value.nombre;
                    me.apellidos = value.apellidos;

                    me.tipocuenta = value.tipocuenta;// 1:AHORROS, 2:PLAZO FIJO

                    if(me.tipocuenta == 2){
                        me.tasa_fijo = value.tasa;
                        me.monto_fijo = value.monto;
                        me.fecha_inicio = value.fecha_inicio;
                        me.fecha_fin = value.fecha_fin;
                    }

                    me.errores.cuenta = null;//Para limpiar el error después de selecciona una cuenta

                    me.cuentaseleccionada = true;
                }else{//en el caso de que no exista, se limpia el label de v-select
                    me.limpiarselect();
                }
            },
            mostrarComponente(elegirTipo, showAhorros, showFijo, showMessage){
                let me = this;

                me.showElegirTipoCuenta = elegirTipo;
                me.showFormRegistroAhorros = showAhorros;
                me.showFormRegistroPlazoFijo = showFijo;
                me.showMsgRegistro = showMessage;
            },
            descargarBoucherMovimiento(){
                let me = this;
                me.mostrarComponente(true, false, false, false);
                window.open(me.ruta + '/ahorro/movimiento/imprimirboucher?id=' + me.idmovimiento,'_blank');
            }
        },
        mounted() {
        }
    };
</script>
