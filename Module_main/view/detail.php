<?php
            require_once __DIR__ . '/../Format/description_formatter.php';

            ?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Sản Phẩm</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5f5;
        }

        .product-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .product-title {
            font-size: 24px;
            font-weight: 500;
            color: #333;
            margin-bottom: 10px;
        }

        .product-price {
            font-size: 28px;
            font-weight: 700;
            color: #ee4d2d;
            margin-bottom: 10px;
        }

        .carousel-container {
            position: relative;
            margin-bottom: 20px;
        }

        .carousel-inner {
            overflow: hidden;
            border-radius: 8px;
        }

        .carousel-item img {
            width: 100%;
            height: 400px;
            object-fit: contain;
            border: 2px solid transparent;
            border-radius: 8px;
        }

        .carousel-item.main img {
            border-color: #ee4d2d;
        }

        .carousel-thumbnails {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 10px;
        }

        .carousel-thumbnails img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
            cursor: pointer;
            opacity: 0.6;
            transition: opacity 0.3s, border 0.3s;
            border: 2px solid transparent;
        }

        .carousel-thumbnails img.active {
            opacity: 1;
            border-color: #ee4d2d;
        }

        .carousel-prev,
        .carousel-next {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: #fff;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .carousel-prev:hover,
        .carousel-next:hover {
            background-color: rgba(0, 0, 0, 0.7);
        }

        .carousel-prev {
            left: 10px;
        }

        .carousel-next {
            right: 10px;
        }

        .btn-shopee {
            background-color: #ee4d2d;
            color: #fff;
            padding: 10px 20px;
            border-radius: 4px;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        .btn-shopee:hover {
            background-color: #d43d1e;
        }

        .section-title {
            font-size: 18px;
            font-weight: 500;
            color: #333;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        .rating-stars {
            color: #ee4d2d;
        }

        .review-item {
            border-bottom: 1px solid #eee;
            padding: 15px 0;
        }

        .comment-section {
            background-color: #fafafa;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
        }

        .comment-item {
            background-color: #fff;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .comment-header {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .comment-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: #555;
            margin-right: 10px;
        }

        .comment-content {
            font-size: 14px;
            color: #333;
            margin-bottom: 10px;
        }

        .comment-meta {
            font-size: 12px;
            color: #888;
        }

        .reply-item {
            background-color: #f9f9f9;
            padding: 10px;
            border-radius: 6px;
            margin-left: 50px;
            margin-top: 10px;
        }

        .reply-form-container {
            display: none;
            margin-top: 10px;
            margin-left: 50px;
        }

        .reply-form-container.active {
            display: block;
        }

        .form-group label {
            font-size: 14px;
            color: #333;
            margin-bottom: 5px;
            display: block;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 10px;
            width: 100%;
            font-size: 14px;
        }

        .form-group textarea {
            resize: vertical;
        }

        .reply-toggle {
            color: #ee4d2d;
            cursor: pointer;
            font-size: 14px;
            margin-top: 5px;
            display: inline-flex;
            align-items: center;
        }

        .reply-toggle:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .product-container {
                padding: 15px;
            }

            .carousel-item img {
                height: 300px;
            }

            .product-title {
                font-size: 20px;
            }

            .product-price {
                font-size: 24px;
            }

            .comment-section {
                padding: 15px;
            }

            .comment-avatar {
                width: 30px;
                height: 30px;
                font-size: 14px;
            }

            .reply-item {
                margin-left: 20px;
            }

            .reply-form-container {
                margin-left: 20px;
            }
        }

        .carousel-inner {
            display: flex;
            width: 100%;
            transition: transform 0.5s ease;
        }

        .carousel-item {
            min-width: 100%;
            box-sizing: border-box;
        }

        .product-preview {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .product-main-image img {
            width: 400px;
            height: 400px;
            object-fit: contain;
            border: 2px solid #eee;
            border-radius: 8px;
            transition: border 0.3s;
        }

        .product-thumbnails img.active {
            border: 2px solid red;
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

        .modal-content {
            background-color: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: auto;
            font-family: 'Segoe UI', sans-serif;
        }

        .modal-content h2 {
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 22px;
            color: #333;
        }

        .modal-content form div {
            margin-bottom: 15px;
        }

        .modal-content label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-weight: 500;
        }

        .modal-content input,
        .modal-content textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
            box-sizing: border-box;
        }

        .modal-content input:focus,
        .modal-content textarea:focus {
            border-color: #28a745;
            outline: none;
        }

        .modal-content button {
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 15px;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        .modal-content button:hover {
            background-color: #218838;
        }

        .star-rating .fa-star,
        .star-rating .far.fa-star {
            color: #ffc107;
            font-size: 1.5rem;
            cursor: pointer;
            margin-right: 5px;
        }

        .star-rating .fa-star:hover,
        .star-rating .fa-star.active {
            color: #ffca2c;
        }
    </style>
</head>

<body>

    <?php include 'header.php'; ?>
    <div class="row" style="display: flex;justify-content: center; margin-top: 10px;">
        <div class="col-xs-11 col-md-7">
            <div class="product-container" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;">
                <?php if (isset($_SESSION['error'])): ?>
                    <p class="text-red-600 text-center mb-4"><?php echo htmlspecialchars($_SESSION['error']); ?></p>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>

                <?php if (!empty($product)): ?>
                    <div class="flex flex-col md:flex-row gap-6">
                        <!-- Product Images -->
                        <div class="md:w-1/2">
                            <h3 class="section-title">Ảnh sản phẩm</h3>
                            <!-- <div class="carousel-container">
                        <div class="carousel-inner flex transition-transform duration-500 ease-in-out">
                            <?php if (!empty($product['images'])): ?>
                                <?php foreach ($product['images'] as $index => $image): ?>
                                    <div class="carousel-item flex-none w-full text-center <?php echo $image['is_main'] ? 'main' : ''; ?>">
                                        <img src="../public/img/<?php echo htmlspecialchars($image['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="carousel-item flex-none w-full text-center">
                                    <img src="../public/img/placeholder.jpg" alt="No Image Available">
                                </div>
                            <?php endif; ?>
                            <?php foreach ($product['images'] as $index => $image): ?>
                                <div class="carousel-item flex-none w-full text-center <?php echo $image['is_main'] ? 'main' : ''; ?>">
                                    <img src="../public/img/<?php echo htmlspecialchars($image['image_url']); ?>" alt="Ảnh <?php echo $index; ?>">
                                </div>
                            <?php endforeach; ?>

                        </div>

                        <?php if (!empty($product['images']) && count($product['images']) > 1): ?>
                            <button class="carousel-prev"><i class="fas fa-chevron-left"></i></button>
                            <button class="carousel-next"><i class="fas fa-chevron-right"></i></button>
                        <?php endif; ?>
                    </div> -->
                            <!-- Ảnh lớn -->
                            <div class="product-preview">
                                <div class="product-main-image">
                                    <?php if (!empty($product['images'])): ?>
                                        <img id="mainImage" src="../public/img/<?php echo htmlspecialchars($product['images'][0]['image_url']); ?>" alt="Ảnh chính">
                                    <?php else: ?>
                                        <img id="mainImage" src="../public/img/placeholder.jpg" alt="Không có ảnh">
                                    <?php endif; ?>
                                </div>

                                <!-- Ảnh nhỏ -->
                                <div class="product-thumbnails flex mt-3 gap-2">
                                    <?php foreach ($product['images'] as $index => $image): ?>
                                        <img class="thumb-img border <?php echo $index === 0 ? 'active' : ''; ?>"
                                            src="../public/img/<?php echo htmlspecialchars($image['image_url']); ?>"
                                            data-full="../public/img/<?php echo htmlspecialchars($image['image_url']); ?>"
                                            style="width: 60px; height: 60px; object-fit: cover; cursor: pointer;">
                                    <?php endforeach; ?>
                                </div>
                            </div>


                        </div>

                        <!-- Product Details -->
                        <div class="md:w-1/2">
                            <h1 class="product-title"><?php echo htmlspecialchars($product['name']); ?></h1>
                            <p class="product-price"><?php echo number_format($product['price'], 0, ',', '.') . ' VND'; ?></p>
                            <p class="text-gray-600 mb-2"><strong>Số lượng:</strong> <?php echo htmlspecialchars($product['quantity']); ?></p>

                            <p class="text-gray-600 mb-4"><strong>Ngày tạo:</strong> <?php echo htmlspecialchars($product['created_at']); ?></p>

                            <!-- Add to Cart -->
                            <form method="POST" action="?controller=order&action=addToCart" class="mt-4">
                                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['ID']); ?>">

                            </form>
                            <button class="btn btn-primary rounded-1 p-2 fs-7 btn-shopee consult-btn" data-product-id="<?php echo $product['ID']; ?>" type="submit">Liên hệ tư vấn</button>

                        </div>
                    </div>
                    <div class="text-gray-600 mb-2"><strong>Mô tả:</strong>
                        <?php echo formatDescription($product['description']); ?>
                    </div>
                    <!-- Reviews -->
                    <h3 class="section-title">Đánh giá sản phẩm</h3>
                    <p class="text-gray-600 mb-4">
                        <strong>Đánh giá trung bình:</strong>
                        <?php
                        $rating = isset($averageRating['average_rating']) && is_numeric($averageRating['average_rating'])
                            ? number_format($averageRating['average_rating'], 1)
                            : '0.0';
                        $total_reviews = isset($averageRating['total_reviews']) ? (int)$averageRating['total_reviews'] : 0;
                        echo "$rating / 5 ($total_reviews đánh giá)";
                        ?>
                        <span class="rating-stars"><?php echo str_repeat('★', round($rating)); ?></span>
                    </p>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <div class="mt-4">
                            <form id="reviewForm" method="POST" action="?controller=product&action=addReview" class="space-y-4">
                                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['ID']); ?>">
                                <div class="form-group mb-3">
                                    <label for="rating" class="form-label">Đánh giá (1-5):</label>
                                    <div class="star-rating" data-rating="3">
                                        <i class="fas fa-star" data-value="1"></i>
                                        <i class="fas fa-star" data-value="2"></i>
                                        <i class="fas fa-star" data-value="3"></i>
                                        <i class="far fa-star" data-value="4"></i>
                                        <i class="far fa-star" data-value="5"></i>
                                        <input type="hidden" name="rating" id="rating" value="3">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="comment">Bình luận:</label>
                                    <textarea name="comment" id="comment" rows="4" placeholder="Viết đánh giá của bạn..." class="form-control"></textarea>
                                </div>
                                <button type="submit" class="btn-shopee">Gửi đánh giá</button>
                            </form>
                        </div>
                    <?php else: ?>
                        <p class="text-gray-600 mt-2">Vui lòng <a href="?controller=auth&action=login" class="text-blue-600 hover:underline">đăng nhập</a> để gửi đánh giá.</p>
                    <?php endif; ?>

                    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        Xem đánh giá
                    </button>

                    <div class="collapse" id="collapseExample">
                        <div class="reviews mt-4">
                            <?php if (empty($reviews)): ?>
                                <p class="text-gray-600">Chưa có đánh giá nào.</p>
                            <?php else: ?>
                                <?php foreach ($reviews as $review): ?>
                                    <div class="review-item">
                                        <p class="font-semibold"><?php echo htmlspecialchars($review['name'] ?? $review['username'] ?? 'Người dùng'); ?> -
                                            <span class="rating-stars"><?php echo str_repeat('★', (int)($review['rating'] ?? 0)) . str_repeat('☆', 5 - (int)($review['rating'] ?? 0)); ?></span>
                                        </p>
                                        <p class="text-gray-600"><?php echo htmlspecialchars($review['comment'] ?? 'Không có bình luận'); ?></p>
                                        <p class="text-sm text-gray-500"><?php echo htmlspecialchars($review['created_at'] ?? ''); ?></p>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>


                    <!-- Comments Section -->
                    <div class="comment-section">
                        <h3 class="section-title">Bình luận sản phẩm</h3>
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <div class="mb-6">
                                <form id="commentForm" method="POST" action="?controller=product&action=addComment" class="space-y-4">
                                    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['ID']); ?>">
                                    <div class="form-group">
                                        <label for="comment" class="sr-only">Bình luận</label>
                                        <textarea name="comment" id="comment" rows="4" required placeholder="Viết bình luận của bạn..." class="form-control"></textarea>
                                    </div>
                                    <button type="submit" class="btn-shopee">Gửi bình luận</button>
                                </form>
                            </div>
                        <?php else: ?>
                            <p class="text-gray-600 mb-4">Vui lòng <a href="?controller=auth&action=login" class="text-blue-600 hover:underline">đăng nhập</a> để gửi bình luận.</p>
                        <?php endif; ?>
                        <div class="comments">
                            <?php if (empty($comments)): ?>
                                <p class="text-gray-600 text-center">Chưa có bình luận nào.</p>
                            <?php else: ?>
                                <?php foreach ($comments as $index => $comment): ?>
                                    <div class="comment-item">
                                        <div class="comment-header">
                                            <div class="comment-avatar"><?php echo htmlspecialchars(substr($comment['name'] ?? $comment['username'] ?? 'Người dùng', 0, 1)); ?></div>
                                            <div>
                                                <p class="font-semibold"><?php echo htmlspecialchars($comment['name'] ?? $comment['username'] ?? 'Người dùng'); ?></p>
                                                <p class="comment-meta"><?php echo htmlspecialchars($comment['created_at'] ?? ''); ?></p>
                                            </div>
                                        </div>
                                        <p class="comment-content"><?php echo htmlspecialchars($comment['comment'] ?? ''); ?></p>
                                        <?php if (isset($_SESSION['user_id'])): ?>
                                            <div class="reply-toggle" data-comment-id="<?php echo htmlspecialchars($comment['ID']); ?>">
                                                <i class="fas fa-reply mr-1"></i> Trả lời
                                            </div>
                                            <div class="reply-form-container" id="reply-form-<?php echo htmlspecialchars($comment['ID']); ?>">
                                                <form class="replyForm" method="POST" action="?controller=product&action=addReply" class="space-y-2">
                                                    <input type="hidden" name="comment_id" value="<?php echo htmlspecialchars($comment['ID']); ?>">
                                                    <div class="form-group">
                                                        <textarea name="reply" rows="3" required placeholder="Viết trả lời của bạn..." class="form-control"></textarea>
                                                    </div>
                                                    <div class="flex justify-end space-x-2">
                                                        <button type="button" class="btn-cancel text-gray-600 hover:text-gray-800" onclick="toggleReplyForm('<?php echo htmlspecialchars($comment['ID']); ?>')">Hủy</button>
                                                        <button type="submit" class="btn-shopee">Gửi</button>
                                                    </div>
                                                </form>
                                            </div>
                                        <?php endif; ?>
                                        <div class="replies">
                                            <?php if (!empty($comment['replies'])): ?>
                                                <?php foreach ($comment['replies'] as $reply): ?>
                                                    <div class="reply-item">
                                                        <div class="comment-header">
                                                            <div class="comment-avatar"><?php echo htmlspecialchars(substr($reply['name'] ?? $reply['username'] ?? 'Người dùng', 0, 1)); ?></div>
                                                            <div>
                                                                <p class="font-semibold"><?php echo htmlspecialchars($reply['name'] ?? $reply['username'] ?? 'Người dùng'); ?></p>
                                                                <p class="comment-meta"><?php echo htmlspecialchars($reply['created_at'] ?? ''); ?></p>
                                                            </div>
                                                        </div>
                                                        <p class="comment-content"><?php echo htmlspecialchars($reply['reply'] ?? ''); ?></p>
                                                    </div>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <a href="?controller=product&action=index" class="mt-6 inline-block text-blue-600 hover:underline">Quay lại danh sách</a>
                <?php else: ?>
                    <p class="text-red-600 text-center">Sản phẩm không tồn tại.</p>
                <?php endif; ?>
            </div>
        </div>
        <div id="consultModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Liên hệ tư vấn</h2>
                <form id="consultForm" method="POST">
                    <input type="hidden" id="modalProductId" name="product_id">
                    <div>
                        <label for="name">Họ và tên:</label>
                        <input type="text" id="name" name="name" value="<?php echo isset($_SESSION['user']['name']) ? htmlspecialchars($_SESSION['user']['name']) : ''; ?>">
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
        <div class="col-xs-12 col-md-3" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
            <?php include 'detailList.php'; ?>
        </div>

    </div>
    <script>
        let currentIndex = 0;
        const carousel = document.querySelector('.carousel-inner');
        const slides = carousel ? carousel.children : [];
        const prevBtn = document.querySelector('.carousel-prev');
        const nextBtn = document.querySelector('.carousel-next');
        // const thumbnails = document.querySelectorAll('.carousel-thumbnails img');

        function showSlide(index) {
            const totalSlides = slides.length;
            if (index < 0) index = totalSlides - 1;
            if (index >= totalSlides) index = 0;

            currentIndex = index;

            carousel.style.transform = `translateX(-${index * 100}%)`;

            thumbnails.forEach((thumb, i) => {
                thumb.classList.toggle('active', i === index);
            });
        }

        if (prevBtn && nextBtn) {
            prevBtn.addEventListener('click', () => showSlide(currentIndex - 1));
            nextBtn.addEventListener('click', () => showSlide(currentIndex + 1));
        }

        thumbnails.forEach((thumb, index) => {
            thumb.addEventListener('click', () => showSlide(index));
        });

        if (slides.length > 0) showSlide(0);

        // Toggle reply form
        function toggleReplyForm(commentId) {
            const form = document.getElementById(`reply-form-${commentId}`);
            form.classList.toggle('active');
        }

        document.querySelectorAll('.reply-toggle').forEach(toggle => {
            toggle.addEventListener('click', () => {
                const commentId = toggle.getAttribute('data-comment-id');
                toggleReplyForm(commentId);
            });
        });

        // AJAX for forms
        // document.querySelectorAll('#reviewForm, #commentForm, .replyForm').forEach(form => {
        //     form.addEventListener('submit', async (e) => {
        //         e.preventDefault();
        //         const formData = new FormData(form);
        //         const action = form.getAttribute('action');

        //         try {
        //             const response = await fetch(action, {
        //                 method: 'POST',
        //                 body: formData
        //             });
        //             const result = await response.json();

        //             if (result.success) {
        //                 Swal.fire({
        //                     title: '✅ Thành công',
        //                     text: result.message || 'Gửi thành công!',
        //                     icon: 'success',
        //                     confirmButtonText: 'Đóng'
        //                 });

        //                 // Tuỳ chọn: reset form sau khi gửi
        //                 form.reset();
        //             } else {
        //                 Swal.fire({
        //                     title: '⚠️ Thất bại',
        //                     text: result.message || 'Vui lòng kiểm tra lại.',
        //                     icon: 'warning',
        //                     confirmButtonText: 'Đóng'
        //                 });
        //             }
        //         } catch (error) {
        //             console.error('Error:', error);
        //             Swal.fire({
        //                 title: '❌ Lỗi hệ thống',
        //                 text: 'Không thể gửi bình luận. Vui lòng thử lại sau.',
        //                 icon: 'error',
        //                 confirmButtonText: 'Đóng'
        //             });
        //         }
        //     });
        // });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('#reviewForm, #commentForm, .replyForm').forEach(form => {
                form.addEventListener('submit', async (e) => {
                    e.preventDefault(); // ⚠️ Ngăn chặn gửi mặc định
                    const formData = new FormData(form);
                    const action = form.getAttribute('action');

                    try {
                        const response = await fetch(action, {
                            method: 'POST',
                            body: formData
                        });

                        const result = await response.json();

                        if (result.success) {
                            Swal.fire({
                                title: '✅ Thành công',
                                text: result.message || 'Đã gửi thành công!',
                                icon: 'success',
                                confirmButtonText: 'Đóng'
                            });

                            // Tuỳ chọn reset form
                            form.reset();
                        } else {
                            Swal.fire({
                                title: '❌ Lỗi',
                                text: result.message || 'Đã xảy ra lỗi. Vui lòng thử lại.',
                                icon: 'error'
                            });
                        }
                    } catch (error) {
                        Swal.fire({
                            title: '❌ Lỗi hệ thống',
                            text: 'Không thể gửi yêu cầu. Vui lòng thử lại sau.',
                            icon: 'error'
                        });
                        console.error(error);
                    }
                });
            });
        });
    </script>

    <script>
        const thumbnails = document.querySelectorAll('.thumb-img');
        const mainImage = document.getElementById('mainImage');

        thumbnails.forEach((thumb) => {
            thumb.addEventListener('click', () => {
                const newSrc = thumb.getAttribute('data-full');
                mainImage.src = newSrc;

                thumbnails.forEach(t => t.classList.remove('active'));
                thumb.classList.add('active');
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const stars = document.querySelectorAll('.star-rating i');
            const ratingInput = document.querySelector('#rating');

            stars.forEach(star => {
                star.addEventListener('click', () => {
                    const value = star.getAttribute('data-value');
                    ratingInput.value = value;

                    stars.forEach(s => {
                        if (s.getAttribute('data-value') <= value) {
                            s.classList.remove('far');
                            s.classList.add('fas', 'active');
                        } else {
                            s.classList.remove('fas', 'active');
                            s.classList.add('far');
                        }
                    });
                });
            });
        });
    </script>
</body>

</html>