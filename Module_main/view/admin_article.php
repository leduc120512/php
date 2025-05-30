<div class="container mt-5">
    <h2>Quản lý bài báo</h2>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?php echo $_SESSION['success'];
                                            unset($_SESSION['success']); ?></div>
    <?php endif; ?>
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?php echo $_SESSION['error'];
                                        unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <a href="?controller=article&action=add" class="btn btn-primary mb-3">Thêm bài báo mới</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tiêu đề</th>
                <th>Tác giả</th>
                <th>Mô tả</th>
                <th>Ghi chú</th>
                <th>Ảnh</th>
                <th>Ngày tạo</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($articles)): ?>
                <?php foreach ($articles as $article): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($article['ID']); ?></td>
                        <td><?php echo htmlspecialchars($article['title']); ?></td>
                        <td><?php echo htmlspecialchars($article['author']); ?></td>
                        <td><?php echo htmlspecialchars($article['description']); ?></td>
                        <td><?php echo htmlspecialchars($article['note']); ?></td>
                        <td>
                            <?php if ($article['image_url']): ?>
                                <img src="../public/img/<?php echo htmlspecialchars($article['image_url']); ?>" alt="Article Image" width="100">
                            <?php else: ?>
                                Không có ảnh
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($article['created_at']); ?></td>
                        <td>
                            <a href="?controller=article&action=edit&id=<?php echo $article['ID']; ?>" class="btn btn-sm btn-warning">Sửa</a>
                            <!-- Thêm nút xóa nếu cần -->
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" class="text-center">Không có bài báo nào.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

