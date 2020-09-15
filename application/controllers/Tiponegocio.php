<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tiponegocio extends CI_Controller {
	
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
		$tiposnegocio = $this->tipo_negocio_model->getTiposNegocio();
		
		$dataJson = '{
					  "data": [';
		
		$i = 1;
		foreach( $tiposnegocio as $item )
		{
			
			$estado = $item->TIPO_NEGOCIO_FLAG ? "<button class='btn btn-success btnactivartiponegocio' idtiponegocio='".$item->TIPO_NEGOCIO_ID."' estado='0'>Activado</button>" : "<button class='btn btn-danger btnactivartiponegocio' idtiponegocio='".$item->TIPO_NEGOCIO_ID."' estado='1'>Desactivado</button>";
			
			$botones =  "<div class='btn-group'><button class='btn btn-warning btnGetEditarTipoNegocio' idtiponegocio='".$item->TIPO_NEGOCIO_ID."' data-toggle='modal' data-target='#modalEditarTipoNegocio'><i class='fa fa-pencil'></i></div>";
			
			$dataJson .= '[
							  "'.$i++.'",
							  "'.$item->TIPO_NEGOCIO_NOMBRE.'",
							  "'.$estado.'",
							  "'.$botones.'"
						  ],';			
		}
		
		$dataJson = substr($dataJson, 0, -1);
		$dataJson .= '] }';
		
		echo $dataJson;
	}
    
	public function insert()
	{
		$tipoNegocio = trim($this->input->post('tipoNegocio'));
		
		$existe = $this->tipo_negocio_model->getTiposNegocioExiste($tipoNegocio);
		
		if( empty($tipoNegocio) ){
			echo '<div class="alert alert-danger text-center" role="alert">*Campo vacio, favor revisar</div>';
		}elseif( $existe ){
			echo '<div class="alert alert-danger text-center" role="alert">*Campo existente, favor revisar</div>';			
		}else{
			$this->tipo_negocio_model->insertTiposNegocio($tipoNegocio);
			echo '<script>
					swal({
						type: "success",
						title: "¡Tipo de negocio ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
					}).then(function(result){
						if(result.value){
							window.location = "tiponegocio";
						}
					});
				</script>';
		}
	}
    
	public function estado()
	{
		$idTipoNegocio 	= trim($this->input->post('idtiponegocio'));
		$estado 		= trim($this->input->post('estado'));
		
		$this->tipo_negocio_model->updateTipoNegocio($idTipoNegocio, $estado);
	}
    
	public function geteditar()
	{
		$idTipoNegocio = trim($this->input->post('idtiponegocio'));
		
		$existe = $this->tipo_negocio_model->getTipoNegocioRow($idTipoNegocio);
		
		echo json_encode($existe);
	}
    
	public function editar()
	{
		$idTipoNegocio 	= trim($this->input->post('idtiponegocio'));
		$txtTipoNegocio = trim($this->input->post('txtTipoNegocio'));
		
		$existe = $this->tipo_negocio_model->getTiposNegocioEditExiste($idTipoNegocio,$txtTipoNegocio);
		
		if( empty($txtTipoNegocio) ){
			echo '<div class="alert alert-danger text-center" role="alert">*Campo vacio, favor revisar</div>';
		}elseif( $existe ){
			echo '<div class="alert alert-danger text-center" role="alert">*Tipo de Negocio existente, favor revisar</div>';	
		}else{
			$this->tipo_negocio_model->updateTipoNegocioTxt($idTipoNegocio,$txtTipoNegocio);
			echo '<script>
					swal({
						type: "success",
						title: "¡Tipo de negocio ha sido editado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
					}).then(function(result){
						if(result.value){
							window.location = "tiponegocio";
						}
					});
				</script>';
		}
	}

}
