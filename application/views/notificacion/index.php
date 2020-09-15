<div class="row mb-1">
	<div class="col-12">
		<div class="modal-header" style="background:#3c8dbc; color:white">
			<h4 class="modal-title">NOTIFICACIONES</h4>
		</div>		
	</div>
</div>

<div class="row mb-2">
	<div class="col">
		<button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarNotificacion">
			AGREGAR NOTIFICACIÓN
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

<table class="table table-bordered table-dark table-hover" id="tblnotificacion" style="width:100%">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">ID</th>
      <th scope="col">EMPRESA</th>
      <th scope="col">HR. INGRESO</th>
      <th scope="col">HR. ENVÍO</th>
      <th scope="col">PROGRAMADA</th>
      <th scope="col">T° DE PAGO</th>
      <th scope="col">MONTO</th>
      <th scope="col">ACCIONES</th>
    </tr>
  </thead>
</table>

<!--=====================================
MODAL AGREGAR NOTIFICACIÓN
======================================-->
<div id="modalAgregarNotificacion" class="modal fade" role="dialog">  
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <form action="<?php echo base_url()?>notificacion/insert" role="form" method="post" enctype="multipart/form-data">

			<!--=====================================
			CABEZA DEL MODAL
			======================================-->

			<div class="modal-header" style="background:#3c8dbc; color:white">
				<h4 class="modal-title">AGREGAR NOTIFICACIÓN</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!--=====================================
			CUERPO DEL MODAL
			======================================-->

			<div class="modal-body">

				<div class="row">
					<div class="col-12">

						<div class="form-group">
							<select class="form-control chosen-select" id="cmbEmpresa" name="cmbEmpresa" required>
								<option value="">SELECCIONAR EMPRESA</option>
							<?php foreach( $empresas as $empresa ){?>
								<option value="<?php echo $empresa->EMPRESA_ID;?>"><?php echo $empresa->EMPRESA_NOMBRE;?></option>
							<?php }?>
							</select>
						</div>

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

					</div>
				</div><!-- PIE ROW -->

			</div>

			<!--=====================================
			PIE DEL MODAL
			======================================-->

			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
				<button type="submit" class="btn btn-primary">Guardar</button>
			</div>
        
		</form>    

    </div>

  </div>

</div>

<!--=====================================
MODAL VER NOTIFICACIÓN
======================================-->
<div id="modalVerNotificacion" class="modal fade" role="dialog">  
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
			<h4 class="modal-title">NOTIFICACIÓN</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
		<div id="getNotificacionloading" class="text-center"></div>

        <div class="modal-body">

        	<div class="row">
        		<div class="col-12 col-md-8">
        		
					<table class="table">
						<tr>
							<td class="table-primary">idnotificacion</td>
							<td><span id="getNotificacionId"></span></td>
						</tr>
						<tr>
							<td class="table-primary">idempresa</td>
							<td><span id="getNotificacionIdEmpresa"></span></td>
						</tr>
						<tr>
							<td class="table-primary">EMPRESA</td>
							<td><span id="getNotificacionEmpresa"></span></td>
						</tr>
						<tr>
							<td class="table-primary">TEXTO</td>
							<td><span id="getNotificacionTexto" style="white-space: pre-line"></span></td>
						</tr>
						<tr>
							<td class="table-primary">INGRESO</td>
							<td><span id="getNotificacionIngreso"></span></td>
						</tr>
						<tr>
							<td class="table-primary">ENVÍO</td>
							<td><span id="getNotificacionEnvio"></span></td>
						</tr>
						<tr>
							<td class="table-primary">PROGRAMADA</td>
							<td><span id="getNotificacionProgramada"></span></td>
						</tr>
						<tr>
							<td class="table-primary">T° COMPRA</td>
							<td><span id="getNotificacionTipoCompra"></span></td>
						</tr>
						<tr>
							<td class="table-primary">OBS.</td>
							<td><span id="getNotificacionObs"></span></td>
						</tr>
						<tr>
							<td class="table-primary">MONTO</td>
							<td><span id="getNotificacionTipoMonto"></span></td>
						</tr>
						<tr>
							<td class="table-primary">APROBADO</td>
							<td><span id="getNotificacionFlag"></span></td>
						</tr>
					</table>
       		
       				<span id="getNotificacionImg"></span>
       				
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

