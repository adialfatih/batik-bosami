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
<?php if($scriptForm=="kain"){?>
<script>
    $(document).ready(function() {
        $("#submitKain").click(function() {
            var namaKain = $("#first-name").val();
            var konstruksi = $("#second-name").val();
            var kodeKain = $("#third-name").val();
            if(namaKain!="" && konstruksi!="" && kodeKain!=""){
                $("#loadersId").show();
                $("#submitKain").hide();
                $.ajax({
                    url:"<?=base_url('proses/inputkain');?>",
                    type: "POST",
                    data: {"namaKain" : namaKain, "konstruksi" : konstruksi, "kodeKain" : kodeKain},
                    cache: false,
                    success: function(dataResult){
                        var dataResult = JSON.parse(dataResult);
                        if(dataResult.statusCode==200){
                            Swal.fire({ icon: 'success', title: 'Success',
                                text: dataResult.message,
                            }).then(function() {
                                $("#loadersId").hide();
                                $("#submitKain").show();
                                $("#first-name").val('');
                                $("#second-name").val('');
                                $("#third-name").val('');
                                loadTableKain();
                                $('#large').modal('hide');
                            });
                        } else {
                            Swal.fire({ icon: 'error', title: 'Error',
                                text: dataResult.message,
                            }).then(function() {
                                $("#loadersId").hide();
                                $("#submitKain").show();
                            });
                        }
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Data Masih Ada Yang Kosong!',
                });
            }
        });
        $("#submitKain2").click(function() {
            var idkain = $("#idHidden").val();
            var namaKain = $("#first-name2").val();
            var konstruksi = $("#second-name2").val();
            var kodeKain = $("#third-name2").val();
            if(namaKain!="" && konstruksi!="" && kodeKain!=""){
                $("#loadersId2").show();
                $("#submitKain2").hide();
                $.ajax({
                    url:"<?=base_url('proses/updatekain');?>",
                    type: "POST",
                    data: {"namaKain" : namaKain, "konstruksi" : konstruksi, "kodeKain" : kodeKain, "idkain" : idkain},
                    cache: false,
                    success: function(dataResult){
                        var dataResult = JSON.parse(dataResult);
                        if(dataResult.statusCode==200){
                            Swal.fire({ icon: 'success', title: 'Success',
                                text: dataResult.message,
                            }).then(function() {
                                $("#loadersId2").hide();
                                $("#submitKain2").show();
                                $("#first-name2").val('');
                                $("#second-name2").val('');
                                $("#third-name2").val('');
                                loadTableKain();
                                $('#large2').modal('hide');
                            });
                        } else {
                            Swal.fire({ icon: 'error', title: 'Error',
                                text: dataResult.message,
                            }).then(function() {
                                $("#loadersId").hide();
                                $("#submitKain").show();
                            });
                        }
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Data Masih Ada Yang Kosong!',
                });
            }
        });
    });
        function loadTableKain(){
            $('#tableBody').html('Loading...');
            $.ajax({
                url:"<?=base_url('data/loadKain');?>",
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
        loadTableKain();
        function hapusKain(id,nm){
            Swal.fire({
                title: 'Hapus data ?',
                text: 'Hapus kain '+nm,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url:"<?=base_url('proses/hapusKain');?>",
                        type: "POST",
                        data: {"id" : id},
                        cache: false,
                        success: function(dataResult){
                            var dataResult = JSON.parse(dataResult);
                            if(dataResult.statusCode==200){
                                loadTableKain();
                            }
                        }
                    });
                }
            })
        } //end funct
        function updateKain(id,nm,kons,kd){
            $('#idHidden').val(''+id);
            $('#first-name2').val(''+nm);
            $('#second-name2').val(''+kons);
            $('#third-name2').val(''+kd);
        }
</script>
<?php } if($scriptForm=="penjahit"){ ?>
    <script>
        function loadPenjahit(){
            $('#tableBody').html('Loading...');
            $.ajax({
                url:"<?=base_url('data/loadPenjahit');?>",
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
        loadPenjahit();
        $("#submitPenjahit").click(function() {
            var namaPenjahit = $("#namaPenjahit").val();
            var kodePenjahit = $("#kodePenjahit").val();
            var hargaJahit = $("#hargaJahit").val();
            var alamat = $("#alamat").val();
            if(namaPenjahit!="" && kodePenjahit!="" && hargaJahit!=""){
                $("#loadersId").show();
                $("#submitPenjahit").hide();
                $.ajax({
                    url:"<?=base_url('proses/inputpenjahit');?>",
                    type: "POST",
                    data: {"namaPenjahit" : namaPenjahit, "kodePenjahit" : kodePenjahit, "hargaJahit" : hargaJahit, "alamat" : alamat},
                    cache: false,
                    success: function(dataResult){
                        var dataResult = JSON.parse(dataResult);
                        if(dataResult.statusCode==200){
                            Swal.fire({ icon: 'success', title: 'Success',
                                text: dataResult.message,
                            }).then(function() {
                                $("#loadersId").hide();
                                $("#submitPenjahit").show();
                                $("#namaPenjahit").val('');
                                $("#kodePenjahit").val('');
                                $("#hargaJahit").val('');
                                $("#alamat").val('');
                                loadPenjahit();
                                $('#large').modal('hide');
                            });
                        } else {
                            Swal.fire({ icon: 'error', title: 'Error',
                                text: dataResult.message,
                            }).then(function() {
                                $("#loadersId").hide();
                                $("#submitPenjahit").show();
                            });
                        }
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Nama, Kode dan Harga Penjahit wajib di isi.',
                });
            }
        });
        $("#submitPenjahit2").click(function() {
            var namaPenjahit = $("#namaPenjahit2").val();
            var kodePenjahit = $("#kodePenjahit2").val();
            var hargaJahit = $("#hargaJahit2").val();
            var alamat = $("#alamat2").val();
            var id = $("#idHidden23").val();
            if(namaPenjahit!="" && kodePenjahit!="" && hargaJahit!=""){
                $("#loadersId2").show();
                $("#submitPenjahit2").hide();
                $.ajax({
                    url:"<?=base_url('proses/updatepenjahit');?>",
                    type: "POST",
                    data: {"id":id,"namaPenjahit" : namaPenjahit, "kodePenjahit" : kodePenjahit, "hargaJahit" : hargaJahit, "alamat" : alamat},
                    cache: false,
                    success: function(dataResult){
                        var dataResult = JSON.parse(dataResult);
                        if(dataResult.statusCode==200){
                            Swal.fire({ icon: 'success', title: 'Success',
                                text: dataResult.message,
                            }).then(function() {
                                $("#loadersId2").hide();
                                $("#submitPenjahit2").show();
                                $("#namaPenjahit").val('');
                                $("#kodePenjahit").val('');
                                $("#hargaJahit").val('');
                                $("#alamat").val('');
                                loadPenjahit();
                                $('#large').modal('hide');
                            });
                        } else {
                            Swal.fire({ icon: 'error', title: 'Error',
                                text: dataResult.message,
                            }).then(function() {
                                $("#loadersId2").hide();
                                $("#submitPenjahit2").show();
                            });
                        }
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Nama, Kode dan Harga Penjahit wajib di isi.',
                });
            }
        });
        function updatePenjahit(id,nm,kd,hrg,almt){
            $('#idHidden23').val(''+id);
            $('#namaPenjahit2').val(''+nm);
            $('#kodePenjahit2').val(''+kd);
            $('#hargaJahit2').val(''+hrg);
            $('#alamat2').val(''+almt);
        }
        function hapusPenjahit(id,nm){
            Swal.fire({
                title: 'Hapus data ?',
                text: 'Hapus '+nm,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url:"<?=base_url('proses/hapusPenjahit');?>",
                        type: "POST",
                        data: {"id" : id},
                        cache: false,
                        success: function(dataResult){
                            var dataResult = JSON.parse(dataResult);
                            if(dataResult.statusCode==200){
                                loadPenjahit();
                            }
                        }
                    });
                }
            })
        } //end funct
        function updateHarga(kd){
            $('#modalUpdateHarga').html('<div style="width:100%;height:100px;display:flex;align-items:center;justify-content:center;"><div class="loader"></div></div>');
            $.ajax({
                url:"<?=base_url('proses/loadUpdateHarga');?>",
                type: "POST",
                data: {"kd" : kd},
                cache: false,
                success: function(dataResult){
                    setTimeout(() => {
                        $('#modalUpdateHarga').html(dataResult);
                    }, 1000);
                }
            });
        }
        function simpanDaftar(kd){
            var jnsjahit = $("#jnsjhtmdl").val();
            var modeljahit = $("#mdljhtmdl").val();
            var harga = $("#hrgjhtmdl").val();
            if(jnsjahit!="" && modeljahit!="" && harga!=""){
                $.ajax({
                    url:"<?=base_url('proses/saveUpdateHarga');?>",
                    type: "POST",
                    data: {"kd" : kd, "jnsjahit" : jnsjahit, "modeljahit" : modeljahit, "harga" : harga},
                    cache: false,
                    success: function(dataResult){
                        var dataResult = JSON.parse(dataResult);
                        if(dataResult.statusCode==200){
                            updateHarga(kd);
                        } else {
                            Swal.fire({ icon: 'error', title: 'Error',
                                text: dataResult.message,
                            });
                        }
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Jenis, Model dan Harga wajib di isi.',
                })
            }
        }
        function hapusHargaList(id,kd){
            Swal.fire({
                title: 'Anda yakin akan menghapus ?',
                text: '',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url:"<?=base_url('proses/hapusHargaList');?>",
                        type: "POST",
                        data: {"id" : id},
                        cache: false,
                        success: function(dataResult){
                            var dataResult = JSON.parse(dataResult);
                            if(dataResult.statusCode==200){
                                updateHarga(kd);
                            }
                        }
                    });
                }
            })
        }
    </script>
<?php } if($scriptForm=="pemotong"){ ?>
    <script>
        function loadPtg(){
            $('#tableBody').html('Loading...');
            $.ajax({
                url:"<?=base_url('data/loadPtg');?>",
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
        loadPtg();
        $("#submitPtg").click(function() {
            var namaptg = $("#namaPtg").val();
            var kodeptg = $("#kodePtg").val();
            var alamat = $("#alamat").val();
            if(namaptg!="" && kodeptg!=""){
                $("#loadersId").show();
                $("#submitPtg").hide();
                $.ajax({
                    url:"<?=base_url('proses/inputptg');?>",
                    type: "POST",
                    data: {"namaptg" : namaptg, "kodeptg" : kodeptg, "alamat" : alamat},
                    cache: false,
                    success: function(dataResult){
                        var dataResult = JSON.parse(dataResult);
                        if(dataResult.statusCode==200){
                            Swal.fire({ icon: 'success', title: 'Success',
                                text: dataResult.message,
                            }).then(function() {
                                $("#loadersId").hide();
                                $("#submitPtg").show();
                                $("#namaPtg").val('');
                                $("#kodePtg").val('');
                                $("#alamat").val('');
                                loadPtg();
                                $('#large').modal('hide');
                            });
                        } else {
                            Swal.fire({ icon: 'error', title: 'Error',
                                text: dataResult.message,
                            }).then(function() {
                                $("#loadersId").hide();
                                $("#submitPtg").show();
                            });
                        }
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Anda harus mengisi data dengan benar.!!',
                });
            }
        });
        $("#submitPtg2").click(function() {
            var idptg = $("#idptg").val();
            var namaptg = $("#namaPtg2").val();
            var kodeptg = $("#kodePtg2").val();
            var alamat = $("#alamat2").val();
            if(namaptg!="" && kodeptg!="" && idptg!=""){
                $("#loadersId2").show();
                $("#submitPtg2").hide();
                $.ajax({
                    url:"<?=base_url('proses/updateptg');?>",
                    type: "POST",
                    data: {"namaptg" : namaptg, "kodeptg" : kodeptg, "alamat" : alamat, "idptg" : idptg},
                    cache: false,
                    success: function(dataResult){
                        var dataResult = JSON.parse(dataResult);
                        if(dataResult.statusCode==200){
                            Swal.fire({ icon: 'success', title: 'Success',
                                text: dataResult.message,
                            }).then(function() {
                                $("#loadersId2").hide();
                                $("#submitPtg2").show();
                                $("#namaPtg2").val('');
                                $("#kodePtg2").val('');
                                $("#alamat2").val('');
                                loadPtg();
                                $('#large').modal('hide');
                            });
                        } else {
                            Swal.fire({ icon: 'error', title: 'Error',
                                text: dataResult.message,
                            }).then(function() {
                                $("#loadersId2").hide();
                                $("#submitPtg2").show();
                            });
                        }
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Anda harus mengisi data dengan benar.!!',
                });
            }
        });
        function updatePtg(id,nm,kd,almt){
            $("#idptg").val(id);
            $("#namaPtg2").val(nm);
            $("#kodePtg2").val(kd);
            $("#alamat2").val(almt);
        }
        function hapusPtg(id,nm){
            Swal.fire({
                title: 'Hapus Tukang Potong ?',
                text: 'Hapus '+nm,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url:"<?=base_url('proses/hapusPemotong');?>",
                        type: "POST",
                        data: {"id" : id},
                        cache: false,
                        success: function(dataResult){
                            var dataResult = JSON.parse(dataResult);
                            if(dataResult.statusCode==200){
                                loadPtg();
                            }
                        }
                    });
                }
            })
        }
        
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