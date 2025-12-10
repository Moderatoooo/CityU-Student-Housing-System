<?php  require_once 'initialize.php';  ?><!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>租房系统后台管理</title>
    <link href="htstyle/css/admin_login.css" rel="stylesheet" type="text/css" />
    <script src="js/jquery.js"></script>
</head>
<body>
<div class="admin_login_wrap">
    <h1>租房系统-后台管理</h1>
    <div class="adming_login_border">

        <div class="admin_input">
            <form action="action.php?a=adminlogin&captch=a" method="post">
                <ul class="admin_items">
                    <li>
                        <label for="user">用户名：</label>
                        <input type="text" name="username" value="" id="user" class="admin_input_style" />
                    </li>
                    <li>
                        <label for="pwd">密码：</label>
                        <input type="password" name="pwd" value="" id="pwd" class="admin_input_style" />
                    </li>
                    <li class="pagerandom">
                        <label for="pagerandom">验证码：</label>
                        <input type="text" name="pagerandom" value="" id="pagerandom" class="admin_input_style" />
                        <img  onClick="this.src='image.php?time='+new Date().getTime();"
                              src="image.php" alt="刷新验证码" style="width: 100px;height: 30px">
                    </li>
                    <li style="display: none">
                        <label for="cx">权限：</label>
                        <select class="admin_input_style" id="cx" name="cx">
                            <option value="管理员">管理员</option>  
  <option value="用户">用户</option>  
  <option value="房东">房东</option>                        </select>
                    </li>
                    <li>
                        <input type="submit" value="提交" class="btn btn-primary" />
                    </li>
                </ul>
            </form>
        </div>
    </div>

    <script>
        $(function () {
            if($('#cx>option').length>1){
                $('#cx').parent().show();
            }
        })
    </script>

    <p class="admin_copyright">&copy; Powered by 租房系统</p>
</div>
</body>
</html>
