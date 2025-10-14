<?php
session_start();

if (isset($_SESSION['user'])) {
    header("Location: admin/index.php");
    exit();
}

if (isset($_POST['btn_ingresar'])) {
    include "conexion.php";
    $pass = $_POST['txt-ct'];
    $user = $_POST['txt-id'];
    if (!empty($pass) and !empty($user)) {
        $consulta = mysqli_query($conexion, "SELECT * FROM usuarios WHERE doc=$user") or die ($conexion. "Problemas en la consulta");

        $num = mysqli_num_rows($consulta);
        if ($num > 0) {
            $fila = mysqli_fetch_array($consulta);

            if (password_verify($pass, $fila['clave'])) {
                $_SESSION['user'] = $fila['doc'];
                $_SESSION['pn'] = $fila['PNombre'];
                $_SESSION['pa'] = $fila['PApellido'];

                echo "<script>window.location='admin/index.php';</script>";
                exit();
            } else {
                $error_message = "⚠️ CONTRASEÑA INCORRECTA ⚠️";
            }
        } else {
            $error_message = "⚠️ USUARIO NO ENCONTRADO ⚠️";
        }
    } else {
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
    
    <link rel="icon" type="image/png" href="Admin/img/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Silkscreen&display=swap" rel="stylesheet">
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
        
        .login-container {
            width: 100%;
            max-width: 400px;
            background: var(--white);
            border: var(--pixel-border);
            box-shadow: var(--pixel-shadow);
            position: relative;
        }
        
        .login-header {
            background-color: var(--primary-blue);
            color: white;
            padding: 30px 20px;
            text-align: center;
            border-bottom: var(--pixel-border);
            position: relative;
        }
        
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
        
        .logo i {
            font-size: 40px;
            color: var(--primary-blue);
        }
        
        .login-header h1 {
            font-family: 'Press Start 2P', cursive;
            font-size: 1.2rem;
            margin-bottom: 10px;
            text-shadow: 2px 2px 0 #000;
        }
        
        .login-header p {
            font-size: 0.8rem;
            opacity: 0.9;
        }
        
        .login-body {
            padding: 30px 25px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--primary-blue);
            font-family: 'Press Start 2P', cursive;
            font-size: 0.7rem;
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
            font-size: 1rem;
            background-color: var(--white);
            box-shadow: 2px 2px 0 #000;
            height: 50px;
        }
        
        .form-control:focus {
            border-color: var(--primary-blue);
            outline: none;
        }
        
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
        
        .btn-login:hover {
            background: var(--secondary-blue);
        }
        
        .btn-login i {
            margin-left: 10px;
        }
        
        .login-footer {
            margin-top: 20px;
            padding-top: 20px;
            border-top: var(--pixel-border);
            text-align: center;
        }
        
        .login-footer a {
            color: var(--primary-blue);
            text-decoration: none;
            font-family: 'Press Start 2P', cursive;
            font-size: 0.6rem;
            transition: all 0.3s;
        }
        
        .login-footer a:hover {
            color: var(--secondary-blue);
        }
        
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
        
        .error-message i {
            margin-right: 10px;
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
    <div class="login-container">
        <div class="pixel-corner pixel-corner-tl"></div>
        <div class="pixel-corner pixel-corner-tr"></div>
        
        <div class="login-header">
        <div class="logo">
        <i class="fas fa-school"></i>
            </div>
            <h1 class="blink">STAY CLEAN</h1>
            <p>VIDEOJUEGO EDUCATIVO</p>
        </div>
        
        <div class="login-body">
            <?php if (!empty($error_message)): ?>
                <div class="error-message">
                    <i class="fas fa-exclamation-triangle"></i> <?php echo $error_message; ?>
                </div>
            <?php endif; ?>
            
            <form action="index.php" method="post">
                <div class="form-group">
                    <label for="username">USUARIO</label>
                    <div class="input-icon">
                        <i class="fas fa-user"></i>
                        <input type="text" id="username" name="txt-id" class="form-control" placeholder="INGRESA TU USUARIO" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="password">CONTRASEÑA</label>
                    <div class="input-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="txt-ct" class="form-control" placeholder="INGRESA TU CONTRASEÑA" required>
                    </div>
                </div>
                
                <button type="submit" name="btn_ingresar" class="btn-login">
                    INICIAR SESIÓN <i class="fas fa-arrow-right"></i>
                </button>
                
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
if (performance.navigation.type === 2) {
    window.location.replace("index.php");
}
</script>
</html>