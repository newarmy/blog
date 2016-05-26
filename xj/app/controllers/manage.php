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
		//设置时区
		date_default_timezone_set('PRC'); 
	}
	public function index($page = 1)
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
		/*
		array('count' =>$pageCount,
			'page' => $page,
			'list' => $res1->result_array());
		*/
		$this->load->model('articleModel');
		$articleRes = $this->articleModel->searchArticle($page, 5);
		$data['name'] = $name;
		$data['nav'] = 1;
		
		if(empty($articleRes)) {
			$data['count'] = 0;
			$data['page'] = 0;
			$data['list'] = array();
		} else {
			$data['count'] = $articleRes['count'];
			$data['page'] = $articleRes['page'];
			$data['list'] = $articleRes['list'];
		}
		
		$this->load->view('admin/header', $data);
		$this->load->view('admin/nav', $data);
		$this->load->view('admin/list', $data);
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
