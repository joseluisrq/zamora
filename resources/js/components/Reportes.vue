<template>
 <main>     

<!--CREDITOS-->
    <template>
        <div class="row">
            <div class="col-md-12 card bg bg-info">
                <h2 class="text-white">Créditos</h2>
            </div>
        </div>
        <!--seccion 02-->
        <div class="row  mt-4">
             <div class="col-md-12">
               <h3 class="text-primary font-weight-bold">Cantidad de Créditos</h3> 
            </div>
            <div class="col-lg-2 grid-margin stretch-card ">
                <div class="card ">
                    <div class="card-body pb-0 ">
                        <div class="d-flex align-items-center justify-content-between ">
                            <h2 class="text-success font-weight-bold ">{{totalcreditos}}</h2>
                            <i class="mdi mdi-account-outline mdi-18px text-dark "></i>                           
                        </div>
                         <p class="text-dark font-weight-bold">Total de Créditos</p>
                    </div>     
                </div>
            </div>
            <div class="col-lg-2 grid-margin stretch-card ">
                <div class="card ">
                    <div class="card-body pb-0 ">
                        <div class="d-flex align-items-center justify-content-between ">
                            <h2 class="text-danger font-weight-bold ">{{enproceso}}</h2>
                            <i class="mdi mdi-refresh mdi-18px text-dark "></i>
                        </div>
                        <p class="text-dark font-weight-bold">Creditos en Proceso</p>                   </div>                  
                    
                </div>
            </div>
            <div class="col-lg-2 grid-margin stretch-card ">
                <div class="card ">
                    <div class="card-body pb-0 ">
                        <div class="d-flex align-items-center justify-content-between ">
                            <h2 class="text-info font-weight-bold ">{{terminados}}</h2>
                            <i class="mdi mdi-file-document-outline mdi-18px text-dark "></i>
                        </div>
                         <p class="text-dark font-weight-bold">Creditos Terminados</p>   
                    </div>                   
                
                </div>
            </div>
            <div class="col-lg-2 grid-margin stretch-card ">
                <div class="card ">
                    <div class="card-body pb-0 ">
                        <div class="d-flex align-items-center justify-content-between ">
                            <h2 class="text-warning font-weight-bold ">{{rechazados}}</h2>
                            <i class="mdi mdi-folder-outline mdi-18px text-dark "></i>
                        </div>
                          <p class="text-dark font-weight-bold">Creditos Rechazados</p>
                    </div>
                  
                  
                </div>
            </div>
         
         
        </div>
        <div class="row">
            <div class="col-md-12">
               <h3 class="text-primary font-weight-bold">Desembolso de Créditos</h3> 
            </div>
               <div class="col-lg-2 grid-margin stretch-card ">
                <div class="card ">
                    <div class="card-body pb-0 ">
                        <div class="d-flex align-items-center justify-content-between ">
                            <h2 class="text-dark font-weight-bold ">{{creditoDes}}</h2>
                            <i class="mdi mdi-cash text-dark mdi-18px "></i>
                        </div>
                         <p class="text-dark font-weight-bold">Créditos Desembolsados</p>
                    </div>
                   
                    
                </div>
            </div>
               <div class="col-lg-2 grid-margin stretch-card ">
                <div class="card ">
                    <div class="card-body pb-0 ">
                        <div class="d-flex align-items-center justify-content-between ">
                            <h2 class="text-secondary font-weight-bold ">{{creditoporDes}}</h2>
                            <i class="mdi mdi-cart-outline mdi-18px text-dark "></i>
                        </div>
                        <p class="text-dark font-weight-bold">Creditos por Desembolsar</p>
                    </div>                   
                
                </div>
            </div>
        </div>
         <!--fin seccion 2-->

        <!-- Sesccion 3-->
        <div class="row ">
            <div class="col-sm-6 grid-margin grid-margin-md-0 stretch-card ">
                <div class="card ">
                    <div class="card-body ">
                        <div class="d-flex align-items-center justify-content-between ">
                            <h4 class="card-title ">Desembolsos de Créditos por Mes</h4>
                            <h4 class="text-success font-weight-bold ">Año<span class="text-dark ml-3 ">{{ano}}</span></h4>
                        </div>
                        <div id="support-tracker-legend " class="support-tracker-legend "></div>
                        <canvas id="desembolsos"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 grid-margin grid-margin-md-0 stretch-card ">
                <div class="card ">
                    <div class="card-body ">
                        <div class="d-flex align-items-center justify-content-between ">
                            <h4 class="card-title ">Canitdad de Desembolsos de Créditos por Mes</h4>
                            <h4 class="text-success font-weight-bold ">Año<span class="text-dark ml-3 ">{{ano}}</span></h4>
                        </div>
                        <div id="support-tracker-legend " class="support-tracker-legend "></div>
                        <canvas id="desembolsospormes"></canvas>
                    </div>
                </div>
            </div>
         
        </div>
         <!--fin seccion 3-->
    </template>
