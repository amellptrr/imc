<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Barang_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getDataBarang()
    {
        $query = "SELECT `barang`.*, `jenis`.`jenis_barang`, `satuan`.`satuan_barang`
                  FROM `barang`
                  JOIN `jenis`
                  ON `barang`.`kode_jenis` = `jenis`.`kode_jenis`
                  JOIN `satuan`
                  ON `barang`.`kode_satuan` = `satuan`.`kode_satuan`
                  ";
        return $this->db->query($query)->result_array();
    }
}
