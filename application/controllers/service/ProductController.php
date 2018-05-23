<?php  defined('BASEPATH') OR exit('No direct script access allowed');
session_start();
class ProductController extends Web_Environment {

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
    
        $this->load->model(array(
            'product_model'
        ));
    }

    private function setInsertProduct($input)
    {
        return array(
            'product_id'    => $input['id_produk'],
            'product_name'  => $input['nama_produk'],
            'status_data'   => 0,
            'create_date'   => date('Y-m-d H:i:s'), 
            'update_date'   => date('Y-m-d H:i:s')
        ); 
    }

    private function setUpdateProduct($input)
    {
        return array(
            'product_name'  => $input['nama_produk'],
            'update_date'   => date('Y-m-d H:i:s')
        ); 
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
    
    public function tampil_produk()
    {
        $product = $this->product_model->getAllProduct();
        if($product != false){
            $this->set_response(true, $product);
        }
        else{
            $this->set_response(false, 'No Record Product List');
        }
    }

    public function show_produk($product_id = '')
    {
        if(empty($product_id))
            $this->set_response(false, 'Data Produk Kosong');

        $data = $this->product_model->getProductById($product_id);

        if($data != false)
            $this->set_response(true, $data);
        else
            $this->set_response(false, 'Data ID Produk '.$product_id.' kosong');
    }

    public function tambah_produk()
    {
        $input = json_decode(file_get_contents('php://input'), true);

        $bools = $this->product_model->checkRecordProductBy($input['id_produk'], $input['nama_produk']);
        
        if($bools == true)
        {
            $this->set_response(false, 'Produk Kopi ['.$input['id_produk'].'] - '.$input['nama_produk']. ' sudah terdaftar dalam list');
        }
        else
        {
            $object = $this->setInsertProduct($input);
            $insert = $this->product_model->insertProduct($object);

            if($insert==true){
                $this->set_response(true,  'Tambah Produk Kopi ['.$input['id_produk'].'] - '.$input['nama_produk'].' Berhasil');
            }
            else{
                $this->set_response(false, 'Tambah Produk Kopi ['.$input['id_produk'].'] - '.$input['nama_produk'].' Gagal');
            }
        }
    }

    public function ubah_produk()
    {
        $input = json_decode(file_get_contents('php://input'), true);

        $set_update = $this->setUpdateProduct($input);
        $update = $this->product_model->updateProductById($input['id_produk'], $set_update);

        if($update == true){
            $this->set_response(true, 'Proses ubah data produk berhasil');
        }
        else{
            $this->set_response(false, 'Proses ubah data produk gagal');
        }
    }

    public function hapus_produk($product_id='')
    {
        if(empty($product_id))
            $this->set_response(false, 'Silahkan input id produk yang akan di hapus');

        $delete = $this->product_model->removeProductById($product_id);

        if($delete == true){
            $this->set_response(true, 'Data berhasil di hapus');
        }
        else{
            $this->set_response(false, 'Data gagal di hapus');
        }
    }
}

/* End of file ProductController.php */
