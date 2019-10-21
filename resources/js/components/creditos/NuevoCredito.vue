<template>
    <!--agregar un CREDITO-->
    <main>
    <div class="row" v-if="viewAgregar">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row bg bg-dark">
                        <div class="col-md-12 mt-2 text-white">
                            <h4>
                                <i class="mdi mdi-package-variant-closed mdi-36px"></i> Nuevo Crédito</h4>
                        </div>
                    </div>

                    <form class="forms-sample mt-4">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="exampleInputUsername1">Ingrese DNI del Socio 
                                </label>
                                <v-select
                                    :on-search="selectCliente"
                                            label="dni"
                                            :options="arrayCliente"
                                            placeholder="Ingrese DNI del cliente..."
                                            :onChange="getDatosCliente"   
                                            class="col-md-12"  
                                    >
                                    </v-select>
                                    <div v-if="idcliente!=0">
                                        <label class="badge badge-dark" v-text="nombre+' '+apellidos">

                                        </label>
                                    </div>
                            </div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3 form-group">
                                
                                <br>
                                <template v-if="registropersona==true">
                                    <button class="btn btn-success" type="button" @click="registropersona=false;garanteestado=0" > <i class="mdi mdi-clipboard-account"></i>  Sin Garante</button>
                                </template>
                                <template v-else>
                                    <button class="btn btn-success" type="button" @click="registropersona=true;garanteestado=1" > <i class="mdi mdi-clipboard-account"></i>  Agregar Garante</button>
                                </template>
                                  </div>
                            <template v-if="registropersona==true" >
                                
                                     <div class="col-md-12 form-group ">
                                         <hr>
                                            <h3 class="font-weight-bold"> Formulario de Garante </h3> 
                                      </div>
                                     <div class="col-md-2 form-group">
                                        <label for="exampleInputUsername1" class=" text-dark">DNI de Garante</label>
                                        <input type="text" class="form-control" v-model="dnig" placeholder="Ingrese DNI" >
                                    </div>

                                    <div class="col-md-3 form-group ">
                                        <label for="exampleInputUsername1" class=" text-dark">Nombres Completos</label>
                                        <input type="text" class="form-control" v-model="nombreg"
                                         onkeyup="this.value = this.value.toUpperCase();" placeholder="Ingrese nombres completos" >
                                    </div>

                                      <div class="col-md-3 form-group">
                                        <label for="exampleInputUsername1" class=" text-dark">Apellidos Completos</label>
                                        <input type="text" class="form-control" v-model="apellidosg" 
                                         onkeyup="this.value = this.value.toUpperCase();" placeholder="Ingrese apellidos completos" >
                                    </div>
                                     <div class="col-md-2 form-group">
                                        <label for="exampleInputUsername1" class=" text-dark">Fecha Nacimiento</label>
                                        <input type="date" class="form-control" v-model="fechanacimientog" placeholder="" >
                                    </div>
                                     <div class="col-md-2 form-group">
                                        <label for="exampleInputUsername1"  class=" text-dark">Departamento</label>
                                        <input type="text" class="form-control" v-model="departamentog"
                                         onkeyup="this.value = this.value.toUpperCase();"  placeholder="Departamento" >
                                    </div>
                                    <div class="col-md-3 form-group ">
                                        <label for="exampleInputUsername1"  class=" text-dark">Ciudad</label>
                                        <input type="text" class="form-control" 
                                         onkeyup="this.value = this.value.toUpperCase();"
                                         v-model="ciudadg" placeholder="Ciudad" >
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="exampleInputUsername1"  class=" text-dark">Direccion</label>
                                        <input type="text" class="form-control"
                                         onkeyup="this.value = this.value.toUpperCase();"
                                          v-model="direcciong" placeholder="Dirección" >
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="exampleInputUsername1"  class=" text-dark">Teléfono</label>
                                        <input type="text" class="form-control" v-model="telefonog" placeholder="Número de Teléfono" >
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="exampleInputUsername1"  class=" text-dark">Correo Electrónico</label>
                                        <input type="text" class="form-control" v-model="emailg" placeholder="Correo Electrónico" >
                                    </div>
                                                                  
                                    
                                    
                                
                            </template>
                            
                            <template v-if="registrogarante==true">
                                <div class="row">
                                     <div class="col-md-2 form-group">
                                        <label for="exampleInputUsername1">Codigo de Crédito</label>
                                        <input type="text" class="form-control" v-model="numeroprestamo" placeholder="Codigo de Credito" disabled>
                                    </div>
                                </div>
                            </template>
                            <div class="col-md-12">
                                <hr>
                                <h3 class="font-weight-bold"> Formulario de Crédito </h3> 
                            </div>
                            
                            <div class="col-md-2 form-group">
                                <label for="exampleInputUsername1">Codigo de Crédito</label>
                                <input type="text" class="form-control" v-model="numeroprestamo" placeholder="Codigo de Credito" disabled>
                            </div>
                            <div class=" col-md-2 form-group">
                                <label for="exampleInputEmail1">Monto</label>
                                <input type="number" class="form-control" v-model="montodesembolsado" placeholder="Monto en Soles">
                            </div>
                            <div class=" col-md-2 form-group">
                                <label for="exampleInputEmail1">N° Cuotas</label>
                                <input type="number" class="form-control" v-model="numerocuotas" placeholder="Número de Cuotas">
                            </div>
                            <div class=" col-md-2 form-group">
                                <label for="exampleInputEmail1">Tasa Efectiva Anual(TEA) %</label>
                                <input type="text"   class="form-control"  v-model="tasa_creditos" placeholder="Número de Telefono" disabled> 
                            </div>
                            <div class=" col-md-2 form-group">
                                <label for="exampleInputEmail1">Periodo dce Cuotas</label>
                                <select class="form-control "  v-model="periodo"> 
                                        <option value="12" selected>Mensual</option>
                                        <option value="1">Anual</option>
                                        <option value="2">Semestral</option>
                                        <option value="4">Trimestral</option>
                                       
                                </select>
                            </div>
                            <div class=" col-md-2 form-group">
                                <label for="exampleInputEmail1">Fecha Primera Cuota</label>
                                <input type="date" class="form-control" v-model="fechadesembolso" placeholder="Número de Telefono">
                            </div>
                        </div>
                        <button type="button " class="btn btn-warning mr-2 " @click.prevent="agregarCuotas()">
                            <i class="mdi mdi-arrange-send-to-back mdi-24px"></i> Generar Cuotas 
                        </button>
                      

                        <div class="table-responsive" v-if="viewCuotas">
                            <table class="table  table-bordered">
                                <thead class="table-info text-white">
                                    <tr>
                                        <th>Cuota </th>
                                        <th>Fecha de Pago </th>
                                        <th>Cuota </th>
                                        <th> Interes </th>
                                        <th> Amortización </th>
                                        <th> Saldo </th>


                                    </tr>
                                </thead>
                                <template v-if="newCuotas.length">
                                    <tbody >
                                        <tr v-for="c in newCuotas" :key="c.id">
                                            <td class="py-1">{{c.contador}}</td>
                                            <td v-text="c.fechapago"></td>
                                            <td v-text="'S/ '+c.monto"></td>
                                            <td v-text="'S/ '+c.interes"></td>
                                                <td v-text="'S/ '+c.amortizacion"></td>
                                                <td v-text="'S/ '+c.saldopendiente"></td>
                                        </tr>
                                    </tbody>
                                <tbody>
                                    <tr class="bg bg-warning">
                                        <td></td>
                                        <td class="font-weight-bold">Total</td>
                                        <td class="font-weight-bold"> S/{{totalcuotas}}</td>
                                        <td class="font-weight-bold">S/ {{totalinteres}}</td>
                                         <td class="font-weight-bold">S/ {{totalamortizacion}}</td>
                                         <td></td>
                                    </tr>
                                </tbody>
                                </template>
                                

                                <tbody v-else>
                                <tr>
                                    <td colspan="6">
                                       Inserte la información requerida
                                    </td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                        <hr>
                         <div  v-show="errorCredito" class=" form-group col-md-12 mt-2 bg-danger">
                            <div class="text-center">
                                <div v-for="error in errorMostrarMsjCredito" :key="error">
                                  <mark class="bg-danger text-white col-md-12" ><i class="fa fa-exclamation-triangle"></i> {{error}}</mark>
                                </div>
                            </div>
                        </div>
                        <template v-if="viewCuotas">
                            <button   type="button " class="btn btn-primary mr-2 " @click.prevent="registrarCredito()">Registrar </button>
                            <button class="btn btn-light " @click="viewCuotas=false;limpiar()">Cancelar</button>
                        </template>
                    </form>
                </div>
            </div>
        </div>
    </div>

     <!--Detalle de un credito-->
    <template v-if="!viewAgregar">
        <button type="button" class="btn btn-warning" @click="viewAgregar=true;limpiar()">
           <i class="mdi mdi-arrow-left-bold"></i> Agregar nuevo Crédito
        </button>   
        <detallecredito  v-bind:id="idcredito" ></detallecredito>
    </template>
     <!--fin de detalle de credito-->
    
    </main>
    <!--fin de agregar un CREDITO-->    
    
