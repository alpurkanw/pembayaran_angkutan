<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        cek_akses();
    }

    public function index()
    {
        $data["judul"] = "Home";

        $this->load->view('adm/Vhome', $data);
    }

    public function dshHome()
    {
        $data["judul"] = "Home";

        $this->db->select('count(namabar) jumitem, sum(harga) nominal');
        $data["dshBarApp"] = $this->db->get_where('tbl_barang', array("sts" => 1))->result();

        $this->db->select('count(namabar) jumitem, sum(harga) nominal');
        $data["dshBar"] = $this->db->get_where('tbl_barang', array("sts" => 0))->result();

        $data["kondisi"] = $this->db->query("SELECT kondisi, count(*) jumitem, sum(harga) nominal FROM `tbl_barang` GROUP BY kondisi;")->result();
        $data["lokasi"] = $this->db->query("SELECT namalok, count(*) jumitem, sum(harga) nominal FROM `tbl_barang` GROUP BY namalok;")->result();
        $data["ruang"] = $this->db->query("SELECT idlok,idruang,ruang, count(*) jumitem, sum(harga) nominal FROM `tbl_barang` GROUP BY idlok,idruang,ruang ORDER BY idruang;")->result();
        $data["asal"] = $this->db->query("SELECT asal_peroleh, count(*) jumitem, sum(harga) nominal FROM `tbl_barang` GROUP BY asal_peroleh ORDER BY jumitem desc;")->result();
        $this->load->view('adm/VdshHome', $data);
    }
}
    
    /* End of file Login.php */
