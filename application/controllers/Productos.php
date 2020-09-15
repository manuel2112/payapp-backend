<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {
	
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
		$data = array();
		$data['tipoProducto']	= $this->tipo_producto_model->getTipoProductoPorEmpresa($this->session_id);
		$this->layout->view('index',$data);
	}
	
	//ITEM
	public function insertitem()
	{
		$idEmpresa	= trim($this->input->post("idEmpresa",true));
		$txtItem	= trim($this->input->post("txtItem",true));		
		$this->tipo_producto_model->insertTipoProducto($idEmpresa,$txtItem);		
		$count = $this->tipo_producto_model->getTipoProductoPorEmpresaCount($idEmpresa,$txtItem);		
		$data = array();
		$data['ok'] = $count > 0 ? '2' : '1' ;
		echo json_encode($data);		
	}
	
	public function getitem()
	{
		$idItem		= trim($this->input->post("idItem",true));
		$data['item'] = $this->tipo_producto_model->getTipoProductoRow($idItem);
		echo json_encode($data);		
	}
	
	public function edititem()
	{
		$idItem		= trim($this->input->post("idItem",true));
		$idEmpresa	= trim($this->input->post("idEmpresa",true));
		$txtItem	= trim($this->input->post("txtItem",true));
		$data 		= array();
		
		$count = $this->tipo_producto_model->editTipoProductoPorEmpresaCount($idEmpresa,$txtItem,$idItem);
		
		if( $count == 0 ){
			$this->tipo_producto_model->updateTipoProducto($idItem,$txtItem);
		}
		
		$data['ok'] = $count == 0 ? '1' : '2' ;
		
		echo json_encode($data);		
	}

/*=============================================
HIDDEN
=============================================*/	
	public function itemhidden()
	{
		$idItem		= trim($this->input->post("idItem",true));
		$value		= trim($this->input->post("value",true));
		$data 		= array();
		
		$this->tipo_producto_model->updateTipoProductoShow($idItem,$value);
		
		$data['title'] = "Proceso exitoso";
		$data['text'] = $value == '1' ? "El producto está activo" :  "El producto ya no está activo";		
		$data['ok'] = '1' ;
		
		echo json_encode($data);		
	}

/*=============================================
ORDER
=============================================*/
	public function menuitemempresa()
	{
		$idEmpresa	= trim($this->input->post("idEmpresa",true));
		$data 		= array();

		$data['items'] 		= $this->tipo_producto_model->getTipoProductoPorEmpresa($idEmpresa);	
		$data['empresa']	= $this->empresa_model->getEmpresaRow($idEmpresa);
		
		echo json_encode($data);		
	}
	
	public function orderitem()
	{
		$position	= $this->input->post("position",true);
		
		$k = 1;
		for( $i = 0 ; $i < count($position) ; $i++ ){
			$this->tipo_producto_model->updateTipoProductoOrder($k,$position[$i]);
			$k++;
		}
	}
	
	public function menuproductosempresa()
	{
		$idItem	= trim($this->input->post("idItem",true));
		$data	= array();

		$data['productos']	= $this->producto_model->getProductoPorTipo($idItem);	
		$data['item']		= $this->tipo_producto_model->getTipoProductoRow($idItem);
		
		echo json_encode($data);		
	}
	
	public function orderproducto()
	{
		$position	= $this->input->post("position",true);
		
		$k = 1;
		for( $i = 0 ; $i < count($position) ; $i++ ){
			$this->producto_model->updateProductoOrder($k,$position[$i]);
			$k++;
		}	
		
	}
	
	public function ordergaleria()
	{
		$position	= $this->input->post("position",true);
		
		$k = 1;
		for( $i = 0 ; $i < count($position) ; $i++ ){
			$this->producto_foto_model->updateProductoFotoOrder($k,$position[$i]);
			$k++;
		}
		
	}
	
	public function menuvavarempresa()
	{
		$idProducto	= trim($this->input->post("idProducto",true));
		$data	= array();

		$data['vavar']		= $this->producto_variable_model->getProductoVariable($idProducto);	
		$data['producto']	= $this->producto_model->getProductoRow($idProducto);
		
		echo json_encode($data);		
	}
	
	public function ordervavar()
	{
		$position	= $this->input->post("position",true);
		
		$k = 1;
		for( $i = 0 ; $i < count($position) ; $i++ ){
			$this->producto_variable_model->updateProductoVariableOrder($k,$position[$i]);
			$k++;
		}
		
	}

