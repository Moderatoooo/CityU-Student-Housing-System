<?php  require_once 'initialize.php';  ?>    <?php checkLogin();  // 检测是否登录 ?>

<?php             // 获取当前用户得数据
        $mmm = M('admins')->where('id' , $_SESSION['id'])->find();
    
    
 ?> 
<?php include "head.php" ?>

<script src="js/jquery.validate.js"></script>




<div>



<div class="panel panel-default">
    <div class="panel-heading">
        <span class="titles">
            添加管理员
        </span>
    </div>
    <div class="panel-body">
        
    

<form action="admins.php?a=update" method="post" name="form1" id="adminsform1"><!-- form 标签开始 -->
    
                    <div class="form-group form-type-text">
    <div class="form-item-flex">
        <label class="form-label-title"><span style="color: red;">*</span> 帐号</label>
        <div class="form-label-control">
            
                            <?php echo Info::html($mmm["username"]); ?><input type="hidden" class="form-control" placeholder="输入帐号" style="width:150px;" data-rule-required="true" data-msg-required="请填写帐号" remote="ajax.php?checktype=update&id=<?php echo $mmm["id"]; ?>&table=admins&col=username" data-msg-remote="内容重复了" id="username" name="username" value="<?php echo Info::html($mmm["username"]); ?>"/>                    
        </div>
        
    </div>
</div>
            
    <div class="form-group" id="form-item-btn">
    <div class="form-item-flex">
        <label class="form-label-title">  </label>
        <div class="form-label-control">
            
                    <input name="id" value="<?php echo $mmm["id"]; ?>" type="hidden"/>
            <input name="referer" value="?" type="hidden"/>
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
        $('#adminsform1').validate();
    });
</script>




    </div>
</div>


</div>


<?php include "foot.php" ?>