<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Claporan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_akses();
        // $this->load->library('form_validation');
        // $this->sqlsvr = $this->load->database("sqlsvr44", TRUE);
    }

    public function perPic($act = "")
    {
        // echo "tes";
        if ($act == "proses") {
            // print_r($_REQUEST);
            // return;

            $tanggalAwal = str_replace('-', '', $this->input->post('tglawal'));
            $tanggalAkhir = str_replace('-', '', $this->input->post('tglakhir'));
            $namapic = $this->input->post("namapic");

            $data["page"] = "respons";
            $data["judul"] = "Angkutan Per PIC";
            // $data["show"] = "respons";


            if ($namapic == "0") {
                $sql = "SELECT * from trx_angkutan where (tglangkut BETWEEN $tanggalAwal and  $tanggalAkhir)  ";
                $data["angks"]  = $this->db->query($sql)->result();
                $data["namapic"] = "Semua PIC";
            } else {
                $sql = "SELECT * from trx_angkutan where (tglangkut BETWEEN $tanggalAwal and  $tanggalAkhir)  and namapic = '$namapic'  ";
                $data["angks"]  = $this->db->query($sql)->result();
                $data["namapic"] = $namapic;
            }


            $data["tglAwal"] = $tanggalAwal;
            $data["tglAkhir"] = $tanggalAkhir;

            // print_r($data);
            // return;
            $this->load->view('adm/Vlap_perPic', $data);
        } else {


            $data["judul"] = "Angkutan Per PIC";
            $data["page"] = "getparam";

            $this->db->select('nama');
            $this->db->from('tm_pic');
            $this->db->order_by('nama', 'ASC');
            $data["pics"] = $this->db->get()->result();

            // $data["pics"] = $this->db->get('tm_pic')->result();
            $this->load->view('adm/Vlap_perPic', $data);
        }
    }

    public function perSopir($act = "")
    {
        // echo "tes";
        if ($act == "proses") {
            // print_r($_REQUEST);
            // return;

            $tanggalAwal = str_replace('-', '', $this->input->post('tglawal'));
            $tanggalAkhir = str_replace('-', '', $this->input->post('tglakhir'));
            $namapic = $this->input->post("namapic");

            $data["page"] = "respons";
            $data["judul"] = "Angkutan Per PIC";
            // $data["show"] = "respons";


            if ($namapic == "0") {
                $sql = "SELECT * from trx_angkutan where (tglangkut BETWEEN $tanggalAwal and  $tanggalAkhir)  ";
                $data["angks"]  = $this->db->query($sql)->result();
                $data["namapic"] = "Semua Sopir";
            } else {
                $sql = "SELECT * from trx_angkutan where (tglangkut BETWEEN $tanggalAwal and  $tanggalAkhir)  and namaspr = '$namapic'  ";
                $data["angks"]  = $this->db->query($sql)->result();
                $data["namapic"] = $namapic;
            }


            $data["tglAwal"] = $tanggalAwal;
            $data["tglAkhir"] = $tanggalAkhir;

            // print_r($data);
            // return;
            $this->load->view('adm/vlap_perSopir', $data);
        } else {


            $data["judul"] = "Angkutan Per Sopir";
            $data["page"] = "getparam";

            $this->db->select('nama');
            $this->db->from('tm_sopir');
            $this->db->order_by('nama', 'ASC');
            $data["sprs"] = $this->db->get()->result();

            // $data["pics"] = $this->db->get('tm_pic')->result();
            $this->load->view('adm/vlap_perSopir', $data);
        }
    }

    public function pemPerSopir($act = "")
    {
        // echo "tes";
        if ($act == "proses") {
            // print_r($_REQUEST);
            // return;

            $tanggalAwal = str_replace('-', '', $this->input->post('tglawal'));
            $tanggalAkhir = str_replace('-', '', $this->input->post('tglakhir'));
            $namaSopir = $this->input->post("namaSopir");

            $data["page"] = "respons";
            $data["judul"] = "Angkutan Per PIC";
            // $data["show"] = "respons";


            if ($namaSopir == "0") {
                $sql = "SELECT * from trx_angkutan where (tgl_byr_spr BETWEEN $tanggalAwal and  $tanggalAkhir)  ";
                $data["angks"]  = $this->db->query($sql)->result();
                $data["namaSopir"] = "Semua Sopir";
            } else {
                $sql = "SELECT * from trx_angkutan where (tgl_byr_spr BETWEEN $tanggalAwal and  $tanggalAkhir)  and namaspr = '$namaSopir'  ";
                $data["angks"]  = $this->db->query($sql)->result();
                $data["namaSopir"] = $namaSopir;
            }


            $data["tglAwal"] = $tanggalAwal;
            $data["tglAkhir"] = $tanggalAkhir;
            $data["namaSpr"] = $this->input->post("namaSopir");

            // print_r($data);
            // return;
            $this->load->view('adm/vlap_PemPerSopir', $data);
        } else {


            $data["judul"] = "Pembayaran Per Sopir";
            $data["page"] = "getparam";

            $this->db->select('nama');
            $this->db->from('tm_sopir');
            $this->db->order_by('nama', 'ASC');
            $data["sprs"] = $this->db->get()->result();

            // $data["pics"] = $this->db->get('tm_pic')->result();
            $this->load->view('adm/vlap_PemPerSopir', $data);
        }
    }



    ////////////////////////////////////////pembayaran per CUSTOMER / PIC
    public function pembPerPic($act = "")
    {
        // echo "tes";
        if ($act == "proses") {
            // print_r($_REQUEST);
            // return;

            $tanggalAwal = str_replace('-', '', $this->input->post('tglawal'));
            $tanggalAkhir = str_replace('-', '', $this->input->post('tglakhir'));
            $namaPic = $this->input->post("namaPic");

            $data["page"] = "respons";
            $data["judul"] = "Angkutan Per PIC";
            // $data["show"] = "respons";


            if ($namaPic == "0") {
                $sql = "SELECT * from trx_angkutan where (tgl_byr_cust BETWEEN $tanggalAwal and  $tanggalAkhir)  ";
                $data["angks"]  = $this->db->query($sql)->result();
                $data["namaPic"] = "Semua Sopir";
            } else {
                $sql = "SELECT * from trx_angkutan where (tgl_byr_cust BETWEEN $tanggalAwal and  $tanggalAkhir)  and namapic = '$namaPic'  ";
                $data["angks"]  = $this->db->query($sql)->result();
                $data["namaPic"] = $namaPic;
            }


            $data["tglAwal"] = $tanggalAwal;
            $data["tglAkhir"] = $tanggalAkhir;
            $data["namaPic"] = $this->input->post("namaPic");

            // print_r($data);
            // return;
            $this->load->view('adm/vlap_pembPerpic', $data);
        } else {


            $data["judul"] = "Pembayaran Per PIC";
            $data["page"] = "getparam";

            $this->db->select('nama');
            $this->db->from('tm_pic');
            $this->db->order_by('nama', 'ASC');
            $data["sprs"] = $this->db->get()->result();

            // $data["pics"] = $this->db->get('tm_pic')->result();
            $this->load->view('adm/vlap_pembPerpic', $data);
        }
    }






    ////////////////  update end 


}
