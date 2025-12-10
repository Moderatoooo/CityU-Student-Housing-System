<?php  require_once 'initialize.php';  ?>    <?php checkLogin();  // 检测是否登录 ?>

<?php             // 根据id 获取要修改得数据
        $mmm = M('fangwuleixing')->where('id' , $_GET['id'])->find();
    
    
 ?> 
<?php include "head.php" ?>

<script src="js/jquery.validate.js"></script>




<div>



<div class="panel panel-default">
    <div class="panel-heading">
        <span class="titles">
            添加房屋类型
        </span>
    </div>
    <div class="panel-body">
        
    

<form action="fangwuleixing.php?a=update" method="post" name="form1" id="fangwuleixingform1"><!-- form 标签开始 -->
    
                    <div class="form-group form-type-text">
    <div class="form-item-flex">
        <label class="form-label-title"> 类型</label>
        <div class="form-label-control">
            
                            <input type="text" class="form-control" placeholder="输入类型" style="width:150px;" id="leixing" name="leixing" value="<?php echo Info::html($mmm["leixing"]); ?>"/>                    
        </div>
        
    </div>
</div>
    
    <div class="form-group" id="form-item-btn">
    <div class="form-item-flex">
        <label class="form-label-title">  </label>
        <div class="form-label-control">
            
                    <input name="id" value="<?php echo $mmm["id"]; ?>" type="hidden"/>
            <input name="referer" value="<?php echo $_SERVER["HTTP_REFERER"] ?>" type="hidden"/>
            <input name="updtself" value="<?php echo $updtself; ?>" type="hidden"/>
                
        
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
        $('#fangwuleixingform1').validate();
    });
</script>




    </div>
</div>


</div>


<?php include "foot.php" ?>