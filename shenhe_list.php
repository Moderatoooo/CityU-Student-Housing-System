<?php require_once 'initialize.php'; ?><?php // --------------------------------------------------
$where = " 1=1 "; // 防止sql 语句where and 这样的错误
$orderby = isset($_REQUEST['orderby']) ? $_REQUEST['orderby'] : 'id';   // 获取前台搜索框中 选择的排序类型,默认为发布时间倒序
$sort = isset($_REQUEST['sort']) ? $_REQUEST['sort'] : 'DESC'; // 获取前台搜索框中 排序类型，默认为倒序


// 设置zulin模块，表id 的值是提交过来，有则只查询这些内容


if ($_REQUEST["zulinid"] != "") {
    $where .= " AND zulinid='" . $_REQUEST["zulinid"] . "' ";
}
// 根据搜索提交的表单搜索数据

if ($_GET["fangwubiaoti"] != null && !"" == $_GET["fangwubiaoti"]) {
    $where .= " AND fangwubiaoti LIKE '%" . $_GET["fangwubiaoti"] . "%'";
}
if ($_GET["xingming"] != null && !"" == $_GET["xingming"]) {
    $where .= " AND xingming LIKE '%" . $_GET["xingming"] . "%'";
}
if ($_GET["lianxidianhua"] != null && !"" == $_GET["lianxidianhua"]) {
    $where .= " AND lianxidianhua LIKE '%" . $_GET["lianxidianhua"] . "%'";
}
if ($_GET["zulinleixing"] != null && !"" == $_GET["zulinleixing"]) {
    $where .= " AND zulinleixing ='" . $_GET["zulinleixing"] . "'";
}
if ($_GET["shenhe"] != null && !"" == $_GET["shenhe"]) {
    $where .= " AND shenhe ='" . $_GET["shenhe"] . "'";
}

// 构建shenhe数据模型
$query = M("shenhe");
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
            审核查询
        </span>
            </div>
            <div class="panel-body">


                <div class="form-search pa10 bg-warning">
                    <form class="form-inline" action="?" size="small" id="formSearch"><!-- form 标签开始 -->


                        房屋标题： <input type="text" class="form-control" style="" name="fangwubiaoti"
                                     value="<?php echo $_GET["fangwubiaoti"]; ?>"/>

                        姓名： <input type="text" class="form-control" style="" name="xingming"
                                   value="<?php echo $_GET["xingming"]; ?>"/>

                        联系电话： <input type="text" class="form-control" style="" name="lianxidianhua"
                                     value="<?php echo $_GET["lianxidianhua"]; ?>"/>

                        租赁类型： <select class="form-control class_zulinleixing1"
                                      data-value="<?php echo $_GET["zulinleixing"]; ?>" id="zulinleixing"
                                      name="zulinleixing">
                            <option value="">请选择</option>
                            <option value="整租">整租</option>
                            <option value="分租">分租</option>

                        </select>
                        <script>
                            $(".class_zulinleixing1").val($(".class_zulinleixing1").attr("data-value"))</script>


                        审核： <select class="form-control class_shenhe2" data-value="<?php echo $_GET["shenhe"]; ?>"
                                    data-rule-required="true" data-msg-required="请填写审核" id="shenhe" name="shenhe">
                            <option value="">请选择</option>
                            <option value="通过">通过</option>
                            <option value="未通过">未通过</option>

                        </select>
                        <script>
                            $(".class_shenhe2").val($(".class_shenhe2").attr("data-value"))</script>


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
                            <th data-field="fangwubiaoti">房屋标题</th>
                            <th data-field="fangwuhuxing">房屋户型</th>
                            <th data-field="xiaoqumingcheng">小区名称</th>
                            <th data-field="xingming">姓名</th>
                            <th data-field="lianxidianhua">联系电话</th>
                            <th data-field="zulinyonghu">租赁用户</th>
                            <th data-field="zulinleixing">租赁类型</th>
                            <th data-field="xuanzefangjian">选择房间</th>
                            <th data-field="shenhe">审核</th>
                            <th data-field="shenhebeizhu">审核备注</th>
                            <th data-field="caozuoren">操作人</th>

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
                                    <?php echo $map["fangwubiaoti"]; ?>                        </td>
                                <td>
                                    <?php echo $map["fangwuhuxing"]; ?>                        </td>
                                <td>
                                    <?php echo $map["xiaoqumingcheng"]; ?>                        </td>
                                <td>
                                    <?php echo $map["xingming"]; ?>                        </td>
                                <td>
                                    <?php echo $map["lianxidianhua"]; ?>                        </td>
                                <td>
                                    <?php echo $map["zulinyonghu"]; ?>                        </td>
                                <td>
                                    <?php echo $map["zulinleixing"]; ?>                        </td>
                                <td>
                                    <?php $mapfangjianxinxi2 = db()->find("SELECT fangjianmingcheng,id FROM fangjianxinxi where id='" . $map["xuanzefangjian"] . "'"); ?><?php echo $mapfangjianxinxi2["fangjianmingcheng"]; ?>                        </td>
                                <td>
                                    <?php echo $map["shenhe"]; ?>                        </td>
                                <td>
                                    <pre style="padding: 5px;background: none;border: none;margin: 0;"><?php echo $map["shenhebeizhu"]; ?></pre>
                                </td>
                                <td>
                                    <?php echo $map["caozuoren"]; ?>                        </td>

                                <td align="center">
                                    <a class="btn btn-info btn-xs" href="shenhe_detail.php?id=<?php echo $map["id"]; ?>"
                                       title="详情"> 详情 </a>


                                    <a class="btn btn-success btn-xs"
                                       href="shenhe_updt.php?id=<?php echo $map["id"]; ?>" title="编辑"> 编辑 </a>


                                    <a class="btn btn-danger btn-xs"
                                       href="shenhe.php?a=delete&id=<?php echo $map["id"]; ?>"
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