<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends Web_Environment {

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
        
        $this->load->model(array('aktivasi_model'));
        
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

    /** View Data */
    public function dashboard()
    {
        $data = $this->get_default();
        $data['subtitle'] = 'ADMIN - DASHBOARD';
        $data['content']  = $this->root_adm . 'pages/admin_dashboard';
		$this->render($this->root_adm . 'admin_layout', $data);
    }

    public function view_master_item_kopi()
    {
        $data = $this->get_default(); 
        $data['subtitle'] = 'MASTER ITEM KOPI';
        $data['nama_item'] = 'Kopi';
        $data['content']  = $this->root_adm . 'pages/admin_master_item';
        $data['scripts']  = 'assets/web/js/adm/master_items.js';
		$this->render($this->root_adm .'admin_layout', $data);
    }

    public function view_master_item_mesin()
    {
        $data = $this->get_default(); 
        $data['subtitle'] = 'MASTER DATA MESIN';
        $data['nama_item'] = 'Mesin';
        $data['content']  = $this->root_adm . 'pages/admin_master_item';
        $data['scripts']  = 'assets/web/js/adm/master_items.js';
		$this->render($this->root_adm . 'admin_layout', $data);
    }

    public function view_master_item_sparepart()
    {
        $data = $this->get_default(); 
        $data['subtitle']  = 'MASTER DATA SPAREPART';
        $data['nama_item'] = 'Sparepart';
        $data['content']   = $this->root_adm . 'pages/admin_master_item';
        $data['scripts']   = 'assets/web/js/adm/master_items.js';
		$this->render($this->root_adm . 'admin_layout', $data);
    }

    public function view_info_aktivasi()
    {
        $data = $this->get_default(); 
        $data['subtitle'] = 'VALIDASI PENAWARAN';
        $data['content']  = $this->root_adm . 'pages/validasi_aktivasi';
        $data['scripts']  = 'assets/web/js/adm/validasi_aktivasi.js';
		$this->render($this->root_adm . 'admin_layout', $data);
    }

    
    public function keluar()
	{
		$this->session->sess_destroy();
		redirect('pages/login','refresh');
		
	}

    
}

/* End of file AdminController.php */
