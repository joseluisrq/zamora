<template>
	<div class="">
		<button v-if="showdetalle && registrar==1" class="btn btn-success mr-2" @click="ocultardetalle">Registrar otro Socio</button>
		<div v-show="!showdetalle || tipo==1" class="row">
			<div class="col-md-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<div class="row bg bg-dark">
							<div class="col-md-12 mt-2 text-white">
								<h4 v-text="titulo"></h4>
							</div>
						</div>
						
						<form id="formRegistro" @submit="validarform" class="forms-sample mt-4">
							<div class="row">
								<div class="col-md-2 form-group">
									<label for="formdni">DNI</label>
									<input id="formdni" type="number" v-model="dni" :class="['form-control', 'border',errores.dni ? 'border-danger' : '']" placeholder="N° DNI">
									<span v-if="errores.dni" class="text-danger">{{ errores.dni[0] }}</span>
								</div>
								<div class="col-md-3 form-group">
									<label for="formnombres">Nombres</label>
									<input id="formnombres" type="text" v-model="nombres" :class="['form-control', 'upper', 'border',errores.nombres ? 'border-danger' : '']" placeholder="Nombres Completos">
									<span v-if="errores.nombres" class="text-danger">{{ errores.nombres[0] }}</span>
								</div>
								<div class=" col-md-4 form-group">
									<label for="formapellidos">Apellidos</label>
									<input id="formapellidos" type="text" v-model="apellidos" :class="['form-control', 'upper', 'border',errores.apellidos ? 'border-danger' : '']" placeholder="Apellido paterno y materno">
									<span v-if="errores.apellidos" class="text-danger">{{ errores.apellidos[0] }}</span>
								</div>
								<div class=" col-md-3 form-group">
									<label for="formfechanacimiento">Fecha de Nacimiento</label>
									<input id="formfechanacimiento" type="date" min="1900-01-01" max="2100-01-01" v-model="fechanacimiento" :class="['form-control', 'border',errores.fechanacimiento ? 'border-danger' : '']" placeholder="">
									<span v-if="errores.fechanacimiento" class="text-danger">{{ errores.fechanacimiento[0] }}</span>
								</div>
								<div class=" col-md-4 form-group">
									<label for="formdepartamento">Departamento</label>
									<input id="formdepartamento" type="text" v-model="departamento" :class="['form-control', 'upper', 'border',errores.departamento ? 'border-danger' : '']" placeholder="Dirección">
									<span v-if="errores.departamento" class="text-danger">{{ errores.departamento[0] }}</span>
								</div>
								<div class=" col-md-4 form-group">
									<label for="formciudad">Ciudad</label>
									<input id="formciudad" type="text" v-model="ciudad" :class="['form-control', 'upper', 'border',errores.ciudad ? 'border-danger' : '']" placeholder="Dirección">
									<span v-if="errores.ciudad" class="text-danger">{{ errores.ciudad[0] }}</span>
								</div>
								<div class=" col-md-4 form-group">
									<label for="formdireccion">Dirección</label>
									<input id="formdireccion" type="text" v-model="direccion" :class="['form-control', 'upper', 'border',errores.direccion ? 'border-danger' : '']" placeholder="Dirección">
									<span v-if="errores.direccion" class="text-danger">{{ errores.direccion[0] }}</span>
								</div>
								<div class=" col-md-4 form-group">
									<label for="formtelefono">Teléfono/Celular</label>
									<input id="formtelefono" type="text" v-model="telefono" :class="['form-control', 'border',errores.telefono ? 'border-danger' : '']" placeholder="Número de Telefono">
									<span v-if="errores.telefono" class="text-danger">{{ errores.telefono[0] }}</span>
								</div>
								<div class=" col-md-4 form-group">
									<label for="formcorreo">Coreo Electrónico</label>
									<input id="formcorreo" type="text" v-model="correo" :class="['form-control', 'lower', 'border',errores.correo ? 'border-danger' : '']" placeholder="Correo Electrónico">
									<span v-if="errores.correo" class="text-danger">{{ errores.correo[0] }}</span>
								</div>
								<!-- INICIO OPCIONES USUARIO -->
								<div v-show="tipo==1" class=" col-md-3 form-group">
									<label for="formroles">Rol</label>
									<select id="formroles" :class="['form-control', 'border',errores.rol ? 'border-danger' : '']" v-model="idrol">
										<option value="">-- seleccione un rol --</option>
										<option v-for="rol in roles" :key="rol.id" :value="rol.id" :selected="rol.id==idrol" v-text="rol.nombre"></option>
									</select>
									<span v-if="errores.rol" class="text-danger">{{ errores.rol[0] }}</span>
								</div>

								<div v-show="tipo==1" class=" col-md-3 form-group">
									<label for="formusuario">Usuario</label>
									<input id="formusuario" type="text" v-model="usuario" :class="['form-control', 'upper', 'border',errores.usuario ? 'border-danger' : '']" placeholder="Usuario">
									<span v-if="errores.usuario" class="text-danger">{{ errores.usuario[0] }}</span>
								</div>
								<div v-show="tipo==1 && registrar==1" class=" col-md-3 form-group">
									<label for="formpassword">Contraseña</label>
									<input id="formpassword" type="password" v-model="password" :class="['form-control', 'border',errores.password ? 'border-danger' : '']" placeholder="******">
									<span v-if="errores.password" class="text-danger">{{ errores.password[0] }}</span>
								</div>
								<div v-show="tipo==1 && registrar==1" class=" col-md-3 form-group">
									<label for="formrepeatpassword">Repita Contraseña</label>
									<input id="formrepeatpassword"  type="password" v-model="repetirpassword" :class="['form-control', 'border',errores.repetirpassword ? 'border-danger' : '']" placeholder="*******">
									<span v-if="errores.repetirpassword" class="text-danger">{{ errores.repetirpassword[0] }}</span>
								</div>
								<div v-show="tipo==1 && registrar==0" class=" col-md-3 form-group">
									<label for="activarusuario">Activar usuario</label>
									<input id="activarusuario" type="checkbox" v-model="condicion" class="form-control">
								</div>
								<!-- FIN OPCIONES USUARIO -->
							</div>
							<input v-show="registrar==1" type="submit" value="Registrar" class="btn btn-primary mr-2" @click="registrarpersona"></input>
							<input v-show="registrar==0" type="submit" value="Actualizar" class="btn btn-primary mr-2" @click="actualizarpersona"></input>
							<a class="btn btn-light" @click="limpiarformulario">Cancelar</a>
						</form>
					</div>
				</div>
			</div>
		</div>

		<detallepersona v-show="showdetalle" :ruta="ruta" :tipo="tipo" :bus="bus"/><!-- EL BUS PERMITE PASAR INFO ENTRE COMPONENTES -->
	</div>
