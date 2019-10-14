<template>
    <main>
    <!--detalle de CREDITO-->
        <div class="row ">
            <div class="col-lg-12 grid-margin stretch-card ">
                <div class="card ">
                    <div class="card-body ">
                        <div class="row bg bg-dark ">
                            <div class="col-md-12 mt-2 text-white ">
                                <h4>Detalle de Crédtio

                                    </h4>

                            </div>
                        </div>
                        <div class="row mt-4 ">
                            <div class="col-lg-12 ">
                                <div class="template-demo ">
                                    <!--INFORMACION DEL SOCIO-->
                                   
                                    <div class="row" v-for="c in arrayCreditos" :key="c.id">
                                        <div class="col-md-7">
                                            <h4 class="text-dark font-weight-bold">
                                                <i class="mdi mdi-package-variant-closed mdi-36px"></i>Información del Crédito </h4>
                                            <hr>
                                        </div>
                                        <div class="col-md-5 ">
                                            <button type="button" @click="pdfCronograma()" class="btn btn-danger btn-icon-text">
                                                <i class="mdi mdi-file-pdf btn-icon-prepend"></i>                                                    
                                                Descargar Cronograma
                                            </button>
                                             <button v-if="arrayCreditos[0].estadodesembolso==0" class="btn btn-success" @click="desembolsar(c.id)"> Desembolsar</button>
                                

                                        </div>



                                        <div class="col-md-3">
                                            <h5 class="font-weight-bold ">Codigo de Credito:</h5>
                                            <p v-text="c.numeroprestamo"></p>
                                        </div>
                                        <div class="col-md-3 ">
                                            <h5 class="font-weight-bold ">Monto Financiado:</h5>
                                             <p v-text="'S/ '+c.montodesembolsado"></p>
                                        </div>
                                        <div class="col-md-3 ">
                                            <h5 class="font-weight-bold ">Número de Cuotas</h5>
                                             <p v-text="c.numerocuotas+'Cuotas'"></p>
                                        </div>
                                        <div class="col-md-3 ">
                                            <h5 class="font-weight-bold ">TEA(Tasa de interes anual)</h5>
                                            <p >{{c.tasa}} % </p>
                                        </div>
                                        
                                        <div class="col-md-3 ">
                                            <h5 class="font-weight-bold ">Interes Total</h5>
                                            <p > S/ {{c.interes}}</p>
                                        </div>
                                        <div class="col-md-3 ">
                                            <h5 class="font-weight-bold ">Monto total a Pagar</h5>
                                            <p > S/ {{parseFloat(c.montodesembolsado)+parseFloat(c.interes)}}</p>
                                        </div>
                                        <div class="col-md-3 ">
                                            <h5 class="font-weight-bold ">Periodo</h5>
                                              <p v-if="c.periodo==1">Anual</p>
                                                <p v-if="c.periodo==2">Semestral</p>
                                                  <p v-if="c.periodo==4">Trimestral</p>
                                                   <p v-if="c.periodo==12">Mensual</p>
                                        </div>
                                        <div class="col-md-3">
                                            <h5 class="font-weight-bold ">Analista del Crédito</h5>
                                             <p v-text="c.usernombre+' '+c.userapellidos"></p>
                                        </div>

                                        <!--INFORMACIONde credito-->
                                          <div class="col-md-12 ">
                                            <h4 class="text-dark font-weight-bold">
                                                <i class="mdi mdi-account-location mdi-36px"></i>Información del Socio </h4>
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
                                         <!--INFORMACIONde credito-->
                                          <div class="col-md-12 ">
                                            <h4 class="text-dark font-weight-bold">
                                                <i class="mdi mdi-account-location mdi-36px"></i>Información del Garante </h4>
                                            <hr>
                                        </div>
                                    <template v-if="c.idgarante!=c.idsocio">
                                        <div class="col-md-3">
                                            <h5 class="font-weight-bold ">DNI:</h5>
                                            <p v-text="c.garantedni"></p>
                                        </div>
                                        <div class="col-md-3 ">
                                            <h5 class="font-weight-bold ">Nombres y apellidos:</h5>
                                            <p v-text="c.garantenombre+' '+c.garanteapellidos"></p>
                                        </div>
                                        <div class="col-md-3 ">
                                            <h5 class="font-weight-bold ">Fecha nacimiento:</h5>
                                             <p v-text="c.garantefechanacimiento"></p>
                                        </div>
                                        <div class="col-md-3 ">
                                            <h5 class="font-weight-bold ">Dirección:</h5>
                                              <p v-text="c.garantedireccion"></p>
                                        </div>
                                        <div class="col-md-3 ">
                                            <h5 class="font-weight-bold ">Teléfono:</h5>
                                            <p v-text="c.garantetelefono"></p>
                                        </div>
                                        <div class="col-md-3">
                                            <h5 class="font-weight-bold ">Email:</h5>
                                            <p v-text="c.garanteemail"></p>
                                        </div>
                                        </template>
                                        <template v-else>
                                        <div class="col-md-3">
                                              
                                                <p> No tiene un garante Registrado</p>
                                        </div>
                                        </template>
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
                                                <th>Cuota </th>
                                                <th> Interes </th>
                                                <th> Amortización </th>
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
                                                         <button type="button" @click="generarboucher(cu.id)" class="btn btn-success btn-rounded btn-icon ">
                                                            <i class="mdi mdi-file-import mdi-24px"></i>
                                                        </button>
                                                    </template>
                                                   
                                                </td>
                                                <template v-if="cu.estado==0">
                                                    <td v-text="cu.fechapago" ></td>
                                                </template>
                                                <template  v-if="cu.estado==1">
                                                     <td >Fecha de Vecnimiento :{{cu.fechapago}} <br>
                                                     Fecha de Pago :  <label class="badge badge-danger">{{cu.fechacancelo}}</label></td>
                                                </template>
                                                
                                                <td v-text="cu.monto"></td>
                                                <td v-text="cu.interes"></td>
                                                <td v-text="cu.amortizacion"></td>
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
             generarboucher(id){
                window.open('/cuota/detallecuotapdf/'+id+'','_blank');
            },
            desembolsar(id){
                
                  let me = this;
                    Swal.fire({
                    title: '',
                    text: "¿Está seguro que desea DESEMBOLSAR EL CREDITO?",
                    type: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                     cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Si'
                    }).then((result) => {
                    if (result.value) {
                       axios.put('/credito/desembolsar',{
                    'id': id,
                        }).then(function (response) {

                        Swal.fire(
                        '', 'El credito ha sido REGISTRADO COMO DESEMBOLSADO',
                        'success'
                        )  
                          this.detalleCredito();
                               
                      }).catch(function (error) {
                                console.log(error);
                            });
                    }
                 })
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