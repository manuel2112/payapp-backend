<div class="row mb-2">
	<div class="col">
		<button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCiudad">
			Agregar Ciudad
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

<table class="table table-bordered table-dark table-hover" id="ciudad" style="width:100%">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">IMAGEN</th>
      <th scope="col">CIUDAD</th>
      <th scope="col">ESTADO</th>
      <th scope="col">ACCIONES</th>
    </tr>
  </thead>
</table>

<!--=====================================
MODAL AGREGAR CIUDAD
======================================-->
<div id="modalAgregarCiudad" class="modal fade" role="dialog">  
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo base_url()?>ciudad/insert" role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
			<h4 class="modal-title">Agregar Ciudad</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
        
        	<div id="respuesta"></div>			

			<div class="form-group">              
				<div class="input-group">              
					<span class="input-group-addon"><i class="fa fa-plus"></i></span> 
					<input type="text" class="form-control" name="nuevaCiudad" id="nuevaCiudad" placeholder="Ingresar Ciudad..." required>
				</div>
			</div>
       
			<div class="form-group">              
				<div class="panel">IMAGEN CIUDAD</div>
				<input type="file" class="nuevaFotoCiudad" name="nuevaFotoCiudad" id="nuevaFotoCiudad">
				<p class="help-block">Peso máximo de la foto 512KB</p>
				<img src="<?php echo base_url('public/images/food-defecto.png')?>" class="img-thumbnail previsualizarCiudad" width="100px">
			</div>
        
		</div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
			<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
			<button type="submit" class="btn btn-primary" id="guardarCiudad" disabled>Guardar Ciudad</button>
        </div>

      </form> 

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR TIPO DE NEGOCIO
======================================-->
<div id="modalEditarCiudad" class="modal fade" role="dialog">  
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo base_url()?>ciudad/editar" role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
			<h4 class="modal-title">Editar Ciudad</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
		<div id="verloading" class="text-center"></div>

        <div class="modal-body">
        
        	<div id="respuestaeditar"></div>

			<div class="form-group">              
				<div class="input-group">              
					<span class="input-group-addon"><i class="fa fa-plus"></i></span>
					<input type="hidden" name="editarIdCiudad" id="editarIdCiudad" >
					<input type="text" class="form-control" name="editarCiudad" id="editarCiudad" placeholder="Editar Ciudad..." required>
				</div>
			</div>
       
			<div class="form-group">              
				<div class="panel">IMAGEN DE CIUDAD</div>
				<input type="file" class="nuevaFotoCiudad" name="nuevaFotoCiudad" id="nuevaFotoCiudad">
				<p class="help-block">Peso máximo de la foto 512KB</p>
				<img src="<?php echo base_url('public/images/food-defecto.png')?>" class="img-thumbnail previsualizarCiudad" width="100px">
              	<input type="hidden" name="fotoActual" id="fotoActual">
			</div>
        
		</div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
			<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
			<button type="submit" class="btn btn-primary" id="btnEditarCiudad">Editar Ciudad</button>
        </div>

      </form> 

    </div>

  </div>

</div>
    