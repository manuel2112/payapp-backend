<?php
	
class producto_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

	public function insertProducto($idTipoProducto,$txtAddProducto,$txtAddProductoDesc,$chkProductoOferta,$chkProductoDest)
    {
		$data = array(
						'PRODUCTO_NOMBRE'	    => $txtAddProducto,
						'PRODUCTO_OFERTA'	    => $chkProductoOferta,
						'PRODUCTO_DESTACADO'    => $chkProductoDest,
						'PRODUCTO_DESC'	        => $txtAddProductoDesc,
						'TIPO_PRODUCTO_ID'	    => $idTipoProducto
					);
		$this->db->insert('producto', $data);
		return $this->db->insert_id();
    }

	public function getProductoPorTipo($idTipoProducto)
	{
		  $where = array(
						  "TIPO_PRODUCTO_ID" => $idTipoProducto,
						  "PRODUCTO_FLAG" => true
						);
		  $query = $this->db
						  ->select("*")
						  ->from("producto")
						  ->where($where)
						  ->order_by("PRODUCTO_ORDEN ASC")
						  ->get();
		  return $query->result();  
	}

	public function getProductoPorTipoAll($idTipoProducto)
	{
		  $where = array(
						  "TIPO_PRODUCTO_ID" => $idTipoProducto
						);
		  $query = $this->db
						  ->select("*")
						  ->from("producto")
						  ->where($where)
						  ->order_by("PRODUCTO_ORDEN ASC")
						  ->get();
		  return $query->result();  
	}

	public function getProductoRow($idProducto)
	{
		$where = array(
				"PRODUCTO_ID" => $idProducto
			);
		$query = $this->db
						->select("*")
						->from("producto")
						->where($where)
						->get();
		return $query->row();
	}

	public function editProductoCount($idProducto,$txtProducto,$idItem)
	{
		  $where = array(
				'PRODUCTO_ID !='	=> $idProducto,
				'PRODUCTO_NOMBRE'	=> $txtProducto,
				'TIPO_PRODUCTO_ID'	=> $idItem
						);
		  $query = $this->db
						  ->select("*")
						  ->from("producto")
						  ->where($where)
						  ->get();
		  return $query->num_rows();
	}

	public function updateProducto($idProducto,$txtProducto,$chkProductoOferta,$chkProductoDest,$txtProductoDesc)
    {
		$array = array(
						'PRODUCTO_NOMBRE' => $txtProducto,
						'PRODUCTO_OFERTA' => $chkProductoOferta,
						'PRODUCTO_DESTACADO' => $chkProductoDest,
						'PRODUCTO_DESC' => $txtProductoDesc,
					   );
		$this->db->where('PRODUCTO_ID', $idProducto);
		$this->db->update('producto', $array);
    }
	
    public function updateProductoOrder($posicion,$idProducto)
    {
      $array = array(
              	'PRODUCTO_ORDEN' => $posicion
              );
      $this->db->where('PRODUCTO_ID', $idProducto);
      $this->db->update('producto', $array);
    }

	public function updateProductoShow($idProducto,$value)
	{
		  $array = array(
						'PRODUCTO_SHOW' => $value
					);
		  $this->db->where('PRODUCTO_ID', $idProducto);
		  $this->db->update('producto', $array);
	}

	public function updateProductoDestacado($idProducto,$value)
	{
		  $array = array(
						'PRODUCTO_DESTACADO' => $value
					);
		  $this->db->where('PRODUCTO_ID', $idProducto);
		  $this->db->update('producto', $array);
	}

	public function updateProductoOferta($idProducto,$value)
	{
		  $array = array(
						'PRODUCTO_OFERTA' => $value
					);
		  $this->db->where('PRODUCTO_ID', $idProducto);
		  $this->db->update('producto', $array);
	}

	public function updateProductoDelete($idProducto)
	{
		  $array = array(
						'PRODUCTO_FLAG' => false
					);
		  $this->db->where('PRODUCTO_ID', $idProducto);
		  $this->db->update('producto', $array);
	}

	public function updateProductoDeletePorItem($idItem)
	{
		  $array = array(
						'PRODUCTO_FLAG' => false
					);
		  $this->db->where('TIPO_PRODUCTO_ID', $idItem);
		  $this->db->update('producto', $array);
	}

	public function updateProductoImg($idProducto,$ruta)
	{
		  $array = array(
						'PRODUCTO_IMG' => $ruta
					);
		  $this->db->where('PRODUCTO_ID', $idProducto);
		  $this->db->update('producto', $array);
	}

	public function getProductoPorEmpresa($idEmpresa)
	{
		  $where = array(
						  "producto.PRODUCTO_SHOW" 				=> true,
						  "producto.PRODUCTO_FLAG" 				=> true,
						  "tipo_producto.EMPRESA_ID" 			=> $idEmpresa,
						  "tipo_producto.TIPO_PRODUCTO_SHOW" 	=> true,
						  "tipo_producto.TIPO_PRODUCTO_FLAG" 	=> true,
						);
		  $query = $this->db
						  ->select("*")
						  ->from("producto")
						  ->join('tipo_producto', 'tipo_producto.TIPO_PRODUCTO_ID = producto.TIPO_PRODUCTO_ID')
						  ->where($where)
						  ->order_by("producto.PRODUCTO_NOMBRE ASC")
						  ->get();
		  return $query->result();  
	}
	
	/********************************/
	/***********API******************/
	/********************************/

	public function getProductoPorTipoAPI($idTipoProducto)
	{
		  $where = array(
						  "TIPO_PRODUCTO_ID" => $idTipoProducto,
						  "PRODUCTO_SHOW" => true,
						  "PRODUCTO_FLAG" => true
						);
		  $query = $this->db
						  ->select("*")
						  ->from("producto")
						  ->where($where)
						  ->order_by("PRODUCTO_ORDEN ASC")
						  ->get();
		  return $query->result();  
	}

	  public function getOfertaAPI($idEmpresa)
	  {
			$where = array(
							"tipo_producto.EMPRESA_ID" => $idEmpresa,
							"tipo_producto.TIPO_PRODUCTO_FLAG" => true,
							"tipo_producto.TIPO_PRODUCTO_SHOW" => true,
							"producto.PRODUCTO_FLAG" => true,
							"producto.PRODUCTO_OFERTA" => true,
							"producto.PRODUCTO_SHOW" => true
						  );
			$query = $this->db
							->select("*")
							->from("tipo_producto")
							->join('producto', 'producto.TIPO_PRODUCTO_ID = tipo_producto.TIPO_PRODUCTO_ID')
							->where($where)
							->order_by("tipo_producto.TIPO_PRODUCTO_ORDEN ASC,producto.PRODUCTO_ORDEN ASC")
							->get();
			return $query->result();
	  }

	  public function getDestacadoAPI($idEmpresa)
	  {
			$where = array(
							"tipo_producto.EMPRESA_ID" => $idEmpresa,
							"tipo_producto.TIPO_PRODUCTO_FLAG" => true,
							"tipo_producto.TIPO_PRODUCTO_SHOW" => true,
							"producto.PRODUCTO_FLAG" => true,
							"producto.PRODUCTO_DESTACADO" => true,
							"producto.PRODUCTO_SHOW" => true
						  );
			$query = $this->db
							->select("*")
							->from("tipo_producto")
							->join('producto', 'producto.TIPO_PRODUCTO_ID = tipo_producto.TIPO_PRODUCTO_ID')
							->where($where)
							->order_by("tipo_producto.TIPO_PRODUCTO_ORDEN ASC,producto.PRODUCTO_ORDEN ASC")
							->get();
			return $query->result();
	  }
} 