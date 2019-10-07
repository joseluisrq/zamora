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
                                <h4 class="font-weight-bold">PAGO DE CUOTA N° {{c.numerocuota}}</h4>       
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
                                        <p class="font-weight-light" v-text="c.nombre+' '+c.apellidopaterno+' '+c.apellidomaterno"></p>
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
                                        <p class="font-weight-bold ">ID KIVA</p>
                                        <p class="font-weight-light" v-text="c.idkiva"></p>
                                    </div>
                                    <div class="col-md-3">
                                        <p class="font-weight-bold ">Tipo cambio</p>
                                        <p class="font-weight-light" v-text="'S/ '+parseFloat(c.tipocambio).toFixed(2)"></p>
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
                                            <td>Saldo Anterior Neto</td>
                                            <td v-text="'$ '+(parseFloat(c.saldopendiente)+parseFloat(c.monto)).toFixed(2)"></td>
                                            </tr>
                                        
                                            <tr>
                                            <td>Pago Neto</td>
                                            <td v-text="'S/ '+(c.monto*c.tipocambio).toFixed(2)"></td>
                                            </tr>
                                            <tr>
                                            <td>Interes</td>
                                            <td v-text="'S/ '+(interes*c.tipocambio).toFixed(2)"></td>
                                            </tr>
                                            <tr>
                                            <td>Otros Pagos S/</td>
                                            <td> <input type="number" class="form-control" min="0"  v-model="c.otroscostos"  placeholder="No puede dejar este campo vacio"></td>
                                            </tr>
                                        
                                            <tr class="">
                                            <td>Total a Pagar</td>
                                            <td v-text="'S/. '+(parseFloat(c.otroscostos)+parseFloat(totalpagar)).toFixed(2)" class="bg bg-warning text-white"></td>

                                            </tr>
                                        
                                            
                                        </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">  
                                <p class="font-weight-bold">Descripción</p>
                                        <textarea rows="5" cols="50" oninput="this.value = this.value.toUpperCase();" v-model="descpagocuota"></textarea>   
                            </div>  
                            <div class="col-md-12">  
                                <hr>
                                <div class="row">
                                    <div class="col-md-9">
                                        <button type="button" v-if="botoncuota" @click="pagarCuota(c.id,c.otroscostos,c.idpersona)" class="btn btn-success col-md-4" >Pagar Cuota</button>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="button" class="btn btn-outline-primary" @click="showpagoporcion=true;botoncuota=false;">Pagar porción</button>      
                                    </div>
                                </div>
                            </div>
                        <!--fin detalle de pago-->
                        
                    <!-- INICIO PAGO PORCION  -->
                        <template v-if="showpagoporcion">
                    
                            <div class="col-md-12">
                                <hr>
                                <h5 class="font-weight-bold">Pagar Porción de Cuota</h5>
                                <hr>
                            </div>
                            <div class="col-md-2">
                                <p class="font-weight-bold">Ingresar Monto S/</p>
                                <input required="" class="col-md-12" type="Number" :max="c.monto" min="0" v-model="montoporcion" placeholder="Ingrese el monto a pagar">                 
                            </div>
                            <div class="col-md-2">
                            <p class="font-weight-bold">Otros Pagos S/</p>
                            <input type="Number" min="0" placeholder="Ingrese cantidad" v-model="otroscostosporcion">
                        </div>
                            <div class="col-md-8">
                                    <p class="font-weight-bold">Descripción</p>
                                    <input type="text" oninput="this.value = this.value.toUpperCase();" v-model="descpagoporcion" class="col-md-12">
                            </div>  
                                                    
                            <div class="col-md-12">
                                <hr>
                                    <button type="button" class="btn btn-danger" @click="showpagoporcion=false;botoncuota=true;">Cerrar</button>
                                    <button type="button" class="btn btn-success" @click="pagarPorcionCuota(c.id,c.tipocambio,c.tasa)">Confirmar pago</button>
                            </div>
                            
                                
                        
                        
                        </template>
                    <!-- FIN PAGO PORCION  -->
    
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
    props : ['idcliente'],
    data (){
            return {
                //ruta
                 ruta: '',
               
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

            }
            
        },
        computed:{
               

            
        },
        methods : {
      

            //CUOTA PAGAR
            obtenerCuotaDeCliente(){
                let me=this;
                
                axios.get('/cuota/detallepagar?id='+this.idcliente)
                    .then(res => {
                    this.dataC = res.data.cuotas;
                    me.interes=me.dataC[0].monto*(me.dataC[0].tasa/100);
                   // me.montoanterior=me.dataC[0].montodesembolsado/me.dataC[0].numerocuotas
                    me.totalpagar=(((parseFloat(me.dataC[0].monto)+parseFloat(me.interes))*me.dataC [0].tipocambio)).toFixed(2);
                     })
                    .catch(err => {
                        console.log(err);
                    });
            },

            //pagar cuota
            pagarCuota: function(idcuota,otroscostoscuota,idpersona){
                axios.put('/cuota/pagar',{
                    'id': idcuota,
                    'descripcion': this.descpagocuota,
                    'otrospagos': otroscostoscuota,
                    'idpersona':idpersona,
                    //'montoant':this.montoanterior,
                })
                    .then(res => {
                    Swal.fire({
                        position: 'top-end',
                        type: 'success',
                        title: 'El pago se realizó correctamente',
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

            generarboucher(){
                window.open('/credito/detallecuotapdf/'+this.identificadorcuota+'','_blank');
            },
            generarboucherPorcion(){
                window.open('/credito/detalleporcioncuotapdf/'+this.identificadorcuota+'','_blank');
            },

            //pagar porcion cuota
            pagarPorcionCuota(idcuota,tipocambio,tasa){

                if(this.montoporcion == 0){
                    Swal.fire({
                    title: 'Debe ingresar un monto mayor a cero',
                    animation: true,
                    customClass: {
                        popup: 'animated tada'
                    }
                    })
                    return;
                }
                //adolares
                 let montopagardolares=this.montoporcion/tipocambio
                 //monto de interes
                 let pagoInteresPorcion=montopagardolares*(tasa/100)
                 //monto de cuta
                 let pagoCuotaProcion=montopagardolares-pagoInteresPorcion;
               
               
                axios.post('/cuota/porcion',{
                    'id':idcuota,
                    'monto': pagoCuotaProcion,
                    'otroscostos': this.otroscostosporcion,
                    'descripcion': this.descpagoporcion
                })
                    .then(res => {
                    Swal.fire({
                        position: 'top-end',
                        type: 'success',
                        title: 'El pago se realizó correctamente',
                        showConfirmButton: false,
                        timer: 1500
                        })
                   // this.generarboucher(cuotaid);
                    this.montoporcion=0.0,
                    this.otroscostosporcion=0.0,
                    this.descpagoporcion='',
                     this.botoncuota=true;


                   
                    this.showpagoporcion=false;

                    this.mostrarpagar=false;
                    this.identificadorcuota=idcuota
                    this.btnboucher=2;


                   
                   
                    })
                    .catch(err => {
                        Swal.fire({
                        position: 'top-end',
                        type: 'error',
                        title: 'Error, No se completó el pago',
                        showConfirmButton: false,
                        timer: 1500
                        })
                    });

                  
            },
        },
        mounted() {
            this.obtenerCuotaDeCliente();
        }
    }
</script>