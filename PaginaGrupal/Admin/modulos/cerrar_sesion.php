<?php

ob_start();

// Si la sesión aún no está iniciada, se inicia
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Limpiar todas las variables de sesión
$_SESSION = array();

// Si la sesión usa cookies, se elimina la cookie asociada
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),   // Nombre de la cookie de sesión
        '',               // Valor vacío
        time() - 42000,   // Fecha de expiración en el pasado
        $params["path"],  // Ruta
        $params["domain"],// Dominio
        $params["secure"],// Si es segura
        $params["httponly"] // Solo accesible por HTTP (no por JS)
    );
}

// Destruir completamente la sesión
session_destroy();

// Limpiar el buffer de salida por completo
ob_end_clean();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <!-- Evitar que el navegador guarde caché -->
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

    <title>Cerrando sesión...</title>

    <script>

        // Función que elimina todas las cookies existentes del navegador
        function deleteAllCookies() {
            const cookies = document.cookie.split(";");
            for (let i = 0; i < cookies.length; i++) {
                const cookie = cookies[i];
                const eqPos = cookie.indexOf("=");
                const name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
                // Borra la cookie estableciendo una fecha de expiración en el pasado
                document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/";
            }
        }


        // Elimina cookies, localStorage y sessionStorage
        deleteAllCookies();
        localStorage.clear();
        sessionStorage.clear();
        
        // Redirige al usuario a la página principal (index.php)
        // Se agrega un parámetro aleatorio (nocache) para evitar caché
        window.location.replace("../index.php?nocache=" + new Date().getTime());
        
        // Se evita que el usuario regrese a la página anterior después de cerrar sesión
        window.history.pushState(null, null, window.location.href);
        window.onpopstate = function() {
            window.history.go(1);
            window.location.replace("../index.php");
        };
    </script>
</head>

<body>
    <!-- Este contenido solo aparece si el usuario tiene JavaScript desactivado -->
    <noscript>
        <p>Por favor, habilita JavaScript para cerrar sesión correctamente.</p>
        <p><a href="../index.php">Haz clic aquí para continuar</a></p>
    </noscript>
</body>
</html>

<?php 
// Cierra el script de forma segura para evitar ejecución adicional
exit(); 
?>
