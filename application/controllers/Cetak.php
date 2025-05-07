<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cetak extends CI_Controller
{
    function __construct()
    {
            parent::__construct();
            $this->load->model('data_model');
            $this->load->library('pdf');
            date_default_timezone_set("Asia/Jakarta");
    }
    function index(){
        echo "";
    }
    
    function invoice(){
        $uri = $this->uri->segment(2);
        $cek = $this->data_model->get_byid('t_penjualan',['codejual'=>$uri]);
        $arbln = ['01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April','05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus','09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember'];
        if($cek->num_rows() == 1){
            $row        = $cek->row_array();
            $id         = $row['id_jual'];
            $id2        = $row['no_inv'];
            $cus        = $row['nama_customer'];
            $hrg        = $row['harga_totalproduk'];
            $tdb        = $row['total_dibayar'];
            $ong        = $row['ongkir'];
            $tg         = explode('-',$row['tgl_jual']);
            $tgl        = $tg[2]."/".$tg[1]."/".$tg[0];
            if($tg[0] == "2025"){
            $no_inv     = "INV/".$tg[0]."/".sprintf('%04d', $id);
            } else {
            $no_inv     = "INV/".$tg[0]."/".sprintf('%04d', $id2);
            }
            $tgl1       = $row['tgl_jual'];
            $date2      = new DateTime($tgl1);
            $date2->modify('+7 days'); 
            $dueDate    = $date2->format('d/m/Y');
            $printTgl   = $tg[2]." ".$arbln[$tg[1]]." ".$tg[0];
            $pdf = new FPDF('p','mm','A4');
            $setFileName= ''.$cus.' - '.$no_inv.' - www.bosamibatik.com';
            // membuat halaman baru
            $pdf->AddPage();
            // setting jenis font yang akan digunakan
            $pdf->SetTitle(''.$cus.' - '.$no_inv.' - www.bosamibatik.com');
            $pdf->SetFont('Arial','',12);
            $pdf->Image(''.base_url().'logo/logo.png', 20, 15, 20);
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->SetTextColor(51, 110, 204);
            $pdf->Cell(190, 10, 'INVOICE', 0, 1, 'R');
            $pdf->SetTextColor(0,0,0);
            $pdf->SetFont('Arial', '', 10);
            $pdf->Cell(165, 5, 'Referensi : ', 0, 0, 'R');
            $pdf->Cell(25, 5, $no_inv, 0, 1, 'R');
            $pdf->Cell(165, 5, 'Tanggal : ', 0, 0, 'R');
            $pdf->Cell(25, 5, $tgl, 0, 1, 'R');
            $pdf->Cell(165, 5, 'Tgl. Jatuh Tempo : ', 0, 0, 'R');
            $pdf->Cell(25, 5, $dueDate, 0, 1, 'R');
            $pdf->Ln(10);
            //ini di bawah header
            $pdf->Cell(100, 5, 'Info Perusahaan', 0, 0);
            $pdf->Cell(100, 5, 'Tagihan Untuk', 0, 0);
            $pdf->Line(11, 52, 100, 52);
            $pdf->Line(111, 52, 200, 52);
            $pdf->Ln(10);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(100, 5, 'Batik Bosami', 0, 0);
            $pdf->Cell(90, 5, $cus, 0, 1);
            $pdf->SetFont('Arial', '', 10);
            $pdf->SetXY(10, 61);
            $pdf->MultiCell(90, 5, "JL. R. A. Kartini Gg.10 No. 5, Rt 003/ Rw 004\nKel. Kauman, Kota Pekalongan, Jawa Tengah, 51128", 0);

            // Atur posisi MultiCell kedua (di sebelahnya)
            $pdf->SetXY(110, 61);
            $pdf->MultiCell(90, 5, "Telp. -", 0);
            $pdf->Ln(5);
            $pdf->Cell(100, 5, 'Telp: 087812426261', 0, 1);
            $pdf->Cell(100, 5, 'Email: batikbosamianjemen@gmail.com', 0, 1);
            $pdf->Ln(5);

            // Header Tabel
            
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetFillColor(24, 42, 71); // Biru (RGB)
            $pdf->SetTextColor(255, 255, 255); // Putih (RGB)
            $pdf->Cell(60, 7, 'Produk', 1, 0, 'L', true);
            $pdf->Cell(60, 7, 'Deskripsi', 1, 0, 'L', true);
            $pdf->Cell(20, 7, 'Kuantitas', 1, 0, 'C', true);
            $pdf->Cell(25, 7, 'Harga (Rp)', 1, 0, 'R', true);
            $pdf->Cell(25, 7, 'Jumlah (Rp)', 1, 1, 'R', true);
            $pdf->SetTextColor(0,0,0);
            // Data Produk
            $pdf->SetFont('Arial', '', 10);
            // $items = [
            //     ['DASTER YURI 2', 'BIRU1', 1, 60000],
            //     ['DASTER KLOK ANDIN', 'BIRU', 1, 60000],
            //     ['DASTER FELLA ZAIDA', 'DUSTY', 1, 65000],
            //     ['DASTER FELLA GHANIA', 'HIJAU', 1, 65000],
            //     ['DASTER FELLA RIA', 'MAROON BIRU KUNING', 3, 65000],
            //     ['DASTER YURI 2', 'BIRU1', 1, 60000],
            //     ['DASTER KLOK ANDIN', 'BIRU', 1, 60000],
            //     ['DASTER FELLA ZAIDA', 'DUSTY', 1, 65000],
            //     ['DASTER FELLA GHANIA', 'HIJAU', 1, 65000],
            //     ['DASTER FELLA RIA', 'MAROON BIRU KUNING', 3, 65000],
            //     ['DASTER YURI 2', 'BIRU1', 1, 60000],
            // ];
            $produk = $this->data_model->get_byid('t_penjualan_data',['codejual'=>$uri])->result(); 
            $totalqty  = 0;
            
            foreach ($produk as $val) {
                //$jumlah = $item[2] * $item[3];
                //$total += $jumlah;
                $vars = $this->data_model->get_byid('master_produk_varians',['kode_varians'=>$val->kodevarians])->row_array();
                $gety = $pdf->getY();
                if($gety > 261){
                    // Header Tabel
                    $pdf->AddPage();
                    $pdf->SetFont('Arial', 'B', 10);
                    $pdf->SetFillColor(24, 42, 71); // Biru (RGB)
                    $pdf->SetTextColor(255, 255, 255); // Putih (RGB)
                    $pdf->Cell(60, 7, 'Produk', 1, 0, 'L', true);
                    $pdf->Cell(60, 7, 'Deskripsi', 1, 0, 'L', true);
                    $pdf->Cell(20, 7, 'Kuantitas', 1, 0, 'C', true);
                    $pdf->Cell(25, 7, 'Harga (Rp)', 1, 0, 'R', true);
                    $pdf->Cell(25, 7, 'Jumlah (Rp)', 1, 1, 'R', true);
                    $pdf->SetTextColor(0,0,0);
                    // Data Produk
                    $pdf->SetFont('Arial', '', 10);
                }
                $pdf->Cell(60, 7, $this->truncateText($vars['nama_produk'], 60, $pdf), 1);
                $pdf->Cell(60, 7, $this->truncateText($vars['models'], 60, $pdf), 1);
                $pdf->Cell(20, 7, $val->jumlah_terjual, 1, 0, 'C');
                $pdf->Cell(25, 7, number_format($val->harga_jual, 0, ',', '.'), 1, 0, 'R');
                $ttlhrg = $val->jumlah_terjual * $val->harga_jual;
                $totalqty+= $val->jumlah_terjual;
                $pdf->Cell(25, 7, number_format($ttlhrg, 0, ',', '.'), 1, 1, 'R');
                
            }
            //footer
            
            $pdf->Cell(190, 7, '', 0, 1, 'L');
            $pdf->Cell(80, 7, '', 0, 0, 'L');
            $pdf->Cell(60, 7, 'Total Kuantitas', 0, 0, 'L');
            $pdf->Cell(50, 7, ''.$totalqty.' Pcs', 0, 0, 'R');
            $gety2 = $pdf->getY() + 7;
            $pdf->Line(90, $gety2, 200, $gety2);
            $pdf->Ln(2);
            $pdf->Cell(190, 7, '', 0, 1, 'L');
            $pdf->Cell(80, 7, '', 0, 0, 'L');
            $pdf->Cell(60, 7, 'Subtotal', 0, 0, 'L');
            $pdf->Cell(50, 7, 'Rp. '.number_format($hrg, 0, ',', '.'), 0, 0, 'R');
            $gety2 = $pdf->getY() + 7;
            $pdf->Line(90, $gety2, 200, $gety2);
            $pdf->Ln(2);
            $pdf->Cell(190, 7, '', 0, 1, 'L');
            $pdf->Cell(80, 7, '', 0, 0, 'L');
            $pdf->Cell(60, 7, 'Biaya Kirim', 0, 0, 'L');
            $pdf->Cell(50, 7, 'Rp. '.number_format($ong, 0, ',', '.'), 0, 0, 'R');
            $gety2 = $pdf->getY() + 7;
            $pdf->Line(90, $gety2, 200, $gety2);
            $pdf->Ln(2);
            $pdf->Cell(190, 7, '', 0, 1, 'L');
            $pdf->Cell(80, 7, '', 0, 0, 'L');
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(60, 7, 'TOTAL ', 0, 0, 'L');
            
            $ttl_ong = $hrg + $ong;
            
            $pdf->Cell(50, 7, 'Rp. '.number_format($ttl_ong, 0, ',', '.'), 0, 0, 'R');
            $gety2 = $pdf->getY() + 7;
            $pdf->Line(90, $gety2, 200, $gety2);
            $pdf->Ln(2);
            $pdf->Cell(190, 7, '', 0, 1, 'L');
            $pdf->Cell(80, 7, '', 0, 0, 'L');
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(60, 7, 'Sisa Tagihan ', 0, 0, 'L');
            
            $sisaTagihan = $ttl_ong - $tdb;
            
            $pdf->Cell(50, 7, 'Rp. '.number_format($sisaTagihan, 0, ',', '.'), 0, 0, 'R');
            $gety2 = $pdf->getY() + 7;
            $pdf->Line(90, $gety2, 200, $gety2);
            $pdf->Ln(10);
            $pdf->SetFont('Arial', 'B', 10);
            
            $pdf->Cell(190, 7, 'Keterangan', 0, 1, 'L');
            $gety32 = $pdf->getY() + 2;
            $pdf->Cell(110, 7, '', 0, 0, 'L');
            $pdf->Cell(90, 7, $printTgl, 0, 1, 'L');
            $pdf->Line(10, $gety32, 100, $gety32);
            $pdf->SetFont('Arial', '', 10);
            $gety14 = $pdf->getY() + 2;
            $pdf->Cell(90, 4, 'LAKUKAN PEMBAYARAN MELALUI REKENING :', 0, 1, 'L');
            $pdf->Cell(90, 4, 'BCA', 0, 1, 'L');
            $pdf->Cell(90, 4, 'A/N FARIDAH', 0, 1, 'L');
            $pdf->Cell(90, 4, '3820122967', 0, 1, 'L');
            $pdf->Ln(17);
            $pdf->SetFont('Arial', 'B', 11);
            $pdf->Cell(110, 4, '', 0, 0, 'L');
            $pdf->Cell(90, 4, 'MUH. AZMI', 0, 1, 'L');
            $pdf->Image(''.base_url().'logo/ttd_azmi.png', 115, $gety14, 50);
            $pdf->Output('I',''.$setFileName.'.pdf'); 
        } else {
            echo "Invoice tidak ditemukan.";
        }
    } //end surat jalan
  
    function truncateText($text, $width, $pdf) {
        $maxLength = floor($width / 2.5); // Sesuaikan dengan lebar cell
        if ($pdf->GetStringWidth($text) > $width) {
            return mb_strimwidth($text, 0, $maxLength, "...");
        }
        return $text;
    }
  
}
?>