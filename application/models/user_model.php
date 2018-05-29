<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public $tbl_user = 'dto_user';
    public $tbl_level = 'dto_level';

    public function getRecordUserAccess($id, $pwd)
    {
        $fields = 'u.id, u.user_id, u.username, u.password, l.level_id, l.level_name';
        $select = $this->db->select($fields)->from($this->tbl_user. ' u')
                           ->join($this->tbl_level.' l', 'l.level_id = u.level_id')
                           ->where('u.user_id', $id)
                           ->where('u.password', $pwd)
                           ->get();

        return ($select->num_rows() > 0) ? $select->result_array()[0] : false;
    }


    public function get_user_by($level_id)
    {
        $fields = 'U.user_id, U.level_id, L.level_name, U.username, U.password';
        $this->db->select($fields)->from($this->tbl_user.' U');
        $this->db->join($this->tbl_level. ' L' , 'U.level_id = L.level_id', 'left');
        $select = $this->db->where('U.level_id', $level_id)->get();
        return ($select->num_rows() > 0) ? $select->result_array() : false;
    }
}
