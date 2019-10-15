<template>
    <!--agregar un CREDITO-->
    <main>
    <template v-if="viewAgregar=='agregar'">
        <div class="row" >
            <button type="button" class="btn btn-warning"
                @click="viewAgregar='listar';limpiar();this.listarCreditos(1,buscar,criterio);">
                 <i class="mdi mdi-format-list-numbers mdi-18px "></i> Lista de Simulaciones
            </button> 
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row ">
                            <div class="col-md-12 mt-2 ">
                                <h4 class="card-title">
                                    <i class="mdi mdi-package-variant-closed mdi-36px"></i> Simulador de Creditos</h4>
                            
                            <hr></div>
                        </div>

                        <form class="forms-sample mt-4">
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label for="exampleInputUsername1">DNI del Cliente</label>
                                    <input type="text" class="form-control" v-model="dni" placeholder="Codigo de Credito">
                                </div>
                                <div class="col-md-8 form-group">
                                    <label for="exampleInputUsername1">Nombres y Apellidos del Cliente</label>
                                    <input type="text" class="form-control" v-model="nombresapellidos" 
                                    onkeyup="javascript:this.value=this.value.toUpperCase();" placeholder="Nombres y apellidos  completos ">
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
                                    <label for="exampleInputEmail1">Tasa de Interés</label>
                                    <input type="text"   class="form-control" v-model="tasa" placeholder="Número de Telefono">
                                </div>
                                <div class=" col-md-2 form-group">
                                    <label for="exampleInputEmail1">Periodo</label>
                                    <select class="form-control "  v-model="periodo"> 
                                        <option value="12" selected>Mensual</option>
                                        <option value="1">Anual</option>
                                        <option value="2">Semestral</option>
                                        <option value="4">Trimestral</option>
                                    </select>
                                </div>
                                <div class=" col-md-2 form-group">
                                    <label for="exampleInputEmail1">Fecha de Desembolso</label>
                                    <input type="date" class="form-control" v-model="fechadesembolso" placeholder="Número de Telefono">
                                </div>
                                <div class=" col-md-2 form-group">
                                    <label for="exampleInputEmail1">Fecha de Primera Cuota</label>
                                    <input type="date" class="form-control" v-model="fechaprimeracuota" placeholder="Número de Telefono">
                                </div>
                            </div>
                            <button type="button " class="btn btn-success mr-2 " @click.prevent="agregarCuotas()">
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
                                <button   type="button " class="btn btn-primary mr-2 " @click.prevent="registrarCredito()">Registrar  Simulación</button>
                                <button class="btn btn-light " @click="viewCuotas=false;limpiar()">Cancelar</button>
                            </template>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </template>

     <!--Detalle de un credito-->
    <template v-if="viewAgregar=='detalle'">
        <button type="button" class="btn btn-warning" @click="viewAgregar='agregar';limpiar()">
           <i class="mdi mdi mdi-plus-circle-multiple-outline  mdi-18px "></i> Nueva simulacion
        </button>   
         <button type="button" class="btn btn-warning" @click="viewAgregar='listar';limpiar();listarCreditos(1,buscar,criterio)">
           <i class="mdi mdi-format-list-numbers mdi-18px  "></i> Lista de Simulaciones
        </button>   
        
    <!--detalle de CREDITO-->
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h3>
                            Simulación de Préstamo
                        </h3>
                        <hr>
                        <h3 class="text-dark font-weight-bold">Información del Cliente</h3>
                        <p>Dni : {{dni}}</p>
                        <p>Nombres: {{nombresapellidos}}</p>
                        <hr>
                        <h3 class="text-dark font-weight-bold">Información del Crédito</h3>
                        
                        <p>Monto de Crédito: {{montodesembolsado}}</p>
                        <p>Tasa(TEA): {{tasa}} %</p>
                        <p>Número de Cuotas: {{numerocuotas}} %</p>
                        <p v-if="periodo==1" >Periodo: Anual </p>
                    
                          <p v-else-if="periodo==4" >Periodo: Trimestral </p>
                           <p v-else-if="periodo==6" >Periodo: Semestral </p>
                            <p v-else-if="periodo==12" >Periodo: Mensual </p>
                        <hr>
                        <button class="btn  btn-success" @click="proforma()">Descargar Tabla de amortización</button>
                    </div>
                </div>
            </div>
        </div>       
    </template>

    <template v-if="viewAgregar=='listar'">
         <button type="button" class="btn btn-warning" @click="viewAgregar='agregar';limpiar()">
           <i class="mdi  mdi-plus-circle-multiple-outline mdi-24px "></i> Nueva simulacion
        </button>  
        <div class="row">
             <div class="col-lg-12 grid-margin stretch-card ">
                                <div class="card ">
                                    <div class="card-body ">
                                        <h4 class="card-title ">Lista de Simulaciones de Créditos</h4>
                                        <p class="card-description ">
                                            Información de simulaciones de Créditos 
                                        </p>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6">
                                                <div class="input-group">
                                                    <select class="form-control col-md-12" v-model="criterio">
                                                        <option value="dni">DNI de Solicitante</option>
                                                        <option value="nombresapellidos">Nombres de Clientes</option>
                                                        
                                                    </select>
                                                    <input type="text" v-model="buscar" @keyup.enter="listarCreditos(1,buscar,criterio)" 
                                                    class="form-control form-control-lg" placeholder="Texto a buscar">
                                                    <button type="submit" @click="listarCreditos(1,buscar,criterio)" 
                                                    class="btn btn-outline-primary btn-sm"><i class="fa fa-search"></i>  <i class="mdi mdi-magnify"></i> Buscar</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive pt-3 ">
                                            <table class="table table-bordered ">
                                                <thead>
                                                    <tr class="bg bg-success text-white ">
                                                        
                                                        <th> Opciones</th>
                                                        <th> # </th>
                                                    
                                                        <th> Monto Capital</th>
                                                        <th> Tasa de Interes</th>
                                                         <th>Periodo </th>
                                                        
                                                        <th> N° Cuotas </th>
                                                        <th> DNI Cliente </th>
                                                        <th> Nombres del  Cliente </th>
                                                       

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="c in arrayCreditos" :key="c.id">
                                                        
                                                        <td>
                                                            <!--detalle de credito-->
                                                            <button type="button" @click="viewDetalle=true;idcredito=c.id;viewLista=false" class="btn btn-success btn-rounded btn-icon ">
                                                                    <i class="mdi mdi-eye "></i>
                                                            </button>
                                                           <button type="button" @click="proforma(c.id)" class="btn btn-danger btn-rounded btn-icon ">
                                                                    <i class="mdi mdi-file-pdf "></i>
                                                            </button>
                                                        </td>
                                                        <td>{{c.id}}</td>
                                                      
                                                       
                                                        <td v-text="'S/ '+c.montodesembolsado"></td>
                                                            <td v-text="c.tasa+' %'"></td>

                                                          <td v-if="c.periodo==12">Mensual</td>
                                                           <td v-else-if="c.periodo==1">Anual</td>
                                                            <td v-else-if="c.periodo==6">Semestral</td>
                                                             <td v-else-if="c.periodo==4">Trimestral</td>
                                                        
                                                        <td v-text="c.numerocuotas"></td>

                                                        <td v-text="c.dni"></td>
                                                        <td v-text="c.nombresapellidos"></td>
                                                        
                                                       

                                                    </tr>
                                                    
                                                </tbody>
                                            </table>
                                              <nav>
                                <ul class="pagination">
                                    <li class="page-item" v-if="pagination.current_page > 1">
                                        <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Anterior</a>
                                    </li>
                                    <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                        <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                                    </li>
                                    <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                        <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Siguiente</a>
                                    </li>
                                </ul>
                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
           
    </template>
  
    
    </main>
    <!--fin de agregar un CREDITO-->    
    
