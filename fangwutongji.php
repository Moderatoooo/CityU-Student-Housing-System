<?php require_once 'initialize.php'; ?><?php include "head.php" ?>

    <script src="js/echarts/echarts.js"></script>


    <div>

        <?php
        $where = " 1=1 ";
        if ($_GET["fangwubiaoti"] != null && $_GET["fangwubiaoti"] != '') {
            $where .= " AND fwx.fangwubiaoti LIKE '%" . $_GET["fangwubiaoti"] . "%'";
        }
        if ($_GET["leixing"] != null && $_GET["leixing"] != '') {
            $where .= " AND fwx.leixing='" . $_GET["leixing"] . "'";
        }
        if ($_GET["xiaoqumingcheng"] != null && $_GET["xiaoqumingcheng"] != '') {
            $where .= " AND fwx.xiaoqumingcheng LIKE '%" . $_GET["xiaoqumingcheng"] . "%'";
        }
        if ($_GET["fangwuhuxing"] != null && $_GET["fangwuhuxing"] != '') {
            $where .= " AND fwx.fangwuhuxing LIKE '%" . $_GET["fangwuhuxing"] . "%'";
        }
        if ($_GET["louceng"] != null && $_GET["louceng"] != '') {
            $where .= " AND fwx.louceng LIKE '%" . $_GET["louceng"] . "%'";
        }
        if ($_GET["mianji"] != null && $_GET["mianji"] != '') {
            $where .= " AND fwx.mianji LIKE '%" . $_GET["mianji"] . "%'";
        }
        if ($_GET["yajinfangshi"] != null && $_GET["yajinfangshi"] != '') {
            $where .= " AND fwx.yajinfangshi='" . $_GET["yajinfangshi"] . "'";
        }
        if ($_GET["fangwudizhi"] != null && $_GET["fangwudizhi"] != '') {
            $where .= " AND fwx.fangwudizhi LIKE '%" . $_GET["fangwudizhi"] . "%'";
        }
        if ($_GET["fangwuzhuangtai"] != null && $_GET["fangwuzhuangtai"] != '') {
            $where .= " AND fwx.fangwuzhuangtai='" . $_GET["fangwuzhuangtai"] . "'";
        }
        if ($_GET["fangjianshu"] != null && $_GET["fangjianshu"] != '') {
            $where .= " AND fwx.fangjianshu LIKE '%" . $_GET["fangjianshu"] . "%'";
        }
        if ($_GET["sheshi"] != null && $_GET["sheshi"] != '') {
            $where .= " AND fwx.sheshi LIKE '%" . $_GET["sheshi"] . "%'";
        }
        if ($_GET["leixing"] != null && $_GET["leixing"] != '') {
            $where .= " AND fwl.leixing LIKE '%" . $_GET["leixing"] . "%'";
        }

        $fangwuxinxiList = M("fangwuxinxi")->alias("fwx")->joinLeft("fangwuleixing fwl", "fwx.leixing=fwl.id")->field("fwl.leixing")->group("fwl.leixing")->field("sum(fwx.shoucangliang) sum_shoucangliang")->field("sum(fwx.liulanliang) sum_liulanliang")->field("avg(fwx.fangwuzujin) avg_fangwuzujin")->where($where)->select();


        ?>

        <div style="padding: 20px">
            <form class="form-inline" action="?" style="background: #ffffff;padding: 20px;border-radius: 10px;">
                <!-- form 标签开始 -->


                房屋标题：<input type="text" class="form-control" style="" name="fangwubiaoti"
                            value="<?php echo $_GET["fangwubiaoti"]; ?>"/> 类型：<select
                        class="form-control class_leixing85" data-value="<?php echo $_GET["leixing"]; ?>" id="leixing"
                        name="leixing">
                    <option value="">请选择
                    </option><?php $select = db()->select("SELECT * FROM fangwuleixing ORDER BY id desc"); ?>
                    <?php foreach ($select as $m) { ?>
                        <option value="<?php echo $m["id"]; ?>"><?php echo $m["leixing"]; ?></option>
                    <?php } ?>

                </select>
                <script>
                    $(".class_leixing85").val($(".class_leixing85").attr("data-value"))</script>
                小区名称：<input type="text" class="form-control" style="" name="xiaoqumingcheng"
                            value="<?php echo $_GET["xiaoqumingcheng"]; ?>"/> 房屋户型：<input type="text"
                                                                                          class="form-control" style=""
                                                                                          name="fangwuhuxing"
                                                                                          value="<?php echo $_GET["fangwuhuxing"]; ?>"/>
                楼层：<input type="text" class="form-control" style="" name="louceng"
                          value="<?php echo $_GET["louceng"]; ?>"/> 面积：<input type="text" class="form-control" style=""
                                                                              name="mianji"
                                                                              value="<?php echo $_GET["mianji"]; ?>"/>
                押金方式：<select class="form-control class_yajinfangshi86" data-value="<?php echo $_GET["yajinfangshi"]; ?>"
                             data-rule-required="true" data-msg-required="请填写押金方式" id="yajinfangshi"
                             name="yajinfangshi">
                    <option value="">请选择</option>
                    <option value="免押金">免押金</option>
                    <option value="押一付一">押一付一</option>
                    <option value="押二付一">押二付一</option>
                    <option value="其他">其他</option>

                </select>
                <script>
                    $(".class_yajinfangshi86").val($(".class_yajinfangshi86").attr("data-value"))</script>
                房屋地址：<input type="text" class="form-control" style="" name="fangwudizhi"
                            value="<?php echo $_GET["fangwudizhi"]; ?>"/> 房屋状态：<select
                        class="form-control class_fangwuzhuangtai87"
                        data-value="<?php echo $_GET["fangwuzhuangtai"]; ?>" id="fangwuzhuangtai"
                        name="fangwuzhuangtai">
                    <option value="">请选择</option>
                    <option value="待租">待租</option>
                    <option value="已租">已租</option>

                </select>
                <script>
                    $(".class_fangwuzhuangtai87").val($(".class_fangwuzhuangtai87").attr("data-value"))</script>
                房间数：<input type="text" class="form-control" style="" name="fangjianshu"
                           value="<?php echo $_GET["fangjianshu"]; ?>"/> 设施：<input type="text" class="form-control"
                                                                                   id="sheshi" name="sheshi"
                                                                                   value="<?php echo $_GET["sheshi"]; ?>"/>
                类型：<input type="text" class="form-control" style="" name="leixing"
                          value="<?php echo $_GET["leixing"]; ?>"/>
                <button type="submit" class="btn btn-default">
                    搜索
                </button>

                <!--form标签结束--></form>
        </div>


    </div>


    <div>


        <div class="container"><!-- 使用bootstrap css框架，container定宽，并剧中 https://v3.bootcss.com/css/#overview-container -->


            <div style="padding: 10px;background: #ffffff">
                <table class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th width="180">
                            类型
                        </th>
