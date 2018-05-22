<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class MachineController extends Web_Environment {

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->root_adm = $this->config->item(strtolower($this->session->userdata('level_name')).'_root');

        $this->load->model(array(
            'machine_model'
        ));
    }

    private function setInsertMachine($input)
    {
        return array(
            'machine_id'    => $input['id_mesin'],
            'machine_name'  => $input['nama_mesin'],
            'status_data'   => 0,
            'create_date'   => date('Y-m-d H:i:s'), 
            'update_date'   => date('Y-m-d H:i:s')
        ); 
    }

    private function setUpdateMachine($input)
    {
        return array(
            'machine_name'  => $input['nama_mesin'],
            'update_date'   => date('Y-m-d H:i:s')
        ); 
    }

    public function datatable_mesin()
    {
        if(isset($_POST['search']))
            $search = $_POST['search']['value'];
        
        if(isset($_POST['draw']))
            $draw = $_POST['draw'];

        if(isset($_POST['length']))
            $length = $_POST['length'];

        if(isset($_POST['start']))
            $start = $_POST['start'];

        $record = $this->machine_model->getDataTableMachine($search, $length, $start);
        $dTable = array();
        $no = $start;
        foreach ($record as $item) {
            $no++;
            $str = '<button type="button" id="btnUpdate" class="btn btn-success" onclick="EditMachine(\''.$item->machine_id.'\')">Ubah</button> &nbsp;';
            $str .= '<button type="button" id="btnHapus" class="btn btn-danger" onclick="DeleteMachine(\''.$item->machine_id.'\')">Hapus</button>';

            $dTable[] = array(
                $no,
                $item->machine_id,
                $item->machine_name,
                $item->create_date,
                $item->update_date,
                $str
            );
            
        }
     
        $output = array(
            "draw"              => $draw,
            "recordsTotal"      => $this->machine_model->countRecordMachine(),
            "recordsFiltered"   => $this->machine_model->countFilterMachine($search),
            "data"              => $dTable,
        );

        echo json_encode($output);
    }
    
    public function show_mesin($machine_id = '')
    {
        if(empty($machine_id))
            $this->set_response(false, 'Data mesin kosong');

        $data = $this->machine_model->getMachineById($machine_id);

        if($data != false)
            $this->set_response(true, $data);
        else
            $this->set_response(false, 'Data ID Mesin '.$machine_id.' kosong');
    }

    public function tambah_mesin()
    {
        $input = json_decode(file_get_contents('php://input'), true);

        $bools = $this->machine_model->checkRecordMachineBy($input['id_mesin'], $input['nama_mesin']);
        
        if($bools == true)
        {
            $this->set_response(false, 'Data mesin ['.$input['id_mesin'].'] - '.$input['nama_mesin']. ' sudah terdaftar dalam list');
        }
        else
        {
            $object = $this->setInsertMachine($input);
            $insert = $this->machine_model->insertMachine($object);

            if($insert==true){
                $this->set_response(true,  'Tambah data mesin ['.$input['id_mesin'].'] - '.$input['nama_mesin'].' Berhasil');
            }
            else{
                $this->set_response(false, 'Tambah data mesin ['.$input['id_mesin'].'] - '.$input['nama_mesin'].' Gagal');
            }
        }
    }

    public function ubah_mesin()
    {
        $input = json_decode(file_get_contents('php://input'), true);

        $set_update = $this->setUpdateMachine($input);
        $update = $this->machine_model->updateMachineById($input['id_mesin'], $set_update);

        if($update == true){
            $this->set_response(true, 'Proses ubah data mesin berhasil');
        }
        else{
            $this->set_response(false, 'Proses ubah data mesin gagal');
        }
    }

    public function hapus_mesin($machine_id='')
    {
        if(empty($machine_id))
            $this->set_response(false, 'Silahkan input id mesin yang akan di hapus');

        $delete = $this->machine_model->removeMachineById($machine_id);

        if($delete == true){
            $this->set_response(true, 'Data berhasil di hapus');
        }
        else{
            $this->set_response(false, 'Data gagal di hapus');
        }
    }
}

/* End of file MachineController.php */

