<?php  require_once 'initialize.php';  ?>    <?php checkLogin();  // 检测是否登录 ?>

<?php             // 根据id 获取要修改得数据
        $mmm = M('yonghu')->where('id' , $_GET['id'])->find();
    
    
 ?> 
<?php include "head.php" ?>

<script src="js/jquery.validate.js"></script>
<link rel="stylesheet" href="js/layer/theme/default/layer.css"/>
<script src="js/layer/layer.js"></script>
<script src="js/rate/jquery.raty.min.js"></script>




<div>



<div class="panel panel-default">
    <div class="panel-heading">
        <span class="titles">
            添加用户
        </span>
    </div>
    <div class="panel-body">
        
    

<form action="yonghu.php?a=update" method="post" name="form1" id="yonghuform1"><!-- form 标签开始 -->
    
                    <div class="form-group form-type-text">
    <div class="form-item-flex">
        <label class="form-label-title"><span style="color: red;">*</span> 用户名</label>
        <div class="form-label-control">
            
                            <?php echo Info::html($mmm["yonghuming"]); ?><input type="hidden" class="form-control" placeholder="输入用户名" style="width:150px;" data-rule-required="true" data-msg-required="请填写用户名" remote="ajax.php?checktype=update&id=<?php echo $mmm["id"]; ?>&table=yonghu&col=yonghuming" data-msg-remote="内容重复了" id="yonghuming" name="yonghuming" value="<?php echo Info::html($mmm["yonghuming"]); ?>"/>                    
        </div>
        
    </div>
</div>
                            <div class="form-group form-type-text">
    <div class="form-item-flex">
        <label class="form-label-title"><span style="color: red;">*</span> 姓名</label>
        <div class="form-label-control">
            
                            <input type="text" class="form-control" placeholder="输入姓名" style="width:150px;" data-rule-required="true" data-msg-required="请填写姓名" id="xingming" name="xingming" value="<?php echo Info::html($mmm["xingming"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-select">
    <div class="form-item-flex">
        <label class="form-label-title"><span style="color: red;">*</span> 性别</label>
        <div class="form-label-control">
            
                            <select class="form-control class_xingbie29" data-value="<?php echo Info::html($mmm["xingbie"]); ?>" data-rule-required="true" data-msg-required="请填写性别" id="xingbie" name="xingbie" style="width:250px">
<option value="男">男</option>
<option value="女">女</option>

</select>
<script>
$(".class_xingbie29").val($(".class_xingbie29").attr("data-value"))</script>
                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-image">
    <div class="form-item-flex">
        <label class="form-label-title"><span style="color: red;">*</span> 头像</label>
        <div class="form-label-control">
            
                            <div class="input-group" style="width:250px">
    <input type="text" class="form-control" data-rule-required="true" data-msg-required="请填写头像" id="touxiang" name="touxiang" value="<?php echo Info::html($mmm["touxiang"]); ?>"/>

    <span class="input-group-btn"><button type="button" class="btn btn-default" onclick="layer.open({type:2,title:'上传图片',fixed:true,shadeClose:true,shade:0.5,area:['320px','150px'],content:'upload.html?result=touxiang'})">
    上传图片
