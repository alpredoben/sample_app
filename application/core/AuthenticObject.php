<?php defined('BASEPATH') OR exit('No direct script access allowed');

class AuthenticObject extends CI_Controller {

    var $_container;
    var $_modules;

    public function __construct()
    {
        parent::__construct();
        
        $this->_container = $this->config->item('auth_root');
        log_message('debug', 'AuthenticObject : Login Layout');
    }
    
    public function render($page='', $data)
    {
        if($page == '')
            $this->load->view($this->_container, $data);
        else
            $this->load->view($this->_container . $page, $data);
    }

}

/* End of file AuthenticObject.php */
