<?php defined('BASEPATH') OR exit('No direct script access allowed');


/** Admin Root Control */
$route['admin']                     = 'admin/AdminController';
$route['admin/keluar']              = 'admin/AdminController/logout';
$route['admin/produk']              = 'admin/AdminController/view_produk';
$route['admin/mesin']               = 'admin/AdminController/view_mesin';
$route['admin/sparepart']           = 'admin/AdminController/view_sparepart';
$route['admin/aktivitas_pesanan']   = 'admin/AdminController/view_aktivitas_pesanan';


/** Service Admin Product */
$route['admin/produk/tambah/produk']       = 'service/ProductController/tambah_produk';
$route['admin/produk/list/produk']         = 'service/ProductController/datatable_produk';
$route['admin/produk/show/produk/(:any)']  = 'service/ProductController/show_produk/$1';
$route['admin/produk/ubah/produk']         = 'service/ProductController/ubah_produk';
$route['admin/produk/hapus/produk/(:any)'] = 'service/ProductController/hapus_produk/$1';

/** Service Admin Machine */
$route['admin/mesin/tambah/mesin']         = 'service/MachineController/tambah_mesin';
$route['admin/mesin/list/mesin']           = 'service/MachineController/datatable_mesin';
$route['admin/mesin/show/mesin/(:any)']    = 'service/MachineController/show_mesin/$1';
$route['admin/mesin/ubah/mesin']           = 'service/MachineController/ubah_mesin';
$route['admin/mesin/hapus/mesin/(:any)']   = 'service/MachineController/hapus_mesin/$1';


/** Service Sparepart Machine */
$route['admin/sparepart/tambah/sparepart']         = 'service/SparepartController/tambah_sparepart';
$route['admin/sparepart/list/sparepart']           = 'service/SparepartController/datatable_sparepart';
$route['admin/sparepart/show/sparepart/(:any)']    = 'service/SparepartController/show_sparepart/$1';
$route['admin/sparepart/ubah/sparepart']           = 'service/SparepartController/ubah_sparepart';
$route['admin/sparepart/hapus/sparepart/(:any)']   = 'service/SparepartController/hapus_sparepart/$1';



/** SALES ROOT CONTROL */
$route['sales']                     = 'sales/SalesController';
$route['sales/keluar']              = 'sales/SalesController/logout';
$route['sales/form_pemesanan']      = 'sales/SalesController/view_form_pemesanan';


/** Login Validation */
$route['user/login/validate'] = 'AuthController/login_validate';
$route['pages/login']         = 'AuthController/view_login';

$route['default_controller'] = $route['pages/login'];
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
