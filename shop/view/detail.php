<?php
require_once '../config/functions.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if ($id === false || $id === null) {
    // Thêm thông báo lỗi để debug
    $_SESSION['error'] = "ID sản phẩm không hợp lệ.";
    header("Location: ?controller=product&action=index&redirected=1"); // Thêm tham số để debug
    exit;
}

$product = getById($id);
if (!$product) {
    $_SESSION['error'] = "Sản phẩm không tồn tại.";
    header("Location: ?controller=product&action=index&redirected=1");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="../public/img/<?php echo htmlspecialchars($product['img']); ?>" class="img-fluid" alt="<?php echo htmlspecialchars($product['name']); ?>">
            </div>
            <div class="col-md-6">
                <?php
                if (isset($_SESSION['error'])) {
                    echo "<p style='color: red;'>" . htmlspecialchars($_SESSION['error']) . "</p>";
                    unset($_SESSION['error']);
                }
                ?>
                <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                <p><?php echo htmlspecialchars($product['description']); ?></p>
                <p>Đơn giá: <span id="unit-price"><?php echo number_format($product['price']); ?></span> VND</p>
                <p>Còn lại: <?php echo $product['quantity']; ?> sản phẩm</p>

                <form method="POST" action="?controller=order&action=buy" id="buy-form">
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
                    <button type="submit" name="buy" class="btn btn-primary">Mua ngay</button>
                    <a href="?controller=product&action=index" class="btn btn-secondary">Quay lại</a>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal xác nhận -->
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Xác nhận đơn hàng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Sản phẩm:</strong> <span id="modal-product-name"><?php echo htmlspecialchars($product['name']); ?></span></p>
                    <p><strong>Số lượng:</strong> <span id="modal-quantity"></span></p>
                    <p><strong>Tổng tiền:</strong> <span id="modal-total-price"></span> VND</p>
                    <p>Bạn có chắc chắn muốn đặt hàng?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-primary" id="confirmBuy">Xác nhận</button>
                </div>
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

        $(document).ready(function() {
            $('#buy-form').on('submit', function(e) {
                e.preventDefault();

                let quantity = $('#quantity').val();
                let totalPrice = $('#total-price').text().replace(/[^0-9.-]+/g, "");

                $('#modal-quantity').text(quantity);
                $('#modal-total-price').text(totalPrice);

                $('#confirmModal').modal('show');

                $('#confirmBuy').off('click').on('click', function() {
                    $('#confirmModal').modal('hide');
                    $('#buy-form').off('submit').submit();
                });
            });
        });
    </script>
</body>

</html>