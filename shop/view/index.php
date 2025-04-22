<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Shop</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../view/css/style.css"> <!-- Trỏ đến css trong public/ -->

  <title>Ninom</title>

  <!-- slider stylesheet0 -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="../view/css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Baloo+Chettan|Dosis:400,600,700|Poppins:400,600,700&display=swap" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="../view/css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="../view/css/responsive.css" rel="stylesheet" />
     <style>
        .order-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .order-table th,
        .order-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .order-table th {
            background-color: #f2f2f2;
        }

        .product-image {
            max-width: 100px;
            height: auto;
        }
        
    </style>
</head>

<body>

  <div class="brand_box">
    <a class="navbar-brand" href="index.html">
      <span>
        Ninom
      </span>
    </a>
  </div>
  <!-- end header section -->
  <!-- slider section -->
  <section class=" slider_section position-relative">
    <div id="carouselExampleControls" class="carousel slide " data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="img-box">
            <img src="../view/images/slider-img.jpg" alt="">
          </div>
        </div>
        <div class="carousel-item">
          <div class="img-box">
            <img src="../view/images/slider-img.jpg" alt="">
          </div>
        </div>
        <div class="carousel-item">
          <div class="img-box">
            <img src="../view/images/slider-img.jpg" alt="">
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="sr-only">Next</span>
      </a>
    </div>
  </section>
  <!-- end slider section -->
  </div>

  <!-- nav section -->

  <section class="nav_section">
    <div class="container">
      <div class="custom_nav2">
        <nav class="navbar navbar-expand custom_nav-container ">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <div class="d-flex flex-column flex-lg-row align-items-center">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="about.html">About</a>
            </li>
            <li class="nav-item">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a class="nav-link" href="?controller=order&action=myOrders">Xem đơn hàng của tôi</a>
                <?php endif; ?>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="testimonial.html">Testimonial</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contact.html">Contact Us</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?controller=auth&action=logout">Logout</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0 ml-0 ml-lg-4 mb-3 mb-lg-0">
            <button class="btn my-2 my-sm-0 nav_search-btn" type="submit"></button>
        </form>
    </div>
</div>
        </nav>
      </div>
    </div>
  </section>

  <!-- end nav section -->

  <!-- shop section -->
  <div class="container-fluid">
    <div class="fruit_container">
      <main class="container mt-5">
        <h1>Top 3 sản phẩm mới nhất</h1>
        <div class="row">
          <?php foreach ($latestProducts as $product): ?>
            <div class="col-md-4 mb-4">
              <div class="card">
                <img src="../public/img/<?php echo htmlspecialchars($product['img']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['name']); ?>">
                <div class="card-body">
                  <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                  <p class="card-text"><?php echo htmlspecialchars($product['description']); ?></p>
                  <p class="card-text"><?php echo number_format($product['price']); ?> VND</p>
                  <p class="card-text">Ngày: <?-byphpecho $product['created_at'] ?? 'N/A'; ?></p>
                  <form method="POST" action="?controller=order&action=buy">
                    <input type="hidden" name="product_id" value="<?php echo $product['ID']; ?>">
                    <input type="number" name="quantity" value="1" min="1" max="<?php echo $product['quantity']; ?>" class="form-control mb-2">
                    <button type="submit" name="buy" class="btn btn-primary">Buy Now</button>
                  </form>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </main>
    </div>
  </div>
  <!-- end shop section -->

  <!-- about section -->
  <section class="about_section">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6 px-0">
          <div class="img-box">
            <img src="../view/images/about-img.jpg" alt="">
          </div>
        </div>
        <div class="col-md-5">
          <div class="detail-box">
            <div class="heading_container">
              <hr>
              <h2>About Our Fruit Shop</h2>
            </div>
            <p>
              There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour
            </p>
            <a href="">Read More</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end about section -->
