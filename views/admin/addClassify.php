		<?php 
		if(!empty($response)){
			$msg = $response['msg'];
			$string =<<<EOF
			<div style="color:#f00"> {$msg}</div>
EOF;
			echo $string;
		}
	?>
			<div class="col-md-10 border-right padding-top">
				 <?php
				//$attributes = array('class'=> 'form-horizontal');
				echo form_open('classify/add');
			  ?>
				  <div class="form-group">
					<label for="title">分类名字</label>
					<input type="text" name="name" class="form-control" id="name" placeholder="分类名字">
					<?php echo form_error('name')?>
				  </div>
				  <div class="form-group">
					<label for="title">分类路径</label>
					<input type="text" name="directory" class="form-control" id="directory" placeholder="分类路径">
					<?php echo form_error('directory')?>
				  </div>
				  <button type="submit" class="btn btn-default form-submit">创建分类</button>
				</form>
			</div>
		</div>