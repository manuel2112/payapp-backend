<?php
	
class producto_foto_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

  public function updateProductoFotoEstado($idProducto,$estado)  
  {
		$array = array(
						'IMAGEN_FLAG' => $estado
					   );
		$this->db->where('PRODUCTO_ID', $idProducto);
		$this->db->update('imagen', $array);
  } 

  public function updateProductoFotoEstadoImg($idImg,$estado)
  {
		$array = array(
						'IMAGEN_FLAG' => $estado
					   );
		$this->db->where('IMAGEN_ID', $idImg);
		$this->db->update('imagen', $array);
  } 
    
  public function insertProductoFoto($idProducto,$ruta)
  {
		$data = array(
						'PRODUCTO_ID'	=> $idProducto,
						'IMAGEN_RUTA'   => $ruta
					);
		$this->db->insert('imagen', $data);
  }    
	
  public function getProductoFotoActive($idProducto)
  {
        $where = array(
							"PRODUCTO_ID" => $idProducto,
							"IMAGEN_FLAG" => TRUE
						);
        $query = $this->db
                        ->select("*")
                        ->from("imagen")
                        ->where($where)
                      	->order_by("IMAGEN_ORDEN ASC")
                        ->get();
        return $query->result();    
  }
	
    public function updateProductoFotoOrder($posicion,$idImagen)
    {
        $array = array(
                            'IMAGEN_ORDEN' => $posicion
                        );
        $this->db->where('IMAGEN_ID', $idImagen);
        $this->db->update('imagen', $array);
    }
	
} 