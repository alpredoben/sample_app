<?php defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends Auth_Environment 
{	

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		
		if($this->session->userdata('is_login') == true){
            redirect(strtolower($this->session->userdata('nama_level_pengguna')), 'refresh');
        }
		
		$this->load->model('user_model');
	}

	public function view_login()
	{
		$data["pages"]    = $this->config->item("auth_root") . "pages/login";
        $data["title"]    = "PT. COFFINDO";
		$data["subtitle"] = "LOGIN SAMPLE";
		
		$this->render('auth_layout', $data);
	}


	public function login_validate()
	{
		$input = json_decode(file_get_contents('php://input'), true);
	
		$data_user = $this->user_model->getRecordUserAccess($input['user_id'], $input['user_pwd']);

		if(is_array($data_user) && count($data_user) > 0 && $data_user != false)
		{
			$sess_data = array(
				'unik_id_pengguna' 		=> $data_user['user_id'],
				'nama_pengguna'			=> $data_user['username'],
				'pwd_pengguna' 			=> $data_user['password'],
				'id_level_pengguna' 	=> $data_user['level_id'],
				'nama_level_pengguna'	=> $data_user['level_name'],
				'is_login' 				=> TRUE
			);

			$this->session->set_userdata( $sess_data );
			
			$this->set_response( true,  base_url(). strtolower($sess_data['nama_level_pengguna']));
		}
		else{
			$this->set_response(false, 'ID dan Password User Tidak Valid. Mohon Periksa Kembali');
		}
	}

	
}
