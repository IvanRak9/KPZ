<?php require_once ROOT . '/app/views/templates/header.php'; ?>

    <div class="container">
        <h1>Відгуки наших гостей</h1>

        <div class="reviews-page-layout">

            <div class="reviews-section">
                <h2>Що кажуть про нас:</h2>
                <?php if (empty($reviews)): ?>
                    <p>Ще немає жодного відгука. Будьте першим!</p>
                <?php else: ?>
                    <?php foreach($reviews as $review): ?>
                        <div class="review-card">
                            <strong><?= htmlspecialchars($review['author_name']) ?></strong>
                            <p>Рейтинг: <?= str_repeat('&#9733;', $review['rating']) . str_repeat('&#9734;', 5 - $review['rating']) ?></p>
                            <p><?= nl2br(htmlspecialchars($review['review_text'])) ?></p>
                            <small>Написано: <?= date('d.m.Y', strtotime($review['created_at'])) ?></small>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="review-form-section">
                <h2>Залишити відгук</h2>
                <form action="<?= BASE_URL ?>reviews/store" method="POST">
                    <div>
                        <label for="author_name">Ваше ім'я:</label>
                        <input type="text" id="author_name" name="author_name" required>
                    </div>
                    <div>
                        <label>Ваша оцінка:</label>
                        <select name="rating" required>
                            <option value="5">5 - Чудово</option>
                            <option value="4">4 - Добре</option>
                            <option value="3">3 - Задовільно</option>
                            <option value="2">2 - Погано</option>
                            <option value="1">1 - Жахливо</option>
                        </select>
                    </div>
                    <div>
                        <label for="review_text">Ваш відгук:</label>
                        <textarea id="review_text" name="review_text" rows="5" required></textarea>
                    </div>
                    <button type="submit">Надіслати відгук</button>
                </form>
            </div>
        </div>
    </div>

<?php require_once ROOT . '/app/views/templates/footer.php'; ?>