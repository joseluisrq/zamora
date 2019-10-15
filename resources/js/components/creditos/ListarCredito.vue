<template>
    <main>
  
    <!--Lista de creditos-->
    <div class="row" v-if="viewLista">
         
        <div class="col-lg-12 grid-margin stretch-card ">
            <div class="card ">
                <div class="card-body ">
                    <h4 class="card-title ">Historial de Creditos</h4>
                    <p class="card-description ">
                        Información de creditos  <code>Activos e inactivos</code>
                    </p>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="input-group">
                                <select class="form-control col-md-12" v-model="criterio">
                                    <option value="numeroprestamo">Número de prestamo</option>
                                    <option value="dni">DNI Socio</option>
                                    <option value="fechadesembolso">Fecha de Desembolso </option>
                                </select>
                                <input type="text" v-model="buscar" @keyup.enter="listarCreditos(1,buscar,criterio)" 
                                class="form-control form-control-lg" placeholder="Texto a buscar">
                                <button type="submit" @click="listarCreditos(1,buscar,criterio)" 
                                class="btn btn-outline-primary btn-sm"><i class="fa fa-search"></i>  <i class="mdi mdi-magnify"></i> Buscar</button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive pt-3 ">
                        <table class="table table-bordered ">
                            <thead>
                                <tr class="bg bg-dark text-white ">
                                   
                                    <th> Opciones</th>
                                    <th> N° Credito </th>
                                    <th> Fecha de Desembolso</th>
                                    <th> Monto Capital</th>
                                    <th> Tasa de Interes</th>
                                  
                                    <th> N° Cuotas </th>
                                    <th> DNI Socio </th>
                                    <th> Nombres del  Socio </th>
                                    <th> Estado</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="c in arrayCreditos" :key="c.id">
                                    
                                    <td>
                                        <!--detalle de credito-->
                                        <button type="button" @click="viewDetalle=true;idcredito=c.id;viewLista=false" class="btn btn-success btn-rounded btn-icon ">
                                                <i class="mdi mdi-eye "></i>
                                        </button>
                                        <!--CONFIGURACION 
                                       
                                        <button type="button " class="btn btn-warning btn-rounded btn-icon ">
                                                <i class="mdi mdi-lead-pencil "></i>
                                        </button>
                                       
                                        <button type="button " class="btn btn-danger btn-rounded btn-icon ">
                                                <i class="mdi mdi-delete-forever "></i>
                                        </button>
                                        <button type="button " class="btn btn-info btn-rounded btn-icon ">
                                                <i class="mdi mdi-currency-usd "></i>
                                        </button>
                                        -->
                                    </td>
                                    <td v-text="c.numeroprestamo"></td>
                                    <td v-text="c.fechadesembolso"></td>
                                    <td v-text="'S/ '+c.montodesembolsado"></td>
                                     <td v-text="c.tasa+' %'"></td>
                                    
                                    <td v-text="c.numerocuotas"></td>

                                    <td v-text="c.sociodni"></td>
                                    <td v-text="c.socionombre+' '+c.socioapellido"></td>
                                 
                                    <td v-if="c.estado==0">
                                        <label class="badge badge-success text-white ">Inactivo</label>
                                    <td  v-else-if="c.estado==1">
                                         <template v-if="c.estadodesembolso==0">
                                          <label class="badge badge-danger text-white ">Sin Desembolsar</label>                                        
                                        </template>
                                        <template v-else>
                                            <label class="badge badge-success text-white ">En proceso</label>                                       
                                        </template>
                                    <td  v-else-if="c.estado==2">
                                        <label  class="badge badge-success text-white ">Finalizado</label>
                                    </td>

                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Fin lista de creditos-->

    <!--Detalle de un credito-->
    <template v-if="viewDetalle">
        <button type="button" class="btn btn-warning" @click="listarCreditos(1,buscar,criterio);viewDetalle=false;viewLista=true">
           <i class="mdi mdi-arrow-left-bold"></i> Historial de Créditos
        </button>   
        <detallecredito  v-bind:id="idcredito" ></detallecredito>
    </template>
     <!--fin de detalle de credito-->
    
    </main>
</template>
<script>
export default {
    props : ['ruta'],
    data(){
        return{
           arrayCreditos:[],
           

            viewDetalle:false,
            viewLista:true,
            idcredito:0,

            //Paginacion
            pagination : 
            {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
            },
            //busqueda
            offset : 3,
            criterio : 'numeroprestamo', 
            buscar : '',
        }
    },
    computed:
    {
            isActived: function(){
                return this.pagination.current_page;
            },
            //Calcula los elementos de la paginación
            pagesNumber: function() {
                if(!this.pagination.to) {
                    return [];
                }
                
                var from = this.pagination.current_page - this.offset; 
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2); 
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }  

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;             

            }
    },
    methods:
    {
            

            cambiarPagina(page,buscar,criterio)
            {   let me = this;
                me.pagination.current_page = page;
                me.listarCreditos(page,buscar,criterio);
            },

           listarCreditos (page,buscar,criterio)
            {
                let me=this;
                me.listado=2;
                var url= 'http://127.0.0.1:8000/credito?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayCreditos = respuesta.creditos.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },


    },
     mounted() {
            this.listarCreditos(1,this.buscar,this.criterio);
          
    }
}
</script>