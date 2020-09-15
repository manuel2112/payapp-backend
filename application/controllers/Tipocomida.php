<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tipocomida extends CI_Controller {
	
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
		$tiposcomida = $this->tipo_comida_model->getTiposComida();
		
		$dataJson = '{
					  "data": [';
		
		$k = 0;
		foreach( $tiposcomida as $item ){
			if($item->TIPO_COMIDA_FLAG){
				$k++;
			}
		}
		
		$i = 1;		
		if( count($tiposcomida) > 0 ){
			foreach( $tiposcomida as $item )
			{
				$estado = $item->TIPO_COMIDA_FLAG ? "<button class='btn btn-success btnactivartipocomida' idtipocomida='".$item->TIPO_COMIDA_ID."' estadotipocomida='0'>Activado</button>" : "<button class='btn btn-danger btnactivartipocomida' idtipocomida='".$item->TIPO_COMIDA_ID."' estadotipocomida='1'>Desactivado</button>";

				$botones =  "<div class='btn-group'><button class='btn btn-warning btnGetEditarTipoComida' idtipocomida='".$item->TIPO_COMIDA_ID."' data-toggle='modal' data-target='#modalEditarTipoComida'><i class='fa fa-pencil'></i></div>";
				
				$imagen = $item->TIPO_COMIDA_IMAGEN ? "<img src='".base_url().$item->TIPO_COMIDA_IMAGEN."' width='50px'>" : "<img src='".base_url()."public/images/food-defecto.png' width='50px'>";
				
				//ORDEN
				if( $i == 1 ){
					$orden = "<div class='btn-group'><a href='".base_url()."tipocomida/orden/2/".$item->TIPO_COMIDA_ID."/".$item->TIPO_COMIDA_ORDEN."' class='btn btn-danger'><i class='fa fa-arrow-down'></i></a></div>";
				}elseif( $i == $k ){
					$orden = "<div class='btn-group'><a href='".base_url()."tipocomida/orden/1/".$item->TIPO_COMIDA_ID."/".$item->TIPO_COMIDA_ORDEN."' class='btn btn-success'><i class='fa fa-arrow-up'></i></a></div>";
				}elseif( !$item->TIPO_COMIDA_FLAG ){
					$orden = "";
				}else{
					$orden = "<div class='btn-group'><a href='".base_url()."tipocomida/orden/1/".$item->TIPO_COMIDA_ID."/".$item->TIPO_COMIDA_ORDEN."' class='btn btn-success'><i class='fa fa-arrow-up'></i></a><a href='".base_url()."tipocomida/orden/2/".$item->TIPO_COMIDA_ID."/".$item->TIPO_COMIDA_ORDEN."' class='btn btn-danger'><i class='fa fa-arrow-down'></i></a></div>";
				}

				$dataJson .= '[
								  "'.$i++.'",
								  "'.$imagen.'",
								  "'.$item->TIPO_COMIDA_NOMBRE.'",
								  "'.$estado.'",
								  "'.$orden.'",
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
    
	public function insert()
	{
		$tipoComida = trim($this->input->post('nuevoTipoComida'));
		$ruta = NULL;
		
		//VALIDAR IMAGEN
		if( !empty($_FILES["nuevaFotoComida"]["tmp_name"]) ){

			list($ancho,$alto) = getimagesize($_FILES["nuevaFotoComida"]["tmp_name"]);
			
			$anchoMaximo = 500;
			$altoProporcional = ($anchoMaximo * $alto) / $ancho;

			$nuevoAncho	= $anchoMaximo;
			$nuevoAlto	= $altoProporcional;
					
			//CREAR DIRECTORIO PARA GUARDAR FOTO					
			$directorio = "upload/comidas";
			//mkdir($directorio,0755);
					
			if( $_FILES["nuevaFotoComida"]["type"] == "image/jpeg" ){
				$aleatorio	= generaRandom();
				$ruta		= $directorio."/".$aleatorio.".jpg";
				
				$origen		= imagecreatefromjpeg($_FILES["nuevaFotoComida"]["tmp_name"]);
				$destino	= imagecreatetruecolor($nuevoAncho,$nuevoAlto);
				
				imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);
				
				imagejpeg($destino,$ruta);
			}
					
			if( $_FILES["nuevaFotoComida"]["type"] == "image/png" ){
				$aleatorio	= generaRandom();
				$ruta		= $directorio."/".$aleatorio.".png";
				
				$origen		= imagecreatefrompng($_FILES["nuevaFotoComida"]["tmp_name"]);
				$destino	= imagecreatetruecolor($nuevoAncho,$nuevoAlto);
				
				imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);
				
				imagejpeg($destino,$ruta);
			}
		}		
		
		$idTipoComida = $this->tipo_comida_model->insertTipoComida($tipoComida,$ruta);
		$this->tipo_comida_model->updateTipoComidaOrden($idTipoComida,$idTipoComida);
		$success = 'Tipo de comida ingresado exitosamente.';
		$this->session->set_flashdata('exito',$success);
		redirect(base_url().'tipocomida');
	}
    
	public function estado()
	{
		$idTipoComida 	= trim($this->input->post('idtipocomida'));
		$estado 		= trim($this->input->post('estado'));
		
		$this->tipo_comida_model->updateTipoComidaEstado($idTipoComida,$estado);
	}
    
	public function orden()
	{
		$upDown 			= $this->uri->segment(3);
		$idTipoComida		= $this->uri->segment(4);
		$ordenTipoComida	= $this->uri->segment(5);
		
		$row = $this->tipo_comida_model->getTiposComidaOrden($upDown,$ordenTipoComida);
		$this->tipo_comida_model->updateTipoComidaOrden($row->TIPO_COMIDA_ID,$ordenTipoComida);
		$this->tipo_comida_model->updateTipoComidaOrden($idTipoComida,$row->TIPO_COMIDA_ORDEN);
		
		redirect(base_url().'tipocomida');
	}
    
	public function geteditar()
	{
		$idTipoComida = trim($this->input->post('idTipoComida'));
		$existe = $this->tipo_comida_model->getTipoComidaRow($idTipoComida);
		echo json_encode($existe);
	}
    
	public function editar()
	{
		$idTipoComida 	= trim($this->input->post('editarIdTipoComida'));
		$tipoComida 	= trim($this->input->post('editarTipoComida'));
		$ruta = NULL;
		
		//VALIDAR IMAGEN
		if( !empty($_FILES["nuevaFotoComida"]["tmp_name"]) ){

			list($ancho,$alto) = getimagesize($_FILES["nuevaFotoComida"]["tmp_name"]);
			
			$anchoMaximo = 500;
			$altoProporcional = ($anchoMaximo * $alto) / $ancho;

			$nuevoAncho	= $anchoMaximo;
			$nuevoAlto	= $altoProporcional;
					
			//CREAR DIRECTORIO PARA GUARDAR FOTO					
			$directorio = "upload/comidas";
			//mkdir($directorio,0755);
					
			if( $_FILES["nuevaFotoComida"]["type"] == "image/jpeg" ){
				$aleatorio	= generaRandom();
				$ruta		= $directorio."/".$aleatorio.".jpg";
				
				$origen		= imagecreatefromjpeg($_FILES["nuevaFotoComida"]["tmp_name"]);
				$destino	= imagecreatetruecolor($nuevoAncho,$nuevoAlto);
				
				imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);
				
				imagejpeg($destino,$ruta);
			}
					
			if( $_FILES["nuevaFotoComida"]["type"] == "image/png" ){
				$aleatorio	= generaRandom();
				$ruta		= $directorio."/".$aleatorio.".png";
				
				$origen		= imagecreatefrompng($_FILES["nuevaFotoComida"]["tmp_name"]);
				$destino	= imagecreatetruecolor($nuevoAncho,$nuevoAlto);
				
				imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);
				
				imagejpeg($destino,$ruta);
			}
			
			$this->tipo_comida_model->updateTipoComidaCampo($idTipoComida,"TIPO_COMIDA_IMAGEN",$ruta);
		}		
		
		$this->tipo_comida_model->updateTipoComidaCampo($idTipoComida,"TIPO_COMIDA_NOMBRE",$tipoComida);
		$success = $tipoComida.' editado exitosamente.';
		$this->session->set_flashdata('exito',$success);
		redirect(base_url().'tipocomida');
	}
    
	public function existetipocomida()
	{
		$tipoComida = trim($this->input->post('tipoComida'));
		
		$existe = $this->tipo_comida_model->getTipoComidaExiste($tipoComida);
		
		if( $existe > 0 ){
			echo TRUE;
		}else{
			echo FALSE;
		}
	}
    
	public function existetipocomidaedit()
	{
		$idTipoComida 	= trim($this->input->post('idTipoComida'));
		$tipoComida 	= trim($this->input->post('tipoComida'));
		
		$existe = $this->tipo_comida_model->getTipoComidaExisteEdit($idTipoComida,$tipoComida);
		
		if( $existe > 0 ){
			echo TRUE;
		}else{
			echo FALSE;
		}
	}

}
