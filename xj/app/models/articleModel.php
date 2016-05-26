<?php

class ArticleModel extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	//添加新文章
    function add($data) {
		$this->db->insert('article', $data); 
		if($this->db->affected_rows() == 1){
			$res['code'] = 0;
			$res['msg'] = "添加文章成功";
			return $res;
		} else {
			$res['code'] = 1;
			$res['msg'] = "添加文章失败";
			return $res;
		}
	}
	
	function _getTotal() {
		$sql = 'select count(*) as count from article';
		$res = $this->db->query($sql);
		$row = $res->row();
		//var_dump($res);
		//exit;
		return $row->count;
	}
	//列表页查询
	function searchArticle($page, $size = 3){
		$total = $this->_getTotal();
		$pageCount = ceil($total/$size);
		$offset = $size*($page - 1);
		$sql1 = "select aid, aname, createtime FROM article ORDER BY aid DESC LIMIT {$offset}, {$size}";
		$res1 = $this->db->query($sql1);
		if( $res1->num_rows()>0){
			return array('count' =>$pageCount,
			'page' => $page,
			'list' => $res1->result_array());
		}
		return null;
	}
	//根据id查询文章
	function searchById($id) {
		$sql = "select * from article where aid = ".$id;
		$res = $this->db->query($sql);
		if($res->num_rows() == 1) {
			return $res->row_array();
		} else {
			return null;
		}
	}
	//更新文章
	function updateArticle($data){
		//$sql1 = "UPDATE article SET pwd ='".addslashes($newpwd)."' WHERE aid= '".$id."'";
		$this->db->where('aid', $data['aid']);
		$this->db->update('article', $data);
		if($this->db->affected_rows() == 1){
			$res['code'] = 0;
			$res['msg'] = "更新文章成功";
			return $res;
		} else {
			$res['code'] = 1;
			$res['msg'] = "更新文章失败";
			return $res;
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
	
	function deleteArticle($id){
		$this->db->where('aid', $id);
		$this->db->delete('article'); 
		if($this->db->affected_rows() == 1){
			$res['code'] = 0;
			$res['msg'] = "删除文章成功";
			return $res;
		} else {
			$res['code'] = 1;
			$res['msg'] = "更新文章失败";
			return $res;
		}
	}
}
/* End of file user.php */
/* Location: ./application/models/user.php */