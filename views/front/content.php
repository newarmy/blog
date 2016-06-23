
		<div class="row">
			<div class ="col-md-8 r-bd xj-article" >
				<h3><?php echo $obj['aname']?><span style="border:1px solid blue;padding:3px 10px;"><?php echo $obj['cname']?></em></h3>
				
				<?php echo $obj['acontent']?>
				
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