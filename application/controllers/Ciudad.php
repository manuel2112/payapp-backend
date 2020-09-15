<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ciudad extends CI_Controller {
	
	public function __construct()
	{	
		parent::__construct();
		if (!$this->session->userdata('adminappchan')) {
			$this->session->set_userdata('', current_url());
			redirect(base_url('login'));
		}        
        $this->session_id = $this->session->userdata('adminappchan');
	}
	
	public function index()
	{
		$this->layout->view('index');
	}
    
	public function indexajax()
	{
		$ciudades = $this->ciudad_model->getCiudadAll();
		
		$dataJson = '{
					  "data": [';
		
		$i = 1;		
		if( count($ciudades) > 0 ){
			foreach( $ciudades as $item )
			{
				$estado = $item->CIUDAD_FLAG ? "<button class='btn btn-success btnactivarciudad' idciudad='".$item->CIUDAD_ID."' estadociudad='0'>Activado</button>" : "<button class='btn btn-danger btnactivarciudad' idciudad='".$item->CIUDAD_ID."' estadociudad='1'>Desactivado</button>";

				$botones =  "<div class='btn-group'><button class='btn btn-warning btnGetEditarCiudad' idciudad='".$item->CIUDAD_ID."' data-toggle='modal' data-target='#modalEditarCiudad'><i class='fa fa-pencil'></i></div>";
				
				$imagen = $item->CIUDAD_IMAGEN ? "<img src='".base_url().$item->CIUDAD_IMAGEN."' width='50px'>" : "<img src='".base_url()."public/images/food-defecto.png' width='50px'>";

				$dataJson .= '[
								  "'.$i++.'",
								  "'.$imagen.'",
								  "'.$item->CIUDAD_NOMBRE.'",
								  "'.$estado.'",
								  "'.$botones.'"
							  ],';
			}			
		}else{
				$dataJson .= '[
								  "SIN INFORMACIÓN",
								  "---",
								  "---",
								  "---",
								  "---",
								  "---"
							  ],';			
		}

		
		$dataJson = substr($dataJson, 0, -1);
		$dataJson .= '] }';
		
		echo $dataJson;
	}
    
	public function existeciudad()
	{
		$txtCiudad = trim($this->input->post('txtCiudad'));
		
		$existe = $this->ciudad_model->getCiudadExiste($txtCiudad);
		
		if( $existe > 0 ){
			echo TRUE;
		}else{
			echo FALSE;
		}
	}
        
	public function insert()
	{
		$txtCiudad = trim($this->input->post('nuevaCiudad'));
		$ruta = NULL;
		
		//VALIDAR IMAGEN
		if( !empty($_FILES["nuevaFotoCiudad"]["tmp_name"]) ){

			list($ancho,$alto) = getimagesize($_FILES["nuevaFotoCiudad"]["tmp_name"]);
			
			$anchoMaximo = 500;
			$altoProporcional = ($anchoMaximo * $alto) / $ancho;

			$nuevoAncho	= $anchoMaximo;
			$nuevoAlto	= $altoProporcional;
					
			//CREAR DIRECTORIO PARA GUARDAR FOTO
			if (!file_exists("upload/ciudades")) {
				mkdir("upload/ciudades", 0777, true);
			}
			$directorio = "upload/ciudades";
					
			if( $_FILES["nuevaFotoCiudad"]["type"] == "image/jpeg" ){
				$aleatorio	= generaRandom();
				$ruta		= $directorio."/".$aleatorio.".jpg";
				
				$origen		= imagecreatefromjpeg($_FILES["nuevaFotoCiudad"]["tmp_name"]);
				$destino	= imagecreatetruecolor($nuevoAncho,$nuevoAlto);
				
				imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);
				
				imagejpeg($destino,$ruta);
			}
					
			if( $_FILES["nuevaFotoCiudad"]["type"] == "image/png" ){
				$aleatorio	= generaRandom();
				$ruta		= $directorio."/".$aleatorio.".png";
				
				$origen		= imagecreatefrompng($_FILES["nuevaFotoCiudad"]["tmp_name"]);
				$destino	= imagecreatetruecolor($nuevoAncho,$nuevoAlto);
				
				imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);
				
				imagejpeg($destino,$ruta);
			}
		}		
		
		$idTipoComida = $this->ciudad_model->insertCiudad($txtCiudad,$ruta);
		$success = 'Ciudad de '.$txtCiudad.' ingresada exitosamente.';
		$this->session->set_flashdata('exito',$success);
		redirect(base_url().'ciudad');
	}
    
	public function estado()
	{
		$idCiudad	= trim($this->input->post('idciudad'));
		$estado		= trim($this->input->post('estado'));
		
		$this->ciudad_model->updateCiudadEstado($idCiudad,$estado);
	}
    
	public function geteditar()
	{
		$idCiudad 	= trim($this->input->post('idCiudad'));
		$existe		= $this->ciudad_model->getCiudadRow($idCiudad);
		echo json_encode($existe);
	}
     
	public function editar()
	{
		$idCiudad 	= trim($this->input->post('editarIdCiudad'));
		$ciudad 	= trim($this->input->post('editarCiudad'));
		$ruta = NULL;
		
		//VALIDAR IMAGEN
		if( !empty($_FILES["nuevaFotoCiudad"]["tmp_name"]) ){

			list($ancho,$alto) = getimagesize($_FILES["nuevaFotoCiudad"]["tmp_name"]);
			
			$anchoMaximo = 500;
			$altoProporcional = ($anchoMaximo * $alto) / $ancho;

			$nuevoAncho	= $anchoMaximo;
			$nuevoAlto	= $altoProporcional;
					
			//CREAR DIRECTORIO PARA GUARDAR FOTO
			if (!file_exists("upload/ciudades")) {
				mkdir("upload/ciudades", 0777, true);
			}
			$directorio = "upload/ciudades";
					
			if( $_FILES["nuevaFotoCiudad"]["type"] == "image/jpeg" ){
				$aleatorio	= generaRandom();
				$ruta		= $directorio."/".$aleatorio.".jpg";
				
				$origen		= imagecreatefromjpeg($_FILES["nuevaFotoCiudad"]["tmp_name"]);
				$destino	= imagecreatetruecolor($nuevoAncho,$nuevoAlto);
				
				imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);
				
				imagejpeg($destino,$ruta);
			}
					
			if( $_FILES["nuevaFotoCiudad"]["type"] == "image/png" ){
				$aleatorio	= generaRandom();
				$ruta		= $directorio."/".$aleatorio.".png";
				
				$origen		= imagecreatefrompng($_FILES["nuevaFotoCiudad"]["tmp_name"]);
				$destino	= imagecreatetruecolor($nuevoAncho,$nuevoAlto);
				
				imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);
				
				imagejpeg($destino,$ruta);
			}
			
			$this->ciudad_model->updateCiudadCampo($idCiudad,"CIUDAD_IMAGEN",$ruta);
		}		
		
		$this->ciudad_model->updateCiudadCampo($idCiudad,"CIUDAD_NOMBRE",$ciudad);
		$success = 'La ciudad '.$ciudad.' ha sido editada exitosamente.';
		$this->session->set_flashdata('exito',$success);
		redirect(base_url().'ciudad');
	}
    
	public function existeciudadedit()
	{
		$idCiudad 	= trim($this->input->post('idCiudad'));
		$ciudad 	= trim($this->input->post('ciudad'));
		
		$existe = $this->ciudad_model->getCiudadExisteEdit($idCiudad,$ciudad);
		
		if( $existe > 0 ){
			echo TRUE;
		}else{
			echo FALSE;
		}
	}

}
