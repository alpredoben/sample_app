<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class MasterOfferingController extends Web_Environment 
{
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        $this->load->model(array('myitem_model'));
    }


    public function datatable_produk()
    {
        if(isset($_POST['search']))
            $search = $_POST['search']['value'];
        
        if(isset($_POST['draw']))
            $draw = $_POST['draw'];

        if(isset($_POST['length']))
            $length = $_POST['length'];

        if(isset($_POST['start']))
            $start = $_POST['start'];

        $record = $this->product_model->getDataTableProduct($search, $length, $start);
        $dTable = array();
        $no = $start;
        foreach ($record as $item) {
            $no++;
            $str = '<button type="button" id="btnUpdate" class="btn btn-success" onclick="EditProduct(\''.$item->product_id.'\')">Ubah</button> &nbsp;';
            $str .= '<button type="button" id="btnHapus" class="btn btn-danger" onclick="DeleteProduct(\''.$item->product_id.'\')">Hapus</button>';

            $dTable[] = array(
                $no,
                $item->product_id,
                $item->product_name,
                $item->create_date,
                $item->update_date,
                $str
            );
            
        }
     
        $output = array(
            "draw"              => $draw,
            "recordsTotal"      => $this->product_model->countRecordProduct(),
            "recordsFiltered"   => $this->product_model->countFilterProduct($search),
            "data"              => $dTable,
        );

        echo json_encode($output);
    }
    
    
    public function set_wait_active($offer_type, $offer_id)
    {
        if(empty($offer_id))
            $this->set_response(false, 'Silahkan input id penawaran yang akan di aktifkan');

        $set_wait = $this->myitem_model->setWaitActiveOfferBy($offer_type, $offer_id);

        if($set_wait == true)
            $this->set_response(true, 'Set request status penawaran '.$offer_type.' berhasil');
        else
            $this->set_response(false, 'Set request status penawaran '.$offer_type.' berhasil');
       
    }
    
    public function delete_offer_item($nama_item, $id)
    {
        if(empty($id))
            $this->set_response(false, 'ID Item penawaran kosong');

        $delete = $this->myitem_model->removeOfferItem($nama_item, $id);

        if($delete == true){
            $this->set_response(true, 'Data berhasil di hapus');
        }
        else{
            $this->set_response(false, 'Data gagal di hapus');
        }
    }

    public function hapus_penawaran_produk($offer_id='')
    {
        if(empty($offer_id))
            $this->set_response(false, 'Silahkan input id penawaran yang akan di hapus');

        $delete = $this->offered_model->removeOfferProductBy($offer_id);

        if($delete == true){
            $this->set_response(true, 'Data berhasil di hapus');
        }
        else{
            $this->set_response(false, 'Data gagal di hapus');
        }
    }
}

/* End of file MasterOfferingController.php */
