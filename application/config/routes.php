<?php defined('BASEPATH') OR exit('No direct script access allowed');

/** ROUTES ADMIN */
$route['admin/dashboard'] = 'admin/AdminController/dashboard';
$route['admin/keluar']    = 'admin/AdminController/keluar';

$route['admin/master/item/kopi'] = 'admin/AdminController/view_master_item_kopi';
$route['admin/master/item/mesin'] = 'admin/AdminController/view_master_item_mesin';
$route['admin/master/item/sparepart'] = 'admin/AdminController/view_master_item_sparepart';


$route['admin/master/item/insert/item/(:any)']           = 'service/MasterItem/save_item/$1';
$route['admin/master/item/update/item/(:any)']           = 'service/MasterItem/edit_item/$1';
$route['admin/master/item/select/item/(:any)/by/(:any)'] = 'service/MasterItem/show_item/$1/$2';
$route['admin/master/item/delete/item/(:any)/by/(:any)'] = 'service/MasterItem/remove_item/$1/$2';
$route['admin/master/item/datatable/item/(:any)']        = 'service/MasterItem/datatable_item/$1';

/** SALES ROUTE */
$route['sales/dashboard'] = 'sales/SalesController/dashboard';
$route['sales/master/penawaran'] = 'sales/SalesController/view_master_penawaran';
$route['sales/master/penawaran/item/(:any)'] = 'sales/SalesController/load_master_penawaran/$1';

$route['sales/master/penawaran/insert/item/(:any)']          = 'service/MasterPenawaran/';
$route['sales/master/penawaran/delete/item/(:any)']          = 'service/MasterPenawaran/';
$route['sales/master/penawaran/update/activate/item/(:any)'] = 'service/MasterPenawaran/';
$route['sales/master/penawaran/datatable/item/(:any)']       = 'service/MasterPenawaran/';

/** SALES ROOT CONTROL */




$route['sales/master/penawaran/set/wait/active/item/(:any)/by/(:any)'] = 'service/MasterOfferingController/set_wait_active/$1/$2';

$route['sales/master/penawaran/hapus/item/(:any)/by/(:any)'] = 'service/MasterOfferingController/delete_offer_item/$1/$2';



$route['sales']                     = 'sales/SalesController';
$route['sales/keluar']              = 'sales/SalesController/logout';
$route['sales/form_penawaran']      = 'sales/SalesController/view_form_penawaran';
$route['sales/load_form_produk']    = 'sales/SalesController/load_form_produk';
$route['sales/load_form_mesin']     = 'sales/SalesController/load_form_mesin';
$route['sales/load_form_sparepart']     = 'sales/SalesController/load_form_sparepart';

/** Service Sales */
$route['sales/penawaran/tambah/produk/kopi']     = 'service/OfferController/tambah_penawaran_produk';
$route['sales/penawaran/datatable/produk/kopi']  = 'service/OfferController/datatable_penawaran_produk';
$route['sales/penawaran/hapus/produk/kopi/(:any)'] = 'service/OfferController/hapus_penawaran_produk/$1';
$route['sales/penawaran/set/wait/active/(:any)/(:any)'] = 'service/OfferController/set_wait_active/$1/$2';

/** Machine Offer Route */
$route['sales/penawaran/tambah/mesin'] = 'service/OfferController/tambah_penawaran_mesin';
$route['sales/penawaran/datatable/mesin'] = 'service/OfferController/datatable_penawaran_mesin';
$route['sales/penawaran/hapus/mesin/(:any)'] = 'service/OfferController/hapus_penawaran_mesin/$1';

/** Sparepart Offer Route */ 
$route['sales/penawaran/tambah/sparepart'] = 'service/OfferController/tambah_penawaran_sparepart';
$route['sales/penawaran/datatable/sparepart'] = 'service/OfferController/datatable_penawaran_sparepart';
$route['sales/penawaran/hapus/sparepart/(:any)'] = 'service/OfferController/hapus_penawaran_sparepart/$1';
//sales/penawaran/tampil/item/produk/by/1
$route['sales/penawaran/tampil/item/(:any)/by/(:any)'] = 'service/OfferController/tampil_items/$1/$2';

$route['sales/tampil/data/produk'] = 'service/ProductController/tampil_produk';

/** Login Validation */
$route['user/login/validate'] = 'AuthController/login_validate';
$route['pages/login']         = 'AuthController/view_login';

$route['default_controller'] = $route['pages/login'];
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
