<?php require_once ROOT . '/app/views/templates/header.php'; ?>
<?php require_once ROOT . '/app/views/admin/partials/admin_nav.php';?>

    <div class="container">
        <h1>Панель адміністрування</h1>
        <p>Вітаємо, <?= htmlspecialchars($_SESSION['username']) ?>!</p>
        <p>Тут ви можете керувати номерами, бронюваннями та іншим контентом сайту.</p>

        <ul>
            <li><a href="<?= BASE_URL ?>adminrooms">Керувати номерами</a></li>
            <li><a href="<?= BASE_URL ?>adminbookings">Керувати бронюваннями</a></li>
            <li><a href="<?= BASE_URL ?>adminpages">Керувати сторінками</a></li>
            <li><a href="<?= BASE_URL ?>adminreviews">Модерувати відгуки</a></li>
        </ul>

        <br>
        <a href="<?= BASE_URL ?>" class="button">Перейти на сайт (режим користувача)</a>
    </div>

<?php require_once ROOT . '/app/views/templates/footer.php'; ?>