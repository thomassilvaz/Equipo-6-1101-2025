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
    $parent_id = isset($_POST['parent_id']) ? intval($_POST['parent_id']) : NULL;
    
    $sql = "INSERT INTO comentarios (texto, usuario_doc, parent_id) VALUES ('$texto', $usuario_doc, " . ($parent_id ? $parent_id : 'NULL') . ")";
    if($conexion->query($sql)) {
        redirect("index.php?mod=comentarios");
    }
}

// Procesamiento de likes/dislikes
if(isset($_POST['reaccionar'])) {
    $comentario_id = intval($_POST['comentario_id']);
    $tipo = $conexion->real_escape_string($_POST['tipo']);
    $usuario_doc = is_array($_SESSION['user']) ? $_SESSION['user']['doc'] : $_SESSION['user'];
    
    // Verificar si ya existe una reacción
    $check_sql = "SELECT id, tipo FROM reacciones WHERE usuario_doc = $usuario_doc AND comentario_id = $comentario_id";
    $result = $conexion->query($check_sql);
    
    if($result->num_rows > 0) {
        $reaccion = $result->fetch_assoc();
        if($reaccion['tipo'] == $tipo) {
            // Eliminar reacción si es la misma
            $sql = "DELETE FROM reacciones WHERE id = " . $reaccion['id'];
        } else {
            // Actualizar reacción si es diferente
            $sql = "UPDATE reacciones SET tipo = '$tipo' WHERE id = " . $reaccion['id'];
        }
    } else {
        // Insertar nueva reacción
        $sql = "INSERT INTO reacciones (tipo, usuario_doc, comentario_id) VALUES ('$tipo', $usuario_doc, $comentario_id)";
    }
    
    $conexion->query($sql);
    redirect("index.php?mod=comentarios");
}

if(isset($_GET['eliminar'])) {
    $id = intval($_GET['eliminar']);
    $usuario_doc = is_array($_SESSION['user']) ? $_SESSION['user']['doc'] : $_SESSION['user'];
    
    $sql = "DELETE FROM comentarios WHERE id = $id AND usuario_doc = $usuario_doc";
    if($conexion->query($sql)) {
        redirect("index.php?mod=comentarios");
    }
}

// Leer comentarios principales (no respuestas)
$sql = "SELECT c.*, u.PNombre, u.PApellido, 
        (SELECT COUNT(*) FROM reacciones WHERE comentario_id = c.id AND tipo = 'like') as likes,
        (SELECT COUNT(*) FROM reacciones WHERE comentario_id = c.id AND tipo = 'dislike') as dislikes,
        (SELECT tipo FROM reacciones WHERE comentario_id = c.id AND usuario_doc = " . (is_array($_SESSION['user']) ? $_SESSION['user']['doc'] : $_SESSION['user']) . ") as mi_reaccion
        FROM comentarios c
        JOIN usuarios u ON c.usuario_doc = u.doc
        WHERE c.parent_id IS NULL
        ORDER BY c.fecha DESC";
$comentarios_principales = $conexion->query($sql);

// Función para obtener respuestas de un comentario
function obtenerRespuestas($conexion, $parent_id, $usuario_doc) {
    $sql = "SELECT c.*, u.PNombre, u.PApellido, 
            (SELECT COUNT(*) FROM reacciones WHERE comentario_id = c.id AND tipo = 'like') as likes,
            (SELECT COUNT(*) FROM reacciones WHERE comentario_id = c.id AND tipo = 'dislike') as dislikes,
            (SELECT tipo FROM reacciones WHERE comentario_id = c.id AND usuario_doc = $usuario_doc) as mi_reaccion
            FROM comentarios c
            JOIN usuarios u ON c.usuario_doc = u.doc
            WHERE c.parent_id = $parent_id
            ORDER BY c.fecha ASC";
    return $conexion->query($sql);
}

