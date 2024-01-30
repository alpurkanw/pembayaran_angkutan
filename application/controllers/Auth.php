<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {


        if ($this->session->userdata('usernm') == '') {
            // jika usernm kosong maka kirim ke form login 
            $this->logout();
        } else {

            // jika usernm ada cek level nya 
            if ($this->session->userdata('level')  == 1) {
                // $data['judul'] = 'Admin Home';
                // $this->load->view('owner/Vhome', $data);
                redirect('owner/Home');
                // } else if ($this->session->userdata('level')  == 2) {
                //     $data['judul'] = 'Approval Home';
                //     $this->load->view('appv/vhome', $data);
                // } else if ($this->session->userdata('level')  == 3) {
                //     $data['judul'] = 'Maker Home';
                //     $this->load->view('pic/Home', $data);
                // } else if ($this->session->userdata('level')  == 4) {
                //     $data['judul'] = 'Penanggung Jawab Lokasi Home';
                //     $this->load->view('mkr/Home', $data);
            } else {
                $this->logout();
            }
        }
    }

    public function gagal()
    {
        $data['judul'] = 'Login Gagal';
        // $data['method'] = "open_index";
        $this->load->view('v_login', $data);
    }


    public function login()
    {


        $this->form_validation->set_rules(
            'usernm',
            'Username',
            'trim|required'
        );
        $this->form_validation->set_rules(
            'passwd',
            'Password',
            'trim|required'
        );

        if ($this->form_validation->run() == TRUE) {

            $usernm = $this->input->post('usernm');

            $pass = $this->input->post('passwd');
            $this->db->select(' * ');
            $this->db->from('tm_user ');
            $this->db->where([
                "usernm" => $usernm
            ]);

            $user = $this->db->get()->row_array();



            if ($user) {
                if (password_verify($pass, $user["pass"])) {
                    // if ($pass == $user["pass"]) {

                    // Array ( [id] => 40 [usernm] => satgas [pass] => $2y$10$WGP6V1jInJOMHRpJtyJ7HO7Lj8C14fMf5JL/so1oU7nHqQcKpyqV6 [notelp] => 085219222200 [level] => 1 [inp_date] => 20230824 002657 [ket] => )
                    $data = [
                        'id' => $user['id'],
                        'nama' => $user['nama'],
                        'notelp' => $user['notelp'],
                        'usernm' => $user['usernm'],
                        'level' => $user['level']

                    ];

                    // print_r($user);
                    // print_r($user["pass"]);
                    // echo "<BR>" . $user["level"] . "</BR>";
                    // return;


                    $this->session->set_userdata($data);
                    if ($data['level'] == '1') {
                        redirect('satgas/Home');
                        return;
                    } elseif ($data['level'] == '2') {
                        redirect('adm/Home');
                        return;
                        // } elseif ($data['level'] == '3') {
                        //     redirect('kasir/Home');
                        //     return;
                    } else {
                        $this->session->set_flashdata(
                            'pesan',
                            '<div class= "alert alert-danger" role="alert" >Level Belum disetting, Silahkan Hubungi Owner!</div>'
                        );
                        // $this->logout();
                        redirect('auth/gagal');
                        return;
                    }
                } else {

                    $this->session->set_flashdata(
                        'pesan',
                        '<div class= "alert alert-danger p-2" role="alert" >Password Salah</div>'
                    );
                    redirect('auth/gagal');
                    return;
                }
            } else {
                $this->session->set_flashdata(
                    'pesan',
                    '<div class= "alert alert-danger" role="alert" >Akun Anda Belum diaktifkan, Silahkan Hubungi Owner!</div>'
                );
                redirect('auth/gagal');
                return;
            }
        } else {
            // redirect('C_daftar/');
            // $data['judul'] = 'Login';
            $this->session->set_flashdata(
                'pesan',
                '<div class= "alert alert-danger" role="alert" >Parameter Belum Lengkap!</div>'
            );
            redirect(base_url());
            return;
        }
    }
    // public



    public function logout()
    {
        $this->session->unset_userdata('usernm');
        $this->session->unset_userdata('usernm');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata(
            'pesan',
            '<div class= "alert alert-success" role="alert" >Logout berhasil!</div>'
        );

        session_destroy();
        // session_destroy();
        redirect('welcome');
    }

    public function register()
    {
        $data['judul'] = 'Register';
        // $data['method'] = "open_index";
        $this->load->view('v_regis', $data);
    }

    public function regis_submit()
    {
        $this->form_validation->set_rules(
            'nama',
            'Nama',
            'trim|required|max_length[50]'
        );
        $this->form_validation->set_rules(
            'nohp',
            'No Hp',
            'trim|required|max_length[16]'
        );
        $this->form_validation->set_rules(
            'usernm',
            'usernm',
            'trim|required|is_unique[tb_user.usernm]'
        );
        $this->form_validation->set_rules(
            'username',
            'Username',
            'trim|required|max_length[25]|is_unique[tb_user.username]'
        );
        $this->form_validation->set_rules(
            'pass1',
            'Pass1',
            'trim|required|matches[pass2]'
        );
        $this->form_validation->set_rules(
            'pass2',
            'Pass2',
            'trim|required|matches[pass1]'
        );

        if ($this->form_validation->run() == true) {
            $data = [
                'nama' => $this->input->post('nama'),
                'nohp' => $this->input->post('nohp'),
                'usernm' => $this->input->post('usernm'),
                'username' => $this->input->post('username'),
                'password' => $this->input->post('pass1'),
                'tglTimeInput' => date('yyyymmdd His'),
                'role_id' => 2,
            ];

            $this->db->insert('tb_user', $data);
            if ($this->db->affected_rows() == 1) {
                //kirim telegram ke gw kalo ada yang daftar baru
                $text =
                    'Ada Pendaftaran User bos... Usernamenya : ' .
                    $data['username'] .
                    ' usernmnya : ' .
                    $data['usernm'] .
                    ' dan No Hp : ' .
                    $data['nohp'];
                sendNotif('123045474', $text);
                //////////////////////////////////////////////////
                echo 'Sukses';
            } else {
                echo 'Gagal';
            }

            redirect('auth');
            # code...
        } else {
            $this->register();
        }
    }

    public function blocked()
    {
        $this->load->view('tmp/v_forbidden');
        return;
    }
}
