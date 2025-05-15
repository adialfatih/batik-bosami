<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends CI_Controller
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
        echo "Token Erorr";
    } 
    function dataakses(){
        $data = [
            'title'         => 'Master - Data Karyawan',
            'sess_nama'     =>  $this->session->userdata('nama'),
            'sess_username' =>  $this->session->userdata('username'),
            'sess_akses'    =>  $this->session->userdata('akses'),
            'formatData'    => 'tables',
            'scriptForm'    => 'users'
        ];
        $this->load->view('part/header', $data);
        $this->load->view('part/navigation', $data);
        $this->load->view('data/master_data_users', $data);
        $this->load->view('part/main_js_tables2', $data);
        
    }
    function datakar(){ 
        $akses = $this->session->userdata('akses');
        $data = [
            'title'         => 'Master - Data Karyawan',
            'sess_nama'     =>  $this->session->userdata('nama'),
            'sess_username' =>  $this->session->userdata('username'),
            'sess_akses'    =>  $akses,
            'formatData'    => 'tables',
            'scriptForm'    => 'karyawan'
        ];
        $this->load->view('part/header', $data);
        $this->load->view('part/navigation', $data);
        if($akses == "root"){
            $this->load->view('data/master_karyawan', $data);
        } else {
            $this->load->view('block_akses', $data);
        }
        $this->load->view('part/main_js_tables2', $data);
    } 
    function loadDataUsers(){
        $cekData = $this->data_model->sort_record('id','users');
        if($cekData->num_rows() > 0){
            $no=1;
            foreach($cekData->result() as $row){
                $id = $row->id;
                $username = $row->username;
                $nama = $row->nama;
                $akses = $row->akses;
                echo "<tr>";
                echo "<td>".$no."</td>";
                echo "<td>".$nama."</td>";
                echo "<td><span class='badge bg-secondary'>".$username."</span></td>";
                if($akses == "root"){
                    echo '<td><span class="badge bg-danger">Super Admin</span></td>';
                } else {
                    echo '<td><span class="badge bg-primary">Admin</span></td>';
                }
                ?>
                <td style="color:red;">
                    <div class="btn-group mb-1">
                        <div class="dropdown">
                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#large12" onclick="updatePass('<?=$id;?>','<?=$nama;?>')">Ubah Password</a>
                                <a class="dropdown-item" href="javascript:void(0);" onclick="hapusUsers('<?=$id;?>','<?=$nama;?>')">Hapus Users</a>
                            </div>
                        </div>
                    </div>
                </td>
                <?php
                echo "</tr>";
                $no++;
            }
        }
    }

    function loadDataKaryawan(){
        $cekData = $this->data_model->sort_record('id_karyawan','master_karyawan');
        if($cekData->num_rows() > 0){
            $no=1;
            foreach($cekData->result() as $row){
                $tgl_awal = $row->tanggal_awal;
                $nama_kar = $row->nama_kar;
                $id_kar = $row->id_karyawan;
                $nik = $row->nik;
                $nowa = $row->no_wa;
                $status_aktif = $row->status_aktif;
                $alamat = $row->alamat_kar;
                $lama_bekerja = $this->hitungLamaBekerja($tgl_awal);
                echo "<tr>";
                echo "<td>".$no."</td>";
                echo "<td>".$nama_kar."</td>";
                echo "<td>".$nowa."</td>";
                echo "<td>".$lama_bekerja."</td>";
                if($status_aktif == "Aktif"){
                    echo '<td><span class="badge bg-success">Aktif</span></td>';
                } else {
                    echo '<td><span class="badge bg-danger">Resign</span></td>';
                }
                ?>
                <td style="color:red;">
                    <div class="btn-group mb-1">
                        <div class="dropdown">
                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#large" onclick="updateKar('<?=$id_kar;?>','<?=$nama_kar;?>','<?=$nik;?>','<?=$tgl_awal;?>','<?=$nowa;?>','<?=$alamat;?>')">Edit Data</a>
                                <a class="dropdown-item" href="javascript:void(0);" onclick="hapusKar('<?=$id_kar;?>','<?=$nama_kar;?>')">Hapus Karyawan</a>
                            </div>
                        </div>
                    </div>
                </td>
                <?php
                echo "</tr>";
                $no++;
            }
        }
    }
    function hitungLamaBekerja($tanggal_awal) {
        $tanggal_awal = new DateTime($tanggal_awal);
        $tanggal_sekarang = new DateTime();
        $interval = $tanggal_awal->diff($tanggal_sekarang);
        
        $hasil = [];
        if ($interval->y > 0) {
            $hasil[] = $interval->y . " Tahun";
        }
        if ($interval->m > 0) {
            $hasil[] = $interval->m . " Bulan";
        }
        if ($interval->d > 0) {
            $hasil[] = $interval->d . " Hari";
        }
        
        return empty($hasil) ? "0 Hari" : implode(" ", $hasil);
    } //end 

    function addDataKaryawan(){
        $idkar = $this->input->post('idkar', TRUE);
        $nik = $this->input->post('nik', TRUE);
        $nmkar = $this->input->post('nmkar', TRUE);
        $nowa = $this->input->post('nowa', TRUE);
        $alamat = $this->input->post('alamat', TRUE);
        $tgl = $this->input->post('tgl', TRUE);
        if($idkar!="" AND $nik!="" AND $nmkar!="" AND $nowa!="" AND $tgl!=""){
            if($idkar=="0"){
                $cekNIK = $this->data_model->get_byid('master_karyawan',['nik'=>$nik])->num_rows();
                if($cekNIK == 0){
                    $this->data_model->saved('master_karyawan',[
                        'nama_kar'      => strtoupper($nmkar),
                        'nik'           => $nik,
                        'tanggal_awal'  => $tgl,
                        'no_wa'         => $nowa,
                        'alamat_kar'    => $alamat,
                        'status_aktif'  => 'Aktif'
                    ]);
                    echo json_encode(array("statusCode" => 200, "message" => "Berhasil menyimpan data karyawan"));
                } else {
                    echo json_encode(array("statusCode" => 500, "message" => "NIK sudah terdaftar sebagai karyawan"));
                }
            } else {
                $this->data_model->updatedata('id_karyawan',$idkar,'master_karyawan',[
                    'nama_kar'      => strtoupper($nmkar),
                    'nik'           => $nik,
                    'tanggal_awal'  => $tgl,
                    'no_wa'         => $nowa,
                    'alamat_kar'    => $alamat
                ]);
                echo json_encode(array("statusCode" => 200, "message" => "Berhasil update data karyawan"));
            }
        } else {
            echo json_encode(array("statusCode" => 500, "message" => "Masih ada data yang kosong..!!"));
        }
    }
    function inputgaji(){
        $data = [
            'title'             => 'Gaji Karyawan',
            'sess_nama'         =>  $this->session->userdata('nama'),
            'sess_username'     =>  $this->session->userdata('username'),
            'sess_akses'        =>  $this->session->userdata('akses'),
            'formatData'        => 'tables',
            'scriptForm'        => 'gajiKaryawan',
            'dateTeimePicker'   => 'yes',
            'showTable'         => 'tableCashFlow',
            'dataKaryawan'      => $this->data_model->get_byid('master_karyawan', ['status_aktif' => 'Aktif'])->result()
        ];
        $this->load->view('part/header', $data);
        $this->load->view('part/navigation', $data);
        if($this->session->userdata('akses')=="root"){
            $this->load->view('laporan/input_gaji', $data);
        } else {
            $this->load->view('block_akses', $data);
        }
        $this->load->view('part/main_js_laporan', $data);
    }
    
}
?>