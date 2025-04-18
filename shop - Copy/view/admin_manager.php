<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quản lý sản phẩm - Admin</title>

    <link href="../../bs-advance-admin/advance-admin/assets/css/bootstrap.css" rel="stylesheet" />
    <link href="../../bs-advance-admin/advance-admin/assets/css/font-awesome.css" rel="stylesheet" />
    <link href="../../bs-advance-admin/advance-admin/assets/css/basic.css" rel="stylesheet" />
    <link href="../../bs-advance-admin/advance-admin/assets/css/custom.css" rel="stylesheet" />
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
                    <li><a href="index.html"><i class="fa fa-dashboard"></i>Dashboard</a></li>
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
                    <li><a href="table.html"><i class="fa fa-flash"></i>Data Tables </a></li>
                    <li>
                        <a class="active-menu-top" href="#"><i class="fa fa-bicycle"></i>Forms <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse in">
                            <li><a class="active-menu" href="form.html"><i class="fa fa-desktop"></i>Basic</a></li>
                            <li><a href="form-advance.html"><i class="fa fa-code"></i>Advance</a></li>
                        </ul>
                    </li>
                    <li><a href="http://localhost/php%20template/shop/public/index.php?controller=product&action=manage"><i class="fa fa-bug"></i>Quản lý sản phẩm</a></li>
                    <li><a href="login.html"><i class="fa fa-sign-in"></i>Login Page</a></li>
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
                    <li><a href="blank.html"><i class="fa fa-square-o"></i>Blank Page</a></li>
                </ul>
            </div>
        </nav>

        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-head-line">Quản lý sản phẩm</h1>
                        <h1 class="page-subhead-line">Thêm và quản lý danh sách sản phẩm</h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">Thêm sản phẩm mới</div>
                            <div class="panel-body">
                                <form action="?controller=product&action=add" method="POST" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Tên sản phẩm</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Giá</label>
                                        <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="quantity" class="form-label">Số lượng</label>
                                        <input type="number" class="form-control" id="quantity" name="quantity" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Mô tả</label>
                                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="img" class="form-label">Hình ảnh</label>
                                        <input type="file" class="form-control" id="img" name="img" accept="image/*" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="add_product">Thêm Sản Phẩm</button>
                                </form>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">Danh sách sản phẩm</div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Tên</th>
                                                <th>Ảnh</th>
                                                <th>Giá</th>
                                                <th>Số lượng</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody id="product-list">
                                            <?php foreach ($this->product->getAll() as $product): ?>
                                                <tr data-product-id="<?php echo $product['ID']; ?>">
                                                    <td><?php echo htmlspecialchars($product['name']); ?></td>
                                                    <td><img src="img/<?php echo htmlspecialchars($product['img']); ?>" width="50"></td>
                                                    <td><?php echo number_format($product['price']); ?> VND</td>
                                                    <td><?php echo $product['quantity']; ?></td>
                                                    <td>
                                                        <a href="?controller=product&action=edit&id=<?php echo $product['ID']; ?>" class="btn btn-sm btn-warning">Sửa</a>
                                                        <a href="?controller=product&action=delete&id=<?php echo $product['ID']; ?>"
                                                            class="btn btn-sm btn-danger btn-delete-product"
                                                            data-product-name="<?php echo htmlspecialchars($product['name']); ?>">Xóa</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
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

    <script src="../../bs-advance-admin/advance-admin/assets/js/jquery-1.10.2.js"></script>
    <script src="../../bs-advance-admin/advance-admin/assets/js/bootstrap.js"></script>
    <script src="../../bs-advance-admin/advance-admin/assets/js/jquery.metisMenu.js"></script>
    <script src="../../bs-advance-admin/advance-admin/assets/js/custom.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // Xử lý thêm sản phẩm
            $('#add-product-form').on('submit', function(e) {
                e.preventDefault();
                let formData = new FormData(this);

                $.ajax({
                    url: '?controller=product&action=add',
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        let productName = $('#add-product-form input[name="name"]').val();
                        Swal.fire({
                            icon: 'success',
                            title: 'Thêm sản phẩm thành công!',
                            text: `Sản phẩm "${productName}" đã được thêm vào danh sách.`,
                            confirmButtonText: 'OK'
                        }).then(() => {
                            location.reload(); // Tải lại trang để cập nhật danh sách
                        });
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi!',
                            text: 'Đã xảy ra lỗi khi thêm sản phẩm. Vui lòng thử lại.',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });

            // Xử lý xóa sản phẩm
            $('.btn-delete-product').on('click', function(e) {
                e.preventDefault();
                let deleteUrl = $(this).attr('href');
                let productName = $(this).data('product-name');
                let productId = $(this).closest('tr').data('product-id');

                Swal.fire({
                    title: 'Bạn có chắc chắn?',
                    text: `Bạn muốn xóa sản phẩm "${productName}"?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Có, xóa nó!',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: deleteUrl,
                            method: 'POST',
                            success: function(response) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Xóa thành công!',
                                    text: `Sản phẩm "${productName}" đã được xóa.`,
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    $(`tr[data-product-id="${productId}"]`).remove(); // Xóa dòng khỏi bảng
                                });
                            },
                            error: function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Lỗi!',
                                    text: 'Đã xảy ra lỗi khi xóa sản phẩm. Vui lòng thử lại.',
                                    confirmButtonText: 'OK'
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>