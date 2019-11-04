<template >
       <!-- INICIO PAGO DE CUOTA -->
       <main v-if="mostrarpagar==true">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <!--detalle de pago-->
                    <div class="row" v-for="c in dataC" :key="c.id">
                            <div class="col-md-12">
                                <h4 class="font-weight-bold">PAGO DE CUOTA N° {{c.numerodecuota}}
                                     &nbsp;&nbsp;
                                <template v-if="diasdemora>0">
                                    <span class="bg bg-danger text-white">  &nbsp;&nbsp;{{diasdemora}} días de incumplimiento de pago.  &nbsp;&nbsp;</span>
                                  
                                </template>
                                
                                

                                </h4>       
                            </div>
                            <!--Datos del cliente-->
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12 ">  
                                        <hr>
                                        <h5 class=" text-dark"><i class="fa fa-address-book-o "></i> Datos del Cliente</h5>
                                    <hr>
                                    </div>
                                    <div class="col-md-3">
                                        <p class="font-weight-bold">DNI</p>
                                        <p class="font-weight-light" v-text="c.dni"></p>
                                    </div>
                                    <div class="col-md-9">  
                                        <p class="font-weight-bold">Cliente</p>
                                        <p class="font-weight-light" v-text="c.nombre+' '+c.apellidos"></p>
                                    </div>
                                
                                </div>
                            </div>
                            <!--Datos del credito-->
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">  
                                        <hr>
                                        <h5 class="text-dark"><i class="fa fa-desktop "></i> Datos del Credito</h5>
                                        <hr>
                                    
                                    </div>
                                    <div class="col-md-3">
                                        <p class="font-weight-bold ">N° Prestamo</p>
                                        <p class="font-weight-light" v-text="c.numeroprestamo"></p>
                                    </div>
                                    <div class="col-md-3">
                                        <p class="font-weight-bold ">TEA(Tasa de Interes Anual)</p>
                                        <p class="font-weight-light" v-text="c.tasa+' %'"></p>
                                    </div>
                                    <div class="col-md-3">
                                        <p class="font-weight-bold ">Numero de Cuotas</p>
                                        <p class="font-weight-light" v-text="c.numerocuotas+' Cuotas'"></p>
                                    </div>
                                    <div class="col-md-3">
                                        <p class="font-weight-bold ">Periodo</p>
                                        <p class="font-weight-light" v-if="c.periodo==1">Mensual</p>
                                        <p class="font-weight-light" v-else-if="c.periodo==3">Trimestral</p>
                                        <p class="font-weight-light" v-else-if="c.periodo==6">Semestral</p>
                                        <p class="font-weight-light" v-else-if="c.periodo==12">Anual</p>
                                    </div>
                                    <div class="col-md-3">
                                            <p class="font-weight-bold">Fecha pago</p>
                                            <p class="font-weight-light" v-text="c.fechapago"></p>
                                    </div>
                                </div>
                            </div>
                            <!--detalle depago-->
                            <div class="col-md-12">  
                                <hr>
                                <h5 class=""> <i class="fa fa-money  "></i> Detalle del Pago</h5>
                                <hr>
                            </div>
                            <div class="col-md-6">  
                                <table class="table table-bordered">
                                <thead>
                                    
                                </thead>
                                        <tbody>
                                            <tr>
                                            
                                        
                                            <tr>
                                                <td>Pago Neto</td>
                                                <td v-text="'S/ '+c.amortizacion"></td>
                                            </tr>
                                            <tr>
                                                <td>Interes</td>
                                                <td v-text="'S/ '+c.interes"></td>
                                                </tr>
                                          
                                            <template v-if="morahastahoy!=0">
                                                <tr>
                                                    <td>Interes Moratorio</td>
                                                    <td v-text="'S/ '+morahastahoy"></td>
                                                </tr>
                                              
                                            </template>
                                           
                                           <!--
                                            <tr>
                                                <td>Otros Pagos S/</td>
                                                <td> <input type="number" class="form-control" min="0"  v-model="c.mora"  placeholder="No puede dejar este campo vacio"></td>
                                            </tr>
                                            -->
                                        
                                            <tr class="">
                                            <td>Total a Pagar</td>
                                            <td v-text="'S/. '+(parseFloat(morahastahoy)+parseFloat(c.monto)).toFixed(2)" class="bg bg-warning text-white"></td>

                                            </tr>
                                        
                                            
                                        </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">  
                                <h5 class="font-weight-bold">Descripción</h5>
                                        <textarea  class="form-control"
                                        rows="3"
                                        oninput="this.value = this.value.toUpperCase();" v-model="descpagocuota"></textarea>   
                            </div>  
                            <div class="col-md-12">  
                                <hr>
                                <div class="row">
                                     <div class="col-md-12">
                                    <h4>Forma de Pago</h4>
                                     </div>
                                    <div class="col-md-6">
                                        <button type="button" v-if="botoncuota" @click="pagarCuota(c.idcuota,c.idpersona)" class="btn btn-success col-md-4" >Pagar en Efectivo</button>
                                         <button type="button" v-if="botoncuota" @click="pagodeposito=true" class="btn btn-success col-md-4" >Pago en Deposito a Cuenta</button>
                                     </div>
                                   
                                   
                                </div>
                            </div>
                            <div class="col-md-12">
                              <template v-if="pagodeposito==true">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-body">
                                                <h4 class="card-title">Detalle de Pago por Deposito</h4>
                                                <p class="card-description">
                                                   Inserte la informacion del deposito 
                                                </p>
                                                <form class="forms-sample">
                                                    <div class="form-group row">
                                                        <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Número de Transacción </label>
                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control" id="exampleInputUsername2"  v-model="transacciondeposito" placeholder="Número de Transacción">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Fecha de Pago</label>
                                                        <div class="col-sm-3">
                                                            <input type="date" class="form-control" id="exampleInputEmail2" v-model="fechapagodeposito" placeholder="Fecha de Pago">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="exampleInputMobile" class="col-sm-3 col-form-label">Monto</label>
                                                        <div class="col-sm-3">
                                                            <input type="number" class="form-control" id="exampleInputMobile" v-model="montodeposito"  placeholder="Monto a Depositar">
                                                        </div>
                                                    </div>
                                                      <button type="button" v-if="botoncuota" @click="pagarDeposito()" class="btn btn-success col-md-4" >Pago de Cuota</button> 
                                                        <button type="button"  @click="pagodeposito=false;transacciondeposito='';fechapagodeposito='';montodeposito='';" class="btn btn-danger col-md-4" >Cancelar</button>  
                                                  
                                                </form>
                                                </div>
                                             </div>
                                        </div>
                                    </div>
                                                               
                            </template>
                        </div>
                        <!--fin detalle de pago-->
                        
                    <!-- INICIO PAGO PORCION  -->
                  
    
                </div>
                </div>
                </div>
                </div>
            </div>   
        </main> 

        <main v-else>
            <div class="row card">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h2 class=" text-primary mb-5 ">La cuota ha sido pagada con éxito</h2>
                            <div class="wrapper d-flex justify-content-between">
                                <div class="side-left">
                               
                                    <button v-if="btnboucher==1" type="button" class="btn btn-danger" 
                                    @click="generarboucher()">
                                    <i class="fa fa-file-pdf-o"></i>
                                    Descargar Boucher
                                    </button>

                                    <button v-else-if="btnboucher==2" type="button" class="btn btn-warning" 
                                    @click="generarboucherPorcion()">
                                    <i class="fa fa-file-pdf-o"></i>
                                    Descargar Boucher
                                    </button>

                                    
                                </div>
                                
                            </div>
                    
                        </div>
                    </div>
                </div>
               
            </div>
        </main>
      
    <!-- FIN PAGO DE CUOTA -->
    </template>