</button></span>
</div>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-text">
    <div class="form-item-flex">
        <label class="form-label-title"><span style="color: red;">*</span> 手机</label>
        <div class="form-label-control">
            
                            <input type="text" class="form-control" placeholder="输入手机" style="width:150px;" data-rule-required="true" data-msg-required="请填写手机" phone="true" data-msg-phone="请输入正确手机号码" id="shouji" name="shouji" value="<?php echo Info::html($mmm["shouji"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-text">
    <div class="form-item-flex">
        <label class="form-label-title"> 邮箱</label>
        <div class="form-label-control">
            
                            <input type="text" class="form-control" placeholder="输入邮箱" style="width:150px;" email="true" data-msg-email="请输入有效邮件地址" id="youxiang" name="youxiang" value="<?php echo Info::html($mmm["youxiang"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-text">
    <div class="form-item-flex">
        <label class="form-label-title"> 年龄</label>
        <div class="form-label-control">
            
                            <input type="text" class="form-control" placeholder="输入年龄" style="width:150px;" id="nianling" name="nianling" value="<?php echo Info::html($mmm["nianling"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-text">
    <div class="form-item-flex">
        <label class="form-label-title"> 身份证</label>
        <div class="form-label-control">
            
                            <input type="text" class="form-control" placeholder="输入身份证" style="width:150px;" idcard="true" data-msg-email="请输入有效身份证号码" id="shenfenzheng" name="shenfenzheng" value="<?php echo Info::html($mmm["shenfenzheng"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-text">
    <div class="form-item-flex">
        <label class="form-label-title"> 所在城市</label>
        <div class="form-label-control">
            
                            <input type="text" class="form-control" placeholder="输入所在城市" style="width:150px;" id="suozaichengshi" name="suozaichengshi" value="<?php echo Info::html($mmm["suozaichengshi"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-radio">
    <div class="form-item-flex">
        <label class="form-label-title"> 年级</label>
        <div class="form-label-control">
            
                            <div class="class_nianji30" data-value="<?php echo Info::html($mmm["nianji"]); ?>"> <label><input type="radio" id="nianji" name="nianji" value="本科"/> 本科</label> 
 <label><input type="radio" id="nianji" name="nianji" value="硕士"/> 硕士</label> 
 <label><input type="radio" id="nianji" name="nianji" value="博士"/> 博士</label> 
 <label><input type="radio" id="nianji" name="nianji" value="其他"/> 其他</label> 
</div>
<script>
$(".class_nianji30 :radio[value='<?php echo Info::html($mmm["nianji"]); ?>']").prop("checked",true)</script>
                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-text">
    <div class="form-item-flex">
        <label class="form-label-title"> 学院/专业</label>
        <div class="form-label-control">
            
                            <input type="text" class="form-control" placeholder="输入学院/专业" style="width:150px;" id="xueyuanzhuanye" name="xueyuanzhuanye" value="<?php echo Info::html($mmm["xueyuanzhuanye"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-text">
    <div class="form-item-flex">
        <label class="form-label-title"> 国籍</label>
        <div class="form-label-control">
            
                            <input type="text" class="form-control" placeholder="输入国籍" style="width:150px;" id="guoji" name="guoji" value="<?php echo Info::html($mmm["guoji"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-select">
    <div class="form-item-flex">
        <label class="form-label-title"> 主要语言</label>
        <div class="form-label-control">
            
                            <select class="form-control class_zhuyaoyuyan31" data-value="<?php echo Info::html($mmm["zhuyaoyuyan"]); ?>" id="zhuyaoyuyan" name="zhuyaoyuyan" style="width:250px">
<option value="粤">粤</option>
<option value="普">普</option>
<option value="英">英</option>
<option value="其他">其他</option>

</select>
<script>
$(".class_zhuyaoyuyan31").val($(".class_zhuyaoyuyan31").attr("data-value"))</script>
                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-select">
    <div class="form-item-flex">
        <label class="form-label-title"> 作息类型</label>
        <div class="form-label-control">
            
                            <select class="form-control class_zuoxileixing32" data-value="<?php echo Info::html($mmm["zuoxileixing"]); ?>" id="zuoxileixing" name="zuoxileixing" style="width:250px">
<option value="早睡早起">早睡早起</option>
<option value="早睡晚起">早睡晚起</option>

</select>
<script>
$(".class_zuoxileixing32").val($(".class_zuoxileixing32").attr("data-value"))</script>
                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-select">
    <div class="form-item-flex">
        <label class="form-label-title"> 在家时间</label>
        <div class="form-label-control">
            
                            <select class="form-control class_zaijiashijian33" data-value="<?php echo Info::html($mmm["zaijiashijian"]); ?>" id="zaijiashijian" name="zaijiashijian" style="width:250px">
<option value="很少">很少</option>
<option value="一般">一般</option>
<option value="较多">较多</option>

</select>
<script>
$(".class_zaijiashijian33").val($(".class_zaijiashijian33").attr("data-value"))</script>
                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-select">
    <div class="form-item-flex">
        <label class="form-label-title"> 固定安静时段需求</label>
        <div class="form-label-control">
            
                            <select class="form-control class_gudinganjingshiduanxuqiu34" data-value="<?php echo Info::html($mmm["gudinganjingshiduanxuqiu"]); ?>" id="gudinganjingshiduanxuqiu" name="gudinganjingshiduanxuqiu" style="width:250px">
<option value="是">是</option>
<option value="否">否</option>
<option value="可协商">可协商</option>

