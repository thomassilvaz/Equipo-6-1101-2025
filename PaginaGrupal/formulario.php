<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario - Stay Clean</title>

    <link rel="icon" type="image/png" href="Admin/img/logo.png">
    
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
    <!-- Google Fonts -->
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
        
        .register-container {
            width: 100%;
            max-width: 800px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.15);
            overflow: hidden;
            position: relative;
            z-index: 1;
            display: flex;
            min-height: 600px;
        }
        
        .register-header {
            flex: 1;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
        }
        
        .register-header::before {
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
            margin-bottom: 30px;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        
        .logo i {
            font-size: 50px;
            color: var(--primary);
        }
        
        .register-header h1 {
            color: white;
            font-weight: 800;
            font-size: 28px;
            margin-bottom: 15px;
            text-align: center;
        }
        
        .register-header p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 16px;
            font-weight: 400;
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
            font-size: 14px;
        }
        
        .features li i {
            margin-right: 10px;
            background: rgba(255, 255, 255, 0.2);
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .register-body {
            flex: 1.5;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .register-body h2 {
            color: var(--dark);
            font-weight: 800;
            font-size: 24px;
            margin-bottom: 5px;
        }
        
        .register-body p {
            color: var(--gray);
            font-size: 14px;
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
            color: var(--dark);
            font-weight: 600;
            font-size: 13px;
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
            font-size: 16px;
        }
        
        .form-control {
            width: 100%;
            padding: 12px 15px 12px 45px;
            border: 1px solid #d1d3e2;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s;
            height: 45px;
        }
        
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(81, 164, 231, 0.25);
        }
        
        .btn-register {
            width: 100%;
            padding: 14px;
            background: var(--primary);
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 20px;
            box-shadow: 0 4px 15px rgba(81, 164, 231, 0.4);
        }
        
        .btn-register:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(81, 164, 231, 0.5);
        }
        
        .login-link {
            text-align: center;
            margin-top: 20px;
            color: var(--gray);
            font-size: 14px;
        }
        
        .login-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .login-link a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
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
        
        @media (max-width: 768px) {
            .register-container {
                flex-direction: column;
            }
            
            .register-header {
                padding: 30px 20px;
            }
            
            .register-body {
                padding: 30px 20px;
            }
            
            .form-group {
                flex: 1 0 100%;
            }
        }
    </style>
</head>
<body>
    <!-- Efectos de burbujas -->
    <div class="bubble bubble-1"></div>
    <div class="bubble bubble-2"></div>
    <div class="bubble bubble-3"></div>
    
    <div class="register-container">
        <div class="register-header">
            <div class="logo">
                <i class="fas fa-school"></i>
            </div>
            <h1>STAY CLEAN</h1>
            <p>Videojuego educativo</p>
        </div>
        
        <div class="register-body">
            <h2>Registro de Usuario</h2>
            <p>Crea una cuenta para acceder al sistema</p>
            
            <form action="codigo.php" method="post">
                <div class="form-row">
                    <div class="form-group">
                        <label>Tipo de Documento</label>
                        <div class="input-icon">
                            <i class="fas fa-id-card"></i>
                            <select name="cmb-tp" class="form-control" required>
                                <option value="">Tipo de Documento</option>
                                <option value="TI">TARJETA DE IDENTIDAD</option>
                                <option value="CC">CÉDULA DE CIUDADANÍA</option>
                                <option value="CE">CÉDULA DE EXTRANJERÍA</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Número de Identificación</label>
                        <div class="input-icon">
                            <i class="fas fa-hashtag"></i>
                            <input type="text" name="txt-id" class="form-control" placeholder="Número de identificación" required>
                        </div>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Primer Nombre</label>
                        <div class="input-icon">
                            <i class="fas fa-user"></i>
                            <input type="text" name="txt-pn" class="form-control" placeholder="Primer nombre" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Segundo Nombre</label>
                        <div class="input-icon">
                            <i class="fas fa-user"></i>
                            <input type="text" name="txt-sn" class="form-control" placeholder="Segundo nombre (opcional)">
                        </div>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Primer Apellido</label>
                        <div class="input-icon">
                            <i class="fas fa-user"></i>
                            <input type="text" name="txt-pa" class="form-control" placeholder="Primer apellido" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Segundo Apellido</label>
                        <div class="input-icon">
                            <i class="fas fa-user"></i>
                            <input type="text" name="txt-sa" class="form-control" placeholder="Segundo apellido (opcional)">
                        </div>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Teléfono</label>
                        <div class="input-icon">
                            <i class="fas fa-phone"></i>
                            <input type="tel" name="txt-tel" class="form-control" placeholder="Número de teléfono" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Correo Electrónico</label>
                        <div class="input-icon">
                            <i class="fas fa-envelope"></i>
                            <input type="email" name="txt-cr" class="form-control" placeholder="Correo electrónico" required>
                        </div>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Rol del Usuario</label>
                        <div class="input-icon">
                            <i class="fas fa-user-tag"></i>
                            <select name="cmb-rol" class="form-control" required>
                                <option value="">Seleccione un rol</option>
                                <option value="1">ADMINISTRADOR</option>
                                <option value="2">OPERARIO</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Contraseña</label>
                        <div class="input-icon">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="txt-ct" class="form-control" placeholder="Contraseña" required>
                        </div>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Confirmar Contraseña</label>
                        <div class="input-icon">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="txt-ctc" class="form-control" placeholder="Confirmar contraseña" required>
                        </div>
                    </div>
                </div>
                
                <button type="submit" name="btn_registrar" class="btn-register">
                    <i class="fas fa-user-plus"></i> REGISTRAR USUARIO
                </button>
                
                <div class="login-link">
                    ¿Ya tienes una cuenta? <a href="index.php">Inicia sesión aquí</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
