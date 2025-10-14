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
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Silkscreen&display=swap" rel="stylesheet">
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
            background-color: #f0f4f8;
            color: var(--dark-text);
            line-height: 1.6;
            font-family: 'Silkscreen', cursive;
            background-image: 
                linear-gradient(rgba(0, 86, 179, 0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 86, 179, 0.05) 1px, transparent 1px);
            background-size: 20px 20px;
        }
        
        .dashboard-container {
            display: grid;
            grid-template-columns: 250px 1fr;
            min-height: 100vh;
        }
        
        /* Sidebar estilo 8-bit */
        .sidebar {
            background-color: var(--primary-blue);
            color: var(--white);
            padding: 20px 0;
            border-right: var(--pixel-border);
            position: fixed;
            width: 250px;
            height: 100%;
            overflow-y: auto;
            z-index: 100;
            box-shadow: var(--pixel-shadow);
        }
        
        .brand {
            padding: 0 20px 20px;
            text-align: center;
            border-bottom: 4px dotted var(--accent-yellow);
            margin-bottom: 10px;
        }
        
        .brand-icon {
            font-size: 2.5rem;
            margin-bottom: 10px;
            color: var(--accent-yellow);
            filter: drop-shadow(2px 2px 0 #000);
        }
        
        .brand-text {
            font-size: 1.2rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-family: 'Press Start 2P', cursive;
            text-shadow: 2px 2px 0 #000;
        }
        
        .sidebar-menu {
            list-style: none;
            margin-top: 30px;
        }
        
        .menu-item {
            padding: 12px 20px;
            transition: all 0.3s;
            border-left: 4px solid transparent;
            font-family: 'Press Start 2P', cursive;
            font-size: 0.7rem;
        }
        
        .menu-item:hover, .menu-item.active {
            background-color: rgba(255, 255, 255, 0.1);
            border-left: 4px solid var(--accent-yellow);
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
            font-size: 0.6rem;
        }
        
        .submenu-item a {
            font-weight: 400;
            opacity: 0.9;
        }
        
        /* Main Content */
        .main-content {
            grid-column: 2;
            padding: 20px 30px;
        }
        
        /* Header estilo 8-bit */
        .header {
            background: var(--white);
            padding: 20px 30px;
            border: var(--pixel-border);
            box-shadow: var(--pixel-shadow);
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: var(--secondary-blue);
            color: white;
            position: relative;
        }
        
        .header::before {
            content: "";
            position: absolute;
            top: 4px;
            left: 4px;
            right: -4px;
            bottom: -4px;
            background-color: var(--primary-blue);
            z-index: -1;
        }
        
        .header-title h1 {
            color: var(--white);
            font-size: 1.8rem;
            margin-bottom: 5px;
            font-family: 'Press Start 2P', cursive;
            text-shadow: 2px 2px 0 #000;
        }
        
        .header-title p {
            color: #e9ecef;
            font-size: 1rem;
            font-family: 'Silkscreen', cursive;
        }
        
        .user-info {
            display: flex;
            align-items: center;
        }
        
        .user-info img {
            width: 40px;
            height: 40px;
            border-radius: 0;
            margin-right: 10px;
            border: var(--pixel-border);
            image-rendering: pixelated;
        }
        
        .user-details span {
            display: block;
        }
        
        .user-name {
            font-weight: 600;
            color: var(--accent-yellow);
            font-family: 'Press Start 2P', cursive;
            font-size: 0.7rem;
        }
        
        .user-role {
            font-size: 0.85rem;
            color: #e9ecef;
            font-family: 'Silkscreen', cursive;
        }
        
        /* Dashboard Grid estilo 8-bit */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }
        
        .card {
            background: var(--white);
            border: var(--pixel-border);
            box-shadow: var(--pixel-shadow);
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            position: relative;
            background-color: #fff;
        }
        
        .card:hover {
            transform: translate(-4px, -4px);
            box-shadow: 8px 8px 0 #000;
        }
        
        .card-header {
            background: var(--primary-blue);
            color: var(--white);
            padding: 15px 20px;
            position: relative;
            border-bottom: var(--pixel-border);
            font-family: 'Press Start 2P', cursive;
            font-size: 0.8rem;
        }
        
        .card-header h3 {
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            text-shadow: 1px 1px 0 #000;
        }
        
        .card-header i {
            margin-right: 10px;
            font-size: 1.2rem;
        }
        
        .card-body {
            padding: 25px 20px;
            font-family: 'Silkscreen', cursive;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }
        
        .stat-box {
            text-align: center;
            padding: 15px;
            border: var(--pixel-border);
            background: var(--light-gray);
            position: relative;
        }
        
        .stat-box::before {
            content: "";
            position: absolute;
            top: 4px;
            left: 4px;
            right: -4px;
            bottom: -4px;
            background-color: var(--secondary-blue);
            z-index: -1;
            opacity: 0.3;
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 5px;
            font-family: 'Press Start 2P', cursive;
            text-shadow: 1px 1px 0 #000;
        }
        
        .stat-label {
            font-size: 0.9rem;
            color: #6c757d;
        }
        
        /* Project Overview estilo 8-bit */
        .project-overview {
            background-color: var(--primary-blue);
            color: var(--white);
            border: var(--pixel-border);
            padding: 30px;
            margin-bottom: 30px;
            position: relative;
            overflow: hidden;
            box-shadow: var(--pixel-shadow);
        }
        
        .project-overview::before {
            content: "";
            position: absolute;
            top: 4px;
            left: 4px;
            right: -4px;
            bottom: -4px;
            background-color: #000;
            z-index: -1;
            opacity: 0.2;
        }
        
        .project-title {
            font-size: 1.8rem;
            margin-bottom: 15px;
            position: relative;
            z-index: 2;
            font-family: 'Press Start 2P', cursive;
            text-shadow: 3px 3px 0 #000;
            color: var(--accent-yellow);
        }
        
        .project-subtitle {
            font-size: 1.1rem;
            margin-bottom: 25px;
            opacity: 0.9;
            position: relative;
            z-index: 2;
            font-family: 'Press Start 2P', cursive;
        }
        
        .project-description {
            max-width: 800px;
            margin-bottom: 30px;
            position: relative;
            z-index: 2;
            font-size: 1rem;
            line-height: 1.7;
            font-family: 'Silkscreen', cursive;
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
            border: 4px dotted var(--accent-yellow);
            padding: 15px;
            background-color: rgba(0, 0, 0, 0.2);
        }
        
        .project-stat-number {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--accent-yellow);
            font-family: 'Press Start 2P', cursive;
            text-shadow: 2px 2px 0 #000;
        }
        
        .project-stat-label {
            font-size: 0.95rem;
            opacity: 0.9;
            font-family: 'Silkscreen', cursive;
        }
        
        /* Team Section estilo 8-bit */
        .team-section {
            margin-top: 40px;
        }
        
        .section-title {
            color: var(--primary-blue);
            font-size: 1.5rem;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 4px solid var(--accent-yellow);
            display: inline-block;
            font-family: 'Press Start 2P', cursive;
            text-shadow: 2px 2px 0 #000;
        }
        
        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
        }
        
        .team-member {
            background: var(--white);
            border: var(--pixel-border);
            overflow: hidden;
            box-shadow: var(--pixel-shadow);
            text-align: center;
            transition: transform 0.3s;
            position: relative;
        }
        
        .team-member:hover {
            transform: translate(-4px, -4px);
            box-shadow: 8px 8px 0 #000;
        }
        
        .member-photo {
            width: 100%;
            height: 200px;
            background-color: var(--secondary-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            color: rgba(255, 255, 255, 0.7);
            border-bottom: var(--pixel-border);
            image-rendering: pixelated;
        }
        
        .member-photo::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                linear-gradient(45deg, #000 25%, transparent 25%), 
                linear-gradient(-45deg, #000 25%, transparent 25%), 
                linear-gradient(45deg, transparent 75%, #000 75%), 
                linear-gradient(-45deg, transparent 75%, #000 75%);
            background-size: 20px 20px;
            background-position: 0 0, 0 10px, 10px -10px, -10px 0px;
            opacity: 0.1;
        }
        
        .member-info {
            padding: 20px;
        }
        
        .member-name {
            font-weight: 700;
            color: var(--primary-blue);
            margin-bottom: 5px;
            font-size: 1.2rem;
            font-family: 'Press Start 2P', cursive;
            text-shadow: 1px 1px 0 #000;
        }
        
        .member-role {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 15px;
            font-family: 'Silkscreen', cursive;
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
            border-radius: 0;
            background: var(--light-gray);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-blue);
            transition: all 0.3s;
            border: var(--pixel-border);
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
            border-top: 4px dotted #e9ecef;
            font-family: 'Silkscreen', cursive;
        }
        
        .footer-logo {
            color: var(--primary-blue);
            font-weight: 700;
            font-size: 1.1rem;
            font-family: 'Press Start 2P', cursive;
        }
        
        /* Efectos especiales 8-bit */
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
        
        .pixel-grid {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                linear-gradient(rgba(0, 0, 0, 0.1) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 0, 0, 0.1) 1px, transparent 1px);
            background-size: 20px 20px;
            pointer-events: none;
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
            
            .menu-item {
                font-size: 0.6rem;
            }
            
            .brand-text {
                font-size: 1rem;
            }
        }
        
        /* Manteniendo estilos de SB Admin 2 para compatibilidad */
        .content-area {
            background: white;
            padding: 20px;
            border: var(--pixel-border);
            box-shadow: var(--pixel-shadow);
            position: relative;
        }
        
        .content-area::before {
            content: "";
            position: absolute;
            top: 4px;
            left: 4px;
            right: -4px;
            bottom: -4px;
            background-color: var(--light-gray);
            z-index: -1;
        }
        
        /* Animación de parpadeo para títulos */
        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        
        .blink {
            animation: blink 1.5s infinite;
        }
        
        /* Efecto de glitch para hover */
        @keyframes glitch {
            0% { transform: translate(0); }
            20% { transform: translate(-2px, 2px); }
            40% { transform: translate(-2px, -2px); }
            60% { transform: translate(2px, 2px); }
            80% { transform: translate(2px, -2px); }
            100% { transform: translate(0); }
        }
        
        .glitch:hover {
            animation: glitch 0.3s infinite;
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
                <div class="pixel-corner pixel-corner-tl"></div>
                <div class="pixel-corner pixel-corner-tr"></div>
                <div class="header-title">
                    <h1 class="blink">STAY CLEAN, IEFO</h1>
                    <p>Plataforma de prevención de drogas para la I.E. Federico Ozanam</p>
                </div>
                <div class="pixel-corner pixel-corner-bl"></div>
                <div class="pixel-corner pixel-corner-br"></div>
            </header>
            
            <!-- Área de contenido dinámico -->
            <div class="content-area">
                <div class="pixel-grid"></div>
                <?php
                if(!isset($_GET['mod']) || $_GET['mod'] == "inicio") {
                    // Vista de inicio con el dashboard
                ?>
                <!-- Project Overview -->
                <section class="project-overview">
                    <div class="pixel-corner pixel-corner-tl"></div>
                    <div class="pixel-corner pixel-corner-tr"></div>
                    <h2 class="project-title">STAY CLEAN, IEFO</h2>
                    <h3 class="project-subtitle">PREVENCIÓN DE CONSUMO DE DROGAS MEDIANTE VIDEOJUEGO EDUCATIVO</h3>
                    
                    <p class="project-description">
                        Proyecto de investigación desarrollado por estudiantes de 11°1 de la Institución Educativa Federico Ozanam 
                        que busca concientizar sobre los riesgos del consumo de sustancias psicoactivas mediante un videojuego educativo. 
                        Nuestra solución combina tecnología, educación y prevención para crear un impacto positivo en nuestra comunidad escolar.
                    </p>
                    
                    <div class="project-stats">
                        <div class="project-stat">
                            <div class="project-stat-number">4</div>
                            <div class="project-stat-label">INTEGRANTES</div>
                        </div>
                        <div class="project-stat">
                            <div class="project-stat-number">638+</div>
                            <div class="project-stat-label">HORAS DE TRABAJO</div>
                        </div>
                    </div>
                    <div class="pixel-corner pixel-corner-bl"></div>
                    <div class="pixel-corner pixel-corner-br"></div>
                </section>
                
                <!-- Stats Grid -->
                <div class="dashboard-grid">
                    <div class="card">
                        <div class="pixel-corner pixel-corner-tl"></div>
                        <div class="pixel-corner pixel-corner-tr"></div>
                        <div class="card-header">
                            <h3><i class="fas fa-bullseye"></i> OBJETIVOS</h3>
                        </div>
                        <div class="card-body">
                            <h4 style="font-family: 'Press Start 2P', cursive; font-size: 0.8rem; margin-bottom: 10px;">OBJETIVO GENERAL</h4>
                            <p>Desarrollar un videojuego educativo para concientizar a los estudiantes sobre el consumo de drogas en la Institución Educativa Federico Ozanam.</p>
                            
                            <h4 style="margin-top: 20px; font-family: 'Press Start 2P', cursive; font-size: 0.8rem;">OBJETIVOS ESPECÍFICOS</h4>
                            <ul style="padding-left: 20px; margin-top: 10px;">
                                <li>Identificar necesidades y preferencias de los estudiantes</li>
                                <li>Definir estructura narrativa y técnica del videojuego</li>
                                <li>Desarrollar versión funcional compatible con diversos dispositivos</li>
                                <li>Validar usabilidad y efectividad educativa</li>
                            </ul>
                        </div>
                        <div class="pixel-corner pixel-corner-bl"></div>
                        <div class="pixel-corner pixel-corner-br"></div>
                    </div>
                    
                    
                    <div class="card">
                        <div class="pixel-corner pixel-corner-tl"></div>
                        <div class="pixel-corner pixel-corner-tr"></div>
                        <div class="card-header">
                            <h3><i class="fas fa-gamepad"></i> VIDEOJUEGO</h3>
                        </div>
                        <div class="card-body">
                            <h4 style="font-family: 'Press Start 2P', cursive; font-size: 0.8rem; margin-bottom: 10px;">STAY CLEAN, IEFO</h4>
                            <p>Videojuego RPG pixel art con enfoque narrativo donde los estudiantes enfrentan decisiones relacionadas con el consumo de drogas y sus consecuencias.</p>
                            
                            <div style="margin-top: 20px; background: var(--light-gray); padding: 15px; border: var(--pixel-border); position: relative;">
                                <h4 style="font-family: 'Press Start 2P', cursive; font-size: 0.7rem;">CARACTERÍSTICAS PRINCIPALES:</h4>
                                <ul style="padding-left: 20px; margin-top: 10px;">
                                    <li>Múltiples rutas narrativas</li>
                                    <li>Decisiones con consecuencias reales</li>
                                    <li>Personajes con los que identificarse</li>
                                    <li>Enfrentamientos simbólicos</li>
                                </ul>
                            </div>
                        </div>
                        <div class="pixel-corner pixel-corner-bl"></div>
                        <div class="pixel-corner pixel-corner-br"></div>
                    </div>
                </div>
                
                <!-- Team Section -->
                <section class="team-section">
                    <h3 class="section-title">EQUIPO DE INVESTIGACIÓN</h3>
                    
                    <div class="team-grid">
                        <div class="team-member glitch">
                            <div class="pixel-corner pixel-corner-tl"></div>
                            <div class="pixel-corner pixel-corner-tr"></div>
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
                            <div class="pixel-corner pixel-corner-bl"></div>
                            <div class="pixel-corner pixel-corner-br"></div>
                        </div>
                        
                        <div class="team-member glitch">
                            <div class="pixel-corner pixel-corner-tl"></div>
                            <div class="pixel-corner pixel-corner-tr"></div>
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
                            <div class="pixel-corner pixel-corner-bl"></div>
                            <div class="pixel-corner pixel-corner-br"></div>
                        </div>
                        
                        <div class="team-member glitch">
                            <div class="pixel-corner pixel-corner-tl"></div>
                            <div class="pixel-corner pixel-corner-tr"></div>
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
                            <div class="pixel-corner pixel-corner-bl"></div>
                            <div class="pixel-corner pixel-corner-br"></div>
                        </div>
                        
                        <div class="team-member glitch">
                            <div class="pixel-corner pixel-corner-tl"></div>
                            <div class="pixel-corner pixel-corner-tr"></div>
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
                            <div class="pixel-corner pixel-corner-bl"></div>
                            <div class="pixel-corner pixel-corner-br"></div>
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
        
        // Efecto de sonido para interacciones
        document.querySelectorAll('.menu-item, .card, .team-member, .contact-icon').forEach(element => {
            element.addEventListener('mouseenter', function() {
                // Podrías agregar un sonido de videojuego aquí
                // new Audio('sounds/hover.wav').play();
            });
            
            element.addEventListener('click', function() {
                // Podrías agregar un sonido de selección aquí
                // new Audio('sounds/select.wav').play();
            });
        });
        
        // Efecto de pixelado para imágenes
        document.querySelectorAll('img').forEach(img => {
            img.style.imageRendering = 'pixelated';
        });
    </script>
</body>
</html>

<?php
} else {
    echo "<script>window.location='../index.php';</script>";
}
?>