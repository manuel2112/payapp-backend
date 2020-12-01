<div class="row mb-2">

	<div class="col-12">

		<?php if ( $this->session->flashdata('exito') ){ ?>
			<div class="alert alert-success">
			<?php echo $this->session->flashdata('exito');?>
			<button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
				<span aria-hidden="true">&times;</span>
			</button>
			</div>
		<?php }?>

		<div class="col-12 mb-5">
				<a href="<?php echo base_url('paletarest/'.$this->session_id)?>" target="_blank" class="btn btn-primary">API</a>
		</div>

		<div class="card text-center mb-5">
			<div class="card-header" style="">
				COLOR PRIMARIO
			</div>
			<div class="card-body" id="card-01" style="padding:60px 0;background-color:<?php echo color($paleta->COLOR_ID_01)->COLOR_HEX ?>">
				<div class="input-group selectWrapper col-12">
					<select class="form-control custom-select form-control-lg" id="slc-color-01" name="slc-color-01">
						<?php foreach( $colores as $color){?>
							<option value="<?php echo $color->COLOR_ID?>" style="background-color:<?php echo $color->COLOR_HEX?>" <?php echo $color->COLOR_ID == $paleta->COLOR_ID_01 ? 'selected' : '' ?>><?php echo $color->COLOR_NOMBRE?></option>
						<?php }?>
					</select>
					<div class="input-group-append">
						<button type="button" class="btn btn-outline-primary btn-lg btn-color-01" name="btn-color-01">SELECCIONAR</button>
					</div>
				</div>
			</div>
			<div class="card-footer text-muted">
				TU COLOR PRIMARIO ES: <?php echo color($paleta->COLOR_ID_01)->COLOR_NOMBRE ?>
			</div>
		</div>

		<div class="card text-center mb-5">
			<div class="card-header" style="">
				COLOR SECUNDARIO
			</div>
			<div class="card-body" id="card-02" style="padding:60px 0;background-color:<?php echo color($paleta->COLOR_ID_02)->COLOR_HEX ?>">
				<div class="input-group selectWrapper col-12">
					<select class="form-control custom-select form-control-lg" id="slc-color-02" name="slc-color-02">
						<?php foreach( $colores as $color){?>
							<option value="<?php echo $color->COLOR_ID?>" style="background-color:<?php echo $color->COLOR_HEX?>" <?php echo $color->COLOR_ID == $paleta->COLOR_ID_02 ? 'selected' : '' ?>><?php echo $color->COLOR_NOMBRE?></option>
						<?php }?>
					</select>
					<div class="input-group-append">
						<button type="button" class="btn btn-outline-primary btn-lg btn-color-02" name="btn-color-02">SELECCIONAR</button>
					</div>
				</div>
			</div>
			<div class="card-footer text-muted">
				TU COLOR SECUNDARIO ES: <?php echo color($paleta->COLOR_ID_02)->COLOR_NOMBRE ?>
			</div>
		</div>
		
		<div class="card text-center">
			<div class="card-header" style="">
				COLOR TERCIARIO
			</div>
			<div class="card-body" id="card-03" style="padding:60px 0;background-color:<?php echo color($paleta->COLOR_ID_03)->COLOR_HEX ?>">
				<div class="input-group selectWrapper col-12">
					<select class="form-control custom-select form-control-lg" id="slc-color-03" name="slc-color-03">
						<?php foreach( $colores as $color){?>
							<option value="<?php echo $color->COLOR_ID?>" style="background-color:<?php echo $color->COLOR_HEX?>" <?php echo $color->COLOR_ID == $paleta->COLOR_ID_03 ? 'selected' : '' ?>><?php echo $color->COLOR_NOMBRE?></option>
						<?php }?>
					</select>
					<div class="input-group-append">
						<button type="button" class="btn btn-outline-primary btn-lg btn-color-03" name="btn-color-03">SELECCIONAR</button>
					</div>
				</div>
			</div>
			<div class="card-footer text-muted">
				TU COLOR TERCIARIO ES: <?php echo color($paleta->COLOR_ID_03)->COLOR_NOMBRE ?>
			</div>
		</div>

	</div>
</div>