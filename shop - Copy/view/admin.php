<?php
// Hàm tính tổng doanh thu
function calculateTotalRevenue($orders)
{
    $totalRevenue = 0;

    foreach ($orders as $order) {
        if ($order['status'] === 'completed') {
            $totalRevenue += $order['total_price'];
        }
    }

    return $totalRevenue;
}

// Tính và hiển thị tổng doanh thu
$revenue = calculateTotalRevenue($orders);
echo "<h4>Tổng doanh thu: " . number_format($revenue) . " VND</h4>";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>AdminLTE 2 | Dashboard</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="../../AdminLTE-master/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Morris chart -->
    <link href="../../AdminLTE-master/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="../../AdminLTE-master/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker -->
    <link href="../../AdminLTE-master/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="../../AdminLTE-master/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="../../AdminLTE-master/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<style>
    .main-header {
        margin-top: -30px;
    }
</style>

<body class="skin-blue">
    <div class="wrapper">


        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="../../AdminLTE-master/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
                    </div>
                    <div class="pull-left info">
                        <p>Alexander Pierce</p>

                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>
                <!-- search form -->
                <form action="#" method="get" class="sidebar-form">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="Search..." />
                        <span class="input-group-btn">
                            <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </form>
                <!-- /.search form -->
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="active treeview">
                        <a href="#">
                            <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
                            <li class="active"><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-files-o"></i>
                            <span>Layout Options</span>
                            <span class="label label-primary pull-right">4</span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="../../AdminLTE-master/pages/layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
                            <li><a href="../../AdminLTE-master/pages/layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
                            <li><a href="../../AdminLTE-master/pages/layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
                            <li><a href="../../AdminLTE-master/pages/layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="../../AdminLTE-master/pages/widgets.html">
                            <i class="fa fa-th"></i> <span>Widgets</span> <small class="label pull-right bg-green">new</small>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-pie-chart"></i>
                            <span>Charts</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="../../AdminLTE-master/pages/charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
                            <li><a href="../../AdminLTE-master/pages/charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
                            <li><a href="../../AdminLTE-master/pages/charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-laptop"></i>
                            <span>UI Elements</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="../../AdminLTE-master/pages/UI/general.html"><i class="fa fa-circle-o"></i> General</a></li>
                            <li><a href="../../AdminLTE-master/pages/UI/icons.html"><i class="fa fa-circle-o"></i> Icons</a></li>
                            <li><a href="../../AdminLTE-master/pages/UI/buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
                            <li><a href="../../AdminLTE-master/pages/UI/sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
                            <li><a href="../../AdminLTE-master/pages/UI/timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
                            <li><a href="../../AdminLTE-master/pages/UI/modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-edit"></i> <span>Forms</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="../../AdminLTE-master/pages/forms/general.html"><i class="fa fa-circle-o"></i> General Elements</a></li>
                            <li><a href="../../AdminLTE-master/pages/forms/advanced.html"><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
                            <li><a href="../../AdminLTE-master/pages/forms/editors.html"><i class="fa fa-circle-o"></i> Editors</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-table"></i> <span>Tables</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="../../AdminLTE-master/pages/tables/simple.html"><i class="fa fa-circle-o"></i> Simple tables</a></li>
                            <li><a href="../../AdminLTE-master/pages/tables/data.html"><i class="fa fa-circle-o"></i> Data tables</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="../../AdminLTE-master/pages/calendar.html">
                            <i class="fa fa-calendar"></i> <span>Calendar</span>
                            <small class="label pull-right bg-red">3</small>
                        </a>
                    </li>
                    <li>
                        <a href="../../AdminLTE-master/pages/mailbox/mailbox.html">
                            <i class="fa fa-envelope"></i> <span>Mailbox</span>
                            <small class="label pull-right bg-yellow">12</small>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-folder"></i> <span>Examples</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="../../AdminLTE-master/pages/examples/invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>
                            <li><a href="../../AdminLTE-master/pages/examples/login.html"><i class="fa fa-circle-o"></i> Login</a></li>
                            <li><a href="../../AdminLTE-master/pages/examples/register.html"><i class="fa fa-circle-o"></i> Register</a></li>
                            <li><a href="../../AdminLTE-master/pages/examples/lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
                            <li><a href="../../AdminLTE-master/pages/examples/404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
                            <li><a href="../../AdminLTE-master/pages/examples/500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
                            <li><a href="../../AdminLTE-master/pages/examples/blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-share"></i> <span>Multilevel</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                            <li>
                                <a href="#"><i class="fa fa-circle-o"></i> Level One <i class="fa fa-angle-left pull-right"></i></a>
                                <ul class="treeview-menu">
                                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                                    <li>
                                        <a href="#"><i class="fa fa-circle-o"></i> Level Two <i class="fa fa-angle-left pull-right"></i></a>
                                        <ul class="treeview-menu">
                                            <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                            <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
                        </ul>
                    </li>

                    <li class="header">LABELS</li>
                    <li><a href="#"><i class="fa fa-circle-o text-danger"></i> Important</a></li>
                    <li><a href="#"><i class="fa fa-circle-o text-warning"></i> Warning</a></li>
                    <li><a href="#"><i class="fa fa-circle-o text-info"></i> Information</a></li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Right side column. Contains the navbar and content of the page -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Dashboard
                    <small>Version 2.0</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Dashboard</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <!-- Info boxes -->
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">CPU Traffic</span>
                                <span class="info-box-number">90<small>%</small></span>
                            </div><!-- /.info-box-content -->
                        </div><!-- /.info-box -->
                    </div><!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Likes</span>
                                <span class="info-box-number">41,410</span>
                            </div><!-- /.info-box-content -->
                        </div><!-- /.info-box -->
                    </div><!-- /.col -->

                    <!-- fix for small devices only -->
                    <div class="clearfix visible-sm-block"></div>

                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Sales</span>
                                <span class="info-box-number">760</span>
                            </div><!-- /.info-box-content -->
                        </div><!-- /.info-box -->
                    </div><!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">New Members</span>
                                <span class="info-box-number">2,000</span>
                            </div><!-- /.info-box-content -->
                        </div><!-- /.info-box -->
                    </div><!-- /.col -->
                </div><!-- /.row -->



                <!-- Main row -->



                <div class="table-responsive">
                    <!-- Table hiện tại của bạn giữ nguyên -->
                    <div id="page-wrapper">
                        <div id="page-inner">
                            <div class="row">
                                <div class="col-md-12">
                                    <h1 class="page-head-line">Quản lý đơn shop bán hoa</h1>
                                    <h1 class="page-subhead-line">Danh sách tất cả các đơn hàng trong hệ thống</h1>

                                </div>
                                <form action="/php template/shop - Copy/public/index.php" method="get">
                                    <input type="hidden" name="controller" value="order">
                                    <input type="hidden" name="action" value="exportExcel">
                                    <button type="submit" class="btn btn-success">Xuất Excel</button>
                                </form>
                                <form action="/php template/shop - Copy/public/index.php" method="get">
                                    <input type="hidden" name="controller" value="order">
                                    <input type="hidden" name="action" value="exportPDF">
                                    <button type="submit" class="btn btn-primary">Xuất PDF</button>
                                </form>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-default">

                                        <div class="revenue-summary">
                                            <?php
                                            $revenue = calculateTotalRevenue($orders);
                                            echo "<h4>Tổng doanh thu: " . number_format($revenue) . " VND</h4>";
                                            ?>
                                        </div>
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Tên người dùng</th>
                                                            <th>Tên người mua</th>
                                                            <th>Địa chỉ</th>
                                                            <th>Số điện thoại</th>
                                                            <th>Tên sản phẩm</th>
                                                            <th>Số lượng</th>
                                                            <th>Tổng tiền</th>
                                                            <th>Thời gian tạo</th>
                                                            <th>Trạng thái</th>
                                                            <th>Hành động</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($orders as $order): ?>
                                                            <tr>
                                                                <td><?php echo htmlspecialchars($order['username']); ?></td>
                                                                <td><?php echo htmlspecialchars($order['name'] ?? ''); ?></td> <!-- Line 204 -->
                                                                <td><?php echo htmlspecialchars($order['address'] ?? ''); ?></td>
                                                                <td><?php echo htmlspecialchars($order['phone'] ?? ''); ?></td>
                                                                <td><?php echo htmlspecialchars($order['product_name']); ?></td>
                                                                <td><?php echo $order['quantity']; ?></td>
                                                                <td><?php echo number_format($order['total_price']); ?> VND</td>
                                                                <td><?php echo date('H:i d/m/Y', strtotime($order['created_at'])); ?></td>
                                                                <td><?php echo htmlspecialchars($order['status']); ?></td>
                                                                <td>
                                                                    <form method="POST" class="update-status-form" data-order-id="<?php echo $order['order_id']; ?>">
                                                                        <select name="status" class="form-control d-inline-block" style="width: 120px;">
                                                                            <option value="pending" <?php if ($order['status'] === 'pending') echo 'selected'; ?>>Pending</option>
                                                                            <option value="completed" <?php if ($order['status'] === 'completed') echo 'selected'; ?>>Completed</option>
                                                                            <option value="cancelled" <?php if ($order['status'] === 'cancelled') echo 'selected'; ?>>Cancelled</option>
                                                                        </select>
                                                                        <button type="submit" class="btn btn-sm btn-primary">Cập nhật</button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <a href="?controller=product&action=index" class="btn btn-secondary">Quay lại</a>




                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="footer-sec">
                        © 2014 YourCompany | Design By : <a href="http://www.binarytheme.com/" target="_blank">BinaryTheme.com</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <!-- TABLE: LATEST ORDERS -->
                        <div class="box box-info">
                            <div class="box-header with-border">
                                <h3 class="box-title">Latest Orders</h3>
                                <div class="box-tools pull-right">
                                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <div class="table-responsive">
                                    <table class="table no-margin">
                                        <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Item</th>
                                                <th>Status</th>
                                                <th>Popularity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><a href="../../AdminLTE-master/pages/examples/invoice.html">OR9842</a></td>
                                                <td>Call of Duty IV</td>
                                                <td><span class="label label-success">Shipped</span></td>
                                                <td>
                                                    <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><a href="../../AdminLTE-master/pages/examples/invoice.html">OR1848</a></td>
                                                <td>Samsung Smart TV</td>
                                                <td><span class="label label-warning">Pending</span></td>
                                                <td>
                                                    <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><a href="../../AdminLTE-master/pages/examples/invoice.html">OR7429</a></td>
                                                <td>iPhone 6 Plus</td>
                                                <td><span class="label label-danger">Delivered</span></td>
                                                <td>
                                                    <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><a href="../../AdminLTE-master/pages/examples/invoice.html">OR7429</a></td>
                                                <td>Samsung Smart TV</td>
                                                <td><span class="label label-info">Processing</span></td>
                                                <td>
                                                    <div class="sparkbar" data-color="#00c0ef" data-height="20">90,80,-90,70,-61,83,63</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><a href="../../AdminLTE-master/pages/examples/invoice.html">OR1848</a></td>
                                                <td>Samsung Smart TV</td>
                                                <td><span class="label label-warning">Pending</span></td>
                                                <td>
                                                    <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><a href="../../AdminLTE-master/pages/examples/invoice.html">OR7429</a></td>
                                                <td>iPhone 6 Plus</td>
                                                <td><span class="label label-danger">Delivered</span></td>
                                                <td>
                                                    <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><a href="../../AdminLTE-master/pages/examples/invoice.html">OR9842</a></td>
                                                <td>Call of Duty IV</td>
                                                <td><span class="label label-success">Shipped</span></td>
                                                <td>
                                                    <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div><!-- /.table-responsive -->
                            </div><!-- /.box-body -->
                            <div class="box-footer clearfix">
                                <a href="javascript::;" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
                                <a href="javascript::;" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
                            </div><!-- /.box-footer -->
                        </div><!-- /.box -->
                    </div><!-- /.col -->
                    <div class="col-md-4">
                        <!-- PRODUCT LIST -->
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Recently Added Products</h3>
                                <div class="box-tools pull-right">
                                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                                </div>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <ul class="products-list product-list-in-box">
                                    <li class="item">
                                        <div class="product-img">
                                            <img src="http://placehold.it/50x50/d2d6de/ffffff" alt="Product Image" />
                                        </div>
                                        <div class="product-info">
                                            <a href="javascript::;" class="product-title">Samsung TV <span class="label label-warning pull-right">$1800</span></a>
                                            <span class="product-description">
                                                Samsung 32" 1080p 60Hz LED Smart HDTV.
                                            </span>
                                        </div>
                                    </li><!-- /.item -->
                                    <li class="item">
                                        <div class="product-img">
                                            <img src="../../AdminLTE-master/dist/img/default-50x50.gif" alt="Product Image" />
                                        </div>
                                        <div class="product-info">
                                            <a href="javascript::;" class="product-title">Bicycle <span class="label label-info pull-right">$700</span></a>
                                            <span class="product-description">
                                                26" Mongoose Dolomite Men's 7-speed, Navy Blue.
                                            </span>
                                        </div>
                                    </li><!-- /.item -->
                                    <li class="item">
                                        <div class="product-img">
                                            <img src="../../AdminLTE-master/dist/img/default-50x50.gif" alt="Product Image" />
                                        </div>
                                        <div class="product-info">
                                            <a href="javascript::;" class="product-title">Xbox One <span class="label label-danger pull-right">$350</span></a>
                                            <span class="product-description">
                                                Xbox One Console Bundle with Halo Master Chief Collection.
                                            </span>
                                        </div>
                                    </li><!-- /.item -->
                                    <li class="item">
                                        <div class="product-img">
                                            <img src="../../AdminLTE-master/dist/img/default-50x50.gif" alt="Product Image" />
                                        </div>
                                        <div class="product-info">
                                            <a href="javascript::;" class="product-title">PlayStation 4 <span class="label label-success pull-right">$399</span></a>
                                            <span class="product-description">
                                                PlayStation 4 500GB Console (PS4)
                                            </span>
                                        </div>
                                    </li><!-- /.item -->
                                </ul>
                            </div><!-- /.box-body -->
                            <div class="box-footer text-center">
                                <a href="javascript::;" class="uppercase">View All Products</a>
                            </div><!-- /.box-footer -->
                        </div><!-- /.box -->
                    </div><!-- /.col -->
                </div><!-- /.row -->

            </section><!-- /.content -->
        </div><!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 2.0
            </div>
            <strong>Copyright &copy; 2014-2015 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights reserved.
        </footer>

    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
    <script src="../../AdminLTE-master/plugins/jQuery/jQuery-2.1.3.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="../../AdminLTE-master/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='../../AdminLTE-master/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="../../AdminLTE-master/dist/js/app.min.js" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="../../AdminLTE-master/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="../../AdminLTE-master/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
    <script src="../../AdminLTE-master/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <!-- daterangepicker -->
    <script src="../../AdminLTE-master/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- datepicker -->
    <script src="../../AdminLTE-master/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="../../AdminLTE-master/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="../../AdminLTE-master/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="../../AdminLTE-master/plugins/chartjs/Chart.min.js" type="text/javascript"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="../../AdminLTE-master/dist/js/../../AdminLTE-master/pages/dashboard2.js" type="text/javascript"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="../../AdminLTE-master/dist/js/demo.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('.update-status-form').on('submit', function(e) {
                e.preventDefault();

                let form = $(this);
                let orderId = form.data('order-id');
                let newStatus = form.find('select[name="status"]').val();
                let row = form.closest('tr');
                let productName = row.find('td:nth-child(2)').text();

                console.log('Sending AJAX: orderId=', orderId, 'newStatus=', newStatus);

                if (!orderId || !newStatus) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi!',
                        text: 'Dữ liệu không hợp lệ.',
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                $.ajax({
                    url: '?controller=order&action=updateStatus',
                    method: 'POST',
                    data: {
                        order_id: orderId,
                        status: newStatus
                    },
                    dataType: 'json',
                    beforeSend: function() {
                        form.find('button').prop('disabled', true).text('Đang cập nhật...');
                    },
                    success: function(response) {
                        console.log('AJAX Response:', response);
                        if (response.success) {
                            row.find('td:nth-child(6)').text(newStatus);
                            Swal.fire({
                                icon: 'success',
                                title: 'Cập nhật thành công!',
                                html: `Đơn hàng cho sản phẩm <strong>${productName}</strong><br>` +
                                    `Trạng thái mới: <strong>${newStatus}</strong>`,
                                confirmButtonText: 'OK'
                            });
                        } else {
                            console.log('Server error response:', response);
                            Swal.fire({
                                icon: 'error',
                                title: 'Lỗi!',
                                text: response.message || 'Đã xảy ra lỗi khi cập nhật trạng thái.',
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error, 'Response:', xhr.responseText);
                        let errorMessage = 'Không thể xử lý phản hồi từ server.';
                        try {
                            let response = JSON.parse(xhr.responseText);
                            if (response.message) {
                                errorMessage = response.message;
                            }
                        } catch (e) {
                            errorMessage += ' Phản hồi không phải JSON: ' + xhr.responseText;
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi!',
                            text: errorMessage,
                            confirmButtonText: 'OK'
                        });
                    },
                    complete: function() {
                        form.find('button').prop('disabled', false).text('Cập nhật');
                    }
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Xử lý submit form tìm kiếm
            document.getElementById('searchForm').addEventListener('submit', function(e) {
                e.preventDefault();

                const orderId = document.getElementById('orderId').value;
                const startDate = document.getElementById('startDate').value;
                const endDate = document.getElementById('endDate').value;

                fetchOrders(orderId, startDate, endDate);
            });

            // Xử lý nút reset
            document.getElementById('resetSearch').addEventListener('click', function() {
                document.getElementById('searchForm').reset();
                fetchOrders('', '', '');
            });

            function fetchOrders(orderId, startDate, endDate) {
                fetch('?controller=order&action=search', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `order_id=${encodeURIComponent(orderId)}&start_date=${encodeURIComponent(startDate)}&end_date=${encodeURIComponent(endDate)}`
                    })
                    .then(response => response.json())
                    .then(data => {
                        updateTable(data);
                    })
                    .catch(error => console.error('Error:', error));
            }

            function updateTable(orders) {
                const tbody = document.querySelector('tbody');
                tbody.innerHTML = ''; // Xóa nội dung cũ

                orders.forEach(order => {
                    const row = `
                <tr>
                    <td>${order.username}</td>
                    <td>${order.product_name}</td>
                    <td>${order.quantity}</td>
                    <td>${new Intl.NumberFormat().format(order.total_price)} VND</td>
                    <td>${order.status}</td>
                    <td>
                        <form method="POST" class="update-status-form" data-order-id="${order.order_id}">
                            <select name="status" class="form-control d-inline-block" style="width: 120px; display: inline;">
                                <option value="pending" ${order.status === 'pending' ? 'selected' : ''}>Pending</option>
                                <option value="completed" ${order.status === 'completed' ? 'selected' : ''}>Completed</option>
                                <option value="cancelled" ${order.status === 'cancelled' ? 'selected' : ''}>Cancelled</option>
                            </select>
                            <button type="submit" class="btn btn-sm btn-primary">Cập nhật</button>
                        </form>
                    </td>
                </tr>
            `;
                    tbody.insertAdjacentHTML('beforeend', row);
                });
            }
        });
    </script>
</body>

</html>