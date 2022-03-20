<?php include __DIR__ . '/../header.php'; ?>

    <a href="/new-course" class="btn btn-primary mb-2">Novo Curso</a>

    <ul class="list-group">
        <?php foreach ($courses as $course): ?>
            <li class="list-group-item d-flex justify-content-between">
                <?= $course->getDescricao(); ?>
                <span>
                    <a href="/update-course?id=<?= $course->getId(); ?>" class="btn btn-info btn-sm">
                        Alterar
                    </a>
                    <a href="/delete-course?id=<?= $course->getId(); ?>" class="btn btn-danger btn-sm">
                        Excluir
                    </a>
                </span>
            </li>
        <?php endforeach; ?>
    </ul>

<?php include __DIR__ . '/../footer.php'; ?>
