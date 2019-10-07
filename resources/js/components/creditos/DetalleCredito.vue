<template>
    <main>
    <!--detalle de CREDITO-->
        <div class="row ">
            <div class="col-lg-12 grid-margin stretch-card ">
                <div class="card ">
                    <div class="card-body ">
                        <div class="row bg bg-dark ">
                            <div class="col-md-12 mt-2 text-white ">
                                <h4>Detalle de Crédtio</h4>

                            </div>
                        </div>
                        <div class="row mt-4 ">
                            <div class="col-lg-12 ">
                                <div class="template-demo ">
                                    <!--INFORMACION DEL SOCIO-->
                                   
                                    <div class="row" v-for="c in arrayCreditos" :key="c.id">
                                        <div class="col-md-9">
                                            <h4 class="text-dark font-weight-bold">
                                                <i class="mdi mdi-package-variant-closed mdi-36px"></i>Informacón del Crédito </h4>
                                            <hr>
                                        </div>
                                        <div class="col-md-3 ">
                                            <button type="button" @click="pdfCronograma()" class="btn btn-danger btn-icon-text">
                                                <i class="mdi mdi-file-pdf btn-icon-prepend"></i>                                                    
                                                Descargar Cronograma
                                            </button>

                                        </div>



                                        <div class="col-md-3">
                                            <h5 class="font-weight-bold ">Codigo de Credito:</h5>
                                            <p v-text="c.numeroprestamo"></p>
                                        </div>
                                        <div class="col-md-3 ">
                                            <h5 class="font-weight-bold ">Monto:</h5>
                                             <p v-text="c.montodesembolsado"></p>
                                        </div>
                                        <div class="col-md-3 ">
                                            <h5 class="font-weight-bold ">Número de Cuotas</h5>
                                             <p v-text="c.numerocuotas"></p>
                                        </div>
                                        <div class="col-md-3 ">
                                            <h5 class="font-weight-bold ">Tasa de Interes:</h5>
                                            <p v-text="c.tasa"></p>
                                        </div>
                                        <div class="col-md-3 ">
                                            <h5 class="font-weight-bold ">Periodo</h5>
                                              <p v-text="c.periodo"></p>
                                        </div>
                                        <div class="col-md-3">
                                            <h5 class="font-weight-bold ">Creado por:</h5>
                                             <p v-text="c.usernombre+' '+c.userapellidos"></p>
                                        </div>

                                        <!--INFORMACIONde credito-->
                                          <div class="col-md-12 ">
                                            <h4 class="text-dark font-weight-bold">
                                                <i class="mdi mdi-account-location mdi-36px"></i>Informacón del Socio </h4>
                                            <hr>
                                        </div>

                                        <div class="col-md-3">
                                            <h5 class="font-weight-bold ">DNI:</h5>
                                            <p v-text="c.sociodni"></p>
                                        </div>
                                        <div class="col-md-3 ">
                                            <h5 class="font-weight-bold ">Nombres y apellidos:</h5>
                                            <p v-text="c.socionombre+' '+c.socioapellidos"></p>
                                        </div>
                                        <div class="col-md-3 ">
                                            <h5 class="font-weight-bold ">Fecha nacimiento:</h5>
                                             <p v-text="c.sociofechanacimiento"></p>
                                        </div>
                                        <div class="col-md-3 ">
                                            <h5 class="font-weight-bold ">Dirección:</h5>
                                              <p v-text="c.sociodireccion"></p>
                                        </div>
                                        <div class="col-md-3 ">
                                            <h5 class="font-weight-bold ">Teléfono:</h5>
                                            <p v-text="c.sociotelefono"></p>
                                        </div>
                                        <div class="col-md-3">
                                            <h5 class="font-weight-bold ">Email:</h5>
                                            <p v-text="c.socioemail"></p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-12 mt-4 ">
                                <h4 class="text-dark font-weight-bold">
                                    <i class="mdi mdi-account-location mdi-36px"></i>Cronograma de Pagos</h4>
                                <hr>
                                <div class="table-responsive">
                                    <table class="table  table-bordered">
                                        <thead>
                                            <tr class="table-info text-white">
                                                <th>Cuota </th>
                                                <th>Boucher </th>
                                                <th>Fecha </th>
                                                <th>Monto de Cuota </th>
                                                <th> Capital </th>
                                                <th> Interés </th>
                                                <th> Saldo </th>
                                                <th> Cajero</th>
                                                <th> Estado </th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="cu in arrayCuotas" :key="cu.id">
                                                <td class="py-1" v-text="cu.numerodecuota"></td>
                                                <td >
                                                    <template v-if="cu.estado==0">
                                                        <button type="button"  class="btn btn-outline-success btn-rounded btn-icon " disabled>
                                                            <i class="mdi mdi-file-import mdi-24px"></i>
                                                        </button>
                                                    </template>
                                                    <template v-if="cu.estado==1">
                                                         <button type="button" @click="bouchercuota(cu.id)" class="btn btn-success btn-rounded btn-icon ">
                                                            <i class="mdi mdi-file-import mdi-24px"></i>
                                                        </button>
                                                    </template>
                                                   
                                                </td>
                                                <template v-if="cu.estado==0">
                                                    <td v-text="cu.fechapago" ></td>
                                                </template>
                                                <template  v-if="cu.estado==1">
                                                     <td >Fecha de Pago :{{cu.fechapago}} <br>
                                                     Fecha de Cancelación :  <label class="badge badge-danger">{{cu.fechacancelo}}</label></td>
                                                </template>
                                                
                                                <td v-text="cu.monto"></td>
                                                <td v-text="cu.monto"></td>
                                                <td v-text="cu.mora"></td>
                                                <td v-text="cu.saldopendiente"></td>

                                                <td v-if="cu.estado==1">{{cu.nombre}} {{cu.apellidos}}</td>
                                                <td v-else> - </td>

                                                <!--estados-->
                                                <template v-if="cu.estado==0">
                                                    <td class="">
                                                        <label class="badge badge-danger">Pendiente</label>
                                                         <label v-if="cu.fechapago<hoy"  class="badge badge-danger">Cuota Atrasada</label>
                                                    </td>
                                                </template>
                                                <template v-else-if="cu.estado==1">
                                                     <td class="">
                                                        <label class="badge badge-success">Pagada</label>
                                                    </td>
                                                 </template>
                                                 <template v-else>
                                                     <td >
                                                        <label class="badge badge-warning">Error-</label>
                                                    </td>
                                                 </template>
                                            

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
    props : ['id'],
    data(){
        return{
            ruta:'http://127.0.0.1:8000',
            arrayCreditos:[],
            arrayCuotas:[],

            hoy:'',
        }
    },
    computed:
    {
    },
    methods:
    {
           detalleCredito()
            {
                let me=this;                
                var url= this.ruta+'/credito/detallecredito?id='+this.id;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayCreditos = respuesta.detallecredito;
                    me.arrayCuotas = respuesta.cuotas;
                   
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            pdfCronograma(idcredito){
                 window.open(this.ruta + '/credito/pdfDetallecredito/'+this.id,'_blank');
            },
           
            fechaactual() 
            {
                let date = new Date()
                let day = date.getDate(); let month = date.getMonth() + 1;let year = date.getFullYear();
                if (month < 10)this.hoy = year + '-0' + month + '-' + day
                else this.hoy = year + '-' + month + '-' + day
            },


    },
     mounted() {
            this.detalleCredito();
            this.fechaactual();
          
    }
}
</script>