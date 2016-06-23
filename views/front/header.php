<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <title><?=$obj['ptitle'];?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="<?=$obj['pdesc'];?>" />
	<meta name="keywords" content="<?=$obj['pkeyword'];?>" />


    <!-- Bootstrap -->
    <link href="<?= base_url().'static/css/bootstrap.css'?>" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<link href="<?= base_url().'static/css/front.css'?>" rel="stylesheet">
  </head>
  <body>
	<div class="container">
		<ul class="top-box g-li">
		  <li class="active">logo</li>
		  <li class="right"><a href="#" class="login">登录</a></li>
		  <li class="right"><a href="#">注册</a></li>
		</ul>
		<ul class="xj-nav g-li">
			<?php if($curCid == '-1') {?>
		   <li  class="active"><a href="<?=site_url('frontArticle/index')?>">首页</a></li>
			<?php } else {?>
				<li><a href="<?=site_url('frontArticle/index')?>">首页</a></li>
			<?php }?>
		  <?php 
			foreach($clist as $key => $v ){
				$url = site_url('frontArticle/classify/'.$v['cid']);
				if($curCid == $v['cid']) {
				   echo '<li class="active" ><a href="'.$url.'">'.$v['cname'].'</a></li>';	
				} else {
					echo '<li ><a href="'.$url.'">'.$v['cname'].'</a></li>';
				}
			}
		  ?>
		</ul>
		