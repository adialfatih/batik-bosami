<footer style="margin:20px 0px;">
                <div class="container">
                    <div class="footer clearfix mb-0 text-muted">
                        <div class="float-start">
                            <p><?=date('Y');?> &copy; Bosami Batik v.3.0</p>
                        </div>
                        <div class="float-end">
                            <p>Developed By <span class="text-primary">Grafamedia</span></p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
<script src="<?=base_url();?>assets/js/bootstrap.js"></script>
<script src="<?=base_url();?>assets/js/app.js"></script>
<script src="<?=base_url();?>assets/js/pages/horizontal-layout.js"></script>
<script src="<?=base_url();?>assets/js/pages/dashboard.js"></script>
<script src="<?=base_url();?>assets/extensions/jquery/jquery.min.js"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
<script src="<?=base_url();?>assets/js/pages/datatables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.9/dist/autoComplete.min.js"></script>
<?php if($scriptForm=="produksi2"){ ?>
    <script>
        function loadDataJahitan(){
            $('#tableBody').html('Loading...');
            $.ajax({
                url:"<?=base_url('transaksi2/loadProsesJahit');?>",
                type: "POST",
                data: {},
                cache: false,
                success: function(dataResult){
                    if ($.fn.DataTable.isDataTable('#table1')) {
                        $('#table1').DataTable().destroy();
                    }
                    $('#tableBody').html(dataResult);
                    $('#table1').DataTable();
                }
            });
        }
        loadDataJahitan();
        const autoCompleteJS = new autoComplete({
            placeHolder: "Ketik Kode Babar",
            data: {
                src: [<?=$dataAuto;?>],
                cache: true,
            },
            resultItem: {
                highlight: true
            },
            events: {
                input: {
                    selection: (event) => {
                        const selection = event.detail.selection.value;
                        autoCompleteJS.input.value = selection;
                        $('#jmlStokPotongan').html('Loading...');
                        $.ajax({
                            url:"<?=base_url('transaksi2/lihatstokbabar');?>",
                            type: "POST",
                            data: {"selection":selection},
                            cache: false,
                            success: function(dataResult){
                                var dataResult = JSON.parse(dataResult);
                                if(dataResult.statusCode==200){
                                    $('#jmlStokPotongan').html('Jumlah Stok : <font style="color:green;font-weight:bold;">'+dataResult.stok+'</font><br>Kode Kain : <font style="color:green;font-weight:bold;">'+dataResult.kode_kain+'</font><br>Proses Babar : <font style="color:green;font-weight:bold;">'+dataResult.proses_babar+'</font>');
                                    $('#codeProduksiBabar').val(''+dataResult.codeproduksi);
                                    $('#jmlStokAwal').val(''+dataResult.stok);
                                    $('#prosesBabarSblm').val(''+dataResult.proses_babar);
                                    $('#kodeKainSblm').val(''+dataResult.kode_kain);
                                    $('#hpp1').val(''+dataResult.hpp1);
                                    $('#hpp2').val(''+dataResult.hpp2);
                                } else {
                                    $('#jmlStokPotongan').html('<font style="color:red;">'+dataResult.message+'</font>');
                                }
                            }
                        });
                    }
                }
            }
        });
        $('#penjahitslct').change(function () {
            let kode_penjahit = $(this).val();
            $('#penjahitmdl').html('<option value="">-- Pilih Model Jahitan --</option>');

                if (kode_penjahit !== "") {
                    $('#penjahitmdl').html('<option value="">Loading..</option>');
                    $.ajax({
                        url: '<?= base_url("transaksi2/get_harga") ?>',
                        type: 'POST',
                        data: { kode_penjahit: kode_penjahit },
                        dataType: 'json',
                        success: function (data) {
                            $('#penjahitmdl').html('<option value="">-- Pilih Model Jahitan --</option>');
                            $.each(data, function (key, value) {
                                $('#penjahitmdl').append('<option value="' + value.id_msj + '">' + value.jenis_jahitan + ' - ' + value.model_jahitan + '</option>');
                            });
                        }
                    });
                }
        });
        $('#produkJadi').change(function () {
            let kodeProduk = $(this).val();
            $('#produkJadi2').html('<option value="">-- Pilih Model Produk --</option>');

                if (kodeProduk !== "") {
                    $('#produkJadi2').html('<option value="">Loading..</option>');
                    $.ajax({
                        url: '<?= base_url("transaksi3/get_model_produk") ?>',
                        type: 'POST',
                        data: { "kodeProduk": kodeProduk },
                        dataType: 'json',
                        success: function (data) {
                            $('#produkJadi2').html('<option value="">-- Pilih Model Produk --</option>');
                            $.each(data, function (key, value) {
                                $('#produkJadi2').append('<option value="' + value.kode_varians + '">' + value.models + '</option>');
                            });
                        }
                    });
                }
        });
       
        $('#statusJahit').change(function () {
            let thisStatus = $(this).val();
            if(thisStatus=="Finish"){
                $('#produkJadi2').removeAttr('disabled');
                $('#produkJadi3').removeAttr('disabled');
                $('#produkJadi').removeAttr('disabled');
            } else {
                $('#produkJadi2').val('');
                $('#produkJadi3').val('');
                $('#produkJadi').val('');
                $('#produkJadi2').attr('disabled', true);
                $('#produkJadi3').attr('disabled', true);
                $('#produkJadi').attr('disabled', true);
            }
            
        });
        $('#penjahitmdl').change(function () {
            let idmsj = $(this).val();
            $('#hargpcs').val('0');
                if (idmsj !== "") {
                    $('#hargpcs').val('0');
                    console.log(''+idmsj);
                    $.ajax({
                        url: '<?= base_url("transaksi2/get_harga2") ?>',
                        type: 'POST',
                        data: { "idmsj": idmsj },
                        cache: false,
                        success: function (dataResult) {
                            var dataResult = JSON.parse(dataResult);
                            if(dataResult.statusCode==200){
                                var totalHarga = dataResult.harga;
                                console.log(''+totalHarga);
                                document.getElementById('hargpcs').value = new Intl.NumberFormat('id-ID').format(totalHarga);
                                hitung();
                            }
                        }
                    });
                }
        });
        function cekHasilSimpan(params) {
            $('#tableReturOnModal').html('<div style="width:100%;display:flex;justify-content:center;"><div class="loader"></div></div>');
            $.ajax({
                url: '<?= base_url("transaksi3/showFinishProduk") ?>',
                type: 'POST',
                data: { "params": params },
                cache: false,
                success: function (dataResult) {
                    setTimeout(() => {
                        $('#tableReturOnModal').html(dataResult);
                        $('#simpanKembali23').show();
                        $('#loadersId2').hide();
                    }, 300);
                }
            });
        }
        $('#simpanKembali23').click(function () {
            var codeProduksiJahit    = $('#codeProduksiRow23').val();
            var codeJahitRow         = $('#codeJahitRow').val();
            var tglMasuk             = $('#tglMasukSelesai').val();
            var jmlKembali           = $('#jmlKembali').val();
            var statusJahit          = $('#statusJahit').val();
            var kodeProduk           = $('#produkJadi').val();
            var kodeVarians          = $('#produkJadi2').val();
            var ukuranProduk         = $('#produkJadi3').val();
            if(codeProduksiJahit!="" && codeJahitRow!="" && tglMasuk!="" && jmlKembali!="" && statusJahit!=""){
                if(statusJahit!="Finish"){
                    var kodeProduk   = "null";
                    var kodeVarians  = "null";
                    var ukuranProduk = "null";
                }
                $('#simpanKembali23').hide();
                $('#loadersId2').show();
                $.ajax({
                    url: '<?= base_url("transaksi3/saveFinishProduk") ?>',
                    type: 'POST',
                    data: { "codeProduksiJahit": codeProduksiJahit, "codeJahitRow": codeJahitRow, "tglMasuk": tglMasuk, "jmlKembali": jmlKembali, "statusJahit": statusJahit, "kodeProduk": kodeProduk, "kodeVarians": kodeVarians, "ukuranProduk": ukuranProduk },
                    cache: false,
                    success: function (dataResult) {
                        var dataResult = JSON.parse(dataResult);
                        if(dataResult.statusCode==200){
                            Swal.fire({icon: 'success',title: 'Berhasil..', text: dataResult.message, });
                            loadDataJahitan();
                            cekHasilSimpan(codeProduksiJahit);
                        } else {
                            Swal.fire({icon: 'error',title: 'Erorr..', text: dataResult.message, });
                            $('#simpanKembali23').show();
                            $('#loadersId2').hide();
                        }
                    }
                });
            } else {

            }
            
        });
        $('#simpanButtons').click(function () {
            var jmlStokAwal         = $('#jmlStokAwal').val();
            var codeProduksiBabar   = $('#codeProduksiBabar').val();
            var prosesBabarSblm     = $('#prosesBabarSblm').val();
            var kodeKainSblm        = $('#kodeKainSblm').val();
            var kodeBabar           = $('#autoComplete').val();
            var jmlKirim            = $('#jmlKirim').val();
            var hpp1                = $('#hpp1').val();
            var hpp2                = $('#hpp2').val();
            if(parseInt(jmlKirim) > 0 && parseInt(jmlKirim) <= parseInt(jmlStokAwal)){
                var tglKirim            = $('#tglKirim').val();
                var penjahit            = $('#penjahitslct').val();
                var penjahitmdl         = $('#penjahitmdl').val();
                var hargpcs             = $('#hargpcs').val();
                var hargttl             = $('#hargttl').val();
                if(jmlStokAwal!="" && codeProduksiBabar!="" && prosesBabarSblm!="" && kodeKainSblm!="" && kodeBabar!="" && jmlKirim!="" && hpp1!="" && hpp2!="" && tglKirim!="" && penjahit!="" && penjahitmdl!="" && hargpcs!="" && hargttl!=""){
                    $('#simpanButtons').hide();
                    $('#loadersId').show();
                    $.ajax({
                        url:"<?=base_url('transaksi2/simpanProsesJahit');?>",
                        type: "POST",
                        data: {"jmlStokAwal":jmlStokAwal, "codeProduksiBabar":codeProduksiBabar, "prosesBabarSblm":prosesBabarSblm, "kodeKainSblm":kodeKainSblm, "kodeBabar":kodeBabar, "jmlKirim":jmlKirim, "hpp1":hpp1, "hpp2":hpp2, "tglKirim":tglKirim, "penjahit":penjahit, "penjahitmdl":penjahitmdl, "hargpcs":hargpcs, "hargttl":hargttl},
                        cache: false,
                        success: function(dataResult){
                            var dataResult = JSON.parse(dataResult);
                            if(dataResult.statusCode==200){
                                Swal.fire({icon: 'success',title: 'Berhasil', text: dataResult.message, });
                                $('#simpanButtons').show();
                                $('#loadersId').hide();
                                loadDataJahitan();
                                $('#large').modal('hide');
                            } else {
                                Swal.fire({icon: 'error',title: 'Erorr..', text: dataResult.message, });
                                $('#simpanButtons').show();
                                $('#loadersId').hide();
                            }
                        }
                    });
                } else {
                    Swal.fire({icon: 'error',title: 'Erorr..', text: 'Data belum lengkap', });
                }
            } else {
                Swal.fire({icon: 'error',title: 'Erorr..', text: 'Jumlah kirim minimal 1 dan maksimal '+jmlStokAwal+'', });
            }
        });
        function hitung(){
            var jml = $('#jmlKirim').val();
            if(parseInt(jml) > 0){
                var hargapcs = cleanNumber(document.getElementById('hargpcs').value);
                var hargttl = cleanNumber(document.getElementById('hargttl').value);
                var totalHarga = hargapcs * parseInt(jml);
                var totalPeces = hargttl / parseInt(jml);
                document.getElementById('hargttl').value = new Intl.NumberFormat('id-ID').format(totalHarga);
                
            } 
        }
        function hitung2(){
            var jml = $('#jmlKirim').val();
            if(parseInt(jml) > 0){
                var hargapcs = cleanNumber(document.getElementById('hargpcs').value);
                var hargttl = cleanNumber(document.getElementById('hargttl').value);
                var totalHarga = hargapcs * parseInt(jml);
                var totalPeces = hargttl / parseInt(jml);
                document.getElementById('hargpcs').value = new Intl.NumberFormat('id-ID').format(totalPeces);
                
            } 
        }
        function showBabarPlusJahit(id, cdjahit){
            $('#modalsBody23').html('<div style="width:100%;height:100px;display:flex;justify-content:center;align-items:center;flex-direction:column;gap:10px;"><img src="<?=base_url();?>assets/images/svg-loaders/rings.svg" alt="loading"><span>Please Wait...</span></div>');
            $('#large23').modal('show');
            $.ajax({
                url:"<?=base_url('transaksi3/showBabarPlusJahit');?>",
                type: "POST",
                data: {"id":id, "cdjahit":cdjahit},
                cache: false,
                success: function(dataResult){
                    setTimeout(() => {
                        $('#modalsBody23').html(''+dataResult);
                    }, 900);
                }
            });
        }
        function selesaiJahit(cd,cdjht){
            cekHasilSimpan(cd);
            $('#codeProduksiRow23').val(''+cd);
            $('#tableReturOnModal').html('');
            $('#codeJahitRow').val(''+cdjht);
            $('#large2312').modal('show');
        }
        function hapusThis(cd,kd){
            //console.log(cd);
            Swal.fire({
                title: 'Hapus Produksi ?',
                text: "Produksi Jahit "+kd+" Akan Di Hapus",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Tidak',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url:"<?=base_url('transaksi3/hapusProduksiJahit');?>",
                        type: "POST",
                        data: {"cd":cd},
                        cache: false,
                        success: function(dataResult){
                            var dataResult = JSON.parse(dataResult);
                            if(dataResult.statusCode==200){
                                Swal.fire({icon: 'success', title: 'Berhasil',
                                    text: dataResult.message,
                                }).then(function() {
                                    loadDataJahitan();
                                });                            
                            } else {
                                Swal.fire({icon: 'error', title: 'Gagal',
                                    text: dataResult.message,
                                });
                            }
                        }
                    }); 
                }
            })
        }
        function hapusReturn2(id,jml,cd){
            Swal.fire({
                title: 'Hapus Return ?',
                text: "Menghapus "+jml+" data return",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Tidak',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url:"<?=base_url('transaksi2/hapusReturnJahit');?>",
                        type: "POST",
                        data: {"id":id},
                        cache: false,
                        success: function(dataResult){
                            var dataResult = JSON.parse(dataResult);
                            if(dataResult.statusCode==200){
                                Swal.fire({icon: 'success', title: 'Berhasil',
                                    text: dataResult.message,
                                }).then(function() {
                                    cekHasilSimpan(cd);
                                    loadDataJahitan();
                                });                            
                            } else {
                                Swal.fire({icon: 'error', title: 'Gagal',
                                    text: dataResult.message,
                                });
                            }
                        }
                    }); 
                }
            })
        }
        function uploadFotoProduksi(id,kdbar){
            $('#large23').modal('hide');
            $('#cdbars').val(''+kdbar);
            $('#idbars').val(''+id);
            $('#largeUpload').modal('show');
        }
        document.addEventListener("DOMContentLoaded", function() {
            var fileInput = document.getElementById("file");
            
            function isMobileDevice() {
                return /Mobi|Android|iPhone|iPad|iPod/i.test(navigator.userAgent);
            }
            
            if (isMobileDevice()) {
                fileInput.setAttribute("capture", "environment"); // Membuka kamera belakang jika tersedia
            }

            fileInput.addEventListener("change", function() {
                var file = fileInput.files[0];
                if (file) {
                    var allowedExtensions = ["image/jpeg", "image/jpg", "image/png", "image/svg+xml"];
                    if (!allowedExtensions.includes(file.type)) {
                        Swal.fire("Format file tidak didukung! Hanya diperbolehkan jpg, jpeg, png, svg.");
                        fileInput.value = "";
                    }
                }
            });
        });
        function hpsFotoProduksi(idProduksi){
            //console.log(cd);
            Swal.fire({
                title: 'Hapus Foto Produksi?',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Tidak',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url:"<?=base_url('transaksi2/hpsFotoProduksi2');?>",
                        type: "POST",
                        data: {"idProduksi":idProduksi},
                        cache: false,
                        success: function(dataResult){
                            location.reload();
                        }
                    }); 
                }
            })
        }
    </script>