<!--FIN CREDITOS-->

<!--Cuentas de Ahorroo-->
   <template>
         <!--seccion 04-->
        <div class="row mt-4">
            <div class="col-md-12 card bg bg-info">
                <h2 class="text-white">Cuentas de Ahorro</h2>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-3 grid-margin stretch-card ">
                <div class="card ">
                    <div class="card-body pb-0 ">
                        <div class="d-flex align-items-center justify-content-between ">
                            <h2 class="text-success font-weight-bold">{{  ahorros_activos }}</h2>
                        </div>
                         <p class="text-dark font-weight-bold">Cuentas de Ahorro Activas</p>
                    </div>     
                </div>
            </div>
            <div class="col-lg-3 grid-margin stretch-card ">
                <div class="card ">
                    <div class="card-body pb-0 ">
                        <div class="d-flex align-items-center justify-content-between ">
                            <h2 class="text-danger font-weight-bold">{{  ahorros_inactivos }}</h2>
                        </div>
                         <p class="text-dark font-weight-bold">Cuentas de Ahorro Canceladas</p>
                    </div>     
                </div>
            </div>
            <div class="col-lg-3 grid-margin stretch-card ">
                <div class="card ">
                    <div class="card-body pb-0 ">
                        <div class="d-flex align-items-center justify-content-between ">
                            <h2 class="text-info font-weight-bold">S/ {{  montos_ahorros }}</h2>
                        </div>
                         <p class="text-dark font-weight-bold">Monto en las cuentas de ahorro</p>
                    </div>     
                </div>
            </div>
            <div class="col-lg-3 grid-margin stretch-card ">
                <div class="card ">
                    <div class="card-body pb-0 ">
                        <div class="d-flex align-items-center justify-content-between ">
                            <h2 class="text-warning font-weight-bold">S/ {{  interes_ganado_ahorros }}</h2>
                        </div>
                         <p class="text-dark font-weight-bold">Interes ganados de Cuentas de Ahorro</p>
                    </div>     
                </div>
            </div>     
        </div>
        <div class="row  mt-4">
            <div class="col-lg-3 grid-margin stretch-card ">
                <div class="card ">
                    <div class="card-body pb-0 ">
                        <div class="d-flex align-items-center justify-content-between ">
                            <h2 class="text-success font-weight-bold">{{  plazofijo_activos }}</h2>
                        </div>
                         <p class="text-dark font-weight-bold">Cuentas a Plazo Fijo Activas</p>
                    </div>     
                </div>
            </div>
            <div class="col-lg-3 grid-margin stretch-card ">
                <div class="card ">
                    <div class="card-body pb-0 ">
                        <div class="d-flex align-items-center justify-content-between ">
                            <h2 class="text-danger font-weight-bold">{{  plazofijo_inactivos }}</h2>
                        </div>
                         <p class="text-dark font-weight-bold">Cuentas a Plazo Fijo Canceladas</p>
                    </div>     
                </div>
            </div>
            
            <div class="col-lg-3 grid-margin stretch-card ">
                <div class="card ">
                    <div class="card-body pb-0 ">
                        <div class="d-flex align-items-center justify-content-between ">
                            <h2 class="text-info font-weight-bold">S/ {{  montos_plazofijo }}</h2>
                        </div>
                         <p class="text-dark font-weight-bold">Monto de cuentas de Plazo Fijo</p>
                    </div>     
                </div>
            </div>
            <div class="col-lg-3 grid-margin stretch-card ">
                <div class="card ">
                    <div class="card-body pb-0 ">
                        <div class="d-flex align-items-center justify-content-between ">
                            <h2 class="text-warning font-weight-bold">S/ {{  interes_ganado_plazofijo }}</h2>
                        </div>
                         <p class="text-dark font-weight-bold">Interés ganado Plazo Fijo</p>
                    </div>     
                </div>
            </div>
        </div>
    </template>
         <!--fin seccion 4-->
