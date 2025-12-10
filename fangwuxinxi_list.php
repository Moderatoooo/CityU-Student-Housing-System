<?php require_once 'initialize.php'; ?><?php // --------------------------------------------------
$where = " 1=1 "; // 防止sql 语句where and 这样的错误
$orderby = isset($_REQUEST['orderby']) ? $_REQUEST['orderby'] : 'id';   // 获取前台搜索框中 选择的排序类型,默认为发布时间倒序
$sort = isset($_REQUEST['sort']) ? $_REQUEST['sort'] : 'DESC'; // 获取前台搜索框中 排序类型，默认为倒序


if (!empty($_REQUEST["keyword"])) {
    $where .= "  AND  ( fangwubiaoti LIKE '%" . $_REQUEST["keyword"] . "%' OR xiaoqumingcheng LIKE '%" . $_REQUEST["keyword"] . "%' OR fangwuhuxing LIKE '%" . $_REQUEST["keyword"] . "%' )  ";
}


// 根据搜索提交的表单搜索数据

if ($_GET["fangwubianhao"] != null && !"" == $_GET["fangwubianhao"]) {
    $where .= " AND fangwubianhao LIKE '%" . $_GET["fangwubianhao"] . "%'";
}
if ($_GET["fangwubiaoti"] != null && !"" == $_GET["fangwubiaoti"]) {
    $where .= " AND fangwubiaoti LIKE '%" . $_GET["fangwubiaoti"] . "%'";
}
if ($_GET["leixing"] != null && !"" == $_GET["leixing"]) {
    $where .= " AND leixing ='" . $_GET["leixing"] . "'";
}
if ($_GET["fangwuhuxing"] != null && !"" == $_GET["fangwuhuxing"]) {
    $where .= " AND fangwuhuxing LIKE '%" . $_GET["fangwuhuxing"] . "%'";
}
if ($_GET["louceng_start"] != null && !"" == $_GET["louceng_start"]) {
    $where .= " AND louceng >='" . $_GET["louceng_start"] . "' ";
}
if ($_GET["louceng_end"] != null && !"" == $_GET["louceng_end"]) {
    $where .= " AND louceng <='" . $_GET["louceng_end"] . "' ";
}
if ($_GET["shifouyoudianti"] != null && !"" == $_GET["shifouyoudianti"]) {
    $where .= " AND shifouyoudianti ='" . $_GET["shifouyoudianti"] . "'";
}
if ($_GET["zulinleixing"] != null && !"" == $_GET["zulinleixing"]) {
    $where .= " AND zulinleixing ='" . $_GET["zulinleixing"] . "'";
}
if ($_GET["jiagequjian"] != null && !"" == $_GET["jiagequjian"]) {
    $where .= " AND jiagequjian ='" . $_GET["jiagequjian"] . "'";
}
if ($_GET["yajinfangshi"] != null && !"" == $_GET["yajinfangshi"]) {
    $where .= " AND yajinfangshi ='" . $_GET["yajinfangshi"] . "'";
}
if ($_GET["julixuexiao"] != null && !"" == $_GET["julixuexiao"]) {
    $where .= " AND julixuexiao ='" . $_GET["julixuexiao"] . "'";
}
if ($_GET["fangwuzhuangtai"] != null && !"" == $_GET["fangwuzhuangtai"]) {
    $where .= " AND fangwuzhuangtai ='" . $_GET["fangwuzhuangtai"] . "'";
}
if ($_GET["sheshi"] != null && !"" == $_GET["sheshi"]) {
    $where .= " AND sheshi LIKE '%" . $_GET["sheshi"] . "%'";
}

