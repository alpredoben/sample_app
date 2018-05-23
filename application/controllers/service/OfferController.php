<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class OfferController extends Web_Environment  
{
    protected $user_session;

    public function __construct()
    {

        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        $this->load->model(array(
            'product_model',
            'machine_model',
            'sparepart_model',
            'offered_model'
        ));
    }

    /** ### DEFAULT SET ACTIVATE OFFER ITEM ###*/
    public function set_wait_active($offer_type, $offer_id)
    {
        if(empty($offer_id))
            $this->set_response(false, 'Silahkan input id penawaran yang akan di aktifkan');

        $set_wait = $this->offered_model->setWaitActiveOfferBy($offer_type, $offer_id);

        if($set_wait == true)
            $this->set_response(true, 'Set request status penawaran '.$offer_type.' berhasil');
        else
            $this->set_response(false, 'Set request status penawaran '.$offer_type.' berhasil');
       
    }


    /** ##################### ALL EVENT METHOD PRODUCT OFFER ################################## */
    private function set_insert_offer_product($input)
    {
        
        return array(
            'product_code'      => $input['id_produk'],
            'quantity'          => $input['kuantitas_produk'],
            'product_price'     => $input['harga_produk'],
            'discount'          => $input['diskon_produk'],
            'stok_id'           => 1,
            'user_id'           => $input['session_user_data']['unik_id_pengguna'],
            'active_id'         => 4, 
            'status_data'       => 0, 
            'create_date'       => date('Y-m-d H:i:s'), 
            'update_date'       => date('Y-m-d H:i:s'),
            'active_date'       => ''
        ); 
    }

    private function set_update_offer_product($input)
    {
        return array(
            'quantity'          => $input['kuantitas_produk'],
            'product_price'     => $input['harga_produk'],
            'discount'          => $input['diskon_produk'],
            'update_date'       => date('Y-m-d H:i:s')
        ); 
    }


    public function tambah_penawaran_produk()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        $insert_data = $this->set_insert_offer_product($input['input_produk']);
        $insert = $this->offered_model->insertProductOffer($insert_data);

        if($insert == true){
            $this->set_response(true, 'Data berhasil ditambahkan');
        }
        else{
            $this->set_response(false, 'Data gagal ditambahkan');
        }
    }

    public function datatable_penawaran_produk()
    {
        if(isset($_POST['search']))
            $search = $_POST['search']['value'];
        
        if(isset($_POST['draw']))
            $draw = $_POST['draw'];

        if(isset($_POST['length']))
            $length = $_POST['length'];

        if(isset($_POST['start']))
            $start = $_POST['start'];

        $record = $this->offered_model->getDataTableProductOffer($search, $length, $start);

        $dTable = array();
        
        $no = $start;
        foreach ($record as $item) {
            $no++;
            $str = '<button type="button" id="btnUpdateOffer" class="btn btn-primary" onclick="EditProductOffer(\''.$item->product_offer_id.'\')">Ubah</button> &nbsp;';

            $str .= '<button type="button" id="btnWaitActive" class="btn btn-success" onclick="UpToWaitActiveOffer(\'produk\',\''.$item->product_offer_id.'\')">Set Active</button> &nbsp;';

            $str .= '<button type="button" id="btnDeleteOffer" class="btn btn-danger" onclick="DeleteProductOffer(\''.$item->product_offer_id.'\')">Hapus</button>';


            $dTable[] = array(
                $no,
                $item->product_id,
                $item->product_name,
                number_format($item->quantity, 0, ",", "."),
                number_format($item->product_price, 0, ",", "."),
                $item->discount,
                '<span style="background:cyan; padding:5px;">'.$item->active_name.'</span>',
                $item->create_date,
                $item->update_date,
                $str
            );
            
        }
     
        $output = array(
            "draw"              => $draw,
            "recordsTotal"      => $this->offered_model->countRecordProductOffer(),
            "recordsFiltered"   => $this->offered_model->countFilterProductOffer($search),
            "data"              => $dTable,
        );

        echo json_encode($output);
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



    /** ###################################### @var MACHINE_OFFER ######################################## */
    private function set_insert_offer_machine($input)
    {
        
        return array(
            'machine_code'      => $input['id_mesin'],
            'quantity'          => $input['kuantitas_mesin'],
            'machine_price'     => $input['harga_mesin'],
            'discount'          => $input['diskon_mesin'],
            'stok_id'           => 1,
            'user_id'           => $input['session_user_data']['unik_id_pengguna'],
            'active_id'         => 4, 
            'status_data'       => 0, 
            'create_date'       => date('Y-m-d H:i:s'), 
            'update_date'       => date('Y-m-d H:i:s'),
            'active_date'       => ''
        ); 
    }

    public function tambah_penawaran_mesin()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        $insert_data = $this->set_insert_offer_machine($input['input_mesin']);
        $insert = $this->offered_model->insertMachineOffer($insert_data);

        if($insert == true){
            $this->set_response(true, 'Data berhasil ditambahkan');
        }
        else{
            $this->set_response(false, 'Data gagal ditambahkan');
        }
    }

    /** Datatable Penawaran Mesin */
    public function datatable_penawaran_mesin()
    {
        if(isset($_POST['search']))
            $search = $_POST['search']['value'];
        
        if(isset($_POST['draw']))
            $draw = $_POST['draw'];

        if(isset($_POST['length']))
            $length = $_POST['length'];

        if(isset($_POST['start']))
            $start = $_POST['start'];

        $record = $this->offered_model->getDataTableMachineOffer($search, $length, $start);

        $dTable = array();
        
        $no = $start;
        foreach ($record as $item) {
            $no++;
            $str = '<button type="button" id="btnUpdateOffer" class="btn btn-primary" onclick="EditMachineOffer(\''.$item->machine_offer_id.'\')">Ubah</button> &nbsp;';

            $str .= '<button type="button" id="btnWaitActive" class="btn btn-success" onclick="UpToWaitActiveOffer(\'mesin\',\''.$item->machine_offer_id.'\')">Set Active</button> &nbsp;';

            $str .= '<button type="button" id="btnDeleteOffer" class="btn btn-danger" onclick="DeleteMachineOffer(\''.$item->machine_offer_id.'\')">Hapus</button>';


            $dTable[] = array(
                $no,
                $item->machine_id,
                $item->machine_name,
                number_format($item->quantity, 0, ",", "."),
                number_format($item->machine_price, 0, ",", "."),
                $item->discount,
                '<span style="background:cyan; padding:5px;">'.$item->active_name.'</span>',
                $item->create_date,
                $item->update_date,
                $str
            );
            
        }
     
        $output = array(
            "draw"              => $draw,
            "recordsTotal"      => $this->offered_model->countRecordMachineOffer(),
            "recordsFiltered"   => $this->offered_model->countFilterMachineOffer($search),
            "data"              => $dTable,
        );

        echo json_encode($output);
    }

    public function hapus_penawaran_mesin($offer_id)
    {
        if(empty($offer_id))
            $this->set_response(false, 'Silahkan input id penawaran yang akan di hapus');

        $delete = $this->offered_model->removeOfferMachineBy($offer_id);

        if($delete == true){
            $this->set_response(true, 'Data berhasil di hapus');
        }
        else{
            $this->set_response(false, 'Data gagal di hapus');
        }
    }



    /** ################################## @var SPAREPART_OFFER ######################################### */
    private function set_insert_offer_sparepart($input)
    {
        
        return array(
            'sparepart_code'    => $input['id_sparepart'],
            'quantity'          => $input['kuantitas_sparepart'],
            'sparepart_price'   => $input['harga_sparepart'],
            'discount'          => $input['diskon_sparepart'],
            'stok_id'           => 1,
            'user_id'           => $input['session_user_data']['unik_id_pengguna'],
            'active_id'         => 4, 
            'status_data'       => 0, 
            'create_date'       => date('Y-m-d H:i:s'), 
            'update_date'       => date('Y-m-d H:i:s'),
            'active_date'       => ''
        ); 
    }

    public function tambah_penawaran_sparepart()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        $insert_data = $this->set_insert_offer_sparepart($input['input_sparepart']);
        $insert = $this->offered_model->insertSparepartOffer($insert_data);

        if($insert == true){
            $this->set_response(true, 'Data berhasil ditambahkan');
        }
        else{
            $this->set_response(false, 'Data gagal ditambahkan');
        }
    }

    public function datatable_penawaran_sparepart()
    {
        if(isset($_POST['search']))
            $search = $_POST['search']['value'];
        
        if(isset($_POST['draw']))
            $draw = $_POST['draw'];

        if(isset($_POST['length']))
            $length = $_POST['length'];

        if(isset($_POST['start']))
            $start = $_POST['start'];

        $record = $this->offered_model->getDataTableSparepartOffer($search, $length, $start);

        $dTable = array();
        
        $no = $start;
        foreach ($record as $item) {
            $no++;
            $str = '<button type="button" id="btnUpdateOffer" class="btn btn-primary" onclick="EditSparepartOffer(\''.$item->sparepart_offer_id.'\')">Ubah</button> &nbsp;';

            $str .= '<button type="button" id="btnWaitActive" class="btn btn-success" onclick="UpToWaitActiveOffer(\'sparepart\',\''.$item->sparepart_offer_id.'\')">Set Active</button> &nbsp;';

            $str .= '<button type="button" id="btnDeleteOffer" class="btn btn-danger" onclick="DeleteSparepartOffer(\''.$item->sparepart_offer_id.'\')">Hapus</button>';


            $dTable[] = array(
                $no,
                $item->sparepart_id,
                $item->sparepart_name,
                number_format($item->quantity, 0, ",", "."),
                number_format($item->sparepart_price, 0, ",", "."),
                $item->discount,
                '<span style="background:cyan; padding:5px;">'.$item->active_name.'</span>',
                $item->create_date,
                $item->update_date,
                $str
            );
            
        }
     
        $output = array(
            "draw"              => $draw,
            "recordsTotal"      => $this->offered_model->countRecordSparepartOffer(),
            "recordsFiltered"   => $this->offered_model->countFilterSparepartOffer($search),
            "data"              => $dTable,
        );

        echo json_encode($output);
    }

    public function hapus_penawaran_sparepart($offer_id)
    {
        if(empty($offer_id))
            $this->set_response(false, 'Silahkan input id penawaran yang akan di hapus');

        $delete = $this->offered_model->removeOfferSparepartBy($offer_id);

        if($delete == true){
            $this->set_response(true, 'Data berhasil di hapus');
        }
        else{
            $this->set_response(false, 'Data gagal di hapus');
        }
    }

}

/* End of file OrderController.php */
