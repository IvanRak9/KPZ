<?php require_once ROOT . '/app/views/templates/header.php'; ?>

    <div class="form-container">
        <h2>Вхід до панелі адміністрування</h2>

        <?php if (!empty($error)): ?>
            <p style="color: red;"><?= $error ?></p>
        <?php endif; ?>

        <form action="<?= BASE_URL ?>user/login" method="POST">
            <div>
                <label for="username">Ім'я користувача:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div>
                <label for="password">Пароль:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Увійти</button>
        </form>
    </div>

<?php require_once ROOT . '/app/views/templates/footer.php'; ?>