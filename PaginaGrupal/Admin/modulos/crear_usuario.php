<!-- Contenido principal del crud-->
<div class="container-fluid">


    <div class="row">
        <div class="col-xl-10 col-lg-12 mx-auto">
            <!-- Tarjeta principal del formulario con efecto glitch -->
            <div class="card shadow mb-4 glitch" style="border-radius: 0; border: var(--pixel-border); background-color: white; box-shadow: var(--pixel-shadow); position: relative;">
                <!-- Esquinas decorativas estilo pixel -->
                <div class="pixel-corner pixel-corner-tl"></div>
                <div class="pixel-corner pixel-corner-tr"></div>
                
                <!--Encabezado de la tarjeta -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" 
                     style="background: var(--primary-blue); 
                            border-top-left-radius: 0 !important; 
                            border-top-right-radius: 0 !important;
                            border-bottom: var(--pixel-border);">
                    <!-- Título del formulario con estilo de videojuego -->
                    <h6 class="m-0 font-weight-bold text-white" style="font-family: 'Press Start 2P', cursive; text-shadow: 2px 2px 0 #000; color: var(--accent-yellow) !important;">
                        <i class="fas fa-user-plus mr-2"></i>REGISTRO DE USUARIO
                    </h6>
                </div>
                
                <!-- Cuerpo de la tarjeta -->
                <div class="card-body" style="padding: 2.5rem;">
                    <!-- Formulario de registro que envía datos a codigo.php -->
                    <form class="user" action="../codigo.php" method="post" id="registrationForm">
                        
                        <!-- Sección: Tipo de Documento -->
                        <div class="form-group">
                            <label class="font-weight-bold" style="color: var(--primary-blue); margin-bottom: 8px; font-family: 'Press Start 2P', cursive; font-size: 0.8rem; text-shadow: 1px 1px 0 #000;">
                                <i class="fas fa-id-card mr-2"></i>Tipo de Documento
                            </label>
                            <!-- Selector de tipo de documento -->
                            <select class="form-control form-control-lg" name="cmb-tp" required 
                                    style="border-radius: 0; padding: 12px; font-size: 16px; border: var(--pixel-border);
                                        font-family: 'Silkscreen', cursive; box-shadow: var(--pixel-shadow); background-color: white;">
                                <option value="">SELECCIONE TIPO DE DOCUMENTO</option>
                                <option value="TI">TARJETA DE IDENTIDAD</option>
                                <option value="CC">CÉDULA DE CIUDADANÍA</option>
                                <option value="CE">CÉDULA DE EXTRANJERÍA</option>
                            </select>
                        </div>

                        <!-- Sección: Número de Identificación -->
                        <div class="form-group">
                            <label class="font-weight-bold" style="color: var(--primary-blue); margin-bottom: 8px; font-family: 'Press Start 2P', cursive; font-size: 0.8rem; text-shadow: 1px 1px 0 #000;">
                                <i class="fas fa-fingerprint mr-2"></i>Número de Identificación
                            </label>
                            <!-- Campo para número de identificación -->
                            <input type="text" class="form-control form-control-lg" name="txt-id" 
                                placeholder="INGRESE SU NÚMERO DE IDENTIFICACIÓN" required
                                style="border-radius: 0; padding: 12px; font-size: 16px; border: var(--pixel-border);
                                       font-family: 'Silkscreen', cursive; box-shadow: var(--pixel-shadow); background-color: white;">
                        </div>

                        <!-- Sección: Nombres - Diseño en dos columnas -->
                        <div class="form-group row">
                            <!-- Columna: Primer Nombre -->
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold" style="color: var(--primary-blue); margin-bottom: 8px; font-family: 'Press Start 2P', cursive; font-size: 0.8rem; text-shadow: 1px 1px 0 #000;">
                                    <i class="fas fa-signature mr-2"></i>Primer Nombre
                                </label>
                                <input type="text" class="form-control form-control-lg" name="txt-pn" 
                                    placeholder="PRIMER NOMBRE" required
                                    style="border-radius: 0; padding: 12px; font-size: 16px; border: var(--pixel-border);
                                           font-family: 'Silkscreen', cursive; box-shadow: var(--pixel-shadow); background-color: white;">
                            </div>
                            <!-- Columna: Segundo Nombre (Opcional) -->
                            <div class="col-md-6">
                                <label class="font-weight-bold" style="color: var(--primary-blue); margin-bottom: 8px; font-family: 'Press Start 2P', cursive; font-size: 0.8rem; text-shadow: 1px 1px 0 #000;">
                                    <i class="fas fa-signature mr-2"></i>Segundo Nombre (Opcional)
                                </label>
                                <input type="text" class="form-control form-control-lg" name="txt-sn" 
                                    placeholder="SEGUNDO NOMBRE"
                                    style="border-radius: 0; padding: 12px; font-size: 16px; border: var(--pixel-border);
                                           font-family: 'Silkscreen', cursive; box-shadow: var(--pixel-shadow); background-color: white;">
                            </div>
                        </div>

                        <!-- Sección: Apellidos - Diseño en dos columnas -->
                        <div class="form-group row">
                            <!-- Columna: Primer Apellido -->
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold" style="color: var(--primary-blue); margin-bottom: 8px; font-family: 'Press Start 2P', cursive; font-size: 0.8rem; text-shadow: 1px 1px 0 #000;">
                                    <i class="fas fa-signature mr-2"></i>Primer Apellido
                                </label>
                                <input type="text" class="form-control form-control-lg" name="txt-pa" 
                                    placeholder="PRIMER APELLIDO" required
                                    style="border-radius: 0; padding: 12px; font-size: 16px; border: var(--pixel-border);
                                           font-family: 'Silkscreen', cursive; box-shadow: var(--pixel-shadow); background-color: white;">
                            </div>
                            <!-- Columna: Segundo Apellido (Opcional) -->
                            <div class="col-md-6">
                                <label class="font-weight-bold" style="color: var(--primary-blue); margin-bottom: 8px; font-family: 'Press Start 2P', cursive; font-size: 0.8rem; text-shadow: 1px 1px 0 #000;">
                                    <i class="fas fa-signature mr-2"></i>Segundo Apellido (Opcional)
                                </label>
                                <input type="text" class="form-control form-control-lg" name="txt-sa" 
                                    placeholder="SEGUNDO APELLIDO"
                                    style="border-radius: 0; padding: 12px; font-size: 16px; border: var(--pixel-border);
                                           font-family: 'Silkscreen', cursive; box-shadow: var(--pixel-shadow); background-color: white;">
                            </div>
                        </div>

                        <!-- Sección: Contacto - Diseño en dos columnas -->
                        <div class="form-group row">
                            <!-- Columna: Teléfono -->
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold" style="color: var(--primary-blue); margin-bottom: 8px; font-family: 'Press Start 2P', cursive; font-size: 0.8rem; text-shadow: 1px 1px 0 #000;">
                                    <i class="fas fa-phone mr-2"></i>Teléfono
                                </label>
                                <input type="tel" class="form-control form-control-lg" name="txt-tel" 
                                    placeholder="NÚMERO DE TELÉFONO" required
                                    style="border-radius: 0; padding: 12px; font-size: 16px; border: var(--pixel-border);
                                           font-family: 'Silkscreen', cursive; box-shadow: var(--pixel-shadow); background-color: white;">
                            </div>
                            <!-- Columna: Correo Electrónico -->
                            <div class="col-md-6">
                                <label class="font-weight-bold" style="color: var(--primary-blue); margin-bottom: 8px; font-family: 'Press Start 2P', cursive; font-size: 0.8rem; text-shadow: 1px 1px 0 #000;">
                                    <i class="fas fa-envelope mr-2"></i>Correo Electrónico
                                </label>
                                <input type="email" class="form-control form-control-lg" name="txt-cr" 
                                    placeholder="CORREO ELECTRÓNICO" required
                                    style="border-radius: 0; padding: 12px; font-size: 16px; border: var(--pixel-border);
                                           font-family: 'Silkscreen', cursive; box-shadow: var(--pixel-shadow); background-color: white;">
                            </div>
                        </div>

                        <!-- Sección: Rol del Usuario -->
                        <div class="form-group">
                            <label class="font-weight-bold" style="color: var(--primary-blue); margin-bottom: 8px; font-family: 'Press Start 2P', cursive; font-size: 0.8rem; text-shadow: 1px 1px 0 #000;">
                                <i class="fas fa-user-tag mr-2"></i>Rol del Usuario
                            </label>
                            <!-- Selector de rol con funcionalidad dinámica -->
                            <select class="form-control form-control-lg" name="cmb-rol" id="userRole" required
                                    style="border-radius: 0; padding: 12px; font-size: 16px; border: var(--pixel-border);
                                           font-family: 'Silkscreen', cursive; box-shadow: var(--pixel-shadow); background-color: white;">
                                <option value="">SELECCIONE UN ROL</option>
                                <option value="1">ADMINISTRADOR</option>
                                <option value="2">USUARIO</option>
                            </select>
                        </div>

                        <!-- Sección: Campo de PIN para Administradores (oculto inicialmente) -->
                        <div class="form-group" id="adminPinField" style="display: none;">
                            <label class="font-weight-bold" style="color: var(--primary-blue); margin-bottom: 8px; font-family: 'Press Start 2P', cursive; font-size: 0.8rem; text-shadow: 1px 1px 0 #000;">
                                <i class="fas fa-key mr-2"></i>PIN de Administrador
                            </label>
                            <!-- Campo PIN que solo aparece cuando se selecciona rol Administrador -->
                            <input type="password" class="form-control form-control-lg" name="admin-pin" id="adminPin" 
                                placeholder="INGRESE EL PIN DE ADMINISTRADOR"
                                style="border-radius: 0; padding: 12px; font-size: 16px; border: var(--pixel-border);
                                       font-family: 'Silkscreen', cursive; box-shadow: var(--pixel-shadow); background-color: white;">
                            <!-- Mensaje de error para PIN incorrecto -->
                            <div class="alert alert-danger mt-2" id="pinError" style="display: none; border-radius: 0; border: var(--pixel-border); background-color: #f8d7da; color: #721c24; font-family: 'Silkscreen', cursive; box-shadow: var(--pixel-shadow);">
                                <i class="fas fa-exclamation-circle mr-2"></i>PIN incorrecto. Solo los administradores autorizados pueden registrarse con este rol.
                            </div>
                        </div>

                        <!-- Sección: Contraseñas - Diseño en dos columnas -->
                        <div class="form-group row">
                            <!-- Columna: Contraseña -->
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold" style="color: var(--primary-blue); margin-bottom: 8px; font-family: 'Press Start 2P', cursive; font-size: 0.8rem; text-shadow: 1px 1px 0 #000;">
                                    <i class="fas fa-lock mr-2"></i>Contraseña
                                </label>
                                <input type="password" class="form-control form-control-lg" name="txt-ct" 
                                    placeholder="CONTRASEÑA" required
                                    style="border-radius: 0; padding: 12px; font-size: 16px; border: var(--pixel-border);
                                           font-family: 'Silkscreen', cursive; box-shadow: var(--pixel-shadow); background-color: white;">
                            </div>
                            <!-- Columna: Confirmar Contraseña -->
                            <div class="col-md-6">
                                <label class="font-weight-bold" style="color: var(--primary-blue); margin-bottom: 8px; font-family: 'Press Start 2P', cursive; font-size: 0.8rem; text-shadow: 1px 1px 0 #000;">
                                    <i class="fas fa-lock mr-2"></i>Confirmar Contraseña
                                </label>
                                <input type="password" class="form-control form-control-lg" name="txt-ctc" 
                                    placeholder="CONFIRMAR CONTRASEÑA" required
                                    style="border-radius: 0; padding: 12px; font-size: 16px; border: var(--pixel-border);
                                           font-family: 'Silkscreen', cursive; box-shadow: var(--pixel-shadow); background-color: white;">
                            </div>
                        </div>

                        <!-- Sección: Botón de Registro -->
                        <div class="form-group mt-4">
                            <!-- Botón principal de envío del formulario -->
                            <button type="submit" name="btn_registrar" class="btn btn-primary btn-user btn-block glitch" 
                                style="background: var(--primary-blue);
                                       border: var(--pixel-border); 
                                       border-radius: 0; 
                                       padding: 15px;
                                       font-size: 18px;
                                       font-weight: 600;
                                       font-family: 'Press Start 2P', cursive;
                                       text-shadow: 2px 2px 0 #000;
                                       box-shadow: var(--pixel-shadow);">
                                <i class="fas fa-user-plus mr-2"></i>REGISTRAR USUARIO
                            </button>
                        </div>
                    </form>
                    
                </div>
                <!-- Esquinas decorativas inferiores -->
                <div class="pixel-corner pixel-corner-bl"></div>
                <div class="pixel-corner pixel-corner-br"></div>
            </div>
        </div>
    </div>

