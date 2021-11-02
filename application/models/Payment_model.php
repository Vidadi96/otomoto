<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Payment_model extends CI_Model
{
	function __construct()
  {
      parent::__construct();
  }

  function increaseBalans($authorid, $amount, $currentDate){
		$this->db->query("insert into car_orders values(null, '".(int)$amount."','".(int)$authorid."','".$currentDate."','3','','1','".(int)$this->session->userdata('autosalon')."' )");
		return $id = $this->db->insert_id();
	}

  function currentBalans($id){
		return $this->db->query("select authorid,salon ,SUM(CASE WHEN action in (3, 5) THEN amount END) as plus, SUM(CASE WHEN action in (12,13,14,15,16,17,18,19) THEN amount END) as minus, COALESCE(SUM(case when action in (4) and salon = 1 then amount END),0) as ads FROM car_orders_view where authorid = ".(int)$id." and active = 1")->row();
	}

  function updateSalon($authorid){
		$this->db->query("update user set autosalon = 1 where id = ".(int)$authorid." ");
	}

	function checkAuthorBalans($id)
	{
		$query = "SELECT authorid, salon,
										 SUM(CASE WHEN action in (3,5) THEN amount END) as plus,
										 SUM(CASE WHEN action in (12,13,14,15,16,17,18,19) THEN amount END) as minus,
										 COALESCE(SUM(case when action in (4) and salon = 1 then amount END),0) as ads
							FROM car_orders_view
							WHERE authorid = ".$id." and active = 1";

		return $this->db->query($query)->result_array();
	}
}
