<div class="row">
	<div class="col-12">
		<div class="modal-header" style="background:#3c8dbc; color:white">
			<h4 class="modal-title">Cambiar contraseña</h4>
		</div>		
	</div>
</div>	

	<div class="row mt-5">
		<div class="col-6 offset-3">
			<form role="form" method="post" id="formpassword">
				
				<input type="hidden" id="idCliente" value="<?php echo $this->session_id?>">

				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-plus"></i></span>
						<input type="password" class="form-control form-control-lg" name="actualPw" id="actualPw" placeholder="CONTRASEÑA ACTUAL..." required>
					</div>
				</div>

				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-plus"></i></span>
						<input type="password" class="form-control form-control-lg" name="nuevoPw" id="nuevoPw" placeholder="CONTRASEÑA NUEVA...">
					</div>
				</div>

				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon"><i class="fa fa-plus"></i></span>
						<input type="password" class="form-control form-control-lg" name="repitePw" id="repitePw" placeholder="REPETIR CONTRASEÑA NUEVA...">
					</div>
				</div>
				
				<div class="text-center">
					<div id="loadingpw"></div>
				</div>

				<div class="form-group">
					<div class="input-group">
						<button type="button" class="btn btn-primary btn-block btn-lg btnEditarPw" id="btnEditarPw"><strong>Editar contraseña</strong></button>
					</div>
				</div>
	
			</form>
		</div>
	</div><!-- PIE ROW -->      
