<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Destacados extends CI_Controller {
	
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
		$data["empresas"] = $this->empresa_model->getEmpresasActivas();
		$this->layout->view('index',$data);
	}

	public function indexajax()
	{
		$destacados = $this->destacado_model->getDestacadosActivas();
		
		$dataJson = '{
					  "data": [';
		
		$i = 1;		
		if( count($destacados) > 0 ){
			foreach( $destacados as $item )
			{				
				$imagen = $item->EMPRESA_LOGOTIPO ? "<img src='".base_url().$item->EMPRESA_LOGOTIPO."' width='50px'>" : "<img src='".base_url()."public/images/food-defecto.png' width='50px'>";

				$botones =  "<div class='btn-group'><button class='btn btn-primary btngetverdestacado' iddestacado='".$item->DESTACADO_ID."' data-toggle='modal' data-target='#modalVerDestacado'><i class='fa fa-info-circle fa-lg'></i></button><button class='btn btn-danger btndeletedestacado' iddestacado='".$item->DESTACADO_ID."'><i class='fa fa-trash fa-lg'></i></button></div>";

				$dataJson .= '[
								  "'.$i++.'",
								  "'.$imagen.'",
								  "'.$item->EMPRESA_NOMBRE.'",
								  "'.$item->DESTACADO_INGRESO.'",
								  "'.$botones.'"
							  ],';
			}			
		}else{
				$dataJson .= '[
								  "SIN INFORMACIÓN",
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

	public function insert()
	{
		$idEmpresa 		= trim($this->input->post('cmbEmpresa')) ? trim($this->input->post('cmbEmpresa')) : NULL ;
		$txtDescripcion = trim($this->input->post('txtDescripcion')) ? trim($this->input->post('txtDescripcion')) : NULL ;
		$txtDescripcion = remove_emoji($txtDescripcion);
		$imagenes 		= $_FILES["file-es"];
		$fechaIngreso	= fechaNow();
		$ruta 			= NULL;

		//FORMATEAR ESTADOS
		$this->destacado_model->updateDestacadoEstado($idEmpresa,FALSE);

		//CREAR DIRECTORIO PARA GUARDAR FOTO
		if (!file_exists("upload/empresas/".$idEmpresa."/destacado/")) {
			mkdir("upload/empresas/".$idEmpresa."/destacado/", 0777, true);
		}
		$directorio = "upload/empresas/".$idEmpresa."/destacado";
		
		//ELIMINAR ARCHIVOS DEL DIRECTORIO
		$files = glob( $directorio . '*' );
		foreach($files as $file){
			if(is_file($file))
			unlink($file);
		}

		//INGRESAR DESTACADO
		$idDestacado = $this->destacado_model->insertDestacado($idEmpresa, $txtDescripcion, NULL, $fechaIngreso);

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
		}

		$success = 'Destacado ingresado exitosamente.';
		$this->session->set_flashdata('exito',$success);
		redirect(base_url().'destacados');
	}

	public function deletedestacado()
	{
		$idDestacado = trim($this->input->post('idDestacado'));
		$this->destacado_model->deleteDestacado($idDestacado);
	}
	
	public function getdestacado()
	{
		$idDestacado 	= trim($this->input->post('idDestacado'));
		
		$data = array();
		$data['destacado']	= $this->destacado_model->getDestacadoEmpresaRow($idDestacado);
		$data['fotos'] 		= $this->destacado_imagen_model->getDestacadoImagen($idDestacado);
		echo json_encode($data);
	}

}