</template>

<script>
    export default {
    	props:['ruta', 'tipo', 'registrar', 'busactualizar'],//LA PROPIEDAD TIPO ES PARA DIFERENCIAR ENTRE SOCIOS Y USUARIOS, 0 SI ES SOCIO Y 1 SI ES USUARIO, LA PROPIEDAD REGISTRAR PERMITE SABER SI SE TRATA DE REGISTRAR O DE ACTUALIZAR 1
    	data: function(){
    		return {
    			bus: new Vue(),

    			titulo: '',

    			id: '',
    			dni: '',
    			nombres: '',
    			apellidos: '',
    			fechanacimiento: '',
    			departamento: '',
    			ciudad: '',
    			direccion: '',
    			telefono: '',
    			correo: '',

    			usuario: '',
                password: '',
                repetirpassword: '',
                idrol: '',
                condicion: '',

                dniprevio: '',
                usuarioprevio: '',

    			roles: [],

    			showdetalle: false,

    			errores: []
    		};
    	},
    	methods: {
    		iniciar: function(){
    			let me = this;
    			if(me.busactualizar) {
    				me.busactualizar.$on('cargardatosactualpersona', me.cargardatosactualpersona);
    				me.busactualizar.$on('ocultarDetalle', me.ocultardetalle);
    				me.busactualizar.$on('limpiarCampos', me.limpiarcampos);
    			}

	        	if(me.tipo==1) me.cargaroles();//CARGA LOS ROLES SI ES USUARIO

	        	let tit = me.registrar==1?'Registrar nuevo ':'Actualizar datos de ';
	        	tit += me.tipo==1?'Usuario':'Socio';

	        	me.titulo = tit;
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
    		limpiarformulario: function(){
    			this.limpiarcampos();
                if(this.busactualizar)this.busactualizar.$emit('volveraLista');//VOLVER A LA LISTA DE PERSONAS
    		},
    		limpiarcampos(){
    			let me =this;
				me.id = '';
    			me.dni = '';
    			me.nombres = '';
    			me.apellidos = '';
    			me.fechanacimiento = '';
    			me.departamento = '';
    			me.ciudad = '';
    			me.direccion = '';
    			me.telefono = '';
    			me.correo = '';

    			me.usuario = '';
                me.password = '';
                me.repetirpassword = '';
                me.idrol = '';
                me.condicion = '';

                me.dniprevio = '';
                me.usuarioprevio = '';

                me.errores = [];

                this.bus.$emit('limpiarDetalle');//Limpiar el detalle del cliente
    		},
    		validarform: function (e) {
    			e.preventDefault();//Esto evita que que el formulario recargue la página cunado se envía la info
		    },
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
    		registrarpersona: function(){
    			let me = this;
    			//VALIDAR QUE SE TRATE DE UN REGISTRO SINO HACER UNA ACTUALIZACIÓN

    			if(me.registrar == 0){
    				me.actualizarpersona();
    				return;
    			}

    			let persona = {
    				'dni' : me.dni,
	    			'nombres' : me.nombres.toUpperCase(),
	    			'apellidos' : me.apellidos.toUpperCase(),
	    			'fechanacimiento' : me.fechanacimiento,
	    			'departamento': me.departamento.toUpperCase(),
					'ciudad': me.ciudad.toUpperCase(),
	    			'direccion' : me.direccion.toUpperCase(),
	    			'telefono' : me.telefono,
	    			'correo' : me.correo?me.correo.toLowerCase():'',
	    			'tipo': me.tipo,

	    			'usuario' : me.usuario?me.usuario.toUpperCase():'',
	    			'password' : me.password, //DESDE ESTE COMPONENTE NO SE PUEDE ACTUALIZAR LAS CONTRASEÑAS
	    			'repetirpassword' : me.repetirpassword, //DESDE ESTE COMPONENTE NO SE PUEDE ACTUALIZAR LAS CONTRASEÑAS
	                'rol' : me.idrol
    			};

				axios.post(me.ruta + '/registrarpersona', persona)
		        .then(res => {
		        	if(res.data.existe){//SI EXISTE UN REGISTRO CON EL MISMO DNI
		        		if(res.data.noadmin)
		        			me.mostraralerta('center', 'error', '¡¡¡ No se puede registrar debido a que esta persona se encuentra registrada como USUARIO y no tiene el rol de ADMINISTRADOR  !!!', false, 2500);
		        		else
		        			me.mostraralerta('center', 'error', '¡¡¡ Ya existe una persona registrada con ese DNI  !!!', false, 2000);
		        	}else {
		        		me.mostraralerta('center', 'success', '¡¡¡ Registro exitoso !!!', false, 1500);
			        	me.mostrardetalle(res.data.id);//DEVUELVE EL ID PARA MOSTRAR EL DETALLE DE LA NUEVA PERSONA REGISTRADA
			        	me.showdetalle = (me.tipo == 0);//SOLO SE MUESTRA EL DETALLE para socios

			        	me.errores = [];

			        	if(me.registrar == 1 && me.tipo == 1) {
			        		me.limpiarcampos();
			        	}//SI SE TRATA DE REGISTRAR DATOS DEL USUARIO, NO SE MUESTRA DETALLE
		        	}
		        })
		        .catch(err => {
		        	me.errores = err.response.data.errors;
		            console.log(err);
		        });
    		},
    		cargardatosactualpersona: function(id){
    			let me = this;
    			axios.get(me.ruta + '/detallepersona?id=' + id + '&tipo=' + me.tipo)
			        .then(res => {

			        	if(me.tipo==1) me.cargaroles();//CARGA LOS ROLES SI ES USUARIO

			        	let persona = res.data.personas[0];

			        	me.id = persona.id;
			        	me.dni = persona.dni;
		    			me.nombres = persona.nombre;
		    			me.apellidos = persona.apellidos;
		    			me.fechanacimiento = persona.fechanacimiento;
		    			me.departamento = persona.departamento;
						me.ciudad = persona.ciudad;
		    			me.direccion = persona.direccion;
		    			me.telefono = persona.telefono;
		    			me.correo = persona.email;

		    			me.usuario = persona.usuario;
		                // me.password = persona.password;
		                // me.repetirpassword = persona.password;
		                me.idrol = persona.idrol;
		                me.condicion = persona.condicion;

		                me.dniprevio = persona.dni;
                		me.usuarioprevio = persona.usuario;
			        })
			        .catch(err => {
			        	me.mostraralerta('top-end', 'error', '¡¡¡ Error, no se logró cargar la información de la persona seleccionada !!!', false, 2500);
			            console.log(err);
			        });
    		},
    		actualizarpersona: function(id){
    			let me = this;

    			let persona = {
					'id' : me.id,
    				'dni' : me.dni,
	    			'nombres' : me.nombres.toUpperCase(),
	    			'apellidos' : me.apellidos.toUpperCase(),
	    			'fechanacimiento' : me.fechanacimiento,
	    			'departamento' : me.departamento.toUpperCase(),
					'ciudad' : me.ciudad.toUpperCase(),
	    			'direccion' : me.direccion.toUpperCase(),
	    			'telefono' : me.telefono,
	    			'correo' : me.correo?me.correo.toLowerCase():'',
	    			'tipo': me.tipo,

	    			'usuario' : me.usuario?me.usuario.toUpperCase():'',
	                // 'password' : me.password, //DESDE ESTE COMPONENTE NO SE PUEDE ACTUALIZAR LAS CONTRASEÑAS
	                'rol' : me.idrol,
	                'condicion' : me.condicion,
	                'dniprevio' : me.dniprevio,
					'usuarioprevio' : me.usuarioprevio
    			};

				axios.put(me.ruta + '/actualizarpersona', persona)
		        .then(res => {
		        	if(res.data.existe){//SI EXISTE UN REGISTRO CON EL MISMO DNI
		        		me.mostraralerta('center', 'error', '¡¡¡ Ya existe una persona registrada con ese DNI  !!!', false, 2000);
		        	}else if(res.data.dobleuser){
		        		me.mostraralerta('center', 'error', '¡¡¡ El nombre de usuario que intenta registrar, ya se encuentra asignado  !!!', false, 2000);
		        	}else{
		        		me.mostraralerta('center', 'success', '¡¡¡ Datos actualizados correctamente !!!', false, 1500);
			        	me.mostrardetalle(res.data.id);//DEVUELVE EL ID PARA MOSTRAR EL DETALLE CON LOS DATOS ACTUALIZADOS
			        	me.busactualizar.$emit('listarpersonas');
			        	me.showdetalle = (me.tipo == 0);//SOLO SE MUESTRA EL DETALLE para socios

			        	me.errores = [];
			        	
			        	if(me.registrar == 0 && me.tipo == 1 && me.busactualizar){
			        		me.limpiarcampos();
			        		me.busactualizar.$emit('volveraLista');
			        	}//VOLVER A LA LISTA DE PERSONAS;//SI SE TRATA DE ACTUALIZAR DATOS DEL USUARIO, SE DEBE REGRESAR A LA LISTA
		        	}
		        })
		        .catch(err => {
		        	me.errores = err.response.data.errors;
		            console.log(err);
		        });
    		},
    		ocultardetalle(){
    			this.showdetalle = false;
    			this.limpiarcampos();
    		},
    		// DETALLE DE LOS SOCIOS
            mostrardetalle(id){
                this.bus.$emit('cargarDetalle', id);
            }
    	},
        mounted() {
        	this.iniciar();
        }
    };
</script>
<style type="text/css">
	.upper{
		text-transform: uppercase;
	}
	.lower{
		text-transform: lowercase;
	}
</style>