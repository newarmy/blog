
  
		<div class="col-md-10 border-right">
		<a href="<?php echo base_url().'index.php/user/index'?>" style="float:right;margin:10px 0 10px 20px;" class="btn btn-primary">添加分类</a>
			<table class="table table-striped">
		  <thead>
			<tr>
			  <th>#</th>
			  <th>用户名称</th>
			  <th>用户级别</th>
			  <th>操作</th>
			</tr>
		  </thead>
		  <tbody>
		  <?php
		   foreach($list as $key => $row) {
			   $index = $key+1;
			   $id = $row["pid"];
			   $n = $row["name"];
			   $level = $row['level'];
			   $updateUrl = site_url("user/toUpdate/".$id);
			   $removeUrl = site_url('user/delete/'.$id);
			echo <<<EOF
			<tr id="{$id}">
				  <th scope="row">{$index}</th>
				  <td>{$n}</td>
				  <td>{$level}</td>
				  <td>
					<a  href="{$updateUrl}" >更新</a> |
					<a href="{$removeUrl}" class="remove">删除</a>
				  </td>
				</tr>
EOF;
		   }
		  ?>
		  
		  </tbody>
		</table>
		<?php 
			$pageStr = '<nav><ul class="pagination">';
			if($count == 0) {
				$pageStr = '';
			}else if($count <= 5) {
				for($i = 1; $i <= $count; $i++) {
					//active 
					if($i == $page) {
						$pageStr.= '<li><a class="active" href="'.base_url().'index.php/manage/manageClassify/'.$i.'">'.$i.'</a></li>';
					} else {
						$pageStr.= '<li><a  href="'.base_url().'index.php/manage/manageClassify/'.$i.'">'.$i.'</a></li>';
					}
				}
				$pageStr .= '</ul></nav>';
			} else {
				if(($page+1) == $count) {
					for($i = $page -4; $i <= $count; $i++) {
						//active 
						if($i == $page) {
							$pageStr.= '<li><a class="active" href="'.base_url().'index.php/manage/manageClassify/'.$i.'">'.$i.'</a></li>';
						} else {
							$pageStr.= '<li><a  href="'.base_url().'index.php/manage/manageClassify/'.$i.'">'.$i.'</a></li>';
						}
					}
				} else {
					for($i = $page -3; $i <= $page+1; $i++) {
						//active 
						if($i == $page) {
							$pageStr.= '<li><a class="active" href="'.base_url().'index.php/manage/manageClassify/'.$i.'">'.$i.'</a></li>';
						} else {
							$pageStr.= '<li><a href="'.base_url().'index.php/manage/manageClassify/'.$i.'">'.$i.'</a></li>';
						}
					}
				}
				$pageStr .= '</ul></nav>';
			}
			echo $pageStr;
		?>
	
		</div>
	</div>
	
	<script>
		function request(url, t) {
			var xmlHttp = new XMLHttpRequest();
			xmlHttp.open('get', url, true);
			xmlHttp.send(null);
			xmlHttp.onreadystatechange = function () {
				if(xmlHttp.readyState === 4 && xmlHttp.status == 200){
					data = xmlHttp.responseText;
					data = eval('('+data+')');
					if(data.code == 0){
						alert(data.msg);
						var tr = t.parentNode.parentNode;
						var tbody = tr.parentNode;
						tbody.removeChild(tr);
						tr = null;
					} else {
						alert(data.msg);
					}
				}
			}
		}
		//删除文章
		var parent = document.getElementsByClassName('table').item(0);
		parent.addEventListener('click', function (e) {
			var t = e.target;
			var className = t.className;
			if(className != 'remove') {
				return;
			}
			e.preventDefault();
			var flag = window.confirm('您确定删除该文章吗？');
			if(flag) {
				var url = t.href;
				request(url, t);
			}
			
		});
	</script>