<?php  require_once 'initialize.php';  ?>    <?php checkLogin();  // 检测是否登录 ?>

<?php  ?> 
<?php  if(null == $_GET["id"] || "" ==  $_GET["id"] ){  ?>    <script>
        alert('非法操作');
        history.go(-1);
    </script>
<?php exit; ?><?php } ?>    <?php $readMap = M("fangwuxinxi")->where("id", $_GET["id"])->find(); ?>
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
            添加房间信息
        </span>
    </div>
    <div class="panel-body">
        
    

<form action="fangjianxinxi.php?a=insert" method="post" name="form1" id="fangjianxinxiform1"><!-- form 标签开始 -->
    
            <input type="hidden" name="fangwuxinxiid" value="<?php echo $_GET["id"]; ?>"/>                <div class="form-group form-type-text">
    <div class="form-item-flex">
        <label class="form-label-title"> 房屋编号</label>
        <div class="form-label-control">
            
                            <?php echo $readMap["fangwubianhao"]; ?><input type="hidden" id="fangwubianhao" name="fangwubianhao" value="<?php echo Info::html($readMap["fangwubianhao"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-long-text">
    <div class="form-item-flex">
        <label class="form-label-title"> 房屋标题</label>
        <div class="form-label-control">
            
                            <?php echo $readMap["fangwubiaoti"]; ?><input type="hidden" id="fangwubiaoti" name="fangwubiaoti" value="<?php echo Info::html($readMap["fangwubiaoti"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-select">
    <div class="form-item-flex">
        <label class="form-label-title"> 类型</label>
        <div class="form-label-control">
            
                            <?php  $mapfangwuleixing8 = db()->find("SELECT leixing,id FROM fangwuleixing where id='".$readMap["leixing"]."'");  ?><?php echo $mapfangwuleixing8["leixing"]; ?><input type="hidden" id="leixing" name="leixing" value="<?php echo Info::html($readMap["leixing"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-text">
    <div class="form-item-flex">
        <label class="form-label-title"> 小区名称</label>
        <div class="form-label-control">
            
                            <?php echo $readMap["xiaoqumingcheng"]; ?><input type="hidden" id="xiaoqumingcheng" name="xiaoqumingcheng" value="<?php echo Info::html($readMap["xiaoqumingcheng"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-text">
    <div class="form-item-flex">
        <label class="form-label-title"> 房屋户型</label>
        <div class="form-label-control">
            
                            <?php echo $readMap["fangwuhuxing"]; ?><input type="hidden" id="fangwuhuxing" name="fangwuhuxing" value="<?php echo Info::html($readMap["fangwuhuxing"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-text">
    <div class="form-item-flex">
        <label class="form-label-title"> 楼层</label>
        <div class="form-label-control">
            
                            <?php echo $readMap["louceng"]; ?><input type="hidden" id="louceng" name="louceng" value="<?php echo Info::html($readMap["louceng"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-select">
    <div class="form-item-flex">
        <label class="form-label-title"> 租赁类型</label>
        <div class="form-label-control">
            
                            <?php echo $readMap["zulinleixing"]; ?><input type="hidden" id="zulinleixing" name="zulinleixing" value="<?php echo Info::html($readMap["zulinleixing"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-text-user">
    <div class="form-item-flex">
        <label class="form-label-title"> 发布人</label>
        <div class="form-label-control">
            
                            <?php echo $readMap["faburen"]; ?><input type="hidden" id="faburen" name="faburen" value="<?php echo Info::html($readMap["faburen"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-long-text">
    <div class="form-item-flex">
        <label class="form-label-title"><span style="color: red;">*</span> 房间名称</label>
        <div class="form-label-control">
            
                            <input type="text" class="form-control" placeholder="输入房间名称" style="width:250px;" data-rule-required="true" data-msg-required="请填写房间名称" id="fangjianmingcheng" name="fangjianmingcheng" value=""/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-images">
    <div class="form-item-flex">
        <label class="form-label-title"> 房间图片</label>
        <div class="form-label-control">
            
                            <input type="hidden" id="fangjiantupian" name="fangjiantupian" value=""/>
        <script>showUploadImages("#fangjiantupian","upload.html")</script>
                            
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-text">
    <div class="form-item-flex">
        <label class="form-label-title"><span style="color: red;">*</span> 面积</label>
        <div class="form-label-control">
            
                            <input type="text" class="form-control" placeholder="输入面积" style="width:150px;" data-rule-required="true" data-msg-required="请填写面积" id="mianji" name="mianji" value=""/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-money">
    <div class="form-item-flex">
        <label class="form-label-title"><span style="color: red;">*</span> 单间价格</label>
        <div class="form-label-control">
            
                            <input type="number" class="form-control" placeholder="输入单间价格" style="width:150px;" step="0.01" data-rule-required="true" data-msg-required="请填写单间价格" number="true" data-msg-number="输入一个有效数字" id="danjianjiage" name="danjianjiage" value=""/>                    
        </div>
        
    </div>
</div>
                            <div class="form-group form-type-editor">
    <div class="form-item-flex">
        <label class="form-label-title"> 房间详情</label>
        <div class="form-label-control">
            
                            <textarea id="fangjianxiangqing" name="fangjianxiangqing" style="max-width: 750px;width:100%; height: 300px;"></textarea><script>
            (function(){
                var um = UM.getEditor('fangjianxiangqing');
            })();
            </script>                    
        </div>
        
    </div>
</div>
    
    <div class="form-group" id="form-item-btn">
    <div class="form-item-flex">
        <label class="form-label-title">  </label>
        <div class="form-label-control">
            
                            <input name="referer" id="referers" class="referers" value="<?php echo $_SERVER["HTTP_REFERER"] ?>" type="hidden"/>
            <script>
                $(function (){
                    $('input.referers').val(document.referrer);
                });
            </script>
        
                     <input type="hidden" name="zhuangtai" id="zhuangtai" value="待租"/>  
                                
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
        $('#fangjianxinxiform1').validate();
    });
</script>




    </div>
</div>


</div>


<?php include "foot.php" ?>