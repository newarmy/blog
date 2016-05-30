		<?php 
		if(!empty($msg)){
			$string =<<<EOF
			<div style="color:#f00"> {$msg}</div>
EOF;
			echo $string;
		}
	?>
			<div class="col-md-10 border-right padding-top">
				 <?php
				//$attributes = array('class'=> 'form-horizontal');
				echo form_open('classify/update');
			  ?>
			  <input type="hidden" name="cid" value="<?=$list['cid']?>">
				  <div class="form-group">
					<label for="title">分类名字</label>
					<input type="text" name="name" value="<?=$list['cname']?>" class="form-control" id="name" placeholder="分类名字">
					<?php echo form_error('name')?>
				  </div>
				  <div class="form-group">
					<label for="title">分类路径</label>
					<input type="text" name="directory" value="<?=$list['directory']?>" class="form-control" id="directory" placeholder="分类路径">
					<?php echo form_error('directory')?>
				  </div>
				  <button type="submit" class="btn btn-default form-submit">更新分类</button>
				</form>
			</div>
		</div>