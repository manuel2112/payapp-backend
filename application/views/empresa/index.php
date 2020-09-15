<div class="row mb-2">
	<div class="col">
		<button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarEmpresa">
			Agregar Empresa
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

<table class="table table-bordered table-dark table-hover" id="empresa" style="width:100%">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">ID</th>
      <th scope="col">LOGOTIPO</th>
      <th scope="col">EMPRESA</th>
      <th scope="col">CIUDAD</th>
      <th scope="col">ACCIONES</th>
    </tr>
  </thead>
</table>

<!--=====================================
MODAL AGREGAR EMPRESA
======================================-->
<div id="modalAgregarEmpresa" class="modal fade" role="dialog">  
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="<?php echo base_url()?>empresa/insert" role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
			<h4 class="modal-title">Agregar Empresa</h4>
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
				</div>
				
        		<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<input type="text" class="form-control" name="txtEmpresaNombre" id="txtEmpresaNombre" placeholder="NOMBRE EMPRESA (*)..." required>
						</div>
					</div>
				</div>
				
        		<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<input type="text" class="form-control" name="txtEmpresaRazon" id="txtEmpresaRazon" placeholder="RAZÓN SOCIAL (*)..." required>
						</div>
					</div>
				</div>
				
        		<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<input type="text" class="form-control" name="txtEmpresaRut" id="txtEmpresaRut" placeholder="EMPRESA RUT (*)..." required>
						</div>
					</div>
				</div>
				
        		<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<input type="text" class="form-control" name="txtEmpresaDireccion" id="txtEmpresaDireccion" placeholder="EMPRESA DIRECCIÓN...">
						</div>
					</div>
				</div>
				
        		<div class="col-12 col-md-6">					
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<input type="text" class="form-control" name="txtEmpresaLatitud" id="txtEmpresaLatitud" placeholder="LATITUD...">
						</div>
					</div>
				</div>
				
        		<div class="col-12 col-md-6">					
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<input type="text" class="form-control" name="txtEmpresaLongitud" id="txtEmpresaLongitud" placeholder="LONGITUD...">
						</div>
					</div>
				</div>
				
        		<div class="col-12 col-md-6">					
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<input type="text" class="form-control" name="txtEmpresaFono" id="txtEmpresaFono" placeholder="TELÉFONO (*)..." required>
						</div>
					</div>
				</div>
				
        		<div class="col-12 col-md-6">					
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<input type="text" class="form-control" name="txtEmpresaEmail" id="txtEmpresaEmail" placeholder="EMAIL...">
						</div>
					</div>
				</div>
				
        		<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<input type="text" class="form-control" name="txtEmpresaUrlWeb" id="txtEmpresaUrlWeb" placeholder="WEB URL...">
						</div>
					</div>
				</div>
				
        		<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<input type="text" class="form-control" name="txtEmpresaUrlFacebook" id="txtEmpresaUrlFacebook" placeholder="FACEBOOK URL...">
						</div>
					</div>
				</div>
				
        		<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<input type="text" class="form-control" name="txtEmpresaUrlInstagram" id="txtEmpresaUrlInstagram" placeholder="URL INSTAGRAM...">
						</div>
					</div>
				</div>
				
        		<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<input type="text" class="form-control" name="txtEmpresaCodigoComercio" id="txtEmpresaCodigoComercio" placeholder="CÓDIGO DE COMERCIO...">
						</div>
					</div>
				</div>
				
        		<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<textarea class="form-control" rows="5" name="txtEmpresaDescripcion" id="txtEmpresaDescripcion" placeholder="DESCRIPCIÓN (*)..." required></textarea>
						</div>
					</div>
				</div>
				
        		<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="panel">LOGOTIPO</div>
						<input type="file" class="nuevaFotoEmpresa" name="nuevaFotoEmpresa" id="nuevaFotoEmpresa">
						<p class="help-block">Peso máximo de la foto 512KB</p>
						<img src="<?php echo base_url('public/images/food-defecto.png')?>" class="img-thumbnail previsualizarEmpresa" width="100px">
					</div>
        		</div>
        		
        	</div><!-- PIE ROW -->
        
		</div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
			<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
			<button type="submit" class="btn btn-primary" id="btnGuardarEmpresa">Guardar Empresa</button>
        </div>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR EMPRESA
