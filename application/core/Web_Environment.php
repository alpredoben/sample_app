<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Web_Environment extends CI_Controller 
{

    var $_construct;

    
    public function __construct()
    {
        parent::__construct();

        if($this->session->userdata('is_login') == true)
        {
            $this->_container = $this->config->item(strtolower($this->session->userdata('level_name')).'_root');
        }
        else{
            redirect('pages/login', 'refresh');
        }
    }

    public function get_default($subtitle)
    {
        return array(
            'title' => 'PT. COFFINDO',
            'subtitle' => $subtitle,
            'login_level' => $this->session->userdata('level_name'),
            'login_name'  => $this->session->userdata('username')
        );
    }


    public function getScripts($scripts = null)
    {
        $js = array(
            path_template() . 'dist/js/site.min.js',
            path_web() . 'js/root_site.js',
			path_web() . 'js/components.js',
        );

        if($scripts != null){
            foreach ($scripts as $v) {
                array_push($js, $v);   
            }
        }
        return $js;
    }

    public function getStyles($styles = null)
    {
        $css = array(
            path_template() . 'dist/css/site.min.css',
        );

        if($styles != null){
            foreach ($styles as $v) {
                array_push($css, $v);
            }
        }

        return $css;
    }

    public function render($page='', $data)
    {
        if($page == '')
            $this->load->view($this->_container, $data);
        else
            $this->load->view($this->_container . $page, $data);
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
