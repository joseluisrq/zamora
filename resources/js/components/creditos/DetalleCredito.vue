<template>
    <main>
    <!--detalle de CREDITO-->
        <template v-if="vistas==1">
        <div class="row ">
            <div class="col-lg-12 grid-margin stretch-card ">
                <div class="card ">
                    <div class="card-body ">
                        <div class="row bg bg-dark ">
                            <div class="col-md-12 mt-2 text-white ">
                                <h4>Detalle de Crédtio  
                                <template v-if="estadodes==3">
                                    <span class="bg bg-danger">  CREDIDO INACTIVO</span> 
                                </template>
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
                                            <button type="button" @click="pdfCronograma()" class="btn btn-primary btn-icon-text">
                                                <i class="mdi mdi-file-pdf btn-icon-prepend"></i>                                                    
                                                Descargar Cronograma
                                            </button>
                                            <template v-if="rol==1">
                                                    <template v-if="arrayCreditos[0].estadodesembolso==0">
                                                        <button  class="btn btn-warning" @click="vistas=2"> Aprobar Credito</button>
                                                       
                                                    </template>
                                                    <template v-else-if="arrayCreditos[0].estadodesembolso==1">
                                                        <button  class="btn btn-success" @click="desembolsar(c.id)">Desembolsar</button>
                                                    </template>                                            
                                            </template>

                                            <template v-else-if="rol!=1">
                                                 <button v-if="arrayCreditos[0].estadodesembolso==0" class="btn btn-success" disabled> Credito por aprobar</button>
                                                  <button v-else-if="arrayCreditos[0].estadodesembolso==1" class="btn btn-success" @click="desembolsar(c.id)">Desembolsar</button>
                                            </template>
                                            
                                

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
                                                     <td >Fecha de Vencimiento :{{cu.fechapago}} <br>
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
        </template>
        <!--detalle de CREDITO-->

        <!--aprobar credito-->
        <template v-if="vistas==2">
            <div class="row ">
                <div class="col-lg-12 grid-margin stretch-card ">
                    <div class="card ">
                        <div class="card-body ">
                             <div class="row bg bg-dark ">
                                 <div class="col-md-12 mt-2 text-white ">
                                     <h4>Requisitos para aprobar Crédito</h4>
                                   
                                </div>
                             </div>
                             <div class="row  ">
                                <div class="col-md-12">
                                      <span>Marque los opciones que cumpla el crédito</span>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input"  value="f1" v-model="requisistos" type="checkbox"> Solicitud de Préstamo                                       
                                    </div>
                                     <div class="form-check form-check-inline">
                                        <input class="form-check-input"  value="f2" v-model="requisistos" type="checkbox"> Pagaré                                      
                                    </div>
                                     <div class="form-check form-check-inline">
                                        <input class="form-check-input"  value="f3"  v-model="requisistos" type="checkbox"> Contrato                                       
                                    </div>
                                     <div class="form-check form-check-inline">
                                        <input class="form-check-input"   value="f4" v-model="requisistos" type="checkbox"> Copia de DNI del Socio Titular, conyuge y garante                                      
                                    </div>
                                     <div class="form-check form-check-inline">
                                        <input class="form-check-input"   value="f5" v-model="requisistos" type="checkbox"> Copia de las boletas de los 2 últimos meses                                       
                                    </div>
                                     <div class="form-check form-check-inline">
                                        <input class="form-check-input"  value="f6"  v-model="requisistos" type="checkbox"> Central de Riesgo                                      
                                    </div> 
                                      <div class="form-check form-check-inline">
                                        <input class="form-check-input"  value="f7"  v-model="requisistos" type="checkbox"> Se aceptan otros ingresos, o ingresos conyugales                                      
                                    </div>
                                      <div class="form-check form-check-inline">
                                        <input class="form-check-input"  value="f8"  v-model="requisistos" type="checkbox"> Copia del recibo del servicio de luz o agua                                      
                                    </div>


                                       <button  class="btn btn-warning" @click="aprobar(arrayCreditos[0].id);"> Aprobar Credito</button>
                                        <button  class="btn btn-danger" @click="desaprobar(arrayCreditos[0].id);"> Desaprobar Credito</button>
                                   

                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                          

        </template>
        <template v-if="vistas==3">
                 <div class="row ">
                <div class="col-lg-12 grid-margin stretch-card ">
                    <div class="card ">
                        <div class="card-body ">
                             <div class="row bg bg-dark ">
                                 <div class="col-md-12 mt-2 text-white ">
                                     <h4>Requisitos para aprobar Crédito</h4>
                                   
                                </div>
                             </div>
                             <div class="row  ">
                                <div class="col-md-12">
                                     <template v-if="estadoaprobado==0">
                                        <div class="card">
                                            <div class="card-body">
                                            <h4 class="card-title">El Credito ha sido desaprobado</h4>
                                            <div class="media">
                                                <i class="mdi mdi-earth icon-md text-info d-flex align-self-start mr-3"></i>
                                                <div class="media-body">
                                                <p class="card-text">El crédito no ha cumplido con los requisitos para ser aprobado, y queda inactivo</p>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                     </template>
                                     <template v-if="estadoaprobado==1">
                                         <div class="card">
                                            <div class="card-body">
                                            <h4 class="card-title">El Credito ha sido Aprobado</h4>
                                            <div class="media">
                                                <i class="mdi mdi-earth icon-md text-info d-flex align-self-start mr-3"></i>
                                                <div class="media-body">
                                                <p class="card-text">El crédito ha sido aprobado, puede descargar el el cronograma de pagos</p>
                                                 <button type="button" @click="pdfCronograma()" class="btn btn-primary btn-icon-text">
                                                <i class="mdi mdi-file-pdf btn-icon-prepend"></i>                                                    
                                                Descargar Cronograma
                                                </button>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </template>                                 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        <!--fin aprobar credito-->
    </main>
