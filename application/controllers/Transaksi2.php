<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi2 extends CI_Controller
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
    function produksi1(){
        $kodekain = $this->db->query("SELECT id_k_ptgan,inisial_kain,panjang_kain,id_tptg,jumlah_pcs FROM view_potongan_kain WHERE jumlah_pcs > 0");
        $ar = array();
        foreach($kodekain->result() as $val){
            $a = $val->inisial_kain;
            $b = $val->panjang_kain;
            $c = sprintf('%03d', $val->id_tptg);
            $d = '"'.$a.'-'.$b.'-'.$c.'"';
            if(in_array($d, $ar)){} else { $ar[]=$d; }
        }
        $im = implode(',', $ar);
        $data = [
            'title'         => 'Persiapan Produksi Batik',
            'sess_nama'     =>  $this->session->userdata('nama'),
            'sess_username' =>  $this->session->userdata('username'),
            'sess_akses'    =>  $this->session->userdata('akses'),
            'formatData'    => 'tables',
            'scriptForm'    => 'produksi1',
            'autoComplete'  => 'yes',
            'dataAuto'      => $im,
            'babar'         => $this->data_model->get_record('master_pembatik'),
            'babar2'         => $this->data_model->get_record('master_babar')
        ];
        $this->load->view('part/header', $data);
        $this->load->view('part/navigation', $data);
        $this->load->view('data/produksi_awal', $data);
        $this->load->view('part/main_js_tables4', $data);
        
    }
    function produksi2(){
        $kodekain = $this->db->query("SELECT * FROM `stok_kain_proses_babar` WHERE jumlah_pcs > 0");
        $ar = array();
        foreach($kodekain->result() as $val){
            $a = $val->kode_babar;
            $d = '"'.$a.'"';
            if(in_array($d, $ar)){} else { $ar[]=$d; }
        }
        $im = implode(',', $ar);
        $data = [
            'title'         => 'Produksi Jahit',
            'sess_nama'     =>  $this->session->userdata('nama'),
            'sess_username' =>  $this->session->userdata('username'),
            'sess_akses'    =>  $this->session->userdata('akses'),
            'formatData'    => 'tables',
            'scriptForm'    => 'produksi2',
            'autoComplete'  => 'yes',
            'dataAuto'      => $im,
            'jahit'         => $this->data_model->get_record('master_penjahit'),
            'produks'       => $this->data_model->get_record('master_produk')
        ];
        $this->load->view('part/header', $data);
        $this->load->view('part/navigation', $data);
        $this->load->view('data/produksi_jahit', $data);
        $this->load->view('part/main_js_tables4', $data);
        
    }
    function lihatstokptg(){
            $selection = $this->input->post('selection', TRUE);
            $x= explode('-', $selection);
            $inisial = $x[0];
            $pjg = $x[1];
            $idptg = intval($x[2]);
            $cek = $this->data_model->get_byid('view_potongan_kain',['inisial_kain'=>$inisial, 'panjang_kain'=>$pjg, 'id_tptg'=>$idptg]);
            if($cek->num_rows() == 1){
                $jmlStok = $cek->row("jumlah_pcs");
                $id      = $cek->row("id_k_ptgan");
                echo json_encode(array("statusCode" => 200, "stok" => $jmlStok, "id" => $id));
            } else {
                echo json_encode(array("statusCode" => 500, "message" => "Data Tidak ditemukan!!"));
            }
    }
    public function get_harga() {
        $kode_penjahit  = $this->input->post('kode_penjahit');
        $data           = $this->data_model->get_harga_by_penjahit($kode_penjahit);
        echo json_encode($data);
    }
    public function get_harga2() {
        $idmsj = $this->input->post('idmsj');
        $data  = $this->data_model->get_byid('master_jahiten',['id_msj'=>$idmsj])->row_array();
        $harga = $data['harga_jahitan'];
        echo json_encode(array("statusCode" => 200, "harga" => $harga));
    }
    function lihatstokbabar(){
        $selection = $this->input->post('selection', TRUE);
            $cek = $this->data_model->get_byid('stok_kain_proses_babar',['kode_babar'=>$selection]);
            if($cek->num_rows() > 0){
                $jmlStok = $this->db->query("SELECT SUM(jumlah_pcs) AS jml FROM stok_kain_proses_babar WHERE kode_babar='$selection'")->row()->jml;
                $id      = $this->db->query("SELECT * FROM stok_kain_proses_babar WHERE kode_babar='$selection' LIMIT 1")->row_array();
                $codeProduksi = $id['codeproduksi'];
                $kode_kain = $id['kode_kain'];
                $proses = $id['proses_babar'];
                $hpp1 = $id['hpp1'];
                $hpp2 = $id['hpp2'];
                echo json_encode(array("statusCode" => 200, "stok" => $jmlStok, "codeproduksi" => $codeProduksi, "kode_kain" => $kode_kain, "proses_babar" => $proses, "hpp1" => $hpp1, "hpp2" => $hpp2));
            } else {
                echo json_encode(array("statusCode" => 500, "message" => "Kode Babar Tidak ditemukan!!"));
            }
    }

    function saveProsesBatik(){
        $kodekain    = $this->input->post('autoComplete', TRUE);
        $id_stokkain = $this->input->post('stokkainid', TRUE);
        $jmlKirim    = $this->input->post('jmlKirim', TRUE);
        $pembatik    = $this->input->post('pembatik', TRUE);
        $tglKirim    = $this->input->post('tglKirim', TRUE);
        $jnsBabar    = $this->input->post('jnsBabar', TRUE);
        $hargpcs     = $this->input->post('hargpcs', TRUE);
        $hargttl     = $this->input->post('hargttl', TRUE);
        $acakKode    = $this->data_model->acakKode(19);
        if($kodekain!="" AND $id_stokkain!="" AND $jmlKirim!="" AND $pembatik!="" AND $tglKirim!="" AND $jnsBabar!="" AND $hargpcs!="" AND $hargttl!=""){
            $cekStok = $this->data_model->get_byid('stok_kain_potongan',['id_k_ptgan'=>$id_stokkain])->row("jumlah_pcs");
            $newStok = intval($cekStok) - $jmlKirim;
            if($jmlKirim>0 AND $jmlKirim <= intval($cekStok)){
                $this->data_model->saved('produksi_babar',[
                    'kode_kain'     => $kodekain,
                    'id_pot_kain'   => $id_stokkain,
                    'jumlah_kirim'  => $jmlKirim,
                    'kode_pembatik' => $pembatik,
                    'tgl_kirim'     => $tglKirim,
                    'tgl_input'     => date('Y-m-d H:i:s'),
                    'proses_babar'  => $jnsBabar,
                    'harga_pcs'     => preg_replace("/[^0-9]/", "", $hargpcs),
                    'harga_ttl'     => preg_replace("/[^0-9]/", "", $hargttl),
                    'diinputoleh'   => $this->session->userdata('username'),
                    'codeproduksi'  => $acakKode
                ]);
                $cekprosesBabar = $this->data_model->get_byid('master_babar',['jenis_babaran'=>strtoupper($jnsBabar)]);
                if($cekprosesBabar->num_rows() == 0){$this->data_model->saved('master_babar',['jenis_babaran'=>strtoupper($jnsBabar)]); }
                $this->data_model->updatedata('id_k_ptgan',$id_stokkain,'stok_kain_potongan',['jumlah_pcs'=>$newStok]);
                echo json_encode(array("statusCode" => 200, "message" => "Menyimpan proses babar."));
            } else {    
                echo json_encode(array("statusCode" => 500, "message" => "Jumlah Stok Tidak Mencukupi."));
            }
        } else {
            echo json_encode(array("statusCode" => 500, "message" => "Anda tidak mengisi data dengan benar.!!"));
        }
    } //END
    function loadProsesJahit(){
        $table = $this->data_model->sort_record('id_pjhit','produksi_jahit');
        if($table->num_rows() > 0){
            $no=1;
            foreach($table->result() as $val){
                $id         = $val->id_pjhit;
                $id_msj     = $val->kode_msj;
                $kd         = $val->kode_penjahit;
                $nm         = $this->data_model->get_byid('master_penjahit',['kode_penjahit'=>$kd])->row("nama_penjahit");
                $msj        = $this->data_model->get_byid('master_jahiten',['id_msj'=>$id_msj])->row_array();
                //$jahit      = $msj['jenis_jahitan']." - ".$msj['model_jahitan'];
                $kode_jahit = $kd."-".sprintf('%03d', $id);
                $kode_kain  = $val->kode_kain;
                $kode_babar = $val->kode_babar;
                $xx         = explode('-', $kode_babar);
                $idbabar    = intval($xx[1]);
                $jumlah_krm = $val->jumlah_kirim;
                $cd         = $val->codeproduksijhit;
                $tgl_kirim  = date('d M Y', strtotime($val->tanggal_jahit));
                $cekFns     = $this->db->query("SELECT SUM(jumlah_kembali) AS jml FROM produksi_jahit_finish WHERE codeproduksijahit='$cd'")->row("jml");
                $sisadata   = $jumlah_krm - $cekFns;
                echo "<tr>";
                echo "<td>".$no."</td>";
                ?>
                <td>
                    <?php if($val->foto_produksi!="null"){?>
                    <a href="<?=base_url('uploads/'.$val->foto_produksi);?>" target="_blank">
                    <img src="<?=base_url('uploads/'.$val->foto_produksi);?>" alt="Foto Produksi <?=$kode_jahit;?>" style="width:100px;"></a>
                    <?php } else { ?>
                    <a href="javascript:void(0)" style="color:blue;" onclick="uploadFotoProduksi('<?=$id;?>','<?=$kode_jahit;?>')">Upload Foto</a>
                    <?php } ?>
                </td>
                <td>
                    <a href="javascript:void(0);" onclick="showBabarPlusJahit('<?=$idbabar;?>','<?=$cd;?>')">
                        <span class="badge bg-danger"><?=$kode_jahit;?></span>
                    </a>
                </td>
                <?php
                echo "<td>".$nm."</td>";
                echo "<td>".$tgl_kirim."</td>";
                echo "<td>".$msj['jenis_jahitan']."</td>";
                echo "<td>".$msj['model_jahitan']."</td>";
                echo "<td style='text-align:center;'>".$jumlah_krm."</td>";
                echo "<td style='text-align:center;'>".$sisadata."</td>";
                ?>
                <td>
                    <a href="javascript:void(0);" onclick="selesaiJahit('<?=$cd;?>','<?=$kode_jahit;?>')">
                        <?php if($cekFns == $jumlah_krm){ ?>
                        <span class="badge bg-success">Selesai</span>
                        <?php } else { ?>
                        <span class="badge bg-secondary">Proses</span>
                        <?php } ?>
                    </a>
                </td>
                <?php
                echo "</tr>";
                $no++;
            }
        }
    }
    function loadProsesBabar(){
        $table = $this->data_model->sort_record('id_produksi','produksi_babar');
        if($table->num_rows() > 0){
            $no=1;
            foreach($table->result() as $val){
                $id         = $val->id_produksi;
                $kd         = $val->kode_pembatik;
                $kode_babar = $kd."-".sprintf('%03d', $id);
                $kode_kain  = $val->kode_kain;
                $jumlah_krm = $val->jumlah_kirim;
                $cd         = $val->codeproduksi;
                $tgl_kirim  = date('d M Y', strtotime($val->tgl_kirim));
                $cekFns     = $this->db->query("SELECT SUM(jumlah_pcs) AS jml FROM produksi_babar_fns WHERE codeproduksi='$cd'")->row("jml");
                echo "<tr>";
                echo "<td>".$no."</td>";
                ?>
                <td>
                    <?php if($val->foto_produksi!="null"){?>
                    <a href="<?=base_url('uploads/'.$val->foto_produksi);?>" target="_blank">
                    <img src="<?=base_url('uploads/'.$val->foto_produksi);?>" alt="Foto Produksi <?=$kode_babar;?>" style="width:100px;"></a>
                    <?php } else { ?>
                    <a href="javascript:void(0)" style="color:blue;" onclick="uploadFotoProduksi('<?=$id;?>','<?=$kode_babar;?>')">Upload Foto</a>
                    <?php } ?>
                </td>
                <td>
                    <a href="javascript:void(0);" onclick="showBabar('<?=$id;?>')">
                        <span class="badge bg-danger"><?=$kode_babar;?></span>
                    </a>
                </td>
                <?php
                //echo "<td><span>".$kode_babar."</td>";
                echo "<td>".$kode_kain."</td>";
                echo "<td>".$tgl_kirim."</td>";
                echo "<td>".$jumlah_krm."</td>";
                if(intval($cekFns) > 0){
                    ?><td><a href="javascript:void(0);" style="color:#0251a1;" onclick="showBabarFns('<?=$cd;?>','<?=$kode_babar;?>')"><?=$cekFns;?></a></td><?php
                } else {
                    ?><td><a href="javascript:void(0);" style="color:#000;" onclick="showBabarFns('<?=$cd;?>','<?=$kode_babar;?>')">0</a></td><?php
                }
                if(intval($cekFns) == intval($jumlah_krm)){
                    echo '<td><span class="badge bg-success">Selesai</span></td>';
                } else {
                    echo '<td><span class="badge bg-secondary">Proses</span></td>';
                }
                echo "</tr>";
                $no++;
            }
        }
    }
    function detilProsesBabar(){
        $id         = $this->input->post('id', TRUE);
        $userAkses  = $this->session->userdata('akses');
        $cek        = $this->data_model->get_byid('produksi_babar',['id_produksi'=>$id]);
        if($cek->num_rows() == 1){
            $val            = $cek->row_array();
            $fotop          = $val['foto_produksi'];
            $id2            = $val['id_produksi'];
            $id_pot         = $val['id_pot_kain'];
            $kd             = $val['kode_pembatik'];
            $jml_kirim      = $val['jumlah_kirim'];
            $tgl_kirim      = $val['tgl_kirim'];
            $proses_babar   = $val['proses_babar'];
            $harga_pcs      = $val['harga_pcs'];
            $harga_ttl      = $val['harga_ttl'];
            $diinputoleh    = $val['diinputoleh'];
            $tgl_input      = $val['tgl_input'];
            $px1            = explode(' ', $tgl_input);
            $tpx1           = date('d M Y', strtotime($px1[0]));
            $codeproduksi   = $val['codeproduksi'];
            $nm             = strtolower($this->data_model->get_byid('master_pembatik',['kode_pembatik'=>$kd])->row("nama_pembatik"));
            $kode_babar     = $kd."-".sprintf('%03d', $id2);
            $kode_kain      = $val['kode_kain'];
            $x              = explode('-', $kode_kain);
            $inisial        = $x[0];
            $kain           = $this->data_model->get_byid('master_kain',['inisial'=>$inisial])->row_array();
            $nama_kain      = strtolower($kain['nama_kain']);
            $jumlah_krm     = $val['jumlah_kirim'];
            $tgl_kirim      = date('d M Y', strtotime($val['tgl_kirim']));
            $pot            = $this->data_model->get_byid('stok_kain_potongan', ['id_k_ptgan'=>$id_pot])->row_array();
            $ukuran_pot     = $pot['panjang_kain']." x ".$pot['lebar_kain']." Meter";
            $hpp1           = $pot['harga_pcs'] + $pot['harga_ptg_pcs'];
            $codeSave       = $pot['code_saved'];
            $tgl_potong     = $this->data_model->get_byid('t_potong_kain',['codesaved'=>$codeSave])->row("tgl_potong");
            $id_stok        = $this->data_model->get_byid('stok_kain_pakai',['codesaved'=>$codeSave])->row("id_stok");
            $stok_kain      = $this->data_model->get_byid('stok_kain',['id_stok'=>$id_stok])->row_array();
            $pembelian      = $this->data_model->get_byid('t_pembelian_kain',['codesave'=>$stok_kain['codesave']])->row_array();
            $tgl_belikain   = $pembelian['tgl_pembelian'];
            $hrg_belikain   = $pembelian['harga_peryard'];
            ?>
            <div class="table-responsive">
            <table style="min-width:700px;">
                <tr>
                    <td style="width:200px;">&bull; Kode Babar</td>
                    <td>: &nbsp;  <span class="badge bg-danger"><?=$kode_babar;?></span></td>
                </tr>
                <?php if($fotop!="null"){?>
                <tr>
                    <td style="width:200px;">&bull; Foto Produksi</td>
                    <td>: &nbsp;  <a href="<?=base_url('uploads/'.$fotop);?>" target="_blank" style="color:blue;">Lihat Foto</a> &nbsp;/ <a href="javascript:void(0);" onclick="hpsFotoProduksi('<?=$id2;?>')" style="color:red;">Hapus Foto</a></td>
                </tr>
                <?php } else { ?>
                <tr>
                    <td style="width:200px;">&bull; Foto Produksi</td>
                    <td>: &nbsp;  <a href="javascript:void(0);" style="color:red;" onclick="uploadFotoProduksi('<?=$id2;?>','<?=$kode_babar;?>')">Upload Foto Produksi</a></td>
                </tr>
                <?php } ?>
                <tr>
                    <td style="width:200px;color:#0760de;">Informasi Kain</td>
                    <td></td>
                </tr>
                <tr>
                    <td style="width:200px;">&bull; Kode Kain</td>
                    <td>: &nbsp;  <?=$kode_kain;?></td>
                </tr>
                <tr>
                    <td style="width:200px;"></td>
                    <td>&nbsp; - <?=ucwords($nama_kain);?></td>
                </tr>
                <tr>
                    <td style="width:200px;"></td>
                    <td>&nbsp; - <?=$kain['konstruksi_kain'];?></td>
                </tr>
                <tr>
                    <td style="width:200px;"></td>
                    <td>&nbsp; - Tanggal Pembelian <?=date('d M Y', strtotime($tgl_belikain));?></td>
                </tr>
                <?php if($userAkses=="root"){ ?>
                <tr>
                    <td style="width:200px;"></td>
                    <td>&nbsp; - Harga Pembelian Rp. <?=number_format($hrg_belikain);?> / Yard</td>
                </tr>
                <?php } ?>
                <tr>
                    <td style="width:200px;">&bull; Ukuran Potong</td>
                    <td>: &nbsp;  <?=$ukuran_pot;?></td>
                </tr>
                <tr>
                    <td style="width:200px;">&bull; Tanggal Potong</td>
                    <td>: &nbsp;  <?=date('d M Y', strtotime($tgl_potong));?></td>
                </tr>
                <?php if($userAkses=="root"){ ?>
                <tr>
                    <td style="width:200px;font-weight:bold;">&bull; HPP 1</td>
                    <td>: &nbsp;  Rp. <strong><?=number_format($hpp1);?></strong> / Pcs</td>
                </tr>
                <?php } ?>
                <tr><td colspan="2">&nbsp;</td></tr>
                <tr>
                    <td style="width:200px;color:#0760de;">Proses Babar</td>
                    <td></td>
                </tr>
                <tr>
                    <td style="width:200px;">&bull; Pembatik</td>
                    <td>: &nbsp;  <?=$kd." - ".ucwords($nm);?></td>
                </tr>
                <tr>
                    <td style="width:200px;">&bull; Jumlah Kirim</td>
                    <td>: &nbsp;  <?=$jml_kirim;?></td>
                </tr>
                <tr>
                    <td style="width:200px;">&bull; Tanggal Kirim</td>
                    <td>: &nbsp;  <?=date('d M Y', strtotime($tgl_kirim));?></td>
                </tr>
                <tr>
                    <td style="width:200px;">&bull; Proses Babar</td>
                    <td>: &nbsp;  <?=$proses_babar;?></td>
                </tr>
                <?php if($userAkses=="root"){ ?>
                <tr>
                    <td style="width:200px;">&bull; Ongkos Total</td>
                    <td>: &nbsp;  Rp. <?=number_format($harga_ttl);?></td>
                </tr>
                
                <tr>
                    <td style="width:200px;font-weight:bold;">&bull; HPP 2</td>
                    <td>: &nbsp;  Rp. <strong><?=number_format($harga_pcs);?></strong> /Pcs</td>
                </tr>
                <?php } ?>
                <tr>
                    <td style="background:#ccc;font-size:12px;padding:5px;color:#333030;" colspan="2">Di input oleh <em><?=$diinputoleh;?></em> pada <em><?=$tpx1." ".$px1[1];?></em>. <a href="javascript:void(0);" style="color:red;" onclick="hapusThis('<?=$codeproduksi;?>','<?=$kode_babar;?>')">Hapus Proses Ini</a></td>
                </tr>
                <tr>
                    <td style="background:#ccc;font-size:12px;padding:5px;color:#333030;" colspan="2">Update harga / biaya jasa proses babar. <a href="javascript:void(0);" style="color:red;" onclick="updateThis('<?=$codeproduksi;?>','<?=$kode_babar;?>')">Update Harga</a></td>
                </tr>
                <tr><td colspan="2">&nbsp;</td></tr>
                <tr>
                    <td style="width:200px;color:#0760de;">Selesai Proses Babar</td>
                    <td></td>
                </tr>
                <tr><td colspan="2">
                    <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>TANGGAL SELESAI</th>
                                <th>JUMLAH</th>
                                <th>STATUS</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $showReturn = $this->data_model->get_byid('produksi_babar_fns',['codeproduksi'=>$codeproduksi]); $n=1;
                        if($showReturn->num_rows() > 0){
                            foreach($showReturn->result() as $val):
                            $id_pbf = $val->id_pbf;
                            $status = $val->status_fns=='Finish'?'<font style="color:green;">Selesai</font>':'<font style="color:red;">Cacat Proses</font>';
                            echo "<tr>";
                            echo "<td>".$n."</td>";
                            echo "<td>".date('d M Y', strtotime($val->tgl_fns))."</td>"; 
                            echo "<td>".$val->jumlah_pcs."</td>"; 
                            echo "<td>".$status."</td>";
                            ?><td><a href="javascript:void(0);" style="color:red;" onclick="hapusReturn('<?=$id_pbf;?>','<?=$val->jumlah_pcs;?>')"><i class="bi bi-trash"></i></a></td><?php
                            echo "</tr>";
                            $n++;
                            endforeach;
                        } else {
                            echo "<tr><td colspan='5'>Belum Ada Data Return</td></tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                    </div>
                </td></tr>
            </table>
            </div>
            <?php
        } else {
            echo "<font style='color:red;'>Token Error...</font>";
        }
    } //END
    function hpsFotoProduksi(){
        $idProduksi = $this->input->post('idProduksi', TRUE);
        $gbr        = $this->data_model->get_byid('produksi_babar',['id_produksi'=>$idProduksi])->row("foto_produksi");
        $this->data_model->updatedata('id_produksi', $idProduksi, 'produksi_babar', ['foto_produksi' => 'null']);
        unlink('uploads/'.$gbr);
        echo "okes";
    }
    function hpsFotoProduksi2(){
        $idProduksi = $this->input->post('idProduksi', TRUE);
        $gbr        = $this->data_model->get_byid('produksi_jahit',['id_pjhit'=>$idProduksi])->row("foto_produksi");
        $this->data_model->updatedata('id_pjhit', $idProduksi, 'produksi_jahit', ['foto_produksi' => 'null']);
        unlink('uploads/'.$gbr);
        echo "okes";
    }
    function saveReturnBatik(){
            $codeProduksi    = $this->input->post('codeProduksi', TRUE);
            $codeBabarRow    = $this->input->post('codeBabarRow', TRUE);
            $tglMasukSelesai = $this->input->post('tglMasukSelesai', TRUE);
            $jmlKemabali     = $this->input->post('jmlKemabali', TRUE);
            $statusBabar     = $this->input->post('statusBabar', TRUE);
            if($codeBabarRow!="" && $codeProduksi!="" && $tglMasukSelesai!="" && $jmlKemabali!="" && $statusBabar!=""){
                $tglinput    = date('Y-m-d H:i:s');
                $jmlReturn   = intval($jmlKemabali);
                $jmlOnBatik  = $this->data_model->get_byid('produksi_babar',['codeproduksi'=>$codeProduksi])->row("jumlah_kirim");
                $totalReturn = $this->db->query("SELECT SUM(jumlah_pcs) AS jml FROM produksi_babar_fns WHERE codeproduksi='$codeProduksi'")->row("jml");
                $harusReturn = intval($jmlOnBatik) - intval($totalReturn);
                if($jmlReturn <= $harusReturn){
                    $this->data_model->saved('produksi_babar_fns', [
                        'codeproduksi'  => $codeProduksi,
                        'jumlah_pcs'    => $jmlReturn,
                        'status_fns'    => $statusBabar,
                        'tgl_fns'       => $tglMasukSelesai,
                        'tglinput'      => $tglinput,
                        'yginput'       => $this->session->userdata('username'),
                        'kode_varians'  => 'null'
                    ]);
                    if($statusBabar=='Finish'){
                        $id_pbf         = $this->data_model->get_byid('produksi_babar_fns',['codeproduksi'=>$codeProduksi,'tglinput'=>$tglinput])->row("id_pbf");
                        $row            = $this->data_model->get_byid('produksi_babar',['codeproduksi'=>$codeProduksi])->row_array();
                        $id_produksi    = $row['id_produksi'];
                        $kode_pembatik  = $row['kode_pembatik'];
                        $kode_babar     = $kode_pembatik."-".sprintf('%03d', $id_produksi);
                        $id_pot         = $row['id_pot_kain'];
                        $kode_kain      = $row['kode_kain'];
                        $proses_babar   = $row['proses_babar'];
                        $harga_pcs      = $row['harga_pcs'];
                        $row2           = $this->data_model->get_byid('stok_kain_potongan',['id_k_ptgan'=>$id_pot])->row_array();
                        $harga_kain     = $row2['harga_pcs'];
                        $harga_potong   = $row2['harga_ptg_pcs'];
                        $hpp1           = intval($harga_kain) + intval($harga_potong);
                        $this->data_model->saved('stok_kain_proses_babar',[
                            'kode_babar'    => $kode_babar,
                            'codeproduksi'  => $codeProduksi,
                            'id_pbf'        => $id_pbf,
                            'jumlah_pcs'    => $jmlReturn,
                            'kode_kain'     => $kode_kain,
                            'proses_babar'  => $proses_babar,
                            'hpp1'          => $hpp1,
                            'hpp2'          => $harga_pcs
                        ]);
                    }
                    $txt = "Jumlah return anda berhasil disimpan.";
                    echo json_encode(array("statusCode" => 200, "message" => $txt));
                } else {
                    $txt     = "Jumlah return anda melebihi jumlah kain yang di kirim.";
                    echo json_encode(array("statusCode" => 500, "message" => $txt));
                }
            } else {
                echo json_encode(array("statusCode" => 500, "message" => "Anda tidak mengisi data dengan benar.!!"));
            }
    } //end
    function simpanProsesJahit(){
        $jmlStokAwal        = $this->input->post('jmlStokAwal', TRUE);
        $jmlKirim           = $this->input->post('jmlKirim', TRUE);
        $codeProduksiBabar  = $this->input->post('codeProduksiBabar', TRUE);
        $prosesBabarSblm    = $this->input->post('prosesBabarSblm', TRUE);
        $kodeKainSblm       = $this->input->post('kodeKainSblm', TRUE);
        $kodeBabar          = $this->input->post('kodeBabar', TRUE);
        $hpp1               = $this->input->post('hpp1', TRUE);
        $hpp2               = $this->input->post('hpp2', TRUE);
        $tglKirim           = $this->input->post('tglKirim', TRUE);
        $penjahit           = $this->input->post('penjahit', TRUE);
        $penjahitmdl        = $this->input->post('penjahitmdl', TRUE);
        $hargpcs            = $this->input->post('hargpcs', TRUE);
        $hargttl            = $this->input->post('hargttl', TRUE);
        $codeProduksiJahit  = $this->data_model->acakKode(19);
        if($codeProduksiBabar!="" && $prosesBabarSblm!="" && $kodeKainSblm!="" && $kodeBabar!="" && $hpp1!="" && $hpp2!="" && $tglKirim!="" && $penjahit!="" && $penjahitmdl!="" && $hargpcs!="" && $hargttl!="" AND $jmlStokAwal!="" && $jmlKirim!=""){
            if(intval($jmlKirim)>0 && intval($jmlKirim) <= intval($jmlStokAwal)){
                $this->data_model->saved('produksi_jahit', [
                    'kode_babar'       => $kodeBabar,
                    'kode_kain'        => $kodeKainSblm,
                    'proses_babar'     => $prosesBabarSblm,
                    'jumlah_kirim'     => $jmlKirim,
                    'kode_penjahit'    => $penjahit,
                    'kode_msj'         => $penjahitmdl,
                    'tanggal_jahit'    => $tglKirim,
                    'tanggal_input'    => date('Y-m-d H:i:s'),
                    'yg_input'         => $this->session->userdata('username'),
                    'harga_jhit_pcs'   => preg_replace("/[^0-9]/", "", $hargpcs),
                    'harga_jhit_ttl'   => preg_replace("/[^0-9]/", "", $hargttl),
                    'hpp1'             => $hpp1,
                    'hpp2'             => $hpp2,
                    'codeproduksi'     => $codeProduksiBabar,
                    'codeproduksijhit' => $codeProduksiJahit ]
                );
                $ambil      = $this->data_model->get_byid('stok_kain_proses_babar',['kode_babar'=>$kodeBabar])->result();
                $sisadata   = intval($jmlKirim);
                foreach($ambil as $row){
                    $id_skb = $row->id_skb;
                    $jmlskb = $row->jumlah_pcs;
                    if($sisadata > 0){
                        if($sisadata >= $jmlskb){
                            $this->data_model->updatedata('id_skb',$id_skb,'stok_kain_proses_babar',['jumlah_pcs'=>0]);
                            $thissisa = $sisadata - $jmlskb;
                            $sisadata = $thissisa;
                            $this->data_model->saved('produksi_jahit_use', ['codeproduksijahit'=>$codeProduksiJahit,'id_skb'=>$id_skb,'pakai'=>$jmlskb]);
                        } else {
                            $thissisa = $jmlskb - $sisadata;
                            $this->data_model->updatedata('id_skb',$id_skb,'stok_kain_proses_babar',['jumlah_pcs'=>$thissisa]);
                            $this->data_model->saved('produksi_jahit_use', ['codeproduksijahit'=>$codeProduksiJahit,'id_skb'=>$id_skb,'pakai'=>$sisadata]);
                            $sisadata = 0;
                        }
                    }
                }
                echo json_encode(array("statusCode" => 200, "message" => "Menyimpan proses Jahit"));
            } else {
                echo json_encode(array("statusCode" => 500, "message" => "Jumlah Kirim Minimal 1 dan Maksimal ".$jmlStokAwal.""));
            }
        } else {
            echo json_encode(array("statusCode" => 500, "message" => "Anda tidak mengisi data dengan benar.!!"));
        }
    }

    function hapusProduksiBabar(){
        $codeProduksi  = $this->input->post('cd', TRUE);
        $row           = $this->data_model->get_byid('produksi_babar',['codeproduksi'=>$codeProduksi])->row_array();
        $id_pot        = $row['id_pot_kain'];
        $jml_kirim     = $row['jumlah_kirim'];
        $row2          = $this->data_model->get_byid('stok_kain_potongan',['id_k_ptgan'=>$id_pot])->row_array();
        $stok_sekarnag = $row2['jumlah_pcs'];
        $upddate_stok  = intval($stok_sekarnag) + intval($jml_kirim);
        $this->data_model->updatedata('id_k_ptgan', $id_pot, 'stok_kain_potongan', ['jumlah_pcs' => $upddate_stok]);
        $this->data_model->delete('produksi_babar', 'codeproduksi', $codeProduksi);
        $this->data_model->delete('produksi_babar_fns', 'codeproduksi', $codeProduksi);
        echo json_encode(array("statusCode" => 200, "message" => "Produksi Batik telah dihapus!"));
    }
    function hapusReturnBabar(){
        $id = $this->input->post('id', TRUE);
        $this->data_model->delete('produksi_babar_fns', 'id_pbf', $id);
        $this->data_model->delete('stok_kain_proses_babar', 'id_pbf', $id);
        echo json_encode(array("statusCode" => 200, "message" => "Membatalkan Proses Return"));
    }
    function hapusReturnJahit(){
        $id = $this->input->post('id', TRUE);
        $this->data_model->delete('produksi_jahit_finish', 'codestok', $id);
        $this->data_model->delete('stok_produk', 'codestok', $id);
        echo json_encode(array("statusCode" => 200, "message" => "Membatalkan Proses Return"));
    }
}
?>