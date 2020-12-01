<div class="row">
	<div class="col-12">
		<div class="modal-header" style="background:#3c8dbc; color:white">
			<h4 class="modal-title"><?php echo $empresa->EMPRESA_NOMBRE?></h4>
		</div>		
	</div>
</div>
	
	<a href="<?php echo base_url('clienterest/'.$this->session_id)?>" target="_blank" class="btn btn-primary">API</a>
	<a href="<?php echo base_url('pay')?>" target="_blank" class="btn btn-primary">PAY</a>
	<a href="<?php echo base_url('paymall')?>" target="_blank" class="btn btn-primary">PAYMALL</a>

<div class="row mt-2">

	<div class="col-12 col-md-9">

		<table class="table">
			<caption>DATOS DE LA EMPRESA</caption>
			<tr>
				<td class="table-primary">CIUDAD</td>
				<td><?php echo $empresa->CIUDAD_NOMBRE?></td>
			</tr>
			<tr>
				<td class="table-primary">DIRECCIÓN</td>
				<td>
					<?php echo $empresa->EMPRESA_DIRECCION?>
					<?php if($empresa->EMPRESA_LAT){?>
					<a href="<?php echo base_url()?>map/index/<?php echo $empresa->EMPRESA_ID?>" class="btn btn-warning" target="_blank"><i class="fa fa-map-pin"></i></a>
					<?php }?>
				</td>
			</tr>
			<tr>
				<td class="table-primary">FONO</td>
				<td><?php echo $empresa->EMPRESA_FONO?></td>
			</tr>
			<tr>
				<td class="table-primary">EMAIL</td>
				<td><?php echo $empresa->EMPRESA_EMAIL?></td>
			</tr>
			<tr>
				<td class="table-primary">WEB</td>
				<td>
					<?php echo $empresa->EMPRESA_WEB?>
				</td>
			</tr>
			<tr>
				<td class="table-primary">FACEBOOK</td>
				<td>
					<?php echo $empresa->EMPRESA_FACEBOOK?>
				</td>
			</tr>
			<tr>
				<td class="table-primary">INSTAGRAM</td>
				<td>
					<?php echo $empresa->EMPRESA_INSTAGRAM?>
				</td>
			</tr>
			<tr>
				<td class="table-primary">DESCRIPCIÓN</td>
				<td><?php echo $empresa->EMPRESA_DESCRIPCION?></td>
			</tr>
			<tr>
				<td class="table-primary">TIEMPO DE ENTREGA</td>
				<td>
					<?php echo $empresa->EMPRESA_T_ENTREGA?><br>
					<button type="button" class="btn btn-warning btn-block" data-toggle="modal" data-target="#modalTiempoEntrega">
						CAMBIAR TIEMPO ENTREGA
					</button>
				</td>
			</tr>
		</table>
		
	
	</div>
	<div class="col-12 col-md-3">
		<img src="<?php echo base_url().$empresa->EMPRESA_LOGOTIPO?>" class="img-thumbnail" width="auto">
	</div>
	
	<div class="col-12">
		<button class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalEditarDatos">
			<strong>Editar datos de la empresa</strong>
		</button>
	</div>	
        		
</div><!-- FIN ROW -->

