<?php

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ?controller=product&action=index");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="../../adminkit/static/../../adminkit/static/img/icons/icon-48x48.png" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/" />

    <title>AdminKit Demo - Bootstrap 5 Admin Template</title>

    <link href="css/app.css" rel="stylesheet">
    <link href="../../adminkit/static/css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<style>
    /* Style for the action column's form container */
    .update-status-form .d-flex {
        gap: 8px;
        /* Space between select and button */
        align-items: center;
    }

    /* Style for the select dropdown */
    .update-status-form .form-select {
        width: 120px;
        /* Fixed width for consistency */
        padding: 6px 12px;
        /* Compact padding */
        font-size: 0.875rem;
        /* Smaller font for a sleek look */
        border-radius: 8px;
        /* Rounded corners */
        border: 1px solid #ced4da;
        /* Bootstrap default border */
        background-color: #fff;
        /* White background */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        /* Subtle shadow */
        transition: all 0.2s ease;
        /* Smooth transitions for hover/focus */
        cursor: pointer;
    }

    /* Hover effect for select */
    .update-status-form .form-select:hover {
        border-color: #0d6efd;
        /* Bootstrap primary color */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        /* Enhanced shadow */
    }

    /* Focus effect for select */
    .update-status-form .form-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        /* Bootstrap focus ring */
        outline: none;
    }

    /* Style for the button */
    .update-status-form .btn {
        padding: 6px 12px;
        /* Compact padding */
        font-size: 0.875rem;
        /* Smaller font */
        border-radius: 8px;
        /* Rounded corners */
        background-color: #0d6efd;
        /* Bootstrap primary color */
        border: none;
        /* Remove default border */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        /* Subtle shadow */
        transition: all 0.2s ease;
        /* Smooth transitions */
        text-transform: uppercase;
        /* Uppercase text for emphasis */
        font-weight: 500;
        /* Medium weight for readability */
    }

    /* Hover effect for button */
    .update-status-form .btn:hover {
        background-color: #005cbf;
        /* Darker primary color */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        /* Enhanced shadow */
        transform: translateY(-1px);
        /* Slight lift effect */
    }

    /* Active effect for button */
    .update-status-form .btn:active {
        background-color: #004a99;
        /* Even darker for click */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2) inset;
        /* Inset shadow for pressed effect */
        transform: translateY(0);
        /* Reset lift */
    }

    /* Disabled state for button */
    .update-status-form .btn:disabled {
        background-color: #6c757d;
        /* Bootstrap secondary color */
        box-shadow: none;
        cursor: not-allowed;
    }

    /* Responsive adjustments */
    @media (max-width: 576px) {
        .update-status-form .form-select {
            width: 100px;
            /* Slightly smaller on mobile */
            font-size: 0.8rem;
            /* Smaller font */
        }

        .update-status-form .btn {
            padding: 5px 10px;
            /* More compact */
            font-size: 0.8rem;
            /* Smaller font */
        }

        .update-status-form .d-flex {
            gap: 6px;
            /* Smaller gap on mobile */
        }
    }

    /* Nền trang */
    #page-wrapper {
        background: #f5f7fa;
        min-height: 100vh;
        padding-top: 40px;
    }

    /* Tiêu đề trang */
    .page-head-line {
        font-size: 32px;
        font-weight: bold;
        color: #2c3e50;
        margin-bottom: 10px;
        text-align: center;
    }

    .page-subhead-line {
        font-size: 18px;
        color: #7f8c8d;
        margin-bottom: 30px;
        text-align: center;
    }

    /* Thẻ card form */
    .card {
        background: #ffffff;
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    /* Tiêu đề trong card */
    .card-title {
        font-size: 24px;
        font-weight: 600;
        text-align: center;
        color: #34495e;
    }

    /* Các label */
    .col-form-label {
        font-weight: 500;
        color: #34495e;
    }

    /* Input focus */
    .form-control:focus {
        border-color: #3498db;
        box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
    }

    /* Ảnh sản phẩm */
    .card img {
        display: block;
        margin-top: 10px;
        max-width: 150px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    /* Button cập nhật */
    .btn-primary {
        background-color: #3498db;
        border-color: #3498db;
        font-weight: 600;
        padding: 10px 20px;
        border-radius: 8px;
    }

    .btn-primary:hover {
        background-color: #2980b9;
        border-color: #2980b9;
    }

    /* Button hủy */
    .btn-outline-secondary {
        border-color: #95a5a6;
        color: #7f8c8d;
        font-weight: 600;
        padding: 10px 20px;
        border-radius: 8px;
    }

    .btn-outline-secondary:hover {
        background-color: #bdc3c7;
        border-color: #bdc3c7;
        color: #2c3e50;
    }
</style>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="index.html">
                    <span class="align-middle">AdminKit</span>
                </a>

                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Pages
                    </li>

                    <li class="sidebar-item active">
                        <a class="sidebar-link" href="index.html">
                            <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <?php if ($_SESSION['role'] === 'admin'): ?>
                            <a class="sidebar-link" href="http://localhost/BTL_PHP/Module_main/public/index.php?controller=order&action=admin">
                                <i class="align-middle" data-feather="log-in"></i> <span class="align-middle">Quản lí sản đơn hàng</span>
                            </a>
                        <?php endif; ?>

                    </li>

                    <li class="sidebar-item">
                        <?php if ($_SESSION['role'] === 'admin'): ?>
                            <a class="sidebar-link" href="http://localhost/BTL_PHP/Module_main/public/index.php?controller=product&action=manage">
                                <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Quản lí sản sản phẩm</span>
                            </a>
                        <?php endif; ?>

                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="pages-blank.html">
                            <i class="align-middle" data-feather="book"></i> <span class="align-middle">Blank</span>
                        </a>
                    </li>

                    <li class="sidebar-header">
                        Tools & Components
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="ui-buttons.html">
                            <i class="align-middle" data-feather="square"></i> <span class="align-middle">Buttons</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="ui-forms.html">
                            <i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Forms</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="ui-cards.html">
                            <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Cards</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="ui-typography.html">
                            <i class="align-middle" data-feather="align-left"></i> <span class="align-middle">Typography</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="icons-feather.html">
                            <i class="align-middle" data-feather="coffee"></i> <span class="align-middle">Icons</span>
                        </a>
                    </li>

                    <li class="sidebar-header">
                        Plugins & Addons
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="charts-chartjs.html">
                            <i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Charts</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="maps-google.html">
                            <i class="align-middle" data-feather="map"></i> <span class="align-middle">Maps</span>
                        </a>
                    </li>
                </ul>

                <div class="sidebar-cta">
                    <div class="sidebar-cta-content">
                        <strong class="d-inline-block mb-2">Upgrade to Pro</strong>
                        <div class="mb-3 text-sm">
                            Are you looking for more components? Check out our premium version.
                        </div>
                        <div class="d-grid">
                            <a href="upgrade-to-pro.html" class="btn btn-primary">Upgrade to Pro</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <div class="main">
            <nav class="navbar navbar-expand navbar-light navbar-bg">
                <a class="sidebar-toggle js-sidebar-toggle">
                    <i class="hamburger align-self-center"></i>
                </a>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav navbar-align">
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
                                <div class="position-relative">
                                    <i class="align-middle" data-feather="bell"></i>
                                    <span class="indicator">4</span>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
                                <div class="dropdown-menu-header">
                                    4 New Notifications
                                </div>
                                <div class="list-group">
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-danger" data-feather="alert-circle"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">Update completed</div>
                                                <div class="text-muted small mt-1">Restart server 12 to complete the update.</div>
                                                <div class="text-muted small mt-1">30m ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-warning" data-feather="bell"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">Lorem ipsum</div>
                                                <div class="text-muted small mt-1">Aliquam ex eros, imperdiet vulputate hendrerit et.</div>
                                                <div class="text-muted small mt-1">2h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-primary" data-feather="home"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">Login from 192.186.1.8</div>
                                                <div class="text-muted small mt-1">5h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <i class="text-success" data-feather="user-plus"></i>
                                            </div>
                                            <div class="col-10">
                                                <div class="text-dark">New connection</div>
                                                <div class="text-muted small mt-1">Christina accepted your request.</div>
                                                <div class="text-muted small mt-1">14h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="dropdown-menu-footer">
                                    <a href="#" class="text-muted">Show all notifications</a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle" href="#" id="messagesDropdown" data-bs-toggle="dropdown">
                                <div class="position-relative">
                                    <i class="align-middle" data-feather="message-square"></i>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="messagesDropdown">
                                <div class="dropdown-menu-header">
                                    <div class="position-relative">
                                        4 New Messages
                                    </div>
                                </div>
                                <div class="list-group">
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <img src="../../adminkit/static/img/avatars/avatar-5.jpg" class="avatar img-fluid rounded-circle" alt="Vanessa Tucker">
                                            </div>
                                            <div class="col-10 ps-2">
                                                <div class="text-dark">Vanessa Tucker</div>
                                                <div class="text-muted small mt-1">Nam pretium turpis et arcu. Duis arcu tortor.</div>
                                                <div class="text-muted small mt-1">15m ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <img src="../../adminkit/static/img/avatars/avatar-2.jpg" class="avatar img-fluid rounded-circle" alt="William Harris">
                                            </div>
                                            <div class="col-10 ps-2">
                                                <div class="text-dark">William Harris</div>
                                                <div class="text-muted small mt-1">Curabitur ligula sapien euismod vitae.</div>
                                                <div class="text-muted small mt-1">2h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <img src="../../adminkit/static/img/avatars/avatar-4.jpg" class="avatar img-fluid rounded-circle" alt="Christina Mason">
                                            </div>
                                            <div class="col-10 ps-2">
                                                <div class="text-dark">Christina Mason</div>
                                                <div class="text-muted small mt-1">Pellentesque auctor neque nec urna.</div>
                                                <div class="text-muted small mt-1">4h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="row g-0 align-items-center">
                                            <div class="col-2">
                                                <img src="../../adminkit/static/img/avatars/avatar-3.jpg" class="avatar img-fluid rounded-circle" alt="Sharon Lessman">
                                            </div>
                                            <div class="col-10 ps-2">
                                                <div class="text-dark">Sharon Lessman</div>
                                                <div class="text-muted small mt-1">Aenean tellus metus, bibendum sed, posuere ac, mattis non.</div>
                                                <div class="text-muted small mt-1">5h ago</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="dropdown-menu-footer">
                                    <a href="#" class="text-muted">Show all messages</a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>

                            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                                <img src="../../adminkit/static/img/avatars/avatar.jpg" class="avatar img-fluid rounded me-1" alt="Charles Hall" /> <span class="text-dark">Charles Hall</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="pages-profile.html"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
                                <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="pie-chart"></i> Analytics</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="index.html"><i class="align-middle me-1" data-feather="settings"></i> Settings & Privacy</a>
                                <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="help-circle"></i> Help Center</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Log out</a>
                            </div>
                        </li>
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

            <main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>

                    <div class="row">
                        <div class="col-xl-6 col-xxl-5 d-flex">
                            <div class="w-100">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col mt-0">
                                                        <h5 class="card-title">Sales</h5>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="stat text-primary">
                                                            <i class="align-middle" data-feather="truck"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h1 class="mt-1 mb-3">2.382</h1>
                                                <div class="mb-0">
                                                    <span class="text-danger">-3.65%</span>
                                                    <span class="text-muted">Since last week</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col mt-0">
                                                        <h5 class="card-title">Visitors</h5>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="stat text-primary">
                                                            <i class="align-middle" data-feather="users"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h1 class="mt-1 mb-3">14.212</h1>
                                                <div class="mb-0">
                                                    <span class="text-success">5.25%</span>
                                                    <span class="text-muted">Since last week</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col mt-0">
                                                        <h5 class="card-title">Earnings</h5>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="stat text-primary">
                                                            <i class="align-middle" data-feather="dollar-sign"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h1 class="mt-1 mb-3">$21.300</h1>
                                                <div class="mb-0">
                                                    <span class="text-success">6.65%</span>
                                                    <span class="text-muted">Since last week</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col mt-0">
                                                        <h5 class="card-title">Orders</h5>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="stat text-primary">
                                                            <i class="align-middle" data-feather="shopping-cart"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h1 class="mt-1 mb-3">64</h1>
                                                <div class="mb-0">
                                                    <span class="text-danger">-2.25%</span>
                                                    <span class="text-muted">Since last week</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 col-xxl-7">
                            <div class="card flex-fill w-100">
                                <div class="card-header">

                                    <h5 class="card-title mb-0">Recent Movement</h5>
                                </div>
                                <div class="card-body py-3">
                                    <div class="chart chart-sm">
                                        <canvas id="chartjs-dashboard-line"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6 col-xxl-3 d-flex order-2 order-xxl-3">
                            <div class="card flex-fill w-100">
                                <div class="card-header">

                                    <h5 class="card-title mb-0">Browser Usage</h5>
                                </div>
                                <div class="card-body d-flex">
                                    <div class="align-self-center w-100">
                                        <div class="py-3">
                                            <div class="chart chart-xs">
                                                <canvas id="chartjs-dashboard-pie"></canvas>
                                            </div>
                                        </div>

                                        <table class="table mb-0">
                                            <tbody>
                                                <tr>
                                                    <td>Chrome</td>
                                                    <td class="text-end">4306</td>
                                                </tr>
                                                <tr>
                                                    <td>Firefox</td>
                                                    <td class="text-end">3801</td>
                                                </tr>
                                                <tr>
                                                    <td>IE</td>
                                                    <td class="text-end">1689</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-12 col-xxl-6 d-flex order-3 order-xxl-2">
                            <div class="card flex-fill w-100">
                                <div class="card-header">

                                    <h5 class="card-title mb-0">Real-Time</h5>
                                </div>
                                <div class="card-body px-4">
                                    <div id="world_map" style="height:350px;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-xxl-3 d-flex order-1 order-xxl-1">
                            <div class="card flex-fill">
                                <div class="card-header">

                                    <h5 class="card-title mb-0">Calendar</h5>
                                </div>
                                <div class="card-body d-flex">
                                    <div class="align-self-center w-100">
                                        <div class="chart">
                                            <div id="datetimepicker-dashboard"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 d-flex">
                            <div class="card flex-fill">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Quản lý đơn hàng</h5>
                                    <div class="revenue-summary mt-2">
                                        <?php
                                        $revenue = calculateTotalRevenue($orders);
                                        echo "<h4>Tổng doanh thu: " . number_format($revenue) . " VND</h4>";
                                        ?>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover my-0">
                                            <thead>
                                                <tr>
                                                    <th>Tên người dùng</th>
                                                    <th class="d-none d-md-table-cell">Tên người mua</th>
                                                    <th class="d-none d-xl-table-cell">Địa chỉ</th>
                                                    <th class="d-none d-xl-table-cell">Số điện thoại</th>
                                                    <th>Tên sản phẩm</th>
                                                    <th>Số lượng</th>
                                                    <th>Tổng tiền</th>
                                                    <th class="d-none d-md-table-cell">Thời gian tạo</th>
                                                    <th>Trạng thái</th>
                                                    <th>Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($orders as $order): ?>
                                                    <tr>
                                                        <td><?php echo htmlspecialchars($order['username']); ?></td>
                                                        <td class="d-none d-md-table-cell"><?php echo htmlspecialchars($order['name'] ?? ''); ?></td>
                                                        <td class="d-none d-xl-table-cell"><?php echo htmlspecialchars($order['address'] ?? ''); ?></td>
                                                        <td class="d-none d-xl-table-cell"><?php echo htmlspecialchars($order['phone'] ?? ''); ?></td>
                                                        <td><?php echo htmlspecialchars($order['product_name']); ?></td>
                                                        <td><?php echo $order['quantity']; ?></td>
                                                        <td><?php echo number_format($order['total_price']); ?> VND</td>
                                                        <td class="d-none d-md-table-cell"><?php echo date('H:i d/m/Y', strtotime($order['created_at'])); ?></td>
                                                        <td>
                                                            <span class="badge <?php
                                                                                switch ($order['status']) {
                                                                                    case 'pending':
                                                                                        echo 'bg-warning';
                                                                                        break;
                                                                                    case 'completed':
                                                                                        echo 'bg-success';
                                                                                        break;
                                                                                    case 'cancelled':
                                                                                        echo 'bg-danger';
                                                                                        break;
                                                                                    default:
                                                                                        echo 'bg-secondary';
                                                                                }
                                                                                ?>">
                                                                <?php echo htmlspecialchars(ucfirst($order['status'])); ?>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <form method="POST" class="update-status-form" data-order-id="<?php echo $order['order_id']; ?>">
                                                                <div class="d-flex align-items-center">
                                                                    <select name="status" class="form-select form-select-sm me-2" style="width: 120px;">
                                                                        <option value="pending" <?php if ($order['status'] === 'pending') echo 'selected'; ?>>Pending</option>
                                                                        <option value="completed" <?php if ($order['status'] === 'completed') echo 'selected'; ?>>Completed</option>
                                                                        <option value="cancelled" <?php if ($order['status'] === 'cancelled') echo 'selected'; ?>>Cancelled</option>
                                                                    </select>
                                                                    <button type="submit" class="btn btn-sm btn-primary">Cập nhật</button>
                                                                </div>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <a href="?controller=product&action=index" class="btn btn-secondary mt-3">Quay lại</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <a class="text-muted" href="https://adminkit.io/" target="_blank"><strong>AdminKit</strong></a> - <a class="text-muted" href="https://adminkit.io/" target="_blank"><strong>Bootstrap Admin Template</strong></a> &copy;
                            </p>
                        </div>
                        <div class="col-6 text-end">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a class="text-muted" href="https://adminkit.io/" target="_blank">Support</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="https://adminkit.io/" target="_blank">Help Center</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="https://adminkit.io/" target="_blank">Privacy</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="https://adminkit.io/" target="_blank">Terms</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="../../adminkit/static/js/app.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");
            var gradient = ctx.createLinearGradient(0, 0, 0, 225);
            gradient.addColorStop(0, "rgba(215, 227, 244, 1)");
            gradient.addColorStop(1, "rgba(215, 227, 244, 0)");
            // Line chart
            new Chart(document.getElementById("chartjs-dashboard-line"), {
                type: "line",
                data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    datasets: [{
                        label: "Sales ($)",
                        fill: true,
                        backgroundColor: gradient,
                        borderColor: window.theme.primary,
                        data: [
                            2115,
                            1562,
                            1584,
                            1892,
                            1587,
                            1923,
                            2566,
                            2448,
                            2805,
                            3438,
                            2917,
                            3327
                        ]
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    tooltips: {
                        intersect: false
                    },
                    hover: {
                        intersect: true
                    },
                    plugins: {
                        filler: {
                            propagate: false
                        }
                    },
                    scales: {
                        xAxes: [{
                            reverse: true,
                            gridLines: {
                                color: "rgba(0,0,0,0.0)"
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                stepSize: 1000
                            },
                            display: true,
                            borderDash: [3, 3],
                            gridLines: {
                                color: "rgba(0,0,0,0.0)"
                            }
                        }]
                    }
                }
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Pie chart
            new Chart(document.getElementById("chartjs-dashboard-pie"), {
                type: "pie",
                data: {
                    labels: ["Chrome", "Firefox", "IE"],
                    datasets: [{
                        data: [4306, 3801, 1689],
                        backgroundColor: [
                            window.theme.primary,
                            window.theme.warning,
                            window.theme.danger
                        ],
                        borderWidth: 5
                    }]
                },
                options: {
                    responsive: !window.MSInputMethodContext,
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    cutoutPercentage: 75
                }
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Bar chart
            new Chart(document.getElementById("chartjs-dashboard-bar"), {
                type: "bar",
                data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    datasets: [{
                        label: "This year",
                        backgroundColor: window.theme.primary,
                        borderColor: window.theme.primary,
                        hoverBackgroundColor: window.theme.primary,
                        hoverBorderColor: window.theme.primary,
                        data: [54, 67, 41, 55, 62, 45, 55, 73, 60, 76, 48, 79],
                        barPercentage: .75,
                        categoryPercentage: .5
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                            gridLines: {
                                display: false
                            },
                            stacked: false,
                            ticks: {
                                stepSize: 20
                            }
                        }],
                        xAxes: [{
                            stacked: false,
                            gridLines: {
                                color: "transparent"
                            }
                        }]
                    }
                }
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var markers = [{
                    coords: [31.230391, 121.473701],
                    name: "Shanghai"
                },
                {
                    coords: [28.704060, 77.102493],
                    name: "Delhi"
                },
                {
                    coords: [6.524379, 3.379206],
                    name: "Lagos"
                },
                {
                    coords: [35.689487, 139.691711],
                    name: "Tokyo"
                },
                {
                    coords: [23.129110, 113.264381],
                    name: "Guangzhou"
                },
                {
                    coords: [40.7127837, -74.0059413],
                    name: "New York"
                },
                {
                    coords: [34.052235, -118.243683],
                    name: "Los Angeles"
                },
                {
                    coords: [41.878113, -87.629799],
                    name: "Chicago"
                },
                {
                    coords: [51.507351, -0.127758],
                    name: "London"
                },
                {
                    coords: [40.416775, -3.703790],
                    name: "Madrid "
                }
            ];
            var map = new jsVectorMap({
                map: "world",
                selector: "#world_map",
                zoomButtons: true,
                markers: markers,
                markerStyle: {
                    initial: {
                        r: 9,
                        strokeWidth: 7,
                        stokeOpacity: .4,
                        fill: window.theme.primary
                    },
                    hover: {
                        fill: window.theme.primary,
                        stroke: window.theme.primary
                    }
                },
                zoomOnScroll: false
            });
            window.addEventListener("resize", () => {
                map.updateSize();
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var date = new Date(Date.now() - 5 * 24 * 60 * 60 * 1000);
            var defaultDate = date.getUTCFullYear() + "-" + (date.getUTCMonth() + 1) + "-" + date.getUTCDate();
            document.getElementById("datetimepicker-dashboard").flatpickr({
                inline: true,
                prevArrow: "<span title=\"Previous month\">&laquo;</span>",
                nextArrow: "<span title=\"Next month\">&raquo;</span>",
                defaultDate: defaultDate
            });
        });
    </script>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>