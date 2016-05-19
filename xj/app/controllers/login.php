<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		//$this->load->library('input');
		$this->load->model('person');
	}
	public function index()
	{
		$this->load->view('admin/login');
	}
}
