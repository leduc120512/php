<?php
require_once '../view/templates/header.php';
?>

<div class="container mt-5">
    <h2>Thêm bài báo mới</h2>

    <form id="addArticleForm" action="?controller=article&action=add" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Tiêu đề</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Nội dung</label>
            <textarea class="form-control" id="content" name="content" rows="10" required></textarea>
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Tác giả</label>
            <input type="text" class="form-control" id="author" name="author">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Mô tả</label>
            <input type="text" class="form-control" id="description" name="description">
        </div>
        <div class="mb-3">
            <label for="note" class="form-label">Ghi chú</label>
            <input type="text" class="form-control" id="note" name="note">
        </div>
        <div class="mb-3">
            <label for="img" class="form-label">Ảnh đại diện</label>
            <input type="file" class="form-control" id="img" name="img" accept="image/*">
        </div>
        <button type="submit" name="add_article" class="btn btn-primary">Thêm bài báo</button>
        <a href="?controller=article&action=manage" class="btn btn-secondary">Hủy</a>
    </form>

    <!-- Hiển thị thông báo từ AJAX -->
    <div id="responseMessage" class="mt-3"></div>
</div>

<script>
    document.getElementById('addArticleForm').addEventListener('submit', function(e) {
        e.preventDefault();
        let formData = new FormData(this);

        fetch('?controller=article&action=add', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                let responseMessage = document.getElementById('responseMessage');
                responseMessage.innerHTML = `<div class="alert alert-${data.success ? 'success' : 'danger'}">${data.message}</div>`;
                if (data.success) {
                    this.reset();
                    setTimeout(() => {
                        window.location.href = '?controller=article&action=manage';
                    }, 2000);
                }
            })
            .catch(error => {
                document.getElementById('responseMessage').innerHTML = '<div class="alert alert-danger">Đã xảy ra lỗi khi gửi yêu cầu.</div>';
                console.error('Error:', error);
            });
    });
</script>

<?php
require_once '../view/templates/footer.php';
?>