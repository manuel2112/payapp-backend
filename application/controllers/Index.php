<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {
	
	public function __construct()
	{		
		parent::__construct();
		if ( $this->session->userdata('clienteapppay') ) {
			$this->session->set_userdata('', current_url());
			//redirect(base_url('login'));
			redirect(base_url('cliente'));
			return;
		} 
		if (!$this->session->userdata('adminapppay')) {
			$this->session->set_userdata('', current_url());
			redirect(base_url('login'));
		}
        $this->session_id = $this->session->userdata('adminapppay');
	}
	
	public function index()
	{
//		$data["base"]	= $this->base_model->getBase();
		$data["base"]	= '';
		$this->layout->view('index',$data);
	}
    
	public function ultimasaccionesappajax()
	{
		$ultimasAccionesApp = $this->estadistica_model->getEstadisticaUltimasAcciones();
		
		$dataJson = '{
					  "data": [';
		
		
		$i = 1;		
		if( count($ultimasAccionesApp) > 0 ){
			foreach( $ultimasAccionesApp as $item )
			{

				$dataJson .= '[
								  "'.$i++.'",
								  "'.$item->EMPRESA_NOMBRE.'",
								  "'.$item->EST_VISTA_TEXTO.'",
								  "'.$item->EST_CAMPO_TEXTO.'",
								  "'.$item->ESTADISTICA_DATE.'"
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
    
	public function ultimasaccionesbackendajax()
	{
		$ultimasAccionesBackend = $this->estadistica_back_model->getEstadisticaBackUltimasAcciones();
		
		$dataJson = '{
					  "data": [';

		$i = 1;		
		if( count($ultimasAccionesBackend) > 0 ){
			foreach( $ultimasAccionesBackend as $item )
			{

				$dataJson .= '[
								  "'.$i++.'",
								  "'.$item->EMPRESA_NOMBRE.'",
								  "'.$item->EST_CAMPO_BACK_TEXTO.'",
								  "'.$item->ESTADISTICA_BACK_DATE.'"
							  ],';
			}			
		}else{
				$dataJson .= '[
								  "SIN INFORMACIÓN",
								  "---",
								  "---",
								  "---"
							  ],';			
		}

		
		$dataJson = substr($dataJson, 0, -1);
		$dataJson .= '] }';
		
		echo $dataJson;
	}
	
	public function graphajax()
	{
		$seccion		= trim($this->input->post('seccion'));		
		$fechaInicio	= fechaHaceUnMes();

		$final = '[[';
		
		if( $seccion == 1 ){
			$row = $this->ciudad_model->getCiudadGraph($fechaInicio);
			foreach( $row as $item ){
				$final  .= '{"dia":"'.$item->NOMBRE.'","value":"'.$item->VALOR.'"},';
			}			
		}elseif( $seccion == 2 ){
			$row = $this->estadistica_model->getEmpresaGraph($fechaInicio);
			foreach( $row as $item ){
				$final  .= '{"dia":"'.$item->NOMBRE.'","value":"'.$item->VALOR.'"},';
			}
		}else{}
		
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
	
	public function vista()
	{
		echo "Estoy en el home";
	}
	
}
