<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stay Clean</title>

    <link rel="icon" type="image/png" href="Admin/img/logo.png">
    
    <!-- Fuentes 8-bit -->
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Silkscreen&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
     
        :root {
            --primary-blue: #0056b3;
            --secondary-blue: #51a4e7;
            --accent-yellow: #ffc107;
            --light-gray: #f8f9fa;
            --dark-text: #212529;
            --white: #ffffff;
            --pixel-border: 4px solid #000;
            --pixel-shadow: 4px 4px 0 #000;
        }
        
        /* Reset de estilos básicos */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            image-rendering: pixelated;
        }
        
        /* Estilos del cuerpo de la página */
        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
            font-family: 'Silkscreen', cursive;
            padding: 20px;
            overflow-x: hidden;
        }
        
        /* Contenedor principal del formulario de registro */
        .register-container {
            width: 100%;
            max-width: 900px;
            background: var(--white);
            border: var(--pixel-border);
            box-shadow: var(--pixel-shadow);
            position: relative;
            display: flex;
            min-height: 600px;
        }
        
        /* Panel izquierdo con información y características */
        .register-header {
            flex: 1;
            background-color: var(--primary-blue);
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            border-right: var(--pixel-border);
        }
        
        /* Logo circular blanco con icono */
        .logo {
            width: 100px;
            height: 100px;
            background: var(--white);
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 30px;
            border: var(--pixel-border);
        }
        
        /* Icono dentro del logo */
        .logo i {
            font-size: 50px;
            color: var(--primary-blue);
        }
        
        /* Título principal con animación de parpadeo */
        .register-header h1 {
            color: white;
            font-family: 'Press Start 2P', cursive;
            font-size: 1.2rem;
            margin-bottom: 15px;
            text-align: center;
            text-shadow: 2px 2px 0 #000;
        }
        
        /* Texto descriptivo debajo del título */
        .register-header p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.9rem;
            text-align: center;
            max-width: 300px;
            margin-bottom: 30px;
        }
        
        /* Lista de características del sistema */
        .features {
            list-style: none;
            margin-top: 30px;
        }
        
        /* Elementos de la lista de características */
        .features li {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            color: white;
            font-size: 0.8rem;
        }
        
        /* Iconos de las características */
        .features li i {
            margin-right: 10px;
            background: rgba(255, 255, 255, 0.2);
            width: 30px;
            height: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            border: var(--pixel-border);
        }
        
        /* Panel derecho con el formulario de registro */
        .register-body {
            flex: 1.5;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        /* Título del formulario */
        .register-body h2 {
            color: var(--primary-blue);
            font-family: 'Press Start 2P', cursive;
            font-size: 1.1rem;
            margin-bottom: 10px;
            text-shadow: 1px 1px 0 #000;
        }
        
        /* Descripción del formulario */
        .register-body p {
            color: var(--dark-text);
            font-size: 0.9rem;
            margin-bottom: 30px;
        }
        
        /* Fila de campos del formulario */
        .form-row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px;
        }
        
        /* Grupo individual de campos */
        .form-group {
            flex: 1 0 50%;
            padding: 0 10px;
            margin-bottom: 20px;
        }
        
        /* Etiquetas de los campos */
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--primary-blue);
            font-family: 'Press Start 2P', cursive;
            fontSize: 0.6rem;
            text-shadow: 1px 1px 0 #000;
        }
        
        /* Contenedor para inputs con iconos */
        .input-icon {
            position: relative;
        }
        
        /* Iconos dentro de los inputs */
        .input-icon i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary-blue);
            font-size: 16px;
        }
        
        /* Campos de entrada de texto */
        .form-control {
            width: 100%;
            padding: 12px 15px 12px 45px;
            border: var(--pixel-border);
            font-family: 'Silkscreen', cursive;
            font-size: 0.9rem;
            background-color: var(--white);
            box-shadow: 2px 2px 0 #000;
            height: 45px;
        }
        
        /* Estilo cuando el input está enfocado */
        .form-control:focus {
            border-color: var(--primary-blue);
            outline: none;
        }
        
        /* Botón de registrar usuario */
        .btn-register {
            width: 100%;
            padding: 14px;
            background: var(--primary-blue);
            border: var(--pixel-border);
            color: white;
            font-family: 'Press Start 2P', cursive;
            font-size: 0.8rem;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 20px;
            box-shadow: var(--pixel-shadow);
            text-shadow: 1px 1px 0 #000;
        }
        
        /* Efecto hover del botón */
        .btn-register:hover {
            background: var(--secondary-blue);
        }
        
        /* Enlace para ir al login */
        .login-link {
            text-align: center;
            margin-top: 20px;
            color: var(--dark-text);
            font-size: 0.8rem;
        }
        
        /* Estilo del enlace de login */
        .login-link a {
            color: var(--primary-blue);
            text-decoration: none;
            font-family: 'Press Start 2P', cursive;
            font-size: 0.7rem;
            transition: all 0.3s;
        }
        
        /* Efecto hover del enlace de login */
        .login-link a:hover {
            color: var(--secondary-blue);
        }
        
        /* Campo de PIN de administrador (oculto por defecto) */
        .admin-pin-field {
            display: none;
        }
        
        /* Mensajes de alerta */
        .alert-message {
            padding: 10px;
            margin-top: 10px;
            font-size: 0.8rem;
            display: none;
            border: var(--pixel-border);
        }
        
        /* Estilo de alerta de error */
        .alert-error {
            background-color: #ffcccc;
            color: #990000;
            border-color: #990000;
        }
        
        /* Esquinas decorativas amarillas */
        .pixel-corner {
            position: absolute;
            width: 16px;
            height: 16px;
            background-color: var(--accent-yellow);
            z-index: 10;
        }
        
        /* Esquina superior izquierda */
        .pixel-corner-tl {
            top: -4px;
            left: -4px;
        }
        
        /* Esquina superior derecha */
        .pixel-corner-tr {
            top: -4px;
            right: -4px;
        }
        
        /* Esquina inferior izquierda */
        .pixel-corner-bl {
            bottom: -4px;
            left: -4px;
        }
        
        /* Esquina inferior derecha */
        .pixel-corner-br {
            bottom: -4px;
            right: -4px;
        }

        /* Animación de parpadeo para el título */
        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        
        /* Clase para aplicar la animación de parpadeo */
        .blink {
            animation: blink 1.5s infinite;
        }
        
        /* Estilos responsive para tablets y móviles */
        @media (max-width: 768px) {
            .register-container {
                flex-direction: column;
            }
            
            .register-header {
                padding: 30px 20px;
                border-right: none;
                border-bottom: var(--pixel-border);
            }
            
            .register-body {
                padding: 30px 20px;
            }
            
            .form-group {
                flex: 1 0 100%;
            }
            
            .register-header h1 {
                font-size: 1rem;
            }
            
            .register-body h2 {
                font-size: 0.9rem;
            }
            
            .btn-register {
                font-size: 0.7rem;
            }
        }
    </style>
