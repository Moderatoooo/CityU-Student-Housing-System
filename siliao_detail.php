<?php require_once 'initialize.php'; ?>

<?php if (empty($_GET['id'])) {
    showMessage('没找到相关详情页面');
}

$map = M("siliao")->where("id", $_GET['id'])->find();

if (empty($map)) {
    showMessage('没找到相关详情页面');
}


?>


<?php include "head.php" ?>


    <div>


        <div class="panel panel-default">
            <div class="panel-heading">
        <span class="titles">
            私聊详情
        </span>
            </div>
            <div class="panel-body">


                <div class="pa10">
                    <div class="pa10 bg-white">
                        <table class="new-detail">
                            <tbody>
                            <tr>

                                <td class="detail-title">
                                    标题
                                </td>
                                <td class="detail-value">
                                    <?php echo $map["biaoti"]; ?>                    </td>

                            </tr>
                            <tr>

                                <td class="detail-title">
                                    咨询时间
                                </td>
                                <td class="detail-value">
                                    <?php echo $map["addtime"]; ?>                    </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>


            </div>
        </div>


    </div>


<?php include "foot.php" ?>