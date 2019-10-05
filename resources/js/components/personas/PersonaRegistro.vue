<template>
	<div class="">
		<button v-if="showdetalle && tipo==0 && registrar==1" class="btn btn-success mr-2" @click="showdetalle=false">volver</button>
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
								<div id="formdni" class="col-md-2 form-group">
										<label for="formdni">DNI</label>
										<input id="formdni" type="number" v-model="dni" class="form-control" placeholder="N° DNI" oninvalid="this.setCustomValidity('ingese un DNI correcto')" oninput="this.setCustomValidity('')" required>
								</div>
								<div class="col-md-3 form-group">
									<label for="formnombres">Nombres</label>
									<input id="formnombres" type="text" v-model="nombres" class="form-control upper" placeholder="Nombres Completos" oninvalid="this.setCustomValidity('ingrese los nombres')" oninput="this.setCustomValidity('')" required>
								</div>
								<div class=" col-md-4 form-group">
									<label for="formapellidos">Apellidos</label>
									<input id="formapellidos" type="text" v-model="apellidos" class="form-control upper" placeholder="Apellido paterno y materno" oninvalid="this.setCustomValidity('ingrese los apellidos')" oninput="this.setCustomValidity('')" required>
								</div>
								<div class=" col-md-3 form-group">
									<label for="formfechanacimiento">Fecha de Nacimiento</label>
									<input id="formfechanacimiento" type="date" data-date-format="DD/MM/YYYY" min="1800-01-01" max="3000-12-31" v-model="fec_nac" class="form-control" placeholder="" oninvalid="this.setCustomValidity('ingrese una fecha válida')" oninput="this.setCustomValidity('')" required>
								</div>
								<div class=" col-md-4 form-group">
									<label for="formdireccion">Dirección</label>
									<input id="formdireccion" type="text" v-model="direccion" class="form-control upper" placeholder="Dirección" oninvalid="this.setCustomValidity('ingrese la dirección')" oninput="this.setCustomValidity('')" required>
								</div>
								<div class=" col-md-4 form-group">
									<label for="formtelefono">Teléfono/Celular</label>
									<input id="formtelefono" type="text" v-model="tel_cel" class="form-control" placeholder="Número de Telefono" oninvalid="this.setCustomValidity('ingrese el número teléfono/celular')" oninput="this.setCustomValidity('')" required>
								</div>
								<div class=" col-md-4 form-group">
									<label for="formcorreo">Coreo Electrónico</label>
									<input id="formcorreo" type="email" v-model="correo" class="form-control lower" placeholder="Correo Electrónico" oninvalid="this.setCustomValidity(this.value === '' ? 'ingrese un email' : (this.validity.typeMismatch ? 'ingrese un email válido' : ''))" oninput="this.setCustomValidity('')" :required="tipo==1">
								</div>
								<!-- INICIO OPCIONES USUARIO -->
								<div v-show="tipo==1" class=" col-md-3 form-group">
									<label for="formroles">Rol</label>
									<select id="formroles" class="form-control" v-model="idrol" oninvalid="this.setCustomValidity('seleccione un rol para el usuario')" oninput="this.setCustomValidity('')" :required="tipo==1">
										<option value="">-- seleccione un rol --</option>
										<option v-for="rol in roles" :key="rol.id" :value="rol.id" :selected="rol.id==idrol" v-text="rol.nombre"></option>
									</select>
								</div>

								<div v-show="tipo==1" class=" col-md-3 form-group">
									<label for="formusuario">Usuario</label>
									<input id="formusuario" type="text" v-model="usuario" class="form-control upper" placeholder="Usuario" oninvalid="this.setCustomValidity('ingrese un nombre de usuario')" oninput="this.setCustomValidity('')" :required="tipo==1">
								</div>
								<div v-show="tipo==1 && registrar==1" class=" col-md-3 form-group">
									<label for="formpassword">Contraseña</label>
									<input id="formpassword" type="password" v-model="password" class="form-control" placeholder="******" oninvalid="this.setCustomValidity('ingrese una contraseña')" oninput="this.setCustomValidity('')" :required="tipo==1 && registrar==1" :disabled="registrar==0">
								</div>
								<div v-show="tipo==1 && registrar==1" class=" col-md-3 form-group">
									<label for="formrepeatpassword">Repita Contraseña</label>
									<input id="formrepeatpassword"  type="password" v-model="reppassword" class="form-control" placeholder="*******" oninput="this.setCustomValidity(this.value === '' ? 'repita la contraseña' : (this.value !== formpassword.value ? 'las contraseñas no coinciden' : ''))" :required="tipo==1 && registrar==1" :disabled="registrar==0">
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

		<detallepersona v-show="showdetalle && tipo==0" :ruta="ruta" :tipo="tipo" :bus="bus"/><!-- EL BUS PERMITE PASAR INFO ENTRE COMPONENTES -->
	</div>
