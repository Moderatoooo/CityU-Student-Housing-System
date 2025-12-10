<?php  require_once 'initialize.php';  ?>

<?php  ?> 
<?php include "head.php" ?>
<?php include "header.php" ?>

<script src="js/jquery.validate.js"></script>




<div>

    
<div class="container"><!-- 使用bootstrap css框架，container定宽，并剧中 https://v3.bootcss.com/css/#overview-container -->

                    



<div class="panel panel-default">
    <div class="panel-heading">
        <span class="titles">
            添加评论
        </span>
    </div>
    <div class="panel-body">
        
    

<form action="pinglun.php?a=insert" method="post" name="form1" id="pinglunform1"><!-- form 标签开始 -->
    
                                    <div class="form-group form-type-text-user">
    <div class="form-item-flex">
        <label class="form-label-title"> 发布人</label>
        <div class="form-label-control">
            
                            <input type="text" class="form-control" placeholder="输入发布人" style="width:150px;" readonly="readonly" id="faburen" name="faburen" value="<?php echo $_SESSION["username"]; ?>"/>                    
        </div>
        
    </div>
</div>
                            <div class="form-group form-type-long-text">
    <div class="form-item-flex">
        <label class="form-label-title"><span style="color: red;">*</span> 评分</label>
        <div class="form-label-control">
            
                            <input type="text" class="form-control" placeholder="输入评分" style="width:250px;" data-rule-required="true" data-msg-required="请填写评分" id="pingfen" name="pingfen" value=""/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-textarea">
    <div class="form-item-flex">
        <label class="form-label-title"> 评论内容</label>
        <div class="form-label-control">
            
                            <textarea style="width: 80%;height: 120px" class="form-control" placeholder="输入评论内容" id="pinglunneirong" name="pinglunneirong"></textarea>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-text-user">
    <div class="form-item-flex">
        <label class="form-label-title"> 评论人</label>
        <div class="form-label-control">
            
                            <input type="text" class="form-control" placeholder="输入评论人" style="width:150px;" readonly="readonly" id="pinglunren" name="pinglunren" value="<?php echo $_SESSION["username"]; ?>"/>                    
        </div>
        
    </div>
</div>
    
    <div class="form-group" id="form-item-btn">
    <div class="form-item-flex">
        <label class="form-label-title">  </label>
        <div class="form-label-control">
            
                
                                                    
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
        $('#pinglunform1').validate();
    });
</script>




    </div>
</div>


        
    
<!-- container定宽，并剧中结束 --></div>


</div>


<?php include "footer.php" ?>
<?php include "foot.php" ?>