<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class Bag_cart {

    private $CI;

    private $pci;

    public function __construct()
    {
        
        $this->CI =& get_instance();
        $this->CI->load->library('cart');;
    }

    public function check_cart()
    {
        return (count($this->CI->cart->contents()) > 0) ? true : false;
    }

    public function get_cart()
    {
        if($this->check_cart() == true)
        {
            $_data = array();

            foreach ($this->CI->cart->contents() as $item) 
            {
                $_sets = array();

                if(isset($item['id']))
                    $_sets['id']            = $item['id'];

                if(isset($item['po_code']))
                    $_sets['po_code']       = $item['po_code'];

                if(isset($item['name']))
                    $_sets['name']          = $item['name'];

                if(isset($item['nama_item']))
                    $_sets['nama_item']     = $item['nama_item'];
                
                if(isset($item['nama_kategori']))
                    $_sets['nama_kategori'] = $item['nama_kategori'];

                if(isset($item['kuantitas']))
                    $_sets['kuantitas']     = $item['kuantitas'];

                if(isset($item['diskon']))
                    $_sets['diskon']        = $item['diskon'];

                if(isset($item['harga_item']))
                    $_sets['harga_item']    = $item['harga_item'];

                if(isset($item['price']))
                    $_sets['price']         = $item['price'];

                if(isset($item['qty']))
                    $_sets['qty']           = $item['qty'];

                if(isset($item['rowid']))
                    $_sets['rowid']         = $item['rowid'];

                
                $_data[] = $_sets;
            }

            return $_data;
        }
       
        return false;
    }


    public function delete_all_item_cart()
    {
        if($this->check_cart() == true)
        {   
            foreach ($this->CI->cart->contents() as $item) {
                $this->delete_cart_index_by($item['rowid']);
            }

            return true;
        }

        return false;
    }


    public function get_total_price_cart()
    {
        return $this->CI->cart->total();
    }

    public function delete_cart_index_by($row_id)
    {
        $data = array(
            'rowid' => $row_id,
            'qty' => 0
        );
        $this->CI->cart->update($data);
    }    

    
}   

