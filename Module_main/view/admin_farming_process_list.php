<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php include 'Admin_fill.php'; ?>
    <div class="container mt-4" style="background-color: white;">
        <h2>Manage Farming Processes</h2>

        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success">
                <?php
                if ($_GET['success'] === 'added') echo 'Farming process added successfully!';
                if ($_GET['success'] === 'updated') echo 'Farming process updated successfully!';
                if ($_GET['success'] === 'deleted') echo 'Farming process deleted successfully!';
                ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger">
                <?php
                if ($_GET['error'] === 'notfound') echo 'Farming process not found!';
                if ($_GET['error'] === 'delete_failed') echo 'Failed to delete farming process!';
                ?>
            </div>
        <?php endif; ?>

        <div class="mb-3">
            <a href="?controller=farming_process&action=add" class="btn btn-primary">Add New Process</a>
        </div>

        <div class="mb-3">
            <form method="GET">
                <input type="hidden" name="controller" value="farming_process">
                <input type="hidden" name="action" value="manage">
                <select name="category_id" onchange="this.form.submit()">
                    <option value="">All Categories</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo htmlspecialchars($category['id'] ?? ''); ?>" <?php echo isset($_GET['category_id']) && $_GET['category_id'] == ($category['id'] ?? '') ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($category['name'] ?? ''); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Order</th>
                    <th>Duration (Days)</th>
                    <th>Image</th>
                    <th>Video</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($processes as $process): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($process['ID'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($process['title'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($process['description'] ?? ''); ?></td>
                        <td><?php echo isset($process['process_order']) ? $process['process_order'] : 'N/A'; ?></td>
                        <td>
                            <?php
                            $start_day = isset($process['start_day']) ? $process['start_day'] : 'N/A';
                            $end_day = isset($process['end_day']) ? $process['end_day'] : 'N/A';
                            echo "$start_day - $end_day";
                            ?>
                        </td>
                        <td>
                            <?php if (!empty($process['image_url'])): ?>
                                <img src="<?php echo htmlspecialchars($process['image_url']); ?>" alt="Process Image" width="100">
                            <?php else: ?>
                                No Image
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if (!empty($process['video_url'])): ?>
                                <video width="100" controls>
                                    <source src="<?php echo htmlspecialchars($process['video_url']); ?>" type="video/mp4">
                                </video>
                            <?php else: ?>
                                No Video
                            <?php endif; ?>
                        </td>
                        <td><?php echo isset($process['created_at']) ? $process['created_at'] : 'N/A'; ?></td>
                        <td>
                            <a href="?controller=farming_process&action=edit&id=<?php echo isset($process['ID']) ? $process['ID'] : ''; ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="?controller=farming_process&action=delete&id=<?php echo isset($process['ID']) ? $process['ID'] : ''; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this farming process?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>