</header>

<div class="content-wrapper container">
	<div class="page-content">
		<section class="row">
			<div class="col-12">
                <div class="card">
                    <?php if($sess_akses == "root"){?>
                    <div class="card-header" style="width:100%;display:flex;justify-content:space-between;align-items:center;">
                        <h4>Users Account</h4>
                        <a href="javascript:void(0);" id="toModals" class="btn icon icon-left btn-primary" data-bs-toggle="modal" data-bs-target="#large"><i data-feather="plus-circle"></i> Tambah Data</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NAMA USER</th>
                                    <th>USERNAME LOGIN</th>
                                    <th>HAK AKSES</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody"></tbody>
                        </table>
                        </div>
                    </div>
                    <?php } else { ?>
                    <div class="card-body">
                        <span style="color:red;">ANDA TIDAK MEMILIKI AKSES KE HALAMAN INI</span>
                    </div>
                    <?php } ?>
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
                                                <h4 class="modal-title" id="myModalLabel17">Tambah Akses User</h4>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <form class="form form-horizontal">
                                            <div class="modal-body">
                                                    <input type="hidden" id="idUsers" value="0">
                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label>Nama User</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="text" id="usersNama" class="form-control" name="usersNama" placeholder="Masukan Nama User" required>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Username Login</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="text" id="username" class="form-control" name="username" placeholder="Masukan username login" required>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Password</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="text" id="pass" class="form-control" name="pass" placeholder="Masukan password login" required>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label>Hak Akses</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <select name="akses" id="aksesid" class="form-control">
                                                                    <option value="">Pilih Akses User</option>
                                                                    <option value="root">Super Admin</option>
                                                                    <option value="admin">Admin</option>
                                                                </select>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary"
                                                    data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="button" id="submitUsers" class="btn btn-primary ml-1">
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
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel1723">Ubah Password</h4>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <form class="form form-horizontal">
                                            <div class="modal-body">
                                                    <input type="hidden" id="idUsers23" value="0">
                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label>Nama User</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="text" id="usersNama23" class="form-control" name="usersNama" placeholder="Masukan Nama User" readonly>
                                                            </div>
                                                            
                                                            <div class="col-md-4">
                                                                <label>Password</label>
                                                            </div>
                                                            <div class="col-md-8 form-group">
                                                                <input type="text" id="pass23" class="form-control" name="pass" placeholder="Masukan password login" required>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary"
                                                    data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="button" id="submitUsersPass" class="btn btn-primary ml-1">
                                                    Submit
                                                </button>
                                                <img src="<?=base_url();?>assets/images/svg-loaders/rings.svg" alt="loading" id="loadersId2" style="display:none;">
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
	</div>

</div>

            