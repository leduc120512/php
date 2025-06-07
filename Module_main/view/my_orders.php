<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ogani | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="../view/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../view/css/font-awesome.min.css" type="text/css">


    <link rel="stylesheet" href="../view/css/jquery-ui.min.css" type="text/css">


    <link rel="stylesheet" href="../view/css/owl.carousel.min.css" type="text/css">

    <link rel="stylesheet" href="../view/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="../view/css/style.css" type="text/css">
    <link rel="stylesheet" href="../view/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="../view/css/nice-select.css" type="text/css">
</head>
<style>
    .cart-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    .cart-table th,
    .cart-table td {
        padding: 12px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }

    .cart-table th {
        background-color: #f8f9fa;
        font-weight: bold;
        color: #343a40;
    }

    .cart-table td {
        vertical-align: middle;
    }

    .product-image {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 5px;
    }

    .no-items {
        text-align: center;
        font-size: 18px;
        color: #6c757d;
        margin: 20px 0;
    }

    .btn-back {
        display: inline-block;
        margin-top: 20px;
        padding: 10px 20px;
        background-color: #6c757d;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .btn-back:hover {
        background-color: #5a6268;
    }

    .error-message {
        color: #dc3545;
        font-size: 16px;
        margin-bottom: 20px;
    }

    .success-message {
        color: #28a745;
        font-size: 16px;
        margin-bottom: 20px;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f8f9fa;
    }

    /* Container tổng */
    .order-container {
        background-color: #fff;
        padding: 30px;
        border-radius: 16px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        max-width: 1000px;
        margin: auto;
    }

    /* Tiêu đề */
    .order-container h2 {
        font-size: 2rem;
        color: #2c3e50;
    }

    /* Thông báo lỗi */
    .error-message {
        color: #dc3545;
        font-weight: bold;
        margin-bottom: 15px;
    }

    /* Không có đơn */
    .no-orders {
        text-align: center;
        font-style: italic;
        color: #888;
        margin-top: 20px;
    }

    /* Bảng đơn hàng */
    .order-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        font-size: 0.95rem;
    }

    .order-table th,
    .order-table td {
        padding: 12px 15px;
        border-bottom: 1px solid #dee2e6;
        text-align: center;
    }

    .order-table thead {
        background-color: #f1f3f5;
    }

    .order-table tr:hover {
        background-color: #f8f9fa;
    }

    /* Ảnh sản phẩm */
    .product-image {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #ddd;
    }

    /* Nút quay lại */
    .btn-back {
        display: inline-block;
        margin-top: 25px;
        padding: 10px 20px;
        background-color: #28a745;
        color: white;
        text-decoration: none;
        border-radius: 8px;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    .btn-back:hover {
        background-color: #218838;
    }

    .order-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        border-radius: 8px;
    }

    .order-table thead {
        background-color: #3498db;
        color: white;
    }

    .order-table th,
    .order-table td {
        padding: 12px 15px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }

    .order-table tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .order-table tbody tr:hover {
        background-color: #e0f7fa;
        transition: 0.3s;
    }

    .product-image {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 6px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
    }

    .update-status-form button {
        background-color: #e74c3c;
        border: none;
        color: white;
        padding: 8px 12px;
        font-size: 14px;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .update-status-form button:hover {
        background-color: #c0392b;
    }
</style>

<body>
    <!-- Page Preloder -->


    <!-- Featured Section Begin -->
    <div class="container-fluid">
        <div class="fruit_container">
            <main class="container mt-5">

                <section class="order-section">
                    <div class="order-container">
                        <h2 class="text-center mb-4" style="font-family: 'Baloo Chettan', sans-serif; color: #343a40;">Đơn hàng của tôi</h2>

                        <?php if (isset($_SESSION['error'])): ?>
                            <p class="error-message text-center"><?php echo $_SESSION['error'];
                                                                    unset($_SESSION['error']); ?></p>
                        <?php endif; ?>

                        <?php if (empty($orders)): ?>
                            <p class="no-orders">Bạn chưa có đơn hàng nào.</p>
                        <?php else: ?>
                            <table class="order-table">
                                <thead>
                                    <tr>
                                        <th>Mã đơn hàng</th>
                                        <th>Sản phẩm</th>
                                        <th>Hình ảnh</th>
                                        <th>Số lượng</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày đặt</th>
                                        <th>Hủy đơn hàng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($orders as $order): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($order['order_id']); ?></td>
                                            <td><?php echo htmlspecialchars($order['product_name']); ?></td>
                                            <td>
                                                <img src="../public/img/<?php echo htmlspecialchars($order['product_image']); ?>"
                                                    class="product-image"
                                                    alt="<?php echo htmlspecialchars($order['product_name']); ?>">
                                            </td>
                                            <td><?php echo htmlspecialchars($order['quantity']); ?></td>
                                            <td><?php echo number_format($order['total_price'], 0, ',', '.') . ' VNĐ'; ?></td>
                                            <td><?php echo htmlspecialchars($order['status'] ?? 'Đang xử lý'); ?></td>
                                            <td><?php echo htmlspecialchars($order['created_at'] ?? date('Y-m-d H:i:s')); ?></td>
                                            <td>
                                                <form method="POST" class="update-status-form" data-order-id="<?php echo $order['order_id']; ?>">
                                                    <select name="status" hidden>
                                                        <option value="cancelled" <?php if ($order['status'] === 'cancelled') echo 'selected'; ?>>Cancelled</option>
                                                    </select>

                                                    <button type="submit" style="height: 40px; width: 100px;" class="btn btn-sm btn-danger">
                                                        Hủy
                                                    </button>
                                                </form>
                                            </td>

                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php endif; ?>

                        <a href="?controller=product&action=index" class="btn-back">Quay lại mua sắm</a>
                    </div>
                </section>
            </main>
        </div>
    </div>
    <!-- Featured Section End -->

    
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="../view/js/jquery-3.3.1.min.js"></script>
    <script src="../view/js/bootstrap.min.js"></script>
    <script src="../view/js/jquery.nice-select.min.js"></script>
    <script src="../view/js/jquery-ui.min.js"></script>
    <script src="../view/js/jquery.slicknav.js"></script>
    <script src="../view/js/mixitup.min.js"></script>
    <script src="../view/js/owl.carousel.min.js"></script>
    <script src="../view/js/main.js"></script>

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
                    url: '?controller=product&action=updateStatusUser',
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

</body>

</html>