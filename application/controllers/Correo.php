<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Correo extends CI_Controller {
	
	public function __construct()
	{		
		parent::__construct();
		if ( $this->session->userdata('clienteappchan') ) {
			redirect(base_url('cliente'));
		} 
		if (!$this->session->userdata('adminappchan')) {
			$this->session->set_userdata('', current_url());
			redirect(base_url('login'));
		}
        $this->session_id = $this->session->userdata('adminappchan');
	}
	
	public function index()
	{
		$data["ciudades"]	= $this->ciudad_model->getCiudad();	
		$this->layout->view('index',$data);
	}
	
	public function insert()
	{
		$idCiudad	= trim($this->input->post('cmbCiudad'));
		$name		= $_FILES['archivo']['name'];
		$tname		= $_FILES['archivo']['tmp_name'];
		$filas		= file($tname);
			
		$i = 0;//TOTAL DE FILAS
		$x = 0;//NUEVOS INGRESADOS	
		$y = 0;//EXISTENTES
		$numero_fila=0;
		//echo $filas[0];	
		while( $i <= count($filas) )
		{
			$correo = !empty($filas[$i]) ? trim($filas[$i]) : '' ;
			if( $correo != "" )
			{
				$existe = $this->correo_model->getCorreo($correo);
				if( count($existe) == 0 ){
					$this->correo_model->insertCorreo($correo, $idCiudad);
					$x++;
				}else{
					$y++;
				}
			}
			$i++;
		}
		
		$texto = $i. " FILAS LEIDAS<br>";
		$texto .= $x. " NUEVOS INGRESADOS<br>";
		$texto .= $y. " EXISTENTES<br>";

			$success = $texto;
			$this->session->set_flashdata('exito',$success);
			redirect($this->agent->referrer());		
	}
	
	public function delete()
	{
		$name		= $_FILES['archivo']['name'];
		$tname		= $_FILES['archivo']['tmp_name'];
		$filas		= file($tname);
			
		$i = 0;//TOTAL DE FILAS
		$x = 0;//NUEVOS INGRESADOS	
		$y = 0;//EXISTENTES
		$numero_fila=0;
		//echo $filas[0];	
		while( $i <= count($filas) )
		{
			$correo = !empty($filas[$i]) ? trim($filas[$i]) : '' ;
			if( $correo != "" )
			{
				$existe = $this->correo_model->getCorreo($correo);
				if( count($existe) > 0 ){
					$this->correo_model->updateCorreoDown($correo);
					$x++;
				}else{
					$y++;
				}
			}
			$i++;
		}
		
		$texto = $i. " FILAS LEIDAS<br>";
		$texto .= $x. " CORREOS ELIMINADOS<br>";
		$texto .= $y. " NO EXISTENTES<br>";

		$success = $texto;
		$this->session->set_flashdata('exito',$success);
		redirect($this->agent->referrer());		
	}
    
	public function quilpueajax()
	{
		$correos = $this->correo_model->getCorreosPorCiudad(1);

		$dataJson = '{
					  "data": [';

		$i = 1;
		if( count($correos) > 0 ){
			foreach( $correos as $item )
			{
				$estado = $item->CORREO_FLAG ? "<button class='btn btn-success btnestadocorreo' idcorreo='".$item->CORREO_ID."' estado='0'><i class='fa fa-check'></i></button>" : "<button class='btn btn-danger btnestadocorreo' idcorreo='".$item->CORREO_ID."' estado='1'><i class='fa fa-times'></i></button>" ;
				
				$dataJson .= '[
								  "'.$i++.'",
								  "'.trim($item->CORREO_NOMBRE).'",
								  "'.$estado.'"
							  ],';
			}
		}else{
				$dataJson .= '[
								  "SIN INFORMACIÓN",
								  "---",
								  "---"
							  ],';			
		}

		$dataJson = substr($dataJson, 0, -1);
		$dataJson .= '] }';

		echo $dataJson;
	}
    
	public function villaalemanaajax()
	{
		$correos = $this->correo_model->getCorreosPorCiudad(2);

		$dataJson = '{
					  "data": [';

		$i = 1;
		if( count($correos) > 0 ){
			foreach( $correos as $item )
			{
				$estado = $item->CORREO_FLAG ? "<button class='btn btn-success btnestadocorreo' idcorreo='".$item->CORREO_ID."' estado='0'><i class='fa fa-check'></i></button>" : "<button class='btn btn-danger btnestadocorreo' idcorreo='".$item->CORREO_ID."' estado='1'><i class='fa fa-times'></i></button>" ;
				
				$dataJson .= '[
								  "'.$i++.'",
								  "'.trim($item->CORREO_NOMBRE).'",
								  "'.$estado.'"
							  ],';
			}
		}else{
				$dataJson .= '[
								  "SIN INFORMACIÓN",
								  "---",
								  "---"
							  ],';			
		}

		$dataJson = substr($dataJson, 0, -1);
		$dataJson .= '] }';

		echo $dataJson;
	}

	public function estadocorreo()
	{
		$idcorreo	= trim($this->input->post('idcorreo'));
		$estado		= trim($this->input->post('estado'));
		
		$this->correo_model->updateCorreoCampo($idcorreo, 'CORREO_FLAG', $estado);
	}
    
	public function exportarporciudad()
	{
		$idCiudad	= $this->uri->segment(3);
		$correos	= $this->correo_model->getCorreosPorCiudadExport($idCiudad);
		$output = '';
		
		foreach( $correos as $item ){
			$output .= $item->CORREO_NOMBRE."\n";
		}
		
		header('Content-type: text/plain');		
		header('Content-Disposition: attachment; filename="ciudad-'.$idCiudad.'.txt"');
		print($output);
	}
	
}
