<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }

    public function do_upload() {
        $jenis = $this->input->post('jenis', TRUE);
        $cdbars = $this->input->post('cdbars', TRUE);
        $idbar = $this->input->post('idbar', TRUE);
        $config['upload_path']   = './uploads/';
        $config['allowed_types'] = 'jpg|jpeg|png|svg';
        $config['max_size']      = 7048; // Maksimal 7MB
        if($jenis == "jahit"){
            $config['file_name']     = 'foto-produksi-jahit-' . $cdbars;
        } else {
            $config['file_name']     = 'foto-produksi-babar-' . $cdbars;
        }
        
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file')) {
            echo json_encode(array('status' => 'error', 'message' => $this->upload->display_errors()));
        } else {
            $upload_data = $this->upload->data();
            
            // Kompres gambar jika bukan SVG
            if ($upload_data['file_ext'] != '.svg') {
                $this->_compress_image($upload_data['full_path'], $upload_data['file_type']);
            }
            if($jenis=="babar"){
                $this->db->query("UPDATE produksi_babar SET foto_produksi='".$upload_data['file_name']."' WHERE id_produksi='$idbar'");
            } else {
                $this->db->query("UPDATE produksi_jahit SET foto_produksi='".$upload_data['file_name']."' WHERE id_pjhit='$idbar'");
            }
            //echo json_encode(array('status' => 'success', 'file_name' => $upload_data['file_name']));
            echo "<div style='width:100%;display:flex;justify-content:center;align-items:center'>";
            echo "<p>Berhasil menyimpan<br>Mengarahkan halaman, mohon tunggu...</p>";
            echo "</div>";
            if($jenis=="babar"){
                echo "<script>setTimeout(function() { window.location.href = '".base_url('persiapan-produksi')."'; }, 800);</script>";
            } else {
                echo "<script>setTimeout(function() { window.location.href = '".base_url('jahit')."'; }, 800);</script>";
            }
            
        }
    }

    private function _compress_image($file_path, $file_type) {
        $quality = 70; // Kualitas kompresi 70%
        
        if ($file_type == 'image/jpeg' || $file_type == 'image/jpg') {
            $image = imagecreatefromjpeg($file_path);
            imagejpeg($image, $file_path, $quality);
        } elseif ($file_type == 'image/png') {
            $image = imagecreatefrompng($file_path);
            imagepng($image, $file_path, 7); // 0 (terbaik) - 9 (terkompresi maksimal)
        }
        
        if (isset($image)) {
            imagedestroy($image);
        }
    }
}