<div class="row">

	<div class="col-12">

		<h2 class="mt-4">Horario de Atención</h2>

		<!-- <h3 id="countdown" class="mt-2"> &nbsp;</h3> -->
		<?php //echo $empresaUpdtHorario?>
		<?php echo $empresa->EMPRESA_ABIERTO == 1 ? '<h3>'.$empresaUpdtHorario.'</h3>' : '<h3 id="countdown" class="mt-2"> &nbsp;</h3>' ?>
		<?php echo $empresaUpdtHorario;?>
		<h3 id="countdown" class="mt-2">x</h3>
		<a href="<?php echo base_url('horariorest/'.$this->session_id)?>" target="_blank" class="btn btn-primary">API</a>


		<div class="btn-group" style="margin:10px 0 0;">
			<button type="button" class="btn btn-outline-dark float-right" data-toggle="modal" data-target="#mdlHorario" title="AGREGAR HORARIO" id="mdlHorarioOpen" ><i class="fas fa-plus"></i> AGREGAR HORARIO</button>
		</div>
		
		<?php $empresaAbierto = $empresa->EMPRESA_ABIERTO == 1 ? 'ABIERTO' : 'CERRADO';?>

		<table class="table table-hover">
		<caption><?php echo $empresaAbierto?></caption>
		<thead class="thead-dark">
		<tr>
		<th scope="col">#</th>
		<th scope="col">DÍA APERTURA</th>
		<th scope="col">HORARIO APERTURA</th>
		<th scope="col">DIA CIERRE</th>
		<th scope="col">HORARIO CIERRE</th>
		<th scope="col">ELIMINAR</th>
		</tr>
		</thead>
		<tbody>

		<?php $i = 1?>
		<?php foreach( $horarioEmpresa as $itemHorarioEmpresa ){?>

			<tr>
			<th scope="row"><?php echo $i++?></th>
			<td><?php echo diaSemanaNmb($itemHorarioEmpresa->HORARIO_DIA_OPEN)?></td>
			<td><?php echo $itemHorarioEmpresa->HORARIO_HORA_OPEN?></td>
			<td><?php echo diaSemanaNmb($itemHorarioEmpresa->HORARIO_DIA_CLOSE)?></td>
			<td><?php echo $itemHorarioEmpresa->HORARIO_HORA_CLOSE?></td>
			<td><button type="button" class="btn btn-danger deleteHorario" title="ELIMINAR HORARIO" idhorario="<?php echo $itemHorarioEmpresa->HORARIO_ID?>"><i class="fas fa-trash-alt"></i></button></td>
			</tr>

		<?php }?>
		</tbody>
	</div>

</div>

<!--=====================================
MODAL EDITAR EMPRESA
======================================-->
<div id="modalEditarDatos" class="modal fade" role="dialog">  
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
	  <form role="form" method="post" enctype="multipart/form-data" id="formEditCliente">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
			<h4 class="modal-title">Editar Datos de la Empresa</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
       
        <div class="modal-body">
        	
        	<div class="row">
        	
        		<div class="col-12">
        		
        			<input type="hidden" name="idEditCliente" id="idEditCliente" value="<?php echo $empresa->EMPRESA_ID?>">

					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<input type="text" class="form-control" name="txtEditDireccion" id="txtEditDireccion" placeholder="DIRECCIÓN..." value="<?php echo $empresa->EMPRESA_DIRECCION?>">
						</div>
					</div>
					
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<input type="text" class="form-control" name="txtEditFono" id="txtEditFono" placeholder="TELÉFONO (*)..." value="<?php echo $empresa->EMPRESA_FONO?>" required>
						</div>
					</div>

					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<input type="text" class="form-control" name="txtEditUrl" id="txtEditUrl" placeholder="WEB..." value="<?php echo $empresa->EMPRESA_WEB?>">
						</div>
					</div>

					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<input type="text" class="form-control" name="txtEditFacebook" id="txtEditFacebook" placeholder="FACEBOOK..." value="<?php echo $empresa->EMPRESA_FACEBOOK?>">
						</div>
					</div>

					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<input type="text" class="form-control" name="txtEditInstagram" id="txtEditInstagram" placeholder="INSTAGRAM..." value="<?php echo $empresa->EMPRESA_INSTAGRAM?>">
						</div>
					</div>

					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<textarea class="form-control" rows="5" name="txtEditDescripcion" id="txtEditDescripcion" placeholder="DESCRIPCIÓN (*)..." required><?php echo $empresa->EMPRESA_DESCRIPCION?></textarea>
						</div>
					</div>

					<div class="form-group">
						<div class="panel">LOGOTIPO</div>
						<img src="<?php echo $empresa->EMPRESA_LOGOTIPO?>" class="img-thumbnail previsualizarLogoCliente" width="100px">
						<input type="file" class="EditFotoLogoCliente" name="EditFotoLogoCliente" id="EditFotoLogoCliente">
						<p class="help-block">Peso máximo de la imagen 512KB</p>
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
			<button type="button" class="btn btn-primary" id="btnEditarEmpresa">Editar Datos</button>
        </div>

      </form> 

    </div>

  </div>

