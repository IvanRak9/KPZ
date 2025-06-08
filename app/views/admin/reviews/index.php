<?php require_once ROOT . '/app/views/templates/header.php'; ?>
<?php require_once ROOT . '/app/views/admin/partials/admin_nav.php';?>

<?php extract($data); ?>
<div class="container">
<h1>Модерація відгуків</h1>

<table class="admin-table">
    <thead><tr><th>Автор</th><th>Рейтинг</th><th>Текст</th><th>Статус</th><th>Дії</th></tr></thead>
    <tbody>
    <?php foreach ($data['reviews'] as $review): ?>
        <tr>
            <td><?= htmlspecialchars($review['author_name']) ?></td>
            <td><?= $review['rating'] ?>/5</td>
            <td><?= htmlspecialchars($review['review_text']) ?></td>
            <td><?= $review['status'] ?></td>
            <td>
                <?php if ($review['status'] == 'pending'): ?>
                    <form action="<?= BASE_URL ?>adminreviews/approve/<?= $review['id'] ?>" method="POST" style="display:inline;">
                        <button type="submit">Схвалити</button>
                    </form>
                    <form action="<?= BASE_URL ?>adminreviews/reject/<?= $review['id'] ?>" method="POST" style="display:inline;">
                        <button type="submit">Відхилити</button>
                    </form>
                <?php endif; ?>
                <form action="<?= BASE_URL ?>adminreviews/destroy/<?= $review['id'] ?>" method="POST" style="display:inline;">
                    <button type="submit" onclick="return confirm('Ви впевнені?');" style="color:red;">Видалити</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>
<?php require_once ROOT . '/app/views/templates/footer.php'; ?>
