<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class Bag_cart {

    private $CI;

    private $pci;

    public function __construct()
    {
        
        $this->CI =& get_instance();
        $this->CI->load->library('cart');;
    }

    public function check_bag_cart()
    {
        return (count($this->CI->cart->contents()) > 0) ? true : false;
    }

    public function get_bag_cart()
    {
        if($this->check_bag_cart() == true)
        {
            $_data = array();

            foreach ($this->CI->cart->contents() as $item) 
            {
                $_sets = array();

                if(isset($item['id']))
                    $_sets['id_po']         = $item['id'];

                if(isset($item['name']))
                    $_sets['kode_item']     = $item['name'];

                if(isset($item['nama_item']))
                    $_sets['nama_item']     = $item['nama_item'];
                
                if(isset($item['kuantitas']))
                    $_sets['kuantitas']     = $item['kuantitas'];

                if(isset($item['diskon']))
                    $_sets['diskon']        = $item['diskon'];

                if(isset($item['harga_item']))
                    $_sets['harga_item']    = $item['harga_item'];

                if(isset($item['price']))
                    $_sets['total_harga']   = $item['price'];

                if(isset($item['qty']))
                    $_sets['qty']           = $item['qty'];

                if(isset($item['rowid']))
                    $_sets['rowid']         = $item['rowid'];

                $_data[] = $_sets;
            }

            return _data
        }
       
        return false;
    }

    

    public function JSONDataTable($record)
    {
        $dTable = array();

        if(is_array($record) && count($record) > 0)
        {
            foreach ($record as $item) 
            {
                $str = '<button type="button" id="btnDeleteRecordTabel" class="hapus_cart btn btn-danger btn-xs" onclick="DeleteRecordTabelCart(\''.$item['code_keranjang'].'\')" style="margin-left:-10px;">Batal</button>';
                
                $dTable[] = array(
                    $item['no_baris'],
                    $item['no_pelanggan'],
                    $item['nama_pelanggan'],
                    $item['keterangan'],
                    $item['jenis_transaksi'],
                    $item['nominal_tagihan'],
                    $str
                );
            }
        }

        return $dTable;
    }

    public function getPivotTable($pivot_cart)
    {
        if(is_array($pivot_cart) && count($pivot_cart) > 0)
        {
            $result = array();

            foreach ($pivot_cart as $item) 
            {
                $sets = array();

                $sets['no_baris']        = $item['no_baris'];
                $sets['no_pelanggan']    = $item['no_pelanggan'];
                $sets['nama_pelanggan']  = $item['nama_pelanggan'];
                $sets['keterangan']      = $item['keterangan'];
                $sets['jenis_transaksi'] = strtoupper($item['inm_info_produk']);
                $sets['nominal_tagihan'] = 'Rp. '. number_format($item['price'], 0, ",", ".");
                $sets['code_keranjang']  = $item['rowid'];
                $result[] = $sets;
            }

            return $result;
        }

        return 'No Available Data Cart';
    }

    public function getTotalOrder()
    {
        return $this->pci->cart->total();
    }

    public function removeCartById($cart_id)
    {
        $data = array(
            'rowid' => $cart_id,
            'qty' => 0,
        );
        $this->pci->cart->update($data);
    }
    
}   

