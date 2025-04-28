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


  <link rel="stylesheet" href="../view/css/jquery-ui.min.css" type="text/css">


  <link rel="stylesheet" href="../view/css/owl.carousel.min.css" type="text/css">

  <link rel="stylesheet" href="../view/css/slicknav.min.css" type="text/css">
  <link rel="stylesheet" href="../view/css/style.css" type="text/css">
  <link rel="stylesheet" href="../view/css/elegant-icons.css" type="text/css">
  <link rel="stylesheet" href="../view/css/nice-select.css" type="text/css">
</head>
<style>
  .shop_section {
    padding: 60px 0;
    background-color: #f9f9f9;
  }

  .heading_container h2 {
    font-size: 2.5rem;
    font-weight: bold;
    margin-bottom: 40px;
    position: relative;
    display: inline-block;
    color: #333;
  }

  .heading_container h2::after {
    content: "";
    width: 60%;
    height: 3px;
    background-color: #ff6f61;
    display: block;
    margin: 10px auto 0;
    border-radius: 5px;
  }

  .box {
    background: #fff;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    margin: 20px 10px;
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    position: relative;
    width: 100%;
    max-width: 300px;
  }

  .box:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
  }

  .box a {
    text-decoration: none;
    color: inherit;
  }

  .img-box {
    background-color: #f1f1f1;
    padding: 20px;
  }

  .img-box img {
    max-width: 100%;
    height: 220px;
    object-fit: cover;
    border-radius: 10px;
  }

  .detail-box {
    padding: 20px 10px;
  }

  .detail-box h6 {
    margin: 5px 0;
    font-size: 1.1rem;
    color: #333;
  }

  .detail-box span {
    color: #ff6f61;
    font-weight: bold;
    margin-left: 5px;
  }

  .new {
    position: absolute;
    top: 15px;
    right: 15px;
    background-color: #ff6f61;
    color: #fff;
    font-size: 0.8rem;
    padding: 5px 10px;
    border-radius: 30px;
    font-weight: bold;
  }

  .buy-form {
    margin-top: 10px;
  }

  .buy-btn {
    background-color: #ff6f61;
    border: none;
    padding: 10px 20px;
    margin-bottom: 20px;
    border-radius: 30px;
    font-size: 1rem;
    font-weight: bold;
    transition: background-color 0.3s ease;
  }

  .buy-btn:hover {
    background-color: #e85b50;
  }

  .btn-box a {
    display: inline-block;
    padding: 12px 30px;
    background-color: #ff6f61;
    color: white;
    font-weight: bold;
    border-radius: 30px;
    text-decoration: none;
    transition: background-color 0.3s ease;
    font-size: 1rem;
  }

  .btn-box a:hover {
    background-color: #e85b50;
  }
</style>

