<?php
	
class push_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
	public function insertPush($pushTitle, $pushTexto, $idProducto, $idEmpresa, $date)
    {
		$data = array(
						'PUSH_TITLE'	=> $pushTitle,
						'PUSH_TEXTO'	=> $pushTexto,
						'PRODUCTO_ID'	=> $idProducto,
						'EMPRESA_ID'	=> $idEmpresa,
						'PUSH_DATE'	    => $date
					);
		$this->db->insert('push', $data);
		return $this->db->insert_id();
    }
    
    public function getPush( $idEmpresa )
    {
        $where = array(
						"EMPRESA_ID"	=> $idEmpresa
					   );
        $query = $this->db
                        ->select("*")
                        ->from("push")
                        ->where($where)
                        ->order_by("PUSH_ID DESC")
						->limit(30)
                        ->get();
        return $query->result();       
    }

    public function getPushRow( $idPush )
    {
        $where = array(
						"PUSH_ID"	=> $idPush
					   );
        $query = $this->db
                        ->select("*")
                        ->from("push")
                        ->where($where)
                        ->get();
        return $query->row();       
    }

	public function updatePushPorCampo( $idPush, $campo, $valor )
	{
		  $array = array(
                        $campo => $valor
					);
		  $this->db->where('PUSH_ID', $idPush);
		  $this->db->update('push', $array);
	}
    
    public function getPushEnCurso()
    {
        $where = array(
						"PUSH_FLAG"	=> true
					   );
        $query = $this->db
                        ->select("*")
                        ->from("push")
                        ->where($where)
                        ->order_by("PUSH_ID ASC")
						->limit(1)
                        ->get();
        return $query->row();
    }

	/********************************/
	/***********PUSH/TOKEN***********/
	/********************************/
	
	public function insertPushToken( $idPush, $idToken, $date )
    {
		$data = array(
						'PUSH_ID'	=> $idPush,
						'TOKEN_ID'	=> $idToken,
						'PUSH_TOKEN_DATE' => $date
					);
		$this->db->insert('push_token', $data);
    }
    
    public function countPushSend( $idPush )
    {
        $where = array(
						"PUSH_ID" => $idPush
					   );
        $query = $this->db
                        ->select("COUNT(*) AS COUNTER")
                        ->from("push_token")
                        ->where($where)
                        ->get();
        return $query->row();       
    }
	
	public function getPushTokenRow( $idPush, $idToken )
	{
		  $where = array(
						  "PUSH_ID" => $idPush,
						  "TOKEN_ID" => $idToken
						);
		  $query = $this->db
						  ->select("*")
						  ->from("push_token")
						  ->where($where)
						  ->get();
		  return $query->row();  
	}
	
	/********************************/
	/***********API******************/
	/********************************/	

	public function getPushPorEmpresaAPI( $idEmpresa )
	{
		  $where = array(
						  "EMPRESA_ID" => $idEmpresa
						);
		  $query = $this->db
						  ->select("*")
						  ->from("push")
						  ->where($where)
						  ->order_by("PUSH_ID DESC")
						  ->limit(15)
						  ->get();
		  return $query->result();  
	}
	
} 