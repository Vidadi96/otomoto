<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Rent_model extends CI_Model
{
	function __construct()
  {
      parent::__construct();
  }

	function select_result($table_name, $select)
  {
    $this->db->select($select);
    $this->db->from($table_name);
    return $this->db->get()->result();
  }

	function currentBalans($id){
		$query = "SELECT
								authorid,
								salon,
								SUM(CASE WHEN action in (3, 5) THEN amount END) as plus,
								SUM(CASE WHEN action in (12,13,14,15,16,17,18,19) THEN amount END) as minus,
								COALESCE(SUM(case when action in (4) and salon = 1 then amount END),0) as ads
							FROM car_orders_view
							WHERE authorid = ".(int)$id." and active = 1";

		return $this->db->query($query)->row();
	}

	function checkMonth($id){
		$query = "SELECT
								MAX(createdate) as createdate,
								DATE_ADD(createdate, INTERVAL 31 DAY) as nextdate
							FROM car_orders_view
							WHERE authorid = ".(int)$id." and active = 1 and amount >=50";

		return $this->db->query($query)->row();
	}

	function photoLocation($pincode)
	{
		$query = "SELECT MAX(location) as location FROM carphoto
							WHERE pincode = '".$pincode."' and active = 1";

		return $this->db->query($query)->row_array();
	}
}
