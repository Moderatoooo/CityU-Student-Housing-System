<?php require_once 'initialize.php'; ?><?php if (empty($_GET['id'])) {
    showMessage('没找到相关详情页面');
}

$map = M("hezushenqing")->where("id", $_GET['id'])->find();

if (empty($map)) {
    showMessage('没找到相关详情页面');
}

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>合租申请详情 - 房屋租赁系统</title>
    <?php include "head.php" ?>
    <link href="js/h5upload/h5upload.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Helvetica Neue', Arial, sans-serif;
            padding: 20px 0;
        }
        .container {
            max-width: 98%;
            margin: 0 auto;
            padding: 0 15px;
        }
        .detail-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            overflow: hidden;
            margin-bottom: 25px;
        }
        .detail-header {
            /*background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);*/
            color: #1b7497;
            padding: 25px;
            text-align: center;
        }
        .detail-header h2 {
            margin: 0;
            font-size: 28px;
            font-weight: bold;
        }
        .detail-body {
            padding: 30px;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }
        .info-table tr {
            border-bottom: 1px solid #eee;
        }
        .info-table tr:last-child {
            border-bottom: none;
        }
        .info-table td {
            padding: 12px 15px;
            vertical-align: top;
        }
        .detail-title {
            background-color: #f8f9fa;
            font-weight: 600;
            color: #495057;
            width: 15%;
            white-space: nowrap;
        }
        .detail-value {
            color: #212529;
        }
        .section-title {
            font-size: 24px;
            color: #2c3e50;
            margin: 30px 0 20px 0;
            padding-bottom: 10px;
            border-bottom: 2px solid #3498db;
            display: inline-block;
        }
        .images-section {
            margin: 25px 0;
        }
        .images-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 15px;
            margin-top: 15px;
        }
        .image-item {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            height: 150px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }
        .image-item:hover {
            transform: scale(1.05);
        }
        .image-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .description-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            line-height: 1.6;
            color: #495057;
        }
        .applicants-section {
            margin-top: 30px;
        }
        .comparison-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        .comparison-table th {
            background: #3498db;
            color: white;
            padding: 15px;
            text-align: center;
            font-weight: 600;
        }
        .comparison-table td {
            padding: 15px;
            border-bottom: 1px solid #dee2e6;
            vertical-align: top;
            position: relative;
        }
        .comparison-table tr td::after {
            content: '';
            position: absolute;
            left: 10%;
            right: 10%;
            bottom: 0;
            height: 3px;
            background: linear-gradient(to right, transparent, #bdc3c7, transparent);
        }
        .comparison-table tr:last-child td {
            border-bottom: 3px solid #3498db;
        }
        .comparison-table tr:last-child td::after {
            background: linear-gradient(to right, transparent, #3498db, transparent);
        }
        .comparison-table tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        .comparison-label {
            font-weight: 600;
            background-color: #e1f0fa !important;
        }
        .star-rating {
            color: #ffc107;
        }
        .action-buttons {
            display: flex;
            gap: 15px;
            margin-top: 30px;
            padding: 20px 0;
        }
        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 500;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            transition: all 0.3s ease;
        }
        .btn-default {
            background: #6c757d;
            color: white;
        }
        .btn-default:hover {
            background: #5a6268;
        }
        .btn-primary {
            background: #007bff;
            color: white;
        }
        .btn-primary:hover {
            background: #0069d9;
        }

        /* 图片模态框样式 */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
            backdrop-filter: blur(5px);
        }
        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            height: 80%;
            object-fit: contain;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
        }
        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            cursor: pointer;
            z-index: 1001;
        }
        .close:hover {
            color: #bbb;
        }

        @media (max-width: 768px) {
            .info-table {
                display: flex;
                flex-direction: column;
            }
            .info-table tr {
                display: flex;
                flex-direction: column;
                margin-bottom: 15px;
            }
            .detail-title, .detail-value {
                width: 100% !important;
                display: block;
                padding: 8px 15px !important;
            }
            .comparison-table {
                display: block;
                overflow-x: auto;
            }
            .action-buttons {
                flex-direction: column;
            }
            .detail-body {
                padding: 20px;
            }
        }
    </style>
