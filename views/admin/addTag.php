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
				echo form_open('tag/add');
			  ?>
				  <div class="form-group">
					<label for="title">标签名字</label>
					<input type="text" name="name" class="form-control" id="name" placeholder="标签名字">
					<?php echo form_error('name')?>
				  </div>
				  <button type="submit" class="btn btn-default form-submit">创建标签</button>
				</form>
			</div>
		</div>