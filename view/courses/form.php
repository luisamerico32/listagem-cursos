<?php include __DIR__ . '/../header.php'; ?>

    <form action="/save-course<?= isset($course) ? '?id=' . $course->getId() : '' ?>" method="POST">
        <div class="form-group">
            <label for="description">Descrição</label>
            <input type="text"
                   id="description"
                   name="description"
                   class="form-control"
                   value="<?= isset($course) ? $course->getDescricao() : '' ?>"
            >
        </div>
        <button class="btn btn-primary">Salvar</button>
    </form>

<?php include __DIR__ . '/../footer.php'; ?>
