<?php
// Inicia la sesión para poder acceder a las variables de sesión existentes
session_start();

// Destruye todas las variables de sesión y termina la sesión actual
session_destroy();

// Redirige al usuario a la página de inicio (login) 
echo "<script>window.location='index.php';</script>"
?>