<?php  require_once 'initialize.php';  ?>    <?php checkLogin();  // 检测是否登录 ?>

<?php             // 根据id 获取要修改得数据
        $mmm = M('fangwuxinxi')->where('id' , $_GET['id'])->find();
    
    
 ?> 
<?php include "head.php" ?>

<script src="js/jquery.validate.js"></script>
<link rel="stylesheet" href="js/layer/theme/default/layer.css"/>
<script src="js/layer/layer.js"></script>
<link href="js/h5upload/h5upload.css" rel="stylesheet">
<script src="js/h5upload/h5upload.js"></script>
<link rel="stylesheet" href="js/umeditor/themes/default/css/umeditor.css"/>
<script src="js/umeditor/umeditor.config.js"></script>
<script src="js/umeditor/umeditor.min.js"></script>




<div>



<div class="panel panel-default">
    <div class="panel-heading">
        <span class="titles">
            添加房屋信息
        </span>
    </div>
    <div class="panel-body">
        
    

<form action="fangwuxinxi.php?a=update" method="post" name="form1" id="fangwuxinxiform1"><!-- form 标签开始 -->
    
                    <div class="form-group form-type-text">
    <div class="form-item-flex">
        <label class="form-label-title"> 房屋编号</label>
        <div class="form-label-control">
            
                            <input type="text" class="form-control" placeholder="输入房屋编号" style="width:150px;" readonly="readonly" id="fangwubianhao" name="fangwubianhao" value="<?php echo Info::html($mmm["fangwubianhao"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-long-text">
    <div class="form-item-flex">
        <label class="form-label-title"><span style="color: red;">*</span> 房屋标题</label>
        <div class="form-label-control">
            
                            <input type="text" class="form-control" placeholder="输入房屋标题" style="width:250px;" data-rule-required="true" data-msg-required="请填写房屋标题" id="fangwubiaoti" name="fangwubiaoti" value="<?php echo Info::html($mmm["fangwubiaoti"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-select">
    <div class="form-item-flex">
        <label class="form-label-title"> 类型</label>
        <div class="form-label-control">
            
                            <select class="form-control class_leixing24" data-value="<?php echo Info::html($mmm["leixing"]); ?>" id="leixing" name="leixing" style="width:250px">
<?php  $select = db()->select("SELECT * FROM fangwuleixing ORDER BY id desc");  ?>
<?php  foreach($select as $m){  ?>
<option value="<?php echo $m["id"]; ?>"><?php echo $m["leixing"]; ?></option>
<?php } ?>

</select>
<script>
$(".class_leixing24").val($(".class_leixing24").attr("data-value"))</script>
                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-text">
    <div class="form-item-flex">
        <label class="form-label-title"><span style="color: red;">*</span> 小区名称</label>
        <div class="form-label-control">
            
                            <input type="text" class="form-control" placeholder="输入小区名称" style="width:150px;" data-rule-required="true" data-msg-required="请填写小区名称" id="xiaoqumingcheng" name="xiaoqumingcheng" value="<?php echo Info::html($mmm["xiaoqumingcheng"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-text">
    <div class="form-item-flex">
        <label class="form-label-title"><span style="color: red;">*</span> 房屋户型</label>
        <div class="form-label-control">
            
                            <input type="text" class="form-control" placeholder="输入房屋户型" style="width:150px;" data-rule-required="true" data-msg-required="请填写房屋户型" id="fangwuhuxing" name="fangwuhuxing" value="<?php echo Info::html($mmm["fangwuhuxing"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-images">
    <div class="form-item-flex">
        <label class="form-label-title"><span style="color: red;">*</span> 房屋图片</label>
        <div class="form-label-control">
            
                            <input type="hidden" data-rule-required="true" data-msg-required="请填写房屋图片" id="fangwutupian" name="fangwutupian" value="<?php echo Info::html($mmm["fangwutupian"]); ?>"/>
        <script>showUploadImages("#fangwutupian","upload.html")</script>
                            
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-number">
    <div class="form-item-flex">
        <label class="form-label-title"> 楼层</label>
        <div class="form-label-control">
            
                            <input type="number" class="form-control" placeholder="输入楼层" style="width:150px;" number="true" data-msg-number="输入一个有效数字" id="louceng" name="louceng" value="<?php echo Info::html($mmm["louceng"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-select">
    <div class="form-item-flex">
        <label class="form-label-title"><span style="color: red;">*</span> 是否有电梯</label>
        <div class="form-label-control">
            
                            <select class="form-control class_shifouyoudianti25" data-value="<?php echo Info::html($mmm["shifouyoudianti"]); ?>" data-rule-required="true" data-msg-required="请填写是否有电梯" id="shifouyoudianti" name="shifouyoudianti" style="width:250px">