</template>

<script>
   
    export default {
       
        data(){
            return{
                //datos de nuevo credito
                ruta:'http://127.0.0.1:8000',
                idcliente:0,
               
                montodesembolsado:1000,
                numerocuotas:12,
                tasa:13,
                periodo:12,
                fechadesembolso:'2019-09-01',
                fechaprimeracuota:'2019-09-01',

                //arrary Credito
                newCredito:[],
                //array Cuotas
                newCuotas:[],
                //aarayClientes
                arrayCliente:[],


              
               dni:'70212063',
               nombresapellidos:'JOSE LUIS RAMIREZ QUIROZ',
               


                //control de vistas
                viewAgregar:'listar',
                viewCuotas:false,
                verlista:false,
                
                //Control de errores
                 errorCredito:0,
                errorMostrarMsjCredito :[],



                arrayAuxliar:[],
                arrayCreditos:[],
                idcredito:0,


                  pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'dni',
                buscar : '',

                }
        },
         
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            //Calcula los elementos de la paginación
            pagesNumber: function() {
                if(!this.pagination.to) {
                    return [];
                }
                
                var from = this.pagination.current_page - this.offset; 
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2); 
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }  

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;             

            }
        },
         methods :{
            cambiarPagina(page,buscar,criterio)
            {
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarCreditos(page,buscar,criterio);
            },

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
                    var pe=periodofecha
                    var dia=me.fechadesembolso.substr(-2)
                    var unmesmas = this.editar_fecha(me.fechadesembolso, periodofecha, "m");

                  
                                       
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
                        }

                       
                        if(K!=0){
                        pe= parseInt(pe)+parseInt(periodofecha);
                        unmesmas = this.editar_fecha(me.fechadesembolso, pe, "m");}
                    
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
            limpiar(){
               
                this.montodesembolsado=0; 
                this.numerocuotas=0; 
                this.tasa=0;               
                this.periodo=12;            
                this.fechadesembolso='';
                this.idcliente=0,
                this.viewCuotas=false

            },

            registrarCredito(){
                if (this.validarCredito()){ return; }
                
                let me = this;
                Swal.fire({
                    title: 'Registrar Simulación',
                    text: "",
                    type: 'success',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                     cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Si'
                    }).then((result) => {
                    if (result.value) {
                       axios.post(this.ruta+'/simulacion/guardarSimulacion',{
                                                  
                        'montodesembolsado': this.montodesembolsado,
                        'fechadesembolso' : this.fechadesembolso, 
                        'fechaprimeracuota' : this.fechaprimeracuota,                                 
                        'numerocuotas' : this.numerocuotas,
                       
                        'tasa' : this.tasa,
                        'periodo' : this.periodo,
                        'dni' : this.dni,
                        'nombresapellidos' : this.nombresapellidos,
                      
                        }).then(function (response) {

                        Swal.fire(
                        'Credito Registrado', 
                        'Correctamente',
                        'success'
                        )  
                          let respuesta= response.data;
                          me.idcredito=respuesta.idcredito;
                         me.viewAgregar='detalle';
                               
                      }).catch(function (error) {
                                console.log(error);
                            });
                    }
                 })
            },
            validarCredito(){
                this.errorCredito=0;
                this.errorMostrarMsjCredito =[];

                if (!this.dni) this.errorMostrarMsjCredito.push("Ingrese DNI de cliente solicitante");  
                if (!this.nombresapellidos) this.errorMostrarMsjCredito.push("Ingrese Nmobres y Apellidos del cliente solicitante");                 
                 if (this.montodesembolsado==0) this.errorMostrarMsjCredito.push("El monto a desembolsar no puede ser 0");
                if (!this.fechadesembolso) this.errorMostrarMsjCredito.push("Seleccione una fecha de desembolso");
                if (!this.fechaprimeracuota) this.errorMostrarMsjCredito.push("Seleccione una fecha de la primera cuota");
                if (this.numerocuotas==0) this.errorMostrarMsjCredito.push("Ingrese el número de cuotas");
                if (this.tipocambio==0) this.errorMostrarMsjCredito.push("Ingrese el tipo de cambio");
                if (this.tasa==0) this.errorMostrarMsjCredito.push("La tasa de interes no puede ser 0");

                //si al menos tenemosun error enotnces errorCredito=1
                if (this.errorMostrarMsjCredito.length) this.errorCredito = 1;

                return this.errorCredito;

            },
             listarCreditos (page,buscar,criterio)
            {
                let me=this;
                me.listado=2;
                var url= 'simulacion/listaSilumaciones?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayCreditos = respuesta.simulaciones.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
              proforma(id){
                window.open('/simulacion/pdfDetallecredito/'+id+'','_blank');
            },
            
         },
          mounted() {
            this.listarCreditos(1,this.buscar,this.criterio);
          
    }
      

    }
</script>
<style >

</style>