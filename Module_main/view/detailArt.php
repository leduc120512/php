<?php
require_once __DIR__ . '/../Format/description_formatter.php';

?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Bài Báo - <?php echo htmlspecialchars($article['title'] ?? 'Bài báo'); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5f5;
        }

        .article-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .article-title {
            font-size: 28px;
            font-weight: 700;
            color: #333;
            margin-bottom: 15px;
        }

        .article-meta {
            font-size: 14px;
            color: #666;
            margin-bottom: 15px;
        }

        .article-image {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .article-content {
            font-size: 16px;
            line-height: 1.6;
            color: #333;
            margin-bottom: 20px;
        }

        .article-description {
            font-size: 14px;
            color: #555;
            margin-bottom: 15px;
            font-style: italic;
        }

        .article-note {
            font-size: 14px;
            color: #777;
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 500;
            color: #333;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        .btn-back {
            display: inline-block;
            background-color: #ee4d2d;
            color: #fff;
            padding: 10px 20px;
            border-radius: 4px;
            font-weight: 500;
            transition: background-color 0.3s;
            text-decoration: none;
        }

        .btn-back:hover {
            background-color: #d43d1e;
        }

        @media (max-width: 768px) {
            .article-container {
                padding: 15px;
            }

            .article-title {
                font-size: 24px;
            }

            .article-image {
                max-height: 300px;
            }

            .article-content {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="article-container">
        <?php if (isset($_SESSION['error'])): ?>
            <p class="text-red-600 text-center mb-4"><?php echo htmlspecialchars($_SESSION['error']); ?></p>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <?php if (!empty($article)): ?>
            <!-- Article Details -->
            <h1 class="article-title"><?php echo htmlspecialchars($article['title']); ?></h1>
            <div class="article-meta">
                <span><i class="fas fa-user"></i> <?php echo htmlspecialchars($article['author'] ?? 'Không rõ tác giả'); ?></span> |
                <span><i class="fas fa-calendar-alt"></i> <?php echo date('d/m/Y H:i', strtotime($article['created_at'])); ?></span>
                <?php if (!empty($article['updated_at'])): ?>
                    | <span><i class="fas fa-edit"></i> Cập nhật: <?php echo date('d/m/Y H:i', strtotime($article['updated_at'])); ?></span>
                <?php endif; ?>
            </div>

            <?php if (!empty($article['image_url'])): ?>
                <img src="<?php echo htmlspecialchars($article['image_url']); ?>" alt="<?php echo htmlspecialchars($article['title']); ?>" class="article-image">
            <?php else: ?>
                <img src="placeholder.jpg" alt="No Image" class="article-image">
            <?php endif; ?>

            <?php if (!empty($article['decription'])): ?>
                <div class="section-title">Mô tả</div>
                <div class="article-description">
                    <?php echo formatDescription($article['decription']); ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($article['content'])): ?>
                <div class="section-title">Nội dung</div>
                <div class="article-content">
                    <?php echo formatDescription($article['content']); ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($article['note'])): ?>
                <div class="section-title">Ghi chú</div>
                <div class="article-note">
                    <?php echo formatDescription($article['note']); ?>
                </div>
            <?php endif; ?>

            <a href="?controller=article&action=index" class="btn-back mt-6">Quay lại danh sách bài báo</a>
        <?php else: ?>
            <p class="text-red-600 text-center">Bài báo không tồn tại.</p>
        <?php endif; ?>
    </div>

</body>

</html>