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
                        <a href="javascript:void(0);" id="inputJual" class="btn icon icon-left btn-success" data-bs-toggle="modal" data-bs-target="#large"><i data-feather="plus-circle"></i> Retur Produk</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="table1">
                                <thead>
                                    <tr>
                                        <th>NO INVOICE</th>
                                        <th>TANGGAL</th>
                                        <th>QTY</th>
                                        <th>ALASAN</th>
                                        <th>KONDISI PRODUK</th>
                                        <th>GANTI</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody"></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="<?=base_url('mutasi/retur-produk');?>" style="font-size:12px;" id="inputJual">Tampilkan data produk yang retur.</a>
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
                                                <h4 class="modal-title" id="myModalLabel17">Input Retur Produk</h4>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body" id="modalsBody">
                                                <input type="hidden" name="codejual" id="codejual" value="<?=$codejual;?>">
                                                <div class="form-body">
                                                    <div class="row">
                                                        <input type="hidden" id="tipeInvSimpan" value="0">
                                                        <strong style="margin-bottom:10px;color:#0760de;">Masukan Nomor Invoice Pengiriman :</strong>
                                                        <div class="col-md-4">
                                                            <label>No Invoice</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="text" class="form-control" name="nomorInvoice" id="nomorInvoice" placeholder="Masukan Nomor Invoice. Ex: INV/2025/0001" value="INV/">
                                                            <small id="notifLoading"></small>
                                                        </div>
                                                        <div id="tableDetilPenjualan" style="width:100%;display:flex;flex-direction:column;justify-content:center;align-items:center;margin-top:10px;"></div>
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
                                <div class="modal fade text-left" id="large23" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel17" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel17">Detail Retur Produk</h4>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body" id="modalsBody25">
                                                
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!--large size Modal 1 end-->
                                
	</div>

</div>

            