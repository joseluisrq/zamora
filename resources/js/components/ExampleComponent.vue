<template>
    <main>
        <!--seccion 1-->
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
        <!--fin seccion 1-->

        <!--seccion 02-->
        <div class="row  mt-4">
            <div class="col-lg-2 grid-margin stretch-card ">
                <div class="card ">
                    <div class="card-body pb-0 ">
                        <div class="d-flex align-items-center justify-content-between ">
                            <h2 class="text-success font-weight-bold ">18390</h2>
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
         
            <div class="col-lg-2 grid-margin stretch-card ">
                <div class="card ">
                    <div class="card-body pb-0 ">
                        <div class="d-flex align-items-center justify-content-between ">
                            <h2 class="text-dark font-weight-bold ">7826</h2>
                            <i class="mdi mdi-cash text-dark mdi-18px "></i>
                        </div>
                         <p class="text-dark font-weight-bold">Créditos en Proceso</p>
                    </div>
                   
                    
                </div>
            </div>
               <div class="col-lg-2 grid-margin stretch-card ">
                <div class="card ">
                    <div class="card-body pb-0 ">
                        <div class="d-flex align-items-center justify-content-between ">
                            <h2 class="text-secondary font-weight-bold ">586</h2>
                            <i class="mdi mdi-cart-outline mdi-18px text-dark "></i>
                        </div>
                        <p class="text-dark font-weight-bold">Creditos Con cuotas Atrasadas</p>
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
                        <div class="d-lg-flex align-items-center justify-content-between mb-4 ">
                            <h4 class="card-title ">Product Orders</h4>
                            <p class="text-dark ">+5.2% vs last 7 days</p>
                        </div>
                        <div class="product-order-wrap padding-reduced ">
                            <div id="productorder-gage " class="gauge productorder-gage "></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <!--fin seccion 3-->

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


                     //para el grafico de desembolsos por mes
                     me.desembolsos=respuesta.desembolsos;
                     me.ano=respuesta.ano
                     //cargamos los datos al chart
                     me.loadDesembolsos();

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
            
            
            
            }

        },
        mounted() {
          this.getDesembolsos();
        }
    }
</script>
