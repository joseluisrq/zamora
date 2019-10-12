<template>
    <main>
    <!--detalle de CREDITO-->
        <div class="row ">
            <div class="col-lg-12 grid-margin stretch-card ">
                <div class="card ">
                    <div class="card-body ">
                        <div class="row bg bg-dark ">
                            <div class="col-md-12 mt-2 text-white ">
                                <h4>Detalle de Cuenta de Ahorros</h4>
                            </div>
                        </div>
                        <div class="row mt-4 ">
                            <div class="col-lg-12 ">
                                <div class="template-demo ">
                                    <!--INFORMACION DE LA CUENTA-->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h4 class="text-dark font-weight-bold">
                                                <i class="mdi mdi-package-variant-closed mdi-36px"></i>Informacón de la Cueta de Ahorros </h4>
                                            <hr>
                                        </div>
                                        <div class="col-md-3">
                                            <h5 class="font-weight-bold ">Número de Cuenta:</h5>
                                            <p v-text="infocuenta.numerocuenta"></p>
                                        </div>
                                        <div class="col-md-3 ">
                                            <h5 class="font-weight-bold ">Saldo efectivo:</h5>
                                             <p v-text="'S/.'+infocuenta.saldoefectivo"></p>
                                        </div>
                                        <div class="col-md-3 ">
                                            <h5 class="font-weight-bold ">Tasa de Interes:</h5>
                                            <p v-text="infocuenta.tasa"></p>
                                        </div>
                                        <div class="col-md-3 ">
                                            <h5 class="font-weight-bold ">Fecha Apertura:</h5>
                                            <p v-text="infocuenta.fechaapertura"></p>
                                        </div>
                                        <div class="col-md-3">
                                            <h5 class="font-weight-bold ">Creado por:</h5>
                                             <p v-text="infocuenta.usuario"></p>
                                        </div>

                                        <!--INFORMACIÓN DEL SOCIO-->
                                          <div class="col-md-12 ">
                                            <h4 class="text-dark font-weight-bold">
                                                <i class="mdi mdi-account-location mdi-36px"></i>Informacón del Socio </h4>
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

                                </div>
                            </div>
                            <div class="col-lg-12 mt-4 ">
                                <h4 class="text-dark font-weight-bold">
                                    <i class="mdi mdi-account-location mdi-36px"></i>Historial de movimientos</h4>
                                <hr>
                                <div class="table-responsive">
                                    <table class="table  table-bordered">
                                        <thead>
                                            <tr class="table-info text-white">
                                                <th>#</th>
                                                <th>Boucher</th>
                                                <th>Fecha Registro</th>
                                                <th>Monto</th>
                                                <th>Tipo</th>
                                                <th>Cajaro</th>
                                                <th>Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(movimiento, index) in arraymovimientos" :key="movimiento.id">
                                                <td class="py-1">{{ index + 1 }}</td>
                                                <td >
                                                    <button type="button" @click="boucherMovimiento(movimiento.id)" class="btn btn-success btn-rounded btn-icon ">
                                                        <i class="mdi mdi-file-import mdi-24px"></i>
                                                    </button>
                                                </td>
                                                <td v-text="movimiento.fecharegistro" ></td>   
                                                <td v-text="movimiento.monto"></td>
                                                <td v-if="movimiento.tipo==0">
                                                    <label class="badge badge-info">Retiro</label>
                                                </td>
                                                <td v-else>
                                                    <label class="badge badge-success">Aporte</label>
                                                </td>
                                                <td v-text="movimiento.usuario"></td>
                                                <td v-text="movimiento.estado"></td>     
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--detalle de CREDITO-->
    </main>
</template>

<script>
export default {
    props : ['ruta', 'id'],
    data(){
        return{
            infocuenta: {
                numerocuenta: '',
                saldoefectivo: '',
                fechaapertura: '',
                tasa: '',
                usuario: ''
            },
            infosocio: {
                dni: '',
                nombre: '',
                apellidos: '',
                fechanacimiento: '',
                direccion: '',
                telefono: '',
                email: ''
            },
            arraymovimientos: []
        }
    },
    computed:
    {
    },
    methods:
    {
       detalleCuentaAhorro()
        {
            let me=this;                
            var url= me.ruta+'/ahorro/detalle/?id='+me.id;
            axios.get(url).then(res => {
                me.infocuenta = res.data.infocuenta;
                me.infosocio = res.data.infosocio;
                me.arraymovimientos = res.data.movimientos;
            })
            .catch(err => {
                console.log(error);
            });
        },
        boucherMovimiento(idmovimiento){
            let me = this;
            window.open(me.ruta + '/ahorro/movimiento/imprimirboucher?id=' + idmovimiento,'_blank');
        }
    },
     mounted() {
        this.detalleCuentaAhorro();
    }
};
</script>