<?php require_once '../view/header.php'; ?>

<div class="container">
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?php echo $_SESSION['error'];
            unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <h2>Chi tiết sản phẩm</h2>
    <div class="row">
        <div class="col-md-6">
            <img src="../public/img/<?php echo htmlspecialchars($product['img']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="img-fluid">
        </div>
        <div class="col-md-6">
            <h3><?php echo htmlspecialchars($product['name']); ?></h3>
            <p><strong>Giá:</strong> <?php echo number_format($product['price']); ?> VND</p>
            <p><strong>Tồn kho:</strong> <?php echo $product['quantity']; ?> sản phẩm</p>
            <p><strong>Mô tả:</strong> <?php echo htmlspecialchars($product['description']); ?></p>

            <!-- Form chọn số lượng và mua -->
            <form method="POST" action="?controller=order&action=buy">
                <input type="hidden" name="product_id" value="<?php echo $product['ID']; ?>">
                <div class="form-group">
                    <label for="quantity">Số lượng:</label>
                    <input type="number" name="quantity" id="quantity" class="form-control" min="1" max="<?php echo $product['quantity']; ?>" value="1" required>
                </div>
                <button type="submit" name="buy" class="btn btn-primary mt-3">Mua</button>
            </form>
        </div>
    </div>
</div>

<?php require_once '../view/footer.php'; ?>