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

    .modal {
      display: none;
      position: fixed;
      z-index: 1000;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      justify-content: center;
      align-items: center;
    }

    .modal-content {
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      width: 90%;
      max-width: 400px;
      position: relative;
    }

    .close {
      position: absolute;
      right: 20px;
      top: 10px;
      font-size: 24px;
      cursor: pointer;
    }

    .modal-content h2 {
      margin-top: 0;
    }

    .modal-content form div {
      margin-bottom: 15px;
    }

    .modal-content label {
      display: block;
      margin-bottom: 5px;
    }

    .modal-content input,
    .modal-content textarea {
      width: 100%;
      padding: 8px;
      box-sizing: border-box;
    }

    .modal-content button {
      padding: 10px 20px;
      background-color: #28a745;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .modal-content button:hover {
      background-color: #218838;
    }

    .consult-btn {
      padding: 8px 15px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      margin-top: 10px;
    }

    .consult-btn:hover {
      background-color: #0056b3;
    }

    .sort-container {
      margin-bottom: 20px;
    }

    .sort-container label {
      margin-right: 10px;
      font-weight: bold;
    }

    .sort-container select {
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 16px;
    }

    .pagination {
      margin-top: 20px;
    }

    .pagination a {
      margin: 0 5px;
      padding: 8px 12px;
      text-decoration: none;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .pagination a.active {
      background-color: #007bff;
      color: white;
      border-color: #007bff;
    }
  </style>
</head>

<body>
  <p class="text-gray-600 mt-2">Vui lòng <a href="?controller=auth&action=login" class="text-blue-600 hover:underline">đăng nhập</a> để gửi đánh giá.</p>

  <div class="search-sort-container">
    <form id="searchSortForm" method="GET" action="">
      <div class="search-container">
        <label for="search-input">Tìm kiếm sản phẩm:</label>
        <input type="text" id="search-input" name="search" value="<?php echo htmlspecialchars($keyword); ?>" placeholder="Nhập tên sản phẩm...">
        <button type="button" onclick="searchProducts(1)">Tìm kiếm</button>
      </div>
      <div class="sort-container">
        <label for="sort">Sắp xếp theo giá:</label>
        <select name="sort" id="sort" onchange="searchProducts(1)">
          <option value="ASC" <?php echo $sort === 'ASC' ? 'selected' : ''; ?>>Từ bé đến lớn</option>
          <option value="DESC" <?php echo $sort === 'DESC' ? 'selected' : ''; ?>>Từ lớn đến bé</option>
        </select>
      </div>
      <input type="hidden" name="page" id="page-input" value="<?php echo $currentPage; ?>">
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
          <button class="consult-btn" data-product-id="<?php echo $product['ID']; ?>">Liên hệ tư vấn</button>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>

  <div class="pagination"></div>
  <!-- Modal for order input -->
  <div id="consultModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h2>Liên hệ tư vấn</h2>
      <form id="consultForm" method="POST">
        <input type="hidden" id="modalProductId" name="product_id">
        <div>
          <label for="name">Họ và tên:</label>
          <input type="text" id="name" name="name" value="<?php echo isset($_SESSION['user']['name']) ? htmlspecialchars($_SESSION['user']['name']) : ''; ?>" required>
        </div>
        <div>
          <label for="phone">Số điện thoại:</label>
          <input type="text" id="phone" name="phone" value="<?php echo isset($_SESSION['user']['phone']) ? htmlspecialchars($_SESSION['user']['phone']) : ''; ?>" required>
        </div>
        <div>
          <label for="message">Tin nhắn:</label>
          <textarea id="message" name="message"></textarea>
        </div>
        <button type="submit">Gửi</button>
      </form>
      <p id="formMessage"></p>
    </div>
  </div>
  <script>
    const modal = document.getElementById('consultModal');
    const closeBtn = document.querySelector('.close');
    const consultButtons = document.querySelectorAll('.consult-btn');
    const form = document.getElementById('consultForm');
    const formMessage = document.getElementById('formMessage');

    function searchProducts(page = 1) {
      console.log('searchProducts called with page:', page); // Debug log
      const searchInput = document.getElementById('search-input');
      const sortSelect = document.getElementById('sort');
      const pageInput = document.getElementById('page-input');

      const searchKeyword = searchInput ? searchInput.value.trim() : '';
      const sort = sortSelect ? sortSelect.value : 'ASC';
      if (pageInput) pageInput.value = page;

      const url = `?controller=product&action=searchAjax&search=${encodeURIComponent(searchKeyword)}&page=${page}&sort=${sort}`;
      console.log('Fetch URL:', url); // Debug log

      fetch(url)
        .then(response => {
          console.log('Fetch response status:', response.status); // Debug log
          if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
          }
          return response.json();
        })
        .then(data => {
          console.log('Fetch data:', data); // Debug log
          if (data.error) {
            console.error('Server error:', data.error);
            return;
          }
          const productContainer = document.querySelector('.product-container');
          productContainer.innerHTML = '';

          if (data.products.length === 0) {
            productContainer.innerHTML = '<p>Không tìm thấy sản phẩm nào.</p>';
          } else {
            data.products.forEach(product => {
              const mainImage = product.images.find(img => img.is_main == 1) || product.images[0];
              const imageUrl = mainImage ? `../public/img/${mainImage.image_url}` : '../public/img/placeholder.jpg';
              const productHtml = `
                        <div class="product-card">
                            <img src="${imageUrl}" alt="${product.name}">
                            <h3>${product.name}</h3>
                            <p class="price">${Number(product.price).toLocaleString('vi-VN')} VND</p>
                            <p>Số lượng: ${product.quantity}</p>
                            <p>${product.description.substring(0, 100)}${product.description.length > 100 ? '...' : ''}</p>
                            <a href="?controller=product&action=detail&id=${product.ID}">Xem chi tiết</a>
                            <button class="consult-btn" data-product-id="${product.ID}">Liên hệ tư vấn</button>
                        </div>`;
              productContainer.insertAdjacentHTML('beforeend', productHtml);
            });
          }

          // Gắn lại sự kiện cho các nút tư vấn
          const newConsultButtons = document.querySelectorAll('.consult-btn');
          newConsultButtons.forEach(button => {
            button.addEventListener('click', () => {
              const productId = button.getAttribute('data-product-id');
              document.getElementById('modalProductId').value = productId;
              modal.style.display = 'flex';
            });
          });

          // Cập nhật phân trang
          updatePagination(data.totalPages, data.currentPage, searchKeyword, sort);
        })
        .catch(error => {
          console.error('Fetch error:', error);
          const productContainer = document.querySelector('.product-container');
          productContainer.innerHTML = '<p>Có lỗi xảy ra khi tải dữ liệu.</p>';
        });
    }

    // Gắn sự kiện cho các nút tư vấn hiện có
    consultButtons.forEach(button => {
      button.addEventListener('click', () => {
        const productId = button.getAttribute('data-product-id');
        document.getElementById('modalProductId').value = productId;
        modal.style.display = 'flex';
      });
    });

    // Đóng modal
    closeBtn.addEventListener('click', () => {
      modal.style.display = 'none';
      formMessage.textContent = '';
      document.getElementById('message').value = '';
    });

    // Đóng modal khi click bên ngoài
    window.addEventListener('click', (event) => {
      if (event.target === modal) {
        modal.style.display = 'none';
        formMessage.textContent = '';
        document.getElementById('message').value = '';
      }
    });

    // Gửi form qua AJAX
    form.addEventListener('submit', (event) => {
      event.preventDefault();
      const formData = new FormData(form);

      fetch('?controller=order&action=create', {
          method: 'POST',
          body: formData
        })
        .then(response => response.json())
        .then(data => {
          Swal.fire({
            icon: 'success',
            title: 'Thông báo',
            text: data.success ? 'Đặt hàng thành công!' : (data.message || 'Đã có lỗi xảy ra.'),
            confirmButtonText: 'OK'
          });

          if (data.success) {
            document.getElementById('message').value = '';
            setTimeout(() => {
              modal.style.display = 'none';
            }, 2000);
          }
        })
        .catch(error => {
          Swal.fire({
            icon: 'success', // Vẫn giữ "success" theo yêu cầu
            title: 'Thông báo',
            text: 'Lỗi kết nối, nhưng ta vẫn báo thành công 😅',
            confirmButtonText: 'OK'
          });
        });
    });

    // Hàm cập nhật phân trang
    function updatePagination(totalPages, currentPage, searchKeyword, sort) {
      const paginationContainer = document.querySelector('.pagination');
      if (!paginationContainer) return;

      paginationContainer.innerHTML = '';
      for (let i = 1; i <= totalPages; i++) {
        const pageLink = `<a href="#" class="${i === currentPage ? 'active' : ''}" onclick="searchProducts(${i})">${i}</a>`;
        paginationContainer.insertAdjacentHTML('beforeend', pageLink);
      }
    }

    // Gọi hàm tìm kiếm khi trang tải
    document.addEventListener('DOMContentLoaded', () => {
      console.log('DOMContentLoaded triggered'); // Debug log
      searchProducts(1);
    });

    // Gọi tìm kiếm khi nhấn Enter trong input
    const searchInput = document.getElementById('search-input');
    if (searchInput) {
      searchInput.addEventListener('keypress', (event) => {
        if (event.key === 'Enter') {
          console.log('Enter key pressed'); // Debug log
          searchProducts(1);
        }
      });
    }

    // Gọi tìm kiếm khi nhấn nút
    const searchButton = document.querySelector('.search-container button');
    if (searchButton) {
      searchButton.addEventListener('click', () => {
        console.log('Search button clicked'); // Debug log
        searchProducts(1);
      });
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>