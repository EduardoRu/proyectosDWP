<?php

?>

<div class="">
    <div class="">
        <button type="button" class="btn btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#exampleModal_edit_<?= escapar($pros['id_proyecto']) ?>">
            Editar
        </button>
    </div>
    <div class="modal fade" id="exampleModal_edit_<?= escapar($pros['id_proyecto']) ?>" tabindex="-1" aria-labelledby="exampleModalLabel_<?= escapar($pros['id_proyecto']) ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel_<?= escapar($pros['id_proyecto']) ?>">Editar proyecto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" name="userDataEdit" id="userDataEdit" enctype="multipart/form-data" onsubmit="location.reload()">
                        <div class="form-group">
                            <label for="nombre_pro_edit">Nombre del proyecto</label>
                            <input type="text" name="nombre_pro_edit_<?= escapar($pros['id_proyecto']) ?>" id="nombre_pro_edit_<?= escapar($pros['id_proyecto']) ?>" class="form-control" required value="<?= escapar($pros['nombre_proyecto']) ?>">
                        </div>
                        <div class="form-group">
                            <label for="desc_edit">Descripción del proyecto</label>
                            <textarea type="text" name="desc_edit_<?= escapar($pros['id_proyecto']) ?>" id="desc_edit_<?= escapar($pros['id_proyecto']) ?>" class="form-control" required><?= escapar($pros['descripcion']) ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="img_pro_edit">Imagen del proyecto</label>
                            <input type="file" name="img_pro_edit_<?= escapar($pros['id_proyecto']) ?>" id="img_pro_edit_<?= escapar($pros['id_proyecto']) ?>" class="form-control border border-0" accept="image/*">
                        </div>
                        <div class="form-group">
                            <label for="email_edit">Email del creador</label>
                            <input type="text" name="email_edit_<?= escapar($pros['id_proyecto']) ?>" id="email_edit_<?= escapar($pros['id_proyecto']) ?>" class="form-control" value="<?= escapar($pros['correo_proyecto']) ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="tel_edit">telefono del creador</label>
                            <input type="number" name="tel_edit_<?= escapar($pros['id_proyecto']) ?>" id="tel_edit_<?= escapar($pros['id_proyecto']) ?>" class="form-control" value="<?= escapar($pros['telefono']) ?>" required>
                        </div>
                        <div style="display:flex;justify-content:center">
                            <button type="button" class="btn btn-secondary mr-2" data-bs-dismiss="modal">Cancelar</button>
                            <input type="submit" name="submit_edit_<?= escapar($pros['id_proyecto']) ?>" id="submit_edit_<?= escapar($pros['id_proyecto']) ?>" class="btn btn-primary" value="Guardar proyecto" onclick="redirectToHome()">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

