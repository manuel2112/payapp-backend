<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notificacion extends CI_Controller {
	
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
		$data["empresas"]	= $this->empresa_model->getEmpresasActivas();
		$data["compras"]	= $this->tipo_compra_model->getTiposCompraActive();
		$data["montos"]		= $this->tipo_monto_model->getTiposMontoActive();
		$this->layout->view('index',$data);
	}

	public function indexajax()
	{
		$notificaciones = $this->empresa_notificacion_model->getClienteNotificacionAll();

		$dataJson = '{
					  "data": [';

		$i = 1;
		if( count( $notificaciones) > 0 ){
			foreach( $notificaciones as $item )
			{
				$programada = $item->NOTIFICACION_PROGRAMADA ? "<button class='btn btn-success btnnotificacionprogramada' idnotificacion='".$item->NOTIFICACION_ID."' estado='0'><i class='fa fa-check'></i></button>" : "<button class='btn btn-danger btnnotificacionprogramada' idnotificacion='".$item->NOTIFICACION_ID."' estado='1'><i class='fa fa-times'></i></button>" ;

				$horaEnvio		= $item->NOTIFICACION_ENVIO ? $item->NOTIFICACION_ENVIO : "<i class='fa fa-minus-circle btn btn-danger'></i></button>" ;
				
				$tipoCompra		= $item->TIPO_COMPRA_ID ? $item->TIPO_COMPRA_NOMBRE : "<i class='fa fa-exclamation-triangle btn btn-warning'></i></button>" ;
				
				$monto			= $item->TIPO_MONTO_ID ? formatoDinero($item->TIPO_MONTO_NOMBRE) : "---" ;
				
				$botones =  "<div class='btn-group'>";				
				$botones .=  "<button class='btn btn-primary btnGetVerNotificacion' idnotificacion='".$item->NOTIFICACION_ID."' data-toggle='modal' data-target='#modalVerNotificacion'><i class='fa fa-info-circle fa-lg'></i></button>";
				if( $item->NOTIFICACION_FLAG ){
					$botones .=  "<button class='btn btn-warning btnGetEditarNotificacion' idnotificacion='".$item->NOTIFICACION_ID."' data-toggle='modal' data-target='#modalEditarNotificacion'><i class='fa fa-pencil fa-lg'></i></button>";
				}
				if( !$item->TIPO_COMPRA_ID ){
					$botones .=  "<button class='btn btn-success btnInsertTipoPago' idnotificacion='".$item->NOTIFICACION_ID."' data-toggle='modal' data-target='#modalInsertTipoPago'><i class='fa fa-usd fa-lg'></i></button>";
				}
				$botones .=  "</div>";
				
				//SI ESTÁ ELIMINADA
				if( !$item->NOTIFICACION_FLAG ){
					$programada	= "<i class='fa fa-minus-circle btn btn-danger'></i></button>";
					$monto		= "<i class='fa fa-minus-circle btn btn-danger'></i></button>";
					$tipoCompra	= "<i class='fa fa-minus-circle btn btn-danger'></i></button>";
				}

				$dataJson .= '[
								  "'.$i++.'",
								  "'.$item->NOTIFICACION_ID.'",
								  "'.$item->EMPRESA_NOMBRE.'",
								  "'.$item->NOTIFICACION_INGRESO.'",
								  "'.$horaEnvio.'",
								  "'.$programada.'",
								  "'.$tipoCompra.'",
								  "'.$monto.'",
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

	public function estadoprogramado()
	{
		$idNotificacion	= trim($this->input->post('idnotificacion'));
		$estado			= trim($this->input->post('estado'));
		
		$this->empresa_notificacion_model->updateEstadoCampo($idNotificacion, 'NOTIFICACION_PROGRAMADA', $estado);
	}

	public function getnotificacion()
	{
		$idNotificacion 	= trim($this->input->post('idnotificacion'));
		
		$data = array();
		$data['notificacion']	= $this->empresa_notificacion_model->getClienteNotificacionRow($idNotificacion);
		echo json_encode($data);
	}

	public function insert()
	{
		$idEmpresa 		= $this->input->post('cmbEmpresa');
		$fechaEnvio 	= trim($this->input->post('datetimepickernotificacion')) ? trim($this->input->post('datetimepickernotificacion')) : NULL ;
		$txtDescripcion = trim($this->input->post('txtDescripcion')) ? trim($this->input->post('txtDescripcion')) : NULL ;
		$txtDescripcion = remove_emoji($txtDescripcion);
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

		$success = 'Notificación ingresada exitosamente.';
		$this->session->set_flashdata('exito',$success);
		redirect(base_url().'notificacion');
	}

	public function insertnotificacionpago()
	{
		$idNotificacion	= trim($this->input->post('idNotificacion'));
		$idTipoCompra	= trim($this->input->post('opttipopago'));
		$idTipoMonto	= trim($this->input->post('optpagoefectivo')) ? trim($this->input->post('optpagoefectivo')) : null ;
		$observacion	= trim($this->input->post('observacion'));
		
		$error = "";
		if( !$idTipoCompra ){
			$error .= "SELECCIONAR TIPO DE PAGO\n";
		}
		if( $idTipoCompra == "1" && !$idTipoMonto ){
			$error .= "SELECCIONAR MONTO PAGADO\n";
		}
		if( !$observacion ){
			$error .= "INGRESAR OBSERVACIÓN\n";
		}
		
		if( $error != "" ){
			echo $error;
			return;
		}else{
			$this->empresa_notificacion_model->updateNotificacionTipoPago($idNotificacion, $idTipoCompra, $idTipoMonto, $observacion);
			
			//SI ES ELIMINADO
			if( $idTipoCompra == 5 ){			
				$this->empresa_notificacion_model->updateNotificacionDarBaja($idNotificacion);	
			}
			echo '1';
			return;			
		}
	}

	public function editar()
	{
		$idNotificacion			= $this->input->post('editNotificacionId');
		$idEmpresa				= $this->input->post('editNotificacionIdEmpresa');
		$txtNotificacion		= trim($this->input->post('editNotificacionTexto')) ? trim($this->input->post('editNotificacionTexto')) : NULL ;
		$txtNotificacion 		= remove_emoji($txtNotificacion);
		$dateSendNotificacion	= trim($this->input->post('editNotificacionEnvio')) ? trim($this->input->post('editNotificacionEnvio')) : NULL ;
		$idTipoCompra			= $this->input->post('cmbEditTipoCompra') != 0 ? trim($this->input->post('cmbEditTipoCompra')) : NULL ;
		$idTipoMonto			= $this->input->post('cmbEditTipoMonto') && $idTipoCompra ? trim($this->input->post('cmbEditTipoMonto')) : NULL ;
		$txtNotificacionObs		= trim($this->input->post('editNotificacionObs')) ? trim($this->input->post('editNotificacionObs')) : NULL ;
		$numNotificacionEnviados	= trim($this->input->post('editNotificacionEnviados')) != '' ? trim($this->input->post('editNotificacionEnviados')) : NULL ;
		$numNotificacionAperturas		= trim($this->input->post('editNotificacionAperturas')) != '' ? trim($this->input->post('editNotificacionAperturas')) : NULL ;
		$ruta	= NULL;

		//EDITAR NOTIFICACION
		$this->empresa_notificacion_model->updateNotificacionAll($idNotificacion, $txtNotificacion, $dateSendNotificacion, $idTipoCompra, $idTipoMonto, $txtNotificacionObs, $numNotificacionEnviados, $numNotificacionAperturas);		

		//VALIDAR IMAGEN
		if( !empty($_FILES["nuevaFotoEmpresa"]["tmp_name"]) ){

			list($ancho,$alto) = getimagesize($_FILES["nuevaFotoEmpresa"]["tmp_name"]);

			$anchoMaximo = 500;
			$altoProporcional = ($anchoMaximo * $alto) / $ancho;

			$nuevoAncho	= $anchoMaximo;
			$nuevoAlto	= $altoProporcional;

			//CREAR DIRECTORIO PARA GUARDAR FOTO
			if (!file_exists("upload/empresas/".$idEmpresa."/notificacion/")) {
				mkdir("upload/empresas/".$idEmpresa."/notificacion/", 0777, true);
			}
			$directorio = "upload/empresas/".$idEmpresa."/notificacion/";
			$aleatorio	= "notificacion_".time();

			if( $_FILES["nuevaFotoEmpresa"]["type"] == "image/jpeg" ){
				$ruta		= $directorio."/".$aleatorio.".jpg";
				
				$origen		= imagecreatefromjpeg($_FILES["nuevaFotoEmpresa"]["tmp_name"]);
				$destino	= imagecreatetruecolor($nuevoAncho,$nuevoAlto);
				
				imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);
				
				imagejpeg($destino,$ruta);
			}

			if( $_FILES["nuevaFotoEmpresa"]["type"] == "image/png" ){
				$ruta		= $directorio."/".$aleatorio.".png";
				
				$origen		= imagecreatefrompng($_FILES["nuevaFotoEmpresa"]["tmp_name"]);
				$destino	= imagecreatetruecolor($nuevoAncho,$nuevoAlto);
				
				imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);
				
				imagejpeg($destino,$ruta);
			}

			$this->empresa_notificacion_model->updateImagenClienteNotificacion($idNotificacion, $ruta);
		}

		$success = 'Notificación editada exitosamente.';
		$this->session->set_flashdata('exito',$success);
		redirect(base_url().'notificacion');
	}

}
