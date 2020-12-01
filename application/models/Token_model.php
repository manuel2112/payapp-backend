<?php
	
class token_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
	public function insertToken($token, $idEmpresa, $idDevice)
    {
		$data = array(
						'HASH_TOKEN' => $token,
						'EMPRESA_ID' => $idEmpresa,
						'DEVICE_ID'	 => $idDevice
					);
		$this->db->insert('token', $data);
    }
    
    public function getTokenRow( $token )
    {
        $where = array(
						"HASH_TOKEN" => $token
					   );
        $query = $this->db
                        ->select("*")
                        ->from("token")
                        ->where($where)
                        ->get();
        return $query->row();       
    }
    
    public function countTokenPorEmpresa( $idEmpresa )
    {
        $where = array(
						"EMPRESA_ID" => $idEmpresa,
						"FLAG_TOKEN" => true
					   );
        $query = $this->db
                        ->select("COUNT(*) AS COUNTER")
                        ->from("token")
                        ->where($where)
                        ->get();
        return $query->row();
    }
    
    public function getTokenSend( $idEmpresa )
    {
        $where = array(
						"EMPRESA_ID" => $idEmpresa,
						"FLAG_TOKEN" => true
					   );
        $query = $this->db
                        ->select("*")
                        ->from("token")
                        ->where($where)
                        ->order_by("TOKEN_ID DESC")
                        ->limit(20)
                        ->get();
        return $query->result();       
    }
    
    public function getTokenSendAll( $idEmpresa )
    {
        $where = array(
						"EMPRESA_ID" => $idEmpresa,
						"FLAG_TOKEN" => true
					   );
        $query = $this->db
                        ->select("*")
                        ->from("token")
                        ->where($where)
                        ->order_by("TOKEN_ID DESC")
                        ->get();
        return $query->result();       
    }

    public function getTokenTest( $idEmpresa, $idDevice )
    {
        $where = array(
						"EMPRESA_ID"    => $idEmpresa,
						"DEVICE_ID"     => $idDevice
					   );
        $query = $this->db
                        ->select("*")
                        ->from("token")
                        ->where($where)
                        ->order_by("TOKEN_ID DESC")
                        ->limit(1)
                        ->get();
        return $query->row();       
    }

	public function updateTokenPorCampo( $idToken, $campo, $valor )
	{
		  $array = array(
                        $campo => $valor
					);
		  $this->db->where('TOKEN_ID', $idToken);
		  $this->db->update('token', $array);
	}
	
} 