<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Daftar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library("form_validation");
    }

    public function index()
    {
        $data['judul'] = 'Pendaftaran';
        $data['page'] = 'daftar';

        // $data["grpid"] = 0;

        $this->load->view('v_daftar', $data);
    }



    public function submit()
    {


        // $this->form_validation->set_rules('nip', 'NIP', 'required|trim|is_unique[tbl_user.nip]');
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[pos_user.email]');
        $this->form_validation->set_rules('pass1', 'Password', 'required|trim|min_length[3]|matches[pass2]');
        $this->form_validation->set_rules('pass2', 'Password', 'required|trim|matches[pass1]');
        $this->form_validation->set_rules('no_hp', 'No Telp', 'required|trim');
        // $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        // print_r($this->form_validation->run());
        // return;

        if ($this->form_validation->run() == TRUE) {
            $data_insert = [
                'nama' => htmlspecialchars($this->input->post('nama')),
                'email' => htmlspecialchars($this->input->post('email')),
                'pass' => password_hash(htmlspecialchars($this->input->post('pass1')), PASSWORD_DEFAULT),
                'notelp' => htmlspecialchars($this->input->post('notelp')),
                'level' => 1, // 1 Owner 2 admin 3 kasir 4 karyawan biasa
                'inp_date' => date('Ymd His') // 1 Owner 2 admin 3 kasir 4 karyawan biasa
            ];
            $ret = $this->db->insert('pos_user', $data_insert);
            // print_r($ret);
            // return;
            if ($ret > 0) {

                $data['judul'] = 'Pendaftaran';
                $data['page'] = 'berhasil';

                $data["email"] = $this->input->post('email');

                $this->load->view('v_daftar', $data);
                // return;
            } else {

                $data['judul'] = 'Pendaftaran';
                $data['page'] = 'gagal';

                // $data["grpid"] = 0;

                $this->load->view('v_daftar', $data);

                // return;
            }
        } else {
            $data['judul'] = 'Pendaftaran';
            $data['page'] = 'gagal';

            // $data["grpid"] = 0;

            $this->load->view('v_daftar', $data);
        }
    }
}
