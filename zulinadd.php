<?php
require_once 'initialize.php';
checkLogin();  // 检测是否登录

// 验证ID合法性（增强安全）
if (empty($_GET["id"]) || !is_numeric($_GET["id"])) {
    echo '<script>alert("非法操作");history.go(-1);</script>';
    exit;
}

// 获取房源信息（强制转整型防注入）
$houseId = intval($_GET["id"]);
$readMap = M("fangwuxinxi")->where("id", $houseId)->find();

// 提前处理最短租期，确保为有效数字
$zuiduanzuqi = isset($readMap["zuiduanzuqi"]) && is_numeric($readMap["zuiduanzuqi"])
    ? intval($readMap["zuiduanzuqi"])
    : 1; // 兜底默认1个月
?>

<?php include "head.php" ?>
<?php include "header.php" ?>

    <script src="js/jquery.validate.js"></script>

    <div>
        <div class="container"><!-- 使用bootstrap css框架，container定宽，并剧中 https://v3.bootcss.com/css/#overview-container -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span class="titles">添加租赁</span>
                </div>
                <div class="panel-body">
                    <form action="zulin.php?a=insert" method="post" name="form1" id="zulinform1">
                        <input type="hidden" name="fangwuxinxiid" value="<?php echo $houseId; ?>"/>

                        <!-- 原有字段保持不变 -->
                        <div class="form-group form-type-text" style="display: none">
                            <div class="form-item-flex">
                                <label class="form-label-title"> 租赁单号</label>
                                <div class="form-label-control">
                                    <input type="text" class="form-control" placeholder="输入租赁单号" style="width:150px;"
                                           readonly="readonly" id="zulindanhao" name="zulindanhao"
                                           value="<?php echo Info::getID(); ?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-type-text" style="display: none">
                            <div class="form-item-flex">
                                <label class="form-label-title"> 房屋编号</label>
                                <div class="form-label-control">
                                    <?php echo $readMap["fangwubianhao"]; ?><input type="hidden" id="fangwubianhao"
                                                                                   name="fangwubianhao"
                                                                                   value="<?php echo Info::html($readMap["fangwubianhao"]); ?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-type-long-text">
                            <div class="form-item-flex">
                                <label class="form-label-title"> 房屋标题</label>
                                <div class="form-label-control">
                                    <?php echo $readMap["fangwubiaoti"]; ?><input type="hidden" id="fangwubiaoti"
                                                                                  name="fangwubiaoti"
                                                                                  value="<?php echo Info::html($readMap["fangwubiaoti"]); ?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-type-text">
                            <div class="form-item-flex">
                                <label class="form-label-title"> 房屋户型</label>
                                <div class="form-label-control">
                                    <?php echo $readMap["fangwuhuxing"]; ?><input type="hidden" id="fangwuhuxing"
                                                                                  name="fangwuhuxing"
                                                                                  value="<?php echo Info::html($readMap["fangwuhuxing"]); ?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-type-text">
                            <div class="form-item-flex">
                                <label class="form-label-title"> 小区名称</label>
                                <div class="form-label-control">
                                    <?php echo $readMap["xiaoqumingcheng"]; ?><input type="hidden" id="xiaoqumingcheng"
                                                                                     name="xiaoqumingcheng"
                                                                                     value="<?php echo Info::html($readMap["xiaoqumingcheng"]); ?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-type-images">
                            <div class="form-item-flex">
                                <label class="form-label-title"> 房屋图片</label>
                                <div class="form-label-control">
                                    <?php if ("" == $readMap["fangwutupian"]) { ?>-<?php } else { ?><img width="100"
                                                                                                         src="<?php echo Info::images($readMap["fangwutupian"]); ?>"/><?php } ?>
                                    <input type="hidden" id="fangwutupian" name="fangwutupian"
                                           value="<?php echo Info::html($readMap["fangwutupian"]); ?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-type-text">
                            <div class="form-item-flex">
                                <label class="form-label-title"> 楼层</label>
                                <div class="form-label-control">
                                    <?php echo $readMap["louceng"]; ?><input type="hidden" id="louceng" name="louceng"
                                                                             value="<?php echo Info::html($readMap["louceng"]); ?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-type-text">
                            <div class="form-item-flex">
                                <label class="form-label-title"> 面积</label>
                                <div class="form-label-control">
                                    <?php echo $readMap["mianji"]; ?><input type="hidden" id="mianji" name="mianji"
                                                                            value="<?php echo Info::html($readMap["mianji"]); ?>"/>
                                </div>
                            </div>
                        </div>


                        <?php if ($readMap["zulinleixing"] == '整租') { ?>

                            <div class="form-group form-type-money">
                                <div class="form-item-flex">
                                    <label class="form-label-title"> 房屋租金</label>
                                    <div class="form-label-control">

                                        <?php echo $readMap["fangwuzujin"]; ?><input type="hidden" id="fangwuzujin"
                                                                                     name="fangwuzujin"
                                                                                     value="<?php echo Info::html($readMap["fangwuzujin"]); ?>"/>
                                    </div>

                                </div>
                            </div>

                        <?php } else { ?>

                            <div class="form-group form-type-money" style="display: none">
                                <div class="form-item-flex">
                                    <label class="form-label-title"> 房屋租金</label>
                                    <div class="form-label-control">

                                        <?php echo $readMap["fangwuzujin"]; ?><input type="hidden" id="fangwuzujin"
                                                                                     name="fangwuzujin"
                                                                                     value="<?php echo Info::html($readMap["fangwuzujin"]); ?>"/>
                                    </div>

                                </div>
                            </div>



                        <?php } ?>

                        <div class="form-group form-type-select">
                            <div class="form-item-flex">
                                <label class="form-label-title"> 押金方式</label>
                                <div class="form-label-control">
                                    <?php echo $readMap["yajinfangshi"]; ?><input type="hidden" id="yajinfangshi"
                                                                                  name="yajinfangshi"
                                                                                  value="<?php echo Info::html($readMap["yajinfangshi"]); ?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-type-text-user" style="display: none">
                            <div class="form-item-flex">
                                <label class="form-label-title"> 发布人</label>
                                <div class="form-label-control">
                                    <?php echo $readMap["faburen"]; ?><input type="hidden" id="faburen" name="faburen"
                                                                             value="<?php echo Info::html($readMap["faburen"]); ?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-type-select">
                            <div class="form-item-flex">
                                <label class="form-label-title"> 类型</label>
                                <div class="form-label-control">
                                    <?php $mapfangwuleixing18 = db()->find("SELECT leixing,id FROM fangwuleixing where id='" . $readMap["leixing"] . "'"); ?><?php echo $mapfangwuleixing18["leixing"]; ?>
                                    <input type="hidden" id="leixing" name="leixing"
                                           value="<?php echo Info::html($readMap["leixing"]); ?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-type-select" style="display: none">
                            <div class="form-item-flex">
                                <label class="form-label-title"> 价格区间</label>
                                <div class="form-label-control">
                                    <?php echo $readMap["jiagequjian"]; ?><input type="hidden" id="jiagequjian"
                                                                                 name="jiagequjian"
                                                                                 value="<?php echo Info::html($readMap["jiagequjian"]); ?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-type-select" style="display: none">
                            <div class="form-item-flex">
                                <label class="form-label-title"> 距离学校</label>
                                <div class="form-label-control">
                                    <?php echo $readMap["julixuexiao"]; ?><input type="hidden" id="julixuexiao"
                                                                                 name="julixuexiao"
                                                                                 value="<?php echo Info::html($readMap["julixuexiao"]); ?>"/>
                                </div>
                            </div>
                        </div>

                        <!-- 最短租期字段（核心：复用该字段的隐藏输入框） -->
                        <div class="form-group form-type-number">
                            <div class="form-item-flex">
                                <label class="form-label-title"> 最短租期(月)</label>
                                <div class="form-label-control">
                                    <?php echo $zuiduanzuqi; ?><input type="hidden" id="zuiduanzuqi"
                                                                      name="zuiduanzuqi"
                                                                      value="<?php echo Info::html($zuiduanzuqi); ?>"/>
                                    <!-- 增加直观提示 -->
