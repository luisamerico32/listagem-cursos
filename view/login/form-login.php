<?php include __DIR__ . '/../header.php'; ?>

<form action="/realize-login" method="POST">
    <div class="form-group">
        <label for="email">E-mail:</label>
        <input type="email" name="email" id="email" class="form-control">
    </div>
    <div class="form-group">
        <label for="password">Senha:</label>
        <input type="password" name="password" id="password" class="form-control">
    </div>
    <button class="btn btn-primary">
        Entrar
    </button>
</form>

<?php include __DIR__ . '/../footer.php'; ?>
