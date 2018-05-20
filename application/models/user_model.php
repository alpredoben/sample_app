<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    private $tbl_user = 'dto_user';
    private $tbl_level = 'dto_level';

    public function getRecordUserAccess($id, $pwd)
    {
        $fields = 'u.id, u.username, u.password, l.level_id, l.level_name';
        $select = $this->db->select($fields)->from($this->tbl_user. ' u')
                           ->join($this->tbl_level.' l', 'l.level_id = u.level_id')
                           ->where('u.user_id', $id)
                           ->where('u.password', $pwd)
                           ->get();

        return ($select->num_rows() > 0) ? $select->result()[0] : false;
    }

}

/* End of file User_model.php */
