</header>

<div class="content-wrapper container">
	<div class="page-content">
		<section class="row">
			<div class="col-12">
                <div class="card">
                    
                    <div class="card-header" style="width:100%;display:flex;justify-content:space-between;align-items:center;">
                        <h4><?=$title;?></h4>
                        <a href="javascript:void(0);" id="inputPtg" class="btn icon icon-left btn-success" data-bs-toggle="modal" data-bs-target="#large"><i data-feather="plus-circle"></i> Input Potong Kain</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="table1">
                                <thead>
                                    <tr>
                                        <th>KODE POTONGAN</th>
                                        <th>TANGGAL POTONG</th>
                                        <th>TUKANG POTONG</th>
                                        <th>KODE KAIN</th>
                                        <th>JUMLAH KIRIM</th>
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
                                                <h4 class="modal-title" id="myModalLabel17">Input Potong Kain</h4>
                                                <button type="button" class="close" onclick="loadPotongKain()" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body" id="modalsBody">
                                                <input type="hidden" name="inputCode" id="inputCode" value="0">
                                                <input type="hidden" name="savenow" id="savenowid" value="not">
                                                <div class="form-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label>Tanggal Potong</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="date" class="form-control" name="tanggalPotong" id="tanggalPotong" required>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Tukang Potong</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <select name="tukangPotong" id="tukangPotong" class="form-control" required>
                                                                <option value="">Pilih Tukang Potong</option>
                                                                <?php foreach($ptg->result() as $row){
                                                                    $showPtg = $row->kode_ptg." - ".$row->nama_ptg;
                                                                    echo "<option value='".$row->kode_ptg."'>".$showPtg."</option>";
                                                                }?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Nama Kain</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <select name="namaKain" id="namaKain" class="form-control" required>
                                                                <option value="">Pilih Kain Yang Akan Dipotong</option>
                                                                <?php foreach($kaindata->result() as $row2){
                                                                    $showKain = $row2->inisial." - ".$row2->nama_kain;
                                                                    echo "<option value='".$row2->inisial."'>".$showKain."</option>";
                                                                }?>
                                                            </select>
                                                            <small id="showStokID"></small>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Total Kain (Yard)</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="text" oninput="formatRibuan2(this)" class="form-control" name="jmlPotong" id="jmlPotong" placeholder="Jumlah Kain Yang Akan Dipotong" required>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label>Ongkos Potong Total</label>
                                                        </div>
                                                        <div class="col-md-8 form-group">
                                                            <input type="text" oninput="formatRibuan(this)" class="form-control" name="ongkosPotong" id="ongkosPotong" placeholder="Masukan total ongkos potong" required>
                                                        </div>
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered" id="hasilPotonganTable"></table>
                                                            <table class="table table-bordered">
                                                                <tr>
                                                                    <td colspan="3" style="font-weight:bold;">Masukan Hasil Potong : </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <span>Ukuran Potong (Meter)</span>
                                                                        <input type="text" class="form-control" placeholder="Format : Panjang x Lebar" id="ukrPotongMtr">
                                                                        <small>Contoh: 1.6 x 1.8</small>
                                                                    </td>
                                                                    <td>
                                                                        <span>Jumlah Potong (Pcs)</span>
                                                                        <input type="number" class="form-control" placeholder="Masukan Jumlah Potong" id="jmlPtpngPcs">
                                                                        <small>&nbsp;</small>
                                                                    </td>
                                                                    <td>
                                                                        <button class="btn btn-success" id="addPlusPotong"><i data-feather="plus"></i></button>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                        <div id="noteIdPotongan"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary"
                                                    data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="button" class="btn btn-primary" id="simpanButtons">
                                                    Simpan
                                                </button>
                                            </div> -->
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                
	</div>

</div>

            