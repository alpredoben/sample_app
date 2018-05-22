<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model {

    private $tbl_order = 'dto_order';

    public function getRecordOrderBy($order_id, $active_id)
    {
        $select = $this->db->where(array('order_id', $order_id, 'active_id', $active_id))->get($this->tbl_order);
        return ($select->num_rows() > 0) ? $select->result() : false;
    }

    
}

/* End of file Order_model.php */
