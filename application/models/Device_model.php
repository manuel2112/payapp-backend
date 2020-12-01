<?php
	
class device_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	
	public function insertDevice($uuid, $model)
    {
		$data = array(
						'DEVICE_UUID'	=> $uuid,
						'DEVICE_MODEL'	=> $model
					);
		$this->db->insert('device', $data);
		return $this->db->insert_id();
    }
    
    public function getDeviceRow( $uuid )
    {
        $where = array(
						"DEVICE_UUID"	=> $uuid
					   );
        $query = $this->db
                        ->select("*")
                        ->from("device")
                        ->where($where)
                        ->get();
        return $query->row();
    }

    public function getDeviceTest()
    {
        $where = array(
						"DEVICE_TEST"	=> TRUE
					   );
        $query = $this->db
                        ->select("*")
                        ->from("device")
                        ->where($where)
                        ->get();
        return $query->result();       
    }
	
} 