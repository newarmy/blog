<?php
//前后文章模型类
class FrontModel extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
	/**
	* 分类查询
	*/
	function getArticleByClassify ($cid, $page, $size = 3) {
		$total = $this->_getTotalByClassify($cid);
		$pageCount = ceil($total/$size);
		$offset = $size*($page - 1);
		$sql = 'SELECT article.aid, article.aclassity, article.aname, article.acontent, classity.cname FROM article, classity WHERE article.aclassity = "'.$cid.'" AND article.aclassity = classity.cid ORDER BY article.createtime DESC LIMIT '.$offset.', '.$size;
		$res = $this->db->query($sql);
		if($res->num_rows() > 0) {
			return array('count' =>$pageCount,
			'page' => $page,
			'list' => $res->result_array());
		}
		return null;
		
	}	
	function _getTotalByClassify($cid) {
		$sql = 'select count(*) as count from article where aclassity = "'.$cid.'"';
		$res = $this->db->query($sql);
		$row = $res->row();
		//var_dump($res);
		//exit;
		return $row->count;
	}
	//获得最新的10篇文章
	function getLastArticle () {
		$sql = "SELECT article.aid, article.aname, article.acontent, classity.cname FROM article, classity WHERE article.aclassity = classity.cid ORDER BY article.createtime DESC LIMIT 10";
		$res = $this->db->query($sql);
		//var_dump($res->num_rows());
		//var_dump($res->result_array());
		//exit;
		if($res->num_rows() > 0) {
			return $res->result_array();
		} else {
			return null;
		}
	}
	//根据id查询
	function searchById($id) {
		$sql = "SELECT article.*, tag.tagname, classity.cname FROM article, tag, classity WHERE article.aid = '".$id."' AND article.atag = tag.tagid AND article.aclassity = classity.cid"; 
		$res = $this->db->query($sql);
		if($res->num_rows() == 1) {
			
			return $res->row_array();
		} else {
			return null;
		}
	}
	//get all classifies
	function getAllClassifies(){
		$sql = "SELECT cid , cname FROM classity";
		$res = $this->db->query($sql);
		if($res->num_rows() >= 1){
			return $res->result_array();
		} else {
			return null;
		}
			
	}
	// 推荐文章
	function getTuiJian() {
		$sql = "SELECT aid, aname FROM article WHERE recommend = 1 LIMIT 5";
		$res = $this->db->query($sql);
		if($res->num_rows() >= 1){
			return $res->result_array();
		} else {
			return null;
		}
	}
	
}
/* End of file user.php */
/* Location: ./application/models/user.php */