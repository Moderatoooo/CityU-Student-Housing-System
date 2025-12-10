<?php  require_once 'initialize.php';  ?>    <?php checkLogin();  // 检测是否登录 ?>

<?php  ?>
<?php  if(null == $_GET["id"] || "" ==  $_GET["id"] ){  ?>    <script>
        alert('非法操作');
        history.go(-1);
    </script>
<?php exit; ?><?php } ?>    <?php $readMap = M("fenzuxinxi")->where("id", $_GET["id"])->find(); ?>
<?php include "head.php" ?>
<?php include "header.php" ?>

<script src="js/jquery.validate.js"></script>

<script>
    // 页面加载完成后显示提示弹窗
    window.onload = function() {
        setTimeout(function() {
            alert('请在个人中心里完善个人资料更容易得到通过');
        }, 500); // 延迟500毫秒显示，确保页面完全加载
    };
</script>

<div>
<div class="container"><!-- 使用bootstrap css框架，container定宽，并剧中 https://v3.bootcss.com/css/#overview-container -->

<div class="panel panel-default">
    <div class="panel-heading">
        <span class="titles">
            添加合租申请
        </span>
    </div>
    <div class="panel-body">

<form action="hezushenqing.php?a=insert" method="post" name="form1" id="hezushenqingform1"><!-- form 标签开始 -->

            <input type="hidden" name="fenzuxinxiid" value="<?php echo $_GET["id"]; ?>"/>        <input type="hidden" name="zulinid" value="<?php echo $readMap["zulinid"]; ?>"/>        <input type="hidden" name="fangwuxinxiid" value="<?php echo $readMap["fangwuxinxiid"]; ?>"/>                <div class="form-group form-type-text">
    <div class="form-item-flex">
        <label class="form-label-title"> 租赁单号</label>
        <div class="form-label-control">

                            <?php echo $readMap["zulindanhao"]; ?><input type="hidden" id="zulindanhao" name="zulindanhao" value="<?php echo Info::html($readMap["zulindanhao"]); ?>"/>
        </div>

    </div>
</div>
                    <div class="form-group form-type-text">
    <div class="form-item-flex">
        <label class="form-label-title"> 房屋编号</label>
        <div class="form-label-control">

                            <?php echo $readMap["fangwubianhao"]; ?><input type="hidden" id="fangwubianhao" name="fangwubianhao" value="<?php echo Info::html($readMap["fangwubianhao"]); ?>"/>
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
        <label class="form-label-title"> 小区名称</label>
        <div class="form-label-control">

                            <?php echo $readMap["xiaoqumingcheng"]; ?><input type="hidden" id="xiaoqumingcheng" name="xiaoqumingcheng" value="<?php echo Info::html($readMap["xiaoqumingcheng"]); ?>"/>
        </div>

    </div>
</div>
                    <div class="form-group form-type-images">
    <div class="form-item-flex">
        <label class="form-label-title"> 房屋图片</label>
        <div class="form-label-control">

                            <?php  if("" ==  $readMap["fangwutupian"] ){  ?>-<?php  } else {   ?><img width="100" src="<?php echo Info::images($readMap["fangwutupian"]); ?>"/><?php } ?><input type="hidden" id="fangwutupian" name="fangwutupian" value="<?php echo Info::html($readMap["fangwutupian"]); ?>"/>
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
                    <div class="form-group form-type-text">
    <div class="form-item-flex">
        <label class="form-label-title"> 面积</label>
        <div class="form-label-control">

                            <?php echo $readMap["mianji"]; ?><input type="hidden" id="mianji" name="mianji" value="<?php echo Info::html($readMap["mianji"]); ?>"/>
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
                    <div class="form-group form-type-select">
    <div class="form-item-flex">
        <label class="form-label-title"> 类型</label>
        <div class="form-label-control">

                            <?php  $mapfangwuleixing13 = db()->find("SELECT leixing,id FROM fangwuleixing where id='".$readMap["leixing"]."'");  ?><?php echo $mapfangwuleixing13["leixing"]; ?><input type="hidden" id="leixing" name="leixing" value="<?php echo Info::html($readMap["leixing"]); ?>"/>
        </div>

    </div>