<body>
  <!-- Page Preloder -->
  <div id="preloder">
    <div class="loader"></div>
  </div>

  <!-- Humberger Begin -->
  <div class="humberger__menu__overlay"></div>
  <div class="humberger__menu__wrapper">
    <div class="humberger__menu__logo">
      <a href="#"><img src="../view/../view/img/logo.png" alt=""></a>
    </div>
    <div class="humberger__menu__cart">
      <ul>
        <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
        <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
      </ul>
      <div class="header__cart__price">item: <span>$150.00</span></div>
    </div>
    <div class="humberger__menu__widget">
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
    <nav class="humberger__menu__nav mobile-menu">
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
        <li><a href="./blog.html">Blog</a></li>
        <li><a href="./contact.html">Contact</a></li>
      </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>
    <div class="header__top__right__social">
      <a href="#"><i class="fa fa-facebook"></i></a>
      <a href="#"><i class="fa fa-twitter"></i></a>
      <a href="#"><i class="fa fa-linkedin"></i></a>
      <a href="#"><i class="fa fa-pinterest-p"></i></a>
    </div>
    <div class="humberger__menu__contact">
      <ul>
        <li><i class="fa fa-envelope"></i> hello@colorlib.com</li>
        <li>Free Shipping for all Order of $99</li>
      </ul>
    </div>
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
              <li><a href="./blog.html">Blog</a></li>
              <li><a href="?controller=order&action=myOrders">đơn hàng</a></li>
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
  <section class="hero">
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
          <div class="hero__item set-bg" data-setbg="../view/img/hero/banner.jpg">
            <div class="hero__text">
              <span>FRUIT FRESH</span>
              <h2>Vegetable <br />100% Organic</h2>
              <p>Free Pickup and Delivery Available</p>
              <a href="#" class="primary-btn">SHOP NOW</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Hero Section End -->

  <!-- Categories Section Begin -->
  <section class="categories">
    <div class="container">
      <div class="row">
        <div class="categories__slider owl-carousel">
          <div class="col-lg-3">
            <div class="categories__item set-bg" data-setbg="../view/img/categories/cat-1.jpg">
              <h5><a href="#">Fresh Fruit</a></h5>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="categories__item set-bg" data-setbg="../view/img/categories/cat-2.jpg">
              <h5><a href="#">Dried Fruit</a></h5>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="categories__item set-bg" data-setbg="../view/img/categories/cat-3.jpg">
              <h5><a href="#">Vegetables</a></h5>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="categories__item set-bg" data-setbg="../view/img/categories/cat-4.jpg">
              <h5><a href="#">drink fruits</a></h5>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="categories__item set-bg" data-setbg="../view/img/categories/cat-5.jpg">
              <h5><a href="#">drink fruits</a></h5>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Categories Section End -->
  <section class="shop_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>Top 3 sản phẩm mới nhất</h2>
      </div>
      <div class="row justify-content-center">
        <?php
        $topProducts = array_slice($latestProducts, 0, 3); // Lấy 3 sản phẩm đầu tiên
        foreach ($topProducts as $product):
        ?>
          <div class="col-sm-6 col-md-4 col-lg-3 d-flex justify-content-center">
            <div class="box">
              <a href="?controller=product&action=detail&id=<?php echo $product['ID']; ?>">
                <div class="img-box">
                  <img src="../public/img/<?php echo htmlspecialchars($product['img']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                </div>
                <div class="detail-box">
                  <h6><?php echo htmlspecialchars($product['name']); ?></h6>
                  <h6>
                    Price
                    <span><?php echo number_format($product['price']); ?> VND</span>
                  </h6>
                </div>
                <div class="new">
                  <span>New</span>
                </div>
              </a>
              <form class="buy-form" method="POST" action="?controller=order&action=buy">
                <input type="hidden" name="product_id" value="<?php echo $product['ID']; ?>">
                <input type="hidden" name="quantity" value="1" class="quantity-input">
                <button type="submit" class="btn btn-primary buy-btn">Buy Now</button>
              </form>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      <div class="btn-box text-center mt-4">
        <a href="?controller=product&action=index">View All Products</a>
      </div>
    </div>
  </section>

  <!-- Featured Section Begin -->
  <section class="featured spad">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-title">
            <h2>Featured Product</h2>
          </div>
          <div class="featured__controls">
            <ul>
              <li class="active" data-filter="*">All</li>
              <li data-filter=".oranges">Oranges</li>
              <li data-filter=".fresh-meat">Fresh Meat</li>
              <li data-filter=".vegetables">Vegetables</li>
              <li data-filter=".fastfood">Fastfood</li>
            </ul>
          </div>
        </div>
      </div>
      <div style="margin-top: 10px;margin-left: 325px; display:flex;justify-content: center;width: 60%;" class="input-group mb-4 mt-20">
        <input type="text" id="searchInput" class="form-control" placeholder="Tìm kiếm theo tên sản phẩm" value="<?php echo htmlspecialchars($keyword ?? ''); ?>">
        <div class="input-group-append">
          <button id="searchButton" class="btn btn-primary">Tìm</button>
        </div>
      </div>
      <div class="row featured__filter" id="productList">
        <?php foreach ($allProducts as $product): ?>
          <div class="col-lg-3 col-md-4 col-sm-6 mix new-arrival">
            <div class="featured__item">
              <div
                class="featured__item__pic set-bg"
                data-setbg="../public/img/<?php echo htmlspecialchars($product['img']); ?>">
                <ul class="featured__item__pic__hover">
                  <li>
                    <a href="#"><i class="fa fa-heart"></i></a>
                  </li>
                  <li>
                    <a href="#"><i class="fa fa-retweet"></i></a>
                  </li>
                  <li>
                    <form method="POST" action="?controller=order&action=buy">
                      <input
                        type="hidden"
                        name="product_id"
                        value="<?php echo $product['ID']; ?>" />
                      <input type="hidden" name="quantity" value="1" />
                      <button type="submit" class="no-style-btn">
                        <i class="fa fa-shopping-cart"></i>
                      </button>
                    </form>
                  </li>
                </ul>
              </div>
              <div class="featured__item__text">
                <h6>
                  <a href="#"><?php echo htmlspecialchars($product['name']); ?></a>
                </h6>
                <h5>
                  <?php echo number_format($product['price']); ?>
                  VND
                </h5>
                <p class="description">
                  <?php echo htmlspecialchars($product['description']); ?>
                </p>
                <p class="created-date">
                  Ngày:
                  <?php echo $product['created_at'] ?? 'N/A'; ?>
                </p>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
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
  </section>
  <!-- Featured Section End -->

  <!-- Banner Begin -->
  <div class="banner">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
          <div class="banner__pic">
            <img src="../view/img/banner/banner-1.jpg" alt="">
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
          <div class="banner__pic">
            <img src="../view/img/banner/banner-2.jpg" alt="">
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Banner End -->

  <!-- Latest Product Section Begin -->
  <section class="latest-product spad">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-6">
          <div class="latest-product__text">
            <h4>Latest Products</h4>
            <div class="latest-product__slider owl-carousel">
              <div class="latest-prdouct__slider__item">
                <a href="#" class="latest-product__item">
                  <div class="latest-product__item__pic">
                    <img src="../view/img/latest-product/lp-1.jpg" alt="">
                  </div>
                  <div class="latest-product__item__text">
                    <h6>Crab Pool Security</h6>
                    <span>$30.00</span>
                  </div>
                </a>
                <a href="#" class="latest-product__item">
                  <div class="latest-product__item__pic">
                    <img src="../view/img/latest-product/lp-2.jpg" alt="">
                  </div>
                  <div class="latest-product__item__text">
                    <h6>Crab Pool Security</h6>
                    <span>$30.00</span>
                  </div>
                </a>
                <a href="#" class="latest-product__item">
                  <div class="latest-product__item__pic">
                    <img src="../view/img/latest-product/lp-3.jpg" alt="">
                  </div>
                  <div class="latest-product__item__text">
                    <h6>Crab Pool Security</h6>
                    <span>$30.00</span>
                  </div>
                </a>
              </div>
              <div class="latest-prdouct__slider__item">
                <a href="#" class="latest-product__item">
                  <div class="latest-product__item__pic">
                    <img src="../view/img/latest-product/lp-1.jpg" alt="">
                  </div>
                  <div class="latest-product__item__text">
                    <h6>Crab Pool Security</h6>
                    <span>$30.00</span>
                  </div>
                </a>
                <a href="#" class="latest-product__item">
                  <div class="latest-product__item__pic">
                    <img src="../view/img/latest-product/lp-2.jpg" alt="">
                  </div>
                  <div class="latest-product__item__text">
                    <h6>Crab Pool Security</h6>
                    <span>$30.00</span>
                  </div>
                </a>
                <a href="#" class="latest-product__item">
                  <div class="latest-product__item__pic">
                    <img src="../view/img/latest-product/lp-3.jpg" alt="">
                  </div>
                  <div class="latest-product__item__text">
                    <h6>Crab Pool Security</h6>
                    <span>$30.00</span>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="latest-product__text">
            <h4>Top Rated Products</h4>
            <div class="latest-product__slider owl-carousel">
              <div class="latest-prdouct__slider__item">
                <a href="#" class="latest-product__item">
                  <div class="latest-product__item__pic">
                    <img src="../view/img/latest-product/lp-1.jpg" alt="">
                  </div>
                  <div class="latest-product__item__text">
                    <h6>Crab Pool Security</h6>
                    <span>$30.00</span>
                  </div>
                </a>
                <a href="#" class="latest-product__item">
                  <div class="latest-product__item__pic">
                    <img src="../view/img/latest-product/lp-2.jpg" alt="">
                  </div>
                  <div class="latest-product__item__text">
                    <h6>Crab Pool Security</h6>
                    <span>$30.00</span>
                  </div>
                </a>
                <a href="#" class="latest-product__item">
                  <div class="latest-product__item__pic">
                    <img src="../view/img/latest-product/lp-3.jpg" alt="">
                  </div>
                  <div class="latest-product__item__text">
                    <h6>Crab Pool Security</h6>
                    <span>$30.00</span>
                  </div>
                </a>
              </div>
              <div class="latest-prdouct__slider__item">
                <a href="#" class="latest-product__item">
                  <div class="latest-product__item__pic">
                    <img src="../view/img/latest-product/lp-1.jpg" alt="">
                  </div>
                  <div class="latest-product__item__text">
                    <h6>Crab Pool Security</h6>
                    <span>$30.00</span>
                  </div>
                </a>
                <a href="#" class="latest-product__item">
                  <div class="latest-product__item__pic">
                    <img src="../view/img/latest-product/lp-2.jpg" alt="">
                  </div>
                  <div class="latest-product__item__text">
                    <h6>Crab Pool Security</h6>
                    <span>$30.00</span>
                  </div>
                </a>
                <a href="#" class="latest-product__item">
                  <div class="latest-product__item__pic">
                    <img src="../view/img/latest-product/lp-3.jpg" alt="">
                  </div>
                  <div class="latest-product__item__text">
                    <h6>Crab Pool Security</h6>
                    <span>$30.00</span>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="latest-product__text">
            <h4>Review Products</h4>
            <div class="latest-product__slider owl-carousel">
              <div class="latest-prdouct__slider__item">
                <a href="#" class="latest-product__item">
                  <div class="latest-product__item__pic">
                    <img src="../view/img/latest-product/lp-1.jpg" alt="">
                  </div>
                  <div class="latest-product__item__text">
                    <h6>Crab Pool Security</h6>
                    <span>$30.00</span>
                  </div>
                </a>
                <a href="#" class="latest-product__item">
                  <div class="latest-product__item__pic">
                    <img src="../view/img/latest-product/lp-2.jpg" alt="">
                  </div>
                  <div class="latest-product__item__text">
                    <h6>Crab Pool Security</h6>
                    <span>$30.00</span>
                  </div>
                </a>
                <a href="#" class="latest-product__item">
                  <div class="latest-product__item__pic">
                    <img src="../view/img/latest-product/lp-3.jpg" alt="">
                  </div>
                  <div class="latest-product__item__text">
                    <h6>Crab Pool Security</h6>
                    <span>$30.00</span>
                  </div>
                </a>
              </div>
              <div class="latest-prdouct__slider__item">
                <a href="#" class="latest-product__item">
                  <div class="latest-product__item__pic">
                    <img src="../view/img/latest-product/lp-1.jpg" alt="">
                  </div>
                  <div class="latest-product__item__text">
                    <h6>Crab Pool Security</h6>
                    <span>$30.00</span>
                  </div>
                </a>
                <a href="#" class="latest-product__item">
                  <div class="latest-product__item__pic">
                    <img src="../view/img/latest-product/lp-2.jpg" alt="">
                  </div>
                  <div class="latest-product__item__text">
                    <h6>Crab Pool Security</h6>
                    <span>$30.00</span>
                  </div>
                </a>
                <a href="#" class="latest-product__item">
                  <div class="latest-product__item__pic">
                    <img src="../view/img/latest-product/lp-3.jpg" alt="">
                  </div>
                  <div class="latest-product__item__text">
                    <h6>Crab Pool Security</h6>
                    <span>$30.00</span>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Latest Product Section End -->

  <!-- Blog Section Begin -->
  <section class="from-blog spad">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-title from-blog__title">
            <h2>From The Blog</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-6">
          <div class="blog__item">
            <div class="blog__item__pic">
              <img src="../view/img/blog/blog-1.jpg" alt="">
            </div>
            <div class="blog__item__text">
              <ul>
                <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                <li><i class="fa fa-comment-o"></i> 5</li>
              </ul>
              <h5><a href="#">Cooking tips make cooking simple</a></h5>
              <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
          <div class="blog__item">
            <div class="blog__item__pic">
              <img src="../view/img/blog/blog-2.jpg" alt="">
            </div>
            <div class="blog__item__text">
              <ul>
                <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                <li><i class="fa fa-comment-o"></i> 5</li>
              </ul>
              <h5><a href="#">6 ways to prepare breakfast for 30</a></h5>
              <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
          <div class="blog__item">
            <div class="blog__item__pic">
              <img src="../view/img/blog/blog-3.jpg" alt="">
            </div>
            <div class="blog__item__text">
              <ul>
                <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                <li><i class="fa fa-comment-o"></i> 5</li>
              </ul>
              <h5><a href="#">Visit the clean farm in the US</a></h5>
              <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Blog Section End -->

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

  <!-- Js Plugins -->
  <script src="../view/js/jquery-3.3.1.min.js"></script>
  <script src="../view/js/bootstrap.min.js"></script>
  <script src="../view/js/jquery.nice-select.min.js"></script>
  <script src="../view/js/jquery-ui.min.js"></script>
  <script src="../view/js/jquery.slicknav.js"></script>
  <script src="../view/js/mixitup.min.js"></script>
  <script src="../view/js/owl.carousel.min.js"></script>
  <script src="../view/js/main.js"></script>


  <script>
    document.addEventListener('DOMContentLoaded', function() {
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
    <div class="col-lg-3 col-md-4 col-sm-6 mix new-arrival">
      <div class="featured__item">
        <div class="featured__item__pic set-bg" data-setbg="../public/img/${product.img}">
          <ul class="featured__item__pic__hover">
            <li><a href="#"><i class="fa fa-heart"></i></a></li>
            <li><a href="#"><i class="fa fa-retweet"></i></a></li>
            <li>
              <form method="POST" action="?controller=order&action=buy">
                <input type="hidden" name="product_id" value="${product.ID}">
                <input type="hidden" name="quantity" value="1">
                <button type="submit" class="no-style-btn">
                  <i class="fa fa-shopping-cart"></i>
                </button>
              </form>
            </li>
          </ul>
        </div>
        <div class="featured__item__text">
          <h6><a href="#">${product.name}</a></h6>
          <h5>${new Intl.NumberFormat('vi-VN').format(product.price)} VND</h5>
          <p class="description">${product.description}</p>
          <p class="created-date">Ngày: ${product.created_at || 'N/A'}</p>
        </div>
      </div>
    </div>
  `;
            });
            // Re-run set-bg logic
            document.querySelectorAll('.set-bg').forEach(element => {
              const bg = element.getAttribute('data-setbg');
              element.style.backgroundImage = `url(${bg})`;
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
      searchButton.addEventListener('click', function() {
        const keyword = searchInput.value.trim();
        loadProducts(keyword, 1); // Tải trang 1 với từ khóa
      });

      // Sự kiện nhấn Enter trong input
      searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
          const keyword = searchInput.value.trim();
          loadProducts(keyword, 1);
        }
      });

      // Gắn sự kiện cho phân trang
      function attachPaginationEvents() {
        const pageLinks = document.querySelectorAll('.page-link');
        pageLinks.forEach(link => {
          link.addEventListener('click', function(e) {
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
</body>

</html>