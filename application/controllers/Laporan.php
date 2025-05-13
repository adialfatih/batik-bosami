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
            'scriptForm'    => 'cashflow',
            'dateTeimePicker' => 'yes'
        ];
        $this->load->view('part/header', $data);
        $this->load->view('part/navigation', $data);
        if($this->session->userdata('akses')=="root"){
            $this->load->view('laporan/cashflow', $data);
        } else {
            $this->load->view('block_akses', $data);
        }
        $this->load->view('part/main_js_laporan', $data);
    } //end

    function inputcashflow(){
        $data = [
            'title'         => 'Cash Flow / Keuangan',
            'sess_nama'     =>  $this->session->userdata('nama'),
            'sess_username' =>  $this->session->userdata('username'),
            'sess_akses'    =>  $this->session->userdata('akses'),
            'formatData'    => 'tables',
            'scriptForm'    => 'cashflow',
            'dateTeimePicker' => 'yes',
            'showTable'       => 'tableCashFlow'
        ];
        $this->load->view('part/header', $data);
        $this->load->view('part/navigation', $data);
        if($this->session->userdata('akses')=="root"){
            $this->load->view('laporan/cashflowinput', $data);
        } else {
            $this->load->view('block_akses', $data);
        }
        $this->load->view('part/main_js_laporan', $data);
    }


}