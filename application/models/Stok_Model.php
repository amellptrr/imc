<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Stok_Model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	public function getAllData()
	{
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
		ON b.kode_satuan = s.kode_satuan";
		return $this->db->query($query)->result_array();
	}
}
