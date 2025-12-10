<?php  require_once 'initialize.php';  ?><?php // --------------------------------------------------
$where = " 1=1 "; // 防止sql 语句where and 这样的错误
$orderby = isset($_REQUEST['orderby']) ? $_REQUEST['orderby'] : 'id';   // 获取前台搜索框中 选择的排序类型,默认为发布时间倒序
$sort    = isset($_REQUEST['sort']) ? $_REQUEST['sort'] : 'DESC'; // 获取前台搜索框中 排序类型，默认为倒序
    //  设置为当前用户的数据
    $where .= " AND pinglunren='".$_SESSION["username"]."' ";




// 根据搜索提交的表单搜索数据

                            
// 构建pinglun数据模型
$query = M("pinglun");
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
            评论查询
        </span>
    </div>
    <div class="panel-body">
        
    





    


        
<div class="list-table">
            <table width="100%" border="1" class="table table-list table-bordered table-hover">
                <thead>
                <tr align="center">
                    <th width="60" data-field="item">序号</th>
                                        <th data-field="faburen">发布人                                            </th>
                                        <th data-field="biaoti">标题                                            </th>
                                        <th data-field="pingfen">评分                                            </th>
                                        <th data-field="pinglunneirong">评论内容                                            </th>
                                        <th data-field="pinglunren">评论人                                            </th>
                    
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
                            <?php echo $map["faburen"]; ?>                        </td>
                                            <td>
                            <?php echo $map["biaoti"]; ?>                        </td>
                                            <td>
                            <?php echo $map["pingfen"]; ?>                        </td>
                                            <td>
                            <pre style="padding: 5px;background: none;border: none;margin: 0;"><?php echo $map["pinglunneirong"]; ?></pre>                        </td>
                                            <td>
                            <?php echo $map["pinglunren"]; ?>                        </td>
                    
                                                            <td align="center">
                                                                        <a class="btn btn-danger btn-xs" href="pinglun.php?a=delete&id=<?php echo $map["id"]; ?>" onclick="return confirm('确定删除？此操作不可恢复')" title="删除"> 删除 </a>  
 

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