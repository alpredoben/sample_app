<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class MasterItem extends Web_Environment {

    
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('items_model');
    }

    private function set_insert_item($input, $types)
    {
        $data = array(
            'kode_item'     => $input['id_item'],
            'nama_item'     => $input['nama_item'],
            'id_kategori'   => getCategoryId($types),
            'id_status'     => 0,
            'create_date'   => date('Y-m-d H:i:s'),
            'update_date'   => date('Y-m-d H:i:s')
        );
        return $data;
    }

    private function set_update_item($input)
    {
        $data = array(
            'nama_item'     => $input['nama_item'],
            'update_date'   => date('Y-m-d H:i:s')
        );
        return $data;
    }


    /** To Save Data Item */
    public function save_item($types)
    {
        $input = json_decode(file_get_contents('php://input'), true); 
        $check = $this->items_model->check_record_item_by(getCategoryId($types), $input['id_item'], $input['nama_item']);

        if($check == true)
        {
            $this->set_response(
                false, 'Data item '.$types. ' ['.$input['id_item'].'] - '.$input['nama_item']. ' sudah terdaftar dalam list'
            );
        }
        else
        {
            $object = $this->set_insert_item($input, $types);
            $insert = $this->items_model->insert_data_item($object);

            if($insert==true)
                $this->set_response(true,  'Data '.$types.' ['.$input['id_item'].'] - '.$input['nama_item'].' berhasil ditambahkan');
            else
                $this->set_response(false, 'Data '.$types.' ['.$input['id_item'].'] - '.$input['nama_item'].' gagal ditambahkan');
        }

    }

    /** To Edit Data Item*/
    public function edit_item($types)
    {
        $input = json_decode(file_get_contents('php://input'), true);

        $object = $this->set_update_item($input);
        $update = $this->items_model->update_data_item(
            $object, array(
                'kode_item'   => $input['id_item'], 
                'id_kategori' => getCategoryId($types) 
            )
        );

        if($update == true){
            $this->set_response(true, 'Proses ubah data '.$types.' berhasil');
        }
        else{
            $this->set_response(false, 'Proses ubah data '.$types.' gagal');
        }
    }

    /** To Get List Data Item By Name And Id */
    public function show_item($types, $id)
    {
        if(empty($id))
            $this->set_response(false, 'Data '.$types.' kosong');

        $select = $this->items_model->select_data_item(array(
            'kode_item' => $id,
            'id_kategori' => getCategoryId($types)
        ));

        if($select != false)
            $this->set_response(true, $select);
        else
            $this->set_response(false, 'Data '.$types. ' dengan kode '.$id.' kosong');
    }
    
    public function remove_item($types, $id)
    {   
        if(empty($id))
            $this->set_response(false, 'Silahkan input kode '.$types.' yang akan di hapus');

        $delete = $this->items_model->delete_data_item(array(
            'kode_item'   => $id,
            'id_kategori' => getCategoryId($types)
        ));

        if($delete == true){
            $this->set_response(true, 'Data berhasil di hapus');
        }
        else{
            $this->set_response(false, 'Data gagal di hapus');
        }
    }

    public function datatable_item($types)
    {
        if(isset($_POST['search']))
            $search = $_POST['search']['value'];
        
        if(isset($_POST['draw']))
            $draw = $_POST['draw'];

        if(isset($_POST['length']))
            $length = $_POST['length'];

        if(isset($_POST['start']))
            $start = $_POST['start'];

        $types = getCategoryId($types);
        $record = $this->items_model->get_datatable_item($types, $search, $length, $start);

        $dTable = array();

        $no = $start;
        
        foreach ($record as $item) {
            $no++;
            $str = '<button type="button" id="btnTampil" class="btn btn-success" onclick="SelectListItem(\''.$item->kode_item.'\')">Ubah</button> &nbsp;';
            $str .= '<button type="button" id="btnHapus" class="btn btn-danger" onclick="DeleteListItem(\''.$item->kode_item.'\')">Hapus</button>';

            $dTable[] = array(
                $no,
                $item->kode_item,
                $item->nama_item,
                $item->create_date,
                $item->update_date,
                $str
            );
            
        }
     
        $output = array(
            "draw"              => $draw,
            "recordsTotal"      => $this->items_model->count_record_item($types),
            "recordsFiltered"   => $this->items_model->count_record_filter_item($types, $search),
            "data"              => $dTable,
        );

        echo json_encode($output);
    }

}

/* End of file MasterItem.php */
