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
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Codigo de Credito">
                            </div>
                            <div class=" col-md-2 form-group">
                                <label for="exampleInputEmail1">Monto</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Monto en Soles">
                            </div>
                            <div class=" col-md-2 form-group">
                                <label for="exampleInputEmail1">N° Cuotas</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Número de Cuotas">
                            </div>
                            <div class=" col-md-2 form-group">
                                <label for="exampleInputEmail1">Tasa de Interés</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Número de Telefono">
                            </div>
                            <div class=" col-md-2 form-group">
                                <label for="exampleInputEmail1">Periodo</label>
                                <select class="form-control ">
                                        <option>Mensual</option>
                                        <option>Bimestral</option>
                                        <option>Trimestral</option>
                                        <option>Anual</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit " class="btn btn-primary mr-2 ">Generar Cotas </button>
                        <button class="btn btn-light ">Cancelar</button><br><br>

                        <div class="table-responsive">
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
                                <tbody>
                                    <tr>
                                        <td class="py-1"> 1</td>
                                        <td>12/05/2019</td>
                                        <td>650</td>
                                        <td>600</td>
                                        <td>50</td>
                                        <td>1200</td>

                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <button type="submit " class="btn btn-primary mr-2 ">Registrar </button>
                        <button class="btn btn-light ">Cancelar</button>
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
                numcredito:0,
                monto:0.0,
                ncuotas:0,
                tasa:0,
                periodo:0,

                //arrary Credito
                newCredito:[],
                //array Cuotas
                newCuotas:[],


                //control de vistas
                viewAgregar:true,
                }
        },
         methods :{}
      

    }
</script>
<style >

</style>