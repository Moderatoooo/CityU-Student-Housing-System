<?php  require_once 'initialize.php';  ?>    <?php checkLogin();  // 检测是否登录 ?>

<?php             // 根据id 获取要修改得数据
        $mmm = M('fangdong')->where('id' , $_GET['id'])->find();
    
    
 ?> 
<?php include "head.php" ?>

<script src="js/jquery.validate.js"></script>
<link rel="stylesheet" href="js/layer/theme/default/layer.css"/>
<script src="js/layer/layer.js"></script>
<link href="js/h5upload/h5upload.css" rel="stylesheet">
<script src="js/h5upload/h5upload.js"></script>




<div>



<div class="panel panel-default">
    <div class="panel-heading">
        <span class="titles">
            添加房东
        </span>
    </div>
    <div class="panel-body">
        
    

<form action="fangdong.php?a=update" method="post" name="form1" id="fangdongform1"><!-- form 标签开始 -->
    
                    <div class="form-group form-type-text">
    <div class="form-item-flex">
        <label class="form-label-title"><span style="color: red;">*</span> 账号</label>
        <div class="form-label-control">
            
                            <?php echo Info::html($mmm["zhanghao"]); ?><input type="hidden" class="form-control" placeholder="输入账号" style="width:150px;" data-rule-required="true" data-msg-required="请填写账号" remote="ajax.php?checktype=update&id=<?php echo $mmm["id"]; ?>&table=fangdong&col=zhanghao" data-msg-remote="内容重复了" id="zhanghao" name="zhanghao" value="<?php echo Info::html($mmm["zhanghao"]); ?>"/>                    
        </div>
        
    </div>
</div>
                            <div class="form-group form-type-text">
    <div class="form-item-flex">
        <label class="form-label-title"><span style="color: red;">*</span> 姓名</label>
        <div class="form-label-control">
            
                            <input type="text" class="form-control" placeholder="输入姓名" style="width:150px;" data-rule-required="true" data-msg-required="请填写姓名" id="xingming" name="xingming" value="<?php echo Info::html($mmm["xingming"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-select">
    <div class="form-item-flex">
        <label class="form-label-title"><span style="color: red;">*</span> 性别</label>
        <div class="form-label-control">
            
                            <select class="form-control class_xingbie3" data-value="<?php echo Info::html($mmm["xingbie"]); ?>" data-rule-required="true" data-msg-required="请填写性别" id="xingbie" name="xingbie" style="width:250px">
<option value="男">男</option>
<option value="女">女</option>

</select>
<script>
$(".class_xingbie3").val($(".class_xingbie3").attr("data-value"))</script>
                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-text">
    <div class="form-item-flex">
        <label class="form-label-title"><span style="color: red;">*</span> 手机</label>
        <div class="form-label-control">
            
                            <input type="text" class="form-control" placeholder="输入手机" style="width:150px;" data-rule-required="true" data-msg-required="请填写手机" phone="true" data-msg-phone="请输入正确手机号码" id="shouji" name="shouji" value="<?php echo Info::html($mmm["shouji"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-text">
    <div class="form-item-flex">
        <label class="form-label-title"> 身份证</label>
        <div class="form-label-control">
            
                            <input type="text" class="form-control" placeholder="输入身份证" style="width:150px;" idcard="true" data-msg-email="请输入有效身份证号码" id="shenfenzheng" name="shenfenzheng" value="<?php echo Info::html($mmm["shenfenzheng"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-images">
    <div class="form-item-flex">
        <label class="form-label-title"> 房产证书</label>
        <div class="form-label-control">
            
                            <input type="hidden" id="fangchanzhengshu" name="fangchanzhengshu" value="<?php echo Info::html($mmm["fangchanzhengshu"]); ?>"/>
        <script>showUploadImages("#fangchanzhengshu","upload.html")</script>
                            
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-image">
    <div class="form-item-flex">
        <label class="form-label-title"><span style="color: red;">*</span> 头像</label>
        <div class="form-label-control">
            
                            <div class="input-group" style="width:250px">
    <input type="text" class="form-control" data-rule-required="true" data-msg-required="请填写头像" id="touxiang" name="touxiang" value="<?php echo Info::html($mmm["touxiang"]); ?>"/>

    <span class="input-group-btn"><button type="button" class="btn btn-default" onclick="layer.open({type:2,title:'上传图片',fixed:true,shadeClose:true,shade:0.5,area:['320px','150px'],content:'upload.html?result=touxiang'})">
    上传图片
</button></span>
</div>                    
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
        $('#fangdongform1').validate();
    });
</script>




    </div>
</div>


</div>


<?php include "foot.php" ?>