<!--=====================================
MODAL EDITAR NOTIFICACIÓN
======================================-->
<div id="modalEditarNotificacion" class="modal fade" role="dialog">  
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="<?php echo base_url()?>notificacion/editar" role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
			<h4 class="modal-title">EDITAR NOTIFICACIÓN >> <span id="editNotificacionEmpresa"></span></h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
		<div id="editNotificacionloading" class="text-center"></div>
       
        <div class="modal-body">
        
        	<div id="respuesta"></div>
        	
        	<div class="row">
        		<div class="col-12 col-md-8">
        		
        			
					<input type="hidden" name="editNotificacionId" id="editNotificacionId">
					<input type="hidden" name="editNotificacionIdEmpresa" id="editNotificacionIdEmpresa">

					<div class="form-group">
						<label for="editNotificacionTexto">TEXTO NOTIFICACIÓN:</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>							
							<textarea class="form-control" rows="5" name="editNotificacionTexto" id="editNotificacionTexto" placeholder="DESCRIPCIÓN (*)..." required></textarea>
						</div>
					</div>

					<div class="form-group">
						<label for="editNotificacionEnvio">FECHA DE ENVÍO:</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<input type="text" class="form-control" name="editNotificacionEnvio" id="editNotificacionEnvio" placeholder="HORA DE ENVÍO (*)..." required>
						</div>
					</div>

					<div class="form-group">
						<label for="cmbEditTipoCompra">TIPO DE COMPRA:</label>
						<select class="form-control" id="cmbEditTipoCompra" name="cmbEditTipoCompra">
							<option value="0">SIN INFORMACIÓN</option>
							<?php foreach( $compras as $itemCompra ){?>
								<option value="<?php echo $itemCompra->TIPO_COMPRA_ID?>"><?php echo $itemCompra->TIPO_COMPRA_NOMBRE?></option>
							<?php }?>
						</select>
					</div>
							
					<div id="pago-efectivo-edit" class="mb-3">
						<label for="cmbEditTipoMonto">MONTO DE PAGO:</label>
						<select class="form-control" id="cmbEditTipoMonto" name="cmbEditTipoMonto">
							<option value="">SELECCIONAR MONTO</option>
							<?php foreach( $montos as $itemMonto ){?>
								<option value="<?php echo $itemMonto->TIPO_MONTO_ID?>"><?php echo formatoDinero($itemMonto->TIPO_MONTO_NOMBRE)?></option>
							<?php }?>
						</select>
					</div>

					<div class="form-group">
						<label for="editNotificacionObs">OBSERVACIONES:</label>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>							
							<textarea class="form-control" rows="5" name="editNotificacionObs" id="editNotificacionObs" placeholder="OBSERVACIÓN (*)..."></textarea>
						</div>
					</div>

					<div class="form-group">
						<div class="panel">IMAGEN DE NOTIFICACIÓN:</div>
						<img class="img-thumbnail previsualizarEmpresa" width="100px">
						<input type="file" class="nuevaFotoEmpresa" name="nuevaFotoEmpresa" id="nuevaFotoEmpresa">
						<p class="help-block">Peso máximo de la foto 512KB</p>
              			<input type="hidden" name="editNotificacionImg" id="editNotificacionImg">
					</div>
        		</div>
        		
        		<div class="col-12 col-md-4">
        		
        			<img src="" class="img-thumbnail previsualizarVerLogoEmpresa" width="80%">
        			
        			<br><br>
        			
					<fieldset>
						<legend>DATOS DE ENVÍO:</legend>

						<div class="form-group">
							<label for="editNotificacionEnvio">TOTAL:</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-plus"></i></span>
								<input type="number" class="form-control" name="editNotificacionEnviados" id="editNotificacionEnviados" placeholder="TOTAL DE ENVÍOS (*)...">
							</div>
						</div>

						<div class="form-group">
							<label for="editNotificacionEnvio">APERTURAS:</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-plus"></i></span>
								<input type="number" class="form-control" name="editNotificacionAperturas" id="editNotificacionAperturas" placeholder="APERTURAS (*)...">
							</div>
						</div>
					
					</fieldset>        			
        		</div>
        		
        	</div><!-- PIE ROW -->
        
		</div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
			<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
			<button type="submit" class="btn btn-primary" id="btnEditNotificacion">Editar Notificación</button>
        </div>

      </form>     

    </div>

  </div>

</div>

<!--=====================================
MODAL PAGO NOTIFICACIÓN
======================================-->
<div id="modalInsertTipoPago" class="modal fade" role="dialog">  
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="<?php echo base_url()?>destacados/insert" role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
			<h4 class="modal-title">TIPO PAGO NOTIFICACIÓN</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
		<div id="getPagoNotificacionloading" class="text-center"></div>

        <div class="modal-body">

        	<div class="row">
        		<div class="col-12 col-md-8">
        		
					<table class="table">
						<tr>
							<td class="table-primary">ID</td>
							<td><span id="getPagoNotificacionId"></span></td>
						</tr>
						<tr>
							<td class="table-primary">EMPRESA</td>
							<td><span id="getPagoNotificacionEmpresa"></span></td>
						</tr>
						<tr>
							<td class="table-primary">TEXTO</td>
							<td><span id="getPagoNotificacionTexto"></span></td>
						</tr>
					</table>
					
					<fieldset>
						<legend>INGRESAR FORMA DE PAGO</legend>
							
							<div class="btn-group btn-group-toggle" data-toggle="buttons">
								<?php foreach( $compras as $itemCompra ){?>
									<label class="btn btn-primary">
										<input type="radio" name="opttipopago" class="opttipopago" value="<?php echo $itemCompra->TIPO_COMPRA_ID?>"> <?php echo $itemCompra->TIPO_COMPRA_NOMBRE?>
									</label>
								<?php }?>
							</div>
							
							<div id="pago-efectivo">							
								<div class="btn-group btn-group-toggle" data-toggle="buttons">
									<?php foreach( $montos as $itemMonto ){?>
										<label class="btn btn-info">
											<input type="radio" name="optpagoefectivo" class="optpagoefectivo" value="<?php echo $itemMonto->TIPO_MONTO_ID?>"> <?php echo formatoDinero($itemMonto->TIPO_MONTO_NOMBRE)?>
										</label>
									<?php }?>
								</div>								
							</div>
							
							<div class="form-group" id="txt-obs">
								<textarea class="form-control" rows="5" id="observacion" placeholder="OBSERVACIÓN DE PAGO"></textarea>
							</div> 							

					</fieldset>
        		</div>
        		
        		<div class="col-12 col-md-4">
        			<img src="" class="img-thumbnail previsualizarVerLogoEmpresa" width="80%">
        			<hr>
        			<span id="getPagoNotificacionImg"></span>
        		</div>
        		
        	</div><!-- PIE ROW -->

		</div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
			<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
			<span id="btnInsertTipoPagoDiv"><button type="button" class="btn btn-primary" id="btnInsertTipoPago">Guardar Notificación</button></span>
			
        </div>

      </form>     

    </div>

  </div>

</div>
