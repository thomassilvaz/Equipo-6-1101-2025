<?php
session_start();

// Si ya hay una sesión activa (usuario logueado), redirige al panel de admin
if (isset($_SESSION['user'])) {
    header("Location: admin/index.php");
    exit();
}

// Verifica si se ha presionado el botón de "Ingresar"
if (isset($_POST['btn_ingresar'])) {
    // Incluye el archivo que contiene la conexión a la base de datos
    include "conexion.php";

    // Obtiene los valores enviados desde el formulario (usuario y contraseña)
    $pass = $_POST['txt-ct']; 
    $user = $_POST['txt-id']; 

    // Comprueba que los campos no estén vacíos
    if (!empty($pass) and !empty($user)) {
        
        // Realiza una consulta para buscar al usuario por su documento
        $consulta = mysqli_query($conexion, "SELECT * FROM usuarios WHERE doc=$user") or die ($conexion. "Problemas en la consulta"); // Si falla la consulta, muestra error

        // Cuenta cuántos resultados devuelve la consulta
        $num = mysqli_num_rows($consulta);

        // Si hay al menos un usuario con ese documento
        if ($num > 0) {

            $fila = mysqli_fetch_array($consulta);

            // Verifica que la contraseña ingresada coincida con la guardada 
            if (password_verify($pass, $fila['clave'])) {

                $_SESSION['user'] = $fila['doc'];
                $_SESSION['pn'] = $fila['PNombre'];
                $_SESSION['pa'] = $fila['PApellido'];

                // Redirige al panel de administración
                echo "<script>window.location='admin/index.php';</script>";
                exit();
            } else {
                // Si la contraseña no coincide, muestra mensaje de error
                $error_message = "⚠️ CONTRASEÑA INCORRECTA ⚠️";
            }
        } else {
            // Si no existe el usuario en la base de datos
            $error_message = "⚠️ USUARIO NO ENCONTRADO ⚠️";
        }
    } else {
        // Si algún campo está vacío
        $error_message = "⚠️ RELLENA TODOS LOS CAMPOS ⚠️";
    }
}
?>

