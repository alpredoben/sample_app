<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class CustomerController extends Web_Environment {
    
    private $root_adm;

    public function __construct()
    {
        parent::__construct();

        $this->load->library('session');
    
        if($this->session->has_userdata('is_login') OR $this->session->userdata('is_login') == TRUE) {
            $this->root_adm = $this->config->item(strtolower($this->session->userdata('nama_level_pengguna')).'_root');
        }
        else {
            redirect('pages/login','refresh');
        }
        
        //$this->load->model(array(''));
        
    }

    public function get_default()
    {
        return array(
            'title'       => 'PT. COFFINDO',
            'subtitle'    => '',
            'login_level' => $this->session->userdata('nama_level_pengguna'),
            'login_name'  => $this->session->userdata('nama_pengguna'),
            'side_nav'    => $this->root_adm . 'pages/admin_side_nav',
        );
    }

    public function view_app()
    {
        $data = $this->get_default();
        $data['subtitle'] = 'WELCOME TO APP';
        $data['content_title'] = 'ORDER ITEM';
        $data['content']  = $this->root_adm . 'pages/cs_order';
        $data['scripts']  = 'assets/web/js/cs/order_cs.js';
        $this->render($this->root_adm . 'customer_layout', $data);
    }

    public function view_list_order()
    {
        $data = $this->get_default();
        $data['subtitle'] = 'WELCOME TO XXXX';
        $data['content']  = $this->root_adm . 'pages/cs_list_order';
        $data['scripts']  = 'assets/web/js/cs/order_cs.js';
        $this->render($this->root_adm . 'customer_layout', $data);
    }

    public function logout()
    {
        $this->session->sess_destroy();
		redirect('pages/login','refresh');
    }

}

