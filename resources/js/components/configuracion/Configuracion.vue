<template>
    <div class="row ">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-dark"><i class="mdi mdi-cash-multiple mdi-36px"></i>Configuraciones generales</h4>
                    <hr>
                    <p class="card-description text-primary">
                        Verifique la Información antes de aceptar los cambios
                    </p>
                    <form id="formRegistro" @submit="enviarForm" class="forms-sample">
                       
                       <div class="row">
                           <div class="col-md-12">
                               <h3>Configuración Créditos</h3>
                               <hr>
                           </div>
                            <div class="col-md-3">
                               <div class="form-group">
                                    <label for="descripcionaporte" class="font-weight-bold">Tasa Efectiva Anual(TEA)(%)</label>
                                    <input id="descripcionaporte" type="text" v-model="tasa_creditos" class="form-control" placeholder="Detalle de operación">
                                </div>
                           </div>
                            <div class="col-md-3">
                               <div class="form-group">
                                    <label for="descripcionaporte" class="font-weight-bold">Tasa Efectiva Mensual(TEM)(%) </label>
                                    <p class="form-control" placeholder="Detalle de operación" disabled>{{(((Math.pow(1+tasa_creditos/100,0.0833333333333333)-1)*12*100)/12).toFixed(2)}}</p>
                                </div>
                           </div>
                            <div class="col-md-3">
                               <div class="form-group">
                                    <label for="descripcionaporte" class="font-weight-bold">Tasa Moratoria Anual (%) </label>
                                    <input id="descripcionaporte" type="text" v-model="tasa_moratoria_anual" class="form-control" placeholder="Detalle de operación">
                                </div>
                           </div>
                           <div class="col-md-3">
                               <div class="form-group">
                                    <label for="descripcionaporte" class="font-weight-bold">Tasa Compensatoria Anual (%) </label>
                                    <input id="descripcionaporte" type="text" v-model="tasa_compensatoria_anual" class="form-control" placeholder="Detalle de operación">
                                </div>
                           </div>
                            <div class="col-md-12">
                               <div class="form-group">
                                    <h3>Configuración Cuenta de Ahorros-Cuenta Cor</h3>
                                    <hr>
                               </div>
                           </div>
                           <div class="col-md-3">
                               <div class="form-group">
                                    <label for="descripcionaporte" class="font-weight-bold">Tasa de Rendimiento Efectivo Anual (%)
                                        (TREA)</label>
                                    <input id="descripcionaporte" type="text" v-model="tasa_ahorros" class="form-control" placeholder="Detalle de operación">
                                </div>
                           </div>
                            <div class="col-md-3">
                               <div class="form-group">
                                    <label for="descripcionaporte" class="font-weight-bold">Comisiones de Consultas (S/)
                                       </label>
                                    <input id="descripcionaporte" type="text" v-model="tasa_ahorros_comisiones" class="form-control" placeholder="Detalle de operación">
                                </div>
                           </div>
                             <div class="col-md-3">
                               <div class="form-group">
                                    <label for="descripcionaporte" class="font-weight-bold">Seguros de Protección (S/)
                                      </label>
                                    <input id="descripcionaporte" type="text" v-model="tasa_ahorros_gastos" class="form-control" placeholder="Detalle de operación">
                                </div>
                           </div>  
                         <div class="col-md-12">
                               <div class="form-group">
                                    <h3>Configuración Cuenta de Ahorros - A plazo Fijo</h3>
                                    <hr>
                               </div>
                           </div>
                           <div class="col-md-2">
                               <div class="form-group">
                                    <label for="descripcionaporte" class="font-weight-bold">30 Días (%)
                                       </label>
                                    <input id="descripcionaporte" type="text" v-model="tasa_ahorroplazo_30" class="form-control" placeholder="Detalle de operación">
                                </div>
                           </div>
                            <div class="col-md-2">
                               <div class="form-group">
                                    <label for="descripcionaporte" class="font-weight-bold">31 - 90 Días  (%)
                                       </label>
                                    <input id="descripcionaporte" type="text" v-model="tasa_ahorroplazo_90" class="form-control" placeholder="Detalle de operación">
                                </div>
                           </div>
                             <div class="col-md-2">
                               <div class="form-group">
                                    <label for="descripcionaporte" class="font-weight-bold">91 - 180 Días (%)
                                      </label>
                                    <input id="descripcionaporte" type="text" v-model="tasa_ahorroplazo_180" class="form-control" placeholder="Detalle de operación">
                                </div>
                           </div>    
                            <div class="col-md-2">
                               <div class="form-group">
                                    <label for="descripcionaporte" class="font-weight-bold">181 -360 días  (%)
                                      </label>
                                    <input id="descripcionaporte" type="text" v-model="tasa_ahorroplazo_360" class="form-control" placeholder="Detalle de operación">
                                </div>
                           </div>  
                              <div class="col-md-2">
                               <div class="form-group">
                                    <label for="descripcionaporte" class="font-weight-bold">+ de 360 Días (%)
                                      </label>
                                    <input id="descripcionaporte" type="text" v-model="tasa_ahorroplazo_361" class="form-control" placeholder="Detalle de operación">
                                </div>
                           </div>    

                         <div class="col-md-12">
                               <div class="form-group">
                                    <h3>Configuración Aportes - Socios</h3>
                                    <hr>
                               </div>
                           </div>
                           <div class="col-md-2">
                               <div class="form-group">
                                    <label for="descripcionaporte" class="font-weight-bold">Tasa Aportes (%)</label>
                                    <input id="descripcionaporte" type="text" v-model="tasa_aportes" class="form-control" placeholder="Detalle de operación">
                                </div>
                           </div>
                       </div>
                       
                       
                        
                        
                        
                        
                        <input type="submit" class="btn btn-primary mr-2" value="Guardar cambios" @click="guardarCambios"/>
                        <a class="btn btn-light" @click="restaurarValores">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>    
