<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Art Category List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Art Categories</h2>
        <div class="row mb-3">
            <div class="col-md-6">
                <form action="?controller=category_art&action=index" method="GET" class="input-group">
                    <input type="hidden" name="controller" value="category_art">
                    <input type="hidden" name="action" value="index">
                    <input type="text" name="search" class="form-control" placeholder="Search by name" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
            <div class="col-md-6 text-end">
                <a href="?controller=category_art&action=create_category" class="btn btn-primary">Add New Art Category</a>
                <a href="?controller=category_art&action=index&top_only=1" class="btn btn-secondary">Show Top Categories Only</a>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Top</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $category): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($category['id']); ?></td>
                        <td><?php echo htmlspecialchars($category['name']); ?></td>
                        <td><?php echo htmlspecialchars($category['description']); ?></td>
                        <td><?php echo $category['top'] ? 'Yes' : 'No'; ?></td>
                        <td><?php echo htmlspecialchars($category['created_at']); ?></td>
                        <td>
                            <a href="?controller=category_art&action=edit_category&id=<?php echo htmlspecialchars($category['id'] ?? ''); ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="?controller=category_art&action=delete_category&id=<?php echo htmlspecialchars($category['id'] ?? ''); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>