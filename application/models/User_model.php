<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getUser($email)
    {
        $query = "SELECT * FROM user WHERE email = '$email'";
		$data = $this->db->query($query)->result_array();
		if (count($data) > 0){
			$data = $data[0];
		} else {
			$data = [];
		}
        return $data;
    }
}
