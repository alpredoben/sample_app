<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Islog
{
    private $ci;

    public function __construct()
    {
        $this->ci =& get_instance();
        $this->ci->load->library('session');
    }
    

    public function islogin()
    {
        if($this->ci->session->has_userdata('is_login') OR $this->ci->session->userdata('is_login') != TRUE){
            redirect('pages/login','refresh');
        }
    }

    public function session_userdata()
    {
        $all_data = $this->ci->session->all_userdata();
        return $all_data;
    }
}

/* End of file Islog.php */
