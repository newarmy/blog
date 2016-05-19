<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reg extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		//$this->load->library('input');
		$this->load->model('person');
	}
	public function index()
	{
		$this->load->view('admin/reg');
	}
	
	public function reg() {
		$n = $this->input->post('name');
		$p = $this->input->post('password');
		if(empty($n) ||  empty($p)) {
			$res['reason'] = '名字或密码为空';
			$this->load->view('admin/reg', $res);
			return;
		}
		$arr['name'] = $n;
		$arr['pwd'] = $p;
		$arr['level'] = 3;
		$response = $this->person->add($arr);
		if($response['code'] === 0) {
			$loginUrl = site_url('/login/index');
			header("location:".$loginUrl );
		} else {
			$this->load->view('admin/reg', $response);
		}
	}
}
