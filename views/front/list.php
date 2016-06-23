<div class="row">
	<div class ="col-md-8 r-bd" >
	<?php if(!empty($con)) {?>
		<ul class="xj-list g-li">
			
			<?php 
			    $alist = $con["list"];
				$count = $con["count"];
				$page = $con["page"];
				//var_dump($alist);
				foreach($alist as $a) {
					$url = site_url('frontArticle/article/'.$a['aid']);
					$cid = $a['aclassity'];
					$con1 = strip_tags($a['acontent']);//php去除字符串中的HTML标签
					/*一、中文截取：mb_substr() 
						mb_substr( $str, $start, $length, $encoding ) 

						$str，需要截断的字符串 
						$start，截断开始处，起始处为0 
						$length，要截取的字数 
						$encoding，网页编码，如utf-8,GB2312,GBK 
					*/
					$content = mb_substr($con1, 0, 100, 'utf-8').'...';
					//echo $content;
					//$content1 = strip_tags($content);
					//$content1 = preg_replace('/<[^>]+>/', '', $content);
					//echo $content1;
					$title = $a['aname'];
					$classify = $a['cname'];
					echo <<<EOT
					<li>
				<h3><em>{$classify}</em><a href="{$url}">{$title}</a></h3>
				<p>{$content}</p>
			</li>
EOT;
				}
			?>
			
		</ul>
		<?php 
			$pageStr = '<nav><ul class="pagination">';
			if($count == 0) {
				$pageStr = '';
			}else if($count <= 5) {
				for($i = 1; $i <= $count; $i++) {
					//active 
					if($i == $page) {
						$pageStr.= '<li><a class="active" href="'.base_url().'index.php/frontArticle/classify/'.$cid.'/'.$i.'">'.$i.'</a></li>';
					} else {
						$pageStr.= '<li><a  href="'.base_url().'index.php/frontArticle/classify/'.$cid.'/'.$i.'">'.$i.'</a></li>';
					}
				}
				$pageStr .= '</ul></nav>';
			} else {
				if(($page+1) == $count) {
					for($i = $page -4; $i <= $count; $i++) {
						//active 
						if($i == $page) {
							$pageStr.= '<li><a class="active" href="'.base_url().'index.php/frontArticle/classify/'.$cid.'/'.$i.'">'.$i.'</a></li>';
						} else {
							$pageStr.= '<li><a  href="'.base_url().'index.php/frontArticle/classify/'.$cid.'/'.$i.'">'.$i.'</a></li>';
						}
					}
				} else {
					for($i = $page -3; $i <= $page+1; $i++) {
						//active 
						if($i == $page) {
							$pageStr.= '<li><a class="active" href="'.base_url().'index.php/frontArticle/classify/'.$cid.'/'.$i.'">'.$i.'</a></li>';
						} else {
							$pageStr.= '<li><a href="'.base_url().'index.php/frontArticle/classify/'.$cid.'/'.$i.'">'.$i.'</a></li>';
						}
					}
				}
				$pageStr .= '</ul></nav>';
			}
			echo $pageStr;
		?>
	<?php } else {?>
		<h3>还没有相关文章呀</ul>
	<?php }?>
	</div>
	<div class ="col-md-4" >
		<h3>推荐文章</h3>
		<ul class="xj-list g-li">
			<?php 
				foreach($tlist as $t) {
					$url = site_url('frontArticle/article/'.$t['aid']);
					echo '<li><h4><em>推荐</em><a href="'.$url.'">'.$t['aname'].'</a></h4></li>';
				}
			?>
		</ul>
	</div>
</div>
		