</div>
                    <div class="form-group form-type-checkbox">
    <div class="form-item-flex">
        <label class="form-label-title"> 设施</label>
        <div class="form-label-control">

                            <?php echo $readMap["sheshi"]; ?><input type="hidden" id="sheshi" name="sheshi" value="<?php echo Info::html($readMap["sheshi"]); ?>"/>
        </div>

    </div>
</div>
                    <div class="form-group form-type-select">
    <div class="form-item-flex">
        <label class="form-label-title"> 是否有电梯</label>
        <div class="form-label-control">

                            <?php echo $readMap["shifouyoudianti"]; ?><input type="hidden" id="shifouyoudianti" name="shifouyoudianti" value="<?php echo Info::html($readMap["shifouyoudianti"]); ?>"/>
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
                    <div class="form-group form-type-long-text">
    <div class="form-item-flex">
        <label class="form-label-title"> 房屋地址</label>
        <div class="form-label-control">

                            <?php echo $readMap["fangwudizhi"]; ?><input type="hidden" id="fangwudizhi" name="fangwudizhi" value="<?php echo Info::html($readMap["fangwudizhi"]); ?>"/>
        </div>

    </div>
</div>
                    <div class="form-group form-type-money">
    <div class="form-item-flex">
        <label class="form-label-title"> 分摊租金</label>
        <div class="form-label-control">

                            <?php echo $readMap["fentanzujin"]; ?><input type="hidden" id="fentanzujin" name="fentanzujin" value="<?php echo Info::html($readMap["fentanzujin"]); ?>"/>
        </div>

    </div>
</div>
                    <div class="form-group form-type-text-user">
    <div class="form-item-flex">
        <label class="form-label-title"> 租赁用户</label>
        <div class="form-label-control">

                            <?php echo $readMap["zulinyonghu"]; ?><input type="hidden" id="zulinyonghu" name="zulinyonghu" value="<?php echo Info::html($readMap["zulinyonghu"]); ?>"/>
        </div>

    </div>
</div>
                    <div class="form-group form-type-text">
    <div class="form-item-flex">
        <label class="form-label-title"><span style="color: red;">*</span> 姓名</label>
        <div class="form-label-control">

                            <input type="text" class="form-control" placeholder="输入姓名" style="width:150px;" data-rule-required="true" data-msg-required="请填写姓名" id="xingming" name="xingming" value="<?php echo $_SESSION["xingming"]; ?>"/>
        </div>

    </div>
</div>
                    <div class="form-group form-type-text">
    <div class="form-item-flex">
        <label class="form-label-title"><span style="color: red;">*</span> 手机</label>
        <div class="form-label-control">

                            <input type="text" class="form-control" placeholder="输入手机" style="width:150px;" data-rule-required="true" data-msg-required="请填写手机" id="shouji" name="shouji" value="<?php echo $_SESSION["shouji"]; ?>"/>
        </div>

    </div>
</div>
                    <div class="form-group form-type-text">
    <div class="form-item-flex">
        <label class="form-label-title"> 身份证</label>
        <div class="form-label-control">

                            <input type="text" class="form-control" placeholder="输入身份证" style="width:150px;" id="shenfenzheng" name="shenfenzheng" value="<?php echo $_SESSION["shenfenzheng"]; ?>"/>
        </div>

    </div>
</div>
                            <div class="form-group form-type-textarea">
    <div class="form-item-flex">
        <label class="form-label-title"> 合租描述</label>
        <div class="form-label-control">

                            <textarea style="width: 80%;height: 120px" class="form-control" placeholder="输入合租描述" id="hezumiaoshu" name="hezumiaoshu"></textarea>
        </div>

    </div>
</div>
                    <div class="form-group form-type-text-user">
    <div class="form-item-flex">
        <label class="form-label-title"> 申请人</label>
        <div class="form-label-control">

                            <input type="text" class="form-control" placeholder="输入申请人" style="width:150px;" readonly="readonly" id="shenqingren" name="shenqingren" value="<?php echo $_SESSION["username"]; ?>"/>
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

                     <input type="hidden" name="hezuzhuangtai" id="hezuzhuangtai" value="待审核"/>

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
        $('#hezushenqingform1').validate();
    });
</script>




    </div>
</div>




<!-- container定宽，并剧中结束 --></div>


</div>


<?php include "footer.php" ?>
<?php include "foot.php" ?>