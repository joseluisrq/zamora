<template>
    <div class="row">
		<div class="col-md-12 grid-margin stretch-card">
			<div class="card">
				<div class="card-body">
					<div class="row bg bg-dark">
						<div class="col-md-12 mt-2 text-white">
							<h4 v-if="tipo==0">Registar a un nuevo Socio</h4>
							<h4 v-else>Registar a un nuevo Usuario</h4>
						</div>
					</div>
					
					<form id="formRegistro" class="forms-sample mt-4 was-validated" oninput='repeatpassword.setCustomValidity(repeatpassword.value != password.value ? "Las contraseñas no coinciden" : "")' onkeypress="">
						<div class="row">
							<div class="col-md-2 form-group">
									<label for="dni">DNI</label>
									<input type="number" v-model="dni" class="form-control" id="dni" placeholder="N° DNI" required>
							</div>
							<div class="col-md-3 form-group">
								<label for="nombres">Nombres</label>
								<input type="text" v-model="nombres" class="form-control" id="nombres" placeholder="Nombres Completos" required oninput="this.value = this.value.toUpperCase();">
							</div>
							<div class=" col-md-4 form-group">
								<label for="apellidos">Apellidos</label>
								<input type="text" v-model="apellidos" class="form-control" id="apellidos" placeholder="Apellido paterno y materno" required oninput="this.value = this.value.toUpperCase();">
							</div>
							<div class=" col-md-3 form-group">
								<label for="fechanacimiento">Fecha de Nacimiento</label>
								<input type="date" v-model="fec_nac" class="form-control" id="fechanacimiento" placeholder="Apellido paterno y materno" required oninput="this.value = this.value.toUpperCase();">
							</div>
							<div class=" col-md-4 form-group">
								<label for="direccion">Dirección</label>
								<input type="text" v-model="direccion" class="form-control" id="direccion" placeholder="Apellido paterno y materno" required oninput="this.value = this.value.toUpperCase();">
							</div>
							<div class=" col-md-4 form-group">
								<label for="telefono">Teléfono/Celular</label>
								<input type="text" v-model="tel_cel" class="form-control" id="telefono" placeholder="Número de Telefono" required>
							</div>
							<div class=" col-md-4 form-group">
								<label for="correoemail">Coreo Electrónico</label>
								<input type="email" v-model="correo" class="form-control" id="correoemail" placeholder="Correo Electrónico" oninput="this.value = this.value.toLowerCase();" :required="tipo==1">
							</div>
							<!-- INICIO OPCIONES USUARIO -->
							<div v-show="tipo==1" class=" col-md-3 form-group">
								<label for="roles">Rol</label>
								<select id="roles" class="form-control" v-model="idrol" :required="tipo==1">
									<option value="">---</option>
									<option v-for="rol in roles" :key="rol.id" :value="rol.id" :selected="rol.id==idrol" v-text="rol.nombre"></option>
								</select>
							</div>

							<div v-show="tipo==1" class=" col-md-3 form-group">
								<label for="usuario">Usuario</label>
								<input type="text" v-model="usuario" class="form-control" id="usuario" placeholder="Usuario" oninput="this.value = this.value.toUpperCase();" :required="tipo==1">
							</div>
							<div v-show="tipo==1" class=" col-md-3 form-group">
								<label for="password">Contraseña</label>
								<input type="password" v-model="password" class="form-control" id="password" placeholder="******" :required="tipo==1">
							</div>
							<div v-show="tipo==1" class=" col-md-3 form-group">
								<label for="repeatpassword">Repita Contraseña</label>
								<input type="password" v-model="reppassword" class="form-control" id="repeatpassword" placeholder="*******" :required="tipo==1">
							</div>
							<div v-show="tipo==1 && registrar==0" class=" col-md-3 form-group">
								<label for="activarusuario">Activar usuario</label>
								<input type="checkbox" v-model="condicion" class="form-control" id="activarusuario">
							</div>
							<!-- FIN OPCIONES USUARIO -->
						</div>
						<a v-show="registrar==1" class="btn btn-primary mr-2" @click="registrarpersona">Registrar</a>
						<a v-show="registrar==0" class="btn btn-primary mr-2" @click="actualizarpersona">Actualizar</a>
						<a class="btn btn-light" @click="limpiarformulario">Cancelar</a>
					</form>
				</div>
			</div>
		</div>

		<!-- INICIO DETALLE -->
        <detallepersona v-show="tipo==0 && registrar==1" :ruta="ruta" :tipo="tipo" :bus="bus"/><!-- EL BUS PERMITE PASAR INFO ENTRE COMPONENTES -->
        <!-- FIN DETALLE -->

	</div>
</template>

