<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Ctujuan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_akses();
        $this->load->library('form_validation');
        // $this->sqlsvr = $this->load->database("sqlsvr44", TRUE);
    }

    public function index()
    {
        // echo "tes";
        $data["judul"] = "List Tujuan";
        $data["show"] = "index";

        $data["tujuans"] = $this->db->get('tm_tujuan')->result();
        $this->load->view('adm/Vtujuan', $data);
    }

    public function Ftambah()
    {
        // echo "tes";
        $data["judul"] = "Form Tambah Tujuan";
        $data["show"] = "form_tambah";

        // $data["orangs"] = $this->db->get('tm_tujuan')->result();
        $this->load->view('adm/Vtujuan', $data);
    }

    public function delete($id)
    {
        // echo $id;
        // $data["orangs"] = $this->db->get('tm_tujuan')->result();
        // $this->load->view('adm/Vsopir', $data);

        // $ruang = $this->db->get_where('tm_tujuan', ["idlok" => $id])->result();
        // if (count($ruang) > 0) {
        //     $this->session->set_flashdata(
        //         'pesan',
        //         '<div class="alert alert-danger py-1" role="alert">
        //                     Data Tujuan GAGAL Dihapus karena sudah terinput ruangan, silahkan hapus terlebih dahulu ruangan pada Tujuan ini
        //                 </div>'
        //     );
        //     redirect('adm/CTujuan');
        // }

        $ret = $this->db->delete('tm_tujuan', array('id' => $id));
        if ($ret > 0) {
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-success py-1" role="alert">
                            Data Tujuan berhasil Dihapus
                        </div>'
            );
            // redirect('appv/C_mstTagihan');
            redirect('adm/Ctujuan/');
            // return;
        } else {
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-danger py-1" role="alert">
                            Data Tujuan GAGAL Dihapus, error: ' . $this->db->error() . '
                        </div>'
            );
            redirect('adm/Ctujuan/');
        }
    }

    public function addProc()
    {

        // print_r($_REQUEST);
        // return;

        // $this->form_validation->set_rules(
        //     'namalok',
        //     'Nama Tujuan',
        //     'trim|required'
        // );
        // $this->form_validation->set_rules(
        //     'ket',
        //     'Ketarangan',
        //     'trim|required'
        // );

        // $this->form_validation->set_rules(
        //     'kodelok',
        //     'Kode Tujuan',
        //     'required|trim|is_unique[tm_tujuan.kodelok]'
        // );


        $data_insert = [
            // 'kodelok' => $this->input->post('kodelok'),
            'tujuan' => $this->input->post('tujuan')
        ];
        $this->tambahkan($data_insert);

        // if ($this->form_validation->run() == TRUE) {
        //     // print_r($_POST);
        //     // echo "sudah di proses";
        //     $data_insert = [
        //         // 'kodelok' => $this->input->post('kodelok'),
        //         'nama' => $this->input->post('nama'),
        //         'alamat' => $this->input->post('alamat'),
        //         'notelp' => $this->input->post('notelp'),
        //         'ket' => $this->input->post('ket'),
        //     ];
        //     $this->tambahkan($data_insert);
        // } else {

        //     redirect('adm/Ctujuan//Ftambah');
        //     // redirect(base_url("adm/CTujuan/Ftambah"));
        //     // $this->load->view('adm/Vsopir', $data);
        //     // return;
        // }
    }

    private function tambahkan($data)
    {

        $ret = $this->db->insert('tm_tujuan', $data);


        if ($ret > 0) {
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-success py-1" role="alert">
                            Data Tujuan berhasil ditambah
                        </div>'
            );
            redirect('adm/Ctujuan');
            return;
        } else {
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-danger py-1" role="alert">
                            Data Tujuan GAGAL ditambah, error: ' . $this->db->error() . '
                        </div>'
            );
            redirect('adm/Ctujuan/Ftambah');
            return;
        }
    }


    // update////////////////////////////

    public function fUpdate($id)
    {
        // echo "tes";
        $data["judul"] = "Form Update Tujuan";
        $data["show"] = "f_update";

        $data["lok"] = $this->db->get_where('tm_tujuan', ["id" => $id])->result();
        $this->load->view('adm/Vtujuan', $data);
    }

    public function updProc($id)
    {


        // $this->form_validation->set_rules(
        //     'namalok',
        //     'Nama Tujuan',
        //     'trim|required'
        // );
        // $this->form_validation->set_rules(
        //     'ket',
        //     'Ketarangan',
        //     'trim|required'
        // );
        $where = [
            'id' => $id,
        ];
        $data_update = [
            'tujuan' => $this->input->post('tujuan')
        ];
        $this->update($data_update, $where);


        // if ($this->form_validation->run() == TRUE) {
        //     // print_r($_POST);
        //     // echo "sudah di proses";

        // } else {

        //     $this->session->set_flashdata(
        //         'pesan',
        //         '<div class="alert alert-danger py-1" role="alert">
        //                     GAGAL Update.
        //                 </div>'
        //     );
        //     redirect("adm/CTujuan");
        // }
    }



    private function update($data, $where)
    {

        $this->db->where($where);
        $this->db->update('tm_tujuan', $data);

        // $data["judul"] = "List Warga";
        if ($this->db->affected_rows() == 1) {

            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-success py-1" role="alert">
                            Success Update.
                        </div>'
            );
            redirect("adm/Ctujuan/");
            // return;
            // return;
        } else {
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-danger py-1" role="alert">
                            GAGAl Update. ' . $this->db->error()["message"] . '
                        </div>'
            );
            redirect("adm/Ctujuan/");
        }
    }

    ////////////////  update end 


}
