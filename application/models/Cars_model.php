<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cars_model extends CI_Model
{
	function __construct()
  {
      parent::__construct();
  }

  function get_car_list($from, $end, $author_id, $status)
  {
    $where = '';
    $where .= ($author_id)?' and car.authorid = '.$author_id:'';
    $where .= ($status > -1 && $status < 5)?' and car.status = '.$status:(($status == 5)?' and car.status = 0':'');

    $query = 'SELECT car.id, car.reject_reason, car.vip, car.vip_type, car.premium, car.premium_type, car.status, car.price, car.agreement, car.currency, mark.mark, model.model, cp.name as "image", u.first_name as "user" FROM carad as car
              LEFT JOIN (SELECT cp1.caradid, cp1.name FROM carphoto as cp1
                         LEFT JOIN (SELECT caradid, min(location) as location FROM carphoto WHERE active = 1 and deleted = 0 GROUP BY caradid) as cp2 on cp2.caradid = cp1.caradid
                         WHERE cp1.location = cp2.location and cp1.deleted = 0) as cp on cp.caradid = car.id
              LEFT JOIN (SELECT id, first_name FROM user) as u on u.id = car.authorid
              LEFT JOIN (SELECT id, mark FROM carmark) as mark on mark.id = car.mark
              LEFT JOIN (SELECT id, model FROM carmodel) as model on model.id = car.model
              WHERE 1'.$where.'
							GROUP BY car.id
							ORDER BY car.createdate desc
              LIMIT '.$from.', '.$end;

    return $this->db->query($query)->result();
  }

  function get_car_list_row($author_id, $status)
  {
    $where = '';
    $where .= ($author_id)?' and car.authorid = '.$author_id:'';
    $where .= ($status > -1)?' and car.status = '.$status:'';

    $query = 'SELECT count(*) as "count" FROM carad as car
              WHERE 1'.$where;

    return $this->db->query($query)->row();
  }

  function get_mail_by_carad_id($id)
  {
    $query = 'SELECT mark.mark, model.model, car.year, car.mileage, u.email FROM carad as car
							LEFT JOIN (SELECT id, mark FROM carmark) as mark on mark.id = car.mark
							LEFT JOIN (SELECT id, model FROM carmodel) as model on model.id = car.model
              LEFT JOIN (SELECT id, email FROM user) as u on u.id = car.authorid
              WHERE car.id = '.$id;

    return $this->db->query($query)->row();
  }

	function get_car_data($id)
	{
		$query = 'SELECT car.*, u.first_name, u.mobile FROM carad as car
							LEFT JOIN (SELECT id, first_name, mobile FROM user) as u on u.id = car.authorid
							WHERE car.id = '.$id;

		return $this->db->query($query)->row();
	}

	function get_car_status($id)
	{
		$query = 'SELECT vip, vip_type, premium, premium_type, status FROM carad WHERE id = '.$id;
		return $this->db->query($query)->row();
	}

	function get_mark_list($from, $count)
	{
		$query = 'SELECT * FROM carmark
							LIMIT '.$from.', '.$count;

		return $this->db->query($query)->result();
	}

	function get_mark_list_row()
	{
		$query = 'SELECT count(*) as "count" FROM carmark';
		return $this->db->query($query)->row();
	}

	function get_model_list($from, $count)
	{
		$query = 'SELECT cm.*, m.mark FROM carmodel as cm
							LEFT JOIN (SELECT id, mark FROM carmark) as m on m.id = cm.markid
							ORDER BY m.mark, cm.model asc
							LIMIT '.$from.', '.$count;

		return $this->db->query($query)->result();
	}

	function get_model_list_row()
	{
		$query = 'SELECT count(*) as "count" FROM carmodel';
		return $this->db->query($query)->row();
	}

	function get_cities_list($from, $count)
	{
		$query = 'SELECT * FROM elancities
							ORDER BY tarix desc
							LIMIT '.$from.', '.$count;

		return $this->db->query($query)->result();
	}

	function get_cities_list_row()
	{
		$query = 'SELECT count(*) as "count" FROM elancities';
		return $this->db->query($query)->row();
	}

	function get_carbodies_list($from, $count)
	{
		$query = 'SELECT * FROM carbody
							ORDER BY createdate desc
							LIMIT '.$from.', '.$count;

		return $this->db->query($query)->result();
	}

	function get_carbodies_list_row()
	{
		$query = 'SELECT count(*) as "count" FROM carbody';
		return $this->db->query($query)->row();
	}

	function get_engines_list($from, $count)
	{
		$query = 'SELECT * FROM carengine
							ORDER BY cast(engine as decimal(4,2)) desc
							LIMIT '.$from.', '.$count;

		return $this->db->query($query)->result();
	}

	function get_engines()
	{
		$query = 'SELECT id, engine FROM carengine
							WHERE active = 1
							ORDER BY cast(engine as decimal(4,2)) asc';

		return $this->db->query($query)->result();
	}

	function get_engines_list_row()
	{
		$query = 'SELECT count(*) as "count" FROM carengine';
		return $this->db->query($query)->row();
	}

	function get_color_list($from, $count)
	{
		$query = 'SELECT * FROM carcolor
							ORDER BY createdate desc
							LIMIT '.$from.', '.$count;

		return $this->db->query($query)->result();
	}

	function get_color_list_row()
	{
		$query = 'SELECT count(*) as "count" FROM carcolor';
		return $this->db->query($query)->row();
	}

	function get_interior_color_list($from, $count)
	{
		$query = 'SELECT * FROM carinteriorcolor
							ORDER BY createdate desc
							LIMIT '.$from.', '.$count;

		return $this->db->query($query)->result();
	}

	function get_interior_color_list_row()
	{
		$query = 'SELECT count(*) as "count" FROM carinteriorcolor';
		return $this->db->query($query)->row();
	}

	function get_car_unlimited($id)
	{
		$query = 'SELECT u.unlimited FROM carad as c
							LEFT JOIN (SELECT id, unlimited FROM user) as u on u.id = c.authorid
							WHERE c.id = '.$id;

		return $this->db->query($query)->row();
	}

}
