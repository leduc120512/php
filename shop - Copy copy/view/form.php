<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Responsive Bootstrap Advance Admin Template</title>



  <link href="../../bs-advance-admin/advance-admin/assets/css/bootstrap.css" rel="stylesheet" />
  <!-- FONTAWESOME STYLES-->
  <link href="../../bs-advance-admin/advance-admin/assets/css/font-awesome.css" rel="stylesheet" />
  <!--CUSTOM BASIC STYLES-->
  <link href="../../bs-advance-admin/advance-admin/assets/css/basic.css" rel="stylesheet" />
  <!--CUSTOM MAIN STYLES-->
  <link href="../../bs-advance-admin/advance-admin/assets/css/custom.css" rel="stylesheet" />
  <!-- GOOGLE FONTS-->
  <link
    href="http://fonts.googleapis.com/css?family=Open+Sans"
    rel="stylesheet"
    type="text/css" />

</head>

<body>
  <div id="wrapper">
    <nav
      class="navbar navbar-default navbar-cls-top"
      role="navigation"
      style="margin-bottom: 0">
      <div class="navbar-header">
        <button
          type="button"
          class="navbar-toggle"
          data-toggle="collapse"
          data-target=".sidebar-collapse">
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
    <!-- /. NAV TOP  -->
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
            <a href="#"><i class="fa fa-desktop"></i>UI Elements
              <span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
              <li>
                <a href="panel-tabs.html"><i class="fa fa-toggle-on"></i>Tabs & Panels</a>
              </li>
              <li>
                <a href="notification.html"><i class="fa fa-bell"></i>Notifications</a>
              </li>
              <li>
                <a href="progress.html"><i class="fa fa-circle-o"></i>Progressbars</a>
              </li>
              <li>
                <a href="buttons.html"><i class="fa fa-code"></i>Buttons</a>
              </li>
              <li>
                <a href="icons.html"><i class="fa fa-bug"></i>Icons</a>
              </li>
              <li>
                <a href="wizard.html"><i class="fa fa-bug"></i>Wizard</a>
              </li>
              <li>
                <a href="typography.html"><i class="fa fa-edit"></i>Typography</a>
              </li>
              <li>
                <a href="grid.html"><i class="fa fa-eyedropper"></i>Grid</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="#"><i class="fa fa-yelp"></i>Extra Pages
              <span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
              <li>
                <a href="invoice.html"><i class="fa fa-coffee"></i>Invoice</a>
              </li>
              <li>
                <a href="pricing.html"><i class="fa fa-flash"></i>Pricing</a>
              </li>
              <li>
                <a href="component.html"><i class="fa fa-key"></i>Components</a>
              </li>
              <li>
                <a href="social.html"><i class="fa fa-send"></i>Social</a>
              </li>

              <li>
                <a href="message-task.html"><i class="fa fa-recycle"></i>Messages & Tasks</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="table.html"><i class="fa fa-flash"></i>Data Tables </a>
          </li>
          <li>
            <a class="active-menu-top" href="#"><i class="fa fa-bicycle"></i>Forms
              <span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse in">
              <li>
                <a class="active-menu" href="form.html"><i class="fa fa-desktop"></i>Basic
                </a>
              </li>
              <li>
                <a href="form-advance.html"><i class="fa fa-code"></i>Advance</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="gallery.html"><i class="fa fa-anchor"></i>Gallery</a>
          </li>
          <li>
            <a href="error.html"><i class="fa fa-bug"></i>Error Page</a>
          </li>
          <li>
            <a href="login.html"><i class="fa fa-sign-in"></i>Login Page</a>
          </li>
          <li>
            <a href="#"><i class="fa fa-sitemap"></i>Multilevel Link
              <span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
              <li>
                <a href="#"><i class="fa fa-bicycle"></i>Second Level Link</a>
              </li>
              <li>
                <a href="#"><i class="fa fa-flask"></i>Second Level Link</a>
              </li>
              <li>
                <a href="#">Second Level Link<span class="fa arrow"></span></a>
                <ul class="nav nav-third-level">
                  <li>
                    <a href="#"><i class="fa fa-plus"></i>Third Level Link</a>
                  </li>
                  <li>
                    <a href="#"><i class="fa fa-comments-o"></i>Third Level Link</a>
                  </li>
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
    <!-- /. NAV SIDE  -->
    <div id="page-wrapper">
      <div id="page-inner">
        <div class="row">
          <div class="col-md-12">
            <h1 class="page-head-line">Basic Forms</h1>
            <h1 class="page-subhead-line">
              This is dummy text , you can replace it with your original text.
            </h1>
          </div>
        </div>
        <!-- /. ROW  -->
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="panel panel-info">
              <div class="panel-heading">BASIC FORM</div>
              <div class="panel-body">
                <form role="form" method="POST" action="?controller=product&action=add" enctype="multipart/form-data">
                  <div class="form-group">
                    <label>Tên</label>
                    <input class="form-control" type="text" name="name" required />
                    <p class="help-block">Nhập tên sản phẩm.</p>
                  </div>
                  <div class="form-group">
                    <label>Ảnh</label>
                    <input class="form-control" type="file" name="img" accept="image/*" required />
                    <p class="help-block">Chọn ảnh sản phẩm.</p>
                  </div>
                  <div class="form-group">
                    <label>Giá</label>
                    <input class="form-control" type="number" name="price" step="0.01" required />
                    <p class="help-block">Nhập giá sản phẩm (VND).</p>
                  </div>
                  <div class="form-group">
                    <label>Số lượng</label>
                    <input class="form-control" type="number" name="quantity" required />
                    <p class="help-block">Nhập số lượng sản phẩm.</p>
                  </div>
                  <div class="form-group">
                    <label>Mô tả</label>
                    <textarea class="form-control" rows="3" name="description"></textarea>
                    <p class="help-block">Mô tả sản phẩm (không bắt buộc).</p>
                  </div>

                  <button type="submit" name="add_product" class="btn btn-info">
                    Thêm sản phẩm
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /. PAGE INNER  -->
    </div>
  </div>
  <div class="container mt-5">
    <h1 class="mb-4">Quản lý Admin</h1>

    <h2>Thêm sản phẩm</h2>
    <form method="POST" action="?controller=product&action=add" enctype="multipart/form-data" class="mb-5">
      <div class="form-group">
        <label>Tên</label>
        <input type="text" name="name" class="form-control" required>
      </div>
      <div class="form-group">
        <label>Ảnh</label>
        <input type="file" name="img" accept="image/*" class="form-control-file" required>
      </div>
      <div class="form-group">
        <label>Giá</label>
        <input type="number" name="price" step="0.01" class="form-control" required>
      </div>
      <div class="form-group">
        <label>Số lượng</label>
        <input type="number" name="quantity" class="form-control" required>
      </div>
      <div class="form-group">
        <label>Mô tả</label>
        <textarea name="description" class="form-control"></textarea>
      </div>
      <button type="submit" name="add_product" class="btn btn-primary">Thêm</button>
    </form>

    <h2>Danh sách sản phẩm</h2>
    <table class="table table-bordered mb-5">
      <thead>
        <tr>
          <th>Tên</th>
          <th>Ảnh</th>
          <th>Giá</th>
          <th>Số lượng</th>
          <th>Hành động</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($this->product->getAll() as $product): ?>
          <tr>
            <td><?php echo htmlspecialchars($product['name']); ?></td>
            <td><img src="img/<?php echo htmlspecialchars($product['img']); ?>" width="50"></td>
            <td><?php echo number_format($product['price']); ?> VND</td>
            <td><?php echo $product['quantity']; ?></td>
            <td>
              <a href="?controller=product&action=edit&id=<?php echo $product['ID']; ?>" class="btn btn-sm btn-warning">Sửa</a>
              <a href="?controller=product&action=delete&id=<?php echo $product['ID']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Xóa sản phẩm này?')">Xóa</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <h2>Danh sách đơn hàng</h2>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>User</th>
          <th>Sản phẩm</th>
          <th>Số lượng</th>
          <th>Tổng</th>
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
              <form method="POST" action="?controller=order&action=updateStatus&order_id=<?php echo $order['order_id']; ?>">
                <select name="status" class="form-control d-inline-block w-auto">
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
    <a href="?controller=product&action=index" class="btn btn-secondary mt-3">Quay lại</a>
  </div>
  </div>
  <!-- /. WRAPPER  -->
  <div id="footer-sec">
    &copy; 2014 YourCompany | Design By :
    <a href="http://www.binarytheme.com/" target="_blank">BinaryTheme.com</a>
  </div>
  <!-- /. FOOTER  -->
  <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
  <!-- JQUERY SCRIPTS -->
  <script src="assets/js/jquery-1.10.2.js"></script>
  <!-- BOOTSTRAP SCRIPTS -->
  <script src="assets/js/bootstrap.js"></script>
  <!-- METISMENU SCRIPTS -->
  <script src="assets/js/jquery.metisMenu.js"></script>
  <!-- CUSTOM SCRIPTS -->
  <script src="assets/js/custom.js"></script>

  <script src="assets/js/jquery-1.10.2.js"></script>
  <!-- BOOTSTRAP SCRIPTS -->
  <script src="assets/js/bootstrap.js"></script>
  <!-- METISMENU SCRIPTS -->
  <script src="assets/js/jquery.metisMenu.js"></script>
  <!-- CUSTOM SCRIPTS -->
  <script src="assets/js/custom.js"></script>
</body>

</html>