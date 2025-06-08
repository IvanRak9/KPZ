<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Бронювання готелю' ?></title>
    <link rel="stylesheet" href="<?= BASE_URL ?>public/css/style.css">
    <script>const BASE_URL = '<?= BASE_URL ?>';</script>

</head>
<body>
<header>
    <nav>
        <a href="<?= BASE_URL ?>">Головна</a>
        <a href="<?= BASE_URL ?>rooms">Номери</a>
        <a href="<?= BASE_URL ?>reviews/index">Відгуки</a>

        <?php if (!empty($pages_for_menu) && is_array($pages_for_menu)): ?>
            <?php foreach($pages_for_menu as $menu_page): ?>
                <a href="<?= BASE_URL ?>pages/show/<?= $menu_page['slug'] ?>"><?= htmlspecialchars($menu_page['title']) ?></a>
            <?php endforeach; ?>
        <?php endif; ?>


        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="<?= BASE_URL ?>admin/dashboard">Адмін-панель</a>
            <a href="<?= BASE_URL ?>user/logout">Вийти</a>
        <?php else: ?>
            <a href="<?= BASE_URL ?>user/login">Вхід для адміністратора</a>
        <?php endif; ?>
    </nav>
</header>
<main>

