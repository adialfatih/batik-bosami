</header>

<div class="content-wrapper container">
	<div class="page-content">
		<section class="row">
			<div class="col-12">
                <div class="card">
                    <div class="card-header" style="width:100%;display:flex;justify-content:space-between;align-items:center;">
                        <h4># <?=$title;?></h4>
                        <a href="<?=base_url('product-bosami');?>">
                        <button type="button" class="btn btn-primary"><i class="bi bi-grid-3x2-gap-fill"></i> Tampilan Grid</button></a>
                    </div>
                    <div class="card-body">
                        <canvas id="bar"></canvas>
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
                                                <h4 class="modal-title" id="myModalLabel17">Upload Image</h4>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <form action="<?=base_url('image-produks');?>" method="post" enctype="multipart/form-data">
                                            <div class="modal-body" id="modalsBody">
                                                <input type="hidden" id="kode_produks" name="kode_produks" value="0">
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label>Nama Produk</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="text" class="form-control" name="nmProduks" id="nmProduks" placeholder="Masukan Kode Jahit" readonly>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Foto Produk</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="file" class="form-control" name="file" id="file" placeholder="Masukan Foto" required>
                                                            <small>Ukuran Max : 1MB (1024kb), Format : jpg, jpeg, png</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary"
                                                    data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="submit" class="btn btn-success">
                                                    Upload
                                                </button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                
	</div>

</div>

            