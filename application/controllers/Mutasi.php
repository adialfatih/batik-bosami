<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mutasi extends CI_Controller
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
    function penjualan(){
        $kodekain = $this->db->query("SELECT kode_produk,nama_produk FROM master_produk ORDER BY nama_produk");
        $ar = array();
        foreach($kodekain->result() as $val){
            $a = $val->kode_produk." - ".$val->nama_produk;
            $d = '"'.$a.'"';
            if(in_array($d, $ar)){} else { $ar[]=$d; }
        }
        $im = implode(',', $ar);
        $data = [
            'title'         => 'Data Penjualan ORI',
            'sess_nama'     =>  $this->session->userdata('nama'),
            'sess_username' =>  $this->session->userdata('username'),
            'sess_akses'    =>  $this->session->userdata('akses'),
            'formatData'    => 'tables',
            'scriptForm'    => 'penjualan',
            'autoComplete'  => 'yes',
            'codejual'      => $this->data_model->acakKode(27),
            'dataAuto'      => $im
        ];
        $this->load->view('part/header', $data);
        $this->load->view('part/navigation', $data);
        $this->load->view('mutasi/data_penjualan', $data);
        $this->load->view('part/main_js_penjualan', $data);
        
    }

    function get_model_produk(){
        $selection   = $this->input->post('selection');
        $x           = explode(' - ', $selection);
        $kode_produk = $x[0];
        $data        = $this->data_model->get_byid('master_produk_varians',['kode_produk'=>$kode_produk])->result();
        echo json_encode($data);
    }
    function get_stok(){
        $modelProduk = $this->input->post('modelProduk', TRUE);
        $ukrproduk   = $this->input->post('ukrproduk', TRUE);
        $stok        = $this->data_model->get_byid('stok_produk', ['kode_varians'=>$modelProduk, 'ukuran'=>$ukrproduk]);
        $jumlah_stok = $stok->num_rows();
        if($jumlah_stok > 0){
            echo json_encode(array("statusCode" => 200, "message" => $jumlah_stok));
        } else {
            echo json_encode(array("statusCode" => 500, "message" => "Stok Kosong"));
        }
    }
    function simpanPenjualan(){
        $codejual           = $this->input->post('codejual', TRUE);
        $tglJual            = $this->input->post('tglJual', TRUE);
        $kirimKe            = $this->input->post('kirimKe', TRUE);
        $namaCus            = $this->input->post('namaCus', TRUE);
        $platformPenjualan  = $this->input->post('platformPenjualan', TRUE);
        $codeProduk         = $this->input->post('codeProduk', TRUE);
        $modelProduk        = $this->input->post('modelProduk', TRUE);
        $ukrproduk          = $this->input->post('ukrproduk', TRUE);
        $jmlPenjualan       = $this->input->post('jmlPenjualan', TRUE);
        $ex                 = explode('-', $tglJual);
        $exTanggal          = $ex[0];
        if($exTanggal=="2025"){
            $no_inv = "0";
        } else {
            $qr = $this->db->query("SELECT * FROM t_penjualan WHERE YEAR(tgl_jual) = '$exTanggal'")->num_rows();
            if($qr == 0){
                $no_inv = 1;
            } else {
                $qr = $this->db->query("SELECT id_jual,tgl_jual,no_inv FROM t_penjualan WHERE YEAR(tgl_jual) = '$exTanggal' ORDER BY id_jual DESC")->row("no_inv");
                $no_inv = intval($qr) + 1;
            }
        }
        if($codejual!="" && $tglJual!="" && $kirimKe!="" && $namaCus!="" && $platformPenjualan!=""){
            $cekCodeJual    = $this->data_model->get_byid('t_penjualan',['codejual'=>$codejual])->num_rows();
            $cekStok        = $this->data_model->get_byid('stok_produk',['kode_varians'=>$modelProduk,'ukuran'=>$ukrproduk])->num_rows();
            if($cekCodeJual==0){
                $this->data_model->saved('t_penjualan',[
                    'tgl_jual'          => $tglJual,
                    'tgl_input'         => date('Y-m-d H:i:s'),
                    'yg_input'          => $this->session->userdata('username'),
                    'codejual'          => $codejual,
                    'tujuan_kirim'      => $kirimKe,
                    'nama_customer'     => strtoupper($namaCus),
                    'total_dibayar'     => 0,
                    'tipe_bayar'        => 'null',
                    'bukti_bayar'       => 'null',
                    'platfom'           => $platformPenjualan,
                    'status_pembayaran' => 'Belum Lunas',
                    'status_pengiriman' => 'Belum Kirim',
                    'harga_totalproduk' => 0,
                    'ongkir'            => 0,
                    'no_inv'            => $no_inv
                ]);
            } else {
                $this->data_model->updatedata('codejual',$codejual,'t_penjualan',[
                    'tgl_jual'      => $tglJual,
                    'tujuan_kirim'  => $kirimKe,
                    'nama_customer' => strtoupper($namaCus),
                    'platfom'       => $platformPenjualan
                ]);
            }
            if($codeProduk == ""){
                $rxt = "Data Penjualan";
                echo json_encode(array("statusCode" => 200, "message" => $rxt));
            } else {
                if($codeProduk!="" && $modelProduk!="" && $ukrproduk!="" && $jmlPenjualan!=""){
                    if($jmlPenjualan>0 && $jmlPenjualan <= $cekStok){
                        //pindahkan data stok ke stok terjual
                        $stokSedia   = $this->db->query("SELECT * FROM stok_produk WHERE kode_varians='$modelProduk' AND ukuran='$ukrproduk' ORDER BY id_stokproduk ASC LIMIT $jmlPenjualan");
                        $total_modal = 0; $harga_terakhir = "";
                        foreach($stokSedia->result() as $val){
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
                            if($harga_jual_edit == 0){
                                $harga_terakhir = $harga_jual;
                            } else {
                                $harga_terakhir = $harga_jual_edit;
                            }
                            $total_modal+=$hpp;
                            $this->data_model->saved('stok_produk_terjual',[
                                'id_stokproduk'     => $id_stokproduk,
                                'kode_produk'       => $kode_produk,
                                'kode_varians'      => $kode_varians,
                                'ukuran'            => $ukuran,
                                'hpp'               => $hpp,
                                'harga_jual'        => $harga_jual,
                                'codeproduksijahit' => $codeproduksijahit,
                                'kode_produksi'     => $kode_produksi,
                                'codestok'          => $codestok,
                                'codejual'          => $codejual,
                            ]);
                            $this->data_model->delete('stok_produk', 'id_stokproduk', $id_stokproduk);
                        }
                        $this->data_model->saved('t_penjualan_data',[
                            'codejual'          => $codejual,
                            'kodeproduk'        => $codeProduk,
                            'kodevarians'       => $modelProduk,
                            'ukuran'            => $ukrproduk,
                            'jumlah_terjual'    => $jmlPenjualan,
                            'total_modal'       => $total_modal,
                            'harga_jual'        => $harga_terakhir
                        ]);
                        $rxt = "Data Penjualan";
                        echo json_encode(array("statusCode" => 200, "message" => $rxt));
                    } else {
                        echo json_encode(array("statusCode" => 203, "message" => "Jumlah stok tidak mencukupi.!"));
                    }
                } else {
                    echo json_encode(array("statusCode" => 203, "message" => "Anda belum mengisi semua dengan lengkap.!"));
                }   
            }
        } else {
            echo json_encode(array("statusCode" => 203, "message" => "Anda harus mengisi semua data.!"));
        }
    }
    function get_detil_jual(){
        $codejual  = $this->input->post('codejual', TRUE);
        $data2     = $this->data_model->get_byid('t_penjualan',['codejual'=>$codejual])->row_array();
        $tgl_input = date('d M Y H:i:s', strtotime($data2['tgl_input']));
        $yg        = $data2['yg_input'];
        $byr       = $data2['total_dibayar'];
        $byr2      = $data2['tipe_bayar'];
        $cus       = $data2['nama_customer'];
        $stbyr     = $data2['status_pembayaran'];
        $stskrm    = $data2['status_pengiriman'];
        $tgl       = date('d M Y', strtotime($data2['tgl_jual']));
        $data      = $this->data_model->get_byid('t_penjualan_data',['codejual'=>$codejual]);
        if($data->num_rows() > 0){
            ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Produk</th>
                        <th>Model</th>
                        <th>Ukuran</th>
                        <th>Jumlah</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
            <?php $n=1;
            foreach($data->result() as $val){
                $x   = explode(' - ', $val->kodeproduk);
                $_id = $val->id_pjdt;
                $kdv = $val->kodevarians;
                $varians = $this->data_model->get_byid('master_produk_varians',['kode_varians'=>$kdv])->row("models");
                echo "<tr>";
                echo "<td>".$n."</td>";
                echo "<td>".$x[1]."</td>";
                echo "<td>".$varians."</td>";
                echo "<td>".$val->ukuran."</td>";
                echo "<td>".$val->jumlah_terjual."</td>";
                ?>
                <td><a href="javascript:void(0);" style="color:red;" onclick="hapusPenjualan('<?=$codejual;?>','detil','<?=$_id;?>')"><i class="bi bi-trash"></i></a></td>
                <?php
                echo "</tr>";
                $n++;
            }
            echo "</tbody></table><hr>";
            ?>
            <div style="display:flex;align-items:center;justify-content:space-between;">
                <small style="color:green;"><i class="bi bi-bag-check"></i> Penjualan Disimpan</small>
                <small style="color:#474747;font-size:11px;"><i class="bi bi-clock"></i> <?=$tgl_input." - ".$yg;?>,</small>
            </div>
            <div style="display:flex;align-items:center;justify-content:space-between;">
                <?php if($byr2 == "null"){ ?>
                    <a href="javascript:void(0);" onclick="inputPembayaran('<?=$codejual;?>','<?=$cus;?>','<?=$tgl;?>')"><small style="color:red;"><i class="bi bi-coin"></i> Harga dan Pembayaran belum diinput</small></a>
                <?php } else { ?>
                    <a href="javascript:void(0);" onclick="inputPembayaran('<?=$codejual;?>','<?=$cus;?>','<?=$tgl;?>')"><small style="color:green;"><i class="bi bi-coin"></i> Harga dan Pembayaran Disimpan</small></a>
                <?php } ?>
                <a href="javascript:void(0);" onclick="hapusPenjualan('<?=$codejual;?>','utama','0')"><small style="color:red;"> Hapus Data Penjualan <i class="bi bi-trash"></i></small></a>
            </div>
            <div style="display:flex;align-items:center;justify-content:space-between;">
                <?php if($stbyr == "Lunas"){ ?>
                <small style="color:green;"><i class="bi bi-check-circle-fill"></i> Pembayaran Lunas</small>
                <?php } else { ?>
                <small style="color:red;"><i class="bi bi-x-circle-fill"></i> Pembayaran Belum Lunas</small>
                <?php } ?>
                <a href="<?=base_url('invoice/'.$codejual);?>" target="_blank"><small style="color:#2d2d2d;cursor:pointer;">Cetak Invoice <i class="bi bi-printer-fill"></i> </small></a>
            </div>
            <div style="display:flex;align-items:center;justify-content:space-between;">
                <?php if($stskrm == "Belum Kirim"){ ?>
                <small style="color:red;"><i class="bi bi-shop"></i> Belum Dikirim</small>
                <?php } elseif($stskrm == "Antrian Kirim") { ?>
                <small style="color:#ccc;"><i class="bi bi-cart2"></i> Dalam antrian pengiriman</small>
                <?php } else { ?>
                <small style="color:green;"><i class="bi bi-cart-check-fill"></i> Sudah Dikirim</small>
                <?php } ?>
                <small style="color:#2d2d2d;cursor:pointer;" onclick="copyThis('<?=base_url('invoice/'.$codejual);?>')">Copy url invoice <i class="bi bi-clipboard-check"></i></small>
            </div>
            <?php
        }
    }
    function delete_penjualan(){
        $codejual   = $this->input->post('codejual', TRUE);
        $type       = $this->input->post('type', TRUE);
        $id         = $this->input->post('id', TRUE);
        if($type=="utama"){
            $this->data_model->delete('t_penjualan_data', 'codejual', $codejual);
            $this->data_model->delete('t_penjualan', 'codejual', $codejual);
            $allproduk = $this->data_model->get_byid('stok_produk_terjual',['codejual'=>$codejual]);
            foreach($allproduk->result() as $val){
                $id_stokproduk      = $val->id_stokproduk;
                $kode_produk        = $val->kode_produk;
                $kode_varians       = $val->kode_varians;
                $ukuran             = $val->ukuran;
                $hpp                = $val->hpp;
                $harga_jual         = $val->harga_jual;
                $codeproduksijahit  = $val->codeproduksijahit;
                $kode_produksi      = $val->kode_produksi;
                $codestok           = $val->codestok;
                $this->data_model->saved('stok_produk',[
                    'id_stokproduk'     => $id_stokproduk,
                    'kode_produk'       => $kode_produk,
                    'kode_varians'      => $kode_varians,
                    'ukuran'            => $ukuran,
                    'hpp'               => $hpp,
                    'harga_jual'        => $harga_jual,
                    'codeproduksijahit' => $codeproduksijahit,
                    'kode_produksi'     => $kode_produksi,
                    'codestok'          => $codestok
                ]);
            }
            $this->data_model->delete('stok_produk_terjual', 'codejual', $codejual);
            echo json_encode(array("statusCode" => 200, "message" => "Data Penjualan Telah Dihapus!"));
        } else {
            $rows    = $this->data_model->get_byid('t_penjualan_data',['id_pjdt'=>$id])->row_array();
            $kodevar = $rows['kodevarians'];
            $ukuran  = $rows['ukuran'];
            $allproduk = $this->data_model->get_byid('stok_produk_terjual',['kode_varians'=>$kodevar,'ukuran'=>$ukuran,'codejual'=>$codejual]);
            foreach($allproduk->result() as $val){
                $id_stokproduk      = $val->id_stokproduk;
                $kode_produk        = $val->kode_produk;
                $kode_varians       = $val->kode_varians;
                $ukuran             = $val->ukuran;
                $hpp                = $val->hpp;
                $harga_jual         = $val->harga_jual;
                $codeproduksijahit  = $val->codeproduksijahit;
                $kode_produksi      = $val->kode_produksi;
                $codestok           = $val->codestok;
                $this->data_model->saved('stok_produk',[
                    'id_stokproduk'     => $id_stokproduk,
                    'kode_produk'       => $kode_produk,
                    'kode_varians'      => $kode_varians,
                    'ukuran'            => $ukuran,
                    'hpp'               => $hpp,
                    'harga_jual'        => $harga_jual,
                    'codeproduksijahit' => $codeproduksijahit,
                    'kode_produksi'     => $kode_produksi,
                    'codestok'          => $codestok
                ]);
            }
            $this->db->query("DELETE FROM stok_produk_terjual WHERE codejual='$codejual' AND kode_varians='$kodevar' AND ukuran='$ukuran'");
            $this->data_model->delete('t_penjualan_data', 'id_pjdt', $id);
        }
    }
    function datapenjualan(){
        $record = $this->data_model->sort_record('tgl_jual','t_penjualan');
        if($record->num_rows() > 0){
            $no=1;
            foreach($record->result() as $val){
                $codejual           = $val->codejual;
                $harga_total_produk = $val->harga_totalproduk;
                $status_pembayaran  = $val->status_pembayaran;
                $status_pengiriman  = $val->status_pengiriman;
                $jml                = $this->data_model->get_byid('stok_produk_terjual',['codejual'=>$codejual])->num_rows();
                $cus                = strtolower($val->nama_customer);
                
                echo "<tr>";
                echo "<td>".$no."</td>";
                echo "<td>".date('d M Y', strtotime($val->tgl_jual))."</td>";
                    if($val->tujuan_kirim == "Customer"){
                        echo "<td>".$val->tujuan_kirim."</td>";
                    } else {
                        echo "<td style='color:red;'>".$val->tujuan_kirim."</td>";
                    }
                echo "<td>".ucwords($cus)."</td>";
                echo "<td>".$jml." Pcs</td>";
                if($val->harga_totalproduk == 0){
                    echo "<td>".$val->harga_totalproduk."</td>";
                } else {
                    echo "<td style='color:#066fba;'>Rp. ".number_format($val->harga_totalproduk)."</td>";
                }
                echo "<td>".number_format($val->ongkir,0,',','.')."</td>";
                echo "<td>".$val->platfom."</td>";
                //echo "<td>".$_status."</td>";
                ?>
                <td>
                    <?php
                    if($status_pembayaran == "Belum Lunas"){
                        ?><span class="badge bg-danger badge-sm" onclick="cekStatus('<?=$codejual;?>')" style="cursor:pointer;">Belum Lunas</span><?php
                    } else {
                        if($status_pengiriman=="Belum Kirim"){ ?><span class="badge bg-danger badge-sm" onclick="cekStatus('<?=$codejual;?>')" style="cursor:pointer;">Belum Kirim</span><?php }
                        if($status_pengiriman=="Antrian Kirim"){ ?><span class="badge bg-warning badge-sm" onclick="cekStatus('<?=$codejual;?>')" style="cursor:pointer;">Antrian Kirim</span> <?php }
                        if($status_pengiriman=="Kirim"){ ?><span class="badge bg-success badge-sm" onclick="cekStatus('<?=$codejual;?>')" style="cursor:pointer;">Dikirim</span><?php }
                    }
                    ?>
                </td>
                <td><span class="badge bg-success" style="cursor:pointer;" onclick="showPenjualan('<?=$val->codejual;?>')"><i class="bi bi-three-dots"></i></span></td>
                <?php
                echo "</tr>";
                $no++;  
            }
        }
    }
    function loadPenjualan(){
        $codejual  = $this->input->post('codejual', TRUE);
        $datas     = $this->data_model->get_byid('t_penjualan',['codejual'=>$codejual]);
        if($datas->num_rows() == 1){
            $row            = $datas->row_array();
            $tgl_jual       = $row['tgl_jual'];
            $tujuan_kirim   = $row['tujuan_kirim'];
            $nama_customer  = $row['nama_customer'];
            $platfom        = $row['platfom'];
            echo json_encode(array("statusCode" => 200, "tgl_jual" => $tgl_jual, "tujuan_kirim" => $tujuan_kirim, "nama_customer" => $nama_customer, "platfom" => $platfom, "message" => "Data Ditemukan.!"));
        } else {
            echo json_encode(array("statusCode" => 203, "message" => "Data Penjualan Tidak Ditemukan.!"));
        }
    }
    function newCodeJual(){
        $kode_jual = $this->data_model->acakKode(27);
        echo json_encode(array("statusCode" => 200, "message" => $kode_jual));
    }
    function simpanprosesbayar(){
        $codejual   = $this->input->post('codejual', TRUE);
        $nominalid  = $this->input->post('nominalid', TRUE);
        $nominalid  = preg_replace('/\D/', '', $nominalid);
        $pembid     = $this->input->post('pembid', TRUE);
        $idpjt     = $this->input->post('idpjt', TRUE);
        $hrgJual     = $this->input->post('hrgJual', TRUE);
        $this->load->library('upload');
        $upload_path = './uploads/buktibayar/';
        $new_file_name = $this->data_model->get_byid('t_penjualan', ['codejual'=>$codejual])->row("bukti_bayar");
        //$new_file_name = "null";
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'jpg|jpeg|png|svg';
        $config['max_size'] = 2048; // Ukuran maksimal dalam KB (2 MB)
        $config['file_name'] = 'bukti-bayar-' . $codejual; // Nama file yang disesuaikan dengan tanggal dan waktu
        $config['overwrite'] = TRUE; // timpa file yang sudah ada
        // echo "<pre>";
        // print_r($hrgJual);
        // echo "</pre>";
        $this->upload->initialize($config);

        if ($this->upload->do_upload('file')) {
            // Jika berhasil diupload
            $file_data = $this->upload->data();

            // Simpan nama file yang telah diubah
            $new_file_name = $file_data['file_name'];

            // Lakukan proses lebih lanjut, misalnya simpan ke database
            // Contoh: $this->db->insert('uploads', ['file_name' => $new_file_name]);

            $this->session->set_flashdata('success', 'File berhasil diupload!');
            $upload_data = "yes";
            
        } else {
            // Jika gagal upload
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('error', $error);
            //echo $error;
            //exit();
            //redirect('upload');
            $upload_data = "no";
        }
        if($upload_data == "yes"){
            $this->data_model->updatedata('codejual',$codejual,'t_penjualan',[
                'tipe_bayar'    => $pembid,
                'bukti_bayar'   => $new_file_name,
                'ongkir'        => $nominalid
            ]);
        } else {
            $this->data_model->updatedata('codejual',$codejual,'t_penjualan',[
                'tipe_bayar'    => $pembid,
                'ongkir'        => $nominalid
            ]);
        }
        for ($i=0; $i <count($hrgJual) ; $i++) { 
            $newharga  = preg_replace('/\D/', '', $hrgJual[$i]);
            $this->data_model->updatedata('id_pjdt',$idpjt[$i], 't_penjualan_data', ['harga_jual'=>$newharga]);
        }
        $new = $this->data_model->get_byid('t_penjualan_data',['codejual'=>$codejual])->result();
        $total_harga = 0;
        foreach($new as $kl){
            $pcs = $kl->jumlah_terjual;
            $hrj = $kl->harga_jual;
            $harga_jual = $pcs * $hrj;
            $total_harga+=$harga_jual;
        }
        $this->data_model->updatedata('codejual',$codejual,'t_penjualan',[
            'harga_totalproduk'    => $total_harga
        ]);
        redirect('mutasi/penjualan');
    }
    function showPembayaran(){
        $codejual   = $this->input->post('codejual', TRUE);
        $datas      = $this->data_model->get_byid('t_penjualan',['codejual'=>$codejual]);
        if($datas->num_rows() == 1){
            $row            = $datas->row_array();
            $total_dibayar  = $row['total_dibayar'];
            $tipe_bayar     = $row['tipe_bayar'];
            $bukti_bayar    = $row['bukti_bayar'];
            $ongkir         = $row['ongkir'];
            $total_dibayar  = number_format($total_dibayar,0,',','.');
            $ongkir2  = number_format($ongkir,0,',','.');
            echo json_encode(array("statusCode" => 200, "total_dibayar" => $total_dibayar, "tipe_bayar" => $tipe_bayar, "bukti_bayar" => $bukti_bayar, "ongkir"=>$ongkir2, "message" => "Data Ditemukan.!"));
        }
    }
    function showPembayaranTable(){
        $codejual   = $this->input->post('codejual', TRUE);
        $datas      = $this->data_model->get_byid('t_penjualan_data',['codejual'=>$codejual])->result();
        ?>
        <table class="table table-bordered">
            <tr>
                <th>Produk</th>
                <th>Qty</th>
                <th>Harga Satuan</th>
                <th>Harga Total</th>
            </tr>
            <?php
            $total_qty=0; $total_harga=0;
            foreach($datas as $val){
                $kd         = explode(' - ', $val->kodeproduk);
                $nm         = $kd[1];
                $kodevar    = $val->kodevarians;
                $models     = $this->data_model->get_byid('master_produk_varians', ['kode_varians'=>$kodevar])->row("models");
                $ukr        = $val->ukuran;
                $jml        = $val->jumlah_terjual;
                $id_pjdt    = $val->id_pjdt;
                $_hrgJual1  = $val->harga_jual;
                $_hrgJual2  = $val->harga_jual;
                $harga_jual = number_format($val->harga_jual,0,',','.');
                $harga_ttl2  = $val->harga_jual * $jml;
                $harga_ttl  = number_format($harga_ttl2,0,',','.');
                $total_qty+=$jml;
                $total_harga+=$harga_ttl2;
                ?>
                <tr>
                    <td><?=$nm." ".$models." - ".$ukr;?><input type="hidden" class="form-control idpjt" name="idpjt[]" value="<?=$id_pjdt;?>"></td>
                    <td><?=$jml;?><input type="hidden" class="form-control qty" name="qty[]" value="<?=$jml;?>"></td>
                    <td><input type="text" class="form-control hrgJual" name="hrgJual[]" value="<?=$harga_jual;?>"></td>
                    <td><input type="text" class="form-control hrgTotal" name="hrgTotal[]" value="<?=$harga_ttl;?>"></td>
                </tr>
                <?php
            }
            ?>
            <tr>
                <td><strong>Total</strong></td>
                <td><strong><?=$total_qty;?></strong></td>
                <td></td>
                <td id="tdTotal"><strong>Rp. <?=number_format($total_harga,0,',','.');?></strong></td>
            </tr>
        </table>
        <?php
    }
    function showPembayaranKonsumen(){
        $codejual   = $this->input->post('txt', TRUE);
        $rec        = $this->data_model->get_byid('t_penjualan_bayar',['codejual'=>$codejual]);
        $rows       = $this->data_model->get_byid('t_penjualan',['codejual'=>$codejual])->row_array();
        $ttl_tgh    = $rows['harga_totalproduk'] + $rows['ongkir'];
        ?>
        <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tanggal Bayar</th>
                <th>Nominal</th>
                <th>#</th>
            </tr>
        </thead>
        <?php
        if($rec->num_rows() > 0){
            $ttl_byr = 0;
            foreach($rec->result() as $val){
                echo "<tr>";
                echo "<td>".date('d M Y', strtotime($val->tgl_bayar))."</td>";
                echo "<td>Rp. ".number_format($val->nominal)."</td>";
                $ttl_byr+=$val->nominal;
                ?>
                <td>
                    <a href="javascript:void(0);" onclick="thisHapus('<?=$val->id_tpb;?>','<?=$codejual;?>')"><span class="badge badge-sm bg-danger">Hapus</span></a>
                </td>
                <?php
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3' style='color:red;'>Belum ada pembayaran</td></tr>";
        }
        $sisa_tgh = $ttl_tgh - $ttl_byr;
        ?>
        <tr>
            <td>Total Pembayaran</td>
            <td>Rp. <?=number_format($ttl_byr,0,',','.');?></td>
            <td></td>
        </tr>
        <tr>
            <th>Total Tagihan</th>
            <th>Rp. <?=number_format($ttl_tgh,0,',','.');?></th>
            <td></td>
        </tr>
        <tr>
            <th style="color:red;">Sisa Tagihan</th>
            <th style="color:red;">Rp. <?=number_format($sisa_tgh,0,',','.');?></th>
            <td></td>
        </tr>
        <tr id="idPembay" style="display:none;">
            <td>
                <input type="date" class="form-control" id="thTgl">
            </td>
            <td>
                <input type="text" class="form-control" oninput="formatRibuan(this)" placeholder="0" id="thNomni">
            </td>
            <td><button class="btn btn-success" onclick="thisSimpan('<?=$codejual;?>')">Simpan</button></td>
        </tr>
        <?php
        echo "</table>";
        if($rows['status_pembayaran'] == "Belum Lunas"){
            ?>
            <a href="javascript:void(0);">
                <button class="btn btn-success" onclick="jadikanLunas('<?=$codejual;?>')">Jadikan Lunas</button>
            </a>
            <a href="javascript:void(0);">
                <button class="btn btn-primary" onclick="showPems()">Input Pembayaran</button>
            </a>
            <hr>
            <div style="font-size:13px;">
            <strong>Note : </strong>Jika anda menjadikan lunas, maka pembayaran akan di input hanya 1x sesuai dengan nominal tagihan dan tanggal pembelian</div>
            <?php
        } else {
            if($rows['status_pengiriman'] == "Antrian Kirim"){
            ?>
            <hr>
            <div style="font-size:13px;">
            <strong>Note : </strong>Pembayaran telah <strong style="color:green;">lunas</strong>. Menunggu paket untuk di kirim ke konsumen.</div>
            <hr>
            <a href="javascript:void(0);">
                <button class="btn btn-success" onclick="jadikanTerkirim('<?=$codejual;?>')">Tandai Sudah Di Kirim</button>
            </a>
            <?php } else { 
                echo "<hr>";
                echo '<div style="font-size:13px;"><strong>Note : </strong>Pembayaran telah <strong style="color:green;">lunas</strong>. Paket telah dikirim ke konsumen.</div><hr>';
            }
        }
    }
    function inputbyr(){
        $tgl = $this->input->post('tgl', TRUE);
        $nom = $this->input->post('nom', TRUE);
        $nominal  = preg_replace('/\D/', '', $nom);
        $codejual = $this->input->post('cd', TRUE);
        if($tgl != "" && $nominal > 0 && $codejual != "" ){
            $this->data_model->saved('t_penjualan_bayar', ['codejual'=>$codejual, 'tgl_bayar'=>$tgl, 'tgl_input'=>date('Y-m-d H:i:s'), 'nominal'=>$nominal, 'yginput'=>$this->session->userdata('username')]);

            $row = $this->data_model->get_byid('t_penjualan', ['codejual'=>$codejual])->row_array();
            $hp  = $row['harga_totalproduk']; 
            $on  = $row['ongkir']; 
            $all = $hp + $on;
            $byr = $this->db->query("SELECT SUM(nominal) AS jml FROM t_penjualan_bayar WHERE codejual='$codejual'")->row("jml");
            if($byr < $all){
                $this->data_model->updatedata('codejual', $codejual, 't_penjualan', ['total_dibayar'=>$byr, 'status_pembayaran'=>'Belum Lunas', 'status_pengiriman'=>'Belum Kirim']);
            } else {
                $this->data_model->updatedata('codejual', $codejual, 't_penjualan', ['total_dibayar'=>$byr, 'status_pembayaran'=>'Lunas', 'status_pengiriman'=>'Antrian Kirim']);
            }

            echo json_encode(array("statusCode" => 200, "message" => "Pembayaran berhasil disimpan"));
        } else {
            echo json_encode(array("statusCode" => 500, "message" => "Data belum lengkap"));
        }
    } //endt
    function hpsbyr(){
        $id = $this->input->post('id', TRUE);
        $cd = $this->input->post('cd', TRUE);
        $this->data_model->delete('t_penjualan_bayar', 'id_tpb', $id);
        $row = $this->data_model->get_byid('t_penjualan', ['codejual'=>$cd])->row_array();
        $hp  = $row['harga_totalproduk']; 
        $on  = $row['ongkir']; 
        $all = $hp + $on;
        $byr = $this->db->query("SELECT SUM(nominal) AS jml FROM t_penjualan_bayar WHERE codejual='$cd'")->row("jml");
        if($byr < $all){
            $this->data_model->updatedata('codejual', $cd, 't_penjualan', ['total_dibayar'=>$byr, 'status_pembayaran'=>'Belum Lunas', 'status_pengiriman'=>'Belum Kirim']);
        } else {
            $this->data_model->updatedata('codejual', $cd, 't_penjualan', ['total_dibayar'=>$byr, 'status_pembayaran'=>'Lunas', 'status_pengiriman'=>'Antrian Kirim']);
        }
        echo "oke";
    }
    function lunaskan(){
        $id  = $this->input->post('cd', TRUE);
        $row = $this->data_model->get_byid('t_penjualan', ['codejual'=>$id])->row_array();
        $hp  = $row['harga_totalproduk']; 
        $on  = $row['ongkir']; 
        $all = $hp + $on;
        $this->data_model->updatedata('codejual', $id, 't_penjualan', ['total_dibayar'=>$all, 'status_pembayaran'=>'Lunas', 'status_pengiriman'=>'Antrian Kirim']);
        $this->data_model->saved('t_penjualan_bayar', ['codejual'=>$id, 'tgl_bayar'=>date('Y-m-d'), 'tgl_input'=>date('Y-m-d H:i:s'), 'nominal'=>$all, 'yginput'=>$this->session->userdata('username')]);
        echo "oke";
    }
    function terkirim(){
        $id  = $this->input->post('cd', TRUE);
        $this->data_model->updatedata('codejual', $id, 't_penjualan', ['status_pengiriman'=>'Kirim']);
        echo "oke";
    }
}