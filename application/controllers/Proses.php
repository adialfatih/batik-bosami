<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proses extends CI_Controller
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
        echo "Token Erorr...";
    } 
    function updatepenjahit(){
        $namaPenjahit = trim($this->input->post('namaPenjahit', TRUE));
        $kodePenjahit = trim($this->input->post('kodePenjahit', TRUE));
        $hargaJahit2 = trim($this->input->post('hargaJahit', TRUE));
        $alamat = trim($this->input->post('alamat', TRUE));
        $id = trim($this->input->post('id', TRUE));
        $namaPenjahit = strtoupper($namaPenjahit);
        $kodePenjahit = strtoupper($kodePenjahit);
        $hargaJahit =  preg_replace("/[^0-9]/", "", $hargaJahit2);
        if($namaPenjahit!="" && $kodePenjahit!="" && $hargaJahit!="" && $id!="0"){
            $cekKode = $this->data_model->get_byid('master_penjahit', ['kode_penjahit'=>$kodePenjahit]);
            if($cekKode->num_rows() < 1){
                $this->data_model->updatedata('id_penjahit',$id,'master_penjahit',[
                    'nama_penjahit' => $namaPenjahit,
                    'alamat'        => $alamat,
                    'kode_penjahit' => $kodePenjahit,
                    'harga_jahitan' => $hargaJahit
                ]);
                echo json_encode(array("statusCode" => 200, "message" => "Update Berhasil Disimpan!"));
            } else {
                if($cekKode->num_rows() == 1){
                    $id_penjahit_asli = $cekKode->row("id_penjahit");
                    if($id_penjahit_asli == $id){
                        $this->data_model->updatedata('id_penjahit',$id,'master_penjahit',[
                            'nama_penjahit' => $namaPenjahit,
                            'alamat'        => $alamat,
                            'kode_penjahit' => $kodePenjahit,
                            'harga_jahitan' => $hargaJahit
                        ]);
                        echo json_encode(array("statusCode" => 200, "message" => "Update Berhasil Disimpan!"));
                    } else {
                        echo json_encode(array("statusCode" => 500, "message" => "Kode Penjahit Sudah di Gunakan.!!"));
                    }
                } else {
                    echo json_encode(array("statusCode" => 500, "message" => "Kode Penjahit Sudah di Gunakan.!!"));
                }
            }
        } else {
            echo json_encode(array("statusCode" => 500, "message" => "Data Masih Ada Yang Kosong!"));
        }
    }
    function updatepembatik(){
        $namaPembatik = trim($this->input->post('namaPembatik', TRUE));
        $kodePembatik = trim($this->input->post('kodePembatik', TRUE));
        $alamat = trim($this->input->post('alamat', TRUE));
        $id = trim($this->input->post('id', TRUE));
        $namaPembatik = strtoupper($namaPembatik);
        $kodePembatik = strtoupper($kodePembatik);
        $hargaJahit =  preg_replace("/[^0-9]/", "", $hargaJahit2);
        if($namaPembatik!="" && $kodePembatik!="" && $id!="0"){
            $cekKode = $this->data_model->get_byid('master_pembatik', ['kode_pembatik'=>$kodePembatik]);
            if($cekKode->num_rows() < 1){
                $this->data_model->updatedata('id_pembatik',$id,'master_pembatik',[
                    'nama_pembatik' => $namaPembatik,
                    'alamat'        => $alamat,
                    'kode_pembatik' => $kodePembatik
                ]);
                echo json_encode(array("statusCode" => 200, "message" => "Update Berhasil Disimpan!"));
            } else {
                if($cekKode->num_rows() == 1){
                    $id_pembatik_asli = $cekKode->row("id_pembatik");
                    if($id_pembatik_asli == $id){
                        $this->data_model->updatedata('id_pembatik',$id,'master_pembatik',[
                            'nama_pembatik' => $namaPembatik,
                            'alamat'        => $alamat,
                            'kode_pembatik' => $kodePembatik
                        ]);
                        echo json_encode(array("statusCode" => 200, "message" => "Update Berhasil Disimpan!"));
                    } else {
                        echo json_encode(array("statusCode" => 500, "message" => "Kode Pembatik Sudah di Gunakan.!!"));
                    }
                } else {
                    echo json_encode(array("statusCode" => 500, "message" => "Kode Pembatik Sudah di Gunakan.!!"));
                }
            }
        } else {
            echo json_encode(array("statusCode" => 500, "message" => "Data Masih Ada Yang Kosong!"));
        }
    }
    function updateptg(){
        $namaptg = trim($this->input->post('namaptg', TRUE));
        $kodeptg = trim($this->input->post('kodeptg', TRUE));
        $alamat = trim($this->input->post('alamat', TRUE));
        $id = trim($this->input->post('idptg', TRUE));
        $namaptg = strtoupper($namaptg);
        $kodeptg = strtoupper($kodeptg);
        
        if($namaptg!="" && $kodeptg!="" && $id!="0"){
            $cekKode = $this->data_model->get_byid('master_pemotong', ['kode_ptg'=>$kodeptg]);
            if($cekKode->num_rows() < 1){
                $this->data_model->updatedata('id_ptg',$id,'master_pemotong',[
                    'nama_ptg'  => $namaptg,
                    'kode_ptg'  => $kodeptg,
                    'alamat'    => $alamat,
                ]);
                echo json_encode(array("statusCode" => 200, "message" => "Update Berhasil Disimpan!"));
            } else {
                if($cekKode->num_rows() == 1){
                    $id_ptg_asli = $cekKode->row("id_ptg");
                    if($id_ptg_asli == $id){
                        $this->data_model->updatedata('id_ptg',$id,'master_pemotong',[
                            'nama_ptg'  => $namaptg,
                            'kode_ptg'  => $kodeptg,
                            'alamat'    => $alamat,
                        ]);
                        echo json_encode(array("statusCode" => 200, "message" => "Update Berhasil Disimpan!"));
                    } else {
                        echo json_encode(array("statusCode" => 500, "message" => "Kode pemotong Sudah di Gunakan.!!"));
                    }
                } else {
                    echo json_encode(array("statusCode" => 500, "message" => "Kode pemotong Sudah di Gunakan.!!"));
                }
            }
        } else {
            echo json_encode(array("statusCode" => 500, "message" => "Data Masih Ada Yang Kosong!"));
        }
    }
    function inputpenjahit(){ 
        $namaPenjahit = trim($this->input->post('namaPenjahit', TRUE));
        $kodePenjahit = trim($this->input->post('kodePenjahit', TRUE));
        $hargaJahit2 = trim($this->input->post('hargaJahit', TRUE));
        $alamat = trim($this->input->post('alamat', TRUE));
        $namaPenjahit = strtoupper($namaPenjahit);
        $kodePenjahit = strtoupper($kodePenjahit);
        $hargaJahit =  preg_replace("/[^0-9]/", "", $hargaJahit2);
        if($namaPenjahit!="" && $kodePenjahit!="" && $hargaJahit!=""){
            $cekKode = $this->data_model->get_byid('master_penjahit', ['kode_penjahit'=>$kodePenjahit]);
            if($cekKode->num_rows() == 0){
                $this->data_model->saved('master_penjahit',[
                    'nama_penjahit' => $namaPenjahit,
                    'alamat'        => $alamat,
                    'kode_penjahit' => $kodePenjahit,
                    'harga_jahitan' => $hargaJahit
                ]);
                echo json_encode(array("statusCode" => 200, "message" => "Data Berhasil Disimpan!"));
            } else {
                echo json_encode(array("statusCode" => 500, "message" => "Kode Penjahit Sudah digunakan.!!"));
            }
        } else {
            echo json_encode(array("statusCode" => 500, "message" => "Data Masih Ada Yang Kosong!"));
        }
    }  //end
    function inputptg(){ 
        $namaptg = trim($this->input->post('namaptg', TRUE));
        $kodeptg = trim($this->input->post('kodeptg', TRUE));
        $alamat = trim($this->input->post('alamat', TRUE));
        $namaptg = strtoupper($namaptg);
        $kodeptg = strtoupper($kodeptg);
        
        if($namaptg!="" && $kodeptg!=""){
            $cekKode = $this->data_model->get_byid('master_pemotong', ['kode_ptg'=>$kodeptg]);
            if($cekKode->num_rows() == 0){
                $this->data_model->saved('master_pemotong',[
                    'nama_ptg'  => $namaptg,
                    'kode_ptg'  => $kodeptg,
                    'alamat'    => $alamat,
                ]);
                echo json_encode(array("statusCode" => 200, "message" => "Data Berhasil Disimpan!"));
            } else {
                echo json_encode(array("statusCode" => 500, "message" => "Kode pemotong Sudah digunakan.!!"));
            }
        } else {
            echo json_encode(array("statusCode" => 500, "message" => "Data Masih Ada Yang Kosong!"));
        }
    }  //end
    function inputpembatik(){ 
        $namaPembatik = trim($this->input->post('namaPembatik', TRUE));
        $kodePembatik = trim($this->input->post('kodePembatik', TRUE));
        $alamat = trim($this->input->post('alamat', TRUE));
        $namaPembatik = strtoupper($namaPembatik);
        $kodePembatik = strtoupper($kodePembatik);
        
        if($namaPembatik!="" && $kodePembatik!=""){
            $cekKode = $this->data_model->get_byid('master_pembatik', ['kode_pembatik'=>$kodePembatik]);
            if($cekKode->num_rows() == 0){
                $this->data_model->saved('master_pembatik',[
                    'nama_pembatik'  => $namaPembatik,
                    'alamat'    => $alamat,
                    'kode_pembatik'  => $kodePembatik
                ]);
                echo json_encode(array("statusCode" => 200, "message" => "Data Berhasil Disimpan!"));
            } else {
                echo json_encode(array("statusCode" => 500, "message" => "Kode Pembatik Sudah digunakan.!!"));
            }
        } else {
            echo json_encode(array("statusCode" => 500, "message" => "Data Masih Ada Yang Kosong!"));
        }
    }  //end
    function inputkain(){ 
        $namaKain = trim($this->input->post('namaKain', TRUE));
        $konstruksi = trim($this->input->post('konstruksi', TRUE));
        $kodeKain = trim($this->input->post('kodeKain', TRUE));
        $namaKain = strtoupper($namaKain);
        $konstruksi = strtoupper($konstruksi);
        $kodeKain = strtoupper($kodeKain);
        if($namaKain!="" && $konstruksi!="" && $kodeKain!=""){
            $cekKode = $this->data_model->get_byid('master_kain', ['inisial'=>$kodeKain]);
            if($cekKode->num_rows() == 0){
                $this->data_model->saved('master_kain',[
                    'nama_kain'         => $namaKain,
                    'konstruksi_kain'   => $konstruksi,
                    'inisial'           => $kodeKain
                ]);
                echo json_encode(array("statusCode" => 200, "message" => "Data Berhasil Disimpan!"));
            } else {
                echo json_encode(array("statusCode" => 500, "message" => "Kode Kain Sudah di Gunakan.!!"));
            }
        } else {
            echo json_encode(array("statusCode" => 500, "message" => "Data Masih Ada Yang Kosong!"));
        }
    }  //end
    function updatekain(){ 
        $namaKain = trim($this->input->post('namaKain', TRUE));
        $konstruksi = trim($this->input->post('konstruksi', TRUE));
        $kodeKain = trim($this->input->post('kodeKain', TRUE));
        $idkain = trim($this->input->post('idkain', TRUE));
        $namaKain = strtoupper($namaKain);
        $konstruksi = strtoupper($konstruksi);
        $kodeKain = strtoupper($kodeKain);
        if($namaKain!="" && $konstruksi!="" && $kodeKain!=""){
            $cekKode = $this->data_model->get_byid('master_kain', ['inisial'=>$kodeKain]);
            if($cekKode->num_rows() < 1){
                $this->data_model->updatedata('id_kain',$idkain,'master_kain',[
                    'nama_kain'         => $namaKain,
                    'konstruksi_kain'   => $konstruksi,
                    'inisial'           => $kodeKain
                ]);
                echo json_encode(array("statusCode" => 200, "message" => "Update Berhasil Disimpan!"));
            } else {
                if($cekKode->num_rows() == 1){
                    $id_kain_asli = $cekKode->row("id_kain");
                    if($id_kain_asli == $idkain){
                        $this->data_model->updatedata('id_kain',$idkain,'master_kain',[
                            'nama_kain'         => $namaKain,
                            'konstruksi_kain'   => $konstruksi,
                            'inisial'           => $kodeKain
                        ]);
                        echo json_encode(array("statusCode" => 200, "message" => "Update Berhasil Disimpan!"));
                    } else {
                        echo json_encode(array("statusCode" => 500, "message" => "Kode Kain Sudah di Gunakan.!!"));
                    }
                } else {
                    echo json_encode(array("statusCode" => 500, "message" => "Kode Kain Sudah di Gunakan.!!"));
                }
            }
        } else {
            echo json_encode(array("statusCode" => 500, "message" => "Data Masih Ada Yang Kosong!"));
        }
    }  //end
    function hapusKain(){
        $id = $this->input->post('id', TRUE);
        $this->data_model->delete('master_kain', 'id_kain', $id);
        echo json_encode(array("statusCode" => 200, "message" => "Data Berhasil Dihapus!"));
    }
    function hapusPenjahit(){
        $id = $this->input->post('id', TRUE);
        $this->data_model->delete('master_penjahit', 'id_penjahit', $id);
        echo json_encode(array("statusCode" => 200, "message" => "Data Berhasil Dihapus!"));
    }
    function hapusPemotong(){
        $id = $this->input->post('id', TRUE);
        $this->data_model->delete('master_pemotong', 'id_ptg', $id);
        echo json_encode(array("statusCode" => 200, "message" => "Data Berhasil Dihapus!"));
    }
    function hapusHargaList(){
        $id = $this->input->post('id', TRUE);
        $this->data_model->delete('master_jahiten', 'id_msj', $id);
        echo json_encode(array("statusCode" => 200, "message" => "Data Berhasil Dihapus!"));
    }
    function hapusPembatik(){
        $id = $this->input->post('id', TRUE);
        $this->data_model->delete('master_pembatik', 'id_pembatik', $id);
        echo json_encode(array("statusCode" => 200, "message" => "Data Berhasil Dihapus!"));
    }
    function hapusbarbar(){
        $id = $this->input->post('id', TRUE);
        $this->data_model->delete('master_babar', 'jenis_babaran', $id);
        echo json_encode(array("statusCode" => 200, "message" => "Data Berhasil Dihapus!"));
    }
    function simpanbabar(){
        $namaBabaran = $this->input->post('namaBabaran', TRUE);
        $namaBabaran = strtoupper($namaBabaran);
        $cek = $this->data_model->get_byid('master_babar', ['jenis_babaran'=>$namaBabaran]);
        if($cek->num_rows() == 0){
            $this->data_model->saved('master_babar',['jenis_babaran' => $namaBabaran]);
        }
        redirect(base_url('data-jenis-babaran'));
    }
    function loadUpdateHarga(){
        $kd     = $this->input->post('kd', TRUE);
        $akses  = $this->session->userdata('akses');
        $cek    = $this->data_model->get_byid('master_penjahit', ['kode_penjahit'=>$kd]);
        if($cek->num_rows() == 1){
            echo 'Kode Penjahit : <span class="badge bg-light-danger">'.$kd.'</span><br>';
            echo "Nama Penjahit : &nbsp;<strong>".$cek->row('nama_penjahit')."</strong><br>";
            $cek2 = $this->data_model->get_byid('master_jahiten', ['kode_penjahit'=>$kd]);
            if($cek2->num_rows() > 0){
                ?>
                <table class="table table-bordered" style="margin-top:10px;">
                    <?php foreach($cek2->result() as $val): ?>
                    <tr>
                        <td><?=$val->jenis_jahitan;?></td>
                        <td><?=$val->model_jahitan;?></td>
                        <?php if($akses=="root"){?>
                        <td><?=number_format($val->harga_jahitan,0,',','.');?></td>
                        <?php } else { echo "<td>*******</td>"; } ?>
                        <td><a href="javascript:void(0);" onclick="hapusHargaList('<?=$val->id_msj;?>','<?=$kd;?>')"><span class="badge bg-danger" style="font-size:12px;">Hapus</span></a></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
                <?php
            } else {
                echo "<hr><font style='color:red;'>Belum Memiliki Daftar Harga Jahit</font>";
            }
            ?>
            <hr>
            <strong>Tambahkan Daftar Harga : </strong><hr>
            <div class="row">
                <div class="col-md-4">
                    <label>Jenis Jahitan</label>
                </div>
                <div class="col-md-8 form-group">
                    <input type="text" id="jnsjhtmdl" class="form-control" name="jnsjahit" placeholder="Masukan jenis jahitan" list="jnsjahit" autocomplete="off">
                    <datalist id="jnsjahit">
                        <?php 
                        $rt = $this->db->query("SELECT DISTINCT jenis_jahitan FROM master_jahiten")->result();
                        foreach($rt as $val){
                            echo '<option value="'.$val->jenis_jahitan.'">'.$val->jenis_jahitan.'</option>';
                        }
                        ?>
                    </datalist>
                </div>
                <div class="col-md-4">
                    <label>Model Jahitan</label>
                </div>
                <div class="col-md-8 form-group">
                    <input type="text" id="mdljhtmdl" class="form-control" name="jnsjahit" placeholder="Masukan model jahitan" list="mdljahit" autocomplete="off">
                    <datalist id="mdljahit">
                        <?php 
                        $rtY = $this->db->query("SELECT DISTINCT model_jahitan FROM master_jahiten")->result();
                        foreach($rtY as $vals){
                            echo '<option value="'.$vals->model_jahitan.'">'.$vals->model_jahitan.'</option>';
                        }
                        ?>
                    </datalist>
                </div>
                <div class="col-md-4">
                    <label>Harga Jahitan</label>
                </div>
                <div class="col-md-8 form-group">
                    <input type="text" id="hrgjhtmdl" class="form-control" name="jnsjahit" placeholder="Masukan harga jahitan" oninput="formatRibuan(this)">
                </div>
            </div>
            <div style="width:100%;display:flex;justify-content:flex-end;">
                <button class="btn btn-primary" id="tambahJahit" onclick="simpanDaftar('<?=$kd;?>')">Simpan</button>
            </div>
            <?php
        } else {
            echo "<font style='color:red;'>Penjahit Tidak Ditemukan</font>";
        }
    } //end
    function saveUpdateHarga(){
        $kd = $this->input->post('kd', TRUE);
        $jns = $this->input->post('jnsjahit', TRUE);
        $mdl = $this->input->post('modeljahit', TRUE);
        $hrg = $this->input->post('harga', TRUE);
        $hargaJahit =  preg_replace("/[^0-9]/", "", $hrg);
        if($kd!="" && $jns!="" && $mdl!="" && $hargaJahit!=""){
            $this->data_model->saved('master_jahiten',[
                'kode_penjahit' => $kd,
                'jenis_jahitan' => strtoupper($jns),
                'model_jahitan' => strtoupper($mdl),
                'harga_jahitan' => $hargaJahit
                ]
            );
            echo json_encode(array("statusCode" => 200, "message" => "Data Berhasil Disimpan!"));
        } else {
            echo json_encode(array("statusCode" => 500, "message" => "Data Masih Ada Yang Kosong!"));
        }
    } //end
    function simpanProdukVarians(){
        $models = $this->input->post('models', TRUE);
        $namaProduk = $this->input->post('namaProduk', TRUE);
        $kodeProduk = $this->input->post('kodeProduk', TRUE);
        $namaProduk = strtoupper($namaProduk);
        $kodeProduk = strtoupper($kodeProduk);
        $models = strtoupper($models);
        if($models!="" && $namaProduk!="" && $kodeProduk!=""){
            if($cekModel == 0){
                $cekModel = $this->data_model->get_byid('master_produk_varians', ['kode_produk'=>$kodeProduk,'models'=>$models])->num_rows();
                $ceknumber = $this->data_model->get_byid('master_produk_varians',['kode_produk'=>$kodeProduk]);
                if($ceknumber->num_rows() == 0){
                    $kodVars = $kodeProduk."-1";
                } else {
                    $lastd = $this->db->query("SELECT * FROM master_produk_varians WHERE kode_produk='$kodeProduk' ORDER BY id_varians DESC LIMIT 1")->row("kode_varians");
                    $x = explode('-', $lastd);
                    $num = $x[1];
                    $new_num = intval($num) + 1;
                    $kodVars = $kodeProduk."-".$new_num;
                }
                $this->data_model->saved('master_produk_varians',[
                    'kode_produk' => $kodeProduk,
                    'nama_produk' => $namaProduk,
                    'models' => $models,
                    'kode_varians' => $kodVars
                ]);
                echo json_encode(array("statusCode" => 200, "message" => "Menyimpan varians produk ".$namaProduk.""));
            } else {
                echo json_encode(array("statusCode" => 500, "message" => "Model untuk produk sudah ditentukan."));
            }
        } else {
            echo json_encode(array("statusCode" => 500, "message" => "Data Masih Ada Yang Kosong!"));
        }
    }
    function simpanProduk(){
        $idProduk = $this->input->post('idProduk', TRUE);
        $namaProduk = $this->input->post('namaProduk', TRUE);
        $kodeProduk = $this->input->post('kodeProduk', TRUE);
        $namaProduk = strtoupper($namaProduk);
        $kodeProduk = strtoupper($kodeProduk);
        if($idProduk!="" && $namaProduk!="" && $kodeProduk!=""){
            if($idProduk == "0"){
                $cekNama = $this->data_model->get_byid('master_produk', ['nama_produk'=>$namaProduk])->num_rows();
                $cekKode = $this->data_model->get_byid('master_produk', ['kode_produk'=>$kodeProduk])->num_rows();
                if($cekNama == 0){
                    if($cekKode == 0){
                        $this->data_model->saved('master_produk',['kode_produk' => $kodeProduk,'nama_produk' => $namaProduk,]);
                        echo json_encode(array("statusCode" => 200, "message" => "Produk Baru Berhasil Disimpan!"));
                    } else {
                        echo json_encode(array("statusCode" => 500, "message" => "Kode Produk Sudah Digunakan!"));
                    }
                } else {
                    echo json_encode(array("statusCode" => 500, "message" => "Nama Produk Sudah Ada!"));
                }
            } else {
                $cekId = $this->data_model->get_byid('master_produk', ['id_produk'=>$idProduk])->num_rows();
                if($cekId == 1){
                    $this->data_model->updatedata('id_produk',$idProduk,'master_produk',['kode_produk' => $kodeProduk,'nama_produk' => $namaProduk,]);
                    echo json_encode(array("statusCode" => 200, "message" => "Produk Berhasil Diupdate!"));
                } else {
                    echo json_encode(array("statusCode" => 500, "message" => "Produk Tidak Ditemukan!"));
                }
            }
        } else {
            echo json_encode(array("statusCode" => 500, "message" => "Data Masih Ada Yang Kosong!"));
        }
    } //end

    function hapusDataProduk(){
        $id = $this->input->post('id', TRUE);
        $kodeProduk = $this->data_model->get_byid('master_produk', ['id_produk'=>$id])->row()->kode_produk;
        $this->data_model->delete('master_produk', 'id_produk', $id);
        $this->data_model->delete('master_produk_varians', 'kode_produk', $kodeProduk);
        echo json_encode(array("statusCode" => 200, "message" => "Data Berhasil Dihapus!"));
    } //end
    function hapusDataProdukvar(){
        $id = $this->input->post('kd', TRUE);
        $this->data_model->delete('master_produk_varians', 'kode_varians', $id);
        echo json_encode(array("statusCode" => 200, "message" => "Data Berhasil Dihapus!"));
    } //end

    function hapusDataKar(){
        $id = $this->input->post('id', TRUE);
        $this->data_model->delete('master_karyawan', 'id_karyawan', $id);
        echo json_encode(array("statusCode" => 200, "message" => "Data Berhasil Dihapus!"));
    }
    function hapusUsers(){
        $id = $this->input->post('id', TRUE);
        $this->data_model->delete('users', 'id', $id);
        echo json_encode(array("statusCode" => 200, "message" => "Data Berhasil Dihapus!"));
    } //
    function simpanpembeliankain(){
        $config['upload_path']   = './uploads/';
        $config['allowed_types'] = 'png|jpg|svg';
        $config['max_size']      = 3048; // Maksimal 3MB
        $this->load->library('upload', $config);

        if (!isset($_FILES['file']) || $_FILES['file']['error'] == 4) {
            // Jika tidak ada file diunggah, gunakan null.jpg
            $newFileName = 'null.jpg';
        } elseif (!$this->upload->do_upload('file')) {
            // Jika gagal upload, tampilkan pesan error
            echo json_encode(array("statusCode" => 500, "message" => strip_tags($this->upload->display_errors()) ));
            return;
        } else {
            $fileData = $this->upload->data();
            $newFileName = 'upload-' . date('Ymd-His') . $fileData['file_ext'];
            rename($fileData['full_path'], $fileData['file_path'] . $newFileName);
        }
        $tanggalBeli = $this->input->post('tanggalBeli', TRUE);
        $kain = $this->input->post('kain', TRUE);
        $jmlyard = $this->input->post('jmlyard', TRUE);
        $jmlyard = preg_replace('/[^0-9.]/', '', $jmlyard);
        $hargayard = $this->input->post('hargayard', TRUE);
        $hargayard = preg_replace('/[^0-9]/', '', $hargayard);
        $totalhargayard = $this->input->post('totalhargayard', TRUE);
        $totalhargayard = preg_replace('/[^0-9]/', '', $totalhargayard);
        $sup = $this->input->post('sup', TRUE);
        $pembayaran = $this->input->post('pembayaran', TRUE);
        $bea = $this->input->post('bea', TRUE);
        $bea = preg_replace('/[^0-9]/', '', $bea);
        if($bea==""){ $bea=0; }
        $codesave = $this->data_model->acakKode(21);
        if($tanggalBeli!="" AND $kain!="" AND $jmlyard!="" AND $hargayard!="" AND $totalhargayard!="" AND $sup!="" AND $pembayaran!=""){
            $this->data_model->saved('t_pembelian_kain',[
                'inisial_kain'      => $kain,
                'tgl_pembelian'     => $tanggalBeli,
                'tgl_input'         => date('Y-m-d H:i:s'),
                'jumlah_pembelian'  => $jmlyard,
                'harga_peryard'     => $hargayard,
                'harga_total_kain'  => $totalhargayard,
                'nama_supplier'     => strtoupper($sup),
                'pembayaran'        => $pembayaran,
                'bukti_tf'          => $newFileName,
                'bea_dll'           => $bea,
                'diinput'           => $this->session->userdata('username'),
                'codesave'          => $codesave
            ]);
            $total_harga_pembelian  = intval($totalhargayard) + intval($bea);
            $harga_asli_peryard     = $total_harga_pembelian / floatval($jmlyard);
            $harga_asli_peryard     = round($harga_asli_peryard);
            $codestok = $kain."-".$harga_asli_peryard;
            $this->data_model->saved('stok_kain', [
                'inisial_kain'      => $kain,
                'jumlah_stok'       => $jmlyard,
                'harga_kain_peryard'=> $harga_asli_peryard,
                'codestok'          => $codestok,
                'codesave'          => $codesave
            ]);
            //echo json_encode(array("statusCode" => 200, "message" => "Berhasil menyimpan proses pembelian kain." ));
            echo "<br>Berhasil Menyimpan <br>Please Wait... Redirecting...";
            ?><script>
            setTimeout(function() {
                window.location.href = "<?=base_url();?>pembelian-kain"; // Ganti dengan URL tujuan
            }, 1500);</script>
            <?php
        } else {
            echo json_encode(array("statusCode" => 500, "message" => "Anda harus mengisi semua data dengan benar..!!" ));
        }
    }
    function inputUang(){
        $tglMasuk            = $this->input->post('tglMasuk', TRUE);
        $inputNominalMasuk   = $this->input->post('inputNominalMasuk', TRUE);
        $inputNominalMasuk   = preg_replace('/[^0-9]/', '', $inputNominalMasuk);
        $kategoriMasuk       = $this->input->post('kategoriMasuk', TRUE);
        $keteranganMasuk     = $this->input->post('keteranganMasuk', TRUE);
        if($tglMasuk!="" AND $inputNominalMasuk!="" AND $kategoriMasuk!="" AND $keteranganMasuk!=""){
            $this->data_model->saved('a_keuangan',[
                'jenisflow' => 'in',
                'nominal'   => $inputNominalMasuk,
                'kategori'  => $kategoriMasuk,
                'keterangan'=> $keteranganMasuk,
                'tgl'       => $tglMasuk,
                'tgl_tms'   => date('Y-m-d H:i:s'),
                'adminput'  => $this->session->userdata('username')
            ]);
            echo json_encode(array("statusCode" => 200, "message" => "Berhasil menyimpan uang masuk." ));
        } else {
            echo json_encode(array("statusCode" => 500, "message" => "Data yang anda masukan tidak lengkap.!!" ));
        }
    }
    function inputGaji(){
        $perioderGaji       = $this->input->post('perioderGaji', TRUE);
        $tglPenggajian      = $this->input->post('tglPenggajian', TRUE);
        $inputNominalGaji   = $this->input->post('inputNominalGaji', TRUE);
        $inputNominalGaji   = preg_replace('/[^0-9]/', '', $inputNominalGaji);
        $namaKaryawan       = $this->input->post('namaKaryawan', TRUE);
        $metodeGaji         = $this->input->post('metodeGaji', TRUE);
        $ket                = $this->input->post('keteranganGaji', TRUE);
        $codesave           = $this->data_model->acakKode(21);
        $nama_kar           = $this->data_model->get_byid('master_karyawan', ['id_karyawan'=>$namaKaryawan])->row("nama_kar");
        if($tglPenggajian!="" AND $namaKaryawan!="" AND $metodeGaji!="" AND $inputNominalGaji>0){
            $cekGaji = $this->data_model->get_byid('a_gajikaryawan', ['id_karyawan'=>$namaKaryawan, 'tanggal_gaji'=>$tglPenggajian])->num_rows();
            if($cekGaji == 0){
                $this->data_model->saved('a_gajikaryawan',[
                    'id_karyawan'   => $namaKaryawan,
                    'periode'       => $perioderGaji=="" ? "Mingguan" : $perioderGaji,
                    'tanggal_gaji'  => $tglPenggajian,
                    'nominal'       => $inputNominalGaji,
                    'metode_gaji'   => $metodeGaji,
                    'ket'           => $ket=="" ? "null" : $ket,
                    'tglinput'      => date('Y-m-d H:i:s'),
                    'yginput'       => $this->session->userdata('username'),
                    'codesaved'     => $codesave
                ]);
                $tyx = "Pembayaran Gaji ".$nama_kar."";
                $this->data_model->saved('a_keuangan',[
                    'jenisflow' => 'out',
                    'nominal'   => $inputNominalGaji,
                    'kategori'  => 'Gaji Karyawan',
                    'keterangan'=> $tyx,
                    'tgl'       => $tglPenggajian,
                    'tgl_tms'   => date('Y-m-d H:i:s'),
                    'adminput'  => $this->session->userdata('username'),
                    'codesaved'     => $codesave
                ]);
                $xt = "Memproses gaji karyawan ".$nama_kar."";
                echo json_encode(array("statusCode" => 200, "message" => $xt));
            } else {
                $xt = "Tidak memproses gaji karyawan ".$nama_kar."";
                echo json_encode(array("statusCode" => 500, "message" => $xt));
            }
        } else {
            echo json_encode(array("statusCode" => 500, "message" => "Data yang anda masukan tidak lengkap.!!" ));
        }
    }
    function inputUangKeluar(){
        $tglMasuk            = $this->input->post('tglKeluar', TRUE);
        $inputNominalMasuk   = $this->input->post('inputNominalKeluar', TRUE);
        $inputNominalMasuk   = preg_replace('/[^0-9]/', '', $inputNominalMasuk);
        $kategoriMasuk       = $this->input->post('kategorikeluar', TRUE);
        $keteranganMasuk     = $this->input->post('keteranganKeluar', TRUE);
        if($tglMasuk!="" AND $inputNominalMasuk!="" AND $kategoriMasuk!="" AND $keteranganMasuk!=""){
            $this->data_model->saved('a_keuangan',[
                'jenisflow' => 'out',
                'nominal'   => $inputNominalMasuk,
                'kategori'  => $kategoriMasuk,
                'keterangan'=> $keteranganMasuk,
                'tgl'       => $tglMasuk,
                'tgl_tms'   => date('Y-m-d H:i:s'),
                'adminput'  => $this->session->userdata('username')
            ]);
            echo json_encode(array("statusCode" => 200, "message" => "Berhasil menyimpan pengeluaran." ));
        } else {
            echo json_encode(array("statusCode" => 500, "message" => "Data yang anda masukan tidak lengkap.!!" ));
        }
    }
    function delCashFlow(){
        $id = $this->input->post('id', TRUE);
        $getData = $this->data_model->get_byid('a_keuangan', ['iduang'=>$id])->row_array();
        $inout = $getData['jenisflow'];
        $tipes = $getData['kategori'];
        $codes = $getData['codesaved'];
        $nominal = number_format($getData['nominal']);
        if($inout == 'in'){
            $txtx = "Menghapus data pemasukan sebesar Rp. ".$nominal."";
        } else {
            $txtx = "Menghapus data pengeluaran sebesar Rp. ".$nominal."";
        }
        
        $this->data_model->delete('a_keuangan', 'iduang', $id);
        if($tipes == 'Gaji Karyawan'){
            $this->data_model->delete('a_gajikaryawan', 'codesaved', $codes);
        }
        echo json_encode(array("statusCode" => 200, "message" => $txtx ));
    }
    function delGajis(){
        $id = $this->input->post('id', TRUE);
        $getData = $this->data_model->get_byid('a_gajikaryawan', ['idgaji'=>$id])->row_array();
        $codes = $getData['codesaved'];
        $this->data_model->delete('a_gajikaryawan', 'idgaji', $id);
        $this->data_model->delete('a_keuangan', 'codesaved', $codes);
        $txtx = "Menghapus gaji karyawan";
        echo json_encode(array("statusCode" => 200, "message" => $txtx ));
    }
}
?>