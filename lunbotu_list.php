<?php  require_once 'initialize.php';  ?><?php // --------------------------------------------------
$where = " 1=1 "; // 防止sql 语句where and 这样的错误
$orderby = isset($_REQUEST['orderby']) ? $_REQUEST['orderby'] : 'id';   // 获取前台搜索框中 选择的排序类型,默认为发布时间倒序
$sort    = isset($_REQUEST['sort']) ? $_REQUEST['sort'] : 'DESC'; // 获取前台搜索框中 排序类型，默认为倒序




// 根据搜索提交的表单搜索数据

             if($_GET["title"] != null && !"" ==  $_GET["title"] ){ $where.=" AND title LIKE '%".$_GET["title"]."%'"; } 
            
// 构建lunbotu数据模型
$query = M("lunbotu");
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
            轮播图查询
        </span>
    </div>
    <div class="panel-body">
        
    


<div class="form-search pa10 bg-warning">
    <form class="form-inline" action="?" size="small" id="formSearch"><!-- form 标签开始 -->
    


                  
                   标题： <input type="text" class="form-control" style="" name="title" value="<?php echo $_GET["title"]; ?>"/>
          
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
                                        <th data-field="title">标题                                            </th>
                                        <th data-field="image">图片                                            </th>
                                        <th data-field="url">连接地址                                            </th>
                    
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
                            <?php echo $map["title"]; ?>                        </td>
                                            <td>
                            <?php  if("" ==  $map["image"] ){  ?>-<?php  } else {   ?><img width="100" src="<?php echo $map["image"]; ?>"/><?php } ?>                        </td>
                                            <td>
                            <?php echo $map["url"]; ?>                        </td>
                    
                                                            <td align="center">
                                                                        <a class="btn btn-success btn-xs" href="lunbotu_updt.php?id=<?php echo $map["id"]; ?>" title="编辑"> 编辑 </a>  
 

<a class="btn btn-danger btn-xs" href="lunbotu.php?a=delete&id=<?php echo $map["id"]; ?>" onclick="return confirm('确定删除？此操作不可恢复')" title="删除"> 删除 </a>  
 

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