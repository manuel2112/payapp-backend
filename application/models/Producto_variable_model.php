<?php
	
class producto_variable_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

	public function insertProductoVariable($txtAddProductoDescVar, $txtAddProductoValorVar,$txtAddProductoStock, $idProducto, $base)
    {
		$data = array(
						'PROVAR_DESC'	    => $txtAddProductoDescVar,
						'PROVAR_VALOR'	    => $txtAddProductoValorVar,
						'PROVAR_STOCK'	    => $txtAddProductoStock,
						'PRODUCTO_ID'	    => $idProducto,
						'PROVAR_BASE'	    => $base
					);
		$this->db->insert('producto_variable', $data);
    }

	public function getProductoVariable($idProducto)
	{
		  $where = array(
						  "PRODUCTO_ID" => $idProducto,
						  "PROVAR_FLAG" => true
						);
		  $query = $this->db
						  ->select("*")
						  ->from("producto_variable")
						  ->where($where)
						  ->order_by("PROVAR_ORDEN ASC")
						  ->get();
		  return $query->result();  
	}

	public function getProductoVariableRow($idVaVar)
	{
		$where = array(
				"PROVAR_ID" => $idVaVar
			);
		$query = $this->db
						->select("*")
						->from("producto_variable")
						->where($where)
						->get();
		return $query->row();
	}
	
    public function updateProductoVariableOrder($posicion,$idVaVar)
    {
      $array = array(
              	'PROVAR_ORDEN' => $posicion
              );
      $this->db->where('PROVAR_ID', $idVaVar);
      $this->db->update('producto_variable', $array);
    }

	public function insertProductoVariableCount($txtProductoDescVar,$idProducto)
	{
		  $where = array(
							'PROVAR_DESC'	=> $txtProductoDescVar,
							'PRODUCTO_ID'	=> $idProducto
						);
		  $query = $this->db
						  ->select("*")
						  ->from("producto_variable")
						  ->where($where)
						  ->get();
		  return $query->num_rows();
	}

	public function updateProductoVariableCount($idVaVar,$txtProductoDescVar,$idProducto)
	{
		  $where = array(
				'PROVAR_ID !='	=> $idVaVar,
				'PROVAR_DESC'	=> $txtProductoDescVar,
				'PRODUCTO_ID'	=> $idProducto
						);
		  $query = $this->db
						  ->select("*")
						  ->from("producto_variable")
						  ->where($where)
						  ->get();
		  return $query->num_rows();
	}

	public function updateProductoVariable($idVaVar, $txtProductoDescVar, $txtProductoValorVar, $txtProductoStockVar)
    {
		$array = array(
						'PROVAR_DESC' => $txtProductoDescVar,
						'PROVAR_VALOR' => $txtProductoValorVar,
						'PROVAR_STOCK' => $txtProductoStockVar
					   );
		$this->db->where('PROVAR_ID', $idVaVar);
		$this->db->update('producto_variable', $array);
    }

	public function updateProductoVariableShow($idVaVar,$value)
	{
		  $array = array(
						'PROVAR_SHOW' => $value
					);
		  $this->db->where('PROVAR_ID', $idVaVar);
		  $this->db->update('producto_variable', $array);
	}

	public function updateProductoVariableDelete($idVaVar)
	{
		  $array = array(
						'PROVAR_FLAG' => false
					);
		  $this->db->where('PROVAR_ID', $idVaVar);
		  $this->db->update('producto_variable', $array);
	}

	public function updateProductoVariableDeletePorProducto($idProducto)
	{
		  $array = array(
						'PROVAR_FLAG' => false
					);
		  $this->db->where('PRODUCTO_ID', $idProducto);
		  $this->db->update('producto_variable', $array);
	}
	
	/********************************/
	/***********API******************/
	/********************************/
	

	public function getPVBaseAPIRow($idProducto)
	{
		$where = array(
				"PRODUCTO_ID" => $idProducto,
				"PROVAR_BASE" => TRUE
			);
		$query = $this->db
						->select("*")
						->from("producto_variable")
						->where($where)
						->limit(1)
						->get();
		return $query->row();
	}
	public function getPVBaseAPIResult($idProducto)
	{
		$where = array(
				"PRODUCTO_ID" => $idProducto,
				"PROVAR_BASE" => TRUE
			);
		$query = $this->db
						->select("*")
						->from("producto_variable")
						->where($where)
						->limit(1)
						->get();
		return $query->result();
	}

	public function getProductoVariableAPI($idProducto)
	{
		  $where = array(
						  "PRODUCTO_ID" => $idProducto,
						  "PROVAR_SHOW" => true,
						  "PROVAR_FLAG" => true
						);
		  $query = $this->db
						  ->select("*")
						  ->from("producto_variable")
						  ->where($where)
						  ->order_by("PROVAR_ORDEN ASC")
						  ->get();
		  return $query->result();  
	}
	
}