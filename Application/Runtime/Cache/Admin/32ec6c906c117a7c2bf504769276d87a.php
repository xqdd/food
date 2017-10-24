<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon" href="<?php echo (ADMIN_PUBLIC); ?>/img/favicon.ico" type="image/x-icon" />
        <link rel="shortcut icon" href="<?php echo (ADMIN_PUBLIC); ?>/img/favicon.ico" type="image/x-icon" />
		<link href="<?php echo (ADMIN_PUBLIC); ?>/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo (ADMIN_PUBLIC); ?>/css/style.css" rel="stylesheet">
	</head>
	<body class="gray-bg">
		<div class="middle-box text-center loginscreen animated fadeInDown">
			<div>
				<h1 class="logo-name">
					<img alt="image" class="admin_img" src="<?php echo (ADMIN_PUBLIC); ?>/img/login.jpg" style="width: 296px;height: 161px;"/>
          </h1>
				<h2>欢迎登陆-管理员</h2>
				<form class="m-t" role="form" action="/food/index.php/Admin/Login/index" method="post">
					<div class="form-group">
						<input type="text" name="username" class="form-control" placeholder="账号" required="">
					</div>
					<div class="form-group">
						<input type="password" name="password" class="form-control" placeholder="密码" required="">
					</div>
					<div class="form-label col-md-6" style="width: 328px;margin-bottom: 30px;">
						<img src="/food/index.php/Admin/Login/code" alt="验证码不见了？？" id="verify_img" onclick="this.src='/food/index.php/Admin/Login/code/'+Math.random()" style="cursor: pointer;" title="看不清？点击更换另一个验证码。" />
					    <input type="text" name="captcha" class="form-control" placeholder="验证码" required="" style="float:left;width: 100px;margin-left: 78px;">
					</div>
				    <style>
				    	#verify_img{
				    		width: 120px;
				    		margin-left: -14px;
				    		float: left;
				    	}
				    </style>
					<button type="submit" class="btn btn-primary block full-width m-b">登陆</button>

				</form>
				<p class="m-t"> <small>网维技术团队 &copy; 2016</small> </p>
			</div>
		</div>
		<!-- Mainly scripts -->
		<script src="<?php echo (ADMIN_PUBLIC); ?>/js/jquery-2.1.1.js"></script>
		<script src="<?php echo (ADMIN_PUBLIC); ?>/js/bootstrap.min.js"></script>
	</body>

</html>