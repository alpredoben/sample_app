<?php defined('BASEPATH') OR exit('No direct script access allowed');


/** Admin Root Control */
$route['admin'] = 'admin/AdminController';
$route['admin/produk'] = 'admin/AdminController/view_produk';
$route['admin/mesin']  = 'admin/AdminController/view_mesin';

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

/** Login Validation */
$route['user/login/validate'] = 'AuthController/login_validate';
$route['pages/login']         = 'AuthController/view_login';

$route['default_controller'] = $route['pages/login'];
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
