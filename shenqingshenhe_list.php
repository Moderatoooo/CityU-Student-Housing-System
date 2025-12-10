<?php  require_once 'initialize.php';  ?><?php // --------------------------------------------------
$where = " 1=1 "; // 防止sql 语句where and 这样的错误
$orderby = isset($_REQUEST['orderby']) ? $_REQUEST['orderby'] : 'id';   // 获取前台搜索框中 选择的排序类型,默认为发布时间倒序
$sort    = isset($_REQUEST['sort']) ? $_REQUEST['sort'] : 'DESC'; // 获取前台搜索框中 排序类型，默认为倒序



    

    // 设置hezushenqing模块，表id 的值是提交过来，有则只查询这些内容



     if($_REQUEST["hezushenqingid"] !=  "" ){     $where .= " AND hezushenqingid='".$_REQUEST["hezushenqingid"]."' ";
    }
// 根据搜索提交的表单搜索数据

                                     if($_GET["fangwuhuxing"] != null && !"" ==  $_GET["fangwuhuxing"] ){ $where.=" AND fangwuhuxing LIKE '%".$_GET["fangwuhuxing"]."%'"; } 
                                             if($_GET["leixing"] != null && !"" ==  $_GET["leixing"] ){ 
$where.=" AND leixing ='".$_GET["leixing"]."'"; } 
                 if($_GET["xingming"] != null && !"" ==  $_GET["xingming"] ){ $where.=" AND xingming LIKE '%".$_GET["xingming"]."%'"; } 
                     if($_GET["shenhejieguo"] != null && !"" ==  $_GET["shenhejieguo"] ){ 
$where.=" AND shenhejieguo ='".$_GET["shenhejieguo"]."'"; } 
            
// 构建shenqingshenhe数据模型
$query = M("shenqingshenhe");
// 设置所有字段
$query->field("*");
$query->where($where)->order("$orderby $sort");   // 根据条件查询列表
list($lists , $page) = $query->page(15);    // 查询列表并返回分页代码

// ------------------------------------------------------------------

?><?php include "head.php" ?>





<div>



<div class="panel panel-default">
    <div class="panel-heading">
        <span class="titles">
            申请审核查询
        </span>
    </div>
    <div class="panel-body">
        
    


<div class="form-search pa10 bg-warning">
    <form class="form-inline" action="?" size="small" id="formSearch"><!-- form 标签开始 -->
    


                  
                   房屋户型： <input type="text" class="form-control" style="" name="fangwuhuxing" value="<?php echo $_GET["fangwuhuxing"]; ?>"/>
                    
                   类型： <select class="form-control class_leixing42" data-value="<?php echo $_GET["leixing"]; ?>" id="leixing" name="leixing">
<option value="">请选择</option><?php  $select = db()->select("SELECT * FROM fangwuleixing ORDER BY id desc");  ?>
<?php  foreach($select as $m){  ?>
<option value="<?php echo $m["id"]; ?>"><?php echo $m["leixing"]; ?></option>
<?php } ?>

</select>
<script>
$(".class_leixing42").val($(".class_leixing42").attr("data-value"))</script>

                    
                   姓名： <input type="text" class="form-control" style="" name="xingming" value="<?php echo $_GET["xingming"]; ?>"/>
                    
                   审核结果： <select class="form-control class_shenhejieguo43" data-value="<?php echo $_GET["shenhejieguo"]; ?>" data-rule-required="true" data-msg-required="请填写审核结果" id="shenhejieguo" name="shenhejieguo">
<option value="">请选择</option><option value="已通过">已通过</option>
<option value="未通过">未通过</option>

</select>
<script>
$(".class_shenhejieguo43").val($(".class_shenhejieguo43").attr("data-value"))</script>

          
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



    
<script>$("#orderby").val("<?php echo $orderby; ?>");$("#sort").val("<?php echo $sort; ?>".toLocaleLowerCase());</script>







    


        
<div class="list-table">
            <table width="100%" border="1" class="table table-list table-bordered table-hover">
                <thead>
                <tr align="center">
                    <th width="60" data-field="item">序号</th>
                                        <th data-field="fangwuhuxing">房屋户型                                            </th>
                                        <th data-field="xiaoqumingcheng">小区名称                                            </th>
                                        <th data-field="fentanzujin">分摊租金                                            </th>
                                        <th data-field="zulinyonghu">租赁用户                                            </th>
                                        <th data-field="fangwutupian">房屋图片                                            </th>
                                        <th data-field="louceng">楼层                                            </th>
                                        <th data-field="mianji">面积                                            </th>
                                        <th data-field="leixing">类型                                            </th>
                                        <th data-field="xingming">姓名                                            </th>
                                        <th data-field="shenqingren">申请人                                            </th>
                                        <th data-field="shenhejieguo">审核结果                                            </th>
                                        <th data-field="shenhebeizhu">审核备注                                            </th>
                    
                                                            <th width="220" data-field="handler">操作</th>
                </tr>
                </thead>
                <tbody>

                <?php $i=0;
 foreach( $lists as $map){ 
$i++;
 ?>
                <tr id="<?php echo $map["id"]; ?>" pid="">
                    <td width="30" align="center">
                        <label>
                                                        <?php echo $i; ?>
                        </label>
                    </td>
                                            <td>
                            <?php echo $map["fangwuhuxing"]; ?>                        </td>
                                            <td>
                            <?php echo $map["xiaoqumingcheng"]; ?>                        </td>
                                            <td>
                            <?php echo $map["fentanzujin"]; ?>                        </td>
                                            <td>
                            <?php echo $map["zulinyonghu"]; ?>                        </td>
                                            <td>
                            <?php  if("" ==  $map["fangwutupian"] ){  ?>-<?php  } else {   ?><img width="100" src="<?php echo Info::images($map["fangwutupian"]); ?>"/><?php } ?>                        </td>
                                            <td>
                            <?php echo $map["louceng"]; ?>                        </td>
                                            <td>
                            <?php echo $map["mianji"]; ?>                        </td>
                                            <td>
                            <?php  $mapfangwuleixing28 = db()->find("SELECT leixing,id FROM fangwuleixing where id='".$map["leixing"]."'");  ?><?php echo $mapfangwuleixing28["leixing"]; ?>                        </td>
                                            <td>
                            <?php echo $map["xingming"]; ?>                        </td>
                                            <td>
                            <?php echo $map["shenqingren"]; ?>                        </td>
                                            <td>
                            <?php echo $map["shenhejieguo"]; ?>                        </td>
                                            <td>
                            <pre style="padding: 5px;background: none;border: none;margin: 0;"><?php echo $map["shenhebeizhu"]; ?></pre>                        </td>
                    
                                                            <td align="center">
                                                                        <a class="btn btn-info btn-xs" href="shenqingshenhe_detail.php?id=<?php echo $map["id"]; ?>" title="详情"> 详情 </a>  
 

<a class="btn btn-success btn-xs" href="shenqingshenhe_updt.php?id=<?php echo $map["id"]; ?>" title="编辑"> 编辑 </a>  
 

<a class="btn btn-danger btn-xs" href="shenqingshenhe.php?a=delete&id=<?php echo $map["id"]; ?>" onclick="return confirm('确定删除？此操作不可恢复')" title="删除"> 删除 </a>  
 

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