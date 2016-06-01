<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
		$this->load->view('admin/login');
	}
	public function loginIn() {
		$n = $this->input->post('name');
		$p = $this->input->post('password');
		//全局的修改定界符 
		$this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
		
		$this->form_validation->set_rules('name', '用户名', 'required|max_length[20]|min_length[5]',
		array('required' => '用户名不能为空', 
		'min_length' => '用户名应大于5个字符',
		'max_length' => '用户名应小于20个字符'));
		//验证规则
		$this->form_validation->set_rules('password', '密码', 'required|min_length[5]|max_length[20]', 
		array('required' => '密码不能为空', 
		'min_length' => '密码应大于3个字符',
		'max_length' => '密码应小于20个字符')
		);
		//checking
		if($this->form_validation->run() == false) {//fail
			//echo 'here';
			$this->load->view('admin/login');
		} else {
			$arr['name'] = $n;
			$arr['pwd'] = $p;
			$response = $this->person->loginIn($arr);
			
			if($response['code'] == 0) {
				//设置session数据
				$this->session->set_userdata('user', $response['name']);
				//获取绝对地址
				$manageUrl = site_url('manage/index');
				redirect($manageUrl);
			} else {
				//echo 'here 2';
				$this->load->view('admin/login', $response);
			}
		}
	} 
}