</div>

<style>

:root {
    --primary-blue: #0056b3;
    --secondary-blue: #51a4e7;
    --accent-yellow: #ffc107;
    --white: #ffffff;
    --pixel-border: 4px solid #000;
    --pixel-shadow: 4px 4px 0 #000;
}

/* Estilo para esquinas decorativas tipo pixel */
.pixel-corner {
    position: absolute;
    width: 16px;
    height: 16px;
    background-color: var(--accent-yellow);
    z-index: 10;
}

/* Posicionamiento de esquina superior izquierda */
.pixel-corner-tl {
    top: -4px;
    left: -4px;
}

/* Posicionamiento de esquina superior derecha */
.pixel-corner-tr {
    top: -4px;
    right: -4px;
}

/* Posicionamiento de esquina inferior izquierda */
.pixel-corner-bl {
    bottom: -4px;
    left: -4px;
}

/* Posicionamiento de esquina inferior derecha */
.pixel-corner-br {
    bottom: -4px;
    right: -4px;
}

/* Animación de efecto glitch para elementos interactivos */
@keyframes glitch {
    0% { transform: translate(0); }
    20% { transform: translate(-2px, 2px); }
    40% { transform: translate(-2px, -2px); }
    60% { transform: translate(2px, 2px); }
    80% { transform: translate(2px, -2px); }
    100% { transform: translate(0); }
}

