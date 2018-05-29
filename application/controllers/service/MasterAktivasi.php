<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class MasterAktivasi extends Web_Environment {

    
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model(array(
            'aktivasi_model'
        ));
    }

    public function master_aktivasi_sales($user_id = '')
    {
        if(isset($_POST['search']))
            $search = $_POST['search']['value'];
        
        if(isset($_POST['draw']))
            $draw = $_POST['draw'];

        if(isset($_POST['length']))
            $length = $_POST['length'];

        if(isset($_POST['start']))
            $start = $_POST['start'];

        $record = $this->aktivasi_model->get_datatable_aktivasi($search, $length, $start, $user_id, 2 );
        //get_datatable_penawaran($search, $length, $start, $id_aktivasi='', $id_kategori='')
        
        $dTable = array();
        $no = $start;
        foreach ($record as $item) {
            $no++;
            
            $str = '<button type="button" id="btnBatalAktifasi" class="btn btn-danger" onclick="CancelActivation(\''.$item->id_penawaran.'\')">Batal Validasi</button> &nbsp;'; 

            $dTable[] = array(
                $no,
                $item->kode_item,
                $item->nama_item,
                strtoupper($item->nama_kategori),
                number_format($item->kuantitas, 0, ",", "."),
                number_format($item->harga_item, 0, ",", "."),
                $item->diskon,
                '<span style="background:blue; padding:5px; color:#fff;">'.$item->nama_aktifasi.'</span>',
                $item->active_date,
                $str
            );
        }
     
        $output = array(
            "draw"              => $draw,
            "recordsTotal"      => $this->aktivasi_model->count_record_aktivasi($user_id, 2),
            "recordsFiltered"   => $this->aktivasi_model->count_filter_aktivasi($search, $user_id, 2),
            "data"              => $dTable,
        );

        echo json_encode($output);

    }

    public function get_info_aktivasi()
    {
        $info = $this->aktivasi_model->get_info_aktivasi(2);
        if($info != false)
            $this->set_response(true, count($info));
        else
            $this->set_response(false, 'No Record');
    }

    public function show_datatable_aktivasi($sales_id = '', $user_id='')
    {
        if(isset($_POST['search']))
            $search = $_POST['search']['value'];
        
        if(isset($_POST['draw']))
            $draw = $_POST['draw'];

        if(isset($_POST['length']))
            $length = $_POST['length'];

        if(isset($_POST['start']))
            $start = $_POST['start'];
        

        $record = $this->aktivasi_model->get_wait_activated($search, $length, $start, 2, $user_id);

        $dTable = array();

        $no = $start;
        foreach ($record as $item) {

            //'pn.id_penawaran, it.id_item, it.kode_item, it.nama_item, pn.kuantitas, pn.harga_item, pn.diskon, kt.id_kategori, kt.nama_kategori, s.id_status, s.keterangan, st.id_stok, st.status_stok, ak.id_aktifasi, ak.nama_aktifasi, us.user_id, us.username pn.active_date'


            $no++;
            
            $str = '<button type="button" id="btnApproveActivated" class="btn btn-primary" onclick="ApproveActivated(\''.$item->user_id.'\',\''.$item->id_penawaran.'\')">Aktifkan</button> &nbsp;';

            $dTable[] = array(
                $no,
                $item->kode_item,
                $item->nama_item,
                strtoupper($item->nama_kategori),
                $item->username,
                number_format($item->kuantitas, 0, ",", "."),
                $item->diskon,
                number_format($item->harga_item, 0, ",", "."),
                '<span style="background:blue; padding:5px; color:#fff;">'.$item->nama_aktifasi.'</span>',
                $item->active_date,
                $str
            );
        }
     
        $output = array(
            "draw"              => $draw,
            "recordsTotal"      => $this->aktivasi_model->count_record_wait_aktivasi(2, $user_id),
            "recordsFiltered"   => $this->aktivasi_model->count_filter_wait_aktivasi($search, 2, $user_id),
            "data"              => $dTable,
        );

        echo json_encode($output);
    }
    
    /** ########################################### SET ACTIVATED #################################### */
    public function set_item_activated()
    {
        $input = json_decode(file_get_contents('php://input'), true);
        
        if(isset($input['id_pengguna']))
            $user_id = $input['id_pengguna'];

        if(isset($input['id_penawaran']))
            $id_penawaran = $input['id_penawaran'];

        $time_activated = date('Y-m-d H:i:s');
        $id_po = 'SOP-'.$id_penawaran.'-'.date('YmdHis');

        $active_data = $this->aktivasi_model->set_activated_item($id_po, $user_id, $id_penawaran, $time_activated);
        
        if($active_data != false)
            $this->set_response(true, 'Item berhasil diaktivasi');
        else
            $this->set_response(false, 'Aktivasi penawaran gagal');
        
    }
}

/* End of file MasterAktivasi.php */
