<?php  require_once 'initialize.php';  ?>    <?php checkLogin();  // 检测是否登录 ?>

<?php             // 根据id 获取要修改得数据
        $mmm = M('lunbotu')->where('id' , $_GET['id'])->find();
    
    
 ?> 
<?php include "head.php" ?>

<script src="js/jquery.validate.js"></script>
<link rel="stylesheet" href="js/layer/theme/default/layer.css"/>
<script src="js/layer/layer.js"></script>




<div>



<div class="panel panel-default">
    <div class="panel-heading">
        <span class="titles">
            添加轮播图
        </span>
    </div>
    <div class="panel-body">
        
    

<form action="lunbotu.php?a=update" method="post" name="form1" id="lunbotuform1"><!-- form 标签开始 -->
    
                    <div class="form-group form-type-text">
    <div class="form-item-flex">
        <label class="form-label-title"><span style="color: red;">*</span> 标题</label>
        <div class="form-label-control">
            
                            <input type="text" class="form-control" placeholder="输入标题" style="width:150px;" data-rule-required="true" data-msg-required="请填写标题" id="title" name="title" value="<?php echo Info::html($mmm["title"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-image">
    <div class="form-item-flex">
        <label class="form-label-title"><span style="color: red;">*</span> 图片</label>
        <div class="form-label-control">
            
                            <div class="input-group" style="width:250px">
    <input type="text" class="form-control" data-rule-required="true" data-msg-required="请填写图片" id="image" name="image" value="<?php echo Info::html($mmm["image"]); ?>"/>

    <span class="input-group-btn"><button type="button" class="btn btn-default" onclick="layer.open({type:2,title:'上传图片',fixed:true,shadeClose:true,shade:0.5,area:['320px','150px'],content:'upload.html?result=image'})">
    上传图片
</button></span>
</div>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-long-text">
    <div class="form-item-flex">
        <label class="form-label-title"><span style="color: red;">*</span> 连接地址</label>
        <div class="form-label-control">
            
                            <input type="text" class="form-control" placeholder="输入连接地址" style="width:250px;" data-rule-required="true" data-msg-required="请填写连接地址" id="url" name="url" value="<?php echo Info::html($mmm["url"]); ?>"/>                    
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
        $('#lunbotuform1').validate();
    });
</script>




    </div>
</div>


</div>


<?php include "foot.php" ?>