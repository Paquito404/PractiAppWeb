<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>prueba2</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/styles.css') ?>">
</head>
<body>
    <div>
        <div class="header-container">
            <img src="<?= base_url('assets/img/logo.png') ?>" alt="Nombre de tu Sitio" width="70" height="70">
            <h1 class="texto-header">Practicas profesionales unison (Moderador)</h1>
        </div>
    </div>

    <nav id="navbar">
        <ul>
            <li><button onclick="loadContent('inicio')">Tus proyectos</button></li>
            <li><button onclick="loadContent('formulario')">Subir proyectos</button></li>
            <li><button onclick="loadContent('papelera')">Papelera</button></li>
            <li><button onclick="loadContent('revisar')">En revision</button></li>
            <li><button onclick="loadContent('buscar')">Base de datos</button></li>
            <li><button onclick="loadContent('registro')">Registrar maestro</button></li>
            <li><button onclick="loadContent('default')">Registrar coordinador</button></li>
            <li class="alinear-derecha"><button id="btnUsuario" onclick="mostrarModerador()">Usuario</button></li>
        </ul>
    </nav>

    <div id="content"> 
    </div>

    <div id="usuarioPanel">
    <div id="infoUsuario">
        <p>Cargando información...</p>
    </div>
    <button onclick="cerrarPanel()">Cerrar</button>
    <a href="<?= base_url('logout') ?>"><button>Cerrar sesión</button></a>
    </div>

    <script>
    const baseUrl = "<?= base_url() ?>";
    const idUsuario = <?= session('usuario_id') ?? 'null' ?>;
    </script>
    <script src="<?= base_url('assets/js/script.js') ?>"></script>
</body>
</html>