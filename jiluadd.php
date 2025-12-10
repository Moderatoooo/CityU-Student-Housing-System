<?php  require_once 'initialize.php';  ?>

<?php  ?> 
<?php  if(null == $_GET["id"] || "" ==  $_GET["id"] ){  ?>    <script>
        alert('非法操作');
        history.go(-1);
    </script>
<?php exit; ?><?php } ?>    <?php $readMap = M("siliao")->where("id", $_GET["id"])->find(); ?>
<?php include "head.php" ?>
<?php include "header.php" ?>

<script src="js/jquery.validate.js"></script>




<div>

    
<div class="container"><!-- 使用bootstrap css框架，container定宽，并剧中 https://v3.bootcss.com/css/#overview-container -->

                    



<div class="panel panel-default">
    <div class="panel-heading">
        <span class="titles">
            添加记录
        </span>
    </div>
    <div class="panel-body">
        
    

<form action="jilu.php?a=insert" method="post" name="form1" id="jiluform1"><!-- form 标签开始 -->
    
            <input type="hidden" name="siliaoid" value="<?php echo $_GET["id"]; ?>"/>                <div class="form-group form-type-text">
    <div class="form-item-flex">
        <label class="form-label-title"> 编号</label>
        <div class="form-label-control">
            
                            <?php echo $readMap["bianhao"]; ?><input type="hidden" id="bianhao" name="bianhao" value="<?php echo Info::html($readMap["bianhao"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-textarea">
    <div class="form-item-flex">
        <label class="form-label-title"> 内容</label>
        <div class="form-label-control">
            
                            <textarea style="width: 80%;height: 120px" class="form-control" placeholder="输入内容" id="neirong" name="neirong"></textarea>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-text-user">
    <div class="form-item-flex">
        <label class="form-label-title"> 发送人</label>
        <div class="form-label-control">
            
                            <input type="text" class="form-control" placeholder="输入发送人" style="width:150px;" readonly="readonly" id="fasongren" name="fasongren" value="<?php echo $_SESSION["username"]; ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-text">
    <div class="form-item-flex">
        <label class="form-label-title"> cx</label>
        <div class="form-label-control">
            
                            <input type="text" class="form-control" placeholder="输入cx" style="width:150px;" id="cx" name="cx" value="<?php echo $_SESSION["cx"]; ?>"/>                    
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


        
    
<!-- container定宽，并剧中结束 --></div>


</div>


<?php include "footer.php" ?>
<?php include "foot.php" ?>