</header>

<div class="content-wrapper container">
	<div class="page-content">
		<section class="row">
			<div class="col-12">
                <div class="card">
                    
                    <div class="card-header" style="width:100%;display:flex;justify-content:space-between;align-items:center;">
                        <h4><?=$title;?></h4>
                        <?php if($sess_akses=="root"){?>
                        <a href="javascript:void(0);" class="btn icon icon-left btn-success" data-bs-toggle="modal" data-bs-target="#large"><i data-feather="plus-circle"></i> Input Pembelian</a>
                        <?php } ?>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="table1">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>TANGGAL PEMBELIAN</th>
                                        <th>KODE KAIN</th>
                                        <th>JUMLAH</th>
                                        <th>HARGA PERYARD</th>
                                        <th>HARGA PEMBELIAN</th>
                                        <th>BEA DLL</th>
                                        <th>SUPPLIER</th>
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
                                                <h4 class="modal-title" id="myModalLabel17">Input Pembelian Kain</h4>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <form class="form form-horizontal" enctype="multipart/form-data" action="<?=base_url('save-pembelian');?>" method="post">
                                            <div class="modal-body">
                                                    <input type="hidden" id="idUsers" value="0">
                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label>Tanggal Pembelian</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="date" id="tanggalBeli" class="form-control" name="tanggalBeli" placeholder="Masukan Tanggal Pembelian" required>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Kain</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <select name="kain" id="kainId" class="form-control" required>
                                                                    <option value="">Pilih Kain</option>
                                                                    <?php foreach ($kaindata->result() as $k) { 
                                                                    $nmkain = strtolower($k->nama_kain);
                                                                    ?>
                                                                        <option value="<?=$k->inisial;?>"><?=$k->inisial;?> - <?=ucwords($nmkain);?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Jumlah (Yard)</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="text" id="jmlyard" class="form-control" name="jmlyard" placeholder="Masukan jumlah pembelian" oninput="formatRibuan2(this); hitungTotal()" required>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Harga /yard</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="text" id="hargayard" class="form-control" name="hargayard" placeholder="Masukan harga per yard" oninput="formatRibuan(this); hitungTotal()" required>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Total Harga</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="text" id="totalhargayard" class="form-control" name="totalhargayard" placeholder="Masukan harga total" oninput="formatRibuan(this); hitungTotal()" required>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Nama Supplier</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="text" id="sup" class="form-control" name="sup" placeholder="Masukan nama supplier" required>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Pembayaran</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <select name="pembayaran" id="pembayaran" class="form-control">
                                                                    <option value="">Pilih Pembayaran</option>
                                                                    <option value="Tunai">Tunai</option>
                                                                    <option value="Transfer">Transfer</option>
                                                                    <option value="Virtual Account">Virtual Account</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Bukti Pembayaran</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="file" id="file" class="form-control" name="file" placeholder="Masukan bukti bayar">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Biaya Lain-lain</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="text" id="bea" class="form-control" name="bea" placeholder="Masukan biaya lain-lain" oninput="formatRibuan(this)" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary"
                                                    data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="submit" id="submitUsers" class="btn btn-primary ml-1">
                                                    Submit
                                                </button>
                                                <img src="<?=base_url();?>assets/images/svg-loaders/rings.svg" alt="loading" id="loadersId" style="display:none;">
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade text-left" id="large12" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel1723" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel1723">Detail Pembelian Kain</h4>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <form class="form form-horizontal">
                                            <div class="modal-body">
                                                    <input type="hidden" id="kodePembelian" value="0">
                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label>Tanggal Pembelian</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="text" id="tanggalBeli2" class="form-control" name="tanggalBeli" placeholder="Masukan Tanggal Pembelian" required>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Kain</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <select name="kain" id="kainId23" class="form-control" required>
                                                                    <option value="">Pilih Kain</option>
                                                                    <?php foreach ($kaindata->result() as $k) { 
                                                                    $nmkain = strtolower($k->nama_kain);
                                                                    ?>
                                                                        <option value="<?=$k->inisial;?>"><?=$k->inisial;?> - <?=ucwords($nmkain);?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Jumlah (Yard)</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="text" id="jmlyard123" class="form-control" name="jmlyard" placeholder="Masukan jumlah pembelian" oninput="formatRibuan2(this); hitungTotal()" required>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Harga /yard</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="text" id="hargayard124" class="form-control" name="hargayard" placeholder="Masukan harga per yard" oninput="formatRibuan(this); hitungTotal()" required>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Total Harga</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="text" id="totalhargayard675" class="form-control" name="totalhargayard" placeholder="Masukan harga total" oninput="formatRibuan(this); hitungTotal()" required>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Nama Supplier</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="text" id="sup789" class="form-control" name="sup" placeholder="Masukan nama supplier" required>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Pembayaran</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <select name="pembayaran" id="pembayaran851" class="form-control">
                                                                    <option value="">Pilih Pembayaran</option>
                                                                    <option value="Tunai">Tunai</option>
                                                                    <option value="Transfer">Transfer</option>
                                                                    <option value="Virtual Account">Virtual Account</option>
                                                                </select>
                                                            </div>
                                                            
                                                            <div class="col-md-4">
                                                                <label>Biaya Lain-lain</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="text" id="bea123" class="form-control" name="bea" placeholder="Masukan biaya lain-lain" oninput="formatRibuan(this)" >
                                                            </div>
                                                            <div id="noteid"></div>
                                                        </div>
                                                    </div>
                                                
                                            </div>
                                            <!-- <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary"
                                                    data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="button" id="submitUsersPass" class="btn btn-warning ml-1">
                                                    Update
                                                </button>
                                                <img src="<=base_url();?>assets/images/svg-loaders/rings.svg" alt="loading" id="loadersId2" style="display:none;">
                                            </div> -->
                                            </form>
                                        </div>
                                    </div>
                                </div>
	</div>

</div>

            