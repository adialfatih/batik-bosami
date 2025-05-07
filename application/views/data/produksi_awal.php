</header>

<div class="content-wrapper container">
	<div class="page-content">
		<section class="row">
			<div class="col-12">
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <i class="bi bi-info-circle"></i> &nbsp;Klik Pada Kode Babar Untuk Informasi Lengkap
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <div class="card">
                    <div class="card-header" style="width:100%;display:flex;justify-content:space-between;align-items:center;">
                        <h4><?=$title;?></h4>
                        <a href="javascript:void(0);" id="inputPtg" class="btn icon icon-left btn-success" data-bs-toggle="modal" data-bs-target="#large"><i data-feather="plus-circle"></i> Produksi Baru</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="table1">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>FOTO PRODUKSI</th>
                                        <th>KODE BABAR</th>
                                        <th>KODE KAIN</th>
                                        <th>TANGGAL KIRIM</th>
                                        <th>JUMLAH KIRIM</th>
                                        <th>JUMLAH SELESAI</th>
                                        <th>STATUS</th>
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
                                                <h4 class="modal-title" id="myModalLabel17">Input Produksi</h4>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body" id="modalsBody">
                                                <input type="hidden" name="stokkainid" id="stokkainid" value="0">
                                                <input type="hidden" name="stokkainjml" id="stokkainjml" value="0">
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label>Kode Kain</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <div class="form-label">
                                                                <div class="autoComplete_wrapper">
                                                                    <input id="autoComplete" type="search" dir="ltr" spellcheck=false autocorrect="off" autocomplete="off" autocapitalize="off">
                                                                </div>
                                                                
                                                            </div>
                                                            <small id="jmlStokPotongan"></small>
                                                        </div>
                                                        <strong style="margin-bottom:10px;color:#0760de;">Kirim Ke Pembatik - Proses Batik / Babar</strong>
                                                        <div class="col-md-4">
                                                            <label>Jumlah Kirim</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="number" oninput="hitung()" class="form-control" name="jmlKirim" id="jmlKirim" placeholder="Masukan Jumlah Kirim">
                                                        </div>
                                                        <div class="col-md-4" >
                                                            <label>Nama Pembatik</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <select name="pembatik" id="pembatik" class="form-control" required>
                                                                <option value="">Pilih Pembatik</option>
                                                                <?php foreach($babar->result() as $row2){
                                                                    $showpbtk = $row2->kode_pembatik." - ".$row2->nama_pembatik;
                                                                    echo "<option value='".$row2->kode_pembatik."'>".$showpbtk."</option>";
                                                                }?>
                                                            </select>
                                                            <small id="showStokID"></small>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Tanggal Kirim</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="date" class="form-control" name="tglKirim" id="tglKirim" required>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Proses Babar</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="text" list="bar" class="form-control" id="jnsBabar" placeholder="Masukan Jenis Babaran">
                                                            <datalist id="bar">
                                                                <?php foreach($babar2->result() as $row){
                                                                    echo "<option value='".$row->jenis_babaran."'></option>";
                                                                }?>
                                                            </datalist>
                                                            <small id="showStokID"></small>
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
                                                <input type="hidden" name="jenis" value="babar" required>
                                                <input type="hidden" name="idbar" id="idbars" value="0" required>
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label>Kode Babar</label>
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
                                <div class="modal fade text-left" id="large2312" tabindex="-1" role="dialog"
                                    aria-labelledby="myMod122bel2317" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myMod122bel2317">Selesai Proses Babar</h4>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body" id="mod12Body23">
                                                <input type="hidden" id="codeProduksiRow" value="0">
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label>Kode Babar</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="text" class="form-control" id="codeBabarRow" placeholder="Masukan Kode Babar" readonly>
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
                                                            <input type="number" class="form-control" id="jmlKemabali" placeholder="Masukan Jumlah Kemabali">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Status Babar</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <select name="statusBabar" class="form-control" id="statusBabar">
                                                                <option value="">Pilih Status</option>
                                                                <option value="Finish">Selesai Proses Batik</option>
                                                                <option value="Cacat">Cacat</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="button" class="btn btn-success" id="simpanKembali">
                                                    Simpan
                                                </button>
                                                <img src="<?=base_url();?>assets/images/svg-loaders/rings.svg" alt="loading" id="loadersId2" style="display:none;">
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
	</div>

</div>

            