// 构建fangwuxinxi数据模型
$query = M("fangwuxinxi");
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
            房屋信息查询
        </span>
            </div>
            <div class="panel-body">


                <div class="form-search pa10 bg-warning">
                    <form class="form-inline" action="?" size="small" id="formSearch"><!-- form 标签开始 -->


                        关键字：<input type="text" class="form-control" name="keyword"
                                   value="<?php echo $_GET["keyword"]; ?>" style="width:150px" placeholder="搜索关键字"/>

                        房屋编号： <input type="text" class="form-control" style="" name="fangwubianhao"
                                     value="<?php echo $_GET["fangwubianhao"]; ?>"/>

                        房屋标题： <input type="text" class="form-control" style="" name="fangwubiaoti"
                                     value="<?php echo $_GET["fangwubiaoti"]; ?>"/>

                        类型： <select class="form-control class_leixing1" data-value="<?php echo $_GET["leixing"]; ?>"
                                    id="leixing" name="leixing">
                            <option value="">请选择
                            </option><?php $select = db()->select("SELECT * FROM fangwuleixing ORDER BY id desc"); ?>
                            <?php foreach ($select as $m) { ?>
                                <option value="<?php echo $m["id"]; ?>"><?php echo $m["leixing"]; ?></option>
                            <?php } ?>

                        </select>
                        <script>
                            $(".class_leixing1").val($(".class_leixing1").attr("data-value"))</script>


                        房屋户型： <input type="text" class="form-control" style="" name="fangwuhuxing"
                                     value="<?php echo $_GET["fangwuhuxing"]; ?>"/>

                        楼层： <input type="text" class="form-control" style="width:80px;" name="louceng_start"
                                   value="<?php echo $_GET["louceng_start"]; ?>"/>-
                        <input type="text" class="form-control" style="width:80px;" name="louceng_end"
                               value="<?php echo $_GET["louceng_end"]; ?>"/>

                        是否有电梯： <select class="form-control class_shifouyoudianti2"
                                       data-value="<?php echo $_GET["shifouyoudianti"]; ?>" data-rule-required="true"
                                       data-msg-required="请填写是否有电梯" id="shifouyoudianti" name="shifouyoudianti">
                            <option value="">请选择</option>
                            <option value="是">是</option>
                            <option value="否">否</option>

                        </select>
                        <script>
                            $(".class_shifouyoudianti2").val($(".class_shifouyoudianti2").attr("data-value"))</script>


                        租赁类型： <select class="form-control class_zulinleixing3"
                                      data-value="<?php echo $_GET["zulinleixing"]; ?>" id="zulinleixing"
                                      name="zulinleixing">
                            <option value="">请选择</option>
                            <option value="整租">整租</option>
                            <option value="分租">分租</option>

                        </select>
                        <script>
                            $(".class_zulinleixing3").val($(".class_zulinleixing3").attr("data-value"))</script>


                        价格区间： <select class="form-control class_jiagequjian4"
                                      data-value="<?php echo $_GET["jiagequjian"]; ?>" data-rule-required="true"
                                      data-msg-required="请填写价格区间" id="jiagequjian" name="jiagequjian">
                            <option value="">请选择</option>
                            <option value="100以下">100以下</option>
                            <option value="100-500">100-500</option>
                            <option value="500-1000">500-1000</option>
                            <option value="1000-2000">1000-2000</option>
                            <option value="2000-3000">2000-3000</option>
                            <option value="3000以上">3000以上</option>

                        </select>
                        <script>
                            $(".class_jiagequjian4").val($(".class_jiagequjian4").attr("data-value"))</script>


                        押金方式： <select class="form-control class_yajinfangshi5"
                                      data-value="<?php echo $_GET["yajinfangshi"]; ?>" data-rule-required="true"
                                      data-msg-required="请填写押金方式" id="yajinfangshi" name="yajinfangshi">
                            <option value="">请选择</option>
                            <option value="免押金">免押金</option>
                            <option value="押一付一">押一付一</option>
                            <option value="押二付一">押二付一</option>
                            <option value="其他">其他</option>

                        </select>
                        <script>
                            $(".class_yajinfangshi5").val($(".class_yajinfangshi5").attr("data-value"))</script>


                        距离学校： <select class="form-control class_julixuexiao6"
                                      data-value="<?php echo $_GET["julixuexiao"]; ?>" id="julixuexiao"
                                      name="julixuexiao">
                            <option value="">请选择</option>
                            <option value="100米">100米</option>
                            <option value="500米">500米</option>
                            <option value="1000米">1000米</option>
                            <option value="1000米以上">1000米以上</option>

                        </select>
                        <script>
                            $(".class_julixuexiao6").val($(".class_julixuexiao6").attr("data-value"))</script>


                        房屋状态： <select class="form-control class_fangwuzhuangtai7"
                                      data-value="<?php echo $_GET["fangwuzhuangtai"]; ?>" id="fangwuzhuangtai"
                                      name="fangwuzhuangtai">
                            <option value="">请选择</option>
                            <option value="待租">待租</option>
                            <option value="已租">已租</option>

                        </select>
                        <script>
                            $(".class_fangwuzhuangtai7").val($(".class_fangwuzhuangtai7").attr("data-value"))</script>


                        设施： <select class="form-control class_sheshi8" data-value="<?php echo $_GET["sheshi"]; ?>"
                                    id="sheshi" name="sheshi[]">
                            <option value="">请选择</option>
                            <option value="床">床</option>
                            <option value="衣柜">衣柜</option>
                            <option value="沙发">沙发</option>
                            <option value="电视">电视</option>
                            <option value="冰箱">冰箱</option>
                            <option value="洗衣机">洗衣机</option>
                            <option value="空调">空调</option>
                            <option value="热水器">热水器</option>
                            <option value="宽带">宽带</option>
                            <option value="暖气">暖气</option>
                            <option value="燃气罩">燃气罩</option>
                            <option value="阳台">阳台</option>
                            <option value="卫生巾">卫生巾</option>
                            <option value="只能门锁">只能门锁</option>
                            <option value="油烟机">油烟机</option>
                            <option value="可做饭">可做饭</option>

                        </select>
                        <script>
                            (function () {
                                var dataValue = "<?php echo $_GET["sheshi"]; ?>".split(",");
                                for (var i = 0; i < dataValue.length; i++) {
                                    $(".class_sheshi8>option[value='" + dataValue[i] + "']").prop("selected", true);
                                }
                            })()</script>


                        <select class="form-control" name="orderby" id="orderby">

                            <option value="id">按发布时间</option>
                            <option value="zuiduanzuqi">
                                按最短租期
                            </option>
                            <option value="shoucangliang">
                                按收藏量
                            </option>
                            <option value="liulanliang">
                                按浏览量
                            </option>

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
                            <th data-field="fangwubianhao">房屋编号</th>
                            <th data-field="fangwubiaoti">房屋标题</th>
                            <th data-field="leixing">类型</th>
                            <th data-field="xiaoqumingcheng">小区名称</th>
                            <th data-field="fangwuhuxing">房屋户型</th>
                            <th data-field="fangwutupian">房屋图片</th>
                            <th data-field="louceng">楼层</th>
                            <th data-field="shifouyoudianti">是否有电梯</th>
                            <th data-field="mianji">面积</th>
                            <th data-field="zulinleixing">租赁类型</th>
                            <th data-field="fangwuzujin">房屋租金</th>
                            <th data-field="jiagequjian">价格区间</th>
                            <th data-field="yajinfangshi">押金方式</th>
                            <th data-field="julixuexiao">距离学校</th>
                            <th data-field="zuiduanzuqi">最短租期 (月)
                            </th>
                            <th data-field="fangwudizhi">房屋地址</th>
                            <th data-field="fangwuzhuangtai">房屋状态</th>
                            <th data-field="fangjianshu">房间数</th>
                            <th data-field="fangchanzhengming">房产证明</th>
                            <th data-field="faburen">发布人</th>

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
                                    <?php echo $map["fangwubianhao"]; ?>                        </td>
                                <td>
                                    <?php echo $map["fangwubiaoti"]; ?>                        </td>
                                <td>
                                    <?php $mapfangwuleixing2 = db()->find("SELECT leixing,id FROM fangwuleixing where id='" . $map["leixing"] . "'"); ?><?php echo $mapfangwuleixing2["leixing"]; ?>                        </td>
                                <td>
                                    <?php echo $map["xiaoqumingcheng"]; ?>                        </td>
                                <td>
                                    <?php echo $map["fangwuhuxing"]; ?>                        </td>
                                <td>
                                    <?php if ("" == $map["fangwutupian"]) { ?>-<?php } else { ?><img width="100"
                                                                                                     src="<?php echo Info::images($map["fangwutupian"]); ?>"/><?php } ?>
                                </td>
                                <td>
                                    <?php echo $map["louceng"]; ?>                        </td>
                                <td>
                                    <?php echo $map["shifouyoudianti"]; ?>                        </td>
                                <td>
                                    <?php echo $map["mianji"]; ?>                        </td>
                                <td>
                                    <?php echo $map["zulinleixing"]; ?>                        </td>
                                <td>
                                    <?php echo $map["fangwuzujin"]; ?>                        </td>
                                <td>
                                    <?php echo $map["jiagequjian"]; ?>                        </td>
                                <td>
                                    <?php echo $map["yajinfangshi"]; ?>                        </td>
                                <td>
                                    <?php echo $map["julixuexiao"]; ?>                        </td>
                                <td>
                                    <?php echo $map["zuiduanzuqi"]; ?>                        </td>
                                <td>
                                    <?php echo $map["fangwudizhi"]; ?>                        </td>
                                <td>
                                    <?php echo $map["fangwuzhuangtai"]; ?>                        </td>
                                <td>
                                    <?php echo $map["fangjianshu"]; ?>                        </td>
                                <td>
                                    <?php if ("" == $map["fangchanzhengming"]) { ?>-<?php } else { ?><img width="100"
                                                                                                          src="<?php echo Info::images($map["fangchanzhengming"]); ?>"/><?php } ?>
                                </td>
                                <td>
                                    <?php echo $map["faburen"]; ?>                        </td>

                                <td>
                                    <?php echo $map["issh"]; ?>
                                    <a href="action.php?a=sh&id=<?php echo $map["id"]; ?>&yuan=<?php echo $map["issh"]; ?>&tablename=fangwuxinxi">
                                        <?php if ($map["issh"] == "是") { ?>
                                            取消审核
                                        <?php } else { ?>
                                            审核
                                        <?php } ?>
                                    </a>
                                </td>
                                <td align="center">
<!--                                    <a class="btn btn-primary btn-xs"-->
<!--                                       href="fangjianxinxi_add.php?id=--><?php //echo $map["id"]; ?><!--"> 添加房间信息 </a>-->
<!---->
<!---->
<!--                                    <a class="btn btn-default btn-xs"-->
<!--                                       href="fangjianxinxi_list.php?fangwuxinxiid=--><?php //echo $map["id"]; ?><!--">-->
<!--                                        查询房间信息 </a>-->


                                    <a class="btn btn-info btn-xs"
                                       href="fangwuxinxi_detail.php?id=<?php echo $map["id"]; ?>" title="详情"> 详情 </a>


                                    <a class="btn btn-success btn-xs"
                                       href="fangwuxinxi_updt.php?id=<?php echo $map["id"]; ?>" title="编辑"> 编辑 </a>


                                    <a class="btn btn-danger btn-xs"
                                       href="fangwuxinxi.php?a=delete&id=<?php echo $map["id"]; ?>"
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