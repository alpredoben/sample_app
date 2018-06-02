<?php defined('BASEPATH') OR exit('No direct script access allowed');

/** ROUTES ADMIN */
$route['admin/dashboard'] = 'admin/AdminController/dashboard';
$route['admin/keluar']    = 'admin/AdminController/keluar';

$route['admin/master/item/kopi'] = 'admin/AdminController/view_master_item_kopi';
$route['admin/master/item/mesin'] = 'admin/AdminController/view_master_item_mesin';
$route['admin/master/item/sparepart'] = 'admin/AdminController/view_master_item_sparepart';

//sales/master/penawaran/insert/item/
$route['admin/master/item/insert/item/(:any)']           = 'service/MasterItem/save_item/$1';
$route['admin/master/item/update/item/(:any)']           = 'service/MasterItem/edit_item/$1';
$route['admin/master/item/select/item/(:any)/by/(:any)'] = 'service/MasterItem/show_item/$1/$2';
$route['admin/master/item/delete/item/(:any)/by/(:any)'] = 'service/MasterItem/remove_item/$1/$2';
$route['admin/master/item/datatable/item/(:any)']        = 'service/MasterItem/datatable_item/$1';

/** SALES ROUTE */
$route['sales/dashboard'] = 'sales/SalesController/dashboard';
$route['sales/logout'] = 'sales/SalesController/logout';
$route['sales/master/penawaran'] = 'sales/SalesController/view_master_penawaran';
$route['sales/master/penawaran/item/(:any)'] = 'sales/SalesController/load_master_penawaran/$1';
$route['sales/aktivasi_penawaran'] = 'sales/SalesController/load_aktivasi_penawaran';

$route['sales/master/penawaran/insert/item/(:any)']                  = 'service/MasterPenawaran/save_item_penawaran/$1';
$route['sales/master/penawaran/delete/item/(:any)/by/(:any)']        = 'service/MasterPenawaran/remove_item_penawaran/$1/$2';
$route['sales/master/penawaran/set/activate/item/(:any)/by/(:any)']  = 'service/MasterPenawaran/set_aktivasi_item/$1/$2';
$route['sales/master/penawaran/datatable/item/(:any)/(:any)']               = 'service/MasterPenawaran/master_datatable_penawaran/$1/$2';
$route['sales/master/penawaran/select/item/(:any)/by/(:any)']        = 'service/MasterPenawaran/get_list_item_penawaran/$1/$2';
$route['sales/master/penawaran/update/item/(:any)']                  = 'service/MasterPenawaran/update_item_penawaran/$1/$2';

$route['sales/master/aktivasi_penawaran/(:any)/item'] = 'service/MasterAktivasi/master_aktivasi_sales/$1';

/** ################################################## TAMBAHAN ########################################## */

// $route['admin/master/view/info/aktivasi'] = 'admin/AdminController/view_info_aktivasi';
$route['admin/info/aktifasi'] = 'service/MasterAktivasi/get_info_aktivasi';
$route['admin/data/user/by/(:any)'] = 'service/MasterUser/get_user_by/$1';

$route['admin/master/set/item/actived'] = 'service/MasterAktivasi/set_item_activated';

$route['admin/master/validasi/aktivasi'] = 'service/MasterAktivasi/show_datatable_aktivasi';
$route['admin/master/validasi/aktivasi/(:any)'] = 'service/MasterAktivasi/show_datatable_aktivasi/$1';
$route['admin/master/validasi/aktivasi/(:any)/user/(:any)'] = 'service/MasterAktivasi/show_datatable_aktivasi/$1/$2';

$route['admin/master/aktivasi/po'] = 'service/MasterAktivasi/purchase_order';


/** ############################# @param CUSTOMER #################################### */
$route['customer/dashboard']        = 'customer/CustomerController/view_app';
$route['customer/app/logout']       = 'customer/CustomerController/logout';
$route['customer/app/order']        = 'customer/CustomerController/view_app';
$route['customer/app/list/order']   = 'customer/CustomerController/view_list_order';
$route['customer/app/list/category']= 'service/CustomerOrder/get_list_category';
$route['customer/app/list/group_item'] = 'service/CustomerOrder/get_list_group_item';
$route['customer/app/list/product/by/(:any)'] = 'service/CustomerOrder/get_list_product/$1';
$route['customer/app/add/order/item'] = 'service/CustomerOrder/add_order_item';

$route['customer/app/get/cart/order/item'] = 'service/CustomerOrder/get_data_cart_order';


/** Login Validation */
$route['user/login/validate'] = 'AuthController/login_validate';
$route['pages/login']         = 'AuthController/view_login';

$route['default_controller'] = $route['pages/login'];
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
