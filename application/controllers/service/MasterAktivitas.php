<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class MasterAktivitas extends Web_Environment {

    
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model(array(
            'penawaran_model',
            'user_model',
            'items_model'
        ));
    }

    
    
}

/* End of file MasterAktivitas.php */
