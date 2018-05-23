<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class Machine_model extends CI_Model {

    private $tbl_machine = 'dto_machine';
    private $fields = array('machine_id','machine_name','create_date', 'update_date');

    public function checkRecordMachineBy($id, $name)
    {
        $select= $this->db->select('*')
                 ->from($this->tbl_machine)
                 ->where('status_data', 0)
                 ->where('machine_id', $id)
                 ->or_where('machine_name', $name)->get();
        
        return ($select->num_rows() > 0) ? true : false;
    }

    public function insertMachine($object)
    {
        $insert = $this->db->insert($this->tbl_machine, $object);
        return ($insert) ? true : false;
    }


    public function setDataTableMachine($search = '')
    {
        $this->db->from($this->tbl_machine)->where('status_data', 0);
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

    function getDataTableMachine($search='', $length, $start)
    {
        $this->setDataTableMachine($search);
        
        if($length != -1)
            $this->db->limit($length, $start);

        $query = $this->db->get();
        return $query->result();
    }
 
    public function countRecordMachine()
    {
        $this->db->from($this->tbl_machine)->where('status_data',0);
        return $this->db->count_all_results();
    }

    public function countFilterMachine($search='')
    {
        $this->setDataTableMachine($search);
        $query = $this->db->get();
        return $query->num_rows();
    }


    /** Get Product By Id */
    public function getMachineById($id)
    {
        $select = $this->db->where(array('status_data' => 0, 'machine_id' => $id))->get($this->tbl_machine);
        return ($select->num_rows() > 0) ? $select->result_array()[0] : false;
        
    }

    public function updateMachineById($id, $data)
    {
        $update = $this->db->set($data)->where('machine_id', $id)->update($this->tbl_machine);
        return ($update) ? true : false;
    }

    public function removeMachineById($id)
    {
        $delete = $this->db->set('status_data', 1)->where('machine_id', $id)->update($this->tbl_machine);
        return ($delete) ? true : false;
    }

    public function getAllMachine()
    {
        $select = $this->db->where('status_data', 0)->get($this->tbl_machine);
        return ($select->num_rows() > 0) ? $select->result_array() : false;
    }

}

/* End of file Machine_model.php */
