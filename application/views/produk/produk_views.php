</header>

<div class="content-wrapper container">
	<div class="page-content">
		<section class="row">
			<div class="col-12">
                <div class="card">
                    <div class="card-header" style="width:100%;display:flex;justify-content:space-between;align-items:center;">
                        <h4># <?=$title;?></h4>
                        <div style="display:flex;align-items:center;gap:10px;">
                            
                            <div class="form-label" style="width:250px;">
                                <div class="autoComplete_wrapper" style="width:250px;">
                                    <input id="autoComplete" style="width:250px;" type="search" dir="ltr" spellcheck=false autocorrect="off" autocomplete="off" autocapitalize="off">
                                </div>
                            </div>
                            <a href="<?=base_url('product-bosami-charts');?>">
                            <button type="button" class="btn btn-primary"><i class="bi bi-bar-chart-line"></i> Tampilan Grafik</button></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" id="rowProduksID">
                <div style="width:100%;display:flex;justify-content:center;flex-direction:column;align-items:center;"><div class="loader"></div><span>Loading data ...</span></div>
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
                                                            <input type="text" class="form-control" name="nmProduks" id="nmProduks" placeholder="Masukan Kode Produk" readonly>
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
                                <!--large size Modal -->
                                <div class="modal fade text-left" id="large231" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1723" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel1723">Stok Defect</h4>
                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body" id="modalsBody12345">
                                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque, reprehenderit neque id officia dicta maxime a, natus ducimus animi nemo reiciendis sunt, sint itaque voluptatibus? At, nostrum necessitatibus! Facere, nisi.
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
                                <div class="modal fade text-left" id="addStokAwal" tabindex="-1" role="dialog" aria-labelledby="addStokAwal2" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="addStokAwal2">Tambah Stok Awal</h4>
                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body" id="moda1123s">
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label>Nama Produk</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="text" class="form-control" name="nmProduks12" id="nmProduks12" placeholder="Masukan Kode Produk" readonly>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Model Produk</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="text" class="form-control" name="mdlsProduks" id="mdlsProduks" placeholder="Masukan Model Produk" readonly>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Ukuran Produk</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <select name="ukrproduk" id="ukrproduk" class="form-control">
                                                                <option value="">Pilih Ukuran Produk</option>
                                                                <option value="All Size">All Size</option>
                                                                <option value="S">S - Small</option>
                                                                <option value="M">M - Medium</option>
                                                                <option value="L">L - Large</option>
                                                                <option value="XL">XL - Xtra Large</option>
                                                                <option value="XXL">XXL - Doble Xtra Large</option>
                                                                <option value="XXXL">XXXL - Triple Xtra Large</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Harga Produksi (HPP)</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="text" class="form-control" name="hpp1" id="hpp1" placeholder="Masukan Harga Modal Produk" oninput="formatRibuan(this)">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Harga Jual Produk</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="text" class="form-control" name="hrgJual" id="hrgJual" placeholder="Masukan Harga Jual Produk" oninput="formatRibuan(this)">
                                                        </div>
                                                        
                                                        <div class="col-md-4">
                                                            <label style="color:red;">Jumlah Stok Awal</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="text" class="form-control" name="stokAwal" id="stokAwal" placeholder="Masukan Jumlah Stok Awal" oninput="formatRibuan(this)">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Kode Produksi</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="text" class="form-control" name="kdProduksi" id="kdProduksi" placeholder="Masukan Kode Produksi (opsional)" >
                                                        </div>
                                                        <div class="col-md-4">
                                                            <input type="hidden" name="kdpdks1" id="kdpdks1">
                                                            <input type="hidden" name="kdvars1" id="kdvars1">
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            &nbsp;
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="button" class="btn btn-primary" id="saveStokAwal">
                                                    Simpan
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
	</div>

</div>

            