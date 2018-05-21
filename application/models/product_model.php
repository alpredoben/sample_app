<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

    private $tbl_product = 'dto_product';
    private $fields = array('product_id','product_name','create_date', 'update_date');

    public function checkRecordProductBy($id, $name)
    {
        $select= $this->db->select('*')
                 ->from($this->tbl_product)
                 ->where('status_data', 0)
                 ->where('product_id', $id)
                 ->or_where('product_name', $name)->get();
        
        return ($select->num_rows() > 0) ? true : false;
    }

    public function insertProduct($object)
    {
        $insert = $this->db->insert($this->tbl_product, $object);
        return ($insert) ? true : false;
    }


    public function setDataTableProduct($search = '')
    {
        $this->db->from($this->tbl_product)->where('status_data', 0);
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

    function getDataTableProduct($search='', $length, $start)
    {
        $this->setDataTableProduct($search);
        
        if($length != -1)
            $this->db->limit($length, $start);

        $query = $this->db->get();
        return $query->result();
    }
 
    public function countRecordProduct()
    {
        $this->db->from($this->tbl_product)->where('status_data',0);
        return $this->db->count_all_results();
    }

    public function countFilterProduct($search='')
    {
        $this->setDataTableProduct($search);
        $query = $this->db->get();
        return $query->num_rows();
    }


    /** Get Product By Id */
    public function getProductById($id)
    {
        $select = $this->db->where(array('status_data' => 0, 'product_id' => $id))->get($this->tbl_product);
        return ($select->num_rows() > 0) ? $select->result_array()[0] : false;
        
    }

    public function updateProductById($id, $data)
    {
        $update = $this->db->set($data)->where('product_id', $id)->update($this->tbl_product);
        return ($update) ? true : false;
    }

    public function removeProductById($id)
    {
        $delete = $this->db->set('status_data', 1)->where('product_id', $id)->update($this->tbl_product);
        return ($delete) ? true : false;
    }

}

/* End of file Product_model.php */
