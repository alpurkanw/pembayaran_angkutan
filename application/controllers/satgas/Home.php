<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        // $this->load->model('tm_sopir', 'spr');
        // $this->load->model('tm_cust', 'cust');
        // $this->load->model('tm_material', 'mtrl');
        cek_akses();
    }

    public function index()
    {
        $data["judul"] = "Home";

        // $data["allcust"] = $this->cust->all()->result_array();
        // $data["custs"] = $this->db->get('tm_cust')->result();
        // $data["mtrls"] = $this->db->get('tm_material')->result();
        // $data["sprs"] = $this->db->get('tm_sopir')->result();
        // print_r($data["barang"]);
        // return;

        $this->load->view('satgas/Vhome', $data);
    }
}
    
    /* End of file Login.php */
