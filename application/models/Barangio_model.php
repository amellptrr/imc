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
					id_barang,
					stok,
					tanggal
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

	public function print($min, $max, $type)
	{
		$query = "SELECT DISTINCT
					b.id,
					b.nama_barang,
					b.merk_barang,
					b.stok,
					b.tanggal,
					bio.stok AS stok_bio
					FROM
					barang as b
					JOIN jenis AS j ON (b.kode_jenis = j.kode_jenis)
					JOIN satuan AS s ON (b.kode_satuan = s.kode_satuan)
					JOIN barang_io AS bio on (bio.id_barang = b.id)
					WHERE b.tanggal BETWEEN '$min' AND '$max'";

		if ($type == null) {
			$query = "SELECT DISTINCT
			b.id,
			b.nama_barang,
			b.merk_barang,
			(SELECT DISTINCT stok FROM barang_io WHERE id_barang = b.id AND tipe = 'masuk' LIMIT 1) AS stok_masuk,
			(SELECT DISTINCT stok FROM barang_io WHERE id_barang = b.id AND tipe = 'keluar' LIMIT 1) AS stok_keluar,
			(SELECT DISTINCT tanggal FROM barang_io WHERE id_barang = b.id AND tipe = 'masuk' LIMIT 1) AS tanggal_masuk,
			(SELECT DISTINCT tanggal FROM barang_io WHERE id_barang = b.id AND tipe = 'keluar' LIMIT 1) AS tanggal_keluar
			FROM barang AS b
			JOIN barang_io AS bio
			ON b.id = bio.id_barang 
			JOIN jenis AS j
			ON b.kode_jenis = j.kode_jenis
			JOIN satuan AS s
			ON b.kode_satuan = s.kode_satuan
			WHERE b.tanggal BETWEEN '$min' AND '$max'";
		}
		if ($type != null) {
			$query = $query . " AND tipe = '$type'";
		}
		return $this->db->query($query)->result_array();
	}

	public function tambahData()
	{
		$data = [
			"id_barang" => $this->input->post('id_barang', true),
			"stok" => $this->input->post('stok', true),
			"tipe" => $this->input->post('tipe', true)
		];
		$this->stockHandler();
		return $this->db->insert('barang_io', $data);
	}

	public function editdata($id)
	{
		$data = [
			"id_barang" => $this->input->post('id_barang', true),
			"stok" => $this->input->post('stok', true),
			"tipe" => $this->input->post('tipe', true)
		];
		$this->stockHandler();
		$this->db->where('id_barang', $this->input->post('id_barang'));
		$this->db->update('barang_io', $data);
	}

	public function stockHandler()
	{
		if ($this->input->post('tipe', true) == 'masuk') {
			$this->addStock($this->input->post('id_barang', true));
		} else {
			$this->reduceStock($this->input->post('id_barang', true));
		}
	}

	public function addStock($id)
	{
		$currentStock = $this->getSingledataBarang($id);
		$updatedStock = (int) $currentStock + (int) $this->input->post('stok', true);
		$data = [
			"stok" => $updatedStock,
		];
		$this->db->where('id', $id);
		$this->db->update('barang', $data);
	}

	public function reduceStock($id)
	{
		$currentStock = $this->getSingledataBarang($id);
		$updatedStock = (int) $currentStock - (int) $this->input->post('stok', true);
		$data = [
			"stok" => $updatedStock,
		];
		$this->db->where('id', $id);
		$this->db->update('barang', $data);
	}

	public function getSingleData($id)
	{
		return $this->db->get_where('barang_io', ['id' => $id])->row_array();
	}

	public function getSingledataBarang($id)
	{
		$data = $this->db->get_where('barang', ['id' => $id])->row_array();
		return $data['stok'];
	}

	public function hapusData($id)
	{
		$this->db->delete('barang_io', ['id' => $id]);
	}
}
