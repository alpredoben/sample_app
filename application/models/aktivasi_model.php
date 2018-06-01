<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Aktivasi_model extends CI_Model {

    private $tbl_penawaran = 'dto_penawaran';
    private $tbl_items = 'dto_items';
    private $tbl_kategori = 'dto_kategori';
    private $tbl_user = 'dto_user';
    private $tbl_aktifasi = 'dto_aktifasi';
    private $tbl_stok = 'dto_stok';
    private $tbl_status = 'dto_status';
    private $tbl_po = 'dto_purchase_order';

    public function set_datatable_aktivasi($search = '', $user_id = '', $id_aktivasi='')
    {
        $fields = 'pn.id_penawaran, it.id_item, it.kode_item, it.nama_item, pn.kuantitas, pn.harga_item, pn.diskon, kt.id_kategori, kt.nama_kategori, s.id_status, s.keterangan, st.id_stok, st.status_stok, ak.id_aktifasi, ak.nama_aktifasi, pn.active_date';

        $this->db->select($fields);
        $this->db->from($this->tbl_penawaran . ' pn');
        $this->db->join($this->tbl_items     . ' it', 'it.id_item = pn.id_item', 'left');
        $this->db->join($this->tbl_kategori  . ' kt', 'kt.id_kategori = pn.id_kategori', 'left');
        $this->db->join($this->tbl_stok      . ' st', 'st.id_stok = pn.id_stok', 'left');
        $this->db->join($this->tbl_aktifasi  . ' ak', 'ak.id_aktifasi = pn.id_aktifasi', 'left');
        $this->db->join($this->tbl_status    . ' s', 's.id_status = pn.id_status', 'left');

        $this->db->where('st.id_stok', 1);
        $this->db->where('s.id_status', 0);

        if(!empty($id_aktivasi))
            $this->db->where('pn.id_aktifasi', $id_aktivasi);

        if(!empty($user_id))
            $this->db->where('pn.user_id', $user_id);
        
        
        $i=0;
        $fields = explode(',', ($fields));
        foreach ($fields as $item) 
        {
            if($search != ''){
                if($i==0){
                    $this->db->group_start();
                    $this->db->like(trim($item), $search);
                }
                else{
                    $this->db->or_like(trim($item), $search);
                }

                if(count($fields)-1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        $this->db->order_by('pn.id_penawaran', 'asc');
    }

    public function get_datatable_aktivasi($search, $length, $start, $user_id='', $id_aktivasi='')
    {
        //$search = '', $user_id = '', $id_aktivasi=''
        $this->set_datatable_aktivasi($search,  $user_id, $id_aktivasi);
        
        if($length != -1)
            $this->db->limit($length, $start);

        $query = $this->db->get();
        return $query->result();
    }

    public function count_record_aktivasi($user_id = '', $id_aktivasi='')
    {
        $this->set_datatable_aktivasi('', $user_id, $id_aktivasi );
        return $this->db->count_all_results();
    }

    public function count_filter_aktivasi($search='', $user_id='', $id_aktivasi='')
    {
        //i
        $this->set_datatable_aktivasi($search, $user_id, $id_aktivasi);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_info_aktivasi($id_aktivasi)
    {
        $select = $this->db->select('*')->from($this->tbl_penawaran)->where('id_aktifasi', $id_aktivasi)->get();
        return ($select->num_rows() > 0) ? $select->result_array() : false;
    }


    /** WAIT ACTIVATED */
    public function set_datatable_wait_aktivated($search = '', $id_aktivasi='', $user_id = '')
    {
        $fields = 'pn.id_penawaran, it.id_item, it.kode_item, it.nama_item, pn.kuantitas, pn.harga_item, pn.diskon, kt.id_kategori, kt.nama_kategori, s.id_status, s.keterangan, st.id_stok, st.status_stok, ak.id_aktifasi, ak.nama_aktifasi, us.user_id, us.username,  pn.active_date';

        $this->db->select($fields);
        $this->db->from($this->tbl_penawaran . ' pn');
        $this->db->join($this->tbl_items     . ' it', 'it.id_item = pn.id_item', 'left');
        $this->db->join($this->tbl_kategori  . ' kt', 'kt.id_kategori = pn.id_kategori', 'left');
        $this->db->join($this->tbl_stok      . ' st', 'st.id_stok = pn.id_stok', 'left');
        $this->db->join($this->tbl_aktifasi  . ' ak', 'ak.id_aktifasi = pn.id_aktifasi', 'left');
        $this->db->join($this->tbl_status    . ' s', 's.id_status = pn.id_status', 'left');
        $this->db->join($this->tbl_user      . ' us', 'us.user_id = pn.user_id', 'left');
        
        $this->db->where('st.id_stok', 1);
        $this->db->where('s.id_status', 0);

        if(!empty($id_aktivasi))
            $this->db->where('pn.id_aktifasi', $id_aktivasi);

        if(!empty($id_kategori))
            $this->db->where('pn.id_kategori', $id_kategori);
        
        if(!empty($user_id))
        $this->db->where('pn.user_id', $user_id);
        
        $i=0;
        $fields = explode(',', ($fields));
        foreach ($fields as $item) 
        {
            if($search != ''){
                if($i==0){
                    $this->db->group_start();
                    $this->db->like(trim($item), $search);
                }
                else{
                    $this->db->or_like(trim($item), $search);
                }

                if(count($fields)-1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        $this->db->order_by('pn.active_date', 'asc');
    }

    public function get_wait_activated($search, $length, $start, $id_aktivasi='', $user_id='')
    {
        $this->set_datatable_wait_aktivated($search, $id_aktivasi, $user_id);
        
        if($length != -1)
            $this->db->limit($length, $start);

        $query = $this->db->get();
        return $query->result();
    }

    public function count_record_wait_aktivasi($id_aktivasi='', $user_id='')
    {
        $this->set_datatable_wait_aktivated('', $id_aktivasi, $user_id);
        return $this->db->count_all_results();
    }

    public function count_filter_wait_aktivasi($search='', $id_aktivasi='', $user_id='')
    {
        $this->set_datatable_wait_aktivated($search, $id_aktivasi, $user_id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function set_activated_item($po_code, $user_id, $id_penawaran, $time_activated)
    {
        $set_data = array(
            'po_code'           => $po_code,
            'id_penawaran'      => $id_penawaran,
            'user_id'           => $user_id,
            'id_aktifasi'       => 1,
            'activation_date'   => $time_activated
        );

        $update = $this->db->set('id_aktifasi', 1)
                           ->where(array('id_penawaran' => $id_penawaran, 'user_id' => $user_id))
                           ->update($this->tbl_penawaran);
        if($update)
        {
            $insert_active = $this->db->insert($this->tbl_po, $set_data);
            return ($insert_active) ? true : false;
        }
        else
        {
            return false;
        }
    }


    /** @param PURCAHSE_ORDER */
    public function set_purchase_order($search='')
    {
        $fields  = 'po.po_code, pn.id_penawaran, it.kode_item, it.nama_item, kt.nama_kategori, pn.kuantitas, pn.diskon, pn.harga_item, ak.nama_aktifasi, st.keterangan, us.username, po.activation_date';

        $this->db->select($fields);
        $this->db->from($this->tbl_penawaran . ' pn');
        $this->db->join($this->tbl_po        . ' po', 'po.id_penawaran = pn.id_penawaran');
        $this->db->join($this->tbl_items     . ' it', 'it.id_item = pn.id_item');
        $this->db->join($this->tbl_aktifasi  . ' ak', 'ak.id_aktifasi = pn.id_aktifasi');
        $this->db->join($this->tbl_kategori  . ' kt', 'kt.id_kategori = pn.id_kategori');
        $this->db->join($this->tbl_status    . ' st', 'st.id_status = pn.id_status');
        $this->db->join($this->tbl_user      . ' us', 'us.user_id = pn.user_id');
        
        $i=0;
        $fields = explode(',', ($fields));
        foreach ($fields as $item) 
        {
            if($search != ''){
                if($i==0){
                    $this->db->group_start();
                    $this->db->like(trim($item), $search);
                }
                else{
                    $this->db->or_like(trim($item), $search);
                }

                if(count($fields)-1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        $this->db->order_by('po.po_code', 'asc');

    }

    public function get_purchase_order($search='', $length='', $start='')
    {
        $this->set_purchase_order($search);
        
        if($length != -1)
            $this->db->limit($length, $start);

        $query = $this->db->get();
        return $query->result();
    }

    public function count_record_po($search='')
    {
        $this->set_purchase_order($search);
        return $this->db->count_all_results();
    }

    public function count_filter_po($search='')
    {
        $this->set_purchase_order($search);
        $query = $this->db->get();
        return $query->num_rows();
    }

}

/* End of file Aktivasi_model.php */
