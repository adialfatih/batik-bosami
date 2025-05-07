</header>

<div class="content-wrapper container">
	<div class="page-content">
		<section class="row">
			<div class="col-12">
                <div class="card">
                    
                    <div class="card-header" style="width:100%;display:flex;justify-content:space-between;align-items:center;">
                        <h4><?=$title;?></h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="table1">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>KODE PRODUKSI</th>
                                        <th>NAMA PRODUK</th>
                                        <th>MODEL</th>
                                        <th>UKURAN</th>
                                        <th>STOK AWAL</th>
                                        <th>TERJUAL</th>
                                        <th>CACAT</th>
                                        <th>PERBAIKAN</th>
                                        <th>STOK TERKINI</th>
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
                                <div class="modal fade text-left" id="large23" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel17" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel17">Detail Produksi</h4>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body" id="modalsBody">
                                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatibus perspiciatis iure facilis molestias ut odit animi esse, in deserunt quisquam ratione voluptatum impedit debitis sed rerum modi. Voluptatibus, maiores ut.
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
                                <!--large size Modal -->
                                <div class="modal fade text-left" id="modalHpp" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel13" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel13">HPP dan Harga Jual</h4>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body" id="modalsBody2">
                                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatibus perspiciatis iure facilis molestias ut odit animi esse, in deserunt quisquam ratione voluptatum impedit debitis sed rerum modi. Voluptatibus, maiores ut.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary"
                                                    data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="button" class="btn btn-success" id="simpanHarga">
                                                    Update Harga
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--large size Modal -->
                                <div class="modal fade text-left" id="modalCCt" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel13134" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel13134">Data Produksi Cacat</h4>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body" id="modalsBody212">
                                                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatibus perspiciatis iure facilis molestias ut odit animi esse, in deserunt quisquam ratione voluptatum impedit debitis sed rerum modi. Voluptatibus, maiores ut.
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
	</div>

</div>

            