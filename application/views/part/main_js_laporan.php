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
<?php if($scriptForm=="cashflow"){?>
<script src="https://cdn.jsdelivr.net/npm/litepicker/dist/bundle.js"></script>
<script>
    const picker = new Litepicker({
      element: document.getElementById('date-range'),
      singleMode: false,
      format: 'YYYY-MM-DD',
      numberOfMonths: 2,
      numberOfColumns: 2
    });

    // Contoh mengambil nilai
    picker.on('selected', (startDate, endDate) => {
      console.log("Dari:", startDate.format('YYYY-MM-DD'));
      console.log("Sampai:", endDate.format('YYYY-MM-DD'));
    });
</script>
<?php } if($scriptForm=="cashflow"){ ?>
    <script>
    function showTableid(){
        $('#tableBody').html('<tr><td colspan="6">Loading...</td></tr>');
        $.ajax({
            url:"<?=base_url('data/loadCashFlow');?>",
            type: "POST",
            data: {"kd" : "tes"},
            cache: false,
            success: function(dataResult){
                setTimeout(() => {
                    if ($.fn.DataTable.isDataTable('#table1')) {
                        $('#table1').DataTable().destroy();
                    }
                    $('#tableBody').html(dataResult);
                    $('#table1').DataTable();
                }, 500);
            }
        });
    }
    showTableid();
    $("#savePemasukan").click(function() {
        $("#loadersId2").show();
        $("#savePemasukan").hide();
        var tglMasuk            = $("#tglMasuk").val();
        var inputNominalMasuk   = $("#inputNominalMasuk").val();
        var kategoriMasuk       = $("#kategoriMasuk").val();
        var keteranganMasuk     = $("#keteranganMasuk").val();
        if(tglMasuk!="" && inputNominalMasuk!="" && kategoriMasuk!="" && keteranganMasuk!=""){
            $.ajax({
                url:"<?=base_url('proses/inputUang');?>",
                type: "POST",
                data: {"tglMasuk" : tglMasuk, "inputNominalMasuk" : inputNominalMasuk, "kategoriMasuk" : kategoriMasuk, "keteranganMasuk" : keteranganMasuk},
                cache: false,
                success: function(dataResult){
                    var data = JSON.parse(dataResult);
                    if(data.statusCode==200){
                        Swal.fire({icon: 'success', title: 'Berhasil', text: data.message,}).then((result) => {
                            $("#loadersId2").hide();
                            $("#savePemasukan").show();
                            $("#tglMasuk").val('');
                            $("#inputNominalMasuk").val('');
                            $("#kategoriMasuk").val('');
                            $("#keteranganMasuk").val('');
                            showTableid();
                        });
                    } else {
                        Swal.fire({icon: 'error', title: 'Oops...', text: data.message,}).then((result) => {
                            $("#loadersId2").hide();
                            $("#savePemasukan").show();
                        });
                    }
                }
            });
        } else {
            Swal.fire({icon: 'error', title: 'Oops...', text: 'Anda harus mengisi semua data.!!',}).then((result) => {
                $("#loadersId2").hide();
                $("#savePemasukan").show();
            });
        }
    });
    $("#showReportFilter").click(function() {
        Swal.fire({icon: 'info', title: 'Informasi', text: 'Laporan tersedia setelah anda menyimpan data minimal 20 hari..!!',});
    });
    $("#savePengeluaran").click(function() {
        $("#loadersId3").show();
        $("#savePengeluaran").hide();
        var tglKeluar             = $("#tglKeluar").val();
        var inputNominalKeluar   = $("#inputNominalKeluar").val();
        var kategorikeluar       = $("#kategorikeluar").val();
        var keteranganKeluar     = $("#keteranganKeluar").val();
        if(tglKeluar!="" && inputNominalKeluar!="" && kategorikeluar!="" && keteranganKeluar!=""){
            $.ajax({
                url:"<?=base_url('proses/inputUangKeluar');?>",
                type: "POST",
                data: {"tglKeluar" : tglKeluar, "inputNominalKeluar" : inputNominalKeluar, "kategorikeluar" : kategorikeluar, "keteranganKeluar" : keteranganKeluar},
                cache: false,
                success: function(dataResult){
                    var data = JSON.parse(dataResult);
                    if(data.statusCode==200){
                        Swal.fire({icon: 'success', title: 'Berhasil', text: data.message,}).then((result) => {
                            $("#loadersId3").hide();
                            $("#savePengeluaran").show();
                            $("#tglKeluar").val('');
                            $("#inputNominalKeluar").val('');
                            $("#kategorikeluar").val('');
                            $("#keteranganKeluar").val('');
                            showTableid();
                        });
                    } else {
                        Swal.fire({icon: 'error', title: 'Oops...', text: data.message,}).then((result) => {
                            $("#loadersId3").hide();
                            $("#savePengeluaran").show();
                        });
                    }
                }
            });
        } else {
            Swal.fire({icon: 'error', title: 'Oops...', text: 'Anda harus mengisi semua data.!!',}).then((result) => {
                $("#loadersId3").hide();
                $("#savePengeluaran").show();
            });
        }
    });
    function hapusCashFlow(id,tipe){
        Swal.fire({
            title: 'Hapus '+tipe+'',
            text: "Anda yakin akan menghapus "+tipe+" ini ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:"<?=base_url('proses/delCashFlow');?>",
                    type: "POST",
                    data: {"id" : id},
                    cache: false,
                    success: function(dataResult){
                        var dataResult = JSON.parse(dataResult);
                        if(dataResult.statusCode==200){
                            Swal.fire({icon: 'success', title: 'Berhasil', text: dataResult.message,}).then((result) => {
                                showTableid();
                            });
                        }
                    }
                });
            }
        });
    }
    </script>
