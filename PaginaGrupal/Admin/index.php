<?php
session_start();
if (isset($_SESSION['user'])){
    // Obtener información del usuario de la sesión (simulado)
    $nombre_usuario = $_SESSION['user']['nombre'] ?? 'Usuario';
    $rol_usuario = $_SESSION['user']['rol'] ?? 'Invitado';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stay Clean, IEFO - Colegio Federico Ozanam</title>
    <link rel="icon" type="image/png" href="img/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Manteniendo los estilos de SB Admin 2 para compatibilidad con módulos -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #0056b3;    /* Azul institucional principal */
            --secondary-blue: #51a4e7;  /* Azul institucional secundario */
            --accent-yellow: #ffc107;   /* Amarillo para acentos */
            --light-gray: #f8f9fa;      /* Fondo claro */
            --dark-text: #212529;       /* Texto oscuro */
            --white: #ffffff;           /* Blanco */
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Nunito', sans-serif;
        }
        
        body {
            background-color: #f0f4f8;
            color: var(--dark-text);
            line-height: 1.6;
        }
        
        .dashboard-container {
            display: grid;
            grid-template-columns: 250px 1fr;
            min-height: 100vh;
        }
        
        /* Sidebar */
        .sidebar {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
            color: var(--white);
            padding: 20px 0;
            box-shadow: 3px 0 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: 250px;
            height: 100%;
            overflow-y: auto;
            z-index: 100;
        }
        
        .brand {
            padding: 0 20px 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .brand-icon {
            font-size: 2.5rem;
            margin-bottom: 10px;
            color: var(--accent-yellow);
        }
        
        .brand-text {
            font-size: 1.4rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .sidebar-menu {
            list-style: none;
            margin-top: 30px;
        }
        
        .menu-item {
            padding: 12px 20px;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }
        
        .menu-item:hover, .menu-item.active {
            background-color: rgba(255, 255, 255, 0.1);
            border-left: 3px solid var(--accent-yellow);
        }
        
        .menu-item a {
            color: var(--white);
            text-decoration: none;
            display: flex;
            align-items: center;
            font-weight: 600;
        }
        
        .menu-item i {
            margin-right: 12px;
            font-size: 1.1rem;
            width: 24px;
            text-align: center;
        }
        
        .submenu {
            list-style: none;
            margin-left: 30px;
            margin-top: 8px;
            display: none;
        }
        
        .menu-item.active .submenu {
            display: block;
        }
        
        .submenu-item {
            padding: 8px 0;
        }
        
        .submenu-item a {
            font-weight: 400;
            font-size: 0.9rem;
            opacity: 0.9;
        }
        
        /* Main Content */
        .main-content {
            grid-column: 2;
            padding: 20px 30px;
        }
        
        /* Header */
        .header {
            background: var(--white);
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .header-title h1 {
            color: var(--primary-blue);
            font-size: 1.8rem;
            margin-bottom: 5px;
        }
        
        .header-title p {
            color: #6c757d;
            font-size: 1rem;
        }
        
        .user-info {
            display: flex;
            align-items: center;
        }
        
        .user-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
            border: 2px solid var(--secondary-blue);
        }
        
        .user-details span {
            display: block;
        }
        
        .user-name {
            font-weight: 600;
            color: var(--primary-blue);
        }
        
        .user-role {
            font-size: 0.85rem;
            color: #6c757d;
        }
        
        /* Dashboard Grid */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }
        
        .card {
            background: var(--white);
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        
        .card-header {
            background: var(--primary-blue);
            color: var(--white);
            padding: 15px 20px;
            position: relative;
        }
        
        .card-header::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 20px;
            width: 20px;
            height: 20px;
            background: var(--primary-blue);
            transform: rotate(45deg);
        }
        
        .card-header h3 {
            font-size: 1.3rem;
            display: flex;
            align-items: center;
        }
        
        .card-header i {
            margin-right: 10px;
            font-size: 1.2rem;
        }
        
        .card-body {
            padding: 25px 20px;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }
        
        .stat-box {
            text-align: center;
            padding: 15px;
            border-radius: 8px;
            background: var(--light-gray);
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 5px;
        }
        
        .stat-label {
            font-size: 0.9rem;
            color: #6c757d;
        }
        
        /* Project Overview */
        .project-overview {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
            color: var(--white);
            border-radius: 10px;
            padding: 30px;
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
        }
        
        .project-overview::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
        }
        
        .project-overview::after {
            content: '';
            position: absolute;
            bottom: -80px;
            right: -30px;
            width: 150px;
            height: 150px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
        }
        
        .project-title {
            font-size: 2rem;
            margin-bottom: 15px;
            position: relative;
            z-index: 2;
        }
        
        .project-subtitle {
            font-size: 1.2rem;
            margin-bottom: 25px;
            opacity: 0.9;
            position: relative;
            z-index: 2;
        }
        
        .project-description {
            max-width: 800px;
            margin-bottom: 30px;
            position: relative;
            z-index: 2;
            font-size: 1.1rem;
            line-height: 1.7;
        }
        
        .project-stats {
            display: flex;
            gap: 30px;
            margin-top: 20px;
            position: relative;
            z-index: 2;
        }
        
        .project-stat {
            text-align: center;
        }
        
        .project-stat-number {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--accent-yellow);
        }
        
        .project-stat-label {
            font-size: 0.95rem;
            opacity: 0.9;
        }
        
        /* Team Section */
        .team-section {
            margin-top: 40px;
        }
        
        .section-title {
            color: var(--primary-blue);
            font-size: 1.5rem;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--accent-yellow);
            display: inline-block;
        }
        
        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
        }
        
        .team-member {
            background: var(--white);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            text-align: center;
            transition: transform 0.3s;
        }
        
        .team-member:hover {
            transform: translateY(-5px);
        }
        
        .member-photo {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, var(--secondary-blue) 0%, var(--primary-blue) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            color: rgba(255, 255, 255, 0.7);
        }
        
        .member-info {
            padding: 20px;
        }
        
        .member-name {
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 5px;
            font-size: 1.2rem;
        }
        
        .member-role {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 15px;
        }
        
        .member-contact {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 15px;
        }
        
        .contact-icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--light-gray);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-blue);
            transition: all 0.3s;
        }
        
        .contact-icon:hover {
            background: var(--primary-blue);
            color: var(--white);
            transform: scale(1.1);
        }
        
        /* Footer */
        .footer {
            text-align: center;
            padding: 30px;
            margin-top: 50px;
            color: #6c757d;
            font-size: 0.9rem;
            border-top: 1px solid #e9ecef;
        }
        
        .footer-logo {
            color: var(--primary-blue);
            font-weight: 700;
            font-size: 1.1rem;
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .dashboard-container {
                grid-template-columns: 1fr;
            }
            
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }
            
            .main-content {
                grid-column: 1;
            }
        }
        
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                text-align: center;
                gap: 15px;
            }
            
            .project-stats {
                flex-direction: column;
                gap: 15px;
            }
            
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
        }
        
        /* Manteniendo estilos de SB Admin 2 para compatibilidad */
        .content-area {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }
    </style>