<option value="是">是</option>
<option value="否">否</option>

</select>
<script>
$(".class_shifouyoudianti25").val($(".class_shifouyoudianti25").attr("data-value"))</script>
                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-text">
    <div class="form-item-flex">
        <label class="form-label-title"> 面积</label>
        <div class="form-label-control">
            
                            <input type="text" class="form-control" placeholder="输入面积" style="width:150px;" id="mianji" name="mianji" value="<?php echo Info::html($mmm["mianji"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-select">
    <div class="form-item-flex">
        <label class="form-label-title"> 租赁类型</label>
        <div class="form-label-control">
            
                            <select class="form-control class_zulinleixing26" data-value="<?php echo Info::html($mmm["zulinleixing"]); ?>" id="zulinleixing" name="zulinleixing" style="width:250px">
<option value="整租">整租</option>
<option value="分租">分租</option>

</select>
<script>
$(".class_zulinleixing26").val($(".class_zulinleixing26").attr("data-value"))</script>
                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-money">
    <div class="form-item-flex">
        <label class="form-label-title"><span style="color: red;">*</span> 房屋租金</label>
        <div class="form-label-control">
            
                            <input type="number" class="form-control" placeholder="输入房屋租金" style="width:150px;" step="0.01" data-rule-required="true" data-msg-required="请填写房屋租金" number="true" data-msg-number="输入一个有效数字" id="fangwuzujin" name="fangwuzujin" value="<?php echo Info::html($mmm["fangwuzujin"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-select">
    <div class="form-item-flex">
        <label class="form-label-title"><span style="color: red;">*</span> 价格区间</label>
        <div class="form-label-control">
            
                            <select class="form-control class_jiagequjian27" data-value="<?php echo Info::html($mmm["jiagequjian"]); ?>" data-rule-required="true" data-msg-required="请填写价格区间" id="jiagequjian" name="jiagequjian" style="width:250px">
<option value="100以下">100以下</option>
<option value="100-500">100-500</option>
<option value="500-1000">500-1000</option>
<option value="1000-2000">1000-2000</option>
<option value="2000-3000">2000-3000</option>
<option value="3000以上">3000以上</option>

</select>
<script>
$(".class_jiagequjian27").val($(".class_jiagequjian27").attr("data-value"))</script>
                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-select">
    <div class="form-item-flex">
        <label class="form-label-title"><span style="color: red;">*</span> 押金方式</label>
        <div class="form-label-control">
            
                            <select class="form-control class_yajinfangshi28" data-value="<?php echo Info::html($mmm["yajinfangshi"]); ?>" data-rule-required="true" data-msg-required="请填写押金方式" id="yajinfangshi" name="yajinfangshi" style="width:250px">
<option value="免押金">免押金</option>
<option value="押一付一">押一付一</option>
<option value="押二付一">押二付一</option>
<option value="其他">其他</option>

</select>
<script>
$(".class_yajinfangshi28").val($(".class_yajinfangshi28").attr("data-value"))</script>
                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-select">
    <div class="form-item-flex">
        <label class="form-label-title"> 距离学校</label>
        <div class="form-label-control">
            
                            <select class="form-control class_julixuexiao29" data-value="<?php echo Info::html($mmm["julixuexiao"]); ?>" id="julixuexiao" name="julixuexiao" style="width:250px">
<option value="100米">100米</option>
<option value="500米">500米</option>
<option value="1000米">1000米</option>
<option value="1000米以上">1000米以上</option>

</select>
<script>
$(".class_julixuexiao29").val($(".class_julixuexiao29").attr("data-value"))</script>
                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-number">
    <div class="form-item-flex">
        <label class="form-label-title"><span style="color: red;">*</span> 最短租期(月)</label>
        <div class="form-label-control">
            
                            <input type="number" class="form-control" placeholder="输入最短租期" style="width:150px;" data-rule-required="true" data-msg-required="请填写最短租期" number="true" data-msg-number="输入一个有效数字" min="1" id="zuiduanzuqi" name="zuiduanzuqi" value="<?php echo Info::html($mmm["zuiduanzuqi"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-long-text">
    <div class="form-item-flex">
        <label class="form-label-title"><span style="color: red;">*</span> 房屋地址</label>
        <div class="form-label-control">
            
                            <input type="text" class="form-control" placeholder="输入房屋地址" style="width:250px;" data-rule-required="true" data-msg-required="请填写房屋地址" id="fangwudizhi" name="fangwudizhi" value="<?php echo Info::html($mmm["fangwudizhi"]); ?>"/>                    
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
                    <div class="form-group form-type-select">
    <div class="form-item-flex">
        <label class="form-label-title"> 房屋状态</label>
        <div class="form-label-control">
            
                            <select class="form-control class_fangwuzhuangtai30" data-value="<?php echo Info::html($mmm["fangwuzhuangtai"]); ?>" id="fangwuzhuangtai" name="fangwuzhuangtai" style="width:250px">
