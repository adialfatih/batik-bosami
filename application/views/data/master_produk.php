</header>

<div class="content-wrapper container">
	<div class="page-content">
		<section class="row">
			<div class="col-12">
                <div class="card">
                    <div class="card-header" style="width:100%;display:flex;justify-content:space-between;align-items:center;">
                        <h4>Master / Data Produk</h4>
                        <a href="javascript:void(0);" id="toModals" class="btn icon icon-left btn-primary" data-bs-toggle="modal" data-bs-target="#large"><i data-feather="plus-circle"></i> Tambah Data</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>KODE PRODUK</th>
                                    <th>NAMA PRODUK</th>
                                    <th>VARIAN / MODEL</th>
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
                                                <h4 class="modal-title" id="myModalLabel17">Tambah Produk</h4>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <form class="form form-horizontal">
                                            <div class="modal-body">
                                                    <input type="hidden" id="idProduk" value="0">
                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label>Nama Produk</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="text" id="namaProduk" class="form-control" name="namaProduk" placeholder="Masukan nama Produk" required>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Kode Produk</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="text" id="kodeProduk" class="form-control" name="kodeProduk" placeholder="Masukan kode Produk" required>
                                                                <small id="tesid" style="color:red;"></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary"
                                                    data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="button" id="submitProduk" class="btn btn-primary ml-1">
                                                    Submit
                                                </button>
                                                <img src="<?=base_url();?>assets/images/svg-loaders/rings.svg" alt="loading" id="loadersId" style="display:none;">
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade text-left" id="modalVarian" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel1723" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel1723">Tambah Varian Produk</h4>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <form class="form form-horizontal">
                                            <div class="modal-body">
                                                    <input type="hidden" id="idProduk234" value="0">
                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label>Kode Produk</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="text" id="kodeProduk23" class="form-control" name="kodeProduk" placeholder="Masukan nama Produk" readonly>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Nama Produk</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="text" id="namaProduk23" class="form-control" name="namaProduk" placeholder="Masukan nama Produk" readonly>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Model Produk</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="text" id="models" class="form-control" name="models" placeholder="Masukan Model/Varian Produk" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary"
                                                    data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="button" id="submitProduk45" class="btn btn-primary ml-1">
                                                    Simpan Model
                                                </button>
                                                <img src="<?=base_url();?>assets/images/svg-loaders/rings.svg" alt="loading" id="loadersId2" style="display:none;">
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade text-left" id="modalVarianShow" tabindex="-1" role="dialog"
                                    aria-labelledby="myModal45" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModal45">Nama Produk</h4>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <form class="form form-horizontal">
                                            <div class="modal-body" id="showVariansHere">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi ex itaque ab, ratione provident fuga impedit quae cumque laborum nostrum, nulla ipsa voluptatem vel, non atque iusto deleniti dolor. Autem!
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
	</div>

</div>

            