// Función para mostrar un comentario (recursiva para respuestas)
function mostrarComentario($com, $conexion, $nivel = 0) {
    $usuario_actual = is_array($_SESSION['user']) ? $_SESSION['user']['doc'] : $_SESSION['user'];
    $margin_left = $nivel * 30; // Sangría para respuestas anidadas
    $border_class = $nivel > 0 ? 'border-start ps-3' : '';
    
    // Obtener respuestas
    $respuestas = obtenerRespuestas($conexion, $com['id'], $usuario_actual);
    $tiene_respuestas = $respuestas->num_rows > 0;
    
    // Determinar clases para botones de like/dislike
    $like_class = ($com['mi_reaccion'] == 'like') ? 'btn-primary' : 'btn-outline-primary';
    $dislike_class = ($com['mi_reaccion'] == 'dislike') ? 'btn-danger' : 'btn-outline-secondary';
    
    echo '<div class="comentario-item mb-3 ' . $border_class . '" style="margin-left: ' . $margin_left . 'px;">';
    echo '<div class="d-flex">';
    echo '<div class="flex-shrink-0">';
    echo '<div class="avatar bg-primary text-white rounded-circle me-3 d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">';
    echo substr($com['PNombre'], 0, 1) . substr($com['PApellido'], 0, 1);
    echo '</div>';
    echo '</div>';
    echo '<div class="flex-grow-1 ms-3">';
    echo '<div class="d-flex justify-content-between align-items-start">';
    echo '<div>';
    echo '<h6 class="mb-0 fw-bold">' . htmlspecialchars($com['PNombre'] . ' ' . $com['PApellido']) . '</h6>';
    echo '<small class="text-muted"><i class="far fa-clock me-1"></i>' . date('d/m/Y H:i', strtotime($com['fecha'])) . '</small>';
    echo '</div>';
    
    // Botones de acción (eliminar) para el propietario
    if($usuario_actual == $com['usuario_doc']): 
        echo '<div class="comentario-acciones">';
        echo '<a href="?mod=comentarios&eliminar=' . $com['id'] . '"';
        echo 'class="btn btn-sm btn-outline-danger"';
        echo 'title="Eliminar comentario"';
        echo 'data-bs-toggle="modal"';
        echo 'data-bs-target="#confirmDeleteModal"';
        echo 'data-comment-id="' . $com['id'] . '">';
        echo '<i class="fas fa-trash-alt"></i>';
        echo '</a>';
        echo '</div>';
    endif;
    echo '</div>';
    
    echo '<p class="mt-2 mb-2 comentario-texto">' . nl2br(htmlspecialchars($com['texto'])) . '</p>';
    
    // Controles de like/dislike y responder
    echo '<div class="d-flex align-items-center mt-2">';
    echo '<form method="POST" class="me-2">';
    echo '<input type="hidden" name="comentario_id" value="' . $com['id'] . '">';
    echo '<input type="hidden" name="tipo" value="like">';
    echo '<button type="submit" name="reaccionar" class="btn btn-sm ' . $like_class . ' d-flex align-items-center">';
    echo '<i class="fas fa-thumbs-up me-1"></i> <span class="count">' . $com['likes'] . '</span>';
    echo '</button>';
    echo '</form>';
    
    echo '<form method="POST" class="me-3">';
    echo '<input type="hidden" name="comentario_id" value="' . $com['id'] . '">';
    echo '<input type="hidden" name="tipo" value="dislike">';
    echo '<button type="submit" name="reaccionar" class="btn btn-sm ' . $dislike_class . ' d-flex align-items-center">';
    echo '<i class="fas fa-thumbs-down me-1"></i> <span class="count">' . $com['dislikes'] . '</span>';
    echo '</button>';
    echo '</form>';
    
    // Botón para responder
    echo '<button class="btn btn-sm btn-outline-primary me-2 btn-responder" data-comentario-id="' . $com['id'] . '">';
    echo '<i class="fas fa-reply me-1"></i> Responder';
    echo '</button>';
    echo '</div>';
    
    // Formulario para responder (oculto inicialmente)
    echo '<div class="respuesta-form mt-3" id="respuesta-form-' . $com['id'] . '" style="display: none;">';
    echo '<form method="POST">';
    echo '<input type="hidden" name="parent_id" value="' . $com['id'] . '">';
    echo '<div class="form-group">';
    echo '<textarea name="texto" class="form-control" rows="2" placeholder="Escribe tu respuesta..." required></textarea>';
    echo '</div>';
    echo '<div class="d-flex justify-content-end mt-2">';
    echo '<button type="button" class="btn btn-sm btn-outline-secondary me-2 cancelar-respuesta" data-comentario-id="' . $com['id'] . '">Cancelar</button>';
    echo '<button type="submit" name="crear_comentario" class="btn btn-sm btn-primary">Responder</button>';
    echo '</div>';
    echo '</form>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    
    // Mostrar respuestas
    if($tiene_respuestas) {
        while($respuesta = $respuestas->fetch_assoc()) {
            mostrarComentario($respuesta, $conexion, $nivel + 1);
        }
    }
}
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
            <form method="POST" class="mb-4" id="form-comentario-principal">
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
                <?php if($comentarios_principales->num_rows > 0): ?>
                    <?php while($com = $comentarios_principales->fetch_assoc()): ?>
                        <?php mostrarComentario($com, $conexion); ?>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="alert alert-info mb-0 text-center">
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
                <p class="small text-muted">Esta acción no se puede deshacer y también eliminará todas las respuestas asociadas.</p>
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

