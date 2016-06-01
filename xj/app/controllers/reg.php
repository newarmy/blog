<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reg extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('person');
		//读取session
		$this->name = $this->session->userdata('user');
	}
	public function index()
	{
		$this->load->view('admin/reg');
	}
	public function toUpdate($id) {
		if(!isset($this->name)) {
			//获得一个完整的 URL
			$loginUrl = site_url('/login/index');
			//重定向这个URL
			redirect($loginUrl);
			exit;
		}
		$data['name'] = $this->name;
		$data['nav'] = 4;
		
		$response = $this->person->searchById($id);
		$data['list'] = $response;
		$this->load->view('admin/header', $data);
		//$this->load->view('admin/header');
		$this->load->view('admin/nav', $data);
		$this->load->view('admin/updateManager', $data);
		$this->load->view('admin/footer');
	}
	public function update() {
		$n = $this->input->post('name');
		$p = $this->input->post('password');
		$l = $this->input->post('level');
		$id = $this->input->post('id');
		//全局的修改定界符 
		$this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
		//验证规则
		$this->form_validation->set_rules('name', '用户名', 'required|min_length[5]|max_length[20]', 
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
		$arr['name'] = $n;
		$arr['pwd'] = $p;
		$arr['level'] = $l;
		$arr['pid'] = $id;
		//验证方法
		if($this->form_validation->run() == FALSE) {//验证失败
			//forword
			$data['name'] = $this->name;
			$data['nav'] = 4;
			$data['list'] = $arr;
			$this->load->view('admin/header', $data);
			//$this->load->view('admin/header');
			$this->load->view('admin/nav', $data);
			$this->load->view('admin/updateManager', $data);
			$this->load->view('admin/footer');
		} else {//验证成功
			
			$response = $this->person->updateUser($arr);
			if($response['code'] === 0) {
				$manageUser = site_url('/manage/manageUser');
				//header("location:".$loginUrl );
				//通过 HTTP 头重定向到指定 URL 。
				//你可以指定一个完整的 URL ，也可以指定一个 URL 段，
				//该函数会根据配置文件自动生成改 URL 。
				redirect($manageUser);
			} else {
				$data['name'] = $this->name;
				$data['nav'] = 4;
				
				$data['list'] = $arr;
				$this->load->view('admin/header', $data);
				//$this->load->view('admin/header');
				$this->load->view('admin/nav', $data);
				$this->load->view('admin/updateManager', $data);
				$this->load->view('admin/footer');
			}	
		}
	}
	public function delete($id) {
		if(!isset($this->name)) {
			//获得一个完整的 URL
			$loginUrl = site_url('/login/index');
			//重定向这个URL
			redirect($loginUrl);
			exit;
		}
		$response = $this->person->delete($id);
		/*$this->output
    ->set_content_type('application/json')
    ->set_output(json_encode(array('foo' => 'bar')));*/
		//允许你设置你的页面的 MIME 类型，可以很方便的提供 JSON 数据、JPEG、XML 等等格式。
		$this->output->set_content_type('application/json');
		//允许你手工设置最终的输出字符串
		$this->output->set_output(json_encode($response));
	}
	public function toAdd()
	{
		if(!isset($this->name)) {
			//获得一个完整的 URL
			$loginUrl = site_url('/login/index');
			//重定向这个URL
			redirect($loginUrl);
			exit;
		}
		$data['name'] = $this->name;
		$data['nav'] = 4;
		$this->load->view('admin/header', $data);
		//$this->load->view('admin/header');
		$this->load->view('admin/nav', $data);
		$this->load->view('admin/addManager');
		$this->load->view('admin/footer');
	}
	public function add() {
		$n = $this->input->post('name');
		$p = $this->input->post('password');
		$l = $this->input->post('level');
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
		$arr['name'] = $n;
		$arr['pwd'] = $p;
		$arr['level'] = $l;
		//验证方法
		if($this->form_validation->run() == FALSE) {//验证失败
			//forword
			$data['name'] = $this->name;
			$data['nav'] = 4;
			$this->load->view('admin/header', $data);
			//$this->load->view('admin/header');
			$this->load->view('admin/nav', $data);
			$this->load->view('admin/addManager', $data);
			$this->load->view('admin/footer');
		} else {//验证成功
			
			$response = $this->person->add($arr);
			if($response['code'] === 0) {
				$manageUser = site_url('/manage/manageUser');
				//header("location:".$loginUrl );
				//通过 HTTP 头重定向到指定 URL 。
				//你可以指定一个完整的 URL ，也可以指定一个 URL 段，
				//该函数会根据配置文件自动生成改 URL 。
				redirect($manageUser);
			} else {
				$data['name'] = $this->name;
				$data['nav'] = 4;
				$this->load->view('admin/header', $data);
				//$this->load->view('admin/header');
				$this->load->view('admin/nav', $data);
				$this->load->view('admin/addManager', $response);
				$this->load->view('admin/footer');
			}	
		}
		
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
