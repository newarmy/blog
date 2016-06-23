<div class="row">
	<div class ="col-md-8 r-bd" >
		<ul class="xj-list g-li">
			
			<?php 
				//var_dump($alist);
				foreach($alist as $a) {
					$url = site_url('frontArticle/article/'.$a['aid']);
					$con = strip_tags($a['acontent']);//php去除字符串中的HTML标签
					/*一、中文截取：mb_substr() 
						mb_substr( $str, $start, $length, $encoding ) 

						$str，需要截断的字符串 
						$start，截断开始处，起始处为0 
						$length，要截取的字数 
						$encoding，网页编码，如utf-8,GB2312,GBK 
					*/
					$content = mb_substr($con, 0, 100, 'utf-8').'...';
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
		