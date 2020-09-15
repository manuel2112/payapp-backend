<div class="row mb-2">
	<div class="col-12">

		<div class="btn-group" style="margin:15px;">
			<button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#mdlHorario" title="AGREGAR HORARIO" id="mdlHorarioOpen"><i class="fas fa-plus"></i> AGREGAR HORARIO</button>
		</div>

    </div>

	<div class="col-12">
	
		<?php horarioPorEmpresa();?><br>		

    </div>

	<div class="col-12">
		<h2 class="mnuProducto">HORARIO DE:</h2>
				
		<div class="col-4">
			<div class="form-group">              
				<div class="input-group">
					<select class="form-control" id="idEmpresaHorario" name="idEmpresaHorario" required>
						<option value="">SELECCIONAR EMPRESA (*)...</option>
						<?php foreach( $empresas as $itemEmpresa ){?>
							<option value="<?php echo $itemEmpresa->EMPRESA_ID?>"><?php echo $itemEmpresa->EMPRESA_NOMBRE?></option>
						<?php }?>
					</select>
				</div>
			</div>
		</div>
				
		<div class="col-12">
			<div id="loadingHorario"></div>
			<div id="tblHorario"></div>
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

			<div class="row">
        		<div class="col-12">
					<div class="form-group">              
						<div class="input-group">              
							<span class="input-group-addon"><i class="fa fa-plus"></i></span>
							<select class="form-control" id="idEmpresa" name="idEmpresa" required>
								<option value="">SELECCIONAR EMPRESA (*)...</option>
								<?php foreach( $empresas as $itemEmpresa){?>
									<option value="<?php echo $itemEmpresa->EMPRESA_ID?>"><?php echo $itemEmpresa->EMPRESA_NOMBRE?></option>
								<?php }?>
							</select>
						</div>
					</div>
				</div>			
			</div>
				
        	
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
							<option value="<?php echo $hora ?>:00"><?php echo $hora ?>:00</option>
							<option value="<?php echo $hora ?>:15"><?php echo $hora ?>:15</option>
							<option value="<?php echo $hora ?>:30"><?php echo $hora ?>:30</option>
							<option value="<?php echo $hora ?>:45"><?php echo $hora ?>:45</option>
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
							<option value="<?php echo $hora ?>:00"><?php echo $hora ?>:00</option>
							<option value="<?php echo $hora ?>:15"><?php echo $hora ?>:15</option>
							<option value="<?php echo $hora ?>:30"><?php echo $hora ?>:30</option>
							<option value="<?php echo $hora ?>:45"><?php echo $hora ?>:45</option>
						<?php } ?>
						
						</select>
					</div>			
				</div>
			</fieldset>

			<div class="row">
        		<div class="col-12">
					<div class="form-group">
						<button type="button" class="btn btn-primary btn-block" id="btnGuardarHorario">GUARDAR HORARIO</button>
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