<div style="display:flex;justify-content: center;flex-direction: column;width: 100%">
<div style="margin-top: 10px;margin-left: 325px; display:flex;justify-content: center;width: 60%;" class="input-group mb-4 mt-20">
    <input type="text" id="searchInput" class="form-control" placeholder="Tìm kiếm theo tên sản phẩm" value="<?php echo htmlspecialchars($keyword ?? ''); ?>">
    <div class="input-group-append">
      <button id="searchButton" class="btn btn-primary">Tìm</button>
    </div>
  </div> 

 <section class="shop_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>Sản phẩm của chúng tôi</h2>
        </div>
        <div class="row" id="productList">
            <?php foreach ($allProducts as $product): ?>
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="box">
                        <a href="">
                            <div class="img-box">
                                <img src="../public/img/<?php echo htmlspecialchars($product['img']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                            </div>
                            <div class="detail-box">
                                <h6><?php echo htmlspecialchars($product['name']); ?></h6>
                                <h6>
                                    Price
                                    <span><?php echo number_format($product['price']); ?> VND</span>
                                </h6>
                                <p><?php echo htmlspecialchars($product['description']); ?></p>
                                <p>Ngày: <?php echo $product['created_at'] ?? 'N/A'; ?></p>
                            </div>
                            <div class="new">
                                <span>New</span>
                            </div>
                        </a>
                        <form class="buy-form" method="POST" action="?controller=order&action=buy">
                            <input type="hidden" name="product_id" value="<?php echo $product['ID']; ?>">
                            <input type="hidden" name="quantity" value="1" class="quantity-input">
                            <button type="button" class="btn btn-primary buy-btn">Buy Now</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <nav aria-label="Page navigation" id="pagination">
            <ul class="pagination justify-content-center">
                <?php if ($currentPage > 1): ?>
                    <li class="page-item"><a class="page-link" href="#" data-page="<?php echo $currentPage - 1; ?>">Previous</a></li>
                <?php else: ?>
                    <li class="page-item disabled"><span class="page-link">Previous</span></li>
                <?php endif; ?>
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?php echo $i === $currentPage ? 'active' : ''; ?>">
                        <a class="page-link" href="#" data-page="<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
                <?php if ($currentPage < $totalPages): ?>
                    <li class="page-item"><a class="page-link" href="#" data-page="<?php echo $currentPage + 1; ?>">Next</a></li>
                <?php else: ?>
                    <li class="page-item disabled"><span class="page-link">Next</span></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</section>
  
  <!-- end client section -->

  <!-- contact section -->
  <section class="contact_section layout_padding-bottom">
    <div class="container-fluid">
      <div class="row">
        <div class="offset-lg-2 col-md-10 offset-md-1">
          <div class="heading_container">
            <hr>
            <h2>Request A Call Back</h2>
          </div>
        </div>
      </div>
      <div class="layout_padding2-top">
        <div class="row">
          <div class="col-lg-4 offset-lg-2 col-md-5 offset-md-1">
            <form action="">
              <div class="contact_form-container">
                <div>
                  <div><input type="text" placeholder="Full Name" /></div>
                  <div><input type="email" placeholder="Email" /></div>
                  <div><input type="text" placeholder="Phone Number" /></div>
                  <div><input type="text" class="message_input" placeholder="Message" /></div>
                  <div><button type="submit">Send</button></div>
                </div>
              </div>
            </form>
          </div>
          <div class="col-md-6 px-0">
            <div class="map_container">
              <div class="map-responsive">
                <iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA0s1a7phLN0iaD6-UE7m4qP-z21pH0eSc&q=Eiffel+Tower+Paris+France" width="600" height="300" frameborder="0" style="border:0; width: 100%; height:100%" allowfullscreen></iframe>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end contact section -->

  <!-- info section -->
  <section class="info_section layout_padding">
    <div class="container">
      <div class="info_logo">
        <h2>NiNom</h2>
      </div>
      <div class="info_contact">
        <div class="row">
          <div class="col-md-4">
            <a href="">
              <img src="../view/images/location.png" alt="">
              <span>Passages of Lorem Ipsum available</span>
            </a>
          </div>
          <div class="col-md-4">
            <a href="">
              <img src="../view/images/call.png" alt="">
              <span>Call : +012334567890</span>
            </a>
          </div>
          <div class="col-md-4">
            <a href="">
              <img src="../view/images/mail.png" alt="">
              <span>demo@gmail.com</span>
            </a>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-8 col-lg-9">
          <div class="info_form">
            <form action="">
              <input type="text" placeholder="Enter your email">
              <button>subscribe</button>
            </form>
          </div>
        </div>
        <div class="col-md-4 col-lg-3">
          <div class="info_social">
            <div><a href=""><img src="../view/images/facebook-logo-button.png" alt=""></a></div>
            <div><a href=""><img src="../view/images/twitter-logo-button.png" alt=""></a></div>
            <div><a href=""><img src="../view/images/linkedin.png" alt=""></a></div>
            <div><a href=""><img src="../view/images/instagram.png" alt=""></a></div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end info section -->
