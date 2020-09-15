<!--
<div class="row mb-5">
	<div class="col">
        <ul class="nav nav-pills">
          <li class="nav-item">
            <a class="nav-link active" href="<?php echo base_url()?>productos">PRODUCTOS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url()?>productos/insert">INGRESAR</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url()?>productos/down">ELIMINADOS</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url()?>categoriasrest" target="_blank">API</a>
          </li>
        </ul>
    </div>
</div>
-->
<div class="row mb-2">
	<div class="col">
		<button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarTipoComida">
			Agregar Tipo de Comida
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

<table class="table table-bordered table-dark table-hover" id="tipocomida" style="width:100%">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">IMAGEN</th>
      <th scope="col">T° DE COMIDA</th>
      <th scope="col">ESTADO</th>
      <th scope="col">ORDEN</th>
      <th scope="col">ACCIONES</th>
    </tr>
  </thead>
</table>

<!--=====================================
MODAL AGREGAR TIPO DE NEGOCIO
======================================-->
<div id="modalAgregarTipoComida" class="modal fade" role="dialog">  
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo base_url()?>tipocomida/insert" role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
			<h4 class="modal-title">Agregar Tipo de Comida</h4>
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
					<input type="text" class="form-control" name="nuevoTipoComida" id="nuevoTipoComida" placeholder="Ingresar Tipo de Comida..." required>
				</div>
			</div>
       
			<div class="form-group">              
				<div class="panel">IMAGEN DE COMIDA</div>
				<input type="file" class="nuevaFotoComida" name="nuevaFotoComida" id="nuevaFotoComida">
				<p class="help-block">Peso máximo de la foto 512KB</p>
				<img src="<?php echo base_url('public/images/food-defecto.png')?>" class="img-thumbnail previsualizarComida" width="100px">
			</div>
        
		</div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
			<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
			<button type="submit" class="btn btn-primary" id="guardarTipoComida">Guardar Tipo de Comida</button>
        </div>

      </form> 

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR TIPO DE NEGOCIO
======================================-->
<div id="modalEditarTipoComida" class="modal fade" role="dialog">  
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo base_url()?>tipocomida/editar" role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
			<h4 class="modal-title">Editar Tipo de Comida</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
        
        	<div id="respuestaeditar"></div>

			<div class="form-group">              
				<div class="input-group">              
					<span class="input-group-addon"><i class="fa fa-plus"></i></span>
					<input type="hidden" name="editarIdTipoComida" id="editarIdTipoComida" >
					<input type="text" class="form-control" name="editarTipoComida" id="editarTipoComida" placeholder="Editar Tipo de Comida..." required>
				</div>
			</div>
       
			<div class="form-group">              
				<div class="panel">IMAGEN DE COMIDA</div>
				<input type="file" class="nuevaFotoComida" name="nuevaFotoComida" id="nuevaFotoComida">
				<p class="help-block">Peso máximo de la foto 512KB</p>
				<img src="<?php echo base_url('public/images/food-defecto.png')?>" class="img-thumbnail previsualizarComida" width="100px">
              	<input type="hidden" name="fotoActual" id="fotoActual">
			</div> 
       		
       		<div id="loading" class="text-center"></div>
        
		</div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
			<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
			<button type="submit" class="btn btn-primary" id="btnEditarTipoComida">Editar Tipo de Comida</button>
        </div>

      </form> 

    </div>

  </div>

</div>
    