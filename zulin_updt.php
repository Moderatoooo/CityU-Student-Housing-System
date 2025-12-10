<?php  require_once 'initialize.php';  ?>    <?php checkLogin();  // 检测是否登录 ?>

<?php             // 根据id 获取要修改得数据
        $mmm = M('zulin')->where('id' , $_GET['id'])->find();
    
            $readMap = M('fangwuxinxi')->find($mmm['fangwuxinxiid']);
    
 ?> 
<?php include "head.php" ?>

<script src="js/jquery.validate.js"></script>




<div>



<div class="panel panel-default">
    <div class="panel-heading">
        <span class="titles">
            添加租赁
        </span>
    </div>
    <div class="panel-body">
        
    

<form action="zulin.php?a=update" method="post" name="form1" id="zulinform1"><!-- form 标签开始 -->
    
            <input type="hidden" name="fangwuxinxiid" value="<?php echo $mmm["fangwuxinxiid"]; ?>"/>                <div class="form-group form-type-text">
    <div class="form-item-flex">
        <label class="form-label-title"> 租赁单号</label>
        <div class="form-label-control">
            
                            <input type="text" class="form-control" placeholder="输入租赁单号" style="width:150px;" readonly="readonly" id="zulindanhao" name="zulindanhao" value="<?php echo Info::html($mmm["zulindanhao"]); ?>"/>                    
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
                    <div class="form-group form-type-money">
    <div class="form-item-flex">
        <label class="form-label-title"> 房屋租金</label>
        <div class="form-label-control">
            
                            <?php echo $mmm["fangwuzujin"]; ?><input type="hidden" id="fangwuzujin" name="fangwuzujin" value="<?php echo Info::html($mmm["fangwuzujin"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-select">
    <div class="form-item-flex">
        <label class="form-label-title"> 押金方式</label>
        <div class="form-label-control">
            
                            <?php echo $mmm["yajinfangshi"]; ?><input type="hidden" id="yajinfangshi" name="yajinfangshi" value="<?php echo Info::html($mmm["yajinfangshi"]); ?>"/>                    
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
            
                            <?php  $mapfangwuleixing17 = db()->find("SELECT leixing,id FROM fangwuleixing where id='".$mmm["leixing"]."'");  ?><?php echo $mapfangwuleixing17["leixing"]; ?><input type="hidden" id="leixing" name="leixing" value="<?php echo Info::html($mmm["leixing"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-select">
    <div class="form-item-flex">
        <label class="form-label-title"> 价格区间</label>
        <div class="form-label-control">
            
                            <?php echo $mmm["jiagequjian"]; ?><input type="hidden" id="jiagequjian" name="jiagequjian" value="<?php echo Info::html($mmm["jiagequjian"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-select">
    <div class="form-item-flex">
        <label class="form-label-title"> 距离学校</label>
        <div class="form-label-control">
            
                            <?php echo $mmm["julixuexiao"]; ?><input type="hidden" id="julixuexiao" name="julixuexiao" value="<?php echo Info::html($mmm["julixuexiao"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-number">
    <div class="form-item-flex">
        <label class="form-label-title"> 最短租期(月)</label>
        <div class="form-label-control">
            
                            <?php echo $mmm["zuiduanzuqi"]; ?><input type="hidden" id="zuiduanzuqi" name="zuiduanzuqi" value="<?php echo Info::html($mmm["zuiduanzuqi"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-checkbox">
    <div class="form-item-flex">
        <label class="form-label-title"> 设施</label>
        <div class="form-label-control">
            
                            <?php echo $mmm["sheshi"]; ?><input type="hidden" id="sheshi" name="sheshi" value="<?php echo Info::html($mmm["sheshi"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-text">
    <div class="form-item-flex">
        <label class="form-label-title"> 房间数</label>
        <div class="form-label-control">
            
                            <?php echo $mmm["fangjianshu"]; ?><input type="hidden" id="fangjianshu" name="fangjianshu" value="<?php echo Info::html($mmm["fangjianshu"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-select">
    <div class="form-item-flex">
        <label class="form-label-title"> 是否有电梯</label>
        <div class="form-label-control">
            
                            <?php echo $mmm["shifouyoudianti"]; ?><input type="hidden" id="shifouyoudianti" name="shifouyoudianti" value="<?php echo Info::html($mmm["shifouyoudianti"]); ?>"/>                    
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
                    <div class="form-group form-type-long-text">
    <div class="form-item-flex">
        <label class="form-label-title"> 房屋地址</label>
        <div class="form-label-control">
            
                            <?php echo $mmm["fangwudizhi"]; ?><input type="hidden" id="fangwudizhi" name="fangwudizhi" value="<?php echo Info::html($mmm["fangwudizhi"]); ?>"/>                    
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
                    <div class="form-group form-type-text">
    <div class="form-item-flex">
        <label class="form-label-title"><span style="color: red;">*</span> 联系电话</label>
        <div class="form-label-control">
            
                            <input type="text" class="form-control" placeholder="输入联系电话" style="width:150px;" data-rule-required="true" data-msg-required="请填写联系电话" phone="true" data-msg-phone="请输入正确手机号码" id="lianxidianhua" name="lianxidianhua" value="<?php echo Info::html($mmm["lianxidianhua"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-text">
    <div class="form-item-flex">
        <label class="form-label-title"><span style="color: red;">*</span> 身份证号</label>
        <div class="form-label-control">
            
                            <input type="text" class="form-control" placeholder="输入身份证号" style="width:150px;" data-rule-required="true" data-msg-required="请填写身份证号" idcard="true" data-msg-email="请输入有效身份证号码" id="shenfenzhenghao" name="shenfenzhenghao" value="<?php echo Info::html($mmm["shenfenzhenghao"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-select">
    <div class="form-item-flex">
        <label class="form-label-title"><span style="color: red;">*</span> 选择房间</label>
        <div class="form-label-control">
            
                            <select class="form-control class_xuanzefangjian19" data-value="<?php echo Info::html($mmm["xuanzefangjian"]); ?>" data-rule-required="true" data-msg-required="请填写选择房间" id="xuanzefangjian" name="xuanzefangjian" style="width:250px">
