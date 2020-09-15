<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Horario extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('clienteapppay') && !$this->session->userdata('adminapppay') ) {
			$this->session->set_userdata('', current_url());
			redirect(base_url('login'));
		}

		if($this->session->userdata('adminapppay')){
			$this->session_id 	= $this->session->userdata('adminapppay');
		}
		if($this->session->userdata('clienteapppay')){
			$this->session_id 	= $this->session->userdata('clienteapppay');
		}
	}

/**********************************************************************/
/*                SECCIÓN ITEM - TIPO PRODUCTO                        */
/**********************************************************************/
	
	public function index()
	{
		$data["empresas"]	= $this->empresa_model->getEmpresasActivas();
		$data["horario"]	= $this->horario_model->getHorarioPorEmpresa(1);
		$this->layout->view('index',$data);
	}

	public function inserthorario()
	{
		$idEmpresa		= $this->input->post('idEmpresa');
		$diaApertura	= $this->input->post('diaApertura');
		$horaApertura	= $this->input->post('horaApertura');
		$diaCierre		= $this->input->post('diaCierre');
		$horaCierre		= $this->input->post('horaCierre');
		$data 			= array();
		
		$this->horario_model->insertHorario($idEmpresa,$diaApertura,$horaApertura,$diaCierre,$horaCierre);
		$data['ok'] = '1';
		if($this->session->userdata('adminapppay')){
			$data['url'] = 'horario';
		}
		if($this->session->userdata('clienteapppay')){
			$data['url'] = 'cliente';
		}

		echo json_encode($data);
	}
	
	public function gethorarioempresa()
	{
		$idEmpresa	= $this->input->post('idEmpresa') ;
		$data 		= array();
		$horario	= "";

		$i = 1;
		//OBTENER HORARIO POR EMPRESA
		$horarioEmpresa = $this->horario_model->getHorarioPorEmpresa($idEmpresa);

		//DATOS EMPRESA
		$empresa = $this->empresa_model->getEmpresaRow($idEmpresa);
		$empresaAbierto = $empresa->EMPRESA_ABIERTO == 1 ? 'ABIERTO' : 'CERRADO';

		$horario .= '<table class="table table-hover">';
		$horario .= '<caption>'.$empresaAbierto.'</caption>';
		$horario .= '<thead class="thead-dark">';
		$horario .= '<tr>';
		$horario .= '<th scope="col">#</th>';
		$horario .= '<th scope="col">DÍA APERTURA</th>';
		$horario .= '<th scope="col">HORARIO APERTURA</th>';
		$horario .= '<th scope="col">DIA CIERRE</th>';
		$horario .= '<th scope="col">HORARIO CIERRE</th>';
		$horario .= '<th scope="col">ELIMINAR</th>';
		$horario .= '</tr>';
		$horario .= '</thead>';
		$horario .= '<tbody>';

		foreach( $horarioEmpresa as $itemHorarioEmpresa ){

			$horario .= '<tr>';
			$horario .= '<th scope="row">'.$i++.'</th>';
			$horario .= '<td>'.diaSemanaNmb($itemHorarioEmpresa->HORARIO_DIA_OPEN).'</td>';
			$horario .= '<td>'.$itemHorarioEmpresa->HORARIO_HORA_OPEN.'</td>';
			$horario .= '<td>'.diaSemanaNmb($itemHorarioEmpresa->HORARIO_DIA_CLOSE).'</td>';
			$horario .= '<td>'.$itemHorarioEmpresa->HORARIO_HORA_CLOSE.'</td>';
			$horario .= '<td><button type="button" class="btn btn-danger deleteHorario" title="ELIMINAR HORARIO" idhorario="'.$itemHorarioEmpresa->HORARIO_ID.'"><i class="fas fa-trash-alt"></i></button></td>';
			$horario .= '</tr>';

		}

		if( count($horarioEmpresa) == 0 ){

			$horario .= '<tr>';
			$horario .= '<th scope="row" colspan="5">SIN DATOS INGRESADOS</th>';
			$horario .= '</tr>';
		}

		$horario .= '</tbody>';
		$horario .= '</table>';
		$horario .= '<script src="'.base_url('public/js/validate.horario.ajax.js').'"></script>';

		$data['ok'] = '1';
		$data['horario'] = $horario;
		echo json_encode($data);
	}

	public function horariodelete()
	{
		$idHorario 	= trim($this->input->post('idHorario'));

		$this->horario_model->updateHorarioDelete($idHorario);

		$title	= "ELIMINAR";
		$text	= "EL HORARIO HA SIDO ELIMINADO";		

		$data = array();
		$data['title'] = $title;
		$data['text'] = $text;

		$data['url'] = $this->session->userdata('adminapppay') ? 'horario' : 'cliente';
		
		echo json_encode($data);
	} 
}