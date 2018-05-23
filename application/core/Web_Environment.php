<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class Web_Environment extends CI_Controller 
{

    public function __construct()
    {
        parent::__construct();
    }

    public function render($_layout, $data)
    {
        $this->load->view($_layout, $data);
    }

    public function set_response($status, $data=null, $optional=null, $code=200)
    {
        $array = array(
            'status'   => ($status!=null) ? $status : false,
            'messages' => ($data!=null) ? $data : 'Tidak Ada Respon Data' 
        );

        if($optional != null)
            $array['optional'] = $optional;

        return $this->output->set_content_type('application/json')->set_status_header($code)->set_output(json_encode($array));
    }
    
}

/* End of file Web_Environment.php */
