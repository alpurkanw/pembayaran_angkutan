<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cangkutan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_akses();
        $this->load->library('form_validation');
        // $this->sqlsvr = $this->load->database("sqlsvr44", TRUE);
    }

    public function input()
    {
        // echo "tes";
        $data["judul"] = "Input angkutan";
        $data["show"] = "index";

        $data["sprs"] = $this->db->get('tm_sopir')->result();
        $data["mtrs"] = $this->db->get('tm_material')->result();
        $data["pics"] = $this->db->get('tm_pic')->result();
        $data["tujuans"] = $this->db->get('tm_tujuan')->result();
        $this->load->view('satgas/Vinput', $data);
    }


    public function submit()
    {
        if ($this->input->post('tanggal') == "") {
            // echo "tanggal Kosong";
            $tgl = date("Ymd");
        } else {
            $tgl = str_replace("-", "", $this->input->post('tanggal'));
        }

        $spr = json_decode($this->input->post('namaSopir'), TRUE);
        $mtr = json_decode($this->input->post('jenisMaterial'), TRUE);
        $pic = json_decode($this->input->post('namaPic'), TRUE);
        $tjn = $this->input->post('tujuan');

        // $namacust = $this->input->post('namaCustomer');
        // $alamatcust = $this->input->post('alamatCustomer');


        // echo $namaSopir["nama"];

        // namaSopir


        $data_insert = [
            "idspr" => $spr["id"],
            "namaspr" => $spr["nama"],
            "notelpspr" => $spr["notelp"],

            "idpic" => $pic["id"],
            "namapic" => $pic["nama"],
            "notelppic" => $pic["notelp"],
            "tujuan" => $tjn,

            "idmat" => $mtr["id"],
            "namamat" => $mtr["namamat"],


            "jum_kubikasi" => 0,
            "upah_ang_per_kubik" => 0,
            "hargaperkubik" => 0,


            "tglangkut" => $tgl,

            "st_byr_spr" => 0,
            "tgl_byr_spr" => 0,

            "st_byr_cust" => 0,
            "tgl_byr_cust" => 0
        ];
        $ret = $this->db->insert('trx_angkutan', $data_insert);
        // print_r($ret);
        // return;
        if ($ret > 0) {
            $data = [
                "pesan" => "sukses",
                "sopir" => $spr["nama"],
                "material" => $mtr["namamat"],
                "pic" => $pic["nama"],
                "tujuan" => $tjn,
                "tglang" => $tgl,
                "inpid" => $_SESSION["id"],
                "inpname" => $_SESSION["nama"],
                "kodeang" => $this->db->insert_id(),
            ];
            echo json_encode($data);
            return;
        } else {
            $data = [
                "pesan" => "gagal",
                "error" => $this->db->error(),

            ];
            echo json_encode($data);
            return;
        }
    }
    public function reportToDay()
    {
        // echo "tes";
        $data["judul"] = "Laporan Per hari ini";
        $data["show"] = "index";
        $sql = "";
        $today = date("Ymd");

        $sql = "SELECT count(*) jum from trx_angkutan where tglangkut = $today  ";
        $data["tot_ang"] = $this->db->query($sql)->result()[0];

        // $sql = "SELECT count(*) jum from trx_angkutan where tglangkut = $today and st_bayar_spr = 0  ";
        // $data["spr_not_pay"] = $this->db->query($sql)->result()[0];

        $sql = "SELECT * from trx_angkutan where tglangkut = $today  ";
        $data["angks"]  = $this->db->query($sql)->result();

        $this->load->view('satgas/Vreporttoday', $data);
    }

    public function reportAllSpr()
    {
        // echo "tes";
        $namaspr = $this->input->post("namaspr");
        if ($namaspr == "0") {


            $data["judul"] = "Laporan All Sopir";
            $data["show"] = "index";
            $sql = "";
            $today = date("Ymd");

            $sql = "SELECT count(*) jum from trx_angkutan   ";
            $data["tot_ang"] = $this->db->query($sql)->result()[0];


            $sql = "
                    SELECT
                        namaspr,
                        SUM(CASE WHEN st_byr_spr = 0 THEN 1 ELSE 0 END) AS jumlah_belum_bayar,
                        SUM(CASE WHEN st_byr_spr = 1 THEN 1 ELSE 0 END) AS jumlah_sudah_bayar,
                        count(*) jum
                    FROM
                        trx_angkutan
                    GROUP BY
                        namaspr
                ";
            $data["angks"]  = $this->db->query($sql)->result();

            $this->load->view('satgas/VrptAllSpr', $data);
        } else {

            $data["judul"] = "Laporan Per Sopir";
            $data["show"] = "result";
            $sql = "";
            // $today = date("Ymd");

            $data["sprs"] = $this->db->get('tm_sopir')->result();
            $data["mtrs"] = $this->db->get('tm_material')->result();
            $data["pics"] = $this->db->get('tm_pic')->result();
            $data["tujuans"] = $this->db->get('tm_tujuan')->result();
            $data["sopir"] = $namaspr;




            $sql = "SELECT count(*) jum from trx_angkutan where namaspr= '" . $namaspr . "' ";
            $data["tot_ang"] = $this->db->query($sql)->result()[0];

            $sql = "SELECT count(*) jum from trx_angkutan where namaspr= '" . $namaspr . "' and st_byr_spr = 0  ";
            $data["spr_not_pay"] = $this->db->query($sql)->result()[0];


            $sql = "SELECT * from trx_angkutan where namaspr= '" . $namaspr . "'  ";
            $data["angks"]  = $this->db->query($sql)->result();
            $this->load->view('satgas/vdetailperspr', $data);
        }
    }


    public function cari($param = "")
    {
        // echo "tes";
        if ($param == "") {
            $data["judul"] = "Laporan Per hari ini";
            $data["show"] = "index";
            $sql = "";
            $today = date("Ymd");




            $this->load->view('satgas/Vcari', $data);
        }

        if ($param == "submit") {
            $data["judul"] = "Laporan Per hari ini";
            $data["show"] = "submit";
            $data["sopir"] = $this->input->post("kata_kunci");
            $sql = "";
            $today = date("Ymd");

            // $sql = "SELECT count(*) jum from trx_angkutan where tglangkut = $today  ";
            // $data["tot_ang"] = $this->db->query($sql)->result()[0];

            // $sql = "SELECT count(*) jum from trx_angkutan where tglangkut = $today and st_bayar_spr = 0  ";
            // $data["spr_not_pay"] = $this->db->query($sql)->result()[0];

            $data["sprs"] = $this->db->get('tm_sopir')->result();
            $data["mtrs"] = $this->db->get('tm_material')->result();
            $data["pics"] = $this->db->get('tm_pic')->result();
            $data["tujuans"] = $this->db->get('tm_tujuan')->result();



            $sql = "SELECT * from trx_angkutan where namaspr = '" . $data["sopir"] . "' order by tglangkut desc";
            $data["angks"]  = $this->db->query($sql)->result();

            $this->load->view('satgas/Vcari', $data);
        }
    }


    public function rptPeriodParam()
    {
        // echo "tes";
        $data["judul"] = "Laporan Per Period";
        $data["show"] = "getParam";

        $this->db->select('nama');
        $this->db->from('tm_sopir');
        $this->db->order_by('nama', 'ASC');
        $data["sprs"] = $this->db->get()->result();
        $this->load->view('satgas/vrptPeriod', $data);
    }

    public function rptPerSprgetParam()
    {
        // echo "tes";
        $data["judul"] = "Laporan Per Period";
        $data["show"] = "getParam";

        $this->db->select('nama');
        $this->db->from('tm_sopir');
        $this->db->order_by('nama', 'ASC');
        $data["sprs"] = $this->db->get()->result();
        $this->load->view('satgas/vrptPerSprgetParm', $data);
    }

    public function rptPeriodResult()
    {


        // print_r($_REQUEST);
        // return;


        $data["judul"] = "Laporan Per Period";
        $data["show"] = "result";
        $sql = "";
        $tanggalAwal = str_replace('-', '', $this->input->post('tanggalAwal'));
        $tanggalAkhir = str_replace('-', '', $this->input->post('tanggalAkhir'));

        // $today = date("Ymd");
        $namaspr = $this->input->post('namaSopir');

        $data["sprs"] = $this->db->get('tm_sopir')->result();
        $data["mtrs"] = $this->db->get('tm_material')->result();
        $data["pics"] = $this->db->get('tm_pic')->result();
        $data["tujuans"] = $this->db->get('tm_tujuan')->result();
        $data["sopir"] = $namaspr;



        $sql = "SELECT count(*) jum from trx_angkutan where (tglangkut BETWEEN $tanggalAwal and  $tanggalAkhir)  ";
        // echo $sql;
        // return;
        $data["tot_ang"] = $this->db->query($sql)->result()[0];

        $sql = "SELECT count(*) jum from trx_angkutan where (tglangkut BETWEEN $tanggalAwal and  $tanggalAkhir)  and st_byr_spr = 0  ";

        $data["spr_not_pay"] = $this->db->query($sql)->result()[0];


        $sql = "SELECT * from trx_angkutan where (tglangkut BETWEEN $tanggalAwal and  $tanggalAkhir)   ";
        $data["angks"]  = $this->db->query($sql)->result();

        $data["tglAwal"] = $this->input->post('tanggalAwal');
        $data["tglAkhir"] = $this->input->post('tanggalAkhir');

        $this->load->view('satgas/vrptPeriod', $data);
    }

    public function deleteAng($id = "")
    {
        if ($id !== "") {

            // cek apakah sudah ada pembyaran sopir dan customer ?
            $sql = "SELECT st_byr_spr,st_byr_cust from trx_angkutan where id = $id limit 1";
            $ang  = $this->db->query($sql)->result()[0];


            if ($ang->st_byr_spr !== "0" ||  $ang->st_byr_cust !== "0") {
                $res = [
                    "code" => "2",
                    "pesan" => "Gagal, Sopir atau Customer sudah ada pembayaran, silahkan konfirmasi ke admin  )"
                ];
                echo json_encode($res);
                return;
            }

            $ret = $this->db->delete('trx_angkutan', array('id' => $id));
            if ($ret > 0) {
                $res = [
                    "code" => "1",
                    "pesan" => "Sukses delete",
                ];
                // return;
            } else {
                $res = [
                    "code" => "2",
                    "pesan" => "Gagals, Error Message : " . $this->db->error(),
                ];
            }
            echo json_encode($res);
            return;
        }
    }
    public function updateAng($namaspr = "")
    {

        // print_r($_REQUEST);
        // return;

        // Array ( [tglangkut] => 2023-12-16 [idang] => 3 [namamat] => PASIR [namaspr] => ADANG [namaPic] => PAMAN ENG [tujuan] => NANTI AGUNG )
        if ($namaspr == "") {

            $tgl = str_replace("-", "", $this->input->post('tglangkut'));
            $namamat = $this->input->post('namamat');
            $namaspr = $this->input->post('namaspr');
            $namaPic = $this->input->post('namaPic');
            $tujuan = $this->input->post('tujuan');

            $where = [
                "id" => $this->input->post("idang")
            ];
            $data = [
                "tglangkut" => $tgl,
                "namamat" => $namamat,
                "namaspr" => $namaspr,
                "namaPic" => $namaPic,
                "tujuan" => $tujuan
            ];

            $this->db->where($where);
            $this->db->update('trx_angkutan', $data);

            // // $data["judul"] = "List Warga";
            if ($this->db->affected_rows() == 1) {

                $this->session->set_flashdata(
                    'pesan',
                    '<div class="alert alert-success py-1" role="alert">
                        Success Update.
                    </div>'
                );
                redirect("satgas/Cangkutan/rptPeriodParam");
                // return;
                // return;
            } else {
                $this->session->set_flashdata(
                    'pesan',
                    '<div class="alert alert-danger py-1" role="alert">
                        GAGAl Update. ' . $this->db->error()["message"] . '
                    </div>'
                );
                redirect("satgas/Cangkutan/rptPeriodParam");
            }
        } else {


            $tgl = str_replace("-", "", $this->input->post('tglangkut'));
            $namamat = $this->input->post('namamat');
            $namaspr = $this->input->post('namaspr');
            $namaPic = $this->input->post('namaPic');
            $tujuan = $this->input->post('tujuan');

            $where = [
                "id" => $this->input->post("idang")
            ];
            $data = [
                "tglangkut" => $tgl,
                "namamat" => $namamat,
                "namaspr" => $namaspr,
                "namaPic" => $namaPic,
                "tujuan" => $tujuan
            ];

            $this->db->where($where);
            $this->db->update('trx_angkutan', $data);

            // // $data["judul"] = "List Warga";
            if ($this->db->affected_rows() == 1) {


                redirect("satgas/Cangkutan/reportAllSpr/" . $namaspr);
                // return;
                // return;
            } else {

                redirect("satgas/Cangkutan/reportAllSpr/" . $namaspr);
            }
        }
    }
}