/*=============================================
PRODUCTO
=============================================*/
	
	public function getproducto()
	{
		$idProducto	= $this->input->post("idProducto",true);
		$data		= array();
		
		$data['producto']	= $this->producto_model->getProductoRow($idProducto);
		echo json_encode($data);
		
	}
	
	//PRODUCTO
	public function insertproducto()
	{
		$data 		= array();
		$idEmpresa				= trim($this->input->post("idEmpresaProducto",true));
		$idTipoProducto			= trim($this->input->post("idTipoProducto",true));
		$txtAddProducto			= trim($this->input->post("txtAddProducto",true));
		$txtAddProductoDesc		= trim($this->input->post("txtAddProductoDesc",true));
		$chkProductoOferta		= trim($this->input->post("chkProductoOferta",true));
		$chkProductoDest		= trim($this->input->post("chkProductoDest",true));
		
		$txtAddProductoValor	= trim($this->input->post("txtAddProductoValor",true));
		$txtAddProductoStock	= trim($this->input->post("txtAddProductoStock",true)) != '' ? trim($this->input->post("txtAddProductoStock",true)) : NULL ;
		
		$txtAddProductoDescVar	= json_decode(stripslashes(trim($this->input->post("txtAddProductoDescVar",true))));
		$txtAddProductoValorVar	= json_decode(stripslashes(trim($this->input->post("txtAddProductoValorVar",true))));
		$txtAddProductoStockVar	= json_decode(stripslashes(trim($this->input->post("txtAddProductoStockVar",true))));
		
		$idProducto = $this->producto_model->insertProducto($idTipoProducto,$txtAddProducto,$txtAddProductoDesc,$chkProductoOferta,$chkProductoDest);
		
		//INSERTAR LOS PRECIOS
		//VALORES BASE
		$this->producto_variable_model->insertProductoVariable(NULL, $txtAddProductoValor,$txtAddProductoStock, $idProducto, TRUE);
		//VALORES VARIABLES
		for( $i = 0 ; $i < count($txtAddProductoValorVar) ; $i++ ){
			$stock	= trim($txtAddProductoStockVar[$i]) != '' ? trim($txtAddProductoStockVar[$i]) : NULL ;
			$this->producto_variable_model->insertProductoVariable($txtAddProductoDescVar[$i], $txtAddProductoValorVar[$i], $stock, $idProducto, FALSE);
		}		

		//VALIDAR IMAGEN
		if( !empty($_FILES["imagen"]["tmp_name"]) ){

			list($ancho,$alto) = getimagesize($_FILES["imagen"]["tmp_name"]);
			
			$anchoMaximo = 500;
			$altoProporcional = ($anchoMaximo * $alto) / $ancho;

			$nuevoAncho	= $anchoMaximo;
			$nuevoAlto	= $altoProporcional;
					
			//CREAR DIRECTORIO PARA GUARDAR FOTO
			if (!file_exists("upload/empresas/".$idEmpresa."/producto")) {
				mkdir("upload/empresas/".$idEmpresa."/producto", 0777, true);
			}
			$directorio = "upload/empresas/".$idEmpresa."/producto";
			$aleatorio	= generaRandom();
					
			if( $_FILES["imagen"]["type"] == "image/jpeg" ){				
				$ruta		= $directorio."/".$aleatorio.".jpg";
				
				$origen		= imagecreatefromjpeg($_FILES["imagen"]["tmp_name"]);
				$destino	= imagecreatetruecolor($nuevoAncho,$nuevoAlto);
				
				imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);
				
				imagejpeg($destino,$ruta);
			}
					
			if( $_FILES["imagen"]["type"] == "image/png" ){
				$ruta		= $directorio."/".$aleatorio.".png";
				
				$origen		= imagecreatefrompng($_FILES["imagen"]["tmp_name"]);
				$destino	= imagecreatetruecolor($nuevoAncho,$nuevoAlto);
				
				imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);
				
				imagejpeg($destino,$ruta);
			}
			$this->producto_model->updateProductoImg($idProducto,$ruta);
		}
		
		$data['ok'] = '1';
		//$data['ok'] = $_FILES["imagen"]["tmp_name"];
		echo json_encode($data);
	}
	
	public function editproducto()
	{
		$data				= array();
		$idProducto			= trim($this->input->post("idProducto",true));
		$idItem				= trim($this->input->post("idItem",true));
		$txtProducto		= trim($this->input->post("txtProducto",true));
		$txtProductoDesc	= trim($this->input->post("txtProductoDesc",true));
		$chkProductoOferta	= trim($this->input->post("chkProductoOferta",true));
		$chkProductoDest	= trim($this->input->post("chkProductoDest",true));
		
		$counter = $this->producto_model->editProductoCount($idProducto,$txtProducto,$idItem);
		if( $counter > 0 ){
			$data['ok'] = '2';
			echo json_encode($data);
			exit();
		}
		
		$this->producto_model->updateProducto($idProducto,$txtProducto,$chkProductoOferta,$chkProductoDest,$txtProductoDesc);
		
		$item = $this->tipo_producto_model->getTipoProductoRow($idItem);
		$idEmpresa = $item->EMPRESA_ID;

		//VALIDAR IMAGEN
		if( !empty($_FILES["imagen"]["tmp_name"]) ){

			list($ancho,$alto) = getimagesize($_FILES["imagen"]["tmp_name"]);
			
			$anchoMaximo = 500;
			$altoProporcional = ($anchoMaximo * $alto) / $ancho;

			$nuevoAncho	= $anchoMaximo;
			$nuevoAlto	= $altoProporcional;
					
			//CREAR DIRECTORIO PARA GUARDAR FOTO
			if (!file_exists("upload/empresas/".$idEmpresa."/producto")) {
				mkdir("upload/empresas/".$idEmpresa."/producto", 0777, true);
			}
			$directorio = "upload/empresas/".$idEmpresa."/producto";
			$aleatorio	= generaRandom();
					
			if( $_FILES["imagen"]["type"] == "image/jpeg" ){				
				$ruta		= $directorio."/".$aleatorio.".jpg";
				
				$origen		= imagecreatefromjpeg($_FILES["imagen"]["tmp_name"]);
				$destino	= imagecreatetruecolor($nuevoAncho,$nuevoAlto);
				
				imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);
				
				imagejpeg($destino,$ruta);
			}
					
			if( $_FILES["imagen"]["type"] == "image/png" ){
				$ruta		= $directorio."/".$aleatorio.".png";
				
				$origen		= imagecreatefrompng($_FILES["imagen"]["tmp_name"]);
				$destino	= imagecreatetruecolor($nuevoAncho,$nuevoAlto);
				
				imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);
				
				imagejpeg($destino,$ruta);
			}
			$this->producto_model->updateProductoImg($idProducto,$ruta);
		}
		
		$data['ok'] = '1';
		echo json_encode($data);
	}
	
	public function productodestacado()
	{
		$idProducto	= trim($this->input->post("idProducto",true));
		$value		= trim($this->input->post("value",true));
		$data 		= array();
		
		$this->producto_model->updateProductoDestacado($idProducto,$value);
		
		$data['title'] = "PRODUCTO DESTACADO";
		$data['text'] = $value == '1' ? "EL PRODUCTO ESTÁ DESTACADO" :  "EL PRODUCTO YA NO ESTÁ DESTACADO";		
		$data['ok'] = '1' ;
		
		echo json_encode($data);		
	}
	
	public function productooferta()
	{
		$idProducto	= trim($this->input->post("idProducto",true));
		$value		= trim($this->input->post("value",true));
		$data 		= array();
		
		$this->producto_model->updateProductoOferta($idProducto,$value);
		
		$data['title'] = "PRODUCTO OFERTA";
		$data['text'] = $value == '1' ? "EL PRODUCTO ESTÁ EN OFERTA" :  "EL PRODUCTO YA NO ESTÁ EN OFERTA";		
		$data['ok'] = '1' ;
		
		echo json_encode($data);		
	}
	
	public function productohidden()
	{
		$idProducto	= trim($this->input->post("idProducto",true));
		$value		= trim($this->input->post("value",true));
		$data 		= array();
		
		$this->producto_model->updateProductoShow($idProducto,$value);
		
		$data['title'] = "PRODUCTO OCULTO";
		$data['text'] = $value == '0' ?"EL PRODUCTO YA NO ESTÁ ACTIVO" : "EL PRODUCTO ESTÁ ACTIVO" ;	
		$data['ok'] = '1' ;
		
		echo json_encode($data);		
	}