/* Aplicar animación glitch al hacer hover (actualmente desactivada con 0.0s) */
.glitch:hover {
    animation: glitch 0.0s infinite;
}

/* Efectos de focus para campos de formulario */
.form-control:focus {
    border-color: var(--primary-blue) !important;
    box-shadow: 6px 6px 0 #000 !important;
    transform: translate(-2px, -2px);
    outline: none;
}

/* Efectos de hover para botones primarios */
.btn-primary:hover {
    background: var(--secondary-blue) !important;
    transform: translate(-4px, -4px);
    box-shadow: 8px 8px 0 #000 !important;
}
</style>


<script>

document.addEventListener('DOMContentLoaded', function() {

    const roleSelect = document.getElementById('userRole');
    const adminPinField = document.getElementById('adminPinField');
    const adminPinInput = document.getElementById('adminPin');
    const pinError = document.getElementById('pinError');
    const registrationForm = document.getElementById('registrationForm');
    
    // PIN de administrador 
    const ADMIN_PIN = "2024ADMIN";
    
    // Event listener para cambio en el selector de rol
    roleSelect.addEventListener('change', function() {
        // Mostrar campo PIN solo si se selecciona Administrador (valor 1)
        if (this.value === '1') {
            adminPinField.style.display = 'block';
            adminPinInput.setAttribute('required', 'required');
        } else {
            // Ocultar campo PIN y limpiar validación para otros roles
            adminPinField.style.display = 'none';
            adminPinInput.removeAttribute('required');
            pinError.style.display = 'none';
        }
    });
    
    // Validar el formulario antes de enviar
    registrationForm.addEventListener('submit', function(e) {
        // Si el usuario seleccionó administrador, validar el PIN
        if (roleSelect.value === '1') {
            if (adminPinInput.value !== ADMIN_PIN) {
                // Prevenir envío del formulario si el PIN es incorrecto
                e.preventDefault();
                pinError.style.display = 'block';
                adminPinInput.focus();
            } else {
                // Ocultar error si el PIN es correcto
                pinError.style.display = 'none';
            }
        }
    });
});
</script>