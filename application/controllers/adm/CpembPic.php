<?php

defined('BASEPATH') or exit('No direct script access allowed');

class CpembPic extends CI_Controller
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
        $data["judul"] = "Pembayaran Customer/PIC";
        $data["page"] = "index";

        $this->db->select('nama');
        $this->db->from('tm_pic');
        $this->db->order_by('nama', 'ASC');
        $data["pics"] = $this->db->get()->result();



        $this->load->view('adm/VpembPic', $data);
    }


    public function get_angkutan()
    {
        // print_r($_REQUEST);
        $namapic = $this->input->post("namapic");
        // echo $namapic;

        $sql = "SELECT * from trx_angkutan where st_byr_cust = 0 and namapic = '$namapic'  and (jum_kubikasi <> 0 or hargaperkubik <> 0)  ";
        // echo $sql;
        // return;
        $angs  = $this->db->query($sql)->result();


        if (count($angs) > 0) {

            $no = 1;
            foreach ($angs as $key => $ank) {

                echo '
            <tr role="row" class="item_bar"
            data-id = ' . $ank->id . ' 
            data-namapic = ' . $ank->namapic . ' 
            data-namapic = ' . $ank->namapic . ' 
            data-tujuan = ' . $ank->tujuan . ' 
            data-namamat = ' . $ank->namamat . ' 
            data-tglangkut = ' . $ank->tglangkut . ' 
            data-jum_kubikasi = ' . $ank->jum_kubikasi . ' 
            data-upah_ang_per_kubik = ' . $ank->upah_ang_per_kubik . ' 
            data-hargaperkubik = ' . $ank->hargaperkubik . ' 
            >
                <td> ' . $ank->id . '<br>' . substr($ank->tglangkut, 0, 4) . '-' . substr($ank->tglangkut, 4, 2) . '-' . substr($ank->tglangkut, -2) . '</td>
                <td> 
                <strong>' . $ank->namapic . ' </strong>
                    <br>' . $ank->namapic . '
                    <br>' . $ank->tujuan . '
                    <br>' . $ank->namamat . '
                </td>
                <td> 
                    ' . $ank->jum_kubikasi . '
                    <br>' . number_format($ank->upah_ang_per_kubik)  . '
                    <br>' . number_format($ank->hargaperkubik) . '
                </td>
                
                <td> 
                    ' . number_format($ank->jum_kubikasi * $ank->upah_ang_per_kubik) . ' 
                </td>
                <td> 
                    <strong>' . number_format($ank->jum_kubikasi * $ank->hargaperkubik) . '</strong>
                </td>
            </tr> ';

                $no++;
            };
        } else {
            echo '
            <tr>
                <td colspan="4">
                Data Angkutan yang siap dibayarkan dengan nama sopir : <strong>' . $namapic . ' </strong>   Belum ada
                </td>

            </tr>
            ';
            echo "";
        }
    }


    public function prosesByr()
    {


        // echo "ID nya ini " . json_encode($this->input->post("ids"));
        $datatrx = [
            "ids" => $this->input->post("ids"),
            "total_harga" => $this->input->post("total_harga")
        ];

        // $thnbln = date("ym");
        // echo $thnbln;
        $tgltrx = date("Ymd");
        $jamtrx = date("His");

        $data = [
            "datatrx" => json_encode($datatrx),
            "tgltrx" => $tgltrx,
            "jamtrx" => $jamtrx,
            "userinp" => $_SESSION["usernm"]
        ];
        $this->db->insert('trx_pemb_pic', $data);
        $last_insert_id = $this->db->insert_id();
        $ids = $this->input->post("ids");

        $data = array(
            'st_byr_cust' => 1,
            'tgl_byr_cust' => $tgltrx,
            'nota_byr_cust' => $last_insert_id
        );



        $this->db->where_in('id', $ids);
        if ($this->db->update('trx_angkutan', $data)) {
            $resp = [
                "pesan" => "OK",
                "nota" => $last_insert_id
            ];
        } else {
            $resp = [
                "pesan" => $this->db->error(),
                "nota" => 0
            ];
        }
        echo json_encode($resp);
        return;

        // print_r($result);
        // echo $resp;
    }

    public function notaPrint($id)
    {
        if ($id !== "") {
            $this->db->select('*');
            $this->db->from('trx_angkutan');
            $this->db->where('nota_byr_cust', $id);
            $this->db->order_by('id', 'ASC');
            $data["trxangks"] = $this->db->get()->result();

            $this->db->select('*');
            $this->db->from('trx_pemb_pic');
            $this->db->where('id', $id);
            $this->db->order_by('id', 'ASC');
            $data["trxByrs"] = $this->db->get()->result();


            $this->load->view('adm/VnotaPrint_cust', $data);
        }
    }
    // public function prosesUpd($id = null)
    // {

    //     $kubikasi = str_replace(",", "", $this->input->post("kubikasi"));
    //     $biaya_ang_per_kubik = str_replace(",", "", $this->input->post("biaya_ang_per_kubik"));
    //     $harga_mat_per_kubik = str_replace(",", "", $this->input->post("harga_mat_per_kubik"));

    //     $data["judul"] = "Update  Angkutan";
    //     // $userlok = $_SESSION["lokid"];
    //     $data["page"] = "index";


    //     $where = [
    //         "id" => $this->input->post("idang"),

    //     ];
    //     $data = [
    //         "jum_kubikasi" => $kubikasi,
    //         "upah_ang_per_kubik" => $biaya_ang_per_kubik,
    //         "hargaperkubik" => $harga_mat_per_kubik
    //     ];

    //     $this->db->where($where);
    //     $this->db->update('trx_angkutan', $data);






    //     echo $this->db->error()["message"];
    //     return;
    //     // $this->index();
    //     redirect("adm/CupdAng");
    // }


    // public function submit()
    // {
    //     $data["judul"] = "Laporan Perlokasi";
    //     // echo $this->input->post('ruang');

    //     // print_r($_REQUEST);
    //     if ($this->input->post('ruang') !== null) {
    //         if ($this->input->post('ruang') !== "0") {
    //             // print_r($ruang);

    //             // ambil barang berdasarkan ruangan 
    //             $data["page"] = "showdata";
    //             $lokasi = json_decode($this->input->post('lokasi'), TRUE);
    //             $ruang = json_decode($this->input->post('ruang'), TRUE);

    //             $sql = " SELECT A.*, B.id, B.namakateg from tbl_barang A left join tbl_kateg B on B.id = A.idkateg
    //              where idlok = '" . $lokasi["id"] . "' and idruang = '" . $ruang["id"] . "' ";
    //             // // echo $sql;
    //             // // return;
    //             $data["bars"] =  $this->db->query($sql)->result();
    //             $data["lokasi"] = $lokasi;
    //             $data["ruang"] = $ruang;

    //             $this->load->view('adm/VprintPerRuang', $data);
    //         } else {
    //             $this->session->set_flashdata(
    //                 'pesan',
    //                 '<div class="alert alert-warning py-1" role="alert">
    //                                 Pilih Ruangan Terlebih Dahulu
    //                             </div>'
    //             );
    //             redirect(base_url("adm/Cactivity"));
    //         }
    //     } else {
    //         $this->session->set_flashdata(
    //             'pesan',
    //             '<div class="alert alert-warning py-1" role="alert">
    //                             Pilih Ruangan Terlebih Dahulu
    //                         </div>'
    //         );
    //         redirect(base_url("adm/Cactivity"));
    //     }
    // }

    // public function showDetail($id)
    // {
    //     /// $data["brgs"] = $this->db->get_where('tbl_barang', ["idlok" => $userlok])->result();
    //     $data["judul"] = "Detail Barang";
    //     $data["show"] = "detailBar";

    //     $data["brg"] = $this->bar->barPerBarcode($id)->result();

    //     $userlok = $_SESSION["lokid"];

    //     $data["ruangs"] = $this->db->get_where('tbl_ruangan', array("idlok" => $userlok))->result();
    //     $data["gbrs"] = $this->db->get_where('tbl_gambar', array("kodebar" => $id))->result();

    //     $this->db->select('*');
    //     $this->db->from('history_upd');
    //     $this->db->where('kode', $id);
    //     $this->db->order_by('tgl, jam', 'DESC');
    //     $data["hstrs"] = $this->db->get()->result();
    //     // $data["hstrs"] = $this->db->get_where('history_upd', ["kode" => $id])->result();

    //     $this->load->view('adm/VprintPerRuang_detail', $data);
    // }

    // public function showDetailAllitemPerRuang($ruang, $lokasi)
    // {
    //     /// $data["brgs"] = $this->db->get_where('tbl_barang', ["idlok" => $userlok])->result();
    //     $data["judul"] = "Detail Barang";
    //     $data["show"] = "detailBar";

    //     // $data["brg"] = $this->bar->barPerBarcode($id)->result();

    //     $userlok = $_SESSION["lokid"];

    //     // $data["ruangs"] = $this->db->get_where('tbl_ruangan', array("idlok" => $userlok))->result();
    //     // $data["gbrs"] = $this->db->get_where('tbl_gambar', array("kodebar" => $id))->result();

    //     // $this->db->select('*');
    //     // $this->db->from('history_upd');
    //     // $this->db->where('kode', $id);
    //     // $this->db->order_by('tgl, jam', 'DESC');
    //     // $data["hstrs"] = $this->db->get()->result();

    //     $sql = "SELECT A.id aid, A.*, B.id, B.namakateg, C.namalok namalok from tbl_barang A 
    //     left join tbl_kateg B on B.id = A.idkateg
    //     left join tbl_lok C on C.id = A.idlok
    //     where 
    //     idlok = $lokasi and idruang = $ruang";
    //     $data["gbrs"] = $this->db->query($sql);


    //     // $data["hstrs"] = $this->db->get_where('history_upd', ["kode" => $id])->result();

    //     $this->load->view('adm/VprintPerRuang_detail_all', $data);
    // }
}
    
    /* End of file Login.php */
