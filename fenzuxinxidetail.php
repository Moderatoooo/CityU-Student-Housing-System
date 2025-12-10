<?php require_once 'initialize.php'; ?><?php if (empty($_GET['id'])) {
    showMessage('没找到相关详情页面');
}

$map = M("fenzuxinxi")->where("id", $_GET['id'])->find();

if (empty($map)) {
    showMessage('没找到相关详情页面');
}

db()->query("UPDATE fenzuxinxi SET dianjilv = dianjilv+1 WHERE id='" . $_GET["id"] . "'");

// 获取房东信息
$fangdong = M("yonghu")->where("yonghuming", "=", $map["zulinyonghu"])->find();
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $map["biaoti"]; ?> - 分租信息详情</title>
    <?php include "head.php" ?>
    <link rel="stylesheet" href="js/swiper/swiper.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Helvetica Neue', Arial, sans-serif;
        }
        .detail-container {
            max-width: 1200px;
            margin: 20px auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            overflow: hidden;
        }
        .detail-header {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
        }
        .detail-header h1 {
            font-size: 28px;
            margin: 0 0 10px 0;
            font-weight: bold;
        }
        .detail-header .subtitle {
            font-size: 16px;
            opacity: 0.9;
        }
        .detail-content {
            padding: 30px;
        }
        .image-gallery {
            margin-bottom: 30px;
            position: relative;
        }
        .swiper-container {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .swiper-slide {
            height: 500px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .swiper-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .swiper-slide .img-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f0f0f0;
            color: #999;
        }
        .swiper-pagination {
            bottom: 10px;
        }
        .swiper-button-next, .swiper-button-prev {
            color: white;
            background: rgba(0,0,0,0.3);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-top: -25px;
        }
        .swiper-button-next::after, .swiper-button-prev::after {
            font-size: 20px;
        }
        .gallery-thumbs .swiper-slide {
            height: 100px;
            cursor: pointer;
        }
        .property-info {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 30px;
        }
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }
        .info-item {
            display: flex;
            flex-direction: column;
        }
        .info-label {
            font-weight: 600;
            color: #495057;
            font-size: 14px;
            margin-bottom: 5px;
        }
        .info-value {
            font-size: 16px;
            color: #212529;
            padding: 8px 0;
        }
        .tabs-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            overflow: hidden;
        }
        .tab-nav {
            display: flex;
            background: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
        }
        .tab-btn {
            flex: 1;
            padding: 18px 20px;
            text-align: center;
            cursor: pointer;
            font-weight: 500;
            color: #6c757d;
            border: none;
            background: none;
            transition: all 0.3s ease;
            font-size: 16px;
            position: relative;
        }
        .tab-btn.active {
            color: #007bff;
            background: white;
        }
        .tab-btn.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: #007bff;
        }
        .tab-content {
            padding: 25px;
        }
        .tab-pane {
            display: none;
        }
        .tab-pane.active {
            display: block;
        }
        .user-info-card {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 25px;
        }
        .user-info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }
        .description-content {
            line-height: 1.8;
            color: #495057;
            font-size: 16px;
        }
        .user-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }
        .user-card h4 {
            color: #2c3e50;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
            margin: 0 0 15px 0;
        }
        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 25px 0;
        }
        .btn-apply {
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
            color: white;
            padding: 14px 30px;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            font-weight: 500;
            font-size: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(255, 107, 107, 0.4);
        }
        .btn-apply:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(255, 107, 107, 0.6);
        }
        .btn-contact {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            padding: 14px 30px;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            font-weight: 500;
            font-size: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(37, 117, 252, 0.4);
        }
        .btn-contact:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(37, 117, 252, 0.6);
        }
        .similar-properties {
            margin-top: 30px;
        }
        .properties-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            margin-top: 20px;
        }
        .property-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }
        .property-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        .property-image {
            height: 180px;
            background-size: cover;
            background-position: center;
            position: relative;
        }
        .property-price {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background: #e74c3c;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: bold;
        }
        .property-content {
            padding: 20px;
        }
        .property-title {
            font-size: 28px;
            font-weight: bold;
            margin: 0 0 10px 0;
            color: #333;
        }
        .rent-price {
            font-size: 28px;
            font-weight: bold;
            color: #e74c3c;
            margin: 10px 0;
        }
        .rent-label {
            font-size: 14px;
            color: #999;
        }
        .property-desc {
            color: #6c757d;
            font-size: 14px;
            margin-bottom: 15px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .property-features {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
        .feature-tag {
            background: #eef2f7;
            padding: 4px 10px;
            border-radius: 15px;
            font-size: 12px;
            color: #495057;
        }
        .section-title {
            font-size: 24px;
            color: #2c3e50;
            margin: 0 0 20px 0;
            padding-bottom: 10px;
            border-bottom: 2px solid #3498db;
            display: inline-block;
        }
        .star-rating {
            color: #ffc107;
        }
        .contact-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }
        .apply-section {
            background: #e3f2fd;
            border-radius: 12px;
            padding: 20px;
            margin: 20px 0;
            text-align: center;
        }
        .apply-section h4 {
            color: #1976d2;
            margin: 0 0 10px 0;
        }
        .apply-section p {
            color: #555;
            margin: 0 0 15px 0;
        }
        @media (max-width: 768px) {
            .detail-content {
                padding: 20px 15px;
            }
            .swiper-slide {
                height: 300px;
            }
            .gallery-thumbs .swiper-slide {
                height: 80px;
            }
            .info-grid {
                grid-template-columns: 1fr;
            }
            .user-info-grid {
                grid-template-columns: 1fr;
            }
            .contact-info {
                flex-direction: column;
                gap: 15px;
            }
            .action-buttons {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>
<?php include "header.php" ?>

<div class="detail-container">
        <h1 style="margin-top: 20px;margin-left: 20px" class="property-title"><?php echo $map["biaoti"]; ?>( <span style="color: #0ac265"><?php echo $map["zulinleixing"]; ?> / 分摊押金:<?php echo $map["fentanzujin"]; ?> </span> )</h1>

        <div class="rent-price" style="margin-left: 20px">
            <span class="rent-label">租金：</span>
            <?php echo $map["fangwuzujin"]; ?>元/月
        </div>
    
    <div class="detail-content">
        <!-- 图片展示区 -->
        <div class="image-gallery">
            <div class="swiper-container gallery-top" id="main-slider">
                <div class="swiper-wrapper">
                    <?php 
                    $images = explode(",", $map["fangwutupian"]);
                    foreach($images as $img): 
                        if(!empty($img)):
                    ?>
                    <div class="swiper-slide">
                        <img src="<?php echo $img; ?>" alt="房源图片" />
                    </div>
                    <?php 
                        else:
                    ?>
                    <div class="swiper-slide">
                        <div class="img-placeholder">暂无图片</div>
                    </div>
                    <?php 
                        endif;
                    endforeach; 
                    if(empty($images[0])):
                    ?>
                    <div class="swiper-slide">
                        <div class="img-placeholder">暂无图片</div>
                    </div>
                    <?php endif; ?>
                </div>
                <!-- 分页器 -->
                <div class="swiper-pagination"></div>
                <!-- 导航按钮 -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
            
            <?php if(count($images) > 1): ?>
            <div class="swiper-container gallery-thumbs" id="thumb-slider" style="margin-top: 15px; height: 100px;">
                <div class="swiper-wrapper">
                    <?php 
                    foreach($images as $img): 
                        if(!empty($img)):
                    ?>
                    <div class="swiper-slide">
                        <img src="<?php echo $img; ?>" alt="缩略图" />
                    </div>
                    <?php 
                        else:
                    ?>
                    <div class="swiper-slide">
                        <div class="img-placeholder">暂无图片</div>
                    </div>
                    <?php 
                        endif;
                    endforeach; 
                    ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
        
        <!-- 操作按钮 -->
        <div class="action-buttons">

            <?php if (M('hezushenqing')->where('fenzuxinxiid', $map['id'])->where("shenqingren", $_SESSION["username"])->count() ==0 && "用户" == $_SESSION["cx"] &&  $map["zulinyonghu"] != $_SESSION["username"]){ ?>
                <a class="btn-apply" style="color: white" href="hezushenqingadd.php?id=<?php echo $map["id"]; ?>"> 合租申请 </a>
            <?php } ?>

<!--            <button class="btn-apply" onclick="applyToRoom()">合租申请</button>-->


<!--            <button class="btn-contact" onclick="contactUser()">联系发布人</button>-->


            <?php if ( "用户" == $_SESSION["cx"] &&  $map["zulinyonghu"] != $_SESSION["username"] ){ ?>
                <a class="btn-contact"  style="color: white" href="siliaoadd.php?id=<?php echo $map["id"]; ?>&shouxinren=<?php echo $map["zulinyonghu"]; ?>"
                   class="btn btn-primary">
                    联系发布人
                </a>
            <?php } else { ?>
                <button class="btn-contact" onclick="contactUser()">联系发布人</button>
            <?php } ?>


        </div>
        
        <!-- 申请提示区 -->
        <div class="apply-section">
            <h4>提示信息</h4>
            <p>点击"申请合租"按钮提交您的申请，发布人将收到通知并与您联系</p>
        </div>
        
        <!-- 房源信息 -->
        <div class="property-info">
            <h3 class="section-title">房源信息</h3>
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">联系人</span>
                    <span class="info-value"><?php echo $map["lianxiren"]; ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">联系方式</span>
                    <span class="info-value"><?php echo $map["lianxifangshi"]; ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">租赁时长</span>
                    <span class="info-value"><?php echo $map["zulinshichang"]; ?>/月</span>
                </div>
                <div class="info-item">
                    <span class="info-label">房屋地址</span>
                    <span class="info-value"><?php echo $map["fangwudizhi"]; ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">租赁类型</span>
                    <span class="info-value"><?php echo $map["zulinleixing"]; ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">是否有电梯</span>
                    <span class="info-value"><?php echo $map["shifouyoudianti"]; ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">房间数</span>
                    <span class="info-value"><?php echo $map["fangjianshu"]; ?></span>
                </div>

                <div class="info-item">
                    <span class="info-label">楼层</span>
                    <span class="info-value"><?php echo $map["louceng"]; ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">面积</span>
                    <span class="info-value"><?php echo $map["mianji"]; ?>㎡</span>
                </div>
                <div class="info-item">
                    <span class="info-label">房屋租金</span>
                    <span class="info-value">￥<?php echo $map["fangwuzujin"]; ?>/月</span>
                </div>
                <div class="info-item">
                    <span class="info-label">押金方式</span>
                    <span class="info-value"><?php echo $map["yajinfangshi"]; ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">分摊押金</span>
                    <span class="info-value"><?php echo $map["fentanzujin"]; ?></span>
                </div>
                <div class="info-item">
                    <span class="info-label">类型</span>
                    <span class="info-value">
                        <?php $mapfangwuleixing10 = db()->find("SELECT leixing,id FROM fangwuleixing where id='" . $map["leixing"] . "'"); ?>
                        <?php echo $mapfangwuleixing10["leixing"]; ?>
                    </span>
                </div>
                <div class="info-item">
                    <span class="info-label">设施</span>
                    <span class="info-value"><?php echo $map["sheshi"]; ?></span>
                </div>
            </div>
        </div>
        
        <!-- 标签页 -->
        <div class="tabs-container">
            <div class="tab-nav">
                <div class="tab-btn active" data-tab="yuanlaifangxinxi">原房信息</div>
                <div class="tab-btn" data-tab="zufangrenxinxi">租房人信息</div>
                <div class="tab-btn" data-tab="xiangqingmiaoshu">详情描述</div>
            </div>
            
            <div class="tab-content">
                <!-- 原房信息 -->
                <div id="yuanlaifangxinxi" class="tab-pane active">
                    <h3 class="section-title">原房源信息</h3>
                    <div class="similar-properties">
                        <?php $fangwuxinxilist29 = M("fangwuxinxi")->where("fangwubianhao", "=", $map["fangwubianhao"])->where("issh", "是")->limit(4)->order("id desc")->select(); ?>
                        <?php if(count($fangwuxinxilist29) > 0): ?>
                        <div class="properties-grid">
                            <?php foreach ($fangwuxinxilist29 as $r): ?>
                            <a href="fangwuxinxidetail.php?id=<?php echo $r["id"]; ?>" class="property-card-link">
                                <div class="property-card">
                                    <div class="property-image" style="background-image: url('<?php echo Info::images($r["fangwutupian"]); ?>');">
                                        <div class="property-price">￥<?php echo $r["fangwuzujin"]; ?>/月</div>
                                    </div>
                                    <div class="property-content">
                                        <h4 class="property-title"><?php echo $r["fangwubiaoti"]; ?></h4>
                                        <div class="property-desc"><?php echo Info::subStr($r["fangwuxiangqing"], 80); ?></div>
                                        <div class="property-features">
                                            <span class="feature-tag">
                                                <?php $mapfangwuleixing11 = db()->find("SELECT leixing,id FROM fangwuleixing where id='" . $r["leixing"] . "'"); ?>
                                                <?php echo $mapfangwuleixing11["leixing"]; ?>
                                            </span>
                                            <span class="feature-tag"><?php echo $r["xiaoqumingcheng"]; ?></span>
                                            <span class="feature-tag"><?php echo $r["fangwuhuxing"]; ?></span>
                                            <span class="feature-tag"><?php echo $r["louceng"]; ?>层</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <?php endforeach; ?>
                        </div>
                        <?php else: ?>
                        <p>暂无相关房源信息</p>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- 租房人信息 -->
                <div id="zufangrenxinxi" class="tab-pane">
                    <h3 class="section-title">租房人信息</h3>
                    <?php $yh = M("yonghu")->where("yonghuming", "=", $map["zulinyonghu"])->limit(1)->order("id desc")->select(); ?>
                    <?php foreach ($yh as $r): ?>
                    <div class="user-info-card">
                        <h4><?php echo $r["xingming"]; ?></h4>
                        <div class="user-info-grid">
                            <div class="info-item">
                                <span class="info-label">性别</span>
                                <span class="info-value"><?php echo $r["xingbie"]; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">手机</span>
                                <span class="info-value"><?php echo $r["shouji"]; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">邮箱</span>
                                <span class="info-value"><?php echo $r["youxiang"]; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">年龄</span>
                                <span class="info-value"><?php echo $r["nianling"]; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">学院/专业</span>
                                <span class="info-value"><?php echo $r["xueyuanzhuanye"]; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">所在城市</span>
                                <span class="info-value"><?php echo $r["suozaichengshi"]; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">年级</span>
                                <span class="info-value"><?php echo $r["nianji"]; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">国籍</span>
                                <span class="info-value"><?php echo $r["guoji"]; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">主要语言</span>
                                <span class="info-value"><?php echo $r["zhuyaoyuyan"]; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">作息类型</span>
                                <span class="info-value"><?php echo $r["zuoxileixing"]; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">在家时间</span>
                                <span class="info-value"><?php echo $r["zaijiashijian"]; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">固定安静时段需求</span>
                                <span class="info-value"><?php echo $r["gudinganjingshiduanxuqiu"]; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">自我整洁度</span>
                                <span class="info-value">
                                    <div class="star-rating" style="display: inline-block;">
                                        <?php for($i=1; $i<=5; $i++): ?>
                                            <?php if($i <= $r["ziwozhengjiedu"]): ?>
                                                <i class="glyphicon glyphicon-star"></i>
                                            <?php else: ?>
                                                <i class="glyphicon glyphicon-star-empty"></i>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    </div>
                                </span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">清洁频率偏好</span>
                                <span class="info-value"><?php echo $r["qingjiepinlvpianhao"]; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">是否参与轮值家务</span>
                                <span class="info-value"><?php echo $r["shifoucanyulunzhijiawu"]; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">公区整洁期望</span>
                                <span class="info-value"><?php echo $r["gongquzhengjieqiwang"]; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">是否接受清洁外包</span>
                                <span class="info-value"><?php echo $r["shifoujieshouqingjiewaibao"]; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">带同/异性回家</span>
                                <span class="info-value"><?php echo $r["daitongyixinghuijia"]; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">同/异性偶尔留宿</span>
                                <span class="info-value"><?php echo $r["tongyixingouerliusu"]; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">社交偏好</span>
                                <span class="info-value"><?php echo $r["shejiaopianhao"]; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">性别混住接受度</span>
                                <span class="info-value"><?php echo $r["xingbiehunzhujieshoudu"]; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">饮食习惯</span>
                                <span class="info-value"><?php echo $r["yinshixiguan"]; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">是否介意油烟/重口味</span>
                                <span class="info-value"><?php echo $r["shifoujieyiyouyanzhongkouwei"]; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">厨房使用频率</span>
                                <span class="info-value"><?php echo $r["chufangshiyongpinlv"]; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">冰箱与调味品共用</span>
                                <span class="info-value"><?php echo $r["bingxiangyutiaoweipingongyong"]; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">过敏/禁忌</span>
                                <span class="info-value"><?php echo $r["guominjinji"]; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">对音量容忍度</span>
                                <span class="info-value">
                                    <div class="star-rating" style="display: inline-block;">
                                        <?php for($i=1; $i<=5; $i++): ?>
                                            <?php if($i <= $r["duiyinliangrongrendu"]): ?>
                                                <i class="glyphicon glyphicon-star"></i>
                                            <?php else: ?>
                                                <i class="glyphicon glyphicon-star-empty"></i>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    </div>
                                </span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">吸烟</span>
                                <span class="info-value"><?php echo $r["xiyan"]; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">饮酒</span>
                                <span class="info-value"><?php echo $r["yinjiu"]; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">香水/香薰</span>
                                <span class="info-value"><?php echo $r["xiangshuixiangxun"]; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">是否介意气味</span>
                                <span class="info-value"><?php echo $r["shifoujieyiqiwei"]; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">是否有宠物</span>
                                <span class="info-value"><?php echo $r["shifouyouchongwu"]; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">对宠物接受度</span>
                                <span class="info-value"><?php echo $r["duichongwujieshoudu"]; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">押金与损耗处理规则</span>
                                <span class="info-value"><?php echo $r["yajinyusunhaochuliguize"]; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">支付方式</span>
                                <span class="info-value"><?php echo $r["zhifufangshi"]; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">共同采购与预算</span>
                                <span class="info-value"><?php echo $r["gongtongcaigouyuyusuan"]; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">性格</span>
                                <span class="info-value"><?php echo $r["xingge"]; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">兴趣</span>
                                <span class="info-value"><?php echo $r["xingqu"]; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">作息</span>
                                <span class="info-value"><?php echo $r["zuoxi"]; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">活动</span>
                                <span class="info-value"><?php echo $r["huodong"]; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">理想室友特质</span>
                                <span class="info-value"><?php echo $r["lixiangshiyoutezhi"]; ?></span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">其他需求</span>
                                <span class="info-value"><?php echo $r["qitaxuqiu"]; ?></span>
                            </div>
                        </div>
                        
                        <div class="contact-info">
                            <div>如需联系该用户，请直接通过上述联系方式联系</div>
                            <button class="btn-contact" onclick="contactUser()">联系用户</button>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                
                <!-- 详情描述 -->
                <div id="xiangqingmiaoshu" class="tab-pane">
                    <h3 class="section-title">详情描述</h3>
                    <div class="description-content">
                        <?php echo $map["hezumiaoshu"]; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/swiper/swiper.js"></script>
<script src="js/jquery.validate.js"></script>
<script src="js/rate/jquery.raty.min.js"></script>
<script>
    // 初始化Swiper
    <?php if(count($images) > 0): ?>
    var thumbsSwiper = new Swiper('#thumb-slider', {
        spaceBetween: 10,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesVisibility: true,
        watchSlidesProgress: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
    var gallerySwiper = new Swiper('#main-slider', {
        spaceBetween: 10,
        loop: <?php echo count($images) > 1 ? 'true' : 'false'; ?>,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        thumbs: {
            swiper: thumbsSwiper,
        }
    });
    <?php elseif(count($images) == 0): ?>
    var gallerySwiper = new Swiper('#main-slider', {
        spaceBetween: 10,
        loop: false,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        }
    });
    <?php endif; ?>
    
    // 标签页切换功能
    document.querySelectorAll('.tab-btn').forEach(button => {
        button.addEventListener('click', function() {
            // 移除所有激活状态
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            document.querySelectorAll('.tab-pane').forEach(pane => {
                pane.classList.remove('active');
            });
            
            // 添加当前激活状态
            this.classList.add('active');
            const tabId = this.getAttribute('data-tab');
            document.getElementById(tabId).classList.add('active');
        });
    });
    
    // 申请合租功能
    function applyToRoom() {
        // 检查用户是否已登录
        <?php if(isset($_SESSION['username']) || isset($_SESSION['user_id'])): ?>
        // 如果已登录，直接申请
        alert('已提交合租申请，请等待发布人回复！');
        <?php else: ?>
        // 如果未登录，提示登录
        if(confirm('申请合租需要登录，是否前往登录页面？')) {
            window.location.href = 'login.php';
        }
        <?php endif; ?>
    }
    
    // 联系用户功能
    function contactUser() {
        const contactMethod = "<?php echo $map['lianxifangshi']; ?>";
        alert('请联系发布人：' + contactMethod);
    }
    
    // 星级评分初始化
    document.querySelectorAll('.star-read').forEach(element => {
        const value = element.getAttribute('data-value');
        // 此处可以使用jquery.raty插件来显示星级评分
    });
</script>

<?php include "footer.php" ?>
<?php include "foot.php" ?>
</body>
</html>