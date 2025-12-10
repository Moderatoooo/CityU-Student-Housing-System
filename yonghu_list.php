<?php require_once 'initialize.php'; ?><?php // --------------------------------------------------
$where = " 1=1 "; // 防止sql 语句where and 这样的错误
$orderby = isset($_REQUEST['orderby']) ? $_REQUEST['orderby'] : 'id';   // 获取前台搜索框中 选择的排序类型,默认为发布时间倒序
$sort = isset($_REQUEST['sort']) ? $_REQUEST['sort'] : 'DESC'; // 获取前台搜索框中 排序类型，默认为倒序


// 根据搜索提交的表单搜索数据

if ($_GET["yonghuming"] != null && !"" == $_GET["yonghuming"]) {
    $where .= " AND yonghuming LIKE '%" . $_GET["yonghuming"] . "%'";
}
if ($_GET["xingming"] != null && !"" == $_GET["xingming"]) {
    $where .= " AND xingming LIKE '%" . $_GET["xingming"] . "%'";
}
if ($_GET["xingbie"] != null && !"" == $_GET["xingbie"]) {
    $where .= " AND xingbie ='" . $_GET["xingbie"] . "'";
}
if ($_GET["shouji"] != null && !"" == $_GET["shouji"]) {
    $where .= " AND shouji LIKE '%" . $_GET["shouji"] . "%'";
}
if ($_GET["shenfenzheng"] != null && !"" == $_GET["shenfenzheng"]) {
    $where .= " AND shenfenzheng LIKE '%" . $_GET["shenfenzheng"] . "%'";
}

// 构建yonghu数据模型
$query = M("yonghu");
// 设置所有字段
$query->field("*");
$query->where($where)->order("$orderby $sort");   // 根据条件查询列表
list($lists, $page) = $query->page(15);    // 查询列表并返回分页代码

// ------------------------------------------------------------------

?><?php include "head.php" ?>


    <div>


        <div class="panel panel-default">
            <div class="panel-heading">
        <span class="titles">
            用户查询
        </span>
            </div>
            <div class="panel-body">


                <div class="form-search pa10 bg-warning">
                    <form class="form-inline" action="?" size="small" id="formSearch"><!-- form 标签开始 -->


                        用户名： <input type="text" class="form-control" style="" name="yonghuming"
                                    value="<?php echo $_GET["yonghuming"]; ?>"/>

                        姓名： <input type="text" class="form-control" style="" name="xingming"
                                   value="<?php echo $_GET["xingming"]; ?>"/>

                        性别： <select class="form-control class_xingbie1" data-value="<?php echo $_GET["xingbie"]; ?>"
                                    data-rule-required="true" data-msg-required="请填写性别" id="xingbie" name="xingbie">
                            <option value="">请选择</option>
                            <option value="男">男</option>
                            <option value="女">女</option>

                        </select>
                        <script>
                            $(".class_xingbie1").val($(".class_xingbie1").attr("data-value"))</script>


                        手机： <input type="text" class="form-control" style="" name="shouji"
                                   value="<?php echo $_GET["shouji"]; ?>"/>

                        身份证： <input type="text" class="form-control" style="" name="shenfenzheng"
                                    value="<?php echo $_GET["shenfenzheng"]; ?>"/>

                        <select class="form-control" name="orderby" id="orderby">

                            <option value="id">按发布时间</option>

                        </select>

                        <select class="form-control" name="sort" id="sort">

                            <option value="desc">倒序</option>
                            <option value="asc">升序</option>

                        </select>

                        <button type="submit" class="btn btn-default">
                            搜索
                        </button>


                        <!--form标签结束--></form>
                </div>


                <script>$("#orderby").val("<?php echo $orderby; ?>");
                    $("#sort").val("<?php echo $sort; ?>".toLocaleLowerCase());</script>


                <div class="list-table">
                    <table width="100%" border="1" class="table table-list table-bordered table-hover">
                        <thead>
                        <tr align="center">
                            <th width="60" data-field="item">序号</th>
                            <th data-field="yonghuming">用户名</th>
                            <th data-field="mima">密码</th>
                            <th data-field="xingming">姓名</th>
                            <th data-field="xingbie">性别</th>
                            <th data-field="touxiang">头像</th>
                            <th data-field="shouji">手机</th>
                            <th data-field="youxiang">邮箱</th>
                            <th data-field="nianling">年龄</th>
                            <th data-field="shenfenzheng">身份证</th>
                            <th data-field="suozaichengshi">所在城市</th>
                            <th data-field="nianji">年级</th>
                            <th data-field="xueyuanzhuanye">学院/专业</th>


                            <th width="80" data-field="issh">审核状态</th>
                            <th width="220" data-field="handler">操作</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php $i = 0;
                        foreach ($lists as $map) {
                            $i++;
                            ?>
                            <tr id="<?php echo $map["id"]; ?>" pid="">
                                <td width="30" align="center">
                                    <label>
                                        <?php echo $i; ?>
                                    </label>
                                </td>
                                <td>
                                    <?php echo $map["yonghuming"]; ?>                        </td>
                                <td>
                                    <?php echo $map["mima"]; ?>                        </td>
                                <td>
                                    <?php echo $map["xingming"]; ?>                        </td>
                                <td>
                                    <?php echo $map["xingbie"]; ?>                        </td>
                                <td>
                                    <?php if ("" == $map["touxiang"]) { ?>-<?php } else { ?><img width="100"
                                                                                                 src="<?php echo $map["touxiang"]; ?>"/><?php } ?>
                                </td>
                                <td>
                                    <?php echo $map["shouji"]; ?>                        </td>
                                <td>
                                    <?php echo $map["youxiang"]; ?>                        </td>
                                <td>
                                    <?php echo $map["nianling"]; ?>                        </td>
                                <td>
                                    <?php echo $map["shenfenzheng"]; ?>                        </td>
                                <td>
                                    <?php echo $map["suozaichengshi"]; ?>                        </td>
                                <td>
                                    <?php echo $map["nianji"]; ?>                        </td>
                                <td>
                                    <?php echo $map["xueyuanzhuanye"]; ?>                        </td>


                                <td>
                                    <?php echo $map["issh"]; ?>
                                    <a href="action.php?a=sh&id=<?php echo $map["id"]; ?>&yuan=<?php echo $map["issh"]; ?>&tablename=yonghu">
                                        <?php if ($map["issh"] == "是") { ?>
                                            取消审核
                                        <?php } else { ?>
                                            审核
                                        <?php } ?>
                                    </a>
                                </td>
                                <td align="center">
                                    <a class="btn btn-info btn-xs" href="yonghu_detail.php?id=<?php echo $map["id"]; ?>"
                                       title="详情"> 详情 </a>


                                    <a class="btn btn-success btn-xs"
                                       href="yonghu_updt.php?id=<?php echo $map["id"]; ?>" title="编辑"> 编辑 </a>


                                    <a class="btn btn-danger btn-xs"
                                       href="yonghu.php?a=delete&id=<?php echo $map["id"]; ?>"
                                       onclick="return confirm('确定删除？此操作不可恢复')" title="删除"> 删除 </a>


                                    <!--qiatnalijne-->
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>


                <?php echo $page->show() ?>


            </div>
        </div>


    </div>


<?php include "foot.php" ?>