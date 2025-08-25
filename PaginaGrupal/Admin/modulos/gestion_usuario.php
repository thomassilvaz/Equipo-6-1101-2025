<?php
// Procesar eliminación de usuario
if(isset($_POST['btn_eliminar'])){
    include "../conexion.php";
    $doc = $_POST['doc'];

    $eliminar = mysqli_query($conexion, "DELETE FROM usuarios WHERE `usuarios`.`doc` = $doc") or die($conexion."Error al eliminar!");

    echo '<div class="alert alert-success alert-dismissible fade show animated fadeIn" role="alert">
            <i class="fas fa-check-circle mr-2"></i>Usuario eliminado con éxito!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>';
    echo "<script>setTimeout(function() { window.location='index.php?mod=gestion_usuario'; }, 1500);</script>";
}

// Procesar actualización de usuario
if(isset($_POST['btn_actualizar'])){
    include "../conexion.php";
    
    $doc = $_POST['doc_modificar'];
    $nombre1 = $_POST['txt-pn'];
    $nombre2 = $_POST['txt-sn'];
    $apellido1 = $_POST['txt-pa'];
    $apellido2 = $_POST['txt-sa'];
    $telefono = $_POST['txt-tel'];
    $email = $_POST['txt-cr'];
    
    $actualizar = mysqli_query($conexion, "UPDATE usuarios SET 
        PNombre = '$nombre1',
        SNombre = '$nombre2',
        PApellido = '$apellido1',
        SApellido = '$apellido2',
        tel = '$telefono',
        email = '$email'
        WHERE doc = '$doc'") or die($conexion."Error al actualizar");
    
    echo '<div class="alert alert-success alert-dismissible fade show animated fadeIn" role="alert">
            <i class="fas fa-check-circle mr-2"></i>Usuario actualizado con éxito!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>';
    echo "<script>setTimeout(function() { window.location='index.php?mod=gestion_usuario'; }, 1500);</script>";
}
?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800" style="color: var(--primary-blue);">
        <i class="fas fa-users mr-2"></i>Gestión de Usuarios
    </h1>

    <div class="card shadow mb-4 custom-card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);">
            <h6 class="m-0 font-weight-bold text-white"><i class="fas fa-search mr-2"></i>Buscar Usuarios</h6>
            <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-white"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                    <div class="dropdown-header">Opciones de búsqueda:</div>
                    <a class="dropdown-item" href="#"><i class="fas fa-user-plus mr-1"></i> Buscar por nombre</a>
                    <a class="dropdown-item" href="#"><i class="fas fa-id-card mr-1"></i> Buscar por documento</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#"><i class="fas fa-filter mr-1"></i> Filtrar por rol</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="index.php?mod=gestion_usuario" method="post">
                <div class="input-group search-container">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Buscar por nombre" name="txt_nom">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit" name="btn_buscar">
                            <i class="fas fa-search mr-1"></i> Buscar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php
    if(isset($_POST['btn_buscar'])){
        include "../conexion.php";
        $dato = $_POST['txt_nom'];

        $consulta = mysqli_query($conexion, "SELECT * FROM usuarios WHERE PNombre LIKE '$dato%'") or die($conexion."Error en la consulta.");
     
        if(mysqli_num_rows($consulta) > 0){
    ?>
    <div class="card shadow mb-4 custom-card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);">
            <h6 class="m-0 font-weight-bold text-white"><i class="fas fa-list mr-2"></i>Resultados de la Búsqueda</h6>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr class="table-header">
                            <th><i class="fas fa-id-card mr-1"></i> Tipo documento</th>
                            <th><i class="fas fa-fingerprint mr-1"></i> Documento</th>
                            <th><i class="fas fa-user mr-1"></i> Primer nombre</th>
                            <th><i class="fas fa-user mr-1"></i> Segundo nombre</th>
                            <th><i class="fas fa-user-tag mr-1"></i> Primer apellido</th>
                            <th><i class="fas fa-user-tag mr-1"></i> Segundo apellido</th>
                            <th><i class="fas fa-envelope mr-1"></i> Correo</th>
                            <th><i class="fas fa-phone mr-1"></i> Teléfono</th>
                            <th><i class="fas fa-user-shield mr-1"></i> Rol</th>
                            <th><i class="fas fa-cogs mr-1"></i> Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while($row = mysqli_fetch_array($consulta)){
                        ?>
                        <tr class="table-row animated fadeIn">
                            <td><?php echo $row['tipo_documento'] ?></td>
                            <td><span class="badge badge-primary"><?php echo $row['doc'] ?></span></td>
                            <td><?php echo $row['PNombre'] ?></td>
                            <td><?php echo $row['SNombre'] ?></td>
                            <td><?php echo $row['PApellido'] ?></td>
                            <td><?php echo $row['SApellido'] ?></td>
                            <td><a href="mailto:<?php echo $row['email'] ?>" class="email-link"><?php echo $row['email'] ?></a></td>
                            <td><?php echo $row['tel'] ?></td>
                            <td>
                                <?php 
                                $rol_class = '';
                                switch($row['Id_rol']) {
                                    case 1: $rol_class = 'badge-danger'; break;
                                    case 2: $rol_class = 'badge-warning'; break;
                                    case 3: $rol_class = 'badge-info'; break;
                                    default: $rol_class = 'badge-secondary';
                                }
                                ?>
                                <span class="badge <?php echo $rol_class; ?>"><?php echo $row['Id_rol'] ?></span>
                            </td>
                            <td>
                                <div class="d-flex action-buttons">
                                    <form action="index.php?mod=gestion_usuario" method="post" class="mr-2">
                                        <input type="hidden" name="doc" value="<?php echo $row['doc']; ?>">
                                        <button type="submit" name="btn_modificar" class="btn btn-primary btn-circle btn-sm action-btn edit-btn" title="Editar usuario">    
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </form>
                                    <button type="button" class="btn btn-danger btn-circle btn-sm action-btn delete-btn delete-trigger" 
                                            data-doc="<?php echo $row['doc']; ?>" 
                                            data-name="<?php echo $row['PNombre'] . ' ' . $row['PApellido']; ?>"
                                            title="Eliminar usuario">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php
        } else {
            echo '<div class="alert alert-warning animated fadeIn">
                    <i class="fas fa-exclamation-triangle mr-2"></i>No se encontraron resultados para su búsqueda
                  </div>';
        }
    } else {
        echo '<div class="alert alert-info animated fadeIn">
                <i class="fas fa-info-circle mr-2"></i>Ingrese un nombre para buscar usuarios en el sistema
              </div>';
    }
    ?>
</div>

<!-- Modal de Confirmación de Eliminación -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel"><i class="fas fa-exclamation-triangle text-warning mr-2"></i>Confirmar Eliminación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <div class="delete-icon-container">
                        <i class="fas fa-user-slash"></i>
                    </div>
                </div>
                <p>¿Estás seguro de que deseas eliminar al usuario <strong id="userName"></strong>?</p>
                <p class="text-danger"><i class="fas fa-exclamation-circle mr-1"></i>Esta acción no se puede deshacer.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times mr-1"></i> Cancelar
                </button>
                <form id="deleteForm" method="post" action="index.php?mod=gestion_usuario">
                    <input type="hidden" name="doc" id="docToDelete">
                    <button type="submit" name="btn_eliminar" class="btn btn-danger">
                        <i class="fas fa-trash mr-1"></i> Eliminar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
if(isset($_POST['btn_modificar'])){
    include "../conexion.php";
    $doc = $_POST['doc'];

    $consulta2 = mysqli_query($conexion, "SELECT * FROM usuarios WHERE doc = '$doc'") or die($conexion."Error en la consulta.");
    while($row2 = mysqli_fetch_array($consulta2)){
?>
<div class="container-fluid animated fadeIn">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800" style="color: var(--primary-blue);">
            <i class="fas fa-user-edit mr-2"></i>Modificar Usuario
        </h1>
        <a href="index.php?mod=gestion_usuario" class="btn btn-secondary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-arrow-left"></i>
            </span>
            <span class="text">Volver</span>
        </a>
    </div>
    
    <div class="row">
        <div class="col-xl-10 col-lg-12 mx-auto">
            <div class="card shadow mb-4 custom-card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);">
                    <h6 class="m-0 font-weight-bold text-white"><i class="fas fa-user-cog mr-2"></i>EDITAR INFORMACIÓN DE USUARIO</h6>
                </div>
                
                <div class="card-body">
                    <form class="user" action="index.php?mod=gestion_usuario" method="post">
                        <input type="hidden" name="doc_modificar" value="<?php echo $row2['doc']; ?>">
                        
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="form-section-title">
                                    <i class="fas fa-id-card"></i> Información de Identificación
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <!-- Tipo de Documento (no editable) -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><i class="fas fa-address-card mr-1"></i> Tipo de Documento</label>
                                    <input type="text" class="form-control form-control-user custom-input" readonly
                                        value="<?php 
                                            switch($row2['tipo_documento']) {
                                                case 'CC': echo 'CÉDULA DE CIUDADANÍA'; break;
                                                case 'TI': echo 'TARJETA DE IDENTIFICACIÓN'; break;
                                                case 'CE': echo 'CÉDULA DE EXTRANJERÍA'; break;
                                                default: echo 'DESCONOCIDO';
                                            }
                                        ?>">
                                    <input type="hidden" name="cmb-tp" value="<?php echo $row2['tipo_documento']; ?>">
                                </div>
                            </div>
            
                            <!-- Número de Identificación -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><i class="fas fa-fingerprint mr-1"></i> Número de Identificación</label>
                                    <input type="text" class="form-control form-control-user custom-input" 
                                        placeholder="NÚMERO DE IDENTIFICACIÓN" value="<?php echo $row2['doc']; ?>" required readonly>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-4 mt-4">
                            <div class="col-md-12">
                                <div class="form-section-title">
                                    <i class="fas fa-user"></i> Información Personal
                                </div>
                            </div>
                        </div>
        
                        <!-- Nombres -->
                        <div class="row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <div class="form-group">
                                    <label><i class="fas fa-signature mr-1"></i> Primer Nombre</label>
                                    <input type="text" class="form-control form-control-user custom-input" name="txt-pn" 
                                        placeholder="PRIMER NOMBRE" value="<?php echo $row2['PNombre']; ?>" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label><i class="fas fa-signature mr-1"></i> Segundo Nombre</label>
                                    <input type="text" class="form-control form-control-user custom-input" name="txt-sn" 
                                        placeholder="SEGUNDO NOMBRE" value="<?php echo $row2['SNombre']; ?>">
                                </div>
                            </div>
                        </div>
        
                        <!-- Apellidos -->
                        <div class="row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <div class="form-group">
                                    <label><i class="fas fa-signature mr-1"></i> Primer Apellido</label>
                                    <input type="text" class="form-control form-control-user custom-input" name="txt-pa" 
                                        placeholder="PRIMER APELLIDO" value="<?php echo $row2['PApellido']; ?>" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label><i class="fas fa-signature mr-1"></i> Segundo Apellido</label>
                                    <input type="text" class="form-control form-control-user custom-input" name="txt-sa" 
                                        placeholder="SEGUNDO APELLIDO" value="<?php echo $row2['SApellido']; ?>">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-4 mt-4">
                            <div class="col-md-12">
                                <div class="form-section-title">
                                    <i class="fas fa-address-book"></i> Información de Contacto
                                </div>
                            </div>
                        </div>
        
                        <!-- Contacto -->
                        <div class="row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <div class="form-group">
                                    <label><i class="fas fa-phone mr-1"></i> Teléfono</label>
                                    <input type="tel" class="form-control form-control-user custom-input" name="txt-tel" 
                                        placeholder="TELÉFONO" value="<?php echo $row2['tel']; ?>" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label><i class="fas fa-envelope mr-1"></i> Correo Electrónico</label>
                                    <input type="email" class="form-control form-control-user custom-input" name="txt-cr" 
                                        placeholder="CORREO ELECTRÓNICO" value="<?php echo $row2['email']; ?>" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-4 mt-4">
                            <div class="col-md-12">
                                <div class="form-section-title">
                                    <i class="fas fa-user-tag"></i> Información de Acceso
                                </div>
                            </div>
                        </div>
        
                        <!-- Rol del Usuario (no editable) -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><i class="fas fa-user-shield mr-1"></i> Rol del Usuario</label>
                                    <input type="text" class="form-control form-control-user custom-input" readonly
                                        value="<?php 
                                            switch($row2['Id_rol']) {
                                                case 1: echo 'ADMINISTRADOR'; break;
                                                case 2: echo 'OPERARIO'; break;
                                                case 3: echo 'ASESOR'; break;
                                                default: echo 'DESCONOCIDO';
                                            }
                                        ?>">
                                    <input type="hidden" name="cmb-rol" value="<?php echo $row2['Id_rol']; ?>">
                                </div>
                            </div>
                        </div>
        
                        <!-- Contraseña (oculta) -->
                        <input type="hidden" name="txt-ct" value="<?php echo $row2['clave']; ?>">
        
                        <!-- Botón de Actualización -->
                        <div class="row mt-5">
                            <div class="col-md-12 text-center">
                                <button type="submit" name="btn_actualizar" class="btn btn-primary btn-user btn-update">
                                    <i class="fas fa-save mr-2"></i> ACTUALIZAR USUARIO
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> 
</div>
<?php
    }
}
?>

<style>
/* Variables de colores y estilos */
:root {
    --primary-blue: #0056b3;
    --secondary-blue: #51a4e7;
    --accent-yellow: #ffc107;
    --light-gray: #f8f9fa;
    --dark-text: #212529;
    --white: #ffffff;
    --success-green: #28a745;
    --danger-red: #dc3545;
    --warning-orange: #fd7e14;
    --info-cyan: #17a2b8;
}

/* Estilos generales */
.custom-card {
    border: none;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
}

.custom-card:hover {
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    transform: translateY(-2px);
}

/* Barra de búsqueda */
.search-container {
    max-width: 500px;
    margin: 0 auto;
}

.search-container .input-group-text {
    background: var(--primary-blue);
    color: white;
    border: none;
    border-radius: 8px 0 0 8px;
}

.search-container .form-control {
    border-radius: 0 8px 8px 0;
    border: 1px solid #ced4da;
    padding: 12px 15px;
    transition: all 0.3s;
}

.search-container .form-control:focus {
    box-shadow: 0 0 0 0.2rem rgba(0, 86, 179, 0.25);
    border-color: var(--secondary-blue);
}

/* Tabla de usuarios */
.table-header {
    background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
    color: white;
}

.table-header th {
    border: none;
    padding: 15px;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.85rem;
    letter-spacing: 0.5px;
}

.table-row {
    transition: all 0.3s ease;
}

.table-row:hover {
    background-color: rgba(0, 86, 179, 0.05);
    transform: scale(1.005);
}

.table td {
    padding: 15px;
    vertical-align: middle;
    border-color: #e3eaef;
}

.table td:first-child {
    border-radius: 8px 0 0 8px;
}

.table td:last-child {
    border-radius: 0 8px 8px 0;
}

/* Badges */
.badge {
    padding: 7px 10px;
    border-radius: 20px;
    font-weight: 500;
    font-size: 0.75rem;
}

.badge-primary {
    background: var(--primary-blue);
}

.badge-danger {
    background: var(--danger-red);
}

.badge-warning {
    background: var(--warning-orange);
    color: #212529;
}

.badge-info {
    background: var(--info-cyan);
}

/* Botones de acción */
.action-buttons {
    justify-content: center;
}

.action-btn {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    border: none;
}

.edit-btn {
    background: var(--secondary-blue);
}

.edit-btn:hover {
    background: var(--primary-blue);
    transform: scale(1.1);
}

.delete-btn {
    background: var(--danger-red);
}

.delete-btn:hover {
    background: #bd2130;
    transform: scale(1.1);
}

/* Enlaces de correo */
.email-link {
    color: var(--primary-blue);
    text-decoration: none;
    transition: all 0.3s;
}

.email-link:hover {
    color: var(--secondary-blue);
    text-decoration: underline;
}

/* Modal de confirmación */
.modal-content {
    border-radius: 12px;
    border: none;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
}

.modal-header {
    background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
    color: white;
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
    padding: 15px 20px;
}

.delete-icon-container {
    display: inline-block;
    width: 70px;
    height: 70px;
    background: rgba(220, 53, 69, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 15px;
}

.delete-icon-container i {
    font-size: 30px;
    color: var(--danger-red);
}

.modal-body {
    padding: 25px;
}

.modal-footer {
    border-top: 1px solid #e9ecef;
    padding: 15px 25px;
}

/* Formulario de modificación */
.form-section-title {
    background: linear-gradient(to right, var(--primary-blue), var(--secondary-blue));
    color: white;
    padding: 12px 20px;
    border-radius: 8px;
    font-weight: 600;
    margin-bottom: 20px;
}

.custom-input {
    border-radius: 8px;
    padding: 12px 15px;
    border: 1px solid #dce4ec;
    transition: all 0.3s;
}

.custom-input:focus {
    border-color: var(--secondary-blue);
    box-shadow: 0 0 0 0.2rem rgba(81, 164, 231, 0.25);
}

.btn-update {
    background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
    border: none;
    border-radius: 8px;
    padding: 12px 30px;
    font-weight: 600;
    font-size: 1.1rem;
    transition: all 0.3s;
    box-shadow: 0 4px 8px rgba(0, 86, 179, 0.3);
}

.btn-update:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(0, 86, 179, 0.4);
}

/* Animaciones */
.animated {
    animation-duration: 0.5s;
    animation-fill-mode: both;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.fadeIn {
    animation-name: fadeIn;
}

@keyframes slideInDown {
    from {
        transform: translate3d(0, -20px, 0);
        opacity: 0;
    }
    to {
        transform: translate3d(0, 0, 0);
        opacity: 1;
    }
}

.slideInDown {
    animation-name: slideInDown;
}

/* Responsive */
@media (max-width: 768px) {
    .table-responsive {
        border: none;
    }
    
    .action-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .action-btn {
        margin-bottom: 5px;
    }
    
    .search-container {
        flex-direction: column;
    }
    
    .search-container .input-group-prepend,
    .search-container .input-group-append {
        width: 100%;
    }
    
    .search-container .input-group-text {
        border-radius: 8px 8px 0 0;
        width: 100%;
        justify-content: center;
    }
    
    .search-container .input-group-append .btn {
        border-radius: 0 0 8px 8px;
        width: 100%;
        margin-top: -1px;
    }
}
</style>

<script>
// Script para el modal de confirmación de eliminación
document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.delete-trigger');
    const deleteForm = document.getElementById('deleteForm');
    const docToDelete = document.getElementById('docToDelete');
    const userName = document.getElementById('userName');
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const doc = this.getAttribute('data-doc');
            const name = this.getAttribute('data-name');
            docToDelete.value = doc;
            userName.textContent = name;
            deleteModal.show();
        });
    });
    
    // Efectos de animación para las filas de la tabla
    const tableRows = document.querySelectorAll('.table-row');
    tableRows.forEach((row, index) => {
        row.style.animationDelay = `${index * 0.05}s`;
    });
});
</script>