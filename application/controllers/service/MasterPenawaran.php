<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class MasterPenawaran extends CI_Controller 
{
    
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model(array('penawaran_model'));
    }
    
    public function datatable_item($type_name)
    {
        if(isset($_POST['search']))
            $search = $_POST['search']['value'];
        
        if(isset($_POST['draw']))
            $draw = $_POST['draw'];

        if(isset($_POST['length']))
            $length = $_POST['length'];

        if(isset($_POST['start']))
            $start = $_POST['start'];
        
        $types_id = getCategoryId($type_name);

        $record = $this->penawaran_model->get_datatable_penawaran($types_id, $search, $length, $start);

        $dTable = array();
        $no = $start;
        foreach ($record as $item) {
            $no++;
            
            $str = '<button type="button" id="btnUpdatePenawaran" class="btn btn-primary" onclick="ShowItemPenawaran(\''.$type_name.'\',\''.$item->id_penawaran.'\')">Ubah</button> &nbsp;';

            $str .= '<button type="button" id="btnAktifasiPenawaran" class="btn btn-success" onclick="UpdateActivatePenawaran(\''.$type_name.'\',\''.$item->id_penawaran.'\')">Aktifasi</button> &nbsp;';

            $str .= '<button type="button" id="btnHapusPenawaran" class="btn btn-danger" onclick="DeleteItemPenawaran(\''.$type_name.'\',\''.$item->id_penawaran.'\')">Hapus</button>';


            $dTable[] = array(
                $no,
                $item->kode_item,
                $item->nama_item,
                number_format($item->kuantitas, 0, ",", "."),
                number_format($item->harga_item, 0, ",", "."),
                $item->diskon,
                '<span style="background:cyan; padding:5px;">'.$item->nama_aktifasi.'</span>',
                strtoupper($item->nama_kategori),
                $item->create_date,
                $item->update_date,
                $str
            );
            
        }
     
        $output = array(
            "draw"              => $draw,
            "recordsTotal"      => $this->penawaran_model->count_record_penawaran($types_id),
            "recordsFiltered"   => $this->penawaran_model->count_filter_penawaran($types_id, $search),
            "data"              => $dTable,
        );

        echo json_encode($output);

    }

    public function insert_item_penawaran()
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
}

/* End of file MasterPenawaran.php */
