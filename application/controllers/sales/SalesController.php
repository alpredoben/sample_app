<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class SalesController extends Web_Environment {

    private $root_adm;

    public function __construct()
    {
        parent::__construct();

        $this->root_adm = $this->config->item(
            strtolower($this->session->userdata('level_name')).'_root'
        );

        $this->load->model(array(
            'product_model', 
            'machine_model',
            'sparepart_model',
            'order_model'
        ));   
    }
    
    public function get_default()
    {
        return array(
            'title'       => 'PT. COFFINDO',
            'subtitle'    => '',
            'login_level' => $this->session->userdata('level_name'),
            'login_name'  => $this->session->userdata('username'),
            'side_nav'    => $this->root_adm . 'pages/sales_side_nav',
        );
    }

    /** View Data */
    public function index()
    {
        $data = $this->get_default();
        $data['subtitle'] = 'SALES - DASHBOARD';
        $data['content']  = $this->root_adm . 'pages/sales_dashboard';
		$this->render('sales_layout', $data);
    }

    public function view_form_pemesanan()
    {
        $data = $this->get_default(); 
        $data['subtitle'] = 'MASTER PRODUK KOPI';
        $data['content']  = $this->root_adm . 'pages/sales_form_order';
        $data['scripts']  = 'assets/web/js/item/order.js';
		$this->render('sales_layout', $data);
    }

   
    public function logout()
	{
		$this->session->sess_destroy();
		redirect('pages/login','refresh');
		
	}
    


    
}

/* End of file AdminController.php */
