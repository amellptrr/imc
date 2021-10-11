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
		$query = "SELECT 
		b.id,
		b.nama_barang,
		b.merk_barang,
		b.stok,
		bio.tipe,
		bio.tanggal
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
