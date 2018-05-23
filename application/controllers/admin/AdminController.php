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
        
        $this->load->model(array('product_model'));   
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
    public function index()
    {
        $data = $this->get_default();
        $data['subtitle'] = 'ADMIN - DASHBOARD';
        $data['content']  = $this->root_adm . 'pages/admin_dashboard';
		$this->render($this->root_adm . 'admin_layout', $data);
    }

    public function view_produk()
    {
        $data = $this->get_default(); 
        $data['subtitle'] = 'MASTER PRODUK KOPI';
        $data['content']  = $this->root_adm . 'pages/admin_product';
        $data['scripts']  = 'assets/web/js/item/product.js';
		$this->render($this->root_adm .'admin_layout', $data);
    }

    public function view_mesin()
    {
        $data = $this->get_default(); 
        $data['subtitle'] = 'MASTER DATA MESIN';
        $data['content']  = $this->root_adm . 'pages/admin_machine';
        $data['scripts']  = 'assets/web/js/item/machine.js';
		$this->render($this->root_adm . 'admin_layout', $data);
    }

    public function view_sparepart()
    {
        $data = $this->get_default(); 
        $data['subtitle'] = 'MASTER DATA SPAREPART';
        $data['content']  = $this->root_adm . 'pages/admin_sparepart';
        $data['scripts']  = 'assets/web/js/item/sparepart.js';
		$this->render($this->root_adm . 'admin_layout', $data);
    }

    public function view_aktivitas_pesanan()
    {
        $data = $this->get_default(); 
        $data['subtitle'] = 'MASTER DATA AKTIVITAS PEMESANAN';
        $data['content']  = $this->root_adm . 'pages/admin_order_activate';
        $data['scripts']  = 'assets/web/js/item/order_detail.js';
		$this->render($this->root_adm . 'admin_layout', $data);
    }

    
    public function logout()
	{
		$this->session->sess_destroy();
		redirect('pages/login','refresh');
		
	}

    
}

/* End of file AdminController.php */
