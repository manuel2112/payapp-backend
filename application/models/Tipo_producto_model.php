<?php
	
class tipo_producto_model extends CI_Model
{
  function __construct()
  {
    parent::__construct();
  }

  public function getTipoProductoPorEmpresa($idEmpresa)
  {
        $where = array(
                        "EMPRESA_ID" => $idEmpresa,
                        "TIPO_PRODUCTO_FLAG" => true
                      );
        $query = $this->db
                        ->select("*")
                        ->from("tipo_producto")
                        ->where($where)
                      	->order_by("TIPO_PRODUCTO_ORDEN ASC")
                        ->get();
        return $query->result();  
  }

  public function getTipoProductoPorEmpresaAPI($idEmpresa)
  {
        $where = array(
                        "EMPRESA_ID" => $idEmpresa,
                        "TIPO_PRODUCTO_SHOW" => true,
                        "TIPO_PRODUCTO_FLAG" => true
                      );
        $query = $this->db
                        ->select("*")
                        ->from("tipo_producto")
                        ->where($where)
                      	->order_by("TIPO_PRODUCTO_ORDEN ASC")
                        ->get();
        return $query->result();  
  }

  public function getTipoProductoPorEmpresaOferta($idEmpresa)
  {
        $where = array(
                        "EMPRESA_ID" => $idEmpresa,
                        "tipo_producto.TIPO_PRODUCTO_FLAG" => true,
                        "producto.PRODUCTO_FLAG" => true,
                        "producto.PRODUCTO_OFERTA" => true
                      );
        $query = $this->db
                        ->select("*")
                        ->from("tipo_producto")
                        ->join('producto', 'producto.TIPO_PRODUCTO_ID = tipo_producto.TIPO_PRODUCTO_ID')
                        ->where($where)
                      	->order_by("producto.PRODUCTO_ID ASC")
                        ->get();
        return $query->result();
  }

  public function getTipoProductoPorEmpresaDestacado($idEmpresa)
  {
        $where = array(
                        "EMPRESA_ID" => $idEmpresa,
                        "tipo_producto.TIPO_PRODUCTO_FLAG" => true,
                        "producto.PRODUCTO_FLAG" => true,
                        "producto.PRODUCTO_DESTACADO" => true
                      );
        $query = $this->db
                        ->select("*")
                        ->from("tipo_producto")
                        ->join('producto', 'producto.TIPO_PRODUCTO_ID = tipo_producto.TIPO_PRODUCTO_ID')
                        ->where($where)
                      	->order_by("producto.PRODUCTO_ID ASC")
                        ->get();
        return $query->result();
  }
  
  public function getTipoProductoRow($idItem)
  {
      $where = array(
          "TIPO_PRODUCTO_ID" => $idItem
          );
      $query = $this->db
                      ->select("*")
                      ->from("tipo_producto")
                      ->where($where)
                      ->get();
      return $query->row();
  }

  public function getTipoProductoPorEmpresaCount($idEmpresa,$txtItem)
  {
        $where = array(
              'TIPO_PRODUCTO_NOMBRE'	=> $txtItem,
              'EMPRESA_ID'			    => $idEmpresa
					  );
        $query = $this->db
                        ->select("*")
                        ->from("tipo_producto")
                        ->where($where)
                        ->get();
        return $query->num_rows();
  }

  public function editTipoProductoPorEmpresaCount($idEmpresa,$txtItem,$idItem)
  {
        $where = array(
              'TIPO_PRODUCTO_ID !='   	=> $idItem,
              'TIPO_PRODUCTO_NOMBRE'	=> $txtItem,
              'EMPRESA_ID'            	=> $idEmpresa
					  );
        $query = $this->db
                        ->select("*")
                        ->from("tipo_producto")
                        ->where($where)
                        ->get();
        return $query->num_rows();
  }

	public function insertTipoProducto($idEmpresa,$txtItem)
  {
		$data = array(
						'TIPO_PRODUCTO_NOMBRE'	=> $txtItem,
						'EMPRESA_ID'			=> $idEmpresa
					);
		$this->db->insert('tipo_producto', $data);
  }
	
  public function updateTipoProductoOrder($posicion,$idTipo)
  {
      $array = array(
              'TIPO_PRODUCTO_ORDEN' => $posicion
              );
      $this->db->where('TIPO_PRODUCTO_ID', $idTipo);
      $this->db->update('tipo_producto', $array);
  }

  public function updateTipoProducto($idItem,$txtItem)
  {
		$array = array(
						'TIPO_PRODUCTO_NOMBRE' => $txtItem
					   );
		$this->db->where('TIPO_PRODUCTO_ID', $idItem);
		$this->db->update('tipo_producto', $array);
  }

  public function updateTipoProductoShow($idItem,$value)
  {
		$array = array(
                      'TIPO_PRODUCTO_SHOW' => $value
                  );
		$this->db->where('TIPO_PRODUCTO_ID', $idItem);
		$this->db->update('tipo_producto', $array);
  }

  public function updateTipoProductoDelete($idItem)
  {
		$array = array(
                      'TIPO_PRODUCTO_FLAG' => false
                  );
		$this->db->where('TIPO_PRODUCTO_ID', $idItem);
		$this->db->update('tipo_producto', $array);
  }

  public function getMenuPorEmpresa($idEmpresa)
  {
          $where = array(
              "EMPRESA_ID" => $idEmpresa
              );
          $query = $this->db
                          ->select("*")
                          ->from("tipo_producto")
                          ->join('producto', 'producto.TIPO_PRODUCTO_ID = tipo_producto.TIPO_PRODUCTO_ID')
                          ->join('producto_variable', 'producto_variable.PRODUCTO_ID = producto.PRODUCTO_ID')
                          ->where($where)
                          ->order_by("TIPO_PRODUCTO_ORDEN ASC")
                          ->get();
          return $query->result();  
  }

} 