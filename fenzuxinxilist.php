<?php require_once 'initialize.php'; ?><?php // --------------------------------------------------
$where = " 1=1 "; // 防止sql 语句where and 这样的错误
$orderby = isset($_REQUEST['orderby']) ? $_REQUEST['orderby'] : 'id';   // 获取前台搜索框中 选择的排序类型,默认为发布时间倒序
$sort = isset($_REQUEST['sort']) ? $_REQUEST['sort'] : 'DESC'; // 获取前台搜索框中 排序类型，默认为倒序

// 设置审核为是
$where .= " AND issh='是' ";


// 设置zulin模块，表id 的值是提交过来，有则只查询这些内容


if ($_REQUEST["zulinid"] != "") {
    $where .= " AND zulinid='" . $_REQUEST["zulinid"] . "' ";
}
// 根据搜索提交的表单搜索数据

if ($_GET["fangwubiaoti"] != null && !"" == $_GET["fangwubiaoti"]) {
    $where .= " AND fangwubiaoti LIKE '%" . $_GET["fangwubiaoti"] . "%'";
}
if ($_GET["fangwuhuxing"] != null && !"" == $_GET["fangwuhuxing"]) {
    $where .= " AND fangwuhuxing LIKE '%" . $_GET["fangwuhuxing"] . "%'";
}
if ($_GET["yajinfangshi"] != null && !"" == $_GET["yajinfangshi"]) {
    $where .= " AND yajinfangshi ='" . $_GET["yajinfangshi"] . "'";
}
if ($_GET["leixing"] != null && !"" == $_GET["leixing"]) {
    $where .= " AND leixing ='" . $_GET["leixing"] . "'";
}
if ($_GET["jiagequjian"] != null && !"" == $_GET["jiagequjian"]) {
    $where .= " AND jiagequjian ='" . $_GET["jiagequjian"] . "'";
}
if ($_GET["julixuexiao"] != null && !"" == $_GET["julixuexiao"]) {
    $where .= " AND julixuexiao ='" . $_GET["julixuexiao"] . "'";
}
if ($_GET["sheshi"] != null && !"" == $_GET["sheshi"]) {
    $where .= " AND sheshi LIKE '%" . $_GET["sheshi"] . "%'";
}
if ($_GET["shifouyoudianti"] != null && !"" == $_GET["shifouyoudianti"]) {
    $where .= " AND shifouyoudianti ='" . $_GET["shifouyoudianti"] . "'";
}
if ($_GET["zulinleixing"] != null && !"" == $_GET["zulinleixing"]) {
    $where .= " AND zulinleixing ='" . $_GET["zulinleixing"] . "'";
}
if ($_GET["biaoti"] != null && !"" == $_GET["biaoti"]) {
    $where .= " AND biaoti LIKE '%" . $_GET["biaoti"] . "%'";
}
if ($_GET["lianxiren"] != null && !"" == $_GET["lianxiren"]) {
    $where .= " AND lianxiren LIKE '%" . $_GET["lianxiren"] . "%'";
}

// 构建fenzuxinxi数据模型
$query = M("fenzuxinxi");
// 设置所有字段
$query->field("*");
$query->where($where)->order("$orderby $sort");   // 根据条件查询列表
list($lists, $page) = $query->page(15);    // 查询列表并返回分页代码

