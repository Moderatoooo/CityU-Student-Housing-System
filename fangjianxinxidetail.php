<?php  require_once 'initialize.php';  ?><?php if(empty($_GET['id'])){
    showMessage('没找到相关详情页面');
}

$map = M("fangjianxinxi")->where("id" , $_GET['id'])->find();

if(empty($map)){
    showMessage('没找到相关详情页面');
}


?> 
<?php include "head.php" ?>
<?php include "header.php" ?>
<link rel="stylesheet" href="js/swiper/swiper.css">
    <script src="js/swiper/swiper.js"></script>
<script src="js/jquery.validate.js"></script>




<div>

    
<div class="container"><!-- 使用bootstrap css框架，container定宽，并剧中 https://v3.bootcss.com/css/#overview-container -->

                    

    
<div class="title-modelbox-widget">
        <h3 class="section-title">
                        房间详情        </h3>
        <div class="sidebar-widget-body">
            

<div class="">
    <div class="goods-info clearfix">
        <div class="gallery-list">
            <div class="swiper-container gallery-top" id="shangpin-galler">
                <div class="swiper-wrapper">
                </div>
            </div>
            <div class="swiper-container gallery-thumbs" id="shangpin-thumb">
                <div class="swiper-wrapper">
                </div>
            </div>
        </div>
        <div class="goods-right-content">
            <h3 class="title"><?php echo $map["fangwubiaoti"]; ?></h3>
            <div class="descount">
                                    <div>
                        <span class="name">
                            类型：
                        </span>
                        <span class="val">
                            <?php  $mapfangwuleixing7 = db()->find("SELECT leixing,id FROM fangwuleixing where id='".$map["leixing"]."'");  ?><?php echo $mapfangwuleixing7["leixing"]; ?>                        </span>
                    </div>
                                    <div>
                        <span class="name">
                            小区名称：
                        </span>
                        <span class="val">
                            <?php echo $map["xiaoqumingcheng"]; ?>                        </span>
                    </div>
                                    <div>
                        <span class="name">
                            房屋户型：
                        </span>
                        <span class="val">
                            <?php echo $map["fangwuhuxing"]; ?>                        </span>
                    </div>
                                    <div>
                        <span class="name">
                            楼层：
                        </span>
                        <span class="val">
                            <?php echo $map["louceng"]; ?>                        </span>
                    </div>
                                    <div>
                        <span class="name">
                            租赁类型：
                        </span>
                        <span class="val">
                            <?php echo $map["zulinleixing"]; ?>                        </span>
                    </div>
                                    <div>
                        <span class="name">
                            单间价格：
                        </span>
                        <span class="val">
                            <?php echo $map["danjianjiage"]; ?>                        </span>
                    </div>
                                    <div>
                        <span class="name">
                            状态：
                        </span>
                        <span class="val">
                            <?php echo $map["zhuangtai"]; ?>                        </span>
                    </div>
                            </div>

                    </div>
    </div>
    <div class="goods-content">
        <?php echo $map["fangjianxiangqing"]; ?>    </div>

    <script>
        (function () {
            var images = "<?php echo $map["fangjiantupian"]; ?>".split(",");
            if(images.length>0){
                for (var i=0;i < images.length;i++){
                    var path = images[i]
                    var src = '<div class="swiper-slide"><div class="img-box pb100"><div class="img" style="background-image: url('+path+')"></div></div></div>';
                    $('#shangpin-galler .swiper-wrapper').append(src);
                    $('#shangpin-thumb .swiper-wrapper').append(src);
                }

                var thumbsSwiper = new Swiper('#shangpin-thumb',{
                    spaceBetween: 10,
                    slidesPerView: 4,
                    watchSlidesVisibility: true,//防止不可点击
                })
                var gallerySwiper = new Swiper('#shangpin-galler',{
                    spaceBetween: 10,
                    thumbs: {
                        swiper: thumbsSwiper,
                    }
                })
            }

        })();

    </script>

</div>


        </div>
        <!-- /.sidebar-widget-body -->
    </div>


        
    
<!-- container定宽，并剧中结束 --></div>


</div>


<?php include "footer.php" ?>
<?php include "foot.php" ?>