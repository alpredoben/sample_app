<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class Sparepart_model extends CI_Model {

    private $tbl_sparepart = 'dto_sparepart';
    private $fields = array('sparepart_id','sparepart_name','create_date', 'update_date');

    public function checkRecordSparepartBy($id, $name)
    {
        $select= $this->db->select('*')
                 ->from($this->tbl_sparepart)
                 ->where('status_data', 0)
                 ->where('sparepart_id', $id)
                 ->or_where('sparepart_name', $name)->get();
        
        return ($select->num_rows() > 0) ? true : false;
    }

    public function insertSparepart($object)
    {
        $insert = $this->db->insert($this->tbl_sparepart, $object);
        return ($insert) ? true : false;
    }


    public function setDataTableSparepart($search = '')
    {
        $this->db->from($this->tbl_sparepart)->where('status_data', 0);
        $i=0;
        foreach ($this->fields as $item) 
        {
            if($search != ''){
                if($i==0){
                    $this->db->group_start();
                    $this->db->like($item, $search);
                }
                else{
                    $this->db->or_like($item, $search);
                }

                if(count($this->fields)-1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        $this->db->order_by('create_date', 'desc');
    }

    function getDataTableSparepart($search='', $length, $start)
    {
        $this->setDataTableSparepart($search);
        
        if($length != -1)
            $this->db->limit($length, $start);

        $query = $this->db->get();
        return $query->result();
    }
 
    public function countRecordSparepart()
    {
        $this->db->from($this->tbl_sparepart)->where('status_data',0);
        return $this->db->count_all_results();
    }

    public function countFilterSparepart($search='')
    {
        $this->setDataTableSparepart($search);
        $query = $this->db->get();
        return $query->num_rows();
    }


    /** Get Product By Id */
    public function getSparepartById($id)
    {
        $select = $this->db->where(array('status_data' => 0, 'sparepart_id' => $id))->get($this->tbl_sparepart);
        return ($select->num_rows() > 0) ? $select->result_array()[0] : false;
        
    }

    public function updateSparepartById($id, $data)
    {
        $update = $this->db->set($data)->where('sparepart_id', $id)->update($this->tbl_sparepart);
        return ($update) ? true : false;
    }

    public function removeSparepartById($id)
    {
        $delete = $this->db->set('status_data', 1)->where('sparepart_id', $id)->update($this->tbl_sparepart);
        return ($delete) ? true : false;
    }

    public function getAllSparepart()
    {
        $select = $this->db->where('status_data', 0)->get($this->tbl_sparepart);
        return ($select->num_rows() > 0) ? $select->result_array() : false;
    }

}

/* End of file Sparepart_model.php */
