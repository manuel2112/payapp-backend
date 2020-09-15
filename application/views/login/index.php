<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $this->layout->getTitle(); ?></title>
    <meta name="description" content="<?php echo $this->layout->getDescripcion(); ?>"  />
    <meta name="keywords" content="<?php echo $this->layout->getKeywords(); ?>" />
    
    <link rel="stylesheet" href="<?php echo base_url('public/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('public/css/font-awesome.min.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('public/sweetalert/sweetalert.css')?>">
    <link rel="stylesheet" href="<?php echo base_url('public/css/style_login.css')?>">
</head>

<body>

	<div class="container-fluid">
        <div class="row">
            
			<div class="col col-md-6 offset-md-3">
			
				<div class="mx-auto text-center">
					<img src="<?php echo base_url('public/images/logo.png')?>" alt="" class="img-fluid logo" width="200">
				</div>
				
                   <form method="post" id="form-signin">
                    <?php echo form_input(array('type'=>'text','id'=>'txtUsuario','name'=>'login','placeholder'=>'USUARIO...','class'=>'form-control','required'=>'required','autofocus'=>'autofocus','value'=>set_value('login'))) ?>
					   
                    <?php echo form_input(array('type'=>'password','id'=>'txtPass','name'=>'pass','placeholder'=>'PASSWORD...','class'=>'form-control','required'=>'required','value'=>set_value('pass'))) ?>
				
					<div class="text-center">
						<div id="loading"></div>
					</div>
					   
                    <button type="submit" class="btn btn-lg btn-primary btn-block btnlogin"><i class="fa fa-refresh" id="loadinglogin"></i> INGRESAR</button>
                  
                   </form>
                   
					<div class="d-flex justify-content-center mt-5">
						<a href="#" class="btn" data-toggle="modal" data-target="#mdlContacto">Problemas para ingresar? Contáctanos aquí</a>
					</div>
					<div class="d-flex justify-content-center mt-3">
						<a href="#" class="btn" data-toggle="modal" data-target="#mdlPassForget">Olvidaste tu contraseña?</a>
					</div>
                
			</div>
            
        </div>
    </div>
    
<!--=====================================
MODAL CONTACTO
======================================-->
<div id="mdlContacto" class="modal fade" role="dialog">  
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post" id="form-contacto-login">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
			<h4 class="modal-title">Cuéntanos cuál es tu problema</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">			

			<div class="form-group">              
				<div class="input-group">              
					<span class="input-group-addon"><i class="fa fa-plus"></i></span> 
					<input type="text" class="form-control" name="txtLoginNombreContacto" id="txtLoginNombreContacto" placeholder="NOMBRE..." required>
				</div>
			</div>			

			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-plus"></i></span> 
					<input type="email" class="form-control" name="txtLoginEmailContacto" id="txtLoginEmailContacto" placeholder="EMAIL..." required>
				</div>
			</div>
			
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-plus"></i></span>
					<textarea class="form-control" id="txtLoginMensajeContacto" name="txtLoginMensajeContacto" rows="3" placeholder="INGRESAR PROBLEMA..." required></textarea>
				</div>
			</div>
			
			<div class="form-group">
				<div class="input-group">					   
                    <button type="submit" class="btn btn-lg btn-primary btn-block" id="sendContactoLogin"><i class="fa fa-refresh" id="loadingLoginContacto"></i> ENVIAR</button>
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
MODAL RECUPERAR CONTRASEÑA
======================================-->
<div id="mdlPassForget" class="modal fade" role="dialog">  
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="post" id="form-contacto-login">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">
			<h4 class="modal-title">Recupera tu contraseña</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">		

			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-plus"></i></span> 
					<input type="email" class="form-control" name="txtLoginEmailPassContacto" id="txtLoginEmailPassContacto" placeholder="INGRESA TU EMAIL..." required>
				</div>
			</div>
			
			<div class="form-group">
				<div class="input-group">					   
                    <button type="submit" class="btn btn-lg btn-primary btn-block" id="sendPassLogin"><i class="fa fa-refresh" id="loadingLoginPass"></i> ENVIAR</button>
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

<script type="text/javascript">
	var base_url	= '<?php echo base_url();?>';
</script>
<script src="<?php echo base_url('public/js/jquery.min.js')?>"></script>
<script src="<?php echo base_url('public/js/popper.min.js')?>"></script>
<script src="<?php echo base_url('public/js/bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('public/sweetalert/sweetalert.min.js')?>"></script> 
<script src="<?php echo base_url('public/js/validate.login.js')?>"></script> 
</body>
</html>    
      