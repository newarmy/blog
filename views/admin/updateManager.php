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
				echo form_open('reg/update');
			  ?>
			  <input type="hidden" name="id" value="<?=$list['pid']?>">
				  <div class="form-group">
					<label for="title">用户名字</label>
					<input type="text" name="name" value="<?=$list['name']?>" class="form-control" id="name" placeholder="用户名字">
					<?php echo form_error('name')?>
				  </div>
				  <div class="form-group">
					<label for="title">用户密码</label>
					<input type="password" name="password" value="<?=$list['pwd']?>" class="form-control" id="password" placeholder="用户名字">
					<?php echo form_error('password')?>
				  </div>
				  <div class="form-group">
					<label for="title">用户级别</label>
					<select name="level">
						<option value="3" <?=($list['level'] == 3 ? 'selected': '')?>>3</option>
						<option value="2" <?=($list['level'] == 2 ? 'selected': '')?>>2</option>
						<option value="1" <?=($list['level'] == 1 ? 'selected': '')?>>1</option>
					</select>
					<?php echo form_error('level')?>
				  </div>
				  <button type="submit" class="btn btn-default form-submit">更新用户信息</button>
				</form>
			</div>
		</div>