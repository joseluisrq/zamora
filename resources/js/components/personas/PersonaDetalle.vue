<template>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row bg bg-dark">
                        <div class="col-md-12 mt-2 text-white">
                            <h4 v-if="tipo==0">Información de Socio</h4>
                            <h4 v-else>Información de Usuario</h4>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-12">
                            <div class="template-demo">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h5 class="font-weight-bold">DNI:</h5>
                                        <P v-text="dni"></P>
                                    </div>
                                    <div class="col-md-4">
                                        <h5 class="font-weight-bold">NOMBRES:</h5>
                                        <p v-text="nombres + ' ' + apellidos"></p>
                                    </div>
                                    <div class="col-md-4">
                                        <h5 class="font-weight-bold">FECHA NACIMIENTO:</h5>
                                        <p v-text="fec_nac"></p>
                                    </div>
                                    <div class="col-md-4">
                                        <h5 class="font-weight-bold">DIRECCIÓN:</h5>
                                        <p v-text="direccion"></p>
                                    </div>
                                    <div class="col-md-4">
                                        <h5 class="font-weight-bold">TELÉFONO:</h5>
                                        <p v-text="tel_cel"></p>
                                    </div>
                                    <div class="col-md-4">
                                        <h5 class="font-weight-bold">EMAIL:</h5>
                                        <p v-text="correo"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>                                      
    </div>
</template>

<script>
    export default {
        props:['ruta', 'tipo', 'bus'],
        data: function(){
            return {
                dni: '',
                nombres: '',
                apellidos: '',
                fec_nac: '',
                direccion: '',
                tel_cel: '',
                correo: ''
            };
        },
        computed:{
        },
        methods: {
            cargarDetalle: function(id){
                let me = this;
                var url= me.ruta+'/detallepersona?id=' + id;

                axios.get(url).then(res => {
                    var persona = res.data.personas[0];
                    me.dni = persona.dni;
                    me.nombres = persona.nombre;
                    me.apellidos = persona.apellidos;
                    me.fec_nac = persona.fechanacimiento;
                    me.direccion = persona.direccion;
                    me.tel_cel = persona.telefono;
                    me.correo = persona.email;
                })
                .catch(function (error) {
                    console.log(error);
                });
            }
        },
        mounted() {
            let me = this;
            me.bus.$on('cargarDetalle', me.cargarDetalle);
        }
    };
</script>
