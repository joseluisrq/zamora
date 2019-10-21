<template>
    <main>
           
   <div class="dropdown">
        <button class="dropbtn">    <i class="mdi mdi-bell mx-0"></i>
            <span class="count ">{{
                parseInt(cuotasAtrasadas.length) +
                parseInt(creditosporaprobar.length)+
                parseInt(creditospordesembolsar.length) }}</span></button>
        <div class="dropdown-content">
            <template v-for="c in cuotasAtrasadas">
                <a :key="c.id" href="#" class="bg bg-danger text-white" style=""><font size="3">{{c.fechapago}}<br>
                DNI : {{c.dni}}</font ><br> <font size="2">{{c.nombre}} {{c.apellidos}}</font ></a>
            </template>

             <template v-for="ca in creditosporaprobar">
                <a :key="ca.id" href="#" class="bg bg-warning text-white" style=""><font size="3">POR APROBAR<br>
                DNI : {{ca.dni}}</font ><br> <font size="2">{{ca.nombre}} {{ca.apellidos}}</font ></a>
            </template>

             <template v-for="cd in creditospordesembolsar">
                <a :key="cd.id" href="#" class="bg bg-success text-white" style=""><font size="3">POR DESEMBOLSAR<br>
                DNI : {{cd.dni}}</font ><br> <font size="2">{{cd.nombre}} {{cd.apellidos}}</font ></a>
            </template>
            
           
        </div>
    </div>
  

    <li class="nav-item dropdown">
        <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="#" data-toggle="dropdown">

        
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
            <p class="mb-0 font-weight-normal float-left dropdown-header">Notificaciones</p>
            <a class="dropdown-item preview-item">
            <div class="preview-thumbnail">
                <div class="preview-icon bg-warning">
                    <i class="mdi mdi-information mx-0"></i>
                </div>
            </div>
            <div class="preview-item-content">
                <h6 class="preview-subject font-weight-normal">Cuota por vencer</h6>
                <p class="font-weight-light small-text mb-0 text-muted">
                    25/10/2019
                </p>
            </div>
            </a>
            
        </div>
    </li>
    </main>

</template>

<script>
export default {
    data(){
        return{
            cuotasAtrasadas:[],
             creditosporaprobar:[],
              creditospordesembolsar:[]

        }
    },
    methods:{
      
        listarnotificacion()
        {
            let me=this;                
                var url= 'http://localhost/zamora/public/notificacion';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;                   
                    me.cuotasAtrasadas = respuesta.cuotas;
                     me.creditosporaprobar = respuesta.creditosporaprobar;
                      me.creditospordesembolsar = respuesta.creditospordesembolsar;
                  
                   
                })
                .catch(function (error) {
                    console.log(error);
                });
        },


    },
     mounted() {
            this.listarnotificacion();  
                  
    }
}
</script>

<style >
.dropbtn {
  background-color: #4CAF50;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
  display: block;
}

.dropdown:hover .dropbtn {
  background-color: #3e8e41;
}
</style>