<script>
    export default {
    	props:['ruta', 'tipo', 'registrar', 'busactualizar'],//LA PROPIEDAD TIPO ES PARA DIFERENCIAR ENTRE SOCIOS Y USUARIOS, 0 SI ES SOCIO Y 1 SI ES USUARIO, LA PROPIEDAD REGISTRAR PERMITE SABER SI SE TRATA DE REGISTRAR O DE ACTUALIZAR
    	data: function(){
    		return {
    			bus: new Vue(),

    			id: '',
    			dni: '',
    			nombres: '',
    			apellidos: '',
    			fec_nac: '',
    			direccion: '',
    			tel_cel: '',
    			correo: '',

    			usuario: '',
                password: '',
                reppassword: '',
                idrol: '',
                condicion: '',

    			roles: []
    		};
    	},
    	methods: {
    		iniciar: function(){
    			let me = this;
    			if(me.busactualizar) me.busactualizar.$on('cargardatosactualpersona', me.cargardatosactualpersona);

	        	if(me.tipo==1) me.cargaroles();//CARGA LOS ROLES SI ES USUARIO
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
				let me =this;
				me.id = '';
    			me.dni = '';
    			me.nombres = '';
    			me.apellidos = '';
    			me.fec_nac = '';
    			me.direccion = '';
    			me.tel_cel = '';
    			me.correo = '';

    			me.usuario = '';
                me.password = '';
                me.reppassword = '';
                me.idrol = '';
                me.condicion = '';
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

    			var form = document.getElementById("formRegistro");
				if(form.checkValidity()){
					let persona = {
	    				'dni' : me.dni,
		    			'nombres' : me.nombres,
		    			'apellidos' : me.apellidos,
		    			'fec_nac' : me.fec_nac,
		    			'direccion' : me.direccion,
		    			'tel_cel' : me.tel_cel,
		    			'correo' : me.correo,
		    			'tipo': me.tipo,

		    			'usuario' : me.usuario,
		                'password' : me.password,
		                'idrol' : me.idrol
	    			};

					axios.post(me.ruta + '/registrarpersona', persona)
			        .then(res => {
			        	me.mostraralerta('center', 'success', '¡¡¡ Registro exitoso !!!', false, 1500);
			        	me.limpiarformulario();
			        	me.mostrardetalle(res.data);//DEVUELVE EL ID PARA MOSTRAR EL DETALLE DE LA NUEVA PERSONA REGISTRADA
			        })
			        .catch(err => {
			        	me.mostraralerta('top-end', 'error', '¡¡¡ Error, el registro no se completó correctamente !!!', false, 2500);
			            console.log(err);
			        });
				}
				else{
					me.mostraralerta('top-end', 'error', '¡¡¡ Debe llenar los campos obligatorios !!!', false, 2500);
				}
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
		    			me.fec_nac = persona.fechanacimiento;
		    			me.direccion = persona.direccion;
		    			me.tel_cel = persona.telefono;
		    			me.correo = persona.email;

		    			me.usuario = persona.usuario;
		                me.password = persona.password;
		                me.reppassword = persona.password;
		                me.idrol = persona.idrol;
		                me.condicion = persona.condicion;
			        })
			        .catch(err => {
			        	me.mostraralerta('top-end', 'error', '¡¡¡ Error, no se logró cargar la información de la persona seleccionada !!!', false, 2500);
			            console.log(err);
			        });
    		},
    		actualizarpersona: function(id){
    			let me = this;

    			var form = document.getElementById("formRegistro");
				if(form.checkValidity()){
					let persona = {
						'id' : me.id,
	    				'dni' : me.dni,
		    			'nombres' : me.nombres,
		    			'apellidos' : me.apellidos,
		    			'fec_nac' : me.fec_nac,
		    			'direccion' : me.direccion,
		    			'tel_cel' : me.tel_cel,
		    			'correo' : me.correo,
		    			'tipo': me.tipo,

		    			'usuario' : me.usuario,
		                'password' : me.password,
		                'idrol' : me.idrol,
		                'condicion' : me.condicion
	    			};

					axios.put(me.ruta + '/actualizarpersona', persona)
			        .then(res => {
			        	me.mostraralerta('center', 'success', '¡¡¡ Datos actualizados correctamente !!!', false, 1500);
			        	me.limpiarformulario();
			        	me.mostrardetalle(res.data);//DEVUELVE EL ID PARA MOSTRAR EL DETALLE CON LOS DATOS ACTUALIZADOS
			        	me.busactualizar.$emit('listarpersonas');
			        })
			        .catch(err => {
			        	me.mostraralerta('top-end', 'error', '¡¡¡ Error, los datos no se actualizaron correctamente !!!', false, 2500);
			            console.log(err);
			        });
				}
				else{
					me.mostraralerta('top-end', 'error', '¡¡¡ Debe llenar los campos obligatorios !!!', false, 2500);
				}
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
