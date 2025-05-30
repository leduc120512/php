<?php
require_once '../view/templates/header.php';
?>

<div class="container mt-5">
    <h2>Sửa bài báo</h2>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?php echo $_SESSION['error'];
                                        unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <form action="?controller=article&action=edit&id=<?php echo htmlspecialchars($article['ID']); ?>" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Tiêu đề</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($article['title']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Nội dung</label>
            <textarea class="form-control" id="content" name="content" rows="10" required><?php echo htmlspecialchars($article['content']); ?></textarea>
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Tác giả</label>
            <input type="text" class="form-control" id="author" name="author" value="<?php echo htmlspecialchars($article['author']); ?>">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Mô tả</label>
            <input type="text" class="form-control" id="description" name="description" value="<?php echo htmlspecialchars($article['description']); ?>">
        </div>
        <div class="mb-3">
            <label for="note" class="form-label">Ghi chú</label>
            <input type="text" class="form-control" id="note" name="note" value="<?php echo htmlspecialchars($article['note']); ?>">
        </div>
        <div class="mb-3">
            <label for="img" class="form-label">Ảnh đại diện</label>
            <input type="file" class="form-control" id="img" name="img" accept="image/*">
            <?php if ($article['image_url']): ?>
                <img src="../public/img/<?php echo htmlspecialchars($article['image_url']); ?>" alt="Current Image" width="100" class="mt-2">
            <?php endif; ?>
        </div>
        <button type="submit" name="update_article" class="btn btn-primary">Cập nhật</button>
        <a href="?controller=article&action=manage" class="btn btn-secondary">Hủy</a>
    </form>
</div>

<?php
require_once '../view/templates/footer.php';
?>