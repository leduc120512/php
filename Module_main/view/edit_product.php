<?php

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ?controller=product&action=index");
    exit;
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Chỉnh sửa sản phẩm - Admin</title>

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
                    <li><a href="gallery.html"><i class="fa fa-anchor"></i>Gallery</a></li>
                    <li><a href="error.html"><i class="fa fa-bug"></i>Error Page</a></li>
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
                        <h1 class="page-head-line">Chỉnh sửa sản phẩm</h1>
                        <h1 class="page-subhead-line">Cập nhật thông tin sản phẩm</h1>
                    </div>
                </div>
                <!-- Chỉ phần form với CSS Bootstrap -->
                <div class="container mt-4">
                    <div class="card p-4">
                        <h2 class="card-title mb-4">CẬP NHẬT SẢN PHẨM</h2>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="row mb-3">
                                <label for="name" class="col-sm-2 col-form-label">Tên sản phẩm</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="<?= htmlspecialchars($product['name']) ?>" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="price" class="col-sm-2 col-form-label">Giá</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="price" name="price"
                                        step="0.01" value="<?= htmlspecialchars($product['price']) ?>" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="quantity" class="col-sm-2 col-form-label">Số lượng</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="quantity" name="quantity"
                                        value="<?= htmlspecialchars($product['quantity']) ?>" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="description" class="col-sm-2 col-form-label">Mô tả</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="description" name="description"
                                        rows="4" required><?= htmlspecialchars($product['description']) ?></textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="img" class="col-sm-2 col-form-label">Hình ảnh</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" id="img" name="img">
                                    <img src="../public/img/<?= htmlspecialchars($product['img']) ?>"
                                        alt="Product Image" class="mt-2" style="max-width: 200px; border-radius: 5px;">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-10 offset-sm-2">
                                    <button type="submit" name="update_product"
                                        class="btn btn-primary me-2">Cập nhật</button>
                                    <a href="?controller=order&action=admin"
                                        class="btn btn-outline-secondary">Hủy</a>
                                </div>
                            </div>
                        </form>
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



</body>

</html>