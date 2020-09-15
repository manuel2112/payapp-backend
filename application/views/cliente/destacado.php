<div class="row">
	<div class="col-12">
		<div class="modal-header" style="background:#3c8dbc; color:white">
			<h4 class="modal-title">Destacado</h4>
		</div>		
	</div>
</div>

<div class="row mt-5">
	<div class="col-6">
		<?php if( $imagenes != '' ){?>
		<h4>DESTACADO ACTUAL</h4>
		
		<table class="table">
			<tr>
				<td class="table-primary">DESCRIPCIÓN</td>
				<td><?php echo $destacado->DESTACADO_DESCRIPCION;?></td>
			</tr>
			<tr>
				<td class="table-primary">INGRESO</td>
				<td><?php echo $destacado->DESTACADO_INGRESO;?></td>
			</tr>
			<tr>
				<td colspan="2">
     
					<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">

						<div class="carousel-inner">
							<?php $i = 1;?>
							<?php foreach( $imagenes as $itemImagen ){?>
								<div class="carousel-item <?php echo $i == 1 ? 'active' : '' ;?>">
									<img class="d-block w-100" src="<?php echo base_url().$itemImagen->EMP_DES_IMG?>" alt="First slide">
								</div>
							<?php $i++;?>
							<?php }?>
						</div>

						<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>

					</div>
					
				</td>
			</tr>
		</table>
		<?php }else{?>
			<div class="alert alert-warning text-center" style="padding: 50px 0;">
				<strong>NO EXISTE DESCACADO INGRESADO</strong>
			</div>		
		<?php }?>	

	</div>
	
	<div class="col-6">
		
		<h4>INGRESAR NUEVO DESTACADO</h4>

		<?php if ( $this->session->flashdata('exito') ){ ?>
			<div class="alert alert-success">
			  <?php echo $this->session->flashdata('exito');?>
			  <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
				<span aria-hidden="true">&times;</span>
			  </button>
			</div>
		<?php }?>

		<form action="<?php echo base_url()?>cliente/destacadoinsert" role="form" method="post" enctype="multipart/form-data">

			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-plus"></i></span>
					<textarea class="form-control" rows="5" name="txtDescripcion" id="txtDescripcion" placeholder="DESCRIPCIÓN (*)..." required></textarea>
				</div>
			</div>

			<div class="form-group">
				<div class="file-loading">
					<input type="file" id="file-es" name="file-es[]" multiple>
				</div>
				<span class="help-block text-secondary">5 imagenes máximo.</span><br>
				<span class="help-block text-secondary">1MB máximo por imagen.</span>
			</div>

			<div class="form-group mt-5">
				<button type="submit" class="btn btn-primary btn-block" id="btnGuardarDestacadoCLiente">Ingresar Destacado</button>
			</div>

		</form>

	</div>
</div><!-- PIE ROW -->
