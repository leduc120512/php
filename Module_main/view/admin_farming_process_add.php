<div class="container mt-4">
    <h2>Add New Farming Process</h2>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="5"></textarea>
        </div>
        <div class="mb-3">
            <label for="process_order" class="form-label">Process Order</label>
            <input type="number" class="form-control" id="process_order" name="process_order" min="0" required>
        </div>
        <div class="mb-3">
            <label for="start_day" class="form-label">Start Day</label>
            <input type="number" class="form-control" id="start_day" name="start_day" min="0" required>
        </div>
        <div class="mb-3">
            <label for="end_day" class="form-label">End Day</label>
            <input type="number" class="form-control" id="end_day" name="end_day" min="0" required>
        </div>
        <div class="mb-3">
            <label for="note" class="form-label">Note</label>
            <input type="text" class="form-control" id="note" name="note">
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select class="form-control" id="category_id" name="category_id">
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category['id']; ?>"><?php echo htmlspecialchars($category['name']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
        </div>
        <div class="mb-3">
            <label for="video" class="form-label">Video</label>
            <input type="file" class="form-control" id="video" name="video" accept="video/*">
        </div>
        <button type="submit" class="btn btn-primary">Add Process</button>
    </form>
</div>