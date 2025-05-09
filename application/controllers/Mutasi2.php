<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mutasi2 extends CI_Controller
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
    function returbarang(){
        $data = [
            'title'         => 'Data Retur Produk',
            'sess_nama'     =>  $this->session->userdata('nama'),
            'sess_username' =>  $this->session->userdata('username'),
            'sess_akses'    =>  $this->session->userdata('akses'),
            'formatData'    => 'tables',
            'scriptForm'    => 'retur',
            'autoComplete'  => 'yes',
            'codejual'      => $this->data_model->acakKode(27)
        ];
        $this->load->view('part/header', $data);
        $this->load->view('part/navigation', $data);
        $this->load->view('mutasi/data_retur', $data);
        $this->load->view('part/main_js_retur', $data);
        
    } //end of function returbarang
    function returbarangv2(){
        $data = [
            'title'         => 'Data Retur Produk',
            'sess_nama'     =>  $this->session->userdata('nama'),
            'sess_username' =>  $this->session->userdata('username'),
            'sess_akses'    =>  $this->session->userdata('akses'),
            'formatData'    => 'tables',
            'scriptForm'    => 'retur',
            'autoComplete'  => 'yes',
            'codejual'      => $this->data_model->acakKode(27)
        ];
        $this->load->view('part/header', $data);
        $this->load->view('part/navigation', $data);
        $this->load->view('mutasi/data_returv2', $data);
        $this->load->view('part/main_js_retur', $data);
        
    } //end of function returbarang
    function cariNomorInv(){
        $nomorInv   = $this->input->post('nomorInv', TRUE);
        $x          = explode('/', $nomorInv);
        $tahun      = $x[1];
        $num        = intval($x[2]);
        $nomorInv2  = strtoupper($nomorInv);
        $nomorInv3  = "INV/".$tahun."/".sprintf("%04d", $num);
        if($tahun == "2025"){
            $cekInv     = $this->data_model->get_byid('t_penjualan', ['id_jual'=>$num]);
        } else {
            $cekInv     = $this->data_model->get_byid('t_penjualan', ['no_inv'=>$num]);
        }
        if($cekInv->num_rows() == 0){
            echo json_encode(array("statusCode" => 400, "message" => "Nomor invoice tidak ditemukan."));
        } else {
            if($cekInv->num_rows() == 1){
                $id_penjualan = $cekInv->row("id_jual");
                $codejual     = $cekInv->row("codejual");
                $statusKirim  = $cekInv->row("status_pengiriman");
                $namaCus      = $cekInv->row("nama_customer");
                echo json_encode(array("statusCode" => 200, "message" => "Success", "nomorInv" => $nomorInv3, "id_jual" => $id_penjualan, "codejual"=>$codejual, "statusKirim"=>$statusKirim, "namaCus"=>$namaCus));
            } else {
                echo json_encode(array("statusCode" => 400, "message" => "Error Code : 192"));
            }
        }
        
    } //end of function cariNomorInv
    function showCodeJual(){
        $codejual       = $this->input->post('codejual', TRUE);
        $cekInv         = $this->input->post('inv', TRUE);
        $cekCodeJual    = $this->data_model->get_byid('t_penjualan_data', ['codejual'=>$codejual]);
        if($cekCodeJual->num_rows() > 0){
            $no = 1;
            ?>
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>NAMA PRODUK</th>
                        <th>JUMLAH KIRIM</th>
                        <th>JUMLAH RETUR</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $totalKirim = 0;
                    foreach($cekCodeJual->result() as $val){ 
                    $x   = $val->kodevarians;
                    $_id = $val->id_pjdt;
                    $t   = $this->data_model->get_byid('master_produk_varians', ['kode_varians'=>$x])->row_array();
                    ?>
                    <tr>
                        <td><?=$no++;?></td>
                        <td><?=$t['nama_produk'].", ".$t['models'].", ".$val->ukuran;?></td>
                        <td><?=$val->jumlah_terjual;?>
                            <input type="hidden" name="idpjdt[]" value="<?=$_id;?>">
                            <input type="hidden" name="jmlTerjual[]" value="<?=$val->jumlah_terjual;?>">
                        </td>
                        <td><input type="number" oninput="hitungTotalRetur()" class="jmlRetur" value="0" name="jmlretur[]" min="0" max="<?=$val->jumlah_terjual;?>" style="border:none;outline:none;background:tranparent;" oninput="validateInput(this)"></td>
                    </tr>
                    <?php $totalKirim+=$val->jumlah_terjual;
                    } ?>
                    <tr>
                        <th colspan="2">Total</th>
                        <th><input type="hidden" id="jmlTotalKirim" name="jmlTotalKirim" value="<?=$totalKirim;?>"><?=$totalKirim;?></th>
                        <th><input type="text" id="totalReturs" name="totalReturs" readonly value="0" style="border:none;outline:none;background:tranparent;"></th>
                    </tr>
                </tbody>
            </table>
            <div style="width:100%;">
                <div class="row">
                    <div class="col-md-4">
                        <label>Tanggal Retur</label>
                    </div>
                    <div class="col-md-8 form-group">
                        <input type="date" class="form-control" name="tglRetur" id="tglRetur">
                    </div>
                    <div class="col-md-4">
                        <label>Alasan Retur</label>
                    </div>
                    <div class="col-md-8 form-group">
                        <textarea name="alasanRetur" id="alasanRetur" class="form-control" placeholder="Masukan alasan retur"></textarea>
                    </div>
                    <div class="col-md-4">
                        <label>Produk Retur</label>
                    </div>
                    <div class="col-md-8 form-group">
                        <select name="produkRetur" id="produkRetur" class="form-control" onchange="thisKondisi(this.value)">
                            <option value="">Pilih Kondisi Produk</option>
                            <option value="Cacat">Cacat Permanent</option>
                            <option value="Defect">Defect</option>
                            <option value="ORI">ORI</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Ganti Produk Otomatis</label>
                    </div>
                    <div class="col-md-8 form-group">
                        <select name="autoGanti" id="autoGanti" class="form-control" onchange="thisautoGanti(this.value)">
                            <option value="">Pilih </option>
                            <option value="tidak">Tidak</option>
                            <option value="ya">Ya</option>
                        </select>
                        <small id="tesSmall"></small>
                    </div>
                </div>
            </div>
            
            <?php
        } else {
            echo "<font style='color:red;'>".$codejual."</font>";
        }
    } //end function showCodeJual

    function simpanProsesRetur(){
        $codejual       = $this->input->post('codejual', TRUE);
        $inv            = $this->input->post('inv', TRUE);
        $jmlRetur       = $this->input->post('jmlRetur', TRUE);
        $jmlKirim       = $this->input->post('jmlKirim', TRUE);
        $jmlTerjualAr   = $this->input->post('jmlTerjualAr', TRUE);
        $jmlReturAr     = $this->input->post('jmlReturAr', TRUE);
        $idpjdtAr       = $this->input->post('idpjdtAr', TRUE);
        $tglRetur       = $this->input->post('tglRetur', TRUE);
        $alasanRetur    = $this->input->post('alasanRetur', TRUE);
        $produkRetur    = $this->input->post('produkRetur', TRUE);
        $autoGanti      = $this->input->post('autoGanti', TRUE);
        $codeRetur      = $this->data_model->acakKode(23);
        $usernama       = $this->session->userdata('username');
        $cekIdJual      = $this->data_model->get_byid('t_penjualan', ['codejual'=>$codejual]);
        if($cekIdJual->num_rows() == 1){
            $id_jual    = $cekIdJual->row('id_jual');
            if(intval($jmlRetur) > 0 && intval($jmlRetur) <= intval($jmlKirim)){
                $this->data_model->saved('t_penjualan_retur',[
                    'id_jual'     => $id_jual,
                    'coderetur'   => $codeRetur,
                    'alasan'      => $alasanRetur,
                    'kondisi'     => $produkRetur,
                    'ganti'       => $autoGanti,
                    'users'       => $usernama,
                    'tgl_tms'     => date('Y-m-d H:i:s'),
                    'tgl_retur'   => $tglRetur
                ]);
                for ($i=0; $i <count($idpjdtAr) ; $i++) { 
                    $isID           = $idpjdtAr[$i];
                    $isJmlRetur     = $jmlReturAr[$i];
                    $isJmlTerjual   = $jmlTerjualAr[$i];
                    $isJmlNow       = intval($isJmlTerjual) - intval($isJmlRetur);
                    $isBarang       = $this->data_model->get_byid('t_penjualan_data', ['id_pjdt'=>$isID])->row_array();
                    $kodeVarians    = $isBarang['kodevarians'];
                    $ukuran         = $isBarang['ukuran'];
                    $qry            = $this->db->query("SELECT * FROM stok_produk_terjual WHERE kode_varians='$kodeVarians' AND ukuran='$ukuran' AND codejual='$codejual' LIMIT $isJmlRetur ")->result();
                    $all_id         = array();
                    $this->data_model->saved('t_penjualan_retur_dt',['id_pjdt'=>$isID,'coderetur'=>$codeRetur,'jml_retur'=>$isJmlRetur]);
                    foreach ($qry as $key => $value) {
                        $id_stokproduk      = $value->id_stokproduk;
                        $all_id[]           = "'".$id_stokproduk."'";
                        $kode_produk        = $value->kode_produk;
                        $kode_varians       = $value->kode_varians;
                        $ukuran             = $value->ukuran;
                        $hpp                = $value->hpp;
                        $harga_jual         = $value->harga_jual;
                        $codeproduksijahit  = $value->codeproduksijahit;
                        $kode_produksi      = $value->kode_produksi;
                        $codestok           = $value->codestok;
                        $harga_jual_edit    = $this->data_model->get_byid('stok_produk', ['codestok'=>$codestok])->row('harga_jual_edit');
                        $list_data          = $id_stokproduk."|".$kode_produk."|".$kode_varians."|".$ukuran."|".$hpp."|".$harga_jual."|".$codeproduksijahit."|".$kode_produksi."|".$codestok."|".$harga_jual_edit;
                        if($produkRetur=="ORI"){
                            $this->data_model->saved('stok_produk', [
                                'id_stokproduk'     => $id_stokproduk,
                                'kode_produk'       => $kode_produk,
                                'kode_varians'      => $kode_varians,
                                'ukuran'            => $ukuran,
                                'hpp'               => $hpp,
                                'harga_jual'        => $harga_jual,
                                'codeproduksijahit' => $codeproduksijahit,
                                'kode_produksi'     => $kode_produksi,
                                'codestok'          => $codestok,
                                'harga_jual_edit'   => $harga_jual_edit
                            ]);
                        } elseif($produkRetur=="Defect"){
                            $this->data_model->saved('stok_produk_cct', [
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
                                'ketcacat'          => $alasanRetur
                            ]);
                            $id_pjf = $this->data_model->get_byid('produksi_jahit_finish',['codestok'=>$codestok])->row("id_pjf");
                            $this->data_model->saved('produksi_jahit_cct',[
                                'id_pjf'        => $id_pjf,
                                'tgl'           => $tglRetur,
                                'tgl_input'     => date('Y-m-d H:i:s'),
                                'user'          => $usernama,
                                'status'        => 'Bisa Dijual',
                                'ket'           => $alasanRetur,
                                'list_data'     => $list_data,
                                'codejual'      => $codejual,
                                'tgl_balik_diperbaiki' => 'null'
                            ]);
                        } else {
                            $id_pjf = $this->data_model->get_byid('produksi_jahit_finish',['codestok'=>$codestok])->row("id_pjf");
                            $this->data_model->saved('produksi_jahit_cct',[
                                'id_pjf'        => $id_pjf,
                                'tgl'           => $tglRetur,
                                'tgl_input'     => date('Y-m-d H:i:s'),
                                'user'          => $usernama,
                                'status'        => 'Cacat Total',
                                'ket'           => $alasanRetur,
                                'list_data'     => $list_data,
                                'codejual'      => $codejual,
                                'tgl_balik_diperbaiki' => 'null'
                            ]);
                        }
                        $this->data_model->delete('stok_produk_terjual', 'id_stokproduk', $id_stokproduk);
                    } //end Foreach
                    $all_id2 = implode(",", $all_id);
                    $this->data_model->saved();
                    // update data penjualan
                    if($autoGanti=="tidak"){
                        $this->data_model->updatedata('id_pjdt',$isID,'t_penjualan_data', ['jumlah_terjual'=>$isJmlNow]);
                    } else {
                        $qry = $this->db->query("SELECT * FROM stok_produk WHERE id_stokproduk NOT IN ($all_id2) AND kode_varians='$kodeVarians' AND ukuran='$ukuran' ORDER BY id_stokproduk LIMIT $isJmlRetur ")->result();
                        foreach($qry as $val){
                            $id_stokproduk      = $val->id_stokproduk;
                            $kode_produk        = $val->kode_produk;
                            $kode_varians       = $val->kode_varians;
                            $ukuran             = $val->ukuran;
                            $hpp                = $val->hpp;
                            $harga_jual         = $val->harga_jual;
                            $codeproduksijahit  = $val->codeproduksijahit;
                            $kode_produksi      = $val->kode_produksi;
                            $codestok           = $val->codestok;
                            $harga_jual_edit    = $val->harga_jual_edit;
                            if($harga_jual_edit==0){
                                $harga_jual_asli= $harga_jual;
                            } else {
                                $harga_jual_asli= $harga_jual_edit;
                            }
                            $this->data_model->saved('stok_produk_terjual', [
                                'id_stokproduk'     => $id_stokproduk,
                                'kode_produk'       => $kode_produk,
                                'kode_varians'      => $kode_varians,
                                'ukuran'            => $ukuran,
                                'hpp'               => $hpp,
                                'harga_jual'        => $harga_jual_asli,
                                'codeproduksijahit' => $codeproduksijahit,
                                'kode_produksi'     => $kode_produksi,
                                'codestok'          => $codestok,
                                'codejual'          => $codejual
                            ]);
                            $this->db->query("DELETE FROM stok_produk WHERE id_stokproduk='$id_stokproduk'");
                        } //end foreach
                    }
                    
                } //end for perulangan array dari form penjualan keluar
                if($autoGanti=="tidak"){
                    $produkTerjual = $this->db->query("SELECT codejual,jumlah_terjual,harga_jual FROM t_penjualan_data WHERE codejual='$codejual'")->result();
                    $totalHarga = 0;
                    foreach($produkTerjual as $val){
                        $jmlTerjual = $val->jumlah_terjual;
                        $hrgTerjual = $val->harga_jual;
                        $thisHarga  = $jmlTerjual * $hrgTerjual;
                        $totalHarga+= $thisHarga;
                    }
                    $cekTotalBayar = $this->data_model->get_byid('t_penjualan',['codejual'=>$codejual])->row("total_dibayar");
                    $this->data_model->updatedata('codejual',$codejual,'t_penjualan',['harga_totalproduk'=>$totalHarga]);
                    if($cekTotalBayar > $totalHarga){
                        $this->data_model->saved('notif',[
                            'jenis'     => 'Notifikasi',
                            'txtnotif'  => ''.$inv.' - Total dibayar melebihi total penjualan.',
                            'tms'       => date('Y-m-d H:i:s'),
                            'readsts'   => 'n'
                        ]);
                    }
                }
                echo json_encode(array("statusCode" => 200, "message" => "Berhasil menyimpan data retur."));
            } else {
                echo json_encode(array("statusCode" => 400, "message" => "Jumlah retur melebihi jumlah kirim."));
            }
        } else {
            echo json_encode(array("statusCode" => 400, "message" => "Invoice tidak ditemukan.!!"));
        }
        
    } //end function simpanProsesRetur

    function dataRetur(){
        $urlAktif = $this->input->post('urlAktif');
        $x2       = explode('/', $urlAktif);
        $terakhir = end($x2);
        if($terakhir=="retur-produk"){
            $dt       = $this->data_model->sort_record('tgl_retur', 'view_produk_retur');
            if($dt->num_rows() > 0){
                foreach($dt->result() as $val){
                    //$id_jual    = $val->id_jual;
                    $coderetur  = $val->coderetur;
                    $alasan     = strtolower($val->alasan);
                    $kondisi    = $val->kondisi;
                    $ganti      = $val->ganti;
                    $jmlRetur   = $val->jml_retur;
                    $produk     = $val->nama_produk.", ".$val->models." (".$val->ukuran.")";
                    $tgl        = date('d M Y', strtotime($val->tgl_retur));
                    //$dtjual     = $this->data_model->get_byid('t_penjualan', ['id_jual'=>$id_jual])->row_array();
                    //$x          = explode('-', $dtjual['tgl_jual']);
                    //$jmlRetur   = $this->db->query("SELECT SUM(jml_retur) AS jml FROM t_penjualan_retur_dt WHERE coderetur='$coderetur'")->row()->jml;
                    
                    ?>
                    <tr>
                        <td><?=$tgl;?></td>
                        <td><?=$produk;?></td>
                        <td><span class="badge bg-success" style="cursor:pointer;"><?=$jmlRetur;?></span></td>
                        <td><?=ucwords($alasan);?></td>
                        <td>
                            <?php
                            if($kondisi=="ORI"){
                                echo "<font style='color:green;'>Baik, Kembali ke gudang</font>";
                            } else {
                                if($kondisi=="Cacat"){
                                    echo "<font style='color:red;'>Cacat Permanent</font>";
                                } else {
                                    echo "<font style='color:orange;'>Defect</font>";
                                }
                            }
                            ?>
                        </td>
                        <td><?=$ganti=='ya'? '<font style="color:green;">Ya</font>' : 'Tidak';?></td>
                        <td><a href="#" title="Batalkan Retur"><i class="bi bi-recycle" style="color:red;"></i></a></td>
                    </tr>
                    <?php
                }
            }
        } else { //tampilan retur awal
            $dt       = $this->data_model->sort_record('id_pjrtr', 't_penjualan_retur');
            if($dt->num_rows() > 0){
                foreach($dt->result() as $val){
                    $id_jual    = $val->id_jual;
                    $coderetur  = $val->coderetur;
                    $alasan     = strtolower($val->alasan);
                    $kondisi    = $val->kondisi;
                    $ganti      = $val->ganti;
                    $tgl        = date('d M Y', strtotime($val->tgl_retur));
                    $dtjual     = $this->data_model->get_byid('t_penjualan', ['id_jual'=>$id_jual])->row_array();
                    $x          = explode('-', $dtjual['tgl_jual']);
                    $jmlRetur   = $this->db->query("SELECT SUM(jml_retur) AS jml FROM t_penjualan_retur_dt WHERE coderetur='$coderetur'")->row()->jml;
                    if($x[0] == "2025"){
                        $no_inv = "INV/2025/".sprintf("%04d", $dtjual['id_jual']);
                    } else {
                        $no_inv = "INV/".$x[0]."/".sprintf("%04d", $dtjual['no_inv']);
                    }
                    ?>
                    <tr>
                        <td><?=$no_inv;?></td>
                        <td><?=$tgl;?></td>
                        <td><span class="badge bg-success" style="cursor:pointer;" onclick="detailRetur('<?=$coderetur;?>')"><?=$jmlRetur;?></span></td>
                        <td><?=ucwords($alasan);?></td>
                        <td>
                            <?php
                            if($kondisi=="ORI"){
                                echo "<font style='color:green;'>Baik, Kembali ke gudang</font>";
                            } else {
                                if($kondisi=="Cacat"){
                                    echo "<font style='color:red;'>Cacat Permanent</font>";
                                } else {
                                    echo "<font style='color:orange;'>Defect</font>";
                                }
                            }
                            ?>
                        </td>
                        <td><?=$ganti=='ya'? '<font style="color:green;">Ya</font>' : 'Tidak';?></td>
                        <td><a href="#" title="Batalkan Retur"><i class="bi bi-recycle" style="color:red;"></i></a></td>
                    </tr>
                    <?php
                }
            }
        }
    } //end function dataRetur
    function showDetailRetur(){
        $kodeRetur  = $this->input->post('kd', TRUE);
        $cek        = $this->data_model->get_byid('t_penjualan_retur_dt', ['coderetur'=>$kodeRetur]);
        if($cek->num_rows() > 0){
            ?>
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Produk</th>
                        <th>Ukuran</th>
                        <th>Retur</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($cek->result() as $k => $val){
                        $cd     = $val->id_pjdt;
                        $vars   = $this->data_model->get_byid('t_penjualan_data',['id_pjdt'=>$cd])->row_array();
                        $cdvars = $vars['kodevarians'];
                        $ukur   = $vars['ukuran'];
                        $pd     = $this->data_model->get_byid('master_produk_varians', ['kode_varians'=>$cdvars])->row_array();
                        ?>
                        <tr>
                            <td><?=$k+1;?></td>
                            <td><?=$pd['nama_produk'].", ".$pd['models']."";?></td>
                            <td><?=$ukur;?></td>
                            <td><?=$val->jml_retur;?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
            <?php
        } else {
            echo "Token Error...";
        }
    }
}