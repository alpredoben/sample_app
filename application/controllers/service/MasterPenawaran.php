<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class MasterPenawaran extends Web_Environment 
{
    
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model(array('penawaran_model'));
    }
    
    /** Datatable */
    public function master_datatable_penawaran($type_name)
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

    /** Set Insert Object Data Penawaran */
    private function set_object_insert_penawaran($types, $input)
    {
        $object = array(
            'id_kategori'   => getCategoryId($types),
            'id_item'       => $input['id_item'],
            'kuantitas'     => $input['kuantitas_item'],
            'harga_item'    => $input['harga_item'],
            'diskon'        => $input['diskon_item'],
            'id_stok'       => 1,
            'id_aktifasi'   => 4,
            'id_status'     => 0,
            'user_id'       => $input['id_user'],
            'create_date'   => date('Y-m-d H:i:s'),
            'update_date'   => date('Y-m-d H:i:s'),
            'active_date'   => ''
        );

        return $object;
    }

    /** Insert/Save Item Penawaran */
    public function save_item_penawaran($types)
    {
        $input = json_decode(file_get_contents('php://input'), true);

        $object = $this->set_object_insert_penawaran($types, $input['input_produk']);
        $insert = $this->penawaran_model->insert_data_penawaran($object);

        if($insert == true)
            $this->set_response(true, 'Data berhasil ditambahkan');
        else
            $this->set_response(false, 'Data gagal ditambahkan');
    }

    /** Remove/Disable Item Penawaran */
    public function remove_item_penawaran($type_name, $id)
    {
        if(empty($id))
            $this->set_response(false, 'Silahkan input id item '.$type_name.' penawaran yang akan di hapus');

        $delete = $this->penawaran_model->delete_data_penawaran(getCategoryId($type_name), $id);

        if($delete == true){
            $this->set_response(true, 'Data berhasil di hapus');
        }
        else{
            $this->set_response(false, 'Data gagal di hapus');
        }
    }

    /** Set Update Aktivasi Penawaran */
    public function set_aktivasi_item($type_name, $id)
    {
        if(empty($id))
            $this->set_response(false, 'Silahkan input id item '.$type_name.' penawaran yang akan di aktivasi');

        $time_validate = date('Y-m-d H:i:s');
        $aktivasi = $this->penawaran_model->set_aktivasi_item(getCategoryId($type_name), $time_validate, $id);
        if($aktivasi == true){
            $this->set_response(true, 'Pengajuan aktivasi data berhasil. ');
        }
        else{
            $this->set_response(false, 'Pengajuan aktivasi data gagal');
        }
    }

    /** Select item penawaran */
    public function get_list_item_penawaran($type_name, $id)
    {
        $list_item = $this->penawaran_model->get_record_item_by(getCategoryId($type_name), $id);

        if($list_item != false)
            $this->set_response(true, $list_item);
        else
            $this->set_response(false, 'Id penawaran '.$id. ' untuk item '. $type_name.' tidak terdaftar');
    }


    /** Update item penawaran */
    public function set_object_update($input)
    {
        $object = array(
            'kuantitas' => $input['kuantitas'],
            'harga_item' => $input['harga_item'] ,
            'diskon' => $input['diskon'],
            'user_id' => $input['id_user']
        );
        return $object;
    }
    public function update_item_penawaran($type_name)
    {
        $input  = json_decode(file_get_contents('php://input'), true)['data_update'];
        $object = $this->set_object_update($input);
        $update = $this->penawaran_model->update_data_penawaran($input['id_penawaran'], $object);

        if($update == true)
            $this->set_response(true, 'Data berhasil di ubah');
        else
            $this->set_response(false, 'Data gagal di ubah');
    }

}

/* End of file MasterPenawaran.php */
