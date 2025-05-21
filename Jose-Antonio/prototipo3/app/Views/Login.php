<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <h2>Iniciar sesión</h2>

    <?php if(session()->getFlashdata('error')): ?>
        <p style="color:red"><?= session()->getFlashdata('error') ?></p>
    <?php endif; ?>

    <form action="<?= site_url('login') ?>" method="post" autocomplete="off">
        <label for="correo">Correo:</label>
        <input type="email" name="correo" required><br>

        <label for="contraseña">Contraseña:</label>
        <input type="password" name="password" required><br>

        <button type="submit">Ingresar</button>
    </form>
</body>
</html>