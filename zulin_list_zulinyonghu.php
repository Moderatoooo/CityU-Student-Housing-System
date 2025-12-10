<?php require_once 'initialize.php'; ?><?php // --------------------------------------------------
$where = " 1=1 "; // 防止sql 语句where and 这样的错误
$orderby = isset($_REQUEST['orderby']) ? $_REQUEST['orderby'] : 'id';   // 获取前台搜索框中 选择的排序类型,默认为发布时间倒序
$sort = isset($_REQUEST['sort']) ? $_REQUEST['sort'] : 'DESC'; // 获取前台搜索框中 排序类型，默认为倒序
//  设置为当前用户的数据
$where .= " AND zulinyonghu='" . $_SESSION["username"] . "' ";


// 设置fangwuxinxi模块，表id 的值是提交过来，有则只查询这些内容


if ($_REQUEST["fangwuxinxiid"] != "") {
    $where .= " AND fangwuxinxiid='" . $_REQUEST["fangwuxinxiid"] . "' ";
}
// 根据搜索提交的表单搜索数据

if ($_GET["fangwubiaoti"] != null && !"" == $_GET["fangwubiaoti"]) {
    $where .= " AND fangwubiaoti LIKE '%" . $_GET["fangwubiaoti"] . "%'";
}
if ($_GET["leixing"] != null && !"" == $_GET["leixing"]) {
    $where .= " AND leixing ='" . $_GET["leixing"] . "'";
}
if ($_GET["zulinleixing"] != null && !"" == $_GET["zulinleixing"]) {
    $where .= " AND zulinleixing ='" . $_GET["zulinleixing"] . "'";
}
if ($_GET["xingming"] != null && !"" == $_GET["xingming"]) {
    $where .= " AND xingming LIKE '%" . $_GET["xingming"] . "%'";
}
if ($_GET["lianxidianhua"] != null && !"" == $_GET["lianxidianhua"]) {
    $where .= " AND lianxidianhua LIKE '%" . $_GET["lianxidianhua"] . "%'";
}

