<?php require_once 'initialize.php'; ?><?php // --------------------------------------------------
$where = " 1=1 "; // 防止sql 语句where and 这样的错误
$orderby = isset($_REQUEST['orderby']) ? $_REQUEST['orderby'] : 'id';   // 获取前台搜索框中 选择的排序类型,默认为发布时间倒序
$sort = isset($_REQUEST['sort']) ? $_REQUEST['sort'] : 'DESC'; // 获取前台搜索框中 排序类型，默认为倒序

// 设置审核为是
$where .= " AND issh='是' ";

if (!empty($_REQUEST["keyword"])) {
    $where .= "  AND  ( fangwubiaoti LIKE '%" . $_REQUEST["keyword"] . "%' OR xiaoqumingcheng LIKE '%" . $_REQUEST["keyword"] . "%' OR fangwuhuxing LIKE '%" . $_REQUEST["keyword"] . "%' OR louceng LIKE '%" . $_REQUEST["keyword"] . "%' )  ";
}


// 根据搜索提交的表单搜索数据

if ($_GET["fangwubianhao"] != null && !"" == $_GET["fangwubianhao"]) {
    $where .= " AND fangwubianhao LIKE '%" . $_GET["fangwubianhao"] . "%'";
}
if ($_GET["fangwubiaoti"] != null && !"" == $_GET["fangwubiaoti"]) {
    $where .= " AND fangwubiaoti LIKE '%" . $_GET["fangwubiaoti"] . "%'";
}
if ($_GET["leixing"] != null && !"" == $_GET["leixing"]) {
    $where .= " AND leixing ='" . $_GET["leixing"] . "'";
}
if ($_GET["fangwuhuxing"] != null && !"" == $_GET["fangwuhuxing"]) {
    $where .= " AND fangwuhuxing LIKE '%" . $_GET["fangwuhuxing"] . "%'";
}
if ($_GET["louceng_start"] != null && !"" == $_GET["louceng_start"]) {
    $where .= " AND louceng >='" . $_GET["louceng_start"] . "' ";
}
if ($_GET["louceng_end"] != null && !"" == $_GET["louceng_end"]) {
    $where .= " AND louceng <='" . $_GET["louceng_end"] . "' ";
}
if ($_GET["shifouyoudianti"] != null && !"" == $_GET["shifouyoudianti"]) {
    $where .= " AND shifouyoudianti ='" . $_GET["shifouyoudianti"] . "'";
}
if ($_GET["zulinleixing"] != null && !"" == $_GET["zulinleixing"]) {
    $where .= " AND zulinleixing ='" . $_GET["zulinleixing"] . "'";
}
if ($_GET["jiagequjian"] != null && !"" == $_GET["jiagequjian"]) {
    $where .= " AND jiagequjian ='" . $_GET["jiagequjian"] . "'";
}
if ($_GET["yajinfangshi"] != null && !"" == $_GET["yajinfangshi"]) {
    $where .= " AND yajinfangshi ='" . $_GET["yajinfangshi"] . "'";
}
if ($_GET["julixuexiao"] != null && !"" == $_GET["julixuexiao"]) {
    $where .= " AND julixuexiao ='" . $_GET["julixuexiao"] . "'";
}
if ($_GET["fangwuzhuangtai"] != null && !"" == $_GET["fangwuzhuangtai"]) {
    $where .= " AND fangwuzhuangtai ='" . $_GET["fangwuzhuangtai"] . "'";
}
if ($_GET["sheshi"] != null && !"" == $_GET["sheshi"]) {
    $where .= " AND sheshi LIKE '%" . $_GET["sheshi"] . "%'";
}

// 构建fangwuxinxi数据模型
$query = M("fangwuxinxi");
// 设置所有字段
$query->field("*");
$query->where($where)->order("$orderby $sort");   // 根据条件查询列表
list($lists, $page) = $query->page(15);    // 查询列表并返回分页代码

// ------------------------------------------------------------------

?>
<!DOCTYPE html>
<html lang="zh-CN">

