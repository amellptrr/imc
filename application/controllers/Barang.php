<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
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
    }

    public function index()
    {
        $data['judul'] = 'Data Barang';
        $data['barang'] = $this->Barangio_model->getDataBarangNoType();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('data/barang', $data);
    }

	public function tambah_data()
    {
        $data['judul'] = 'Tambah Data Barang';
		$this->form_validation->set_rules('nama_barang','nama_barang','required');
		$this->form_validation->set_rules('stok','stok','required');
		$this->form_validation->set_rules('kode_jenis','kode_jenis','required');
		$this->form_validation->set_rules('kode_satuan','kode_satuan','required');
		$this->form_validation->set_rules('tanggal','tanggal','required');
        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar');
            $this->load->view('data/tambah_barang', $data);
        } else {
            $this->Jenis_Model->tambahDataJenis();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('jenis');
        }
    }
}
