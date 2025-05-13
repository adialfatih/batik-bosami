</header>

<div class="content-wrapper container">
	<div class="page-content">
		<section class="row">
			<div class="col-12">
                <div class="card">
                    
                    <div class="card-header" style="width:100%;display:flex;justify-content:space-between;align-items:center;">
                        <h4><?=$title;?></h4>
                        <div>
                        <a href="javascript:void(0);" id="inputPtg" class="btn icon icon-left btn-success" data-bs-toggle="modal" data-bs-target="#addPemasukan"><i data-feather="plus-circle"></i> Pemasukan</a>
                        <a href="javascript:void(0);" id="inputPtg2" class="btn icon icon-left btn-danger" data-bs-toggle="modal" data-bs-target="#addPengeluaran"><i data-feather="plus-circle"></i> Pengeluaran</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="table1">
                                <thead>
                                    <tr>
                                        <th>ALUR</th>
                                        <th>NOMINAL</th>
                                        <th>TANGGAL</th>
                                        <th>KATEGORI</th>
                                        <th>KETERANGAN</th>
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
                                                <h4 class="modal-title" id="addPemasukan22">Input Data Pemasukan</h4>
                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <form class="form form-horizontal">
                                            <div class="modal-body">
                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label>Tanggal</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="date" id="tglMasuk" class="form-control" name="tglMasuk" placeholder="Tanggal Pemasukan">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Nominal</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="text" id="inputNominalMasuk" class="form-control" name="inputNominalMasuk" placeholder="Masukan nominal pemasukan" oninput="formatRibuan(this)">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Kategori</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <select name="kategoriMasuk" class="form-control" id="kategoriMasuk">
                                                                    <option value="">Pilih Kategori</option>
                                                                    <option value="Penjualan">Penjualan</option>
                                                                    <option value="Pendapatan Sampingan">Pendapatan Sampingan</option>
                                                                    <option value="Pendapatan Non-Operasional">Pendapatan Non-Operasional</option>
                                                                    <option value="Retur Penjualan yang Diterima Kembali">Retur Penjualan yang Diterima Kembali</option>
                                                                    <option value="Lain - lain">Lain - lain</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Keterangan</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <textarea name="keteranganMasuk" class="form-control" id="keteranganMasuk" placeholder="Masukan keterangan pemasukan"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                    Tutup
                                                </button>
                                                <button type="button" id="savePemasukan" class="btn btn-success ml-1">
                                                    Simpan Pemasukan
                                                </button>
                                                <img src="<?=base_url();?>assets/images/svg-loaders/rings.svg" alt="loading" id="loadersId2" style="display:none;">
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade text-left" id="addPengeluaran" tabindex="-1" role="dialog" aria-labelledby="addPengeluaran2" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="addPengeluaran22">Input Data Pengeluaran</h4>
                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <form class="form form-horizontal">
                                            <div class="modal-body">
                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label>Tanggal</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="date" id="tglKeluar" class="form-control" name="tglKeluar" placeholder="Tanggal Pengeluaran">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Nominal</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="text" id="inputNominalKeluar" class="form-control" name="inputNominalKeluar" placeholder="Masukan nominal pengeluaran" oninput="formatRibuan(this)">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Kategori</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <select name="kategorikeluar" class="form-control" id="kategorikeluar">
                                                                    <option value="">Pilih Kategori</option>
                                                                    <option value="Operasional Produksi">Operasional Produksi</option>
                                                                    <option value="Pemasaran">Pemasaran</option>
                                                                    <option value="Gaji Karyawan">Gaji Karyawan</option>
                                                                    <option value="Lain - lain">Lain - lain</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Keterangan</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <textarea name="keteranganKeluar" class="form-control" id="keteranganKeluar" placeholder="Masukan keterangan pengeluaran"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                    Tutup
                                                </button>
                                                <button type="button" id="savePengeluaran" class="btn btn-danger ml-1">
                                                    Simpan Pengeluaran
                                                </button>
                                                <img src="<?=base_url();?>assets/images/svg-loaders/rings.svg" alt="loading" id="loadersId3" style="display:none;">
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
	</div>

</div>

            