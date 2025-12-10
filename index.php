<?php require_once 'initialize.php'; ?><?php include "head.php" ?>
<?php include "header.php" ?>

    <link rel="stylesheet" href="js/swiper/swiper.css">
    <script src="js/swiper/swiper.js"></script>


    <div>


        <div class=""><!-- 使用bootstrap css框架，container定宽，并剧中 https://v3.bootcss.com/css/#overview-container -->


            <?php $bhtList = M("lunbotu")->order("id desc")->limit(5)->select(); ?>

            <div class="swiper-container" id="base/banner262">
                <div class="swiper-wrapper">
                    <?php foreach ($bhtList as $bht) { ?>
                        <div class="swiper-slide">
                            <div class="decoimg_b2">
                                <a class="" href="<?php echo $bht["url"]; ?>"
                                   style="background-image: url('<?php echo $bht["image"]; ?>'); height: 520px"></a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <!-- 如果需要分页器 -->
                <div class="swiper-pagination"></div>
                <!-- 如果需要导航按钮 -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>


            <script>
                var mySwiper = new Swiper('#base/banner262', {
                    loop: true, // 循环模式选项
                    autoplay: {
                        delay: 3000,
                        disableOnInteraction: false
                    },
                    // 如果需要分页器
                    pagination: {
                        el: '.swiper-pagination',
                    },
                    // 如果需要前进后退按钮
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    // 如果需要滚动条
                    /*scrollbar: {
                        el: '.swiper-scrollbar',
                    },*/
                })
            </script>


            <!-- container定宽，并剧中结束 --></div>


    </div>


    <div>


        <div class="container"><!-- 使用bootstrap css框架，container定宽，并剧中 https://v3.bootcss.com/css/#overview-container -->


            <div class="title-sn-title-shinei">
                <div class="sn-title">
                        <span>
                最新发布            </span>
                </div>
                <div class="sn-content">


                    <?php $fangwuxinxilist268 = M("fangwuxinxi")->where("issh", "是")->where("fangwuzhuangtai", "待租")->limit(3)->order("id desc")->select(); ?>
                    <div class="properties-grid"
                         style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 25px; margin-top: 20px;">
                        <?php foreach ($fangwuxinxilist268 as $r) { ?>
                            <div class="property-card"
                                 style="background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.08); transition: all 0.3s ease; text-decoration: none; color: inherit;">
                                <a href="fangwuxinxidetail.php?id=<?php echo $r["id"]; ?>" style="display: block;">
                                    <div class="property-image"
                                         style="height: 200px; background-size: cover; background-position: center; position: relative; background-image: url('<?php echo Info::images($r["fangwutupian"]); ?>');">
                                        <div style="position: absolute; bottom: 10px; right: 10px; background: #e74c3c; color: white; padding: 5px 15px; border-radius: 20px; font-weight: bold;">
                                            ￥<?php echo $r["fangwuzujin"]; ?>/月
                                        </div>
                                    </div>
                                </a>
                                <div class="property-info" style="padding: 20px;">
                                    <a href="fangwuxinxidetail.php?id=<?php echo $r["id"]; ?>"
                                       style="text-decoration: none; color: inherit;">
                                        <div class="property-title"
                                             style="font-size: 18px; font-weight: bold; margin: 0 0 10px 0; color: #2c3e50;">
                                            <?php echo $r["fangwubiaoti"]; ?>
                                        </div>
                                    </a>
                                    <div class="property-description"
                                         style="color: #6c757d; font-size: 14px; margin-bottom: 15px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                        <?php echo Info::subStr($r["fangwuxiangqing"], 60); ?>
                                    </div>
                                    <div class="property-features"
                                         style="display: flex; flex-wrap: wrap; gap: 12px; margin-bottom: 15px;">
                                        <span class="feature-item"
                                              style="background: #eef2f7; padding: 6px 12px; border-radius: 20px; font-size: 13px; color: #495057;">
                                            <?php $mapfangwuleixing6 = db()->find("SELECT leixing,id FROM fangwuleixing where id='" . $r["leixing"] . "'"); ?>
                                            <?php echo $mapfangwuleixing6["leixing"]; ?>
                                        </span>
                                        <span class="feature-item"
                                              style="background: #eef2f7; padding: 6px 12px; border-radius: 20px; font-size: 13px; color: #495057;">
                                            <?php echo $r["xiaoqumingcheng"]; ?>
                                        </span>
                                        <span class="feature-item"
                                              style="background: #eef2f7; padding: 6px 12px; border-radius: 20px; font-size: 13px; color: #495057;">
                                            <?php echo $r["fangwuhuxing"]; ?>
                                        </span>
                                    </div>
                                    <div class="property-meta"
                                         style="display: flex; justify-content: space-between; align-items: center; padding-top: 15px; border-top: 1px solid #eee; color: #6c757d; font-size: 12px;">
                                        <span style="display: inline-block; max-width: 70%; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><?php echo $r["fangwudizhi"]; ?></span>
                                        <a href="fangwuxinxidetail.php?id=<?php echo $r["id"]; ?>"
                                           style="background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); color: white; padding: 6px 16px; border: none; border-radius: 20px; font-size: 12px; text-decoration: none;">
                                            详情
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>


                </div>
            </div>


            <!-- container定宽，并剧中结束 --></div>


    </div>


    <div>


        <div class="container"><!-- 使用bootstrap css框架，container定宽，并剧中 https://v3.bootcss.com/css/#overview-container -->


            <div class="title-sn-title-shinei">
                <div class="sn-title">
                        <span>
                热门房源            </span>
                </div>
                <div class="sn-content">


                    <?php $fangwuxinxilist274 = M("fangwuxinxi")->where("issh", "是")->where("fangwuzhuangtai", "待租")->limit(3)->order("shoucangliang desc")->select(); ?>
                    <div class="properties-grid"
                         style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 25px; margin-top: 20px;">
                        <?php foreach ($fangwuxinxilist274 as $r) { ?>
                            <div class="property-card"
                                 style="background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.08); transition: all 0.3s ease; text-decoration: none; color: inherit;">
                                <a href="fangwuxinxidetail.php?id=<?php echo $r["id"]; ?>" style="display: block;">
                                    <div class="property-image"
                                         style="height: 200px; background-size: cover; background-position: center; position: relative; background-image: url('<?php echo Info::images($r["fangwutupian"]); ?>');">
                                        <div style="position: absolute; bottom: 10px; right: 10px; background: #e74c3c; color: white; padding: 5px 15px; border-radius: 20px; font-weight: bold;">
                                            ￥<?php echo $r["fangwuzujin"]; ?>/月
                                        </div>
                                    </div>
                                </a>
                                <div class="property-info" style="padding: 20px;">
                                    <a href="fangwuxinxidetail.php?id=<?php echo $r["id"]; ?>"
                                       style="text-decoration: none; color: inherit;">
                                        <div class="property-title"
                                             style="font-size: 18px; font-weight: bold; margin: 0 0 10px 0; color: #2c3e50;">
                                            <?php echo $r["fangwubiaoti"]; ?>
                                        </div>
                                    </a>
                                    <div class="property-description"
                                         style="color: #6c757d; font-size: 14px; margin-bottom: 15px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                        <?php echo Info::subStr($r["fangwuxiangqing"], 60); ?>
                                    </div>
                                    <div class="property-features"
                                         style="display: flex; flex-wrap: wrap; gap: 12px; margin-bottom: 15px;">
                                        <span class="feature-item"
                                              style="background: #eef2f7; padding: 6px 12px; border-radius: 20px; font-size: 13px; color: #495057;">
                                            <?php $mapfangwuleixing6 = db()->find("SELECT leixing,id FROM fangwuleixing where id='" . $r["leixing"] . "'"); ?>
                                            <?php echo $mapfangwuleixing6["leixing"]; ?>
                                        </span>
                                        <span class="feature-item"
                                              style="background: #eef2f7; padding: 6px 12px; border-radius: 20px; font-size: 13px; color: #495057;">
                                            <?php echo $r["xiaoqumingcheng"]; ?>
                                        </span>
                                        <span class="feature-item"
                                              style="background: #eef2f7; padding: 6px 12px; border-radius: 20px; font-size: 13px; color: #495057;">
                                            <?php echo $r["fangwuhuxing"]; ?>
                                        </span>
                                    </div>
                                    <div class="property-meta"
                                         style="display: flex; justify-content: space-between; align-items: center; padding-top: 15px; border-top: 1px solid #eee; color: #6c757d; font-size: 12px;">
                                        <span style="display: inline-block; max-width: 70%; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><?php echo $r["fangwudizhi"]; ?></span>
                                        <a href="fangwuxinxidetail.php?id=<?php echo $r["id"]; ?>"
                                           style="background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); color: white; padding: 6px 16px; border: none; border-radius: 20px; font-size: 12px; text-decoration: none;">
                                            详情
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>


                </div>
            </div>


            <!-- container定宽，并剧中结束 --></div>


    </div>

    <div>


        <div class="container"><!-- 使用bootstrap css框架，container定宽，并剧中 https://v3.bootcss.com/css/#overview-container -->


            <div class="title-sn-title-shinei">
                <div class="sn-title">
                        <span>
                最新合租信息            </span>
                </div>
                <div class="sn-content">


                    <?php $fz = M("fenzuxinxi")->where("issh", "是")->limit(3)->order("id desc")->select(); ?>
                    <div class="properties-list" style="display: flex; flex-direction: column; gap: 25px;">
                        <?php foreach ($fz as $r) { ?>
                            <div class="property-card"
                                 style="background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.08); display: flex; flex-direction: row; transition: all 0.3s ease; text-decoration: none; color: inherit;">
                                <a href="fenzuxinxidetail.php?id=<?php echo $r["id"]; ?>"
                                   style="display: block; width: 300px; height: 200px; flex-shrink: 0; text-decoration: none; color: inherit;">
                                    <div class="property-image"
                                         style="width: 300px; height: 200px; background-size: cover; background-position: center; flex-shrink: 0; background-image: url('<?php echo Info::images($r["fangwutupian"]); ?>');"></div>
                                </a>
                                <div class="property-content" style="padding: 25px; flex: 1;">
                                    <a href="fenzuxinxidetail.php?id=<?php echo $r["id"]; ?>"
                                       style="text-decoration: none; color: inherit;">
                                        <h3 class="property-title"
                                            style="font-size: 20px; font-weight: bold; margin: 0 0 12px 0; color: #2c3e50;"><?php echo $r["biaoti"]; ?></h3>
                                    </a>
                                    <p class="property-description"
                                       style="color: #6c757d; margin-bottom: 15px; line-height: 1.6;"><?php echo Info::subStr($r["hezumiaoshu"], 120); ?></p>

                                    <div class="property-features"
                                         style="display: flex; flex-wrap: wrap; gap: 12px; margin-bottom: 15px;">
                                        <span class="feature-item"
                                              style="background: #eef2f7; padding: 6px 12px; border-radius: 20px; font-size: 13px; color: #495057;">房屋户型：<?php echo $r["fangwuhuxing"]; ?></span>
                                        <span class="feature-item"
                                              style="background: #eef2f7; padding: 6px 12px; border-radius: 20px; font-size: 13px; color: #495057;">小区名称：<?php echo $r["xiaoqumingcheng"]; ?></span>
                                        <span class="feature-item"
                                              style="background: #eef2f7; padding: 6px 12px; border-radius: 20px; font-size: 13px; color: #495057;">押金方式：<?php echo $r["yajinfangshi"]; ?></span>
                                        <span class="feature-item"
                                              style="background: #eef2f7; padding: 6px 12px; border-radius: 20px; font-size: 13px; color: #495057;">是否有电梯：<?php echo $r["shifouyoudianti"]; ?></span>
                                        <span class="feature-item"
                                              style="background: #eef2f7; padding: 6px 12px; border-radius: 20px; font-size: 13px; color: #495057;">租赁类型：<?php echo $r["zulinleixing"]; ?></span>
                                        <span class="feature-item"
                                              style="background: #eef2f7; padding: 6px 12px; border-radius: 20px; font-size: 13px; color: #495057;">租赁时长：<?php echo $r["zulinshichang"]; ?>/月</span>
                                    </div>

                                    <div class="property-meta"
                                         style="display: flex; justify-content: space-between; align-items: center; padding-top: 15px; border-top: 1px solid #eee; color: #6c757d;">
                                        <div class="property-price"
                                             style="font-size: 22px; font-weight: bold; color: #e74c3c;">
                                            ￥<?php echo $r["fentanzujin"]; ?>/月
                                        </div>
                                        <a href="fenzuxinxidetail.php?id=<?php echo $r["id"]; ?>"
                                           style="background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); color: white; padding: 8px 20px; border: none; border-radius: 25px; cursor: pointer; font-weight: 500; transition: all 0.3s ease; text-decoration: none; display: inline-block;">查看详情</a>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>


                </div>
            </div>


            <!-- container定宽，并剧中结束 --></div>


    </div>


<?php include "footer.php" ?>
<?php include "foot.php" ?>