</div>

<!--=====================================
MODAL TIEMPO ENTREGA
======================================-->
<div id="modalTiempoEntrega" class="modal fade" role="dialog">  
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="post" id="form-tiempo-entrga">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
			<h4 class="modal-title">TIEMPO DE ENTREGA</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div id="contactoloading" class="text-center"></div>

        <div class="modal-body">
        	
        	<input type="hidden" id="tiempoIdEmpresa" value="<?php echo $empresa->EMPRESA_ID?>">

			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-plus"></i></span>
					<textarea class="form-control" id="txtTiempoEntrega" name="txtTiempoEntrega" rows="6" placeholder="INGRESAR TIEMPO DE ENTREGA..." required><?php echo $empresa->EMPRESA_T_ENTREGA?></textarea>
				</div>
			</div>

			<div class="form-group">
				<div class="input-group">					   
                    <button type="button" class="btn btn-lg btn-warning btn-block" id="btnTiempoEntrega"><i class="fas fa-save"></i> GUARDAR</button>
				</div>
			</div>

		</div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
			<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
        </div>

      </form> 

    </div>

  </div>

</div>
<!--=====================================
MODAL CONTACTO
======================================-->
<div id="mdlContacto" class="modal fade" role="dialog">  
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="post" id="form-contacto-login">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
			<h4 class="modal-title">x<span id="verAsuntoContacto"></span>x</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div id="contactoloading" class="text-center"></div>

        <div class="modal-body">
        	
        	<input type="hidden" id="txtAsuntoContacto" value="">
        	<input type="hidden" id="txtNombreContacto" value="<?php echo $empresa->EMPRESA_NOMBRE?>">
        	<input type="hidden" id="txtEmailContacto" value="<?php echo $empresa->EMPRESA_EMAIL?>">

			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-plus"></i></span>
					<textarea class="form-control" id="txtMensajeContacto" name="txtMensajeContacto" rows="6" placeholder="INGRESAR MENSAJE..." required></textarea>
				</div>
			</div>

			<div class="form-group">
				<div class="input-group">					   
                    <button type="submit" class="btn btn-lg btn-primary btn-block" id="sendContacto"><i class="fa fa-refresh" id="loadingContacto"></i> ENVIAR</button>
				</div>
			</div>

		</div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
			<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
        </div>

      </form> 

    </div>

  </div>

</div>

