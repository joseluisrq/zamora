<template>
    <main>
        <!--seccion 1
        <div class="row">
            <div class="card ">
                <div class="card-body ">
                    <div class="row ">
                        <div class="col-lg-4 ">
                            <h4 class="card-title ">Sales Difference</h4>
                            <canvas id="salesDifference "></canvas>
                            <p class="mt-3 mb-4 mb-lg-0 ">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            </p>
                        </div>
                        <div class="col-lg-5 ">
                            <h4 class="card-title ">Best Sellers</h4>
                            <div class="row ">
                                <div class="col-sm-4 ">
                                    <ul class="graphl-legend-rectangle ">
                                        <li><span class="bg-danger "></span>Automotive</li>
                                        <li><span class="bg-warning "></span>Books</li>
                                        <li><span class="bg-info "></span>Software</li>
                                        <li><span class="bg-success "></span>Video games</li>
                                    </ul>
                                </div>
                                <div class="col-sm-8 grid-margin ">
                                    <canvas id="bestSellers "></canvas>
                                </div>
                            </div>
                            <p class="mt-3 mb-4 mb-lg-0 ">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            </p>
                        </div>
                        <div class="col-lg-3 ">
                            <h4 class="card-title ">Social Media Statistics</h4>
                            <div class="row ">
                                <div class="col-sm-12 ">
                                    <div class="progress progress-lg grouped mb-2 ">
                                        <div class="progress-bar bg-danger " role="progressbar " style="width: 40% " aria-valuenow="25 " aria-valuemin="0 " aria-valuemax="100 "></div>
                                        <div class="progress-bar bg-info " role="progressbar " style="width: 10% " aria-valuenow="50 " aria-valuemin="0 " aria-valuemax="100 "></div>
                                        <div class="progress-bar bg-warning " role="progressbar " style="width: 20% " aria-valuenow="50 " aria-valuemin="0 " aria-valuemax="100 "></div>
                                        <div class="progress-bar bg-success " role="progressbar " style="width: 30% " aria-valuenow="50 " aria-valuemin="0 " aria-valuemax="100 "></div>
                                    </div>
                                </div>
                                <div class="col-sm-12 ">
                                    <ul class="graphl-legend-rectangle ">
                                        <li><span class="bg-danger "></span>Instagram (15%)</li>
                                        <li><span class="bg-warning "></span>Facebook (20%)</li>
                                        <li><span class="bg-info "></span>Website (25%)</li>
                                        <li><span class="bg-success "></span>Youtube (40%)</li>
                                    </ul>
                                </div>
                            </div>
                            <p class="mb-0 mt-2 ">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        fin seccion 1-->

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

          <!--seccion 04-->
        <div class="row mt-4">
            <div class="col-md-12 ">
                <h3 class="text-primary font-weight-bold">Cuentas de Ahorro</h3>
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
         <!--fin seccion 4-->
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
                interes_ganado_plazofijo: 0

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
                     me.ano=respuesta.ano

                     //para el grafico de cantidad de desembolsos por mes
                     me.cdesembolsos=respuesta.creditospormes;
                     me.ano=respuesta.ano

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
          this.cargarReporteCuentas();
        }
    }
</script>
