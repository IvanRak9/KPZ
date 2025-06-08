<?php $isEdit = isset($data['rooms']); ?>

<?php if (!empty($data['error'])): ?>
    <p style="color: red;"><?= $data['error'] ?></p>
<?php endif; ?>

<form action="<?= $isEdit ? '/adminrooms/update/' . $data['rooms']['id'] : '/adminrooms/store' ?>" method="POST" enctype="multipart/form-data">
    <div>
        <label for="name">Назва номеру:</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($data['rooms']['name'] ?? '') ?>" required>
    </div>
    <div>
        <label for="description">Опис:</label>
        <textarea id="description" name="description" rows="5" required><?= htmlspecialchars($data['rooms']['description'] ?? '') ?></textarea>
    </div>
    <div>
        <label for="price">Ціна за ніч (UAH):</label>
        <input type="number" step="0.01" id="price" name="price" value="<?= htmlspecialchars($data['rooms']['price_per_night'] ?? '') ?>" required>
    </div>
    <div>
        <label for="capacity">Місткість (осіб):</label>
        <input type="number" id="capacity" name="capacity" value="<?= htmlspecialchars($data['rooms']['capacity'] ?? '') ?>" required>
    </div>
    <div>
        <label for="image">Фото номеру:</label>
        <input type="file" id="image" name="image" accept="image/*">
        <?php if ($isEdit && !empty($data['rooms']['image_path'])): ?>
            <p>Поточне фото:</p>
            <img src="<?= $data['rooms']['image_path'] ?>" alt="<?= htmlspecialchars($data['rooms']['name']) ?>" width="150">
        <?php endif; ?>
    </div>
    <button type="submit"><?= $isEdit ? 'Оновити' : 'Створити' ?></button>
</form>