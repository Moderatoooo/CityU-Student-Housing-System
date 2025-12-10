<?php  require_once 'initialize.php';  ?>    <?php checkLogin();  // 检测是否登录 ?>

<?php  ?> 
<?php include "head.php" ?>
<?php include "header.php" ?>

<script src="js/jquery.validate.js"></script>




<div>

    
<div class="container"><!-- 使用bootstrap css框架，container定宽，并剧中 https://v3.bootcss.com/css/#overview-container -->

                    



<div class="panel panel-default">
    <div class="panel-heading">
        <span class="titles">
            添加收藏
        </span>
    </div>
    <div class="panel-body">
        
    

<form action="shoucang.php?a=insert" method="post" name="form1" id="shoucangform1"><!-- form 标签开始 -->
    
                                            
    <div class="form-group" id="form-item-btn">
    <div class="form-item-flex">
        <label class="form-label-title">  </label>
        <div class="form-label-control">
            
                
                     <input type="hidden" name="xwid" id="xwid" value="<?php echo $_GET["xwid"]; ?>"/>  
 <input type="hidden" name="biao" id="biao" value="<?php echo $_GET["biao"]; ?>"/>  
 <input type="hidden" name="biaoti" id="biaoti" value="<?php echo $_GET["biaoti"]; ?>"/>  
                                
        <button type="submit" class="btn btn-primary" name="Submit">
    提交
</button>
        <button type="reset" class="btn btn-default" name="Submit2">
    重置
</button>
            
        </div>
        
    </div>
</div>

<!--form标签结束--></form>


<?php  if('1' ==  $_REQUEST["hideBtn"] ){  ?>

<script>
    $('#form-item-btn').hide();
</script>

<?php } ?>



<script>
    $(function (){
        $('#shoucangform1').validate();
    });
</script>




    </div>
</div>


        
    
<!-- container定宽，并剧中结束 --></div>


</div>


<?php include "footer.php" ?>
<?php include "foot.php" ?>