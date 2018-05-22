<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends Web_Environment {

    private $root_adm;

    public function __construct()
    {
        parent::__construct();

        $this->root_adm = $this->config->item(
            strtolower($this->session->userdata('level_name')).'_root'
        );

        $this->load->model(array(
            'product_model'
        ));   
    }
    
    public function get_default()
    {
        return array(
            'title'       => 'PT. COFFINDO',
            'subtitle'    => '',
            'login_level' => $this->session->userdata('level_name'),
            'login_name'  => $this->session->userdata('username'),
            'side_nav'    => $this->root_adm . 'pages/admin_side_nav',
        );
    }

    /** View Data */
    public function index()
    {
        $data = $this->get_default();
        $data['subtitle'] = 'ADMIN - DASHBOARD';
        $data['content']  = $this->root_adm . 'pages/admin_dashboard';
		$this->render('admin_layout', $data);
    }

    public function view_produk()
    {
        $data = $this->get_default(); 
        $data['subtitle'] = 'MASTER PRODUK KOPI';
        $data['content']  = $this->root_adm . 'pages/admin_product';
        $data['scripts']  = 'assets/web/js/item/product.js';
		$this->render('admin_layout', $data);
    }

    public function view_mesin()
    {
        $data = $this->get_default(); 
        $data['subtitle'] = 'MASTER DATA MESIN';
        $data['content']  = $this->root_adm . 'pages/admin_machine';
        $data['scripts']  = 'assets/web/js/item/machine.js';
		$this->render('admin_layout', $data);
    }

    public function view_sparepart()
    {
        $data = $this->get_default(); 
        $data['subtitle'] = 'MASTER DATA SPAREPART';
        $data['content']  = $this->root_adm . 'pages/admin_sparepart';
        $data['scripts']  = 'assets/web/js/item/sparepart.js';
		$this->render('admin_layout', $data);
    }

    public function view_aktivitas_pesanan()
    {
        $data = $this->get_default(); 
        $data['subtitle'] = 'MASTER DATA AKTIVITAS PEMESANAN';
        $data['content']  = $this->root_adm . 'pages/admin_order_activate';
        $data['scripts']  = 'assets/web/js/item/order_detail.js';
		$this->render('admin_layout', $data);
    }

    
    public function logout()
	{
		$this->session->sess_destroy();
		redirect('pages/login','refresh');
		
	}

    
}

/* End of file AdminController.php */
