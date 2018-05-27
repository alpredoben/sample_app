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

    public function master_aktivasi_sales()
    {
        if(isset($_POST['search']))
            $search = $_POST['search']['value'];
        
        if(isset($_POST['draw']))
            $draw = $_POST['draw'];

        if(isset($_POST['length']))
            $length = $_POST['length'];

        if(isset($_POST['start']))
            $start = $_POST['start'];

        $record = $this->aktivasi_model->get_datatable_aktivasi($search, $length, $start, 2);
        //get_datatable_penawaran($search, $length, $start, $id_aktivasi='', $id_kategori='')
        
        $dTable = array();
        $no = $start;
        foreach ($record as $item) {
            $no++;
            
            $str = '<button type="button" id="btnBatalAktifasi" class="btn btn-primary" onclick="CancelActivation(\''.$item->id_penawaran.'\')">Batal Validasi</button> &nbsp;'; 

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
            "recordsTotal"      => $this->aktivasi_model->count_record_aktivasi(2),
            "recordsFiltered"   => $this->aktivasi_model->count_filter_aktivasi($search, 2),
            "data"              => $dTable,
        );

        echo json_encode($output);

    }
    
}

/* End of file MasterAktivasi.php */
