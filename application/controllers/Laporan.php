<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->model('data_model');
        date_default_timezone_set("Asia/Jakarta");
    }

    function index(){
        echo "Error Token..";
    }

    function cashflow(){
        $data = [
            'title'         => 'Laporan - Keuangan / Cash Flow',
            'sess_nama'     =>  $this->session->userdata('nama'),
            'sess_username' =>  $this->session->userdata('username'),
            'sess_akses'    =>  $this->session->userdata('akses'),
            'formatData'    => 'tables',
            'scriptForm'    => 'cashflow'
        ];
        $this->load->view('part/header', $data);
        $this->load->view('part/navigation', $data);
        if($this->session->userdata('akses')=="root"){
            $this->load->view('laporan/cashflow', $data);
        } else {
            $this->load->view('block_akses', $data);
        }
        $this->load->view('part/main_js_tables', $data);
    }


}