<?php  require_once 'initialize.php';  ?>    <?php checkLogin();  // 检测是否登录 ?>

<?php             // 根据id 获取要修改得数据
        $mmm = M('shenhe')->where('id' , $_GET['id'])->find();
    
            $readMap = M('zulin')->find($mmm['zulinid']);
    
 ?> 
<?php include "head.php" ?>

<script src="js/jquery.validate.js"></script>




<div>



<div class="panel panel-default">
    <div class="panel-heading">
        <span class="titles">
            添加审核
        </span>
    </div>
    <div class="panel-body">
        
    

<form action="shenhe.php?a=update" method="post" name="form1" id="shenheform1"><!-- form 标签开始 -->
    
            <input type="hidden" name="zulinid" value="<?php echo $mmm["zulinid"]; ?>"/>                <div class="form-group form-type-text">
    <div class="form-item-flex">
        <label class="form-label-title"> 租赁单号</label>
        <div class="form-label-control">
            
                            <?php echo $mmm["zulindanhao"]; ?><input type="hidden" id="zulindanhao" name="zulindanhao" value="<?php echo Info::html($mmm["zulindanhao"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-text">
    <div class="form-item-flex">
        <label class="form-label-title"> 房屋编号</label>
        <div class="form-label-control">
            
                            <?php echo $mmm["fangwubianhao"]; ?><input type="hidden" id="fangwubianhao" name="fangwubianhao" value="<?php echo Info::html($mmm["fangwubianhao"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-long-text">
    <div class="form-item-flex">
        <label class="form-label-title"> 房屋标题</label>
        <div class="form-label-control">
            
                            <?php echo $mmm["fangwubiaoti"]; ?><input type="hidden" id="fangwubiaoti" name="fangwubiaoti" value="<?php echo Info::html($mmm["fangwubiaoti"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-text">
    <div class="form-item-flex">
        <label class="form-label-title"> 房屋户型</label>
        <div class="form-label-control">
            
                            <?php echo $mmm["fangwuhuxing"]; ?><input type="hidden" id="fangwuhuxing" name="fangwuhuxing" value="<?php echo Info::html($mmm["fangwuhuxing"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-text">
    <div class="form-item-flex">
        <label class="form-label-title"> 小区名称</label>
        <div class="form-label-control">
            
                            <?php echo $mmm["xiaoqumingcheng"]; ?><input type="hidden" id="xiaoqumingcheng" name="xiaoqumingcheng" value="<?php echo Info::html($mmm["xiaoqumingcheng"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-text">
    <div class="form-item-flex">
        <label class="form-label-title"> 姓名</label>
        <div class="form-label-control">
            
                            <?php echo $mmm["xingming"]; ?><input type="hidden" id="xingming" name="xingming" value="<?php echo Info::html($mmm["xingming"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-text">
    <div class="form-item-flex">
        <label class="form-label-title"> 联系电话</label>
        <div class="form-label-control">
            
                            <?php echo $mmm["lianxidianhua"]; ?><input type="hidden" id="lianxidianhua" name="lianxidianhua" value="<?php echo Info::html($mmm["lianxidianhua"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-text">
    <div class="form-item-flex">
        <label class="form-label-title"> 身份证号</label>
        <div class="form-label-control">
            
                            <?php echo $mmm["shenfenzhenghao"]; ?><input type="hidden" id="shenfenzhenghao" name="shenfenzhenghao" value="<?php echo Info::html($mmm["shenfenzhenghao"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-text-user">
    <div class="form-item-flex">
        <label class="form-label-title"> 租赁用户</label>
        <div class="form-label-control">
            
                            <?php echo $mmm["zulinyonghu"]; ?><input type="hidden" id="zulinyonghu" name="zulinyonghu" value="<?php echo Info::html($mmm["zulinyonghu"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-select">
    <div class="form-item-flex">
        <label class="form-label-title"> 租赁类型</label>
        <div class="form-label-control">
            
                            <?php echo $mmm["zulinleixing"]; ?><input type="hidden" id="zulinleixing" name="zulinleixing" value="<?php echo Info::html($mmm["zulinleixing"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-select">
    <div class="form-item-flex">
        <label class="form-label-title"> 选择房间</label>
        <div class="form-label-control">
            
                            <?php  $mapfangjianxinxi10 = db()->find("SELECT fangjianmingcheng,id FROM fangjianxinxi where id='".$mmm["xuanzefangjian"]."'");  ?><?php echo $mapfangjianxinxi10["fangjianmingcheng"]; ?><input type="hidden" id="xuanzefangjian" name="xuanzefangjian" value="<?php echo Info::html($mmm["xuanzefangjian"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-select">
    <div class="form-item-flex">
        <label class="form-label-title"><span style="color: red;">*</span> 审核</label>
        <div class="form-label-control">
            
                            <select class="form-control class_shenhe8" data-value="<?php echo Info::html($mmm["shenhe"]); ?>" data-rule-required="true" data-msg-required="请填写审核" id="shenhe" name="shenhe" style="width:250px">
<option value="通过">通过</option>
<option value="未通过">未通过</option>

</select>
<script>
$(".class_shenhe8").val($(".class_shenhe8").attr("data-value"))</script>
                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-textarea">
    <div class="form-item-flex">
        <label class="form-label-title"> 审核备注</label>
        <div class="form-label-control">
            
                            <textarea style="width: 80%;height: 120px" class="form-control" placeholder="输入审核备注" id="shenhebeizhu" name="shenhebeizhu"><?php echo Info::html($mmm["shenhebeizhu"]); ?></textarea>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-text-user">
    <div class="form-item-flex">
        <label class="form-label-title"> 操作人</label>
        <div class="form-label-control">
            
                            <input type="text" class="form-control" placeholder="输入操作人" style="width:150px;" readonly="readonly" id="caozuoren" name="caozuoren" value="<?php echo $mmm["caozuoren"]; ?>"/>                    
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
        $('#shenheform1').validate();
    });
</script>




    </div>
</div>


</div>


<?php include "foot.php" ?>