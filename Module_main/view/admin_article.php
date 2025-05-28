<?php
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ?controller=auth&action=login");
    exit;
}
$processes = isset($processes) ? $processes : [];
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý giai đoạn chăn nuôi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            margin-top: 20px;
        }

        .alert {
            margin-bottom: 20px;
        }

        .action-buttons a,
        .action-buttons form {
            display: inline-block;
        }

        .action-buttons form button {
            margin-left: 5px;
        }

        .image-preview {
            max-width: 100px;
            max-height: 100px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="mb-4">Danh sách giai đoạn chăn nuôi</h2>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?php echo $_SESSION['success'];
                unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?php echo $_SESSION['error'];
                unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <a href="?controller=farming_process&action=add" class="btn btn-primary mb-3">Thêm giai đoạn mới</a>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Tiêu đề</th>
                    <th>Mô tả</th>
                    <th>Thứ tự</th>
                    <th>Ngày bắt đầu</th>
                    <th>Ngày kết thúc</th>
                    <th>Ghi chú</th>
                    <th>Hình ảnh</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($processes)): ?>
                    <tr>
                        <td colspan="9" class="text-center">Không có giai đoạn chăn nuôi nào.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($processes as $process): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($process['ID']); ?></td>
                            <td><?php echo htmlspecialchars($process['title']); ?></td>
                            <td><?php echo htmlspecialchars($process['description'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($process['process_order']); ?></td>
                            <td><?php echo htmlspecialchars($process['start_day']); ?></td>
                            <td><?php echo htmlspecialchars($process['end_day']); ?></td>
                            <td><?php echo htmlspecialchars($process['note'] ?? ''); ?></td>
                            <td>
                                <?php if (!empty($process['image_url'])): ?>
                                    <img src="<?php echo htmlspecialchars($process['image_url']); ?>" alt="Hình ảnh" class="image-preview">
                                <?php else: ?>
                                    Không có hình
                                <?php endif; ?>
                            </td>
                            <td class="action-buttons">
                                <a href="?controller=farming_process&action=edit&id=<?php echo $process['ID']; ?>" class="btn btn-sm btn-warning">Sửa</a>
                                <form action="?controller=farming_process&action=delete&id=<?php echo $process['ID']; ?>" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa giai đoạn này?');">
                                    <button type="submit" class="btn btn-sm btn-danger">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>