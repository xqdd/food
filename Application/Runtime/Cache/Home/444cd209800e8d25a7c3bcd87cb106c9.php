<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>选课</title>
		<link rel="icon" href="<?php echo (HOME_PUBLIC); ?>/images/favicon.ico" type="image/x-icon" />
        <link rel="shortcut icon" href="<?php echo (HOME_PUBLIC); ?>/images/favicon.ico" type="image/x-icon" /> 
		<link href="<?php echo (HOME_PUBLIC); ?>/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo (HOME_PUBLIC); ?>/css/style.css" rel="stylesheet">
		<style>
			#menu {
				margin: 10px auto;
				width: 80%;
				z-index: 120;
			}
		</style>

	</head>

	<body scroll="no" style="overflow-x:hidden">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-10 col-lg-offset-1">
					<img src="<?php echo (HOME_PUBLIC); ?>/images/header.png" style="width: 104%;margin-left: -2%;" />
				</div>
			</div>
		</div>

		<!-- 路径导航条 -->
		<div class="row">
			<div class="col-lg-1 col-md-1 col-sm-1"></div>
			<div class="col-lg-4  col-md-4" id="nav_div">
				<ul class="nav nav-tabs nav-justified">
					<li role="presentation " class="active"><a href="#" class="glyphicon glyphicon-check">个人信息</a></li>
					<li role="presentation" class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="	true" aria-expanded="false">
				    	  公告 <span class="caret"></span>
				   	  </a>
						<ul class="dropdown-menu" style="overflow: hidden;">
							<?php if(is_array($announce)): foreach($announce as $key=>$vo): ?><li><a href="/food/index.php/Home/Index/announce/an_id/<?php echo ($vo["an_id"]); ?>"><?php echo ($vo["an_title"]); ?></a></li><?php endforeach; endif; ?>
						</ul>
					</li>
					<li role="presentation">
						<a href="/food/index.php/Home/Index/index">
							<span class=" " aria-hidden="true"></span>&nbsp; 选课
						</a>
					</li>
				</ul>

			</div>
		</div>
		<!-- nav end -->
		</div>
		<div class="wrapper wrapper-content animated fadeInRight" style="margin-top:50px;">
			<div class="row" style="margin-top: 50px;">
				<div class="col-lg-10 col-lg-offset-1">
					<table class="table table-striped table-hover" style="border: 1px solid dodgerblue;">
						<tr>
							<th class="bg-primary">学号</th>
							<th class="bg-primary">姓名</th>
							<th class="bg-primary">性别</th>
							<th class="bg-primary">政治面貌</th>
							<th class="bg-primary">民族</th>
							<th class="bg-primary">专业</th>
							<th class="bg-primary">班别</th>
							<th class="bg-primary">身份证号</th>
							<th class='bg-info text-center'>密码</th>
						</tr>
						<tr>
							<td><?php echo ($_SESSION['sdSession']['sd_num']); ?></td>
							<td><?php echo ($_SESSION['sdSession']['sd_name']); ?></td>
							<td><?php echo ($_SESSION['sdSession']['sd_sex']); ?></td>
							<td><?php echo ($_SESSION['sdSession']['sd_political_status']); ?></td>
							<td><?php echo ($_SESSION['sdSession']['sd_nation']); ?></td>
							<td><?php echo ($_SESSION['sdSession']['sd_professional']); ?></td>
							<td><?php echo ($_SESSION['sdSession']['sd_class']); ?></td>
							<td><?php echo ($_SESSION['sdSession']['sd_idcar']); ?></td>
							<td align="center">
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">修改</button>
							</td>
						</tr>
					</table>
				</div>
			</div>
			<div class="col-lg-10 col-lg-offset-1">联系电话：<span><?php echo ($_SESSION['sdSession']['sd_phone']); ?></span>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1">修改</button>
			</div>
		</div>
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content" >
					<div class="modal-header" >
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="exampleModalLabel">修改密码</h4>
					</div>
					<div class="modal-body">
						<form method="post" action="/food/index.php/Home/Person/resetPwd" enctype="multipart/form-data">
							<div class="form-group">
								<label for="recipient-name" class="control-label">旧密码:</label>
								<input type="password" maxlength="25" placeholder="必填" name="oldPwd" class="form-control" required="" id="recipient-name">
							</div>
							<div class="form-group">
								<label for="recipient-name" class="control-label" >新密码:</label>
								<input type="password" maxlength="25" placeholder="必填" name="newPwd" class="form-control" required="" id="recipient-name">
							</div>
							<div class="form-group">
								<label for="recipient-name" class="control-label">&nbsp;</label>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
								<input type="submit" value="确定" class="btn btn-primary">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content" >
					<div class="modal-header" >
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="exampleModalLabel">修改/添加联系电话</h4>
					</div>
					<div class="modal-body">
						<form method="post" action="/food/index.php/Home/Person/resetPhone" enctype="multipart/form-data">
							<div class="form-group">
								<label for="recipient-name" class="control-label">联系电话:</label>
								<input type="text" maxlength="25" placeholder="必填" name="sd_phone" value="<?php echo ($_SESSION['sdSession']['sd_phone']); ?>" class="form-control" required="">
							</div>
							<div class="form-group">
								<label for="recipient-name" class="control-label">&nbsp;</label>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
								<input type="submit" value="确定" class="btn btn-primary">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="row" style="margin-top:50px;">
			<div class="col-lg-10 col-lg-offset-1">
				<h4>已选课程</h4></div>
		</div>
		<script>
			function confirmFun(){
				if(confirm("确定要退选???")){
					return true;
				}else{
					return false;
				}
			}
		</script>
		<div class="row" style="margin-bottom:70px;">
			<!-- 已选课表列表 -->
			<div class="col-lg-1 col-md-1"></div>
			<div class="col-lg-10" id="selected_div">
				<table class="table table-striped table-hover ">
					<tr>
						<th class="bg-primary">序号</th>
						<th class="bg-primary">课程名称</th>
						<th class="bg-primary">指导老师</th>
						<th class="bg-primary">指导电话</th>
						<th class="bg-primary">拟安排实验室</th>
						<!--<th class="bg-primary">状态</th>-->
						<th class='bg-info text-center'>操作</th>
					</tr>
					
					<?php if(is_array($listArray)): foreach($listArray as $i=>$vo): ?><tr>
							<td><?php echo ($i+1); ?>
							</td>
							<td><a href="/food/index.php/Home/Content/index/ct_id/<?php echo ($vo["ct_id"]); ?>"><?php echo ($vo["ct_name"]); ?></a></td>
							<td><?php echo ($vo["ct_teacher"]); ?></td>
							<td><?php echo ($vo["ct_phone"]); ?></td>
							<td><?php echo ($vo["ct_lab"]); ?></td>
							<!--<td>
								<?php if($vo['ct_seletctd_num'] == 1): ?><div style="color:red;">已选</div>
									<?php else: ?>
									<div style="color:forestgreen;">未选</div><?php endif; ?>
							</td>-->
							<td>
								<a type="button" class="btn btn-danger btn-sm btn-block" onclick="return confirmFun()" href="/food/index.php/Home/Person/delete/content_id/<?php echo ($vo["sc_content_id"]); ?>">退选</a>
							</td>
						</tr><?php endforeach; endif; ?>
				</table>
			</div>
			<div class="col-lg-1 col-md-1"><?php echo ($marks); ?></div>
			<!-- table end-->
			<input type="hidden" class="marks" value="<?php echo ($marks); ?>" />
			<input type="hidden" class="pwd" value="<?php echo ($pwd); ?>" />
		</div>
		</div>
		<!-- 版权信息 -->
		<div class="row" style="background:#326FA3;width: 86%;margin-left: 7%;height: 110px;">
			<div style="margin-top: 15px;color: white;font-size: 15px;">
				<p class="text-center">&copy;2016广东海洋大学食品科学与工程系本科论文选题系统</p>
				<p class="text-center">技术支持:网维工作室&nbsp;&nbsp;微信:lzhlad</p>
				<p class="text-center">hubeizhangyi@163.com 张翼</p>
			</div>
		</div>
	</body>
<!--	<style>
		#exampleModal{
			position: absolute;
		}
	</style>-->
	<script src="<?php echo (HOME_PUBLIC); ?>/js/jquery.min.js"></script>
	<script src="<?php echo (HOME_PUBLIC); ?>/js/bootstrap.min.js"></script>

	<script>
/*		$(document).ready(function() {
			$('#menu1').menu({
				position: {
					at: 'left bottom'
				}
			});

		})
		$(document).ready(function() {
			var top = $('#exampleModal').height() - ($('window').height()) / 2;
				$('#exampleModal').css({
					'top': top
				});
				alert(top)
			});*/
	    if($('.marks').val() == '0000'){
	    	alert('旧密码有错！！！')
	    }else if($('.marks').val() == '1111'){
	    	alert('修改成功！！！;新密码是:'+$('.pwd').val())
	    }else if($('.marks').val() == '00000'){
	    	alert('修改失败！！！')
	    }else{
	    	
	    }
	</script>

</html>