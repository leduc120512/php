<?php
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ?controller=auth&action=login");
    exit;
}
$process = isset($process) ? $process : [];
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa giai đoạn chăn nuôi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h2>Chỉnh sửa giai đoạn chăn nuôi</h2>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?php echo $_SESSION['error'];
                unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>
        <form action="?controller=farming_process&action=edit&id=<?php echo $process['ID']; ?>" method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Tiêu đề</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($process['title']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Mô tả</label>
                <textarea class="form-control" id="description" name="description"><?php echo htmlspecialchars($process['description'] ?? ''); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="process_order" class="form-label">Thứ tự quy trình</label>
                <input type="number" class="form-control" id="process_order" name="process_order" value="<?php echo htmlspecialchars($process['process_order']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="start_day" class="form-label">Ngày bắt đầu</label>
                <input type="number" class="form-control" id="start_day" name="start_day" value="<?php echo htmlspecialchars($process['start_day']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="end_day" class="form-label">Ngày kết thúc</label>
                <input type="number" class="form-control" id="end_day" name="end_day" value="<?php echo htmlspecialchars($process['end_day']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="note" class="form-label">Ghi chú</label>
                <textarea class="form-control" id="note" name="note"><?php echo htmlspecialchars($process['note'] ?? ''); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="image_url" class="form-label">URL hình ảnh</label>
                <input type="url" class="form-control" id="image_url" name="image_url" value="<?php echo htmlspecialchars($process['image_url'] ?? ''); ?>">
                <?php if (!empty($process['image_url'])): ?>
                    <img src="<?php echo htmlspecialchars($process['image_url']); ?>" alt="Hình ảnh" class="image-preview mt-2" style="max-width: 100px; max-height: 100px;">
                <?php endif; ?>
            </div>
            <button type="submit" name="update_farming_process" class="btn btn-primary">Cập nhật</button>
            <a href="?controller=farming_process&action=manage" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>