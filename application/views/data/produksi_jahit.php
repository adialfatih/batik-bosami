</header>

<div class="content-wrapper container">
	<div class="page-content">
		<section class="row">
			<div class="col-12">
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <i class="bi bi-info-circle"></i> &nbsp;Klik Pada Kode Jahit Untuk Informasi Lengkap
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <div class="card">
                    <div class="card-header" style="width:100%;display:flex;justify-content:space-between;align-items:center;">
                        <h4><?=$title;?></h4>
                        <a href="javascript:void(0);" id="inputPtg" class="btn icon icon-left btn-success" data-bs-toggle="modal" data-bs-target="#large"><i data-feather="plus-circle"></i> Jahit Baru</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="table1">
                                <thead>
                                    <tr>
                                        <th rowspan="2">NO</th>
                                        <th rowspan="2">FOTO PRODUKSI</th>
                                        <th rowspan="2">KODE JAHIT</th>
                                        <th rowspan="2">NAMA PENJAHIT</th>
                                        <th rowspan="2">TANGGAL KIRIM</th>
                                        <th rowspan="2">JENIS JAHITAN</th>
                                        <th rowspan="2">MODEL JAHITAN</th>
                                        <th colspan="2" style="text-align:center;">JUMLAH</th>
                                        <th rowspan="2">STATUS</th>
                                    </tr>
                                    <tr>
                                        <th style="text-align:center;">KIRIM</th>
                                        <th style="text-align:center;">SAAT INI</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody"></tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>
            </div>
		</section>
                            <!--large size Modal -->
                                <div class="modal fade text-left" id="large" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel17" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel17">Kirim Kain ke Penjahit</h4>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body" id="modalsBody">
                                                <input type="hidden" name="jmlStokAwal" id="jmlStokAwal" value="0">
                                                <input type="hidden" name="codeProduksiBabar" id="codeProduksiBabar" value="0">
                                                <input type="hidden" name="prosesBabarSblm" id="prosesBabarSblm" value="0">
                                                <input type="hidden" name="kodeKainSblm" id="kodeKainSblm" value="0">
                                                <input type="hidden" name="hpp1" id="hpp1" value="0">
                                                <input type="hidden" name="hpp2" id="hpp2" value="0">
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label>Kode Kain</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <div class="form-label">
                                                                <div class="autoComplete_wrapper">
                                                                    <input id="autoComplete" type="search" dir="ltrp" spellcheck=false autocorrect="off" autocomplete="off" autocapitalize="off">
                                                                </div>
                                                                
                                                            </div>
                                                            <small id="jmlStokPotongan"></small>
                                                        </div>
                                                        <strong style="margin-bottom:10px;color:#0760de;">Kirim Ke Penjahit - Proses Jahit</strong>
                                                        <div class="col-md-4">
                                                            <label>Jumlah Kirim</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="number" oninput="hitung()" class="form-control" name="jmlKirim" id="jmlKirim" placeholder="Masukan Jumlah Kirim">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Tanggal Kirim</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="date" class="form-control" name="tglKirim" id="tglKirim" required>
                                                        </div>
                                                        <div class="col-md-4" >
                                                            <label>Nama Penjahit</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <select name="penjahitslct" id="penjahitslct" class="form-control" required>
                                                                <option value="">Pilih Penjahit</option>
                                                                <?php foreach($jahit->result() as $row2){
                                                                    $showpbtk = $row2->kode_penjahit." - ".$row2->nama_penjahit;
                                                                    echo "<option value='".$row2->kode_penjahit."'>".$showpbtk."</option>";
                                                                }?>
                                                            </select>
                                                            <small id="showStokID"></small>
                                                        </div>
                                                        
                                                        <div class="col-md-4">
                                                            <label>Proses Jahit</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <select name="penjahitmdl" id="penjahitmdl" class="form-control" required>
                                                                <option value="">Pilih Model Jahitan</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Harga Per Pcs</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="text" oninput="formatRibuan(this); hitung()" class="form-control" name="hargpcs" id="hargpcs" placeholder="Masukan Harga Per Potong">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Harga Total</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="text" oninput="formatRibuan(this); hitung2()" class="form-control" name="hargttl" id="hargttl" placeholder="Masukan Harga Total">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary"
                                                    data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="button" class="btn btn-primary" id="simpanButtons">
                                                    Simpan
                                                </button>
                                                <img src="<?=base_url();?>assets/images/svg-loaders/rings.svg" alt="loading" id="loadersId" style="display:none;">
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--large size Modal -->
                                <div class="modal fade text-left" id="large23" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel2317" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel2317">Produksi</h4>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body" id="modalsBody23">
                                                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Similique asperiores fuga minus, quas quasi optio, dicta consequatur aliquid quis totam ea enim nemo rerum praesentium vero quod deleniti obcaecati ipsum?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary"
                                                    data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--large size Modal -->
                                <div class="modal fade text-left" id="large2312" tabindex="-1" role="dialog"
                                    aria-labelledby="myMod122bel2317" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myMod122bel2317">Selesai Proses Jahit</h4>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body" id="mod12Body23">
                                                <input type="hidden" id="codeProduksiRow23" value="0">
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label>Kode Jahit</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="text" class="form-control" id="codeJahitRow" placeholder="Masukan Kode Jahit" readonly>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Tanggal Masuk</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="date" class="form-control" id="tglMasukSelesai" placeholder="Masukan Tanggal Masuk">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Jumlah Kembali</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="number" class="form-control" id="jmlKembali" placeholder="Masukan Jumlah Kembali" min="0">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Status Kembali</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <select name="statusJahit" class="form-control" id="statusJahit">
                                                                <option value="">Pilih Status</option>
                                                                <option value="Finish">Selesai Proses Jahit</option>
                                                                <option value="Cacat">Cacat</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Produk Jadi</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <select name="produkJadi" class="form-control" id="produkJadi" disabled>
                                                                <option value="">Pilih Produk</option>
                                                                <?php foreach($produks->result() as $row3){
                                                                    $showpbtk2 = $row3->kode_produk." - ".$row3->nama_produk;
                                                                    echo "<option value='".$row3->kode_produk."'>".$showpbtk2."</option>";
                                                                }?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Model Produk</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <select name="produkJadi2" class="form-control" id="produkJadi2" disabled>
                                                                <option value="">Pilih Model Produk</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Ukuran</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <select name="produkJadi3" class="form-control" id="produkJadi3" disabled>
                                                                <option value="">Pilih Ukuran</option>
                                                                <option value="All Size">All Size</option>
                                                                <option value="S">S - Small</option>
                                                                <option value="M">M - Medium</option>
                                                                <option value="L">L - Large</option>
                                                                <option value="XL">XL - Xtra Large</option>
                                                                <option value="XXL">XXL - Doble Xtra Large</option>
                                                                <option value="XXXL">XXXL - Triple Xtra Large</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div style="width:100%;" id="tableReturOnModal">
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="button" class="btn btn-success" id="simpanKembali23">
                                                    Simpan
                                                </button>
                                                <img src="<?=base_url();?>assets/images/svg-loaders/rings.svg" alt="loading" id="loadersId2" style="display:none;">
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade text-left" id="largeUpload" tabindex="-1" role="dialog"
                                    aria-labelledby="myModl2317" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"
                                        role="document">
                                        <div class="modal-content">
                                            <form action="<?=base_url('upload/do_upload');?>" enctype="multipart/form-data" method="post">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModl2317">Upload Foto Produksi</h4>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body" id="mod21dy23">
                                                <input type="hidden" name="jenis" value="jahit" required>
                                                <input type="hidden" name="idbar" id="idbars" value="0" required>
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label>Kode Jahit</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="text" class="form-control" id="cdbars" value="0" name="cdbars" readonly>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Upload Foto Produksi</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="file" class="form-control" id="file" value="0" name="file" accept="image/png, image/jpeg, image/jpg, image/svg+xml" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary"
                                                    data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    Simpan & Upload
                                                </button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--large size Modal -->
	</div>

</div>

            