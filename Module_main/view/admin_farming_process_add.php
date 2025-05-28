<?php
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ?controller=auth&action=login");
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm giai đoạn chăn nuôi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h2>Thêm giai đoạn chăn nuôi</h2>

        <!-- Hiển thị thông báo nếu có -->
        <div id="message"></div>

        <form id="addFarmingProcessForm" action="?controller=farming_process&action=add" method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Tiêu đề</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Mô tả</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>
            <div class="mb-3">
                <label for="process_order" class="form-label">Thứ tự quy trình</label>
                <input type="number" class="form-control" id="process_order" name="process_order" required>
            </div>
            <div class="mb-3">
                <label for="start_day" class="form-label">Ngày bắt đầu</label>
                <input type="number" class="form-control" id="start_day" name="start_day" required>
            </div>
            <div class="mb-3">
                <label for="end_day" class="form-label">Ngày kết thúc</label>
                <input type="number" class="form-control" id="end_day" name="end_day" required>
            </div>
            <div class="mb-3">
                <label for="note" class="form-label">Ghi chú</label>
                <textarea class="form-control" id="note" name="note"></textarea>
            </div>
            <div class="mb-3">
                <label for="image_url" class="form-label">URL hình ảnh</label>
                <input type="url" class="form-control" id="image_url" name="image_url">
            </div>
            <button type="submit" name="add_farming_process" class="btn btn-primary">Thêm</button>
            <a href="?controller=farming_process&action=manage" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sử dụng AJAX để gửi form và hiển thị thông báo
        document.getElementById('addFarmingProcessForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Ngăn form gửi theo cách thông thường

            const form = this;
            const formData = new FormData(form);
            const messageDiv = document.getElementById('message');

            fetch(form.action, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        messageDiv.innerHTML = `<div class="alert alert-success">${data.message}</div>`;
                        // Chuyển hướng về trang quản lý sau 2 giây
                        setTimeout(() => {
                            window.location.href = '?controller=farming_process&action=manage';
                        }, 2000);
                    } else {
                        messageDiv.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
                    }
                })
                .catch(error => {
                    messageDiv.innerHTML = `<div class="alert alert-danger">Đã xảy ra lỗi: ${error.message}</div>`;
                });
        });
    </script>
</body>

</html>