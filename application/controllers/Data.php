<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->model('data_model');
        date_default_timezone_set("Asia/Jakarta");
    }

    function index(){
        echo "Error Token..";
    }
    public function loadKain(){
        $cekTable = $this->data_model->get_record('master_kain');
        if($cekTable->num_rows() > 0){
            $no=1;
            foreach($cekTable->result() as $row){
                $id_kain = $row->id_kain;
                $nm_kain = $row->nama_kain;
                $konstruksi_kain = $row->konstruksi_kain;
                $inisial = $row->inisial;
                echo "<tr id='idrow".$id_kain."'>";
                echo "<td>".$no."</td>";
                echo "<td>".$nm_kain."</td>";
                echo "<td>".$konstruksi_kain."</td>";
                //echo "<td>".$inisial."</td>";
                ?><td><span class="badge bg-light-danger"><?=$inisial;?></span></td><?php
                ?>
                <td style="color:red;">
                    <div class="btn-group mb-1">
                        <div class="dropdown">
                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#large2" onclick="updateKain('<?=$id_kain;?>','<?=$nm_kain;?>','<?=$konstruksi_kain;?>','<?=$inisial;?>')">Edit</a>
                                <a class="dropdown-item" href="javascript:void(0);" onclick="hapusKain('<?=$id_kain;?>','<?=$nm_kain;?>')">Hapus</a>
                            </div>
                        </div>
                    </div>
                </td>
                <?php
                echo "</tr>";
                $no++;
            }
        }
    } //END
    public function loadPenjahit(){
        $cekTable = $this->data_model->get_record('master_penjahit');
        if($cekTable->num_rows() > 0){
            $no=1;
            foreach($cekTable->result() as $row){
                $id_penjahit = $row->id_penjahit;
                $nm_penjahit = $row->nama_penjahit;
                $alamat = $row->alamat;
                $kode_penjahit = $row->kode_penjahit;
                $harga_penjahit = $row->harga_jahitan;
                $cekList = $this->data_model->get_byid('master_jahiten', ['kode_penjahit'=>$kode_penjahit]);
                echo "<tr id='idrow".$id_penjahit."'>";
                echo "<td>".$no."</td>";
                echo "<td>".$nm_penjahit."</td>";
                //echo "<td>".$kode_penjahit."</td>";
                ?><td><span class="badge bg-light-danger"><?=$kode_penjahit;?></span></td><?php
                if($cekList->num_rows() == 0){
                    echo "<td style='color:red;'>Not Set</td>";
                } else {
                    ?>
                    <td>
                        <a href="javascript:void(0);" onclick="updateHarga('<?=$kode_penjahit;?>')" data-bs-toggle="modal" data-bs-target="#modalHarga">List Harga</a>
                    </td>
                    <?php
                }
                ?>
                <td style="color:red;">
                    <div class="btn-group mb-1">
                        <div class="dropdown">
                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0);" onclick="updateHarga('<?=$kode_penjahit;?>')" data-bs-toggle="modal" data-bs-target="#modalHarga">Update Harga Jahit</a>
                                <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#large2" onclick="updatePenjahit('<?=$id_penjahit;?>','<?=$nm_penjahit;?>','<?=$kode_penjahit;?>','<?=$harga_penjahit;?>','<?=$alamat;?>')">Edit Data</a>
                                <a class="dropdown-item" href="javascript:void(0);" onclick="hapusPenjahit('<?=$id_penjahit;?>','<?=$nm_penjahit;?>')">Hapus</a>
                            </div>
                        </div>
                    </div>
                </td>
                <?php
                echo "</tr>";
                $no++;
            }
        }
    } //END
    public function loadPembatik(){
        $cekTable = $this->data_model->get_record('master_pembatik');
        if($cekTable->num_rows() > 0){
            $no=1;
            foreach($cekTable->result() as $row){
                $id_pembatik = $row->id_pembatik;
                $nm_pembatik = $row->nama_pembatik;
                $alamat = $row->alamat;
                $kode_pembatik = $row->kode_pembatik;
                echo "<tr id='idrow".$id_pembatik."'>";
                echo "<td>".$no."</td>";
                echo "<td>".$nm_pembatik."</td>";
                ?><td><span class="badge bg-light-danger"><?=$kode_pembatik;?></span></td><?php
                echo "<td>".$alamat."</td>";
                ?>
                <td style="color:red;">
                    <div class="btn-group mb-1">
                        <div class="dropdown">
                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#large2" onclick="updatePembatik('<?=$id_pembatik;?>','<?=$nm_pembatik;?>','<?=$kode_pembatik;?>','<?=$alamat;?>')">Edit Data</a>
                                <a class="dropdown-item" href="javascript:void(0);" onclick="hapusPembatik('<?=$id_pembatik;?>','<?=$nm_pembatik;?>')">Hapus</a>
                            </div>
                        </div>
                    </div>
                </td>
                <?php
                echo "</tr>";
                $no++;
            }
        }
    } //END
    function loadProduk(){
        $cekTable = $this->data_model->get_record('master_produk');
        if($cekTable->num_rows() > 0){
            $no=1;
            foreach($cekTable->result() as $row){
                $id_produk = $row->id_produk;
                $nm_produk = $row->nama_produk;
                $kd_produk = $row->kode_produk;
                $varians   = $this->data_model->get_byid('master_produk_varians', ['kode_produk'=>$kd_produk])->num_rows();
                echo "<tr id='idrow".$id_produk."'>";
                echo "<td>".$no."</td>";
                ?>
                <td>
                    <span class="badge bg-success"><?=$kd_produk;?></span>
                </td>
                <td><?=$nm_produk;?></td>
                <td>
                    <a href="javascript:void(0);" class="btn btn-secondary btn-sm" onclick="showVarian('<?=$kd_produk;?>','<?=$nm_produk;?>')" data-bs-toggle="modal" data-bs-target="#modalVarianShow"><?=$varians;?> Model</a>
                </td>
                <td style="color:red;">
                    <div class="btn-group mb-1">
                        <div class="dropdown">
                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#large" onclick="updateProduk('<?=$id_produk;?>','<?=$nm_produk;?>','<?=$kd_produk;?>')">Edit Produk</a>
                                <a class="dropdown-item" href="javascript:void(0);" onclick="updateVarian('<?=$kd_produk;?>','<?=$nm_produk;?>')" data-bs-toggle="modal" data-bs-target="#modalVarian">Tambah Model</a>
                                <a class="dropdown-item" href="javascript:void(0);" onclick="hapusProduk('<?=$id_produk;?>','<?=$nm_produk;?>')">Hapus</a>
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
    public function loadPtg(){
        $cekTable = $this->data_model->get_record('master_pemotong');
        if($cekTable->num_rows() > 0){
            $no=1;
            foreach($cekTable->result() as $row){
                $id_ptg = $row->id_ptg;
                $nm_ptg = $row->nama_ptg;
                $alamat = $row->alamat;
                $kode_ptg = $row->kode_ptg;
                echo "<tr id='idrow".$id_ptg."'>";
                echo "<td>".$no."</td>";
                echo "<td>".$nm_ptg."</td>";
                //echo "<td>".$kode_penjahit."</td>";
                ?><td><span class="badge bg-light-danger"><?=$kode_ptg;?></span></td><?php
                echo "<td>".$alamat."</td>";
                ?>
                <td style="color:red;">
                    <div class="btn-group mb-1">
                        <div class="dropdown">
                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#large2" onclick="updatePtg('<?=$id_ptg;?>','<?=$nm_ptg;?>','<?=$kode_ptg;?>','<?=$alamat;?>')">Edit</a>
                                <a class="dropdown-item" href="javascript:void(0);" onclick="hapusPtg('<?=$id_ptg;?>','<?=$nm_ptg;?>')">Hapus</a>
                            </div>
                        </div>
                    </div>
                </td>
                <?php
                echo "</tr>";
                $no++;
            }
        }
    } //END

    function loadpembeliankain(){
        $aks    = $this->session->userdata('akses');
        $record = $this->data_model->sort_record('tgl_pembelian','t_pembelian_kain');
        if($record->num_rows() > 0){
            $no=1;
            foreach($record->result() as $val){
                $kd = $val->codesave;
                $in = $val->inisial_kain;
                $ck = $this->data_model->get_byid('master_kain',['inisial'=>$in])->row_array();
                $tr = $ck['nama_kain']." - ".$ck['konstruksi_kain'];
                echo "<tr>";
                echo "<td>".$no."</td>";
                echo "<td>".date('d M Y', strtotime($val->tgl_pembelian))."</td>";
                ?><td><a href="#" data-bs-toggle="tooltip" title="<?=$tr;?>"><span class="badge bg-success"><?=$in;?></span></a></td><?php
                if($val->jumlah_pembelian == floor($val->jumlah_pembelian)){
                    echo "<td>".number_format($val->jumlah_pembelian,0,',','.')."</td>";
                } else {
                    echo "<td>".number_format($val->jumlah_pembelian,2,',','.')."</td>";
                }
                if($aks == "root"){
                    echo "<td>Rp. ".number_format($val->harga_peryard,0,',','.')."</td>";
                    echo "<td>Rp. ".number_format($val->harga_total_kain,0,',','.')."</td>";
                    echo "<td>Rp. ".number_format($val->bea_dll,0,',','.')."</td>";
                } else {
                    echo "<td>Rp. ******</td>";
                    echo "<td>Rp. ******</td>";
                    echo "<td>Rp. ******</td>";
                }
                echo "<td>".$val->nama_supplier."</td>";
                ?><td><a href="javascript:void(0);" onclick="showDetil('<?=$kd;?>')"><span class='badge bg-primary'>View</span></a></td><?php
                echo "</tr>";
                $no++;
            }
        }
    } //end
    function loadProdukVarians(){
        $kd = $this->input->post('kd', TRUE);
        $cek = $this->data_model->get_byid('master_produk_varians', ['kode_produk'=>$kd]);
        if($cek->num_rows() == 0){
            echo "Produk ini tidak memiliki model varian";
        } else {
            echo "<table class='table table-bordered'>";
            echo "<tr>";
            echo "<th>Kode Produk</th>";
            echo "<th>Nama Produk</th>";
            echo "<th>Model</th>";
            echo "<th>Hapus</th>";
            foreach($cek->result() as $val){
                echo "<tr id='akd".$val->id_varians."'>";
                echo "<td><span class='badge bg-success'>".$val->kode_varians."</span></td>";
                echo "<td>".$val->nama_produk."</td>";
                echo "<td>".$val->models."</td>";
                ?>
                <td>
                    <a href="javascript:void(0);" style="color:red;" onclick="hapusVarian('<?=$val->kode_varians;?>','<?=$val->id_varians;?>')">Hapus</a>
                </td>
                <?php
                
                echo "</tr>";
            }
        }
    } //END
    function loadStokKainBatik(){
        $cekTable = $this->db->query("SELECT * FROM stok_kain_proses_babar WHERE jumlah_pcs > 0");
        $arrKode  = array();
        if($cekTable->num_rows() > 0){
            foreach($cekTable->result() as $row){
                if(!in_array($row->kode_babar, $arrKode)){
                    $arrKode[] = $row->kode_babar;
                }
            } $no=1;
            foreach($arrKode as $val){
                $jml    = $this->db->query("SELECT SUM(jumlah_pcs) AS jml FROM stok_kain_proses_babar WHERE kode_babar='$val'")->row()->jml;
                $row2   = $this->db->query("SELECT * FROM stok_kain_proses_babar WHERE kode_babar='$val' LIMIT 1")->row_array(); 
                $cd     = $row2['codeproduksi'];
                $idp    = $this->data_model->get_byid('produksi_babar', ['codeproduksi'=>$cd])->row("id_produksi");
                echo "<tr>";
                echo "<td>".$no."</td>";
                ?>
                <td>
                    <a href="javascript:void(0);" onclick="showBabar('<?=$idp;?>')"><span class='badge bg-success'><?=$val;?></span></a>
                </td>
                <?php
                //echo "<td><span class='badge bg-success'>".$val."</span></td>";
                echo "<td>".$row2['kode_kain']."</td>";
                echo "<td>".$row2['proses_babar']."</td>";
                echo "<td>".$jml."</td>";
                echo "</tr>";
                $no++;
            }
        }
    }
    function loadStokKainPotongan(){
        $aks        = $this->session->userdata('akses');
        $cekTable   = $this->db->query("SELECT * FROM stok_kain_potongan WHERE jumlah_pcs > 0");
        if($cekTable->num_rows() > 0){
            $no=1;
            foreach($cekTable->result() as $row){
                $id_k_ptgan = $row->id_k_ptgan;
                $inisial    = $row->inisial_kain;
                $p          = $row->panjang_kain;
                $l          = $row->lebar_kain;
                $harga1     = $row->harga_pcs;
                $harga2     = $row->harga_ptg_pcs;
                $harga      = $harga1 + $harga2;
                $jumlah_pcs = $row->jumlah_pcs;
                $code_saved = $row->code_saved;
                $ukuran     = $p ." x ". $l;
                $xr         = $this->data_model->get_byid('master_kain',['inisial'=>$inisial])->row_array();
                $cr         = $this->data_model->get_byid('t_potong_kain',['codesaved'=>$code_saved])->row("id_tptg");
                $kode_kainp = $inisial."-".$p."-".sprintf('%03d', $cr);
                ?>
                <tr>
                    <td><?=$no;?></td>
                    <td><span class="badge bg-success"><?=$kode_kainp;?></span></td>
                    <td><?=$xr['nama_kain'];?></td>
                    <td><?=$xr['konstruksi_kain'];?></td>
                    <td><?=$ukuran;?> Meter</td>
                    <td><span class="badge bg-primary" style="cursor:pointer;" onclick="showDetilPtg('<?=$code_saved;?>')"><?=$jumlah_pcs;?></span></td>
                    <?php if($aks == "root"){ ?>
                    <td>Rp. <?=number_format($harga);?></td>
                    <?php } else { ?>
                    <td>Rp. ******</td>
                    <?php } ?>
                </tr>
                <?php

                $no++;
            }
        }
    }
    function loadStokKain(){
        $cekTable = $this->data_model->get_record('master_kain');
        if($cekTable->num_rows() > 0){
            $no=1;
            foreach($cekTable->result() as $row){
                $id_kain = $row->id_kain;
                $nm_kain = $row->nama_kain;
                $konstruksi_kain = $row->konstruksi_kain;
                $inisial = $row->inisial;
                $total_kain = $this->db->query("SELECT SUM(jumlah_stok) AS jml FROM stok_kain WHERE inisial_kain='$inisial'")->row()->jml;
                if(intval($total_kain) < 1){
                    $total_kain = 0;
                } else {
                    if($total_kain == floor($total_kain)){
                        $total_kain = number_format($total_kain,0,',','.');
                    } else {
                        $total_kain = number_format($total_kain,2,',','.');
                    }
                }
                echo "<tr id='idrow".$id_kain."'>";
                echo "<td>".$no."</td>";
                ?><td><span class="badge bg-success"><?=$inisial;?></span></td><?php
                echo "<td>".$nm_kain."</td>";
                echo "<td>".$konstruksi_kain."</td>";
                ?>
                <td>
                    <a href="javascript:void(0);" style="font-weight:bold;color:red;" data-bs-toggle="modal" data-bs-target="#large2" onclick="lihatKodeKain('<?=$inisial;?>')"><?=$total_kain;?></a>
                </td>
                <?php
                echo "<td>Yard</td>";
                echo "</tr>";
                $no++;
            }
        }
    }
    function lihatDetilKain(){
        $kd = $this->input->post('kd', TRUE);
        $cek = $this->db->query("SELECT DISTINCT codestok FROM stok_kain WHERE inisial_kain='$kd'");
        ?>
        <table class="table table-bordered">
            <tr>
                <th>Kode Kain</th>
                <th>Jumlah Stok</th>
                <th>Harga Per Yard</th>
            </tr>
            <?php
            foreach($cek->result() as $val){
            $x = explode('-', $val->codestok);
            $r = $val->codestok;
            $xx = number_format($x[1], 0, ',', '.');
            $jmlStok = $this->db->query("SELECT SUM(jumlah_stok) AS jml FROM stok_kain WHERE codestok='$r'")->row()->jml;
            if($jmlStok == floor($jmlStok)){
                $jmlStok = number_format($jmlStok,0,',','.');
            } else {
                $jmlStok = number_format($jmlStok,2,',','.');
            }
            ?>
            <tr>
                <td><?=$kd;?></td>
                <td><?=$jmlStok;?></td>
                <td>Rp. <?=$xx;?></td>
            </tr>
            <?php
            }
            ?>
        </table>
        <?php
    }
    function lihatStokKain(){
        $kd = $this->input->post('selectedValue', TRUE);
        $total_kain = $this->db->query("SELECT SUM(jumlah_stok) AS jml FROM stok_kain WHERE inisial_kain='$kd'")->row()->jml;
        if(intval($total_kain) < 1){
            $total_kain = 0;
            echo "<font style='color:red;'>Stok Tidak Tersedia</font>";
        } else {
            if($total_kain == floor($total_kain)){
                $total_kain = number_format($total_kain,0,',','.');
            } else {
                $total_kain = number_format($total_kain,2,',','.');
            }
            echo "Jumlah Stok Tersedia ".$total_kain;
        }
        
    }
    function getCode(){
        $kode = $this->data_model->acakKode('19');
        echo $kode;
    }
    function loadPotongKain(){
        $cekTable = $this->data_model->sort_record('tgl_potong','t_potong_kain');
        if($cekTable->num_rows() > 0){
            $no=1;
            foreach($cekTable->result() as $row){
                $ptg = $row->kode_pemotong;
                $codesaved = $row->codesaved;
                $nama_ptg = $this->data_model->get_byid('master_pemotong',['kode_ptg'=>$ptg])->row("nama_ptg");
                if($row->jumlah_kainkirim == floor($row->jumlah_kainkirim)){
                    $kirim = number_format($row->jumlah_kainkirim,0,',','.');
                } else {
                    $kirim = number_format($row->jumlah_kainkirim,2,',','.');
                }
                ?>
                <tr>
                    <td><?=$ptg."-".sprintf('%03d', $row->kode_potongan); ?></td>
                    <td><?=date('d M Y', strtotime($row->tgl_potong));?></td>
                    <td><?=$nama_ptg;?></td>
                    <td><?=$row->kode_kain;?></td>
                    <td><?=$kirim;?></td>
                    <td>
                        <button class="btn btn-primary btn-sm" onclick="viewPotongan('<?=$codesaved;?>')">View</button>
                    </td>
                </tr>
                <?php
            }
        }
    }
    function showInputanPotong(){
        $codesaved = $this->input->post('codesaved', TRUE);
        $cek = $this->data_model->get_byid('t_potong_kain',['codesaved'=>$codesaved]);
        if($cek->num_rows() == 1){
            $tgl_potong = $cek->row("tgl_potong");
            $tgl_input = $cek->row("tgl_input");
            $kode_pemotong = $cek->row("kode_pemotong");
            $kode_kain = $cek->row("kode_kain");
            $jumlah_kainkirim = $cek->row("jumlah_kainkirim");
            $harga_peryard = $cek->row("harga_peryard");
            $ongkos_potong = $cek->row("ongkos_potong");
            $diinputoleh = $cek->row("diinputoleh");
            $kode_potongan = sprintf('%03d', $cek->row("kode_potongan"));
            echo json_encode(array(
                "statusCode" => 200, 
                "tgl_potong" => $tgl_potong, 
                "tgl_input" => $tgl_input, 
                "kode_pemotong" => $kode_pemotong, 
                "kode_kain" => $kode_kain, 
                "jumlah_kainkirim" => $jumlah_kainkirim, 
                "harga_peryard" => $harga_peryard, 
                "ongkos_potong" => $ongkos_potong, 
                "diinputoleh" => $diinputoleh, 
                "kode_potongan" => $kode_potongan, 
            ));
        } else {
            echo json_encode(array("statusCode" => 500, "message" => "Token Error" ));
        }
    }
    function hitungHpp1(){
        $cd             = $this->input->post('cd', TRUE);
        $jumlah_kirim   = $this->data_model->get_byid('t_potong_kain',['codesaved'=>$cd])->row("jumlah_kainkirim");
        $rows           = $this->data_model->get_byid('stok_kain_pakai',['codesaved'=>$cd]);
        if($rows->num_rows() == 1){
            $id_stok            = $rows->row("id_stok");
            $kain_peryard_harga = $this->data_model->get_byid('stok_kain',['id_stok'=>$id_stok])->row("harga_kain_peryard");
            $harga_total_kain   = intval($kain_peryard_harga) * $jumlah_kirim;
            $ty                 = $this->data_model->get_byid('stok_kain_potongan',['code_saved'=>$cd])->result();
            $total_yard         = 0;
            foreach($ty as $val){
                $pj      = $val->panjang_kain;
                $pj_yard = $pj / 0.9;
                $pj_yard = round($pj_yard,1);
                $pcs     = $val->jumlah_pcs;
                $total1  = $pj_yard * $pcs;
                $total_yard += $total1;
            }
            $harga_kain_peryard_real = $harga_total_kain / $total_yard;
            $harga_kain_peryard_real = round($harga_kain_peryard_real);
            $this->data_model->updatedata('codesaved',$cd,'t_potong_kain',['harga_peryard'=>$harga_kain_peryard_real]);
            foreach($ty as $val2){
                $id      = $val2->id_k_ptgan;
                $pj      = $val2->panjang_kain;
                $pj_yard = $pj / 0.9;
                $pj_yard = round($pj_yard,1);
                $harga_pcs = $pj_yard * $harga_kain_peryard_real;
                $this->data_model->updatedata('id_k_ptgan',$id,'stok_kain_potongan',['harga_pcs'=>round($harga_pcs)]);
            }
            echo "success $kain_peryard_harga";
        } elseif($rows->num_rows() > 1){
            
            echo "success2";
        }
    }
    function loadCashFlow(){
        $record = $this->data_model->sort_record('tgl','a_keuangan');
        if($record->num_rows() > 0){
            foreach($record->result() as $val){
                $jenis = $val->jenisflow;
                $nominal = $val->nominal;
                $nominal2 = number_format($val->nominal);
                $tgl = date('d M Y', strtotime($val->tgl));
                ?>
                <tr>
                    <td>
                        <?php 
                        if($jenis=="in"){
                            $tipejenis = "Pemasukan";
                            echo '<span class="badge bg-success">MASUK</span>';
                        } else {
                            $tipejenis = "Pengeluaran";
                            echo '<span class="badge bg-danger">KELUAR</span>';
                        }
                        ?>
                    </td>
                    <td>
                        <?php 
                        if($jenis=="in"){
                            echo '<font style="color:green;">Rp. '.$nominal2.'</font>';
                        } else {
                            echo '<font style="color:red;">Rp. '.$nominal2.'</font>';
                        }
                        ?>
                    </td>
                    <td><?=$tgl;?></td>
                    <td><?=$val->kategori;?></td>
                    <td><?=$val->keterangan;?></td>
                    <td><a href="javascript:void(0);" style="color:red;" onclick="hapusCashFlow('<?=$val->iduang;?>','<?=$tipejenis;?>')"><i class="bi bi-trash-fill"></i></a></td>
                </tr>
                <?php
            }
        } else {
            echo '<tr><td colspan="6" style="color:red;">Tidak ada data</td></tr>';
        }
    } //end

    function loadDataGaji(){
        $record = $this->data_model->sort_record('tanggal_gaji','a_gajikaryawan');
        if($record->num_rows() > 0){
            foreach($record->result() as $val){
                $idgaji = $val->idgaji;
                $periode = $val->periode;
                $tanggal = date('d M Y',strtotime($val->tanggal_gaji));
                $nominal = number_format($val->nominal);
                $metode = $val->metode_gaji;
                $nmkar   = $this->db->query("SELECT id_karyawan,nama_kar FROM master_karyawan WHERE id_karyawan='$val->id_karyawan'")->row("nama_kar");
                ?>
                <tr>
                    <td><?=$periode;?></td>
                    <td><?=$tanggal;?></td>
                    <td><?=$nmkar;?></td>
                    <td><?=$nominal;?></td>
                    <td><?=$nominal;?></td>
                    <td><a href="javascript:void(0);" style="color:red;" onclick="hapusGaji('<?=$idgaji;?>','<?=$nmkar;?>')"><i class="bi bi-trash-fill"></i></a></td>
                </tr>
                <?php
            }
        }
    } //end function

}
?>