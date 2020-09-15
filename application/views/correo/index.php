<div class="row mb-2">
	<div class="col">
		<button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarArchivo">
			Agregar Archivo
		</button>
		<button class="btn btn-danger float-right" data-toggle="modal" data-target="#modalDeleteArchivo">
			Eliminar Correos
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

<div id="tblemailciudades">

	<div id="accordion" class="mt-4">
		<div class="card">
			<div class="card-header">
				<a class="card-link" data-toggle="collapse" href="#collapse1">
				QUILPUÉ
				</a>
			</div>
			<div id="collapse1" class="collapse" data-parent="#accordion">
				<div class="clearfix">
					<a href="<?php echo base_url().'correo/exportarporciudad/1';?>" class="btn btn-primary float-right clearfix" target="_blank">EXPORTAR 2000 ACTIVOS</a>
				</div>		

				<div class="clarfix"></div>
				<div class="card-body">
					<table class="table table-bordered table-dark table-hover" id="tblquilpue" style="width:100%">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">EMAIL</th>
								<th scope="col">ESTADO</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-header">
				<a class="card-link" data-toggle="collapse" href="#collapse2">
				VILLA ALEMANA
				</a>
			</div>
			<div id="collapse2" class="collapse" data-parent="#accordion">
				<div class="clearfix">
					<a href="<?php echo base_url().'correo/exportarporciudad/2';?>" class="btn btn-primary float-right clearfix" target="_blank">EXPORTAR 2000 ACTIVOS</a>
				</div>		

				<div class="clarfix"></div>
				<div class="card-body">
					<table class="table table-bordered table-dark table-hover" id="tblvillaalemana" style="width:100%">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">EMAIL</th>
								<th scope="col">ESTADO</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
	
</div>

<!--=====================================
MODAL AGREGAR ARCHIVO TXT
======================================-->
<div id="modalAgregarArchivo" class="modal fade" role="dialog">  
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="<?php echo base_url()?>correo/insert" role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
			<h4 class="modal-title">Agregar Archivo</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
        
        	<div id="respuesta"></div>
        	
        	<div class="row">
        		<div class="col-12">
        		
					<div class="form-group">              
						<div class="input-group">              
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<select class="form-control" id="cmbCiudad" name="cmbCiudad" required>
								<option value="">SELECCIONAR CIUDAD (*)...</option>
								<?php foreach( $ciudades as $itemCiudades){?>
									<option value="<?php echo $itemCiudades->CIUDAD_ID?>"><?php echo $itemCiudades->CIUDAD_NOMBRE?></option>
								<?php }?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<div class="panel">ARCHIVO</div>
						<input type="file" class="archivo" name="archivo" id="archivo" required>
					</div>
        		</div>
        		
        	</div><!-- PIE ROW -->
        
		</div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
			<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
			<button type="submit" class="btn btn-primary" id="btninsertFileEmails">Ingresar Archivo</button>
        </div>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL ELIMINAR ARCHIVO TXT
======================================-->
<div id="modalDeleteArchivo" class="modal fade" role="dialog">  
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="<?php echo base_url()?>correo/delete" role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
			<h4 class="modal-title">Eliminar Correos</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
        
        	<div id="respuesta"></div>
        	
        	<div class="row">
        		<div class="col-12">

					<div class="form-group">
						<div class="panel">ARCHIVO</div>
						<input type="file" class="archivo" name="archivo" id="archivo" required>
					</div>
        		</div>
        		
        	</div><!-- PIE ROW -->
        
		</div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
			<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
			<button type="submit" class="btn btn-primary" id="btninsertFileEmails">Ingresar Archivo</button>
        </div>

      </form>

    </div>

  </div>

</div>