======================================-->
<div id="modalEditarEmpresa" class="modal fade" role="dialog">  
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="<?php echo base_url()?>empresa/editar" role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
			<h4 class="modal-title">Editar Empresa</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
		<div id="editarloading" class="text-center"></div>
       
        <div class="modal-body">
        
        	<div id="respuesta"></div>
        	
        	<div class="row">
				
        		<div class="col-12">
					<div class="form-group">              
						<div class="input-group">              
							<span class="input-group-addon" data-toggle="tooltip" data-placement="top" title="SELECCIONAR CIUDAD"><i class="fa fa-plus"></i></span> 
							<select class="form-control" id="cmbEditCiudad" name="cmbEditCiudad" required>
								<?php foreach( $ciudades as $itemCiudades){?>
									<option value="<?php echo $itemCiudades->CIUDAD_ID?>"><?php echo $itemCiudades->CIUDAD_NOMBRE?></option>
								<?php }?>
							</select>
						</div>
					</div>
				</div>
				
        		<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon" data-toggle="tooltip" data-placement="top" title="NOMBRE EMPRESA"><i class="fa fa-plus"></i></span>
							<input type="hidden" name="idEditEmpresa" id="idEditEmpresa" >
							<input type="text" class="form-control" name="txtEditEmpresa" id="txtEditEmpresa" placeholder="NOMBRE EMPRESA (*)..." required>
						</div>
					</div>
				</div>
				
        		<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon" data-toggle="tooltip" data-placement="top" title="RAZÓN SOCIAL"><i class="fa fa-plus"></i></span>
							<input type="text" class="form-control" name="txtEditRazon" id="txtEditRazon" placeholder="RAZÓN SOCIAL (*)..." required>
						</div>
					</div>
				</div>
				
        		<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon" data-toggle="tooltip" data-placement="top" title="EMPRESA RUT"><i class="fa fa-plus"></i></span>
							<input type="text" class="form-control" name="txtEditRut" id="txtEditRut" placeholder="EMPRESA RUT (*)..." required>
						</div>
					</div>
				</div>
				
        		<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon" data-toggle="tooltip" data-placement="top" title="DIRECCIÓN"><i class="fa fa-plus"></i></span>
							<input type="text" class="form-control" name="txtEditDireccion" id="txtEditDireccion" placeholder="DIRECCIÓN...">
						</div>
					</div>
				</div>
				
        		<div class="col-12 col-md-6">					
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon" data-toggle="tooltip" data-placement="top" title="LATITUD"><i class="fa fa-plus"></i></span>
							<input type="text" class="form-control" name="txtEditLatitud" id="txtEditLatitud" placeholder="LATITUD...">
						</div>
					</div>
				</div>
				
        		<div class="col-12 col-md-6">					
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon" data-toggle="tooltip" data-placement="top" title="LONGITUD"><i class="fa fa-plus"></i></span>
							<input type="text" class="form-control" name="txtEditLongitud" id="txtEditLongitud" placeholder="LONGITUD...">
						</div>
					</div>
				</div>
				
        		<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon" data-toggle="tooltip" data-placement="top" title="URL WEB"><i class="fa fa-plus"></i></span>
							<input type="text" class="form-control" name="txtEditUrl" id="txtEditUrl" placeholder="URL WEB...">
						</div>
					</div>
				</div>
				
        		<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon" data-toggle="tooltip" data-placement="top" title="URL FACEBOOK"><i class="fa fa-plus"></i></span>
							<input type="text" class="form-control" name="txtEditFacebook" id="txtEditFacebook" placeholder="URL FACEBOOK...">
						</div>
					</div>
				</div>
				
        		<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon" data-toggle="tooltip" data-placement="top" title="URL INSTAGRAM"><i class="fa fa-plus"></i></span>
							<input type="text" class="form-control" name="txtEditInstagram" id="txtEditInstagram" placeholder="URL INSTAGRAM...">
						</div>
					</div>
				</div>
				
        		<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon" data-toggle="tooltip" data-placement="top" title="TELÉFONO"><i class="fa fa-plus"></i></span>
							<input type="text" class="form-control" name="txtEditFono" id="txtEditFono" placeholder="TELÉFONO..." required>
						</div>
					</div>
				</div>
				
        		<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon" data-toggle="tooltip" data-placement="top" title="EMAIL"><i class="fa fa-plus"></i></span>
							<input type="text" class="form-control" name="txtEditEmail" id="txtEditEmail" placeholder="EMAIL...">
						</div>
					</div>
				</div>
				
        		<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon" data-toggle="tooltip" data-placement="top" title="CÓDIGO DE COMERCIO"><i class="fa fa-plus"></i></span>
							<input type="text" class="form-control" name="txtEditComercio" id="txtEditComercio" placeholder="CÓDIGO DE COMERCIO...">
						</div>
					</div>
				</div>
				
        		<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon" data-toggle="tooltip" data-placement="top" title="DESCRIPCIÓN"><i class="fa fa-plus"></i></span>
							<textarea class="form-control" rows="5" name="txtEditDescripcion" id="txtEditDescripcion" placeholder="DESCRIPCIÓN (*)..." required></textarea>
						</div>
					</div>
				</div>
				
        		<div class="col-12 col-md-6">
					<div class="form-group">
						<div class="panel">LOGOTIPO</div>
						<img class="img-thumbnail previsualizarEmpresa" width="100px">
						<input type="file" class="EditFotoEmpresa" name="EditFotoEmpresa" id="EditFotoEmpresa">
						<p class="help-block">Peso máximo de la foto 512KB</p>
              			<input type="hidden" name="fotoActualEmpresa" id="fotoActualEmpresa">
					</div>
        		</div>

        	</div><!-- PIE ROW -->

		</div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
			<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
			<button type="submit" class="btn btn-primary" id="btnEditarEmpresa">Editar Empresa</button>
        </div>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL VER EMPRESA
