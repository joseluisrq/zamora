<template>
    <div class="content-wrapper">
        <div class="row ">
            <div class="col-md-6 grid-margin stretch-card">
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
                                    class="col-md-12"
                                >
                                </v-select>
                                <div v-if="idsocio!=0">
                                    <label class="badge badge-dark" v-text="nombre+' '+apellidos"/>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="montoinicial" class="font-weight-bold">Monto de Aporte Incial(S/)</label>
                                <input type="number" class="form-control" id="montoinicial" placeholder="Monto" v-model="monto" oninvalid="this.setCustomValidity('ingrese el aporte inicial')" oninput="this.setCustomValidity('')" required>
                            </div>
                            <div class="form-group">
                                <label for="descripcion" class="font-weight-bold">Descripción</label>
                                <input type="text" class="form-control" id="descripcion" placeholder="Detalle de Aporte" v-model="descripcion" required>
                            </div>
                            
                        
                            <input type="submit" class="btn btn-primary mr-2" value="Crear Cuenta" @click="crearcuentaahorros"></input>
                            <a class="btn btn-light" @click="limpiarformulario">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h3 class=" text-dark font-weight-bold">
                                <i class="mdi mdi-cash-usd mdi-36px"></i>
                                Datos de la nueva Cuenta de Ahorros
                        </h3>
                                <hr>
                        <p class="card-description text-primary">
                            La cuenta que se creará tendrá la siguiente información
                        </p>
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="font-weight-bold ">Número de cuenta</h5>
                                <p v-text="numerocuenta"></p>
                            </div>
                            <div class="col-md-12">
                                <h5 class="font-weight-bold ">Socio</h5>
                                 <p v-text="nombre+' '+apellidos"></p>
                            </div>
                            <div class="col-md-9">
                                <h5 class="font-weight-bold ">Saldo efectivo</h5>
                                 <p v-text="'S/.'+monto"></p>
                            </div>
                            <div class="col-md-3">
                                <h5 class="font-weight-bold ">Tasa de Rendimiento Efectivo Anual(%)</h5>
                                 <p v-text="tasa"></p>
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

                monto: '',//Al momnto de crear la cuenta, este es el saldo inicial
                descripcion: '',
                tasa: '',

                socioseleccionado: false,
                arraysocios: [],

                numerocuenta: '',
                usuario: {
                    id: '',
                    usuario: ''
                }
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

                me.tasa = '';
                me.usuario = {
                    id: '',
                    usuario: ''
                };
                me.numerocuenta = '';
            },
            limpiarselect(){
                let me = this;
                me.$nextTick(() => {
                    me.selected = null;//Limpiar el valor de label de v-select
                });
                me.limpiardatossocio();//Limpiar datos del socio
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
                        'idusuario': me.usuario.id,
                        'numerocuenta': me.numerocuenta,
                        'monto_inicial': me.monto,
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
                var url= me.ruta+'/ahorro/selectsocio?filtro='+search;
                axios.get(url).then(function (response) {
                    let respuesta = response.data;
                    q:search;
                    me.socioseleccionado = false;
                    me.arraysocios = respuesta.socios;

                    me.tasa = respuesta.tasa;
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
            }
        },
        mounted() {
        }
    };
</script>
