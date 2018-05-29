<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class MasterUser extends Web_Environment {

    
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model(array(
            'user_model'
        ));
    }
    

    public function get_user_by($level_id)
    {
        $user = $this->user_model->get_user_by($level_id);
        if($user != false)
            $this->set_response(true, $user);
        else
            $this->set_response(false, 'No record data user');

    }

}

/* End of file MasterUser.php */
