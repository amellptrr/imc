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
		b.stok as stok_barang,
		(SELECT tanggal FROM barang_io WHERE id_barang = b.id AND tipe = 'masuk' ORDER BY barang_io.tanggal DESC LIMIT 1) AS tanggal_masuk,
		(SELECT tanggal FROM barang_io WHERE id_barang = b.id AND tipe = 'keluar' ORDER BY barang_io.tanggal DESC LIMIT 1) AS tanggal_keluar
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
