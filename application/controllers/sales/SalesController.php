<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class SalesController extends Web_Environment 
{

    private $root_sales;

    public function __construct()
    {
        parent::__construct();

        $this->load->library('session');
    
        if($this->session->has_userdata('is_login') && $this->session->userdata('is_login') == TRUE) {
            $this->root_sales = $this->config->item(strtolower($this->session->userdata('nama_level_pengguna')).'_root');
        }
        else {
            redirect('pages/login','refresh');
        }

        $this->load->model(array(
            'product_model', 
            'machine_model',
            'sparepart_model',
        ));   
    }
    
    public function get_default()
    {
        return array(
            'title'       => 'PT. COFFINDO',
            'subtitle'    => '',
            'login_level' => $this->session->userdata('nama_level_pengguna'),
            'login_name'  => $this->session->userdata('nama_pengguna'),
            'side_nav'    => $this->root_sales . 'pages/sales_side_nav',
        );
    }

    /** View Data */
    public function index()
    {
        $data = $this->get_default();
        $data['subtitle'] = 'SALES - DASHBOARD';
        $data['content']  = $this->root_sales . 'pages/sales_dashboard';
        $this->render($this->root_sales . 'sales_layout', $data);
    }

    public function view_form_penawaran()
    {
        $data = $this->get_default(); 
        $data['subtitle'] = 'DETAIL PENAWARAN ITEM';
        $data['content']  = $this->root_sales . 'pages/sales_form_order';
        $data['scripts']  = 'assets/web/js/item/order.js';
		$this->render($this->root_sales . 'sales_layout', $data);
    }

    public function load_form_produk()
    {
        $data = array(
            'produk_kopi' => $this->product_model->getAllProduct()
        );
        $this->load->view($this->root_sales . 'pages/sales_form_produk', $data);
    }

    public function load_form_mesin()
    {
        $data = array(
            'daftar_mesin' => $this->machine_model->getAllMachine()
        );
        $this->load->view($this->root_sales . 'pages/sales_form_mesin', $data);
    }

    public function logout()
	{
		$this->session->sess_destroy();
		redirect('pages/login','refresh');
		
	}
    


    
}

/* End of file AdminController.php */
