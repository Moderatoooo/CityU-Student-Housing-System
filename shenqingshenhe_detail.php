<?php  require_once 'initialize.php';  ?><?php if(empty($_GET['id'])){
    showMessage('没找到相关详情页面');
}

$map = M("shenqingshenhe")->where("id" , $_GET['id'])->find();

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
            申请审核详情
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
                        房屋户型                    </td>
                    <td class="detail-value">
                        <?php echo $map["fangwuhuxing"]; ?>                    </td>
                    </tr><tr>                                    <td class="detail-title">
                        小区名称                    </td>
                    <td class="detail-value">
                        <?php echo $map["xiaoqumingcheng"]; ?>                    </td>
                                                        <td class="detail-title">
                        分摊租金                    </td>
                    <td class="detail-value">
                        <?php echo $map["fentanzujin"]; ?>                    </td>
                                                        <td class="detail-title">
                        租赁用户                    </td>
                    <td class="detail-value">
                        <?php echo $map["zulinyonghu"]; ?>                    </td>
                    </tr><tr>                                    <td class="detail-title">
                        楼层                    </td>
                    <td class="detail-value">
                        <?php echo $map["louceng"]; ?>                    </td>
                                                        <td class="detail-title">
                        面积                    </td>
                    <td class="detail-value">
                        <?php echo $map["mianji"]; ?>                    </td>
                                                        <td class="detail-title">
                        发布人                    </td>
                    <td class="detail-value">
                        <?php echo $map["faburen"]; ?>                    </td>
                    </tr><tr>                                    <td class="detail-title">
                        类型                    </td>
                    <td class="detail-value">
                        <?php  $mapfangwuleixing36 = db()->find("SELECT leixing,id FROM fangwuleixing where id='".$map["leixing"]."'");  ?><?php echo $mapfangwuleixing36["leixing"]; ?>                    </td>
                                                        <td class="detail-title">
                        姓名                    </td>
                    <td class="detail-value">
                        <?php echo $map["xingming"]; ?>                    </td>
                                                        <td class="detail-title">
                        申请人                    </td>
                    <td class="detail-value">
                        <?php echo $map["shenqingren"]; ?>                    </td>
                    </tr><tr>                                    <td class="detail-title">
                        审核结果                    </td>
                    <td class="detail-value">
                        <?php echo $map["shenhejieguo"]; ?>                    </td>
                                                        <td class="detail-title">
                        添加时间                    </td>
                    <td class="detail-value">
                        <?php echo $map["addtime"]; ?>                    </td>
                                                </tr>
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
                审核备注            </div>
            <td class="detail-value">
                <pre style="padding: 5px;background: none;border: none;margin: 0;"><?php echo $map["shenhebeizhu"]; ?></pre>            </td>
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