<!--                        <th>-->
<!--                            收藏量-->
<!--                        </th>-->
                        <th>
                            浏览量
                        </th>
                        <th>
                            房屋租金
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($fangwuxinxiList as $v) { ?>
                        <tr>
                            <td><?php echo $v["leixing"]; ?></td>
<!--                            <td>--><?php //echo $v["sum_shoucangliang"]; ?><!--</td>-->
                            <td><?php echo $v["sum_liulanliang"]; ?></td>
                            <td><?php echo number_format($v["avg_fangwuzujin"], 2, '.', ''); ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>


            <!-- container定宽，并剧中结束 --></div>


    </div>


    <div>


        <div class="container"><!-- 使用bootstrap css框架，container定宽，并剧中 https://v3.bootcss.com/css/#overview-container -->


            <!-- container定宽，并剧中结束 --></div>


        <div class="container"><!-- 使用bootstrap css框架，container定宽，并剧中 https://v3.bootcss.com/css/#overview-container -->


            <div id="lineOptionsKey1" class="" style="height: 300px;background-color: #ffffff;padding: 20px"></div>


            <script>
                var chartDom = document.getElementById('lineOptionsKey1');
                var myChart = echarts.init(chartDom);
                var option = {
                    title: {
                        text: "房屋类型统计"
                    },
                    color: ['#5470c6', '#91cc75', '#fac858', '#ee6666', '#73c0de', '#3ba272', '#fc8452', '#9a60b4'],
                    tooltip: {
                        trigger: 'axis'
                    },
                    grid: {
                        left: '3%',
                        right: '4%',
                        bottom: '3%',
                        containLabel: true
                    },
                    toolbox: {
                        feature: {
                            saveAsImage: {}
                        }
                    },
                    xAxis: {
                        type: 'category',
                        boundaryGap: false,
                        data: [
                            <?php  foreach($fangwuxinxiList as $v){  ?>
                            '<?php echo $v["leixing"]; ?>',
                            <?php } ?>
                        ]
                    },
                    yAxis: {
                        type: 'value'
                    },
                    series: [
                        //{
                        //    name: '收藏量',
                        //    type: 'line',
                        //    stack: 'Total',
                        //    data: [
                        //        <?php // foreach($fangwuxinxiList as $v){  ?>
                        //        <?php //echo $v["sum_shoucangliang"]; ?>//,
                        //        <?php //} ?>
                        //    ]
                        //},
                        {
                            name: '浏览量',
                            type: 'line',
                            stack: 'Total',
                            data: [
                                <?php  foreach($fangwuxinxiList as $v){  ?>
                                <?php echo $v["sum_liulanliang"]; ?>,
                                <?php } ?>
                            ]
                        },
                        {
                            name: '房屋平均租金',
                            type: 'line',
                            stack: 'Total',
                            data: [
                                <?php  foreach($fangwuxinxiList as $v){  ?>
                                <?php echo $v["avg_fangwuzujin"]; ?>,
                                <?php } ?>
                            ]
                        },
                    ]
                }

                option && myChart.setOption(option);
            </script>


            <!-- container定宽，并剧中结束 --></div>


    </div>


    <div>


        <div class="container"><!-- 使用bootstrap css框架，container定宽，并剧中 https://v3.bootcss.com/css/#overview-container -->


            <div id="pieOptionsKey1" class="" style="height: 300px;background-color: #ffffff;padding: 20px"></div>


            <script>
                var chartDom = document.getElementById('pieOptionsKey1');
                var myChart = echarts.init(chartDom);
                var option = {
                    title: {
                        text: '房屋浏览占比',
                        left: 'center'
                    },
                    tooltip: {
                        trigger: 'item',
                        formatter: '{b}：{c},{d}%'
                    },
                    legend: {
                        orient: 'vertical',
                        left: 'left'
                    },
                    series: [
                        {
                            name: '浏览量',
                            type: 'pie',
                            radius: '50%',
                            data: [
                                <?php  foreach($fangwuxinxiList as $v){  ?>
                                {
                                    value: parseFloat("<?php echo $v["sum_liulanliang"]; ?>"),
                                    name: '<?php echo $v["leixing"]; ?>'
                                },
                                <?php } ?>
                            ],
                            emphasis: {
                                itemStyle: {
                                    shadowBlur: 10,
                                    shadowOffsetX: 0,
                                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                                }
                            }
                        }
                    ]
                }

                option && myChart.setOption(option);
            </script>


            <!-- container定宽，并剧中结束 --></div>


    </div>


<?php include "foot.php" ?>