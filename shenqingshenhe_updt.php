<?php  require_once 'initialize.php';  ?>    <?php checkLogin();  // 检测是否登录 ?>

<?php             // 根据id 获取要修改得数据
        $mmm = M('shenqingshenhe')->where('id' , $_GET['id'])->find();
    
            $readMap = M('hezushenqing')->find($mmm['hezushenqingid']);
    
 ?> 
<?php include "head.php" ?>

<script src="js/jquery.validate.js"></script>




<div>



<div class="panel panel-default">
    <div class="panel-heading">
        <span class="titles">
            添加申请审核
        </span>
    </div>
    <div class="panel-body">
        
    

<form action="shenqingshenhe.php?a=update" method="post" name="form1" id="shenqingshenheform1"><!-- form 标签开始 -->
    
            <input type="hidden" name="hezushenqingid" value="<?php echo $mmm["hezushenqingid"]; ?>"/>        <input type="hidden" name="fenzuxinxiid" value="<?php echo $mmm["fenzuxinxiid"]; ?>"/>        <input type="hidden" name="zulinid" value="<?php echo $mmm["zulinid"]; ?>"/>        <input type="hidden" name="fangwuxinxiid" value="<?php echo $mmm["fangwuxinxiid"]; ?>"/>                <div class="form-group form-type-text">
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
                    <div class="form-group form-type-money">
    <div class="form-item-flex">
        <label class="form-label-title"> 分摊租金</label>
        <div class="form-label-control">
            
                            <?php echo $mmm["fentanzujin"]; ?><input type="hidden" id="fentanzujin" name="fentanzujin" value="<?php echo Info::html($mmm["fentanzujin"]); ?>"/>                    
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
                    <div class="form-group form-type-images">
    <div class="form-item-flex">
        <label class="form-label-title"> 房屋图片</label>
        <div class="form-label-control">
            
                            <?php  if("" ==  $mmm["fangwutupian"] ){  ?>-<?php  } else {   ?><img width="100" src="<?php echo Info::images($mmm["fangwutupian"]); ?>"/><?php } ?><input type="hidden" id="fangwutupian" name="fangwutupian" value="<?php echo Info::html($mmm["fangwutupian"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-text">
    <div class="form-item-flex">
        <label class="form-label-title"> 楼层</label>
        <div class="form-label-control">
            
                            <?php echo $mmm["louceng"]; ?><input type="hidden" id="louceng" name="louceng" value="<?php echo Info::html($mmm["louceng"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-text">
    <div class="form-item-flex">
        <label class="form-label-title"> 面积</label>
        <div class="form-label-control">
            
                            <?php echo $mmm["mianji"]; ?><input type="hidden" id="mianji" name="mianji" value="<?php echo Info::html($mmm["mianji"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-text-user">
    <div class="form-item-flex">
        <label class="form-label-title"> 发布人</label>
        <div class="form-label-control">
            
                            <?php echo $mmm["faburen"]; ?><input type="hidden" id="faburen" name="faburen" value="<?php echo Info::html($mmm["faburen"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-select">
    <div class="form-item-flex">
        <label class="form-label-title"> 类型</label>
        <div class="form-label-control">
            
                            <?php  $mapfangwuleixing38 = db()->find("SELECT leixing,id FROM fangwuleixing where id='".$mmm["leixing"]."'");  ?><?php echo $mapfangwuleixing38["leixing"]; ?><input type="hidden" id="leixing" name="leixing" value="<?php echo Info::html($mmm["leixing"]); ?>"/>                    
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
                    <div class="form-group form-type-text-user">
    <div class="form-item-flex">
        <label class="form-label-title"> 申请人</label>
        <div class="form-label-control">
            
                            <?php echo $mmm["shenqingren"]; ?><input type="hidden" id="shenqingren" name="shenqingren" value="<?php echo Info::html($mmm["shenqingren"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-select">
    <div class="form-item-flex">
        <label class="form-label-title"><span style="color: red;">*</span> 审核结果</label>
        <div class="form-label-control">
            
                            <select class="form-control class_shenhejieguo51" data-value="<?php echo Info::html($mmm["shenhejieguo"]); ?>" data-rule-required="true" data-msg-required="请填写审核结果" id="shenhejieguo" name="shenhejieguo" style="width:250px">
<option value="已通过">已通过</option>
<option value="未通过">未通过</option>

</select>
<script>
$(".class_shenhejieguo51").val($(".class_shenhejieguo51").attr("data-value"))</script>
                    
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
        $('#shenqingshenheform1').validate();
    });
</script>




    </div>
</div>


</div>


<?php include "foot.php" ?>