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
					id,
					nama_barang,
					merk_barang,
					stok
					FROM
					barang_io
				  	WHERE tipe = '$type'";
		return $this->db->query($query)->result_array();
	}

	public function getDataBarangNoType()
	{
		$query = "SELECT
					b.id,
					b.nama_barang,
					b.merk_barang,
					b.stok,
					b.tanggal,
					j.jenis_barang,
					s.satuan_barang
					FROM
					barang_io as b
					JOIN jenis AS j ON (b.kode_jenis = j.kode_jenis)
					JOIN satuan AS s ON (b.kode_satuan = s.kode_satuan)";
		return $this->db->query($query)->result_array();
	}

	public function tambahData()
	{
		$data = [
			"nama_barang" => $this->input->post('nama_barang', true),
			"merk_barang" => $this->input->post('merk_barang', true),
			"stok" => $this->input->post('stok', true),
			"kode_jenis" => $this->input->post('jenis', true),
			"kode_satuan" => $this->input->post('satuan', true),
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
			"kode_jenis" => $this->input->post('jenis', true),
			"kode_satuan" => $this->input->post('satuan', true),
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
