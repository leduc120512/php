<?php
if (!isset($products) || !isset($totalPages) || !isset($currentPage)) {
  header("Location: ?controller=product&action=index");
  exit;
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Danh Sách Sản Phẩm</title>
  <style>
    .product-container {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      justify-content: center;
    }

    .product-card {
      border: 1px solid #ddd;
      padding: 15px;
      width: 200px;
      text-align: center;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .product-card img {
      max-width: 100%;
      height: auto;
      border-radius: 5px;
    }

    .product-card h3 {
      font-size: 1.2em;
      margin: 10px 0;
    }

    .product-card p {
      color: #555;
    }

    .product-card .price {
      color: #e44d26;
      font-weight: bold;
    }

    .search-bar {
      margin: 20px 0;
      text-align: center;
    }

    .pagination {
      text-align: center;
      margin: 20px 0;
    }

    .pagination a {
      margin: 0 5px;
      text-decoration: none;
      padding: 5px 10px;
      border: 1px solid #ddd;
      border-radius: 5px;
    }

    .pagination a.active {
      background-color: #007bff;
      color: white;
    }
  </style>
</head>

<body>
  <div class="search-bar">
    <form method="GET" action="?controller=product&action=index">
      <input type="hidden" name="controller" value="product">
      <input type="hidden" name="action" value="index">
      <input type="text" name="search" placeholder="Tìm kiếm sản phẩm..." value="<?php echo isset($keyword) ? htmlspecialchars($keyword) : ''; ?>">
      <button type="submit">Tìm kiếm</button>
    </form>
  </div>

  <div class="product-container">
    <?php if (empty($products)): ?>
      <p>Không tìm thấy sản phẩm nào.</p>
    <?php else: ?>
      <?php foreach ($products as $product): ?>
        <div class="product-card">
          <?php
          $main_image = array_filter($product['images'], function ($img) {
            return $img['is_main'] == 1;
          });
          $main_image = reset($main_image) ?: reset($product['images']);
          ?>
          <?php if (!empty($main_image)): ?>
            <img src="../public/img/<?php echo htmlspecialchars($main_image['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
          <?php else: ?>
            <img src="../public/img/placeholder.jpg" alt="No Image">
          <?php endif; ?>
          <h3><?php echo htmlspecialchars($product['name']); ?></h3>
          <p class="price"><?php echo number_format($product['price'], 0, ',', '.') . ' VND'; ?></p>
          <p>Số lượng: <?php echo htmlspecialchars($product['quantity']); ?></p>
          <p><?php echo htmlspecialchars(substr($product['description'], 0, 100)) . (strlen($product['description']) > 100 ? '...' : ''); ?></p>
          <a href="?controller=product&action=detail&id=<?php echo $product['ID']; ?>">Xem chi tiết</a>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>

  <div class="pagination">
    <?php if ($totalPages > 1): ?>
      <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="?controller=product&action=index&page=<?php echo $i; ?><?php echo !empty($keyword) ? '&search=' . urlencode($keyword) : ''; ?>" class="<?php echo $i === $currentPage ? 'active' : ''; ?>">
          <?php echo $i; ?>
        </a>
      <?php endfor; ?>
    <?php endif; ?>
  </div>
</body>

</html>