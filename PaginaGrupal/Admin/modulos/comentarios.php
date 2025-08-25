<?php
include '../conexion.php';

function redirect($url) {
    echo "<script>window.location.href='$url';</script>";
    exit();
}

// Procesamiento de CRUD
if(isset($_POST['crear_comentario'])) {
    $texto = $conexion->real_escape_string($_POST['texto']);
    $usuario_doc = is_array($_SESSION['user']) ? $_SESSION['user']['doc'] : $_SESSION['user'];
    
    $sql = "INSERT INTO comentarios (texto, usuario_doc) VALUES ('$texto', $usuario_doc)";
    if($conexion->query($sql)) {
        redirect("index.php?mod=comentarios");
    }
}

if(isset($_GET['eliminar'])) {
    $id = intval($_GET['eliminar']);
    $usuario_doc = is_array($_SESSION['user']) ? $_SESSION['user']['doc'] : $_SESSION['user'];
    
    $sql = "DELETE FROM comentarios WHERE id = $id AND usuario_doc = $usuario_doc";
    if($conexion->query($sql)) {
        redirect("index.php?mod=comentarios");
    }
}

// Leer comentarios
$sql = "SELECT c.*, u.PNombre, u.PApellido 
        FROM comentarios c
        JOIN usuarios u ON c.usuario_doc = u.doc
        ORDER BY c.fecha DESC";
$comentarios = $conexion->query($sql);
?>

<!-- Contenedor principal -->
<div class="content-area">
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title mb-0">
                <i class="fas fa-comments me-2"></i>Comentarios
            </h3>
        </div>
        <div class="card-body">
            <!-- Formulario para nuevo comentario -->
            <form method="POST" class="mb-4">
                <div class="form-group">
                    <label for="texto" class="form-label text-muted small">Escribe tu comentario</label>
                    <textarea name="texto" id="texto" class="form-control" rows="3" required 
                              placeholder="Comparte tus ideas..."></textarea>
                </div>
                <button type="submit" name="crear_comentario" class="btn btn-primary mt-2">
                    <i class="fas fa-paper-plane me-1"></i> Publicar
                </button>
            </form>

            <!-- Lista de comentarios -->
            <div class="comentarios-list">
                <?php if($comentarios->num_rows > 0): ?>
                    <?php while($com = $comentarios->fetch_assoc()): ?>
                        <div class="comentario-item card mb-3 border-primary border-2">
                            <div class="card-body position-relative">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="comentario-contenido" style="flex: 1;">
                                        <p class="comentario-texto mb-2"><?= nl2br(htmlspecialchars($com['texto'])) ?></p>
                                        
                                        <div class="comentario-meta d-flex align-items-center mt-3">
                                            <div class="avatar bg-secondary text-white rounded-circle me-2" 
                                                 style="width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;">
                                                <?= substr($com['PNombre'], 0, 1) . substr($com['PApellido'], 0, 1) ?>
                                            </div>
                                            <div>
                                                <span class="fw-semibold"><?= htmlspecialchars($com['PNombre'].' '.$com['PApellido']) ?></span>
                                                <span class="text-muted small ms-2">
                                                    <i class="far fa-clock me-1"></i>
                                                    <?= date('d/m/Y H:i', strtotime($com['fecha'])) ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <?php 
                                    $usuario_actual = is_array($_SESSION['user']) ? $_SESSION['user']['doc'] : $_SESSION['user'];
                                    if($usuario_actual == $com['usuario_doc']): 
                                    ?>
                                        <div class="comentario-acciones ms-3">
                                            <a href="?mod=comentarios&eliminar=<?= $com['id'] ?>" 
                                               class="btn btn-sm btn-outline-danger"
                                               title="Eliminar comentario"
                                               data-bs-toggle="modal" 
                                               data-bs-target="#confirmDeleteModal"
                                               data-comment-id="<?= $com['id'] ?>">
                                               <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="alert alert-info mb-0">
                        <i class="fas fa-info-circle me-2"></i> No hay comentarios aún. ¡Sé el primero en comentar!
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmación personalizado -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle me-2"></i>Confirmar eliminación
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro que deseas eliminar este comentario?</p>
                <p class="small text-muted">Esta acción no se puede deshacer.</p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Cancelar
                </button>
                <a id="confirmDeleteBtn" href="#" class="btn btn-danger">
                    <i class="fas fa-trash-alt me-1"></i> Eliminar
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Estilos adicionales para comentarios -->
<style>
    .comentario-item {
        transition: transform 0.2s;
        border-left: 4px solid var(--primary-blue) !important;
    }
    .comentario-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    .comentario-texto {
        white-space: pre-line;
        padding-right: 15px;
    }
    .comentario-acciones {
        display: flex;
    }
    .avatar {
        font-size: 0.8rem;
        font-weight: 600;
        background: linear-gradient(135deg, var(--secondary-blue) 0%, var(--primary-blue) 100%);
    }
</style>

<!-- Scripts necesarios -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Script para manejar la confirmación -->
<script>
$(document).ready(function() {
    // Configurar el modal de eliminación
    $('#confirmDeleteModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Botón que activó el modal
        var commentId = button.data('comment-id'); // Extraer info de data-* attributes
        var deleteUrl = '?mod=comentarios&eliminar=' + commentId;
        
        // Actualizar el botón de eliminar
        $('#confirmDeleteBtn').attr('href', deleteUrl);
    });
});
</script>