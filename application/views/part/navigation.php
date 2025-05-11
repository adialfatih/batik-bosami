<?php $aks=$this->session->userdata('akses'); ?>
<nav class="main-navbar">
    <div class="container">
        <ul>
           <li class="menu-item ">
                <a href="<?=base_url('dashboard');?>" class='menu-link'>
                    <i class="bi bi-grid-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="menu-item has-sub">
                <a href="javacript:void(0);" class='menu-link'>
                    <i class="bi bi-stack"></i>
                    <span>Master</span>
                </a>
                <div class="submenu ">
                    <div class="submenu-group-wrapper">
                        <ul class="submenu-group">
                            <li class="submenu-item ">
                                <a href="<?=base_url('data-kain');?>" class='submenu-link'>Data Kain</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="<?=base_url('data-penjahit');?>" class='submenu-link'>Data Penjahit</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="<?=base_url('data-tukang-potong');?>" class='submenu-link'>Data Pemotong</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="<?=base_url('data-pembatik');?>" class='submenu-link'>Data Pembatik</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="<?=base_url('data-jenis-babaran');?>" class='submenu-link'>Data Jenis Babaran</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="<?=base_url('data-produk');?>" class='submenu-link'>Data Produk</a>
                            </li>
                            <?php if($aks=="root"){ ?>
                            <li class="submenu-item ">
                                <a href="<?=base_url('data-karyawan');?>" class='submenu-link'>Data Karyawan</a>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </li>
            <li class="menu-item  has-sub">
                <a href="#" class='menu-link'>
                    <i class="bi bi-grid-1x2-fill"></i>
                    <span>Kain</span>
                </a>
                <div class="submenu ">
                    <div class="submenu-group-wrapper">
                        <ul class="submenu-group">
                            <li class="submenu-item">
                                <a href="<?=base_url('pembelian-kain');?>" class='submenu-link'>Pembelian Kain</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="<?=base_url('stok-kain-real');?>" class='submenu-link'>Stok Kain Real</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="<?=base_url('stok-kain-potongan');?>" class='submenu-link'>Stok Kain Potongan</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="<?=base_url('stok-kain-batik');?>" class='submenu-link'>Stok Kain Batik</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
            <li class="menu-item  has-sub">
                <a href="#" class='menu-link'>
                    <i class="bi bi-gear-wide-connected"></i>
                    <span>Produksi</span>
                </a>
                <div class="submenu ">
                    <div class="submenu-group-wrapper">
                        <ul class="submenu-group">
                            <li class="submenu-item">
                                <a href="<?=base_url('pemotongan-kain');?>" class='submenu-link'>Potong Kain</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="<?=base_url('persiapan-produksi');?>" class='submenu-link'>Persiapan</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="<?=base_url('jahit');?>" class='submenu-link'>Jahit</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="<?=base_url('stok-produksi');?>" class='submenu-link'>Stok Produksi</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
            <!-- <li class="menu-item  has-sub">
                <a href="#" class='menu-link'>
                    <i class="bi bi-file-earmark-fill"></i>
                    <span>Pages</span>
                </a>
                <div class="submenu ">
                    <div class="submenu-group-wrapper">
                        <ul class="submenu-group">
                            <li class="submenu-item  has-sub">
                                <a href="#" class='submenu-link'>Authentication</a>
                                    <ul class="subsubmenu">
                                        <li class="subsubmenu-item ">
                                            <a href="auth-login.html" class="subsubmenu-link">Login</a>
                                        </li>
                                        <li class="subsubmenu-item ">
                                            <a href="auth-register.html" class="subsubmenu-link">Register</a>
                                        </li>
                                        <li class="subsubmenu-item ">
                                            <a href="auth-forgot-password.html" class="subsubmenu-link">Forgot Password</a>
                                        </li>
                                    </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </li> -->
            <li class="menu-item ">
                <a href="<?=base_url('product-bosami');?>" class='menu-link'>
                    <i class="bi bi-tags-fill"></i>
                    <span>Produk</span>
                </a>
            </li>
            
            <li class="menu-item  has-sub">
                <a href="#" class='menu-link'>
                    <i class="bi bi-arrow-left-right"></i>
                    <span>Transaksi</span>
                </a>
                <div class="submenu ">
                    <div class="submenu-group-wrapper">
                        <ul class="submenu-group">
                            <li class="submenu-item">
                                <a href="<?=base_url('mutasi/penjualan');?>" class='submenu-link'>&raquo; Penjualan ORI</a>
                            </li>
                            <li class="submenu-item">
                                <a href="<?=base_url('mutasi/penjualan-defect');?>" class='submenu-link'>&raquo; Penjualan defect</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="<?=base_url('mutasi/retur');?>" class='submenu-link'>&laquo; Retur</a>
                            </li>
                            
                        </ul>
                    </div>
                </div>
            </li>
            <?php if($sess_akses=="root"){ ?>
            <li class="menu-item  has-sub">
                <a href="#" class='menu-link'>
                    <i class="bi bi-clipboard2-check"></i>
                    <span>Laporan</span>
                </a>
                <div class="submenu ">
                    <div class="submenu-group-wrapper">
                        <ul class="submenu-group">
                            <li class="submenu-item">
                                <a href="<?=base_url('laporan-cashflow');?>" class='submenu-link'>Cash Flow</a>
                            </li>
                            <li class="submenu-item">
                                <a href="<?=base_url('laporan-penjulan');?>" class='submenu-link'>Penjualan</a>
                            </li>
                            <li class="submenu-item ">
                                <a href="<?=base_url('hutang-piutang');?>" class='submenu-link'>Hutang & Piutang</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
            <li class="menu-item ">
                <a href="<?=base_url('users-account');?>" class='menu-link'>
                    <i class="bi bi-people-fill"></i>
                    <span>Users</span>
                </a>
            </li>
            <?php } ?>
            
            <li class="menu-item " id="logoutMain">
                <a href="<?=base_url('login/logout');?>" class='menu-link'>
                    <i class="bi bi-grid-fill"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </div>
</nav>