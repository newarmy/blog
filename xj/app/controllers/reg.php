<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reg extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('person');
	}
	public function index()
	{
		$this->load->view('admin/reg');
	}
	
	public function reg() {
		$n = $this->input->post('name');
		$p = $this->input->post('password');
		//全局的修改定界符 
		$this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
		//验证规则
		$this->form_validation->set_rules('name', '用户名', 'required|min_length[5]|max_length[20]|callback_ishave', 
		array('required' => '用户名不能为空', 
		'min_length' => '用户名应大于5个字符',
		'max_length' => '用户名应小于20个字符')
		);
		
		
		//验证规则
		$this->form_validation->set_rules('password', '密码', 'required|min_length[5]|max_length[20]', 
		array('required' => '密码不能为空', 
		'min_length' => '密码应大于3个字符',
		'max_length' => '密码应小于20个字符')
		);
		
		//验证方法
		if($this->form_validation->run() == FALSE) {//验证失败
			//forword
			$this->load->view('admin/reg');
			//redirect('admin/reg');
		} else {//验证成功
			$arr['name'] = $n;
			$arr['pwd'] = $p;
			$arr['level'] = 3;
			$response = $this->person->add($arr);
			if($response['code'] === 0) {
				$loginUrl = site_url('/login/index');
				//header("location:".$loginUrl );
				//通过 HTTP 头重定向到指定 URL 。
				//你可以指定一个完整的 URL ，也可以指定一个 URL 段，
				//该函数会根据配置文件自动生成改 URL 。
				redirect($loginUrl);
			} else {
				$this->load->view('admin/reg', $response);
			}	
		}
		
	}
	//自定义规则  规则名字为：callback_ishave
	public function ishave($name){
		$response = $this->person->have($name);
		if($response) {
			return true;
		} else {
			$this->form_validation->set_message('ishave', '用户名已经存在');
			return false;
		}
	}
}