// ------------------------------------------------------------------

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>合租房源 - 房屋租赁系统</title>
    <?php include "head.php" ?>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Helvetica Neue', Arial, sans-serif;
        }
        .container {
            max-width: 1200px;
            margin:auto;
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
        .filter-row {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 15px;
        }
        .filter-group {
            flex: 1;
            min-width: 200px;
        }
        .filter-title {
            font-weight: 600;
            margin-bottom: 8px;
            color: #495057;
            font-size: 14px;
        }
        .filter-options {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
        .filter-option {
            padding: 6px 12px;
            background: #f1f3f5;
            border: 1px solid #e0e0e0;
            border-radius: 20px;
            cursor: pointer;
            font-size: 12px;
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
        .search-input {
            display: flex;
            gap: 10px;
            align-items: end;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #eee;
        }
        .search-input input {
            flex: 1;
        }
        .properties-list {
            display: flex;
            flex-direction: column;
            gap: 25px;
        }
        .property-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            display: flex;
            flex-direction: row;
            transition: all 0.3s ease;
        }
        .property-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        .property-image {
            width: 300px;
            height: 200px;
            background-size: cover;
            background-position: center;
            flex-shrink: 0;
        }
        .property-content {
            padding: 25px;
            flex: 1;
        }
        .property-title {
            font-size: 20px;
            font-weight: bold;
            margin: 0 0 12px 0;
            color: #2c3e50;
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
            margin-bottom: 15px;
            line-height: 1.6;
        }
        .property-features {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 15px;
        }
        .feature-item {
            background: #eef2f7;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            color: #495057;
        }
        .property-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 15px;
            border-top: 1px solid #eee;
            color: #6c757d;
        }
        .property-price {
            font-size: 22px;
            font-weight: bold;
            color: #e74c3c;
        }
        .btn-apply {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            padding: 8px 20px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .btn-apply:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(37, 117, 252, 0.4);
        }
        .pagination-container {
            display: flex;
            justify-content: center;
            margin: 30px 0;
        }
        .active-indicator::after {
            content: " (当前)";
            color: #3498db;
            font-weight: normal;
        }
        @media (max-width: 992px) {
            .property-card {
                flex-direction: column;
            }
            .property-image {
                width: 100%;
                height: 200px;
            }
        }
        @media (max-width: 768px) {
            .filter-group {
                min-width: 150px;
            }
            .section-header h2 {
                font-size: 24px;
            }
        }
        @media (max-width: 576px) {
            .filter-group {
                min-width: 100%;
            }
            .filter-row {
                flex-direction: column;
            }
            .property-content {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
<?php include "header.php" ?>

<div class="container">
    <div class="section-header">
        <h2>合租房源</h2>
    </div>
    
    <div class="search-filters">
        <form action="?" method="get" id="filterForm">
            <div class="filter-row">
                <div class="filter-group">
                    <div class="filter-title">类型</div>
                    <div class="filter-options">
                        <span class="filter-option <?php echo empty($_GET["leixing"]) ? 'active' : ''; ?>" data-field="leixing" data-value="">全部</span>
                        <?php $mapfangwuleixing7 = db()->select("SELECT id,leixing FROM fangwuleixing"); ?>
                        <?php foreach ($mapfangwuleixing7 as $r): ?>
                            <span class="filter-option <?php echo $_GET["leixing"] == $r["id"] ? 'active' : ''; ?>" data-field="leixing" data-value="<?php echo $r["id"]; ?>"><?php echo $r["leixing"]; ?></span>
                        <?php endforeach; ?>
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
                    <div class="filter-title">距离学校</div>
                    <div class="filter-options">
                        <span class="filter-option <?php echo empty($_GET["julixuexiao"]) ? 'active' : ''; ?>" data-field="julixuexiao" data-value="">全部</span>
                        <span class="filter-option <?php echo $_GET["julixuexiao"] == '100米' ? 'active' : ''; ?>" data-field="julixuexiao" data-value="100米">100米</span>
                        <span class="filter-option <?php echo $_GET["julixuexiao"] == '500米' ? 'active' : ''; ?>" data-field="julixuexiao" data-value="500米">500米</span>
                        <span class="filter-option <?php echo $_GET["julixuexiao"] == '1000米' ? 'active' : ''; ?>" data-field="julixuexiao" data-value="1000米">1000米</span>
                        <span class="filter-option <?php echo $_GET["julixuexiao"] == '1000米以上' ? 'active' : ''; ?>" data-field="julixuexiao" data-value="1000米以上">1000米以上</span>
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
                
                <div class="filter-group">
                    <div class="filter-title">是否有电梯</div>
                    <div class="filter-options">
                        <span class="filter-option <?php echo empty($_GET["shifouyoudianti"]) ? 'active' : ''; ?>" data-field="shifouyoudianti" data-value="">全部</span>
                        <span class="filter-option <?php echo $_GET["shifouyoudianti"] == '是' ? 'active' : ''; ?>" data-field="shifouyoudianti" data-value="是">是</span>
                        <span class="filter-option <?php echo $_GET["shifouyoudianti"] == '否' ? 'active' : ''; ?>" data-field="shifouyoudianti" data-value="否">否</span>
                    </div>
                </div>
            </div>
            
            <div class="filter-row">
                <div class="filter-group">
                    <div class="filter-title">排序</div>
                    <div class="filter-options">
                        <span class="filter-option <?php echo $orderby == 'id' ? 'active' : ($orderby != 'dianjilv' ? 'active' : ''); ?>" data-field="orderby" data-value="id">发布时间</span>
                        <span class="filter-option <?php echo $orderby == 'dianjilv' ? 'active' : ''; ?>" data-field="orderby" data-value="dianjilv">点击率</span>
                    </div>
                </div>
                
                <div class="search-input">
                    <div style="flex: 1;">
                        <label>标题</label>
                        <input type="text" class="form-control" name="biaoti" value="<?php echo $_GET["biaoti"]; ?>" placeholder="请输入关键词"/>
                    </div>
                    <button type="submit" class="btn btn-primary" style="height: 40px;">搜索</button>
                </div>
            </div>
        </form>
    </div>
    
    <div class="properties-list">
        <?php foreach ($lists as $r): ?>
        <div class="property-card">
            <a href="fenzuxinxidetail.php?id=<?php echo $r["id"]; ?>" style="display: block; width: 300px; height: 200px; flex-shrink: 0;">
                <div class="property-image" style="background-image: url('<?php echo Info::images($r["fangwutupian"]); ?>');"></div>
            </a>
            <div class="property-content">
                <a href="fenzuxinxidetail.php?id=<?php echo $r["id"]; ?>">
                    <h3 class="property-title"><?php echo $r["biaoti"]; ?></h3>
                </a>
                <p class="property-description"><?php echo Info::subStr($r["hezumiaoshu"], 120); ?></p>
                
                <div class="property-features">
                    <span class="feature-item">房屋户型：<?php echo $r["fangwuhuxing"]; ?></span>
                    <span class="feature-item">小区名称：<?php echo $r["xiaoqumingcheng"]; ?></span>
                    <span class="feature-item">押金方式：<?php echo $r["yajinfangshi"]; ?></span>
                    <span class="feature-item">是否有电梯：<?php echo $r["shifouyoudianti"]; ?></span>
                    <span class="feature-item">租赁类型：<?php echo $r["zulinleixing"]; ?></span>
                    <span class="feature-item">租赁时长：<?php echo $r["zulinshichang"]; ?></span>
                </div>
                
                <div class="property-meta">
                    <div class="property-price">￥<?php echo $r["fangwuzujin"]; ?>/月</div>
                    <a href="fenzuxinxidetail.php?id=<?php echo $r["id"]; ?>"><button class="btn-apply">查看详情</button></a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
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
            const parent = this.parentElement;
            parent.querySelectorAll('.filter-option').forEach(opt => {
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