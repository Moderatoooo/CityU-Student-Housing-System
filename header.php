<?php require_once 'initialize.php'; ?>


<div>
    <div class="header">

        <div class="container clearfix">
            <!-- 使用bootstrap css框架，container定宽，并剧中 https://v3.bootcss.com/css/#overview-container -->

            <div class="fr">
                <?php if ($_SESSION["username"] != null && "" != $_SESSION["username"]) { ?>
                    欢迎<?php echo $_SESSION["username"]; ?>登录，
                    您得权限：<?php echo $_SESSION["cx"]; ?>
                <?php if ($_SESSION["cx"] != "管理员" ) { ?>
                    <a href="chats.php"  style="color: red"> / 聊天 / </a>
                    <?php } ?>
                    <a href="main.php"> 个人中心</a>
                    <a href="action.php?a=logout" onclick="return confirm('你确定退出？')"> 退出</a>
                <?php } else { ?>
                    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#loginModel">

                        登录

                    </button>


                        <a class="btn btn-info btn-xs" href="login.php">login后台
                        </a>

                <?php } ?>
            </div>
            <div class="">
                欢迎光临
            </div>

            <!-- container定宽，并剧中结束 --></div>
    </div>
    <nav class="navbar navbar-default-lan">
        <div class="container container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">
                    租房系统
                </a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav" id="navbar-str">
                    <li>
                        <a href="./">首页
                        </a>
                    </li>
                    <li>
                        <a href="fangwuxinxilist.php">房屋信息
                        </a>
                    </li>

                    <li>
                        <a href="fenzuxinxilist.php">合租信息
                        </a>
                    </li>
                    <li>
                        <a href="yonghuadd.php">用户注册
                        </a>
                    </li>
                    <li>
                        <a href="fangdongadd.php">房东注册
                        </a>
                    </li>

                </ul>
                <form class="navbar-form navbar-right" action="fangwuxinxilist.php">
                    <div class="form-group">
                        <input type="text" value="<?php echo $_GET["fangwubiaoti"]; ?>" name="fangwubiaoti"
                               class="form-control" placeholder="输入关键词搜索"/>
                    </div>
                    <button type="submit" class="btn btn-default">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </form>
            </div>
        </div>
    </nav>
    <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel0" id="loginModel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel0">登录</h4>
                </div>
                <div class="modal-body">
                    <div class="pa10">

                        <form action="action.php?a=login&captch=a" method="post"><!-- form 标签开始 -->

                            <div class="form-group">


                                <input type="text" class="form-control" name="username" placeholder="输入帐号"/>

                            </div>
                            <div class="form-group">


                                <input type="password" class="form-control" name="pwd" placeholder="密码"/>

                            </div>
                            <div class="form-group">


                                <select class="form-control" name="cx">

                                    <option value="用户">用户</option>
                                    <option value="房东">房东</option>
                                </select>

                            </div>
                            <div class="form-group">


                                <div class="input-group">

                                    <input type="text" class="form-control" name="pagerandom" placeholder="输入验证码"/>


                                    <span class="input-group-addon"><img src="image.php"
                                                                         style="width: 60px;height: 20px;max-width: none; max-height: none;"
                                                                         onclick="this.src='image.php?rand='+new Date().getTime()"/></span>
                                </div>

                            </div>
                            <input name="referer" class="loginReferer" type="hidden"/>
                            <script>
                                $('.loginReferer').val(location.href);
                            </script>
                            <div class="form-group">
                                <div class="form-item-flex">
                                    <label class="form-label-title"> </label>
                                    <div class="form-label-control">

                                        <button type="submit" class="btn btn-primary">
                                            登录
                                        </button>

                                    </div>

                                </div>
                            </div>

                            <!--form标签结束--></form>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>



