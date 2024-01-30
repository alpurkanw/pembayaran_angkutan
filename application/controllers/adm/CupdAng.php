<?php

defined('BASEPATH') or exit('No direct script access allowed');

class CupdAng extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_akses();
        // $this->load->model('M_barang', 'bar');
        // $this->load->model('m_jns_tag', 'mtag');
    }

    public function index()
    {
        $data["judul"] = "Update Angkutan";
        // $userlok = $_SESSION["lokid"];
        $data["page"] = "index";

        // $data["ktgs"] = $this->db->get('tbl_kateg')->result();
        // $data["loks"] = $this->db->get('trx_angkutan')->result();
        $this->db->select('nama');
        $this->db->from('tm_sopir');
        $this->db->order_by('nama', 'ASC');
        $data["sprs"] = $this->db->get()->result();



        $this->load->view('adm/VupdAng', $data);
    }


    public function searchAng($namaspr = "")
    {
        $data["judul"] = "List Angkutan";
        // $userlok = $_SESSION["lokid"];
        $data["page"] = "respons";
        $_SESSION["namaspr"] =   ($this->input->post("namaSopir") !== null) ? $this->input->post("namaSopir") : $namaspr;


        $this->db->select('*');
        $this->db->from('trx_angkutan');
        $this->db->where(["namaspr" => $_SESSION["namaspr"]]);

        // $where = [
        //     "namaspr" => $namaspr
        // ];
        // $this->db->get_where('trx_angkutan', $where);
        // echo $namaspr;
        // echo $this->db->error()["message"];
        $data["angs"] = $this->db->get()->result();
        // return;

        $this->db->select('nama');
        $this->db->from('tm_sopir');
        $this->db->order_by('nama', 'ASC');
        $data["sprs"] = $this->db->get()->result();


        // $data["respons"] = "resp_cari";
        $this->load->view('adm/VupdAng', $data);
    }

    public function prosesUpd($id = null)
    {

        $data["judul"] = "Update  Angkutan";
        // $userlok = $_SESSION["lokid"];
        $data["page"] = "index";


        $where = [
            "id" => $this->input->post("idang"),

        ];
        $data = [
            "jum_kubikasi" => $this->input->post("kubikasi"),
            "upah_ang_per_kubik" => $this->input->post("biaya_ang_per_kubik"),
            "hargaperkubik" => $this->input->post("harga_mat_per_kubik")
        ];

        $this->db->where($where);
        $this->db->update('trx_angkutan', $data);






        // echo $this->db->error()["message"];

        // $this->index();
        redirect("adm/CupdAng/searchAng/" . $_SESSION["namaspr"]);
    }


    public function submit()
    {
        $data["judul"] = "Laporan Perlokasi";
        // echo $this->input->post('ruang');

        // print_r($_REQUEST);
        if ($this->input->post('ruang') !== null) {
            if ($this->input->post('ruang') !== "0") {
                // print_r($ruang);

                // ambil barang berdasarkan ruangan 
                $data["page"] = "showdata";
                $lokasi = json_decode($this->input->post('lokasi'), TRUE);
                $ruang = json_decode($this->input->post('ruang'), TRUE);

                $sql = " SELECT A.*, B.id, B.namakateg from tbl_barang A left join tbl_kateg B on B.id = A.idkateg
                 where idlok = '" . $lokasi["id"] . "' and idruang = '" . $ruang["id"] . "' ";
                // // echo $sql;
                // // return;
                $data["bars"] =  $this->db->query($sql)->result();
                $data["lokasi"] = $lokasi;
                $data["ruang"] = $ruang;

                $this->load->view('adm/VprintPerRuang', $data);
            } else {
                $this->session->set_flashdata(
                    'pesan',
                    '<div class="alert alert-warning py-1" role="alert">
                                    Pilih Ruangan Terlebih Dahulu
                                </div>'
                );
                redirect(base_url("adm/Cactivity"));
            }
        } else {
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-warning py-1" role="alert">
                                Pilih Ruangan Terlebih Dahulu
                            </div>'
            );
            redirect(base_url("adm/Cactivity"));
        }
    }

    public function showDetail($id)
    {
        /// $data["brgs"] = $this->db->get_where('tbl_barang', ["idlok" => $userlok])->result();
        $data["judul"] = "Detail Barang";
        $data["show"] = "detailBar";

        $data["brg"] = $this->bar->barPerBarcode($id)->result();

        $userlok = $_SESSION["lokid"];

        $data["ruangs"] = $this->db->get_where('tbl_ruangan', array("idlok" => $userlok))->result();
        $data["gbrs"] = $this->db->get_where('tbl_gambar', array("kodebar" => $id))->result();

        $this->db->select('*');
        $this->db->from('history_upd');
        $this->db->where('kode', $id);
        $this->db->order_by('tgl, jam', 'DESC');
        $data["hstrs"] = $this->db->get()->result();
        // $data["hstrs"] = $this->db->get_where('history_upd', ["kode" => $id])->result();

        $this->load->view('adm/VprintPerRuang_detail', $data);
    }

    public function showDetailAllitemPerRuang($ruang, $lokasi)
    {
        /// $data["brgs"] = $this->db->get_where('tbl_barang', ["idlok" => $userlok])->result();
        $data["judul"] = "Detail Barang";
        $data["show"] = "detailBar";

        // $data["brg"] = $this->bar->barPerBarcode($id)->result();

        $userlok = $_SESSION["lokid"];

        // $data["ruangs"] = $this->db->get_where('tbl_ruangan', array("idlok" => $userlok))->result();
        // $data["gbrs"] = $this->db->get_where('tbl_gambar', array("kodebar" => $id))->result();

        // $this->db->select('*');
        // $this->db->from('history_upd');
        // $this->db->where('kode', $id);
        // $this->db->order_by('tgl, jam', 'DESC');
        // $data["hstrs"] = $this->db->get()->result();

        $sql = "SELECT A.id aid, A.*, B.id, B.namakateg, C.namalok namalok from tbl_barang A 
        left join tbl_kateg B on B.id = A.idkateg
        left join tbl_lok C on C.id = A.idlok
        where 
        idlok = $lokasi and idruang = $ruang";
        $data["gbrs"] = $this->db->query($sql);


        // $data["hstrs"] = $this->db->get_where('history_upd', ["kode" => $id])->result();

        $this->load->view('adm/VprintPerRuang_detail_all', $data);
    }
}
    
    /* End of file Login.php */