/*=============================================
IMAGENES GALERÍA PRODUCTO
=============================================*/
	
	
	public function productogetgaleria()
	{
		$idProducto	= trim($this->input->post("idProducto",true));
		$data		= array();
		
		$data['imagenes'] = $this->producto_foto_model->getProductoFotoActive($idProducto);
		echo json_encode($data);
	}
	public function productogaleria()
	{
		$data		= array();
		$idEmpresa	= trim($this->input->post("idGaleriaEmpresa",true));
		$idProducto	= trim($this->input->post("idGaleriaProducto",true));
		
		$this->producto_foto_model->updateProductoFotoEstado($idProducto,FALSE);
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
				
				$directorio	= "upload/empresas/".$idEmpresa."/destacados/".$idProducto;		
				//CREAR DIRECTORIO PARA GUARDAR FOTO
				if (!file_exists($directorio)) {
					mkdir($directorio, 0777, true);
				}
				$directorio = $directorio;
				$aleatorio	= generaRandom();
				$nmbFile 	= $directorio."/dest_".$aleatorio;

				if( $imgType == "image/jpeg" ){					
					$ruta		= $nmbFile.".jpg";

					$origen		= imagecreatefromjpeg($imgTemp);
					$destino	= imagecreatetruecolor($nuevoAncho,$nuevoAlto);

					imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);

					imagejpeg($destino,$ruta);
				}

				if( $imgType == "image/png" ){
					$ruta		= $nmbFile.".png";

					$origen		= imagecreatefrompng($imgTemp);
					$destino	= imagecreatetruecolor($nuevoAncho,$nuevoAlto);

					imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoAlto,$ancho,$alto);

					imagejpeg($destino,$ruta);
				}
				$this->producto_foto_model->insertProductoFoto($idProducto,$ruta);
			}
		}

		$producto = $this->producto_model->getProductoRow($idProducto);
		$success = 'GALERÍA DE IMÁGENES PARA EL PRODUCTO '.$producto->PRODUCTO_NOMBRE.', INGRESADAS EXITOSAMENTE.';
		$this->session->set_flashdata('exito',$success);
		redirect(base_url().'productos');
	}
	
	public function deletegaleriaimg()
	{
		$idImg	= trim($this->input->post("idimg",true));
		$this->producto_foto_model->updateProductoFotoEstadoImg($idImg,FALSE);
		
		$data	= array();		
		$data['idImg'] = $idImg;
		
		echo json_encode($data);
	}
	
