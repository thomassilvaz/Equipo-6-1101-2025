<?php
// Incluir archivo de conexión a la base de datos
include '../conexion.php';

// Función para redireccionar usando JavaScript
function redirect($url) {
    echo "<script>window.location.href='$url';</script>";
    exit();
}

// Procesamiento de CRUD - Crear comentario
if(isset($_POST['crear_comentario'])) {
    $texto = $conexion->real_escape_string($_POST['texto']);
    $usuario_doc = is_array($_SESSION['user']) ? $_SESSION['user']['doc'] : $_SESSION['user'];
    $parent_id = isset($_POST['parent_id']) ? intval($_POST['parent_id']) : NULL;
    
    // Insertar nuevo comentario en la base de datos
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
    
    // Verificar si ya existe una reacción del usuario en este comentario
    $check_sql = "SELECT id, tipo FROM reacciones WHERE usuario_doc = $usuario_doc AND comentario_id = $comentario_id";
    $result = $conexion->query($check_sql);
    
    if($result->num_rows > 0) {
        $reaccion = $result->fetch_assoc();
        if($reaccion['tipo'] == $tipo) {
            // Eliminar reacción si es la misma (toggle)
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

// Procesamiento de eliminación de comentario
if(isset($_GET['eliminar'])) {
    $id = intval($_GET['eliminar']);
    $usuario_doc = is_array($_SESSION['user']) ? $_SESSION['user']['doc'] : $_SESSION['user'];
    
    // Solo permite eliminar comentarios propios
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
    $margin_left = $nivel * 30;
    $border_class = $nivel > 0 ? 'comentario-respuesta' : '';
    
    // Obtener respuestas de este comentario
    $respuestas = obtenerRespuestas($conexion, $com['id'], $usuario_actual);
    $tiene_respuestas = $respuestas->num_rows > 0;
    
    // Determinar clases para botones de like/dislike basado en la reacción actual
    $like_class = ($com['mi_reaccion'] == 'like') ? 'btn-like-active' : 'btn-like';
    $dislike_class = ($com['mi_reaccion'] == 'dislike') ? 'btn-dislike-active' : 'btn-dislike';
    
    // Inicio del contenedor del comentario
    echo '<div class="comentario-item ' . $border_class . '" style="margin-left: ' . $margin_left . 'px;">';
    echo '<div class="pixel-corner pixel-corner-tl"></div>';
    echo '<div class="pixel-corner pixel-corner-tr"></div>';
    echo '<div class="comentario-header">';
    echo '<div class="comentario-avatar">';
    echo '<div class="avatar-pixel">';
    echo substr($com['PNombre'], 0, 1) . substr($com['PApellido'], 0, 1);
    echo '</div>';
    echo '</div>';
    echo '<div class="comentario-info">';
    echo '<div class="comentario-meta">';
    echo '<span class="comentario-autor">' . htmlspecialchars($com['PNombre'] . ' ' . $com['PApellido']) . '</span>';
    echo '<span class="comentario-fecha"><i class="fas fa-clock"></i>' . date('d/m/Y H:i', strtotime($com['fecha'])) . '</span>';
    echo '</div>';
    
    // Botones de acción (eliminar) solo para el propietario del comentario
    if($usuario_actual == $com['usuario_doc']): 
        echo '<div class="comentario-acciones">';
        echo '<a href="?mod=comentarios&eliminar=' . $com['id'] . '"';
        echo 'class="btn-eliminar"';
        echo 'title="Eliminar comentario"';
        echo 'data-bs-toggle="modal"';
        echo 'data-bs-target="#confirmDeleteModal"';
        echo 'data-comment-id="' . $com['id'] . '">';
        echo '<i class="fas fa-trash-alt"></i>';
        echo '</a>';
        echo '</div>';
    endif;
    echo '</div>';
    echo '</div>';
    
    // Texto del comentario
    echo '<div class="comentario-texto">' . nl2br(htmlspecialchars($com['texto'])) . '</div>';
    
    // Controles de like/dislike y responder
    echo '<div class="comentario-acciones-inferiores">';
    echo '<form method="POST" class="form-reaccion">';
    echo '<input type="hidden" name="comentario_id" value="' . $com['id'] . '">';
    echo '<input type="hidden" name="tipo" value="like">';
    echo '<button type="submit" name="reaccionar" class="' . $like_class . '">';
    echo '<i class="fas fa-thumbs-up"></i> <span class="count">' . $com['likes'] . '</span>';
    echo '</button>';
    echo '</form>';
    
    echo '<form method="POST" class="form-reaccion">';
    echo '<input type="hidden" name="comentario_id" value="' . $com['id'] . '">';
    echo '<input type="hidden" name="tipo" value="dislike">';
    echo '<button type="submit" name="reaccionar" class="' . $dislike_class . '">';
    echo '<i class="fas fa-thumbs-down"></i> <span class="count">' . $com['dislikes'] . '</span>';
    echo '</button>';
    echo '</form>';
    
    // Botón para responder al comentario
    echo '<button class="btn-responder" data-comentario-id="' . $com['id'] . '">';
    echo '<i class="fas fa-reply"></i> Responder';
    echo '</button>';
    echo '</div>';
    
    // Formulario para responder
    echo '<div class="respuesta-form" id="respuesta-form-' . $com['id'] . '" style="display: none;">';
    echo '<form method="POST">';
    echo '<input type="hidden" name="parent_id" value="' . $com['id'] . '">';
    echo '<div class="form-group">';
    echo '<textarea name="texto" class="form-control-pixel" rows="2" placeholder="Escribe tu respuesta..." required></textarea>';
    echo '</div>';
    echo '<div class="form-actions">';
    echo '<button type="button" class="btn-cancelar cancelar-respuesta" data-comentario-id="' . $com['id'] . '">Cancelar</button>';
    echo '<button type="submit" name="crear_comentario" class="btn-publicar">Responder</button>';
    echo '</div>';
    echo '</form>';
    echo '</div>';
    echo '<div class="pixel-corner pixel-corner-bl"></div>';
    echo '<div class="pixel-corner pixel-corner-br"></div>';
    echo '</div>';
    
    // Mostrar respuestas recursivamente
    if($tiene_respuestas) {
        while($respuesta = $respuestas->fetch_assoc()) {
            mostrarComentario($respuesta, $conexion, $nivel + 1);
        }
    }
}
?>

<!-- Contenedor principal del módulo de comentarios con estilo 8-bit -->
<div class="comentarios-module">
    <!-- Header de la sección -->
    <div class="section-header">
        <div class="pixel-corner pixel-corner-tl"></div>
        <div class="pixel-corner pixel-corner-tr"></div>
        <h2 class="section-title blink">
            <i class="fas fa-comments"></i> COMENTARIOS
        </h2>
        <p class="section-subtitle">Comparte tus ideas y opiniones sobre el proyecto</p>
        <div class="pixel-corner pixel-corner-bl"></div>
        <div class="pixel-corner pixel-corner-br"></div>
    </div>

    <!-- Formulario para nuevo comentario principal -->
    <div class="nuevo-comentario-card card">
        <div class="pixel-corner pixel-corner-tl"></div>
        <div class="pixel-corner pixel-corner-tr"></div>
        <div class="card-header">
            <h3><i class="fas fa-edit"></i> NUEVO COMENTARIO</h3>
        </div>
        <div class="card-body">
            <form method="POST" id="form-comentario-principal">
                <div class="form-group">
                    <label for="texto" class="form-label">Escribe tu comentario:</label>
                    <textarea name="texto" id="texto" class="form-control-pixel" rows="3" required 
                              placeholder="Comparte tus ideas sobre el proyecto Stay Clean..."></textarea>
                </div>
                <button type="submit" name="crear_comentario" class="btn-publicar">
                    <i class="fas fa-paper-plane"></i> PUBLICAR COMENTARIO
                </button>
            </form>
        </div>
        <div class="pixel-corner pixel-corner-bl"></div>
        <div class="pixel-corner pixel-corner-br"></div>
    </div>

    <!-- Lista de comentarios existentes -->
    <div class="comentarios-lista">
        <h3 class="subsection-title">
            <i class="fas fa-comment-dots"></i> COMENTARIOS RECIENTES
        </h3>
        
        <?php if($comentarios_principales->num_rows > 0): ?>
            <div class="comentarios-container">
                <?php while($com = $comentarios_principales->fetch_assoc()): ?>
                    <?php mostrarComentario($com, $conexion); ?>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <!-- Mensaje cuando no hay comentarios -->
            <div class="no-comentarios card">
                <div class="pixel-corner pixel-corner-tl"></div>
                <div class="pixel-corner pixel-corner-tr"></div>
                <div class="card-body text-center">
                    <i class="fas fa-comment-slash no-comentarios-icon"></i>
                    <h4>No hay comentarios aún</h4>
                    <p>¡Sé el primero en compartir tus ideas sobre el proyecto!</p>
                </div>
                <div class="pixel-corner pixel-corner-bl"></div>
                <div class="pixel-corner pixel-corner-br"></div>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Mensaje de confirmación para eliminar comentario -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-pixel">
            <div class="pixel-corner pixel-corner-tl"></div>
            <div class="pixel-corner pixel-corner-tr"></div>
            <div class="modal-header">
                <h3 class="modal-title">
                    <i class="fas fa-exclamation-triangle"></i> CONFIRMAR ELIMINACIÓN
                </h3>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro que deseas eliminar este comentario?</p>
                <p class="text-muted">Esta acción no se puede deshacer y también eliminará todas las respuestas asociadas.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancelar" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i> CANCELAR
                </button>
                <a id="confirmDeleteBtn" href="#" class="btn-eliminar-confirm">
                    <i class="fas fa-trash-alt"></i> ELIMINAR
                </a>
            </div>
            <div class="pixel-corner pixel-corner-bl"></div>
            <div class="pixel-corner pixel-corner-br"></div>
        </div>
    </div>
</div>

<style>
.comentarios-module {
    padding: 0 10px;
}
/* Estilos para el encabezado de la sección de comentarios */
.section-header {
    background: var(--primary-blue);
    color: var(--white);
    border: var(--pixel-border);
    padding: 30px;
    margin-bottom: 30px;
    position: relative;
    box-shadow: var(--pixel-shadow);
}

/* Título principal de la sección con estilo de videojuego */
.section-title {
    font-size: 1.8rem;
    margin-bottom: 10px;
    font-family: 'Press Start 2P', cursive;
    text-shadow: 3px 3px 0 #000;
    color: var(--accent-yellow);
    display: flex;
    align-items: center;
    gap: 15px;
}

/* Subtítulo descriptivo de la sección */
.section-subtitle {
    font-size: 1rem;
    opacity: 0.9;
    font-family: 'Silkscreen', cursive;
}

/* Título de subsección para lista de comentarios */
.subsection-title {
    color: var(--primary-blue);
    font-size: 1.3rem;
    margin: 30px 0 20px;
    padding-bottom: 10px;
    border-bottom: 4px solid var(--accent-yellow);
    font-family: 'Press Start 2P', cursive;
    text-shadow: 2px 2px 0 #000;
    display: flex;
    align-items: center;
    gap: 10px;
}

/* Campos de formulario con estilo pixel */
.form-control-pixel {
    width: 100%;
    padding: 12px 15px;
    border: var(--pixel-border);
    background-color: var(--light-gray);
    font-family: 'Silkscreen', cursive;
    resize: vertical;
    box-shadow: inset 2px 2px 0 #0000001a;
}

/* Efecto de focus para campos de formulario */
.form-control-pixel:focus {
    outline: none;
    background-color: var(--white);
    box-shadow: inset 2px 2px 0 var(--primary-blue);
}

/* Etiquetas de formulario */
.form-label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    color: var(--primary-blue);
    font-family: 'Press Start 2P', cursive;
    font-size: 0.8rem;
}

/* Botón principal para publicar comentarios */
.btn-publicar {
    background-color: var(--primary-blue);
    color: white;
    border: var(--pixel-border);
    padding: 12px 20px;
    font-family: 'Press Start 2P', cursive;
    font-size: 0.7rem;
    cursor: pointer;
    transition: all 0.3s;
    box-shadow: var(--pixel-shadow);
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

/* Efecto hover para botón publicar */
.btn-publicar:hover {
    background-color: var(--secondary-blue);
    transform: translate(-2px, -2px);
    box-shadow: 6px 6px 0 #000;
    color: white;
}

/* Botón secundario para cancelar acciones */
.btn-cancelar {
    background-color: var(--light-gray);
    color: var(--dark-text);
    border: var(--pixel-border);
    padding: 10px 15px;
    font-family: 'Press Start 2P', cursive;
    font-size: 0.6rem;
    cursor: pointer;
    transition: all 0.3s;
    box-shadow: var(--pixel-shadow);
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

/* Efecto hover para botón cancelar */
.btn-cancelar:hover {
    background-color: #e9ecef;
    transform: translate(-2px, -2px);
    box-shadow: 6px 6px 0 #000;
}

/* Contenedor individual para cada comentario */
.comentario-item {
    background: var(--white);
    border: var(--pixel-border);
    box-shadow: var(--pixel-shadow);
    margin-bottom: 20px;
    padding: 20px;
    position: relative;
    transition: all 0.3s;
}

/* Efecto hover para items de comentario */
.comentario-item:hover {
    transform: translate(-2px, -2px);
    box-shadow: 6px 6px 0 #000;
}

/* Estilo especial para comentarios que son respuestas */
.comentario-respuesta {
    background-color: #f8f9fa;
    border-left: 4px solid var(--secondary-blue);
}

/* Encabezado del comentario con información del usuario */
.comentario-header {
    display: flex;
    align-items: flex-start;
    gap: 15px;
    margin-bottom: 15px;
}

/* Avatar estilo pixel con iniciales del usuario */
.avatar-pixel {
    width: 50px;
    height: 50px;
    background-color: var(--primary-blue);
    color: white;
    border: var(--pixel-border);
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Press Start 2P', cursive;
    font-weight: bold;
    font-size: 1rem;
    flex-shrink: 0;
}

/* Contenedor de información del comentario */
.comentario-info {
    flex-grow: 1;
}

/* Metadatos del comentario (autor y fecha) */
.comentario-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 5px;
}

/* Nombre del autor del comentario */
.comentario-autor {
    font-weight: bold;
    color: var(--primary-blue);
    font-family: 'Press Start 2P', cursive;
    font-size: 0.8rem;
}

/* Fecha de publicación del comentario */
.comentario-fecha {
    color: #6c757d;
    font-size: 0.8rem;
    font-family: 'Silkscreen', cursive;
    display: flex;
    align-items: center;
    gap: 5px;
}

/* Área de texto del comentario */
.comentario-texto {
    margin-bottom: 15px;
    line-height: 1.6;
    font-family: 'Silkscreen', cursive;
    padding: 10px;
    background-color: var(--light-gray);
    border: 2px solid #e9ecef;
}

/* Contenedor para botones de acciones inferiores */
.comentario-acciones-inferiores {
    display: flex;
    gap: 15px;
    align-items: center;
}

/* Formulario inline para reacciones */
.form-reaccion {
    display: inline;
}

/* Botones base para like, dislike y responder */
.btn-like, .btn-dislike, .btn-responder {
    background-color: var(--light-gray);
    color: var(--dark-text);
    border: var(--pixel-border);
    padding: 8px 12px;
    font-family: 'Silkscreen', cursive;
    font-size: 0.8rem;
    cursor: pointer;
    transition: all 0.3s;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

/* Efecto hover para botones de interacción */
.btn-like:hover, .btn-dislike:hover, .btn-responder:hover {
    transform: translate(-1px, -1px);
    box-shadow: 2px 2px 0 #000;
}

/* Estado activo para botón de like */
.btn-like-active {
    background-color: var(--primary-blue);
    color: white;
    border: var(--pixel-border);
    padding: 8px 12px;
    font-family: 'Silkscreen', cursive;
    font-size: 0.8rem;
    cursor: pointer;
    box-shadow: 2px 2px 0 #000;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

/* Estado activo para botón de dislike */
.btn-dislike-active {
    background-color: #dc3545;
    color: white;
    border: var(--pixel-border);
    padding: 8px 12px;
    font-family: 'Silkscreen', cursive;
    font-size: 0.8rem;
    cursor: pointer;
    box-shadow: 2px 2px 0 #000;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}

/* Botón para eliminar comentario */
.btn-eliminar {
    color: #dc3545;
    background: none;
    border: none;
    cursor: pointer;
    font-size: 1rem;
    transition: all 0.3s;
}

/* Efecto hover para botón eliminar */
.btn-eliminar:hover {
    transform: scale(1.1);
    color: #bd2130;
}

/* Formulario para responder a comentarios */
.respuesta-form {
    background-color: #f1f3f4;
    padding: 15px;
    margin-top: 15px;
    border: var(--pixel-border);
    position: relative;
}

/* Contenedor para acciones del formulario */
.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 10px;
}

/* Estado cuando no hay comentarios */
.no-comentarios {
    text-align: center;
    padding: 40px 20px;
}

/* Icono para estado sin comentarios */
.no-comentarios-icon {
    font-size: 3rem;
    color: #6c757d;
    margin-bottom: 15px;
}

/* Título para estado sin comentarios */
.no-comentarios h4 {
    color: var(--primary-blue);
    font-family: 'Press Start 2P', cursive;
    margin-bottom: 10px;
}

/* Texto descriptivo para estado sin comentarios */
.no-comentarios p {
    font-family: 'Silkscreen', cursive;
    color: #6c757d;
}

/* Modal personalizado con estilo pixel */
.modal-pixel {
    border: var(--pixel-border);
    box-shadow: var(--pixel-shadow);
    position: relative;
    background: white;
}

/* Encabezado del modal */
.modal-header {
    background: var(--primary-blue);
    color: white;
    padding: 20px;
    border-bottom: var(--pixel-border);
}

/* Título del modal */
.modal-header .modal-title {
    font-family: 'Press Start 2P', cursive;
    font-size: 0.9rem;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 10px;
}

/* Cuerpo del modal */
.modal-body {
    padding: 20px;
    font-family: 'Silkscreen', cursive;
}

/* Pie del modal con botones de acción */
.modal-footer {
    padding: 15px 20px;
    border-top: 2px dotted #dee2e6;
    display: flex;
    justify-content: flex-end;
    gap: 10px;
}

/* Botón de confirmación para eliminar */
.btn-eliminar-confirm {
    background-color: #dc3545;
    color: white;
    border: var(--pixel-border);
    padding: 10px 15px;
    font-family: 'Press Start 2P', cursive;
    font-size: 0.6rem;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    transition: all 0.3s;
    box-shadow: var(--pixel-shadow);
}

/* Efecto hover para botón de confirmación de eliminación */
.btn-eliminar-confirm:hover {
    background-color: #bd2130;
    transform: translate(-2px, -2px);
    box-shadow: 6px 6px 0 #000;
    color: white;
    text-decoration: none;
}

/* Media queries para diseño responsive en dispositivos móviles */
@media (max-width: 768px) {
    .comentario-header {
        flex-direction: column;
        gap: 10px;
    }
    
    .comentario-meta {
        flex-direction: column;
        align-items: flex-start;
        gap: 5px;
    }
    
    .comentario-acciones-inferiores {
        flex-wrap: wrap;
        gap: 10px;
    }
    
    .modal-footer {
        flex-direction: column;
    }
    
    .btn-publicar, .btn-cancelar, .btn-eliminar-confirm {
        width: 100%;
        justify-content: center;
    }
}

/* Animación de efecto glitch para elementos interactivos */
.comentario-item.glitch:hover {
    animation: glitch 0.3s infinite;
}

/* Definición de la animación glitch */
@keyframes glitch {
    0% { transform: translate(0); }
    20% { transform: translate(-2px, 2px); }
    40% { transform: translate(-2px, -2px); }
    60% { transform: translate(2px, 2px); }
    80% { transform: translate(2px, -2px); }
    100% { transform: translate(0); }
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
    
    // Manejar clic en botón "Responder"
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
    
    // Efecto de sonido para interacciones (opcional)
    document.querySelectorAll('.btn-like, .btn-dislike, .btn-responder, .btn-publicar').forEach(element => {
        element.addEventListener('mouseenter', function() {
            // Podrías agregar un sonido de videojuego aquí
            // new Audio('sounds/hover.wav').play();
        });
    });
});
</script>