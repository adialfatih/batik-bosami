<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Auth');
    }

    public function index()
    {
        // Jika sudah login, redirect ke Beranda
        if ($this->session->userdata('username')) {
            redirect(base_url('beranda'));
        }
        $this->load->view('login_view');
    }


    public function proses_login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->M_Auth->cek_login($username, $password);

        if ($user) {
            // Simpan Data ke Session
            $data_session = [
                'username' => $user->username,
                'nama'     => $user->nama,
                'logged_in' => TRUE,
                'akses'    => $user->akses
            ];

            $this->session->set_userdata($data_session);
            $this->session->sess_regenerate(TRUE); // Regenerasi Session ID

            redirect(base_url('beranda'));
        } else {
            $this->session->set_flashdata('message', 'Username atau Password Salah');
            redirect(base_url('login'));
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url('login'));
    }
}