</head>

<script>
// Evitar que el botón "Atrás" lleve al login
history.pushState(null, null, location.href);
window.onpopstate = function() {
    history.go(1);
};
</script>

<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="brand">
                <div class="brand-icon">
                    <i class="fas fa-school"></i>
                </div>
                <div class="brand-text">Stay Clean, IEFO</div>
            </div>
            
            <ul class="sidebar-menu">
                <?php
                $current_mod = isset($_GET['mod']) ? $_GET['mod'] : 'inicio';
                $menu_items = [
                    'inicio' => ['icon' => 'fas fa-home', 'name' => 'Inicio'],
                    'descripcion' => ['icon' => 'fas fa-info-circle', 'name' => 'Descripción'],
                    'usuarios' => [
                        'icon' => 'fas fa-users', 
                        'name' => 'Usuarios',
                        'submenu' => [
                            'crear_usuario' => 'Crear usuario',
                            'gestion_usuario' => 'Gestión de usuarios'
                        ]
                    ],
                    'descripcion' => ['icon' => 'fas fa-info-circle', 'name' => 'Descripción'],
                    'historia' => ['icon' => 'fas fa-landmark', 'name' => 'Historia'],
                    'comentarios' => ['icon' => 'fas fa-comments', 'name' => 'Comentarios'],
                    'descarga' => ['icon' => 'fas fa-download', 'name' => 'Descargas'],
                    'cerrar_sesion' => ['icon' => 'fas fa-sign-out-alt', 'name' => 'Cerrar sesión'],

                ];
                
                foreach ($menu_items as $mod => $item) {
                    $is_active = ($mod == $current_mod) || isset($item['submenu']) && in_array($current_mod, array_keys($item['submenu']));
                    $has_submenu = isset($item['submenu']);
                    
                    echo '<li class="menu-item ' . ($is_active ? 'active' : '') . '">';
                    echo '<a href="' . ($has_submenu ? '#' : 'index.php?mod=' . $mod) . '">';
                    echo '<i class="' . $item['icon'] . '"></i>';
                    echo '<span>' . $item['name'] . '</span>';
                    echo '</a>';
                    
                    if ($has_submenu) {
                        echo '<ul class="submenu">';
                        foreach ($item['submenu'] as $submod => $subname) {
                            $is_subactive = ($submod == $current_mod);
                            echo '<li class="submenu-item ' . ($is_subactive ? 'active' : '') . '">';
                            echo '<a href="index.php?mod=' . $submod . '">' . $subname . '</a>';
                            echo '</li>';
                        }
                        echo '</ul>';
                    }
                    
                    echo '</li>';
                }
                ?>
            </ul>
        </aside>
        
        <!-- Main Content -->
        <main class="main-content">
            <!-- Header -->
            <header class="header">
                <div class="header-title">
                    <h1>Stay Clean, IEFO</h1>
                    <p>Plataforma de prevención de drogas para la I.E. Federico Ozanam</p>
                </div>
            </header>
            
            <!-- Área de contenido dinámico -->
            <div class="content-area">
                <?php
                if(!isset($_GET['mod']) || $_GET['mod'] == "inicio") {
                    // Vista de inicio con el dashboard
                ?>
                <!-- Project Overview -->
                <section class="project-overview">
                    <h2 class="project-title">STAY CLEAN, IEFO</h2>
                    <h3 class="project-subtitle">Prevención de consumo de drogas mediante videojuego educativo</h3>
                    
                    <p class="project-description">
                        Proyecto de investigación desarrollado por estudiantes de 11°1 de la Institución Educativa Federico Ozanam 
                        que busca concientizar sobre los riesgos del consumo de sustancias psicoactivas mediante un videojuego educativo. 
                        Nuestra solución combina tecnología, educación y prevención para crear un impacto positivo en nuestra comunidad escolar.
                    </p>
                    
                    <div class="project-stats">
                        <div class="project-stat">
                            <div class="project-stat-number">4</div>
                            <div class="project-stat-label">Integrantes</div>
                        </div>
                        <div class="project-stat">
                            <div class="project-stat-number">638+</div>
                            <div class="project-stat-label">Horas de trabajo</div>
                        </div>
                    </div>
                </section>
                
                <!-- Stats Grid -->
                <div class="dashboard-grid">
                    <div class="card">
                        <div class="card-header">
                            <h3><i class="fas fa-bullseye"></i> Objetivos</h3>
                        </div>
                        <div class="card-body">
                            <h4>Objetivo General</h4>
                            <p>Desarrollar un videojuego educativo para concientizar a los estudiantes sobre el consumo de drogas en la Institución Educativa Federico Ozanam.</p>
                            
                            <h4 style="margin-top: 20px;">Objetivos Específicos</h4>
                            <ul style="padding-left: 20px; margin-top: 10px;">
                                <li>Identificar necesidades y preferencias de los estudiantes</li>
                                <li>Definir estructura narrativa y técnica del videojuego</li>
                                <li>Desarrollar versión funcional compatible con diversos dispositivos</li>
                                <li>Validar usabilidad y efectividad educativa</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-header">
                            <h3><i class="fas fa-chart-bar"></i> Estadísticas</h3>
                        </div>
                        <div class="card-body">
                            <div class="stats-grid">
                                <div class="stat-box">
                                    <div class="stat-number">66.7%</div>
                                    <div class="stat-label">Han visto drogas en la institución</div>
                                </div>
                                <div class="stat-box">
                                    <div class="stat-number">80%</div>
                                    <div class="stat-label">Consideran insuficiente la prevención</div>
                                </div>
                                <div class="stat-box">
                                    <div class="stat-number">#1</div>
                                    <div class="stat-label">Vaper es la droga más común</div>
                                </div>
                                <div class="stat-box">
                                    <div class="stat-number">42</div>
                                    <div class="stat-label">Estudiantes encuestados</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-header">
                            <h3><i class="fas fa-gamepad"></i> Videojuego</h3>
                        </div>
                        <div class="card-body">
                            <h4>Stay Clean, IEFO</h4>
                            <p>Videojuego RPG pixel art con enfoque narrativo donde los estudiantes enfrentan decisiones relacionadas con el consumo de drogas y sus consecuencias.</p>
                            
                            <div style="margin-top: 20px; background: var(--light-gray); padding: 15px; border-radius: 8px;">
                                <h4>Características principales:</h4>
                                <ul style="padding-left: 20px; margin-top: 10px;">
                                    <li>Múltiples rutas narrativas</li>
                                    <li>Decisiones con consecuencias reales</li>
                                    <li>Personajes con los que identificarse</li>
                                    <li>Enfrentamientos simbólicos</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Team Section -->
                <section class="team-section">
                    <h3 class="section-title">Equipo de Investigación</h3>
                    
                    <div class="team-grid">
                        <div class="team-member">
                            <div class="member-photo">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="member-info">
                                <div class="member-name">Camilo Gonzalez Ruiz</div>
                                <div class="member-role">Investigador Principal</div>
                                <p>Encargado de análisis de datos y desarrollo conceptual del proyecto.</p>
                                <div class="member-contact">
                                    <a href="#" class="contact-icon"><i class="fas fa-envelope"></i></a>
                                    <a href="#" class="contact-icon"><i class="fab fa-github"></i></a>
                                    <a href="#" class="contact-icon"><i class="fab fa-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="team-member">
                            <div class="member-photo">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="member-info">
                                <div class="member-name">Miguel Ángel Marín Lopez</div>
                                <div class="member-role">Desarrollador</div>
                                <p>Programador del videojuego y responsable de la implementación técnica.</p>
                                <div class="member-contact">
                                    <a href="#" class="contact-icon"><i class="fas fa-envelope"></i></a>
                                    <a href="#" class="contact-icon"><i class="fab fa-github"></i></a>
                                    <a href="#" class="contact-icon"><i class="fab fa-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="team-member">
                            <div class="member-photo">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="member-info">
                                <div class="member-name">Sebastián Muñoz Zapata</div>
                                <div class="member-role">Diseñador</div>
                                <p>Responsable de la experiencia de usuario y diseño visual del proyecto.</p>
                                <div class="member-contact">
                                    <a href="#" class="contact-icon"><i class="fas fa-envelope"></i></a>
                                    <a href="#" class="contact-icon"><i class="fab fa-github"></i></a>
                                    <a href="#" class="contact-icon"><i class="fab fa-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="team-member">
                            <div class="member-photo">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="member-info">
                                <div class="member-name">Thomas Silva Zapata</div>
                                <div class="member-role">Coordinador</div>
                                <p>Gestión del proyecto, documentación y comunicación con la institución.</p>
                                <div class="member-contact">
                                    <a href="#" class="contact-icon"><i class="fas fa-envelope"></i></a>
                                    <a href="#" class="contact-icon"><i class="fab fa-github"></i></a>
                                    <a href="#" class="contact-icon"><i class="fab fa-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <?php
                } else {
                    // Cargar módulos según el parámetro mod
                    $modulo = $_GET['mod'];
                    $archivo = "modulos/$modulo.php";
                    
                    if(file_exists($archivo)) {
                        require_once($archivo);
                    } else {
                        echo '<div class="alert alert-danger">Módulo no encontrado: ' . htmlspecialchars($modulo) . '</div>';
                    }
                }
                ?>
            </div>
            
            <!-- Footer -->
            <footer class="footer">
                <p>&copy; <?php echo date('Y'); ?> <span class="footer-logo">Stay Clean, IEFO</span> - Institución Educativa Federico Ozanam</p>
                <p>Tecnología e Investigación | Todos los derechos reservados</p>
            </footer>
        </main>
    </div>

    <!-- Manteniendo scripts originales para compatibilidad -->
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <script>
        // Toggle submenus
        document.querySelectorAll('.menu-item').forEach(item => {
            if (item.querySelector('.submenu')) {
                item.addEventListener('click', function(e) {
                    if (!e.target.closest('.submenu')) {
                        this.classList.toggle('active');
                    }
                });
            }
        });
        
        // Simple animation for stats
        const stats = document.querySelectorAll('.stat-number');
        stats.forEach(stat => {
            const target = +stat.innerText.replace('%', '').replace('+', '');
            let count = 0;
            const duration = 2000;
            const increment = target / (duration / 16);
            
            const updateCount = () => {
                if (count < target) {
                    count += increment;
                    stat.innerText = Math.round(count) + (stat.innerText.includes('%') ? '%' : '') + (stat.innerText.includes('+') ? '+' : '');
                    setTimeout(updateCount, 16);
                } else {
                    stat.innerText = target + (stat.innerText.includes('%') ? '%' : '') + (stat.innerText.includes('+') ? '+' : '');
                }
            };
            
            setTimeout(updateCount, 500);
        });
    </script>
</body>
</html>

<?php
} else {
    echo "<script>window.location='../index.php';</script>";
}
?>