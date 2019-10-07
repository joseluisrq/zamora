<template>

    <main >
        <template v-if="detalecuota==false">
            <div class="row ">            
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                    <h3 class="text-dark font-weight-bold">Buscar cuotas por Cliente</h3> <br>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="dnisocio " class="font-weight-bold">Socio (Ingrese N° de DNI )</label>
                                            <v-select
                                                id="dnisocio"
                                                :on-search="selectSocio"
                                                label="dni"
                                                :options="arraysocios"
                                                placeholder="Ingrese DNI del socio..."
                                                :onChange="getDatosSocio"
                                            >
                                            </v-select>
                                            <div v-if="idsocio!=0">
                                                <label class="badge badge-dark" v-text="nombre+' '+apellidos"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-4">
                                    
                                        <button  type="button"  @click="pagarcuota(idsocio)" class="btn btn-primary"> <i class="mdi mdi-magnify mdi-18px"></i>
                                        Buscar Cuotas</button>
                                    </div>
                                </div>
                        </div>
                    </div> 
                    
                </div>          
            </div>
            <div class="row ">            
                    <div class="col-lg-12 grid-margin stretch-card ">
                        <div class="card ">
                            <div class="card-body ">
                                <h4 class="card-title ">Cuotas por Pagar</h4>
                                <p class="card-description ">
                                Cuotas en orden de venciomiento 
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
                                            <button type="submit" 
                                            class="btn btn-outline-primary btn-sm"><i class="fa fa-search"></i>  <i class="mdi mdi-magnify"></i> Buscar</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                        <table class="table  table-bordered">
                                            <thead>
                                                <tr class="table-info text-white">
                                                    <th>Pagar  </th> 
                                                    <th> Socio</th>   
                                                    <th>Credito </th>                                                 
                                                    <th>N °Cuota </th>                                                
                                                    <th>Fecha </th>
                                                    <th>Monto de Cuota </th>
                                                    <th> Capital </th>
                                                    <th> Interés </th>
                                                    <th> Saldo </th>
                                                    
                                                    <th> Estado </th>


                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="cu in arrayCuotas" :key="cu.id">
                                                    
                                                    <td>
                                                        <button type="button" @click="pagarcuota(cu.idsocio)" class="btn btn-warning btn-rounded btn-icon ">
                                                        <i class="mdi mdi-currency-usd mdi-24px"></i>
                                                    </button>
                                                    </td>
                                                    <td >{{cu.dni}} - {{cu.nombre}} {{cu.apellidos}}</td>
                                                    <td class="py-1" v-text="cu.numeroprestamo"></td>
                                                    <td class="py-1" v-text="cu.numerodecuota"></td>
                                                
                                                    <template v-if="cu.estado==0">
                                                        <td v-text="cu.fechapago" ></td>
                                                    </template>
                                                    <template  v-if="cu.estado==1">
                                                        <td >Fecha de Pago :{{cu.fechapago}} <br>
                                                        Fecha de Cancelación :  <label class="badge badge-danger">{{cu.fechacancelo}}</label></td>
                                                    </template>
                                                    
                                                    <td v-text="cu.monto"></td>
                                                    <td v-text="cu.monto"></td>
                                                    <td v-text="cu.mora"></td>
                                                    <td v-text="cu.saldopendiente"></td>

                                                
                                                

                                                    <!--estados-->
                                                    <template>
                                                        <td v-if="cu.fechapago<hoy">                                                        
                                                            <label  class="badge badge-danger">Cuota Atrasada</label>
                                                        </td>
                                                        <td v-else>
                                                            <label  class="badge badge-success">Por Pagar</label>
                                                        </td>
                                                    </template>
                                                
                                                

                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                            </div>
                        </div>
                    </div>
            </div> 
        </template>  
        <template v-else>
            <button type="button"   @click="detalecuota=false" class="btn btn-primary">
                Buscar Cuotas
            </button>
            <pagarcuota :idcliente="personacredito_id" ></pagarcuota>
        </template>       
    </main>
   
</template>

<script>
import vSelect from 'vue-select'
export default {
    props:['ruta'],
    data(){
        
        return{

             idsocio: 0,

                dni: '',
                nombre: '',
                apellidos: '',

                numerocuenta: '',

                monto: '',
                descripcion: '',
                tasa: '',

                socioseleccionado: false,
                arraysocios: [],

                detalecuota:false,
                personacredito_id:0,


                arrayCuotas:[],
                 hoy:'',

        }
    },
     components:{
            vSelect
        },
    methods:{
          selectSocio(search, loading){//CREAR SOLO PARA LOS SOCIOS QUE NO TIENEN CUENTA DE AHORROS
                let me=this;
                 loading(true)
                var url= this.ruta+'/aporte/selectsocio?filtro='+search;
                axios.get(url).then(function (response) {
                    let respuesta = response.data;
                    q:search;
                    me.socioseleccionado = false;
                    me.arraysocios = respuesta.socios;
                    loading(false)
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            getDatosSocio(value){//Capturar el valor seleccionado de la lista
                let me = this;
                if(value){//si existe un valor para socio
                    me.loading = true;
                    me.idsocio = value.id;
                    me.dni = value.dni;
                    me.nombre = value.nombre;
                    me.apellidos = value.apellidos;
                    me.socioseleccionado = true;
                }else{//en el caso de que no exista, se limpia el label de v-select
                    me.limpiarselect();
                }
            },
               listarCuotas()
            {
                let me=this;                
                var url= this.ruta+'/cuota/cuotassinpagar';
                axios.get(url).then(function (response) {
                    var respuesta= response.data;                   
                    me.arrayCuotas = respuesta.cuotas;
                   
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            pagarcuota(id){
                this.personacredito_id=id;
                this.detalecuota=true;
            },
             fechaactual() 
            {
                let date = new Date()
                let day = date.getDate(); let month = date.getMonth() + 1;let year = date.getFullYear();
                if (month < 10)this.hoy = year + '-0' + month + '-' + day
                else this.hoy = year + '-' + month + '-' + day
            },
    },
     mounted() {
            this.listarCuotas();
             this.fechaactual();
          
    }
}
</script>