// 构建zulin数据模型
$query = M("zulin");
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
            租赁查询
        </span>
            </div>
            <div class="panel-body">


                <div class="form-search pa10 bg-warning">
                    <form class="form-inline" action="?" size="small" id="formSearch"><!-- form 标签开始 -->


                        房屋标题： <input type="text" class="form-control" style="" name="fangwubiaoti"
                                     value="<?php echo $_GET["fangwubiaoti"]; ?>"/>

                        类型： <select class="form-control class_leixing5" data-value="<?php echo $_GET["leixing"]; ?>"
                                    id="leixing" name="leixing">
                            <option value="">请选择
                            </option><?php $select = db()->select("SELECT * FROM fangwuleixing ORDER BY id desc"); ?>
                            <?php foreach ($select as $m) { ?>
                                <option value="<?php echo $m["id"]; ?>"><?php echo $m["leixing"]; ?></option>
                            <?php } ?>

                        </select>
                        <script>
                            $(".class_leixing5").val($(".class_leixing5").attr("data-value"))</script>


                        租赁类型： <select class="form-control class_zulinleixing6"
                                      data-value="<?php echo $_GET["zulinleixing"]; ?>" id="zulinleixing"
                                      name="zulinleixing">
                            <option value="">请选择</option>
                            <option value="整租">整租</option>
                            <option value="分租">分租</option>

                        </select>
                        <script>
                            $(".class_zulinleixing6").val($(".class_zulinleixing6").attr("data-value"))</script>


                        姓名： <input type="text" class="form-control" style="" name="xingming"
                                   value="<?php echo $_GET["xingming"]; ?>"/>

                        联系电话： <input type="text" class="form-control" style="" name="lianxidianhua"
                                     value="<?php echo $_GET["lianxidianhua"]; ?>"/>

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
                            <th data-field="fangwutupian">房屋图片</th>
                            <th data-field="louceng">楼层</th>
                            <th data-field="mianji">面积</th>
                            <th data-field="fangwuzujin">房屋租金</th>
                            <th data-field="yajinfangshi">押金方式</th>
                            <th data-field="leixing">类型</th>
                            <th data-field="fangjianshu">房间数</th>
                            <th data-field="zulinleixing">租赁类型</th>
                            <th data-field="fangwudizhi">房屋地址</th>
                            <th data-field="xingming">姓名</th>
                            <th data-field="lianxidianhua">联系电话</th>
                            <th data-field="shenfenzhenghao">身份证号</th>
                            <th data-field="xuanzefangjian">选择房间</th>
                            <th data-field="zulinshichang">租赁时长 (月)
                            </th>
                            <th data-field="beizhu">备注</th>
                            <th data-field="zulinzhuangtai">租赁状态</th>
                            <th data-field="zulinyonghu">租赁用户</th>

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
                                    <?php if ("" == $map["fangwutupian"]) { ?>-<?php } else { ?><img width="100"
                                                                                                     src="<?php echo Info::images($map["fangwutupian"]); ?>"/><?php } ?>
                                </td>
                                <td>
                                    <?php echo $map["louceng"]; ?>                        </td>
                                <td>
                                    <?php echo $map["mianji"]; ?>                        </td>
                                <td>
                                    <?php echo $map["fangwuzujin"]; ?>                        </td>
                                <td>
                                    <?php echo $map["yajinfangshi"]; ?>                        </td>
                                <td>
                                    <?php $mapfangwuleixing11 = db()->find("SELECT leixing,id FROM fangwuleixing where id='" . $map["leixing"] . "'"); ?><?php echo $mapfangwuleixing11["leixing"]; ?>                        </td>
                                <td>
                                    <?php echo $map["fangjianshu"]; ?>                        </td>
                                <td>
                                    <?php echo $map["zulinleixing"]; ?>                        </td>
                                <td>
                                    <?php echo $map["fangwudizhi"]; ?>                        </td>
                                <td>
                                    <?php echo $map["xingming"]; ?>                        </td>
                                <td>
                                    <?php echo $map["lianxidianhua"]; ?>                        </td>
                                <td>
                                    <?php echo $map["shenfenzhenghao"]; ?>                        </td>
                                <td>
                                    <?php $mapfangjianxinxi12 = db()->find("SELECT fangjianmingcheng,id FROM fangjianxinxi where id='" . $map["xuanzefangjian"] . "'"); ?><?php echo $mapfangjianxinxi12["fangjianmingcheng"]; ?>                        </td>
                                <td>
                                    <?php echo $map["zulinshichang"]; ?>                        </td>
                                <td>
                                    <pre style="padding: 5px;background: none;border: none;margin: 0;"><?php echo $map["beizhu"]; ?></pre>
                                </td>
                                <td>
                                    <?php echo $map["zulinzhuangtai"]; ?>                        </td>
                                <td>
                                    <?php echo $map["zulinyonghu"]; ?>                        </td>

                                <td align="center">

                                    <?php $fenzuxinxiMapCount1 = M("fenzuxinxi")->where("zulinid", $map["id"])->count(); ?>
                                    <?php  if($fenzuxinxiMapCount1 ==  0  ){  ?>

                                        <?php  if($map["zulinleixing"] ==  '整租'  ){  ?>

                                            <?php  if($map["zulinzhuangtai"] ==  '通过'  ){  ?>
                                                <a class="btn btn-primary btn-xs" href="fenzuxinxi_add.php?id=<?php echo $map["id"]; ?>"> 添加分租 </a>


                                            <?php } ?>
                                        <?php } ?>
                                    <?php } ?>

                                    <a class="btn btn-info btn-xs" href="zulin_detail.php?id=<?php echo $map["id"]; ?>"
                                       title="详情"> 详情 </a>


<!--                                    <a class="btn btn-success btn-xs" href="zulin_updt.php?id=--><?php //echo $map["id"]; ?><!--"-->
<!--                                       title="编辑"> 编辑 </a>-->


                                    <a class="btn btn-danger btn-xs"
                                       href="zulin.php?a=delete&id=<?php echo $map["id"]; ?>"
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