<option value="待租">待租</option>
<option value="已租">已租</option>

</select>
<script>
$(".class_fangwuzhuangtai30").val($(".class_fangwuzhuangtai30").attr("data-value"))</script>
                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-text">
    <div class="form-item-flex">
        <label class="form-label-title"><span style="color: red;">*</span> 房间数</label>
        <div class="form-label-control">
            
                            <input type="text" class="form-control" placeholder="输入房间数" style="width:150px;" data-rule-required="true" data-msg-required="请填写房间数" id="fangjianshu" name="fangjianshu" value="<?php echo Info::html($mmm["fangjianshu"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-checkbox">
    <div class="form-item-flex">
        <label class="form-label-title"> 设施</label>
        <div class="form-label-control">
            
                            <div class="class_sheshi31" data-value="<?php echo Info::html($mmm["sheshi"]); ?>"> <label><input type="checkbox" id="sheshi" name="sheshi[]" value="床"/> 床</label> 
 <label><input type="checkbox" id="sheshi" name="sheshi[]" value="衣柜"/> 衣柜</label> 
 <label><input type="checkbox" id="sheshi" name="sheshi[]" value="沙发"/> 沙发</label> 
 <label><input type="checkbox" id="sheshi" name="sheshi[]" value="电视"/> 电视</label> 
 <label><input type="checkbox" id="sheshi" name="sheshi[]" value="冰箱"/> 冰箱</label> 
 <label><input type="checkbox" id="sheshi" name="sheshi[]" value="洗衣机"/> 洗衣机</label> 
 <label><input type="checkbox" id="sheshi" name="sheshi[]" value="空调"/> 空调</label> 
 <label><input type="checkbox" id="sheshi" name="sheshi[]" value="热水器"/> 热水器</label> 
 <label><input type="checkbox" id="sheshi" name="sheshi[]" value="宽带"/> 宽带</label> 
 <label><input type="checkbox" id="sheshi" name="sheshi[]" value="暖气"/> 暖气</label> 
 <label><input type="checkbox" id="sheshi" name="sheshi[]" value="燃气罩"/> 燃气罩</label> 
 <label><input type="checkbox" id="sheshi" name="sheshi[]" value="阳台"/> 阳台</label> 
 <label><input type="checkbox" id="sheshi" name="sheshi[]" value="卫生巾"/> 卫生巾</label> 
 <label><input type="checkbox" id="sheshi" name="sheshi[]" value="只能门锁"/> 只能门锁</label> 
 <label><input type="checkbox" id="sheshi" name="sheshi[]" value="油烟机"/> 油烟机</label> 
 <label><input type="checkbox" id="sheshi" name="sheshi[]" value="可做饭"/> 可做饭</label> 
</div>
<script>
(function(){
                        var dataValue = "<?php echo Info::html($mmm["sheshi"]); ?>".split(",");
                        for(var i=0;i<dataValue.length;i++){
                            $(".class_sheshi31 :checkbox[value='"+dataValue[i]+"']").prop("checked" , true);
                        }
                    })()</script>
                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-editor">
    <div class="form-item-flex">
        <label class="form-label-title"> 房屋详情</label>
        <div class="form-label-control">
            
                            <textarea id="fangwuxiangqing" name="fangwuxiangqing" style="max-width: 750px;width:100%; height: 300px;"><?php echo Info::html($mmm["fangwuxiangqing"]); ?></textarea><script>
            (function(){
                var um = UM.getEditor('fangwuxiangqing');
            })();
            </script>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-images">
    <div class="form-item-flex">
        <label class="form-label-title"><span style="color: red;">*</span> 房产证明</label>
        <div class="form-label-control">
            
                            <input type="hidden" data-rule-required="true" data-msg-required="请填写房产证明" id="fangchanzhengming" name="fangchanzhengming" value="<?php echo Info::html($mmm["fangchanzhengming"]); ?>"/>
        <script>showUploadImages("#fangchanzhengming","upload.html")</script>
                            
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-text-user">
    <div class="form-item-flex">
        <label class="form-label-title"> 发布人</label>
        <div class="form-label-control">
            
                            <input type="text" class="form-control" placeholder="输入发布人" style="width:150px;" readonly="readonly" id="faburen" name="faburen" value="<?php echo $mmm["faburen"]; ?>"/>                    
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
        $('#fangwuxinxiform1').validate();
    });
</script>




    </div>
</div>


</div>


<?php include "foot.php" ?>