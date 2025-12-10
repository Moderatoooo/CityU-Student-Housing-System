<?php  require_once 'initialize.php';  ?><!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>租房系统后台管理</title>
    <link rel="stylesheet" type="text/css" href="htstyle/css/common.css"/>
    <link rel="stylesheet" type="text/css" href="htstyle/css/main.css"/>
    <script type="text/javascript" src="htstyle/js/libs/modernizr.min.js"></script>
    <script src="htstyle/js/jquery.js"></script>
</head>
<body>

    <div class="topbar-wrap white">
        <div class="topbar-inner clearfix">
            <div class="topbar-logo-wrap clearfix">
                <h1 class="topbar-logo none"><a href="sy.php" class="navbar-brand">后台管理</a></h1>
                <ul class="navbar-list clearfix">
                    <li><a class="on" href="./">租房系统</a></li>
                    <li><a href="sy.php" target="main">首页</a></li>
                    <li><a href="./" target="_blank">网站首页</a></li>
                </ul>
            </div>
            <div class="top-info-wrap">
                <ul class="top-info-list clearfix">
                    <li><a href="javascript:;"><?php echo $_SESSION["username"]; ?> , <?php echo $_SESSION["cx"]; ?></a></li>
                    <li><a href="mod.php" target="main"> 修改密码 </a></li>
                    <li><a href="action.php?a=logout">退出</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container clearfix">
        <div class="sidebar-wrap">
            <div class="sidebar-title">
                <h1>导航</h1>
            </div>
            <div class="sidebar-content">
                <ul class="sidebar-list" id="sidebarList">
                                        <?php  if("管理员" ==  $_SESSION["cx"] ){  ?>
                    <?php include "left_guanliyuan.php" ?>
                    <?php } ?>
                                        <?php  if("用户" ==  $_SESSION["cx"] ){  ?>
                    <?php include "left_yonghu.php" ?>
                    <?php } ?>
                                        <?php  if("房东" ==  $_SESSION["cx"] ){  ?>
                    <?php include "left_fangdong.php" ?>
                    <?php } ?>
                                    </ul>
            </div>
        </div>
        <!--/sidebar-->
        <div class="main-wrap">
            <?php  if($_GET["url"] != null && $_GET["url"] !=  '' ){  ?>
            <iframe class="iframe" src="<?php echo $_GET["url"]; ?>" name="main"></iframe>
            <?php  } else {   ?>
            <iframe class="iframe" src="sy.php" name="main"></iframe>
            <?php } ?>

        </div>
        <!--/main-->
    </div>
    <script>
        $(function () {
            $('#sidebarList').on('click','>li>a' ,   function () {
                $('#sidebarList>li.active .sub-menu').stop().slideUp(200);
                $('#sidebarList>li.active').removeClass('active');
                $(this).parent().toggleClass('active');
                $(this).next().stop().slideToggle(200);
            });

            $('#sidebarList>li:eq(0)>a').click();
        })
    </script>


    </body>
</html>
