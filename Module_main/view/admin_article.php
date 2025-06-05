<?php
// Second file
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    
    <div class="main">
        <div class="container mt-4">
            <h2>Manage Articles</h2>
            <!-- Rest of your content (table, forms, etc.) -->
            <?php
            $content = ob_get_clean();
            include 'Admin_fill.php';
            ?>

            <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success">
                    <?php
                    if ($_GET['success'] === 'added') echo 'Article added successfully!';
                    if ($_GET['success'] === 'updated') echo 'Article updated successfully!';
                    if ($_GET['success'] === 'deleted') echo 'Article deleted successfully!';
                    ?>
                </div>
            <?php endif; ?>

            <div class="mb-3">
                <a href="?controller=article&action=add" class="btn btn-primary">Add New Article</a>
            </div>

            <div class="mb-3">
                <form method="GET">
                    <input type="hidden" name="controller" value="article">
                    <input type="hidden" name="action" value="manage">
                    <select name="category_id" onchange="this.form.submit()">
                        <option value="">All Categories</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo $category['id']; ?>" <?php echo isset($_GET['category_id']) && $_GET['category_id'] == $category['id'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($category['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </form>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($articles as $article): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($article['title']); ?></td>
                            <td><?php echo htmlspecialchars($article['decription']); ?></td>
                            <td>
                                <?php if ($article['image_url']): ?>
                                    <img src="<?php echo htmlspecialchars($article['image_url']); ?>" alt="Article Image" width="100">
                                <?php endif; ?>
                            </td>
                            <td><?php echo $article['created_at']; ?></td>
                            <td>
                                <a href="?controller=article&action=edit&id=<?php echo $article['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="?controller=article&action=delete&id=<?php echo $article['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this article?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>