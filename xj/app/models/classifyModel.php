<?php
//分类模型类
class ClassifyModel extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	//添加新分类
    function add($data) {
		$this->db->insert('classity', $data); 
		if($this->db->affected_rows() == 1){
			$res['code'] = 0;
			$res['msg'] = "添加分类成功";
			return $res;
		} else {
			$res['code'] = 1;
			$res['msg'] = "添加分类失败";
			return $res;
		}
	}
	
	function _getTotal() {
		$sql = 'select count(*) as count from classity';
		$res = $this->db->query($sql);
		$row = $res->row();
		//var_dump($res);
		//exit;
		return $row->count;
	}
	//列表页查询(分页)
	function searchClassifys($page, $size = 3){
		$total = $this->_getTotal();
		$pageCount = ceil($total/$size);
		$offset = $size*($page - 1);
		$sql1 = "select cid, cname, directory FROM classity ORDER BY cid DESC LIMIT {$offset}, {$size}";
		$res1 = $this->db->query($sql1);
		if( $res1->num_rows()>0){
			return array('count' =>$pageCount,
			'page' => $page,
			'list' => $res1->result_array());
		}
		return null;
	}
	//查询所有
	function searchAll() {
		$sql = "SELECT cid, cname, directory FROM classity ORDER BY cid DESC";
		$res = $this->db->query($sql);
		return $res->result_array();
	}
	//根据id查询
	function searchById($id) {
		$sql = "select * from classity where cid = ".$id;
		$res = $this->db->query($sql);
		if($res->num_rows() == 1) {
			return $res->row_array();
		} else {
			return null;
		}
	}
	//更新
	function updateClassify($data){
		//$sql1 = "UPDATE article SET pwd ='".addslashes($newpwd)."' WHERE aid= '".$id."'";
		//$this->db->where('aid', $data['aid']);
		//$this->db->update('article', $data);
		$sql = "UPDATE classity SET cname = '".$data['cname']."', directory = '".$data['directory']."'  WHERE cid = ".$data['cid'];
		$this->db->query($sql);
		if($this->db->affected_rows() == 1){
			$res['code'] = 0;
			$res['msg'] = "更新分类成功";
			return $res;
		} else {
			$res['code'] = 1;
			$res['msg'] = "更新分类失败";
			return $res;
		}
			
	}
	
	function deleteClassify($id){
		$this->db->where('cid', $id);
		$this->db->delete('classity'); 
		if($this->db->affected_rows() == 1){
			$res['code'] = 0;
			$res['msg'] = "删除分类成功";
			return $res;
		} else {
			$res['code'] = 1;
			$res['msg'] = "更新分类失败";
			return $res;
		}
	}
}
/* End of file user.php */
/* Location: ./application/models/user.php */