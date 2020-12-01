<?php
	
class color_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
  public function getColor()
    {
        $where = array(
						"COLOR_FLAG" => 1
					  );
        $query = $this->db
                        ->select("*")
                        ->from("colores")
                        ->where($where)
                      	->order_by("COLOR_ID ASC")
                        ->get();
        return $query->result();       
    }
	
	public function insertColor($nmbColor, $hexaColor)
    {
		$data = array(
						'COLOR_NOMBRE'	=> $nmbColor,
						'COLOR_HEX'	=> $hexaColor
					);
		$this->db->insert('colores', $data);
    }

    public function getCampoExisteColor($campo,$varible)
    {
        $where = array(
                        $campo => $varible
					  );
        $query = $this->db
                        ->select("*")
                        ->from("colores")
                        ->where($where)
                        ->get();
        return $query->result();       
    }

    public function updateCampoExisteColor($idColor,$campo,$varible)
    {
        $where = array(
                        'COLOR_ID !=' => $idColor,
                        'COLOR_FLAG !=' => 0,
                        $campo => $varible
					  );
        $query = $this->db
                        ->select("*")
                        ->from("colores")
                        ->where($where)
                        ->get();
        return $query->result();       
    }
	
	public function updateColor($idColor,$nmbColor,$hexaColor)
    {
		$array = array(
						'COLOR_NOMBRE' => $nmbColor,
						'COLOR_HEX' => $hexaColor
					   );
		$this->db->where('COLOR_ID', $idColor);
		$this->db->update('colores', $array);
    }
	
	public function deleteColor($idColor)
    {
		$array = array(
						'COLOR_FLAG' => 0
					   );
		$this->db->where('COLOR_ID', $idColor);
		$this->db->update('colores', $array);
    }

  public function getColorRow($idColor)
    {
        $where = array(
                        'COLOR_ID' => $idColor
					  );
        $query = $this->db
                        ->select("*")
                        ->from("colores")
                        ->where($where)
                        ->get();
        return $query->row();       
    }
	
} 