<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//分类控制器
class Classify extends CI_Controller {
    private $name = null; 
	//public  static $updateList = null;
	function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('user_agent');
		$this->load->library('session');
		$this->load->model('classifyModel');
		//设置时区
		date_default_timezone_set('PRC'); 
		//读取session
		$this->name = $this->session->userdata('user');
	}
	public function index()
	{
		
		if(!isset($this->name)) {
			//获得一个完整的 URL
			$loginUrl = site_url('/login/index');
			//重定向这个URL
			redirect($loginUrl);
			exit;
		}
		$data['name'] = $this->name;
		$data['nav'] = 3;
		$this->load->view('admin/header', $data);
		//$this->load->view('admin/header');
		$this->load->view('admin/nav', $data);
		$this->load->view('admin/addClassify');
		$this->load->view('admin/footer');
	}
	public function delete($id) {
		if(!isset($this->name)) {
			//获得一个完整的 URL
			$loginUrl = site_url('/login/index');
			//重定向这个URL
			redirect($loginUrl);
			exit;
		}
		$response = $this->classifyModel->deleteClassify($id);
		/*$this->output
    ->set_content_type('application/json')
    ->set_output(json_encode(array('foo' => 'bar')));*/
		//允许你设置你的页面的 MIME 类型，可以很方便的提供 JSON 数据、JPEG、XML 等等格式。
		$this->output->set_content_type('application/json');
		//允许你手工设置最终的输出字符串
		$this->output->set_output(json_encode($response));
	}
	public function toUpdate($id) {
		if(!isset($this->name)) {
			//获得一个完整的 URL
			$loginUrl = site_url('/login/index');
			//重定向这个URL
			redirect($loginUrl);
			exit;
		}
		
		$response = $this->classifyModel->searchById($id);
		if(empty($response)) {
			//获得一个完整的 URL
			//$manageUrl = site_url('/manage/manageClassify');
			//重定向这个URL
			//redirect($manageUrl);
			//exit;
		}
		//$this->updateList = $response;
		//var_dump($this->updateList);
		$data['name'] = $this->name;
		$data['nav'] = 3;
		$data['list'] = $response;
		$this->load->view('admin/header', $data);
		//$this->load->view('admin/header');
		$this->load->view('admin/nav', $data);
		$this->load->view('admin/updateClassify', $data);
		$this->load->view('admin/footer');
	}
	/*
	* 更新分类
	*/
	public function update() {
		$this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
		$this->form_validation->set_rules('name', '分类名称',
		'required|max_length[20]',
		array('required'=> '分类名字不能为空',
			'max_length'=> '分类名字不能大于20个字符'));
		$this->form_validation->set_rules('directory', '分类路径',
		'required|max_length[20]',
		array(
			'required'=> '分类路径不能为空',
			'max_length'=> '分类路径不能大于20个字符'
		));
		$arr['cid'] = $this->input->post('cid');
		$arr['cname'] = $this->input->post('name');
		$arr['directory'] = $this->input->post('directory');
		if($this->form_validation->run() == false) {
			$data['name'] = $this->name;
			$data['nav'] = 3;
			$data['list'] = $arr;
			$this->load->view('admin/header', $data);
			//$this->load->view('admin/header');
			$this->load->view('admin/nav', $data);
			$this->load->view('admin/updateClassify', $data);
			$this->load->view('admin/footer');
		} else {
			$response = $this->classifyModel->updateClassify($arr);
			if($response['code'] == 0) {
				$manageUrl = site_url('/manage/manageClassify');
				//header("location:".$loginUrl );
				//通过 HTTP 头重定向到指定 URL 。
				//你可以指定一个完整的 URL ，也可以指定一个 URL 段，
				//该函数会根据配置文件自动生成改 URL 。
				redirect($manageUrl);
				//redirect($this->agent->referrer());
			} else {
				$data['name'] = $this->name;
				$data['nav'] = 3;
				$data['list'] = $arr;
				//var_dump($this->updateList);
				$data['msg'] = $response['msg'];
				$this->load->view('admin/header', $data);
				$this->load->view('admin/nav', $data);
				$this->load->view('admin/updateClassify', $data);
				$this->load->view('admin/footer');
			}
		}
	}
	/*
	* 添加分类
	*/
	public function add() {
		$this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
		$this->form_validation->set_rules('name', '分类名字',
		'required|max_length[20]',
		array(
			'required'=> '分类名字不能为空',
			'max_length'=> '分类名字不能大于20个字符'
		));
		$this->form_validation->set_rules('directory', '分类路径',
		'required|max_length[20]',
		array(
			'required'=> '分类路径不能为空',
			'max_length'=> '分类路径不能大于20个字符'
		));
		
		if($this->form_validation->run() == false) {
			$data['name'] = $this->name;
			$data['nav'] = 2;
			$this->load->view('admin/header', $data);
			//$this->load->view('admin/header');
			$this->load->view('admin/nav', $data);
			$this->load->view('admin/addClassify');
			$this->load->view('admin/footer');
		} else {
			$arr['cname'] = $this->input->post('name');
			$arr['directory'] = $this->input->post('directory');
			$response = $this->classifyModel->add($arr);
			if($response['code'] == 0) {
				$manageUrl = site_url('/manage/manageClassify');
				//header("location:".$loginUrl );
				//通过 HTTP 头重定向到指定 URL 。
				//你可以指定一个完整的 URL ，也可以指定一个 URL 段，
				//该函数会根据配置文件自动生成改 URL 。
				redirect($manageUrl);
			} else {
				$data['name'] = $this->name;
				$data['nav'] = 2;
				$this->load->view('admin/header', $data);
				$this->load->view('admin/nav', $data);
				$this->load->view('admin/addClassify', $response);
				$this->load->view('admin/footer');
			}
		}
		
	}
	
	
}