</select>
<script>
$(".class_gudinganjingshiduanxuqiu34").val($(".class_gudinganjingshiduanxuqiu34").attr("data-value"))</script>
                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-rate">
    <div class="form-item-flex">
        <label class="form-label-title"> 自我整洁度</label>
        <div class="form-label-control">
            
                            <span class="form-star" data-name="ziwozhengjiedu" data-value="<?php echo Info::html($mmm["ziwozhengjiedu"]); ?>"></span>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-select">
    <div class="form-item-flex">
        <label class="form-label-title"> 清洁频率偏好</label>
        <div class="form-label-control">
            
                            <select class="form-control class_qingjiepinlvpianhao35" data-value="<?php echo Info::html($mmm["qingjiepinlvpianhao"]); ?>" id="qingjiepinlvpianhao" name="qingjiepinlvpianhao" style="width:250px">
<option value="每日整理">每日整理</option>
<option value="每周大扫除">每周大扫除</option>
<option value="按需求">按需求</option>

</select>
<script>
$(".class_qingjiepinlvpianhao35").val($(".class_qingjiepinlvpianhao35").attr("data-value"))</script>
                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-select">
    <div class="form-item-flex">
        <label class="form-label-title"> 是否参与轮值家务</label>
        <div class="form-label-control">
            
                            <select class="form-control class_shifoucanyulunzhijiawu36" data-value="<?php echo Info::html($mmm["shifoucanyulunzhijiawu"]); ?>" id="shifoucanyulunzhijiawu" name="shifoucanyulunzhijiawu" style="width:250px">
<option value="是">是</option>
<option value="否">否</option>
<option value="视情况">视情况</option>

</select>
<script>
$(".class_shifoucanyulunzhijiawu36").val($(".class_shifoucanyulunzhijiawu36").attr("data-value"))</script>
                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-textarea">
    <div class="form-item-flex">
        <label class="form-label-title"> 公区整洁期望</label>
        <div class="form-label-control">
            
                            <textarea style="width: 80%;height: 120px" class="form-control" placeholder="输入公区整洁期望" id="gongquzhengjieqiwang" name="gongquzhengjieqiwang"><?php echo Info::html($mmm["gongquzhengjieqiwang"]); ?></textarea>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-select">
    <div class="form-item-flex">
        <label class="form-label-title"> 是否接受清洁外包</label>
        <div class="form-label-control">
            
                            <select class="form-control class_shifoujieshouqingjiewaibao37" data-value="<?php echo Info::html($mmm["shifoujieshouqingjiewaibao"]); ?>" id="shifoujieshouqingjiewaibao" name="shifoujieshouqingjiewaibao" style="width:250px">
<option value="可以">可以</option>
<option value="不倾向">不倾向</option>
<option value="视预算">视预算</option>

</select>
<script>
$(".class_shifoujieshouqingjiewaibao37").val($(".class_shifoujieshouqingjiewaibao37").attr("data-value"))</script>
                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-select">
    <div class="form-item-flex">
        <label class="form-label-title"> 带同/异性回家</label>
        <div class="form-label-control">
            
                            <select class="form-control class_daitongyixinghuijia38" data-value="<?php echo Info::html($mmm["daitongyixinghuijia"]); ?>" id="daitongyixinghuijia" name="daitongyixinghuijia" style="width:250px">
<option value="可以">可以</option>
<option value="需提前告知">需提前告知</option>
<option value="不接受">不接受</option>

</select>
<script>
$(".class_daitongyixinghuijia38").val($(".class_daitongyixinghuijia38").attr("data-value"))</script>
                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-select">
    <div class="form-item-flex">
        <label class="form-label-title"> 同/异性偶尔留宿</label>
        <div class="form-label-control">
            
                            <select class="form-control class_tongyixingouerliusu39" data-value="<?php echo Info::html($mmm["tongyixingouerliusu"]); ?>" id="tongyixingouerliusu" name="tongyixingouerliusu" style="width:250px">
<option value="可以">可以</option>
<option value="需协商">需协商</option>
<option value="不接受">不接受</option>

</select>
<script>
$(".class_tongyixingouerliusu39").val($(".class_tongyixingouerliusu39").attr("data-value"))</script>
                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-select">
    <div class="form-item-flex">
        <label class="form-label-title"> 社交偏好</label>
        <div class="form-label-control">
            
                            <select class="form-control class_shejiaopianhao40" data-value="<?php echo Info::html($mmm["shejiaopianhao"]); ?>" id="shejiaopianhao" name="shejiaopianhao" style="width:250px">
