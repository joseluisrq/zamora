<template>
    <div class="row">
						<div class="col-md-12 grid-margin stretch-card">
							<div class="card">
								<div class="card-body">
									<div class="row bg bg-dark">
										<div class="col-md-12 mt-2 text-white">
											<h4>Registar a un nuevo Socio</h4>
										</div>
									</div>
									
									<form class="forms-sample mt-4">
										<div class="row">
											<div class="col-md-2 form-group">
													<label for="exampleInputUsername1">DNI</label>
													<input type="text" class="form-control" id="exampleInputUsername1" placeholder="N° DNI">
											</div>
											<div class="col-md-3 form-group">
												<label for="exampleInputUsername1">Nombres</label>
												<input type="text" class="form-control" id="exampleInputUsername1" placeholder="Nombres Completos">
											</div>
											<div class=" col-md-4 form-group">
												<label for="exampleInputEmail1">Apellidos</label>
												<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Apellido paterno y materno">
											</div>
											<div class=" col-md-3 form-group">
												<label for="exampleInputEmail1">Fecha de Nacimiento</label>
												<input type="date" class="form-control" id="exampleInputEmail1" placeholder="Apellido paterno y materno">
											</div>
											<div class=" col-md-4 form-group">
												<label for="exampleInputEmail1">Dirección</label>
												<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Apellido paterno y materno">
											</div>
											<div class=" col-md-4 form-group">
												<label for="exampleInputEmail1">Teléfono/Celular</label>
												<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Número de Telefono">
											</div>
											<div class=" col-md-4 form-group">
												<label for="exampleInputEmail1">Coreo Electrónico</label>
												<input type="text" class="form-control" id="exampleInputEmail1" placeholder="Correo Electrónico">
											</div>
										</div>
										<button type="submit" class="btn btn-primary mr-2">Registrar </button>
										<button class="btn btn-light">Cancelar</button>
									</form>
								</div>
							</div>
						</div>
					</div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
