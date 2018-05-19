<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Authorize_section extends AuthenticObject 
{	
	public function __construct()
	{
		parent::__construct();
		
	}

	public function view_login()
	{
		$data["pages"]        = $this->config->item("auth_root") . "user/login";
        $data["nama_pln"]     = GetPLNNames();
        $data["title"]        = "PT. COFFINDO";
        $data["subtitle"]     = "LOGIN SAMPLE";
        $data["scripts"]      = array(
			
		);

        $data["designs"]      = array(

		);

        $data["ppob_menu"]    = $this->config->item("auth_root") . "master/ppob/menu_ppob";
        $data["table_layout"] = $this->config->item("auth_root") . "layout_belanja";
		$data["transactnav"]  = $this->config->item("auth_root") . "master/layout/masterTransactnav";
		
		$this->render('auth_layout', $data);
	}
	
}
