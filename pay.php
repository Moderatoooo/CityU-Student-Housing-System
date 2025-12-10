<?php  require_once 'initialize.php';  ?>
<?php include "head.php" ?>
<link rel="stylesheet" href="css/payment/style.css" />
<form method="post" id="paymentForm" action="zhifu.php">
    <div class="container">
        <div class="hd">
            <div class="hd-main">
                <div class="ep-hd-info">
                    <div class="ep-order-status">
                        <h1>订单模拟支付</h1>
                    </div>
                </div>
                <div class="user-info">
                    <p>账号：xxxxxxxxxx</p>
                </div>
            </div>
        </div>
        <div class="bd">
            <div class="bd-main">
                <div class="ep-wrapper">
                    <div class="ep-pay-step ep-step-channel bd-main-container" style="display: block;">
                        <div class="ep-order-detail">
                            <div>
                                <?php  if($_REQUEST["ordersn"] != null){  ?>
                                <div class="ep-order-tit">
                                    <dl>
                                        <dt>商品订单：</dt>
                                        <dd>
                                            <?php echo $_REQUEST["ordersn"]; ?>
                                            <input type="hidden" name="ordersn" value="<?php echo $_REQUEST["ordersn"]; ?>">
                                        </dd>
                                    </dl>
                                </div>
                                <?php } ?>

                                <?php  if($_REQUEST["zongji"] != null){  ?>
                                <div class="ep-order-tit">
                                    <span>
                                        支付金额：
                                        <em class="rmb">
                                            <i>¥</i><?php echo $_REQUEST["zongji"]; ?>
                                        </em>
                                    </span>
                                    <input type="hidden" name="zongji" value="<?php echo $_REQUEST["zongji"]; ?>">
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="ep-pay-method ep-pay-methods">
                            <dl>
                                <dt>支付方式：</dt>
                                <dd class="pay-channel" id="pay-channel">
                                    <div class="ep-pay-method-list-tit">
                                        <ul>
                                            <li class="selected" data-type="wechat" title="微信支付">
                                                <span class="ep-icon ep-icon-wxpay"></span> <span
                                                    class="ep-pay-method-name">微信支付</span>
                                                <i class="ep-icon ep-icon-selected"></i>
                                            </li>
                                            <?php  if($_REQUEST["alipay"] != null && '1' ==  $_REQUEST["alipay"] ){  ?>
                                            <li class="" data-type="alipay" title="支付宝沙箱">
                                                <span class="ep-icon ep-icon-alipay"></span>
                                                <span class="ep-pay-method-name">支付宝沙箱</span>
                                            </li>
                                            <?php  } else {   ?>
                                            <li class="" data-type="alipay" title="支付宝支付">
                                                <span class="ep-icon ep-icon-alipay"></span>
                                                <span class="ep-pay-method-name">支付宝支付</span>
                                            </li>
                                            <?php } ?>

                                            <li class="" data-type="qqwallet" title="QQ钱包支付">
                                                <span class="ep-icon ep-icon-qqpay"></span>
                                                <span class="ep-pay-method-name">QQ钱包支付</span>
                                            </li>

                                            <?php  if($_REQUEST["bank"] != null){  ?>
                                            <li class="" data-type="bank" title="余额支付">
                                                <span class="ep-icon ep-icon-unionpay"></span>
                                                <span class="ep-pay-method-name">余额支付</span>
                                            </li>
                                            <?php } ?>

                                        </ul>
                                    </div>

                                    <div class="ep-pay-operate">
                                        <input type="hidden" name="id" value="<?php echo $_REQUEST["id"]; ?>">
                                        <input type="hidden" name="biao" value="<?php echo $_REQUEST["biao"]; ?>">
                                        <input type="hidden" name="pay_type" id="pay_type" value="">
                                        <input type="button" id="paymentButton" class="ep-btn ep-btn-blue" value="立即支付" />
                                    </div>

                                </dd>
                            </dl>
                        </div>
                    </div>
                    <div class="ep-pay-step ep-step-pending"></div>
                    <div class="ep-pay-step ep-step-success"></div>
                    <div class="ep-pay-step ep-step-fail"></div>
                </div>
            </div>
        </div>

    </div>
</form>
<script>
    $('#pay-channel').on("click", "li", function (e) {
        $('#pay-channel li.selected').removeClass('selected').find('i.ep-icon-selected').remove();
        $(this).addClass('selected').append('<i class="ep-icon ep-icon-selected"></i>');
    });
    $(function (){
        var alipay = '<?php echo $_REQUEST["alipay"]; ?>';
        $('#paymentButton').click(function (){
            var selected = $('#pay-channel li.selected');
            var data = selected.data();
            $('#pay_type').val(data.type);
            if(alipay == '1' && data.type == 'alipay'){
                // 跳转支付宝沙箱支付处理页面
                var alipayUrl = "alipay.php";
                alipayUrl += (alipayUrl.indexOf("?") === -1 ? "?" : "&")+'id=<?php echo $_REQUEST["id"]; ?>&biao=<?php echo $_REQUEST["biao"]; ?>&ordersn=<?php echo $_REQUEST["ordersn"]; ?>&zongji=<?php echo $_REQUEST["zongji"]; ?>';
                window.location.href = alipayUrl;
            }else{
                // 直接支付
                $('#paymentForm').submit();
            }
        });

    });
</script>


<?php include "foot.php" ?>