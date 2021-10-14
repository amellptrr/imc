<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barangio extends CI_Controller
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
    function __construct()
    {
        parent::__construct();
        $this->load->model('Barangio_model');
		$this->load->model('Barang_Model');
		$this->load->model('Jenis_Model');
		$this->load->model('Satuan_Model');
    }

    public function index()
    {
        $data['judul'] = 'Data Barang';
		$currentUrl = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		$queryParams = null;
		if (isset($_GET['type'])){
			$queryParams = $_GET['type'];
			$data['judul'] = $data['judul'] . " " . ucfirst($_GET['type']);
		} else {
			$queryParams = "?type=masuk";
			return redirect(base_url('/barangio') . $queryParams);
		}

        $data['barang'] = $this->Barangio_model->getDataBarang($queryParams);

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('data/barangio', $data);
    }

	public function tambah_data()
    {
        $data['judul'] = 'Tambah Data Barang';
		$data['barang'] = $this->Barang_Model->getDataBarang();
		$this->form_validation->set_rules('id_barang','id_barang','required');
		$this->form_validation->set_rules('stok','stok','required');
		$this->form_validation->set_rules('tipe','tipe','required');
		if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar');
            $this->load->view('data/tambah_barangio', $data);
        } else {
            $this->Barangio_model->tambahData();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect(base_url('barangio'));
        }
    }

	public function edit_data($id)
	{
		$data['judul'] = 'Edit Data Barang';
		$data['barangio'] = $this->Barangio_model->getSingleData($id);
		$data['barang'] = $this->Barang_Model->getDataBarang();
		$this->form_validation->set_rules('id_barang','id_barang','required');
		$this->form_validation->set_rules('stok','stok','required');
		$this->form_validation->set_rules('tipe','tipe','required');
		if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar');
            $this->load->view('data/edit_barangio', $data);
        } else {
            $this->Barangio_model->editdata();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect(base_url('barangio'));
        }
	}

	public function hapus_data($id)
    {
        $this->Barangio_model->hapusData($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect(base_url('barangio'));
    }

	public function print(){
		$minDate = (isset($_GET['min']) ? $_GET['min'] : "");
		$maxDate = (isset($_GET['max']) ? $_GET['max']: "");
		$minDate = date('Y-m-d',(strtotime ( '-1 day' , strtotime ($minDate) ) ));
		$maxDate = date('Y-m-d',(strtotime ( '-1 day' , strtotime ($maxDate) ) ));
		$type = (isset($_GET['type']) ? $_GET['type'] : null);
		$data['barang'] = $this->Barangio_model->print($minDate,$maxDate,$type);
		$data['title'] = ($type == null ? '' : $type);
		$this->load->view('data/print', $data);
	}
}
