		<?php 
		$aname= $data['aname'];
		$aid= $data['aid'];
		$acontent= $data['acontent'];
		$aclassity= $data['aclassity'];
		$atag = $data['atag'];
		$pkeyword= $data['pkeyword'];
		$pdesc= $data['pdesc'];
		$ptitle= $data['ptitle'];
		$filename= $data['filename'];
		$createuser= $data['createuser'];
		$recommend= $data['recommend'];
	?>
	<textarea id='cccc' style="display:none"><?=$acontent?></textarea>
			<div class="col-md-10 border-right padding-top">
				 <?php
				//$attributes = array('class'=> 'form-horizontal');
				echo form_open('article/update');
			  ?>
			      <input type="hidden" name="createuser" value="<?=$createuser?>" >
				  <input type="hidden" name="aid" value="<?=$aid?>" >
				  <div class="form-group">
					<label for="title">文章标题</label>
					<input type="text" name="title" value="<?=$aname?>" class="form-control" id="title" placeholder="文章标题">
					<?php echo form_error('title')?>
				  </div>
				  <div class="form-group">
					<label for="content">文章内容</label>
					<script id="content" name="content"  type="text/plain" style="width:100%;height:300px;"></script>
					<?php echo form_error('content')?>
				  </div>
				  <div class="form-group">
					<label for="tag">文章标签</label>
					<select class="form-control" name="tag" id="tag">
					  <?php 
						$tagString = '';
						foreach($tagList as $key => $value) {
							if($atag == $value['tagid']) {
								$tagString .= '<option value="'.$value['tagid'].'"  selected>'.$value['tagname'].'</option>';	
							}else{
							$tagString .= '<option value="'.$value['tagid'].'">'.$value['tagname'].'</option>';
							}
						}
						echo $tagString;
					 ?>
					</select>
					<?php echo form_error('tag')?>
				  </div>
				  <div class="form-group">
					<label for="classify" >文章分类</label>
					<select class="form-control" name="classify" id="classify">
					  <option value="1" <?=($aclassity == 1) ? 'selected': ''?>>1</option>
					  <option value="2" <?=($aclassity == 2) ? 'selected': ''?>>2</option>
					  <option value="3" <?=($aclassity == 3) ? 'selected': ''?>>3</option>
					  <option value="4" <?=($aclassity == 4) ? 'selected': ''?>>4</option>
					  <option value="5" <?=($aclassity == 5) ? 'selected': ''?>>5</option>
					</select>
					<?php echo form_error('classify')?>
				  </div>
				  <div class="form-group">
					<label for="keywords">当前页面关键字(seo)</label>
					<input type="text" class="form-control" value="<?=$pkeyword?>" name="keywords" id="keywords" placeholder="文章标题">
					<?php echo form_error('keywords')?>
				 </div>
				  <div class="form-group">
					<label for="desc">当前页面meta描述(seo)</label>
					<input type="text" class="form-control" value="<?=$pdesc?>" name="desc" id="desc" placeholder="文章标题">
					<?php echo form_error('desc')?>
				 </div>
				  <div class="form-group">
					<label for="pageTitle">当前页面title名称(seo)</label>
					<input type="text" class="form-control" value="<?=$ptitle?>" name="pageTitle" id="pageTitle" placeholder="文章标题">
					<?php echo form_error('pageTitle')?>
				  </div>
				  
				  <div class="form-group">
					<label for="filename">静态文章文件名称</label>
					<input type="text" class="form-control" value="<?=$filename?>"  name="filename" id="filename" placeholder="文章标题">
					<?php echo form_error('filename')?>
				  </div>
				  <div class="form-group">
					<label style="display:block">文章是否被推荐</label>
					<label class="radio-inline">
					  <input type="radio" name="recommend" id="isStatic1" value="1" <?=($recommend == 1) ? 'checked': ''?>> 推荐 
					</label>
					<label class="radio-inline">
					  <input type="radio" name="recommend" id="isStatic2" value="0" <?=($recommend == 0) ? 'checked': ''?>> 不推荐 
					</label>
				  </div>
				  <button type="submit" class="btn btn-default form-submit">更新文章</button>
				</form>
			</div>
		</div>
		<script type="text/javascript" charset="utf-8" src="<?php echo base_url().'static/js/ueditor/ueditor.config.js'?>"></script>
		<script type="text/javascript" charset="utf-8" src="<?php echo base_url().'static/js/ueditor/ueditor.all.min.js'?>"> </script>
		<!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
		<!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
		<script type="text/javascript" charset="utf-8" src="<?php echo base_url().'static/js/ueditor/lang/zh-cn/zh-cn.js'?>"></script>
        <script type="text/javascript" charset="utf-8" src="<?php echo base_url().'static/js/updateArticle.js'?>"></script>
        