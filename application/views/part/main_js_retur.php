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
<?php if($scriptForm=="retur"){ ?>
    <script>
        function loadData(){
            var urlAktif = ''+window.location.href;
            console.log('Aktif : '+urlAktif);
            $('#tableBody').html('Loading...');
            $.ajax({
                url:"<?=base_url('mutasi2/dataRetur');?>",
                type: "POST",
                data: {"urlAktif": urlAktif},
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
        loadData();
        $('#simpanButtons').click(function() {
            var codeJual = document.getElementById('tipeInvSimpan').value;
            if(codeJual == "0"){
                Swal.fire({ icon: 'error', title: 'Error', text: 'Nomor invoice belum valid.', });
            } else {
                var jmlRetur = document.getElementById('totalReturs').value;
                var jmlKirim = document.getElementById('jmlTotalKirim').value;
                if(parseInt(jmlRetur) > 0 && parseInt(jmlRetur) <= parseInt(jmlKirim)){
                    const jmlTerjualAr  = Array.from(document.getElementsByName('jmlTerjual[]')).map(el => el.value);
                    const jmlReturAr    = Array.from(document.getElementsByName('jmlretur[]')).map(el => el.value);
                    const idpjdtAr      = Array.from(document.getElementsByName('idpjdt[]')).map(el => el.value);
                    var tglRetur        = document.getElementById('tglRetur').value;
                    var alasanRetur     = document.getElementById('alasanRetur').value;
                    var produkRetur     = document.getElementById('produkRetur').value;
                    var autoGanti       = document.getElementById('autoGanti').value;
                    var nomorInvoice    = document.getElementById('nomorInvoice').value;
                    var codeJual2       = document.getElementById('tipeInvSimpan').value;
                    if(tglRetur != "" && alasanRetur != "" && produkRetur != "" && autoGanti != ""){
                        $('#simpanButtons').hide();
                        $('#loadersId').show();
                        console.log('tes'+codeJual2+'-'+nomorInvoice+'-'+jmlRetur+'-'+jmlKirim+'-'+jmlTerjualAr+'-'+jmlReturAr+'-'+idpjdtAr+'-'+tglRetur+'-'+alasanRetur+'-'+produkRetur+'-'+autoGanti);
                        $.ajax({
                            url: '<?= base_url("mutasi2/simpanProsesRetur") ?>',
                            type: 'POST',
                            data: { 
                                "codejual"      : codeJual2, 
                                "inv"           : nomorInvoice,
                                "jmlRetur"      : jmlRetur, 
                                "jmlKirim"      : jmlKirim,
                                "jmlTerjualAr"  : jmlTerjualAr,
                                "jmlReturAr"    : jmlReturAr,
                                "idpjdtAr"      : idpjdtAr,
                                "tglRetur"      : tglRetur,
                                "alasanRetur"   : alasanRetur,
                                "produkRetur"   : produkRetur,
                                "autoGanti"     : autoGanti
                            },
                            cache: false,
                            success: function (dataResult) {
                                setTimeout(() => { 
                                    Swal.fire({ icon: 'success', title: 'Berhasil', text: 'Menyimpan data retur.', });
                                    $('#simpanButtons').show();
                                    $('#loadersId').hide();
                                }, 1000);
                            }
                        });
                    } else {
                        Swal.fire({ icon: 'warning', title: 'Peringatan !', text: 'Anda harus mengisi semua informasi.', });
                    }
                } else {
                    Swal.fire({ icon: 'error', title: 'Error', text: 'Jumlah retur tidak valid.', });
                }
            }
        });
        $('#nomorInvoice').keyup(function() {
            var nomorInv = $(this).val();
            var notif = document.getElementById('notifLoading');
            var konten = document.getElementById('tableDetilPenjualan');
            notif.innerHTML = 'Sedang mencari nomor invoice : ' + nomorInv;
            notif.style.color = 'red'; 
            document.getElementById('tipeInvSimpan').value = '0';
            if(nomorInv != ""){
                $.ajax({
                    url: '<?= base_url("mutasi2/cariNomorInv") ?>',
                    type: 'POST',
                    data: { "nomorInv": nomorInv },
                    cache: false,
                    success: function (dataResult) {
                        console.table(dataResult);
                        var dataResult = JSON.parse(dataResult);
                        if(dataResult.statusCode == 200){
                            notif.innerHTML = 'Nomor invoice ditemukan : ' + dataResult.nomorInv +' a/N '+dataResult.namaCus;
                            notif.style.color = 'green'; 
                            konten.innerHTML = '<div class="loader"></div><span>Mengambil Data ...</span>' ;
                            if(dataResult.statusKirim == "Kirim"){
                                loadDetilPenjualan(dataResult.codejual, dataResult.nomorInv);
                            } else {
                                setTimeout(() => { 
                                    konten.innerHTML = 'Penjualan ini belum di kirim dari gudang.!';
                                    document.getElementById('tipeInvSimpan').value = '0';
                                }, 1000);
                            }
                        } else {
                            if(dataResult.statusCode == 401){
                                notif.innerHTML = 'Penjualan Defect Tidak Bisa Di Retur : ' + nomorInv;
                                notif.style.color = 'red'; 
                                konten.innerHTML = '' ;
                                document.getElementById('tipeInvSimpan').value = '0';
                            } else {
                                notif.innerHTML = 'Nomor invoice tidak ditemukan : ' + nomorInv;
                                notif.style.color = 'red'; 
                                konten.innerHTML = '' ;
                                document.getElementById('tipeInvSimpan').value = '0';
                            }
                        }
                    }
                });
            } else {
                notif.innerHTML = '';
                konten.innerHTML = '' ;
                document.getElementById('tipeInvSimpan').value = '0';
            }
        });
        function loadDetilPenjualan(codejual, inv){
            var konten = document.getElementById('tableDetilPenjualan');
            $.ajax({
                url: '<?= base_url("mutasi2/showCodeJual") ?>',
                type: 'POST',
                data: { "codejual": codejual, "inv": inv },
                cache: false,
                success: function (dataResult) {
                    setTimeout(() => { 
                        konten.innerHTML = ''+dataResult; 
                        document.getElementById('tipeInvSimpan').value = ''+codejual;
                    }, 1000);
                }
            });
        }
        function hitungTotalRetur() {
            let total = 0;
            document.querySelectorAll('.jmlRetur').forEach(function(input) {
                total += parseInt(input.value) || 0;
            });
            document.getElementById('totalReturs').value = ''+total;
        }
        function detailRetur(kd){
            $('#modalsBody25').html('<div style="width:100%;height:100px;display:flex;justify-content:center;align-items:center;flex-direction:column;gap:10px;"><img src="<?=base_url();?>assets/images/svg-loaders/rings.svg" alt="loading"><span>Please Wait...</span></div>');
            $('#large23').modal('show');
            $.ajax({
                url: '<?= base_url("mutasi2/") ?>',
                type: 'POST',
                data: { "kd": kd },
                cache: false,
                success: function (dataResult) {
                    setTimeout(() => { 
                        $('#modalsBody25').html(''+dataResult);
                    }, 1000);
                }
            });
        }

        // Jalankan saat halaman siap
        
        function validateInput(input) {
            const min = parseInt(input.min);
            const max = parseInt(input.max);
            let val = parseInt(input.value);

            if (isNaN(val)) {
                input.value = min; // Jika kosong atau bukan angka
                return;
            }

            if (val < min) input.value = min;
            if (val > max) input.value = max;
        }
        function thisKondisi(val){
            if(val=="Cacat"){
                Swal.fire({ icon: 'warning', title: 'Warning !', text: 'Produk cacat akan di masukan ke stok produk cacat dan tidak bisa di jual kembali.', });
            }
            if(val=="Defect"){
                Swal.fire({ icon: 'info', title: 'Info', text: 'Produk defect dapat di jual kembali.', });
            }
            if(val=="ORI"){
                Swal.fire({ icon: 'success', title: 'Info', text: 'Pastikan produk dalam kondisi baik ketika di kembalikan ke gudang.', });
            }
        }
        function thisautoGanti(val){
            var konten = document.getElementById('tesSmall');
            if(val==""){
                $('#tesSmall').html('');
            } else {
                if(val=="tidak"){
                    konten.innerHTML = 'Produk tidak diganti, tagihan akan di kurangi.';
                    konten.style.color = 'orange'; 
                } else {
                    konten.innerHTML = 'Produk akan di ganti sesuai dengan yang diretur. Pastikan stok di sistem masih ada.';
                    konten.style.color = 'red'; 
                }
            }
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