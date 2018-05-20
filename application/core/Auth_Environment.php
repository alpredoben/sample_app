<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_Environment extends CI_Controller {

    var $_container;
    var $_modules;

    protected $default_scripts;
    protected $default_styles;

    public function __construct()
    {
        parent::__construct();
        
        $this->_container = $this->config->item('auth_root');
        
        if($this->session->userdata('is_login') == true){
            redirect(strtolower($this->session->userdata('level_name')), 'refresh');
        }
        
        log_message('debug', 'AuthenticObject : Login Layout');
    }
    
    public function render($page='', $data)
    {
        if($page == '')
            $this->load->view($this->_container, $data);
        else
            $this->load->view($this->_container . $page, $data);
    }

    public function set_response($status, $data=null, $optional=null, $code=200)
    {
        $array = array(
            'status'   => ($status!=null) ? $status : false,
            'messages' => ($data!=null) ? $data : 'Tidak Ada Respon Data' 
        );

        if($optional != null)
            $array['optional'] = $optional;

        return $this->output->set_content_type('application/json')->set_status_header($code)->set_output(json_encode($array));
    }

}

/* End of file Auth_Environment.php */