<!--=====================================
MODAL HORARIO
======================================-->
<div id="mdlHorario" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form role="form" method="post" id="formAddHorario">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header">
			<h4 class="modal-title">AGREGAR HORARIO</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
			<input type="hidden" name="idEmpresa" id="idEmpresa" value="<?php echo $this->session_id?>">

        	<fieldset class="row scheduler-border">
				<legend class="scheduler-border">HORARIO APERTURA</legend>		
				<div class="col-6">
					<div class="form-group">
						<select class="form-control" id="diaApertura" name="diaApertura">
							<option value="">DIA DE APERTURA</option>
							<option value="1">LUNES</option>
							<option value="2">MARTES</option>
							<option value="3">MIÉRCOLES</option>
							<option value="4">JUEVES</option>
							<option value="5">VIERNES</option>
							<option value="6">SÁBADO</option>
							<option value="7">DOMINGO</option>
						</select>
					</div> 				
				</div>
				<div class="col-6">
					<div class="form-group">
						<select class="form-control" id="horaApertura" name="horaApertura">
							<option value="">HORARIO DE APERTURA</option>
						<?php for( $i = 0 ; $i < 24 ; $i++ ){ ?>
						<?php $hora = $i < 10 ? '0'.$i : $i ; ?>
							<!--<option value="<?php echo $hora ?>:00"><?php echo $hora ?>:00</option>
							<option value="<?php echo $hora ?>:15"><?php echo $hora ?>:15</option>
							<option value="<?php echo $hora ?>:30"><?php echo $hora ?>:30</option>
							<option value="<?php echo $hora ?>:45"><?php echo $hora ?>:45</option>-->
							<option value="<?php echo $hora ?>:00"><?php echo $hora ?>:00</option>
							<option value="<?php echo $hora ?>:05"><?php echo $hora ?>:05</option>
							<option value="<?php echo $hora ?>:10"><?php echo $hora ?>:10</option>
							<option value="<?php echo $hora ?>:15"><?php echo $hora ?>:15</option>
							<option value="<?php echo $hora ?>:20"><?php echo $hora ?>:20</option>
							<option value="<?php echo $hora ?>:25"><?php echo $hora ?>:25</option>
							<option value="<?php echo $hora ?>:30"><?php echo $hora ?>:30</option>
							<option value="<?php echo $hora ?>:35"><?php echo $hora ?>:35</option>
							<option value="<?php echo $hora ?>:40"><?php echo $hora ?>:40</option>
							<option value="<?php echo $hora ?>:45"><?php echo $hora ?>:45</option>
							<option value="<?php echo $hora ?>:50"><?php echo $hora ?>:50</option>
							<option value="<?php echo $hora ?>:55"><?php echo $hora ?>:55</option>
						<?php } ?>
						
						</select>
					</div>			
				</div>
			</fieldset>
        	
        	<fieldset class="row scheduler-border">
				<legend class="scheduler-border">HORARIO CIERRE</legend>		
				<div class="col-6">
					<div class="form-group">
						<select class="form-control" id="diaCierre" name="diaCierre">
							<option value="">DIA DE CIERRE</option>
							<option value="1">LUNES</option>
							<option value="2">MARTES</option>
							<option value="3">MIÉRCOLES</option>
							<option value="4">JUEVES</option>
							<option value="5">VIERNES</option>
							<option value="6">SÁBADO</option>
							<option value="7">DOMINGO</option>
						</select>
					</div> 				
				</div>
				<div class="col-6">
					<div class="form-group">
						<select class="form-control" id="horaCierre" name="horaCierre">
							<option value="">HORARIO DE CIERRE</option>
						<?php for( $i = 0 ; $i < 24 ; $i++ ){ ?>
						<?php $hora = $i < 10 ? '0'.$i : $i ; ?>
							<!--<option value="<?php echo $hora ?>:00"><?php echo $hora ?>:00</option>
							<option value="<?php echo $hora ?>:15"><?php echo $hora ?>:15</option>
							<option value="<?php echo $hora ?>:30"><?php echo $hora ?>:30</option>
							<option value="<?php echo $hora ?>:45"><?php echo $hora ?>:45</option>-->
							<option value="<?php echo $hora ?>:00"><?php echo $hora ?>:00</option>
							<option value="<?php echo $hora ?>:05"><?php echo $hora ?>:05</option>
							<option value="<?php echo $hora ?>:10"><?php echo $hora ?>:10</option>
							<option value="<?php echo $hora ?>:15"><?php echo $hora ?>:15</option>
							<option value="<?php echo $hora ?>:20"><?php echo $hora ?>:20</option>
							<option value="<?php echo $hora ?>:25"><?php echo $hora ?>:25</option>
							<option value="<?php echo $hora ?>:30"><?php echo $hora ?>:30</option>
							<option value="<?php echo $hora ?>:35"><?php echo $hora ?>:35</option>
							<option value="<?php echo $hora ?>:40"><?php echo $hora ?>:40</option>
							<option value="<?php echo $hora ?>:45"><?php echo $hora ?>:45</option>
							<option value="<?php echo $hora ?>:50"><?php echo $hora ?>:50</option>
							<option value="<?php echo $hora ?>:55"><?php echo $hora ?>:55</option>
						<?php } ?>

						</select>
					</div>			
				</div>
			</fieldset>

			<div class="row">
        		<div class="col-12">
					<div class="form-group">
						<button type="button" class="btn btn-primary btn-block" id="btnGuardarHorario" disabled>GUARDAR HORARIO</button>
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


<script type="text/javascript">
	var upgradeTime	= '<?php echo $empresaUpdtHorario?>';
</script>