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
<?php if($scriptForm=="pembatik"){ ?>
    <script>
        function loadPembatik(){
            $('#tableBody').html('Loading...');
            $.ajax({
                url:"<?=base_url('data/loadPembatik');?>",
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
        loadPembatik();
        $("#submitPembatik").click(function() {
            var namaPembatik = $("#namaPembatik").val();
            var kodePembatik = $("#kodePembatik").val();
            var alamat = $("#alamat").val();
            if(namaPembatik!="" && kodePembatik!=""){
                $("#loadersId").show();
                $("#submitPembatik").hide();
                $.ajax({
                    url:"<?=base_url('proses/inputpembatik');?>",
                    type: "POST",
                    data: {"namaPembatik" : namaPembatik, "kodePembatik" : kodePembatik, "alamat" : alamat},
                    cache: false,
                    success: function(dataResult){
                        var dataResult = JSON.parse(dataResult);
                        if(dataResult.statusCode==200){
                            Swal.fire({ icon: 'success', title: 'Success',
                                text: dataResult.message,
                            }).then(function() {
                                $("#loadersId").hide();
                                $("#submitPembatik").show();
                                $("#namaPembatik").val('');
                                $("#kodePembatik").val('');
                                $("#alamat").val('');
                                loadPembatik();
                                $('#large').modal('hide');
                            });
                        } else {
                            Swal.fire({ icon: 'error', title: 'Error',
                                text: dataResult.message,
                            }).then(function() {
                                $("#loadersId").hide();
                                $("#submitPembatik").show();
                            });
                        }
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Nama, dan Kode Pembatik wajib di isi.',
                });
            }
        });
        $("#submitPembatik2").click(function() {
            var namaPembatik = $("#namaPembatik2").val();
            var kodePembatik = $("#kodePembatik2").val();
            var alamat = $("#alamat2").val();
            var id = $("#idHidden23").val();
            if(namaPembatik!="" && kodePembatik!=""){
                $("#loadersId2").show();
                $("#submitPembatik2").hide();
                $.ajax({
                    url:"<?=base_url('proses/updatepembatik');?>",
                    type: "POST",
                    data: {"id":id,"namaPembatik" : namaPembatik, "kodePembatik" : kodePembatik, "alamat" : alamat},
                    cache: false,
                    success: function(dataResult){
                        var dataResult = JSON.parse(dataResult);
                        if(dataResult.statusCode==200){
                            Swal.fire({ icon: 'success', title: 'Success',
                                text: dataResult.message,
                            }).then(function() {
                                $("#loadersId2").hide();
                                $("#submitPembatik2").show();
                                $("#namaPembatik2").val('');
                                $("#kodePembatik2").val('');
                                $("#alamat2").val('');
                                loadPembatik();
                                $('#large2').modal('hide');
                            });
                        } else {
                            Swal.fire({ icon: 'error', title: 'Error',
                                text: dataResult.message,
                            }).then(function() {
                                $("#loadersId2").hide();
                                $("#submitPembatik2").show();
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
        function updatePembatik(id,nm,kd,almt){
            $('#idHidden23').val(''+id);
            $('#namaPembatik2').val(''+nm);
            $('#kodePembatik2').val(''+kd);
            $('#alamat2').val(''+almt);
        }
        function hapusPembatik(id,nm){
            Swal.fire({
                title: 'Hapus pembatik ?',
                text: 'Hapus '+nm,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url:"<?=base_url('proses/hapusPembatik');?>",
                        type: "POST",
                        data: {"id" : id},
                        cache: false,
                        success: function(dataResult){
                            var dataResult = JSON.parse(dataResult);
                            if(dataResult.statusCode==200){
                                loadPembatik();
                            }
                        }
                    });
                }
            })
        } //end funct
        
    </script>
<?php } if($scriptForm=="babars"){ ?>
    <script>
        function hapusBarbar(id){
            Swal.fire({
                title: 'Anda yakin akan menghapus ?',
                text: ''+id,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url:"<?=base_url('proses/hapusbarbar');?>",
                        type: "POST",
                        data: {"id" : id},
                        cache: false,
                        success: function(dataResult){
                            var dataResult = JSON.parse(dataResult);
                            if(dataResult.statusCode==200){
                                location.reload();
                            }
                        }
                    });
                }
            })
        }
    </script>
<?php } if($scriptForm=="produk"){ ?>
    <script>
        function updateVarian(kd,nm){
            $('#kodeProduk23').val(''+kd);
            $('#namaProduk23').val(''+nm);
        }
        function showVarian(kd,nm){
            $('#myModal45').html(''+nm);
            $('#showVariansHere').html('<div style="width:100%;height:100px;display:flex;justify-content:center;align-items:center;flex-direction:column;gap:10px;"><img src="<?=base_url();?>assets/images/svg-loaders/rings.svg" alt="loading"><span>Please Wait...</span></div>');
            $.ajax({
                url:"<?=base_url('data/loadProdukVarians');?>",
                type: "POST",
                data: {"kd" : kd},
                cache: false,
                success: function(dataResult){
                    setTimeout(() => {
                        $('#showVariansHere').html(dataResult);
                    }, 1000);
                }
            });
        }
        function loadProduk(){
            $('#tableBody').html('Loading...');
            $.ajax({
                url:"<?=base_url('data/loadProduk');?>",
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
        loadProduk();
        document.getElementById("namaProduk").addEventListener("input", function() {
            let namaProduk = this.value;
            let kodeProduk = namaProduk.split(" ") // Memisahkan berdasarkan spasi
                .filter(word => word.length > 0) // Menghilangkan spasi berlebih
                .map(word => word[0].toUpperCase()) // Mengambil huruf pertama dan menjadikannya huruf besar
                .join(""); // Menggabungkan semua huruf awal
            
            document.getElementById("kodeProduk").value = kodeProduk;
            if(kodeProduk==""){
                document.getElementById("tesid").innerHTML = "";
            } else {
                document.getElementById("tesid").innerHTML = "Rekomendasi kode secara otomatis. Anda dapat mengubahnya sesuai keinginan.";
            }
        });
        $("#toModals").click(function() {
            $('#idProduk').val('0');
            $('#namaProduk').val('');
            $('#kodeProduk').val('');
        });
        $("#submitProduk45").click(function() {
            $('#submitProduk45').hide();
            $('#loadersId2').show();
            var namaProduk = $('#namaProduk23').val();
            var kodeProduk = $('#kodeProduk23').val();
            var models = $('#models').val();
            if(namaProduk!="" && kodeProduk!="" && models!=""){
                $.ajax({
                    url:"<?=base_url('proses/simpanProdukVarians');?>",
                    type: "POST",
                    data: {"namaProduk" : namaProduk, "kodeProduk" : kodeProduk, "models" : models},
                    cache: false,
                    success: function(dataResult){
                        var dataResult = JSON.parse(dataResult);
                        if(dataResult.statusCode==200){
                            Swal.fire({icon: 'success',title: 'Berhasil..',
                                text: dataResult.message,
                            }).then(function() {
                                loadProduk();
                                //$('#namaProduk23').val('');
                                //$('#kodeProduk23').val('');
                                $('#models').val('');
                                $('#submitProduk45').show();
                                $('#loadersId2').hide();
                                //$('#modalVarian').modal('hide');
                            });
                        } else {
                            Swal.fire({icon: 'error',title: 'Erorr..',
                                text: dataResult.message,
                            });
                            $('#submitProduk45').show();
                            $('#loadersId2').hide();
                        }
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Data Masih Ada Yang Kosong!',
                });
                $('#submitProduk45').show();
                $('#loadersId2').hide();
            }
        });
        $("#submitProduk").click(function() {
            $('#submitProduk').hide();
            $('#loadersId').show();
            var namaProduk = $('#namaProduk').val();
            var kodeProduk = $('#kodeProduk').val();
            var idProduk = $('#idProduk').val();
            if(namaProduk!="" && kodeProduk!="" && idProduk!=""){
                $.ajax({
                    url:"<?=base_url('proses/simpanProduk');?>",
                    type: "POST",
                    data: {"idProduk" : idProduk, "namaProduk" : namaProduk, "kodeProduk" : kodeProduk},
                    cache: false,
                    success: function(dataResult){
                        var dataResult = JSON.parse(dataResult);
                        if(dataResult.statusCode==200){
                            Swal.fire({icon: 'success',title: 'Berhasil..',
                                text: dataResult.message,
                            }).then(function() {
                                loadProduk();
                                $('#namaProduk').val('');
                                $('#kodeProduk').val('');
                                $('#idProduk').val('0');
                                $('#submitProduk').show();
                                $('#loadersId').hide();
                                $('#large').modal('hide');
                            });
                        } else {
                            Swal.fire({icon: 'error',title: 'Erorr..',
                                text: dataResult.message,
                            });
                            $('#submitProduk').show();
                            $('#loadersId').hide();
                        }
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Data Masih Ada Yang Kosong!',
                });
                $('#submitProduk').show();
                $('#loadersId').hide();
            }
        });
        function updateProduk(id,nm,kd) {
            $('#namaProduk').val(''+nm);
            $('#kodeProduk').val(''+kd);
            $('#idProduk').val(''+id);
        }
        function hapusProduk(id,nm){
            Swal.fire({
                title: 'Anda yakin hapus Produk ?',
                text: ''+nm,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url:"<?=base_url('proses/hapusDataProduk');?>",
                        type: "POST",
                        data: {"id" : id},
                        cache: false,
                        success: function(dataResult){
                            var dataResult = JSON.parse(dataResult);
                            if(dataResult.statusCode==200){
                                loadProduk();
                            }
                        }
                    });
                }
            })
        }
        function hapusVarian(kd,id){
            Swal.fire({
                title: 'Hapus Model ?',
                text: 'Kode : '+kd,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url:"<?=base_url('proses/hapusDataProdukvar');?>",
                        type: "POST",
                        data: {"kd" : kd},
                        cache: false,
                        success: function(dataResult){
                            var dataResult = JSON.parse(dataResult);
                            if(dataResult.statusCode==200){
                                $('#akd'+id+'').hide();
                            }
                        }
                    });
                }
            })
        }
    </script>
<?php } if($scriptForm == "karyawan"){ ?>
    <script>
        function loadKaryawan(){
            $('#tableBody').html('Loading...');
            $.ajax({
                url:"<?=base_url('karyawan/loadDataKaryawan');?>",
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
        loadKaryawan();
        $("#toModals").click(function() {
            $('#idKaryawan').val('0');
            $('#nikKar').val('');
            $('#namaKar').val('');
            $('#nomowa').val('');
            $('#alamat').val('');
            $('#tglAwal').val('');
        });
        $("#submitKaryawan").click(function() {
            var idkar = $('#idKaryawan').val();
            var nik = $('#nikKar').val();
            var nmkar = $('#namaKar').val();
            var nowa = $('#nomowa').val();
            var alamat = $('#alamat').val();
            var tgl = $('#tglAwal').val();
            $('#submitKaryawan').hide();
            $('#loadersId').show();
            if(idkar!="" && nik!="" && nmkar!="" && nowa!="" && tgl!=""){
                $.ajax({
                    url:"<?=base_url('karyawan/addDataKaryawan');?>",
                    type: "POST",
                    data: {"idkar" : idkar, "nik":nik,"nmkar":nmkar,"nowa":nowa,"alamat":alamat,"tgl":tgl},
                    cache: false,
                    success: function(dataResult){
                        var dataResult = JSON.parse(dataResult);
                        if(dataResult.statusCode==200){
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: dataResult.message,
                            }).then(function() {
                                loadKaryawan();
                                $('#idKaryawan').val('0');
                                $('#nikKar').val('');
                                $('#namaKar').val('');
                                $('#nomowa').val('');
                                $('#alamat').val('');
                                $('#tglAwal').val('');
                                $('#submitKaryawan').show();
                                $('#loadersId').hide();
                                $('#large').modal('hide');
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: dataResult.message,
                            });
                            $('#submitKaryawan').show();
                            $('#loadersId').hide();
                        }
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Data Masih Ada Yang Harus Di Isi!',
                });
                $('#submitKaryawan').show();
                $('#loadersId').hide();
            }
        });
        function hapusKar(id,nm){
            Swal.fire({
                title: 'Anda yakin hapus Karyawan ?',
                text: ''+nm,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url:"<?=base_url('proses/hapusDataKar');?>",
                        type: "POST",
                        data: {"id" : id},
                        cache: false,
                        success: function(dataResult){
                            var dataResult = JSON.parse(dataResult);
                            if(dataResult.statusCode==200){
                                loadKaryawan();
                            }
                        }
                    });
                }
            })
        }
        function updateKar(id,nm,nik,tgl,nowa,almt){
            $('#idKaryawan').val(''+id);
            $('#nikKar').val(''+nik);
            $('#namaKar').val(''+nm);
            $('#nomowa').val(''+nowa);
            $('#alamat').val(''+almt);
            $('#tglAwal').val(''+tgl);
        }
    </script>
<?php } if($scriptForm=="users"){ ?>
    <script>
        function loadUsers(){
            $('#tableBody').html('Loading...');
            $.ajax({
                url:"<?=base_url('karyawan/loadDataUsers');?>",
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
        loadUsers();
        $("#toModals").click(function() {
            $('#idUsers').val('0');
            $('#usersNama').val('');
            $('#username').val('');
            $('#pass').val('');
            $('#akses').val('');
        });
        $('#submitUsersPass').click(function(){
            $('#submitUsersPass').hide();
            $('#loadersId2').show();
            var idUsers = $('#idUsers23').val();
            var pass = $('#pass23').val();
            if(pass!=""){
                $.ajax({
                    url:"<?=base_url('users/simpanPass');?>",
                    type: "POST",
                    data: {"idUsers" : idUsers, "pass":pass},
                    cache: false,
                    success: function(dataResult){
                        var dataResult = JSON.parse(dataResult);
                        if(dataResult.statusCode==200){
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: dataResult.message,
                            }).then(function() {
                                loadUsers();
                                $('#idUsers23').val('0');
                                $('#pass23').val('');
                                $('#submitUsersPass').show();
                                $('#loadersId2').hide();
                                $('#large12').modal('hide');
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: dataResult.message,
                            });
                            $('#submitUsersPass').show();
                                $('#loadersId2').hide();
                        }
                    }
                });
            }
        });
        $("#submitUsers").click(function() {
            var idUsers = $('#idUsers').val();
            var usersNama = $('#usersNama').val();
            var username = $('#username').val();
            var pass = $('#pass').val();
            var akses = $('#aksesid').val();
            $('#submitUsers').hide();
            $('#loadersId').show();
            if(idUsers!="" && usersNama!="" && username!="" && pass!="" && akses!=""){
                $.ajax({
                    url:"<?=base_url('users/simpan');?>",
                    type: "POST",
                    data: {"idUsers" : idUsers, "usersNama":usersNama,"username":username,"pass":pass,"akses":akses},
                    cache: false,
                    success: function(dataResult){
                        var dataResult = JSON.parse(dataResult);
                        if(dataResult.statusCode==200){
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: dataResult.message,
                            }).then(function() {
                                loadUsers();
                                $('#idUsers').val('0');
                                $('#usersNama').val('');
                                $('#username').val('');
                                $('#pass').val('');
                                $('#akses').val('');
                                $('#submitUsers').show();
                                $('#loadersId').hide();
                                $('#large').modal('hide');
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: dataResult.message,
                            });
                            $('#submitUsers').show();
                            $('#loadersId').hide();
                        }
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Data Masih Ada Yang Harus Di Isi!',
                });
                $('#submitUsers').show();
                $('#loadersId').hide();
            }
        });
        function hapusUsers(id,nm){
            Swal.fire({
                title: 'Anda yakin hapus Users ?',
                text: ''+nm,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url:"<?=base_url('proses/hapusUsers');?>",
                        type: "POST",
                        data: {"id" : id},
                        cache: false,
                        success: function(dataResult){
                            var dataResult = JSON.parse(dataResult);
                            if(dataResult.statusCode==200){
                                loadUsers();
                            }
                        }
                    });
                }
            })
        }
        function updatePass(id,nm){
            $('#idUsers23').val(''+id);
            $('#usersNama23').val(''+nm);
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