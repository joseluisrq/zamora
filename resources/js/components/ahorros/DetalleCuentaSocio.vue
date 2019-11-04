<template>
    <main>
    <!--detalle de CREDITO-->
        <div class="row ">
            <div class="col-lg-12 grid-margin stretch-card ">
                <div class="card ">
                    <div class="card-body ">
                        <div class="row bg bg-dark ">
                            <div class="col-md-12 mt-2 text-white ">
                                <h4 v-if="infocuenta.tipocuenta==1">Detalle de Cuenta de Ahorros</h4>
                                <h4 v-if="infocuenta.tipocuenta==2">Detalle de Cuenta a Plazo Fijo</h4>
                            </div>
                        </div>
                        <div class="row mt-4 ">
                            <div class="col-lg-12 ">
                                <div class="template-demo ">
                                    <!--INFORMACION DE LA CUENTA-->
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h4 class="text-dark font-weight-bold">
                                                <i class="mdi mdi-package-variant-closed mdi-36px"></i>
                                                <span v-if="infocuenta.tipocuenta==1">Información de la Cuenta de Ahorros</span>
                                                <span v-if="infocuenta.tipocuenta==2">Información de la Cuenta a Plazo Fijo</span>
                                            </h4>
                                            <hr>
                                        </div>
                                         <div class="col-md-4 mt-2 text-white ">
                                            <button type="button" @click="descargarDetalleCuenta()" class="btn btn-primary btn-icon-text">
                                                <i class="mdi mdi-file-pdf btn-icon-prepend"></i>Descargar Contrato
                                            </button>
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
                                        <div class="col-md-12 ">
                                            <h5 class="font-weight-bold ">Interés disponible</h5>
                                            <p v-text="'S/ '+infocuenta.interes_ganado"></p>
                                        </div>
                                        <div class="col-md-3">
                                            <h5 class="font-weight-bold ">Creado por:</h5>
                                             <p v-text="infocuenta.usuario"></p>
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
                                                <th>Cajero</th>
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
                                                <td v-if="movimiento.tipomovimiento==0">
                                                    <label class="badge badge-warning">Retiro</label>
                                                </td>
                                                <td v-else>
                                                    <label class="badge badge-success">Aporte</label>
                                                </td>
                                                <td v-text="movimiento.usuario"></td>
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
        },
        descargarDetalleCuenta(){
            let me = this;
            window.open(me.ruta + '/ahorro/cuenta/imprimirdetalle?id=' + me.id,'_blank');
        },        
    },
     mounted() {
        this.detalleCuentaAhorro();
    }
};
</script>