<?php require_once 'initialize.php'; ?><?php if (empty($_GET['id'])) {
    showMessage('没找到相关详情页面');
}

$map = M("fangwuxinxi")->where("id", $_GET['id'])->find();

if (empty($map)) {
    showMessage('没找到相关详情页面');
}

db()->query("UPDATE fangwuxinxi SET liulanliang = liulanliang+1 WHERE id='" . $_GET["id"] . "'");


?>
<?php include "head.php" ?>
<?php include "header.php" ?>

    <link rel="stylesheet" href="js/swiper/swiper.css">
    <script src="js/swiper/swiper.js"></script>
    <script src="js/jquery.validate.js"></script>
    <script src="js/rate/jquery.raty.min.js"></script>


    <style>
        .property-detail-container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 15px;
        }

        .property-header {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .property-title {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 15px;
        }

        .property-image-section {
            margin-bottom: 30px;
            position: relative;
        }

        .property-main-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .property-thumbnails {
            display: flex;
            gap: 10px;
            overflow-x: auto;
            padding: 10px 0;
        }

        .property-thumb {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 4px;
            cursor: pointer;
            border: 2px solid transparent;
            transition: all 0.3s ease;
            opacity: 0.7;
        }

        .property-thumb:hover {
            opacity: 1;
            transform: scale(1.05);
        }

        .property-thumb.active {
            border-color: #007bff;
            opacity: 1;
            box-shadow: 0 2px 8px rgba(0, 123, 255, 0.3);
        }

        .image-counter {
            position: absolute;
            top: 15px;
            right: 15px;
            background-color: rgba(0, 0, 0, 0.6);
            color: white;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 14px;
            z-index: 10;
        }

        .property-info-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 25px;
            margin-bottom: 20px;
        }

        .property-attributes {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 15px;
        }

        .attribute-item {
            display: flex;
            flex-direction: column;
        }

        .attribute-label {
            font-weight: bold;
            color: #555;
            margin-bottom: 5px;
        }

        .attribute-value {
            color: #333;
            padding: 5px 0;
        }

        .property-description {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 25px;
            margin-bottom: 20px;
        }

        .property-description h3 {
            font-size: 20px;
            margin-bottom: 15px;
            color: #333;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }

        .property-description-content {
            line-height: 1.8;
            color: #555;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            margin-top: 20px;
            flex-wrap: wrap;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-outline-primary {
            color: #007bff;
            border-color: #007bff;
        }

        .btn-collect {
            display: flex;
            align-items: center;
            gap: 5px;
            transition: all 0.3s ease;
        }

        .btn-collect:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-collect.collected {
            background-color: #dc3545;
            border-color: #dc3545;
            color: white;
        }

        .btn-collect.collected:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }

        .collect-icon {
            font-size: 16px;
        }

        .comment-section {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 25px;
            margin-top: 20px;
        }

        .comment-section h3 {
            font-size: 20px;
            margin-bottom: 20px;
            color: #333;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
            display: flex;
            align-items: center;
        }

        .comment-section h3::before {
            content: "";
            display: inline-block;
            width: 4px;
            height: 20px;
            background-color: #007bff;
            margin-right: 10px;
            border-radius: 2px;
        }

        .comment-form {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
        }

        .comment-input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            resize: vertical;
            min-height: 100px;
            font-size: 14px;
        }

        .comment-input:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
        }

        .comment-list {
            margin-top: 20px;
        }

        .comment-item {
            padding: 20px;
            border-bottom: 1px solid #eee;
            transition: background-color 0.2s;
        }

        .comment-item:hover {
            background-color: #f8f9fa;
            border-radius: 8px;
        }

        .comment-item:last-child {
            border-bottom: none;
        }

        .comment-header {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .comment-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            margin-right: 12px;
            object-fit: cover;
            border: 2px solid #e9ecef;
        }

        .comment-user {
            font-weight: bold;
            color: #333;
            font-size: 16px;
        }

        .comment-time {
            color: #999;
            font-size: 12px;
            margin-left: 15px;
        }

        .comment-content {
            color: #555;
            line-height: 1.7;
            font-size: 15px;
        }

        .no-comments {
            text-align: center;
            color: #999;
            font-style: italic;
            padding: 30px 0;
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
    </style>

    <div class="property-detail-container">
        <div class="property-header">
            <h1 class="property-title"><?php echo $map["fangwubiaoti"]; ?>( <span
                        style="color: #0ac265"><?php echo $map["zulinleixing"]; ?> / <?php echo $map["fangwuzhuangtai"]; ?> </span> )</h1>

            <div class="rent-price">
                <span class="rent-label">租金：</span>
                <?php echo $map["fangwuzujin"]; ?>元/月
            </div>

            <div class="action-buttons">
                <?php $shoucangCount = M("shoucang")->where("biao", "fangwuxinxi")->where("xwid", $map["id"])->field("count(*) as count")->find(); ?>
                <?php if ($_SESSION["username"] != null && "" != $_SESSION["username"]) { ?>
                    <?php $shoucang = M("shoucang")->where("biao", "fangwuxinxi")->where("xwid", $map["id"])->where("username", $_SESSION["username"])->field("count(*) as count")->find(); ?>

                    <button type="button" class="btn btn-default btn-collects-click"
                            data-url="shoucang.php?a=insert&xwid=<?php echo $map["id"]; ?>&biao=fangwuxinxi&biaoti=<?php echo $map["fangwubiaoti"]; ?>"
                            data-confirm="取消收藏" data-text="收藏" data-is-zan="<?php echo $shoucang["count"]; ?>"
                            data-count="<?php echo $shoucangCount["count"]; ?>">


                    </button>
                <?php } else { ?>
                    <button type="button" class="btn btn-default btn-xs" onclick="alert('请登录后操作')">

                        收藏 <span class="badge">
            <?php echo $shoucangCount["count"]; ?>
        </span>

                    </button>
                <?php } ?>

                <script>
                    encodeURIComponent(location.href);


                </script>


                <?php if ($map["fangwuzhuangtai"] == '待租' && $_SESSION["cx"] == "用户") { ?>

                    <a class="btn btn-info " href="zulinadd.php?id=<?php echo $map["id"]; ?>">
                        申请租赁 </a>
                <?php } ?>


                <?php if ($_SESSION["cx"] == "用户") { ?>
                    <a href="siliaoadd.php?id=<?php echo $map["id"]; ?>&shouxinren=<?php echo $map["faburen"]; ?>"
                       class="btn btn-primary">
                        联系房东
                    </a>
                <?php } ?>


            </div>
        </div>

        <div class="property-image-section">
            <?php
            $images = explode(",", $map["fangwutupian"]);
            $mainImage = $images[0]; // 默认第一张为主图
            ?>

            <?php if ($mainImage): ?>
                <div class="image-counter">
                    <span id="currentImageIndex">1</span> / <?php echo count($images); ?>
                </div>
                <img src="<?php echo $mainImage; ?>" alt="房源图片" class="property-main-image" id="mainImage">
            <?php else: ?>
                <img src="images/default.gif" alt="默认图片" class="property-main-image" id="mainImage">
            <?php endif; ?>

            <?php if (count($images) > 1): ?>
                <div class="property-thumbnails" id="thumbnails">
                    <?php foreach ($images as $index => $img): ?>
                        <img
                                src="<?php echo $img; ?>"
                                alt="房源缩略图"
                                class="property-thumb <?php echo $index === 0 ? 'active' : ''; ?>"
                                data-index="<?php echo $index; ?>"
                                data-src="<?php echo $img; ?>"
                        >
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="property-info-card">
            <div class="property-attributes">
                <div class="attribute-item">
                    <span class="attribute-label">房屋类型</span>
                    <span class="attribute-value">
                        <?php $mapfangwuleixing8 = db()->find("SELECT leixing,id FROM fangwuleixing where id='" . $map["leixing"] . "'"); ?>
                        <?php echo $mapfangwuleixing8["leixing"]; ?>
                    </span>
                </div>

                <div class="attribute-item">
                    <span class="attribute-label">小区名称</span>
                    <span class="attribute-value"><?php echo $map["xiaoqumingcheng"]; ?></span>
                </div>

                <div class="attribute-item">
                    <span class="attribute-label">房屋户型</span>
                    <span class="attribute-value"><?php echo $map["fangwuhuxing"]; ?></span>
                </div>

                <div class="attribute-item">
                    <span class="attribute-label">楼层</span>
                    <span class="attribute-value"><?php echo $map["louceng"]; ?></span>
                </div>

                <div class="attribute-item">
                    <span class="attribute-label">面积</span>
                    <span class="attribute-value"><?php echo $map["mianji"]; ?>㎡</span>
                </div>

                <div class="attribute-item">
                    <span class="attribute-label">是否有电梯</span>
                    <span class="attribute-value"><?php echo $map["shifouyoudianti"]; ?>㎡</span>
                </div>

                <div class="attribute-item">
                    <span class="attribute-label">租赁类型</span>
                    <span class="attribute-value"><?php echo $map["zulinleixing"]; ?>㎡</span>
                </div>

                <div class="attribute-item">
                    <span class="attribute-label">押金方式</span>
                    <span class="attribute-value"><?php echo $map["yajinfangshi"]; ?></span>
                </div>
                <div class="attribute-item">
                    <span class="attribute-label">房屋租金</span>
                    <span class="attribute-value"><?php echo $map["fangwuzujin"]; ?></span>
                </div>

                <div class="attribute-item">
                    <span class="attribute-label">距离学校</span>
                    <span class="attribute-value"><?php echo $map["julixuexiao"]; ?></span>
                </div>

                <div class="attribute-item">
                    <span class="attribute-label">房屋地址</span>
                    <span class="attribute-value"><?php echo $map["fangwudizhi"]; ?></span>
                </div>

                <div class="attribute-item">
                    <span class="attribute-label">联系电话</span>
                    <span class="attribute-value"><?php echo $map["lianxidianhua"]; ?></span>
                </div>

                <div class="attribute-item">
                    <span class="attribute-label">发布人</span>
                    <span class="attribute-value"><?php echo $map["faburen"]; ?></span>
                </div>

                <div class="attribute-item">
                    <span class="attribute-label">房屋状态</span>
                    <span class="attribute-value"><?php echo $map["fangwuzhuangtai"]; ?></span>
                </div>

                <div class="attribute-item">
                    <span class="attribute-label">房间数</span>
                    <span class="attribute-value"><?php echo $map["fangjianshu"]; ?>间</span>
                </div>


                <div class="attribute-item">
                    <span class="attribute-label">最短租期</span>
                    <span class="attribute-value"><?php echo $map["zuiduanzuqi"]; ?>月</span>
                </div>
                <div class="attribute-item">
                    <span class="attribute-label">浏览量</span>
                    <span class="attribute-value"><?php echo $map["liulanliang"]; ?></span>
                </div>
            </div>

            <div class="attribute-item" style="grid-column: 1 / -1;">
                <span class="attribute-label">设施</span>
                <span class="attribute-value"><?php echo $map["sheshi"]; ?></span>
            </div>
        </div>


        <div class="title-modelbox-widget">
            <h3 class="section-title">
                房间信息        </h3>
            <div class="sidebar-widget-body">



                <div class="">
                    <?php $fangjianxinxilist30 = M("fangjianxinxi")->where("fangwuxinxiid", "=", $_GET["id"])->limit(99)->order("id desc")->select(); ?>                <div class="news-list">
                        <ul>
                            <?php  foreach($fangjianxinxilist30 as $r){  ?>
                                <li class="clearfix">
                                    <a href="fangjianxinxidetail.php?id=<?php echo $r["id"]; ?>">
                                        <div class="thumb">
                                            <div class="img-box pb100">
                                                <div class="img" style="background-image: url('<?php echo Info::images($r["fangjiantupian"]); ?>')"></div>
                                            </div>
                                        </div>
                                    </a>

                                    <div class="news-content-text ">
                                        <a href="fangjianxinxidetail.php?id=<?php echo $r["id"]; ?>">
                                            <h3><?php echo $r["fangjianmingcheng"]; ?></h3>
                                        </a>
                                        <div class="description">
                                            <?php echo Info::subStr($r["fangjianxiangqing"], 80); ?>
                                        </div>
                                        <div class="other-content">
                                            <span>状态：<?php echo $r["zhuangtai"]; ?></span>
                                            <span>面积：<?php echo $r["mianji"]; ?></span>

                                            <?php if ($map["zulinleixing"] == '分租'){?>
                                                <span >单租价格：<?php echo $r["danjianjiage"]; ?></span>
                                            <?php }?>

                                        </div>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>


            </div>
            <!-- /.sidebar-widget-body -->
        </div>

        <div class="property-description" style="margin-top: 20px">
            <h3>房源详情</h3>
            <div class="property-description-content">
                <?php echo $map["fangwuxiangqing"]; ?>
            </div>
        </div>

        <div class="comment-section">
            <h3>用户评论</h3>

            <div class="comment-form">
                <form action="pinglun.php?a=insert" method="post">
                    <div class="form-group">
                        <textarea class="comment-input" name="pinglunneirong" placeholder="请输入评论内容..."></textarea>
                    </div>
                    <input type="hidden" name="biao" value="fangwuxinxi"/>
                    <input name="biaoid" type="hidden" id="biaoid" value="<?php echo $_GET["id"]; ?>"/>
                    <input name="biaoti" type="hidden" id="biaoti" value="<?php echo $map["fangwubiaoti"]; ?>"/>
                    <input name="faburen" type="hidden" id="faburen" value="<?php echo $map["faburen"]; ?>"/>
                    <input name="pinglunren" type="hidden" value="<?php echo $_SESSION["username"]; ?>"/>
                    <input type="hidden" class="referer_href" id="referer" name="referer" value=""/>
                    <script>
                        $(function () {
                            $('.referer_href').val(location.href)
                        });
                    </script>

                    <div style="text-align: left">
                        <button type="submit" class="btn btn-primary">发布评论</button>
                    </div>
                </form>
            </div>

            <div class="comment-list">
                <?php $pinglunList = M("pinglun")->where("biao", "fangwuxinxi")->where("biaoid", $_GET["id"])->order("id desc")->select(); ?>

                <?php if (count($pinglunList) > 0): ?>
                    <?php foreach ($pinglunList as $pl): ?>
                        <?php $user = M("yonghu")->where("yonghuming", $pl["pinglunren"])->find(); ?>

                        <div class="comment-item">
                            <div class="comment-header">
                                <img src="<?php echo $user["touxiang"] ? $user["touxiang"] : 'images/default.gif'; ?>"
                                     alt="用户头像" class="comment-avatar">
                                <span class="comment-user"><?php echo $user["yonghuming"]; ?></span>
                                <span class="comment-time"><?php echo $pl["addtime"]; ?></span>
                            </div>
                            <div class="comment-content"><?php echo $pl["pinglunneirong"]; ?></div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="no-comments">
                        <p>暂无评论，快来抢沙发吧！</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
        // 图片缩略图切换功能
        document.addEventListener('DOMContentLoaded', function () {
            const thumbnails = document.querySelectorAll('.property-thumb');
            const mainImage = document.getElementById('mainImage');
            const currentImageIndex = document.getElementById('currentImageIndex');

            // 如果存在缩略图，初始化功能
            if (thumbnails.length > 0) {
                thumbnails.forEach((thumb, index) => {
                    thumb.addEventListener('click', function () {
                        // 移除所有激活状态
                        thumbnails.forEach(t => t.classList.remove('active'));
                        // 添加当前激活状态
                        this.classList.add('active');
                        // 更新主图
                        mainImage.src = this.getAttribute('data-src');
                        // 更新图片计数器
                        if (currentImageIndex) {
                            currentImageIndex.textContent = parseInt(this.getAttribute('data-index')) + 1;
                        }
                    });
                });

                // 键盘左右箭头支持
                document.addEventListener('keydown', function (e) {
                    if (e.key === 'ArrowLeft' || e.key === 'ArrowRight') {
                        let currentIndex = 0;
                        thumbnails.forEach((thumb, index) => {
                            if (thumb.classList.contains('active')) {
                                currentIndex = index;
                            }
                        });

                        let nextIndex;
                        if (e.key === 'ArrowLeft') {
                            nextIndex = (currentIndex - 1 + thumbnails.length) % thumbnails.length;
                        } else {
                            nextIndex = (currentIndex + 1) % thumbnails.length;
                        }

                        // 触发下一张图片的点击事件
                        if (thumbnails[nextIndex]) {
                            thumbnails[nextIndex].click();
                        }
                    }
                });
            }

            // 初始化Swiper（保持原有的Swiper功能以兼容现有代码）
            (function () {
                var images = "<?php echo $map["fangwutupian"]; ?>".split(",");
                if (images.length > 0) {
                    for (var i = 0; i < images.length; i++) {
                        var path = images[i]
                        var src = '<div class="swiper-slide"><div class="img-box pb100"><div class="img" style="background-image: url(' + path + ')"></div></div></div>';
                        $('#shangpin-galler .swiper-wrapper').append(src);
                        $('#shangpin-thumb .swiper-wrapper').append(src);
                    }

                    var thumbsSwiper = new Swiper('#shangpin-thumb', {
                        spaceBetween: 10,
                        slidesPerView: 4,
                        watchSlidesVisibility: true,//防止不可点击
                    })
                    var gallerySwiper = new Swiper('#shangpin-galler', {
                        spaceBetween: 10,
                        thumbs: {
                            swiper: thumbsSwiper,
                        }
                    })
                }

            })();


        });
    </script>

<?php include "footer.php" ?>
<?php include "foot.php" ?>