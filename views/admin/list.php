
  
		<div class="col-md-10 border-right">
		<a href="<?php echo base_url().'index.php/article/index'?>" style="float:right;margin:10px 0 10px 20px;" class="btn btn-primary">添加文章</a>
			<table class="table table-striped">
		  <thead>
			<tr>
			  <th>#</th>
			  <th>文章标题</th>
			  <th>文章创建时间</th>
			  <th>文章操作</th>
			</tr>
		  </thead>
		  <tbody>
		  <?php
		   foreach($list as $key => $row) {
			   $index = $key+1;
			   $id = $row["aid"];
			   $n = $row["aname"];
			   $t = $row["createtime"];
			   $tstr = date('H:m:s  d. m. Y', $t);
			   $updateUrl = site_url("article/toUpdate/".$id);
			   $removeUrl = site_url('article/delete/'.$id);
			echo <<<EOF
			<tr id="{$id}">
				  <th scope="row">{$index}</th>
				  <td>{$n}</td>
				  <td>{$tstr}</td>
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
						$pageStr.= '<li><a class="active" href="'.base_url().'index.php/manage/index/'.$i.'">'.$i.'</a></li>';
					} else {
						$pageStr.= '<li><a  href="'.base_url().'index.php/manage/index/'.$i.'">'.$i.'</a></li>';
					}
				}
				$pageStr .= '</ul></nav>';
			} else {
				if(($page+1) == $count) {
					for($i = $page -4; $i <= $count; $i++) {
						//active 
						if($i == $page) {
							$pageStr.= '<li><a class="active" href="'.base_url().'index.php/manage/index/'.$i.'">'.$i.'</a></li>';
						} else {
							$pageStr.= '<li><a  href="'.base_url().'index.php/manage/index/'.$i.'">'.$i.'</a></li>';
						}
					}
				} else {
					for($i = $page -3; $i <= $page+1; $i++) {
						//active 
						if($i == $page) {
							$pageStr.= '<li><a class="active" href="'.base_url().'index.php/manage/index/'.$i.'">'.$i.'</a></li>';
						} else {
							$pageStr.= '<li><a href="'.base_url().'index.php/manage/index/'.$i.'">'.$i.'</a></li>';
						}
					}
				}
				$pageStr .= '</ul></nav>';
			}
			echo $pageStr;
		?>
	
		</div>
	</div>
	
	