<!DOCTYPE html> 
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STAY CLEAN</title>
    
    <link rel="icon" type="image/png" href="Admin/img/logo.png"> <!-- Icono de la pestaña (favicon) -->
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet"> <!-- Fuente estilo pixelado -->
    <link href="https://fonts.googleapis.com/css2?family=Silkscreen&display=swap" rel="stylesheet"> <!-- Fuente estilo pixelado -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> <!-- Biblioteca de iconos -->

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
        
        /* Contenedor principal del formulario de login */
        .login-container {
            width: 100%;
            max-width: 400px;
            background: var(--white);
            border: var(--pixel-border);
            box-shadow: var(--pixel-shadow);
            position: relative;
        }
        
        /* Cabecera del login con fondo azul */
        .login-header {
            background-color: var(--primary-blue);
            color: white;
            padding: 30px 20px;
            text-align: center;
            border-bottom: var(--pixel-border);
            position: relative;
        }
        
        /* Logo circular blanco con icono */
        .logo {
            width: 80px;
            height: 80px;
            background: var(--white);
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 15px;
            border: var(--pixel-border);
        }
        
        /* Icono dentro del logo */
        .logo i {
            font-size: 40px;
            color: var(--primary-blue);
        }
        
        /* Título principal con animación de parpadeo */
        .login-header h1 {
            font-family: 'Press Start 2P', cursive;
            font-size: 1.2rem;
            margin-bottom: 10px;
            text-shadow: 2px 2px 0 #000;
        }
        
        /* Texto descriptivo debajo del título */
        .login-header p {
            font-size: 0.8rem;
            opacity: 0.9;
        }
        
        /* Área del formulario */
        .login-body {
            padding: 30px 25px;
        }
        
        /* Grupo de campos del formulario */
        .form-group {
            margin-bottom: 20px;
        }
        
        /* Etiquetas de los campos */
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--primary-blue);
            font-family: 'Press Start 2P', cursive;
            font-size: 0.7rem;
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
            font-size: 1rem;
            background-color: var(--white);
            box-shadow: 2px 2px 0 #000;
            height: 50px;
        }
        
        /* Estilo cuando el input está enfocado */
        .form-control:focus {
            border-color: var(--primary-blue);
            outline: none;
        }
        
        /* Botón de iniciar sesión */
        .btn-login {
            width: 100%;
            padding: 15px;
            background: var(--primary-blue);
            border: var(--pixel-border);
            color: white;
            font-family: 'Press Start 2P', cursive;
            font-size: 0.8rem;
            cursor: pointer;
            box-shadow: var(--pixel-shadow);
            height: 50px;
            text-shadow: 1px 1px 0 #000;
            transition: all 0.3s;
        }
        
        /* Efecto hover del botón */
        .btn-login:hover {
            background: var(--secondary-blue);
        }
        
        /* Icono dentro del botón */
        .btn-login i {
            margin-left: 10px;
        }
        
        /* Pie del formulario con enlace */
        .login-footer {
            margin-top: 20px;
            padding-top: 20px;
            border-top: var(--pixel-border);
            text-align: center;
        }
        
        /* Enlace para crear nueva cuenta */
        .login-footer a {
            color: var(--primary-blue);
            text-decoration: none;
            font-family: 'Press Start 2P', cursive;
            font-size: 0.6rem;
            transition: all 0.3s;
        }
        
        /* Efecto hover del enlace */
        .login-footer a:hover {
            color: var(--secondary-blue);
        }
        
        /* Mensaje de error de validación */
        .error-message {
            background: rgba(255, 0, 0, 0.1);
            border: var(--pixel-border);
            border-color: #ff0000;
            padding: 15px;
            margin-bottom: 20px;
            color: #ff0000;
            font-family: 'Silkscreen', cursive;
            font-size: 0.8rem;
            text-align: center;
        }
        
        /* Icono dentro del mensaje de error */
        .error-message i {
            margin-right: 10px;
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
        
        /* Estilos responsive para dispositivos móviles */
        @media (max-width: 480px) {
            .login-container {
                max-width: 100%;
            }
            
            .login-header {
                padding: 20px 15px;
            }
            
            .login-body {
                padding: 20px 15px;
            }
            
            .login-header h1 {
                font-size: 1rem;
            }
            
            .btn-login {
                font-size: 0.7rem;
            }
        }
    </style>
</head>
<body>
    <!-- Contenedor principal del login -->
    <div class="login-container">

        <div class="pixel-corner pixel-corner-tl"></div>
        <div class="pixel-corner pixel-corner-tr"></div>
        
        <!-- Cabecera con logo y título -->
        <div class="login-header">
        <div class="logo">
        <i class="fas fa-school"></i>
            </div>
            <h1 class="blink">STAY CLEAN</h1>
            <p>VIDEOJUEGO EDUCATIVO</p>
        </div> 
        
        <!-- Cuerpo del formulario -->
        <div class="login-body">
            <!-- Muestra mensaje de error si existe -->
            <?php if (!empty($error_message)): ?>
                <div class="error-message">
                    <i class="fas fa-exclamation-triangle"></i> <?php echo $error_message; ?>
                </div>
            <?php endif; ?>
            
            <!-- Formulario de inicio de sesión -->
            <form action="index.php" method="post">
                <!-- Campo para el usuario -->
                <div class="form-group">
                    <label for="username">USUARIO</label>
                    <div class="input-icon">
                        <i class="fas fa-user"></i>
                        <input type="text" id="username" name="txt-id" class="form-control" placeholder="INGRESA TU USUARIO" required>
                    </div>
                </div>
                
                <!-- Campo para la contraseña -->
                <div class="form-group">
                    <label for="password">CONTRASEÑA</label>
                    <div class="input-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="txt-ct" class="form-control" placeholder="INGRESA TU CONTRASEÑA" required>
                    </div>
                </div>
                
                <!-- Botón para enviar el formulario -->
                <button type="submit" name="btn_ingresar" class="btn-login">
                    INICIAR SESIÓN <i class="fas fa-arrow-right"></i>
                </button>
                
                <!-- Enlace para crear nueva cuenta -->
                <div class="login-footer">
                    <a href="formulario.php">
                        <i class="fas fa-user-plus"></i> CREAR NUEVA CUENTA
                    </a>
                </div>
            </form>
        </div>
        

        <div class="pixel-corner pixel-corner-bl"></div>
        <div class="pixel-corner pixel-corner-br"></div>
    </div>
</body>

<script>
// Evita el reenvío del formulario al usar el botón "atrás" del navegador
if (performance.navigation.type === 2) {
    window.location.replace("index.php");
}
</script>
</html>