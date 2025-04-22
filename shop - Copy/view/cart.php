<!DOCTYPE html>
<html>

<head>
    <title>Giỏ hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Giỏ hàng của bạn</h2>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?php echo $_SESSION['error'];
                unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?php echo $_SESSION['success'];
                unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <?php if (empty($cart)): ?>
            <p>Giỏ hàng trống.</p>
        <?php else: ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tổng</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total = 0; ?>
                    <?php foreach ($cart as $product_id => $item): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['name']); ?></td>
                            <td><?php echo number_format($item['price']); ?> VND</td>
                            <td><?php echo $item['quantity']; ?></td>
                            <td><?php
                                $subtotal = $item['price'] * $item['quantity'];
                                $total += $subtotal;
                                echo number_format($subtotal);
                                ?> VND</td>
                            <td>
                                <a href="?controller=order&action=removeFromCart&id=<?php echo $product_id; ?>"
                                    class="btn btn-danger btn-sm">Xóa</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="3"><strong>Tổng cộng:</strong></td>
                        <td><strong><?php echo number_format($total); ?> VND</strong></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>

            <a href="?controller=order&action=checkout" class="btn btn-primary">Thanh toán</a>
            <a href="?controller=product&action=index" class="btn btn-secondary">Tiếp tục mua sắm</a>
        <?php endif; ?>
    </div>
</body>

</html>