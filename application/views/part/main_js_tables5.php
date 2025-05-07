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
<?php  if($scriptForm=="produks"){ ?>
    <script src="assets/extensions/chart.js/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.9/dist/autoComplete.min.js"></script>
    <script>
        const autoCompleteJS = new autoComplete({
            placeHolder: "Cari Produk",
            data: {
                src: ["Tampilkan Semua",<?=$dataAuto;?>],
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
                        $('#rowProduksID').html('<div style="width:100%;display:flex;justify-content:center;"><div class="loader"></div></div>');
                        $.ajax({
                            url:"<?=base_url('produk/lihatProduk');?>",
                            type: "POST",
                            data: {"selection":selection},
                            cache: false,
                            success: function(dataResult){
                                setTimeout(() => {
                                    $('#rowProduksID').html(dataResult);
                                }, 500);
                                
                            }
                        });
                    }
                }
            }
        });
        function defectShow(kodeProduk){
            $('#large231').modal('show');
            $('#modalsBody12345').html('<div style="width:100%;display:flex;justify-content:center;"><div class="loader"></div></div>');
            $.ajax({
                url:"<?=base_url('produk/lihatProdukDefect');?>",
                type: "POST",
                data: {"kodeProduk":kodeProduk},
                cache: false,
                success: function(dataResult){
                    setTimeout(() => {
                        $('#modalsBody12345').html(dataResult);
                    }, 500);
                }
            });
        }
    function uploads(kd,nm){
        $('#large23').modal('show');
        $('#nmProduks').val(''+nm);
        $('#kode_produks').val(''+kd);
    }
        document.getElementById("file").addEventListener("change", function () {
            var file = this.files[0];
            var allowedExtensions = ["image/jpeg", "image/jpg", "image/png"];
            var maxSize = 1024 * 1024; // 1MB

            if (file) {
                if (!allowedExtensions.includes(file.type)) {
                    Swal.fire("Format file tidak valid! Hanya diperbolehkan jpg, jpeg, dan png.");
                    this.value = "";
                    return;
                }

                if (file.size > maxSize) {
                    Swal.fire("Ukuran file terlalu besar! Maksimal 1MB.");
                    this.value = "";
                    return;
                }
            }
        });
        
var chartColors = {
    red: 'rgb(255, 99, 132)',
    orange: 'rgb(255, 159, 64)',
    yellow: 'rgb(255, 205, 86)',
    green: 'rgb(75, 192, 192)',
    info: '#41B1F9',
    blue: '#3245D1',
    purple: 'rgb(153, 102, 255)',
    grey: '#EBEFF6'
};
$(document).ready(function () {
    $.ajax({
        url: "produk/get_chart_data",
        type: "GET",
        dataType: "json",
        success: function (response) {
            var ctxBar = document.getElementById("bar").getContext("2d");
            var colorValues = Object.values(chartColors);
            function getRandomColor() {
                return colorValues[Math.floor(Math.random() * colorValues.length)];
            }

            var backgroundColors = response.labels.map(() => getRandomColor());
            var myBar = new Chart(ctxBar, {
                type: 'bar',
                data: {
                    labels: response.labels,
                    datasets: [{
                        label: 'Stok',
                        backgroundColor: backgroundColors,
                        data: response.data
                    }]
                },
                options: {
                    responsive: true,
                    barRoundness: 1,
                    title: {
                        display: true,
                        text: "Stok Realtime Bosami"
                    },
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                suggestedMax: 40 + 20,
                                padding: 10,
                            },
                            gridLines: {
                                drawBorder: false,
                            }
                        }],
                        xAxes: [{
                            gridLines: {
                                display: false,
                                drawBorder: false
                            }
                        }]
                    }
                }
            });
        },
        error: function () {
            alert("Gagal mengambil data dari server.");
        }
    });
});
// ----adi sh--



    </script>