<!--fin cuentas de ahorro-->

<!--Cajas-->
    <template>
        <div class="row">
            <div class="col-md-12 card bg bg-info">
                <h2 class="text-white">Cajas</h2>
            </div>
        </div>
        <!--seccion 02-->
        <div class="row  mt-4">
             
            <div class="col-lg-4 grid-margin stretch-card ">
                <div class="card ">
                    <div class="card-body pb-0 ">
                        <div class="d-flex align-items-center justify-content-between ">
                            <h2 class="text-success font-weight-bold ">{{totalcajas}}</h2>
                             <button class="btn btn-danger" @click="TodaslasCajas()">Detalle Pdf</button>
                            <i class="mdi mdi-account-outline mdi-18px text-dark "></i>                           
                        </div>
                         <p class="text-dark font-weight-bold">Total de Cajas</p>
                    </div>     
                </div>
            </div>
            <div class="col-lg-4 grid-margin stretch-card ">
                <div class="card ">
                    <div class="card-body pb-0 ">
                        <div class="d-flex align-items-center justify-content-between ">
                            <h2 class="text-danger font-weight-bold ">{{cajasabiertas}}</h2>                           
                            <i class="mdi mdi-refresh mdi-18px text-dark "></i>
                        </div>
                        <p class="text-dark font-weight-bold">Cajas Abiertas</p>                   </div>                  
                    
                </div>
            </div>   
         
        </div>
       
         <!--fin seccion 2-->

        <!-- Sesccion 3
        <div class="row ">
            <div class="col-sm-6 grid-margin grid-margin-md-0 stretch-card ">
                <div class="card ">
                    <div class="card-body ">
                        <div class="d-flex align-items-center justify-content-between ">
                            <h4 class="card-title ">Desembolsos de Créditos por Mes</h4>
                            <h4 class="text-success font-weight-bold ">Año<span class="text-dark ml-3 ">{{ano}}</span></h4>
                        </div>
                        <div id="support-tracker-legend " class="support-tracker-legend "></div>
                        <canvas id="desembolsos"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 grid-margin grid-margin-md-0 stretch-card ">
                <div class="card ">
                    <div class="card-body ">
                        <div class="d-flex align-items-center justify-content-between ">
                            <h4 class="card-title ">Canitdad de Desembolsos de Créditos por Mes</h4>
                            <h4 class="text-success font-weight-bold ">Año<span class="text-dark ml-3 ">{{ano}}</span></h4>
                        </div>
                        <div id="support-tracker-legend " class="support-tracker-legend "></div>
                        <canvas id="desembolsospormes"></canvas>
                    </div>
                </div>
            </div>
         
        </div>
         fin seccion 3-->
    </template>
<!--FIN cajas-->
<!--SOcios-->
  <template>
        <div class="row">
            <div class="col-md-12 card bg bg-info">
                <h2 class="text-white">Socios</h2>
            </div>
        </div>
        <!--seccion 02-->
        <div class="row  mt-4">
             
            <div class="col-lg-4 grid-margin stretch-card ">
                <div class="card ">
                    <div class="card-body pb-0 ">
                        <div class="d-flex align-items-center justify-content-between ">
                            <h2 class="text-success font-weight-bold ">{{sociosactivos}}</h2>
                               <button class="btn btn-danger" @click="SociosPdf(1)">Detalle Pdf</button>
                           
                               <i class="mdi mdi-account-outline mdi-18px text-dark "></i>                           
                        </div>
                         <p class="text-dark font-weight-bold">Socios Activos</p>
                    </div>     
                </div>
            </div>
            <div class="col-lg-4 grid-margin stretch-card ">
                <div class="card ">
                    <div class="card-body pb-0 ">
                        <div class="d-flex align-items-center justify-content-between ">
                            <h2 class="text-danger font-weight-bold ">{{sociosinactivos}}</h2>                           
                            <i class="mdi mdi-refresh mdi-18px text-dark "></i>
                              <button class="btn btn-danger" @click="SociosPdf(0)">Detalle Pdf</button>
                           
                        </div>
                        <p class="text-dark font-weight-bold">Socios Inactivos</p>
                                           </div>                  
                    
                </div>
            </div>   
                <div class="col-lg-4 grid-margin stretch-card ">
                <div class="card ">
                    <div class="card-body pb-0 ">
                        <div class="d-flex align-items-center justify-content-between ">
                            <h2 class="text-danger font-weight-bold ">{{sociosconcreditos}}</h2>                           
                            <i class="mdi mdi-refresh mdi-18px text-dark "></i>
                        </div>
                        <p class="text-dark font-weight-bold">Socios con Crédito</p>                   </div>                  
                    
                </div>
            </div>
         
        </div>
    </template>