<option value="热闹">热闹</option>
<option value="适中">适中</option>
<option value="偏安静">偏安静</option>

</select>
<script>
$(".class_shejiaopianhao40").val($(".class_shejiaopianhao40").attr("data-value"))</script>
                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-select">
    <div class="form-item-flex">
        <label class="form-label-title"> 性别混住接受度</label>
        <div class="form-label-control">
            
                            <select class="form-control class_xingbiehunzhujieshoudu41" data-value="<?php echo Info::html($mmm["xingbiehunzhujieshoudu"]); ?>" id="xingbiehunzhujieshoudu" name="xingbiehunzhujieshoudu" style="width:250px">
<option value="不介意">不介意</option>
<option value="偏好同性">偏好同性</option>
<option value="仅同性">仅同性</option>

</select>
<script>
$(".class_xingbiehunzhujieshoudu41").val($(".class_xingbiehunzhujieshoudu41").attr("data-value"))</script>
                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-select">
    <div class="form-item-flex">
        <label class="form-label-title"> 饮食习惯</label>
        <div class="form-label-control">
            
                            <select class="form-control class_yinshixiguan42" data-value="<?php echo Info::html($mmm["yinshixiguan"]); ?>" id="yinshixiguan" name="yinshixiguan" style="width:250px">
<option value="荤">荤</option>
<option value="素">素</option>
<option value="清真">清真</option>
<option value="其他">其他</option>

</select>
<script>
$(".class_yinshixiguan42").val($(".class_yinshixiguan42").attr("data-value"))</script>
                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-select">
    <div class="form-item-flex">
        <label class="form-label-title"> 是否介意油烟/重口味</label>
        <div class="form-label-control">
            
                            <select class="form-control class_shifoujieyiyouyanzhongkouwei43" data-value="<?php echo Info::html($mmm["shifoujieyiyouyanzhongkouwei"]); ?>" id="shifoujieyiyouyanzhongkouwei" name="shifoujieyiyouyanzhongkouwei" style="width:250px">
<option value="不介意">不介意</option>
<option value="适度">适度</option>
<option value="介意">介意</option>

</select>
<script>
$(".class_shifoujieyiyouyanzhongkouwei43").val($(".class_shifoujieyiyouyanzhongkouwei43").attr("data-value"))</script>
                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-select">
    <div class="form-item-flex">
        <label class="form-label-title"> 厨房使用频率</label>
        <div class="form-label-control">
            
                            <select class="form-control class_chufangshiyongpinlv44" data-value="<?php echo Info::html($mmm["chufangshiyongpinlv"]); ?>" id="chufangshiyongpinlv" name="chufangshiyongpinlv" style="width:250px">
<option value="几乎每天">几乎每天</option>
<option value="每周数次">每周数次</option>
<option value="很少">很少</option>

</select>
<script>
$(".class_chufangshiyongpinlv44").val($(".class_chufangshiyongpinlv44").attr("data-value"))</script>
                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-select">
    <div class="form-item-flex">
        <label class="form-label-title"> 冰箱与调味品共用</label>
        <div class="form-label-control">
            
                            <select class="form-control class_bingxiangyutiaoweipingongyong45" data-value="<?php echo Info::html($mmm["bingxiangyutiaoweipingongyong"]); ?>" id="bingxiangyutiaoweipingongyong" name="bingxiangyutiaoweipingongyong" style="width:250px">
<option value="可共用并标注">可共用并标注</option>
<option value="仅自用">仅自用</option>
<option value="可商量">可商量</option>

