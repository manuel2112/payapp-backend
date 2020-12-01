<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empresa extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('adminapppay')) {
			$this->session->set_userdata('', current_url());
			redirect(base_url('login'));
		}        
        $this->session_id = $this->session->userdata('adminapppay');
	}

	public function index()
	{
		$data["ciudades"]	= $this->ciudad_model->getCiudad();
		$data["negocios"]	= $this->tipo_negocio_model->getTiposNegocioActive();
		$this->layout->view('index',$data);
	}
    
	public function indexajax()
	{
		$empresas = $this->empresa_model->getEmpresa();
		
		$dataJson = '{
					  "data": [';
		
		$i = 1;		
		if( count($empresas) > 0 ){
			foreach( $empresas as $item )
			{
				$imagen = $item->EMPRESA_LOGOTIPO ? "<img src='".base_url().$item->EMPRESA_LOGOTIPO."' width='40px'>" : "<img src='".base_url()."public/images/food-defecto.png' width='40px'>";

				//ACCIONES
				$botones =  "<div class='btn-group'>";
				$botones .=  "<button class='btn btn-warning btnGetEditarEmpresa' idempresa='".$item->EMPRESA_ID."' data-toggle='modal' data-target='#modalEditarEmpresa' title='EDITAR EMPRESA' data-toggle='popover' data-trigger='hover' data-placement='top' data-content='Now hover out.'><i class='fas fa-edit'></i></button>";
				$botones .=  "<button class='btn btn-primary btnGetVerEmpresa' idempresa='".$item->EMPRESA_ID."' data-toggle='modal' data-target='#modalVerEmpresa' title='DETALLE EMPRESA'><i class='fa fa-info-circle fa-lg'></i></button>";

				//DAR PERMISOS
				$botones .= $item->EMPRESA_PERMISO ?  "<button class='btn btn-success btnDarPermisos' idempresa='".$item->EMPRESA_ID."' valor='0' title='PERMISOS PARA INGRESAR'><i class='fa fa-thumbs-up fa-lg'></i></button>" : "<button class='btn btn-danger btnDarPermisos' idempresa='".$item->EMPRESA_ID."' valor='1' title='PERMISOS PARA INGRESAR'><i class='fa fa-thumbs-down fa-lg'></i></button>" ;

				//ACTIVAR DESACTIVAR
				$botones .= $item->EMPRESA_FLAG ?  "<button class='btn btn-success btnActivarEmpresa' idempresa='".$item->EMPRESA_ID."'  estadoempresa='0' title='ACTIVAR/DESACTIVAR EMPRESA'><i class='fa fa-check fa-lg'></i></button>" : "<button class='btn btn-danger btnActivarEmpresa' idempresa='".$item->EMPRESA_ID."' estadoempresa='1' title='ACTIVAR/DESACTIVAR EMPRESA'><i class='fa fa-times fa-lg'></i></button>" ;
				$botones .=  "</div>";

				$testPush = "<button type='button' class='btn btn-primary btnPushTest' idempresa='".$item->EMPRESA_ID."'>TEST PUSH</button>";

				$geo = $item->EMPRESA_DIRECCION ? "<i class='fa fa-check fa-lg btn btn-success'></i>" : "<i class='fa fa-times fa-lg btn btn-danger'></i>" ;

				$dataJson .= '[
								  "'.$i++.'",
								  "'.$item->EMPRESA_ID.'",
								  "'.$imagen.'",
								  "'.$item->EMPRESA_NOMBRE.'",
								  "'.$item->CIUDAD_NOMBRE.'",
								  "'.$botones.'",
								  "'.$testPush.'"
							  ],';
			}
		}else{
				$dataJson .= '[
								  "SIN INFORMACIÓN",
								  "---",
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
    
	public function insert()
	{
		$cmbCiudad 					= trim($this->input->post('cmbCiudad')) ? trim($this->input->post('cmbCiudad')) : NULL ;
		$txtKeyPush 				= trim($this->input->post('txtKeyPush')) ? trim($this->input->post('txtKeyPush')) : NULL ;
		$txtEmpresaNombre 			= trim($this->input->post('txtEmpresaNombre')) ? trim($this->input->post('txtEmpresaNombre')) : NULL ;
		$txtEmpresaRazon 			= trim($this->input->post('txtEmpresaRazon')) ? trim($this->input->post('txtEmpresaRazon')) : NULL ;
		$txtEmpresaRut 				= trim($this->input->post('txtEmpresaRut')) ? trim($this->input->post('txtEmpresaRut')) : NULL ;
		$txtEmpresaDireccion 		= trim($this->input->post('txtEmpresaDireccion')) ? trim($this->input->post('txtEmpresaDireccion')) : NULL ;
		$txtEmpresaLatitud 			= trim($this->input->post('txtEmpresaLatitud')) ? trim($this->input->post('txtEmpresaLatitud')) : NULL ;
		$txtEmpresaLongitud 		= trim($this->input->post('txtEmpresaLongitud')) ? trim($this->input->post('txtEmpresaLongitud')) : NULL ;
		$txtEmpresaFono 			= trim($this->input->post('txtEmpresaFono')) ? trim($this->input->post('txtEmpresaFono')) : NULL ;
		$txtEmpresaEmail 			= trim($this->input->post('txtEmpresaEmail')) ? trim($this->input->post('txtEmpresaEmail')) : NULL ;
		$txtEmpresaUrlWeb 			= trim($this->input->post('txtEmpresaUrlWeb')) ? trim($this->input->post('txtEmpresaUrlWeb')) : NULL ;
		$txtEmpresaUrlFacebook 		= trim($this->input->post('txtEmpresaUrlFacebook')) ? trim($this->input->post('txtEmpresaUrlFacebook')) : NULL ;
		$txtEmpresaUrlInstagram 	= trim($this->input->post('txtEmpresaUrlInstagram')) ? trim($this->input->post('txtEmpresaUrlInstagram')) : NULL ;
		$txtEmpresaCodigoComercio 	= trim($this->input->post('txtEmpresaCodigoComercio')) ? trim($this->input->post('txtEmpresaCodigoComercio')) : NULL ;
		$txtEmpresaDescripcion 		= trim($this->input->post('txtEmpresaDescripcion')) ? trim($this->input->post('txtEmpresaDescripcion')) : NULL ;
		$tipoNegocio 				= $this->input->post('tipoNegocio') ;
		$tipoNegocioObs 			= $this->input->post('tipoNegocioObs') ;
		
		$fechaIngreso				= fechaNow();
		$txtEmpresaPass 			= NULL;
		$txtEmpresaPermiso 			= NULL;
		$txtEmpresaRutaLogo			= NULL;
		$txtEmpresaTipoDisenno		= NULL;
		
		//INGRESAR EMPRESA
		$idEmpresa = $this->empresa_model->insertEmpresa($txtKeyPush, $txtEmpresaNombre, $txtEmpresaRazon, $txtEmpresaRut, $txtEmpresaDireccion, $txtEmpresaLatitud, $txtEmpresaLongitud, $txtEmpresaFono, $txtEmpresaEmail, $txtEmpresaDescripcion, $txtEmpresaRutaLogo, $txtEmpresaUrlWeb, $txtEmpresaUrlFacebook, $txtEmpresaUrlInstagram, $txtEmpresaPass, $txtEmpresaPermiso, $txtEmpresaCodigoComercio, $cmbCiudad, $txtEmpresaTipoDisenno, $fechaIngreso);

		if( $tipoNegocio ){
			foreach( $tipoNegocio as $tipo ){
				$this->empresa_negocio_model->insertEmpresaNegocio($tipo, $idEmpresa, trim($tipoNegocioObs[$tipo]));
			}
		}
		
		
		//VALIDAR IMAGEN
		if( !empty($_FILES["nuevaFotoEmpresa"]["tmp_name"]) ){

			list($ancho,$alto) = getimagesize($_FILES["nuevaFotoEmpresa"]["tmp_name"]);
			
			$anchoMaximo = 500;
			$altoProporcional = ($anchoMaximo * $alto) / $ancho;

			$nuevoAncho	= $anchoMaximo;
			$nuevoAlto	= $altoProporcional;
					
			//CREAR DIRECTORIO PARA GUARDAR FOTO
			if (!file_exists("upload/empresas/".$idEmpresa."/logotipo")) {
				mkdir("upload/empresas/".$idEmpresa."/logotipo", 0777, true);
			}
			$directorio = "upload/empresas/".$idEmpresa."/logotipo";
					
			if( $_FILES["nuevaFotoEmpresa"]["type"] == "image/jpeg" ){
				$aleatorio	= generaRandom();
				$ruta		= $directorio."/".$aleatorio.".jpg";
				
				$origen		= imagecreatefromjpeg($_FILES["nuevaFotoEmpresa"]["tmp_name"]);
				$destino	= imagecreatetruecolor($nuevoAncho,$nuevoAlto);
				
				imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);
				
				imagejpeg($destino,$ruta);
			}
					
			if( $_FILES["nuevaFotoEmpresa"]["type"] == "image/png" ){
				$aleatorio	= generaRandom();
				$ruta		= $directorio."/".$aleatorio.".png";
				
				$origen		= imagecreatefrompng($_FILES["nuevaFotoEmpresa"]["tmp_name"]);
				$destino	= imagecreatetruecolor($nuevoAncho,$nuevoAlto);
				
				imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);
				
				imagejpeg($destino,$ruta);
			}
			$this->empresa_model->updateEmpresaLogo($idEmpresa, $ruta);
		}
		
		$success = 'Empresa '.$txtEmpresa.' ingresada exitosamente.';
		$this->session->set_flashdata('exito',$success);
		redirect(base_url().'empresa');
	}
    
	public function estado()
	{
		$idEmpresa 	= trim($this->input->post('idempresa'));
		$estado		= trim($this->input->post('estado'));
		$empresa 	= $this->empresa_model->getEmpresaRow($idEmpresa);

		$this->empresa_model->updateEmpresaEstado($idEmpresa,$estado);
		
		if( $estado == 0 ){
			$title	= "Eliminada";
			$text	= "La Empresa ha sido eliminada";
		}else{
			$title	= "Aceptada";
			$text	= "La Empresa ha sido aceptada";			
		}		

		$data = array();
		$data['title'] = $title;
		$data['text'] = $text;
		echo json_encode($data);
	}

	public function geteditar()
	{
		$idEmpresa 	= trim($this->input->post('idEmpresa'));
		$data = array();
		$data['empresa']		= $this->empresa_model->getEmpresaRow($idEmpresa);
		$data['tipoNegocio']	= $this->empresa_negocio_model->getEmpresaNegocioActive($idEmpresa);
		echo json_encode($data);
	}

	public function geteditarval()
	{
		$idEmpresa 	= trim($this->input->post('idEmpresa'));
		$data = array();
		$data['empresa']		= $this->empresa_model->getEmpresaRow($idEmpresa);

		$tipoNegocio = $this->tipo_negocio_model->getTiposNegocioActive();
		
		foreach ($tipoNegocio as $tipo) {
			$obs = '';
			$checked = FALSE;
			$existe = $this->empresa_negocio_model->getEmpresaNegocioRow($tipo->TIPO_NEGOCIO_ID,$idEmpresa);
			if( $existe ){
				$obs = $existe->EMPRESA_TIPO_NEGOCIO_OBS;
				$checked = 'checked';
			}
			$tipoarray[] = array('TIPO_NEGOCIO_ID' => $tipo->TIPO_NEGOCIO_ID,
								 'TIPO_NEGOCIO_NOMBRE' => $tipo->TIPO_NEGOCIO_NOMBRE, 
								 'OBS' => $obs, 
								 'CHECKED' => $checked);
		}

		$data['tipoNegocio'] = $tipoarray;
		echo json_encode($data);
	}

	public function editar()
	{
		$idEmpresa		= $this->input->post('idEditEmpresa');
		$txtEditKeyPush	= trim($this->input->post('txtEditKeyPush')) ? trim($this->input->post('txtEditKeyPush')) : NULL ;
		$txtEmpresa 	= trim($this->input->post('txtEditEmpresa')) ? trim($this->input->post('txtEditEmpresa')) : NULL ;
		$txtRazon 		= trim($this->input->post('txtEditRazon')) ? trim($this->input->post('txtEditRazon')) : NULL ;
		$txtRut 		= trim($this->input->post('txtEditRut')) ? trim($this->input->post('txtEditRut')) : NULL ;
		$txtDireccion 	= trim($this->input->post('txtEditDireccion')) ? trim($this->input->post('txtEditDireccion')) : NULL ;
		$txtLatitud 	= trim($this->input->post('txtEditLatitud')) ? trim($this->input->post('txtEditLatitud')) : NULL ;
		$txtLongitud 	= trim($this->input->post('txtEditLongitud')) ? trim($this->input->post('txtEditLongitud')) : NULL ;
		$txtFono 		= trim($this->input->post('txtEditFono')) ? trim($this->input->post('txtEditFono')) : NULL ;
		$txtEmail 		= trim($this->input->post('txtEditEmail')) ? trim($this->input->post('txtEditEmail')) : NULL ;
		$txtDescripcion = trim($this->input->post('txtEditDescripcion')) ? trim($this->input->post('txtEditDescripcion')) : NULL ;
		$txtWeb 		= trim($this->input->post('txtEditUrl')) ? trim($this->input->post('txtEditUrl')) : NULL ;
		$txtFacebook	= trim($this->input->post('txtEditFacebook')) ? trim($this->input->post('txtEditFacebook')) : NULL ;
		$txtInstagram	= trim($this->input->post('txtEditInstagram')) ? trim($this->input->post('txtEditInstagram')) : NULL ;
		$txtComercio	= trim($this->input->post('txtEditComercio')) ? trim($this->input->post('txtEditComercio')) : NULL ;
		$cmbCiudad 		= trim($this->input->post('cmbEditCiudad')) ? trim($this->input->post('cmbEditCiudad')) : NULL ;
		$ruta 			= NULL;
		$tipoNegocio	= $this->input->post('tipoNegocio') ;
		$tipoNegocioObs	= $this->input->post('tipoNegocioObs') ;

		//UPDATE EMPRESA
		$this->empresa_model->updateEmpresa($idEmpresa, $txtEditKeyPush, $txtEmpresa, $txtRazon, $txtRut, $txtDireccion, $txtLatitud, $txtLongitud, $txtFono, $txtEmail, $txtDescripcion, $txtWeb, $txtFacebook, $txtInstagram, $txtComercio, $cmbCiudad);

		//UPDATE T° NEGOCIO
		if( $tipoNegocio ){
			$this->empresa_negocio_model->updateEmpresaNegocio($idEmpresa);
			foreach( $tipoNegocio as $tipo ){
				$this->empresa_negocio_model->insertEmpresaNegocio($tipo, $idEmpresa, trim($tipoNegocioObs[$tipo]));
			}
		}

		//VALIDAR IMAGEN
		if( !empty($_FILES["EditFotoEmpresa"]["tmp_name"]) ){

			list($ancho,$alto) = getimagesize($_FILES["EditFotoEmpresa"]["tmp_name"]);

			$anchoMaximo = 500;
			$altoProporcional = ($anchoMaximo * $alto) / $ancho;

			$nuevoAncho	= $anchoMaximo;
			$nuevoAlto	= $altoProporcional;

			//CREAR DIRECTORIO PARA GUARDAR FOTO
			if (!file_exists("upload/empresas/".$idEmpresa."/logotipo")) {
				mkdir("upload/empresas/".$idEmpresa."/logotipo", 0777, true);
			}
			$directorio = "upload/empresas/".$idEmpresa."/logotipo";

			//ELIMINAR ARCHIVOS DEL DIRECTORIO
			$files = glob( $directorio . '/*' );
			foreach($files as $file){
				if(is_file($file))
				unlink($file);
			}

			if( $_FILES["EditFotoEmpresa"]["type"] == "image/jpeg" ){
				$aleatorio	= generaRandom();
				$ruta		= $directorio."/".$aleatorio.".jpg";

				$origen		= imagecreatefromjpeg($_FILES["EditFotoEmpresa"]["tmp_name"]);
				$destino	= imagecreatetruecolor($nuevoAncho,$nuevoAlto);

				imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);

				imagejpeg($destino,$ruta);
			}

			if( $_FILES["EditFotoEmpresa"]["type"] == "image/png" ){
				$aleatorio	= generaRandom();
				$ruta		= $directorio."/".$aleatorio.".png";

				$origen		= imagecreatefrompng($_FILES["EditFotoEmpresa"]["tmp_name"]);
				$destino	= imagecreatetruecolor($nuevoAncho,$nuevoAlto);

				imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);

				imagejpeg($destino,$ruta);
			}
			$this->empresa_model->updateEmpresaLogo($idEmpresa, $ruta);
		}

		$success = 'Empresa '.$txtEmpresa.' editada exitosamente.';
		$this->session->set_flashdata('exito',$success);
		redirect(base_url().'empresa');
	}

	public function updatepermisos()
	{
		$idEmpresa	= trim($this->input->post('idempresa')) ;
		$valor		= trim($this->input->post('valor')) ;
		$empresa 	= $this->empresa_model->getEmpresaRow($idEmpresa);

		if( $empresa->EMPRESA_EMAIL ){
			$this->empresa_model->updateEmpresaPorCampo($idEmpresa,'EMPRESA_PERMISO',$valor);

			if( $valor == 1 ){
				//CREAR PASSWORD
				$nuevoPass	= generaPass();
				$this->empresa_model->updateEmpresaPorCampo($idEmpresa,'EMPRESA_PASS',md5($nuevoPass));

				//ENVIAR MENSAJE CON PASSWORD
				$nmbEmpresa	= $empresa->EMPRESA_NOMBRE;
				$email		= $empresa->EMPRESA_EMAIL;
				$asunto		= 'Permisos de Ingreso';
				$exito 		= email_permisos_ingreso($nmbEmpresa,$email,$asunto,$nuevoPass);

				$title	= "ACEPTADO";
				$text	= "Se han otorgado los permisos para ingresar.";
			}else{
				$title	= "ELIMINADO";
				$text	= "Se han eliminado los permisos para ingresar";
			}
		}else{
			$title	= "ERROR";
			$text	= "Debe ser ingresado el correo del cliente para otorgar permisos";
		}

		$data = array();
		$data['title']	= $title;
		$data['text']	= $text;
		echo json_encode($data);
	}

}
