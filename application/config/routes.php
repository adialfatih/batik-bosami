<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller']    = 'beranda';
$route['dashboard']             = 'beranda';
$route['home']                  = 'beranda';
$route['data-kain']             = 'beranda/kndata';
$route['data-penjahit']         = 'beranda/penjahitdata';
$route['data-tukang-potong']    = 'beranda/ptgdata';
$route['data-pembatik']         = 'beranda/pmbtkdata';
$route['data-jenis-babaran']    = 'beranda/jnsbarbar';
$route['data-produk']           = 'beranda/dataproduk';

$route['product-bosami']        = 'produk/produkdata';
$route['product-bosami-charts'] = 'produk/produkdata2';
$route['image-produks']         = 'produk/upload_file';

$route['data-karyawan']         = 'karyawan/datakar';
$route['users-account']         = 'karyawan/dataakses';

$route['pembelian-kain']        = 'transaksi/pembeliankain';
$route['stok-kain-real']        = 'transaksi/stokkain';
$route['stok-kain-potongan']    = 'transaksi/stokkain2';
$route['stok-kain-batik']       = 'transaksi/stokkainbatik';
$route['pemotongan-kain']       = 'transaksi/potongkain';

$route['persiapan-produksi']    = 'transaksi2/produksi1';
$route['jahit']                 = 'transaksi2/produksi2';
$route['simpan-pembayaran']     = 'mutasi/simpanprosesbayar';
$route['invoice/(:any)']        = 'cetak/invoice';

$route['stok-produksi']         = 'transaksi4/stokkainproduksi';
$route['mutasi/retur']          = 'mutasi2/returbarang';
$route['mutasi/retur-produk']   = 'mutasi2/returbarangv2';

$route['save-pembelian']            = 'proses/simpanpembeliankain';
$route['simpan-babaran']            = 'proses/simpanbabar';
$route['mutasi/penjualan-defect']   = 'mutasi/penjualanbs';

$route['laporan-cashflow']          = 'laporan/cashflow';

$route['404_override']          = 'Notfounde';
$route['translate_uri_dashes']  = FALSE;

/*
| -------------------------------------------------------------------------
| Sample REST API Routes
| -------------------------------------------------------------------------
*/

$route['api/example/users/(:num)']                          = 'api/example/users/id/$1'; // Example 4
$route['api/example/users/(:num)(\.)([a-zA-Z0-9_-]+)(.*)']  = 'api/example/users/id/$1/format/$3$4'; // Example 8
