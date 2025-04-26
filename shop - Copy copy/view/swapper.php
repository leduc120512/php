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
                        <div class="d-flex  flex-column flex-lg-row align-items-center">
                            <ul class="navbar-nav  ">
                                <li class="nav-item active">
                                    <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="about.html">About </a>
                                </li>
                                <li class="nav-item">
                                    <!-- Trong file header hoặc navigation -->
                                    <?php if (isset($_SESSION['user_id'])): ?>
                                        <a href="?controller=order&action=myOrders">Xem đơn hàng của tôi</a>
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

    <!-- fruit section -->
    <div style="display:flex;justify-content: center;flex-direction: column;width: 100%%">
        <div style="display:flex;justify-content: center;width: 60%;" class="input-group mb-4 mt-20">
            <input type="text" id="searchInput" class="form-control" placeholder="Tìm kiếm theo tên sản phẩm" value="<?php echo htmlspecialchars($keyword ?? ''); ?>">
            <div class="input-group-append">
                <button id="searchButton" class="btn btn-primary">Tìm</button>
            </div>
        </div>

        <!-- end fruit section -->

        <!-- client section -->
        <section class="client_section layout_padding-bottom">
            <div class="container ">
                <div class="heading_container">
                    <h2>What Says Customer</h2>
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
                                    <h5>Jone Mark</h5>
                                    <p>
                                        <img src="../view/images/left-quote.png" alt="">
                                        <span>Lorem ipsum dolor sit amet,</span>
                                        <img src="../view/images/right-quote.png" alt=""> <br>
                                        consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua...
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- Các carousel-item khác giữ nguyên -->
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
    </div>


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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>