</header>

<div class="content-wrapper container">
	<div class="page-content">
		<section class="row">
			<div class="col-12">
                <div class="card">
                    <div class="card-header" style="width:100%;display:flex;justify-content:space-between;align-items:center;">
                        <h4>Master / Data Pembatik</h4>
                        <a href="javascript:void(0);" class="btn icon icon-left btn-primary" data-bs-toggle="modal" data-bs-target="#large"><i data-feather="plus-circle"></i> Tambah Data</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NAMA PEMBATIK</th>
                                    <th>KODE PEMBATIK</th>
                                    <th>ALAMAT</th>
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
                                                <h4 class="modal-title" id="myModalLabel17">Tambah Pembatik</h4>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <form class="form form-horizontal">
                                            <div class="modal-body">
                                                
                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label>Nama Pembatik</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="text" id="namaPembatik" class="form-control" name="namakain" placeholder="Masukan nama Pembatik" required>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Pembatik Kode</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="text" id="kodePembatik" class="form-control" name="kons" placeholder="Masukan kode Pembatik / inisial" required>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Alamat</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <textarea name="alamat" id="alamat" class="form-control" placeholder="Masukan alamat pembatik (opsional)"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary"
                                                    data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="button" id="submitPembatik" class="btn btn-primary ml-1">
                                                    Submit
                                                </button>
                                                <img src="<?=base_url();?>assets/images/svg-loaders/rings.svg" alt="loading" id="loadersId" style="display:none;">
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--large size Modal -->
                                <div class="modal fade text-left" id="large2" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel172" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel172">Update Data Pembatik</h4>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <form class="form form-horizontal">
                                            <input type="hidden" id="idHidden23" value="0">
                                            <div class="modal-body">
                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label>Nama Pembatik</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="text" id="namaPembatik2" class="form-control" name="namakain" placeholder="Masukan nama Pembatik" required>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Pembatik Kode</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="text" id="kodePembatik2" class="form-control" name="kons" placeholder="Masukan kode Pembatik / inisial" required>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Alamat</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <textarea name="alamat" id="alamat2" class="form-control" placeholder="Masukan alamat pembatik (opsional)"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary"
                                                    data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="button" id="submitPembatik2" class="btn btn-success ml-1">
                                                    Update
                                                </button>
                                                <img src="<?=base_url();?>assets/images/svg-loaders/rings.svg" alt="loading" id="loadersId2" style="display:none;">
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--large size Modal -->
                                <div class="modal fade text-left" id="modalHarga" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel172" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel172">Update Harga Penjahit</h4>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            
                                            <input type="hidden" id="idHidden2309" value="0">
                                            <div class="modal-body">
                                                <div class="form-body" id="modalUpdateHarga">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
	</div>

</div>

            