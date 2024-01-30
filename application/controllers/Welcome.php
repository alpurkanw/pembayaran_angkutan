<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	public function index()
	{

		if (!$this->session->userdata('level')) {

			$this->load->view('v_login');
		} else {
			if ($this->session->userdata('level') == "1") {
				redirect("satgas/home");
			} else if ($this->session->userdata('level') == "2") {
				redirect("adm/home");
				// } else if ($this->session->userdata('level') == "3") {
				// 	redirect("kasir/home");
				// } else if ($this->session->userdata('level') == "4") {
				// 	redirect("mkr/home");
			} else {
				session_destroy();
				redirect('welcome');
			}
		}
		// phpinfo	();
		// echo "tes";
	}
}