</template>

<script>
   import vSelect from 'vue-select'
    export default {
        props : ['ruta'],
        data(){
            return{
                //datos de nuevo credito
            
                idcliente:0,
                numeroprestamo:'CZ-05',
                montodesembolsado:1000,
                numerocuotas:12,
                tasa:13,
                periodo:1,
                interesprestamo:0,
                fechadesembolso:'2019-09-01',

                //arrary Credito
                newCredito:[],
                //array Cuotas
                newCuotas:[],
                //aarayClientes
                arrayCliente:[],
                registropersona:false,
                registrogarante:false,


              
               dni:'',
               nombre:'',
               apellidos:'',


                //control de vistas
                viewAgregar:true,
                viewCuotas:false,
                
                //Control de errores
                 errorCredito:0,
                errorMostrarMsjCredito :[],



                arrayAuxliar:[],
                idcredito:0,


                totalcuotas:0,
                totalinteres:0,
                totalamortizacion:0  ,

                //datos garante
                dnig:'',
                nombreg:'',
                apellidosg:'',
                fechanacimientog:'',
                direcciong:'',
                departamentog:'',
                ciudadg:'',
                telefonog:'',
                emailg:'',

                garanteestado:0,

                tasa_creditos:0.0 ,
                hoy:'',                }
        },
          components:{
            vSelect
        
        },
         methods :{
            editar_fecha(fecha, intervalo, dma, separador)
            {                  
                var separador = separador || "-";
                var arrayFecha = fecha.split(separador);
                var dia = arrayFecha[2];
                var mes = arrayFecha[1];
                var anio = arrayFecha[0];
                
                var fechaInicial = new Date(anio, mes - 1, dia);
                var fechaFinal = fechaInicial;
                if(dma=="m" || dma=="M"){
                    fechaFinal.setMonth(fechaInicial.getMonth()+parseInt(intervalo));
                }else if(dma=="y" || dma=="Y"){
                    fechaFinal.setFullYear(fechaInicial.getFullYear()+parseInt(intervalo));
                }else if(dma=="d" || dma=="D"){
                    fechaFinal.setDate(fechaInicial.getDate()+parseInt(intervalo));
                }else{
                    return fecha;
                }
                dia = fechaFinal.getDate();
                mes = fechaFinal.getMonth() + 1;
                anio = fechaFinal.getFullYear();
                
                dia = (dia.toString().length == 1) ? "0" + dia.toString() : dia;
                mes = (mes.toString().length == 1) ? "0" + mes.toString() : mes;
                
                return anio + "-" + mes + "-" + dia;
            },
            agregarCuotas()
            {
                
                this.newCuotas.length=0;
                let me=this;
               if(this.montodesembolsado==0 ||this.numerocuotas==0  ||this.periodo=='0'||this.tasa=='0'){
                    Swal.fire({
                        position: 'top-end',
                        type: 'error',
                        title: 'Inserte información en los campos obligatorios',
                        showConfirmButton: false,
                        timer: 2000
                        })
                }else{
                   //  me.btnregistar=1;
                    var periodofecha
                    if(me.periodo==1)periodofecha=12
                    else  if(me.periodo==2)periodofecha=6
                    else  if(me.periodo==4)periodofecha=3
                    else  if(me.periodo==12)periodofecha=1


                    var e = new Date(me.fechadesembolso);
                    var pe=0;
                    var dia=me.fechadesembolso.substr(-2)
                    var unmesmas =me.fechadesembolso// this.editar_fecha(me.fechadesembolso, periodofecha, "m");

                  
                                       
                    //INICIO DE FORMULAR
                    var TIN = 0;
                    var TA = 0;
                    var TAN = 0;
                    var AA = 0;
                    var CUOTA = "";
                    var I = 0;
                    var AN = 0;
                    var IN = 0;
                    var A1 = 0;
                    var CP2 = 0;
                    var POT = 0;
                    var CP1 = 0;

                    var C = this.montodesembolsado;
                    var J =  this.tasa/ 100;
                    var N =this.numerocuotas;
                    var D = 0;

                    N = Math.round(N);
                    var M =this.periodo;


                    var DD = 2;
                    if (M == 1) {
                        CUOTA = "ANUALES"
                    }
                    if (M == 2) {
                        CUOTA = "SEMESTRALES"
                    }
                    if (M == 4) {
                        CUOTA = "TRIMESTRALES"
                    }
                    if (M == 12) {
                        CUOTA = "MENSUALES"
                    }  I = Math.pow(1 + J, 1 / M) - 1;
                        AN = 0;
                        IN = 0;
                        A1 = 0;
                        CP2 = C;
                        POT = parseInt(D) - N;
                        TIN = 0;
                        TA = 0;
                        TAN = 0;
                    //FIN DE FORMULA
                    for (var K = 0; K <= N; K++) {

                        TIN = TIN + IN;
                        TA = TA + A1;
                        TAN = TAN + AN;
                        if(K!=0){
                             me.newCuotas.push({
                            //(monto total+tasa)/cantidadde cuotas
                            contador:K,
                            monto:this.deci(AN, DD),
                            interes:this.deci(IN, DD),
                            amortizacion:this.deci(A1, DD),
                            saldopendiente:this.deci(CP2, DD),
                            fechapago:unmesmas,
                                                  
                        })
                        pe= parseInt(pe)+parseInt(periodofecha);
                        unmesmas = this.editar_fecha(me.fechadesembolso, pe, "m");
                        }
                    
                       if (K < D) {
                       
                            AN = C * I;
                            IN = C * I;
                            A1 = 0;
                            CP2 = C;
                       
                            }
                        if (K == D) {
                            
                                AN = (C * I) / (1 - Math.pow(1 + I, POT));
                                IN = C * I;
                                A1 = AN - IN;
                                CP2 = C - A1;
                                CP1 = CP2;
                        
                        }

                        if (K > D) {
                            IN = CP1 * I;
                            A1 = AN - IN;
                            CP2 = CP1 - A1;
                            CP1 = CP2;
                        }

                     }

                     this.totalcuotas=this.deci(TAN, DD);
                     this.totalinteres=this.deci(TIN, DD);
                     this.totalamortizacion=this.deci(TA, DD)



    
                    this.viewCuotas=true;

                 }//fin del else
               
            },
            deci(GG, KK){
                 return (Math.round(GG * Math.pow(10, KK)) / Math.pow(10, KK));
            },
            codigoprestamo(){
                let me=this;
                 let idcreditou=0;
                var url= this.ruta+'/credito/ultimocredito';               
                axios.get(url).then(function (response) {
                let respuesta= response.data;
                if(response.length==0){
                    idcreditou=1;
                }else{
                    idcreditou= respuesta.idultimocredito[0].id;
                }
               
                me.numeroprestamo='CZ'+me.zfill(idcreditou,6);
                 
                
                })
                .catch(function (error) {
                    console.log(error);
                });

            },
            zfill(number, width) {
                var numberOutput = Math.abs(number); /* Valor absoluto del número */
                var length = number.toString().length; /* Largo del número */ 
                var zero = "0"; /* String de cero */  

                if (width <= length) {
                    if (number < 0) {
                            return ("-" + numberOutput.toString()); 
                    } else {
                            return numberOutput.toString(); 
                    }
                } else {
                    if (number < 0) {
                        return ("-" + (zero.repeat(width - length)) + numberOutput.toString()); 
                    } else {
                        return ((zero.repeat(width - length)) + numberOutput.toString()); 
                    }
                }
            },
            cargarValores()
            {
                let me = this;

                axios.get(this.ruta+'/config/valores')
                    .then(res => {
                        //  me.array_empresa=res.data.config;
                        me.tasa_creditos =  res.data.config.tasa_creditos;
                        me.tasa=me.tasa_creditos;
                        me.hoy = res.data.hoy;
                        me.fechadesembolso=me.hoy;
                    
                    })
                    .catch(err => {
                    // me.mostraralerta('top-end', 'error', '¡¡¡ Error al cargar las tasas', false, 2500);
                        console.log(err);
                    });
            },

            limpiar(){
                this.codigoprestamo();
                this.montodesembolsado=0; 
                this.numerocuotas=0; 
                this.tasa=0;               
                this.periodo=0;            
                this.fechadesembolso='';
                this.idcliente=0,
                this.viewCuotas=false

            },
            //SELECIONAR CLIENTE PARA CREDITO
            selectCliente(search, loading){
                 let me=this;
                 loading(true)
                var url= this.ruta+'/socios/selectCliente?filtro='+search;
                axios.get(url).then(function (response) {
                    let respuesta= response.data;
                    q:search;
                    me.arrayCliente = respuesta.clientes;
                    loading(false)
                    
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            //COGER DTOS DEL CLIENTE PARA VISTA DETALLE
            getDatosCliente(val1){
                let me=this;
                me.loading=true;
                me.idcliente=val1.id;
                me.dni=val1.dni;
                me.nombre=val1.nombre;
                me.apellidos=val1.apellidos;
               
            },

            registrarCredito(){
                if (this.validarCredito()){ return; }
                
                let me = this;
                Swal.fire({
                    title: '¿Está seguro que desea AGREGAR UN NUEVO CREDITO?',
                    text: "",
                    type: 'success',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                     cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Si'
                    }).then((result) => {
                    if (result.value) {
                       axios.post(this.ruta+'/credito/registrar',{
                        'numeroprestamo': this.numeroprestamo,                              
                        'montodesembolsado': this.montodesembolsado,
                        'fechadesembolso' : this.hoy, 
                                                       
                        'numerocuotas' : this.numerocuotas,
                        'interes':this.totalinteres,
                       
                        'tasa' : this.tasa,
                        'periodo' : this.periodo,
                        'idcliente' : this.idcliente,

                        'garanteestado':this.garanteestado,


                        'dnig':this.dnig,
                        'nombreg':this.nombreg,  
                        'apellidosg':this.apellidosg,                       
                        'fechanacimientog':this.fechanacimientog,
                        'direcciong':this.direcciong,
                        'departamentog':this.departamentog,
                        'ciudadg':this.ciudadg,
                        'telefonog':this.telefonog,
                        'emailg':this.emailg,


                        'data':this.newCuotas    
                        }).then(function (response) {

                        Swal.fire(
                        'CREDITO REGISTRADO', 'El credito ha sido registrado correctamente',
                        'success'
                        )  
                          let respuesta= response.data;
                          me.idcredito=respuesta.idcredito;
                         me.viewAgregar=false;
                               
                      }).catch(function (error) {
                                console.log(error);
                            });
                    }
                 })
            },
            validarCredito(){
                this.errorCredito=0;
                this.errorMostrarMsjCredito =[];

                if (this.idcliente==0) this.errorMostrarMsjCredito.push("Seleccione un Cliente");               
                if (!this.numeroprestamo) this.errorMostrarMsjCredito.push("Ingrese el Codigo de Crédito");
                if (this.montodesembolsado==0) this.errorMostrarMsjCredito.push("El monto a desembolsar no puede ser 0");
                if (!this.fechadesembolso) this.errorMostrarMsjCredito.push("Seleccione una fecha de desembolso");
                if (this.numerocuotas==0) this.errorMostrarMsjCredito.push("Ingrese el número de cuotas");
                if (this.tipocambio==0) this.errorMostrarMsjCredito.push("Ingrese el tipo de cambio");
                if (this.tasa==0) this.errorMostrarMsjCredito.push("La tasa de interes no puede ser 0");

                //si al menos tenemosun error enotnces errorCredito=1
                if (this.errorMostrarMsjCredito.length) this.errorCredito = 1;

                return this.errorCredito;

            }
            
         },
         mounted(){
             this.codigoprestamo();
                this.cargarValores();
         }
      

    }
</script>
<style >

</style>