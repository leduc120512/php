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
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quản lý đơn hàng - Admin</title>

    <!-- BOOTSTRAP STYLES-->
    <link href="../../bs-advance-admin/advance-admin/assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="../../bs-advance-admin/advance-admin/assets/css/font-awesome.css" rel="stylesheet" />
    <!-- CUSTOM BASIC STYLES-->
    <link href="../../bs-advance-admin/advance-admin/assets/css/basic.css" rel="stylesheet" />
    <!-- CUSTOM MAIN STYLES-->
    <link href="../../bs-advance-admin/advance-admin/assets/css/custom.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css" />
</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">COMPANY NAME</a>
            </div>
            <div class="header-right">
                <a href="message-task.html" class="btn btn-info" title="New Message"><b>30 </b><i class="fa fa-envelope-o fa-2x"></i></a>
                <a href="message-task.html" class="btn btn-primary" title="New Task"><b>40 </b><i class="fa fa-bars fa-2x"></i></a>
                <a href="login.html" class="btn btn-danger" title="Logout"><i class="fa fa-exclamation-circle fa-2x"></i></a>
            </div>
        </nav>

        <!-- /. NAV SIDE  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
                        <div class="user-img-div">
                            <img src="../../bs-advance-admin/advance-admin/assets/img/user.png" class="img-thumbnail" />
                            <div class="inner-text">
                                Jhon Deo Alex
                                <br />
                                <small>Last Login : 2 Weeks Ago </small>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a href="index.html"><i class="fa fa-dashboard"></i>Dashboard</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-desktop"></i>UI Elements <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="panel-tabs.html"><i class="fa fa-toggle-on"></i>Tabs & Panels</a></li>
                            <li><a href="notification.html"><i class="fa fa-bell"></i>Notifications</a></li>
                            <li><a href="progress.html"><i class="fa fa-circle-o"></i>Progressbars</a></li>
                            <li><a href="buttons.html"><i class="fa fa-code"></i>Buttons</a></li>
                            <li><a href="icons.html"><i class="fa fa-bug"></i>Icons</a></li>
                            <li><a href="wizard.html"><i class="fa fa-bug"></i>Wizard</a></li>
                            <li><a href="typography.html"><i class="fa fa-edit"></i>Typography</a></li>
                            <li><a href="http://localhost/php%20template/shop/public/index.php?controller=order&action=admin"><i class="fa fa-list"></i> Quản lý đơn hàng</a></li>
                            <li><a href="grid.html"><i class="fa fa-eyedropper"></i>Grid</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-yelp"></i>Extra Pages <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="invoice.html"><i class="fa fa-coffee"></i>Invoice</a></li>
                            <li><a href="pricing.html"><i class="fa fa-flash"></i>Pricing</a></li>
                            <li><a href="component.html"><i class="fa fa-key"></i>Components</a></li>
                            <li><a href="social.html"><i class="fa fa-send"></i>Social</a></li>
                            <li><a href="message-task.html"><i class="fa fa-recycle"></i>Messages & Tasks</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="table.html"><i class="fa fa-flash"></i>Data Tables </a>
                    </li>
                    <li>
                        <a class="active-menu-top" href="#"><i class="fa fa-bicycle"></i>Forms <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse in">
                            <li><a class="active-menu" href="form.html"><i class="fa fa-desktop"></i>Basic </a></li>
                            <li><a href="form-advance.html"><i class="fa fa-code"></i>Advance</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="http://localhost/php%20template/shop/public/index.php?controller=product&action=manage"><i class="fa fa-bug"></i>Quản lý sản phẩm</a>
                    </li>
                    <li>
                        <a href="login.html"><i class="fa fa-sign-in"></i>Login Page</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-sitemap"></i>Multilevel Link <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li><a href="#"><i class="fa fa-bicycle"></i>Second Level Link</a></li>
                            <li><a href="#"><i class="fa fa-flask"></i>Second Level Link</a></li>
                            <li>
                                <a href="#">Second Level Link<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li><a href="#"><i class="fa fa-plus"></i>Third Level Link</a></li>
                                    <li><a href="#"><i class="fa fa-comments-o"></i>Third Level Link</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="blank.html"><i class="fa fa-square-o"></i>Blank Page</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="panel-body">
            <div class="panel-body">
                <div class="search-form" style="margin-bottom: 20px;">
                    <form id="searchForm" class="form-inline">
                        <div class="form-group">
                            <label for="orderId">Mã đơn hàng:</label>
                            <input type="text" class="form-control" id="orderId" name="order_id">
                        </div>
                        <div class="form-group">
                            <label for="startDate">Từ ngày:</label>
                            <input type="date" class="form-control" id="startDate" name="start_date">
                        </div>
                        <div class="form-group">
                            <label for="endDate">Đến ngày:</label>
                            <input type="date" class="form-control" id="endDate" name="end_date">
                        </div>
                        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                        <button type="button" class="btn btn-default" id="resetSearch">Reset</button>
                    </form>
                </div>
                <div class="table-responsive">
                    <!-- Table hiện tại của bạn giữ nguyên -->
                    <div class="table-responsive">
                        <!-- Table hiện tại của bạn giữ nguyên -->
                        <div id="page-wrapper">
                            <div id="page-inner">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h1 class="page-head-line">Quản lý đơn hàng 1</h1>
                                        <h1 class="page-subhead-line">Danh sách tất cả các đơn hàng trong hệ thốn1g</h1>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                Danh sách đơn hàng le xuan duc
                                            </div>
                                            <div class="revenue-summary">
                                                <?php
                                                $revenue = calculateTotalRevenue($orders);
                                                echo "<h4>Tổng doanh thu: " . number_format($revenue) . " VND</h4>";
                                                ?>
                                            </div>
                                            <div class="panel-body">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Tên người dùng</th>
                                                                <th>Tên sản phẩm</th>
                                                                <th>Số lượng</th>
                                                                <th>Tổng tiền</th>
                                                                <th>Trạng thái</th>
                                                                <th>Hành động</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($orders as $order): ?>
                                                                <tr>
                                                                    <td><?php echo htmlspecialchars($order['username']); ?></td>
                                                                    <td><?php echo htmlspecialchars($order['product_name']); ?></td>
                                                                    <td><?php echo $order['quantity']; ?></td>
                                                                    <td><?php echo number_format($order['total_price']); ?> VND</td>
                                                                    <td><?php echo $order['status']; ?></td>
                                                                    <td>
                                                                        <form method="POST" class="update-status-form"
                                                                            data-order-id="<?php echo $order['order_id']; ?>">
                                                                            <select name="status" class="form-control d-inline-block" style="width: 120px; display: inline;">
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
                                                <p>đs</p>
                                                <form action="?controller=order&action=exportExcel" method="post">
                                                    <button type="submit" class="btn btn-success">Xuất Excel</button>
                                                </form>
                                                <form action="?controller=order&action=exportExcel" method="get">
                                                    <button type="submit" class="btn btn-success">Xuất Excel</button>
                                                </form>
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

                    <!-- SCRIPTS - AT THE BOTTOM TO REDUCE LOAD TIME -->
                    <script src="../../bs-advance-admin/advance-admin/assets/js/jquery-1.10.2.js"></script>
                    <script src="../../bs-advance-admin/advance-admin/assets/js/bootstrap.js"></script>
                    <script src="../../bs-advance-admin/advance-admin/assets/js/jquery.metisMenu.js"></script>
                    <script src="../../bs-advance-admin/advance-admin/assets/js/custom.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                    <script>
                        $(document).ready(function() {
                            $('.update-status-form').on('submit', function(e) {
                                e.preventDefault(); // Ngăn submit form mặc định

                                let form = $(this);
                                let orderId = form.data('order-id');
                                let newStatus = form.find('select[name="status"]').val();
                                let row = form.closest('tr');
                                let productName = row.find('td:nth-child(2)').text();

                                // Gửi request AJAX để cập nhật trạng thái
                                $.ajax({
                                    url: '?controller=order&action=updateStatus',
                                    method: 'POST',
                                    data: {
                                        order_id: orderId,
                                        status: newStatus
                                    },
                                    success: function(response) {
                                        // Cập nhật trạng thái hiển thị trong bảng
                                        row.find('td:nth-child(5)').text(newStatus);

                                        // Hiển thị SweetAlert thành công
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Cập nhật thành công!',
                                            html: `Đơn hàng cho sản phẩm <strong>${productName}</strong><br>` +
                                                `Trạng thái mới: <strong>${newStatus}</strong>`,
                                            confirmButtonText: 'OK'
                                        });
                                    },
                                    error: function() {
                                        // Hiển thị SweetAlert lỗi
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Lỗi!',
                                            text: 'Đã xảy ra lỗi khi cập nhật trạng thái. Vui lòng thử lại.',
                                            confirmButtonText: 'OK'
                                        });
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