<!--fin socios-->

 </main> 
</template>

<script>
    export default {
        props:['ruta'],
        data(){
            return{
                varDesembolsos:null,
                charDesembolso:null,
                desembolsos:[],
                varTotalDesembolsos:[],
                varMesDesembolsos:[],

                 cvarDesembolsos:null,
                ccharDesembolso:null,
                cdesembolsos:[],
                cvarTotalDesembolsos:[],
                cvarMesDesembolsos:[],

                ano:'1993',

                enproceso:0,
                rechazados:0,
                terminados:0,
                totalcreditos:0,


                creditoporDes:0,
                creditoDes:0,


                ahorros_activos: 0,
                ahorros_inactivos: 0,
                plazofijo_activos: 0,
                plazofijo_inactivos: 0,

                montos_ahorros: 0,
                interes_ganado_ahorros: 0,

                montos_plazofijo: 0,
                interes_ganado_plazofijo: 0,




                //cajas
                totalcajas:0,
                cajasabiertas:0,

                //socios
                sociosactivos:0,
                sociosinactivos:0,
                sociosconcreditos:0,
                sociosconcreditosatrasados:0,
                
            }
        },
        methods:{
            getDesembolsos(){
                 let me=this;
                 var url=me.ruta+'/reportes';
                 axios.get(url).then(function(response){
                     var respuesta=response.data;

                     //cantidad de creditos
                     me.enproceso=respuesta.enproceso;
                     me.rechazados=respuesta.rechazados;
                     me.terminados=respuesta.terminados;

                    //total de creditos
                     me.totalcreditos=respuesta.totalcreditos;

                    //desembolsos/ sin desembolsar
                     me.creditoDes=respuesta.creditoDes;
                     me.creditoporDes=respuesta.creditoporDes;


                     //para el grafico de monto desembolsos por mes
                     me.desembolsos=respuesta.desembolsos;
                    
                     //para el grafico de cantidad de desembolsos por mes
                     me.cdesembolsos=respuesta.creditospormes;
                     me.ano=respuesta.ano

                     //cajas
                     me.totalcajas=respuesta.totalcajas;
                     me.cajasabiertas=respuesta.cajasabiertas;

                     //socios
                     me.sociosactivos=respuesta.sociosactivos;
                     me.sociosinactivos=respuesta.sociosinactivos;
                     me.sociosconcreditos=respuesta.sociosconcreditos;

                     //cargamos los datos al chart
                     me.loadDesembolsos();

                     me.loadCreditpsporMes();

                 })
                 .catch(function(error){
                     console.log(error);
                 });
            },
            loadDesembolsos(){
                 let me=this;
                 me.desembolsos.map(function(x){
                     if(x.mes==1)me.varMesDesembolsos.push('Enero');
                     else if(x.mes==2)me.varMesDesembolsos.push('Febrero');
                     else if(x.mes==3)me.varMesDesembolsos.push('Marzo');
                     else if(x.mes==4)me.varMesDesembolsos.push('Abril');
                     else if(x.mes==5)me.varMesDesembolsos.push('Mayo');
                     else if(x.mes==6)me.varMesDesembolsos.push('Junio');
                     else if(x.mes==7)me.varMesDesembolsos.push('Julio');
                     else if(x.mes==8)me.varMesDesembolsos.push('Agosto');
                    else if(x.mes==9)me.varMesDesembolsos.push('Setiembre');
                    else if(x.mes==10)me.varMesDesembolsos.push('Octubre');
                    else if(x.mes==11)me.varMesDesembolsos.push('Noviembre');
                    else if(x.mes==12)me.varMesDesembolsos.push('Diciembre');

                     
                     //me.varMesDesembolsos.push(x.mes);
                     me.varTotalDesembolsos.push(x.total);

                 });
                 me.varDesembolsos=document.getElementById('desembolsos').getContext('2d');

                 me.charDesembolso = new Chart(me.varDesembolsos, {
                    type: 'bar',
                    data: {
                        labels: me.varMesDesembolsos,
                        datasets: [{
                            label: 'Desembolsos',
                            data: me.varTotalDesembolsos,
                            backgroundColor: 
                                'rgba(75, 192, 192, 0.2)',                              
                              
                              
                            borderColor: 
                                'rgba(75, 192, 192, 0.2)',
                              
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            
            
            
            },
            TodaslasCajas(){
                  let me=this;
                  window.open(me.ruta + '/cajas/pdfReportecajas','_blank');

         
            },
            SociosPdf(id){
                 let me=this; 
                  window.open(me.ruta + '/persona/pdfreportesociosactivos/'+id,'_blank');

            },
            loadCreditpsporMes(){
                 let me=this;
                 me.cdesembolsos.map(function(x){
                     if(x.mes==1)me.varMesDesembolsos.push('Enero');
                     else if(x.mes==2)me.cvarMesDesembolsos.push('Febrero');
                     else if(x.mes==3)me.cvarMesDesembolsos.push('Marzo');
                     else if(x.mes==4)me.cvarMesDesembolsos.push('Abril');
                     else if(x.mes==5)me.cvarMesDesembolsos.push('Mayo');
                     else if(x.mes==6)me.cvarMesDesembolsos.push('Junio');
                     else if(x.mes==7)me.cvarMesDesembolsos.push('Julio');
                     else if(x.mes==8)me.cvarMesDesembolsos.push('Agosto');
                    else if(x.mes==9)me.cvarMesDesembolsos.push('Setiembre');
                    else if(x.mes==10)me.cvarMesDesembolsos.push('Octubre');
                    else if(x.mes==11)me.cvarMesDesembolsos.push('Noviembre');
                    else if(x.mes==12)me.cvarMesDesembolsos.push('Diciembre');

                     
                     //me.varMesDesembolsos.push(x.mes);
                     me.cvarTotalDesembolsos.push(x.total);

                 });
                 me.cvarDesembolsos=document.getElementById('desembolsospormes').getContext('2d');

                 me.ccharDesembolso = new Chart(me.cvarDesembolsos, {
                    type: 'bar',
                    data: {
                        labels: me.cvarMesDesembolsos,
                        datasets: [{
                            label: 'Cantidad de Desembolsos',
                            data: me.cvarTotalDesembolsos,
                            backgroundColor: 
                                'rgba(255, 99, 132, 0.2)',
                              
                            borderColor: 
                                'rgba(255, 99, 132, 1)',
                              
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            
            
            
            },
               cargarReporteCuentas(){
                let me=this;
                var url=me.ruta+'/ahorro/reporte';
                axios.get(url).then(function(response){
                    var respuesta = response.data;

                    me.ahorros_activos = respuesta.ahorros_activos;
                    me.ahorros_inactivos = respuesta.ahorros_inactivos;
                    me.plazofijo_activos = respuesta.plazofijo_activos;
                    me.plazofijo_inactivos = respuesta.plazofijo_inactivos;

                    me.montos_ahorros = respuesta.montos_ahorros;
                    me.interes_ganado_ahorros = respuesta.interes_ganado_ahorros;

                    me.montos_plazofijo = respuesta.montos_plazofijo;
                    me.interes_ganado_plazofijo = respuesta.interes_ganado_plazofijo;
                 })
                 .catch(function(error){
                     console.log(error);
                 });
            }


        },
        mounted() {
          this.getDesembolsos();
          this.cargarReporteCuentas();
        }
    }
</script>
