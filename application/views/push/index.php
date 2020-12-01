<div class="row mb-2">

	<div class="col-12">

	<?php if ( $this->session->flashdata('exito') ){ ?>
		<div class="alert alert-success">
		  <?php echo $this->session->flashdata('exito');?>
		  <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
	<?php }?>

    <?php if ( $this->session->userdata('adminapppay') ) {?>
	<?php }?>

    <?php if ( $this->session->userdata('clienteapppay') ) {?>

	<div class="col-12 mb-5">
			<button class="btn btn-primary" data-toggle="modal" data-target="#mdlPush" title="CREAR NOTIFICACIÓN PUSH" id="mdlPushOpen">CREAR NOTIFICACIÓN PUSH</button>
			<br><br>
			<a href="<?php echo base_url('pushrest/'.$this->session_id)?>" target="_blank" class="btn btn-primary">API</a>
			<a href="<?php echo base_url('pushcron/')?>" target="_blank" class="btn btn-primary">CRON</a>
	</div>

	<table class="table table-bordered table-dark table-hover" id="tbl-push" style="width:100%">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">TÍTULO</th>
				<th scope="col">TEXTO</th>
				<th scope="col">PRODUCTO ASOCIADO</th>
				<th scope="col">PAQUETE</th>
				<th scope="col">FECHA</th>
				<th scope="col">FLAG</th>
			</tr>
		</thead>
		<tbody>
			<?php if( $pushs ){ ?>
			<?php $i=1; ?>
			<?php foreach( $pushs as $push ){ ?>
			<tr>
				<th scope="row"><?php echo $i++ ?></th>
				<td><?php echo $push->PUSH_TITLE ?></td>
				<td><?php echo $push->PUSH_TEXTO ?></td>
				<td><?php echo getNmbProducto($push->PRODUCTO_ID) ?></td>
				<td><?php echo $push->PUSH_PACKAGE ?></td>
				<td><?php echo $push->PUSH_DATE ?></td>
				<td><?php echo $push->PUSH_FLAG ?></td>
			</tr>
			<?php } ?>
			<?php }else{ ?>
			<tr>
				<td colspan="5">AÚN NO HAS INGRESADO NOTIFICACIONES</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
	<?php }//IF SESSION?>

	</div>
</div>


<!--=====================================
MODAL AGREGAR PUSH
======================================-->
<div id="mdlPush" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data" id="formAddPush">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header">
			AGREGAR NOTIFICACIÓN
			<button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
        	
        	<div class="row">
			
				<input type="hidden" name="idEmpresaProducto" id="idEmpresaProducto" value="<?php echo $this->session_id?>">

				<div class="col-12">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<input type="text" class="form-control" name="txtPushTitle" id="txtPushTitle" placeholder="TÍTULO NOTIFICACIÓN (*)..." required>
						</div>
					</div>
				</div>

				<div class="col-12">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<input type="text" class="form-control" name="txtPushTexto" id="txtPushTexto" placeholder="TEXTO NOTIFICACIÓN (*)..." required>
						</div>
					</div>
				</div>
				
				<div class="col-12">
					<div class="form-group">              
						<div class="input-group">              
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<select class="form-control" id="idProductoPush" name="idProductoPush">
								<option value="">SELECCIONAR PRODUCTO...</option>
								<?php foreach( $productos as $producto){?>
									<option value="<?php echo $producto->PRODUCTO_ID ?>"><?php echo $producto->PRODUCTO_NOMBRE?></option>
								<?php }?>
							</select>
						</div>
						<small id="emailHelp" class="form-text text-muted">SELECCIONAR PRODUCTO SOLO SI DESEA ENLAZAR LA NOTIFICACIÓN A LA VISTA DEL PRODUCTO EN LA APP</small>
					</div>
				</div>

        		<div class="col-12 mt-3">
					<div class="form-group">
						<button type="button" class="btn btn-primary btn-block" id="btnGuardarPush">ENVIAR NOTIFICACIÓN</button>
					</div>
				</div>

        	</div><!-- PIE ROW -->
        
		</div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
        </div>

      </form>

    </div>

  </div>

</div>
