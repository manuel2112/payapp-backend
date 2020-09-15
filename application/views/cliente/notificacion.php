<div class="row">
	<div class="col-12">
		<div class="modal-header" style="background:#3c8dbc; color:white">
			<h4 class="modal-title">Solicitud de Notificación</h4>
		</div>		
	</div>
</div>

<?php if( $notificaciones ){?>
<div class="row mt-3">
	<div class="col-12">
		<button class='btn btn-success pull-right' data-toggle='modal' data-target='#modalVerNotificaciones'><i class='fa fa-pencil fa-lg'></i> REPORTE NOTIFICCIONES</button>
	</div>
</div>
<?php }?>

<div class="row mt-4">
	<div class="col-12">
		
		<?php if ( $this->session->flashdata('exito') ){ ?>
			<div class="alert alert-success">
			  <?php echo $this->session->flashdata('exito');?>
			  <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
		<?php }?>						

		<form action="<?php echo base_url()?>cliente/notificacioninsert" role="form" method="post" enctype="multipart/form-data">

			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
					<input type="text" class="form-control" name="datetimepickernotificacion" id="datetimepickernotificacion" placeholder="FECHA Y HORA DE ENVÍO (*)..." required />
				</div>
			</div>

			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-plus"></i></span>
					<textarea class="form-control" rows="5" name="txtDescripcion" id="txtDescripcion" placeholder="INGRESAR TEXTO DE NOTIFICACIÓN (*)..." required></textarea>
				</div>
			</div>

			<div class="form-group">
				<div class="panel">IMAGEN DE NOTIFICACIÓN</div>
				<div class="file-loading">
					<input type="file" id="file-not" name="file-not[]" required>
				</div>
				<span class="help-block text-secondary">Imagen de notificación</span><br>
				<span class="help-block text-secondary">1MB peso máximo.</span>
			</div>

			<div class="form-group">
				<button type="submit" class="btn btn-primary btn-block" id="btnGuardarEmpresa">Solicitar Notificación</button>
			</div>

		</form>

	</div>
</div><!-- PIE ROW -->

<!--=====================================
MODAL VER/AGREGAR FOTOS PROMOCIÓN EMPRESA
======================================-->
<div id="modalVerNotificaciones" class="modal fade" role="dialog">  
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<!--=====================================
			CABEZA DEL MODAL
			======================================-->

			<div class="modal-header" style="background:#3c8dbc; color:white">
				<h4 class="modal-title">REPORTE NOTIFICACIONES</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!--=====================================
			CUERPO DEL MODAL
			======================================-->

			<div class="modal-body">
			
				<table class="table table-bordered table-dark table-hover" style="width:100%">
					<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">FECHA</th>
							<th scope="col">TEXTO</th>
							<th scope="col">IMAGEN</th>
							<th scope="col">ENVIADOS</th>
							<th scope="col">CLICKS</th>
						</tr>
					</thead>
					<tbody>
					<?php $i = 1;?>
					<?php foreach( $notificaciones as $notificacion ){?>
						<tr>
							<td scope="col"><?php echo $i++?></td>
							<td scope="col"><?php echo fechaLatina($notificacion->NOTIFICACION_ENVIO)?></td>
							<td scope="col"><?php echo substr($notificacion->NOTIFICACION_TEXTO, 0, 30)?>...</td>
							<td scope="col"><img src="<?php echo base_url().$notificacion->NOTIFICACION_IMG?>" width="50px" alt=""></td>
							<td scope="col"><?php echo $notificacion->NOTIFICACION_ENVIADOS != '' ? $notificacion->NOTIFICACION_ENVIADOS : '---' ;?></td>
							<td scope="col"><?php echo $notificacion->NOTIFICACION_APERTURA != '' ? $notificacion->NOTIFICACION_APERTURA : '---' ;?></td>
						</tr>
					<?php }?>
					</tbody>
				</table>			

			</div>

			<!--=====================================
			PIE DEL MODAL
			======================================-->

			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
			</div>

		</div>

	</div>

</div>
