</header>

<div class="content-wrapper container">
	<div class="page-content">
		<section class="row">
			<div class="col-12">
                <div class="card">
                    <div class="card-header" style="width:100%;display:flex;justify-content:space-between;align-items:center;">
                        <h4>Master / Data Jenis Babaran</h4>
                        <a href="javascript:void(0);" class="btn icon icon-left btn-primary" data-bs-toggle="modal" data-bs-target="#large"><i data-feather="plus-circle"></i> Tambah Data</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                        <table class="table table-hover" id="table1">
                            <thead>
                                <tr>
                                    <th style="text-align:center;">NO</th>
                                    <th style="text-align:left;">JENIS BABARAN</th>
                                    <th style="text-align:center;">#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if($recordTable->num_rows() > 0){
                                    $no=1;
                                    foreach($recordTable->result() as $val){
                                        ?>
                                <tr>
                                    <td style="text-align:center;"><?=$no;?></td>
                                    <td style="text-align:left;"><?=$val->jenis_babaran;?></td>
                                    <td style="text-align:center;">
                                        <a class="btn btn-danger" href="javascript:void(0);" onclick="hapusBarbar('<?=$val->jenis_babaran;?>')">Hapus</a>
                                    </td>
                                </tr>
                                        <?php
                                        $no++;
                                    }
                                }
                                ?>
                            </tbody>
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
                                                <h4 class="modal-title" id="myModalLabel17">Tambah Jenis Babaran</h4>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <form class="form form-horizontal" action="<?=base_url('simpan-babaran');?>" method="post">
                                            <div class="modal-body">
                                                
                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label>Jenis Babaran</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="text" id="namaBabaran" class="form-control" name="namaBabaran" placeholder="Masukan Jenis Babaran" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary"
                                                    data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="submit" id="submitPembatik" class="btn btn-primary ml-1">
                                                    Submit
                                                </button>
                                                <img src="<?=base_url();?>assets/images/svg-loaders/rings.svg" alt="loading" id="loadersId" style="display:none;">
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                
	</div>

</div>

            