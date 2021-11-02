<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Auth_model extends CI_Model
{
	function __construct()
  {
      parent::__construct();
  }

	function login_check($email, $password)
	{
		$query = "SELECT * FROM user
							WHERE email='".$email."' AND password='".$password."'";

		return $this->db->query($query)->row();
	}
}