</head>
<body>


<div class="container">
    <div class="detail-card">
        <div class="detail-header">
            <h2>合租申请详情</h2>
        </div>
        
        <div class="detail-body">
            <!-- 房源信息表格 -->
            <div class="info-table-wrapper">
                <table class="info-table">
                    <tr>
                        <td class="detail-title">租赁单号</td>
                        <td class="detail-value"><?php echo $map["zulindanhao"]; ?></td>
                        <td class="detail-title">房屋编号</td>
                        <td class="detail-value"><?php echo $map["fangwubianhao"]; ?></td>
                        <td class="detail-title">房屋户型</td>
                        <td class="detail-value"><?php echo $map["fangwuhuxing"]; ?></td>
                    </tr>
                    <tr>
                        <td class="detail-title">小区名称</td>
                        <td class="detail-value"><?php echo $map["xiaoqumingcheng"]; ?></td>
                        <td class="detail-title">楼层</td>
                        <td class="detail-value"><?php echo $map["louceng"]; ?></td>
                        <td class="detail-title">面积</td>
                        <td class="detail-value"><?php echo $map["mianji"]; ?></td>
                    </tr>
                    <tr>
                        <td class="detail-title">发布人</td>
                        <td class="detail-value"><?php echo $map["faburen"]; ?></td>
                        <td class="detail-title">类型</td>
                        <td class="detail-value">
                            <?php $mapfangwuleixing10 = db()->find("SELECT leixing,id FROM fangwuleixing where id='" . $map["leixing"] . "'"); ?>
                            <?php echo $mapfangwuleixing10["leixing"]; ?>
                        </td>
                        <td class="detail-title">设施</td>
                        <td class="detail-value"><?php echo $map["sheshi"]; ?></td>
                    </tr>
                    <tr>
                        <td class="detail-title">是否有电梯</td>
                        <td class="detail-value"><?php echo $map["shifouyoudianti"]; ?></td>
                        <td class="detail-title">租赁类型</td>
                        <td class="detail-value"><?php echo $map["zulinleixing"]; ?></td>
                        <td class="detail-title">房屋地址</td>
                        <td class="detail-value"><?php echo $map["fangwudizhi"]; ?></td>
                    </tr>
                    <tr>
                        <td class="detail-title">分摊租金</td>
                        <td class="detail-value"><?php echo $map["fentanzujin"]; ?></td>
                        <td class="detail-title">租赁用户</td>
                        <td class="detail-value"><?php echo $map["zulinyonghu"]; ?></td>
                        <td class="detail-title">姓名</td>
                        <td class="detail-value"><?php echo $map["xingming"]; ?></td>
                    </tr>
                    <tr>
                        <td class="detail-title">手机</td>
                        <td class="detail-value"><?php echo $map["shouji"]; ?></td>
                        <td class="detail-title">身份证</td>
                        <td class="detail-value"><?php echo $map["shenfenzheng"]; ?></td>
                        <td class="detail-title">合租状态</td>
                        <td class="detail-value"><?php echo $map["hezuzhuangtai"]; ?></td>
                    </tr>
                    <tr>
                        <td class="detail-title">申请人</td>
                        <td class="detail-value"><?php echo $map["shenqingren"]; ?></td>
                        <td class="detail-title">添加时间</td>
                        <td class="detail-value"><?php echo $map["addtime"]; ?></td>
                    </tr>
                </table>
            </div>
            
            <!-- 房屋图片 -->
            <div class="images-section">
                <h3 class="section-title">房屋图片</h3>
                <div class="images-grid">
                    <?php 
                    $images = explode(',', $map["fangwutupian"]);
                    foreach($images as $image):
                        if(!empty($image)):
                    ?>
                    <div class="image-item" onclick="openModal();currentSlide(<?php echo array_search($image, $images) + 1; ?>)">
                        <img src="<?php echo $image; ?>" alt="房屋图片" />
                    </div>
                    <?php 
                        endif;
                    endforeach;
                    if(empty($images[0])):
                    ?>
                    <p>暂无图片</p>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- 合租描述 -->
            <div class="description-section">
                <h3 class="section-title">合租描述</h3>
                <div><?php echo $map["hezumiaoshu"]; ?></div>
            </div>
            
            <!-- 申请合租人信息对比 -->


            <?php if ($_SESSION["username"] == $map["zulinyonghu"]){?>

                <div class="applicants-section">
                    <h3 class="section-title">申请合租人信息对比</h3>
                    <?php $hz = M("hezushenqing")->where("zulindanhao", "=", $map["zulindanhao"])->order("id desc")->select(); ?>

                    <?php if(count($hz) > 0): ?>
                        <table class="comparison-table">
                            <thead>
                            <tr>
                                <th class="comparison-label" style="color: #0f0f0f">信息类别</th>
                                <?php foreach($hz as $index => $m): ?>
                                    <?php $yh = M("yonghu")->where("yonghuming", "=", $m["shenqingren"])->order("id desc")->limit(1)->select(); ?>
                                    <?php foreach($yh as $r): ?>
                                        <th>
                                            <div><?php echo $r["xingming"]; ?></div>
                                            <div style="font-size: 12px; margin-top: 5px; color: #3498db;"><?php echo $m["hezuzhuangtai"]; ?></div>
                                        </th>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="comparison-label">性别</td>
                                <?php foreach($hz as $m): ?>
                                    <?php $yh = M("yonghu")->where("yonghuming", "=", $m["shenqingren"])->order("id desc")->limit(1)->select(); ?>
                                    <?php foreach($yh as $r): ?>
                                        <td><?php echo $r["xingbie"]; ?></td>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td class="comparison-label">手机</td>
                                <?php foreach($hz as $m): ?>
                                    <?php $yh = M("yonghu")->where("yonghuming", "=", $m["shenqingren"])->order("id desc")->limit(1)->select(); ?>
                                    <?php foreach($yh as $r): ?>
                                        <td><?php echo $r["shouji"]; ?></td>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td class="comparison-label">邮箱</td>
                                <?php foreach($hz as $m): ?>
                                    <?php $yh = M("yonghu")->where("yonghuming", "=", $m["shenqingren"])->order("id desc")->limit(1)->select(); ?>
                                    <?php foreach($yh as $r): ?>
                                        <td><?php echo $r["youxiang"]; ?></td>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td class="comparison-label">年龄</td>
                                <?php foreach($hz as $m): ?>
                                    <?php $yh = M("yonghu")->where("yonghuming", "=", $m["shenqingren"])->order("id desc")->limit(1)->select(); ?>
                                    <?php foreach($yh as $r): ?>
                                        <td><?php echo $r["nianling"]; ?></td>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td class="comparison-label">学院/专业</td>
                                <?php foreach($hz as $m): ?>
                                    <?php $yh = M("yonghu")->where("yonghuming", "=", $m["shenqingren"])->order("id desc")->limit(1)->select(); ?>
                                    <?php foreach($yh as $r): ?>
                                        <td><?php echo $r["xueyuanzhuanye"]; ?></td>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td class="comparison-label">所在城市</td>
                                <?php foreach($hz as $m): ?>
                                    <?php $yh = M("yonghu")->where("yonghuming", "=", $m["shenqingren"])->order("id desc")->limit(1)->select(); ?>
                                    <?php foreach($yh as $r): ?>
                                        <td><?php echo $r["suozaichengshi"]; ?></td>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td class="comparison-label">年级</td>
                                <?php foreach($hz as $m): ?>
                                    <?php $yh = M("yonghu")->where("yonghuming", "=", $m["shenqingren"])->order("id desc")->limit(1)->select(); ?>
                                    <?php foreach($yh as $r): ?>
                                        <td><?php echo $r["nianji"]; ?></td>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td class="comparison-label">国籍</td>
                                <?php foreach($hz as $m): ?>
                                    <?php $yh = M("yonghu")->where("yonghuming", "=", $m["shenqingren"])->order("id desc")->limit(1)->select(); ?>
                                    <?php foreach($yh as $r): ?>
                                        <td><?php echo $r["guoji"]; ?></td>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td class="comparison-label">主要语言</td>
                                <?php foreach($hz as $m): ?>
                                    <?php $yh = M("yonghu")->where("yonghuming", "=", $m["shenqingren"])->order("id desc")->limit(1)->select(); ?>
                                    <?php foreach($yh as $r): ?>
                                        <td><?php echo $r["zhuyaoyuyan"]; ?></td>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td class="comparison-label">作息类型</td>
                                <?php foreach($hz as $m): ?>
                                    <?php $yh = M("yonghu")->where("yonghuming", "=", $m["shenqingren"])->order("id desc")->limit(1)->select(); ?>
                                    <?php foreach($yh as $r): ?>
                                        <td><?php echo $r["zuoxileixing"]; ?></td>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td class="comparison-label">在家时间</td>
                                <?php foreach($hz as $m): ?>
                                    <?php $yh = M("yonghu")->where("yonghuming", "=", $m["shenqingren"])->order("id desc")->limit(1)->select(); ?>
                                    <?php foreach($yh as $r): ?>
                                        <td><?php echo $r["zaijiashijian"]; ?></td>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td class="comparison-label">固定安静时段需求</td>
                                <?php foreach($hz as $m): ?>
                                    <?php $yh = M("yonghu")->where("yonghuming", "=", $m["shenqingren"])->order("id desc")->limit(1)->select(); ?>
                                    <?php foreach($yh as $r): ?>
                                        <td><?php echo $r["gudinganjingshiduanxuqiu"]; ?></td>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td class="comparison-label">自我整洁度</td>
                                <?php foreach($hz as $m): ?>
                                    <?php $yh = M("yonghu")->where("yonghuming", "=", $m["shenqingren"])->order("id desc")->limit(1)->select(); ?>
                                    <?php foreach($yh as $r): ?>
                                        <td>
                                            <div class="star-rating" style="display: inline-block;">
                                                <?php for($i=1; $i<=5; $i++): ?>
                                                    <?php if($i <= $r["ziwozhengjiedu"]): ?>
                                                        <i class="glyphicon glyphicon-star"></i>
                                                    <?php else: ?>
                                                        <i class="glyphicon glyphicon-star-empty"></i>
                                                    <?php endif; ?>
                                                <?php endfor; ?>
                                            </div>
                                        </td>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td class="comparison-label">清洁频率偏好</td>
                                <?php foreach($hz as $m): ?>
                                    <?php $yh = M("yonghu")->where("yonghuming", "=", $m["shenqingren"])->order("id desc")->limit(1)->select(); ?>
                                    <?php foreach($yh as $r): ?>
                                        <td><?php echo $r["qingjiepinlvpianhao"]; ?></td>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td class="comparison-label">是否参与轮值家务</td>
                                <?php foreach($hz as $m): ?>
                                    <?php $yh = M("yonghu")->where("yonghuming", "=", $m["shenqingren"])->order("id desc")->limit(1)->select(); ?>
                                    <?php foreach($yh as $r): ?>
                                        <td><?php echo $r["shifoucanyulunzhijiawu"]; ?></td>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td class="comparison-label">公区整洁期望</td>
                                <?php foreach($hz as $m): ?>
                                    <?php $yh = M("yonghu")->where("yonghuming", "=", $m["shenqingren"])->order("id desc")->limit(1)->select(); ?>
                                    <?php foreach($yh as $r): ?>
                                        <td><?php echo $r["gongquzhengjieqiwang"]; ?></td>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td class="comparison-label">是否接受清洁外包</td>
                                <?php foreach($hz as $m): ?>
                                    <?php $yh = M("yonghu")->where("yonghuming", "=", $m["shenqingren"])->order("id desc")->limit(1)->select(); ?>
                                    <?php foreach($yh as $r): ?>
                                        <td><?php echo $r["shifoujieshouqingjiewaibao"]; ?></td>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td class="comparison-label">带同/异性回家</td>
                                <?php foreach($hz as $m): ?>
                                    <?php $yh = M("yonghu")->where("yonghuming", "=", $m["shenqingren"])->order("id desc")->limit(1)->select(); ?>
                                    <?php foreach($yh as $r): ?>
                                        <td><?php echo $r["daitongyixinghuijia"]; ?></td>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td class="comparison-label">同/异性偶尔留宿</td>
                                <?php foreach($hz as $m): ?>
                                    <?php $yh = M("yonghu")->where("yonghuming", "=", $m["shenqingren"])->order("id desc")->limit(1)->select(); ?>
                                    <?php foreach($yh as $r): ?>
                                        <td><?php echo $r["tongyixingouerliusu"]; ?></td>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td class="comparison-label">社交偏好</td>
                                <?php foreach($hz as $m): ?>
                                    <?php $yh = M("yonghu")->where("yonghuming", "=", $m["shenqingren"])->order("id desc")->limit(1)->select(); ?>
                                    <?php foreach($yh as $r): ?>
                                        <td><?php echo $r["shejiaopianhao"]; ?></td>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td class="comparison-label">性别混住接受度</td>
                                <?php foreach($hz as $m): ?>
                                    <?php $yh = M("yonghu")->where("yonghuming", "=", $m["shenqingren"])->order("id desc")->limit(1)->select(); ?>
                                    <?php foreach($yh as $r): ?>
                                        <td><?php echo $r["xingbiehunzhujieshoudu"]; ?></td>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td class="comparison-label">饮食习惯</td>
                                <?php foreach($hz as $m): ?>
                                    <?php $yh = M("yonghu")->where("yonghuming", "=", $m["shenqingren"])->order("id desc")->limit(1)->select(); ?>
                                    <?php foreach($yh as $r): ?>
                                        <td><?php echo $r["yinshixiguan"]; ?></td>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td class="comparison-label">是否介意油烟/重口味</td>
                                <?php foreach($hz as $m): ?>
                                    <?php $yh = M("yonghu")->where("yonghuming", "=", $m["shenqingren"])->order("id desc")->limit(1)->select(); ?>
                                    <?php foreach($yh as $r): ?>
                                        <td><?php echo $r["shifoujieyiyouyanzhongkouwei"]; ?></td>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td class="comparison-label">厨房使用频率</td>
                                <?php foreach($hz as $m): ?>
                                    <?php $yh = M("yonghu")->where("yonghuming", "=", $m["shenqingren"])->order("id desc")->limit(1)->select(); ?>
                                    <?php foreach($yh as $r): ?>
                                        <td><?php echo $r["chufangshiyongpinlv"]; ?></td>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td class="comparison-label">冰箱与调味品共用</td>
                                <?php foreach($hz as $m): ?>
                                    <?php $yh = M("yonghu")->where("yonghuming", "=", $m["shenqingren"])->order("id desc")->limit(1)->select(); ?>
                                    <?php foreach($yh as $r): ?>
                                        <td><?php echo $r["bingxiangyutiaoweipingongyong"]; ?></td>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td class="comparison-label">过敏/禁忌</td>
                                <?php foreach($hz as $m): ?>
                                    <?php $yh = M("yonghu")->where("yonghuming", "=", $m["shenqingren"])->order("id desc")->limit(1)->select(); ?>
                                    <?php foreach($yh as $r): ?>
                                        <td><?php echo $r["guominjinji"]; ?></td>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td class="comparison-label">对音量容忍度</td>
                                <?php foreach($hz as $m): ?>
                                    <?php $yh = M("yonghu")->where("yonghuming", "=", $m["shenqingren"])->order("id desc")->limit(1)->select(); ?>
                                    <?php foreach($yh as $r): ?>
                                        <td>
                                            <div class="star-rating" style="display: inline-block;">
                                                <?php for($i=1; $i<=5; $i++): ?>
                                                    <?php if($i <= $r["duiyinliangrongrendu"]): ?>
                                                        <i class="glyphicon glyphicon-star"></i>
                                                    <?php else: ?>
                                                        <i class="glyphicon glyphicon-star-empty"></i>
                                                    <?php endif; ?>
                                                <?php endfor; ?>
                                            </div>
                                        </td>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td class="comparison-label">吸烟</td>
                                <?php foreach($hz as $m): ?>
                                    <?php $yh = M("yonghu")->where("yonghuming", "=", $m["shenqingren"])->order("id desc")->limit(1)->select(); ?>
                                    <?php foreach($yh as $r): ?>
                                        <td><?php echo $r["xiyan"]; ?></td>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td class="comparison-label">饮酒</td>
                                <?php foreach($hz as $m): ?>
                                    <?php $yh = M("yonghu")->where("yonghuming", "=", $m["shenqingren"])->order("id desc")->limit(1)->select(); ?>
                                    <?php foreach($yh as $r): ?>
                                        <td><?php echo $r["yinjiu"]; ?></td>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td class="comparison-label">香水/香薰</td>
                                <?php foreach($hz as $m): ?>
                                    <?php $yh = M("yonghu")->where("yonghuming", "=", $m["shenqingren"])->order("id desc")->limit(1)->select(); ?>
                                    <?php foreach($yh as $r): ?>
                                        <td><?php echo $r["xiangshuixiangxun"]; ?></td>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td class="comparison-label">是否介意气味</td>
                                <?php foreach($hz as $m): ?>
                                    <?php $yh = M("yonghu")->where("yonghuming", "=", $m["shenqingren"])->order("id desc")->limit(1)->select(); ?>
                                    <?php foreach($yh as $r): ?>
                                        <td><?php echo $r["shifoujieyiqiwei"]; ?></td>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td class="comparison-label">是否有宠物</td>
                                <?php foreach($hz as $m): ?>
                                    <?php $yh = M("yonghu")->where("yonghuming", "=", $m["shenqingren"])->order("id desc")->limit(1)->select(); ?>
                                    <?php foreach($yh as $r): ?>
                                        <td><?php echo $r["shifouyouchongwu"]; ?></td>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td class="comparison-label">对宠物接受度</td>
                                <?php foreach($hz as $m): ?>
                                    <?php $yh = M("yonghu")->where("yonghuming", "=", $m["shenqingren"])->order("id desc")->limit(1)->select(); ?>
                                    <?php foreach($yh as $r): ?>
                                        <td><?php echo $r["duichongwujieshoudu"]; ?></td>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td class="comparison-label">押金与损耗处理规则</td>
                                <?php foreach($hz as $m): ?>
                                    <?php $yh = M("yonghu")->where("yonghuming", "=", $m["shenqingren"])->order("id desc")->limit(1)->select(); ?>
                                    <?php foreach($yh as $r): ?>
                                        <td><?php echo $r["yajinyusunhaochuliguize"]; ?></td>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td class="comparison-label">支付方式</td>
                                <?php foreach($hz as $m): ?>
                                    <?php $yh = M("yonghu")->where("yonghuming", "=", $m["shenqingren"])->order("id desc")->limit(1)->select(); ?>
                                    <?php foreach($yh as $r): ?>
                                        <td><?php echo $r["zhifufangshi"]; ?></td>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td class="comparison-label">共同采购与预算</td>
                                <?php foreach($hz as $m): ?>
                                    <?php $yh = M("yonghu")->where("yonghuming", "=", $m["shenqingren"])->order("id desc")->limit(1)->select(); ?>
                                    <?php foreach($yh as $r): ?>
                                        <td><?php echo $r["gongtongcaigouyuyusuan"]; ?></td>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td class="comparison-label">性格</td>
                                <?php foreach($hz as $m): ?>
                                    <?php $yh = M("yonghu")->where("yonghuming", "=", $m["shenqingren"])->order("id desc")->limit(1)->select(); ?>
                                    <?php foreach($yh as $r): ?>
                                        <td><?php echo $r["xingge"]; ?></td>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td class="comparison-label">兴趣</td>
                                <?php foreach($hz as $m): ?>
                                    <?php $yh = M("yonghu")->where("yonghuming", "=", $m["shenqingren"])->order("id desc")->limit(1)->select(); ?>
                                    <?php foreach($yh as $r): ?>
                                        <td><?php echo $r["xingqu"]; ?></td>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td class="comparison-label">作息</td>
                                <?php foreach($hz as $m): ?>
                                    <?php $yh = M("yonghu")->where("yonghuming", "=", $m["shenqingren"])->order("id desc")->limit(1)->select(); ?>
                                    <?php foreach($yh as $r): ?>
                                        <td><?php echo $r["zuoxi"]; ?></td>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td class="comparison-label">活动</td>
                                <?php foreach($hz as $m): ?>
                                    <?php $yh = M("yonghu")->where("yonghuming", "=", $m["shenqingren"])->order("id desc")->limit(1)->select(); ?>
                                    <?php foreach($yh as $r): ?>
                                        <td><?php echo $r["huodong"]; ?></td>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td class="comparison-label">理想室友特质</td>
                                <?php foreach($hz as $m): ?>
                                    <?php $yh = M("yonghu")->where("yonghuming", "=", $m["shenqingren"])->order("id desc")->limit(1)->select(); ?>
                                    <?php foreach($yh as $r): ?>
                                        <td><?php echo $r["lixiangshiyoutezhi"]; ?></td>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tr>
                            <tr>
                                <td class="comparison-label">其他需求</td>
                                <?php foreach($hz as $m): ?>
                                    <?php $yh = M("yonghu")->where("yonghuming", "=", $m["shenqingren"])->order("id desc")->limit(1)->select(); ?>
                                    <?php foreach($yh as $r): ?>
                                        <td><?php echo $r["qitaxuqiu"]; ?></td>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </tr>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>暂无申请合租人信息</p>
                    <?php endif; ?>
                </div>

            <?php }?>


            
            <!-- 操作按钮 -->
            <div class="action-buttons">
                <button type="button" class="btn btn-default" onclick="history.go(-1);">
                    返回
                </button>
                <button type="button" class="btn btn-primary" onclick="window.print()">
                    打印本页
                </button>
            </div>
        </div>
    </div>
</div>

<!-- 图片模态框 -->
<div id="imageModal" class="modal" onclick="closeModal()">
    <span class="close" onclick="closeModal()">&times;</span>
    <img class="modal-content" id="modalImage">
</div>

<script src="js/h5upload/h5upload.js"></script>
<script>
    // 图片模态框功能
    function openModal() {
        document.getElementById('imageModal').style.display = 'block';
    }
    
    function closeModal() {
        document.getElementById('imageModal').style.display = 'none';
    }
    
    // 点击图片时打开模态框并显示对应图片
    document.querySelectorAll('.image-item img').forEach((img, index) => {
        img.addEventListener('click', function(e) {
            e.stopPropagation(); // 防止触发父元素的点击事件
            document.getElementById('modalImage').src = this.src;
            openModal();
        });
    });
    
    // 点击模态框外部关闭
    document.getElementById('imageModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
    
    // 处理键盘事件
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });
    
    // 页面加载完成后执行
    document.addEventListener('DOMContentLoaded', function() {
        // 可以添加额外的交互功能
    });
</script>


<?php include "foot.php" ?>
</body>
</html>