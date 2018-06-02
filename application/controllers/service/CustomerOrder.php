<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class CustomerOrder extends Web_Environment {

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model(array(
            'cs_order_model',
        ));

        $this->load->library(array(
            'cart',
            'bag_cart'
        ));
        
    }

    public function get_list_category()
    {
        $list = $this->cs_order_model->get_category_item();
        if($list != false)
            $this->set_response(true, $list);
        else
            $this->set_response(false, 'No Record List Category');
    }

    public function get_list_group_item()
    {
        $input = json_decode(file_get_contents('php://input'), true);

        $id_kategori = isset($input['id_kategori']) ? $input['id_kategori'] : '';
        $list = $this->cs_order_model->get_item_group($id_kategori);

        if($list != false)
            $this->set_response(true, $list);
        else
            $this->set_response(false, 'No Record List Product');
    }

    public function get_list_product($kode_item='')
    {
        $list = $this->cs_order_model->get_list_product_item_by($kode_item);

        $result = array('data' => array());

        if($list != false)
        {
            
            foreach ($list as $v) 
            {
                $result['data'][] = array(
                    $v['id'], 
                    $v['po_code'],
                    $v['kode_item'],
                    $v['nama_item'],
                    $v['nama_kategori'],
                    $v['kuantitas'],
                    $v['diskon'],
                    $v['harga_item'],
                    round( ((100 - $v['diskon'])/100) * $v['harga_item'] , 2)
                );
            }

            echo json_encode($result);
        }
        else{
            $result['data'] = 'No Record Data';
            echo json_encode($result);
        }
    }


    public function check_fill_cart($id)
    {
        $bool = false;

        if (count($this->cart->contents())>0) {
            foreach ($this->cart->contents() as $items) {
                if ($items['id']==$id) {
                    $bool = true;
                }
            }
            return $bool;
        }
        else
            return false;
    }

    public function add_order_item()
    {
        $input = json_decode(file_get_contents('php://input') ,true);
        $list_order = $this->cs_order_model->get_list_order_by($input['list_item']);

        if($list_order != false)
        {
            $_result = array();

            foreach ($list_order as $v) 
            {
                if( $this->check_fill_cart($v['id']) != true )
                {
                    $tmp_cart = array(
                        'id'            => $v['id'],
                        'po_code'       => $v['po_code'],
                        'name'          => $v['kode_item'],
                        'nama_item'     => $v['nama_item'],
                        'nama_kategori' => $v['nama_kategori'],
                        'kuantitas'     => intval($v['kuantitas']),
                        'diskon'        => intval($v['diskon']),
                        'harga_item'    => intval($v['harga_item']),
                        'price'         => round( ((100 - intval($v['diskon'])) * intval($v['harga_item'])) / 100, 2),
                        'qty'           => 1
                    );

                    $insert_cart = $this->cart->insert($tmp_cart);

                    array_push($_result, $tmp_cart);
                }
            }

            if(count($_result) > 0)
            {
                $this->set_response(true, 'Insert item to cart list success');
            }
            else{
                $this->set_response(false, 'Items have been inserted to cart list');
            }

        }
        else
            $this->set_response(false, 'Insert item to cart list failed. No record item list in Database');
    }

    public function get_data_cart_order()
    {

        if($this->bag_cart->check_cart() == true){
            $record_cart = $this->bag_cart->get_cart();
            $total_price = $this->bag_cart->get_total_price_cart();

            $_json_data = array('data' => array());


            $index = 0;
            foreach ($record_cart as $v) {
                $index += 1;
                $button = '<button type="button" id="btnDelete'.$v['id'].'" class="btn btn-danger" onclick="DeleteOrderItem(\''.$v['id'].'\')">Delete</button>';
                $tmp = array(
                    $index,
                    $v['po_code'],
                    $v['name'],
                    $v['nama_item'],
                    $v['nama_kategori'],
                    $v['kuantitas'],
                    $v['diskon'],
                    $v['harga_item'],
                    $v['price'],
                    $button
                );

                array_push($_json_data['data'], $tmp);
            }

            $this->set_response(true, array('record_data' => $_json_data, 'total_prices' => $total_price));
        }
        else{
            $this->set_response(false, 'No Record Cart Order Item');
        }
        
    }

    public function pay_order_item()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        $customer = $input['customers'];
        $bool = true;

        if($this->bag_cart->check_cart() == true) {
            
            $list_order = $this->bag_cart->get_cart();

            $objects = array();

            foreach ($list_order as $value) 
            {
                $create_date = date('Y-m-d H:i:s');
                
                $objects[] = array(
                    'id_order'          => $value['id'],
                    'no_po_order'       => $value['po_code'],
                    'kode_produk'       => $value['name'],    
                    'no_bill'           => $customer['no_bill_account'], 
                    'customer_name'     => $customer['comp_name'],
                    'customer_email'    => $customer['comp_email'],
                    'customer_phone'    => $customer['comp_phone'],
                    'customer_address'  => $customer['comp_address'],
                    'invoice_date'      => $customer['invoice_date'],
                    'nama_produk'       => $value['nama_item'],
                    'kategori_produk'   => $value['nama_kategori'],
                    'kuantitas'         => $value['kuantitas'],
                    'diskon'            => $value['diskon'],
                    'harga_produk'      => $value['harga_item'],
                    'total_harga'       => $value['price'],
                    'created_date'      => $create_date,
                );            
            }

            
            $insert_order = $this->cs_order_model->add_customer_order($objects);
            
            if($insert_order != false)
            {
                $delete_cart = $this->bag_cart->delete_all_item_cart();

                if($delete_cart == true){
                    $this->set_response(true, 'Proses pemesanan produk berhasil');
                }
                else{
                    $this->set_response(false, 'Proses pemesanan produk gagal. Terjadi kesalah pada cart');
                }
            }
            else
                $this->set_response(false, 'Proses pemesanan produk gagal');
                
        }
        else{
            $this->set_response(false, 'Daftar produk yang dipesan kosong');
        }

    }

}

/* End of file CustomerOrder.php */
