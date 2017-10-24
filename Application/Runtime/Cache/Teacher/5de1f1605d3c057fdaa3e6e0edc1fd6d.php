<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
        <!-- 导入css -->
    <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>广东海洋大学食品学院选课系统</title>
    <link href="<?php echo (ADMIN_PUBLIC); ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo (ADMIN_PUBLIC); ?>/font-awesome/css/font-awesome.css" rel="stylesheet">
    <!-- Toastr style -->
    <link href="<?php echo (ADMIN_PUBLIC); ?>/css/plugins/toastr/toastr.min.css" rel="stylesheet">
    <!-- Gritter -->
    <link href="<?php echo (ADMIN_PUBLIC); ?>/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
    <link href="<?php echo (ADMIN_PUBLIC); ?>/css/animate.css" rel="stylesheet">
    <link href="<?php echo (ADMIN_PUBLIC); ?>/css/mystyle.css" rel="stylesheet">
    <link href="<?php echo (ADMIN_PUBLIC); ?>/css/style.css" rel="stylesheet">
    
</head>
        <!-- Mainly scripts -->
           <!-- 导入js -->
        <script src="<?php echo (ADMIN_PUBLIC); ?>/js/jquery-2.1.1.js"></script>
    <script src="<?php echo (ADMIN_PUBLIC); ?>/js/bootstrap.min.js"></script>
    <script src="<?php echo (ADMIN_PUBLIC); ?>/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="<?php echo (ADMIN_PUBLIC); ?>/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <!-- Flot -->
    <script src="<?php echo (ADMIN_PUBLIC); ?>/js/plugins/flot/jquery.flot.js"></script>
    <script src="<?php echo (ADMIN_PUBLIC); ?>/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="<?php echo (ADMIN_PUBLIC); ?>/js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="<?php echo (ADMIN_PUBLIC); ?>/js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="<?php echo (ADMIN_PUBLIC); ?>/js/plugins/flot/jquery.flot.pie.js"></script>

    <!-- Peity -->
    <script src="<?php echo (ADMIN_PUBLIC); ?>/js/plugins/peity/jquery.peity.min.js"></script>
    <script src="<?php echo (ADMIN_PUBLIC); ?>/js/demo/peity-demo.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="<?php echo (ADMIN_PUBLIC); ?>/js/inspinia.js"></script>
    <script src="<?php echo (ADMIN_PUBLIC); ?>/js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="<?php echo (ADMIN_PUBLIC); ?>/js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- GITTER -->
    <script src="<?php echo (ADMIN_PUBLIC); ?>/js/plugins/gritter/jquery.gritter.min.js"></script>

    <!-- Sparkline -->
    <script src="<?php echo (ADMIN_PUBLIC); ?>/js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="<?php echo (ADMIN_PUBLIC); ?>/js/demo/sparkline-demo.js"></script>

    <!-- ChartJS-->
    <script src="<?php echo (ADMIN_PUBLIC); ?>/js/plugins/chartJs/Chart.min.js"></script>

    <!-- Toastr -->
    <script src="<?php echo (ADMIN_PUBLIC); ?>/js/plugins/toastr/toastr.min.js"></script>
<body>
    <div id="wrapper">
        <!-- 导入导航菜单 -->
            <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element admin_div"> 
                            <a href="/food/index.php/Teacher/Index/index">
                            <img alt="image" class="admin_img" src="<?php echo (ADMIN_PUBLIC); ?>/img/p5.jpg" style="width: 222px;margin-left: -27px;margin-top: -44px;"/>
                            </a>
                            </span>
                            <span class="clear"> 
                            <span class="block admin_name" style="font-size: 20px;padding: 10px;color: white;">
                              <?php echo ($_SESSION['tcSession']["mg_name"]); ?>
                             </span></span>
                        </div>
                    </li>
                    <li class="index_li">
                        <a href="/food/index.php/Teacher/Content/index"><i class="fa fa-diamond"></i> <span class="nav-label">查看课题</span> </a>
                    </li>
                    <li class="add_li">
                    	<?php if(($sizeof > 0 )): ?><a href="/food/index.php/Teacher/Content/add"><i class="fa fa-diamond"></i> <span class="nav-label">增加课题</span> </a>
                    	<?php else: ?>
                    	<a href="#"><i class="fa fa-diamond"></i> <span class="nav-label">不能再添加</span> </a><?php endif; ?>
                        
                    </li>
                    <li class="alert_pwd">
                    	<a href="/food/index.php/Teacher/Password/index"><i class="fa fa-diamond"></i> <span class="nav-label">修改密码</span> </a>
                    </li>
                    <!--
                     <li class="dele_li">
                        <a href="/food/index.php/Teacher/Content/dele"><i class="fa fa-diamond"></i> <span class="nav-label">删除课题</span> </a>
                    </li>-->
                </ul>
            </div>
        </nav>