/*=============================================
VALOR VARIABLE
=============================================*/	

	public function insertvavar()
	{
		$data = array();
		$idProducto				= trim($this->input->post("idProducto",true));
		$txtProductoDescVar		= trim($this->input->post("txtProductoDescVar",true));
		$txtProductoValorVar	= trim($this->input->post("txtProductoValorVar",true));
		$txtProductoStockVar	= trim($this->input->post("txtProductoStockVar",true)) != '' ? trim($this->input->post("txtProductoStockVar",true)) : NULL ;
		
		$counter = $this->producto_variable_model->insertProductoVariableCount($txtProductoDescVar,$idProducto);
		
		if( $counter == 0 ){
				$this->producto_variable_model->insertProductoVariable($txtProductoDescVar, $txtProductoValorVar,$txtProductoStockVar, $idProducto, FALSE);
		}
		
		$data['ok'] = $counter > 0 ? '2' : '1' ;
		echo json_encode($data);		
	}
	
	public function getvavar()
	{
		$idVaVar	= trim($this->input->post("idVaVar",true));
		$data 		= array();

		$data['vavar'] = $this->producto_variable_model->getProductoVariableRow($idVaVar);
		
		echo json_encode($data);		
	}
	
	public function editvavar()
	{
		$idProducto				= trim($this->input->post("idProducto",true));
		$idVaVar				= trim($this->input->post("idVaVar",true));
		$txtProductoDescVar		= trim($this->input->post("txtProductoDescVar",true));
		$txtProductoValorVar	= trim($this->input->post("txtProductoValorVar",true));
		$txtProductoStockVar	= trim($this->input->post("txtProductoStockVar",true)) != '' ? trim($this->input->post("txtProductoStockVar",true)) : NULL ;
		$data 		= array();		
		
		$counter = $this->producto_variable_model->updateProductoVariableCount($idVaVar,$txtProductoDescVar,$idProducto);
		if( $counter == 0 ){
			$this->producto_variable_model->updateProductoVariable($idVaVar, $txtProductoDescVar, $txtProductoValorVar, $txtProductoStockVar);
		}
		
		$data['ok'] = $counter == 0 ? '1' : '2' ;
		echo json_encode($data);		
	}
	
	public function vavarhidden()
	{
		$idVaVar	= trim($this->input->post("idVaVar",true));
		$value		= trim($this->input->post("value",true));
		$data 		= array();
		
		$this->producto_variable_model->updateProductoVariableShow($idVaVar,$value);
		
		$data['title'] = "VALOR VARIABLE";
		$data['text'] = $value == '1' ? "EL VALOR VARIABLE ESTÁ ACTIVO" :  "EL VALOR VARIABLE ESTÁ DESACTIVADO";		
		$data['ok'] = '1' ;
		
		echo json_encode($data);		
	}

