<?php  require_once 'initialize.php';  ?><?php if(empty($_GET['id'])){
    showMessage('没找到相关详情页面');
}

$map = M("fenzuxinxi")->where("id" , $_GET['id'])->find();

if(empty($map)){
    showMessage('没找到相关详情页面');
}


?> 
<?php include "head.php" ?>

<link href="js/h5upload/h5upload.css" rel="stylesheet">
<script src="js/h5upload/h5upload.js"></script>




<div>



<div class="panel panel-default">
    <div class="panel-heading">
        <span class="titles">
            分租信息详情
        </span>
    </div>
    <div class="panel-body">
        
    

<div class="pa10">
    <div class="pa10 bg-white">
        <table class="new-detail">
            <tbody>
            <tr>
                                    <td class="detail-title">
                        租赁单号                    </td>
                    <td class="detail-value">
                        <?php echo $map["zulindanhao"]; ?>                    </td>
                                                        <td class="detail-title">
                        房屋编号                    </td>
                    <td class="detail-value">
                        <?php echo $map["fangwubianhao"]; ?>                    </td>
                                                        <td class="detail-title">
                        房屋标题                    </td>
                    <td class="detail-value">
                        <?php echo $map["fangwubiaoti"]; ?>                    </td>
                    </tr><tr>                                    <td class="detail-title">
                        房屋户型                    </td>
                    <td class="detail-value">
                        <?php echo $map["fangwuhuxing"]; ?>                    </td>
                                                        <td class="detail-title">
                        小区名称                    </td>
                    <td class="detail-value">
                        <?php echo $map["xiaoqumingcheng"]; ?>                    </td>
                                                        <td class="detail-title">
                        楼层                    </td>
                    <td class="detail-value">
                        <?php echo $map["louceng"]; ?>                    </td>
                    </tr><tr>                                    <td class="detail-title">
                        面积                    </td>
                    <td class="detail-value">
                        <?php echo $map["mianji"]; ?>                    </td>
                                                        <td class="detail-title">
                        房屋租金                    </td>
                    <td class="detail-value">
                        <?php echo $map["fangwuzujin"]; ?>                    </td>
                                                        <td class="detail-title">
                        押金方式                    </td>
                    <td class="detail-value">
                        <?php echo $map["yajinfangshi"]; ?>                    </td>
                    </tr><tr>                                    <td class="detail-title">
                        发布人                    </td>
                    <td class="detail-value">
                        <?php echo $map["faburen"]; ?>                    </td>
                                                        <td class="detail-title">
                        类型                    </td>
                    <td class="detail-value">
                        <?php  $mapfangwuleixing9 = db()->find("SELECT leixing,id FROM fangwuleixing where id='".$map["leixing"]."'");  ?><?php echo $mapfangwuleixing9["leixing"]; ?>                    </td>
                                                        <td class="detail-title">
                        价格区间                    </td>
                    <td class="detail-value">
                        <?php echo $map["jiagequjian"]; ?>                    </td>
                    </tr><tr>                                    <td class="detail-title">
                        距离学校                    </td>
                    <td class="detail-value">
                        <?php echo $map["julixuexiao"]; ?>                    </td>
                                                        <td class="detail-title">
                        最短租期                    </td>
                    <td class="detail-value">
                        <?php echo $map["zuiduanzuqi"]; ?>                    </td>
                                                        <td class="detail-title">
                        设施                    </td>
                    <td class="detail-value">
                        <?php echo $map["sheshi"]; ?>                    </td>
                    </tr><tr>                                    <td class="detail-title">
                        房间数                    </td>
                    <td class="detail-value">
                        <?php echo $map["fangjianshu"]; ?>                    </td>
                                                        <td class="detail-title">
                        是否有电梯                    </td>
                    <td class="detail-value">
                        <?php echo $map["shifouyoudianti"]; ?>                    </td>
                                                        <td class="detail-title">
                        租赁类型                    </td>
                    <td class="detail-value">
                        <?php echo $map["zulinleixing"]; ?>                    </td>
                    </tr><tr>                                    <td class="detail-title">
                        房屋地址                    </td>
                    <td class="detail-value">
                        <?php echo $map["fangwudizhi"]; ?>                    </td>
                                                        <td class="detail-title">
                        租赁时长                    </td>
                    <td class="detail-value">
                        <?php echo $map["zulinshichang"]; ?>                    </td>
                                                        <td class="detail-title">
                        租赁用户                    </td>
                    <td class="detail-value">
                        <?php echo $map["zulinyonghu"]; ?>                    </td>
                    </tr><tr>                                    <td class="detail-title">
                        标题                    </td>
                    <td class="detail-value">
                        <?php echo $map["biaoti"]; ?>                    </td>
                                                        <td class="detail-title">
                        分摊租金                    </td>
                    <td class="detail-value">
                        <?php echo $map["fentanzujin"]; ?>                    </td>
                                                        <td class="detail-title">
                        联系人                    </td>
                    <td class="detail-value">
                        <?php echo $map["lianxiren"]; ?>                    </td>
                    </tr><tr>                                    <td class="detail-title">
                        联系方式                    </td>
                    <td class="detail-value">
                        <?php echo $map["lianxifangshi"]; ?>                    </td>
                                                        <td class="detail-title">
                        点击率                    </td>
                    <td class="detail-value">
                        <?php echo $map["dianjilv"]; ?>                    </td>
                                                        <td class="detail-title">
                        添加时间                    </td>
                    <td class="detail-value">
                        <?php echo $map["addtime"]; ?>                    </td>
                    </tr><tr>                            </tr>
            </tbody>
        </table>
    </div>
        <div class="mt10 pa10 bg-white">
        <div class="new-detail-line">
            <div class="detail-title">
                房屋图片            </div>
            <td class="detail-value">
                <fieldset class="images_box"><div id="gellay_images" class="imagesList"><script>
            var images = "<?php echo $map["fangwutupian"]; ?>".split(',');
            for(var i=0;i<images.length;i++){
                var image = images[i];
                var uploadImage = '<div class="uploadImage">' +
                '<span class="thumb thumbnail"><img src="'+image+'"/></span>'+
                '</div>';
                document.writeln(uploadImage);
            }
            
</script></div></fieldset>            </td>
        </div>
    </div>
        <div class="mt10 pa10 bg-white">
        <div class="new-detail-line">
            <div class="detail-title">
                合租描述            </div>
            <td class="detail-value">
                <?php echo $map["hezumiaoshu"]; ?>            </td>
        </div>
    </div>
        <div class="mt10 not-print">
        <button type="button" class="btn btn-default" onclick="history.go(-1);">
    返回
        
</button>
        <button type="button" class="btn btn-default" onclick="window.print()">
    打印本页
        
</button>
    </div>
</div>




    </div>
</div>


</div>


<?php include "foot.php" ?>