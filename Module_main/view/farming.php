<!DOCTYPE html>
<html lang="en">

<head>
    <title>Furry - Pet Store HTML Website Template</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="author" content="TemplatesJungle" />
    <meta name="keywords" content="pet, store" />
    <meta name="description" content="Pet Store HTML Website Template" />

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ"
        crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="../view/css/vendor.css" />
    <link rel="stylesheet" type="text/css" href="./style.css" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Chewy&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
        rel="stylesheet" />
</head>
<style>
    @media (max-width: 576px) {
        .list_item {
            display: none;
        }
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

    @media (max-width: 576px) {
        .logo-img {
            max-height: 50px !important;
        }
    }

    /* === LOGO + ZALO === */
    .logo-img {
        max-height: 60px;
        object-fit: contain;
        transition: transform 0.3s ease;
    }

    .logo-img:hover {
        transform: scale(1.05);
    }

    /* Zalo button */
    .btn-zalo img {
        width: 40px;
        transition: transform 0.3s ease;
    }

    .btn-zalo:hover img {
        transform: scale(1.15);
    }

    /* === SEARCH BAR === */
    .search-bar {
        border: 1px solid #ddd;
        background-color: #f8f9fa !important;
        border-radius: 10px;
        box-shadow: 0 1px 5px rgba(0, 0, 0, 0.05);
    }

    .search-bar input {
        padding-left: 12px;
        font-size: 14px;
        height: 40px;
    }

    .search-bar svg {
        color: #555;
        cursor: pointer;
        transition: color 0.2s ease;
    }

    .search-bar svg:hover {
        color: #007bff;
    }

    /* === NAV ICONS (user, cart, search) === */
    ul li a svg {
        fill: #333;
        transition: transform 0.2s ease, fill 0.2s ease;
    }

    ul li a:hover svg {
        transform: scale(1.15);
        fill: #007bff;
    }

    /* === NAVBAR MENU === */
    .navbar-nav .nav-link {
        font-size: 14px;
        text-transform: uppercase;
        color: #333;
        transition: color 0.2s ease, background-color 0.2s ease;
    }

    .navbar-nav .nav-link:hover {
        color: #007bff;
        background-color: rgba(0, 123, 255, 0.05);
        border-radius: 4px;
    }

    .post-item {
        transition: all 0.3s ease;
    }

    /* Responsive cho điện thoại */
    @media screen and (max-width: 768px) {
        .col-md-4:nth-child(n+4) {
            display: none;
            /* Ẩn bài viết từ thứ 4 trở đi */
        }
    }
</style>

<body>



    <!-- <section id="latest-blog" class="section-padding pt-0">
        <div class="container-lg">
            <div class="row">
                <div class="section-header d-flex align-items-center justify-content-between mb-lg-2">
                    <h2 class="section-title">Bài báo</h2>
                    <a href="?controller=article&action=index" class="btn btn-primary">View All</a>
                </div>
            </div>
            <div class="row">
                <?php foreach ($articles as $article): ?>
                    <div class="col-md-4">
                        <article class="post-item card border-1 border-light shadow-sm p-3">
                            <div class="image-holder zoom-effect">
                                <a href="?controller=article&action=view&id=<?= htmlspecialchars($article['id'] ?? '') ?>">
                                    <img src="<?= htmlspecialchars($article['image_url'] ?? '../public/img/default.jpg') ?>" alt="post" class="card-img-top" loading="lazy" />
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="post-meta d-flex text-uppercase gap-3 my-3 align-items-center">
                                    <div class="meta-date">
                                        <a href="#" class="text-decoration-none"><?= date("d M Y", strtotime($article['created_at'] ?? 'now')) ?></a>
                                    </div>
                                    <div class="meta-categories">
                                        <a href="#" class="text-decoration-none"><?= htmlspecialchars($article['note'] ?? '') ?></a>
                                    </div>
                                </div>
                                <div class="post-header">
                                    <h3 class="fs-5 fw-normal">
                                        <a href="#" class="text-decoration-none"><?= htmlspecialchars($article['title'] ?? '') ?></a>
                                    </h3>
                                    <p><?= htmlspecialchars($article['description'] ?? '') ?></p>
                                </div>
                            </div>
                        </article>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section> -->



    <section id="farming-process" class="section-padding pt-0">
        <div class="container-lg">
            <div class="row">
                <div class="section-header d-flex align-items-center justify-content-between mb-4">
                    <h2 class="section-title text-success">Quy trình chăn nuôi</h2>

                </div>
            </div>
            <div class="row" id="farming-container">
                <?php if (empty($FarmingProcess)): ?>
                    <p class="text-muted">Không có bài Quy trình chăn nuôi trong danh mục này.</p>
                <?php else: ?>
           
    <?php foreach ($FarmingProcess as $process): ?>
        <div class="col-lg-4 col-md-6 mb-4">
            <article class="post-item card border-1 border-success shadow-sm h-100">
                <div class="image-holder zoom-effect">
                    <a href="/BTL_PHP/Module_main/public/index.php?controller=farming_process&action=detail_fm&id=<?= htmlspecialchars($process['ID'] ?? '') ?>" aria-label="Xem chi tiết quy trình">
                        <img src="<?= htmlspecialchars($process['image_url'] ?? '/public/img/default.jpg') ?>"
                            alt="<?= htmlspecialchars($process['title'] ?? 'Hình ảnh quy trình chăn nuôi') ?>"
                            class="card-img-top" loading="lazy" />
                    </a>
                </div>
                <div class="card-body">
                    <div class="post-meta d-flex text-uppercase gap-3 my-3 align-items-center">
                        <span class="meta-date text-muted">
                            <?= date("d M Y", strtotime($process['created_at'] ?? 'now')) ?>
                        </span>
                        <span class="meta-categories text-muted">
                            <?= htmlspecialchars($process['note'] ?? '') ?>
                        </span>
                    </div>
                    <div class="post-header">
                        <h3 class="fs-5 fw-bold">
                            <a href="/BTL_PHP/Module_main/public/index.php?controller=farming_process&action=detail_fm&id=<?= htmlspecialchars($process['ID'] ?? '') ?>"
                                class="post-title"><?= htmlspecialchars($process['title'] ?? '') ?></a>
                        </h3>
                        <p class="text-muted"><?= htmlspecialchars($process['description'] ?? '') ?></p>
                    </div>
                </div>
            </article>
        </div>
    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <script>
        function changeCategoryFm() {
            const select = document.getElementById('categorySelect_fm');
            const categoryId = select.value;
            Swal.fire({
                title: 'Đang tải...',
                text: 'Vui lòng chờ trong khi tải danh mục mới.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            let url = '?controller=product&action=index';
            if (categoryId) {
                url += '&category_id_fm=' + encodeURIComponent(categoryId);
            }
            setTimeout(() => {
                window.location.href = url;
            }, 500);
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../view/js/jquery-1.11.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="../view/js/plugins.js"></script>
    <script src="../view/js/script.js"></script>
</body>

</html>