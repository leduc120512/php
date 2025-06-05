<!-- <!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="path/to/public/js/add-product.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h2>Thêm sản phẩm</h2>
        <form id="add-product-form" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="add_product" value="1">
            <div class="form-group">
                <label for="name" class="font-semibold">Tên sản phẩm</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="price" class="font-semibold">Giá</label>
                <input type="number" name="price" step="0.01" class="form-control" min="0" required>
            </div>
            <div class="form-group">
                <label for="quantity" class="font-semibold">Số lượng</label>
                <input type="number" name="quantity" class="form-control" min="0" required>
            </div>
            <div class="form-group">
                <label for="description" class="font-semibold">Mô tả</label>
                <textarea name="description" class="form-control" rows="4"></textarea>
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
                            if ($id && $name) {
                                echo "<option value=\"$id\">$name</option>";
                            }
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="img" class="font-semibold">Ảnh sản phẩm (có thể chọn nhiều)</label>
                <input type="file" name="img[]" class="form-control-file" accept="image/*" multiple>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Thêm sản phẩm</button>
        </form>
        <div class="panel panel-default">
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
                                <?php foreach ($this->product->getAllAdmin() as $product): ?>
                                    <tr data-product-id="<?php echo $product['ID']; ?>">
                                        <td><?php echo htmlspecialchars($product['name']); ?></td>
                                        <td>
                                            <?php if (!empty($product['main_image'])): ?>
                                                <img src="img/<?php echo htmlspecialchars($product['main_image']); ?>" width="50" alt="Product Image">
                                            <?php else: ?>
                                                <img src="img/default-placeholder.png" width="50" alt="No Image">
                                            <?php endif; ?>
                                        </td>
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
        <script>
            $(document).ready(function() {
                console.log('add-product.js loaded');

                if ($('select[name="category_id"]').length === 0) {
                    console.error('Select element with name="category_id" not found');
                }

                $('#add-product-form').on('submit', function(e) {
                    e.preventDefault();
                    console.log('Form submit triggered');

                    let name = $('input[name="name"]').val().trim();
                    let price = $('input[name="price"]').val();
                    let quantity = $('input[name="quantity"]').val();
                    let category_id = $('select[name="category_id"]').val();

                    console.log('Selected category_id:', category_id);

                    if (!name) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi!',
                            text: 'Tên sản phẩm không được để trống.',
                            confirmButtonText: 'OK'
                        });
                        console.log('Validation failed: Name is empty');
                        return;
                    }
                    if (!price || price <= 0) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi!',
                            text: 'Giá phải là số dương.',
                            confirmButtonText: 'OK'
                        });
                        console.log('Validation failed: Invalid price');
                        return;
                    }
                    if (!quantity || quantity < 0) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi!',
                            text: 'Số lượng phải là số không âm.',
                            confirmButtonText: 'OK'
                        });
                        console.log('Validation failed: Invalid quantity');
                        return;
                    }
                    if (!category_id || category_id === '') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi!',
                            text: 'Vui lòng chọn danh mục.',
                            confirmButtonText: 'OK'
                        });
                        console.log('Validation failed: Category not selected or empty');
                        return;
                    }

                    let formData = new FormData(this);
                    // Debug: Log FormData
                    for (let [key, value] of formData.entries()) {
                        if (key === 'img[]' && value instanceof File) {
                            console.log(`FormData - ${key}: ${value.name}, Size: ${value.size} bytes`);
                        } else {
                            console.log(`FormData - ${key}:`, value);
                        }
                    }

                    $.ajax({
                        url: '?controller=product&action=add',
                        method: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        beforeSend: function() {
                            console.log('Sending AJAX request to ?controller=product&action=add');
                        },
                        success: function(response) {
                            console.log('AJAX Success:', response);
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Thành công!',
                                    text: `Sản phẩm "${name}" đã được thêm.`,
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    window.location.href = '?controller=product&action=manage';
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Lỗi!',
                                    text: response.message || 'Thêm sản phẩm thất bại.',
                                    confirmButtonText: 'OK'
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX Error:', xhr.status, status, error);
                            console.log('Response Text:', xhr.responseText);
                            Swal.fire({
                                icon: 'error',
                                title: 'Lỗi!',
                                text: 'Không thể kết nối đến server. Vui lòng thử lại.',
                                confirmButtonText: 'OK'
                            });
                        }
                    });
                });
            });
        </script>
</body>

