<?php
// Kiểm tra sản phẩm có tồn tại
if (!isset($product) || !$product) {
    $_SESSION['error'] = "Sản phẩm không tồn tại.";
    header("Location: ?controller=product&action=index");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận mua hàng</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Xác nhận mua hàng</h2>
        <?php
        if (isset($_SESSION['error'])) {
            echo "<p style='color: red;'>" . htmlspecialchars($_SESSION['error']) . "</p>";
            unset($_SESSION['error']);
        }
        if (isset($_SESSION['success'])) {
            echo "<p style='color: green;'>" . htmlspecialchars($_SESSION['success']) . "</p>";
            unset($_SESSION['success']);
        }
        ?>
        <div class="row">
            <div class="col-md-6">
                <img src="../public/img/<?php echo htmlspecialchars($product['img']); ?>" class="img-fluid" alt="<?php echo htmlspecialchars($product['name']); ?>">
            </div>
            <div class="col-md-6">
                <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                <p><?php echo htmlspecialchars($product['description']); ?></p>
                <p>Đơn giá: <span id="unit-price"><?php echo number_format($product['price']); ?></span> VND</p>
                <p>Còn lại: <?php echo $product['quantity']; ?> sản phẩm</p>

                <form method="POST" action="?controller=order&action=buy" id="confirm-buy-form">
                    <input type="hidden" name="product_id" value="<?php echo $product['ID']; ?>">
                    <div class="form-group">
                        <label for="quantity">Số lượng:</label>
                        <input type="number"
                            id="quantity"
                            name="quantity"
                            value="1"
                            min="1"
                            max="<?php echo $product['quantity']; ?>"
                            class="form-control"
                            oninput="calculateTotal()">
                    </div>
                    <p>Tổng tiền: <span id="total-price"><?php echo number_format($product['price']); ?></span> VND</p>
                    <button type="submit" name="buy" class="btn btn-primary">Mua</button>
                    <a href="?controller=product&action=index" class="btn btn-secondary">Quay lại</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script>
    <script>
        function calculateTotal() {
            let quantity = parseInt(document.getElementById('quantity').value);
            let unitPrice = parseFloat(document.getElementById('unit-price').innerText.replace(/[^0-9.-]+/g, ""));
            let totalPrice = quantity * unitPrice;
            document.getElementById('total-price').innerText = totalPrice.toLocaleString();
        }
    </script>
</body>

</html>