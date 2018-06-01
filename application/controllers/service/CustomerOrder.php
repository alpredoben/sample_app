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

        $this->load->library('cart');
        
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
        //po.id, po.po_code, it.kode_item, it.nama_item, kt.nama_kategori, pn.kuantitas, pn.diskon, pn.harga_item
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

            if(count($_result) > 0){
                $this->set_response(true, 'Insert item to cart list success', $_result);
            }
            else{
                $this->set_response(false, 'Items have been inserted to cart list');
            }

        }
        else
            $this->set_response(false, 'Insert item to cart list failed. No record item list in Database');
    }

}

/* End of file CustomerOrder.php */