<!-- Modal xác nhận -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmModalLabel">Xác nhận mua hàng</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Sản phẩm: <span id="modal-product-name"></span></p>
        <div class="form-group">
          <label for="modal-quantity">Số lượng:</label>
          <input type="number" id="modal-quantity" class="form-control" min="1" value="1">
        </div>
        <p>Tổng tiền: <span id="modal-total-price"></span> VND</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
        <button type="button" class="btn btn-primary" id="confirmBuy">Xác nhận</button>
      </div>
    </div>
  </div>
</div>
  <?php if ($_SESSION['role'] === 'admin'): ?>
    <a href="?controller=order&action=admin" class="btn btn-secondary">Quản lý</a>
  <?php endif; ?>

  <!-- footer section -->
  <section class="container-fluid footer_section">
    <p>
      © <span id="displayYear"></span> All Rights Reserved. Design by
      <a href="https://html.design/">Free Html Templates</a>
    </p>
  </section>
  <!-- footer section -->

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script>
 <script>
document.addEventListener('DOMContentLoaded', function () {
    const searchButton = document.getElementById('searchButton');
    const searchInput = document.getElementById('searchInput');
    const productList = document.getElementById('productList');
    const pagination = document.getElementById('pagination');

    // Hàm tải danh sách sản phẩm
    function loadProducts(keyword = '', page = 1) {
        fetch(`?controller=product&action=searchAjax&search=${encodeURIComponent(keyword)}&page=${page}`, {
            method: 'GET',
            headers: {
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
                return;
            }

            // Cập nhật danh sách sản phẩm
            productList.innerHTML = '';
            data.products.forEach(product => {
                productList.innerHTML += `
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="../public/img/${product.img}" class="card-img-top" alt="${product.name}">
                            <div class="card-body">
                                <h5 class="card-title">${product.name}</h5>
                                <p class="card-text">${product.description}</p>
                                <p class="card-text">${Number(product.price).toLocaleString()} VND</p>
                                <p class="card-text">Ngày: ${product.created_at || 'N/A'}</p>
                                <form class="buy-form" method="POST" action="?controller=order&action=buy">
                                    <input type="hidden" name="product_id" value="${product.ID}">
                                    <input type="hidden" name="quantity" value="1" class="quantity-input">
                                    <button type="button" class="btn btn-primary buy-btn">Buy Now</button>
                                </form>
                            </div>
                        </div>
                    </div>
                `;
            });

            // Cập nhật phân trang
            pagination.innerHTML = '';
            let paginationHTML = '<ul class="pagination justify-content-center">';
            if (data.currentPage > 1) {
                paginationHTML += `<li class="page-item"><a class="page-link" href="#" data-page="${data.currentPage - 1}">Previous</a></li>`;
            } else {
                paginationHTML += `<li class="page-item disabled"><span class="page-link">Previous</span></li>`;
            }

            for (let i = 1; i <= data.totalPages; i++) {
                paginationHTML += `
                    <li class="page-item ${i === data.currentPage ? 'active' : ''}">
                        <a class="page-link" href="#" data-page="${i}">${i}</a>
                    </li>
                `;
            }

            if (data.currentPage < data.totalPages) {
                paginationHTML += `<li class="page-item"><a class="page-link" href="#" data-page="${data.currentPage + 1}">Next</a></li>`;
            } else {
                paginationHTML += `<li class="page-item disabled"><span class="page-link">Next</span></li>`;
            }
            paginationHTML += '</ul>';
            pagination.innerHTML = paginationHTML;

            // Gắn lại sự kiện cho các liên kết phân trang
            attachPaginationEvents();
        })
        .catch(error => console.error('Error:', error));
    }

    // Sự kiện nút tìm kiếm
    searchButton.addEventListener('click', function () {
        const keyword = searchInput.value.trim();
        loadProducts(keyword, 1); // Tải trang 1 với từ khóa
    });

    // Sự kiện nhấn Enter trong input
    searchInput.addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            const keyword = searchInput.value.trim();
            loadProducts(keyword, 1);
        }
    });

    // Gắn sự kiện cho phân trang
    function attachPaginationEvents() {
        const pageLinks = document.querySelectorAll('.page-link');
        pageLinks.forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                const page = this.getAttribute('data-page');
                if (page) {
                    const keyword = searchInput.value.trim();
                    loadProducts(keyword, page);
                }
            });
        });
    }

    // Tải sản phẩm ban đầu
    loadProducts();
});
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>