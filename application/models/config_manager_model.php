<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Config_manager_model extends CI_Model {

    public  $tbl_user = 'dto_user',
            $tbl_level = 'dto_level',
            $tbl_aktifasi = 'dto_aktifasi',
            $tbl_kategori = 'dto_kategori',
            $tbl_penawaran = 'dto_penawaran',
            $tbl_stok = 'dto_stok',
            $tbl_status = 'dto_status',
            $tbl_items = 'dto_items';


    /** Filter Field */
    public $item_fields = array('kode_item', 'nama_item','create_date', 'update_date');    

}

/* End of file Config_manager_model.php */
