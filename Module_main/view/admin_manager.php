<!DOCTYPE html>
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
                            $id = htmlspecialchars($category['id'] ?? '');
                            $name = htmlspecialchars($category['name'] ?? '');
                            if ($id !== '') {
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

</html>