</select>
<script>
$(".class_bingxiangyutiaoweipingongyong45").val($(".class_bingxiangyutiaoweipingongyong45").attr("data-value"))</script>
                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-textarea">
    <div class="form-item-flex">
        <label class="form-label-title"> 过敏/禁忌</label>
        <div class="form-label-control">
            
                            <textarea style="width: 80%;height: 120px" class="form-control" placeholder="输入过敏/禁忌" id="guominjinji" name="guominjinji"><?php echo Info::html($mmm["guominjinji"]); ?></textarea>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-rate">
    <div class="form-item-flex">
        <label class="form-label-title"> 对音量容忍度</label>
        <div class="form-label-control">
            
                            <span class="form-star" data-name="duiyinliangrongrendu" data-value="<?php echo Info::html($mmm["duiyinliangrongrendu"]); ?>"></span>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-select">
    <div class="form-item-flex">
        <label class="form-label-title"> 吸烟</label>
        <div class="form-label-control">
            
                            <select class="form-control class_xiyan46" data-value="<?php echo Info::html($mmm["xiyan"]); ?>" id="xiyan" name="xiyan" style="width:250px">
<option value="不吸">不吸</option>
<option value="仅室外">仅室外</option>
<option value="家中指定区域">家中指定区域</option>

</select>
<script>
$(".class_xiyan46").val($(".class_xiyan46").attr("data-value"))</script>
                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-select">
    <div class="form-item-flex">
        <label class="form-label-title"> 饮酒</label>
        <div class="form-label-control">
            
                            <select class="form-control class_yinjiu47" data-value="<?php echo Info::html($mmm["yinjiu"]); ?>" id="yinjiu" name="yinjiu" style="width:250px">
<option value="不饮">不饮</option>
<option value="偶尔">偶尔</option>
<option value="社交型">社交型</option>
<option value="经常">经常</option>

</select>
<script>
$(".class_yinjiu47").val($(".class_yinjiu47").attr("data-value"))</script>
                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-select">
    <div class="form-item-flex">
        <label class="form-label-title"> 香水/香薰</label>
        <div class="form-label-control">
            
                            <select class="form-control class_xiangshuixiangxun48" data-value="<?php echo Info::html($mmm["xiangshuixiangxun"]); ?>" id="xiangshuixiangxun" name="xiangshuixiangxun" style="width:250px">
<option value="不使用">不使用</option>
<option value="偶尔">偶尔</option>
<option value="经常">经常</option>

</select>
<script>
$(".class_xiangshuixiangxun48").val($(".class_xiangshuixiangxun48").attr("data-value"))</script>
                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-select">
    <div class="form-item-flex">
        <label class="form-label-title"> 是否介意气味</label>
        <div class="form-label-control">
            
                            <select class="form-control class_shifoujieyiqiwei49" data-value="<?php echo Info::html($mmm["shifoujieyiqiwei"]); ?>" id="shifoujieyiqiwei" name="shifoujieyiqiwei" style="width:250px">
<option value="是">是</option>
<option value="否">否</option>
<option value="视情况">视情况</option>

</select>
<script>
$(".class_shifoujieyiqiwei49").val($(".class_shifoujieyiqiwei49").attr("data-value"))</script>
                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-select">
    <div class="form-item-flex">
        <label class="form-label-title"> 是否有宠物</label>
        <div class="form-label-control">
            
                            <select class="form-control class_shifouyouchongwu50" data-value="<?php echo Info::html($mmm["shifouyouchongwu"]); ?>" id="shifouyouchongwu" name="shifouyouchongwu" style="width:250px">
<option value="有">有</option>
<option value="无">无</option>

</select>
<script>
$(".class_shifouyouchongwu50").val($(".class_shifouyouchongwu50").attr("data-value"))</script>
                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-select">
    <div class="form-item-flex">
        <label class="form-label-title"> 对宠物接受度</label>
        <div class="form-label-control">
            
                            <select class="form-control class_duichongwujieshoudu51" data-value="<?php echo Info::html($mmm["duichongwujieshoudu"]); ?>" id="duichongwujieshoudu" name="duichongwujieshoudu" style="width:250px">
<option value="喜欢">喜欢</option>
<option value="可接受">可接受</option>
<option value="过敏或不接受">过敏或不接受</option>

</select>
<script>
$(".class_duichongwujieshoudu51").val($(".class_duichongwujieshoudu51").attr("data-value"))</script>
                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-textarea">
    <div class="form-item-flex">
        <label class="form-label-title"> 押金与损耗处理规则</label>
        <div class="form-label-control">
            
                            <textarea style="width: 80%;height: 120px" class="form-control" placeholder="输入押金与损耗处理规则" id="yajinyusunhaochuliguize" name="yajinyusunhaochuliguize"><?php echo Info::html($mmm["yajinyusunhaochuliguize"]); ?></textarea>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-select">
    <div class="form-item-flex">
        <label class="form-label-title"> 支付方式</label>
        <div class="form-label-control">
            
                            <select class="form-control class_zhifufangshi52" data-value="<?php echo Info::html($mmm["zhifufangshi"]); ?>" id="zhifufangshi" name="zhifufangshi" style="width:250px">
