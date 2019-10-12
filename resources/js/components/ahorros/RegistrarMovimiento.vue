<template>
    <div class="row ">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-dark"><i class="mdi mdi-cash-multiple mdi-36px"></i>Registrar Movimiento</h4>
                    <hr>
                    <p class="card-description text-primary">
                        Verifique la Información antes de hacer el registro
                    </p>
                    <form id="formRegistro" @submit="enviarForm" class="forms-sample">
                        <div class="form-group">
                            <label for="numcuenta" class="font-weight-bold">Ingrese N° de cuenta</label>
                            <v-select
                                id="numcuenta"
                                :on-search="selectCuenta"
                                label="numerocuenta"
                                :options="arraycuentas"
                                placeholder="Ingrese un número de cuenta"
                                :onChange="getDatosCuenta"
                            >
                            </v-select>
                            <div v-if="idcuenta!=0">
                                <label class="badge badge-dark" v-text="nombre+' '+apellidos"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="montoaporte" class="font-weight-bold">Monto de Operación(S/)</label>
                            <input id="montoaporte" type="number" v-model="monto" class="form-control" placeholder="Ingrese el monto" required>
                        </div>
                        <div class="form-group">
                            <label for="descripcionaporte" class="font-weight-bold">Descripción</label>
                            <input id="descripcionaporte" type="text" v-model="descripcion" class="form-control" placeholder="Detalle de operación">
                        </div>
                        <div class="form-group">
                            <label for="descripcionaporte" class="font-weight-bold">Tipo de operación</label>
                            <br>
                            <span>Aporte</span>
                            <input id="aporte" type="radio" value="1" v-model="tipo" name="tipooper" required>
                            <span>Retiro</span>
                            <input id="retiro" type="radio" value="0" v-model="tipo" name="tipooper" required>
                        </div>
                        <input type="submit" class="btn btn-primary mr-2" value="Registrar Operación" @click="registrarMovimiento"/>
                        <a class="btn btn-light" @click="limpiarformulario">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>    
</template>
<script>
    import vSelect from 'vue-select'

    export default {
        props:['ruta'],
        data: function(){
            return {
                idcuenta: 0,
                numerocuenta: '',

                nombre: '',
                apellidos: '',
                
                monto: '',
                descripcion: '',
                tipo: '',

                cuentaseleccionada: false,

                arraycuentas: []
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

                me.idcuenta = 0;
                me.numerocuenta = '';
                
                me.nombre = '';
                me.apellidos = '';

                me.monto = '';
                me.descripcion = '';
                me.tipo = '';

                me.cuentaseleccionada = false;

                me.arraycuentas = [];

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

                if(!me.cuentaseleccionada){
                    me.mostraralerta('top-end', 'error', '¡¡¡ Por favor seleccione un número de cuenta !!!', false, 2500);
                    return;
                }

                let form = document.getElementById("formRegistro");
                form.classList.add('was-validated');

                if(form.checkValidity()){
                    let movimiento = {
                        'idahorro': me.idcuenta,
                        'monto': me.monto,
                        'descripcion': me.descripcion,
                        'tipo': me.tipo
                    };

                    axios.post(me.ruta + '/movimiento/registrar', movimiento)
                    .then(res => {
                        form.classList.remove('was-validated');
                        if(res.data.excep)
                            me.mostraralerta('top-end', 'error', '¡¡¡ El retiro no se puede realizar debido a que no tiene los fondos suficientes !!!', false, 2000);
                        else{
                            me.limpiarformulario();
                            me.mostraralerta('top-end', 'success', '¡¡¡ La operación fue registrada exitosamente !!!', false, 2000);
                        }
                    })
                    .catch(err => {
                        me.mostraralerta('top-end', 'error', '¡¡¡ Error, el registro no se completó correctamente !!!', false, 2500);
                        console.log(err);
                    });
                }
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
                    me.cuentaseleccionada = true;
                }else{//en el caso de que no exista, se limpia el label de v-select
                    me.limpiarselect();
                }
            }
        },
        mounted() {
        }
    };
</script>
