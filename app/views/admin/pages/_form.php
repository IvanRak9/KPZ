<?php $isEdit = isset($data['page']); ?>
<?php extract($data); ?>

<form action="<?= $isEdit ? '/adminpages/update/' . $data['page']['id'] : '/adminpages/store' ?>" method="POST">
    <div>
        <label for="title">Заголовок:</label>
        <input type="text" id="title" name="title" value="<?= htmlspecialchars($data['page']['title'] ?? '') ?>" required>
    </div>
    <div>
        <label for="slug">URL (slug):</label>
        <input type="text" id="slug" name="slug" value="<?= htmlspecialchars($data['page']['slug'] ?? '') ?>">
        <small>Залиште порожнім, щоб згенерувати автоматично.</small>
    </div>
    <div>
        <label for="content">Контент:</label>
        <textarea id="content" name="content" rows="15"><?= htmlspecialchars($data['page']['content'] ?? '') ?></textarea>
    </div>
    <div>
        <label>
            <input type="checkbox" name="is_published" value="1" <?= ($data['page']['is_published'] ?? false) ? 'checked' : '' ?>>
            Опублікувати
        </label>
    </div>
    <button type="submit"><?= $isEdit ? 'Оновити' : 'Створити' ?></button>
</form>