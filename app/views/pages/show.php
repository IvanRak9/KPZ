<?php require_once ROOT . '/app/views/templates/header.php'; ?>
<?php extract($data); ?>

    <article class="static-page">
        <h1><?= htmlspecialchars($data['page']['title']) ?></h1>
        <div class="page-content">
            <?= nl2br(htmlspecialchars($data['page']['content']))?>
        </div>
    </article>

<?php require_once ROOT . '/app/views/templates/footer.php'; ?>