<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class MasterAktivasi extends Web_Environment {

    private $search;
    private $length;
    private $start;
    private $draw;

    
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model(array(
            'aktivasi_model'
        ));
    }

    private function call_io_datatable()
    {
        if(isset($_POST['search']))
            $this->search = $_POST['search']['value'];
        
        if(isset($_POST['draw']))
            $this->draw = $_POST['draw'];

        if(isset($_POST['length']))
            $this->length = $_POST['length'];

        if(isset($_POST['start']))
            $this->start = $_POST['start'];
    }

    public function master_aktivasi_sales($user_id = '')
    {
        $this->call_io_datatable();
        $record = $this->aktivasi_model->get_datatable_aktivasi($this->search, $this->length, $this->start, $user_id, 2 );
        
        $dTable = array();
        $no = $this->start;
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
            "draw"              => $this->draw,
            "recordsTotal"      => $this->aktivasi_model->count_record_aktivasi($user_id, 2),
            "recordsFiltered"   => $this->aktivasi_model->count_filter_aktivasi($this->search, $user_id, 2),
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
        $this->call_io_datatable();
        $record = $this->aktivasi_model->get_wait_activated($this->search, $this->length, $this->start, 2, $user_id);
        $dTable = array();
        $no = $this->start;
        foreach ($record as $item) {
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
                '<span style="background:#ffcc00; padding:5px; color:#fff;">'.$item->nama_aktifasi.'</span>',
                $item->active_date,
                $str
            );
        }
     
        $output = array(
            "draw"              => $this->draw,
            "recordsTotal"      => $this->aktivasi_model->count_record_wait_aktivasi(2, $user_id),
            "recordsFiltered"   => $this->aktivasi_model->count_filter_wait_aktivasi($this->search, 2, $user_id),
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

    /** Datatable Purchase Order */
    public function purchase_order()
    {   
        $this->call_io_datatable();

        $record = $this->aktivasi_model->get_purchase_order($this->search, $this->length, $this->start);
        $dTable = array();

        $no = $this->start;
        foreach ($record as $item) 
        {
            $no++;
            $str = '<button type="button" id="btnRemoveActivated" class="btn btn-danger" onclick="RemoveActivated(\''.$item->po_code.'\')">Remove</button> &nbsp;';

            //$fields  = 'po.po_code, pn.id_penawaran, it.kode_item, it.nama_item, kt.nama_kategori, pn.kuantitas, pn.diskon, pn.harga_item';
            //$fields .= 'ak.nama_aktifasi, st.keterangan, us.username, po.activation_date';

            $dTable[] = array(
                $no,
                $item->po_code,
                $item->kode_item,
                $item->nama_item,
                strtoupper($item->nama_kategori),
                number_format($item->kuantitas, 0, ",", "."),
                $item->diskon,
                number_format($item->harga_item, 0, ",", "."),
                '<span style="background:#00b3b3; padding:5px; color:#fff; ">'.$item->nama_aktifasi.' , '.$item->keterangan.'</span>',
                $item->activation_date,
                $str
            );
        }
     
        $output = array(
            "draw"              => $this->draw,
            "recordsTotal"      => $this->aktivasi_model->count_record_po(),
            "recordsFiltered"   => $this->aktivasi_model->count_filter_po($this->search),
            "data"              => $dTable,
        );

        echo json_encode($output);
    }
}

/* End of file MasterAktivasi.php */
