</header>

<div class="content-wrapper container">
	<div class="page-content">
		<section class="row">
			<div class="col-12">
                <div class="card">
                    <div class="card-header" style="width:100%;display:flex;justify-content:space-between;align-items:center;">
                        <h4>Master / Data Karyawan</h4>
                        <a href="javascript:void(0);" id="toModals" class="btn icon icon-left btn-primary" data-bs-toggle="modal" data-bs-target="#large"><i data-feather="plus-circle"></i> Tambah Data</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NAMA KARYAWAN</th>
                                    <th>NOMOR HP</th>
                                    <th>STATUS</th>
                                    <th>LAMA BEKERJA</th>
                                    <th>#</th>
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
                                                <h4 class="modal-title" id="myModalLabel17">Tambah Data Karyawan</h4>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <form class="form form-horizontal">
                                            <div class="modal-body">
                                                    <input type="hidden" id="idKaryawan" value="0">
                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label>NIK Karyawan</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="number" id="nikKar" class="form-control" name="nikKar" placeholder="Masukan NIK Karyawan" required>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Nama Karyawan</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="text" id="namaKar" class="form-control" name="namaKar" placeholder="Masukan nama karyawan" required>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Nomor HP / WA</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="text" id="nomowa" class="form-control" name="nomowa" placeholder="Masukan nomor HP / Wa" required>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Alamat</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <textarea name="alamat" id="alamat" class="form-control" placeholder="Masukan alamat karyawan (opsional)"></textarea>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Tanggal Awal Bekerja</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="date" id="tglAwal" class="form-control" name="tglAwal">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Status Aktif</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="text" id="statusAktif" class="form-control" name="statusAktif" value="Aktif" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary"
                                                    data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="button" id="submitKaryawan" class="btn btn-primary ml-1">
                                                    Submit
                                                </button>
                                                <img src="<?=base_url();?>assets/images/svg-loaders/rings.svg" alt="loading" id="loadersId" style="display:none;">
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
	</div>

</div>

            