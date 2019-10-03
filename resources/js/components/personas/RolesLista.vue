<template>
   <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">LISTA DE ROLES</h4>
                    <p class="card-description">
                    Información de Roles <code>Detalle</code>
                    </p>
                    <div class="table-responsive pt-3">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="bg bg-dark text-white">
                                    <th>#</th>
                                    <th>Opciones</th>
                                    <td>Rol</td>
                                    <th>Descripcion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(rol, index) in roles">
                                    <td>{{ index + 1 }}</td>
                                    <td>                                        
                                        <!--editar de rol-->    
                                        <button type="button" class="btn btn-warning btn-rounded btn-icon">
                                                <i class="mdi mdi-lead-pencil"></i>
                                        </button>
                                        <!--eliminar rol-->  
                                        <button type="button" class="btn btn-danger btn-rounded btn-icon">
                                                <i class="mdi mdi-delete-forever"></i>
                                        </button>                                        
                                    </td>
                                    <td v-text="rol.nombre"></td>
                                    <td v-text="rol.descripcion"></td>
                                </tr>                               
                            </tbody>
                        </table>
                    </div>
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
                roles: []
            };
        },
        computed:{
        },
        methods: {
            cargaroles: function(){
                let me = this;
                axios.get(me.ruta + '/listaroles')
                    .then(res => {
                        me.roles = res.data.roles;
                    })
                    .catch(err => {
                        me.mostraralerta('top-end', 'error', '¡¡¡ Error durante la carga de los roles de usuario !!!', false, 2500);
                        console.log(err);
                    });
            },
        },
        mounted() {
            let me = this;
            me.cargaroles();
        }
    };
</script>
