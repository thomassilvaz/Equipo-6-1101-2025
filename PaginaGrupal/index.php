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
    <title>STAY CLEAN - Inicio de Sesión</title>
    
    <link rel="icon" type="image/png" href="Admin/img/logo.png">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    
    

    <style>
        :root {
            --primary: #51a4e7;
            --primary-dark: #3a8bd6;
            --light: #f8f9fc;
            --dark: #2e3a59;
            --gray: #858796;
            --success: #1cc88a;
            --danger: #e74a3b;
            --warning: #f6c23e;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, var(--primary) 0%, var(--dark) 100%);
            font-family: 'Nunito', sans-serif;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }
        
        .login-container {
            width: 100%;
            max-width: 450px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.15);
            overflow: hidden;
            position: relative;
            z-index: 1;
        }
        
        .login-container::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            background: rgba(81, 164, 231, 0.1);
            border-radius: 50%;
            z-index: -1;
        }
        
        .login-container::after {
            content: '';
            position: absolute;
            bottom: -80px;
            left: -80px;
            width: 300px;
            height: 300px;
            background: rgba(81, 164, 231, 0.1);
            border-radius: 50%;
            z-index: -1;
        }
        
        .login-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            padding: 40px 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .login-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%23ffffff' fill-opacity='0.1' d='M0,192L48,197.3C96,203,192,213,288,229.3C384,245,480,267,576,250.7C672,235,768,181,864,181.3C960,181,1056,235,1152,234.7C1248,235,1344,181,1392,154.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z'%3E%3C/path%3E%3C/svg%3E");
            background-size: cover;
            background-position: bottom;
            opacity: 0.3;
        }
        
        .logo {
            width: 100px;
            height: 100px;
            background: white;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 20px;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        
        .logo i {
            font-size: 50px;
            color: var(--primary);
        }
        
        .login-header h1 {
            color: white;
            font-weight: 800;
            font-size: 28px;
            margin-bottom: 10px;
            position: relative;
        }
        
        .login-header p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 16px;
            font-weight: 400;
        }
        
        .login-body {
            padding: 40px 30px;
        }
        
        .form-group {
            margin-bottom: 25px;
            position: relative;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--dark);
            font-weight: 600;
            font-size: 14px;
        }
        
        .input-icon {
            position: relative;
        }
        
        .input-icon i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary);
            font-size: 18px;
        }
        
        .form-control {
            width: 100%;
            padding: 15px 15px 15px 50px;
            border: 1px solid #d1d3e2;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.3s;
            height: 50px;
        }
        
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(81, 164, 231, 0.25);
        }
        
        .btn-login {
            width: 100%;
            padding: 15px;
            background: var(--primary);
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 15px rgba(81, 164, 231, 0.4);
        }
        
        .btn-login:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(81, 164, 231, 0.5);
        }
        
        .btn-login i {
            margin-left: 10px;
            font-size: 18px;
        }
        
        .login-footer {
            display: flex;
            justify-content: space-between;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #e3e6f0;
        }
        
        .login-footer a {
            color: var(--primary);
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .login-footer a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }
        
        .error-message {
            background: rgba(231, 74, 59, 0.1);
            border-left: 4px solid var(--danger);
            padding: 15px;
            margin-bottom: 25px;
            border-radius: 0 4px 4px 0;
            color: var(--danger);
            font-weight: 600;
            font-size: 14px;
            display: flex;
            align-items: center;
        }
        
        .error-message i {
            margin-right: 10px;
            font-size: 18px;
        }
        
        .bubble {
            position: absolute;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            z-index: 0;
        }
        
        .bubble-1 {
            width: 120px;
            height: 120px;
            top: 20%;
            left: 10%;
        }
        
        .bubble-2 {
            width: 80px;
            height: 80px;
            bottom: 30%;
            right: 15%;
        }
        
        .bubble-3 {
            width: 60px;
            height: 60px;
            top: 10%;
            right: 20%;
        }
        
        @media (max-width: 576px) {
            .login-header {
                padding: 30px 20px;
            }
            
            .login-body {
                padding: 30px 20px;
            }
            
            .login-footer {
                flex-direction: column;
                gap: 15px;
                align-items: center;
            }
        }
    </style>
</head>
<body>

    <div class="bubble bubble-1"></div>
    <div class="bubble bubble-2"></div>
    <div class="bubble bubble-3"></div>
    
    <div class="login-container">
        <div class="login-header">
            <div class="logo">
                <i class="fas fa-school"></i>
            </div>
            <h1>STAY CLEAN</h1>
            <p>Videojuego educativo</p>
        </div>
        
        <div class="login-body">
            <?php if (!empty($error_message)): ?>
                <div class="error-message">
                    <i class="fas fa-exclamation-triangle"></i> <?php echo $error_message; ?>
                </div>
            <?php endif; ?>
            
            <form action="index.php" method="post">
                <div class="form-group">
                    <label for="username">Usuario</label>
                    <div class="input-icon">
                        <i class="fas fa-user"></i>
                        <input type="text" id="username" name="txt-id" class="form-control" placeholder="Ingresa tu usuario" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <div class="input-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="txt-ct" class="form-control" placeholder="Ingresa tu contraseña" required>
                    </div>
                </div>
                
                <button type="submit" name="btn_ingresar" class="btn-login">
                    INICIAR SESIÓN <i class="fas fa-arrow-right"></i>
                </button>
                
                <div class="login-footer">
                    <a href="#">
                        <i class="fas fa-question-circle"></i> ¿Olvidaste tu contraseña?
                    </a>
                    <a href="formulario.php">
                        <i class="fas fa-user-plus"></i> Crear nueva cuenta
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>

<script>

if (performance.navigation.type === 2) {

    window.location.replace("index.php");
}
</script>
</html>