<?php
// Procesar eliminación de usuario
if(isset($_POST['btn_eliminar'])){
    include "../conexion.php";
    $doc = $_POST['doc'];

    $eliminar = mysqli_query($conexion, "DELETE FROM usuarios WHERE `usuarios`.`doc` = $doc") or die($conexion."Error al eliminar!");

    echo '<div class="alert alert-success alert-dismissible fade show animated fadeIn" role="alert" style="border: var(--pixel-border); background-color: #d4edda; color: #155724; font-family: \'Silkscreen\', cursive; box-shadow: var(--pixel-shadow);">
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
    
    echo '<div class="alert alert-success alert-dismissible fade show animated fadeIn" role="alert" style="border: var(--pixel-border); background-color: #d4edda; color: #155724; font-family: \'Silkscreen\', cursive; box-shadow: var(--pixel-shadow);">
            <i class="fas fa-check-circle mr-2"></i>Usuario actualizado con éxito!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>';
    echo "<script>setTimeout(function() { window.location='index.php?mod=gestion_usuario'; }, 1500);</script>";
}
?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800" style="color: var(--primary-blue); font-family: 'Press Start 2P', cursive; text-shadow: 2px 2px 0 #000; border: var(--pixel-border); background-color: var(--white); padding: 15px; box-shadow: var(--pixel-shadow);">
        <i class="fas fa-users mr-2"></i>Gestión de Usuarios
    </h1>

    <div class="card shadow mb-4 glitch" style="border-radius: 0; border: var(--pixel-border); background-color: white; box-shadow: var(--pixel-shadow); position: relative;">
        <div class="pixel-corner pixel-corner-tl"></div>
        <div class="pixel-corner pixel-corner-tr"></div>
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background: var(--primary-blue); border-bottom: var(--pixel-border);">
            <h6 class="m-0 font-weight-bold text-white" style="font-family: 'Press Start 2P', cursive; text-shadow: 2px 2px 0 #000; color: var(--accent-yellow) !important;"><i class="fas fa-search mr-2"></i>Buscar Usuarios</h6>
            <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-white"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="border: var(--pixel-border); font-family: 'Silkscreen', cursive; box-shadow: var(--pixel-shadow);">
                    <div class="dropdown-header" style="font-family: 'Press Start 2P', cursive;">Opciones de búsqueda:</div>
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
                        <span class="input-group-text" style="background: var(--primary-blue); color: white; border: var(--pixel-border); border-radius: 0; font-family: 'Silkscreen', cursive;"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Buscar por nombre" name="txt_nom" style="border: var(--pixel-border); border-radius: 0; font-family: 'Silkscreen', cursive; box-shadow: var(--pixel-shadow);">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit" name="btn_buscar" style="background: var(--primary-blue); border: var(--pixel-border); border-radius: 0; font-family: 'Press Start 2P', cursive; text-shadow: 2px 2px 0 #000; box-shadow: var(--pixel-shadow);">
                            <i class="fas fa-search mr-1"></i> Buscar
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="pixel-corner pixel-corner-bl"></div>
        <div class="pixel-corner pixel-corner-br"></div>
    </div>

    <?php
    if(isset($_POST['btn_buscar'])){
        include "../conexion.php";
        $dato = $_POST['txt_nom'];

        $consulta = mysqli_query($conexion, "SELECT * FROM usuarios WHERE PNombre LIKE '$dato%'") or die($conexion."Error en la consulta.");
     
        if(mysqli_num_rows($consulta) > 0){
    ?>
    <div class="card shadow mb-4 glitch" style="border-radius: 0; border: var(--pixel-border); background-color: white; box-shadow: var(--pixel-shadow); position: relative;">
        <div class="pixel-corner pixel-corner-tl"></div>
        <div class="pixel-corner pixel-corner-tr"></div>
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background: var(--primary-blue); border-bottom: var(--pixel-border);">
            <h6 class="m-0 font-weight-bold text-white" style="font-family: 'Press Start 2P', cursive; text-shadow: 2px 2px 0 #000; color: var(--accent-yellow) !important;"><i class="fas fa-list mr-2"></i>Resultados de la Búsqueda</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0" style="border: var(--pixel-border); font-family: 'Silkscreen', cursive;">
                    <thead>
                        <tr class="table-header" style="background: var(--primary-blue); color: white;">
                            <th style="border: var(--pixel-border); font-family: 'Press Start 2P', cursive; text-shadow: 2px 2px 0 #000;"><i class="fas fa-id-card mr-1"></i> Tipo documento</th>
                            <th style="border: var(--pixel-border); font-family: 'Press Start 2P', cursive; text-shadow: 2px 2px 0 #000;"><i class="fas fa-fingerprint mr-1"></i> Documento</th>
                            <th style="border: var(--pixel-border); font-family: 'Press Start 2P', cursive; text-shadow: 2px 2px 0 #000;"><i class="fas fa-user mr-1"></i> Primer nombre</th>
                            <th style="border: var(--pixel-border); font-family: 'Press Start 2P', cursive; text-shadow: 2px 2px 0 #000;"><i class="fas fa-user mr-1"></i> Segundo nombre</th>
                            <th style="border: var(--pixel-border); font-family: 'Press Start 2P', cursive; text-shadow: 2px 2px 0 #000;"><i class="fas fa-user-tag mr-1"></i> Primer apellido</th>
                            <th style="border: var(--pixel-border); font-family: 'Press Start 2P', cursive; text-shadow: 2px 2px 0 #000;"><i class="fas fa-user-tag mr-1"></i> Segundo apellido</th>
                            <th style="border: var(--pixel-border); font-family: 'Press Start 2P', cursive; text-shadow: 2px 2px 0 #000;"><i class="fas fa-envelope mr-1"></i> Correo</th>
                            <th style="border: var(--pixel-border); font-family: 'Press Start 2P', cursive; text-shadow: 2px 2px 0 #000;"><i class="fas fa-phone mr-1"></i> Teléfono</th>
                            <th style="border: var(--pixel-border); font-family: 'Press Start 2P', cursive; text-shadow: 2px 2px 0 #000;"><i class="fas fa-user-shield mr-1"></i> Rol</th>
                            <th style="border: var(--pixel-border); font-family: 'Press Start 2P', cursive; text-shadow: 2px 2px 0 #000;"><i class="fas fa-cogs mr-1"></i> Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while($row = mysqli_fetch_array($consulta)){
                        ?>
                        <tr class="table-row animated fadeIn" style="border: var(--pixel-border);">
                            <td style="border: var(--pixel-border);"><?php echo $row['tipo_documento'] ?></td>
                            <td style="border: var(--pixel-border);"><span class="badge badge-primary" style="background: var(--primary-blue); border: var(--pixel-border); font-family: 'Press Start 2P', cursive; text-shadow: 2px 2px 0 #000; border-radius: 0; padding: 5px 10px;"><?php echo $row['doc'] ?></span></td>
                            <td style="border: var(--pixel-border);"><?php echo $row['PNombre'] ?></td>
                            <td style="border: var(--pixel-border);"><?php echo $row['SNombre'] ?></td>
                            <td style="border: var(--pixel-border);"><?php echo $row['PApellido'] ?></td>
                            <td style="border: var(--pixel-border);"><?php echo $row['SApellido'] ?></td>
                            <td style="border: var(--pixel-border);"><a href="mailto:<?php echo $row['email'] ?>" class="email-link" style="color: var(--primary-blue); text-decoration: none; font-family: 'Silkscreen', cursive;"><?php echo $row['email'] ?></a></td>
                            <td style="border: var(--pixel-border);"><?php echo $row['tel'] ?></td>
                            <td style="border: var(--pixel-border);">
                                <?php 
                                $rol_class = '';
                                switch($row['Id_rol']) {
                                    case 1: $rol_class = 'badge-danger'; break;
                                    case 2: $rol_class = 'badge-warning'; break;
                                    case 3: $rol_class = 'badge-info'; break;
                                    default: $rol_class = 'badge-secondary';
                                }
                                ?>
                                <span class="badge <?php echo $rol_class; ?>" style="border: var(--pixel-border); font-family: 'Press Start 2P', cursive; text-shadow: 2px 2px 0 #000; border-radius: 0; padding: 5px 10px;"><?php echo $row['Id_rol'] ?></span>
                            </td>
                            <td style="border: var(--pixel-border);">
                                <div class="d-flex action-buttons">
                                    <form action="index.php?mod=gestion_usuario" method="post" class="mr-2">
                                        <input type="hidden" name="doc" value="<?php echo $row['doc']; ?>">
                                        <button type="submit" name="btn_modificar" class="btn btn-primary btn-circle btn-sm action-btn edit-btn glitch" title="Editar usuario" style="background: var(--secondary-blue); border: var(--pixel-border); border-radius: 0; width: 35px; height: 35px; box-shadow: var(--pixel-shadow);">    
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </form>
                                    <button type="button" class="btn btn-danger btn-circle btn-sm action-btn delete-btn delete-trigger glitch" 
                                            data-doc="<?php echo $row['doc']; ?>" 
                                            data-name="<?php echo $row['PNombre'] . ' ' . $row['PApellido']; ?>"
                                            title="Eliminar usuario"
                                            style="background: #dc3545; border: var(--pixel-border); border-radius: 0; width: 35px; height: 35px; box-shadow: var(--pixel-shadow);">
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
        <div class="pixel-corner pixel-corner-bl"></div>
        <div class="pixel-corner pixel-corner-br"></div>
    </div>
    <?php
        } else {
            echo '<div class="alert alert-warning animated fadeIn" style="border: var(--pixel-border); background-color: #fff3cd; color: #856404; font-family: \'Silkscreen\', cursive; box-shadow: var(--pixel-shadow);">
                    <i class="fas fa-exclamation-triangle mr-2"></i>No se encontraron resultados para su búsqueda
                  </div>';
        }
    } else {
        echo '<div class="alert alert-info animated fadeIn" style="border: var(--pixel-border); background-color: #d1ecf1; color: #0c5460; font-family: \'Silkscreen\', cursive; box-shadow: var(--pixel-shadow);">
                <i class="fas fa-info-circle mr-2"></i>Ingrese un nombre para buscar usuarios en el sistema
              </div>';
    }
    ?>
</div>

<!-- Modal de Confirmación de Eliminación -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border: var(--pixel-border); box-shadow: var(--pixel-shadow); font-family: 'Silkscreen', cursive;">
            <div class="modal-header" style="background: var(--primary-blue); border-bottom: var(--pixel-border);">
                <h5 class="modal-title" id="deleteModalLabel" style="font-family: 'Press Start 2P', cursive; text-shadow: 2px 2px 0 #000; color: var(--accent-yellow);"><i class="fas fa-exclamation-triangle text-warning mr-2"></i>Confirmar Eliminación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <div class="delete-icon-container" style="display: inline-block; width: 70px; height: 70px; background: rgba(220, 53, 69, 0.1); border: var(--pixel-border); display: flex; align-items: center; justify-content: center; margin-bottom: 15px;">
                        <i class="fas fa-user-slash" style="font-size: 30px; color: #dc3545;"></i>
                    </div>
                </div>
                <p>¿Estás seguro de que deseas eliminar al usuario <strong id="userName"></strong>?</p>
                <p class="text-danger"><i class="fas fa-exclamation-circle mr-1"></i>Esta acción no se puede deshacer.</p>
            </div>
            <div class="modal-footer" style="border-top: var(--pixel-border);">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background: #6c757d; border: var(--pixel-border); border-radius: 0; font-family: 'Press Start 2P', cursive; text-shadow: 2px 2px 0 #000; box-shadow: var(--pixel-shadow);">
                    <i class="fas fa-times mr-1"></i> Cancelar
                </button>
                <form id="deleteForm" method="post" action="index.php?mod=gestion_usuario">
                    <input type="hidden" name="doc" id="docToDelete">
                    <button type="submit" name="btn_eliminar" class="btn btn-danger glitch" style="background: #dc3545; border: var(--pixel-border); border-radius: 0; font-family: 'Press Start 2P', cursive; text-shadow: 2px 2px 0 #000; box-shadow: var(--pixel-shadow);">
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
        <h1 class="h3 mb-0 text-gray-800" style="color: var(--primary-blue); font-family: 'Press Start 2P', cursive; text-shadow: 2px 2px 0 #000; border: var(--pixel-border); background-color: var(--white); padding: 15px; box-shadow: var(--pixel-shadow);">
            <i class="fas fa-user-edit mr-2"></i>Modificar Usuario
        </h1>
        <a href="index.php?mod=gestion_usuario" class="btn btn-secondary btn-icon-split glitch" style="background: #6c757d; border: var(--pixel-border); border-radius: 0; font-family: 'Press Start 2P', cursive; text-shadow: 2px 2px 0 #000; box-shadow: var(--pixel-shadow);">
            <span class="icon text-white-50">
                <i class="fas fa-arrow-left"></i>
            </span>
            <span class="text">Volver</span>
        </a>
    </div>
    
    <div class="row">
        <div class="col-xl-10 col-lg-12 mx-auto">
            <div class="card shadow mb-4 glitch" style="border-radius: 0; border: var(--pixel-border); background-color: white; box-shadow: var(--pixel-shadow); position: relative;">
                <div class="pixel-corner pixel-corner-tl"></div>
                <div class="pixel-corner pixel-corner-tr"></div>
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" style="background: var(--primary-blue); border-bottom: var(--pixel-border);">
                    <h6 class="m-0 font-weight-bold text-white" style="font-family: 'Press Start 2P', cursive; text-shadow: 2px 2px 0 #000; color: var(--accent-yellow) !important;"><i class="fas fa-user-cog mr-2"></i>EDITAR INFORMACIÓN DE USUARIO</h6>
                </div>
                
                <div class="card-body">
                    <form class="user" action="index.php?mod=gestion_usuario" method="post">
                        <input type="hidden" name="doc_modificar" value="<?php echo $row2['doc']; ?>">
                        
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="form-section-title" style="background: var(--primary-blue); color: white; padding: 12px 20px; border: var(--pixel-border); font-family: 'Press Start 2P', cursive; text-shadow: 2px 2px 0 #000; margin-bottom: 20px;">
                                    <i class="fas fa-id-card"></i> Información de Identificación
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <!-- Tipo de Documento (no editable) -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="font-family: 'Press Start 2P', cursive; font-size: 0.8rem; text-shadow: 1px 1px 0 #000; color: var(--primary-blue);"><i class="fas fa-address-card mr-1"></i> Tipo de Documento</label>
                                    <input type="text" class="form-control form-control-user custom-input" readonly
                                        value="<?php 
                                            switch($row2['tipo_documento']) {
                                                case 'CC': echo 'CÉDULA DE CIUDADANÍA'; break;
                                                case 'TI': echo 'TARJETA DE IDENTIFICACIÓN'; break;
                                                case 'CE': echo 'CÉDULA DE EXTRANJERÍA'; break;
                                                default: echo 'DESCONOCIDO';
                                            }
                                        ?>"
                                        style="border: var(--pixel-border); border-radius: 0; padding: 12px; font-family: 'Silkscreen', cursive; box-shadow: var(--pixel-shadow);">
                                    <input type="hidden" name="cmb-tp" value="<?php echo $row2['tipo_documento']; ?>">
                                </div>
                            </div>
            
                            <!-- Número de Identificación -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="font-family: 'Press Start 2P', cursive; font-size: 0.8rem; text-shadow: 1px 1px 0 #000; color: var(--primary-blue);"><i class="fas fa-fingerprint mr-1"></i> Número de Identificación</label>
                                    <input type="text" class="form-control form-control-user custom-input" 
                                        placeholder="NÚMERO DE IDENTIFICACIÓN" value="<?php echo $row2['doc']; ?>" required readonly
                                        style="border: var(--pixel-border); border-radius: 0; padding: 12px; font-family: 'Silkscreen', cursive; box-shadow: var(--pixel-shadow);">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-4 mt-4">
                            <div class="col-md-12">
                                <div class="form-section-title" style="background: var(--primary-blue); color: white; padding: 12px 20px; border: var(--pixel-border); font-family: 'Press Start 2P', cursive; text-shadow: 2px 2px 0 #000; margin-bottom: 20px;">
                                    <i class="fas fa-user"></i> Información Personal
                                </div>
                            </div>
                        </div>
        
                        <!-- Nombres -->
                        <div class="row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <div class="form-group">
                                    <label style="font-family: 'Press Start 2P', cursive; font-size: 0.8rem; text-shadow: 1px 1px 0 #000; color: var(--primary-blue);"><i class="fas fa-signature mr-1"></i> Primer Nombre</label>
                                    <input type="text" class="form-control form-control-user custom-input" name="txt-pn" 
                                        placeholder="PRIMER NOMBRE" value="<?php echo $row2['PNombre']; ?>" required
                                        style="border: var(--pixel-border); border-radius: 0; padding: 12px; font-family: 'Silkscreen', cursive; box-shadow: var(--pixel-shadow);">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label style="font-family: 'Press Start 2P', cursive; font-size: 0.8rem; text-shadow: 1px 1px 0 #000; color: var(--primary-blue);"><i class="fas fa-signature mr-1"></i> Segundo Nombre</label>
                                    <input type="text" class="form-control form-control-user custom-input" name="txt-sn" 
                                        placeholder="SEGUNDO NOMBRE" value="<?php echo $row2['SNombre']; ?>"
                                        style="border: var(--pixel-border); border-radius: 0; padding: 12px; font-family: 'Silkscreen', cursive; box-shadow: var(--pixel-shadow);">
                                </div>
                            </div>
                        </div>
        
                        <!-- Apellidos -->
                        <div class="row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <div class="form-group">
                                    <label style="font-family: 'Press Start 2P', cursive; font-size: 0.8rem; text-shadow: 1px 1px 0 #000; color: var(--primary-blue);"><i class="fas fa-signature mr-1"></i> Primer Apellido</label>
                                    <input type="text" class="form-control form-control-user custom-input" name="txt-pa" 
                                        placeholder="PRIMER APELLIDO" value="<?php echo $row2['PApellido']; ?>" required
                                        style="border: var(--pixel-border); border-radius: 0; padding: 12px; font-family: 'Silkscreen', cursive; box-shadow: var(--pixel-shadow);">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label style="font-family: 'Press Start 2P', cursive; font-size: 0.8rem; text-shadow: 1px 1px 0 #000; color: var(--primary-blue);"><i class="fas fa-signature mr-1"></i> Segundo Apellido</label>
                                    <input type="text" class="form-control form-control-user custom-input" name="txt-sa" 
                                        placeholder="SEGUNDO APELLIDO" value="<?php echo $row2['SApellido']; ?>"
                                        style="border: var(--pixel-border); border-radius: 0; padding: 12px; font-family: 'Silkscreen', cursive; box-shadow: var(--pixel-shadow);">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-4 mt-4">
                            <div class="col-md-12">
                                <div class="form-section-title" style="background: var(--primary-blue); color: white; padding: 12px 20px; border: var(--pixel-border); font-family: 'Press Start 2P', cursive; text-shadow: 2px 2px 0 #000; margin-bottom: 20px;">
                                    <i class="fas fa-address-book"></i> Información de Contacto
                                </div>
                            </div>
                        </div>
        
                        <!-- Contacto -->
                        <div class="row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <div class="form-group">
                                    <label style="font-family: 'Press Start 2P', cursive; font-size: 0.8rem; text-shadow: 1px 1px 0 #000; color: var(--primary-blue);"><i class="fas fa-phone mr-1"></i> Teléfono</label>
                                    <input type="tel" class="form-control form-control-user custom-input" name="txt-tel" 
                                        placeholder="TELÉFONO" value="<?php echo $row2['tel']; ?>" required
                                        style="border: var(--pixel-border); border-radius: 0; padding: 12px; font-family: 'Silkscreen', cursive; box-shadow: var(--pixel-shadow);">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label style="font-family: 'Press Start 2P', cursive; font-size: 0.8rem; text-shadow: 1px 1px 0 #000; color: var(--primary-blue);"><i class="fas fa-envelope mr-1"></i> Correo Electrónico</label>
                                    <input type="email" class="form-control form-control-user custom-input" name="txt-cr" 
                                        placeholder="CORREO ELECTRÓNICO" value="<?php echo $row2['email']; ?>" required
                                        style="border: var(--pixel-border); border-radius: 0; padding: 12px; font-family: 'Silkscreen', cursive; box-shadow: var(--pixel-shadow);">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mb-4 mt-4">
                            <div class="col-md-12">
                                <div class="form-section-title" style="background: var(--primary-blue); color: white; padding: 12px 20px; border: var(--pixel-border); font-family: 'Press Start 2P', cursive; text-shadow: 2px 2px 0 #000; margin-bottom: 20px;">
                                    <i class="fas fa-user-tag"></i> Información de Acceso
                                </div>
                            </div>
                        </div>
        
                        <!-- Rol del Usuario (no editable) -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label style="font-family: 'Press Start 2P', cursive; font-size: 0.8rem; text-shadow: 1px 1px 0 #000; color: var(--primary-blue);"><i class="fas fa-user-shield mr-1"></i> Rol del Usuario</label>
                                    <input type="text" class="form-control form-control-user custom-input" readonly
                                        value="<?php 
                                            switch($row2['Id_rol']) {
                                                case 1: echo 'ADMINISTRADOR'; break;
                                                case 2: echo 'OPERARIO'; break;
                                                case 3: echo 'ASESOR'; break;
                                                default: echo 'DESCONOCIDO';
                                            }
                                        ?>"
                                        style="border: var(--pixel-border); border-radius: 0; padding: 12px; font-family: 'Silkscreen', cursive; box-shadow: var(--pixel-shadow);">
                                    <input type="hidden" name="cmb-rol" value="<?php echo $row2['Id_rol']; ?>">
                                </div>
                            </div>
                        </div>
        
                        <!-- Contraseña (oculta) -->
                        <input type="hidden" name="txt-ct" value="<?php echo $row2['clave']; ?>">
        
                        <!-- Botón de Actualización -->
                        <div class="row mt-5">
                            <div class="col-md-12 text-center">
                                <button type="submit" name="btn_actualizar" class="btn btn-primary btn-user btn-update glitch" 
                                    style="background: var(--primary-blue); border: var(--pixel-border); border-radius: 0; padding: 15px 30px; font-weight: 600; font-size: 1.1rem; font-family: 'Press Start 2P', cursive; text-shadow: 2px 2px 0 #000; box-shadow: var(--pixel-shadow);">
                                    <i class="fas fa-save mr-2"></i> ACTUALIZAR USUARIO
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="pixel-corner pixel-corner-bl"></div>
                <div class="pixel-corner pixel-corner-br"></div>
            </div>
        </div>
    </div> 
</div>
<?php
    }
}
?>

