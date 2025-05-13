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
<?php if($scriptForm2=="ori"){?>
<input type="hidden" id="scriptform2" value="ori">
<?php } else { ?>
<input type="hidden" id="scriptform2" value="bs">
<?php } ?>
<script src="<?=base_url();?>assets/js/bootstrap.js"></script>
<script src="<?=base_url();?>assets/js/app.js"></script>
<script src="<?=base_url();?>assets/js/pages/horizontal-layout.js"></script>
<script src="<?=base_url();?>assets/js/pages/dashboard.js"></script>
<script src="<?=base_url();?>assets/extensions/jquery/jquery.min.js"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
<script src="<?=base_url();?>assets/js/pages/datatables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.9/dist/autoComplete.min.js"></script>
<?php if($scriptForm=="penjualan"){ ?>
    <script>
        var sc = $('#scriptform2').val();
        function loadDataPenjualan(){
            $('#tableBody').html('Loading...');
            $.ajax({
                url:"<?=base_url('mutasi/datapenjualan');?>",
                type: "POST",
                data: {"sc":sc},
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
        loadDataPenjualan();
        const autoCompleteJS = new autoComplete({
            placeHolder: "Ketikan & Pilih Produk",
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
                        $('#modelProduk').html('<option value="">-- Loading... --</option>');
                        $('#modelProduk').attr('disabled', true);
                            $.ajax({
                                url: '<?= base_url("mutasi/get_model_produk") ?>',
                                type: 'POST',
                                data: { selection: selection },
                                dataType: 'json',
                                success: function (data) {
                                    console.log(''+data);
                                    $('#modelProduk').html('<option value="">-- Pilih Model Produk --</option>');
                                    $('#modelProduk').removeAttr('disabled');
                                    $.each(data, function (key, value) {
                                        $('#modelProduk').append('<option value="' + value.kode_varians + '">' + value.models + '</option>');
                                    });
                                }
                            });
                        
                    }
                }
            }
        });
        $('#modelProduk').change(function () {
            let kodeProduk = $(this).val();
                if (kodeProduk !== "") {
                    $('#ukrproduk').removeAttr('disabled');
                } else {
                    $('#ukrproduk').attr('disabled', true);
                }
        });
        $('#kirimKe').change(function () {
            let tx = $(this).val();
                if (tx !== "") {
                    $('#namaCus').removeAttr('disabled');
                    $('#thisNama').html('Nama '+tx);
                    $('#namaCus').attr('placeholder', 'Masukan Nama ' + tx);
                } else {
                    $('#namaCus').val('');
                    $('#thisNama').html('Nama ');
                    $('#namaCus').attr('disabled', true);
                }
        });
        
        $('#simpanButtons').click(function () {
            $('#simpanButtons').hide();
            $('#loadersId').show();
            var codejual            = $('#codejual').val();
            var tglJual             = $('#tglPenjualan').val();
            var kirimKe             = $('#kirimKe').val();
            var namaCus             = $('#namaCus').val();
            var platformPenjualan   = $('#platformPenjualan').val();

            var codeProduk          = $('#autoComplete').val();
            var modelProduk         = $('#modelProduk').val();
            var ukrproduk           = $('#ukrproduk').val();
            var jmlPenjualan        = $('#jmlPenjualan').val();
            var sc                  = $('#scriptform2').val();
            if(codejual!="" && tglJual!="" && kirimKe!="" && namaCus!="" && platformPenjualan!=""){
                $.ajax({
                    url: '<?= base_url("mutasi/simpanPenjualan") ?>',
                    type: 'POST',
                    data: { "codejual":codejual,"tglJual":tglJual,"kirimKe":kirimKe,"namaCus":namaCus,"platformPenjualan":platformPenjualan,"codeProduk":codeProduk,"modelProduk":modelProduk,"ukrproduk":ukrproduk,"jmlPenjualan":jmlPenjualan,"sc":sc },
                    cache: false,
                    success: function (dataResult) {
                        var dataResult = JSON.parse(dataResult);
                        if(dataResult.statusCode==200){
                            Swal.fire({icon: 'success',title: 'Berhasil Menyimpan..',text: dataResult.message,});
                            $('#simpanButtons').show();
                            $('#loadersId').hide();
                            $('#autoComplete').val('');
                            $('#modelProduk').val('');
                            $('#ukrproduk').val('');
                            $('#jmlPenjualan').val('');
                            loadDetilPenjualan(codejual);
                            loadDataPenjualan();
                        } else {
                            Swal.fire({icon: 'error',title: 'Gagal Menyimpan..',text: dataResult.message,});
                            $('#simpanButtons').show();
                            $('#loadersId').hide();
                        }
                    }
                });
            } else {
                Swal.fire({icon: 'error',title: 'Gagal Menyimpan..',text: 'Anda harus mengisi semua data.!',});
                $('#simpanButtons').show();
                $('#loadersId').hide();
            }

        });
        $('#inputJual').click(function () {
            $.ajax({
                url: '<?= base_url("mutasi/newCodeJual") ?>',
                type: 'POST',
                data: { "codejual": "new" },
                cache: false,
                success: function (dataResult) {
                    var dataResult = JSON.parse(dataResult);
                    if(dataResult.statusCode==200){
                        $('#codejual').val(''+dataResult.message);
                    } 
                }
            });
            $('#tglPenjualan').val('');
            $('#kirimKe').val('');
            $('#namaCus').val('');
            $('#platformPenjualan').val('');
            $('#namaCus').attr('disabled', true);
        });
        function showPenjualan(codejual){
            $.ajax({
                url: '<?= base_url("mutasi/loadPenjualan") ?>',
                type: 'POST',
                data: { "codejual": codejual },
                cache: false,
                success: function (dataResult) {
                    var dataResult = JSON.parse(dataResult);
                    if(dataResult.statusCode==200){
                        $('#codejual').val(''+codejual);
                        $('#tglPenjualan').val(''+dataResult.tgl_jual);
                        $('#kirimKe').val(''+dataResult.tujuan_kirim);
                        $('#namaCus').val(''+dataResult.nama_customer);
                        $('#platformPenjualan').val(''+dataResult.platfom);
                        $('#namaCus').removeAttr('disabled');
                        $('#large').modal('show');
                        loadDetilPenjualan(codejual);
                    } else {
                        Swal.fire({icon: 'error',title: 'Error.!',text: dataResult.message,});
                    }
                }
            });
        }
        function loadDetilPenjualan(codejual){
            $.ajax({
                url: '<?= base_url("mutasi/get_detil_jual") ?>',
                type: 'POST',
                data: { "codejual": codejual },
                cache: false,
                success: function (dataResult) {
                    $('#tablePenjualan').html(dataResult);
                    console.log('Telah di load Detil');
                }
            });
        }
        function lihatStokProduk(){
            let namaProduk = $('#autoComplete').val();
            let modelProduk = $('#modelProduk').val();
            let ukrproduk = $('#ukrproduk').val();
            let sc = $('#scriptform2').val();
            if(namaProduk!="" && modelProduk!="" && ukrproduk!=""){
                $.ajax({
                    url: '<?= base_url("mutasi/get_stok") ?>',
                    type: 'POST',
                    data: { "modelProduk": modelProduk, "ukrproduk": ukrproduk, "sc": sc },
                    cache: false,
                    success: function (dataResult) {
                        var dataResult = JSON.parse(dataResult);
                        if(dataResult.statusCode==200){
                            $('#stokTersedia').val(''+dataResult.message);
                        } else {
                            Swal.fire('Stok Tidak Tersedia');
                            $('#stokTersedia').val('');
                        }
                    }
                });
            } else {
                $('#stokTersedia').val('0');
            }
        }
        $('#file').change(function() {
            var file = this.files[0]; 
            var allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/svg+xml'];
            var maxSize = 2 * 1024 * 1024; // 2MB

            if (file) {
                var fileType = file.type;
                var fileSize = file.size;

                // Cek format file
                if (!allowedTypes.includes(fileType)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Format Tidak Diperbolehkan!',
                        text: 'Hanya file dengan format JPG, JPEG, PNG, dan SVG yang diperbolehkan.',
                    });
                    $('#file').val(''); // Kosongkan input
                    return;
                }

                // Cek ukuran file
                if (fileSize > maxSize) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Ukuran File Terlalu Besar!',
                        text: 'Ukuran file maksimal 2MB.',
                    });
                    $('#file').val(''); // Kosongkan input
                    return;
                }
            }
        });
        function hapusPenjualan(codejual,type,id){
            Swal.fire({
                title: 'Hapus Penjualan?',
                text: 'Apakah anda yakin ingin menghapus penjualan ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url("mutasi/delete_penjualan") ?>',
                        type: 'POST',
                        data: { "codejual": codejual, "type": type, "id": id },
                        cache: false,
                        success: function (dataResult) {
                            Swal.fire({icon: 'success',title: 'Berhasil Menghapus..',text: 'Penjualan berhasil dihapus.',}).then(function() {
                                if(type=="utama"){
                                    location.reload();
                                } else {
                                    loadDetilPenjualan(codejual);
                                }
                            });
                        }
                    });
                }
            });
        }
        function inputPembayaran(codejual,cus,tgl){
            $('#showBuktiBayar').html('');
            $.ajax({
                url: '<?= base_url("mutasi/showPembayaran") ?>',
                type: 'POST',
                data: { "codejual": codejual},
                cache: false,
                success: function (dataResult) {
                    var dataResult = JSON.parse(dataResult);
                    if(dataResult.statusCode==200){
                        $('#nominalid').val(''+dataResult.ongkir);
                        if(dataResult.tipe_bayar=="null"){
                            $('#pembid').val('');
                        } else {
                            $('#pembid').val(''+dataResult.tipe_bayar);
                        }
                        if(dataResult.bukti_bayar!="null"){
                            $('#showBuktiBayar').html('<img src="<?=base_url('uploads/buktibayar/');?>'+dataResult.bukti_bayar+'?t='+new Date().getTime()+'" alt="Bukti Bayar" style="width: 100%; margin-top: 10px;">');
                        }
                    }
                }
            });
            $('#large').modal('hide');
            $('#codejual2').val(''+codejual);
            $('#tglid').val(''+tgl);
            $('#cusid').val(''+cus);
            $.ajax({
                url: '<?= base_url("mutasi/showPembayaranTable") ?>',
                type: 'POST',
                data: { "codejual": codejual},
                cache: false,
                success: function (dataResult) {
                    //console.log(dataResult);
                    $('#tableHargaJual').html(''+dataResult);
                    $('#large2').modal('show');
                }
            });
        }
        document.addEventListener("input", function (event) {
            if (event.target.classList.contains("hrgJual")) {
                let row = event.target.closest("tr"); // Sesuaikan jika bukan dalam <tr>
                let qty = parseInt(row.querySelector(".qty").value) || 0;
                let hargaJual = event.target.value.replace(/\./g, ""); // Hapus titik sebelum konversi
                let hargaJualInt = parseInt(hargaJual) || 0;
                let total = hargaJualInt * qty;
                
                // Format angka dengan titik sebagai pemisah ribuan
                event.target.value = hargaJualInt.toLocaleString("id-ID");
                row.querySelector(".hrgTotal").value = total.toLocaleString("id-ID");
                hitungTotalKeseluruhan();
            }
        });
        

        // Fungsi untuk menghitung total keseluruhan dari semua .hrgTotal
        function hitungTotalKeseluruhan() {
            let totalKeseluruhan = 0;

            document.querySelectorAll(".hrgTotal").forEach(input => {
                let nilai = input.value.replace(/\./g, ""); // Hapus titik sebelum konversi
                totalKeseluruhan += parseInt(nilai) || 0;
            });

            // Tampilkan total keseluruhan di elemen dengan ID "totalSemua"
            document.getElementById("tdTotal").innerHTML = 'Rp. '+totalKeseluruhan.toLocaleString("id-ID");
        }
        function cekStatus(txt){
            $('#modalsBody123').html('<div style="width:100%;height:100px;display:flex;justify-content:center;align-items:center;"><div class="loader"></div></div>');
            $.ajax({
                url: '<?= base_url("mutasi/showPembayaranKonsumen") ?>',
                type: 'POST',
                data: { "txt": txt},
                cache: false,
                success: function (dataResult) {
                    setTimeout(() => {
                        $('#modalsBody123').html(dataResult);
                    }, 800);
                    
                }
            });
            
            $('#large22').modal('show');
        }
        function showPems(){
            $('#idPembay').show();
        }
        function thisSimpan(cd){
            var tgl = $('#thTgl').val();
            var nom = $('#thNomni').val();
            if(tgl!="" && parseInt(nom) > 1){
                $.ajax({
                    url: '<?= base_url("mutasi/inputbyr") ?>',
                    type: 'POST',
                    data: { "tgl": tgl, "nom": nom, "cd": cd},
                    cache: false,
                    success: function (dataResult) {
                        var dataResult = JSON.parse(dataResult);
                        if(dataResult.statusCode==200){
                            Swal.fire({icon: 'success',title: 'Success',text: dataResult.message,});
                            cekStatus(cd); loadDataPenjualan();
                        } else {
                            Swal.fire({icon: 'error',title: 'Error',text: dataResult.message,});
                        }
                    }
                });
            } else {
                Swal.fire('Mohon di isi dengan benar.!');
            }
        }
        function thisHapus(id,cd){
            Swal.fire({
                title: 'Hapus Pembayaran?',
                text: 'Apakah anda yakin ingin menghapus pembayaran ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url("mutasi/hpsbyr") ?>',
                        type: 'POST',
                        data: { "id": id, "cd": cd },
                        cache: false,
                        success: function (dataResult) {
                            cekStatus(cd); loadDataPenjualan();
                        }
                    });
                }
            });
        }
        function jadikanLunas(cd){
            Swal.fire({
                title: 'Jadikan Lunas?',
                text: 'Akan menghapus semua pembayaran dan mengganti dengan jumlah yang sesuai tagihan',
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Lunas',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url("mutasi/lunaskan") ?>',
                        type: 'POST',
                        data: { "cd": cd },
                        cache: false,
                        success: function (dataResult) {
                            cekStatus(cd); loadDataPenjualan();
                        }
                    });
                }
            });
        }
        function jadikanTerkirim(cd){
            Swal.fire({
                title: 'Paket Terkirim ?',
                text: 'Mengubah status paket telah dikirim ke konsumen.',
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url("mutasi/terkirim") ?>',
                        type: 'POST',
                        data: { "cd": cd },
                        cache: false,
                        success: function (dataResult) {
                            cekStatus(cd); loadDataPenjualan();
                        }
                    });
                }
            });
        }
        function copyThis(url) {
            navigator.clipboard.writeText(url)
            .then(() => {
                Swal.fire({icon: 'success',title: 'Success',text: 'URL Invoice berhasil disalin ke clipboard',});
            })
            .catch(err => {
                console.error('Gagal menyalin teks:', err);
            });
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