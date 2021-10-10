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

	public function getUserById($id)
    {
        $query = "SELECT * FROM user WHERE id_user = '$id'";
		$data = $this->db->query($query)->result_array();
		if (count($data) > 0){
			$data = $data[0];
		} else {
			$data = [];
		}
        return $data;
    }

	public function getAllUser()
	{
		$query = "SELECT * FROM user";
		$data = $this->db->query($query)->result_array();
		return $data;
	}


	public function tambahUser()
	{
		$data = [
			"nama_lengkap" => $this->input->post('nama_lengkap',true), 
			"email" => $this->input->post('email',true), 
			"no_hp" => $this->input->post('no_hp',true), 
			"password" => $this->input->post('password',true), 
			"role" => $this->input->post('role',true)
        ];
        $this->db->insert('user', $data);
	}

	public function editUser($id)
    {
        $data = [
			"nama_lengkap" => $this->input->post('nama_lengkap',true), 
			"email" => $this->input->post('email',true), 
			"no_hp" => $this->input->post('no_hp',true), 
			"password" => $this->input->post('password',true), 
			"role" => $this->input->post('role',true) ?? $_SESSION['role']
        ];

        $this->db->where('id_user', $id);
        $this->db->update('user', $data);
    }
}
