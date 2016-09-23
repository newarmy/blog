<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
* 前端文章控制器
*/
class FrontArticle extends CI_Controller {
    private $name = null; 
	function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->model('frontModel');
		//$this->output->cache(1);
		//设置时区
		//date_default_timezone_set('PRC'); 
		//读取session
		//$this->name = $this->session->userdata('user');
	}
	public function index() {
		$data['obj'] = array('ptitle'=> '董新军的博客首页', 'pkeyword'=> '董新军的博客首页', 'pdesc'=>'web前端知识积累，html5， css3，移动开发');
		$aRes = $this->frontModel->getLastArticle();
		$cRes = $this->frontModel->getAllClassifies();
		$tRes = $this->frontModel->getTuiJian();
		$data['alist'] = $aRes;
		$data['clist'] = $cRes;
		$data['tlist'] = $tRes;
		$data['curCid'] = '-1';
		$this->load->view('front/header', $data);
		$this->load->view('front/home', $data);
		$this->load->view('front/footer');
	}
	public function classify($cid, $page = 1, $size = 3) {
		$data['obj'] = array('ptitle'=> '董新军的博客首页', 'pkeyword'=> '董新军的博客首页', 'pdesc'=>'web前端知识积累，html5， css3，移动开发');
		$aRes = $this->frontModel->getArticleByClassify($cid, $page, $size);
		$cRes = $this->frontModel->getAllClassifies();
		$tRes = $this->frontModel->getTuiJian();
		$data['con'] = $aRes;
		$data['clist'] = $cRes;
		$data['tlist'] = $tRes;
		$data['curCid'] = $cid;
		$this->load->view('front/header', $data);
		$this->load->view('front/list', $data);
		$this->load->view('front/footer');
	}
	public function article($id) {
		$cRes = $this->frontModel->getAllClassifies();
		$aRes = $this->frontModel->searchById($id);
		$tRes = $this->frontModel->getTuiJian();
		//var_dump($cRes);
		$data['obj'] = $aRes;
		$data['clist'] = $cRes;
		$data['tlist'] = $tRes;
		$data['curCid'] = '-2';
		$this->load->view('front/header', $data);
		$this->load->view('front/content', $data);
		$this->load->view('front/footer');
	}
	
	
	
}
