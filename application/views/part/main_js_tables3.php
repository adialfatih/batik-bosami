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
<?php if($scriptForm=="potongkain"){ ?>
    <script>
        function loadPotongKain(){
            $('#tableBody').html('Loading...');
            $.ajax({
                url:"<?=base_url('data/loadPotongKain');?>",
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
        loadPotongKain();
        $("#inputPtg").click(function() {
            var savednow = $('#savenowid').val();
            $('#hasilPotonganTable').html('');
            $('#noteIdPotongan').html('');
            if(savednow == "not"){
                $.ajax({
                    url:"<?=base_url('data/getCode');?>",
                    type: "POST",
                    data: {},
                    cache: false,
                    success: function(dataResult){
                        $('#inputCode').val(''+dataResult);
                        $('#tanggalPotong').val('');
                        $('#tukangPotong').val('');
                        $('#namaKain').val('');
                        $('#showStokID').html('');
                        $('#jmlPotong').val('');
                        $('#ongkosPotong').val('');
                        $('#ukrPotongMtr').val('');
                        $('#jmlPtpngPcs').val('');
                    }
                });
            }
        });
        $("#addPlusPotong").click(function() {
            var savenowid = $('#savenowid').val();
            var saveCode = $('#inputCode').val();
            var tanggalPotong = $('#tanggalPotong').val();
            var tukangPotong = $('#tukangPotong').val();
            var namaKain = $('#namaKain').val();
            var jmlPotong = $('#jmlPotong').val();
            var ongkosPotong = $('#ongkosPotong').val();
            var ukrPotongMtr = $('#ukrPotongMtr').val();
            var jmlPtpngPcs = $('#jmlPtpngPcs').val();
            $('#addPlusPotong').prop('disabled', true);
            $('#simpanButtons').prop('disabled', true);
            if(saveCode!="" && tanggalPotong!="" && tukangPotong!="" && namaKain!="" && jmlPotong!="" && ongkosPotong!="" && ukrPotongMtr!="" && jmlPtpngPcs!=""){
                $.ajax({
                    url:"<?=base_url('transaksi/prosesPotongSimpan');?>",
                    type: "POST",
                    data: {"saveCode":saveCode,"tanggalPotong":tanggalPotong,"tukangPotong":tukangPotong,"namaKain":namaKain,"jmlPotong":jmlPotong,"ongkosPotong":ongkosPotong,"ukrPotongMtr":ukrPotongMtr,"jmlPtpngPcs":jmlPtpngPcs,},
                    cache: false,
                    success: function(dataResult){
                        var dataResult = JSON.parse(dataResult);
                        if(dataResult.statusCode==200){
                            Swal.fire({icon: 'success',title: 'Berhasil..', text: dataResult.message, });
                            $('#addPlusPotong').prop('disabled', false);
                            $('#simpanButtons').prop('disabled', false);
                            showPotongan(saveCode);
                        } else {
                            Swal.fire({icon: 'error',title: 'Erorr..', text: dataResult.message, });
                            $('#addPlusPotong').prop('disabled', false);
                            $('#simpanButtons').prop('disabled', false);
                        }
                    }
                });
            } else {
                Swal.fire({icon: 'error',title: 'Erorr..', text: 'Anda harus mengisi data dengan benar.!!', });
                $('#addPlusPotong').prop('disabled', false);
                $('#simpanButtons').prop('disabled', false);
            }
        });
        function hapusPproses(cd){
            console.log(cd);
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Menghapus Proses Pemotongan Kain",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Tidak',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url:"<?=base_url('transaksi/hapusPptonganKainAll');?>",
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
        function hapusPotongan(id,cd){
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Data Potongan Akan Di Hapus",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Tidak',
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:"<?=base_url('transaksi/hapusPptonganKain');?>",
                    type: "POST",
                    data: {"id":id,"cd":cd},
                    cache: false,
                    success: function(dataResult){
                        var dataResult = JSON.parse(dataResult);
                        if(dataResult.statusCode==200){
                            Swal.fire({icon: 'success', title: 'Berhasil',
                                text: dataResult.message,
                            });
                            showPotongan(cd);
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
        function viewPotongan(codesaved){
            $.ajax({
                url:"<?=base_url('data/showInputanPotong');?>",
                type: "POST",
                data: {"codesaved":codesaved},
                cache: false,
                success: function(dataResult){
                    var dataResult = JSON.parse(dataResult);
                    if(dataResult.statusCode==200){
                        $('#inputCode').val(''+codesaved);
                        $('#tanggalPotong').val(''+dataResult.tgl_potong);
                        $('#tukangPotong').val(''+dataResult.kode_pemotong);
                        $('#namaKain').val(''+dataResult.kode_kain);
                        $('#showStokID').html('');
                        $('#jmlPotong').val(''+dataResult.jumlah_kainkirim);
                        $('#ongkosPotong').val(''+dataResult.ongkos_potong);
                        $('#ukrPotongMtr').val('');
                        $('#jmlPtpngPcs').val('');
                        showPotongan(codesaved);
                        var txt = "<hr><strong style='color:blue;'>Perhitungan HPP 1 :</strong><br>(Ukuran Panjang Potongan Kain &raquo; Konversi Ke Yard) x Harga Kain Per Yard<br>+<br>Total Ongkos Potong / Jumlah Pcs Potongan Kain<hr><div style='width:flex;display:flex;justify-content:space-between;align-items:center;'><a style='color:red;' href='#' onclick='hapusPproses(\""+codesaved+"\")'>Hapus Proses Ini</a><button type='button' class='btn btn-primary' onclick='hitungHpp1(\""+codesaved+"\")'>Hitung HPP 1</button></div>";
                        $('#noteIdPotongan').html(''+txt);
                        $('#large').modal('show');
                    } else {
                        Swal.fire({ icon: 'error', title: 'Error', text: 'Token Error..!!'});
                    }
                }
            });
            
        }
        function hitungHpp1(cd){
            console.log('tes '+cd);
            $.ajax({
                url:"<?=base_url('data/hitungHpp1');?>",
                type: "POST",
                data: {"cd":cd},
                cache: false,
                success: function(dataResult){
                    console.log('tes2 '+dataResult);
                    viewPotongan(cd);
                }
            });
        }
        function showPotongan(cd){
            $.ajax({
                url:"<?=base_url('transaksi/lihatPotonganKain');?>",
                type: "POST",
                data: {"cd":cd},
                cache: false,
                success: function(dataResult){
                    $('#hasilPotonganTable').html(dataResult);
                }
            });
        }
        document.getElementById('namaKain').addEventListener('change', function (event) {
            var selectedValue = event.target.value;
            $('#showStokID').html('Loading...');
            $.ajax({
                url:"<?=base_url('data/lihatStokKain');?>",
                type: "POST",
                data: {"selectedValue":selectedValue},
                cache: false,
                success: function(dataResult){
                    $('#showStokID').html(dataResult);
                }
            });
        });
    </script>
<?php } if($scriptForm=="stokkain"){ ?>
    <script>
        function loadStokKain(){
            $('#tableBody').html('Loading...');
            $.ajax({
                url:"<?=base_url('data/loadStokKain');?>",
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
        loadStokKain();
        function lihatKodeKain(kd){
            $('#modalsBody').html('<div style="width:100%;height:100px;display:flex;justify-content:center;align-items:center;flex-direction:column;gap:10px;"><img src="<?=base_url();?>assets/images/svg-loaders/rings.svg" alt="loading"><span>Please Wait...</span></div>');
            $.ajax({
                url:"<?=base_url('data/lihatDetilKain');?>",
                type: "POST",
                data: {"kd" : kd},
                cache: false,
                success: function(dataResult){
                    setTimeout(() => {
                        $('#modalsBody').html(dataResult);
                    }, 800);
                }
            });
        }
    </script>
<?php } if($scriptForm=="pembeliankain"){ ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        }, false);
        function loadpembeliankain(){
            $('#tableBody').html('Loading...');
            $.ajax({
                url:"<?=base_url('data/loadpembeliankain');?>",
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
        loadpembeliankain();
        document.getElementById('file').addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const allowedExtensions = ['image/png', 'image/jpeg', 'image/svg+xml'];
                if (!allowedExtensions.includes(file.type)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Format File Tidak Didukung!',
                        text: 'Hanya file PNG, JPG, dan SVG yang diperbolehkan.',
                    });
                    event.target.value = ''; // Hapus file dari input
                }
            }
        });
        function showDetil(kd){
            $('#kodePembelian').val(''+kd);
            var aks = "<?=$this->session->userdata('akses');?>";
            $.ajax({
                url:"<?=base_url('transaksi/lihatDetil');?>",
                type: "POST",
                data: {"kd":kd},
                cache: false,
                success: function(dataResult){
                    var dataResult = JSON.parse(dataResult);
                    if(dataResult.statusCode==200){
                        var formattedHargaTotal = new Intl.NumberFormat('id-ID').format(dataResult.hargatotal);
                        var formattedhargayard = new Intl.NumberFormat('id-ID').format(dataResult.hargayard);
                        var formattebeadll = new Intl.NumberFormat('id-ID').format(dataResult.beadll);
                        var formajmlbeli = new Intl.NumberFormat('id-ID').format(dataResult.jmlbeli);
                        var formbeadll = new Intl.NumberFormat('id-ID').format(dataResult.beadll);
                        $('#tanggalBeli2').val(dataResult.tglPembelian2);
                        $('#kainId23').val(dataResult.kodekain);
                        $('#jmlyard123').val(formajmlbeli);
                        if(aks=="root"){
                        $('#hargayard124').val(formattedhargayard);
                        $('#totalhargayard675').val(formattedHargaTotal);
                        $('#bea123').val(formbeadll);
                        } else {
                        $('#hargayard124').val('*****');
                        $('#totalhargayard675').val('*****');
                        $('#bea123').val('*****');
                        }
                        $('#sup789').val(dataResult.namasup);
                        $('#pembayaran851').val(dataResult.pembayaran);
                        var nilaiTotalBeli = parseInt(dataResult.hargatotal) + parseInt(dataResult.beadll);
                        var nilaiTotalBeli2 = new Intl.NumberFormat('id-ID').format(nilaiTotalBeli);
                        var hargaYard = nilaiTotalBeli / parseFloat(dataResult.jmlbeli);
                        let hasilYard = Math.round(hargaYard);
                        var formathasilYard = new Intl.NumberFormat('id-ID').format(hasilYard);
                        if(aks=="root"){
                        if(dataResult.buktitf=="null.jpg"){
                            var txt = "<strong>Note : </strong><br>Total Harga Pembelian = Rp. "+formattedHargaTotal+" + Rp. "+formattebeadll+"<br>Total Harga Pembelian = Rp. <strong>"+nilaiTotalBeli2+"</strong><br>Harga Per Yard = Rp. "+nilaiTotalBeli2+" / "+formajmlbeli+" Yard<br>Harga Per Yard = Rp. <strong>"+formathasilYard+"</strong><hr>Di input oleh : "+dataResult.diinput+", "+dataResult.tglinput+", <a style='color:red;' href='#' onclick='hapusPembelian(\""+dataResult.codesave+"\")'>Hapus Pembelian Ini</a>";
                        } else {
                            var txt = "<strong>Note : </strong><br>Total Harga Pembelian = Rp. "+formattedHargaTotal+" + Rp. "+formattebeadll+"<br>Total Harga Pembelian = Rp. <strong>"+nilaiTotalBeli2+"</strong><br>Harga Per Yard = Rp. "+nilaiTotalBeli2+" / "+formajmlbeli+" Yard<br>Harga Per Yard = Rp. <strong>"+formathasilYard+"</strong><br>Bukti Bayar = <a href='<?=base_url('uploads/');?>"+dataResult.buktitf+"' target='_blank'>Download</a><hr>Di input oleh : "+dataResult.diinput+", "+dataResult.tglinput+", <a style='color:red;' href='#' onclick='hapusPembelian(\""+dataResult.codesave+"\")'>Hapus Pembelian Ini</a>";
                        }
                        } else {
                            var txt = "";
                        }
                        $('#noteid').html(''+txt);
                        $('#large12').modal('show');
                    } else {
                        Swal.fire({icon: 'error', title: 'Gagal',
                            text: dataResult.message,
                        });
                    }
                }
            });
            
        } //end
        function hapusPembelian(kd){
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Data Pembelian Akan Dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Tidak',
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:"<?=base_url('transaksi/hapusPembelian');?>",
                    type: "POST",
                    data: {"kd":kd},
                    cache: false,
                    success: function(dataResult){
                        var dataResult = JSON.parse(dataResult);
                        if(dataResult.statusCode==200){
                            Swal.fire({icon: 'success', title: 'Berhasil',
                                text: dataResult.message,
                            });
                            $('#large12').modal('hide');
                            loadpembeliankain();
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
        
    </script>
<?php } if($scriptForm=="stokkain2"){ ?>
    <script>
        function loadStokKainPotongan(){
            $('#tableBody').html('Loading...');
            $.ajax({
                url:"<?=base_url('data/loadStokKainPotongan');?>",
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
        loadStokKainPotongan();
        function showDetilPtg(cd){
            $('#modalsBody').html('<div style="width:100%;height:100px;display:flex;justify-content:center;align-items:center;flex-direction:column;gap:10px;"><img src="<?=base_url();?>assets/images/svg-loaders/rings.svg" alt="loading"><span>Please Wait...</span></div>');
            $('#large2').modal('show');
            $.ajax({
                url:"<?=base_url('transaksi/lihatsumberPotongan');?>",
                type: "POST",
                data: {"cd":cd},
                cache: false,
                success: function(dataResult){
                    setTimeout(() => {
                        $('#modalsBody').html(dataResult);
                    }, 900);
                }
            });
        }
        </script>
<?php } if($scriptForm=="stokkain3"){ ?>
    <script>
        function loadStokKainPotongan(){
            $('#tableBody').html('Loading...');
            $.ajax({
                url:"<?=base_url('data/loadStokKainBatik');?>",
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
        loadStokKainPotongan();
        function showBabar(id){
            $('#modalsBody').html('<div style="width:100%;height:100px;display:flex;justify-content:center;align-items:center;flex-direction:column;gap:10px;"><img src="<?=base_url();?>assets/images/svg-loaders/rings.svg" alt="loading"><span>Please Wait...</span></div>');
            $('#large23').modal('show');
            $.ajax({
                url:"<?=base_url('transaksi2/detilProsesBabar');?>",
                type: "POST",
                data: {"id":id},
                cache: false,
                success: function(dataResult){
                    setTimeout(() => {
                        $('#modalsBody').html(''+dataResult);
                    }, 900);
                }
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