<?php  require_once 'initialize.php';  ?><?php if(empty($_GET['id'])){
    showMessage('没找到相关详情页面');
}

$map = M("fangdong")->where("id" , $_GET['id'])->find();

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
            房东详情
        </span>
    </div>
    <div class="panel-body">
        
    

<div class="pa10">
    <div class="pa10 bg-white">
        <table class="new-detail">
            <tbody>
            <tr>
                                    <td class="detail-title">
                        账号                    </td>
                    <td class="detail-value">
                        <?php echo $map["zhanghao"]; ?>                    </td>
                                                        <td class="detail-title">
                        密码                    </td>
                    <td class="detail-value">
                        <?php echo $map["mima"]; ?>                    </td>
                                                        <td class="detail-title">
                        姓名                    </td>
                    <td class="detail-value">
                        <?php echo $map["xingming"]; ?>                    </td>
                    </tr><tr>                                    <td class="detail-title">
                        性别                    </td>
                    <td class="detail-value">
                        <?php echo $map["xingbie"]; ?>                    </td>
                                                        <td class="detail-title">
                        手机                    </td>
                    <td class="detail-value">
                        <?php echo $map["shouji"]; ?>                    </td>
                                                        <td class="detail-title">
                        身份证                    </td>
                    <td class="detail-value">
                        <?php echo $map["shenfenzheng"]; ?>                    </td>
                    </tr><tr>                                    <td class="detail-title">
                        头像                    </td>
                    <td class="detail-value">
                        <img src="<?php echo $map["touxiang"]; ?>" style="width: 350px"/>                    </td>
                                                </tr>
            </tbody>
        </table>
    </div>
        <div class="mt10 pa10 bg-white">
        <div class="new-detail-line">
            <div class="detail-title">
                房产证书            </div>
            <td class="detail-value">
                <fieldset class="images_box"><div id="gellay_images" class="imagesList"><script>
            var images = "<?php echo $map["fangchanzhengshu"]; ?>".split(',');
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