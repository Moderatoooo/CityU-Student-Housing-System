<?php  require_once 'initialize.php';  ?><?php if(empty($_GET['id'])){
    showMessage('没找到相关详情页面');
}

$map = M("yonghu")->where("id" , $_GET['id'])->find();

if(empty($map)){
    showMessage('没找到相关详情页面');
}


?> 
<?php include "head.php" ?>

<script src="js/rate/jquery.raty.min.js"></script>




<div>



<div class="panel panel-default">
    <div class="panel-heading">
        <span class="titles">
            用户详情
        </span>
    </div>
    <div class="panel-body">
        
    

<div class="pa10">
    <div class="pa10 bg-white">
        <table class="new-detail">
            <tbody>
            <tr>
                                    <td class="detail-title">
                        用户名                    </td>
                    <td class="detail-value">
                        <?php echo $map["yonghuming"]; ?>                    </td>
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
                        头像                    </td>
                    <td class="detail-value">
                        <img src="<?php echo $map["touxiang"]; ?>" style="width: 350px"/>                    </td>
                                                        <td class="detail-title">
                        手机                    </td>
                    <td class="detail-value">
                        <?php echo $map["shouji"]; ?>                    </td>
                    </tr><tr>                                    <td class="detail-title">
                        邮箱                    </td>
                    <td class="detail-value">
                        <?php echo $map["youxiang"]; ?>                    </td>
                                                        <td class="detail-title">
                        年龄                    </td>
                    <td class="detail-value">
                        <?php echo $map["nianling"]; ?>                    </td>
                                                        <td class="detail-title">
                        身份证                    </td>
                    <td class="detail-value">
                        <?php echo $map["shenfenzheng"]; ?>                    </td>
                    </tr><tr>                                    <td class="detail-title">
                        所在城市                    </td>
                    <td class="detail-value">
                        <?php echo $map["suozaichengshi"]; ?>                    </td>
                                                        <td class="detail-title">
                        年级                    </td>
                    <td class="detail-value">
                        <?php echo $map["nianji"]; ?>                    </td>
                                                        <td class="detail-title">
                        学院/专业                    </td>
                    <td class="detail-value">
                        <?php echo $map["xueyuanzhuanye"]; ?>                    </td>
                    </tr><tr>                                    <td class="detail-title">
                        国籍                    </td>
                    <td class="detail-value">
                        <?php echo $map["guoji"]; ?>                    </td>
                                                        <td class="detail-title">
                        主要语言                    </td>
                    <td class="detail-value">
                        <?php echo $map["zhuyaoyuyan"]; ?>                    </td>
                                                        <td class="detail-title">
                        作息类型                    </td>
                    <td class="detail-value">
                        <?php echo $map["zuoxileixing"]; ?>                    </td>
                    </tr><tr>                                    <td class="detail-title">
                        在家时间                    </td>
                    <td class="detail-value">
                        <?php echo $map["zaijiashijian"]; ?>                    </td>
                                                        <td class="detail-title">
                        固定安静时段需求                    </td>
                    <td class="detail-value">
                        <?php echo $map["gudinganjingshiduanxuqiu"]; ?>                    </td>
                                                        <td class="detail-title">
                        自我整洁度                    </td>
                    <td class="detail-value">
                        <span class="star-read" data-value="<?php echo $map["ziwozhengjiedu"]; ?>"></span>                    </td>
                    </tr><tr>                                    <td class="detail-title">
                        清洁频率偏好                    </td>
                    <td class="detail-value">
                        <?php echo $map["qingjiepinlvpianhao"]; ?>                    </td>
                                                        <td class="detail-title">
                        是否参与轮值家务                    </td>
                    <td class="detail-value">
                        <?php echo $map["shifoucanyulunzhijiawu"]; ?>                    </td>
                                                        <td class="detail-title">
                        是否接受清洁外包                    </td>
                    <td class="detail-value">
                        <?php echo $map["shifoujieshouqingjiewaibao"]; ?>                    </td>
                    </tr><tr>                                    <td class="detail-title">
                        带同/异性回家                    </td>
                    <td class="detail-value">
                        <?php echo $map["daitongyixinghuijia"]; ?>                    </td>
                                                        <td class="detail-title">
                        同/异性偶尔留宿                    </td>
                    <td class="detail-value">
                        <?php echo $map["tongyixingouerliusu"]; ?>                    </td>
                                                        <td class="detail-title">
                        社交偏好                    </td>
                    <td class="detail-value">
                        <?php echo $map["shejiaopianhao"]; ?>                    </td>
                    </tr><tr>                                    <td class="detail-title">
                        性别混住接受度                    </td>
                    <td class="detail-value">
                        <?php echo $map["xingbiehunzhujieshoudu"]; ?>                    </td>
                                                        <td class="detail-title">
                        饮食习惯                    </td>
                    <td class="detail-value">
                        <?php echo $map["yinshixiguan"]; ?>                    </td>
                                                        <td class="detail-title">
                        是否介意油烟/重口味                    </td>
                    <td class="detail-value">
                        <?php echo $map["shifoujieyiyouyanzhongkouwei"]; ?>                    </td>
                    </tr><tr>                                    <td class="detail-title">
                        厨房使用频率                    </td>
                    <td class="detail-value">
                        <?php echo $map["chufangshiyongpinlv"]; ?>                    </td>
                                                        <td class="detail-title">
                        冰箱与调味品共用                    </td>
                    <td class="detail-value">
                        <?php echo $map["bingxiangyutiaoweipingongyong"]; ?>                    </td>
                                                        <td class="detail-title">
                        对音量容忍度                    </td>
                    <td class="detail-value">
                        <span class="star-read" data-value="<?php echo $map["duiyinliangrongrendu"]; ?>"></span>                    </td>
                    </tr><tr>                                    <td class="detail-title">
                        吸烟                    </td>
                    <td class="detail-value">
                        <?php echo $map["xiyan"]; ?>                    </td>
                                                        <td class="detail-title">
                        饮酒                    </td>
                    <td class="detail-value">
                        <?php echo $map["yinjiu"]; ?>                    </td>
                                                        <td class="detail-title">
                        香水/香薰                    </td>
                    <td class="detail-value">
                        <?php echo $map["xiangshuixiangxun"]; ?>                    </td>
                    </tr><tr>                                    <td class="detail-title">
                        是否介意气味                    </td>
                    <td class="detail-value">
                        <?php echo $map["shifoujieyiqiwei"]; ?>                    </td>
                                                        <td class="detail-title">
                        是否有宠物                    </td>
                    <td class="detail-value">
                        <?php echo $map["shifouyouchongwu"]; ?>                    </td>
                                                        <td class="detail-title">
                        对宠物接受度                    </td>
                    <td class="detail-value">
                        <?php echo $map["duichongwujieshoudu"]; ?>                    </td>
                    </tr><tr>                                    <td class="detail-title">
                        支付方式                    </td>
                    <td class="detail-value">
                        <?php echo $map["zhifufangshi"]; ?>                    </td>
                                                        <td class="detail-title">
                        共同采购与预算                    </td>
                    <td class="detail-value">
                        <?php echo $map["gongtongcaigouyuyusuan"]; ?>                    </td>
                                                        <td class="detail-title">
                        性格                    </td>
                    <td class="detail-value">
                        <?php echo $map["xingge"]; ?>                    </td>
                    </tr><tr>                                    <td class="detail-title">
                        兴趣                    </td>
                    <td class="detail-value">
                        <?php echo $map["xingqu"]; ?>                    </td>
                                                        <td class="detail-title">
                        作息                    </td>
                    <td class="detail-value">
                        <?php echo $map["zuoxi"]; ?>                    </td>
                                                        <td class="detail-title">
                        活动                    </td>
                    <td class="detail-value">
                        <?php echo $map["huodong"]; ?>                    </td>
                    </tr><tr>                                    <td class="detail-title">
                        理想室友特质                    </td>
                    <td class="detail-value">
                        <?php echo $map["lixiangshiyoutezhi"]; ?>                    </td>
                                                </tr>
            </tbody>
        </table>
    </div>
        <div class="mt10 pa10 bg-white">
        <div class="new-detail-line">
            <div class="detail-title">
                公区整洁期望            </div>
            <td class="detail-value">
                <pre style="padding: 5px;background: none;border: none;margin: 0;"><?php echo $map["gongquzhengjieqiwang"]; ?></pre>            </td>
        </div>
    </div>
        <div class="mt10 pa10 bg-white">
        <div class="new-detail-line">
            <div class="detail-title">
                过敏/禁忌            </div>
            <td class="detail-value">
                <pre style="padding: 5px;background: none;border: none;margin: 0;"><?php echo $map["guominjinji"]; ?></pre>            </td>
        </div>
    </div>
        <div class="mt10 pa10 bg-white">
        <div class="new-detail-line">
            <div class="detail-title">
                押金与损耗处理规则            </div>
            <td class="detail-value">
                <pre style="padding: 5px;background: none;border: none;margin: 0;"><?php echo $map["yajinyusunhaochuliguize"]; ?></pre>            </td>
        </div>
    </div>
        <div class="mt10 pa10 bg-white">
        <div class="new-detail-line">
            <div class="detail-title">
                其他需求            </div>
            <td class="detail-value">
                <pre style="padding: 5px;background: none;border: none;margin: 0;"><?php echo $map["qitaxuqiu"]; ?></pre>            </td>
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