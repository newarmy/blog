<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends CI_Controller {
    private $name = null; 
	function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->model('articleModel');
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
		$data['nav'] = 1;
		$this->load->view('admin/header', $data);
		//$this->load->view('admin/header');
		$this->load->view('admin/nav', $data);
		$this->load->view('admin/addArticle');
		$this->load->view('admin/footer');
	}
	public function add() {
		$this->form_validation->set_error_delimiters('<p style="color:red">', '</p>');
		$this->form_validation->set_rules('title', '文章标题',
		'required|max_length[30]',
		array(
			'required'=> '文章标题不能为空',
			'max_length'=> '文章标题不能大于30个字符'
		));
		$this->form_validation->set_rules('content', '文章内容',
		'required',
		array(
			'required' => '文章内容不能为空'
		));
		$this->form_validation->set_rules('tag', '文章标签',
		'required',
		array(
			'required' => '文章标签不能为空'
		));
		$this->form_validation->set_rules('classify', '文章分类',
		'required',
		array(
			'required' => '文章分类不能为空'
		));
		$this->form_validation->set_rules('keywords', '当前页面关键字',
		'required|max_length[20]',
		array(
			'required' => '当前页面关键字不能为空',
			'max_length'=> '当前页面关键字不能大于20个字符'
		));
		$this->form_validation->set_rules('desc', '当前页面meta描述',
		'required|max_length[50]',
		array(
			'required' => '当前页面meta描述不能为空',
			'max_length'=> '当前页面meta描述不能大于50个字符'
		));
		$this->form_validation->set_rules('pageTitle', '当前页面title名称',
		'required|max_length[20]',
		array(
			'required' => '当前页面title名称不能为空',
			'max_length'=> '当前页面title名称不能大于20个字符'
		));
		
		if($this->form_validation->run() == false) {
			$data['name'] = $this->name;
			$data['nav'] = 1;
			$this->load->view('admin/header', $data);
			//$this->load->view('admin/header');
			$this->load->view('admin/nav', $data);
			$this->load->view('admin/addArticle');
			$this->load->view('admin/footer');
		} else {
			$arr['aname'] = $this->input->post('title');
			$arr['acontent'] = $this->input->post('content');
			$arr['aclassity'] = $this->input->post('classify');
			$arr['atag'] = $this->input->post('tag');
			$arr['pkeyword'] = $this->input->post('keywords');
			$arr['pdesc'] = $this->input->post('desc');
			$arr['ptitle'] = $this->input->post('pageTitle');
			$arr['filename'] = $this->input->post('filename');
			$today = date("j, n, Y");//返回时间字符串，用逗号间隔
			$tArr = explode(',',$today);//使用一个字符串分割另一个字符串,返回数组
			//int mktime ([ int $hour [, int $minute [, int $second [, int $month [, int $day [, int $year [, int $is_dst ]]]]]]] )
			$times = mktime(0,0,0,$tArr[1],$tArr[0],$tArr[2]);//取得一个日期的 Unix 时间戳
		
			$arr['createtime'] = $times;
			//$name = $this->session->userdata('user');
			$arr['createuser'] = $this->name;
			$arr['recommend'] = $this->input->post('recommend');
			$response = $this->articleModel->add($arr);
			if($response['code'] == 0) {
				$manageUrl = site_url('/manage/index');
				//header("location:".$loginUrl );
				//通过 HTTP 头重定向到指定 URL 。
				//你可以指定一个完整的 URL ，也可以指定一个 URL 段，
				//该函数会根据配置文件自动生成改 URL 。
				redirect($manageUrl);
			} else {
				$data['name'] = $this->name;
				$data['nav'] = 1;
				$this->load->view('admin/header', $data);
				//$this->load->view('admin/header');
				$this->load->view('admin/nav', $data);
				$this->load->view('admin/addArticle', $response);
				$this->load->view('admin/footer');
			}
		}
		
	}
	
	
}
