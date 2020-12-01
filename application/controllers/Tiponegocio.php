<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tiponegocio extends CI_Controller {
	
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
		$data['idDelivery']		= 1;
		$data['idRestaurante'] 	= 2;
		$data['idRetiro']		= 3;
		$data['montoMinimo']	= $this->empresa_negocio_model->getEmpresaNegocioMontoRow($this->session_id);
		$data['sectores']		= $this->empresa_negocio_model->getSector($this->session_id);
		$this->layout->view('index', $data);
	}
    
	public function insert()
	{
		$data  = array();

		$idTipo			= trim($this->input->post("idTipo",true));
		$idEmpresa		= $this->session_id;
		$descripcion	= trim($this->input->post("descripcion",true));

		$existe = $this->empresa_negocio_model->getEmpresaNegocioRow($idTipo,$idEmpresa);
		$bool = $descripcion ? TRUE : FALSE;
		$mensaje = $bool ? 'TIPO DE NEGOCIO AGREGADO' : 'TIPO DE NEGOCIO ELIMINADO';

		if( $existe ){
			$idUpdt = $existe->EMPRESA_TIPO_NEGOCIO_ID;
			$this->empresa_negocio_model->updateEmpresaNegocio($idUpdt, $descripcion, $bool );
		}else{			
			$this->empresa_negocio_model->insertEmpresaNegocio($idTipo, $idEmpresa, $descripcion, $bool);
		}

		$data['ok'] 	= '1';
		$data['msn'] 	= $mensaje;
		echo json_encode($data);
	}
    
	public function insertmonto()
	{
		$data  = array();

		$idEmpresa		= $this->session_id;
		$txtMonto		= mb_strtoupper(trim($this->input->post("txtMonto",true)));
		$valorMonto		= trim($this->input->post("numberMonto",true));

		$existe		= $this->empresa_negocio_model->getEmpresaNegocioMontoRow($idEmpresa);
		$bool 		= $txtMonto ? TRUE : FALSE;
		$mensaje 	= $bool ? 'MONTO MÍNIMO AGREGADO' : 'MONTO MÍNIMO ELIMINADO';

		if( $bool && (!is_numeric($valorMonto) || ($valorMonto < 1)) ){
			$data['ok'] 	= '2';
			$data['msn'] 	= 'VALOR NUMÉRICO INCORRECTO.';
			echo json_encode($data);
			exit();
		}

		if( $existe ){
			$idMonto = $existe->MONTO_ID;
			$this->empresa_negocio_model->updateEmpresaNegocioMonto($idMonto, $txtMonto, $valorMonto, $bool );
		}else{
			$this->empresa_negocio_model->insertEmpresaNegocioMonto($idEmpresa, $txtMonto, $valorMonto);
		}

		$data['ok'] 	= '1';
		$data['msn'] 	= $mensaje;
		echo json_encode($data);
	}
    
	public function insertsector()
	{
		$data  = array();

		$idEmpresa		= $this->session_id;
		$txtSector		= mb_strtoupper(trim($this->input->post("txtSector",true)));
		$precioSector	= trim($this->input->post("precioSector",true));

		if( !$txtSector || (!is_numeric($precioSector) || ($precioSector < 1)) ){
			$data['ok'] 	= '2';
			$data['msn'] 	= 'SECTOR Y CAMPO NÚMERICO OBLIGATORIO';
			echo json_encode($data);
			exit();
		}

		$this->empresa_negocio_model->insertSector($idEmpresa, $txtSector, $precioSector);
		$mensaje 	= 'SECTOR AGREGADO';

		$data['ok'] 	= '1';
		$data['msn'] 	= $mensaje;
		echo json_encode($data);
	}
    
	public function deletesector()
	{
		$data  = array();
		$idSector	= $this->input->post("idSector",true);

		$this->empresa_negocio_model->deleteSector($idSector);
		$mensaje 	= 'SECTOR ELIMINADO EXITOSAMENTE';

		$data['ok'] 	= '1';
		$data['msn'] 	= $mensaje;
		echo json_encode($data);
	}

	public function getsectores()
	{
		$data  = array();

		$data['sectores'] 	= $this->empresa_negocio_model->getSector($this->session_id);
		echo json_encode($data);

	}

}
