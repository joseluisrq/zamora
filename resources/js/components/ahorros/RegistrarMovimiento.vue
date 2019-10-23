<template>
    <div class="content-wrapper">

        <template v-if="showfromregistro">
            <div class="row ">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-dark"><i class="mdi mdi-cash-multiple mdi-36px"></i> Registrar Movimiento</h4>
                            <hr>
                            <p class="card-description text-primary">
                                Verifique la Información antes de hacer el registro
                            </p>
                            <form id="formRegistro" @submit="enviarForm" class="forms-sample">
                                <div class="form-group">
                                    <label for="numcuenta" class="font-weight-bold">Ingrese DNI del socio</label>
                                    <v-select
                                        id="numcuenta"
                                        :class="['border',errores.cuenta ? 'border-danger' : '']"
                                        :on-search="selectCuenta"
                                        label="identificador"
                                        :options="arraycuentas"
                                        placeholder="Ingrese un número de cuenta"
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
                                <input type="submit" class="btn btn-primary mr-2" value="Registrar Operación" @click="registrarMovimiento"/>
                                <a class="btn btn-light" @click="limpiarformulario">Cancelar</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </template>

        <!-- INICIO MOVIMIENTO REGISTRADO CON ÉXITO -->
        <template v-if="showmsgregistro">
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
                                    <button type="button" class="btn btn-success btn-icon-text" @click="mostrarComponente(true, false)">
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

                cuentaseleccionada: false,

                arraycuentas: [], 

                showfromregistro: true,
                showmsgregistro: false,

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
            enviarForm(e){
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

                me.cuentaseleccionada = false;

                me.arraycuentas = [];

                me.idmovimiento = 0;

                me.limpiarselect();
            },
            limpiarselect(){
                let me = this;
                me.$nextTick(() => {
                    me.selected = null;//Limpiar el valor de label de v-select
                })
            },
            registrarMovimiento(){
                let me = this;

                let movimiento = {
                    'cuenta': me.idcuenta,
                    'monto': me.monto,
                    'descripcion': me.descripcion,
                    'tipo': me.tipo
                };

                me.errores = [];

                axios.post(me.ruta + '/movimiento/registrar', movimiento)
                .then(res => {
                    if(res.data.excep){
                        me.errores = {
                            monto: ['Usted sólo dispone de S/.' + res.data.monto + " para retirar"]
                        }
                    }
                    else{
                        me.limpiarformulario();
                        me.idmovimiento = res.data.id;
                        me.mostrarComponente(false, true);
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
                var url= this.ruta+'/movimiento/selectCuenta?filtro='+search;
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

                    me.errores.cuenta = null;//Para limpiar el error después de selecciona una cuenta

                    me.cuentaseleccionada = true;
                }else{//en el caso de que no exista, se limpia el label de v-select
                    me.limpiarselect();
                }
            },
            mostrarComponente(showform, showmessage){
                let me = this;
                me.showfromregistro = showform;
                me.showmsgregistro = showmessage;
                console.log('Cambiado' + me.showfromregistro + ', ' + me.showmsgregistro)
            },
            descargarBoucherMovimiento(){
                let me = this;
                me.mostrarComponente(true, false);
                window.open(me.ruta + '/ahorro/movimiento/imprimirboucher?id=' + me.idmovimiento,'_blank');
            }
        },
        mounted() {
        }
    };
</script>
