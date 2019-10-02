<template>
    <!--agregar un CREDITO-->
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
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="N° DNI">
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
                                <input type="number" class="form-control" v-model="tasa" placeholder="Número de Telefono">
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
                        <button type="submit " class="btn btn-warning mr-2 " @click="agregarCuotas()">
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
                        <template v-if="viewCuotas">
                        <button   type="submit " class="btn btn-primary mr-2 ">Registrar </button>
                        <button class="btn btn-light " @click="viewCuotas=false;limpiar()">Cancelar</button>
                        </template>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--fin de agregar un CREDITO-->    
    
</template>

<script>
    export default {
        data(){
            return{
                //datos de nuevo credito
                idcliente:0,
                numeroprestamo:'CZ-05',
                montodesembolsado:1000,
                numerocuotas:12,
                tasa:3.15,
                periodo:1,
                fechadesembolso:'2019-09-01',

                //arrary Credito
                newCredito:[],
                //array Cuotas
                newCuotas:[],


                //control de vistas
                viewAgregar:true,
                viewCuotas:false,
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
                this.numeroprestamo='';
                this.montodesembolsado=0; 
                this.numerocuotas=0; 
                this.tasa=0;               
                this.periodo=0;            
                this.fechadesembolso='';
                this.viewCuotas=false

            }
         }
      

    }
</script>
<style >

</style>