<?php } ?>
<?php  if($scriptForm=="stokproduksi"){ ?>
    <script>
        function loadProduksiStok(){
            $('#tableBody').html('Loading...');
            $.ajax({
                url:"<?=base_url('transaksi4/loadProduksiStok');?>",
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
        loadProduksiStok();
        function showProduksiStok(id, cdjahit){
            $('#modalsBody').html('<div style="width:100%;height:100px;display:flex;justify-content:center;align-items:center;flex-direction:column;gap:10px;"><img src="<?=base_url();?>assets/images/svg-loaders/rings.svg" alt="loading"><span>Please Wait...</span></div>');
            $('#large23').modal('show');
            $.ajax({
                url:"<?=base_url('transaksi3/showBabarPlusJahit');?>",
                type: "POST",
                data: {"id":id, "cdjahit":cdjahit},
                cache: false,
                success: function(dataResult){
                    setTimeout(() => {
                        $('#modalsBody').html(''+dataResult);
                    }, 900);
                }
            });
        }
        function updateHpp(id){
            $('#modalsBody2').html('<div style="width:100%;height:100px;display:flex;justify-content:center;align-items:center;flex-direction:column;gap:10px;"><img src="<?=base_url();?>assets/images/svg-loaders/rings.svg" alt="loading"><span>Please Wait...</span></div>');
            $('#modalHpp').modal('show');
            $.ajax({
                url:"<?=base_url('transaksi4/updateHpp');?>",
                type: "POST",
                data: {"id":id},
                cache: false,
                success: function(dataResult){
                    setTimeout(() => {
                        $('#modalsBody2').html(''+dataResult);
                    }, 900);
                }
            });
        }
        $('#simpanHarga').click(function () {
            var codestok = $('#codestokEdit').val();
            var hrgProduks = $('#hrgProduks').val();
            var idpjfid = $('#idpjfid').val();
            $.ajax({
                url: '<?= base_url("transaksi4/updateharga") ?>',
                type: 'POST',
                data: { "codestok": codestok, "hrgProduks": hrgProduks, "idpjfid": idpjfid },
                cache: false,
                success: function (dataResult) {
                    updateHpp(idpjfid);
                }
            });
        });
        function showCacat(id){
            $('#myModalLabel13134').html('Data Produksi Cacat');
            $('#modalsBody212').html('<div style="width:100%;height:100px;display:flex;justify-content:center;align-items:center;"><div class="loader"></div></div>');
            $.ajax({
                url: '<?= base_url("transaksi4/lihatCacat") ?>',
                type: 'POST',
                data: { "id": id, "tipe":"one" },
                cache: false,
                success: function (dataResult) {
                    setTimeout(() => {
                        $('#modalsBody212').html(''+dataResult);
                    }, 500);
                }
            });
            $('#modalCCt').modal('show');
        }
        function showCacat2(id){
            $('#myModalLabel13134').html('Data Produksi Perbaikan');
            $('#modalsBody212').html('<div style="width:100%;height:100px;display:flex;justify-content:center;align-items:center;"><div class="loader"></div></div>');
            $.ajax({
                url: '<?= base_url("transaksi4/lihatCacat") ?>',
                type: 'POST',
                data: { "id": id, "tipe":"two" },
                cache: false,
                success: function (dataResult) {
                    setTimeout(() => {
                        $('#modalsBody212').html(''+dataResult);
                    }, 500);
                }
            });
            $('#modalCCt').modal('show');
        }
        function onchs(){
            var thisSelect = $('#statuscct').val();
            if(thisSelect == ''){
                $('#keccts').html('');
            }
            if(thisSelect == 'Cacat Total'){
                $('#keccts').html('<span style="color:red;">Produk yang cacat dan tidak bisa diperbaiki akan masuk ke stok produk cacat.</span>');
            }
            if(thisSelect == 'Bisa Dijual'){
                $('#keccts').html('<span style="color:#e66707;">Produk yang cacat dan masih bisa dijual akan masuk ke stok produk deface.</span>');
            }
            if(thisSelect == 'Bisa Diperbaiki'){
                $('#keccts').html('<span style="color:green;">Produk yang cacat dan masih bisa diperbaiki akan di kirim kembali ke penjahit untuk perbaikan.</span>');
            }
            //alert('tes');
        }
        function simpanCacat(id){
            var tglCcacat = $('#tglCcacat').val();
            var jmlcct = $('#jmlcct').val();
            var statuscct = $('#statuscct').val();
            var ketcct = $('#ketcct').val();
            if(tglCcacat!='' && jmlcct!='' && statuscct!='' && ketcct!=''){
                if(parseInt(jmlcct) > 0){
                    $.ajax({
                        url: '<?= base_url("transaksi4/prosesCacat") ?>',
                        type: 'POST',
                        data: { "id": id, "tglCcacat": tglCcacat, "jmlcct": jmlcct, "statuscct": statuscct, "ketcct": ketcct },
                        cache: false,
                        success: function (dataResult) {
                                showCacat(id);
                        }
                    });
                } else {
                    Swal.fire("Jumlah cacat tidak boleh kurang dari 1.!!");
                }
            } else {
                Swal.fire("Anda harus mengisi semua form mutasi cacat pada stok produksi.!!");
            }
        }
        function simpanCacatPerbaikan(id){
            var tglCcacat  = $('#tglCcacat5').val();
            var id_pjfcct2 = $('#id_pjfcct2').val();
            if(tglCcacat!='' && id_pjfcct2!=''){
                    $.ajax({
                        url: '<?= base_url("transaksi4/prosesCacat2") ?>',
                        type: 'POST',
                        data: { "id": id, "tglCcacat": tglCcacat, "id_pjfcct2": id_pjfcct2 },
                        cache: false,
                        success: function (dataResult) {
                            showCacat2(id);
                        }
                    });
            } else {
                Swal.fire("Anda harus mengisi semua form mutasi cacat pada stok produksi.!!");
            }
        }
        function deleteCct(nid,id){
            Swal.fire({
                title: 'Hapus Data Cacat.?',
                text: 'Akan mengembalikan ke stok produksi',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url("transaksi4/undocacat") ?>',
                        type: 'POST',
                        data: { "nid": nid },
                        cache: false,
                        success: function (dataResult) {
                            var dataResult = JSON.parse(dataResult);
                            if(dataResult.statusCode==200){ 
                                showCacat(id);
                            } else {
                                Swal.fire({icon: 'error',title: 'Error',text: dataResult.message,});
                            }
                        }
                    });
                }
            });
        }
        function thisIdtwo(id,st){
            if(st == "Telah Diperbaiki"){
                Swal.fire({icon: 'info',title: 'Info',text: 'Sudah di perbaiki yang ini.',});
            } else {
            $('#id_pjfcct2').val(''+id);
            $('#tglCcacat5').prop('disabled', false);
            $('#btnsimpansoke').prop('disabled', false); }
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