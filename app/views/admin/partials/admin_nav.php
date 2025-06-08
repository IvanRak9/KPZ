<button class="admin-burger" aria-label="Відкрити меню">
    <span></span>
    <span></span>
    <span></span>
</button>

<aside class="admin-sidebar">
    <nav class="admin-nav">
        <h3>Адмін-меню</h3>
        <ul>
            <li><a href="<?= BASE_URL ?>admin/dashboard">Головна панель</a></li>
            <li><a href="<?= BASE_URL ?>adminrooms">Керувати номерами</a></li>
            <li><a href="<?= BASE_URL ?>adminbookings">Керувати бронюваннями</a></li>
            <li><a href="<?= BASE_URL ?>adminpages">Керувати сторінками</a></li>
            <li><a href="<?= BASE_URL ?>adminreviews">Модерувати відгуки</a></li>
        </ul>
        <hr>
        <ul>
            <li><a href="<?= BASE_URL ?>" target="_blank">Перейти на сайт</a></li>
            <li><a href="<?= BASE_URL ?>user/logout">Вийти</a></li>
        </ul>
    </nav>
</aside>

<div class="admin-overlay"></div>