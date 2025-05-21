<h1>Vista combinada sin clasificar por tabla</h1>

<div class="acciones">
    <input type="text" id="buscador" placeholder="Buscar por nombre..." onkeyup="filtrarFilas()">
</div>

<div class="contenedor-botones">
    <?php
        $total = count($filas);
        for ($i = 0; $i < $total; $i += 4):
    ?>
        <div class="fila-botones">
            <?php for ($j = $i; $j < $i + 4 && $j < $total; $j++): 
                $fila = $filas[$j];
            ?>
                <button class="boton-buscador" onclick="verFila('<?= $fila['origen'] ?>', <?= $fila['ID'] ?>)">
                    <strong>ID:</strong> <?= htmlspecialchars($fila['ID']) ?><br>
                    <strong>Nombre:</strong> <?= htmlspecialchars($fila['nombre']) ?><br>
                    <strong>Propiedad:</strong> <?= htmlspecialchars($fila['propiedad']) ?><br>
                    <small><em><?= htmlspecialchars($fila['origen']) ?></em></small>
                </button>
            <?php endfor; ?>
        </div>
    <?php endfor; ?>
</div>