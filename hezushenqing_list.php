<?php  require_once 'initialize.php';  ?><?php // --------------------------------------------------
$where = " 1=1 "; // 防止sql 语句where and 这样的错误
$orderby = isset($_REQUEST['orderby']) ? $_REQUEST['orderby'] : 'id';   // 获取前台搜索框中 选择的排序类型,默认为发布时间倒序
$sort    = isset($_REQUEST['sort']) ? $_REQUEST['sort'] : 'DESC'; // 获取前台搜索框中 排序类型，默认为倒序



    

    // 设置fenzuxinxi模块，表id 的值是提交过来，有则只查询这些内容



     if($_REQUEST["fenzuxinxiid"] !=  "" ){     $where .= " AND fenzuxinxiid='".$_REQUEST["fenzuxinxiid"]."' ";
    }
// 根据搜索提交的表单搜索数据

                                 if($_GET["fangwuhuxing"] != null && !"" ==  $_GET["fangwuhuxing"] ){ $where.=" AND fangwuhuxing LIKE '%".$_GET["fangwuhuxing"]."%'"; } 
                                     if($_GET["leixing"] != null && !"" ==  $_GET["leixing"] ){ 
$where.=" AND leixing ='".$_GET["leixing"]."'"; } 
                 if($_GET["sheshi"] != null && !"" ==  $_GET["sheshi"] ){ $where.=" AND sheshi LIKE '%".$_GET["sheshi"]."%'"; } 
                 if($_GET["shifouyoudianti"] != null && !"" ==  $_GET["shifouyoudianti"] ){ 
$where.=" AND shifouyoudianti ='".$_GET["shifouyoudianti"]."'"; } 
                 if($_GET["zulinleixing"] != null && !"" ==  $_GET["zulinleixing"] ){ 
$where.=" AND zulinleixing ='".$_GET["zulinleixing"]."'"; } 
                             if($_GET["xingming"] != null && !"" ==  $_GET["xingming"] ){ $where.=" AND xingming LIKE '%".$_GET["xingming"]."%'"; } 
                 if($_GET["shouji"] != null && !"" ==  $_GET["shouji"] ){ $where.=" AND shouji LIKE '%".$_GET["shouji"]."%'"; } 
                     if($_GET["hezuzhuangtai"] != null && !"" ==  $_GET["hezuzhuangtai"] ){ 
$where.=" AND hezuzhuangtai ='".$_GET["hezuzhuangtai"]."'"; } 
                
// 构建hezushenqing数据模型
$query = M("hezushenqing");
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
            合租申请查询
        </span>
    </div>
    <div class="panel-body">
        
    


<div class="form-search pa10 bg-warning">
    <form class="form-inline" action="?" size="small" id="formSearch"><!-- form 标签开始 -->
    


                  
                   房屋户型： <input type="text" class="form-control" style="" name="fangwuhuxing" value="<?php echo $_GET["fangwuhuxing"]; ?>"/>
                    
                   类型： <select class="form-control class_leixing1" data-value="<?php echo $_GET["leixing"]; ?>" id="leixing" name="leixing">
<option value="">请选择</option><?php  $select = db()->select("SELECT * FROM fangwuleixing ORDER BY id desc");  ?>
<?php  foreach($select as $m){  ?>
<option value="<?php echo $m["id"]; ?>"><?php echo $m["leixing"]; ?></option>
<?php } ?>

</select>
<script>
$(".class_leixing1").val($(".class_leixing1").attr("data-value"))</script>

                    
                   设施： <select class="form-control class_sheshi2" data-value="<?php echo $_GET["sheshi"]; ?>" id="sheshi" name="sheshi[]">
<option value="">请选择</option><option value="床">床</option>
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
(function(){
                            var dataValue = "<?php echo $_GET["sheshi"]; ?>".split(",");
                            for(var i=0;i<dataValue.length;i++){
                                $(".class_sheshi2>option[value='"+dataValue[i]+"']").prop("selected" , true);
                            }
                        })()</script>

                    
                   是否有电梯： <select class="form-control class_shifouyoudianti3" data-value="<?php echo $_GET["shifouyoudianti"]; ?>" id="shifouyoudianti" name="shifouyoudianti">
<option value="">请选择</option><option value="是">是</option>
<option value="否">否</option>

