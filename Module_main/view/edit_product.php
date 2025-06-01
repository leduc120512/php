<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa sản phẩm</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
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
</body>

</html>