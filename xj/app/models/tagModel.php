<?php
//标签模型类
class TagModel extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	//添加新标签
    function add($data) {
		$this->db->insert('tag', $data); 
		if($this->db->affected_rows() == 1){
			$res['code'] = 0;
			$res['msg'] = "添加标签成功";
			return $res;
		} else {
			$res['code'] = 1;
			$res['msg'] = "添加标签失败";
			return $res;
		}
	}
	
	function _getTotal() {
		$sql = 'select count(*) as count from tag';
		$res = $this->db->query($sql);
		$row = $res->row();
		//var_dump($res);
		//exit;
		return $row->count;
	}
	//列表页查询(分页)
	function searchTags($page, $size = 3){
		$total = $this->_getTotal();
		$pageCount = ceil($total/$size);
		$offset = $size*($page - 1);
		$sql1 = "select tagid, tagname FROM tag ORDER BY tagid DESC LIMIT {$offset}, {$size}";
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
		$sql = "SELECT tagid, tagname FROM tag ORDER BY tagid DESC";
		$res = $this->db->query($sql);
		return $res->result_array();
	}
	//根据id查询
	function searchById($id) {
		$sql = "select * from tag where tagid = ".$id;
		$res = $this->db->query($sql);
		if($res->num_rows() == 1) {
			return $res->row_array();
		} else {
			return null;
		}
	}
	//更新
	function updateTag($data){
		//$sql1 = "UPDATE article SET pwd ='".addslashes($newpwd)."' WHERE aid= '".$id."'";
		//$this->db->where('aid', $data['aid']);
		//$this->db->update('article', $data);
		$sql = "UPDATE tag SET tagname = '".$data['tagname']."' WHERE tagid = ".$data['tagid'];
		$this->db->query($sql);
		if($this->db->affected_rows() == 1){
			$res['code'] = 0;
			$res['msg'] = "更新标签成功";
			return $res;
		} else {
			$res['code'] = 1;
			$res['msg'] = "更新标签失败";
			return $res;
		}
			
	}
	
	function deleteTag($id){
		$this->db->where('tagid', $id);
		$this->db->delete('tag'); 
		if($this->db->affected_rows() == 1){
			$res['code'] = 0;
			$res['msg'] = "删除标签成功";
			return $res;
		} else {
			$res['code'] = 1;
			$res['msg'] = "更新标签失败";
			return $res;
		}
	}
}
/* End of file user.php */
/* Location: ./application/models/user.php */