<script>
export default {
    props : ['idcliente','caja'],
    data (){
            return {
                //ruta
                 ruta: 'http://localhost/zamora/public',
               
                dataC:[],//detalle de cuota

                totalpagar:0.0,
                interes:0.0,

                descpagocuota:'',

                //datos del cliente
                
                 showpagoporcion:false,
                 botoncuota:true,


                 montoporcion:0.0,
                 otroscostosporcion:0.0,
                 descpagoporcion:'',
                 mostrarpagar:true,
                 
                 identificadorcuota:0,
                 btnboucher:1, //1cuota //2 porcioncuota

                 montoanterior:0,

                 //caluclo de interes
              
                 hoy:'',
                 tasa_compensatoria_anual:0.0,
                 tasa_moratoria_anual:0.0,

                 fechapago:'',
                 diasdemora:'',

                 morahastahoy:0.0,
                 estadomora:"0",
                 pagodeposito:false,
                
                montoestandar:0,
                transacciondeposito:'',
                montodeposito:0,
                fechapagodeposito:''
                 

            }
            
        },
        computed:{
               

            
        },
        methods : {
      

            //CUOTA PAGAR
            obtenerCuotaDeCliente(){
                let me=this;
                
                axios.get(this.ruta+'/cuota/detallepagar?id='+this.idcliente)
                    .then(res => {
                    this.dataC = res.data.cuotas;
                    this.fechapago=this.dataC[0].fechapago
                    this.montodeposito=this.dataC[0].monto;
                    // this.montoestandar=this.dataC[0].monto;
                   // me.montoanterior=me.dataC[0].montodesembolsado/me.dataC[0].numerocuotas
                   // me.totalpagar=(((parseFloat(me.dataC[0].monto)+parseFloat(me.interes))*me.dataC [0].tipocambio)).toFixed(2);
                     })
                    .catch(err => {
                        console.log(err);
                    });
            },
            pagarDeposito(){
                let me= this;
                if(me.transacciondeposito!=''&& me.fechapagodeposito!='' && me.montodeposito!=0 ){
                    if(me.montoestandar<=me.montodeposito){
                          axios.put(this.ruta+'/cuota/pagarCuotaDeposito',{
                            'id': me.dataC[0].idcuota,
                            'descripcion': this.descpagocuota,
                            'mora': this.morahastahoy,
                            'idsocio':me.dataC[0].idpersona,
                            'montodeposito':me.montodeposito,
                            'transacciondeposito':me.transacciondeposito,
                            'fechapagodeposito':me.fechapagodeposito,
                            'estadomora':this.estadomora,

                             'caja':this.caja,
                            'montodeposito':this.montodeposito,
                        
                        })
                            .then(res => {
                                 this.mostrarpagar=false;
                                this.identificadorcuota=me.dataC[0].idcuota
                            Swal.fire({
                                position: 'top-end',
                                type: 'success',
                                title: 'El pago se realizó exitosameente',
                                showConfirmButton: false,
                                timer: 2000
                                })
                               
                        
                            })
                            .catch(err => {
                                Swal.fire({
                                position: 'top-end',
                                type: 'error',
                                title: 'Error, No se realizó el pago',
                                showConfirmButton: false,
                                timer: 1500
                                })
                            });

                    }
                    else{
                        Swal.fire({
                        type: 'error',
                        title: 'Error',
                        text: 'El  deposito tiene que ser igual o mayor a la deuda',
                     
                        })
                    }
                    
                }else{
                    Swal.fire({
                        type: 'error',
                        title: 'Error',
                        text: 'Datos Incorrectos',
                        footer: '<a href>Asegurese de ingresar los datos correctos</a>'
                        })
                }
            },

            //pagar cuota
            pagarCuota (idcuota,idpersona){
                axios.put(this.ruta+'/cuota/pagarCuota',{
                    'id': idcuota,
                    'descripcion': this.descpagocuota,
                    'mora': this.morahastahoy,
                    'idsocio':idpersona,
                    'estadomora':this.estadomora,
                    'caja':this.caja,
                    'montodeposito':this.montodeposito,
                  
                })
                    .then(res => {
                    Swal.fire({
                        position: 'top-end',
                        type: 'success',
                        title: 'El pago se realizó exitosameente',
                        showConfirmButton: false,
                        timer: 2000
                        })
                        this.mostrarpagar=false;
                        this.identificadorcuota=idcuota
                
                    })
                    .catch(err => {
                        Swal.fire({
                        position: 'top-end',
                        type: 'error',
                        title: 'Error, No se realizó el pago',
                        showConfirmButton: false,
                        timer: 1500
                        })
                    });
            },

            interespormora(){
               let me=this;
               var fecha1=moment(me.fechapago)
               var fecha2=moment(me.hoy);
               me.diasdemora =fecha2.diff(fecha1, 'days')
               if(me.diasdemora>0){
                   me.estadomora="1";
                
                    var M=0;
                   var DM=this.diasdemora/360;
                   var S=0;
                   
                   var CP=this.dataC[0].monto;
                   var C=parseFloat(CP)+parseFloat(S);
                   var TC=this.tasa_compensatoria_anual/100;
                   var TM=this.tasa_moratoria_anual/100;


                   
                   M=
                   parseFloat(C)+
                   parseFloat(CP*(Math.pow(parseFloat(1)+parseFloat(TC),DM)-1))+
                   parseFloat(CP*(Math.pow(parseFloat(1)+parseFloat(TM),DM)-1))
                   ;
                   me.morahastahoy=(M-C).toFixed(2);
                   me.montodeposito=parseFloat(me.morahastahoy)+parseFloat(me.montodeposito);
                   me.montoestandar= me.montodeposito;
                   console.log(me.morahastahoy)
               }
               else{
                    me.morahastahoy=0;
                    me.estadomora="0";
               }
            },

            cargarValores(){
            let me = this;

            axios.get(this.ruta+'/config/valores')
                .then(res => {
                    //  me.array_empresa=res.data.config;
                    me.tasa_compensatoria_anual =  res.data.config.tasa_compensatoria_anual;
                    me.tasa_moratoria_anual = res.data.config.tasa_moratoria_anual;
                    me.hoy = res.data.hoy;
                    me.fechapagodeposito=me.hoy;
                    me.interespormora();
                })
                .catch(err => {
                  //  me.mostraralerta('top-end', 'error', '¡¡¡ Error al cargar las tasas', false, 2500);
                    console.log(err);
                });
            },


            generarboucher(){
                window.open(this.ruta+'/cuota/detallecuotapdf/'+this.identificadorcuota+'','_blank');
            },
           

          
        },
        mounted() {
            this.obtenerCuotaDeCliente();
              this.cargarValores();
        }
    }
</script>