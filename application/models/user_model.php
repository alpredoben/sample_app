<?php  defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/models/config_manager_model.php';

class User_model extends Config_manager_model {

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

}

/* End of file User_model.php */
