<?php
require_once __DIR__ . '/../Format/description_formatter.php';

?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Giai Đoạn Nuôi Trồng - <?php echo htmlspecialchars($farmingProcess['title'] ?? 'Giai đoạn'); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5f5;
        }

        .process-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .process-title {
            font-size: 28px;
            font-weight: 700;
            color: #333;
            margin-bottom: 15px;
        }

        .process-meta {
            font-size: 14px;
            color: #666;
            margin-bottom: 15px;
        }

        .process-image {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .process-video {
            width: 100%;
            max-height: 400px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .process-description {
            font-size: 16px;
            line-height: 1.6;
            color: #333;
            margin-bottom: 20px;
        }

        .process-note {
            font-size: 14px;
            color: #777;
            margin-bottom: 20px;
        }

        .process-details {
            font-size: 14px;
            color: #333;
            margin-bottom: 15px;
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
            .process-container {
                padding: 15px;
            }

            .process-title {
                font-size: 24px;
            }

            .process-image,
            .process-video {
                max-height: 300px;
            }

            .process-description {
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="process-container">
        <?php if (isset($_SESSION['error'])): ?>
            <p class="text-red-600 text-center mb-4"><?php echo htmlspecialchars($_SESSION['error']); ?></p>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <?php if (!empty($farmingProcess)): ?>
            <!-- Farming Process Details -->
            <h1 class="process-title"><?php echo htmlspecialchars($farmingProcess['title']); ?></h1>
            <div class="process-meta">
                <span><i class="fas fa-calendar-alt"></i> Ngày tạo: <?php echo date('d/m/Y H:i', strtotime($farmingProcess['created_at'])); ?></span>
                <?php if (!empty($farmingProcess['category_id'])): ?>
                    | <span><i class="fas fa-tag"></i> Danh mục ID: <?php echo htmlspecialchars($farmingProcess['category_id']); ?></span>
                <?php endif; ?>
            </div>

            <div class="process-details">
                <p><strong>Thứ tự thực hiện:</strong> <?php echo htmlspecialchars($farmingProcess['process_order'] ?? 'Không xác định'); ?></p>
                <p><strong>Thời gian bắt đầu:</strong> Ngày <?php echo htmlspecialchars($farmingProcess['start_day'] ?? 'Không xác định'); ?></p>
                <p><strong>Thời gian kết thúc:</strong> Ngày <?php echo htmlspecialchars($farmingProcess['end_day'] ?? 'Không xác định'); ?></p>
            </div>

            <?php if (!empty($farmingProcess['image_url'])): ?>
                <img src="<?php echo htmlspecialchars($farmingProcess['image_url']); ?>" alt="<?php echo htmlspecialchars($farmingProcess['title']); ?>" class="process-image">
            <?php else: ?>

            <?php endif; ?>

            <?php if (!empty($farmingProcess['video_url'])): ?>
                <video controls class="process-video">
                    <source src="../public/videos/<?php echo htmlspecialchars($farmingProcess['video_url']); ?>" type="video/mp4">
                    Trình duyệt của bạn không hỗ trợ video.
                </video>
            <?php endif; ?>

            <?php if (!empty($farmingProcess['description'])): ?>
                <div class="section-title">Mô tả</div>
                <div class="process-description">
                    <?php echo formatDescription($farmingProcess['description']); ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($farmingProcess['note'])): ?>
                <div class="section-title">Ghi chú</div>
                <p class="process-note"><?php echo formatDescription($farmingProcess['note']); ?></p>
            <?php endif; ?>

            <a href="?controller=farmingProcess&action=index" class="btn-back mt-6">Quay lại danh sách giai đoạn</a>
        <?php else: ?>
            <p class="text-red-600 text-center">Giai đoạn nuôi trồng không tồn tại.</p>
        <?php endif; ?>
    </div>

</body>

</html>