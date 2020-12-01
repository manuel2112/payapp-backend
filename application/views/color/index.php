<div class="row mb-2">
	<div class="col">
		<button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarColor">
			Agregar Color
		</button>
    </div>
</div>

<?php if ( $this->session->flashdata('exito') ){ ?>
    <div class="alert alert-success">
      <?php echo $this->session->flashdata('exito');?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
<?php }?>

<table class="table table-bordered table-hover" id="color" style="width:100%">
	<thead class="thead-dark">
		<tr>
			<th scope="col">#</th>
			<th scope="col">COLOR</th>
			<th scope="col">NOMBRE COLOR</th>
			<th scope="col">VAR</th>
			<th scope="col">HEX</th>
			<th scope="col">ACCIONES</th>
		</tr>
	</thead>
	<tbody>

	<?php $i = 1?>
	<?php foreach( $colores as $color ){?>

		<tr>
			<th scope="row"><?php echo $i++?></th>
			<td style="background-color:<?php echo $color->COLOR_HEX?>;width:20px">&#32;</td>
			<td><?php echo $color->COLOR_NOMBRE?></td>
			<td><?php echo strtolower(str_replace(' ', '', $color->COLOR_NOMBRE))?></td>
			<td><?php echo $color->COLOR_HEX?></td>
			<td>
				<button class='btn btn-warning btnGetEditarColor' idcolor='<?php echo $color->COLOR_ID?>' data-toggle='modal' data-target='#modalEditarColor' title='EDITAR COLOR'><i class='fas fa-edit'></i></button>
				
				<button class="btn btn-danger btnDeleteColor" title="ELIMINAR COLOR" idcolor="<?php echo $color->COLOR_ID?>"><i class="fas fa-trash-alt"></i></button>
			</td>
		</tr>

	<?php }?>
	<?php if( count($colores) == 0){ ?>

		<tr>
			<th colspan="3" class="text-center">SIN CAMPOS INGRESADOS</th>
		</tr>
	<?php } ?>
	</tbody>
</table>

<!--=====================================
MODAL AGREGAR COLOR
======================================-->
<div id="modalAgregarColor" class="modal fade" role="dialog">  
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form  role="form" method="post" id="formInsertColor">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
			<h4 class="modal-title">Agregar Color</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
        	
        	<div class="row">

        		<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<input type="text" class="form-control" name="txtColorNombre" id="txtColorNombre" placeholder="NOMBRE COLOR (*)..." required>
						</div>
					</div>
				</div>
				
        		<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<input type="text" class="form-control" name="txtColorHexa" id="txtColorHexa" placeholder="COLOR HEXADECIMAL...">
						</div>
					</div>
				</div>
        		
        	</div><!-- PIE ROW -->
        
		</div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
			<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
			<button type="button" class="btn btn-primary" id="btnGuardarColor">Guardar Color</button>
        </div>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR COLOR
======================================-->
<div id="modalEditarColor" class="modal fade" role="dialog">  
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form  role="form" method="post" id="formEditColor">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
			<h4 class="modal-title">Editar Color</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
		<div id="editarloading" class="text-center"></div>
       
        <div class="modal-body">
        	
        	<div class="row">
				
        		<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon" data-toggle="tooltip" data-placement="top" title="NOMBRE COLOR"><i class="fa fa-plus"></i></span>
							<input type="hidden" name="idEditColor" id="idEditColor" >
							<input type="text" class="form-control" name="nmbEditColor" id="nmbEditColor" placeholder="NOMBRE COLOR (*)..." required>
						</div>
					</div>
				</div>
				
        		<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon" data-toggle="tooltip" data-placement="top" title="N° HEXADECIMAL"><i class="fa fa-plus"></i></span>
							<input type="text" class="form-control" name="hexaEditColor" id="hexaEditColor" placeholder="N° HEXADECIMAL...">
						</div>
					</div>
				</div>

        	</div><!-- PIE ROW -->

		</div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
			<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
			<button type="button" class="btn btn-primary" id="btnEditarColor">Editar Color</button>
        </div>

      </form>

    </div>

  </div>

</div>