<!--        动态添加navbar中的active属性
-->
        <script type="text/javascript">
        	 function navbar(class1,class2){
        	 	$(class1).addClass('active');
        		$(class2).addClass('active');
        	 }
        </script>
        



        <div id="page-wrapper" class="gray-bg dashbard-1">
        <!-- 导入页面头部 -->
    <link rel="icon" href="<?php echo (ADMIN_PUBLIC); ?>/img/favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="<?php echo (ADMIN_PUBLIC); ?>/img/favicon.ico" type="image/x-icon" />
<div class="row border-bottom">
	<nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
		
		<ul class="nav navbar-top-links navbar-right">
			<li>
				<span class="m-r-l text-justify welcome-message">
					广东海洋大学食品科学与工程系论文选题系统
				</span>
			</li>
			<li>
				<a href="/food/index.php/Teacher/Login/logout">
					<i class="fa fa-sign-out"></i>注销
				</a>
			</li>
		</ul>

	</nav>

              <!-- 本页面内容 -->
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-9">
                    <h2>查看学生信息</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">首页</a>
                        </li>
                        <li class="breadcrumb_li2">
                            查看学生信息
                        </li>
                        
                    </ol>
                </div>
            </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
        	<div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>查看学生信息</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <form method="post" class="form-horizontal" id="form_data" name="form_data" enctype="multipart/form-data">
                                <div class="form-group"><label class="col-sm-4 control-label">姓名:</label>
                                    <div class="col-sm-5"><input type="text" value="<?php echo ($oneStu[0]["sd_name"]); ?>" class="form-control" ></div>
                                </div>
                               <div class="form-group"><label class="col-sm-4 control-label">学号:</label>
                                    <div class="col-sm-5"><input type="text" value="<?php echo ($oneStu[0]["sd_num"]); ?>" class="form-control" ></div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">性别:</label>
                                    <div class="col-sm-5"><input type="text" value="<?php echo ($oneStu[0]["sd_sex"]); ?>" class="form-control" ></div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">名族:</label>
                                    <div class="col-sm-5"><input type="text" value="<?php echo ($oneStu[0]["sd_nation"]); ?>" class="form-control" ></div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">专业:</label>
                                    <div class="col-sm-5"><input type="text" value="<?php echo ($oneStu[0]["sd_professional"]); ?>" class="form-control" ></div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">班别:</label>
                                    <div class="col-sm-5"><input type="text" value="<?php echo ($oneStu[0]["sd_class"]); ?>" class="form-control" ></div>
                                </div>
                                <div class="form-group"><label class="col-sm-4 control-label">联系电话:</label>
                                    <div class="col-sm-5"><input type="text" value="<?php echo ($oneStu[0]["sd_phone"]); ?>" class="form-control" ></div>
                                </div>
                        </form>
                    </div>
                    <div class="col-sm-2 col-sm-offset-9"><a href="/food/index.php/Teacher/Content/index"><span class="btn btn-success">返回</span></a></div>
                </div>
            </div>
        </div>
        </div>
        </div>
            <!-- end -->
          <!-- 导入页面头部按钮 -->
            <div class="row">
            <div class="col-lg-12">

                <div class="footer">
                    <div class="pull-right">
                        <strong>网维团队</strong> 提供技术支持
                    </div>
                    <div>
                        版权归属<strong> &nbsp;广东海洋大学食品科学与工程系论文选题系统&nbsp;</strong>  &copy; 2016
                    </div>
                </div>
            </div>
        </div>
        
          <!-- 导入页面头部按钮 -->
                    <div id="right-sidebar">
            <div class="sidebar-container">

                <ul class="nav nav-tabs navs-3">

                    <li class="active"><a data-toggle="tab" href="#tab-1">
                        Notes
                    </a></li>
                    <li><a data-toggle="tab" href="#tab-2">
                        Projects
                    </a></li>
                    <li class=""><a data-toggle="tab" href="#tab-3">
                        <i class="fa fa-gear"></i>
                    </a></li>
                </ul>

                <div class="tab-content">


                    <div id="tab-1" class="tab-pane active">

                        <div class="sidebar-title">
                            <h3> <i class="fa fa-comments-o"></i> Latest Notes</h3>
                            <small><i class="fa fa-tim"></i> You have 10 new message.</small>
                        </div>

                        <div>

                            <div class="sidebar-message">
                                <a href="#">
                                    <div class="pull-left text-center">
                                        <img alt="image" class="img-circle message-avatar" src="img/a1.jpg">

                                        <div class="m-t-xs">
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                        </div>
                                    </div>
                                    <div class="media-body">

                                        There are many variations of passages of Lorem Ipsum available.
                                        <br>
                                        <small class="text-muted">Today 4:21 pm</small>
                                    </div>
                                </a>
                            </div>
                            <div class="sidebar-message">
                                <a href="#">
                                    <div class="pull-left text-center">
                                        <img alt="image" class="img-circle message-avatar" src="img/a2.jpg">
                                    </div>
                                    <div class="media-body">
                                        The point of using Lorem Ipsum is that it has a more-or-less normal.
                                        <br>
                                        <small class="text-muted">Yesterday 2:45 pm</small>
                                    </div>
                                </a>
                            </div>
                            <div class="sidebar-message">
                                <a href="#">
                                    <div class="pull-left text-center">
                                        <img alt="image" class="img-circle message-avatar" src="img/a3.jpg">

                                        <div class="m-t-xs">
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        Mevolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                                        <br>
                                        <small class="text-muted">Yesterday 1:10 pm</small>
                                    </div>
                                </a>
                            </div>
                            <div class="sidebar-message">
                                <a href="#">
                                    <div class="pull-left text-center">
                                        <img alt="image" class="img-circle message-avatar" src="img/a4.jpg">
                                    </div>

                                    <div class="media-body">
                                        Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the
                                        <br>
                                        <small class="text-muted">Monday 8:37 pm</small>
                                    </div>
                                </a>
                            </div>
                            <div class="sidebar-message">
                                <a href="#">
                                    <div class="pull-left text-center">
                                        <img alt="image" class="img-circle message-avatar" src="img/a8.jpg">
                                    </div>
                                    <div class="media-body">

                                        All the Lorem Ipsum generators on the Internet tend to repeat.
                                        <br>
                                        <small class="text-muted">Today 4:21 pm</small>
                                    </div>
                                </a>
                            </div>
                            <div class="sidebar-message">
                                <a href="#">
                                    <div class="pull-left text-center">
                                        <img alt="image" class="img-circle message-avatar" src="img/a7.jpg">
                                    </div>
                                    <div class="media-body">
                                        Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.
                                        <br>
                                        <small class="text-muted">Yesterday 2:45 pm</small>
                                    </div>
                                </a>
                            </div>
                            <div class="sidebar-message">
                                <a href="#">
                                    <div class="pull-left text-center">
                                        <img alt="image" class="img-circle message-avatar" src="img/a3.jpg">

                                        <div class="m-t-xs">
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        The standard chunk of Lorem Ipsum used since the 1500s is reproduced below.
                                        <br>
                                        <small class="text-muted">Yesterday 1:10 pm</small>
                                    </div>
                                </a>
                            </div>
                            <div class="sidebar-message">
                                <a href="#">
                                    <div class="pull-left text-center">
                                        <img alt="image" class="img-circle message-avatar" src="img/a4.jpg">
                                    </div>
                                    <div class="media-body">
                                        Uncover many web sites still in their infancy. Various versions have.
                                        <br>
                                        <small class="text-muted">Monday 8:37 pm</small>
                                    </div>
                                </a>
                            </div>
                        </div>

                    </div>

                    <div id="tab-2" class="tab-pane">

                        <div class="sidebar-title">
                            <h3> <i class="fa fa-cube"></i> Latest projects</h3>
                            <small><i class="fa fa-tim"></i> You have 14 projects. 10 not completed.</small>
                        </div>

                        <ul class="sidebar-list">
                            <li>
                                <a href="#">
                                    <div class="small pull-right m-t-xs">9 hours ago</div>
                                    <h4>Business valuation</h4>
                                    It is a long established fact that a reader will be distracted.

                                    <div class="small">Completion with: 22%</div>
                                    <div class="progress progress-mini">
                                        <div style="width: 22%;" class="progress-bar progress-bar-warning"></div>
                                    </div>
                                    <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="small pull-right m-t-xs">9 hours ago</div>
                                    <h4>Contract with Company </h4>
                                    Many desktop publishing packages and web page editors.

                                    <div class="small">Completion with: 48%</div>
                                    <div class="progress progress-mini">
                                        <div style="width: 48%;" class="progress-bar"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="small pull-right m-t-xs">9 hours ago</div>
                                    <h4>Meeting</h4>
                                    By the readable content of a page when looking at its layout.

                                    <div class="small">Completion with: 14%</div>
                                    <div class="progress progress-mini">
                                        <div style="width: 14%;" class="progress-bar progress-bar-info"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="label label-primary pull-right">NEW</span>
                                    <h4>The generated</h4>
                                    <!--<div class="small pull-right m-t-xs">9 hours ago</div>-->
                                    There are many variations of passages of Lorem Ipsum available.
                                    <div class="small">Completion with: 22%</div>
                                    <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="small pull-right m-t-xs">9 hours ago</div>
                                    <h4>Business valuation</h4>
                                    It is a long established fact that a reader will be distracted.

                                    <div class="small">Completion with: 22%</div>
                                    <div class="progress progress-mini">
                                        <div style="width: 22%;" class="progress-bar progress-bar-warning"></div>
                                    </div>
                                    <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="small pull-right m-t-xs">9 hours ago</div>
                                    <h4>Contract with Company </h4>
                                    Many desktop publishing packages and web page editors.

                                    <div class="small">Completion with: 48%</div>
                                    <div class="progress progress-mini">
                                        <div style="width: 48%;" class="progress-bar"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="small pull-right m-t-xs">9 hours ago</div>
                                    <h4>Meeting</h4>
                                    By the readable content of a page when looking at its layout.

                                    <div class="small">Completion with: 14%</div>
                                    <div class="progress progress-mini">
                                        <div style="width: 14%;" class="progress-bar progress-bar-info"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="label label-primary pull-right">NEW</span>
                                    <h4>The generated</h4>
                                    <!--<div class="small pull-right m-t-xs">9 hours ago</div>-->
                                    There are many variations of passages of Lorem Ipsum available.
                                    <div class="small">Completion with: 22%</div>
                                    <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                                </a>
                            </li>

                        </ul>

                    </div>

                    <div id="tab-3" class="tab-pane">

                        <div class="sidebar-title">
                            <h3><i class="fa fa-gears"></i> Settings</h3>
                            <small><i class="fa fa-tim"></i> You have 14 projects. 10 not completed.</small>
                        </div>

                        <div class="setings-item">
                    <span>
                        Show notifications
                    </span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example">
                                    <label class="onoffswitch-label" for="example">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                    <span>
                        Disable Chat
                    </span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="collapsemenu" checked class="onoffswitch-checkbox" id="example2">
                                    <label class="onoffswitch-label" for="example2">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                    <span>
                        Enable history
                    </span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example3">
                                    <label class="onoffswitch-label" for="example3">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                    <span>
                        Show charts
                    </span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example4">
                                    <label class="onoffswitch-label" for="example4">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                    <span>
                        Offline users
                    </span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" checked name="collapsemenu" class="onoffswitch-checkbox" id="example5">
                                    <label class="onoffswitch-label" for="example5">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                    <span>
                        Global search
                    </span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" checked name="collapsemenu" class="onoffswitch-checkbox" id="example6">
                                    <label class="onoffswitch-label" for="example6">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                    <span>
                        Update everyday
                    </span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example7">
                                    <label class="onoffswitch-label" for="example7">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="sidebar-content">
                            <h4>Settings</h4>
                            <div class="small">
                                I belive that. Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                And typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                                Over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                            </div>
                        </div>

                    </div>
                </div>

            </div>



        </div>
    </div>
    <input type="hidden" class="hidden_input" value="<?php echo ($list[0]["mg_sign"]); ?>"/>
<!--    判断是那中类型的管理员
-->    <script type="text/javascript">
        	navbar('.index_li','.index_li');
    </script>

</body>
</html>