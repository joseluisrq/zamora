<template>
    <!--agregar un CREDITO-->
    <main>
    <template v-if="viewAgregar=='agregar'">
        <div class="row" >
            <button type="button" class="btn btn-warning" @click="viewAgregar='listar';limpiar()">
            <i class="mdi mdi-arrow-left-bold"></i> Lista de Simulaciones
            </button> 
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row bg bg-dark">
                            <div class="col-md-12 mt-2 text-white">
                                <h4>
                                    <i class="mdi mdi-package-variant-closed mdi-36px"></i> Simulador de Crédito</h4>
                            </div>
                        </div>

                        <form class="forms-sample mt-4">
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label for="exampleInputUsername1">DNI del Cliente</label>
                                    <input type="text" class="form-control" v-model="dni" placeholder="Codigo de Credito">
                                </div>
                                <div class="col-md-8 form-group">
                                    <label for="exampleInputUsername1">Nombres y Apellidos del Cliente</label>
                                    <input type="text" class="form-control" v-model="nombresapellidos" placeholder="Nombres y apellidos  completos ">
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
                                        <option value="1">Mensual</option>
                                            <option value="2">Bimestral</option>
                                            <option value="3">Trimestral</option>
                                            <option value="6">Semestral</option>
                                            <option value="12">Anual</option>
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
                            <button type="button " class="btn btn-warning mr-2 " @click.prevent="agregarCuotas()">
                                <i class="mdi mdi-arrange-send-to-back mdi-24px"></i> Generar Cuotas 
                            </button>
                        

                            <div class="table-responsive" v-if="viewCuotas">
                                <table class="table  table-bordered">
                                    <thead class="table-info text-white">
                                        <tr>
                                            <th>Cuota </th>
                                            <th>Fecha de Pago </th>
                                            <th>Monto de Cuota </th>
                                            <th> Capital </th>
                                            <th> Interés </th>
                                            <th> Saldo </th>


                                        </tr>
                                    </thead>
                                    <tbody v-if="newCuotas.length">
                                        <tr v-for="c in newCuotas" :key="c.id">
                                            <td class="py-1">{{c.contador}}</td>
                                            <td v-text="c.fechapago"></td>
                                            <td v-text="c.monto"></td>
                                            <td v-text="c.monto"></td>
                                            <td v-text="c.monto"></td>
                                            <td v-text="c.saldopendiente"></td>
                                            

                                        </tr>

                                    </tbody>
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
           <i class="mdi mdi-arrow-left-bold"></i> Nueva simulacion
        </button>   
         <button type="button" class="btn btn-warning" @click="viewAgregar='listar';limpiar()">
           <i class="mdi mdi-arrow-left-bold"></i> Lista de Simulaciones
        </button>   
        
    <!--detalle de CREDITO-->
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h1>
                            Simulación de Préstamo
                        </h1>
                        <hr>
                        <h3 class="text-dark font-weight-bold">Información del Cliente</h3>
                        <p>Dni : {{dni}}</p>
                        <p>Nombres: {{nombresapellidos}}</p>
                        <hr>
                        <h3 class="text-dark font-weight-bold">Información del Crédito</h3>
                        
                        <p>Monto de Crédito: {{montodesembolsado}}</p>
                        <p>Tasa(TEA): {{tasa}} %</p>
                        <p>Número de Cuotas: {{numerocuotas}} %</p>
                        <p v-if="periodo==1" >Periodo: Mensual </p>
                         <p v-else-if="periodo==2" >Periodo: Bimestral </p>
                          <p v-else-if="periodo==3" >Periodo: Trimestral </p>
                           <p v-else-if="periodo==6" >Periodo: Semestral </p>
                            <p v-else-if="periodo==12" >Periodo: Anual </p>
                        <hr>
                        <button class="btn  btn-success">Descargar Tabla de amortización</button>
                    </div>
                </div>
            </div>
        </div>       
    </template>

    <template v-if="viewAgregar=='listar'">
         <button type="button" class="btn btn-warning" @click="viewAgregar='agregar';limpiar()">
           <i class="mdi mdi-arrow-left-bold"></i> Nueva simulacion
        </button>  
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
                periodo:1,
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
                idcredito:0
                }
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
                    var montotal=this.montodesembolsado; 
                    var contadoraux=1;
                    //cuota neta
                    var cuotaneta=(this.montodesembolsado/this.numerocuotas).toFixed(2);
                    //saldo pendienteneto =monto desembolsado- montopor cuota
                    var saldop=(parseFloat(this.montodesembolsado)-parseFloat(cuotaneta)).toFixed(2);
                
                     //FECHA
                    var e = new Date(me.fechadesembolso);
                    var pe=me.periodo
                   // var dia=e.getDate();//
                    var dia=me.fechadesembolso.substr(-2)
                    var unmesmas = this.editar_fecha(me.fechadesembolso, me.periodo, "m");

                    for (let i = 0; i < me.numerocuotas; i++) { 
                    
                    if((i+1)==me.numerocuotas)saldop=0;
                   

                    me.newCuotas.push({
                        //(monto total+tasa)/cantidadde cuotas
                    
                        monto:cuotaneta,
                        fechapago:unmesmas,
                        saldopendiente:saldop,
                        otroscostos:0.0,
                        descripcion:'',
                        contador:contadoraux,

                    
                    })

                    saldop=(parseFloat(saldop)-parseFloat(cuotaneta)).toFixed(2);
                    contadoraux++;
                    pe= parseInt(pe)+parseInt(me.periodo);
                    unmesmas = this.editar_fecha(me.fechadesembolso, pe, "m");
                    }
    
                    this.viewCuotas=true;

                 }//fin del else
               
            },
            limpiar(){
               
                this.montodesembolsado=0; 
                this.numerocuotas=0; 
                this.tasa=0;               
                this.periodo=0;            
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

            }
            
         }
      

    }
</script>
<style >

</style>