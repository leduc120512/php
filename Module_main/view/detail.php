<?php
// $product, $reviews, $comments, $averageRating được truyền từ ProductController::detail()
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Sản Phẩm</title>
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
    </style>
</head>

<body>
    <div class="product-container">
        <?php if (isset($_SESSION['error'])): ?>
            <p class="text-red-600 text-center mb-4"><?php echo htmlspecialchars($_SESSION['error']); ?></p>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <?php if (!empty($product)): ?>
            <div class="flex flex-col md:flex-row gap-6">
                <!-- Product Images -->
                <div class="md:w-1/2">
                    <h3 class="section-title">Ảnh sản phẩm</h3>
                    <div class="carousel-container">
                        <div class="carousel-inner flex transition-transform duration-500 ease-in-out">
                            <?php if (!empty($product['images'])): ?>
                                <?php foreach ($product['images'] as $index => $image): ?>
                                    <div class="carousel-item flex-none w-full text-center <?php echo $image['is_main'] ? 'main' : ''; ?>">
                                        <img src="../public/img/<?php echo htmlspecialchars($image['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="carousel-item flex-none w-full text-center">
                                    <img src="../public/img/placeholder.jpg" alt="No Image">
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php if (!empty($product['images']) && count($product['images']) > 1): ?>
                            <button class="carousel-prev"><i class="fas fa-chevron-left"></i></button>
                            <button class="carousel-next"><i class="fas fa-chevron-right"></i></button>
                        <?php endif; ?>
                    </div>
                    <div class="carousel-thumbnails">
                        <?php if (!empty($product['images'])): ?>
                            <?php foreach ($product['images'] as $index => $image): ?>
                                <img src="../public/img/<?php echo htmlspecialchars($image['image_url']); ?>" alt="Thumbnail" data-index="<?php echo $index; ?>" class="<?php echo $index === 0 ? 'active' : ''; ?>">
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Product Details -->
                <div class="md:w-1/2">
                    <h1 class="product-title"><?php echo htmlspecialchars($product['name']); ?></h1>
                    <p class="product-price"><?php echo number_format($product['price'], 0, ',', '.') . ' VND'; ?></p>
                    <p class="text-gray-600 mb-2"><strong>Số lượng:</strong> <?php echo htmlspecialchars($product['quantity']); ?></p>
                    <p class="text-gray-600 mb-2"><strong>Mô tả:</strong> <?php echo htmlspecialchars($product['description']); ?></p>
                    <p class="text-gray-600 mb-4"><strong>Ngày tạo:</strong> <?php echo htmlspecialchars($product['created_at']); ?></p>

                    <!-- Add to Cart -->
                    <form method="POST" action="?controller=order&action=addToCart" class="mt-4">
                        <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['ID']); ?>">
                        <button type="submit" class="btn-shopee">Thêm vào giỏ hàng</button>
                    </form>
                </div>
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
                        <div class="form-group">
                            <label for="rating">Đánh giá (1-5):</label>
                            <select name="rating" id="rating" required class="form-control">
                                <option value="" disabled selected>Chọn số sao</option>
                                <option value="1">1 sao</option>
                                <option value="2">2 sao</option>
                                <option value="3">3 sao</option>
                                <option value="4">4 sao</option>
                                <option value="5">5 sao</option>
                            </select>
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

    <script>
        // Carousel JavaScript
        const carousel = document.querySelector('.carousel-inner');
        const prevBtn = document.querySelector('.carousel-prev');
        const nextBtn = document.querySelector('.carousel-next');
        const thumbnails = document.querySelectorAll('.carousel-thumbnails img');
        let currentIndex = 0;

        function showSlide(index) {
            const totalSlides = carousel.children.length;
            if (index >= totalSlides) index = 0;
            if (index < 0) index = totalSlides - 1;
            currentIndex = index;
            carousel.style.transform = `translateX(-${currentIndex * 100}%)`;
            thumbnails.forEach((thumb, i) => {
                thumb.classList.toggle('active', i === currentIndex);
            });
        }

        if (prevBtn && nextBtn) {
            prevBtn.addEventListener('click', () => showSlide(currentIndex - 1));
            nextBtn.addEventListener('click', () => showSlide(currentIndex + 1));
            thumbnails.forEach((thumb, index) => {
                thumb.addEventListener('click', () => showSlide(index));
            });
        }

        showSlide(0);

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
        document.querySelectorAll('#reviewForm, #commentForm, .replyForm').forEach(form => {
            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                const formData = new FormData(form);
                const action = form.getAttribute('action');
                try {
                    const response = await fetch(action, {
                        method: 'POST',
                        body: formData
                    });
                    const result = await response.json();
                    alert(result.message || 'Thành công!');
                    if (result.success) {
                        window.location.reload();
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Đã có lỗi xảy ra. Vui lòng thử lại.');
                }
            });
        });
    </script>
</body>

</html>