</head>
<body>
    <!-- Contenedor principal del registro -->
    <div class="register-container">
        <div class="pixel-corner pixel-corner-tl"></div>
        <div class="pixel-corner pixel-corner-tr"></div>
        
        <!-- Panel izquierdo con información -->
        <div class="register-header">
            <div class="logo">
                <i class="fas fa-school"></i>
            </div>
            <h1 class="blink">STAY CLEAN</h1>
            <p>VIDEOJUEGO EDUCATIVO</p>
            
            <!-- Lista de características -->
            <ul class="features">
                <li><i class="fas fa-shield-alt"></i> SEGURO</li>
                <li><i class="fas fa-graduation-cap"></i> EDUCATIVO</li>
                <li><i class="fas fa-gamepad"></i> INTERACTIVO</li>
            </ul>
        </div>
        
        <!-- Panel derecho con formulario -->
        <div class="register-body">
            <h2>REGISTRO DE USUARIO</h2>
            <p>CREA UNA CUENTA PARA ACCEDER AL SISTEMA</p>
            
            <!-- Formulario de registro -->
            <form action="codigo.php" method="post" id="registrationForm">
                <!-- Primera fila de campos -->
                <div class="form-row">
                    <div class="form-group">
                        <label>TIPO DE DOCUMENTO</label>
                        <div class="input-icon">
                            <i class="fas fa-id-card"></i>
                            <select name="cmb-tp" class="form-control" required>
                                <option value="">TIPO DE DOCUMENTO</option>
                                <option value="TI">TARJETA DE IDENTIDAD</option>
                                <option value="CC">CÉDULA DE CIUDADANÍA</option>
                                <option value="CE">CÉDULA DE EXTRANJERÍA</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>N° DE IDENTIFICACIÓN</label>
                        <div class="input-icon">
                            <i class="fas fa-hashtag"></i>
                            <input type="text" name="txt-id" class="form-control" placeholder="NÚMERO DE IDENTIFICACIÓN" required>
                        </div>
                    </div>
                </div>
                
                <!-- Segunda fila de campos (nombres) -->
                <div class="form-row">
                    <div class="form-group">
                        <label>PRIMER NOMBRE</label>
                        <div class="input-icon">
                            <i class="fas fa-user"></i>
                            <input type="text" name="txt-pn" class="form-control" placeholder="PRIMER NOMBRE" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>SEGUNDO NOMBRE</label>
                        <div class="input-icon">
                            <i class="fas fa-user"></i>
                            <input type="text" name="txt-sn" class="form-control" placeholder="SEGUNDO NOMBRE (OPCIONAL)">
                        </div>
                    </div>
                </div>
                
                <!-- Tercera fila de campos (apellidos) -->
                <div class="form-row">
                    <div class="form-group">
                        <label>PRIMER APELLIDO</label>
                        <div class="input-icon">
                            <i class="fas fa-user"></i>
                            <input type="text" name="txt-pa" class="form-control" placeholder="PRIMER APELLIDO" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>SEGUNDO APELLIDO</label>
                        <div class="input-icon">
                            <i class="fas fa-user"></i>
                            <input type="text" name="txt-sa" class="form-control" placeholder="SEGUNDO APELLIDO (OPCIONAL)">
                        </div>
                    </div>
                </div>
                
                <!-- Cuarta fila de campos (contacto) -->
                <div class="form-row">
                    <div class="form-group">
                        <label>TELÉFONO</label>
                        <div class="input-icon">
                            <i class="fas fa-phone"></i>
                            <input type="tel" name="txt-tel" class="form-control" placeholder="NÚMERO DE TELÉFONO" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>CORREO ELECTRÓNICO</label>
                        <div class="input-icon">
                            <i class="fas fa-envelope"></i>
                            <input type="email" name="txt-cr" class="form-control" placeholder="CORREO ELECTRÓNICO" required>
                        </div>
                    </div>
                </div>
                
                <!-- Quinta fila de campos (rol y contraseña) -->
                <div class="form-row">
                    <div class="form-group">
                        <label>ROL DEL USUARIO</label>
                        <div class="input-icon">
                            <i class="fas fa-user-tag"></i>
                            <select name="cmb-rol" id="userRole" class="form-control" required>
                                <option value="">SELECCIONE UN ROL</option>
                                <option value="1">ADMINISTRADOR</option>
                                <option value="2">JUGADOR</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>CONTRASEÑA</label>
                        <div class="input-icon">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="txt-ct" class="form-control" placeholder="CONTRASEÑA" required>
                        </div>
                    </div>
                </div>
                
                <!-- Sexta fila de campos (confirmación y PIN admin) -->
                <div class="form-row">
                    <div class="form-group">
                        <label>CONFIRMAR CONTRASEÑA</label>
                        <div class="input-icon">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="txt-ctc" class="form-control" placeholder="CONFIRMAR CONTRASEÑA" required>
                        </div>
                    </div>
                    
                    <!-- Campo de PIN de administrador (oculto por defecto) -->
                    <div class="form-group admin-pin-field" id="adminPinField">
                        <label>PIN DE ADMINISTRADOR</label>
                        <div class="input-icon">
                            <i class="fas fa-key"></i>
                            <input type="password" name="admin-pin" id="adminPin" class="form-control" placeholder="INGRESA EL PIN DE ADMINISTRADOR">
                        </div>
                        <div class="alert-message alert-error" id="pinError">
                            PIN INCORRECTO. SOLO LOS ADMINISTRADORES AUTORIZADOS PUEDEN REGISTRARSE CON ESTE ROL.
                        </div>
                    </div>
                </div>
                
                <!-- Botón de enviar formulario -->
                <button type="submit" name="btn_registrar" class="btn-register" id="submitButton">
                    <i class="fas fa-user-plus"></i> REGISTRAR USUARIO
                </button>
                
                <!-- Enlace para ir al login -->
                <div class="login-link">
                    ¿YA TIENES UNA CUENTA? <a href="index.php">INICIA SESION AQUi</a>
                </div>
            </form>
        </div>
        
        <!-- Esquinas decorativas inferiores -->
        <div class="pixel-corner pixel-corner-bl"></div>
        <div class="pixel-corner pixel-corner-br"></div>
    </div>

    <script>
        // Script para manejar la validación del formulario de registro
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
</body>
</html>