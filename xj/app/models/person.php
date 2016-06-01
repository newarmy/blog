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
	function _getTotal() {
		$sql = 'select count(*) as count from person';
		$res = $this->db->query($sql);
		$row = $res->row();
		//var_dump($res);
		//exit;
		return $row->count;
	}
	function searchUsers($page, $limit = 3){
		$total = $this->_getTotal();
		$pageCount = ceil($total/$limit);
		$offset = $limit*($page -1);
		$sql1 = "select pid, name, level, pwd FROM person LIMIT {$offset}, {$limit}";
		$res1 = $this->db->query($sql1);
		if( $res1->num_rows()>0){
			return array('count' =>$pageCount,
			'page' => $page,
			'list' => $res1->result_array());
		}
		return null;
	}
	function searchById($id) {
		$this->db->where('pid', $id);
		$res = $this->db->from('person')->get();
		if($res->num_rows() == 1) {
			return $res->row_array();
		} else {
			return null;
		}
	}
	function updateUser($d){
		$sql1 = "UPDATE person SET pwd ='".$d['pwd']."', name ='".$d['name']."', level ='".$d['level']."'  WHERE pid= '".$d['pid']."'";
		$this->db->query($sql1);
		if($this->db->affected_rows() == 1){
			$res['code'] = 0;
			$res['msg'] = "更新用户成功";
			return $res;
		} else {
			$res['code'] = 1;
			$res['msg'] = "更新用户失败";
			return $res;
		}
			
	}
    
	
	function delete($id){
		$this->db->where('pid', $id);
		$this->db->delete('person'); 
		if($this->db->affected_rows() == 1){
			$res['code'] = 0;
			$res['msg'] = "删除用户成功";
			return $res;
		} else {
			$res['code'] = 1;
			$res['msg'] = "更新用户失败";
			return $res;
		}
	}
}
/* End of file user.php */
/* Location: ./application/models/user.php */