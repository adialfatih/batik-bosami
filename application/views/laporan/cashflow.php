</header>
<?php
$thisDate = date('Y-m-d');
$x = explode('-', $thisDate);
$tahun = $x[0];
$ar = [
    '01' => 'Januari',
    '02' => 'Februari',
    '03' => 'Maret',
    '04' => 'April',
    '05' => 'Mei',
    '06' => 'Juni',
    '07' => 'Juli',
    '08' => 'Agustus',
    '09' => 'September',
    '10' => 'Oktober',
    '11' => 'November',
    '12' => 'Desember'
];
$bulanIni = $ar[$x[1]];
?>
<div class="content-wrapper container">
	<div class="page-content">
		<section class="row">
			<div class="col-12">
                <div class="card">
                    <div class="card-header" style="width:100%;display:flex;justify-content:space-between;align-items:center;">
                        <h4>LAPORAN KEUANGAN BOSAMI BATIK</h4>
                        <a href="javascript:void(0);" class="btn icon icon-left btn-primary" data-bs-toggle="modal" data-bs-target="#large"><i data-feather="search"></i> Lihat Periode</a>
                    </div>
                    <div class="card-body">
                        <span>&bull; Laporan Laba Rugi Periode : <strong style="color:#125bc9;"><?php echo $bulanIni . ' ' . $tahun; ?></strong></span> 
                        <div style="width:100%;display:flex;align-items:flex-start;padding:10px 15px;">
                            <span>Pendapatan :</span>
                        </div>
                        <div style="width:100%;display:flex;align-items:flex-start;padding:0px 15px;">
                            <span style="width:350px;color:#125bc9;">- Total Penjualan :</span>
                            <span style="width:350px;color:#125bc9;font-weight:bold;">Rp. 250.000.000</span>
                        </div>
                        <div style="width:100%;display:flex;align-items:flex-start;padding:10px 15px;">
                            <span>Harga Pokok Produksi (HPP) :</span>
                        </div>
                        <div style="width:100%;display:flex;align-items:flex-start;padding:0px 15px;">
                            <span style="width:350px;color:#125bc9;">- Pembelian Kain :</span>
                            <span style="width:350px;color:#125bc9;font-weight:bold;">Rp. 50.000.000</span>
                        </div>
                        <div style="width:100%;display:flex;align-items:flex-start;padding:0px 15px;">
                            <span style="width:350px;color:#125bc9;">- Jasa Pemotongan Kain :</span>
                            <span style="width:350px;color:#125bc9;font-weight:bold;">Rp. 950.000</span>
                        </div>
                        <div style="width:100%;display:flex;align-items:flex-start;padding:0px 15px;">
                            <span style="width:350px;color:#125bc9;">- Upah Jahit :</span>
                            <span style="width:350px;color:#125bc9;font-weight:bold;">Rp. 1.950.000</span>
                        </div>
                        <div style="width:100%;display:flex;align-items:flex-start;padding:0px 15px;">
                            <span style="width:350px;color:#125bc9;">- Biaya Pembatikan :</span>
                            <span style="width:350px;color:#125bc9;font-weight:bold;">Rp. 12.950.000</span>
                        </div>
                        <div style="width:100%;display:flex;align-items:flex-start;padding:10px 15px;">
                            <span style="width:350px;">Total HPP</span>
                            <span style="width:350px;font-weight:bold;">Rp. 290.000.000</span>
                        </div>

                        <div style="width:100%;display:flex;align-items:flex-start;padding:10px 15px;">
                            <span>Biaya Operasional : </span>
                        </div>
                        <div style="width:100%;display:flex;align-items:flex-start;padding:0px 15px;">
                            <span style="width:350px;color:#125bc9;">- Gaji Karyawan :</span>
                            <span style="width:350px;color:#125bc9;font-weight:bold;">Rp. 50.000.000</span>
                        </div>
                        <div style="width:100%;display:flex;align-items:flex-start;padding:0px 15px;">
                            <span style="width:350px;color:#125bc9;">- Listrik/Air :</span>
                            <span style="width:350px;color:#125bc9;font-weight:bold;">Rp. 770.000</span>
                        </div>
                        <div style="width:100%;display:flex;align-items:flex-start;padding:0px 15px;">
                            <span style="width:350px;color:#125bc9;">- Sewa Kantor :</span>
                            <span style="width:350px;color:#125bc9;font-weight:bold;">Rp. 1.650.000</span>
                        </div>
                        <div style="width:100%;display:flex;align-items:flex-start;padding:0px 15px;">
                            <span style="width:350px;color:#125bc9;">- Dll :</span>
                            <span style="width:350px;color:#125bc9;font-weight:bold;">Rp. 2.950.000</span>
                        </div>
                        <div style="width:100%;display:flex;align-items:flex-start;padding:10px 15px;">
                            <span style="width:350px;">Total Biaya Operasional</span>
                            <span style="width:350px;font-weight:bold;">Rp. 190.000.000</span>
                        </div>

                        <div style="width:100%;display:flex;align-items:flex-start;padding:10px 15px;">
                            <span style="width:350px;">Laba Bersih</span>
                            <span style="width:350px;font-weight:bold;">Rp. 1.290.000.000</span>
                        </div>
                    </div>
                </div>
            </div>
		</section>
	</div>
</div>