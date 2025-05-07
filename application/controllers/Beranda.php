<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('data_model');
        date_default_timezone_set("Asia/Jakarta");
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
    }

    function index(){ 
        $data = [
            'title'         => 'Beranda - Batik Bosami',
            'sess_nama'     =>  $this->session->userdata('nama'),
            'sess_username' =>  $this->session->userdata('username'),
            'sess_akses'    =>  $this->session->userdata('akses')
        ];
        $this->load->view('part/header', $data);
        $this->load->view('part/navigation', $data);
        $this->load->view('beranda_view', $data);
        $this->load->view('part/main_js', $data);
    } 
    function kndata(){ 
        $data = [
            'title'         => 'Master - Data Kain',
            'sess_nama'     =>  $this->session->userdata('nama'),
            'sess_username' =>  $this->session->userdata('username'),
            'sess_akses'    =>  $this->session->userdata('akses'),
            'formatData'    => 'tables',
            'scriptForm'    => 'kain'
        ];
        $this->load->view('part/header', $data);
        $this->load->view('part/navigation', $data);
        $this->load->view('data/master_kain', $data);
        $this->load->view('part/main_js_tables', $data);
    } 
    function penjahitdata(){ 
        $data = [
            'title'         => 'Master - Data Penjahit',
            'sess_nama'     =>  $this->session->userdata('nama'),
            'sess_username' =>  $this->session->userdata('username'),
            'sess_akses'    =>  $this->session->userdata('akses'),
            'formatData'    => 'tables',
            'scriptForm'    => 'penjahit'
        ];
        $this->load->view('part/header', $data);
        $this->load->view('part/navigation', $data);
        $this->load->view('data/master_penjahit', $data);
        $this->load->view('part/main_js_tables', $data);
    } 
    function ptgdata(){ 
        $data = [
            'title'         => 'Master - Data Tukang Potong',
            'sess_nama'     =>  $this->session->userdata('nama'),
            'sess_username' =>  $this->session->userdata('username'),
            'sess_akses'    =>  $this->session->userdata('akses'),
            'formatData'    => 'tables',
            'scriptForm'    => 'pemotong'
        ];
        $this->load->view('part/header', $data);
        $this->load->view('part/navigation', $data);
        $this->load->view('data/master_potong', $data);
        $this->load->view('part/main_js_tables', $data);
    } 
    function pmbtkdata(){ 
        $data = [
            'title'         => 'Master - Data Pembatik',
            'sess_nama'     =>  $this->session->userdata('nama'),
            'sess_username' =>  $this->session->userdata('username'),
            'sess_akses'    =>  $this->session->userdata('akses'),
            'formatData'    => 'tables',
            'scriptForm'    => 'pembatik'
        ];
        $this->load->view('part/header', $data);
        $this->load->view('part/navigation', $data);
        $this->load->view('data/master_pembatik', $data);
        $this->load->view('part/main_js_tables2', $data);
    } 
    function jnsbarbar(){ 
        $data = [
            'title'         => 'Master - Data Jenis Babaran',
            'sess_nama'     =>  $this->session->userdata('nama'),
            'sess_username' =>  $this->session->userdata('username'),
            'sess_akses'    =>  $this->session->userdata('akses'),
            'formatData'    => 'tables',
            'scriptForm'    => 'babars',
            'recordTable'   =>  $this->data_model->sort_record('id_barbar','master_babar')
        ];
        $this->load->view('part/header', $data);
        $this->load->view('part/navigation', $data);
        $this->load->view('data/master_babar', $data);
        $this->load->view('part/main_js_tables2', $data);
    } 
    function dataproduk(){ 
        $data = [
            'title'         => 'Master - Data Produk',
            'sess_nama'     =>  $this->session->userdata('nama'),
            'sess_username' =>  $this->session->userdata('username'),
            'sess_akses'    =>  $this->session->userdata('akses'),
            'formatData'    => 'tables',
            'scriptForm'    => 'produk'
        ];
        $this->load->view('part/header', $data);
        $this->load->view('part/navigation', $data);
        $this->load->view('data/master_produk', $data);
        $this->load->view('part/main_js_tables2', $data);
    } 

    
}
?>