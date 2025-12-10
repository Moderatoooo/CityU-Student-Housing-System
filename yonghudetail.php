<?php  require_once 'initialize.php';  ?><?php if(empty($_GET['id'])){
    showMessage('没找到相关详情页面');
}

$map = M("yonghu")->where("id" , $_GET['id'])->find();

if(empty($map)){
    showMessage('没找到相关详情页面');
}


?> 
<?php include "head.php" ?>
<?php include "header.php" ?>
<link rel="stylesheet" href="js/swiper/swiper.css">
    <script src="js/swiper/swiper.js"></script>
<script src="js/jquery.validate.js"></script>
<script src="js/rate/jquery.raty.min.js"></script>




<div>

    
<div class="container"><!-- 使用bootstrap css框架，container定宽，并剧中 https://v3.bootcss.com/css/#overview-container -->

                    

    
<div class="title-sn-title-shinei">
        <div class="sn-title">
                        <span>
                用户信息            </span>
        </div>
        <div class="sn-content">
            

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
            <h3 class="title"><?php echo $map["xingming"]; ?></h3>
            <div class="descount">
                                    <div>
                        <span class="name">
                            性别：
                        </span>
                        <span class="val">
                            <?php echo $map["xingbie"]; ?>                        </span>
                    </div>
                                    <div>
                        <span class="name">
                            手机：
                        </span>
                        <span class="val">
                            <?php echo $map["shouji"]; ?>                        </span>
                    </div>
                                    <div>
                        <span class="name">
                            邮箱：
                        </span>
                        <span class="val">
                            <?php echo $map["youxiang"]; ?>                        </span>
                    </div>
                                    <div>
                        <span class="name">
                            年龄：
                        </span>
                        <span class="val">
                            <?php echo $map["nianling"]; ?>                        </span>
                    </div>
                                    <div>
                        <span class="name">
                            所在城市：
                        </span>
                        <span class="val">
                            <?php echo $map["suozaichengshi"]; ?>                        </span>
                    </div>
                                    <div>
                        <span class="name">
                            年级：
                        </span>
                        <span class="val">
                            <?php echo $map["nianji"]; ?>                        </span>
                    </div>
                                    <div>
                        <span class="name">
                            学院/专业：
                        </span>
                        <span class="val">
                            <?php echo $map["xueyuanzhuanye"]; ?>                        </span>
                    </div>
                                    <div>
                        <span class="name">
                            国籍：
                        </span>
                        <span class="val">
                            <?php echo $map["guoji"]; ?>                        </span>
                    </div>
                                    <div>
                        <span class="name">
                            主要语言：
                        </span>
                        <span class="val">
                            <?php echo $map["zhuyaoyuyan"]; ?>                        </span>
                    </div>
                                    <div>
                        <span class="name">
                            作息类型：
                        </span>
                        <span class="val">
                            <?php echo $map["zuoxileixing"]; ?>                        </span>
                    </div>
                                    <div>
                        <span class="name">
                            在家时间：
                        </span>
                        <span class="val">
                            <?php echo $map["zaijiashijian"]; ?>                        </span>
                    </div>
                                    <div>
                        <span class="name">
                            固定安静时段需求：
                        </span>
                        <span class="val">
                            <?php echo $map["gudinganjingshiduanxuqiu"]; ?>                        </span>
                    </div>
                                    <div>
                        <span class="name">
                            自我整洁度：
                        </span>
                        <span class="val">
                            <span class="star-read" data-value="<?php echo $map["ziwozhengjiedu"]; ?>"></span>                        </span>
                    </div>
                                    <div>
                        <span class="name">
                            清洁频率偏好：
                        </span>
                        <span class="val">
                            <?php echo $map["qingjiepinlvpianhao"]; ?>                        </span>
                    </div>
                                    <div>
                        <span class="name">
                            是否参与轮值家务：
                        </span>
                        <span class="val">
                            <?php echo $map["shifoucanyulunzhijiawu"]; ?>                        </span>
                    </div>
                                    <div>
                        <span class="name">
                            公区整洁期望：
                        </span>
                        <span class="val">
                            <pre style="padding: 5px;background: none;border: none;margin: 0;"><?php echo $map["gongquzhengjieqiwang"]; ?></pre>                        </span>
                    </div>
                                    <div>
                        <span class="name">
                            是否接受清洁外包：
                        </span>
                        <span class="val">
                            <?php echo $map["shifoujieshouqingjiewaibao"]; ?>                        </span>
                    </div>
                                    <div>
                        <span class="name">
                            带同/异性回家：
                        </span>
                        <span class="val">
                            <?php echo $map["daitongyixinghuijia"]; ?>                        </span>
                    </div>
                                    <div>
                        <span class="name">
                            同/异性偶尔留宿：
                        </span>
                        <span class="val">
                            <?php echo $map["tongyixingouerliusu"]; ?>                        </span>
                    </div>
                                    <div>
                        <span class="name">
                            社交偏好：
                        </span>
                        <span class="val">
                            <?php echo $map["shejiaopianhao"]; ?>                        </span>
                    </div>
                                    <div>
                        <span class="name">
                            性别混住接受度：
                        </span>
                        <span class="val">
                            <?php echo $map["xingbiehunzhujieshoudu"]; ?>                        </span>
                    </div>
                                    <div>
                        <span class="name">
                            饮食习惯：
                        </span>
                        <span class="val">
                            <?php echo $map["yinshixiguan"]; ?>                        </span>
                    </div>
                                    <div>
                        <span class="name">
                            是否介意油烟/重口味：
                        </span>
                        <span class="val">
                            <?php echo $map["shifoujieyiyouyanzhongkouwei"]; ?>                        </span>
                    </div>
                                    <div>
                        <span class="name">
                            厨房使用频率：
                        </span>
                        <span class="val">
                            <?php echo $map["chufangshiyongpinlv"]; ?>                        </span>
                    </div>
                                    <div>
                        <span class="name">
                            冰箱与调味品共用：
                        </span>
                        <span class="val">
                            <?php echo $map["bingxiangyutiaoweipingongyong"]; ?>                        </span>
                    </div>
                                    <div>
                        <span class="name">
                            过敏/禁忌：
                        </span>
                        <span class="val">
                            <pre style="padding: 5px;background: none;border: none;margin: 0;"><?php echo $map["guominjinji"]; ?></pre>                        </span>
                    </div>
                                    <div>
                        <span class="name">
                            对音量容忍度：
                        </span>
                        <span class="val">
                            <span class="star-read" data-value="<?php echo $map["duiyinliangrongrendu"]; ?>"></span>                        </span>
                    </div>
                                    <div>
                        <span class="name">
                            吸烟：
                        </span>
                        <span class="val">
                            <?php echo $map["xiyan"]; ?>                        </span>
                    </div>
                                    <div>
                        <span class="name">
                            饮酒：
                        </span>
                        <span class="val">
                            <?php echo $map["yinjiu"]; ?>                        </span>
                    </div>
                                    <div>
                        <span class="name">
                            香水/香薰：
                        </span>
                        <span class="val">
                            <?php echo $map["xiangshuixiangxun"]; ?>                        </span>
                    </div>
                                    <div>
                        <span class="name">
                            是否介意气味：
                        </span>
                        <span class="val">
                            <?php echo $map["shifoujieyiqiwei"]; ?>                        </span>
                    </div>
                                    <div>
                        <span class="name">
                            是否有宠物：
                        </span>
                        <span class="val">
                            <?php echo $map["shifouyouchongwu"]; ?>                        </span>
                    </div>
                                    <div>
                        <span class="name">
                            对宠物接受度：
                        </span>
                        <span class="val">
                            <?php echo $map["duichongwujieshoudu"]; ?>                        </span>
                    </div>
                                    <div>
                        <span class="name">
                            押金与损耗处理规则：
                        </span>
                        <span class="val">
                            <pre style="padding: 5px;background: none;border: none;margin: 0;"><?php echo $map["yajinyusunhaochuliguize"]; ?></pre>                        </span>
                    </div>
                                    <div>
                        <span class="name">
                            支付方式：
                        </span>
                        <span class="val">
                            <?php echo $map["zhifufangshi"]; ?>                        </span>
                    </div>
                                    <div>
                        <span class="name">
                            共同采购与预算：
                        </span>
                        <span class="val">
                            <?php echo $map["gongtongcaigouyuyusuan"]; ?>                        </span>
                    </div>
                                    <div>
                        <span class="name">
                            性格：
                        </span>
                        <span class="val">
                            <?php echo $map["xingge"]; ?>                        </span>
                    </div>
                                    <div>
                        <span class="name">
                            兴趣：
                        </span>
                        <span class="val">
                            <?php echo $map["xingqu"]; ?>                        </span>
                    </div>
                                    <div>
                        <span class="name">
                            作息：
                        </span>
                        <span class="val">
                            <?php echo $map["zuoxi"]; ?>                        </span>
                    </div>
                                    <div>
                        <span class="name">
                            活动：
                        </span>
                        <span class="val">
                            <?php echo $map["huodong"]; ?>                        </span>
                    </div>
                                    <div>
                        <span class="name">
                            理想室友特质：
                        </span>
                        <span class="val">
                            <?php echo $map["lixiangshiyoutezhi"]; ?>                        </span>
                    </div>
                            </div>

                    </div>
    </div>
    <div class="goods-content">
        <pre style="padding: 5px;background: none;border: none;margin: 0;"><?php echo $map["qitaxuqiu"]; ?></pre>    </div>

    <script>
        (function () {
            var images = "<?php echo $map["touxiang"]; ?>".split(",");
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
    </div>


        
    
<!-- container定宽，并剧中结束 --></div>


</div>


<?php include "footer.php" ?>
<?php include "foot.php" ?>