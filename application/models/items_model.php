<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class Items_model extends CI_Model {

    public $item_fields = array('kode_item', 'nama_item','create_date', 'update_date'); 
    public $tbl_items = 'dto_items';

    public function get_list_item_by($type_id)
    {
        $select = $this->db->where(array('id_kategori' => $type_id, 'id_status' => 0))->get($this->tbl_items);
        return ($select->num_rows() > 0) ? $select->result_array() : false;
    }

    public function check_record_item_by($types, $id, $name)
    {
        $this->db->where(array(
            'id_kategori' => $types,
            'id_status' => 0,
        ));

        $this->db->where('kode_item', $types);
        $this->db->or_where('nama_item', $name);

        $select = $this->db->get($this->tbl_items);
        return ($select->num_rows() > 0) ? true : false;
    }

    public function insert_data_item($object)
    {
        $insert = $this->db->insert($this->tbl_items, $object);
        return ($insert) ? true : false;
    }

    public function update_data_item($object, $condition)
    {
        $update = $this->db->where($condition)->update($this->tbl_items, $object);
        return ($update) ? true : false;
    }

    public function delete_data_item($condition)
    {
        $delete = $this->db->set('id_status', 1)->where($condition)->update($this->tbl_items);
        return ($delete) ? true : false;
    }

    public function select_data_item($condition)
    {
        $this->db->select('*');
        $this->db->from($this->tbl_items);
        $this->db->where('id_status',0);
        $this->db->where($condition);
        $select = $this->db->get();
        return ($select->num_rows() > 0) ? $select->result_array()[0] : false;
    }

    /** DATATABLE */
    public function set_datatable_item($types, $search = '')
    {
        $this->db->from($this->tbl_items)->where(array('id_status' => 0, 'id_kategori' => $types));
        $i=0;
        foreach ($this->item_fields as $item) 
        {
            if($search != ''){
                if($i==0){
                    $this->db->group_start();
                    $this->db->like($item, $search);
                }
                else{
                    $this->db->or_like($item, $search);
                }

                if(count($this->item_fields)-1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        $this->db->order_by('create_date', 'desc');
    }


    public function get_datatable_item($types, $search, $length, $start)
    {
        $this->set_datatable_item($types, $search);
        if($length != -1)
            $this->db->limit($length, $start);

        $query = $this->db->get();
        return $query->result();
    }

    public function count_record_item($types)
    {
        $this->db->from($this->tbl_items)->where(array('id_status' => 0, 'id_kategori' => $types));
        return $this->db->count_all_results();
    }

    public function count_record_filter_item($types, $search)
    {
        $this->set_datatable_item($types, $search);
        $query = $this->db->get();
        return $query->num_rows();
    }
}

/* End of file Items_model.php */
