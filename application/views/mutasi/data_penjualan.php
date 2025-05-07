</header>

<div class="content-wrapper container">
	<div class="page-content">
		<section class="row">
			<div class="col-12">
                <!-- <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <i class="bi bi-info-circle"></i> &nbsp;Klik Pada Kode Jahit Untuk Informasi Lengkap
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div> -->
                <div class="card">
                    <div class="card-header" style="width:100%;display:flex;justify-content:space-between;align-items:center;">
                        <h4><?=$title;?></h4>
                        <a href="javascript:void(0);" id="inputJual" class="btn icon icon-left btn-success" data-bs-toggle="modal" data-bs-target="#large"><i data-feather="plus-circle"></i> Input Penjualan</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="table1">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>TANGGAL</th>
                                        <th>PENJUALAN</th>
                                        <th>NAMA CUSTOMER</th>
                                        <th>TOTAL PRODUK</th>
                                        <th>TOTAL HARGA</th>
                                        <th>ONGKIR</th>
                                        <th>PLATFORM</th>
                                        <th>STATUS</th>
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
                            <!--large size Modal -->
                                <div class="modal fade text-left" id="large" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel17" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel17">Buat Transaksi Penjualan</h4>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body" id="modalsBody">
                                                <input type="hidden" name="codejual" id="codejual" value="<?=$codejual;?>">
                                                <div class="form-body">
                                                    <div class="row">
                                                        <strong style="margin-bottom:10px;color:#0760de;">Input Data Penjualan :</strong>
                                                        <div class="col-md-4">
                                                            <label>Tanggal Penjualan</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="date" class="form-control" name="tglPenjualan" id="tglPenjualan" placeholder="Masukan Tanggal Penjualan">
                                                        </div>
                                                        
                                                        <!-- <div class="col-md-4">
                                                            <label>Total Dibayar</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="text" oninput="formatRibuan(this)" class="form-control" name="totalDibayar" id="totalDibayar" placeholder="Masukan Harga Total Dibayar">
                                                        </div> -->
                                                        
                                                        <div class="col-md-4">
                                                            <label>Kirim Ke</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <select name="kirimKe" id="kirimKe" class="form-control" required>
                                                                <option value="">Pilih</option>
                                                                <option value="Customer">Customer</option>
                                                                <option value="Reseller">Reseller</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label id="thisNama">Nama</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="text" class="form-control" name="namaCus" id="namaCus" placeholder="Masukan Nama" disabled>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Platform Penjualan</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <select name="platformPenjualan" id="platformPenjualan" class="form-control" required>
                                                                <option value="">Pilih</option>
                                                                <option value="Toko">Toko</option>
                                                                <option value="Website">Website</option>
                                                                <option value="Shopee">Shopee</option>
                                                                <option value="Tiktok">Tiktok</option>
                                                                <option value="Tokopedia">Tokopedia</option>
                                                                <option value="Lainnya">Lainnya</option>
                                                            </select>
                                                        </div>
                                                    <strong style="margin-bottom:5px;color:#0760de;">Pilih Produk</strong>
                                                        <div class="col-md-4">
                                                            <label>Nama Produk</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <div class="form-label">
                                                                <div class="autoComplete_wrapper">
                                                                    <input id="autoComplete" type="search" dir="ltrp" spellcheck=false autocorrect="off" autocomplete="off" autocapitalize="off" onchange="lihatStokProduk()">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Model Produk</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <select name="modelProduk" id="modelProduk" onchange="lihatStokProduk()" class="form-control" disabled>
                                                                <option value="">Pilih Nama Produk Terlebih Dahulu</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Ukuran Produk</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <select name="ukrproduk" id="ukrproduk" onchange="lihatStokProduk()" class="form-control" disabled>
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
                                                            <label>Stok Tersedia</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="number" class="form-control" name="stokTersedia" id="stokTersedia" placeholder="0" readonly>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Jumlah Penjualan</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="number" class="form-control" name="jmlPenjualan" id="jmlPenjualan" placeholder="Masukan Jumlah Penjualan">
                                                        </div>
                                                        <div style="width:100%;" id="tablePenjualan"></div>
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
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--large size Modal 1 end-->
                                <!--large size Modal -->
                                <div class="modal fade text-left" id="large2" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel17" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel17">Proses Pembayaran</h4>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body" id="modalsBody">
                                                <form action="<?=base_url('simpan-pembayaran');?>" enctype="multipart/form-data" method="post">
                                                <input type="hidden" name="codejual" id="codejual2" value="0">
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label>Tanggal Penjualan</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="text" class="form-control" name="tglid" id="tglid"  readonly>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Nama Customer</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="text" class="form-control" name="cusid" id="cusid"  readonly>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Ongkos Kirim</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="text" oninput="formatRibuan(this)" class="form-control" name="nominalid" placeholder="0" id="nominalid"  required>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Pembayaran</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <select name="pembid" id="pembid" class="form-control" required>
                                                                <option value="">Pilih Pembayaran</option>
                                                                <option value="Tunai">Tunai</option>
                                                                <option value="Transfer">Transfer</option>
                                                                <option value="Virtual Account">Virtual Account</option>
                                                                <option value="Belum Dibayar">Belum Dibayar</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Bukti Pembayaran</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="file"  class="form-control" name="file" id="file">
                                                        </div>
                                                        <div id="tableHargaJual"></div>
                                                        <div id="showBuktiBayar"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary"
                                                    data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="submit" class="btn btn-primary" id="simpanButtons2">
                                                    Simpan
                                                </button>
                                                <img src="<?=base_url();?>assets/images/svg-loaders/rings.svg" alt="loading" id="loadersId2" style="display:none;">
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--large size Modal -->
                                <div class="modal fade text-left" id="large22" tabindex="-1" role="dialog" aria-labelledby="myModalLabel171231" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel171231">Status</h4>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body" id="modalsBody123">
                                                <div class="form-body">
                                                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Porro quod corrupti laudantium minima harum praesentium ea blanditiis consectetur, recusandae adipisci nostrum excepturi assumenda! Molestiae ipsam iure fugiat tenetur minima doloremque.
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
	</div>

</div>

            