<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class Penawaran_model extends CI_Model {

    public $offer_fields = array(
        'pn.id_penawaran', 'it.id_item', 'it.kode_item', 'it.nama_item', 'pn.kuantitas', 'kt.nama_kategori', 
        'pn.harga_item', 'pn.diskon', 'ak.nama_aktifasi', 'pn.create_date', 'pn.update_date'
    );

    public $tbl_penawaran = 'dto_penawaran';
    public $tbl_items = 'dto_items';
    public $tbl_kategori = 'dto_kategori';
    public $tbl_stok = 'dto_stok';
    public $tbl_aktifasi = 'dto_aktifasi';
    public $tbl_status = 'dto_status';
    

    
    /** DataTable Item Penawaran */
    public function set_datatable_penawaran($types_id, $search = '')
    {
        $this->db->select($this->offer_fields);
        $this->db->from($this->tbl_penawaran . ' pn');
        $this->db->join($this->tbl_items     . ' it', 'it.id_item = pn.id_item', 'left');
        $this->db->join($this->tbl_kategori  . ' kt', 'kt.id_kategori = pn.id_kategori', 'left');
        $this->db->join($this->tbl_stok      . ' st', 'st.id_stok = pn.id_stok', 'left');
        $this->db->join($this->tbl_aktifasi  . ' ak', 'ak.id_aktifasi = pn.id_aktifasi', 'left');
        $this->db->join($this->tbl_status    . ' s', 's.id_status = pn.id_status', 'left');

        $this->db->where(array(
            'ak.id_aktifasi' => 4, 
            'st.id_stok' => 1, 
            's.id_status' => 0,
            'kt.id_kategori' => $types_id
        ));
        
        $i=0;
        foreach ($this->offer_fields as $item) 
        {
            if($search != ''){
                if($i==0){
                    $this->db->group_start();
                    $this->db->like($item, $search);
                }
                else{
                    $this->db->or_like($item, $search);
                }

                if(count($this->offer_fields)-1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        $this->db->order_by('pn.create_date', 'desc');
    }

    public function get_datatable_penawaran($types_id, $search, $length, $start)
    {
        $this->set_datatable_penawaran($types_id, $search);
        
        if($length != -1)
            $this->db->limit($length, $start);

        $query = $this->db->get();
        return $query->result();
    }

    public function count_record_penawaran($types_id)
    {
        $this->set_datatable_penawaran($types_id);
        return $this->db->count_all_results();
    }

    public function count_filter_penawaran($types_id, $search)
    {
        $this->set_datatable_penawaran($types_id, $search);
        $query = $this->db->get();
        return $query->num_rows();
    }

    /** Insert Item Penawaran */
    public function insert_data_penawaran($object)
    {
        $insert = $this->db->insert($this->tbl_penawaran, $object);
        return ($insert) ? true : false;
    }


    /** Delete Item Penawaran */
    public function delete_data_penawaran($types_id, $id)
    {
        $delete = $this->db->set('id_status', 1)
                           ->where(array('id_kategori' => $types_id, 'id_penawaran' => $id))
                           ->update($this->tbl_penawaran);
        return ($delete) ? true : false;
    }

    /** Set Aktivasi Item Penawaran */
    public function set_aktivasi_item($type_id, $datetime, $id)
    {
        $this->db->set(array(
            'id_aktifasi' => 2,
            'active_date' => $datetime
        ));
        
        $this->db->where(array(
            'id_status' => 0,
            'id_kategori' => $type_id,
            'id_penawaran' => $id
        ));
        $aktifasi = $this->db->update($this->tbl_penawaran);
        return ($aktifasi) ? true : false;
    }


    /** Select One Record Only Item Penawaran */
    public function get_record_item_by($types_id, $id)
    {
        $field = 'pn.id_penawaran, it.id_item, it.nama_item, pn.kuantitas, pn.harga_item, pn.diskon, pn.id_kategori';

        $this->db->select($field);
        $this->db->from($this->tbl_penawaran . ' pn');
        $this->db->join($this->tbl_items     . ' it', 'it.id_item = pn.id_item', 'left');
        
        $this->db->where(array(
            'pn.id_penawaran' => $id,
            'pn.id_kategori' => $types_id
        ));

        $select = $this->db->get();
        return ($select->num_rows() > 0) ? $select->result_array()[0] : false;
    }

    public function update_data_penawaran($id, $data)
    {
        $this->db->set($data);
        $update = $this->db->where('id_penawaran', $id)->update($this->tbl_penawaran);
        return ($update) ? true : false ;
    }
}

/* End of file Items_model.php */
