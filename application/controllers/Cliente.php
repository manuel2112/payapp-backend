<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('clienteapppay')) {
			$this->session->set_userdata('', current_url());
			redirect(base_url('login'));
		}
		$this->session_id 	= $this->session->userdata('clienteapppay');
	}
	
	public function index()
	{
		$data = array();
		$data['empresaUpdtHorario']		= horarioPorEmpresaSingle($this->session_id);
		$data['empresa'] 				= $this->empresa_model->getEmpresaRow($this->session_id);
		$data['horarioEmpresa']			= $this->horario_model->getHorarioPorEmpresa($this->session_id);

		$this->layout->view('index',$data);
	}
	
	public function password()
	{
		$this->layout->view('password');
	}
	
	public function passwordeditajax()
	{
		$idCliente	= trim($this->input->post("idCliente",true));
		$cliente	= $this->empresa_model->getEmpresaRow($idCliente);
		
		$actualPw	= trim($this->input->post("actualPw",true));
		$nuevoPw	= trim($this->input->post("nuevoPw",true));
		$repitePw	= trim($this->input->post("repitePw",true));
		
		$error	= "";
		
		if( $actualPw == "" ){
			$error	.= "Contraseña actual obligatoria";
		}
		elseif( $nuevoPw == "" ){
			$error	.= "Contraseña nueva obligatoria";
		}
		elseif( $repitePw == "" ){
			$error	.= "Repetir contraseña nueva obligatoria";
		}
		elseif( md5($actualPw) != $cliente->EMPRESA_PASS ){
			$error	.= "Contraseña actual no corresponde";
		}
		elseif( strlen($nuevoPw) < 6 ){
			$error	.= "Contraseña nueva mínimo 6 caracteres".strlen($nuevoPw);
		}
		elseif( $nuevoPw != $repitePw ){
			$error	.= "Contraseñas no coinciden";
		}
		
		if( $error != "" ){
			echo $error;
			return;
		}else{
			
			$this->empresa_model->updateEmpresaPorCampo($idCliente,'EMPRESA_PASS',md5($nuevoPw));
			$this->estadistica_back_model->insertEstadisticaBack($this->session_id,6,fechaNow());//INGRESO EMPRESA
			
			echo 1;
			return;
		}
	}
  
	public function updatecliente()
	{
		$idEmpresa		= $this->input->post('idCliente');
		$txtDireccion 	= trim($this->input->post('txtEditDireccion')) ? ucwords(strtolower(trim($this->input->post('txtEditDireccion')))) : NULL ;
		$txtFono 		= trim($this->input->post('txtEditFono')) ? trim($this->input->post('txtEditFono')) : NULL ;
		$txtUrl 		= trim($this->input->post('txtEditUrl')) ? trim($this->input->post('txtEditUrl')) : NULL ;
		$txtFacebook	= trim($this->input->post('txtEditFacebook')) ? trim($this->input->post('txtEditFacebook')) : NULL ;
		$txtInstagram 	= trim($this->input->post('txtEditInstagram')) ? trim($this->input->post('txtEditInstagram')) : NULL ;
		$txtDescripcion	= trim($this->input->post('txtEditDescripcion')) ? trim($this->input->post('txtEditDescripcion')) : NULL ;
		$ruta 			= NULL;
		
		//UPDATE EMPRESA
		$this->empresa_model->updateCliente($idEmpresa, $txtDireccion, $txtFono, $txtUrl, $txtFacebook, $txtInstagram, $txtDescripcion);

		//VALIDAR IMAGEN
		if( isset($_FILES["imagen"]["tmp_name"]) ){

			list($ancho,$alto) = getimagesize($_FILES["imagen"]["tmp_name"]);

			$anchoMaximo = 500;
			$altoProporcional = ($anchoMaximo * $alto) / $ancho;

			$nuevoAncho	= $anchoMaximo;
			$nuevoAlto	= $altoProporcional;		
				
			$directorio	= "upload/empresas/".$idEmpresa."/logotipo";		
			//CREAR DIRECTORIO PARA GUARDAR FOTO
			if (!file_exists($directorio)) {
				mkdir($directorio, 0777, true);
			}
			$aleatorio	= generaRandom();
			$nmbFile 	= $directorio."/logo_".$aleatorio;

			if( $_FILES["imagen"]["type"] == "image/jpeg" ){
				$ruta		= $nmbFile.".jpg";				
				$origen		= imagecreatefromjpeg($_FILES["imagen"]["tmp_name"]);
				$destino	= imagecreatetruecolor($nuevoAncho,$nuevoAlto);				
				imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);				
				imagejpeg($destino,$ruta);
			}
					
			if( $_FILES["imagen"]["type"] == "image/png" ){
				$ruta		= $nmbFile.".png";				
				$origen		= imagecreatefrompng($_FILES["imagen"]["tmp_name"]);
				$destino	= imagecreatetruecolor($nuevoAncho,$nuevoAlto);				
				imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);				
				imagejpeg($destino,$ruta);
			}
			$this->empresa_model->updateEmpresaLogo($idEmpresa, $ruta);
		}

		$data 		= array();	
		$data['ok'] = '1' ;		
		echo json_encode($data);
	}
	
	public function imagenesperfil()
	{
		if( $this->plan_id == 2 || $this->plan_id == 3 || $this->plan_id == 4 || $this->plan_id == 5 ){
			$data['imagenes']	= $this->empresa_foto_model->getEmpresaFotoActive($this->session_id);
			$this->layout->view('imagenesperfil',$data);			
		}else{
			redirect(base_url().'cliente');
		}
	}
	
	public function uploadimagenesperfil()
	{
		$idEmpresa		= $this->session_id;
		$imagenes 		= $_FILES["file-es"];
		$fechaIngreso	= fechaNow();
		$ruta 			= NULL;

		//FORMATEAR ESTADOS
		$this->empresa_foto_model->updateEmpresaFotoEstado($idEmpresa,FALSE);

		//CREAR DIRECTORIO PARA GUARDAR FOTO
		if (!file_exists("upload/empresas/".$idEmpresa."/promocion")) {
			mkdir("upload/empresas/".$idEmpresa."/promocion", 0777, true);
		}
		$directorio = "upload/empresas/".$idEmpresa."/promocion";
		
		//ELIMINAR ARCHIVOS DEL DIRECTORIO
		$files = glob( $directorio . '/*' );
		foreach($files as $file){
			if(is_file($file))
			unlink($file);
		}

		for($i = 0; $i < count($_FILES['file-es']['name']); $i++)
		{
			$imgType = $_FILES['file-es']['type'][$i];
			$imgTemp = $_FILES['file-es']['tmp_name'][$i];

			//VALIDAR IMAGEN
			if( !empty($imgTemp) )
			{
				list($ancho,$alto) = getimagesize($imgTemp);

				$anchoMaximo = 500;
				$altoProporcional = ($anchoMaximo * $alto) / $ancho;

				$nuevoAncho	= $anchoMaximo;
				$nuevoAlto	= $altoProporcional;

				if( $imgType == "image/jpeg" ){
					$aleatorio	= generaRandom();
					$ruta		= $directorio."/promocion_".$aleatorio.".jpg";

					$origen		= imagecreatefromjpeg($imgTemp);
					$destino	= imagecreatetruecolor($nuevoAncho,$nuevoAlto);

					imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);

					imagejpeg($destino,$ruta);
				}

				if( $imgType == "image/png" ){
					$aleatorio	= generaRandom();
					$ruta		= $directorio."/promocion_".$aleatorio.".png";

					$origen		= imagecreatefrompng($imgTemp);
					$destino	= imagecreatetruecolor($nuevoAncho,$nuevoAlto);

					imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);

					imagejpeg($destino,$ruta);
				}
				$this->empresa_foto_model->insertEmpresaFoto($idEmpresa,$ruta,$fechaIngreso);
			}
			
			if( $i == 4 ){
				break;
			}
		}
		$this->estadistica_back_model->insertEstadisticaBack($this->session_id,3,fechaNow());//INGRESO EMPRESA

		$success = 'Imágenes ingresadas exitosamente.';
		$this->session->set_flashdata('exito',$success);
		redirect(base_url().'cliente/imagenesperfil');
	}
	
	public function destacado()
	{
		if( $this->plan_id == 3 || $this->plan_id == 4 || $this->plan_id == 5 ){
			$data = array();
			$data['destacado']	= $this->destacado_model->getDestacadoEmpresaClienteRow($this->session_id);
			$destacado			= $this->destacado_model->getDestacadoEmpresaClienteRow($this->session_id);			
			$data['imagenes']	= $destacado ? $this->destacado_imagen_model->getDestacadoImagen($destacado->DESTACADO_ID) : '';
			$this->layout->view('destacado',$data);
		}else{
			redirect(base_url().'cliente');
		}
	}
	
	public function destacadoinsert()
	{
		$idEmpresa 		= $this->session_id;
		$txtDescripcion = trim($this->input->post('txtDescripcion')) ? trim($this->input->post('txtDescripcion')) : NULL ;
		$imagenes 		= $_FILES["file-es"];
		$fechaIngreso	= fechaNow();
		$ruta 			= NULL;

		//FORMATEAR ESTADOS
		$this->destacado_model->updateDestacadoEstado($idEmpresa,FALSE);

		//INGRESAR DESTACADO
		$idDestacado = $this->destacado_model->insertDestacado($idEmpresa, $txtDescripcion, NULL, $fechaIngreso);
		$this->estadistica_back_model->insertEstadisticaBack($this->session_id,4,fechaNow());//INGRESO EMPRESA

		//CREAR DIRECTORIO PARA GUARDAR FOTO
		if (!file_exists("upload/empresas/".$idEmpresa."/destacado/")) {
			mkdir("upload/empresas/".$idEmpresa."/destacado/", 0777, true);
		}
		$directorio = "upload/empresas/".$idEmpresa."/destacado/";
		
		//ELIMINAR ARCHIVOS DEL DIRECTORIO
		$files = glob( $directorio . '/*' );
		foreach($files as $file){
			if(is_file($file))
			unlink($file);
		}

		for($i = 0; $i < count($_FILES['file-es']['name']); $i++)
		{
			$imgType = $_FILES['file-es']['type'][$i];
			$imgTemp = $_FILES['file-es']['tmp_name'][$i];

			//VALIDAR IMAGEN
			if( !empty($imgTemp) )
			{
				list($ancho,$alto) = getimagesize($imgTemp);

				$anchoMaximo = 500;
				$altoProporcional = ($anchoMaximo * $alto) / $ancho;

				$nuevoAncho	= $anchoMaximo;
				$nuevoAlto	= $altoProporcional;

				if( $imgType == "image/jpeg" ){
					$aleatorio	= generaRandom();
					$ruta		= $directorio."/destacado_".$aleatorio.".jpg";

					$origen		= imagecreatefromjpeg($imgTemp);
					$destino	= imagecreatetruecolor($nuevoAncho,$nuevoAlto);

					imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);

					imagejpeg($destino,$ruta);
				}

				if( $imgType == "image/png" ){
					$aleatorio	= generaRandom();
					$ruta		= $directorio."/destacado_".$aleatorio.".png";

					$origen		= imagecreatefrompng($imgTemp);
					$destino	= imagecreatetruecolor($nuevoAncho,$nuevoAlto);

					imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);

					imagejpeg($destino,$ruta);
				}
				$this->destacado_imagen_model->insertDestacadoImagen($idDestacado, $ruta);
			}
			
			if( $i == 4 ){
				break;
			}
		}

		$success = 'Destacado ingresado exitosamente.';
		$this->session->set_flashdata('exito',$success);
		redirect(base_url().'cliente/destacado');
	}
	
	public function notificacion()
	{
		if( $this->plan_id == 4 || $this->plan_id == 5 ){
			$data = array();
			$data['notificaciones']	= $this->empresa_notificacion_model->getNotificacionesPorCliente($this->session_id);
			$this->layout->view('notificacion',$data);		
		}else{
			redirect(base_url().'cliente');
		}
	}
	
	public function notificacioninsert()
	{
		$idEmpresa 		= $this->session_id;
		$fechaEnvio 	= trim($this->input->post('datetimepickernotificacion')) ? trim($this->input->post('datetimepickernotificacion')) : NULL ;
		$txtDescripcion = trim($this->input->post('txtDescripcion')) ? trim($this->input->post('txtDescripcion')) : NULL ;
		$imagenes 		= $_FILES["file-not"];
		$fechaIngreso	= fechaNow();
		$ruta 			= NULL;
		
		//INGRESAR NOTIFICACION
		$idNotificacion = $this->empresa_notificacion_model->insertClienteNotificacion($idEmpresa, $txtDescripcion, $fechaIngreso, date_datetime($fechaEnvio));

		//CREAR DIRECTORIO PARA GUARDAR FOTO
		if (!file_exists("upload/empresas/".$idEmpresa."/notificacion/")) {
			mkdir("upload/empresas/".$idEmpresa."/notificacion/", 0777, true);
		}
		$directorio = "upload/empresas/".$idEmpresa."/notificacion/";

		for($i = 0; $i < count($_FILES['file-not']['name']); $i++)
		{
			$imgType = $_FILES['file-not']['type'][$i];
			$imgTemp = $_FILES['file-not']['tmp_name'][$i];

			//VALIDAR IMAGEN
			if( !empty($imgTemp) )
			{
				list($ancho,$alto) = getimagesize($imgTemp);

				$anchoMaximo = 500;
				$altoProporcional = ($anchoMaximo * $alto) / $ancho;

				$nuevoAncho	= $anchoMaximo;
				$nuevoAlto	= $altoProporcional;

				if( $imgType == "image/jpeg" ){
					$aleatorio	= generaRandom();
					$ruta		= $directorio."notificacion_".$aleatorio.".jpg";

					$origen		= imagecreatefromjpeg($imgTemp);
					$destino	= imagecreatetruecolor($nuevoAncho,$nuevoAlto);

					imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);

					imagejpeg($destino,$ruta);
				}

				if( $imgType == "image/png" ){
					$aleatorio	= generaRandom();
					$ruta		= $directorio."notificacion_".$aleatorio.".png";

					$origen		= imagecreatefrompng($imgTemp);
					$destino	= imagecreatetruecolor($nuevoAncho,$nuevoAlto);

					imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);

					imagejpeg($destino,$ruta);
				}
				$this->empresa_notificacion_model->updateImagenClienteNotificacion($idNotificacion, $ruta);
			}
			
			if( $i == 4 ){
				break;
			}
		}
		
		$this->estadistica_back_model->insertEstadisticaBack($this->session_id,5,fechaNow());//INGRESO EMPRESA

		$success = 'Notificación solicitada exitosamente.';
		$this->session->set_flashdata('exito',$success);
		redirect(base_url().'cliente/notificacion');
	}
	
	public function estadistica()
	{
		if( $this->plan_id == 4 || $this->plan_id == 5 ){
			$this->layout->view('estadistica');		
		}else{
			redirect(base_url().'cliente');
		}
	}
	
	public function graphajax()
	{
		$seccion 	= trim($this->input->post('seccion'));
		$idCampo 	= trim($this->input->post('campo'));
		
		$fechaInicio = fechaHaceUnMes();
		$final = '[[';
			while( $fechaInicio <= fechaNow() ){				
				$counter = $this->estadistica_model->countEstadisticaCampo($this->session_id,$idCampo,$fechaInicio);
				$final  .= '{"dia":"'.$fechaInicio.'","value":"'.$counter.'"},';
				$fechaInicio = fechaMasUnDia($fechaInicio);
			}
		$final = substr($final, 0, -1);
		$final .= ']]';

		$final = json_decode($final, true);
		$new_final = array();
		// simple flattening
		foreach($final as $value) {
			foreach($value as $sub_value) {
				$new_final[] = $sub_value;
			}
		}

		echo json_encode($new_final);		
	}
	
}