<style>
:root {
    --primary-blue: #0056b3;
    --secondary-blue: #51a4e7;
    --accent-yellow: #ffc107;
    --white: #ffffff;
    --pixel-border: 4px solid #000;
    --pixel-shadow: 4px 4px 0 #000;
}

.pixel-corner {
    position: absolute;
    width: 16px;
    height: 16px;
    background-color: var(--accent-yellow);
    z-index: 10;
}

.pixel-corner-tl {
    top: -4px;
    left: -4px;
}

.pixel-corner-tr {
    top: -4px;
    right: -4px;
}

.pixel-corner-bl {
    bottom: -4px;
    left: -4px;
}

.pixel-corner-br {
    bottom: -4px;
    right: -4px;
}

@keyframes glitch {
    0% { transform: translate(0); }
    20% { transform: translate(-2px, 2px); }
    40% { transform: translate(-2px, -2px); }
    60% { transform: translate(2px, 2px); }
    80% { transform: translate(2px, -2px); }
    100% { transform: translate(0); }
}

.glitch:hover {
    animation: glitch 0.0s infinite;
}

.form-control:focus {
    border-color: var(--primary-blue) !important;
    box-shadow: 6px 6px 0 #000 !important;
    transform: translate(-2px, -2px);
    outline: none;
}

.btn-primary:hover, .btn-danger:hover, .btn-secondary:hover {
    transform: translate(-4px, -4px);
    box-shadow: 8px 8px 0 #000 !important;
}

.action-btn:hover {
    transform: scale(1.1);
}

.table-row:hover {
    background-color: rgba(0, 86, 179, 0.05);
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.animated {
    animation-duration: 0.0s;
    animation-fill-mode: both;
}

.fadeIn {
    animation-name: fadeIn;
}

@media (max-width: 768px) {
    .action-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .action-btn {
        margin-bottom: 5px;
    }
}
</style>

<script>
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