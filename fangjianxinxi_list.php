<?php  require_once 'initialize.php';  ?><?php // --------------------------------------------------
$where = " 1=1 "; // 防止sql 语句where and 这样的错误
$orderby = isset($_REQUEST['orderby']) ? $_REQUEST['orderby'] : 'id';   // 获取前台搜索框中 选择的排序类型,默认为发布时间倒序
$sort    = isset($_REQUEST['sort']) ? $_REQUEST['sort'] : 'DESC'; // 获取前台搜索框中 排序类型，默认为倒序



    

    // 设置fangwuxinxi模块，表id 的值是提交过来，有则只查询这些内容



     if($_REQUEST["fangwuxinxiid"] !=  "" ){     $where .= " AND fangwuxinxiid='".$_REQUEST["fangwuxinxiid"]."' ";
    }
// 根据搜索提交的表单搜索数据

                 if($_GET["fangwubianhao"] != null && !"" ==  $_GET["fangwubianhao"] ){ $where.=" AND fangwubianhao LIKE '%".$_GET["fangwubianhao"]."%'"; } 
                 if($_GET["fangwubiaoti"] != null && !"" ==  $_GET["fangwubiaoti"] ){ $where.=" AND fangwubiaoti LIKE '%".$_GET["fangwubiaoti"]."%'"; } 
                 if($_GET["leixing"] != null && !"" ==  $_GET["leixing"] ){ 
$where.=" AND leixing ='".$_GET["leixing"]."'"; } 
                     if($_GET["fangwuhuxing"] != null && !"" ==  $_GET["fangwuhuxing"] ){ $where.=" AND fangwuhuxing LIKE '%".$_GET["fangwuhuxing"]."%'"; } 
                     if($_GET["zulinleixing"] != null && !"" ==  $_GET["zulinleixing"] ){ 
$where.=" AND zulinleixing ='".$_GET["zulinleixing"]."'"; } 
                                     if($_GET["zhuangtai"] != null && !"" ==  $_GET["zhuangtai"] ){ 
$where.=" AND zhuangtai ='".$_GET["zhuangtai"]."'"; } 
        
// 构建fangjianxinxi数据模型
$query = M("fangjianxinxi");
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
            房间信息查询
        </span>
    </div>
    <div class="panel-body">
        
    


<div class="form-search pa10 bg-warning">
    <form class="form-inline" action="?" size="small" id="formSearch"><!-- form 标签开始 -->
    


                  
                   房屋编号： <input type="text" class="form-control" style="" name="fangwubianhao" value="<?php echo $_GET["fangwubianhao"]; ?>"/>
                    
                   房屋标题： <input type="text" class="form-control" style="" name="fangwubiaoti" value="<?php echo $_GET["fangwubiaoti"]; ?>"/>
                    
                   类型： <select class="form-control class_leixing1" data-value="<?php echo $_GET["leixing"]; ?>" id="leixing" name="leixing">
<option value="">请选择</option><?php  $select = db()->select("SELECT * FROM fangwuleixing ORDER BY id desc");  ?>
<?php  foreach($select as $m){  ?>
<option value="<?php echo $m["id"]; ?>"><?php echo $m["leixing"]; ?></option>
<?php } ?>

</select>
<script>
$(".class_leixing1").val($(".class_leixing1").attr("data-value"))</script>

                    
                   房屋户型： <input type="text" class="form-control" style="" name="fangwuhuxing" value="<?php echo $_GET["fangwuhuxing"]; ?>"/>
                    
                   租赁类型： <select class="form-control class_zulinleixing2" data-value="<?php echo $_GET["zulinleixing"]; ?>" id="zulinleixing" name="zulinleixing">
<option value="">请选择</option><option value="整租">整租</option>
<option value="单租">单租</option>

</select>
<script>
$(".class_zulinleixing2").val($(".class_zulinleixing2").attr("data-value"))</script>

                    
                   状态： <select class="form-control class_zhuangtai3" data-value="<?php echo $_GET["zhuangtai"]; ?>" id="zhuangtai" name="zhuangtai">
<option value="">请选择</option><option value="待租">待租</option>
<option value="已租">已租</option>

</select>
<script>
$(".class_zhuangtai3").val($(".class_zhuangtai3").attr("data-value"))</script>

          
        <select class="form-control" name="orderby" id="orderby">

            <option value="id">按发布时间</option>
                                <option value="danjianjiage">
                        按单间价格                    </option>
                        
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
                                        <th data-field="fangwubianhao">房屋编号                                            </th>
                                        <th data-field="fangwubiaoti">房屋标题                                            </th>
                                        <th data-field="leixing">类型                                            </th>
                                        <th data-field="xiaoqumingcheng">小区名称                                            </th>
                                        <th data-field="fangwuhuxing">房屋户型                                            </th>
                                        <th data-field="louceng">楼层                                            </th>
                                        <th data-field="zulinleixing">租赁类型                                            </th>
                                        <th data-field="faburen">发布人                                            </th>
                                        <th data-field="fangjianmingcheng">房间名称                                            </th>
                                        <th data-field="fangjiantupian">房间图片                                            </th>
                                        <th data-field="mianji">面积                                            </th>
                                        <th data-field="danjianjiage">单间价格                                            </th>
                                        <th data-field="zhuangtai">状态                                            </th>
                    
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
                            <?php echo $map["fangwubianhao"]; ?>                        </td>
                                            <td>
                            <?php echo $map["fangwubiaoti"]; ?>                        </td>
                                            <td>
                            <?php  $mapfangwuleixing2 = db()->find("SELECT leixing,id FROM fangwuleixing where id='".$map["leixing"]."'");  ?><?php echo $mapfangwuleixing2["leixing"]; ?>                        </td>
                                            <td>
                            <?php echo $map["xiaoqumingcheng"]; ?>                        </td>
                                            <td>
                            <?php echo $map["fangwuhuxing"]; ?>                        </td>
                                            <td>
                            <?php echo $map["louceng"]; ?>                        </td>
                                            <td>
                            <?php echo $map["zulinleixing"]; ?>                        </td>
                                            <td>
                            <?php echo $map["faburen"]; ?>                        </td>
                                            <td>
                            <?php echo $map["fangjianmingcheng"]; ?>                        </td>
                                            <td>
                            <?php  if("" ==  $map["fangjiantupian"] ){  ?>-<?php  } else {   ?><img width="100" src="<?php echo Info::images($map["fangjiantupian"]); ?>"/><?php } ?>                        </td>
                                            <td>
                            <?php echo $map["mianji"]; ?>                        </td>
                                            <td>
                            <?php echo $map["danjianjiage"]; ?>                        </td>
                                            <td>
                            <?php echo $map["zhuangtai"]; ?>                        </td>
                    
                                                            <td align="center">
                                                                        <a class="btn btn-info btn-xs" href="fangjianxinxi_detail.php?id=<?php echo $map["id"]; ?>" title="详情"> 详情 </a>  
 

<a class="btn btn-success btn-xs" href="fangjianxinxi_updt.php?id=<?php echo $map["id"]; ?>" title="编辑"> 编辑 </a>  
 

<a class="btn btn-danger btn-xs" href="fangjianxinxi.php?a=delete&id=<?php echo $map["id"]; ?>" onclick="return confirm('确定删除？此操作不可恢复')" title="删除"> 删除 </a>  
 

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