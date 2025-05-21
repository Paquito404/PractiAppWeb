<h1>Practicas en revision</h1>
<p>En este apartado se desglozan todas las practicas en proceso de revision</p>
<br>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="contenedor-botones">
                <?php foreach ($practica as $prac): ?>
                    <?php
                        $id = $prac['ID'];
                        $nombre = $prac['Carrera'];
                        $fase = $prac['Fase'];
                        $imgPath = base_url('imagenes/' . $id . '-' . $nombre .'.jpg');
                        $imgFile = FCPATH . 'imagenes/' . $id . '-' . $nombre . '.jpg';
                        $hasImage = file_exists($imgFile);
                    ?>
                    <?php if ($fase == 1): ?>
                    <button class="boton-izquierda" onclick="revisar('<?= $id ?>')">
                        <div style="display: flex; align-items: center;">
                        
                            <?php if ($hasImage): ?>
                                <img src="<?= $imgPath . '?v=' . time() ?>" alt="Imagen <?= $id ?>" width="60" height="60" style="margin-right: 15px; object-fit: cover; border-radius: 5px;">
                            <?php else: ?>
                                <div style="width: 60px; height: 60px; background: #ccc; color: #fff; display: flex; align-items: center; justify-content: center; font-size: 12px; margin-right: 15px; border-radius: 5px;">
                                    Sin<br>Imagen
                                </div>
                            <?php endif; ?>
                            <div>
                                <?= 
                                    "Practica: ". htmlspecialchars($prac['ID']) . "<br>" .
                                    htmlspecialchars($prac['Titulo']) . "<br>" .
                                    htmlspecialchars($prac['Carrera']) . "<br>" .
                                    htmlspecialchars($prac['Estatus']) . "<br>" .
                                    "Integrantes: " . htmlspecialchars($prac['Integrantes'])
                                ?>
                            </div>
                        </div>
                    </button>
                        <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>