</select>
<script>
$(".class_shifouyoudianti3").val($(".class_shifouyoudianti3").attr("data-value"))</script>

                    
                   租赁类型： <select class="form-control class_zulinleixing4" data-value="<?php echo $_GET["zulinleixing"]; ?>" id="zulinleixing" name="zulinleixing">
<option value="">请选择</option><option value="整租">整租</option>
<option value="分租">分租</option>

</select>
<script>
$(".class_zulinleixing4").val($(".class_zulinleixing4").attr("data-value"))</script>

                    
                   姓名： <input type="text" class="form-control" style="" name="xingming" value="<?php echo $_GET["xingming"]; ?>"/>
                    
                   手机： <input type="text" class="form-control" style="" name="shouji" value="<?php echo $_GET["shouji"]; ?>"/>
                    
                   合租状态： <select class="form-control class_hezuzhuangtai5" data-value="<?php echo $_GET["hezuzhuangtai"]; ?>" id="hezuzhuangtai" name="hezuzhuangtai">
<option value="">请选择</option><option value="待审核">待审核</option>
<option value="已通过">已通过</option>
<option value="未通过">未通过</option>

</select>
<script>
$(".class_hezuzhuangtai5").val($(".class_hezuzhuangtai5").attr("data-value"))</script>

          
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
                                        <th data-field="fangwutupian">房屋图片                                            </th>
                                        <th data-field="louceng">楼层                                            </th>
                                        <th data-field="mianji">面积                                            </th>
                                        <th data-field="leixing">类型                                            </th>
                                        <th data-field="zulinleixing">租赁类型                                            </th>
                                        <th data-field="fangwudizhi">房屋地址                                            </th>
                                        <th data-field="fentanzujin">分摊租金                                            </th>
                                        <th data-field="zulinyonghu">租赁用户                                            </th>
                                        <th data-field="xingming">姓名                                            </th>
                                        <th data-field="shouji">手机                                            </th>
                                        <th data-field="shenfenzheng">身份证                                            </th>
                                        <th data-field="hezuzhuangtai">合租状态                                            </th>
                                        <th data-field="hezumiaoshu">合租描述                                            </th>
                                        <th data-field="shenqingren">申请人                                            </th>
                    
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
                            <?php  if("" ==  $map["fangwutupian"] ){  ?>-<?php  } else {   ?><img width="100" src="<?php echo Info::images($map["fangwutupian"]); ?>"/><?php } ?>                        </td>
                                            <td>
                            <?php echo $map["louceng"]; ?>                        </td>
                                            <td>
                            <?php echo $map["mianji"]; ?>                        </td>
                                            <td>
                            <?php  $mapfangwuleixing2 = db()->find("SELECT leixing,id FROM fangwuleixing where id='".$map["leixing"]."'");  ?><?php echo $mapfangwuleixing2["leixing"]; ?>                        </td>
                                            <td>
                            <?php echo $map["zulinleixing"]; ?>                        </td>
                                            <td>
                            <?php echo $map["fangwudizhi"]; ?>                        </td>
                                            <td>
                            <?php echo $map["fentanzujin"]; ?>                        </td>
                                            <td>
                            <?php echo $map["zulinyonghu"]; ?>                        </td>
                                            <td>
                            <?php echo $map["xingming"]; ?>                        </td>
                                            <td>
                            <?php echo $map["shouji"]; ?>                        </td>
                                            <td>
                            <?php echo $map["shenfenzheng"]; ?>                        </td>
                                            <td>
                            <?php echo $map["hezuzhuangtai"]; ?>                        </td>
                                            <td>
                            <pre style="padding: 5px;background: none;border: none;margin: 0;"><?php echo $map["hezumiaoshu"]; ?></pre>                        </td>
                                            <td>
                            <?php echo $map["shenqingren"]; ?>                        </td>
                    
                                                            <td align="center">
                                                                        <a class="btn btn-info btn-xs" href="hezushenqing_detail.php?id=<?php echo $map["id"]; ?>" title="详情"> 详情 </a>  
 

<a class="btn btn-success btn-xs" href="hezushenqing_updt.php?id=<?php echo $map["id"]; ?>" title="编辑"> 编辑 </a>  
 

<a class="btn btn-danger btn-xs" href="hezushenqing.php?a=delete&id=<?php echo $map["id"]; ?>" onclick="return confirm('确定删除？此操作不可恢复')" title="删除"> 删除 </a>  
 

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