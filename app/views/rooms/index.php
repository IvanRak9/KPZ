<?php require_once ROOT . '/app/views/templates/header.php'; ?>

    <div class="container">
        <h1>Наші номери</h1>
        <p>Оберіть номер, який вам до вподоби, та перевірте доступність на бажані дати.</p>

        <div class="rooms-catalog">
            <?php if (empty($rooms)): ?>
                <p>На жаль, на даний момент немає доступних номерів.</p>
            <?php else: ?>
                <?php foreach ($rooms as $room): ?>
                    <div class="room-card">
                        <img src="<?= BASE_URL . 'public' . $room['image_path'] ?>" alt="<?= htmlspecialchars($room['name']) ?>">

                        <div class="room-card-content">
                            <h2><?= htmlspecialchars($room['name']) ?></h2>
                            <p><?= nl2br(htmlspecialchars($room['description'])) ?></p>
                            <p><strong>Ціна:</strong> <?= $room['price_per_night'] ?> грн/ніч</p>
                            <p><strong>Місткість:</strong> <?= $room['capacity'] ?> осіб</p>

                            <div class="booking-form" data-room-id="<?= $room['id'] ?>">
                                <h4>Перевірити доступність:</h4>
                                <label>Заїзд: <input type="date" class="start-date"></label>
                                <label>Виїзд: <input type="date" class="end-date"></label>
                                <button class="check-availability-btn">Перевірити</button>
                                <div class="availability-status"></div>

                                <form action="<?= BASE_URL ?>booking/store" method="POST" class="book-now-form" style="display: none; margin-top: 15px;">
                                    <h4>Забронювати:</h4>
                                    <input type="hidden" name="room_id" value="<?= $room['id'] ?>">
                                    <input type="hidden" name="start_date" class="hidden-start-date">
                                    <input type="hidden" name="end_date" class="hidden-end-date">
                                    <input type="text" name="guest_name" placeholder="Ваше ім'я" required>
                                    <input type="email" name="guest_email" placeholder="Ваш Email" required>
                                    <input type="tel" name="guest_phone" placeholder="Ваш телефон" required>
                                    <button type="submit">Забронювати</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

<?php require_once ROOT . '/app/views/templates/footer.php'; ?>