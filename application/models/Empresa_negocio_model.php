<?php
	
class empresa_negocio_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    public function getEmpresaNegocioActive($idEmpresa)
    {
        $where = array(
						"empresa_tipo_negocio.EMPRESA_ID" => $idEmpresa,
						"empresa_tipo_negocio.EMPRESA_TIPO_NEGOCIO_FLAG" => TRUE,
						"tipo_negocio.TIPO_NEGOCIO_FLAG" => TRUE
						);
        $query = $this->db
                        ->select("*")
                        ->from("tipo_negocio")
					              ->join('empresa_tipo_negocio', 'empresa_tipo_negocio.TIPO_NEGOCIO_ID = tipo_negocio.TIPO_NEGOCIO_ID')
                        ->where($where)
                      	->order_by("tipo_negocio.TIPO_NEGOCIO_NOMBRE ASC")
                        ->get();
        return $query->result();  
    }
	
    public function getEmpresaNegocioRow($idTipo,$idEmpresa)
    {
        $where = array(
                          "TIPO_NEGOCIO_ID"           => $idTipo,
                          "EMPRESA_ID"                => $idEmpresa
                      );
        $query = $this->db
                        ->select("*")
                        ->from("empresa_tipo_negocio")
                        ->where($where)
                        ->get();
        return $query->row();
    }

	  public function insertEmpresaNegocio($idTipo, $idEmpresa, $obsTipo, $bool)
    {
      $data = array(
              'TIPO_NEGOCIO_ID'	          => $idTipo,
              'EMPRESA_ID' 		            => $idEmpresa,
              'EMPRESA_TIPO_NEGOCIO_OBS'  => $obsTipo,
              'EMPRESA_TIPO_NEGOCIO_FLAG' => $bool
            );
      $this->db->insert('empresa_tipo_negocio', $data);
    }

	  public function updateEmpresaNegocio($id, $obsTipo, $bool )
    {
      $array = array(
              'EMPRESA_TIPO_NEGOCIO_OBS'  => $obsTipo,
              'EMPRESA_TIPO_NEGOCIO_FLAG' => $bool
              );
      $this->db->where('EMPRESA_TIPO_NEGOCIO_ID', $id);
      $this->db->update('empresa_tipo_negocio', $array);
    }

/*=============================================
    MONTO MINIMO
=============================================*/	
	
    public function getEmpresaNegocioMontoRow($idEmpresa)
    {
        $where = array(
                          "EMPRESA_ID"  => $idEmpresa
                      );
        $query = $this->db
                        ->select("*")
                        ->from("monto_minimo")
                        ->where($where)
                        ->get();
        return $query->row();
    }
    
    public function getEmpresaNegocioMontoActiveRow($idEmpresa)
    {
        $where = array(
                          "EMPRESA_ID"  => $idEmpresa,
                          "MONTO_FLAG"  => true
                      );
        $query = $this->db
                        ->select("*")
                        ->from("monto_minimo")
                        ->where($where)
                        ->get();
        return $query->row();
    }

	  public function insertEmpresaNegocioMonto($idEmpresa, $txtMonto, $valorMonto)
    {
      $data = array(
              'EMPRESA_ID'  => $idEmpresa,
              'MONTO_OBS'   => $txtMonto,
              'MONTO_VALOR' => $valorMonto
            );
      $this->db->insert('monto_minimo', $data);
    }

	  public function updateEmpresaNegocioMonto($id, $obs, $valor, $bool )
    {
      $array = array(
                      'MONTO_OBS'  => $obs,
                      'MONTO_VALOR'  => $valor,
                      'MONTO_FLAG' => $bool
                    );
      $this->db->where('MONTO_ID ', $id);
      $this->db->update('monto_minimo', $array);
    }

    /*=============================================
        SECTOR
    =============================================*/	

	  public function insertSector($idEmpresa, $txtSector, $precioSector)
    {
      $data = array(
              'EMPRESA_ID'    => $idEmpresa,
              'SECTOR_OBS'    => $txtSector,
              'SECTOR_VALOR'  => $precioSector
            );
      $this->db->insert('sector', $data);
    }
	
    public function getSector($idEmpresa)
    {
        $where = array(
                          "EMPRESA_ID"   => $idEmpresa,
						  'SECTOR_FLAG'  => true
                      );
        $query = $this->db
                        ->select("*")
                        ->from("sector")
                        ->where($where)
                        ->get();
        return $query->result();
    }
	
    public function deleteSector($idSector)
    {
      $array = array(
                      'SECTOR_FLAG'  => false
                    );
      $this->db->where('SECTOR_ID ', $idSector);
      $this->db->update('sector', $array);
    }
	
} 