======================================-->
<div id="modalVerEmpresa" class="modal fade" role="dialog">  
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
			<h4 class="modal-title"><span id="verNmbEmpresa"></span></h4>
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
							<td class="table-primary">ID</td>
							<td><span id="verIdEmpresa"></span></td>
						</tr>
						<tr>
							<td class="table-primary">EMPRESA</td>
							<td><span id="verNmbEmpresa2"></span></td>
						</tr>
						<tr>
							<td class="table-primary">RAZÓN SOCIAL</td>
							<td><span id="verRazonSocial"></span></td>
						</tr>
						<tr>
							<td class="table-primary">RUT</td>
							<td><span id="verRutEmpresa"></span></td>
						</tr>
						<tr>
							<td class="table-primary">DIRECCIÓN</td>
							<td><span id="verDireccionEmpresa"></span></td>
						</tr>
						<tr>
							<td class="table-primary">CIUDAD</td>
							<td><span id="verCiudadEmpresa"></span></td>
						</tr>
						<tr>
							<td class="table-primary">LATITUD</td>
							<td><span id="verLatEmpresa"></span></td>
						</tr>
						<tr>
							<td class="table-primary">LONGITUD</td>
							<td><span id="verLongEmpresa"></span> <span id="verUbicacionEmpresa"></span></td>
						</tr>
						<tr>
							<td class="table-primary">WEB</td>
							<td><span id="verWebEmpresa"></span> <span id="verWebUrlEmpresa"></span></td>
						</tr>
						<tr>
							<td class="table-primary">FACEBOOK</td>
							<td><span id="verFacebookEmpresa"></span></td>
						</tr>
						<tr>
							<td class="table-primary">INSTAGRAM</td>
							<td><span id="verInstagramEmpresa"></span></td>
						</tr>
						<tr>
							<td class="table-primary">FONO</td>
							<td><span id="verFonoEmpresa"></span></td>
						</tr>
						<tr>
							<td class="table-primary">EMAIL</td>
							<td><span id="verEmailEmpresa"></span></td>
						</tr>
						<tr>
							<td class="table-primary">DESCRIPCIÓN</td>
							<td><span id="verDescEmpresa"></span></td>
						</tr>
						<tr>
							<td class="table-primary">CÓDIGO DEL COMERCIO</td>
							<td><span id="verComercioEmpresa"></span></td>
						</tr>
						<tr>
							<td class="table-primary">INGRESO</td>
							<td><span id="verIngresoEmpresa"></span></td>
						</tr>
					</table>
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

