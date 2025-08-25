<?php
// Iniciar el buffer de salida
ob_start();

// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Destruir completamente la sesión
$_SESSION = array();

// Eliminar la cookie de sesión
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destruir la sesión
session_destroy();

// Limpiar TODO el buffer de salida
ob_end_clean();

// Enviar encabezados de control de caché
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>Cerrando sesión...</title>
    <script>
        // Función para eliminar todas las cookies
        function deleteAllCookies() {
            const cookies = document.cookie.split(";");
            for (let i = 0; i < cookies.length; i++) {
                const cookie = cookies[i];
                const eqPos = cookie.indexOf("=");
                const name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
                document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/";
            }
        }
        
        // Eliminar cookies y redirigir inmediatamente
        deleteAllCookies();
        localStorage.clear();
        sessionStorage.clear();
        
        // Redirección forzada sin cache
        window.location.replace("../index.php?nocache=" + new Date().getTime());
        
        // Prevenir que el botón "Atrás" funcione
        window.history.pushState(null, null, window.location.href);
        window.onpopstate = function() {
            window.history.go(1);
            window.location.replace("../index.php");
        };
    </script>
</head>
<body>
    <!-- Contenido mínimo para que el script se ejecute -->
    <noscript>
        <p>Por favor, habilita JavaScript para cerrar sesión correctamente.</p>
        <p><a href="../index.php">Haz clic aquí para continuar</a></p>
    </noscript>
</body>
</html>
<?php exit(); ?>