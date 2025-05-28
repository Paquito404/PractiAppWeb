<h1>Papelera de reciclaje</h1>
<p>Aqui se pondran todas las practicas borradas</p>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="contenedor-botones">
                <?php foreach ($practica as $prac): ?>
                    <?php
                        $id = $prac['ID'];
                        $nombre = $prac['Carrera'];
                        $fase = $prac['Fase'];
                        $fecha = CodeIgniter\I18n\Time::now()->toDateTimeString();
                        $imgPath = base_url('imagenes/' . $id . '-' . $nombre .'.jpg');
                        $imgFile = FCPATH . 'imagenes/' . $id . '-' . $nombre . '.jpg';
                        $hasImage = file_exists($imgFile);
                    ?>
                    <?php if ($fecha >= $prac['Fecha'] && $prac['Fecha'] != NULL): ?>
                        <?php 

                            if($hasImage){
                                
                                unlink($imgFile);

                            }

                            $escuelaModel = new App\Models\EscuelaModel();
                            $escuelaModel->delete($id);
                            ?>
                    <?php else: ?>
                    <?php if ($fase == 0): ?>
                    <button class="boton-izquierda" onclick="borrar('<?= $id ?>')">
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
                        <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>