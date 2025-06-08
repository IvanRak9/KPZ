<?php require_once ROOT . '/app/views/templates/header.php'; ?>
<?php require_once ROOT . '/app/views/admin/partials/admin_nav.php';?>

<?php extract($data); ?>
<div class="container">
    <h1>Управління номерами</h1>
    <a href="<?= BASE_URL ?>adminrooms/create">Додати новий номер</a>

    <table class="admin-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Назва</th>
            <th>Ціна за ніч</th>
            <th>Місткість</th>
            <th>Дії</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($rooms as $room): ?>
            <tr>
                <td><?= $room['id'] ?></td>
                <td><?= htmlspecialchars($room['name']) ?></td>
                <td><?= $room['price_per_night'] ?></td>
                <td><?= $room['capacity'] ?></td>
                <td>
                    <a href="<?= BASE_URL ?>adminrooms/edit/<?= $room['id'] ?>">Редагувати</a>
                    <form action="<?= BASE_URL ?>adminrooms/destroy/<?= $room['id'] ?>" method="POST" style="display:inline;">
                        <button type="submit" onclick="return confirm('Ви впевнені, що хочете видалити цей номер?');">Видалити</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php require_once ROOT . '/app/views/templates/footer.php'; ?>

