<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800" style="color: var(--primary-blue);">Registro de Usuario</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-xl-10 col-lg-12 mx-auto">
            <div class="card shadow mb-4" style="border-radius: 15px; border: none;">
                <!-- Card Header -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between" 
                     style="background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%); 
                            border-top-left-radius: 15px !important; 
                            border-top-right-radius: 15px !important;">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-user-plus mr-2"></i>REGISTRO DE USUARIO
                    </h6>
                </div>
                
                <!-- Card Body -->
                <div class="card-body" style="padding: 2.5rem;">
                    <form class="user" action="../codigo.php" method="post" id="registrationForm">
                        <!-- Tipo de Documento -->
                        <div class="form-group">
                            <label class="font-weight-bold" style="color: var(--primary-blue); margin-bottom: 8px;">
                                <i class="fas fa-id-card mr-2"></i>Tipo de Documento
                            </label>
                            <select class="form-control form-control-lg" name="cmb-tp" required 
                                    style="border-radius: 10px; padding: 12px; font-size: 16px; border: 2px solid #e0e0e0;
                                        font-family: 'Nunito', sans-serif;">
                                <option value="">SELECCIONE TIPO DE DOCUMENTO</option>
                                <option value="TI">TARJETA DE IDENTIDAD</option>
                                <option value="CC">CÉDULA DE CIUDADANÍA</option>
                                <option value="CE">CÉDULA DE EXTRANJERÍA</option>
                            </select>
                        </div>

                        <!-- Número de Identificación -->
                        <div class="form-group">
                            <label class="font-weight-bold" style="color: var(--primary-blue); margin-bottom: 8px;">
                                <i class="fas fa-fingerprint mr-2"></i>Número de Identificación
                            </label>
                            <input type="text" class="form-control form-control-lg" name="txt-id" 
                                placeholder="INGRESE SU NÚMERO DE IDENTIFICACIÓN" required
                                style="border-radius: 10px; padding: 12px; font-size: 16px; border: 2px solid #e0e0e0;
                                       font-family: 'Nunito', sans-serif;">
                        </div>

                        <!-- Nombres -->
                        <div class="form-group row">
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold" style="color: var(--primary-blue); margin-bottom: 8px;">
                                    <i class="fas fa-signature mr-2"></i>Primer Nombre
                                </label>
                                <input type="text" class="form-control form-control-lg" name="txt-pn" 
                                    placeholder="PRIMER NOMBRE" required
                                    style="border-radius: 10px; padding: 12px; font-size: 16px; border: 2px solid #e0e0e0;
                                           font-family: 'Nunito', sans-serif;">
                            </div>
                            <div class="col-md-6">
                                <label class="font-weight-bold" style="color: var(--primary-blue); margin-bottom: 8px;">
                                    <i class="fas fa-signature mr-2"></i>Segundo Nombre (Opcional)
                                </label>
                                <input type="text" class="form-control form-control-lg" name="txt-sn" 
                                    placeholder="SEGUNDO NOMBRE"
                                    style="border-radius: 10px; padding: 12px; font-size: 16px; border: 2px solid #e0e0e0;
                                           font-family: 'Nunito', sans-serif;">
                            </div>
                        </div>

                        <!-- Apellidos -->
                        <div class="form-group row">
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold" style="color: var(--primary-blue); margin-bottom: 8px;">
                                    <i class="fas fa-signature mr-2"></i>Primer Apellido
                                </label>
                                <input type="text" class="form-control form-control-lg" name="txt-pa" 
                                    placeholder="PRIMER APELLIDO" required
                                    style="border-radius: 10px; padding: 12px; font-size: 16px; border: 2px solid #e0e0e0;
                                           font-family: 'Nunito', sans-serif;">
                            </div>
                            <div class="col-md-6">
                                <label class="font-weight-bold" style="color: var(--primary-blue); margin-bottom: 8px;">
                                    <i class="fas fa-signature mr-2"></i>Segundo Apellido (Opcional)
                                </label>
                                <input type="text" class="form-control form-control-lg" name="txt-sa" 
                                    placeholder="SEGUNDO APELLIDO"
                                    style="border-radius: 10px; padding: 12px; font-size: 16px; border: 2px solid #e0e0e0;
                                           font-family: 'Nunito', sans-serif;">
                            </div>
                        </div>

                        <!-- Contacto -->
                        <div class="form-group row">
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold" style="color: var(--primary-blue); margin-bottom: 8px;">
                                    <i class="fas fa-phone mr-2"></i>Teléfono
                                </label>
                                <input type="tel" class="form-control form-control-lg" name="txt-tel" 
                                    placeholder="NÚMERO DE TELÉFONO" required
                                    style="border-radius: 10px; padding: 12px; font-size: 16px; border: 2px solid #e0e0e0;
                                           font-family: 'Nunito', sans-serif;">
                            </div>
                            <div class="col-md-6">
                                <label class="font-weight-bold" style="color: var(--primary-blue); margin-bottom: 8px;">
                                    <i class="fas fa-envelope mr-2"></i>Correo Electrónico
                                </label>
                                <input type="email" class="form-control form-control-lg" name="txt-cr" 
                                    placeholder="CORREO ELECTRÓNICO" required
                                    style="border-radius: 10px; padding: 12px; font-size: 16px; border: 2px solid #e0e0e0;
                                           font-family: 'Nunito', sans-serif;">
                            </div>
                        </div>

                        <!-- Rol del Usuario -->
                        <div class="form-group">
                            <label class="font-weight-bold" style="color: var(--primary-blue); margin-bottom: 8px;">
                                <i class="fas fa-user-tag mr-2"></i>Rol del Usuario
                            </label>
                            <select class="form-control form-control-lg" name="cmb-rol" id="userRole" required
                                    style="border-radius: 10px; padding: 12px; font-size: 16px; border: 2px solid #e0e0e0;
                                           font-family: 'Nunito', sans-serif;">
                                <option value="">SELECCIONE UN ROL</option>
                                <option value="1">ADMINISTRADOR</option>
                                <option value="2">USUARIO</option>
                            </select>
                        </div>

                        <!-- Campo de PIN para Administradores (oculto inicialmente) -->
                        <div class="form-group" id="adminPinField" style="display: none;">
                            <label class="font-weight-bold" style="color: var(--primary-blue); margin-bottom: 8px;">
                                <i class="fas fa-key mr-2"></i>PIN de Administrador
                            </label>
                            <input type="password" class="form-control form-control-lg" name="admin-pin" id="adminPin" 
                                placeholder="INGRESE EL PIN DE ADMINISTRADOR"
                                style="border-radius: 10px; padding: 12px; font-size: 16px; border: 2px solid #e0e0e0;
                                       font-family: 'Nunito', sans-serif;">
                            <div class="alert alert-danger mt-2" id="pinError" style="display: none; border-radius: 10px;">
                                <i class="fas fa-exclamation-circle mr-2"></i>PIN incorrecto. Solo los administradores autorizados pueden registrarse con este rol.
                            </div>
                        </div>

                        <!-- Contraseñas -->
                        <div class="form-group row">
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold" style="color: var(--primary-blue); margin-bottom: 8px;">
                                    <i class="fas fa-lock mr-2"></i>Contraseña
                                </label>
                                <input type="password" class="form-control form-control-lg" name="txt-ct" 
                                    placeholder="CONTRASEÑA" required
                                    style="border-radius: 10px; padding: 12px; font-size: 16px; border: 2px solid #e0e0e0;
                                           font-family: 'Nunito', sans-serif;">
                            </div>
                            <div class="col-md-6">
                                <label class="font-weight-bold" style="color: var(--primary-blue); margin-bottom: 8px;">
                                    <i class="fas fa-lock mr-2"></i>Confirmar Contraseña
                                </label>
                                <input type="password" class="form-control form-control-lg" name="txt-ctc" 
                                    placeholder="CONFIRMAR CONTRASEÑA" required
                                    style="border-radius: 10px; padding: 12px; font-size: 16px; border: 2px solid #e0e0e0;
                                           font-family: 'Nunito', sans-serif;">
                            </div>
                        </div>

                        <!-- Botón de Registro -->
                        <div class="form-group mt-4">
                            <button type="submit" name="btn_registrar" class="btn btn-primary btn-user btn-block" 
                                style="background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
                                       border: none; 
                                       border-radius: 10px; 
                                       padding: 15px;
                                       font-size: 18px;
                                       font-weight: 600;
                                       font-family: 'Nunito', sans-serif;">
                                <i class="fas fa-user-plus mr-2"></i>REGISTRAR USUARIO
                            </button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const roleSelect = document.getElementById('userRole');
    const adminPinField = document.getElementById('adminPinField');
    const adminPinInput = document.getElementById('adminPin');
    const pinError = document.getElementById('pinError');
    const registrationForm = document.getElementById('registrationForm');
    
    // PIN de administrador
    const ADMIN_PIN = "2024ADMIN";
    
    // Mostrar u ocultar campo PIN según el rol seleccionado
    roleSelect.addEventListener('change', function() {
        if (this.value === '1') { // Valor 1 para ADMINISTRADOR
            adminPinField.style.display = 'block';
            adminPinInput.setAttribute('required', 'required');
        } else {
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
                e.preventDefault();
                pinError.style.display = 'block';
                adminPinInput.focus();
            } else {
                pinError.style.display = 'none';
            }
        }
    });
});
</script>