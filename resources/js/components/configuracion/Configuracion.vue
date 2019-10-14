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
                        <div class="form-group">
                            <label for="montoaporte" class="font-weight-bold">Mora</label>
                            <input id="montoaporte" type="number" v-model="mora" class="form-control" placeholder="Ingrese el monto" required>
                        </div>
                        <div class="form-group">
                            <label for="descripcionaporte" class="font-weight-bold">Interés</label>
                            <input id="descripcionaporte" type="text" v-model="intereses" class="form-control" placeholder="Detalle de operación">
                        </div>
                        <div class="form-group">
                            <label for="descripcionaporte" class="font-weight-bold">Abono socio</label>
                            <input id="descripcionaporte" type="text" v-model="abonosocio" class="form-control" placeholder="Detalle de operación">
                        </div>
                        <div class="form-group">
                            <label for="descripcionaporte" class="font-weight-bold">Tasa de Rendimiento Efectivo Anual(TREA)
                                (TREA)</label>
                            <input id="descripcionaporte" type="text" v-model="tasa_ahorros" class="form-control" placeholder="Detalle de operación">
                        </div>
                        <div class="form-group">
                            <label for="descripcionaporte" class="font-weight-bold">Tasa Efectiva Anual(TEA)</label>
                            <input id="descripcionaporte" type="text" v-model="tasa_creditos" class="form-control" placeholder="Detalle de operación">
                        </div>
                        <div class="form-group">
                            <label for="descripcionaporte" class="font-weight-bold">Tasa Aportes</label>
                            <input id="descripcionaporte" type="text" v-model="tasa_aportes" class="form-control" placeholder="Detalle de operación">
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
                mora: '',
                intereses: '',
                abonosocio: '',
                tasa_ahorros: '',
                tasa_creditos: '',
                tasa_aportes: '',

                ant_mora: '',
                ant_intereses: '',
                ant_abonosocio: '',
                ant_tasa_ahorros: '',
                ant_tasa_creditos: '',
                ant_tasa_aportes: ''
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

                axios.get('/config/valores')
                    .then(res => {
                      //  me.array_empresa=res.data.config;
                        me.mora = me.ant_mora = res.data.config.mora;
                        me.intereses = me.ant_intereses = res.data.config.interes;
                        me.abonosocio = me.ant_abonosocio = res.data.config.abonosocio;
                        me.tasa_ahorros = me.ant_tasa_ahorros = res.data.config.tasa_ahorros;
                        me.tasa_creditos = me.ant_tasa_creditos = res.data.config.tasa_creditos;
                        me.tasa_aportes = me.ant_tasa_aportes = res.data.config.tasa_aportes;
                        console.log(res.data);
                    })
                    .catch(err => {
                        me.mostraralerta('top-end', 'error', '¡¡¡ Error, las actualizaciones no se completaron correctamente !!!', false, 2500);
                        console.log(err);
                    });
            },
            guardarCambios(){
                let me = this;

                axios.put(me.ruta + '/config/actualizar', {
                    'mora': me.mora,
                    'intereses': me.intereses,
                    'abonosocio': me.abonosocio,
                    'tasa_ahorros': me.tasa_ahorros,
                    'tasa_creditos': me.tasa_creditos,
                    'tasa_aportes': me.tasa_aportes
                })
                    .then(res => {
                        me.ant_mora = me.mora;
                        me.ant_intereses = me.intereses;
                        me.ant_abonosocio = me.abonosocio;
                        me.ant_tasa_ahorros = me.tasa_ahorros;
                        me.ant_tasa_creditos = me.tasa_creditos;
                        me.ant_tasa_aportes = me.tasa_aportes;
                        me.mostraralerta('top-end', 'success', '¡¡¡ Las configuraciones se actualizaron correctamente !!!', false, 2500);
                    })
                    .catch(err => {
                        me.mostraralerta('top-end', 'error', '¡¡¡ Error, no se actualizaron los cambios !!!', false, 2500);
                        console.log(err);
                    });
            },
            restaurarValores(){
                let me = this;

                me.mora = me.ant_mora;
                me.intereses = me.ant_intereses;
                me.abonosocio = me.ant_abonosocio;
                me.tasa_ahorros = me.ant_tasa_ahorros;
                me.tasa_creditos = me.ant_tasa_creditos;
                me.tasa_aportes = me.ant_tasa_aportes;
            }
        },
        mounted() {
            this.cargarValores();
        }
    };
</script>
