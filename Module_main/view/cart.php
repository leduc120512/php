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
    <link rel="stylesheet" href="../view/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="../view/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="../view/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="../view/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="../view/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="../view/css/style.css" type="text/css">
</head>
<style>
    /* Tổng thể container */
    .container {
        background: linear-gradient(to right, #f9f9f9, #e0f7fa);
        padding: 40px 30px;
        border-radius: 20px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    /* Tiêu đề */
    .container h2 {
        font-size: 2.5rem;
        color: #0d6efd;
        margin-bottom: 30px;
        font-weight: bold;
        animation: slideInTop 1s ease;
    }

    /* Alert */
    .alert {
        border-radius: 12px;
        font-size: 1.1rem;
        font-weight: 500;
        animation: fadeIn 0.8s ease-in-out;
    }

    /* Bảng */
    .table {
        background-color: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    }

    .table thead {
        background: #0d6efd;
        color: white;
    }

    .table th,
    .table td {
        vertical-align: middle;
        text-align: center;
        font-size: 1rem;
        padding: 15px;
    }

    .table th {
        font-weight: bold;
    }

    /* Dòng bảng hover */
    .table tbody tr:hover {
        background-color: #f1f8ff;
    }

    /* Checkbox */
    #select-all,
    .product-checkbox {
        width: 20px;
        height: 20px;
    }

    /* Nút Xóa */
    .btn-danger {
        background-color: #ff4d4f;
        border: none;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .btn-danger:hover {
        background-color: #ff7875;
        transform: scale(1.05);
    }

    /* Nút Mua ngay */
    .btn-primary {
        background: linear-gradient(135deg, #4facfe, #00f2fe);
        border: none;
        font-weight: bold;
        font-size: 1.1rem;
        padding: 10px 20px;
        border-radius: 50px;
        transition: all 0.4s ease;
        margin-right: 10px;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #00c6ff, #0072ff);
        transform: scale(1.05);
    }

    /* Nút Tiếp tục mua */
    .btn-secondary {
        background-color: #6c757d;
        border: none;
        font-weight: bold;
        padding: 10px 20px;
        border-radius: 50px;
        transition: all 0.4s ease;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
        transform: scale(1.05);
    }

    /* Phần Tổng cộng */
    .table tfoot td {
        font-size: 1.3rem;
        font-weight: bold;
        color: #ff5722;
    }

    /* Animation */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.95);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    @keyframes slideInTop {
        from {
            opacity: 0;
            transform: translateY(-50px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Style cho container */
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    /* Style cho bảng giỏ hàng */
    .cart-table {
        width: 100%;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .cart-table th,
    .cart-table td {
        padding: 15px;
        text-align: left;
        vertical-align: middle;
    }

    .cart-table th {
        background: linear-gradient(90deg, #007bff, #00d4ff);
        color: #fff;
        font-weight: 600;
    }

    .cart-table tr {
        border-bottom: 1px solid #eee;
    }

    .cart-table tr:last-child {
        border-bottom: none;
    }

    /* Style cho input số lượng */
    .quantity-input {
        width: 80px;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 16px;
        text-align: center;
        outline: none;
        transition: border-color 0.3s;
    }

    .quantity-input:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
    }

    /* Style cho button */
    .btn {
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 16px;
        font-weight: 600;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .btn-primary {
        background: linear-gradient(90deg, #007bff, #00d4ff);
        border: none;
        color: #fff;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 123, 255, 0.4);
    }

    .btn-secondary {
        background: #6c757d;
        border: none;
        color: #fff;
    }

    .btn-secondary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(108, 117, 125, 0.4);
    }

    .btn-danger {
        background: #dc3545;
        border: none;
        color: #fff;
    }

    .btn-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(220, 53, 69, 0.4);
    }

    /* Style cho alert */
    .alert {
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .alert-success {
        background: #d4edda;
        color: #155724;
    }

    .alert-danger {
        background: #f8d7da;
        color: #721c24;
    }

    /* Responsive */
    @media (max-width: 768px) {

        .cart-table th,
        .cart-table td {
            padding: 10px;
            font-size: 14px;
        }

        .quantity-input {
            width: 60px;
        }

        .btn {
            padding: 8px 15px;
            font-size: 14px;
        }
    }
</style>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> hello@colorlib.com</li>
                                <li>Free Shipping for all Order of $99</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-pinterest-p"></i></a>
                            </div>
                            <div class="header__top__right__language">
                                <img src="../view/img/language.png" alt="">
                                <div>English</div>
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    <li><a href="#">Spanis</a></li>
                                    <li><a href="#">English</a></li>
                                </ul>
                            </div>
                            <div class="header__top__right__auth">
                                <a href="?controller=auth&action=logout"><i class="fa fa-user"></i> Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="./index.html"><img src="../view/img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="controller=product&action=index">Home</a></li>
                            <li><a href="./shop-grid.html">Shop</a></li>
                            <li><a href="#">Pages</a>
                                <ul class="header__menu__dropdown">
                                    <li><a href="./shop-details.html">Shop Details</a></li>
                                    <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                                    <li><a href="./checkout.html">Check Out</a></li>
                                    <li><a href="./blog-details.html">Blog Details</a></li>
                                </ul>
                            </li>

                            <li><a href="?controller=order&action=myOrders">đơn hàng</a></li>
                            <li><a href="?controller=auth&action=updateUser">Sửa user</a></li>

                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                            <li><a href="?controller=order&action=viewCart"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
                        </ul>
                        <div class="header__cart__price">item: <span>$150.00</span></div>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <section class="hero hero-normal">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>All departments</span>
                        </div>
                        <ul>
                            <li><a href="#">Fresh Meat</a></li>
                            <li><a href="#">Vegetables</a></li>
                            <li><a href="#">Fruit & Nut Gifts</a></li>
                            <li><a href="#">Fresh Berries</a></li>
                            <li><a href="#">Ocean Foods</a></li>
                            <li><a href="#">Butter & Eggs</a></li>
                            <li><a href="#">Fastfood</a></li>
                            <li><a href="#">Fresh Onion</a></li>
                            <li><a href="#">Papayaya & Crisps</a></li>
                            <li><a href="#">Oatmeal</a></li>
                            <li><a href="#">Fresh Bananas</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="#">
                                <div class="hero__search__categories">
                                    All Categories
                                    <span class="arrow_carrot-down"></span>
                                </div>
                                <input type="text" placeholder="What do yo u need?">
                                <button type="submit" class="site-btn">SEARCH</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+65 11.188.888</h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="../view/img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Vegetable’s Package</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <a href="./index.html">Vegetables</a>
                            <span>Vegetable’s Package</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Details Section Begin -->
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
            <form id="cartForm" action="?controller=order&action=checkout" method="POST">
                <table class="table cart-table">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="select-all" onclick="toggleSelectAll()"> Chọn</th>
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
                            <tr data-product-id="<?php echo $product_id; ?>">
                                <td>
                                    <input type="checkbox" name="selected_products[]" value="<?php echo $product_id; ?>" class="product-checkbox">
                                </td>
                                <td><?php echo htmlspecialchars($item['name']); ?></td>
                                <td class="product-price"><?php echo number_format($item['price']); ?> VND</td>
                                <td>
                                    <input type="number" class="quantity-input" name="quantity[<?php echo $product_id; ?>]" value="<?php echo $item['quantity']; ?>" min="1" data-price="<?php echo $item['price']; ?>">
                                </td>
                                <td class="subtotal"><?php
                                                        $subtotal = $item['price'] * $item['quantity'];
                                                        $total += $subtotal;
                                                        echo number_format($subtotal);
                                                        ?> VND</td>
                                <td>
                                    <a href="?controller=order&action=removeFromCart&id=<?php echo $product_id; ?>" class="btn btn-danger btn-sm">Xóa</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="4"><strong>Tổng cộng:</strong></td>
                            <td><strong id="total-price"><?php echo number_format($total); ?> VND</strong></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>

                <button type="submit" class="btn btn-primary">Mua ngay</button>
                <a href="?controller=product&action=index" class="btn btn-secondary">Tiếp tục mua sắm</a>
            </form>
        <?php endif; ?>
    </div>
    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Related Product</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="../view/img/product/product-1.jpg">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="../view/img/product/product-2.jpg">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="../view/img/product/product-3.jpg">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="../view/img/product/product-7.jpg">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="#">Crab Pool Security</a></h6>
                            <h5>$30.00</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Related Product Section End -->

    <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="./index.html"><img src="../view/img/logo.png" alt=""></a>
                        </div>
                        <ul>
                            <li>Address: 60-49 Road 11378 New York</li>
                            <li>Phone: +65 11.188.888</li>
                            <li>Email: hello@colorlib.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Useful Links</h6>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">About Our Shop</a></li>
                            <li><a href="#">Secure Shopping</a></li>
                            <li><a href="#">Delivery infomation</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Our Sitemap</a></li>
                        </ul>
                        <ul>
                            <li><a href="#">Who We Are</a></li>
                            <li><a href="#">Our Services</a></li>
                            <li><a href="#">Projects</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Innovation</a></li>
                            <li><a href="#">Testimonials</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Join Our Newsletter Now</h6>
                        <p>Get E-mail updates about our latest shop and special offers.</p>
                        <form action="#">
                            <input type="text" placeholder="Enter your mail">
                            <button type="submit" class="site-btn">Subscribe</button>
                        </form>
                        <div class="footer__widget__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text">
                            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;<script>
                                    document.write(new Date().getFullYear());
                                </script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                        </div>
                        <div class="footer__copyright__payment"><img src="../view/img/payment-item.png" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->
    <script>
        // Chọn tất cả checkbox
        function toggleSelectAll() {
            const selectAll = document.getElementById('select-all');
            const checkboxes = document.querySelectorAll('.product-checkbox');
            checkboxes.forEach(checkbox => checkbox.checked = selectAll.checked);
        }

        // Cập nhật tổng tiền khi thay đổi số lượng
        document.querySelectorAll('.quantity-input').forEach(input => {
            input.addEventListener('input', function() {
                const quantity = parseInt(this.value) || 0;
                const price = parseInt(this.dataset.price);
                const subtotal = quantity * price;
                const row = this.closest('tr');
                row.querySelector('.subtotal').textContent = formatVND(subtotal);

                updateTotalPrice();
            });
        });

        // Hàm định dạng tiền VND
        function formatVND(n) {
            return n.toLocaleString('vi-VN') + ' VND';
        }

        // Cập nhật tổng tiền toàn bộ giỏ hàng
        function updateTotalPrice() {
            let total = 0;
            document.querySelectorAll('.subtotal').forEach(subtotal => {
                const value = parseInt(subtotal.textContent.replace(/[^0-9]/g, '')) || 0;
                total += value;
            });
            document.getElementById('total-price').textContent = formatVND(total);
        }

        // Xử lý submit form với SweetAlert
        const cartForm = document.getElementById('cartForm');
        cartForm.addEventListener('submit', function(e E) {
            e.preventDefault();
            Swal.fire({
                icon: 'success',
                title: 'Mua hàng thành công!',
                text: 'Đơn hàng đang được xử lý...',
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'btn btn-success'
                },
                buttonsStyling: false
            }).then(() => {
                cartForm.submit();
            });
        });
    </script>
    <!-- Js Plugins -->
    <script src="../view/js/jquery-3.3.1.min.js"></script>
    <script src="../view/js/bootstrap.min.js"></script>
    <script src="../view/js/jquery.nice-select.min.js"></script>
    <script src="../view/js/jquery-ui.min.js"></script>
    <script src="../view/js/jquery.slicknav.js"></script>
    <script src="../view/js/mixitup.min.js"></script>
    <script src="../view/js/owl.carousel.min.js"></script>
    <script src="../view/js/main.js"></script>


</body>

</html>