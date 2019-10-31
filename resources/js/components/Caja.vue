<template>
<main>
    <div class="row">
        <div class="col-sm-12 grid-margin stretch-card ">
            <div class="card ">
                <div class="card-body ">
                    <div class="row ">
                        <div class="col-lg-8 ">
                            <h1 class="font-weight-bold text-dark ">Caja</h1>
                            <p class="text-dark ">{{fecha}}</p>
                            <div class="d-lg-flex align-items-baseline mb-3 ">
                                   <h3 type="number" class="text-dark font-weight-bold" >Monto Incial &nbsp;&nbsp;  </h3>
                                <input type="number" class="text-dark font-weight-bold " v-model="montoincial">
                                <p class="text-muted ml-3 ">{{moneda}}</p>
                            </div>
                        </div>
                         <div class="col-lg-4 ">
                            <h3 class="font-weight-bold text-dark ">
                                <template>
                                    <button class="btn btn-primary">Abrir Caja</button>
                                </template>
                                <template>
                                       <button class="btn btn-danger">Cerrar Caja</button>
                                </template>
                                
                            </h3>
                      </div>
                       
                    </div>
                    <div class="row ">
                        <div class="col-sm-12 mt-4 mt-lg-0 ">
                            <div class="bg-primary text-white px-4 py-4 card ">
                                <div class="row ">
                                    <div class="col-sm-3 pl-lg-5 ">
                                        <h2>{{movimientos}}</h2>
                                        <p class="mb-0 ">Movimientos</p>
                                    </div>
                                    <div class="col-sm-9 climate-info-border mt-lg-0 mt-2 ">
                                        <h2>S/ {{totaldinero}}</h2>
                                        <p class="mb-0 ">Total Efectivo</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row pt-3 mt-md-1 ">
                        <div class="col ">
                            <div class="d-flex purchase-detail-legend align-items-center ">
                                <div id="circleProgress1 " class="p-2 "></div>
                                <div>
                                    <p class="font-weight-medium text-dark text-small ">Sessions</p>
                                    <h3 class="font-weight-bold text-dark mb-0 ">26.80%</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col ">
                            <div class="d-flex purchase-detail-legend align-items-center ">
                                <div id="circleProgress2 " class="p-2 "></div>
                                <div>
                                    <p class="font-weight-medium text-dark text-small ">Users</p>
                                    <h3 class="font-weight-bold text-dark mb-0 ">56.80%</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 grid-margin stretch-card ">
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
             <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Movimientos</h4>
                        <p class="card-description">
                        Add class <code>.table</code>
                        </p>
                        <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Profile</th>
                                <th>VatNo.</th>
                                <th>Created</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Jacob</td>
                                <td>53275531</td>
                                <td>12 May 2017</td>
                                <td><label class="badge badge-danger">Pending</label></td>
                            </tr>
                        
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
             <div class="col-lg-12 grid-margin stretch-card ">
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
    </div>
</main>
</template>

<script>
export default {
      props:['ruta'],
    data(){
        return{
            fecha:'',
            hora:'',
            montoincial:1200,
            moneda:'Soles',
            movimientos:0,
            totaldinero:0,

        }
    },
    methods:{
        datosactuales(){
            let me=this;
            moment.lang('es', {
            months: 'Enero_Febrero_Marzo_Abril_Mayo_Junio_Julio_Agosto_Septiembre_Octubre_Noviembre_Diciembre'.split('_'),
            monthsShort: 'Enero._Feb._Mar_Abr._May_Jun_Jul._Ago_Sept._Oct._Nov._Dec.'.split('_'),
            weekdays: 'Domingo_Lunes_Martes_Miercoles_Jueves_Viernes_Sabado'.split('_'),
            weekdaysShort: 'Dom._Lun._Mar._Mier._Jue._Vier._Sab.'.split('_'),
            weekdaysMin: 'Do_Lu_Ma_Mi_Ju_Vi_Sa'.split('_')
            });
            me.fecha=moment().format('LLL'); 
        }
      },
    mounted() {
        
      this.datosactuales();
    }
}
</script>