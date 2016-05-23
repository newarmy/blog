<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>后台</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url().'static/css/bootstrap.min.css' ?>" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<link href="<?php echo base_url().'static/css/admin.css'?>" rel="stylesheet">
  </head>
  <body>
	<div class="container ">
		<div class="row g c-color">
			<div class="col-md-10 "><h1>后台管理</h1></div>
			<div class = 'col-md-2 '>
				<?php 
					if(!empty($name)) {
					   echo "<div style='float:right;margin-top: 30px;'>你好，".$name."</div>";
					} else {
						echo<<<EOF
							<a  href="#" class="li">登录</a>
							<a href="#" class="li">注册</a>
EOF;
					}	
				?>
					
				
			</div>
		</div>
		