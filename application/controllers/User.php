<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
	}


	public function index()
	{
		$data['judul'] = 'Profile';

		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar');
		$this->load->view('user/user', $data);
	}

	public function login()
	{
		$data = $this->input;
		$modelData = $this->User_model->getUser($data->post('email'));
		if ($data->post('password') == $modelData['password']) {
			$_SESSION['nama_lengkap'] = $modelData['nama_lengkap'];
			$_SESSION['email'] = $modelData['email'];
			$_SESSION['no_hp'] = $modelData['no_hp'];
			$_SESSION['role'] = $modelData['role'];
			return redirect(base_url('/'));
		} else {
			return redirect(base_url('/login.php'));
		}
	}

	public function logout()
	{
		$_SESSION = [];
		session_unset();
		session_destroy();
		header("Access-Control-Allow-Headers: *");
		$url = base_url('/login.php');
		echo $url;
		echo "<script type='text/javascript'>window.top.location='$url';</script>";
		exit;
	}
}
