<?php

class Person extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	//添加新用户
    function add($data) {
		$this->db->insert('person', $data); 
		if($this->db->affected_rows() == 1){
			$res['code'] = 0;
			$res['msg'] = "存储成功";
			return $res;
		} else {
			$res['code'] = 1;
			$res['msg'] = "存储失败";
			return $res;
		}
	}
	//查询有没有用户
	public function have($name) {
		$this->db->select('name');
		$this->db->where('name', $name);
		$query = $this->db->get('person');
		
		if($query->num_rows() == 1){
			return false;
		} else {
			return true;
		}
	}
	//登录
    function loginIn($data){
		
		$sql = 'SELECT name, pwd, level FROM person WHERE name = "'.$data['name'].'"';
		$res = $this->db->query($sql);
		
		if($res->num_rows() > 0){
			$r = $res->row_array();
			if($data['pwd'] == $r['pwd']){
				$res1['code'] = 0;
				$res1['name'] = $r['name'];
				$res1['pwd'] = $r['pwd'];
				return $res1;
			}else {
				$res1['code'] = 1;
				$res1['msg'] = "登录失败";
				return $res;
			}
		} else {
			$res1['code'] = 1;
			$res1['msg'] = "登录失败";
			return $res;
		}
	}
	
	function searchUsers(){
		if(empty($_GET['page'])||$_GET['page']<0){ 
			$page = 1; 
		}else { 
			$page=$_GET['page']; 
		} 
		$size = 3;
		$sql = "select name, level, pwd FROM person WHERE 1";
		$res = $this->db->query($sql);
		$total = $res->num_rows();
		$pageCount = ceil($total/$size);
		$offset = $size*($page -1);
		$sql1 = "select name, level, pwd FROM person LIMIT {$offset}, {$size}";
		$res1 = $this->db->query($sql1);
		if( $res1->num_rows()>0){
			return array('count' =>$pageCount,
			'page' => $page,
			'list' => $res1->result_array());
		}
		return null;
	}
	function createUser(){
		$name = $_POST['name'];
		$pwd = $_POST['pwd'];
		$level = $_POST['level'];
		if(empty($name)){
			return 4;
		}
		if(empty($pwd)){
			return 5;
		}
		$this->db->select('name');
		$this->db->where('name',$name);
		$query = $this->db->get('person');
		if($query->num_rows() == 1){
			return 1;
		}
		$data = array(
               'name' => $name,
               'pwd' => $pwd,
               'level' => $level
            );
		$this->db->insert('person', $data); 
		if($this->db->affected_rows() == 1){
					return 3;
				} else {
					return 2;
				}
	}
	function updateUser(){
		$name = $_POST['name'];
		$oldpwd = $_POST['oldpwd'];
		$newpwd = $_POST['newpwd'];
		if(empty($name)){
			return 4;
		}
		if(empty($oldpwd)){
			return 5;
		}
		if(empty($newpwd)){
			return 6;
		}
		$sql = 'select pwd from person where name="'.addslashes($name).'"';
		$r =  $this->db->query($sql);
		if($r->num_rows() == 1){
			$row =$r->row_array();
			if($row['pwd'] == $oldpwd){
				$sql1 = "UPDATE person SET pwd ='".addslashes($newpwd)."' WHERE name= '".addslashes($name)."'";
				$this->db->query($sql1);
				if($this->db->affected_rows() == 1){
					return 3;
				} else {
					return 2;
				}
			} else {
				return 1;
			}
		}
	}
    
    function register()
    {
        $name = $_POST['name'];
		$pwd = $_POST['pwd'];
		if(empty($name)){
			return 4;
		}
		if(empty($pwd)){
			return 5;
		}
		$this->db->select('name');
		$this->db->where('name',$name);
		$query = $this->db->get('person');
		if($query->num_rows() == 1){
			return 1;
		}
		$data = array(
               'name' => $name,
               'pwd' => $pwd,
               'level' => 1
            );
		$this->db->insert('person', $data); 
		if($this->db->affected_rows() == 1){
			return 3;
		} else {
			return 2;
		}
	}
	
	function delete(){
		$name = $_GET['name'];
		$this->db->where('name', $name);
		$this->db->delete('person'); 
		if($this->db->affected_rows() == 1){
			return 2;
		} else {
			return 1;
		}
	}
}
/* End of file user.php */
/* Location: ./application/models/user.php */