</template>
<script>
    export default {
        props:['ruta'],
        data: function(){
            return {
                array_empresa:[],
               
                tasa_creditos:'',           
                tasa_ahorros:'',
                tasa_ahorros_comisiones:'',
                tasa_ahorros_gastos:'',           
                tasa_aportes:'',         
                tasa_compensatoria_anual:'',
                tasa_moratoria_anual:'',

                ant_tasa_creditos:'',           
                ant_tasa_ahorros:'',
                ant_tasa_ahorros_comisiones:'',
                ant_tasa_ahorros_gastos:'',           
                ant_tasa_aportes:'',         
                ant_tasa_compensatoria_anual:'',
                ant_tasa_moratoria_anual:'',
                idempresa:'',

                tasa_ahorroplazo_30:'',
                tasa_ahorroplazo_90:'',
                tasa_ahorroplazo_180:'',
                tasa_ahorroplazo_360:'',
                tasa_ahorroplazo_361:'',

                tasa_mensual:''



            }
        },
        methods: {
            enviarForm(e){
                e.preventDefault();
            },
            mostraralerta: function(posicion, tipo, titulo, btnconfirm, tiempo){
                Swal.fire({
                    position: posicion,
                    type: tipo,
                    title: titulo,
                    showConfirmButton: btnconfirm,
                    timer: tiempo
                });
            },
            cargarValores(){
                let me = this;

                axios.get(me.ruta +'/config/valores')
                    .then(res => {
                      //  me.array_empresa=res.data.config;
                        me.idempresa=res.data.config.id;
                         me.tasa_ahorros = me.ant_tasa_ahorros = res.data.config.tasa_ahorros;
                         me.tasa_ahorros_comisiones = me.ant_tasa_ahorros_comisiones = res.data.config.tasa_ahorros_comisiones;
                         me.tasa_ahorros_gastos = me.ant_tasa_ahorros_gastos = res.data.config.tasa_ahorros_gastos;

                         me.tasa_creditos = me.ant_tasa_creditos = res.data.config.tasa_creditos;
                         me.tasa_compensatoria_anual = me.ant_tasa_compensatoria_anual  = res.data.config.tasa_compensatoria_anual;
                         me.tasa_moratoria_anual = me.ant_tasa_moratoria_anual = res.data.config.tasa_moratoria_anual;


                         me.tasa_aportes = me.ant_tasa_aportes = res.data.config.tasa_aportes;

                            me.tasa_ahorroplazo_30=res.data.config.tasa_ahorroplazo_30;
                            me.tasa_ahorroplazo_90=res.data.config.tasa_ahorroplazo_90;
                            me.tasa_ahorroplazo_180=res.data.config.tasa_ahorroplazo_180;
                            me.tasa_ahorroplazo_360=res.data.config.tasa_ahorroplazo_360;
                            me.tasa_ahorroplazo_361=res.data.config.tasa_ahorroplazo_361;


                    var tnominal=(Math.pow(1+me.tasa_creditos/100,0.0833333333333333)-1)*12*100;
                    var mensual=tnominal/12;
                    me.tasa_mensual=this.deci(mensual,2)

                   

                        
                        console.log(res.data);
                    })
                    .catch(err => {
                        me.mostraralerta('top-end', 'error', '¡¡¡ Error, las configuraciones no se cargaron correctamente !!!', false, 2500);
                        console.log(err);
                    });
            },
            guardarCambios(){
                let me = this;

                axios.put(me.ruta + '/config/actualizar', {
                   
                        'id':me.idempresa,
                        'tasa_creditos':me.tasa_creditos,
                        'tasa_compensatoria_anual':me.tasa_compensatoria_anual,
                        'tasa_moratoria_anual':me.tasa_moratoria_anual,  

                        'tasa_ahorros':me.tasa_ahorros,
                        'tasa_ahorros_comisiones':me.tasa_ahorros_comisiones,
                        'tasa_ahorros_gastos':me.tasa_ahorros_gastos,   

                        'tasa_aportes':me.tasa_aportes, 
                        
                        
                       'tasa_ahorroplazo_30':me.tasa_ahorroplazo_30,
                       'tasa_ahorroplazo_90':me.tasa_ahorroplazo_90,
                       'tasa_ahorroplazo_180':me.tasa_ahorroplazo_180,
                       'tasa_ahorroplazo_360':me.tasa_ahorroplazo_360,
                       'tasa_ahorroplazo_361':me.tasa_ahorroplazo_361
                        
                })
                    .then(res => {
                                              
                        me.mostraralerta('top-end', 'success', '¡¡¡ Las configuraciones se actualizaron correctamente !!!', false, 2500);
                    })
                    .catch(err => {
                        me.mostraralerta('top-end', 'error', '¡¡¡ Error, no se actualizaron los cambios !!!', false, 2500);
                        console.log(err);
                    });
            },
            restaurarValores(){
                let me = this;

                me.tasa_ahorros = me.ant_tasa_ahorros;
                me.tasa_ahorros_comisiones = me.ant_tasa_ahorros_comisiones;
                me.tasa_ahorros_gastos = me.ant_tasa_ahorros_gastos;

                me.tasa_creditos = me.ant_tasa_creditos;
                me.tasa_compensatoria_anual = me.ant_tasa_moratoria_anual;
                me.tasa_moratoria_anual = me.ant_tasa_moratoria_anual;

                me.tasa_aportes = me.ant_tasa_aportes;

              
            },
             deci(GG, KK){
                 return (Math.round(GG * Math.pow(10, KK)) / Math.pow(10, KK));
            }
        },
        mounted() {
            this.cargarValores();
        }
    };
</script>
