</header>

<div class="content-wrapper container">
	<div class="page-content">
		<section class="row">
			<div class="col-12">
                <div class="card">
                    
                    <div class="card-header" style="width:100%;display:flex;justify-content:space-between;align-items:center;">
                        <h4><?=$title;?></h4>
                        <div>
                        <a href="javascript:void(0);" id="inputPtg" class="btn icon icon-left btn-success" data-bs-toggle="modal" data-bs-target="#addPemasukan"><i data-feather="plus-circle"></i> Input Gaji</a>
                        <!-- <a href="javascript:void(0);" id="inputPtg2" class="btn icon icon-left btn-danger" data-bs-toggle="modal" data-bs-target="#addPengeluaran"><i data-feather="search"></i></a> -->
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="table1">
                                <thead>
                                    <tr>
                                        <th>PERIODE GAJI</th>
                                        <th>TANGGAL</th>
                                        <th>NAMA KARYAWAN</th>
                                        <th>NOMINAL GAJI</th>
                                        <th>METODE PENGGAJIAN</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody"></tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>
            </div>
		</section>
                                <div class="modal fade text-left" id="addPemasukan" tabindex="-1" role="dialog" aria-labelledby="addPemasukan2" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="addPemasukan22">Input Gaji Karyawan</h4>
                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <form class="form form-horizontal">
                                            <div class="modal-body">
                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label>Periode Gaji</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="month" id="perioderGaji" class="form-control" name="perioderGaji" placeholder="Periode Gaji">
                                                                <small style="color:red;">Jika periode gaji mingguan, anda bisa mengosongi inputan ini</small>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Tanggal Penggajian</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="date" id="tglPenggajian" class="form-control" name="tglPenggajian" placeholder="Tanggal Penggajian">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Nama Karyawan</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <select name="namaKaryawan" class="form-control" id="namaKaryawan">
                                                                    <option value="">Pilih Karyawan</option>
                                                                    <?php foreach ($dataKaryawan as $key => $value) { ?>
                                                                    <option value="<?=$value->id_karyawan;?>"><?=$value->nama_kar;?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Nominal</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="text" id="inputNominalGaji" class="form-control" name="inputNominalGaji" placeholder="Masukan nominal gaji" oninput="formatRibuan(this)">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Metode Penggajian</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <select name="metodeGaji" class="form-control" id="metodeGaji">
                                                                    <option value="">Pilih Metode Penggajian</option>
                                                                    <option value="Cash">Cash</option>
                                                                    <option value="Transfer">Transfer</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Keterangan</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <textarea name="keteranganGaji" class="form-control" id="keteranganGaji" placeholder="Masukan keterangan (opsional)"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                    Tutup
                                                </button>
                                                <button type="button" id="saveGaji" class="btn btn-success ml-1">
                                                    Simpan & Proses
                                                </button>
                                                <img src="<?=base_url();?>assets/images/svg-loaders/rings.svg" alt="loading" id="loadersId2" style="display:none;">
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                
	</div>

</div>

            