<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi4 extends CI_Controller
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

    function stokkainproduksi(){
        $data = [
            'title'         => 'Data Stok Produksi',
            'sess_nama'     =>  $this->session->userdata('nama'),
            'sess_username' =>  $this->session->userdata('username'),
            'sess_akses'    =>  $this->session->userdata('akses'),
            'formatData'    => 'tables',
            'scriptForm'    => 'stokproduksi'
        ];
        $this->load->view('part/header', $data);
        $this->load->view('part/navigation', $data);
        $this->load->view('data/transaksi_stokkain4', $data);
        $this->load->view('part/main_js_tables5', $data);
    }

    function loadProduksiStok(){
        $userAkses = $this->session->userdata('akses');
        //$data = $this->data_model->sort_record('id_pjf','produksi_jahit_finish');
        $data = $this->db->query("SELECT * FROM produksi_jahit_finish WHERE status_finish='Finish' ORDER BY id_pjf DESC");
        if($data->num_rows() > 0){
            $no=1;
            foreach($data->result() as $val){
                $id             = $val->id_pjf;
                $cd             = $val->codeproduksijahit;
                $kode_babar     = $this->data_model->get_byid('produksi_jahit', ['codeproduksijhit'=>$cd])->row("kode_babar");
                $x1             = explode('-', $kode_babar);
                $idbabar        = intval($x1[1]);
                $codestok       = $val->codestok;
                $kode_varians   = $val->kode_varians;
                $ros            = $this->data_model->get_byid('master_produk_varians', ['kode_varians'=>$kode_varians])->row_array();
                $kode_produksi  = $this->db->query("SELECT * FROM stok_produk WHERE codestok='$codestok' LIMIT 1")->row("kode_produksi");
                $nama_produk    = strtolower($ros['nama_produk']);
                $model_produk   = strtolower($ros['models']);
                $terjual        = $this->data_model->get_byid('stok_produk_terjual', ['codestok'=>$codestok])->num_rows();
                $stoknow        = $this->data_model->get_byid('stok_produk', ['codestok'=>$codestok])->num_rows();
                $cct            = $this->db->query("SELECT * FROM produksi_jahit_cct WHERE id_pjf='$id' AND (status='Cacat Total' OR status='Bisa Dijual') ")->num_rows();
                $perbaikan      = $this->db->query("SELECT * FROM produksi_jahit_cct WHERE id_pjf='$id' AND (status='Bisa Diperbaiki' OR status='Telah Diperbaiki') ")->num_rows();
                ?>
                <tr>
                    <td><?=$no;?></td>
                    <td><a href="javascript:void(0);" onclick="showProduksiStok('<?=$idbabar;?>','<?=$cd;?>')" style="font-weight: bold;"><?=$kode_produksi;?></a></td>
                    <td><?=ucwords($nama_produk);?></td>
                    <td><?=ucwords($model_produk);?></td>
                    <td><?=$val->ukuran;?></td>
                    <td><?=$val->jumlah_kembali;?></td>
                    <td><?=$terjual;?></td>
                    <td>
                        <?php if($cct > 0){?>
                            <a href="javascript:void(0);" style="color:red;font-weight:bold;" onclick="showCacat('<?=$id;?>')"><?=$cct;?></a>
                        <?php } else {?>
                            <a href="javascript:void(0);" style="color:#008be3;font-weight:bold;" onclick="showCacat('<?=$id;?>')"><?=$cct;?></a>
                        <?php } ?>
                    </td>
                    <td>
                        <?php if($perbaikan > 0){?>
                            <a href="javascript:void(0);" style="color:red;font-weight:bold;" onclick="showCacat2('<?=$id;?>')"><?=$perbaikan;?></a>
                        <?php } else {?>
                            <a href="javascript:void(0);" style="color:#008be3;font-weight:bold;" onclick="showCacat2('<?=$id;?>')"><?=$perbaikan;?></a>
                        <?php } ?>
                    </td>
                    <?php if($userAkses == 'root'){ ?>
                        <td>
                        <a href="javascript:void(0);" style="color:#008be3;font-weight:bold;" onclick="updateHpp('<?=$id;?>')"><?=$stoknow;?></a>
                        </td>
                    <?php } else { ?>
                        <td><?=$stoknow;?></td>
                    <?php } ?>
                </tr>
                <?php
                $no++;
            }
        }
    }

    function updateHpp(){
        $id                 = $this->input->post('id', TRUE);
        $data               = $this->data_model->get_byid('produksi_jahit_finish', ['id_pjf'=>$id])->row_array();
        $codeProduksiJahit  = $data['codeproduksijahit'];
        $jumlah_kembali     = $data['jumlah_kembali'];
        $kode_produk        = $data['kode_produk'];
        $kode_varians       = $data['kode_varians'];
        $ukuran             = $data['ukuran'];
        $codestok           = $data['codestok'];
        $jahit              = $this->data_model->get_byid('produksi_jahit', ['codeproduksijhit'=>$codeProduksiJahit])->row_array();
        $hpp1               = $jahit['hpp1'];
        $hpp2               = $jahit['hpp2'];
        $hpp3               = $jahit['hpp3'];
        $kode_jahit         = $jahit['kode_penjahit']."-".sprintf('%03d', $jahit['id_pjhit']);
        $produk             = $this->data_model->get_byid('master_produk_varians', ['kode_varians'=>$kode_varians])->row_array();
        $showProduk         = $produk['nama_produk'].", ".$produk['models']." - ".$ukuran;
        $dataStok           = $this->data_model->get_byid('stok_produk', ['codestok'=>$codestok])->row_array();
        $harga_jual_edit1   = $dataStok['harga_jual_edit'];
        $harga_jual_edit    = number_format($dataStok['harga_jual_edit'], 0, ',', '.');
        $harga_jual         = number_format($dataStok['harga_jual'], 0, ',', '.');
        $hppProduk          = number_format($dataStok['hpp'],0,',','.');
        ?>
        <div class="form-body">
            <div class="row">
                <div class="col-md-4">
                    <label>Kode Jahit</label>
                </div>
                <div class="col-md-8 form-group">
                    <input type="text" class="form-control" name="kdjahit" id="kdjahit" value="<?=$kode_jahit;?>" readonly>
                </div>
                <div class="col-md-4">
                    <label>Produk - Ukuran</label>
                </div>
                <div class="col-md-8 form-group">
                    <input type="text" class="form-control" name="produks" id="produks" value="<?=$showProduk;?>" readonly>
                </div>
                <div class="col-md-4">
                    <label>HPP Produk</label>
                </div>
                <div class="col-md-8 form-group">
                    <input type="text" class="form-control" name="hppProduks" id="hppProduks" value="Rp. <?=$hppProduk;?>" readonly>
                </div>
                <div class="col-md-4">
                    <label>Harga Jual Produk</label>
                </div>
                <?php if($harga_jual_edit1 == 0){ ?>
                <div class="col-md-8 form-group">
                    <input type="text" class="form-control" name="hrgProduks" id="hrgProduks" oninput="formatRibuan(this)" value="<?=$harga_jual;?>">
                    <small style="color:red;">Harga jual ini adalah hitungan default dari sistem (120% dari HPP).</small>
                </div>
                <?php } else { ?>
                <div class="col-md-8 form-group">
                    <input type="text" class="form-control" name="hrgProduks" id="hrgProduks" oninput="formatRibuan(this)" value="<?=$harga_jual_edit;?>">
                    <small style="color:green;">Harga jual ini telah di edit oleh super user.</small>
                </div>
                <?php } ?>
                <input type="hidden" id="codestokEdit" value="<?=$codestok;?>">
                <input type="hidden" id="idpjfid" value="<?=$id;?>">
            </div>
        </div>
        <?php
    }
    function updateharga(){
        $codestok   = $this->input->post('codestok', TRUE);
        $hrgProduks = $this->input->post('hrgProduks', TRUE);
        $hrgProduks = preg_replace('/\D/', '', $hrgProduks);
        $idpjfid    = $this->input->post('idpjfid');
        $this->data_model->updatedata('codestok', $codestok, 'stok_produk', ['harga_jual_edit'=>$hrgProduks]);
        //$this->data_model->updatedata('id_pjdt', $id_pjdt, 't_penjualan_data', ['harga_jual'=>$hrgProduks]);
        echo "success";
    }
    function lihatCacat(){
        $id   = $this->input->post('id', TRUE);
        $tipe = $this->input->post('tipe', TRUE);
        //$data = $this->data_model->get_byid('produksi_jahit_cct', ['id_pjf'=>$id]);
        if($tipe=="one"){
            $data = $this->db->query("SELECT * FROM produksi_jahit_cct WHERE id_pjf='$id' AND (status='Cacat Total' OR status='Bisa Dijual') ");
        } else {
            $data = $this->db->query("SELECT * FROM produksi_jahit_cct WHERE id_pjf='$id' AND (status='Bisa Diperbaiki' OR status='Telah Diperbaiki') ");
        }
        if($data->num_rows() > 0){
            ?>
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($data->result() as $row) {
                        $nid = $row->id_pjfcct;
                        ?>
                        <tr>
                            <td><?=$no++;?></td>
                            <td><?=date('d M Y', strtotime($row->tgl));?></td>
                            <?php if($tipe=="one"){?>
                                <td>1</td>
                            <?php } else { ?>
                                <td><a href="javascript:void(0);" style="color:blue;" onclick="thisIdtwo('<?=$row->id_pjfcct;?>','<?=$row->status;?>')">1</a></td>
                            <?php } ?>
                            <td><?=$row->status;?></td>
                            <?php if($row->status=="Telah Diperbaiki"){?>
                                <td>Return <?=date('d M Y', strtotime($row->tgl_balik_diperbaiki));?></td>
                            <?php } else {?>
                                <td><?=$row->ket;?></td>
                            <?php } ?>
                            <td><a href="javascript:void(0);" onclick="deleteCct('<?=$nid;?>','<?=$id;?>')" style="color:red;"><i class="bi bi-trash3"></i></a></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
            <?php
        } else {
            echo "<span style='color:red;'>Tidak ada data cacat</span>";
        }
        echo "<hr>"; //'Cacat Total','Bisa Dijual','Terjual','Bisa Diperbaiki'
        if($tipe=="one"){
        ?>
        <span>Tambah Data Cacat :</span><hr>
        <div class="form-body">
            <div class="row">
                <div class="col-md-4">
                    <label>Tanggal</label>
                </div>
                <div class="col-md-8 form-group">
                    <input type="date" class="form-control" name="tglCcacat" id="tglCcacat" required>
                </div>
                <div class="col-md-4">
                    <label>Jumlah</label>
                </div>
                <div class="col-md-8 form-group">
                    <input type="number" class="form-control" name="jmlcct" id="jmlcct" placeholder="Masukan Jumlah Cacat" required>
                </div>
                <div class="col-md-4">
                    <label>Status</label>
                </div>
                <div class="col-md-8 form-group">
                    <select name="statuscct" id="statuscct" class="form-control" onchange="onchs()">
                        <option value="">-Pilih Status-</option>
                        <option value="Cacat Total">Cacat Tidak Bisa Di Perbaiki</option>
                        <option value="Bisa Dijual">Deffect Produk</option>
                        <option value="Bisa Diperbaiki">Perbaikan Produk</option>
                    </select>
                    <small id="keccts"></small>
                </div>
                <div class="col-md-4">
                    <label>Keterangan</label>
                </div>
                <div class="col-md-8 form-group">
                    <textarea name="ketcct" class="form-control" id="ketcct" placeholder="Masukan keterangan cacat"></textarea>
                </div>
            </div>
            <hr>
            <div style="width:100%;display:flex;justify-content:flex-end;">
                <button class="btn btn-primary" type="button" onclick="simpanCacat('<?=$id;?>')">Simpan</button>
            </div>
            
        </div>
        <?php } else { ?>
        <span>Retur Perbaikan :</span><br>
        <small>Note : Klik kolom jumlah pada table untuk mengembalikan produk yang telah di perbaiki.</small><hr>
        <div class="form-body">
            <input type="hidden" id="id_pjfcct2" value="0">
            <div class="row">
                <div class="col-md-4">
                    <label>Tanggal</label>
                </div>
                <div class="col-md-8 form-group">
                    <input type="date" class="form-control" name="tglCcacat5" id="tglCcacat5" disabled>
                </div>
                
            </div>
            <hr>
            <div style="width:100%;display:flex;justify-content:flex-end;">
                <button class="btn btn-primary" type="button" onclick="simpanCacatPerbaikan('<?=$id;?>')" id="btnsimpansoke" disabled>Simpan</button>
            </div>
            
        </div>
        <?php
        }
    } 
    function prosesCacat2(){
        $id         = $this->input->post('id', TRUE);
        $tglCcacat  = $this->input->post('tglCcacat', TRUE);
        $id_pjfcct2 = $this->input->post('id_pjfcct2', TRUE);
        $cek        = $this->data_model->get_byid('produksi_jahit_cct',['id_pjfcct'=>$id_pjfcct2]);
        $this->data_model->updatedata('id_pjfcct',$id_pjfcct2,'produksi_jahit_cct',['status'=>'Telah Diperbaiki','tgl_balik_diperbaiki'=>$tglCcacat]);
        $list       = $cek->row("list_data");
        $xx        = explode('|', $list);
        $this->data_model->saved('stok_produk',[
            'id_stokproduk'     => $xx[0],
            'kode_produk'       => $xx[1],
            'kode_varians'      => $xx[2],
            'ukuran'            => $xx[3],
            'hpp'               => $xx[4],
            'harga_jual'        => $xx[5],
            'codeproduksijahit' => $xx[6],
            'kode_produksi'     => $xx[7],
            'codestok'          => $xx[8],
            'harga_jual_edit'   => $xx[9],
        ]); 
    }
    function prosesCacat(){
        $id         = $this->input->post('id', TRUE);
        $tglCcacat  = $this->input->post('tglCcacat', TRUE);
        $jmlcct     = $this->input->post('jmlcct', TRUE);
        $statuscct  = $this->input->post('statuscct', TRUE);
        $ketcct     = $this->input->post('ketcct', TRUE);
        if($tglCcacat!='' && $jmlcct!='' && $statuscct!='' && $ketcct!=''){
            if(intval($jmlcct) > 0){
                $cek = $this->data_model->get_byid('produksi_jahit_finish',['id_pjf'=>$id]);
                if($cek->num_rows() == 1){
                    $codestok       = $cek->row("codestok");
                    $sisaDiGudang   = $this->data_model->get_byid('stok_produk',['codestok'=>$codestok])->num_rows();
                    if(intval($jmlcct) <= $sisaDiGudang){
                        $qry = $this->db->query("SELECT * FROM stok_produk WHERE codestok='$codestok' LIMIT $jmlcct");
                        foreach ($qry->result() as $list) { 
                            $id_stokproduk          = $list->id_stokproduk;
                            $kode_produk            = $list->kode_produk;
                            $kode_varians           = $list->kode_varians;
                            $ukuran                 = $list->ukuran;
                            $hpp                    = $list->hpp;
                            $harga_jual             = $list->harga_jual;
                            $codeproduksijahit      = $list->codeproduksijahit;
                            $kode_produksi          = $list->kode_produksi;
                            $codestok               = $list->codestok;
                            $harga_jual_edit        = $list->harga_jual_edit;
                            $list_data = $id_stokproduk."|".$kode_produk."|".$kode_varians."|".$ukuran."|".$hpp."|".$harga_jual."|".$codeproduksijahit."|".$kode_produksi."|".$codestok."|".$harga_jual_edit;
                            if($statuscct == "Cacat Total"){
                                $this->data_model->saved('produksi_jahit_cct',[
                                    'id_pjf'        => $id,
                                    'tgl'           => $tglCcacat,
                                    'tgl_input'     => date('Y-m-d H:i:s'),
                                    'user'          => $this->session->userdata('username'),
                                    'status'        => $statuscct,
                                    'ket'           => $ketcct,
                                    'list_data'     => $list_data,
                                    'codejual'      => 'null',
                                    'tgl_balik_diperbaiki' => 'null'
                                ]);
                                $txt = $jmlcct." Pcs produk di simpan di stok produk cacat tidak bisa dijual.";
                            } //jika produk cacat total
                            if($statuscct == "Bisa Dijual"){
                                $codejual = $this->data_model->acakKode(23);
                                $this->data_model->saved('produksi_jahit_cct',[
                                    'id_pjf'        => $id,
                                    'tgl'           => $tglCcacat,
                                    'tgl_input'     => date('Y-m-d H:i:s'),
                                    'user'          => $this->session->userdata('username'),
                                    'status'        => $statuscct,
                                    'ket'           => $ketcct,
                                    'list_data'     => $list_data,
                                    'codejual'      => $codejual,
                                    'tgl_balik_diperbaiki' => 'null'
                                ]);
                                $this->data_model->saved('stok_produk_cct',[
                                    'id_stokprodukreal' => $id_stokproduk,
                                    'kode_produk'       => $kode_produk,
                                    'kode_varians'      => $kode_varians,
                                    'ukuran'            => $ukuran,
                                    'hpp'               => $hpp,
                                    'harga_jual'        => $harga_jual,
                                    'codeproduksijahit' => $codeproduksijahit,
                                    'kode_produksi'     => $kode_produksi,  
                                    'codestok'          => $codestok,
                                    'harga_jual_edit'   => $harga_jual_edit,
                                    'codejual'          => $codejual,
                                    'ketcacat'          => $ketcct
                                ]);
                                $txt = $jmlcct." Pcs produk di simpan di stok produk defect.";
                            } //jika produk cacat bisa dijual defact
                            if($statuscct == "Bisa Diperbaiki"){
                                $this->data_model->saved('produksi_jahit_cct',[
                                    'id_pjf'        => $id,
                                    'tgl'           => $tglCcacat,
                                    'tgl_input'     => date('Y-m-d H:i:s'),
                                    'user'          => $this->session->userdata('username'),
                                    'status'        => $statuscct,
                                    'ket'           => $ketcct,
                                    'list_data'     => $list_data,
                                    'codejual'      => 'null',
                                    'tgl_balik_diperbaiki' => 'null'
                                ]);
                                $txt = $jmlcct." Pcs produk di kembalikan ke penjahit untuk perbaikan";
                            } //jika produk cacat total
                            $this->data_model->delete('stok_produk','id_stokproduk',$id_stokproduk);
                        } //end prulangan for
                        echo json_encode(array("statusCode" => 200, "message" => $txt));
                    } else {
                        echo json_encode(array("statusCode" => 500, "message" => "Jumlah yang anda pilih melebihi sisa stok di gudang.!"));
                    }
                } else {
                    echo json_encode(array("statusCode" => 500, "message" => "ID tidak ditemukan"));
                }
            } else {
                echo json_encode(array("statusCode" => 500, "message" => "Jumlah cacat tidak boleh kurang dari 1"));
            }
        } else {
            echo json_encode(array("statusCode" => 500, "message" => "Data belum lengkap"));
        }
    }
    function undocacat(){
        $nid = $this->input->post('nid', TRUE);
        $cek = $this->data_model->get_byid('produksi_jahit_cct',['id_pjfcct'=>$nid]);
        if($cek->num_rows() == 1){
            $_status   = $cek->row("status");
            $list_data = $cek->row("list_data");
            $codejual  = $cek->row("codejual");
            $tglbalik  = $cek->row("tgl_balik_diperbaiki");
            $xx        = explode('|', $list_data);
            if($_status == "Bisa Dijual"){
                $this->data_model->delete('stok_produk_cct','codejual',$codejual);
            }
            if($tglbalik=="null"){
                $this->data_model->saved('stok_produk',[
                    'id_stokproduk'     => $xx[0],
                    'kode_produk'       => $xx[1],
                    'kode_varians'      => $xx[2],
                    'ukuran'            => $xx[3],
                    'hpp'               => $xx[4],
                    'harga_jual'        => $xx[5],
                    'codeproduksijahit' => $xx[6],
                    'kode_produksi'     => $xx[7],
                    'codestok'          => $xx[8],
                    'harga_jual_edit'   => $xx[9],
                ]); 
            }
            $this->data_model->delete('produksi_jahit_cct','id_pjfcct',$nid);
            echo json_encode(array("statusCode" => 200, "message" => "oke"));
        } else {
            echo json_encode(array("statusCode" => 500, "message" => "Data tidak ditemukan"));
        }
    }
}
?>