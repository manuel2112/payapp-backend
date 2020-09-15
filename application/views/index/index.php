<div id="accordion">

	<div class="card">
		<div class="card-header">
			<a class="card-link" data-toggle="collapse" href="#collapse1">
			ÚLTIMAS ACCIONES APP
			</a>
		</div>
		<div id="collapse1" class="collapse" data-parent="#accordion">
			<div class="card-body">
				<table class="table table-bordered table-dark table-hover" id="ultimasaccionesapp" style="width:100%">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">EMPRESA</th>
							<th scope="col">VISTA</th>
							<th scope="col">ACCIÓN</th>
							<th scope="col">FECHA</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>

	<div class="card">
		<div class="card-header">
			<a class="card-link" data-toggle="collapse" href="#collapse2">
			ÚLTIMAS ACCIONES BACKEND
			</a>
		</div>
		<div id="collapse2" class="collapse" data-parent="#accordion">
			<div class="card-body">
				<table class="table table-bordered table-dark table-hover" id="ultimasaccionesbackend" style="width:100%">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">EMPRESA</th>
							<th scope="col">ACCIÓN</th>
							<th scope="col">FECHA</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>

	<div class="card">
		<div class="card-header">
			<a class="card-link" data-toggle="collapse" href="#collapse3">
			GRÁFICOS
			</a>
		</div>
		<div id="collapse3" class="collapse" data-parent="#accordion">
			<div class="card-body">
				<div class="list-group">
					<button class="list-group-item list-group-item-action" data-toggle="modal" data-target="#modalGetGraphAdmin" data-title="CIUDAD MÁS VISTA" data-seccion="1"><i class="fa fa-bar-chart"></i> CIUDAD</button>
					<button class="list-group-item list-group-item-action" data-toggle="modal" data-target="#modalGetGraphAdmin" data-title="EMPRESA MÁS VISTA" data-seccion="2"><i class="fa fa-bar-chart"></i> EMPRESA</button>
				</div>
			</div>
		</div>
	</div>

	<div class="card">
		<div class="card-header">
			<a class="card-link" data-toggle="collapse" href="#collapse4">
			VALORES BASE
			</a>
		</div>
		<div id="collapse4" class="collapse" data-parent="#accordion">
			<div class="card-body">
				
				<div id="ok-descarga"></div>
				
				<form class="form-inline">
					<div class="form-group mx-sm-3 mb-2">
						<label for="updateDescargas" class="sr-only">Descargas</label>
						<input type="number" class="form-control" id="updateDescargas" placeholder="Descargas" value="<?php echo $base->BASE_DESCARGAS?>">
					</div>
					<button type="button" class="btn btn-primary mb-2" id="btnUpdateDescargas">Actualizar</button>
				</form>				
				
			</div>
		</div>
	</div>

</div>

<!--=====================================
MODAL GRÁFICO
======================================-->
<div id="modalGetGraphAdmin" class="modal fade" role="dialog">  
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<!--=====================================
			CABEZA DEL MODAL
			======================================-->

			<div class="modal-header" style="background:#3c8dbc; color:white">
				<h4 class="modal-title">GRÁFICA <span id="title-modal"></span></h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!--=====================================
			CUERPO DEL MODAL
			======================================-->
			<div id="graphloading" class="text-center"></div>

			<div class="modal-body" style="width:100%">
				<div class="row">
					<div class="col-12">
						<div id="mychartadmin" style="width:100%"></div>	
					</div>
				</div>								
			</div>

			<!--=====================================
			PIE DEL MODAL
			======================================-->

			<div class="modal-footer">
				<button type="button" class="btn btn-primary pull-left" data-dismiss="modal">Salir</button>
			</div>

		</div>
	</div>
</div>