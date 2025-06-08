<?php require_once ROOT . '/app/views/templates/header.php'; ?>
<?php require_once ROOT . '/app/views/admin/partials/admin_nav.php';?>

    <div class="container">
        <h1>Управління бронюваннями</h1>

        <table class="admin-table">
            <thead>
            <tr>
                <th>ID</th><th>Номер</th><th>Гість</th><th>Email</th><th>Телефон</th><th>Дати</th><th>Статус</th><th>Дії</th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($bookings)): ?>
                <?php foreach($bookings as $booking): ?>
                    <tr>
                        <td><?= $booking['id'] ?></td>
                        <td><?= htmlspecialchars($booking['room_name']) ?></td>
                        <td><?= htmlspecialchars($booking['guest_name']) ?></td>
                        <td><?= htmlspecialchars($booking['guest_email']) ?></td>
                        <td><?= htmlspecialchars($booking['guest_phone']) ?></td>
                        <td><?= $booking['start_date'] ?> - <?= $booking['end_date'] ?></td>
                        <td><?= $booking['status'] ?></td>
                        <td>
                            <?php if ($booking['status'] == 'pending'): ?>
                                <form action="<?= BASE_URL ?>adminbookings/approve/<?= $booking['id'] ?>" method="POST" style="display:inline;">
                                    <button type="submit">Підтвердити</button>
                                </form>
                                <form action="<?= BASE_URL ?>adminbookings/cancel/<?= $booking['id'] ?>" method="POST" style="display:inline;">
                                    <button type="submit">Скасувати</button>
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" style="text-align: center;">На даний момент бронювань немає.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

<?php require_once ROOT . '/app/views/templates/footer.php'; ?>