<option value="FPS">FPS</option>
<option value="转账">转账</option>
<option value="现金">现金</option>

</select>
<script>
$(".class_zhifufangshi52").val($(".class_zhifufangshi52").attr("data-value"))</script>
                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-select">
    <div class="form-item-flex">
        <label class="form-label-title"> 共同采购与预算</label>
        <div class="form-label-control">
            
                            <select class="form-control class_gongtongcaigouyuyusuan53" data-value="<?php echo Info::html($mmm["gongtongcaigouyuyusuan"]); ?>" id="gongtongcaigouyuyusuan" name="gongtongcaigouyuyusuan" style="width:250px">
<option value="AA">AA</option>
<option value="轮流">轮流</option>
<option value="各自">各自</option>

</select>
<script>
$(".class_gongtongcaigouyuyusuan53").val($(".class_gongtongcaigouyuyusuan53").attr("data-value"))</script>
                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-long-text">
    <div class="form-item-flex">
        <label class="form-label-title"> 性格</label>
        <div class="form-label-control">
            
                            <input type="text" class="form-control" placeholder="输入性格" style="width:250px;" id="xingge" name="xingge" value="<?php echo Info::html($mmm["xingge"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-long-text">
    <div class="form-item-flex">
        <label class="form-label-title"> 兴趣</label>
        <div class="form-label-control">
            
                            <input type="text" class="form-control" placeholder="输入兴趣" style="width:250px;" id="xingqu" name="xingqu" value="<?php echo Info::html($mmm["xingqu"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-long-text">
    <div class="form-item-flex">
        <label class="form-label-title"> 作息</label>
        <div class="form-label-control">
            
                            <input type="text" class="form-control" placeholder="输入作息" style="width:250px;" id="zuoxi" name="zuoxi" value="<?php echo Info::html($mmm["zuoxi"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-long-text">
    <div class="form-item-flex">
        <label class="form-label-title"> 活动</label>
        <div class="form-label-control">
            
                            <input type="text" class="form-control" placeholder="输入活动" style="width:250px;" id="huodong" name="huodong" value="<?php echo Info::html($mmm["huodong"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-long-text">
    <div class="form-item-flex">
        <label class="form-label-title"> 理想室友特质</label>
        <div class="form-label-control">
            
                            <input type="text" class="form-control" placeholder="输入理想室友特质" style="width:250px;" id="lixiangshiyoutezhi" name="lixiangshiyoutezhi" value="<?php echo Info::html($mmm["lixiangshiyoutezhi"]); ?>"/>                    
        </div>
        
    </div>
</div>
                    <div class="form-group form-type-textarea">
    <div class="form-item-flex">
        <label class="form-label-title"> 其他需求</label>
        <div class="form-label-control">
            
                            <textarea style="width: 80%;height: 120px" class="form-control" placeholder="输入其他需求" id="qitaxuqiu" name="qitaxuqiu"><?php echo Info::html($mmm["qitaxuqiu"]); ?></textarea>                    
        </div>
        
    </div>
</div>
    
    <div class="form-group" id="form-item-btn">
    <div class="form-item-flex">
        <label class="form-label-title">  </label>
        <div class="form-label-control">
            
                    <input name="id" value="<?php echo $mmm["id"]; ?>" type="hidden"/>
            <input name="referer" value="<?php echo $_SERVER["HTTP_REFERER"] ?>" type="hidden"/>
            <input name="updtself" value="<?php echo $updtself; ?>" type="hidden"/>
                
        
        <button type="submit" class="btn btn-primary" name="Submit">
    提交
</button>
        <button type="reset" class="btn btn-default" name="Submit2">
    重置
</button>
            
        </div>
        
    </div>
</div>

<!--form标签结束--></form>


<?php  if('1' ==  $_REQUEST["hideBtn"] ){  ?>

<script>
    $('#form-item-btn').hide();
</script>

<?php } ?>



<script>
    $(function (){
        $('#yonghuform1').validate();
    });
</script>




    </div>
</div>


</div>


<?php include "foot.php" ?>