<?php } if($scriptForm=="produksi1"){ ?>
    <script>
        const autoCompleteJS = new autoComplete({
            placeHolder: "Ketik Kode Kain",
            data: {
                src: [<?=$dataAuto;?>],
                cache: true,
            },
            resultItem: {
                highlight: true
            },
            events: {
                input: {
                    selection: (event) => {
                        const selection = event.detail.selection.value;
                        autoCompleteJS.input.value = selection;
                        $('#jmlStokPotongan').html('Loading...');
                        $.ajax({
                            url:"<?=base_url('transaksi2/lihatstokptg');?>",
                            type: "POST",
                            data: {"selection":selection},
                            cache: false,
                            success: function(dataResult){
                                var dataResult = JSON.parse(dataResult);
                                if(dataResult.statusCode==200){
                                    $('#jmlStokPotongan').html('Jumlah Stok : <font style="color:green;font-weight:bold;">'+dataResult.stok+'</font>');
                                    $('#stokkainid').val(''+dataResult.id);
                                    $('#stokkainjml').val(''+dataResult.stok);
                                } else {
                                    $('#jmlStokPotongan').html('<font style="color:red;">'+dataResult.message+'</font>');
                                }
                            }
                        });
                    }
                }
            }
        });
        function loadKirimBabar(){
            $('#tableBody').html('Loading...');
            $.ajax({
                url:"<?=base_url('transaksi2/loadProsesBabar');?>",
                type: "POST",
                data: {},
                cache: false,
                success: function(dataResult){
                    if ($.fn.DataTable.isDataTable('#table1')) {
                        $('#table1').DataTable().destroy();
                    }
                    $('#tableBody').html(dataResult);
                    $('#table1').DataTable();
                }
            });
        }
        loadKirimBabar();
        function hitung(){
            var jml = $('#jmlKirim').val();
            if(parseInt(jml) > 0){
                var hargapcs = cleanNumber(document.getElementById('hargpcs').value);
                var hargttl = cleanNumber(document.getElementById('hargttl').value);
                var totalHarga = hargapcs * parseInt(jml);
                var totalPeces = hargttl / parseInt(jml);
                document.getElementById('hargttl').value = new Intl.NumberFormat('id-ID').format(totalHarga);
                
            } 
        }
        function hitung2(){
            var jml = $('#jmlKirim').val();
            if(parseInt(jml) > 0){
                var hargapcs = cleanNumber(document.getElementById('hargpcs').value);
                var hargttl = cleanNumber(document.getElementById('hargttl').value);
                var totalHarga = hargapcs * parseInt(jml);
                var totalPeces = hargttl / parseInt(jml);
                document.getElementById('hargpcs').value = new Intl.NumberFormat('id-ID').format(totalPeces);
                
            } 
        }
        function showBabar(id){
            $('#modalsBody23').html('<div style="width:100%;height:100px;display:flex;justify-content:center;align-items:center;flex-direction:column;gap:10px;"><img src="<?=base_url();?>assets/images/svg-loaders/rings.svg" alt="loading"><span>Please Wait...</span></div>');
            $('#large23').modal('show');
            $.ajax({
                url:"<?=base_url('transaksi2/detilProsesBabar');?>",
                type: "POST",
                data: {"id":id},
                cache: false,
                success: function(dataResult){
                    setTimeout(() => {
                        $('#modalsBody23').html(''+dataResult);
                    }, 900);
                }
            });
        }
        function uploadFotoProduksi(id,kdbar){
            $('#large23').modal('hide');
            $('#cdbars').val(''+kdbar);
            $('#idbars').val(''+id);
            $('#largeUpload').modal('show');
        }
        document.addEventListener("DOMContentLoaded", function() {
            var fileInput = document.getElementById("file");
            
            function isMobileDevice() {
                return /Mobi|Android|iPhone|iPad|iPod/i.test(navigator.userAgent);
            }
            
            if (isMobileDevice()) {
                fileInput.setAttribute("capture", "environment"); // Membuka kamera belakang jika tersedia
            }

            fileInput.addEventListener("change", function() {
                var file = fileInput.files[0];
                if (file) {
                    var allowedExtensions = ["image/jpeg", "image/jpg", "image/png", "image/svg+xml"];
                    if (!allowedExtensions.includes(file.type)) {
                        Swal.fire("Format file tidak didukung! Hanya diperbolehkan jpg, jpeg, png, svg.");
                        fileInput.value = "";
                    }
                }
            });
        });
        $("#simpanKembali").click(function() {
            var codeProduksi   = $('#codeProduksiRow').val();
            var codeBabarRow  = $('#codeBabarRow').val();
            var tglMasukSelesai  = $('#tglMasukSelesai').val();
            var jmlKemabali  = $('#jmlKemabali').val();
            var statusBabar  = $('#statusBabar').val();
            console.log(''+codeProduksi);
            if(codeProduksi!="" && codeBabarRow!="" && tglMasukSelesai!="" && jmlKemabali!="" && statusBabar!=""){
                if(parseInt(jmlKemabali) > 0){
                    $('#simpanKembali').hide();
                    $('#loadersId2').show();
                    $.ajax({
                        url:"<?=base_url('transaksi2/saveReturnBatik');?>",
                        type: "POST",
                        data: {"codeProduksi":codeProduksi,"codeBabarRow":codeBabarRow,"tglMasukSelesai":tglMasukSelesai,"jmlKemabali":jmlKemabali,"statusBabar":statusBabar},
                        cache: false,
                        success: function(dataResult){
                            var dataResult = JSON.parse(dataResult);
                            if(dataResult.statusCode==200){
                                $('#simpanKembali').show();
                                $('#loadersId2').hide();
                                $('#codeProduksiRow').val('');
                                $('#codeBabarRow').val('');
                                $('#tglMasukSelesai').val('');
                                $('#jmlKemabali').val('');
                                $('#pemstatusBabarbatik').val('');
                                loadKirimBabar();
                                Swal.fire({icon: 'success',title: 'Berhasil..', text: dataResult.message, }).then(function() {
                                    $('#large2312').modal('hide');
                                });
                            } else {
                                Swal.fire({icon: 'error',title: 'Erorr..', text: dataResult.message, });
                                $('#simpanKembali').show();
                                $('#loadersId2').hide();
                            }
                        }
                    });
                } else {
                    Swal.fire({icon: 'error',title: 'Erorr..', text: 'Masukan jumlah kembali..', });
                }
            } else {
                Swal.fire({icon: 'error',title: 'Erorr..', text: 'Anda harus mengisi data dengan benar.!!', });
            }
            
        });
        $("#simpanButtons").click(function() {
            var stokkainid   = $('#stokkainid').val();
            var stokkainjml  = $('#stokkainjml').val();
            var autoComplete = $('#autoComplete').val();
            var jmlKirim     = $('#jmlKirim').val();
            if(parseInt(jmlKirim) > 0 && parseInt(jmlKirim) <= parseInt(stokkainjml)){
                var pembatik = $('#pembatik').val();
                var tglKirim = $('#tglKirim').val();
                var jnsBabar = $('#jnsBabar').val();
                var hargpcs = cleanNumber(document.getElementById('hargpcs').value);
                var hargttl = cleanNumber(document.getElementById('hargttl').value);
                $('#simpanButtons').hide();
                $('#loadersId').show();
                if(autoComplete!="" && pembatik!="" && tglKirim!="" && jnsBabar!="" && hargpcs!="" && hargttl!=""){
                    $.ajax({
                        url:"<?=base_url('transaksi2/saveProsesBatik');?>",
                        type: "POST",
                        data: {"autoComplete":autoComplete,"stokkainid":stokkainid,"jmlKirim":jmlKirim,"pembatik":pembatik,"tglKirim":tglKirim,"jnsBabar":jnsBabar,"hargpcs":hargpcs,"hargttl":hargttl},
                        cache: false,
                        success: function(dataResult){
                            var dataResult = JSON.parse(dataResult);
                            if(dataResult.statusCode==200){
                                $('#simpanButtons').show();
                                $('#loadersId').hide();
                                $('#stokkainid').val('');
                                $('#stokkainjml').val('');
                                $('#autoComplete').val('');
                                $('#jmlKirim').val('');
                                $('#pembatik').val('');
                                $('#tglKirim').val('');
                                $('#jnsBabar').val('');
                                $('#hargpcs').val('');
                                $('#hargpcs').val('');
                                loadKirimBabar();
                                Swal.fire({icon: 'success',title: 'Berhasil..', text: dataResult.message, });
                            } else {
                                Swal.fire({icon: 'error',title: 'Erorr..', text: dataResult.message, });
                                $('#simpanButtons').show();
                                $('#loadersId').hide();
                            }
                        }
                    });
                } else {
                    Swal.fire({icon: 'error',title: 'Erorr..', text: 'Anda harus mengisi data dengan benar.!!', });
                    $('#simpanButtons').show();
                    $('#loadersId').hide();
                }
            } else {
                var txy = "Jumlah kirim minimal 1 dan maksimal "+stokkainjml;
                Swal.fire({icon: 'error',title: 'Erorr..', text: txy, });
            }
            
            
        });
        function hapusReturn(id,jml){
            Swal.fire({
                title: 'Hapus Return ?',
                text: "Menghapus "+jml+" data return",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Tidak',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url:"<?=base_url('transaksi2/hapusReturnBabar');?>",
                        type: "POST",
                        data: {"id":id},
                        cache: false,
                        success: function(dataResult){
                            var dataResult = JSON.parse(dataResult);
                            if(dataResult.statusCode==200){
                                Swal.fire({icon: 'success', title: 'Berhasil',
                                    text: dataResult.message,
                                }).then(function() {
                                    location.reload();
                                });                            
                            } else {
                                Swal.fire({icon: 'error', title: 'Gagal',
                                    text: dataResult.message,
                                });
                            }
                        }
                    }); 
                }
            })
        }
        function hapusThis(cd,kd){
            //console.log(cd);
            Swal.fire({
                title: 'Hapus Produksi?',
                text: "Menghapus Keseluruhan Proses "+kd+"",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Tidak',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url:"<?=base_url('transaksi2/hapusProduksiBabar');?>",
                        type: "POST",
                        data: {"cd":cd},
                        cache: false,
                        success: function(dataResult){
                            var dataResult = JSON.parse(dataResult);
                            if(dataResult.statusCode==200){
                                Swal.fire({icon: 'success', title: 'Berhasil',
                                    text: dataResult.message,
                                }).then(function() {
                                    location.reload();
                                });                            
                            } else {
                                Swal.fire({icon: 'error', title: 'Gagal',
                                    text: dataResult.message,
                                });
                            }
                        }
                    }); 
                }
            })
        }
        function updateThis(cd,kd){
            $('#large23').modal('hide');
            $('#largeUpdateJasa').modal('show');
            $('#cdbarse34').val(''+kd);
        }
        function hpsFotoProduksi(idProduksi){
            //console.log(cd);
            Swal.fire({
                title: 'Hapus Foto Produksi?',
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Tidak',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url:"<?=base_url('transaksi2/hpsFotoProduksi');?>",
                        type: "POST",
                        data: {"idProduksi":idProduksi},
                        cache: false,
                        success: function(dataResult){
                            location.reload();
                        }
                    }); 
                }
            })
        }
        function showBabarFns(id,kd){
            $('#codeProduksiRow').val(''+id);
            $('#codeBabarRow').val(''+kd);
            $('#large2312').modal('show');
        }
    </script>
