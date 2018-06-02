<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Cs_order_model extends CI_Model {

    private $tbl_penawaran = 'dto_penawaran';
    private $tbl_items = 'dto_items';
    private $tbl_kategori = 'dto_kategori';
    private $tbl_user = 'dto_user';
    private $tbl_aktifasi = 'dto_aktifasi';
    private $tbl_stok = 'dto_stok';
    private $tbl_status = 'dto_status';
    private $tbl_po = 'dto_purchase_order';

    private $tbl_customer_order = 'dto_customer_order';

    public function get_category_item($id_kategori = '')
    {
        if(!empty($id_kategori))
            $this->db->where('id_kategori', $id_kategori);
        
        $select = $this->db->get($this->tbl_kategori);
        return ($select->num_rows() > 0 ) ? $select->result_array() : false;
    }


    public function get_record_purchase_order($id_penawaran = '', $id_kategori = '')
    {
        $field = 'po.id, po.po_code, it.kode_item, it.nama_item, pn.kuantitas, pn.diskon, pn.harga_item, kt.nama_kategori';

        $this->db->select($field);
        $this->db->from($this->tbl_penawaran . ' pn');
        $this->db->join($this->tbl_po        . ' po', 'po.id_penawaran = pn.id_penawaran');
        $this->db->join($this->tbl_items     . ' it', 'it.id_item = pn.id_item', 'left');
        $this->db->join($this->tbl_kategori  . ' kt', 'kt.id_kategori = pn.id_kategori', 'left');
        $this->db->join($this->tbl_stok      . ' st', 'st.id_stok = pn.id_stok', 'left');
        $this->db->join($this->tbl_aktifasi  . ' ak', 'ak.id_aktifasi = pn.id_aktifasi', 'left');
        $this->db->join($this->tbl_status    . ' s', 's.id_status = pn.id_status', 'left');
        
        $this->db->where(array(
            'pn.id_aktifasi' => 1,
            'pn.id_stok' => 1,
            'pn.id_status' => 0
        ));

        if(!empty($id_kategori))
            $this->db->where('pn.id_kategori', $id_kategori);

        if(!empty($id_penawaran))
            $this->db->where('pn.id_penawaran', $id_penawaran);
        
        $select = $this->db->get();

        return ($select->num_rows() > 0) ? $select->result_array() : false;
        
    }

    public function get_item_group($id_kategori='')
    {

        $this->db->select('it.kode_item, it.nama_item')->from($this->tbl_penawaran . ' pn');
        $this->db->join($this->tbl_po . ' po', 'po.id_penawaran = pn.id_penawaran');
        $this->db->join($this->tbl_items . ' it', 'it.id_item = pn.id_item');
        $this->db->join($this->tbl_kategori . ' kt', 'kt.id_kategori = pn.id_kategori');

        if(!empty($id_kategori))
            $this->db->where('pn.id_kategori', $id_kategori);    

        $this->db->group_by('it.kode_item');

        $select = $this->db->get();
        return ($select->num_rows() > 0) ? $select->result_array() : false;
    }

    public function get_list_product_item_by($kode_item = '')
    {
        $fields = 'po.id, po.po_code, it.kode_item, it.nama_item, kt.nama_kategori, pn.kuantitas, pn.diskon, pn.harga_item';

        $this->db->select($fields)->from($this->tbl_penawaran . ' pn');
        $this->db->join($this->tbl_po       . ' po', 'po.id_penawaran = pn.id_penawaran');
        $this->db->join($this->tbl_items    . ' it', 'it.id_item = pn.id_item');
        $this->db->join($this->tbl_kategori . ' kt', 'kt.id_kategori = pn.id_kategori');
        $this->db->join($this->tbl_stok     . ' sk', 'sk.id_stok = pn.id_stok');
        $this->db->join($this->tbl_aktifasi . ' ak', 'ak.id_aktifasi = pn.id_aktifasi');
        $this->db->join($this->tbl_status   . ' st', 'st.id_status = pn.id_status');

        $this->db->where(array(
            'pn.id_aktifasi' => 1,
            'pn.id_stok' => 1,
            'pn.id_status' => 0
        ));

        if(!empty($kode_item))
            $this->db->where('it.kode_item', $kode_item);

        $select = $this->db->get();
        return ($select->num_rows() > 0) ? $select->result_array() : false;
    }

    public function get_list_order_by($id_list_item)
    {
        $fields = 'po.id, po.po_code, it.kode_item, it.nama_item, kt.nama_kategori, pn.kuantitas, pn.diskon, pn.harga_item';

        $this->db->select($fields)->from($this->tbl_penawaran . ' pn');
        $this->db->join($this->tbl_po       . ' po', 'po.id_penawaran = pn.id_penawaran');
        $this->db->join($this->tbl_items    . ' it', 'it.id_item = pn.id_item');
        $this->db->join($this->tbl_kategori . ' kt', 'kt.id_kategori = pn.id_kategori');
        $this->db->join($this->tbl_stok     . ' sk', 'sk.id_stok = pn.id_stok');
        $this->db->join($this->tbl_aktifasi . ' ak', 'ak.id_aktifasi = pn.id_aktifasi');
        $this->db->join($this->tbl_status   . ' st', 'st.id_status = pn.id_status');

        $this->db->where(array(
            'pn.id_aktifasi' => 1,
            'pn.id_stok' => 1,
            'pn.id_status' => 0
        ));

        $this->db->where('po.id IN ('.$id_list_item.')');
        $select = $this->db->get();
        return ($select->num_rows() > 0) ? $select->result_array() : false;

    }

    public function add_customer_order($object)
    {
        
        $insert = $this->db->insert_batch($this->tbl_customer_order, $object);
        return ($insert) ? true : false;
    }

}

/* End of file Cs_order_model.php */
