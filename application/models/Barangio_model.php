<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Barangio_Model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function getDataBarang($type)
	{
		$query = "SELECT
					barang_io.id,
					barang_io.nama_barang,
					barang_io.merk_barang,
					barang_io.stok,
					jenis.jenis_barang,
					satuan.satuan_barang
					FROM
					barang_io
					LEFT JOIN jenis ON barang_io.kode_jenis = jenis.kode_jenis
					LEFT JOIN satuan ON barang_io.kode_satuan = satuan.kode_satuan
				  WHERE tipe = '$type'";
		return $this->db->query($query)->result_array();
	}

	public function getDataBarangNoType()
	{
		$query = "SELECT
					barang_io.id,
					barang_io.nama_barang,
					barang_io.merk_barang,
					barang_io.stok,
					jenis.jenis_barang,
					satuan.satuan_barang
					FROM
					barang_io
					LEFT JOIN jenis ON barang_io.kode_jenis = jenis.kode_jenis
					LEFT JOIN satuan ON barang_io.kode_satuan = satuan.kode_satuan";
		return $this->db->query($query)->result_array();
	}

	public function tambahData()
	{
		$data = [
			"nama_barang" => $this->input->post('nama_barang', true),
			"merk_barang" => $this->input->post('merk_barang', true),
			"stok" => $this->input->post('stok', true),
			"kode_jenis" => $this->input->post('satuan', true),
			"kode_satuan" => $this->input->post('jenis', true),
			"tipe" => $this->input->post('tipe', true)
		];
		return $this->db->insert('barang_io', $data);
	}

	public function editdata($id)
	{
		$data = [
			"nama_barang" => $this->input->post('nama_barang', true),
			"merk_barang" => $this->input->post('merk_barang', true),
			"stok" => $this->input->post('stok', true),
			"kode_jenis" => $this->input->post('satuan', true),
			"kode_satuan" => $this->input->post('jenis', true),
			"tipe" => $this->input->post('tipe', true)
		];
		$this->db->where('id', $this->input->post('id'));
		$this->db->update('barang_io', $data);
	}

	public function getSingleData($id)
	{
        return $this->db->get_where('barang_io', ['id' => $id])->row_array();
	}

	public function hapusData($id)
    {
        $this->db->delete('barang_io', ['id' => $id]);
    }
}
