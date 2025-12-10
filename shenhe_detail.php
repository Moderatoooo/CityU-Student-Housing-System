<?php  require_once 'initialize.php';  ?><?php if(empty($_GET['id'])){
    showMessage('没找到相关详情页面');
}

$map = M("shenhe")->where("id" , $_GET['id'])->find();

if(empty($map)){
    showMessage('没找到相关详情页面');
}


?> 
<?php include "head.php" ?>





<div>



<div class="panel panel-default">
    <div class="panel-heading">
        <span class="titles">
            审核详情
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
                        姓名                    </td>
                    <td class="detail-value">
                        <?php echo $map["xingming"]; ?>                    </td>
                    </tr><tr>                                    <td class="detail-title">
                        联系电话                    </td>
                    <td class="detail-value">
                        <?php echo $map["lianxidianhua"]; ?>                    </td>
                                                        <td class="detail-title">
                        身份证号                    </td>
                    <td class="detail-value">
                        <?php echo $map["shenfenzhenghao"]; ?>                    </td>
                                                        <td class="detail-title">
                        租赁用户                    </td>
                    <td class="detail-value">
                        <?php echo $map["zulinyonghu"]; ?>                    </td>
                    </tr><tr>                                    <td class="detail-title">
                        租赁类型                    </td>
                    <td class="detail-value">
                        <?php echo $map["zulinleixing"]; ?>                    </td>
                                                        <td class="detail-title">
                        选择房间                    </td>
                    <td class="detail-value">
                        <?php  $mapfangjianxinxi8 = db()->find("SELECT fangjianmingcheng,id FROM fangjianxinxi where id='".$map["xuanzefangjian"]."'");  ?><?php echo $mapfangjianxinxi8["fangjianmingcheng"]; ?>                    </td>
                                                        <td class="detail-title">
                        审核                    </td>
                    <td class="detail-value">
                        <?php echo $map["shenhe"]; ?>                    </td>
                    </tr><tr>                                    <td class="detail-title">
                        操作人                    </td>
                    <td class="detail-value">
                        <?php echo $map["caozuoren"]; ?>                    </td>
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