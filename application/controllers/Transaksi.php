<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller
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
    function potongkain(){
        $data = [
            'title'         => 'Data Pemotongan Kain',
            'sess_nama'     =>  $this->session->userdata('nama'),
            'sess_username' =>  $this->session->userdata('username'),
            'sess_akses'    =>  $this->session->userdata('akses'),
            'formatData'    => 'tables',
            'scriptForm'    => 'potongkain',
            'ptg'           => $this->data_model->get_record('master_pemotong'),
            'kaindata'      => $this->data_model->get_record('master_kain')
        ];
        $this->load->view('part/header', $data);
        $this->load->view('part/navigation', $data);
        $this->load->view('data/transaksi_potongkain', $data);
        $this->load->view('part/main_js_tables3', $data);
        
    }
    function stokkain(){
        $data = [
            'title'         => 'Data Stok Kain Real',
            'sess_nama'     =>  $this->session->userdata('nama'),
            'sess_username' =>  $this->session->userdata('username'),
            'sess_akses'    =>  $this->session->userdata('akses'),
            'formatData'    => 'tables',
            'scriptForm'    => 'stokkain',
            'kaindata'      => $this->data_model->get_record('master_kain')
        ];
        $this->load->view('part/header', $data);
        $this->load->view('part/navigation', $data);
        $this->load->view('data/transaksi_stokkain', $data);
        $this->load->view('part/main_js_tables3', $data);
        
    }
    function stokkain2(){
        $data = [
            'title'         => 'Data Stok Kain Potongan',
            'sess_nama'     =>  $this->session->userdata('nama'),
            'sess_username' =>  $this->session->userdata('username'),
            'sess_akses'    =>  $this->session->userdata('akses'),
            'formatData'    => 'tables',
            'scriptForm'    => 'stokkain2',
            'kaindata'      => $this->data_model->get_record('master_kain')
        ];
        $this->load->view('part/header', $data);
        $this->load->view('part/navigation', $data);
        $this->load->view('data/transaksi_stokkain2', $data);
        $this->load->view('part/main_js_tables3', $data);
        
    }
    function stokkainbatik(){
        $data = [
            'title'         => 'Data Stok Kain Batik',
            'sess_nama'     =>  $this->session->userdata('nama'),
            'sess_username' =>  $this->session->userdata('username'),
            'sess_akses'    =>  $this->session->userdata('akses'),
            'formatData'    => 'tables',
            'scriptForm'    => 'stokkain3'
        ];
        $this->load->view('part/header', $data);
        $this->load->view('part/navigation', $data);
        $this->load->view('data/transaksi_stokkain3', $data);
        $this->load->view('part/main_js_tables3', $data);
        
    }
    function pembeliankain(){
        $data = [
            'title'         => 'Data Pembelian Kain',
            'sess_nama'     =>  $this->session->userdata('nama'),
            'sess_username' =>  $this->session->userdata('username'),
            'sess_akses'    =>  $this->session->userdata('akses'),
            'formatData'    => 'tables',
            'scriptForm'    => 'pembeliankain',
            'kaindata'      => $this->data_model->get_record('master_kain')
        ];
        $this->load->view('part/header', $data);
        $this->load->view('part/navigation', $data);
        $this->load->view('data/transaksi_pembeliankain', $data);
        $this->load->view('part/main_js_tables3', $data);
        
    }
    function lihatDetil(){
        $kd = $this->input->post('kd', TRUE);
        $cek = $this->data_model->get_byid('t_pembelian_kain', ['codesave'=>$kd]);
        if($cek->num_rows() == 1){
            $tgl_pembelian      = $cek->row("tgl_pembelian");
            $tgl_input          = $cek->row("tgl_input");
            $inisial            = $cek->row("inisial_kain");
            $jumlah_pembelian   = $cek->row("jumlah_pembelian");
            $harga_peryard      = $cek->row("harga_peryard");
            $harga_total_kain   = $cek->row("harga_total_kain");
            $nama_supplier      = $cek->row("nama_supplier");
            $pembayaran         = $cek->row("pembayaran");
            $bukti_tf           = $cek->row("bukti_tf");
            $bea_dll            = $cek->row("bea_dll");
            $diinput            = $cek->row("diinput");
            $codesave           = $cek->row("codesave");
            echo json_encode(array(
                "statusCode"    => 200, 
                "tglPembelian"  => $tgl_pembelian,
                "tglPembelian2"  => date('d M Y', strtotime($tgl_pembelian)),
                "tglinput"      => $tgl_input,
                "kodekain"      => $inisial,
                "jmlbeli"       => $jumlah_pembelian,
                "hargayard"     => $harga_peryard,
                "hargatotal"    => $harga_total_kain,
                "namasup"       => $nama_supplier,
                "pembayaran"    => $pembayaran,
                "buktitf"       => $bukti_tf,
                "beadll"        => $bea_dll,
                "diinput"       => $diinput,
                "codesave"      => $codesave,
            ));
        } else {
            echo json_encode(array("statusCode" => 500, "message" => "Data Tidak ditemukan!!"));
        }
    }
    function hapusPembelian(){
        $id = $this->input->post('kd', TRUE);
        $this->data_model->delete('t_pembelian_kain', 'codesave', $id);
        $this->data_model->delete('stok_kain', 'codesave', $id);
        echo json_encode(array("statusCode" => 200, "message" => "Data Berhasil Dihapus!"));
    }
    function hapusPptonganKainAll(){
        $id = $this->input->post('cd', TRUE);
        $this->data_model->delete('stok_kain_potongan', 'code_saved', $id);
        $this->data_model->delete('t_potong_kain', 'codesaved', $id);
        $ck = $this->data_model->get_byid('stok_kain_pakai',['codesaved'=>$id])->result();
        foreach($ck as $val){
            $id_stok = $val->id_stok;
            $stoksblm = $val->stok_sebelumnya;
            $pemakaian = $val->pemakaian;
            $stok_sekarang = $this->data_model->get_byid('stok_kain',['id_stok'=>$id_stok])->row("jumlah_stok");
            $updateStok = $stok_sekarang + $pemakaian;
            $updateStok = round($updateStok,1);
            $this->data_model->updatedata('id_stok',$id_stok,'stok_kain',['jumlah_stok'=>$updateStok]);
        }
        $this->data_model->delete('stok_kain_pakai', 'codesaved', $id);
        echo json_encode(array("statusCode" => 200, "message" => "Data Berhasil Dihapus!"));
    }
    function hapusPptonganKain(){
        $id = $this->input->post('id', TRUE);
        $cd = $this->input->post('cd', TRUE);
        $this->data_model->delete('stok_kain_potongan', 'id_k_ptgan', $id);
        $harga_potong = $this->data_model->get_byid('t_potong_kain',['codesaved'=>$cd])->row("ongkos_potong");
        $total_potongan = $this->db->query("SELECT SUM(jumlah_pcs) AS jml FROM stok_kain_potongan WHERE code_saved='$cd'")->row("jml");
        $harga_perpotongan = $harga_potong / $total_potongan;
        $harga_perpotongan = round($harga_perpotongan);
        $this->data_model->updatedata('code_saved',$cd,'stok_kain_potongan',['harga_ptg_pcs'=>$harga_perpotongan]);
        echo json_encode(array("statusCode" => 200, "message" => "Data Berhasil Dihapus!"));
    }
    function prosesPotongSimpan(){
        $saveCode       = $this->input->post('saveCode', TRUE);
        $tanggalPotong  = $this->input->post('tanggalPotong', TRUE);
        $tukangPotong   = $this->input->post('tukangPotong', TRUE);
        $namaKain       = $this->input->post('namaKain', TRUE);
        $jmlPotong      = $this->input->post('jmlPotong', TRUE);
        $jmlPotong      = preg_replace('/[^0-9.]/', '', $jmlPotong);
        $ongkosPotong   = $this->input->post('ongkosPotong', TRUE);
        $ongkosPotong   = preg_replace('/[^0-9]/', '', $ongkosPotong);
        $ukrPotongMtr   = $this->input->post('ukrPotongMtr', TRUE);
        $jmlPtpngPcs    = $this->input->post('jmlPtpngPcs', TRUE);
        //$harga_peryard  = 0;
        if($saveCode!="" AND $tanggalPotong!="" AND $tukangPotong!="" AND $namaKain!="" AND $jmlPotong!="" AND $ongkosPotong!="" AND $ukrPotongMtr!="" AND $jmlPtpngPcs!=""){
            $total_kain = $this->db->query("SELECT SUM(jumlah_stok) AS jml FROM stok_kain WHERE inisial_kain='$kd'")->row()->jml;
            if(floatval($total_kain) < 1){ $stok_kain = 0; } else { $stok_kain = $total_kain; }
            if($stok_kain <= $jmlPotong){
                $cekCode = $this->data_model->get_byid('t_potong_kain',['codesaved'=>$saveCode])->num_rows();
                if($cekCode==0){
                    $cekNomorUrut = $this->db->query("SELECT * FROM t_potong_kain WHERE kode_pemotong='$tukangPotong' ORDER BY kode_potongan DESC LIMIT 1");
                    if($cekNomorUrut->num_rows() == 1){
                        $nomorUrutSekarang = $cekNomorUrut->row("kode_potongan");
                        $nomorUrut = intval($nomorUrutSekarang) + 1;
                    } else {
                        $nomorUrut = 1;
                    }
                    $cekStokKain = $this->db->query("SELECT * FROM stok_kain WHERE inisial_kain='$namaKain' AND jumlah_stok > 0 ORDER BY id_stok ASC");
                    $sisa_kain = $jmlPotong;
                    $total_harga_digunakan = 0;
                    foreach($cekStokKain->result() as $vals){
                        $id_stok = $vals->id_stok;
                        $inisial_kain = $vals->inisial_kain;
                        $stok_disini = $vals->jumlah_stok;
                        $harga_sekarang = $vals->harga_kain_peryard;
                        if($sisa_kain > 0){
                            if($sisa_kain > $stok_disini){
                                $harga_dipakai = $stok_disini * $harga_sekarang;
                                $total_harga_digunakan += $harga_dipakai;
                                $sisa_sekarang = $sisa_kain - $stok_disini;
                                $sisa_kain = $sisa_sekarang;
                                $this->data_model->saved('stok_kain_pakai',[
                                    'id_stok' => $id_stok,
                                    'inisial_kain' => $inisial_kain,
                                    'stok_sebelumnya' => $stok_disini,
                                    'pemakaian' => $stok_disini,
                                    'codesaved' => $saveCode
                                ]);
                                $this->data_model->updatedata('id_stok',$id_stok,'stok_kain',['jumlah_stok'=>0]);
                            } else {
                                $harga_dipakai = $sisa_kain * $harga_sekarang;
                                $total_harga_digunakan += $harga_dipakai;
                                $this->data_model->saved('stok_kain_pakai',[
                                    'id_stok' => $id_stok,
                                    'inisial_kain' => $inisial_kain,
                                    'stok_sebelumnya' => $stok_disini,
                                    'pemakaian' => $sisa_kain,
                                    'codesaved' => $saveCode
                                ]);
                                $updateStok = $stok_disini - $sisa_kain;
                                $updateStok = round($updateStok,1);
                                $this->data_model->updatedata('id_stok',$id_stok,'stok_kain',['jumlah_stok'=>$updateStok]);
                                $sisa_kain = 0;
                            }
                        }
                    }
                    
                    //$harga_peryard = $total_harga_digunakan / $jmlPotong;
                    //$harga_peryard = round($harga_peryard);
                    $this->data_model->saved('t_potong_kain',[
                        'codesaved'         => $saveCode,
                        'tgl_potong'        => $tanggalPotong,
                        'tgl_input'         => date('Y-m-d H:i:s'),
                        'kode_pemotong'     => $tukangPotong,
                        'kode_kain'         => $namaKain,
                        'jumlah_kainkirim'  => $jmlPotong,
                        'harga_peryard'     => 0,
                        'ongkos_potong'     => $ongkosPotong,
                        'diinputoleh'       => $this->session->userdata('username'),
                        'kode_potongan'     => $nomorUrut
                    ]);
                }
                if($ukrPotongMtr!="" AND $jmlPtpngPcs!=""){
                    $x = explode(' x ', $ukrPotongMtr);
                    $panjang = $x[0];
                    $lebar = $x[1];
                    $this->data_model->saved('stok_kain_potongan',[
                        'inisial_kain'     => $namaKain,
                        'panjang_kain'     => $panjang,
                        'lebar_kain'       => $lebar,
                        'harga_pcs'        => 0,
                        'harga_ptg_pcs'    => 0,
                        'jumlah_pcs'       => $jmlPtpngPcs,
                        'code_saved'       => $saveCode,
                    ]);
                    $harga_potong = $this->data_model->get_byid('t_potong_kain',['codesaved'=>$saveCode])->row("ongkos_potong");
                    $total_potongan = $this->db->query("SELECT SUM(jumlah_pcs) AS jml FROM stok_kain_potongan WHERE code_saved='$saveCode'")->row("jml");
                    $harga_perpotongan = $harga_potong / $total_potongan;
                    $harga_perpotongan = round($harga_perpotongan);
                    $this->data_model->updatedata('code_saved',$saveCode,'stok_kain_potongan',['harga_ptg_pcs'=>$harga_perpotongan]);
                }
                
                echo json_encode(array("statusCode" => 200, "message" => "Menyimpan data potong kain"));
            } else {
                echo json_encode(array("statusCode" => 500, "message" => "Jumlah Stok Tidak Mencukupi.!"));
            }
        } else {
            echo json_encode(array("statusCode" => 500, "message" => "Anda tidak mengisi data dengan benar!"));
        }
    }
    function lihatPotonganKain(){
        $codesaved  = $this->input->post('cd', TRUE);
        $aks        = $this->session->userdata('akses');
        $cek        = $this->data_model->get_byid('stok_kain_potongan',['code_saved'=>$codesaved]);
        $yrdkrim    = $this->data_model->get_byid('t_potong_kain',['codesaved'=>$codesaved])->row("jumlah_kainkirim");
        if($cek->num_rows() > 0){
            $no=1;
            $total_yard = 0;
            ?>
            <tr>
                <th>No</th>
                <th>Ukuran Potong</th>
                <th>Jumlah Potong</th>
                <th>HPP 1</th>
                <th></th>
            </tr>
            <?php
            foreach($cek->result() as $val){
                $id = $val->id_k_ptgan;
                $cd = $val->code_saved;
                $panjang_kain = $val->panjang_kain;
                $panjang_kain_yard = $panjang_kain / 0.9;
                $panjang_kain_yard = round($panjang_kain_yard,1);
                $panjang_kain_yard_all = $val->jumlah_pcs * $panjang_kain_yard;
                $total_yard += $panjang_kain_yard_all;
                $hp1 = $val->harga_pcs;
                $hp2 = $val->harga_ptg_pcs;
                $hpp1 = $hp1 + $hp2;
                ?>
                <tr>
                    <td><?=$no;?>.</td>
                    <td><?=$val->panjang_kain;?> x <?=$val->lebar_kain;?> Meter</td>
                    <td><?=$val->jumlah_pcs;?> Pcs</td>
                    <?php if($aks=="root"){ ?>
                    <td>Rp. <?=number_format($hpp1,0,'.',',');?></td>
                    <?php } else { ?>
                    <td>Rp. ******</td>
                    <?php } ?>
                    <td><a href="#" onclick="hapusPotongan('<?=$id;?>','<?=$cd;?>')" style="color:red;">Hapus</a></td>
                </tr>
                <?php $no++;
            }
            $sisaKain = $yrdkrim - $total_yard;
            echo "<tr>";
            echo "<td></td>";
            if($total_yard == floor($total_yard)){
                echo "<td colspan='3'>".number_format($total_yard,0,',','.')." Yard (Total Kain Yang Sudah Di Potong) Sisa Kain<strong>$sisaKain Yard</strong></td>";
            } else {
                echo "<td colspan='3'>".number_format($total_yard,1,',','.')." Yard (Total Kain Yang Sudah Di Potong) Sisa Kain<strong>$sisaKain Yard</strong></td>";
            }
            
            echo "</tr>";
        }
    }
    function lihatsumberPotongan(){
        $cd = $this->input->post('cd', TRUE);
        $aks= $this->session->userdata('akses');
        $cek = $this->data_model->get_byid('t_potong_kain',['codesaved'=>$cd]);
        if($cek->num_rows() == 1){
            $kode_pemotong = $cek->row("kode_pemotong");
            $nama_pemotong = $this->data_model->get_byid('master_pemotong',['kode_ptg'=>$kode_pemotong])->row("nama_ptg");
            $tgl_potong = $cek->row("tgl_potong");
            $kode_potongan = sprintf('%03d', $cek->row("kode_potongan"));
            $showKodePotongan = $kode_pemotong."-".$kode_potongan;
            $cval = $this->db->query("SELECT * FROM stok_kain_pakai WHERE codesaved='$cd' LIMIT 1")->row("id_stok");
            //stok_kain_pakai',['codesaved'=>$cd])->result();
            //$tgl_pembelian_kain = array();
            //foreach($cval as $c){
                //$id_stok = $c->id_stok;
                $ck2 = $this->data_model->get_byid('stok_kain',['id_stok'=>$cval])->row("codesave");
                $ck3 = $this->data_model->get_byid('t_pembelian_kain',['codesave'=>$ck2])->row_array();
                $tgl_pembelian_kain = date('d M Y', strtotime($ck3['tgl_pembelian']));
                $hrg_pembelian_kain = number_format($ck3['harga_peryard']);
            //}
            ?>
            <table class="table">
                <tr>
                    <td style="width:200px;">Kode Potongan</td>
                    <td>: &nbsp; <strong><?=$showKodePotongan;?></strong></td>
                </tr>
                <tr>
                    <td style="width:200px;">Tanggal Potong</td>
                    <td>: &nbsp; <strong><?=date('d M Y', strtotime($tgl_potong));?></strong></td>
                </tr>
                <tr>
                    <td style="width:200px;">Nama Pemotong</td>
                    <td>: &nbsp; <strong><?=$nama_pemotong;?></strong></td>
                </tr>
                <tr>
                    <td style="width:200px;">Tanggal Pembelian Kain</td>
                    <td>: &nbsp; <strong><?=$tgl_pembelian_kain;?></strong></td>
                </tr>
                <tr>
                    <td style="width:200px;">Harga Beli</td>
                    <?php if($aks == "root"){ ?>
                    <td>: &nbsp; <strong>Rp. <?=$hrg_pembelian_kain;?></strong> / Yard</td>
                    <?php } else { ?>
                    <td>: &nbsp; <strong>Rp. ******</strong> / Yard</td>
                    <?php } ?>
                </tr>
            </table>
            <?php
        } else {
            echo "Token Error...";
        }
    }
}
?>