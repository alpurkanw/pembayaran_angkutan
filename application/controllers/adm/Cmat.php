<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cmat extends CI_Controller
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
        $data["judul"] = "List Material";
        $data["show"] = "index";

        $data["materials"] = $this->db->get('tm_material')->result();
        $this->load->view('adm/Vmat', $data);
    }

    public function Ftambah()
    {
        // echo "tes";
        $data["judul"] = "Form Tambah Sopir";
        $data["show"] = "form_tambah";

        // $data["orangs"] = $this->db->get('tm_material')->result();
        $this->load->view('adm/Vmat', $data);
    }

    public function delete($id)
    {
        // echo $id;
        // $data["orangs"] = $this->db->get('tm_material')->result();
        // $this->load->view('adm/Vsopir', $data);

        // $ruang = $this->db->get_where('tm_material', ["idlok" => $id])->result();
        // if (count($ruang) > 0) {
        //     $this->session->set_flashdata(
        //         'pesan',
        //         '<div class="alert alert-danger py-1" role="alert">
        //                     Data Lokasi GAGAL Dihapus karena sudah terinput ruangan, silahkan hapus terlebih dahulu ruangan pada lokasi ini
        //                 </div>'
        //     );
        //     redirect('adm/Clokasi');
        // }

        $ret = $this->db->delete('tm_material', array('id' => $id));
        if ($ret > 0) {
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-success py-1" role="alert">
                            Data Lokasi berhasil Dihapus
                        </div>'
            );
            // redirect('appv/C_mstTagihan');
            redirect('adm/Cmat/');
            // return;
        } else {
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-danger py-1" role="alert">
                            Data Lokasi GAGAL Dihapus, error: ' . $this->db->error() . '
                        </div>'
            );
            redirect('adm/Cmat/');
        }
    }

    public function addProc()
    {

        // print_r($_REQUEST);
        // return;

        // $this->form_validation->set_rules(
        //     'namalok',
        //     'Nama Lokasi',
        //     'trim|required'
        // );
        // $this->form_validation->set_rules(
        //     'ket',
        //     'Ketarangan',
        //     'trim|required'
        // );

        // $this->form_validation->set_rules(
        //     'kodelok',
        //     'Kode Lokasi',
        //     'required|trim|is_unique[tm_material.kodelok]'
        // );


        $data_insert = [
            // 'kodelok' => $this->input->post('kodelok'),
            'namamat' => $this->input->post('namamat'),
            'harga' => $this->input->post('Harga')
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

        //     redirect('adm/Cmat//Ftambah');
        //     // redirect(base_url("adm/Clokasi/Ftambah"));
        //     // $this->load->view('adm/Vsopir', $data);
        //     // return;
        // }
    }

    private function tambahkan($data)
    {

        $ret = $this->db->insert('tm_material', $data);


        if ($ret > 0) {
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-success py-1" role="alert">
                            Data Material berhasil ditambah
                        </div>'
            );
            redirect('adm/Cmat');
            return;
        } else {
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-danger py-1" role="alert">
                            Data Material GAGAL ditambah, error: ' . $this->db->error() . '
                        </div>'
            );
            redirect('adm/Cmat/Ftambah');
            return;
        }
    }


    // update////////////////////////////

    public function fUpdate($id)
    {
        // echo "tes";
        $data["judul"] = "Form Update Material";
        $data["show"] = "f_update";

        $data["lok"] = $this->db->get_where('tm_material', ["id" => $id])->result();
        $this->load->view('adm/Vmat', $data);
    }

    public function updProc($id)
    {


        // $this->form_validation->set_rules(
        //     'namalok',
        //     'Nama Lokasi',
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
            'namamat' => $this->input->post('namamat'),
            'harga' => $this->input->post('harga')
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
        //     redirect("adm/Clokasi");
        // }
    }



    private function update($data, $where)
    {

        $this->db->where($where);
        $this->db->update('tm_material', $data);

        // $data["judul"] = "List Warga";
        if ($this->db->affected_rows() == 1) {

            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-success py-1" role="alert">
                            Success Update.
                        </div>'
            );
            redirect("adm/Cmat/");
            // return;
            // return;
        } else {
            $this->session->set_flashdata(
                'pesan',
                '<div class="alert alert-danger py-1" role="alert">
                            GAGAl Update. ' . $this->db->error()["message"] . '
                        </div>'
            );
            redirect("adm/Cmat/");
        }
    }

    ////////////////  update end 


}
