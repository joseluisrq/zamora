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
                                <label for="exampleInputUsername1">Ingrese DNI 
                                </label>
                                <v-select
                                    :on-search="selectCliente"
                                            label="dni"
                                            :options="arrayCliente"
                                            placeholder="Ingrese DNI del cliente..."
                                            :onChange="getDatosCliente"     
                                    >
                                    </v-select>
                                    <div v-if="idcliente!=0">
                                        <label class="badge badge-dark" v-text="nombre+' '+apellidos">

                                        </label>
                                    </div>
                            </div>
                            <div class="col-md-3"></div>
                            <div class="col-md-3 form-group">
                                <label for="exampleInputUsername1">Si el socio no esta registrado </label>
                                <br><button class="btn btn-success "> <i class="mdi mdi-clipboard-account"></i>  Agregar Socio</button>
                            </div>
                            <div class="col-md-2 form-group">
                                <label for="exampleInputUsername1">Codigo de Crédito</label>
                                <input type="text" class="form-control" v-model="numeroprestamo" placeholder="Codigo de Credito">
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
        <button type="button" class="btn btn-warning" @click="viewAgregar==true;limpiar()">
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
       
        data(){
            return{
                //datos de nuevo credito
                ruta:'http://127.0.0.1:8000',
                idcliente:0,
                numeroprestamo:'CZ-05',
                montodesembolsado:1000,
                numerocuotas:12,
                tasa:13,
                periodo:1,
                fechadesembolso:'2019-09-01',

                //arrary Credito
                newCredito:[],
                //array Cuotas
                newCuotas:[],
                //aarayClientes
                arrayCliente:[],


              
               dni:'',
               nombre:'',
               apellidos:'',


                //control de vistas
                viewAgregar:true,
                viewCuotas:false,
                
                //Control de errores
                 errorCredito:0,
                errorMostrarMsjCredito :[]
                }
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
                this.numeroprestamo='';
                this.montodesembolsado=0; 
                this.numerocuotas=0; 
                this.tasa=0;               
                this.periodo=0;            
                this.fechadesembolso='';
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
                        'fechadesembolso' : this.fechadesembolso,                               
                        'numerocuotas' : this.numerocuotas,
                       
                        'tasa' : this.tasa,
                        'periodo' : this.periodo,
                        'idcliente' : this.idcliente,
                        'data':this.newCuotas    
                        }).then(function (response) {

                        Swal.fire(
                        'CREDITO REGISTRADO', 'El credito ha sido registrado correctamente',
                        'success'
                        )  
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
            
         }
      

    }
</script>
<style >

</style>