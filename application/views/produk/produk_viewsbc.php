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
                <?php 
                if($produkdata->num_rows() > 0){
                    foreach($produkdata->result() as $row):
                    $foto = $row->foto_produk;
                ?>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div style="width:100%;margin-bottom:10px;position:relative;">
                                    <div style="width:25px;height:25px;background:#d60404;position:absolute;top:5px;right:15px;border-radius:50%;color:#fff;display:flex;justify-content:center;cursor:pointer;" onclick="uploads('<?=$row->kode_produk;?>','<?=$row->nama_produk;?>')"><i class="bi bi-upload"></i></div>
                                    <?php if($foto=="null"){ ?>
                                        <img src="<?=base_url('logo/logo.png');?>" style="width:100%;" alt="<?=$row->nama_produk;?>">
                                    <?php } else { ?>
                                        <img src="<?=base_url('uploads/produks/'.$foto);?>" style="width:100%;" alt="<?=$row->nama_produk;?>">
                                    <?php } ?>
                                </div>
                                <strong style="color:#0455d6;"><?=$row->nama_produk;?></strong>
                                <?php
                                $vars = $this->data_model->get_byid('master_produk_varians',['kode_produk'=>$row->kode_produk])->result();
                                foreach($vars as $var){
                                $kodevar = $var->kode_varians;
                                $models = strtolower($var->models);
                                ?>
                                <div style="width:100%;display:flex;justify-content:space-between;">
                                    <span>&bull; <?=ucwords($models);?></span>
                                    <div>
                                        <?php
                                        $cekSize = $this->db->query("SELECT * FROM stok_produk WHERE kode_varians='$kodevar' GROUP BY ukuran");
                                        if($cekSize->num_rows() > 0){
                                        foreach($cekSize->result() as $zi){
                                            $ukr = $zi->ukuran;
                                            if($ukr == "All Size"){ $ukrprint=""; } else { $ukrprint=$ukr." - "; }
                                            $pcs = $this->db->query("SELECT COUNT(id_stokproduk) AS jml FROM stok_produk WHERE kode_varians='$kodevar' AND ukuran='$ukr'")->row("jml");
                                            echo $ukrprint."<strong>".$pcs."</strong> Pcs<br>";
                                        }
                                        } else {
                                            echo "<font style='color:red;'>0 Pcs</font>";
                                        }
                                        ?>
                                    </div>
                                </div>
                                <?php } 
                                $cekDefect = $this->data_model->get_byid('stok_produk_cct',['kode_produk'=>$row->kode_produk])->num_rows();
                                if($cekDefect > 0){
                                ?>
                                <div style="width:100%;display:flex;justify-content:space-between;">
                                    <span>&bull; <a href="javascript:void(0);" style="color:#e66707;" onclick="defectShow('<?=$row->kode_produk;?>')">Stok Defect</a></span>
                                    <div style="color:#e66707;"><strong><?=$cekDefect;?></strong> Pcs</div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; } ?>
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
	</div>

</div>

            