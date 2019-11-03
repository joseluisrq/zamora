<template>
<main>
    <template>
         <div class="col-sm-12 grid-margin stretch-card ">
            <div class="card ">
                <div class="card-body ">
                    <div class="row ">
                        <h3 class="font-weight-bold text-dark col-md-12">Cajas Aperturadas : {{cajasAperturadas.length}}</h3><hr>
                        <template v-for="(caj,index) in cajasAperturadas" >
                            
                            <div class="col-lg-4" :key="caj.id"> 
                                <i class="mdi mdi-account-settings mdi-24px text-primary"></i>                             
                                <p class="text-dark">Codigo Caja : {{index+1}} - {{caj.id}}</p>
                                <p class="text-dark">Usuario : {{caj.nombre}} {{caj.apellidos}}</p>
                                                      
                            </div>
                        </template>
                        
                     </div>
                </div>
        </div>
         </div>
    </template>
    <template v-if="cajaabierta==false">
        <div class="col-sm-12 grid-margin stretch-card ">
            <div class="card ">
                <div class="card-body ">
                    <div class="row ">
                        <div class="col-lg-8 ">
                            <h1 class="font-weight-bold text-dark ">Abrir Caja</h1><hr>
                            <p class="text-dark ">Fecha de Apertura : {{fecha}}</p>
                             <p class="text-dark ">Moneda : {{moneda}}</p>
                            <div class="d-lg-flex align-items-baseline mb-3 ">
                                   <h3  class="text-dark" > Monto Incial &nbsp;&nbsp;  </h3>
                                <input type="number" class="text-dark font-weight-bold " v-model="montoinicial">
                                <p class="text-muted ml-3 ">{{moneda}}</p>
                            </div>
                        </div>
                         <div class="col-lg-12 ">
                            <h3 class="font-weight-bold text-dark ">
                                <template>
                                    <button type="button" @click="abrirCaja()" class="btn btn-primary" >Abrir Caja</button>
                                </template>
                               
                            </h3>
                      </div>                       
                    </div>
                </div>
            </div>
        </div>
    </template>
    <template v-else>
      <div class="row">
        <div class="col-sm-12 grid-margin stretch-card ">
            <div class="card ">
                <div class="card-body ">
                    <div class="row ">
                        <div class="col-lg-8 ">
                            <h1 class="font-weight-bold text-dark ">Caja</h1>
                            <p class="text-dark ">{{fecha}}</p>
                           
                        </div>
                         <div class="col-lg-4 ">
                            <h3 class="font-weight-bold text-dark ">
                               
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
                                        <h2>{{arrayMovimientos.length}}</h2>
                                        <p class="mb-0 ">Movimientos</p>
                                    </div>
                                    <div class="col-sm-9 climate-info-border mt-lg-0 mt-2 ">
                                        <h2>S/ {{totaldinero}}</h2>
                                        <p class="mb-0 ">Total Efectivo Movimientos</p>
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
                                    <p class="font-weight-medium text-dark text-small ">Monto de Apertura </p>
                                    <h3 class="font-weight-bold text-dark mb-0 ">{{montoapertura}}</h3>
                                </div>
                                <div>
                                    <p class="font-weight-medium text-dark text-small ">&nbsp;&nbsp; </p>
                                    <h3 class="font-weight-bold text-dark mb-0 ">&nbsp;&nbsp;</h3>
                                </div>
                                <div>
                                    <p class="font-weight-medium text-dark text-small "> Monto Total</p>
                                    <h3 class="font-weight-bold text-dark mb-0 ">{{parseFloat(montoapertura)+parseFloat(totaldinero)}}</h3>
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
                           
                           
                            <div class="col-lg-12 ">
                                <h4 class="card-title ">Tipos de Movimientos</h4>
                                <div class="row ">
                                   
                                    <div class="col-sm-12 ">
                                        <ul class="graphl-legend-rectangle ">
                                            <button class="btn btn-danger col-md-7 " type="button" @click="mostrarMovimientos(1)"><span class="bg-danger "></span>Aportes Socios</button>
                                            <button class="btn btn-info col-md-7" type="button" @click="mostrarMovimientos(4)">Créditos Desembolsados</button>
                                            <button class="btn btn-warning col-md-7" type="button"  @click="mostrarMovimientos(3)">Pago de Cuotas</button>
                                            <button class="btn btn-success col-md-7" type="button"  @click="mostrarMovimientos(2)">Cuentas de Ahorros</button>
                                        </ul>
                                    </div>
                                </div>
                                <p class="mb-0 mt-2 ">Selecione el tipo de movimiento para der el detalle
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Detalle de Movimientos</h4>
                        <p class="card-description">
                      {{estadoMovimiento}}
                        </p>
                        <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Monto.</th>
                                <th>Fecha</th>
                                <th>Voucher</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="t in arrayTabla" :key="t.idmovimiento">
                                <td v-text="t.idmovimiento"></td>
                                <td v-text="t.monto"></td>  
                                 <td v-text="t.fecha"></td>                              
                                <td><label class="badge badge-danger">Descargar</label></td>
                            </tr>
                            <p>Total : {{totalTabla}}</p>
                        
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
                           
                            <div class="col-lg-6 ">
                                <h4 class="card-title ">Montos Totales</h4>
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
                                            <li><span class="bg-danger "></span>Total Aportes de Socios: {{sumaaportes}}</li>
                                            <li><span class="bg-warning "></span>Total Movimientos en Cuentas de Ahorros : {{sumamovimiento}} </li>
                                            <li><span class="bg-info "></span>Total Desembolsos de Créditos : {{sumadesembolso}}</li>
                                            <li><span class="bg-success "></span>Total Pagos de Cuotas : {{sumapagos}}</li>
                                        </ul>
                                    </div>
                                </div>
                                <p class="mb-0 mt-2 ">Total {{totaldinero}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>
    
</main>
</template>

<script>
export default {
      props:['ruta'],
    data(){
        return{
            fecha:'',
            hora:'',
            montoinicial:500,
            moneda:'Soles',
            movimientos:0,
            montoapertura:0,
            totaldinero:0,
            datosCaja:0,
            cajasAperturadas:[],
            user:'',
            idcajaactual:0,

            cajaabierta:false,
            arrayMovimientos:[],
            arrayCaja:[],
            arrayTabla:[],
            estadoMovimiento:'',
            totalTabla:0,

            sumaaportes:0,
            sumapagos:0,
            sumamovimiento:0,
            sumadesembolso:0

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
        },
         seleccionarCaja ()
            {   
                let me=this;   
                me.datosactuales();

                var url= me.ruta+'/caja/seleccionarCaja';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.datosCaja = respuesta.caja;
                    //me.montoapertura= me.datosCaja[0].montoinicial; 
                    me.user = respuesta.user; 
                    if(me.user==me.datosCaja[0].idusuario)
                    {   me.cajaabierta=true;
                        me.idcajaactual=me.datosCaja[0].id
                        me.MovimientosCaja();
                    }

                                  
                })
                .catch(function (error) {
                    console.log(error);
                });
         },
             
        CajasAperturadas ()
        {   
                let me=this;   
                me.datosactuales();                            
                var url= me.ruta+'/caja/CajasAperturadas';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.cajasAperturadas = respuesta.cajas;              
                })
                .catch(function (error) {
                    console.log(error);
                });
         },
         abrirCaja()
         {
               
                
                let me = this;
                Swal.fire({
                    title: '¿Está seguro que desea ABRIR UNA NUEVA CAJA?',
                    text: "",
                    type: 'success',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                     cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Si'
                    }).then((result) => {
                    if (result.value) {
                       axios.post(this.ruta+'/caja/abrirCaja',{
                        'montoinicial': me.montoinicial,  
                        }).then(function (response) {
                        me.cajaabierta=true;
                        Swal.fire(
                        'CAJA ABIERTA',
                        'Ya puede registrar operaciones',
                        'success'
                        )  
                         
                               
                      }).catch(function (error) {
                                console.log(error);
                            });
                    }
                 })
            },
         MovimientosCaja (){
                let me = this;
                if(me.idcajaactual!=0){
                var url= me.ruta+'/caja/MovimientosCaja?id='+ me.idcajaactual;
                axios.get(url).then(res => {
                    var respuesta = res.data;
                    me.arrayMovimientos = respuesta.detallecaja;
                    me.arrayCaja = respuesta.datoscaja;                                       
                    me.montoapertura= me.arrayCaja[0].montoinicial; 
                    
                    me.arrayMovimientos.map(function(x){
                        me.totaldinero=parseFloat(x.monto)+parseFloat(me.totaldinero)
                        if(x.tipo==1)me.sumaaportes=parseFloat(x.monto)+parseFloat(me.sumaaportes);
                        else if(x.tipo==2)me.sumamovimiento=parseFloat(x.monto)+parseFloat(me.sumamovimiento);
                        else if(x.tipo==3)me.sumapagos=parseFloat(x.monto)+parseFloat(me.sumapagos);
                        else if(x.tipo==4)me.sumadesembolso=parseFloat(x.monto)+parseFloat(me.sumadesembolso);                   
                     });
                })
                .catch(function (error) {
                    console.log(error);
                });
                }

            },
            mostrarMovimientos(id){
                let me=this;
                 me.arrayTabla.length=0;
                 me.totalTabla=0;

                        if(id==1)me.estadoMovimiento='Aportes de Socios'
                        else if(id==2)me.estadoMovimiento='Cuenta de Ahorros'
                        else if(id==3)me.estadoMovimiento='Pago de Cuotas'
                        else if(id==4)me.estadoMovimiento='Desembolsos de Créditos'



                me.arrayMovimientos.map(function(x){
                    if(x.tipo==id){
                        me.arrayTabla.push(x);
                        me.totalTabla=parseFloat(x.monto)+parseFloat(me.totalTabla)                       
                    }
                   
                });
               

            }
      },
    mounted() {
        
      this.seleccionarCaja();
       this.CajasAperturadas();
      
    }
}
</script>