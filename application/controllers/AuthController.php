<?php defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends Auth_Environment 
{	

	public function __construct()
	{
		parent::__construct();
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
				'user_id' 	=> $data_user['user_id'],
				'username'	=> $data_user['username'],
				'user_pwd' 	=> $data_user['password'],
				'level_id' 	=> $data_user['level_id'],
				'level_name'=> $data_user['level_name'],
				'is_login' 	=> true
			);

			$this->session->set_userdata( $sess_data );
			

			$this->set_response( true,  base_url(). strtolower($sess_data['level_name']));
		}
		else{
			$this->set_response(false, 'ID dan Password User Tidak Valid. Mohon Periksa Kembali');
		}
		
	}
}