</html> -->
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <div class="container mt-5">
        <!-- Search Form -->
        <div class="card mb-4">
            <div class="card-header">Tìm kiếm sản phẩm</div>
            <div class="card-body">
                <form id="search-form" method="GET" action="?controller=product&action=manage">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="name">Tên sản phẩm</label>
                            <input type="text" name="name" id="name" class="form-control" value="<?php echo isset($_GET['name']) ? htmlspecialchars($_GET['name']) : ''; ?>">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="id">ID sản phẩm</label>
                            <input type="number" name="id" id="id" class="form-control" value="<?php echo isset($_GET['id']) ? htmlspecialchars($_GET['id']) : ''; ?>">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="start_date">Từ ngày</label>
                            <input type="date" name="start_date" id="start_date" class="form-control" value="<?php echo isset($_GET['start_date']) ? htmlspecialchars($_GET['start_date']) : ''; ?>">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="end_date">Đến ngày</label>
                            <input type="date" name="end_date" id="end_date" class="form-control" value="<?php echo isset($_GET['end_date']) ? htmlspecialchars($_GET['end_date']) : ''; ?>">
                        </div>
                        <div class="form-group col-md-1">
                            <label>&nbsp;</label>
                            <button type="submit" class="btn btn-primary btn-block">Tìm</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Add Product Button -->
        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">
            Thêm sản phẩm mới
        </button>

        <!-- Add Product Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thêm sản phẩm</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="add-product-form" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="add_product" value="1">
                            <div class="form-group">
                                <label for="name" class="font-semibold">Tên sản phẩm</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="price" class="font-semibold">Giá</label>
                                <input type="number" name="price" step="0.01" class="form-control" min="0" required>
                            </div>
                            <div class="form-group">
                                <label for="quantity" class="font-semibold">Số lượng</label>
                                <input type="number" name="quantity" class="form-control" min="0" required>
                            </div>

                            <div class="form-group">
                                <label for="description" class="font-semibold">Mô tả</label>
                                <textarea name="description" class="form-control" rows="4"></textarea>


                                <!-- Dialog -->

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
                                            if ($id && $name) {
                                                echo "<option value=\"$id\">$name</option>";
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="top" class="font-semibold">Sản phẩm nổi bật</label>
                                <input type="checkbox" name="top" value="1" class="form-check-input">
                            </div>
                            <div class="form-group">
                                <label for="img" class="font-semibold">Ảnh sản phẩm (có thể chọn nhiều)</label>
                                <input type="file" name="img[]" class="form-control-file" accept="image/*" multiple>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Thêm sản phẩm</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product List -->
        <div class="panel panel-default">
            <div class="panel-heading">Danh sách sản phẩm</div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Ảnh</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Ngày tạo</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody id="product-list">
                            <?php foreach ($products as $product): ?>
                                <tr data-product-id="<?php echo $product['ID']; ?>">
                                    <td><?php echo htmlspecialchars($product['ID']); ?></td>
                                    <td><?php echo htmlspecialchars($product['name']); ?></td>
                                    <td>
                                        <?php if (!empty($product['main_image'])): ?>
                                            <img src="img/<?php echo htmlspecialchars($product['main_image']); ?>" width="50" alt="Product Image">
                                        <?php else: ?>
                                            <img src="img/default-placeholder.png" width="50" alt="No Image">
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo number_format($product['price']); ?> VND</td>
                                    <td><?php echo $product['quantity']; ?></td>
                                    <td><?php echo htmlspecialchars($product['created_at']); ?></td>
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

    <script>
        $(document).ready(function() {
            // Existing add product form submission code
            $('#add-product-form').on('submit', function(e) {
                e.preventDefault();
                let name = $('input[name="name"]').val().trim();
                let price = $('input[name="price"]').val();
                let quantity = $('input[name="quantity"]').val();
                let category_id = $('select[name="category_id"]').val();


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
                    url: '?controller=product&action=add',
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
                                text: `Sản phẩm  đã được thêm.`,
                                confirmButtonText: 'OK'
                            }).then(() => {
                                window.location.href = '?controller=product&action=manage';
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Lỗi!',
                                text: response.message || 'Thêm sản phẩm thất bại.',
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi!',
                            text: 'Không thể kết nối đến server.',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });

            // Optional: AJAX search for dynamic updates
            $('#search-form').on('submit', function(e) {
                e.preventDefault();
                let formData = $(this).serializeArray();
                let data = {};
                formData.forEach(item => {
                    data[item.name] = item.value;
                });

                $.ajax({
                    url: '?controller=product&action=searchAjax_2',
                    method: 'POST',
                    data: data,
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            let html = '';
                            response.products.forEach(product => {
                                html += `
                                    <tr data-product-id="${product.ID}">
                                        <td>${product.ID}</td>
                                        <td>${product.name}</td>
                                        <td>
                                            ${product.main_image ? 
                                                `<img src="img/${product.main_image}" width="50" alt="Product Image">` : 
                                                `<img src="img/default-placeholder.png" width="50" alt="No Image">`
                                            }
                                        </td>
                                        <td>${new Intl.NumberFormat('vi-VN').format(product.price)} VND</td>
                                        <td>${product.quantity}</td>
                                        <td>${product.created_at}</td>
                                        <td>
                                            <a href="?controller=product&action=edit&id=${product.ID}" class="btn btn-sm btn-warning">Sửa</a>
                                            <a href="?controller=product&action=delete&id=${product.ID}"
                                               class="btn btn-sm btn-danger btn-delete-product"
                                               data-product-name="${product.name}">Xóa</a>
                                        </td>
                                    </tr>`;
                            });
                            $('#product-list').html(html);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Lỗi!',
                                text: 'Không thể tìm kiếm sản phẩm.',
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi!',
                            text: 'Không thể kết nối đến server.',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>