</template>

<script>
export default {
    props : ['id','rol'],
    data(){
        return{
            ruta:'http://localhost/zamora/public',
            arrayCreditos:[],
            estadodes:0,
            arrayCuotas:[],

            hoy:'',
            vistas:1,
            f1:'', f2:'', f3:'', f4:'', f5:'', f6:'', f7:'', f8:'',

            errorRequisistos:0,
            errorMostrarMsjRequisistos :[],
            requisistos:[],
            estadoaprobado:'',
            caja:0
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
                      me.estadodes = me.arrayCreditos[0].estadodesembolso;
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
                window.open(this.ruta +'/cuota/detallecuotapdf/'+id+'','_blank');
            },
            desembolsar(id){
                
                  let me = this;

                var url= this.ruta+'/caja/seleccionarCaja';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    var datosCaja = respuesta.caja[0].idusuario;
                    me.caja = respuesta.caja[0].id;
                    //me.montoapertura= me.datosCaja[0].montoinicial; 
                    var user = respuesta.user; 
                    if(user==datosCaja)
                    {   
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
                       axios.put(me.ruta+'/credito/desembolsar',{
                        'id': id,
                        'caja':me.caja,
                        'montodesembolsado':me.arrayCreditos[0].montodesembolsado


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
                       
                    }else{
                        Swal.fire({
                        type: 'error',
                        title: 'Error',
                        text: 'Debe aperturar una caja',
                          })
                    }

                                  
                })
                .catch(function (error) {
                    console.log(error);
                });
                  
                   
            },
        aprobar(id){
             if (this.validarRequisistos()==true){ 
            let me = this;
            Swal.fire({
            title: '',
            text: "¿Está seguro que desea APROBAR EL CREDITO?",
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
                cancelButtonText: 'Cancelar',
            confirmButtonText: 'Si'
            }).then((result) => {
            if (result.value) {
                axios.put(this.ruta+'/credito/aprobar',{
            'id': id,
                }).then(function (response) {
                    me.vistas=3;
                    me.estadoaprobado=1;
                Swal.fire(
                '', 'El credito ha sido APROBADO ',
                'success'
                )  
                    this.detalleCredito();
                
                        
                }).catch(function (error) {
                        console.log(error);
                    });
            }
            })
             } 
             else{
                 Swal.fire({
                    type: 'error',
                    title: 'Error',
                    text: 'El credito no se puede aprobar',
                    footer: '<a href>Todos los requisitos son obligatorios</a>'
                    })
             }},
            validarRequisistos(){
                if(this.requisistos.length==8){
                    return true;
                }

            },

              desaprobar(id){
                
                  let me = this;
                    Swal.fire({
                    title: '',
                    text: "¿Está seguro que desea DESAPROBAR EL CREDITO?",
                    type: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                     cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Si'
                    }).then((result) => {
                    if (result.value) {
                       axios.put(this.ruta+'/credito/desaprobar',{
                    'id': id,
                        }).then(function (response) {
                              me.vistas=3;
                             me.estadoaprobado=0;
                        Swal.fire(
                        '', 'El credito ha sido DESAPROBADO ',
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