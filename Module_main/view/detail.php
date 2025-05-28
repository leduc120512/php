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
    <style>
        .carousel-item img {
            border: 2px solid transparent;
        }

        .carousel-item.main img {
            border: 2px solid #3b82f6;
        }

        .carousel-thumbnails img.active {
            border: 2px solid #3b82f6;
            opacity: 1;
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="max-w-4xl mx-auto my-8 p-6 bg-white rounded-lg shadow-lg">
        <?php if (isset($_SESSION['error'])): ?>
            <p class="text-red-600 text-center mb-4"><?php echo htmlspecialchars($_SESSION['error']);
                                                        unset($_SESSION['error']); ?></p>
        <?php endif; ?>

        <?php if ($product): ?>
            <h1 class="text-3xl font-bold mb-4"><?php echo htmlspecialchars($product['name']); ?></h1>
            <p class="text-2xl font-semibold text-red-600 mb-2"><?php echo number_format($product['price'], 0, ',', '.') . ' VND'; ?></p>
            <p class="text-gray-600 mb-2"><strong>Số lượng:</strong> <?php echo htmlspecialchars($product['quantity']); ?></p>
            <p class="text-gray-600 mb-2"><strong>Mô tả:</strong> <?php echo htmlspecialchars($product['description']); ?></p>
            <p class="text-gray-600 mb-4"><strong>Ngày tạo:</strong> <?php echo htmlspecialchars($product['created_at']); ?></p>

            <!-- Carousel Ảnh -->
            <h3 class="text-xl font-semibold mb-2">Ảnh sản phẩm</h3>
            <div class="relative">
                <div class="carousel-inner flex transition-transform duration-500 ease-in-out">
                    <?php if (!empty($product['images'])): ?>
                        <?php foreach ($product['images'] as $index => $image): ?>
                            <div class="carousel-item flex-none w-full text-center <?php echo $image['is_main'] ? 'main' : ''; ?>">
                                <img src="../public/img/<?php echo htmlspecialchars($image['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="max-w-full h-auto rounded-lg">
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="carousel-item flex-none w-full text-center">
                            <img src="../public/img/placeholder.jpg" alt="No Image" class="max-w-full h-auto rounded-lg">
                        </div>
                    <?php endif; ?>
                </div>
                <?php if (!empty($product['images']) && count($product['images']) > 1): ?>
                    <button class="carousel-prev absolute top-1/2 left-2 transform -translate-y-1/2 bg-gray-800 text-white px-4 py-2 rounded-full">❮</button>
                    <button class="carousel-next absolute top-1/2 right-2 transform -translate-y-1/2 bg-gray-800 text-white px-4 py-2 rounded-full">❯</button>
                <?php endif; ?>
            </div>
            <div class="carousel-thumbnails flex justify-center gap-2 mt-4">
                <?php if (!empty($product['images'])): ?>
                    <?php foreach ($product['images'] as $index => $image): ?>
                        <img src="../public/img/<?php echo htmlspecialchars($image['image_url']); ?>" alt="Thumbnail" data-index="<?php echo $index; ?>" class="w-16 h-16 object-cover rounded-lg cursor-pointer opacity-60 <?php echo $index === 0 ? 'active' : ''; ?>">
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- Nút Thêm vào Giỏ hàng -->
            <form method="POST" action="?controller=order&action=addToCart" class="mt-4">
                <input type="hidden" name="product_id" value="<?php echo $product['ID']; ?>">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">Thêm vào giỏ hàng</button>
            </form>

            <!-- Đánh giá sản phẩm -->
            <h3 class="text-xl font-semibold mt-6 mb-2">Đánh giá sản phẩm</h3>
            <p class="text-gray-600">
                <strong>Đánh giá trung bình:</strong>
                <?php
                $rating = isset($averageRating['average_rating']) && is_numeric($averageRating['average_rating'])
                    ? number_format($averageRating['average_rating'], 1)
                    : '0.0';
                $total_reviews = isset($averageRating['total_reviews']) ? $averageRating['total_reviews'] : 0;
                echo "$rating / 5 ($total_reviews đánh giá)";
                ?>
            </p>
            <?php if (isset($_SESSION['user_id'])): ?>
                <div class="mt-4">
                    <form id="reviewForm" method="POST" action="?controller=product&action=addReview" class="space-y-4">
                        <input type="hidden" name="product_id" value="<?php echo $product['ID']; ?>">
                        <div>
                            <label for="rating" class="block text-gray-700">Đánh giá (1-5):</label>
                            <select name="rating" id="rating" required class="w-full p-2 border rounded-lg">
                                <option value="" disabled selected>Chọn số sao</option>
                                <option value="1">1 sao</option>
                                <option value="2">2 sao</option>
                                <option value="3">3 sao</option>
                                <option value="4">4 sao</option>
                                <option value="5">5 sao</option>
                            </select>
                        </div>
                        <div>
                            <label for="comment" class="block text-gray-700">Bình luận:</label>
                            <textarea name="comment" id="comment" rows="4" placeholder="Viết đánh giá của bạn..." class="w-full p-2 border rounded-lg"></textarea>
                        </div>
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">Gửi đánh giá</button>
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
                        <div class="border-b py-4">
                            <p class="font-semibold"><?php echo htmlspecialchars($review['name'] ?: $review['username']); ?> -
                                <span class="text-yellow-400"><?php echo str_repeat('★', $review['rating']) . str_repeat('☆', 5 - $review['rating']); ?></span>
                            </p>
                            <p class="text-gray-600"><?php echo htmlspecialchars($review['comment'] ?: 'Không có bình luận'); ?></p>
                            <p class="text-sm text-gray-500"><?php echo htmlspecialchars($review['created_at']); ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- Bình luận sản phẩm -->
            <h3 class="text-xl font-semibold mt-6 mb-2">Bình luận sản phẩm</h3>
            <?php if (isset($_SESSION['user_id'])): ?>
                <div class="mt-4">
                    <form id="commentForm" method="POST" action="?controller=product&action=addComment" class="space-y-4">
                        <input type="hidden" name="product_id" value="<?php echo $product['ID']; ?>">
                        <div>
                            <label for="comment" class="block text-gray-700">Bình luận:</label>
                            <textarea name="comment" id="comment" rows="4" required placeholder="Viết bình luận của bạn..." class="w-full p-2 border rounded-lg"></textarea>
                        </div>
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">Gửi bình luận</button>
                    </form>
                </div>
            <?php else: ?>
                <p class="text-gray-600 mt-2">Vui lòng <a href="?controller=auth&action=login" class="text-blue-600 hover:underline">đăng nhập</a> để gửi bình luận.</p>
            <?php endif; ?>
            <div class="comments mt-4">
                <?php if (empty($comments)): ?>
                    <p class="text-gray-600">Chưa có bình luận nào.</p>
                <?php else: ?>
                    <?php foreach ($comments as $comment): ?>
                        <div class="border-b py-4">
                            <p class="font-semibold"><?php echo htmlspecialchars($comment['name'] ?: $comment['username']); ?></p>
                            <p class="text-gray-600"><?php echo htmlspecialchars($comment['comment']); ?></p>
                            <p class="text-sm text-gray-500"><?php echo htmlspecialchars($comment['created_at']); ?></p>
                            <!-- Form trả lời -->
                            <?php if (isset($_SESSION['user_id'])): ?>
                                <div class="mt-2">
                                    <form class="replyForm" method="POST" action="?controller=product&action=addReply" class="space-y-2">
                                        <input type="hidden" name="comment_id" value="<?php echo $comment['ID']; ?>">
                                        <textarea name="reply" rows="2" required placeholder="Viết trả lời của bạn..." class="w-full p-2 border rounded-lg"></textarea>
                                        <button type="submit" class="bg-blue-600 text-white px-4 py-1 rounded-lg hover:bg-blue-700">Trả lời</button>
                                    </form>
                                </div>
                            <?php endif; ?>
                            <div class="replies ml-6 mt-2">
                                <?php foreach ($comment['replies'] as $reply): ?>
                                    <div class="border-l-2 border-blue-500 pl-4 py-2">
                                        <p class="font-semibold"><?php echo htmlspecialchars($reply['name'] ?: $reply['username']); ?></p>
                                        <p class="text-gray-600"><?php echo htmlspecialchars($reply['reply']); ?></p>
                                        <p class="text-sm text-gray-500"><?php echo htmlspecialchars($reply['created_at']); ?></p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
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

        // AJAX cho các form
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
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    const result = await response.json();
                    alert(result.message);
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