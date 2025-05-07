<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi3 extends CI_Controller
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
    
    function showBabarPlusJahit(){
        $id        = $this->input->post('id', TRUE);
        $cdjahit   = $this->input->post('cdjahit', TRUE);
        $userAkses = $this->session->userdata('akses');
        $cek = $this->data_model->get_byid('produksi_babar',['id_produksi'=>$id]);
        if($cek->num_rows() == 1){
            $val            = $cek->row_array();
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
            $px1             = explode(' ', $tgl_input);
            $tpx1            = date('d M Y', strtotime($px1[0]));
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
                <tr><td colspan="2">&nbsp;</td></tr>
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
                    <td>: &nbsp;  <?=$jml_kirim;?> Pcs</td>
                </tr>
                <tr>
                    <td style="width:200px;">&bull; Tanggal Kirim</td>
                    <td>: &nbsp;  <?=date('d M Y', strtotime($tgl_kirim));?></td>
                </tr>
                <tr>
                    <td style="width:200px;">&bull; Proses Babar</td>
                    <td>: &nbsp;  <?=$proses_babar;?></td>
                </tr>
                <tr>
                    <td style="width:200px;">&bull; Ongkos Total</td>
                    <td>: &nbsp;  Rp. <?=number_format($harga_ttl);?></td>
                </tr>
                <?php if($userAkses=="root"){ ?>
                <tr>
                    <td style="width:200px;font-weight:bold;">&bull; HPP 2</td>
                    <td>: &nbsp;  Rp. <strong><?=number_format($harga_pcs);?></strong> /Pcs</td>
                </tr>
                <?php } ?>
                <tr>
                    <td style="background:#ccc;font-size:12px;padding:5px;color:#333030;" colspan="2">Di input oleh <em><?=$diinputoleh;?></em> pada <em><?=$tpx1." ".$px1[1];?></em>.</td>
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
                <tr>
                    <td style="width:200px;color:#0760de;">Proses Jahit</td>
                    <td></td>
                </tr>
                <?php
                $jahit          = $this->data_model->get_byid('produksi_jahit',['codeproduksijhit'=>$cdjahit])->row_array();
                $id_pjhit       = $jahit['id_pjhit'];
                $nama_penjahit  = $this->data_model->get_byid('master_penjahit',['kode_penjahit'=>$jahit['kode_penjahit']])->row("nama_penjahit");
                $proses_jahit   = $this->data_model->get_byid('master_jahiten',['id_msj'=>$jahit['kode_msj']])->row_array();
                $jenis_jahitan  = $proses_jahit['jenis_jahitan'];
                $model_jahitan  = $proses_jahit['model_jahitan'];
                $harga_jahitan  = $proses_jahit['harga_jahitan'];
                $px             = explode(' ', $jahit['tanggal_input']);
                $tpx            = date('d M Y', strtotime($px[0]));
                $kode_jahit     = $jahit['kode_penjahit']."-".sprintf('%03d', $id_pjhit);
                $foto_produksi  = $jahit['foto_produksi'];
                ?>
                <tr>
                    <td style="width:200px;">&bull; Kode Jahit</td>
                    <td>: &nbsp;  <span class="badge bg-danger"><?=$kode_jahit;?></span></td>
                </tr>
                <?php
                if($foto_produksi == "null"){ ?>
                <tr>
                    <td style="width:200px;">&bull; Foto Produksi</td>
                    <td>: &nbsp;  <a href="javascript:void(0)" style="color:blue;" onclick="uploadFotoProduksi('<?=$id_pjhit;?>','<?=$kode_jahit;?>')">Upload Foto</a></td>
                </tr><?php
                } else { ?>
                <tr>
                    <td style="width:200px;">&bull; Foto Produksi</td>
                    <td>: &nbsp;  <a href="<?=base_url('uploads/'.$foto_produksi);?>" target="_blank" style="color:blue;">Lihat Foto</a> &nbsp;/&nbsp; <a href="javascript:void(0)" style="color:red;" onclick="hpsFotoProduksi('<?=$id_pjhit;?>')">Hapus Foto</a></td>
                </tr><?php
                }
                ?>
                <tr>
                    <td style="width:200px;">&bull; Nama Penjahit</td>
                    <td>: &nbsp;  <?=$nama_penjahit;?></td>
                </tr>
                <tr>
                    <td style="width:200px;">&bull; Tanggal Kirim</td>
                    <td>: &nbsp;  <?=date('d M Y', strtotime($jahit['tanggal_jahit']));?></td>
                </tr>
                <tr>
                    <td style="width:200px;">&bull; Jumlah Kirim Kirim</td>
                    <td>: &nbsp;  <?=$jahit['jumlah_kirim'];?> Pcs</td>
                </tr>
                <tr>
                    <td style="width:200px;">&bull; Model Jahitan</td>
                    <td>: &nbsp;  <?=$jenis_jahitan;?> - <?=$model_jahitan;?></td>
                </tr>
                <tr>
                    <td style="width:200px;">&bull; Ongkos Total</td>
                    <td>: &nbsp;  Rp. <?=number_format($jahit['harga_jhit_ttl'],0,",",".");?> </td>
                </tr>
                <?php if($userAkses=="root"){ ?>
                <tr>
                    <td style="width:200px;font-weight:bold;">&bull; HPP 3</td>
                    <td>: &nbsp;  Rp. <strong><?=number_format($harga_jahitan,0,",",".");?></strong> /Pcs</td>
                </tr>
                <?php } ?>
                <tr>
                    <td style="background:#ccc;font-size:12px;padding:5px;color:#333030;" colspan="2">Di input oleh <em><?=$jahit['yg_input'];?></em> pada <em><?=$tpx." - ".$px[1];?></em>. <a href="javascript:void(0);" style="color:red;" onclick="hapusThis('<?=$cdjahit;?>','<?=$kode_jahit;?>')">Hapus Proses Ini</a></td>
                </tr>
                <tr><td colspan="2">&nbsp;</td></tr>
                <tr>
                    <td style="width:200px;color:#0760de;">Selesai Proses Jahit</td>
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
                                <th>PRODUK</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $showReturn2 = $this->data_model->get_byid('produksi_jahit_finish',['codeproduksijahit'=>$cdjahit]); $n1=1;
                        if($showReturn2->num_rows() > 0){
                            foreach($showReturn2->result() as $val):
                            $id_pjf = $val->id_pjf;
                            $codestok = $val->codestok;
                            $kd1    = $val->kode_varians=='null' ? '':$val->kode_varians;
                            $kd2    = $val->ukuran=='null' ? '':$val->ukuran;
                            $status = $val->status_finish=='Finish'?'<font style="color:green;">Selesai</font>':'<font style="color:red;">Cacat Proses</font>';
                            echo "<tr>";
                            echo "<td>".$n1."</td>";
                            echo "<td>".date('d M Y', strtotime($val->tgl_masuk))."</td>"; 
                            echo "<td>".$val->jumlah_kembali."</td>"; 
                            echo "<td>".$status."</td>";
                            echo "<td>".$kd1."-".$kd2."</td>";
                            ?><td><a href="javascript:void(0);" style="color:red;" onclick="hapusReturn2('<?=$codestok;?>','<?=$val->jumlah_kembali;?>','<?=$cdjahit;?>')"><i class="bi bi-trash"></i></a></td><?php
                            echo "</tr>";
                            $n1++;
                            endforeach;
                        } else {
                            echo "<tr><td colspan='5'>Belum Ada Data Selesai</td></tr>";
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
            echo "<font style='color:red;'>Token Error... Code: 21</font>";
        }
    } //END
    function hapusProduksiJahit(){
        $codeProduksi  = $this->input->post('cd', TRUE);
        $row           = $this->data_model->get_byid('produksi_jahit_use',['codeproduksijahit'=>$codeProduksi])->result();
        foreach($row as $r){
            $id_skb    = $r->id_skb;
            $pakai     = $r->pakai;
            $stok_awal = $this->data_model->get_byid('stok_kain_proses_babar',['id_skb'=>$id_skb])->row("jumlah_pcs");
            $stok_new  = intval($stok_awal) + intval($pakai);
            $this->data_model->updatedata('id_skb',$id_skb,'stok_kain_proses_babar', ['jumlah_pcs'=>$stok_new]);
        }
        $this->data_model->delete('produksi_jahit', 'codeproduksijhit', $codeProduksi);
        $this->data_model->delete('produksi_jahit_use', 'codeproduksijahit', $codeProduksi);
        echo json_encode(array("statusCode" => 200, "message" => "Produksi Jahit telah dihapus!"));
    }
    public function get_model_produk() {
        $kodeProduk     = $this->input->post('kodeProduk');
        $data           = $this->data_model->get_byid('master_produk_varians', ['kode_produk'=>$kodeProduk])->result();
        echo json_encode($data);
    }
    function showFinishProduk(){
        $params  = $this->input->post('params', TRUE);
        $showReturn2 = $this->data_model->get_byid('produksi_jahit_finish',['codeproduksijahit'=>$params]); $n1=1;
        if($showReturn2->num_rows() > 0){
            ?><table class="table table-bordered"><thead><tr><th>NO</th><th>TANGGAL SELESAI</th><th>QTY</th><th></th><th>STATUS</th><th>PRODUK</th></tr></thead><?php
            foreach($showReturn2->result() as $val):
            $id_pjf = $val->id_pjf;
            $codestok = $val->codestok;
            $kd1    = $val->kode_varians=='null' ? '':$val->kode_varians;
            $kd2    = $val->ukuran=='null' ? '':$val->ukuran;
            $status = $val->status_finish=='Finish'?'<font style="color:green;">Selesai</font>':'<font style="color:red;">Cacat Proses</font>';
            echo "<tr>";
            echo "<td>".$n1."</td>";
            echo "<td>".date('d M Y', strtotime($val->tgl_masuk))."</td>"; 
            echo "<td>".$val->jumlah_kembali."</td>"; 
            echo "<td>".$status."</td>";
            echo "<td>".$kd1."-".$kd2."</td>";
            ?><td><a href="javascript:void(0);" style="color:red;" onclick="hapusReturn2('<?=$codestok;?>','<?=$val->jumlah_kembali;?>','<?=$params;?>')"><i class="bi bi-trash"></i></a></td><?php
            echo "</tr>";
            $n1++;
            endforeach;
        } else { echo ""; }
    }
    function saveFinishProduk(){
        $codeProduksiJahit  = $this->input->post('codeProduksiJahit', TRUE);
        $codeJahitRow       = $this->input->post('codeJahitRow', TRUE);
        $tglMasuk           = $this->input->post('tglMasuk', TRUE);
        $jmlKembali         = $this->input->post('jmlKembali', TRUE);
        $statusJahit        = $this->input->post('statusJahit', TRUE);
        $kodeProduk         = $this->input->post('kodeProduk', TRUE);
        $kodeVarians        = $this->input->post('kodeVarians', TRUE);
        $ukuranProduk       = $this->input->post('ukuranProduk', TRUE);
        $rows               = $this->data_model->get_byid('produksi_jahit', ['codeproduksijhit'=>$codeProduksiJahit])->row_array();
        $yangHarusKembali   = $rows['jumlah_kirim'];
        $yangSudahKembali   = $this->db->query("SELECT SUM(jumlah_kembali) AS jml FROM produksi_jahit_finish WHERE codeproduksijahit='$codeProduksiJahit'")->row("jml");
        $sisaKembali        = intval($yangHarusKembali) - intval($yangSudahKembali);
        if($codeProduksiJahit!="" && $codeJahitRow!="" && $tglMasuk!="" && $jmlKembali!="" && $statusJahit!="" && $kodeProduk!="" && $kodeVarians!="" && $ukuranProduk!=""){
            if(intval($jmlKembali) <= intval($sisaKembali)){
                $codeStok   = $this->data_model->acakKode('13');
                $this->data_model->saved('produksi_jahit_finish', [
                    'codeproduksijahit' => $codeProduksiJahit,
                    'tgl_masuk'         => $tglMasuk,
                    'tgl_input'         => date('Y-m-d H:i:s'),
                    'yg_input'          => $this->session->userdata('username'),
                    'status_finish'     => $statusJahit,
                    'jumlah_kembali'    => $jmlKembali,
                    'kode_produk'       => $kodeProduk,
                    'kode_varians'      => $kodeVarians,
                    'ukuran'            => $ukuranProduk,
                    'codestok'          => $codeStok
                ]);
                if($statusJahit=="Finish"){
                    $hpp_all            = intval($rows['hpp1']) + intval($rows['hpp2']) + intval($rows['harga_jhit_pcs']);
                    $hpp_all2           = $hpp_all + 3000;
                    $duapulupersen      = ($hpp_all2 * 20) / 100;
                    $harga_produk       = $hpp_all2 + $duapulupersen;
                    $_id_pjhit          = $rows['id_pjhit'];
                    $_id_pjhit2         = sprintf('%03d', $_id_pjhit);
                    $_kode_kain         = $rows['kode_kain'];
                    $x                  = explode('-', $_kode_kain);
                    $_kode_babar        = $rows['kode_babar'];
                    $xy                 = explode('-', $_kode_babar);
                    $_kode_pnjhit       = $rows['kode_penjahit'];
                    $kode_produksi      = $x[0]."".$x[1]."-".$xy[0]."".$_kode_pnjhit."-".$_id_pjhit2;
                    for ($i=0; $i <$jmlKembali ; $i++) { 
                        $this->data_model->saved('stok_produk', [
                            'kode_produk'       => $kodeProduk,
                            'kode_varians'      => $kodeVarians,
                            'ukuran'            => $ukuranProduk,
                            'hpp'               => $hpp_all2,
                            'harga_jual'        => $harga_produk,
                            'codeproduksijahit' => $codeProduksiJahit,
                            'kode_produksi'     => $kode_produksi,
                            'codestok'          => $codeStok
                        ]);
                    }
                }
                $var = "Berhasil menyimpan data produk.";
                echo json_encode(array("statusCode" => 200, "message" => $var));
            } else {
                $var = "Jumlah yang belum kembali adalah ".intval($sisaKembali);
                echo json_encode(array("statusCode" => 400, "message" => $var));
            }
        } else {
            echo json_encode(array("statusCode" => 400, "message" => "Anda tidak mengisi data dengan benar.!"));
        }
    }
}
?>