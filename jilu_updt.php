<?php  require_once 'initialize.php';  ?>    <?php checkLogin();  // 检测是否登录 ?>

<?php             // 根据id 获取要修改得数据
        $mmm = M('jilu')->where('id' , $_GET['id'])->find();
    
            $readMap = M('siliao')->find($mmm['siliaoid']);
    
 ?> 
<?php include "head.php" ?>

<script src="js/jquery.validate.js"></script>




<div>



<div class="panel panel-default">
    <div class="panel-heading">
        <span class="titles">
            添加记录
        </span>
    </div>
    <div class="panel-body">
        
    

<form action="jilu.php?a=update" method="post" name="form1" id="jiluform1"><!-- form 标签开始 -->
    
            <input type="hidden" name="siliaoid" value="<?php echo $mmm["siliaoid"]; ?>"/>                <div class="form-group form-type-text">
    <div class="form-item-flex">
        <label class="form-label-title"> 编号</label>
        <div class="form-label-control">
            
                            <?php echo $mmm["bianhao"]; ?><input type="hidden" id="bianhao" name="bianhao" value="<?php echo Info::html($mmm["bianhao"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-textarea">
    <div class="form-item-flex">
        <label class="form-label-title"> 内容</label>
        <div class="form-label-control">
            
                            <textarea style="width: 80%;height: 120px" class="form-control" placeholder="输入内容" id="neirong" name="neirong"><?php echo Info::html($mmm["neirong"]); ?></textarea>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-text-user">
    <div class="form-item-flex">
        <label class="form-label-title"> 发送人</label>
        <div class="form-label-control">
            
                            <input type="text" class="form-control" placeholder="输入发送人" style="width:150px;" readonly="readonly" id="fasongren" name="fasongren" value="<?php echo $mmm["fasongren"]; ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-text">
    <div class="form-item-flex">
        <label class="form-label-title"> cx</label>
        <div class="form-label-control">
            
                            <input type="text" class="form-control" placeholder="输入cx" style="width:150px;" id="cx" name="cx" value="<?php echo Info::html($mmm["cx"]); ?>"/>                    
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
                <button type="button" class="btn btn-default" onclick="history.back()">
    返回
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
        $('#jiluform1').validate();
    });
</script>




    </div>
</div>


</div>


<?php include "foot.php" ?>