/*=============================================
DELETE
=============================================*/
	
	public function itemdelete()
	{
		$idItem	= trim($this->input->post("idItem",true));
		$data	= array();
		
		$this->tipo_producto_model->updateTipoProductoDelete($idItem);
		
		$data['title'] = "ITEM";
		$data['text'] = "EL ITEM HA SIDO ELIMINADO" ;		
		$data['ok'] = '1' ;
		
		echo json_encode($data);		
	}
	
	public function productodelete()
	{
		$idProducto	= trim($this->input->post("idProducto",true));
		$data	= array();
		
		$this->producto_model->updateProductoDelete($idProducto);
		
		$data['title'] = "PRODUCTO";
		$data['text'] = "EL PRODUCTO HA SIDO ELIMINADO" ;		
		$data['ok'] = '1' ;
		
		echo json_encode($data);		
	}
	
	public function vavardelete()
	{
		$idVaVar	= trim($this->input->post("idVaVar",true));
		$data	= array();
		
		$this->producto_variable_model->updateProductoVariableDelete($idVaVar);
		
		$data['title'] = "VALOR VARIBLE";
		$data['text'] = "EL VALOR VARIBLE HA SIDO ELIMINADO" ;		
		$data['ok'] = '1' ;
		
		echo json_encode($data);		
	}
	
}
