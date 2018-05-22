<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class SparepartController extends Web_Environment {

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->root_adm = $this->config->item(strtolower($this->session->userdata('level_name')).'_root');

        $this->load->model(array(
            'sparepart_model'
        ));
    }

    private function setInsertSparepart($input)
    {
        return array(
            'sparepart_id'    => $input['id_sparepart'],
            'sparepart_name'  => $input['nama_sparepart'],
            'status_data'   => 0,
            'create_date'   => date('Y-m-d H:i:s'), 
            'update_date'   => date('Y-m-d H:i:s')
        ); 
    }

    private function setUpdateSparepart($input)
    {
        return array(
            'sparepart_name'  => $input['nama_sparepart'],
            'update_date'   => date('Y-m-d H:i:s')
        ); 
    }

    public function datatable_sparepart()
    {
        if(isset($_POST['search']))
            $search = $_POST['search']['value'];
        
        if(isset($_POST['draw']))
            $draw = $_POST['draw'];

        if(isset($_POST['length']))
            $length = $_POST['length'];

        if(isset($_POST['start']))
            $start = $_POST['start'];

        $record = $this->sparepart_model->getDataTableSparepart($search, $length, $start);
        $dTable = array();
        $no = $start;
        foreach ($record as $item) {
            $no++;
            $str = '<button type="button" id="btnUpdate" class="btn btn-success" onclick="EditSparepart(\''.$item->sparepart_id.'\')">Ubah</button> &nbsp;';
            $str .= '<button type="button" id="btnHapus" class="btn btn-danger" onclick="DeleteSparepart(\''.$item->sparepart_id.'\')">Hapus</button>';

            $dTable[] = array(
                $no,
                $item->sparepart_id,
                $item->sparepart_name,
                $item->create_date,
                $item->update_date,
                $str
            );
            
        }
     
        $output = array(
            "draw"              => $draw,
            "recordsTotal"      => $this->sparepart_model->countRecordSparepart(),
            "recordsFiltered"   => $this->sparepart_model->countFilterSparepart($search),
            "data"              => $dTable,
        );

        echo json_encode($output);
    }
    
    public function show_sparepart($sparepart_id = '')
    {
        if(empty($sparepart_id))
            $this->set_response(false, 'Data sparepart kosong');

        $data = $this->sparepart_model->getSparepartById($sparepart_id);

        if($data != false)
            $this->set_response(true, $data);
        else
            $this->set_response(false, 'Data ID Sparepart '.$sparepart_id.' kosong');
    }

    public function tambah_sparepart()
    {
        $input = json_decode(file_get_contents('php://input'), true);

        $bools = $this->sparepart_model->checkRecordSparepartBy($input['id_sparepart'], $input['nama_sparepart']);
        
        if($bools == true)
        {
            $this->set_response(false, 'Data sparepart ['.$input['id_sparepart'].'] - '.$input['nama_sparepart']. ' sudah terdaftar dalam list');
        }
        else
        {
            $object = $this->setInsertSparepart($input);
            $insert = $this->sparepart_model->insertSparepart($object);

            if($insert==true){
                $this->set_response(true,  'Tambah data sparepart ['.$input['id_sparepart'].'] - '.$input['nama_sparepart'].' Berhasil');
            }
            else{
                $this->set_response(false, 'Tambah data sparepart ['.$input['id_sparepart'].'] - '.$input['nama_sparepart'].' Gagal');
            }
        }
    }

    public function ubah_sparepart()
    {
        $input = json_decode(file_get_contents('php://input'), true);

        $set_update = $this->setUpdateSparepart($input);
        $update = $this->sparepart_model->updateSparepartById($input['id_sparepart'], $set_update);

        if($update == true){
            $this->set_response(true, 'Proses ubah data sparepart berhasil');
        }
        else{
            $this->set_response(false, 'Proses ubah data sparepart gagal');
        }
    }

    public function hapus_sparepart($sparepart_id='')
    {
        if(empty($sparepart_id))
            $this->set_response(false, 'Silahkan input id sparepart yang akan di hapus');

        $delete = $this->sparepart_model->removeSparepartById($sparepart_id);

        if($delete == true){
            $this->set_response(true, 'Data berhasil di hapus');
        }
        else{
            $this->set_response(false, 'Data gagal di hapus');
        }
    }
}

/* End of file SparepartController.php */

