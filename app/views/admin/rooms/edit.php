<?php require_once ROOT . '/app/views/templates/header.php'; ?>

    <div class="form-container">
        <h1>Редагувати номер: <?= htmlspecialchars($room['name'] ?? 'Новий номер') ?></h1>

        <?php require_once '_form.php'; ?>
    </div>

<?php require_once ROOT . '/app/views/templates/footer.php'; ?>