<?php } ?>
<script>
function formatRibuan(input) {
    let angka = input.value.replace(/[^0-9]/g, '');
    let formatted = new Intl.NumberFormat('id-ID').format(angka);
    input.value = formatted;
}
function formatRibuan2(input) {
    let value = input.value;
    value = value.replace(/[^0-9.]/g, '');
    let parts = value.split('.');
    if (parts.length > 2) {
        value = parts[0] + '.' + parts.slice(1).join('');
    }
    if (parts.length === 2) {
        parts[1] = parts[1].substring(0, 2); 
        value = parts.join('.');
    }
    let integerPart = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    input.value = parts.length === 2 ? `${integerPart}.${parts[1]}` : integerPart;
}
        function cleanNumber(value, allowDecimal = false) {
            if (allowDecimal) {
                return parseFloat(value.replace(/[^0-9.]/g, '') || 0).toFixed(2); // Menghapus karakter lain kecuali angka dan titik
            } else {
                return parseInt(value.replace(/\./g, '') || 0); // Hapus titik untuk angka bulat
            }
        }
        function hitungTotal() {
            let jumlahYard = parseFloat(cleanNumber(document.getElementById('jmlyard').value, true));
            let hargaPerYard = cleanNumber(document.getElementById('hargayard').value);
            let totalHarga = cleanNumber(document.getElementById('totalhargayard').value);

            if (event.target.id === 'jmlyard' || event.target.id === 'hargayard') {
                totalHarga = jumlahYard * hargaPerYard;
                document.getElementById('totalhargayard').value = new Intl.NumberFormat('id-ID').format(totalHarga);
            } else if (event.target.id === 'totalhargayard' && jumlahYard > 0) {
                hargaPerYard = totalHarga / jumlahYard;
                document.getElementById('hargayard').value = new Intl.NumberFormat('id-ID').format(hargaPerYard);
            }
        }
</script>
</body>

</html>