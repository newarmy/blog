<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('person');
	}
	public function index()
	{
		//读取session
		$name = $this->session->userdata('user');
		if(!isset($name)) {
			//获得一个完整的 URL
			$loginUrl = site_url('/login/index');
			//重定向这个URL
			redirect($loginUrl);
			exit;
		}
		$data['name'] = $name;
		$data['nav'] = 1;
		$this->load->view('admin/header', $data);
		$this->load->view('admin/nav', $data);
		$this->load->view('admin/list');
		$this->load->view('admin/footer');
	}
	public function manageTag()
	{
		//读取session
		$name = $this->session->userdata('user');
		if(!isset($name)) {
			//获得一个完整的 URL
			$loginUrl = site_url('/login/index');
			//重定向这个URL
			redirect($loginUrl);
			exit;
		}
		$data['name'] = $name;
		$data['nav'] = 2;
		$this->load->view('admin/header', $data);
		$this->load->view('admin/nav', $data);
		$this->load->view('admin/list');
		$this->load->view('admin/footer');
	}
	public function manageUser()
	{
		//读取session
		$name = $this->session->userdata('user');
		if(!isset($name)) {
			//获得一个完整的 URL
			$loginUrl = site_url('/login/index');
			//重定向这个URL
			redirect($loginUrl);
			exit;
		}
		$data['name'] = $name;
		$data['nav'] = 4;
		$this->load->view('admin/header', $data);
		$this->load->view('admin/nav', $data);
		$this->load->view('admin/list');
		$this->load->view('admin/footer');
	}
	public function manageClassify()
	{
		//读取session
		$name = $this->session->userdata('user');
		if(!isset($name)) {
			//获得一个完整的 URL
			$loginUrl = site_url('/login/index');
			//重定向这个URL
			redirect($loginUrl);
			exit;
		}
		$data['name'] = $name;
		$data['nav'] = 3;
		$this->load->view('admin/header', $data);
		$this->load->view('admin/nav', $data);
		$this->load->view('admin/list');
		$this->load->view('admin/footer');
	}
	
	
}