</template>

<script>
    export default {
    	props:['ruta', 'tipo', 'registrar', 'busactualizar'],//LA PROPIEDAD TIPO ES PARA DIFERENCIAR ENTRE SOCIOS Y USUARIOS, 0 SI ES SOCIO Y 1 SI ES USUARIO, LA PROPIEDAD REGISTRAR PERMITE SABER SI SE TRATA DE REGISTRAR O DE ACTUALIZAR
    	data: function(){
    		return {
    			bus: new Vue(),

    			titulo: '',

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

    			roles: [],

    			showdetalle: false
    		};
    	},
    	methods: {
    		iniciar: function(){
    			let me = this;
    			if(me.busactualizar) me.busactualizar.$on('cargardatosactualpersona', me.cargardatosactualpersona);

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

                let form = document.getElementById("formRegistro");
                form.classList.remove('was-validated');
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

    			let form = document.getElementById("formRegistro");
    			form.classList.add('was-validated');

				if(form.checkValidity()){
					let persona = {
	    				'dni' : me.dni,
		    			'nombres' : me.nombres.toUpperCase(),
		    			'apellidos' : me.apellidos.toUpperCase(),
		    			'fec_nac' : me.fec_nac,
		    			'direccion' : me.direccion.toUpperCase(),
		    			'tel_cel' : me.tel_cel,
		    			'correo' : me.correo?me.correo.toLowerCase():'',
		    			'tipo': me.tipo,

		    			'usuario' : me.usuario?me.usuario.toUpperCase():'',
		                'password' : me.password,
		                'idrol' : me.idrol
	    			};

					axios.post(me.ruta + '/registrarpersona', persona)
			        .then(res => {
			        	if(res.data.existe){//SI EXISTE UN REGISTRO CON EL MISMO DNI
			        		me.mostraralerta('center', 'error', '¡¡¡ Ya existe una persona registrada con ese DNI  !!!', false, 2000);
			        	}else {
			        		me.mostraralerta('center', 'success', '¡¡¡ Registro exitoso !!!', false, 1500);
				        	me.limpiarformulario();
				        	me.mostrardetalle(res.data.id);//DEVUELVE EL ID PARA MOSTRAR EL DETALLE DE LA NUEVA PERSONA REGISTRADA
				        	me.showdetalle = true;
			        	}
			        })
			        .catch(err => {
			        	me.mostraralerta('top-end', 'error', '¡¡¡ Error, el registro no se completó correctamente !!!', false, 2500);
			            console.log(err);
			        });
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

    			let form = document.getElementById("formRegistro");
    			form.classList.add('was-validated');

				if(form.checkValidity()){
					let persona = {
						'id' : me.id,
	    				'dni' : me.dni,
		    			'nombres' : me.nombres.toUpperCase(),
		    			'apellidos' : me.apellidos.toUpperCase(),
		    			'fec_nac' : me.fec_nac,
		    			'direccion' : me.direccion.toUpperCase(),
		    			'tel_cel' : me.tel_cel,
		    			'correo' : me.correo?me.correo.toLowerCase():'',
		    			'tipo': me.tipo,

		    			'usuario' : me.usuario?me.usuario.toUpperCase():'',
		                // 'password' : me.password, //DESDE ESTE COMPONENTE NO SE PUEDE ACTUALIZAR LAS CONTRASEÑAS
		                'idrol' : me.idrol,
		                'condicion' : me.condicion
	    			};

					axios.put(me.ruta + '/actualizarpersona', persona)
			        .then(res => {
			        	me.mostraralerta('center', 'success', '¡¡¡ Datos actualizados correctamente !!!', false, 1500);
			        	me.limpiarformulario();
			        	me.mostrardetalle(res.data);//DEVUELVE EL ID PARA MOSTRAR EL DETALLE CON LOS DATOS ACTUALIZADOS
			        	me.busactualizar.$emit('listarpersonas');
			        	me.showdetalle = true;
			        })
			        .catch(err => {
			        	me.mostraralerta('top-end', 'error', '¡¡¡ Error, los datos no se actualizaron correctamente !!!', false, 2500);
			            console.log(err);
			        });
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
<style type="text/css">
	.upper{
		text-transform: uppercase;
	}
	.lower{
		text-transform: lowercase;
	}
</style>