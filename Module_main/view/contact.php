<!-- <?php
      require_once '../config/functions.php'; // Nạp hàm toàn cục


      $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
      if ($id === false || $id === null) {
        header("Location: ?controller=product&action=index");
        exit;
      }

      $product = getById($id); // Gọi hàm toàn cục
      if (!$product) {
        echo "<p>Sản phẩm không tồn tại.</p>";
        exit;
      }
      ?> -->


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



  <!-- slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="../view/css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Baloo+Chettan|Dosis:400,600,700|Poppins:400,600,700&display=swap" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="../view/css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="../view/css/responsive.css" rel="stylesheet" />
</head>

<body>




  <!-- end header section -->
  <!-- slider section -->


  <!-- nav section -->

  <section class="nav_section" style="width:100%; margin-top:10px;">
    <div class="container">
      <div class="custom_nav2">
        <nav class="navbar navbar-expand custom_nav-container ">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="d-flex  flex-column flex-lg-row align-items-center">
              <ul class="navbar-nav  ">
                <li class="nav-item active">
                  <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="about.html">About </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="fruit.html">Our Fruit </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="testimonial.html">Testimonial</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="contact.html">Contact Us</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="?controller=auth&action=logout">Login</a>
                </li>
              </ul>
              <form class="form-inline my-2 my-lg-0 ml-0 ml-lg-4 mb-3 mb-lg-0">
                <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit"></button>
              </form>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </section>

  <!-- end nav section -->

  <!-- shop section -->
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <img src="img/<?php echo htmlspecialchars($product['img']); ?>" class="img-fluid" alt="<?php echo htmlspecialchars($product['name']); ?>">
      </div>
      <div class="col-md-6">
        <?php
        // Hiển thị thông báo lỗi nếu có
        if (isset($_SESSION['error'])) {
          echo "<p style='color: red;'>" . htmlspecialchars($_SESSION['error']) . "</p>";
          unset($_SESSION['error']);
        }
        ?>
        <h2><?php echo htmlspecialchars($product['name']); ?></h2>
        <p><?php echo htmlspecialchars($product['description']); ?></p>
        <p>Đơn giá: <span id="unit-price"><?php echo number_format($product['price']); ?></span> VND</p>
        <p>Còn lại: <?php echo $product['quantity']; ?> sản phẩm</p>

        <form method="POST" action="?controller=order&action=buy">
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
          <a href="?" class="btn btn-secondary">Quay lại</a>
        </form>
      </div>
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
              <h2>
                About Our Fruit Shop
              </h2>
            </div>
            <p>
              There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour
            </p>
            <a href="">
              Read More
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end about section -->

  <!-- fruit section -->

  <section class="fruit_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <hr>
        <h2>
          Fresh Fruit
        </h2>
      </div>
    </div>
    <div class="container-fluid">

      <div class="fruit_container">
        <div class="fruit_container">


        </div>
        <div class="box">
          <img src="../view/images/f-6.jpg" alt="">
          <div class="link_box">
            <h5>
              Strawberry
            </h5>
            <a href="">
              Buy Now
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end fruit section -->


  <!-- client section -->

  <section class="client_section layout_padding-bottom">
    <div class="container ">
      <div class="heading_container">
        <h2>
          What Syas Cutomer
        </h2>
        <hr>
      </div>
      <div id="carouselExample2Controls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="client_container layout_padding-top">
              <div class="img-box">
                <img src="../view/images/client-img.png" alt="">
              </div>
              <div class="detail-box">
                <h5>
                  Jone Mark
                </h5>
                <p>
                  <img src="../view/images/left-quote.png" alt="">
                  <span>
                    Lorem ipsum dolor sit amet,
                  </span>
                  <img src="../view/images/right-quote.png" alt=""> <br>
                  consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                  veniam, quis nostrud exercitation ullamco laboris ut aliquip ex ea commodo
                  consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                </p>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="client_container layout_padding-top">
              <div class="img-box">
                <img src="../view/images/client-img.png" alt="">
              </div>
              <div class="detail-box">
                <h5>
                  Jone Mark
                </h5>
                <p>
                  <img src="../view/images/left-quote.png" alt="">
                  <span>
                    Lorem ipsum dolor sit amet,
                  </span>
                  <img src="../view/images/right-quote.png" alt=""> <br>
                  consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                  veniam, quis nostrud exercitation ullamco laboris ut aliquip ex ea commodo
                  consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                </p>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="client_container layout_padding-top">
              <div class="img-box">
                <img src="../view/images/client-img.png" alt="">
              </div>
              <div class="detail-box">
                <h5>
                  Jone Mark
                </h5>
                <p>
                  <img src="../view/images/left-quote.png" alt="">
                  <span>
                    Lorem ipsum dolor sit amet,
                  </span>
                  <img src="../view/images/right-quote.png" alt=""> <br>
                  consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                  veniam, quis nostrud exercitation ullamco laboris ut aliquip ex ea commodo
                  consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                </p>
              </div>
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExample2Controls" role="button" data-slide="prev">
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExample2Controls" role="button" data-slide="next">
          <span class="sr-only">Next</span>
        </a>
      </div>

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
            <h2>
              Request A call back
            </h2>
          </div>
        </div>
      </div>

      <div class="layout_padding2-top">
        <div class="row">
          <div class="col-lg-4 offset-lg-2 col-md-5 offset-md-1">
            <form action="">
              <div class="contact_form-container">
                <div>
                  <div>
                    <input type="text" placeholder="Full Name" />
                  </div>
                  <div>
                    <input type="email" placeholder="Email" />
                  </div>
                  <div>
                    <input type="text" placeholder="Phone Number" />
                  </div>
                  <div>
                    <input type="text" class="message_input" placeholder="Message" />
                  </div>
                  <div>
                    <button type="submit">
                      Send
                    </button>
                  </div>
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
     
      </div>
      <div class="info_contact">
        <div class="row">
          <div class="col-md-4">
            <a href="">
              <img src="../view/images/location.png" alt="">
              <span>
                Passages of Lorem Ipsum available
              </span>
            </a>
          </div>
          <div class="col-md-4">
            <a href="">
              <img src="../view/images/call.png" alt="">
              <span>
                Call : +012334567890
              </span>
            </a>
          </div>
          <div class="col-md-4">
            <a href="">
              <img src="../view/images/mail.png" alt="">
              <span>
                demo@gmail.com
              </span>
            </a>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-8 col-lg-9">
          <div class="info_form">
            <form action="">
              <input type="text" placeholder="Enter your email">
              <button>
                subscribe
              </button>
            </form>
          </div>
        </div>
        <div class="col-md-4 col-lg-3">
          <div class="info_social">
            <div>
              <a href="">
                <img src="../view/images/facebook-logo-button.png" alt="">
              </a>
            </div>
            <div>
              <a href="">
                <img src="../view/images/twitter-logo-button.png" alt="">
              </a>
            </div>
            <div>
              <a href="">
                <img src="../view/images/linkedin.png" alt="">
              </a>
            </div>
            <div>
              <a href="">
                <img src="../view/images/instagram.png" alt="">
              </a>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- end info section -->


  <!-- footer section -->
  <section class="container-fluid footer_section ">
    <p>
      &copy; <span id="displayYear"></span> All Rights Reserved. Design by
      <a href="https://html.design/">Free Html Templates</a>
    </p>
  </section>
  <!-- footer section -->
  <div class="modal fade" id="quantityModal" tabindex="-1" aria-labelledby="quantityModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="quantityModalLabel">Select Quantity</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="?controller=order&action=buy" method="POST">
          <div class="modal-body">
            <input type="hidden" name="product_id" id="product_id">
            <div class="mb-3">
              <label for="quantity" class="form-label">Quantity</label>
              <input type="number" class="form-control" id="quantity" name="quantity" min="1" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Total Price</label>
              <p id="total_price" class="form-text">$0</p>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Confirm Purchase</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="js/custom.js"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script>
  <script src="js/script.js"></script>
  <script>
    function calculateTotal() {
      const quantity = document.getElementById('quantity').value;
      const unitPrice = <?php echo $product['price']; ?>;
      const totalPrice = quantity * unitPrice;
      document.getElementById('total-price').innerText = totalPrice.toLocaleString('vi-VN');
    }
  </script>
</body>

</html>