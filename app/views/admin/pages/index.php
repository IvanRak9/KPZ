<?php require_once ROOT . '/app/views/templates/header.php'; ?>
<?php require_once ROOT . '/app/views/admin/partials/admin_nav.php';?>

<?php extract($data); ?>
<div class="container">
<h1>Управління сторінками</h1>
<a href="<?= BASE_URL ?>adminpages/create">Створити нову сторінку</a>

<table class="admin-table">
    <thead><tr><th>ID</th><th>Заголовок</th><th>URL (slug)</th><th>Статус</th><th>Дії</th></tr></thead>
    <tbody>
    <?php foreach ($data['pages'] as $page): ?>
        <tr>
            <td><?= $page['id'] ?></td>
            <td><?= htmlspecialchars($page['title']) ?></td>
            <td><a href="<?= BASE_URL ?>pages/show/<?= $page['slug'] ?>" target="_blank">/pages/show/<?= $page['slug'] ?></a></td>
            <td><?= $page['is_published'] ? 'Опубліковано' : 'Чернетка' ?></td>
            <td>
                <a href="<?= BASE_URL ?>adminpages/edit/<?= $page['id'] ?>">Редагувати</a>
                <form action="<?= BASE_URL ?>adminpages/destroy/<?= $page['id'] ?>" method="POST" style="display:inline;">
                    <button type="submit" onclick="return confirm('Ви впевнені?');">Видалити</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>
<?php require_once ROOT . '/app/views/templates/footer.php'; ?>