<!--                                    <span class="help-block" style="margin-top:5px;color:#666;">-->
<!--                                    提示：租赁时长不能小于此最短租期-->
<!--                                </span>-->
                                </div>
                            </div>
                        </div>

                        <div class="form-group form-type-checkbox" style="display: none">
                            <div class="form-item-flex">
                                <label class="form-label-title"> 设施</label>
                                <div class="form-label-control">
                                    <?php echo $readMap["sheshi"]; ?><input type="hidden" id="sheshi" name="sheshi"
                                                                            value="<?php echo Info::html($readMap["sheshi"]); ?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-type-text">
                            <div class="form-item-flex">
                                <label class="form-label-title"> 房间数</label>
                                <div class="form-label-control">
                                    <?php echo $readMap["fangjianshu"]; ?><input type="hidden" id="fangjianshu"
                                                                                 name="fangjianshu"
                                                                                 value="<?php echo Info::html($readMap["fangjianshu"]); ?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-type-select">
                            <div class="form-item-flex">
                                <label class="form-label-title"> 是否有电梯</label>
                                <div class="form-label-control">
                                    <?php echo $readMap["shifouyoudianti"]; ?><input type="hidden" id="shifouyoudianti"
                                                                                     name="shifouyoudianti"
                                                                                     value="<?php echo Info::html($readMap["shifouyoudianti"]); ?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-type-select">
                            <div class="form-item-flex">
                                <label class="form-label-title"> 租赁类型</label>
                                <div class="form-label-control">
                                    <?php echo $readMap["zulinleixing"]; ?><input type="hidden" id="zulinleixing"
                                                                                  name="zulinleixing"
                                                                                  value="<?php echo Info::html($readMap["zulinleixing"]); ?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-type-long-text">
                            <div class="form-item-flex">
                                <label class="form-label-title"> 房屋地址</label>
                                <div class="form-label-control">
                                    <?php echo $readMap["fangwudizhi"]; ?><input type="hidden" id="fangwudizhi"
                                                                                 name="fangwudizhi"
                                                                                 value="<?php echo Info::html($readMap["fangwudizhi"]); ?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-type-text">
                            <div class="form-item-flex">
                                <label class="form-label-title"><span style="color: red;">*</span> 姓名</label>
                                <div class="form-label-control">
                                    <input type="text" class="form-control" placeholder="输入姓名" style="width:150px;"
                                           data-rule-required="true" data-msg-required="请填写姓名" id="xingming"
                                           name="xingming" value="<?php echo $_SESSION["xingming"]; ?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-type-text">
                            <div class="form-item-flex">
                                <label class="form-label-title"><span style="color: red;">*</span> 联系电话</label>
                                <div class="form-label-control">
                                    <input type="text" class="form-control" placeholder="输入联系电话" style="width:150px;"
                                           data-rule-required="true" data-msg-required="请填写联系电话" data-rule-phone="true"
                                           data-msg-phone="请输入正确手机号码" id="lianxidianhua" name="lianxidianhua"
                                           value="<?php echo $_SESSION["shouji"]; ?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-type-text">
                            <div class="form-item-flex">
                                <label class="form-label-title"><span style="color: red;">*</span> 身份证号</label>
                                <div class="form-label-control">
                                    <input type="text" class="form-control" placeholder="输入身份证号" style="width:150px;"
                                           data-rule-required="true" data-msg-required="请填写身份证号" data-rule-idcard="true"
                                           data-msg-idcard="请输入有效身份证号码" id="shenfenzhenghao" name="shenfenzhenghao"
                                           value="<?php echo $_SESSION["shenfenzheng"]; ?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-type-select">
                            <div class="form-item-flex">
                                <label class="form-label-title"><span style="color: red;">*</span> 选择房间</label>
                                <div class="form-label-control">
                                    <?php if ($readMap["zulinleixing"] == '整租') { ?>
                                        整租
                                    <?php } else { ?>
                                        <select class="form-control class_xuanzefangjian20" data-value=""
                                                data-rule-required="true" data-msg-required="请填写选择房间"
                                                id="xuanzefangjian"
                                                name="xuanzefangjian" style="width:250px">
                                            <?php $select = db()->select("SELECT * FROM fangjianxinxi where  fangwubianhao ='" . $readMap["fangwubianhao"] . "' and zhuangtai ='待租' ORDER BY id desc"); ?>
                                            <?php foreach ($select as $m) { ?>
                                                <option value="<?php echo $m["id"]; ?>"><?php echo $m["fangjianmingcheng"]; ?>
                                                    /<?php echo $m["mianji"]; ?>
                                                    /<?php echo $m["danjianjiage"]; ?></option>
                                            <?php } ?>
                                        </select>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                        <!-- 租赁时长字段（核心修改：基于zuiduanzuqi字段验证） -->
                        <div class="form-group form-type-number">
                            <div class="form-item-flex">
                                <label class="form-label-title"><span style="color: red;">*</span> 租赁时长(月)</label>
                                <div class="form-label-control">
                                    <input type="number" class="form-control"
                                           placeholder="输入租赁时长（最短<?php echo $zuiduanzuqi; ?>个月）"
                                           style="width:250px;"
                                           data-rule-required="true"
                                           data-msg-required="请填写租赁时长"
                                           data-rule-number="true"
                                           data-msg-number="输入一个有效数字"
                                           data-rule-minLease="true"
                                           data-msg-minLease="租赁时长不能小于最短租期（<?php echo $zuiduanzuqi; ?>个月）"
                                           min="<?php echo $zuiduanzuqi; ?>"
                                    id="zulinshichang"
                                    name="zulinshichang"
                                    value=""/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group form-type-textarea">
                            <div class="form-item-flex">
                                <label class="form-label-title"> 备注</label>
                                <div class="form-label-control">
                                <textarea style="width: 80%;height: 120px" class="form-control" placeholder="输入备注"
                                          id="beizhu" name="beizhu"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-type-text-user">
                            <div class="form-item-flex">
                                <label class="form-label-title"> 租赁用户</label>
                                <div class="form-label-control">
                                    <input type="text" class="form-control" placeholder="输入租赁用户" style="width:150px;"
                                           readonly="readonly" id="zulinyonghu" name="zulinyonghu"
                                           value="<?php echo $_SESSION["username"]; ?>"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group" id="form-item-btn">
                            <div class="form-item-flex">
                                <label class="form-label-title"> </label>
                                <div class="form-label-control">
                                    <input name="referer" id="referers" class="referers"
                                           value="<?php echo $_SERVER["HTTP_REFERER"] ?>" type="hidden"/>
                                    <script>
                                        $(function () {
                                            $('input.referers').val(document.referrer);
                                        });
                                    </script>
                                    <input type="hidden" name="zulinzhuangtai" id="zulinzhuangtai" value="待审核"/>

                                    <button type="submit" class="btn btn-primary" name="Submit">
                                        提交
                                    </button>
                                    <button type="reset" class="btn btn-default" name="Submit2">
                                        重置
                                    </button>
                                    <button type="button" class="btn btn-default" onclick="history.back()">
                                        返回
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <?php if ('1' == $_REQUEST["hideBtn"]) { ?>
                        <script>
                            $('#form-item-btn').hide();
                        </script>
                    <?php } ?>

                    <script>
                        $(function () {
                            // 1. 自定义验证规则：租赁时长 ≥ 最短租期（复用页面中的zuiduanzuqi字段）
                            $.validator.addMethod("minLease", function(value, element) {
                                // 从已有隐藏字段获取最短租期
                                var minLease = parseInt($("#zuiduanzuqi").val()) || 1;
                                // 获取输入的租赁时长
                                var inputLease = parseInt(value);

                                // 验证逻辑：非空 + 是数字 + 大于等于最短租期
                                return this.optional(element) || (!isNaN(inputLease) && inputLease >= minLease);
                            }, function() {
                                // 动态返回错误提示（显示实际的最短租期）
                                var minLease = parseInt($("#zuiduanzuqi").val()) || 1;
                                return "租赁时长不能小于最短租期（" + minLease + "个月）";
                            });

                            // 2. 修复身份证验证规则
                            $.validator.addMethod("idcard", function(value, element) {
                                var idCardReg = /(^\d{18}$)|(^\d{17}(\d|X|x)$)/;
                                return this.optional(element) || idCardReg.test(value);
                            }, "请输入有效身份证号码");

                            // 3. 修复手机号验证规则
                            $.validator.addMethod("phone", function(value, element) {
                                var phoneReg = /^1[3-9]\d{9}$/;
                                return this.optional(element) || phoneReg.test(value);
                            }, "请输入正确手机号码");

                            // 4. 初始化表单验证
                            $('#zulinform1').validate({
                                // 提交时验证
                                submitHandler: function(form) {
                                    // 二次兜底验证（防止前端绕过）
                                    var minLease = parseInt($("#zuiduanzuqi").val()) || 1;
                                    var inputLease = parseInt($("#zulinshichang").val());

                                    if (isNaN(inputLease) || inputLease < minLease) {
                                        alert("租赁时长不能小于最短租期（" + minLease + "个月）");
                                        return false;
                                    }
                                    form.submit();
                                },
                                // 实时验证（输入时立即检查）
                                onkeyup: function(element) {
                                    $(element).valid();
                                },
                                // 错误提示位置
                                errorPlacement: function(error, element) {
                                    error.appendTo(element.parent()).css("color", "red").css("margin-left", "5px");
                                },
                                // 验证通过的样式
                                success: function(label) {
                                    label.remove();
                                }
                            });

                            // 5. 增强体验：输入框实时提示
                            $("#zulinshichang").on("input change", function() {
                                var minLease = parseInt($("#zuiduanzuqi").val()) || 1;
                                var inputVal = $(this).val();

                                if (inputVal && parseInt(inputVal) < minLease) {
                                    $(this).addClass("border-danger");
                                    // 显示实时提示
                                    if (!$(this).next(".lease-tip").length) {
                                        $(this).after('<span class="lease-tip text-danger" style="margin-left:5px;">租赁时长不能小于' + minLease + '个月</span>');
                                    }
                                } else {
                                    $(this).removeClass("border-danger");
                                    $(this).next(".lease-tip").remove();
                                }
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>

<?php include "footer.php" ?>
<?php include "foot.php" ?>