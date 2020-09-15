<div class="row mb-2">
	<div class="col">
		<button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarDestacado">
			Agregar Destacado
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

<table class="table table-bordered table-dark table-hover" id="destacados" style="width:100%">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">LOGOTIPO</th>
      <th scope="col">EMPRESA</th>
      <th scope="col">INGRESO</th>
      <th scope="col">ACCIONES</th>
    </tr>
  </thead>
</table>

<!--=====================================
MODAL AGREGAR DESTACADO
======================================-->
<div id="modalAgregarDestacado" class="modal fade" role="dialog">  
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="<?php echo base_url()?>destacados/insert" role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
			<h4 class="modal-title">Agregar Destacado</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
		<div id="fotodestacadaloading" class="text-center"></div>

        <div class="modal-body">
        
        	<div id="respuesta"></div>
        	
        	<div class="row">
        		<div class="col-12">

					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<select class="form-control chosen-select" id="cmbEmpresa" name="cmbEmpresa" required>
								<option value="">SELECCIONAR EMPRESA (*)...</option>
								<?php foreach( $empresas as $itemEmpresas){?>
									<option value="<?php echo $itemEmpresas->EMPRESA_ID?>"><?php echo $itemEmpresas->EMPRESA_NOMBRE?></option>
								<?php }?>
							</select>
						</div>
					</div>

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
						<span class="help-block text-secondary">512MB máximo por imagen.</span>
					</div>

        		</div>

        	</div><!-- PIE ROW -->

		</div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
			<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
			<button type="submit" class="btn btn-primary" id="btnGuardarDestacado">Guardar Destacado</button>
        </div>

      </form>     

    </div>

  </div>

</div>

<!--=====================================
MODAL VER DESTACADO
======================================-->
<div id="modalVerDestacado" class="modal fade" role="dialog">  
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
			<h4 class="modal-title"><span id="verNmbEmpresaDest"></span></h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
		<div id="verloading" class="text-center"></div>

        <div class="modal-body">
        	
        	<div class="row">
        		<div class="col-12 col-md-8">
        		
					<table class="table">
						<tr>
							<td class="table-primary">DESCRIPCIÓN</td>
							<td><span id="verDescEmpresaDest"></span></td>
						</tr>
						<tr>
							<td class="table-primary">INGRESO</td>
							<td><span id="verDateEmpresaDest"></span></td>
						</tr>
					</table>
       		
       				<div id="txtVerDestFotos"></div>
       			
        		</div>
        		
        		<div class="col-12 col-md-4">
        			<img src="" class="img-thumbnail previsualizarVerLogoEmpresa" width="80%">   			
        		</div>
        		
        	</div><!-- PIE ROW -->
        
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
