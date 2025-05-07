<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Auth');
    }
    function simpanPass(){
        $idUsers = $this->input->post('idUsers', TRUE);
        $password = $this->input->post('pass', TRUE);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $this->db->query("UPDATE users SET password='$hashed_password' WHERE id='$idUsers'");
        echo json_encode(array("statusCode" => 200, "message" => "Update Password berhasil disimpan!"));
    }

    public function simpan()
    {
        
        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('pass', TRUE);
        $nama     = $this->input->post('usersNama', TRUE);
        $akses     = $this->input->post('akses', TRUE);
        if($username != "" AND $password!="" AND $nama!="" AND $akses!=""){
            // Enkripsi password dengan bcrypt
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Data yang akan dimasukkan ke database
            $data = [
                'username' => $username,
                'password' => $hashed_password,
                'nama'     => strtoupper($nama),
                'akses'    => $akses
            ];

            // Simpan ke database
            $insert = $this->M_Auth->tambah_user($data);

            if ($insert) {
                //echo "User berhasil disimpan!";
                echo json_encode(array("statusCode" => 200, "message" => "User berhasil disimpan!"));
            } else {
                echo json_encode(array("statusCode" => 500, "message" => "Gagal menyimpan user"));
            }
        } else {
            echo json_encode(array("statusCode" => 500, "message" => "Data tidak di isi dengan benar!!"));
        }
    }
}
