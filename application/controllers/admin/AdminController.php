<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends Web_Environment {

    private $root_adm;

    public function __construct()
    {
        parent::__construct();
        $this->root_adm = $this->config->item(
            strtolower($this->session->userdata('level_name')).'_root'
        );
    }
    
    
    public function index()
    {
        $data = $this->get_default('ADMIN - DASHBOARD');

        $data['scripts']  = $this->getScripts();
        $data['styles']   = $this->getStyles();
        $data['pages']    = $this->root_adm . 'pages/dashboard';
        $data['side_nav'] = $this->root_adm . 'pages/admin_side_nav';
        $data['content']  = $this->root_adm . 'pages/admin_dashboard';

		$this->render('admin_layout', $data);
    }

}

/* End of file AdminController.php */