<?php  $select = db()->select("SELECT * FROM fangjianxinxi ORDER BY id desc");  ?>
<?php  foreach($select as $m){  ?>
<option value="<?php echo $m["id"]; ?>"><?php echo $m["fangjianmingcheng"]; ?></option>
<?php } ?>

</select>
<script>
$(".class_xuanzefangjian19").val($(".class_xuanzefangjian19").attr("data-value"))</script>
                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-number">
    <div class="form-item-flex">
        <label class="form-label-title"><span style="color: red;">*</span> 租赁时长(月)</label>
        <div class="form-label-control">
            
                            <input type="number" class="form-control" placeholder="输入租赁时长" style="width:150px;" data-rule-required="true" data-msg-required="请填写租赁时长" number="true" data-msg-number="输入一个有效数字" id="zulinshichang" name="zulinshichang" value="<?php echo Info::html($mmm["zulinshichang"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-textarea">
    <div class="form-item-flex">
        <label class="form-label-title"> 备注</label>
        <div class="form-label-control">
            
                            <textarea style="width: 80%;height: 120px" class="form-control" placeholder="输入备注" id="beizhu" name="beizhu"><?php echo Info::html($mmm["beizhu"]); ?></textarea>                    
        </div>
        
    </div>
</div>
                            <div class="form-group form-type-text-user">
    <div class="form-item-flex">
        <label class="form-label-title"> 租赁用户</label>
        <div class="form-label-control">
            
                            <input type="text" class="form-control" placeholder="输入租赁用户" style="width:150px;" readonly="readonly" id="zulinyonghu" name="zulinyonghu" value="<?php echo $mmm["zulinyonghu"]; ?>"/>                    
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
        $('#zulinform1').validate();
    });
</script>




    </div>
</div>


</div>


<?php include "foot.php" ?>