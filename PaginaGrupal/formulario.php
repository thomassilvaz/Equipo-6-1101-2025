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
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            image-rendering: pixelated;
        }
        
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
        
        .logo i {
            font-size: 50px;
            color: var(--primary-blue);
        }
        
        .register-header h1 {
            color: white;
            font-family: 'Press Start 2P', cursive;
            font-size: 1.2rem;
            margin-bottom: 15px;
            text-align: center;
            text-shadow: 2px 2px 0 #000;
        }
        
        .register-header p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.9rem;
            text-align: center;
            max-width: 300px;
            margin-bottom: 30px;
        }
        
        .features {
            list-style: none;
            margin-top: 30px;
        }
        
        .features li {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            color: white;
            font-size: 0.8rem;
        }
        
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
        
        .register-body {
            flex: 1.5;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .register-body h2 {
            color: var(--primary-blue);
            font-family: 'Press Start 2P', cursive;
            font-size: 1.1rem;
            margin-bottom: 10px;
            text-shadow: 1px 1px 0 #000;
        }
        
        .register-body p {
            color: var(--dark-text);
            font-size: 0.9rem;
            margin-bottom: 30px;
        }
        
        .form-row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px;
        }
        
        .form-group {
            flex: 1 0 50%;
            padding: 0 10px;
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--primary-blue);
            font-family: 'Press Start 2P', cursive;
            font-size: 0.6rem;
            text-shadow: 1px 1px 0 #000;
        }
        
        .input-icon {
            position: relative;
        }
        
        .input-icon i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary-blue);
            font-size: 16px;
        }
        
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
        
        .form-control:focus {
            border-color: var(--primary-blue);
            outline: none;
        }
        
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
        
        .btn-register:hover {
            background: var(--secondary-blue);
        }
        
        .login-link {
            text-align: center;
            margin-top: 20px;
            color: var(--dark-text);
            font-size: 0.8rem;
        }
        
        .login-link a {
            color: var(--primary-blue);
            text-decoration: none;
            font-family: 'Press Start 2P', cursive;
            font-size: 0.7rem;
            transition: all 0.3s;
        }
        
        .login-link a:hover {
            color: var(--secondary-blue);
        }
        
        .admin-pin-field {
            display: none;
        }
        
        .alert-message {
            padding: 10px;
            margin-top: 10px;
            font-size: 0.8rem;
            display: none;
            border: var(--pixel-border);
        }
        
        .alert-error {
            background-color: #ffcccc;
            color: #990000;
            border-color: #990000;
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

        /* Animación de parpadeo */
        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        
        .blink {
            animation: blink 1.5s infinite;
        }
        
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
    <div class="register-container">
        <div class="pixel-corner pixel-corner-tl"></div>
        <div class="pixel-corner pixel-corner-tr"></div>
        
        <div class="register-header">
            <div class="logo">
                <i class="fas fa-school"></i>
            </div>
            <h1 class="blink">STAY CLEAN</h1>
            <p>VIDEOJUEGO EDUCATIVO</p>
            
            <ul class="features">
                <li><i class="fas fa-shield-alt"></i> SEGURO</li>
                <li><i class="fas fa-graduation-cap"></i> EDUCATIVO</li>
                <li><i class="fas fa-gamepad"></i> INTERACTIVO</li>
            </ul>
        </div>
        
        <div class="register-body">
            <h2>REGISTRO DE USUARIO</h2>
            <p>CREA UNA CUENTA PARA ACCEDER AL SISTEMA</p>
            
            <form action="codigo.php" method="post" id="registrationForm">
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
                
                <div class="form-row">
                    <div class="form-group">
                        <label>CONFIRMAR CONTRASEÑA</label>
                        <div class="input-icon">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="txt-ctc" class="form-control" placeholder="CONFIRMAR CONTRASEÑA" required>
                        </div>
                    </div>
                    
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
                
                <button type="submit" name="btn_registrar" class="btn-register" id="submitButton">
                    <i class="fas fa-user-plus"></i> REGISTRAR USUARIO
                </button>
                
                <div class="login-link">
                    ¿YA TIENES UNA CUENTA? <a href="index.php">INICIA SESION AQUi</a>
                </div>
            </form>
        </div>
        
        <div class="pixel-corner pixel-corner-bl"></div>
        <div class="pixel-corner pixel-corner-br"></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const roleSelect = document.getElementById('userRole');
            const adminPinField = document.getElementById('adminPinField');
            const adminPinInput = document.getElementById('adminPin');
            const pinError = document.getElementById('pinError');
            const registrationForm = document.getElementById('registrationForm');
            
            // PIN de administrador (deberías guardarlo de forma segura en un entorno real)
            const ADMIN_PIN = "2024ADMIN"; // Cambia esto por un PIN seguro
            
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