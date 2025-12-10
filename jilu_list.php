<?php require_once 'initialize.php'; ?>
 <?php include "head.php" ?>

<script src="js/jquery.validate.js"></script>

<div style="padding: 10px" class="admin-content">
    <?php
    // --------------------------------------------------
    $where = " 1=1 "; // 防止sql 语句where and 这样的错误
    $orderby = isset($_REQUEST["order"]) ? $_REQUEST["order"] : "id"; // 获取前台搜索框中 选择的排序类型,默认为发布时间倒序
    $sort = isset($_REQUEST["sort"]) ? $_REQUEST["sort"] : "DESC"; // 获取前台搜索框中 排序类型，默认为倒序
    
    // 设置siliao模块，表id 的值是提交过来，有则只查询这些内容
    
    if ($_REQUEST["siliaoid"] != "") {
        $where .= " AND siliaoid='" . $_REQUEST["siliaoid"] . "' ";
    }
    // 根据搜索提交的表单搜索数据
    
    // 构建jilu数据模型
    $query = M("jilu");
    // 设置所有字段
    $query->field("*");
    $query->where($where)->order("$orderby $sort"); // 根据条件查询列表
    list($list, $page) = $query->page(15); // 查询列表并返回分页代码
    
    // ------------------------------------------------------------------
    ?>


    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="module-name"> 记录 </span>
            <span>列表</span>
        </div>
        <div class="panel-body">


            <?php require_once 'initialize.php'; ?>

            <?php if (empty($_GET['siliaoid'])) {
                showMessage('没找到相关详情页面');
            }

            $map = M("siliao")->where("id", $_GET['siliaoid'])->find();

            if (empty($map)) {
                showMessage('没找到相关详情页面');
            }


            ?>

            <div class="panel-body">


                <div class="pa10">
                    <div class="pa10 bg-white">
                        <table class="new-detail">
                            <tbody>
                            <tr>

                                <td class="detail-title">
                                    标题
                                </td>
                                <td class="detail-value">
                                    <?php echo $map["biaoti"]; ?>                    </td>

                            </tr>
                            <tr>

                                <td class="detail-title">
                                    咨询时间
                                </td>
                                <td class="detail-value">
                                    <?php echo $map["addtime"]; ?>                    </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>


            </div>


            <div class="list-table">
                <table width="100%" border="1" class="table table-list table-bordered table-hover">
                    <thead>
                        <tr align="center">
                            <th width="60" data-field="item">序号</th>
                            <th>内容</th>
                            <th width="180">发送人</th>
                            <th width="180">发送时间</th>
                            <th width="105" data-field="handler">操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        foreach ($list as $map) {
                            $i++;
                        ?>

                        <tr id="<?php echo $map["id"]; ?>" pid="">
                            <td width="30" align="center">
                                <label> <?php echo $i; ?> </label>
                            </td>
                            <td><?php echo $map["neirong"]; ?></td>
                            <td><?php echo $map["fasongren"]; ?> <?php echo $map["cx"]; ?></td>
                            <td><?php echo Info::subStr($map["addtime"] , 19 , ""); ?></td>
                            <td align="center">
<!--                                <a href="jilu_updt.php?id=--><?php //echo $map["id"]; ?><!--">编辑</a>-->

                                <a href="jilu.php?a=delete&id=<?php echo $map["id"]; ?>" onclick="return confirm('确定要删除？')">删除</a>
                                <!--qiatnalijne-->
                            </td>
                        </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>

            <?php echo $page->show() ?>
<br>
            <?php
            $readMap = M("siliao")
                ->where("id", $_REQUEST["siliao"])
                ->find();
            ?>
            <form action="jilu.php?a=insert" method="post" name="form1" id="form1">
                <!-- form 标签开始 -->

                <input type="hidden" name="siliaoid" value="<?php echo $_REQUEST["siliaoid"]; ?>" />
                <div class="form-group" style="display: none">
                    <div class="row">
                        <label style="text-align: right" class="col-sm-2 hiddex-xs">编号</label>
                        <div class="col-sm-10"><?php echo $readMap["bianhao"]; ?><input type="hidden" id="bianhao" name="bianhao" value="<?php echo Info::html($readMap["bianhao"]); ?>" /></div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label style="text-align: right" class="col-sm-2 hiddex-xs">内容</label>
                        <div class="col-sm-10">
                            <textarea style="width: 80%; height: 120px" class="form-control" placeholder="输入内容" id="neirong" name="neirong"></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label style="text-align: right" class="col-sm-2 hiddex-xs">发送人</label>
                        <div class="col-sm-10">
                            <input
                                    type="text"
                                    class="form-control"
                                    placeholder="输入发送人"
                                    style="width: 150px"
                                    readonly="readonly"
                                    id="fasongren"
                                    name="fasongren"
                                    value="<?php echo $_SESSION["username"]; ?>"
                            />
                        </div>
                    </div>
                </div>
                <div class="form-group" style="display: none">
                    <div class="row">
                        <label style="text-align: right" class="col-sm-2 hiddex-xs">cx</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="输入cx" style="width: 150px" id="cx" name="cx" value="<?php echo $_SESSION["cx"]; ?>" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label style="text-align: right" class="col-sm-2 hiddex-xs"> </label>
                        <div class="col-sm-10">
                            <input name="referer" value="" id="referers" type="hidden"/>
                            <input name="issh" value="否" id="issh" type="hidden"/>
                            <script>
                                $('#referers').val(location.href);
                            </script>
                            <button type="submit" class="btn btn-primary" name="Submit">提交</button>
                            <button type="reset" class="btn btn-default" name="Submit2">重置</button>
                        </div>
                    </div>
                </div>

                <!--form标签结束-->
            </form>
            <script>
                $(function () {
                    $("#form1").validate();
                });
            </script>
        </div>
    </div>
</div>
<?php include "foot.php" ?>

