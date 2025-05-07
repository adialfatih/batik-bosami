</header>

<div class="content-wrapper container">
	<div class="page-content">
		<section class="row">
			<div class="col-12">
                <div class="card">
                    <div class="card-header" style="width:100%;display:flex;justify-content:space-between;align-items:center;">
                        <h4>Master / Data Tukang Potong</h4>
                        <a href="javascript:void(0);" class="btn icon icon-left btn-primary" data-bs-toggle="modal" data-bs-target="#large"><i data-feather="plus-circle"></i> Tambah Data</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NAMA PEMOTONG</th>
                                    <th>KODE PEMOTONG</th>
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
                                                <h4 class="modal-title" id="myModalLabel17">Tambah Tukang Potong</h4>
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
                                                                <label>Nama Tukang Potong</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="text" id="namaPtg" class="form-control" name="namakain" placeholder="Masukan nama Tukang Potong" required>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Tukang Potong Kode</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="text" id="kodePtg" class="form-control" name="kons" placeholder="Masukan kode Tukang Potong / inisial" required>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Alamat</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <textarea name="alamat" id="alamat" class="form-control" placeholder="Masukan alamat Tukang Potong (opsional)"></textarea>
                                                            </div>
                                                        </div>
                                                </div>
                                                
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary"
                                                    data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="button" id="submitPtg" class="btn btn-primary ml-1">
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
                                                <h4 class="modal-title" id="myModalLabel172">Update Data Pemotong</h4>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <form class="form form-horizontal">
                                            <input type="hidden" id="idptg" value="0">
                                            <div class="modal-body">
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label>Nama Tukang Potong</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="text" id="namaPtg2" class="form-control" name="namakain" placeholder="Masukan nama Tukang Potong" required>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Tukang Potong Kode</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="text" id="kodePtg2" class="form-control" name="kons" placeholder="Masukan kode Tukang Potong / inisial" required>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Alamat</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <textarea name="alamat" id="alamat2" class="form-control" placeholder="Masukan alamat Tukang Potong (opsional)"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary"
                                                    data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="button" id="submitPtg2" class="btn btn-success ml-1">
                                                    Update
                                                </button>
                                                <img src="<?=base_url();?>assets/images/svg-loaders/rings.svg" alt="loading" id="loadersId2" style="display:none;">
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
	</div>

</div>

            