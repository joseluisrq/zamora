<template>
    <div class="content-wrapper">
        <div class="row ">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h3 class=" text-dark font-weight-bold">
                                <i class="mdi mdi-cash-usd mdi-36px"></i>
                                Crear cuenta de Ahorros
                        </h3>
                                <hr>
                        <p class="card-description text-primary">
                            Verifique la Información antes de crear una cuenta de ahorros
                        </p>
                        <form id="formRegistro" submit="this.preventDefault()" class="forms-sample">
                            <div class="form-group">
                                <label for="dnisocio " class="font-weight-bold">Socio (Ingrese N° de DNI )</label>
                                <v-select
                                    id="dnisocio"
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
                            </div>
                            <div class="form-group">
                                    <label for="numcuentasocio " class="font-weight-bold">Número de Cuenta</label>
                                    <input type="text" class="form-control" id="numcuentasocio" placeholder="Número de cuenta de ahorros" v-model="numerocuenta" oninvalid="this.setCustomValidity('ingrese un número de cuenta')" oninput="this.setCustomValidity('')" required>
                            </div>
                            <div class="form-group">
                                    <label for="tasainteres" class="font-weight-bold">Tasa de Interés</label>
                                    <input type="number" class="form-control" id="tasainteres" placeholder="Tasa de interes por aporte" v-model="tasa" min="1" max="99" oninvalid="this.setCustomValidity('ingrese la tasa de interés')" oninput="this.setCustomValidity('')" required>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="montoinicial" class="font-weight-bold">Monto de Aporte Incial(S/)</label>
                                <input type="number" class="form-control" id="montoinicial" placeholder="Monto" v-model="monto" oninvalid="this.setCustomValidity('ingrese el aporte inicial')" oninput="this.setCustomValidity('')" required>
                            </div>
                            <div class="form-group">
                                <label for="descripcion" class="font-weight-bold">Descripción</label>
                                <input type="text" class="form-control" id="descripcion" placeholder="Detalle de Aporte" v-model="descripcion">
                            </div>
                            
                        
                            <input type="submit" class="btn btn-primary mr-2" value="Crear Cuenta" @click="crearcuentaahorros"></input>
                            <a class="btn btn-light" @click="limpiarformulario">Cancelar</a>
                        </form>
                    </div>
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
                idsocio: 0,

                dni: '',
                nombre: '',
                apellidos: '',

                numerocuenta: '',

                monto: '',
                descripcion: '',
                tasa: '',

                socioseleccionado: false,
                arraysocios: []
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
                me.numerocuenta = '';
                me.monto = '';
                me.descripcion = '';
                me.tasa = '';

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
            crearcuentaahorros(){
                let me = this;

                if(!me.socioseleccionado){
                    me.mostraralerta('top-end', 'error', '¡¡¡ Por favor seleccione un socio para crear la cuenta de ahorros !!!', false, 2500);
                    return;
                }

                let form = document.getElementById("formRegistro");
                form.classList.add('was-validated');

                if(form.checkValidity()){
                    let cuentaahorros = {
                        'idsocio': me.idsocio,
                        'numerocuenta': me.numerocuenta,
                        'dni': me.dni,
                        'monto': me.monto,
                        'descripcion': me.descripcion,
                        'tasa': me.tasa
                    };

                    axios.post(me.ruta + '/cuentaahorros/crear', cuentaahorros)
                    .then(res => {
                        form.classList.remove('was-validated');
                        me.limpiarformulario();
                        me.mostraralerta('top-end', 'success', '¡¡¡ Cuenta de ahorros creada correctamente !!!', false, 2500);
                    })
                    .catch(err => {
                        me.mostraralerta('top-end', 'error', '¡¡¡ Error, el registro no se completó correctamente !!!', false, 2500);
                        console.log(err);
                    });
                }
            },
            selectSocio(search, loading){//CREAR SOLO PARA LOS SOCIOS QUE NO TIENEN CUENTA DE AHORROS
                let me=this;
                 loading(true)
                var url= this.ruta+'/aporte/selectsocio?filtro='+search;
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
            }
        },
        mounted() {
        }
    };
</script>