<style>
    .comentario-item {
        background-color: white;
        border-radius: 10px;
        padding: 15px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        border-left: 3px solid #0d6efd;
    }
    
    .comentario-item:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
        transform: translateY(-2px);
    }
    
    .avatar {
        font-weight: 600;
        background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%);
    }
    
    .comentario-texto {
        line-height: 1.6;
        color: #333;
    }
    
    .btn-responder, .cancelar-respuesta {
        border-radius: 20px;
        transition: all 0.2s ease;
    }
    
    .btn-responder:hover, .cancelar-respuesta:hover {
        transform: translateY(-1px);
    }
    
    .count {
        min-width: 20px;
        text-align: center;
        display: inline-block;
    }
    
    .border-start {
        border-left: 3px solid #0dcaf0 !important;
    }
    
    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
        border: none;
        border-radius: 20px;
    }
    
    .btn-primary:hover {
        background: linear-gradient(135deg, #0a58ca 0%, #084298 100%);
        transform: translateY(-1px);
    }
    
    .modal-content {
        border-radius: 12px;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }
    
    .respuesta-form {
        background-color: #f8f9fa;
        padding: 15px;
        border-radius: 8px;
        border-left: 3px solid #6c757d;
    }
    
    @media (max-width: 576px) {
        .comentario-item {
            padding: 12px;
        }
        
        .d-flex {
            flex-direction: column;
        }
        
        .flex-shrink-0 {
            margin-bottom: 10px;
        }
        
        .btn-responder, .cancelar-respuesta {
            margin-top: 8px;
        }
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
    // Configurar el modal de eliminación
    $('#confirmDeleteModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var commentId = button.data('comment-id');
        var deleteUrl = '?mod=comentarios&eliminar=' + commentId;
        
        $('#confirmDeleteBtn').attr('href', deleteUrl);
    });
    
    // Manejar clic en botón "Responder" - Usar delegación de eventos
    $(document).on('click', '.btn-responder', function() {
        var comentarioId = $(this).data('comentario-id');
        
        // Ocultar todos los formularios de respuesta
        $('.respuesta-form').slideUp();
        
        // Mostrar el formulario correspondiente
        $('#respuesta-form-' + comentarioId).slideDown();
        
        // Enfocar el textarea
        $('#respuesta-form-' + comentarioId + ' textarea').focus();
        
        // Desplazar suavemente hacia el formulario
        $('html, body').animate({
            scrollTop: $('#respuesta-form-' + comentarioId).offset().top - 100
        }, 500);
    });
    
    // Manejar clic en botón "Cancelar" en formularios de respuesta
    $(document).on('click', '.cancelar-respuesta', function() {
        var comentarioId = $(this).data('comentario-id');
        $('#respuesta-form-' + comentarioId).slideUp();
    });
    
    // Cerrar formularios de respuesta al hacer clic fuera de ellos
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.respuesta-form').length && !$(e.target).hasClass('btn-responder')) {
            $('.respuesta-form').slideUp();
        }
    });
    
    // Prevenir que el clic dentro del formulario cierre el mismo
    $('.respuesta-form').on('click', function(e) {
        e.stopPropagation();
    });
});
</script>