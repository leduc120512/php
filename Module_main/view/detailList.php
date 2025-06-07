<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .related-item {
        border-bottom: 1px solid #e0e0e0;
        padding-bottom: 10px;
    }

    .related-img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 4px;
    }

    .related-title {
        font-size: 16px;
        color: #0056b3;
        text-decoration: none;
    }

    .related-title:hover {
        text-decoration: underline;
    }
</style>

<body>
    <section id="farming-process" class="section-padding pt-0">
        <div class="container-lg">
            <div class="row">
                <div class="section-header mb-3">
                    <h2 class="section-title text-success">Quy trình chăn nuôi</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="related-list">
                        <?php foreach ($categoryFmProductsone as $process): ?>
                            <div class="related-item d-flex align-items-start mb-3">
                                <a href="/SHOPGA/Module_main/public/index.php?controller=farming_process&action=detail_fm&id=<?= htmlspecialchars($process['ID']) ?>">
                                    <img src="<?= htmlspecialchars($process['image_url'] ?? '/public/img/default.jpg') ?>"
                                        alt="<?= htmlspecialchars($process['title']) ?>"
                                        class="related-img me-3" />
                                </a>
                                <div>
                                    <a href="/SHOPGA/Module_main/public/index.php?controller=farming_process&action=detail_fm&id=<?= htmlspecialchars($process['ID']) ?>"
                                        class="related-title text-primary fw-bold d-block">
                                        <?= htmlspecialchars($process['title']) ?>
                                    </a>
                                    <small class="text-muted"><?= date("d/m/Y", strtotime($process['created_at'] ?? 'now')) ?></small>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

</html>