<?php include "header.php" ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>房源信息 - 房屋租赁系统</title>
    <?php include "head.php" ?>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Helvetica Neue', Arial, sans-serif;
        }
        .container {
            max-width: 1400px;
            margin: auto;
            padding: 0 15px;
        }
        .section-header {
            background: linear-gradient(135deg, #527CAE 0%, #7798C1 100%);
            color: white;
            padding: 25px;
            text-align: center;
            border-radius: 12px 12px 0 0;
            margin-bottom: 25px;
        }
        .section-header h2 {
            margin: 0;
            font-size: 28px;
            font-weight: bold;
        }
        .search-filters {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            margin-bottom: 25px;
        }
        .filter-rows {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .filter-row {
            flex: 1;
            min-width: 300px;
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }
        .filter-group {
            flex: 1;
            min-width: 200px;
        }
        .filter-title {
            font-weight: 600;
            margin-bottom: 6px;
            color: #495057;
            font-size: 13px;
        }
        .filter-options {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }
        .filter-option {
            padding: 5px 10px;
            background: #f1f3f5;
            border: 1px solid #e0e0e0;
            border-radius: 15px;
            cursor: pointer;
            font-size: 11px;
            transition: all 0.3s ease;
        }
        .filter-option:hover {
            background: #e0e6ed;
        }
        .filter-option.active {
            background: #3498db;
            color: white;
            border-color: #3498db;
        }
        .search-inputs {
            display: flex;
            gap: 10px;
            align-items: end;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid #eee;
        }
        .search-inputs .form-group {
            flex: 1;
            margin-bottom: 0;
        }
        .search-inputs button {
            height: 40px;
        }
        .properties-section {
            background: linear-gradient(120deg, #f0f4f8 0%, #e6ecef 100%);
            padding: 30px 0;
            border-radius: 0 0 12px 12px;
        }
        .properties-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 25px;
            padding: 0 15px;
        }
        .property-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        .property-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        .property-image {
            height: 160px;
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
            font-size: 15px;
        }
        .property-info {
            padding: 18px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        .property-title {
            font-size: 16px;
            font-weight: bold;
            margin: 0 0 8px 0;
            color: #2c3e50;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .property-title a {
            color: inherit;
            text-decoration: none;
        }
        .property-title a:hover {
            color: #3498db;
        }
        .property-description {
            color: #6c757d;
            font-size: 12px;
            margin-bottom: 12px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            flex: 1;
        }
        .property-details {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-bottom: 10px;
        }
        .detail-item {
            background: #eef2f7;
            padding: 4px 8px;
            border-radius: 15px;
            font-size: 10.5px;
            color: #495057;
        }
        .property-meta {
            display: flex;
            justify-content: space-between;
            padding-top: 10px;
            border-top: 1px dashed #eee;
            color: #6c757d;
            font-size: 11.5px;
        }
        .pagination-container {
            display: flex;
            justify-content: center;
            margin: 30px 0;
        }
        @media (max-width: 1400px) {
            .properties-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }
        @media (max-width: 1100px) {
            .properties-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        @media (max-width: 768px) {
            .filter-row {
                flex-direction: column;
                gap: 15px;
            }
            .filter-group {
                min-width: 100%;
            }
            .search-inputs {
                flex-direction: column;
                align-items: stretch;
            }
            .search-inputs button {
                width: 100%;
            }
            .properties-grid {
                grid-template-columns: 1fr;
            }
            .section-header h2 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="section-header">
        <h2>优质房源</h2>
    </div>
    
    <div class="search-filters">
        <form action="?" method="get" id="filterForm">
            <div class="filter-rows">
                <div class="filter-row">

                    <div class="filter-group">
                        <div class="filter-title">类型</div>
                        <div class="filter-options">
                            <span class="filter-option <?php echo empty($_GET["leixing"]) ? 'active' : ''; ?>" data-field="leixing" data-value="">全部</span>
                            <?php $mapfangwuleixing5 = db()->select("SELECT id,leixing FROM fangwuleixing"); ?>
                            <?php foreach ($mapfangwuleixing5 as $r): ?>
                                <span class="filter-option <?php echo $_GET["leixing"] == $r["id"] ? 'active' : ''; ?>" data-field="leixing" data-value="<?php echo $r["id"]; ?>"><?php echo $r["leixing"]; ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="filter-group">
                        <div class="filter-title">价格区间</div>
                        <div class="filter-options">
                            <span class="filter-option <?php echo empty($_GET["jiagequjian"]) ? 'active' : ''; ?>" data-field="jiagequjian" data-value="">全部</span>
                            <span class="filter-option <?php echo $_GET["jiagequjian"] == '100以下' ? 'active' : ''; ?>" data-field="jiagequjian" data-value="100以下">100以下</span>
                            <span class="filter-option <?php echo $_GET["jiagequjian"] == '100-500' ? 'active' : ''; ?>" data-field="jiagequjian" data-value="100-500">100-500</span>
                            <span class="filter-option <?php echo $_GET["jiagequjian"] == '500-1000' ? 'active' : ''; ?>" data-field="jiagequjian" data-value="500-1000">500-1000</span>
                            <span class="filter-option <?php echo $_GET["jiagequjian"] == '1000-2000' ? 'active' : ''; ?>" data-field="jiagequjian" data-value="1000-2000">1000-2000</span>
                            <span class="filter-option <?php echo $_GET["jiagequjian"] == '2000-3000' ? 'active' : ''; ?>" data-field="jiagequjian" data-value="2000-3000">2000-3000</span>
                            <span class="filter-option <?php echo $_GET["jiagequjian"] == '3000以上' ? 'active' : ''; ?>" data-field="jiagequjian" data-value="3000以上">3000以上</span>
                        </div>
                    </div>



                    <div class="filter-group">
                        <div class="filter-title">排序</div>
                        <div class="filter-options">
                            <span class="filter-option <?php echo $orderby == 'id' ? 'active' : ($orderby != 'zuiduanzuqi' && $orderby != 'shoucangliang' && $orderby != 'liulanliang' ? 'active' : ''); ?>" data-field="orderby" data-value="id">发布时间</span>
                            <span class="filter-option <?php echo $orderby == 'zuiduanzuqi' ? 'active' : ''; ?>" data-field="orderby" data-value="zuiduanzuqi">最短租期</span>
                            <span class="filter-option <?php echo $orderby == 'shoucangliang' ? 'active' : ''; ?>" data-field="orderby" data-value="shoucangliang">收藏量</span>
                            <span class="filter-option <?php echo $orderby == 'liulanliang' ? 'active' : ''; ?>" data-field="orderby" data-value="liulanliang">浏览量</span>
                        </div>
                    </div>


                </div>
                
                <div class="filter-row">

                    <div class="filter-group">
                        <div class="filter-title">设施</div>
                        <div class="filter-options">
                            <span class="filter-option <?php echo empty($_GET["sheshi"]) ? 'active' : ''; ?>" data-field="sheshi" data-value="">全部</span>
                            <span class="filter-option <?php echo $_GET["sheshi"] == '床' ? 'active' : ''; ?>" data-field="sheshi" data-value="床">床</span>
                            <span class="filter-option <?php echo $_GET["sheshi"] == '衣柜' ? 'active' : ''; ?>" data-field="sheshi" data-value="衣柜">衣柜</span>
                            <span class="filter-option <?php echo $_GET["sheshi"] == '沙发' ? 'active' : ''; ?>" data-field="sheshi" data-value="沙发">沙发</span>
                            <span class="filter-option <?php echo $_GET["sheshi"] == '电视' ? 'active' : ''; ?>" data-field="sheshi" data-value="电视">电视</span>
                            <span class="filter-option <?php echo $_GET["sheshi"] == '冰箱' ? 'active' : ''; ?>" data-field="sheshi" data-value="冰箱">冰箱</span>
                        </div>
                    </div>

                    <div class="filter-group">
                        <div class="filter-title">距离学校</div>
                        <div class="filter-options">
                            <span class="filter-option <?php echo empty($_GET["julixuexiao"]) ? 'active' : ''; ?>" data-field="julixuexiao" data-value="">全部</span>
                            <span class="filter-option <?php echo $_GET["julixuexiao"] == '100米' ? 'active' : ''; ?>" data-field="julixuexiao" data-value="100米">100米</span>
                            <span class="filter-option <?php echo $_GET["julixuexiao"] == '500米' ? 'active' : ''; ?>" data-field="julixuexiao" data-value="500米">500米</span>
                            <span class="filter-option <?php echo $_GET["julixuexiao"] == '1000米' ? 'active' : ''; ?>" data-field="julixuexiao" data-value="1000米">1000米</span>
                            <span class="filter-option <?php echo $_GET["julixuexiao"] == '1000米以上' ? 'active' : ''; ?>" data-field="julixuexiao" data-value="1000米以上">1000米以上</span>
                        </div>
                    </div>
                    
                    <div class="filter-group">
                        <div class="filter-title">押金方式</div>
                        <div class="filter-options">
                            <span class="filter-option <?php echo empty($_GET["yajinfangshi"]) ? 'active' : ''; ?>" data-field="yajinfangshi" data-value="">全部</span>
                            <span class="filter-option <?php echo $_GET["yajinfangshi"] == '免押金' ? 'active' : ''; ?>" data-field="yajinfangshi" data-value="免押金">免押金</span>
                            <span class="filter-option <?php echo $_GET["yajinfangshi"] == '押一付一' ? 'active' : ''; ?>" data-field="yajinfangshi" data-value="押一付一">押一付一</span>
                            <span class="filter-option <?php echo $_GET["yajinfangshi"] == '押二付一' ? 'active' : ''; ?>" data-field="yajinfangshi" data-value="押二付一">押二付一</span>
                            <span class="filter-option <?php echo $_GET["yajinfangshi"] == '其他' ? 'active' : ''; ?>" data-field="yajinfangshi" data-value="其他">其他</span>
                        </div>
                    </div>




                </div>
                
                <div class="filter-row">



                    <div class="filter-group">
                        <div class="filter-title">租赁类型</div>
                        <div class="filter-options">
                            <span class="filter-option <?php echo empty($_GET["zulinleixing"]) ? 'active' : ''; ?>" data-field="zulinleixing" data-value="">全部</span>
                            <span class="filter-option <?php echo $_GET["zulinleixing"] == '整租' ? 'active' : ''; ?>" data-field="zulinleixing" data-value="整租">整租</span>
                            <span class="filter-option <?php echo $_GET["zulinleixing"] == '分租' ? 'active' : ''; ?>" data-field="zulinleixing" data-value="分租">分租</span>
                        </div>
                    </div>


                    <div class="filter-group">
                        <div class="filter-title">是否有电梯</div>
                        <div class="filter-options">
                            <span class="filter-option <?php echo empty($_GET["shifouyoudianti"]) ? 'active' : ''; ?>" data-field="shifouyoudianti" data-value="">全部</span>
                            <span class="filter-option <?php echo $_GET["shifouyoudianti"] == '是' ? 'active' : ''; ?>" data-field="shifouyoudianti" data-value="是">是</span>
                            <span class="filter-option <?php echo $_GET["shifouyoudianti"] == '否' ? 'active' : ''; ?>" data-field="shifouyoudianti" data-value="否">否</span>
                        </div>
                    </div>

                    <div class="filter-group">
                        <div class="filter-title">房屋状态</div>
                        <div class="filter-options">
                            <span class="filter-option <?php echo empty($_GET["fangwuzhuangtai"]) ? 'active' : ''; ?>" data-field="fangwuzhuangtai" data-value="">全部</span>
                            <span class="filter-option <?php echo $_GET["fangwuzhuangtai"] == '待租' ? 'active' : ''; ?>" data-field="fangwuzhuangtai" data-value="待租">待租</span>
                            <span class="filter-option <?php echo $_GET["fangwuzhuangtai"] == '已租' ? 'active' : ''; ?>" data-field="fangwuzhuangtai" data-value="已租">已租</span>
                        </div>
                    </div>
                    

                </div>
                
                <div class="filter-row">

                    

                </div>
            </div>
            
            <div class="filter-row">
                <div class="filter-group">
                    <div class="filter-title">设施</div>
                    <div class="filter-options">
                        <span class="filter-option <?php echo empty($_GET["sheshi"]) ? 'active' : ''; ?>" data-field="sheshi" data-value="">全部</span>
                        <span class="filter-option <?php echo $_GET["sheshi"] == '床' ? 'active' : ''; ?>" data-field="sheshi" data-value="床">床</span>
                        <span class="filter-option <?php echo $_GET["sheshi"] == '衣柜' ? 'active' : ''; ?>" data-field="sheshi" data-value="衣柜">衣柜</span>
                        <span class="filter-option <?php echo $_GET["sheshi"] == '沙发' ? 'active' : ''; ?>" data-field="sheshi" data-value="沙发">沙发</span>
                        <span class="filter-option <?php echo $_GET["sheshi"] == '电视' ? 'active' : ''; ?>" data-field="sheshi" data-value="电视">电视</span>
                        <span class="filter-option <?php echo $_GET["sheshi"] == '冰箱' ? 'active' : ''; ?>" data-field="sheshi" data-value="冰箱">冰箱</span>
                        <span class="filter-option <?php echo $_GET["sheshi"] == '洗衣机' ? 'active' : ''; ?>" data-field="sheshi" data-value="洗衣机">洗衣机</span>
                        <span class="filter-option <?php echo $_GET["sheshi"] == '空调' ? 'active' : ''; ?>" data-field="sheshi" data-value="空调">空调</span>
                        <span class="filter-option <?php echo $_GET["sheshi"] == '热水器' ? 'active' : ''; ?>" data-field="sheshi" data-value="热水器">热水器</span>
                        <span class="filter-option <?php echo $_GET["sheshi"] == '宽带' ? 'active' : ''; ?>" data-field="sheshi" data-value="宽带">宽带</span>
                        <span class="filter-option <?php echo $_GET["sheshi"] == '暖气' ? 'active' : ''; ?>" data-field="sheshi" data-value="暖气">暖气</span>
                        <span class="filter-option <?php echo $_GET["sheshi"] == '燃气罩' ? 'active' : ''; ?>" data-field="sheshi" data-value="燃气罩">燃气罩</span>
                        <span class="filter-option <?php echo $_GET["sheshi"] == '阳台' ? 'active' : ''; ?>" data-field="sheshi" data-value="阳台">阳台</span>
                        <span class="filter-option <?php echo $_GET["sheshi"] == '卫生巾' ? 'active' : ''; ?>" data-field="sheshi" data-value="卫生巾">卫生巾</span>
                        <span class="filter-option <?php echo $_GET["sheshi"] == '只能门锁' ? 'active' : ''; ?>" data-field="sheshi" data-value="只能门锁">只能门锁</span>
                        <span class="filter-option <?php echo $_GET["sheshi"] == '油烟机' ? 'active' : ''; ?>" data-field="sheshi" data-value="油烟机">油烟机</span>
                        <span class="filter-option <?php echo $_GET["sheshi"] == '可做饭' ? 'active' : ''; ?>" data-field="sheshi" data-value="可做饭">可做饭</span>
                    </div>
                </div>


                <div class="search-inputs">
                    <div class="form-group">
                        <label><i class="glyphicon glyphicon-home"></i> 房屋标题</label>
                        <input type="text" class="form-control" name="fangwubiaoti" value="<?php echo $_GET["fangwubiaoti"]; ?>" placeholder="请输入房屋标题关键词"/>
                    </div>
                    <div class="form-group">
                        <label><i class="glyphicon glyphicon-th-large"></i> 房屋户型</label>
                        <input type="text" class="form-control" name="fangwuhuxing" value="<?php echo $_GET["fangwuhuxing"]; ?>" placeholder="请输入房屋户型关键词"/>
                    </div>
                    <button type="submit" class="btn btn-primary">搜索</button>
                </div>
            </div>
        </form>
    </div>
    
    <div class="properties-section">
        <div class="container">
            <div class="properties-grid">
                <?php foreach ($lists as $r): ?>
                    <div class="property-card">
                        <a href="fangwuxinxidetail.php?id=<?php echo $r["id"]; ?>" style="display: block;">
                            <div class="property-image" style="background-image: url('<?php echo Info::images($r["fangwutupian"]); ?>');">
                                <div class="property-price">￥<?php echo $r["fangwuzujin"]; ?>/月</div>
                            </div>
                        </a>
                        <div class="property-info">
                            <a href="fangwuxinxidetail.php?id=<?php echo $r["id"]; ?>">
                                <div class="property-title"><?php echo $r["fangwubiaoti"]; ?></div>
                            </a>
                            <div class="property-description"><?php echo Info::subStr($r["fangwuxiangqing"], 60); ?></div>
                            <div class="property-details">
                                <span class="detail-item">
                                    <?php $mapfangwuleixing6 = db()->find("SELECT leixing,id FROM fangwuleixing where id='" . $r["leixing"] . "'"); ?>
                                    <?php echo $mapfangwuleixing6["leixing"]; ?>
                                </span>
                                <span class="detail-item"><?php echo $r["xiaoqumingcheng"]; ?></span>
                                <span class="detail-item"><?php echo $r["fangwuhuxing"]; ?></span>
                                <span class="detail-item"><?php echo $r["yajinfangshi"]; ?></span>
                                <span class="detail-item"><?php echo $r["mianji"]; ?>/㎡</span>
                                <span class="detail-item"><?php echo $r["louceng"]; ?>/层</span>
                                <span class="detail-item"><?php echo $r["zulinleixing"]; ?></span>
                            </div>
                            <div class="property-meta">
                                <span><i class="glyphicon glyphicon-map-marker"></i> <?php echo $r["fangwudizhi"]; ?></span>
                                <span><i class="glyphicon glyphicon-phone"></i> <?php echo $r["lianxidianhua"]; ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    
    <div class="pagination-container">
        <?php echo $page->show() ?>
    </div>
</div>

<script>
    // 处理筛选按钮点击事件
    document.querySelectorAll('.filter-option').forEach(option => {
        option.addEventListener('click', function() {
            const field = this.getAttribute('data-field');
            const value = this.getAttribute('data-value');

            // 更新同组的选项状态
            this.parentElement.querySelectorAll('.filter-option').forEach(opt => {
                opt.classList.remove('active');
            });
            this.classList.add('active');
            
            // 更新隐藏input的值
            const existingInput = document.querySelector(`input[name="${field}"]`);
            if(existingInput) {
                existingInput.value = value;
            } else {
                const form = document.getElementById('filterForm');
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = field;
                hiddenInput.value = value;
                form.appendChild(hiddenInput);
            }
            
            // 提交表单
            document.getElementById('filterForm').submit();
        });
    });
    
    // 修正初始排序选项的active状态
    document.addEventListener('DOMContentLoaded', function() {
        const orderbyValue = "<?php echo $orderby; ?>";
        if(orderbyValue) {
            const orderbyOption = document.querySelector(`.filter-option[data-field="orderby"][data-value="${orderbyValue}"]`);
            if(orderbyOption) {
                // 移除所有orderby选项的active状态
                document.querySelectorAll('.filter-option[data-field="orderby"]').forEach(opt => {
                    opt.classList.remove('active');
                });
                // 添加当前排序的active状态
                orderbyOption.classList.add('active');
            }
        }
    });
</script>

<?php include "footer.php" ?>
<?php include "foot.php" ?>
</body>
</html>