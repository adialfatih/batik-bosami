<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller
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

    function produkdata(){
        $produik = $this->data_model->get_record('master_produk');
        $ar = array();
        foreach($produik->result() as $val){
            $d = '"'.$val->nama_produk.'"';
            if(in_array($d, $ar)){} else { $ar[]=$d; }
        }
        $im = implode(',', $ar);
        $data = [
            'title'         => 'Produk Bosami',
            'sess_nama'     =>  $this->session->userdata('nama'),
            'sess_username' =>  $this->session->userdata('username'),
            'sess_akses'    =>  $this->session->userdata('akses'),
            'formatData'    => 'tables',
            'scriptForm'    => 'produks',
            'autoComplete'  => 'yes',
            'dataAuto'      => $im,
            'produkdata'    => $this->data_model->get_record('master_produk')
        ];
        $this->load->view('part/header', $data);
        $this->load->view('part/navigation', $data);
        $this->load->view('produk/produk_views', $data);
        $this->load->view('part/main_js_tables5', $data);
    }
    function produkdata2(){
        $data = [
            'title'         => 'Produk Bosami',
            'sess_nama'     =>  $this->session->userdata('nama'),
            'sess_username' =>  $this->session->userdata('username'),
            'sess_akses'    =>  $this->session->userdata('akses'),
            'formatData'    => 'tables',
            'scriptForm'    => 'produks',
            'produkdata'    => $this->data_model->get_record('master_produk')
        ];
        $this->load->view('part/header', $data);
        $this->load->view('part/navigation', $data);
        $this->load->view('produk/produk_views2', $data);
        $this->load->view('part/main_js_tables5', $data);
    }
    public function upload_file() {
        $kd                         = $this->input->post('kode_produks', TRUE);
        $nmProduks                  = $this->input->post('nmProduks', TRUE);
        $config['upload_path']      = './uploads/produks/';
        $config['allowed_types']    = 'jpg|jpeg|png';
        $config['max_size']         = 1024; // 1MB
        $config['file_ext_tolower'] = TRUE;

        $new_name                   = $kd.'-' . date('Ymd-His');
        $config['file_name'] = $new_name;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file')) {
            $error = $this->upload->display_errors();
            echo json_encode(['status' => 'error', 'message' => $error]);
        } else {
            $data = $this->upload->data();
            //echo json_encode(['status' => 'success', 'file_name' => $data['file_name']]);
            $this->data_model->updatedata('kode_produk',$kd,'master_produk', ['foto_produk'=>$data['file_name']]);
            redirect(base_url('product-bosami'));
        }
    }

    public function get_chart_data() {
        $query = $this->db->query("SELECT mp.nama_produk, COUNT(sp.id_stokproduk ) as total_stok
            FROM master_produk mp
            LEFT JOIN stok_produk sp ON mp.kode_produk = sp.kode_produk
            GROUP BY mp.kode_produk
        ");

        $result = $query->result_array();

        // Siapkan data untuk chart
        $labels = [];
        $data = [];

        foreach ($result as $row) {
            $labels[] = $row['nama_produk'];
            $data[] = $row['total_stok'];
        }

        echo json_encode(['labels' => $labels, 'data' => $data]);
    }
    function lihatProduk(){
        $selection = $this->input->post('selection', TRUE);
        if($selection == "Tampilkan Semua"){
            $produkdata = $this->data_model->get_record('master_produk');
        } else {
            $produkdata = $this->data_model->get_byid('master_produk', ['nama_produk'=>$selection]);
        }
        if($produkdata->num_rows() > 0){
            foreach($produkdata->result() as $row):
            $foto = $row->foto_produk;
            ?>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div style="width:100%;margin-bottom:10px;position:relative;">
                                    <div style="width:25px;height:25px;background:#d60404;position:absolute;top:5px;right:15px;border-radius:50%;color:#fff;display:flex;justify-content:center;cursor:pointer;" onclick="uploads('<?=$row->kode_produk;?>','<?=$row->nama_produk;?>')"><i class="bi bi-upload"></i></div>
                                    <?php if($foto=="null"){ ?>
                                        <img src="<?=base_url('logo/logo.png');?>" style="width:100%;" alt="<?=$row->nama_produk;?>">
                                    <?php } else { ?>
                                        <img src="<?=base_url('uploads/produks/'.$foto);?>" style="width:100%;" alt="<?=$row->nama_produk;?>">
                                    <?php } ?>
                                </div>
                                <strong style="color:#0455d6;"><?=$row->nama_produk;?></strong>
                                <?php
                                $vars = $this->data_model->get_byid('master_produk_varians',['kode_produk'=>$row->kode_produk])->result();
                                foreach($vars as $var){
                                $kodevar = $var->kode_varians;
                                $kodepdk = $var->kode_produk;
                                $models  = strtolower($var->models);
                                $pdk1    = strtolower($var->nama_produk);
                                ?>
                                <div style="width:100%;display:flex;justify-content:space-between;">
                                    <span>&bull; <?=ucwords($models);?></span>
                                    <div>
                                        <?php
                                        $cekSize = $this->db->query("SELECT * FROM stok_produk WHERE kode_varians='$kodevar' GROUP BY ukuran");
                                        if($cekSize->num_rows() > 0){
                                            foreach($cekSize->result() as $zi){
                                                $ukr = $zi->ukuran;
                                                if($ukr == "All Size"){ $ukrprint=""; } else { $ukrprint=$ukr." - "; }
                                                $pcs = $this->db->query("SELECT COUNT(id_stokproduk) AS jml FROM stok_produk WHERE kode_varians='$kodevar' AND ukuran='$ukr'")->row("jml");
                                                echo $ukrprint."<strong>".$pcs."</strong> Pcs<br>";
                                            }
                                        } else {
                                            //echo "<font style='color:red;'>0 Pcs</font>";
                                            ?>
                                            <a href="javascript:void(0);" style="color:red;" onclick="addStokAwal('<?=$kodevar;?>','<?=$kodepdk;?>','<?=strtoupper($models);?>','<?=strtoupper($pdk1);?>')">0 Pcs</a>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <?php } 
                                $cekDefect = $this->data_model->get_byid('stok_produk_cct',['kode_produk'=>$row->kode_produk])->num_rows();
                                if($cekDefect > 0){
                                ?>
                                <div style="width:100%;display:flex;justify-content:space-between;">
                                    <span>&bull; <a href="javascript:void(0);" style="color:#e66707;" onclick="defectShow('<?=$row->kode_produk;?>')">Stok Defect</a></span>
                                    <div style="color:#e66707;"><strong><?=$cekDefect;?></strong> Pcs</div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; }
    }
    function lihatProdukDefect(){
        $kodeProduk = $this->input->post('kodeProduk', TRUE);
        $cek        = $this->data_model->get_byid('stok_produk_cct',['kode_produk'=>$kodeProduk]);
        if($cek->num_rows() > 0){
            ?>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>Models</th>
                        <th>Keterangan</th>
                        <th>Harga Jual</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($cek->result() as $key => $vl){
                        $n = $key + 1;
                        $xtx = strtolower($vl->ketcacat);
                        $var = $vl->kode_varians;
                        $rows= $this->data_model->get_byid('master_produk_varians',['kode_varians'=>$var])->row_array();
                        echo "<tr>";
                        echo "<td>".$n."</td>";
                        echo "<td>".$rows['nama_produk']."</td>";
                        echo "<td>".$rows['models']."</td>";
                        echo "<td>".ucwords($xtx)."</td>";
                        echo "<td>Rp. ".number_format($vl->harga_jual_edit)."</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <?php
        } else {
            echo "Tidak ada stok defect untuk produk ini";
        }
    }
    function addStokAwalProses(){
        $namaProduk  = $this->input->post('namaProduk', TRUE);
        $modelProduk = $this->input->post('modelProduk', TRUE);
        $ukrProduk   = $this->input->post('ukrProduk', TRUE);
        $hpp1        = preg_replace("/[^0-9]/", "", $this->input->post('hpp1', TRUE));
        $hrgJual     = preg_replace("/[^0-9]/", "", $this->input->post('hrgJual', TRUE));
        $stokAwal    = preg_replace("/[^0-9]/", "", $this->input->post('stokAwal', TRUE));
        $kodeProduks = $this->input->post('kodeProduks', TRUE);
        $kodeVarians = $this->input->post('kodeVarians', TRUE);
        $kdProduksi  = $this->input->post('kdProduksi', TRUE);
        if($kodeProduks!="" && $kodeVarians!="" && $hpp1!="" && $hrgJual!="" && $stokAwal!=""){
            $cek     = $this->data_model->get_byid('stok_produk',['kode_varians'=>$kodeVarians])->num_rows();
            if($cek == 0){
                for ($i=0; $i < $stokAwal ; $i++) { 
                    $this->data_model->saved('stok_produk',[
                        'kode_produk'       => $kodeProduks,
                        'kode_varians'      => $kodeVarians,
                        'ukuran'            => $ukrProduk,
                        'hpp'               => $hpp1,
                        'harga_jual'        => $hrgJual,
                        'codeproduksijahit' => 'null',
                        'kode_produksi'     => $kdProduksi,
                        'codestok'          => 'null',
                        'harga_jual_edit'   => $hrgJual
                    ]);
                }
                echo json_encode(array("statusCode" => 200, "message" => "success"));
            } else {
                echo json_encode(array("statusCode" => 500, "message" => "Anda harus mengkosongkan stok dahulu.!!"));
            }
        } else {
            echo json_encode(array("statusCode" => 500, "message" => "Anda tidak mengisi data dengan benar.!!"));
        }
    }
}
?>