<?php } if($scriptForm=="gajiKaryawan"){ ?>
<script>
    function showTableGaji(){
        $('#tableBody').html('<tr><td colspan="6">Loading...</td></tr>');
        $.ajax({
            url:"<?=base_url('data/loadDataGaji');?>",
            type: "POST",
            data: {"kd" : "tes"},
            cache: false,
            success: function(dataResult){
                setTimeout(() => {
                    if ($.fn.DataTable.isDataTable('#table1')) {
                        $('#table1').DataTable().destroy();
                    }
                    $('#tableBody').html(dataResult);
                    $('#table1').DataTable();
                }, 100);
            }
        });
    }
    showTableGaji();
    function hapusGaji(id,kar){
        Swal.fire({
            title: 'Hapus Gaji',
            text: "Menghapus gaji karyawan atas nama "+kar+"",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:"<?=base_url('proses/delGajis');?>",
                    type: "POST",
                    data: {"id" : id},
                    cache: false,
                    success: function(dataResult){
                        var dataResult = JSON.parse(dataResult);
                        if(dataResult.statusCode==200){
                            Swal.fire({icon: 'success', title: 'Berhasil Hapus', text: dataResult.message,}).then((result) => {
                                showTableGaji();
                            });
                        }
                    }
                });
            }
        });
    }
    $("#saveGaji").click(function() {
        $("#loadersId2").show();
        $("#saveGaji").hide();
        console.log('tes 1');
        var perioderGaji     = $("#perioderGaji").val();
        var tglPenggajian    = $("#tglPenggajian").val();
        var namaKaryawan     = $("#namaKaryawan").val();
        var inputNominalGaji = $("#inputNominalGaji").val();
        var metodeGaji       = $("#metodeGaji").val();
        var keteranganGaji   = $("#keteranganGaji").val();
        if(tglPenggajian!="" && namaKaryawan!="" && inputNominalGaji!="" && metodeGaji!=""){
            $.ajax({
                url:"<?=base_url('proses/inputGaji');?>",
                type: "POST",
                data: {"perioderGaji" : perioderGaji, "tglPenggajian" : tglPenggajian, "namaKaryawan" : namaKaryawan, "inputNominalGaji" : inputNominalGaji, "metodeGaji" : metodeGaji, "keteranganGaji" : keteranganGaji},
                cache: false,
                success: function(dataResult){
                    var data = JSON.parse(dataResult);
                    if(data.statusCode==200){
                        Swal.fire({icon: 'success', title: 'Berhasil Simpan', text: data.message,}).then((result) => {
                            $("#loadersId2").hide();
                            $("#saveGaji").show();
                            $("#inputNominalGaji").val('');
                            $("#namaKaryawan").val('');
                            $("#metodeGaji").val('');
                            $("#keteranganGaji").val('');
                            showTableGaji();
                        });
                    } else {
                        Swal.fire({icon: 'error', title: 'Gagal Menyimpan', text: data.message,}).then((result) => {
                            $("#loadersId2").hide();
                            $("#saveGaji").show();
                        });
                    }
                }
            });
        } else {
            Swal.fire({icon: 'error', title: 'Oops...', text: 'Anda harus mengisi semua data.!!',}).then((result) => {
                $("#loadersId2").hide();
                $("#saveGaji").show();
            });
        }
    });
</script>
<?php } ?>
<script>
function formatRibuan(input) {
    let angka = input.value.replace(/[^0-9]/g, '');
    let formatted = new Intl.NumberFormat('id-ID').format(angka);
    input.value = formatted;
}
</script>
</body>

</html>