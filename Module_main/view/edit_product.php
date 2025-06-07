<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa sản phẩm</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
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
                            <a class="sidebar-link" href="?controller=farming_process&action=manage">
                                <i class="align-middle" data-feather="log-in"></i> <span class="align-middle">Quản lí sản đơn hàng</span>
                            </a>
                        <?php endif; ?>

                    </li>

                    <li class="sidebar-item">
                        <?php if ($_SESSION['role'] === 'admin'): ?>
                            <a class="sidebar-link" href="?controller=article&action=manage">
                                <i class="align-middle" data-feather="log-in"></i> <span class="align-middle">Quản lí Bài báo</span>
                            </a>
                        <?php endif; ?>

                    </li>
                    <li class="sidebar-item">
                        <?php if ($_SESSION['role'] === 'admin'): ?>
                            <a class="sidebar-link" href="?controller=farming_process&action=manage">
                                <i class="align-middle" data-feather="log-in"></i> <span class="align-middle">Quản lí cách chăn nuôi </span>
                            </a>
                        <?php endif; ?>

                    </li>

                    <li class="sidebar-item">
                        <?php if ($_SESSION['role'] === 'admin'): ?>
                            <a class="sidebar-link" href="?controller=product&action=manage">
                                <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Quản lí sản sản phẩm</span>
                            </a>
                        <?php endif; ?>

                    </li>
                    <li class="sidebar-item">
                        <?php if ($_SESSION['role'] === 'admin'): ?>
                            <a class="sidebar-link" href="?controller=product&action=inventory">
                                <i class="align-middle" data-feather="user-plus"></i>
                                <pan class="align-middle">Quản lí sản phẩm tồn kho </pan>
                            </a>
                        <?php endif; ?>

                    </li>
                    <li class="sidebar-item">
                        <?php if ($_SESSION['role'] === 'admin'): ?>
                            <a class="sidebar-link" href="?controller=auth&action=logout">
                                <i class="align-middle" data-feather="user-plus"></i>
                                <pan class="align-middle">Đăng xuất</pan>
                            </a>
                        <?php endif; ?>

                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="pages-sign-in.html">
                            <i class="align-middle" data-feather="log-in"></i> <span class="align-middle">Sign In</span>
                        </a>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link" href="pages-sign-up.html">
                            <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Sign Up</span>
                        </a>
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
            <div class="container mt-5">
                <h2>Sửa sản phẩm</h2>
                <form id="edit-product-form" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="edit_product" value="1">
                    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['ID'] ?? ''); ?>">
                    <div class="form-group">
                        <label for="name" class="font-semibold">Tên sản phẩm</label>
                        <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($product['name'] ?? ''); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="price" class="font-semibold">Giá</label>
                        <input type="number" name="price" step="0.01" class="form-control" min="0" value="<?php echo htmlspecialchars($product['price'] ?? ''); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="quantity" class="font-semibold">Số lượng</label>
                        <input type="number" name="quantity" class="form-control" min="0" value="<?php echo htmlspecialchars($product['quantity'] ?? ''); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="description" class="font-semibold">Mô tả</label>
                        <textarea name="description" class="form-control" rows="4"><?php echo htmlspecialchars($product['description'] ?? ''); ?></textarea>
                        <p data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" style="color: red; font-size: 10px;cursor: pointer;"> Xem chi tiết các nhập mô tả(Hãy bấm vào đây để xem)</p>


                        <div class="collapse" id="collapseExample">
                            <p style="font-size: 15px;font-weight: bold;"> * Hướng dẫn sử dụng copy vào AI nó sẽ hiểu:</p>
                            <p style="margin-top: 20px;"> * - Dùng $text$ để tạo chữ đậm, màu đen, kích thước 18px (ví dụ: $Phần 1$).</p>
                            <p> * - Dùng | để tạo bảng (ví dụ: "Tiêu đề 1|Tiêu đề 2\nGiá trị 1|Giá trị 2").</p>
                            <p>* - Dùng *text* để tạo danh sách gạch đầu dòng (ví dụ: *Mục 1*).</p>
                            <p> * - Mỗi dòng mới (\n) sẽ tạo một đoạn văn bản riêng, kích thước chữ tự động điều chỉnh:</p>

                            <p>* + Dưới 50 ký tự: 16px (text-base).</p>
                            <p> * + 50-100 ký tự: 14px (text-sm).</p>
                            <p> * + Trên 100 ký tự: 12px (text-xs).</p>
                            <p> * - Các ký tự HTML sẽ được mã hóa để tránh lỗi bảo mật.</p>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="category_id" class="font-semibold">Danh mục</label>
                        <select name="category_id" class="form-control" required>
                            <option value="">Chọn danh mục</option>
                            <?php
                            $categories = $this->product->getAllCategory();
                            if (empty($categories)) {
                                echo '<option value="" disabled>Không có danh mục nào</option>';
                            } else {
                                foreach ($categories as $category) {
                                    $id = htmlspecialchars($category['ID'] ?? '');
                                    $name = htmlspecialchars($category['name'] ?? '');
                                    $selected = ($id == ($product['category_id'] ?? '')) ? 'selected' : '';
                                    if ($id && $name) {
                                        echo "<option value=\"$id\" $selected>$name</option>";
                                    }
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="is_locked" class="font-semibold">Trạng thái khóa</label>
                        <input type="checkbox" name="is_locked" value="1" <?php echo isset($product['is_locked']) && $product['is_locked'] ? 'checked' : ''; ?>>
                        <small class="form-text text-muted">Chọn để khóa sản phẩm (khóa = 1, mở khóa = 0).</small>
                    </div>
                    <div class="form-group">
                        <label for="img" class="font-semibold">Ảnh sản phẩm mới (có thể chọn nhiều)</label>
                        <input type="file" name="img[]" class="form-control-file" accept="image/*" multiple>
                    </div>
                    <div class="form-group">
                        <label for="top" class="font-semibold">Sản phẩm nổi bật</label>
                        <input type="checkbox" name="top" value="1" <?php echo isset($product['top']) && $product['top'] ? 'checked' : ''; ?> class="form-check-input">
                        <small class="form-text text-muted">Chọn để đánh dấu sản phẩm là nổi bật.</small>
                    </div>
                    <div class="form-group">
                        <label class="font-semibold">Ảnh hiện tại (chọn để xóa)</label>
                        <?php if (!empty($product['images']) && is_array($product['images'])): ?>
                            <?php foreach ($product['images'] as $image): ?>
                                <?php $image_id = $image['ID'] ?? null; ?>
                                <?php if ($image_id): ?>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="delete_images[]" value="<?php echo htmlspecialchars($image_id); ?>" class="custom-control-input" id="image_<?php echo htmlspecialchars($image_id); ?>">
                                        <label class="custom-control-label" for="image_<?php echo htmlspecialchars($image_id); ?>">
                                            <img src="../public/img/<?php echo htmlspecialchars($image['image_url'] ?? 'default-placeholder.png'); ?>" width="50" alt="Product Image">
                                        </label>
                                        <a href="?controller=product&action=remove_image&id=<?php echo htmlspecialchars($product['ID'] ?? ''); ?>&image_id=<?php echo htmlspecialchars($image_id); ?>" class="btn btn-sm btn-danger ml-2 remove-image" data-image-id="<?php echo htmlspecialchars($image_id); ?>">Xóa</a>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>Không có ảnh.</p>
                        <?php endif; ?>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Cập nhật sản phẩm</button>
                    <a href="?controller=product&action=manage" class="btn btn-secondary mt-3">Quay lại</a>
                </form>
            </div>
            <script>
                $(document).ready(function() {
                    $('#edit-product-form').on('submit', function(e) {
                        e.preventDefault();
                        let name = $('input[name="name"]').val().trim();
                        let price = $('input[name="price"]').val();
                        let quantity = $('input[name="quantity"]').val();
                        let category_id = $('select[name="category_id"]').val();

                        if (!name) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Lỗi!',
                                text: 'Tên sản phẩm không được để trống.',
                                confirmButtonText: 'OK'
                            });
                            return;
                        }
                        if (!price || price <= 0) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Lỗi!',
                                text: 'Giá phải là số dương.',
                                confirmButtonText: 'OK'
                            });
                            return;
                        }
                        if (!quantity || quantity < 0) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Lỗi!',
                                text: 'Số lượng phải là số không âm.',
                                confirmButtonText: 'OK'
                            });
                            return;
                        }
                        if (!category_id || category_id === '') {
                            Swal.fire({
                                icon: 'error',
                                title: 'Lỗi!',
                                text: 'Vui lòng chọn danh mục.',
                                confirmButtonText: 'OK'
                            });
                            return;
                        }

                        let formData = new FormData(this);
                        $.ajax({
                            url: '?controller=product&action=edit&id=<?php echo htmlspecialchars($product['ID'] ?? ''); ?>',
                            method: 'POST',
                            data: formData,
                            contentType: false,
                            processData: false,
                            dataType: 'json',
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Thành công!',
                                        text: `Sản phẩm "${name}" đã được cập nhật.`,
                                        confirmButtonText: 'OK'
                                    }).then(() => {
                                        window.location.href = '?controller=product&action=manage';
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Lỗi!',
                                        text: response.message || 'Cập nhật sản phẩm thất bại.',
                                        confirmButtonText: 'OK'
                                    });
                                }
                            },
                            error: function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Lỗi!',
                                    text: 'Không thể kết nối đến server. Vui lòng thử lại.',
                                    confirmButtonText: 'OK'
                                });
                            }
                        });
                    });

                    // Handle individual image removal via AJAX
                    $('.remove-image').on('click', function(e) {
                        e.preventDefault();
                        let imageId = $(this).data('image-id');
                        let productId = '<?php echo htmlspecialchars($product['ID'] ?? ''); ?>';
                        if (!imageId || !productId) return;

                        Swal.fire({
                            title: 'Bạn có chắc?',
                            text: "Hành động này sẽ xóa ảnh vĩnh viễn!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'Xóa',
                            cancelButtonText: 'Hủy'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: '?controller=product&action=remove_image&id=' + productId + '&image_id=' + imageId,
                                    method: 'GET',
                                    dataType: 'json',
                                    success: function(response) {
                                        if (response.success) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Thành công!',
                                                text: response.message,
                                                confirmButtonText: 'OK'
                                            }).then(() => {
                                                location.reload(); // Reload page to reflect changes
                                            });
                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Lỗi!',
                                                text: response.message,
                                                confirmButtonText: 'OK'
                                            });
                                        }
                                    },
                                    error: function() {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Lỗi!',
                                            text: 'Không thể kết nối đến server. Vui lòng thử lại.',
                                            confirmButtonText: 'OK'
                                        });
                                    }
                                });
                            }
                        });
                    });
                });
            </script>
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
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

            <!-- SCRIPTS - AT THE BOTTOM TO REDUCE LOAD TIME -->
            <script src="../../bs-advance-admin/advance-admin/assets/js/jquery-1.10.2.js"></script>
            <script src="../../bs-advance-admin/advance-admin/assets/js/bootstrap.js"></script>
            <script src="../../bs-advance-admin/advance-admin/assets/js/jquery.metisMenu.js"></script>
            <script src="../../bs-advance-admin/advance-admin/assets/js/custom.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>