<?php
// Verifica si se ha presionado el botón de registrar
if (isset($_POST['btn_registrar'])) {
    // Incluye el archivo de conexión a la base de datos
    include 'conexion.php';

    // Obtiene las contraseñas del formulario
    $pass = $_POST['txt-ct'];
    $pass2 = $_POST['txt-ctc'];

    // Verifica que las contraseñas coincidan
    if ($pass === $pass2) {
        // Encripta la contraseña para almacenarla de forma segura
        $clave = password_hash($pass, PASSWORD_DEFAULT);

        // Obtiene todos los datos del formulario
        $tp = $_POST['cmb-tp']; 
        $doc = $_POST['txt-id'];
        $pnombre = $_POST['txt-pn'];
        $snombre = $_POST['txt-sn'];
        $papellido = $_POST['txt-pa'];
        $sapellido = $_POST['txt-sa'];
        $telefono = $_POST['txt-tel'];
        $email = $_POST['txt-cr'];
        $rol = $_POST['cmb-rol'];
        $estado = 1;

        // Verifica si el documento ya existe en la base de datos
        $verificar = mysqli_query($conexion, "SELECT * FROM usuarios WHERE doc = '$doc'");
        if (mysqli_num_rows($verificar) > 0) {
            // Muestra alerta si el documento ya está registrado
            echo "<script>alert('Este documento ya está registrado');</script>";
            echo "<script>window.location='index.php';</script>";
            exit;
        }

        // Inserta el nuevo usuario en la base de datos
        $registrar = mysqli_query($conexion, "INSERT INTO `usuarios` (`doc`, `tipo_documento`, `PNombre`, `SNombre`, `PApellido`, `SApellido`, `tel`, `email`, `clave`, `Id_rol`) 
        VALUES ('$doc', '$tp', '$pnombre', '$snombre', '$papellido', '$sapellido', '$telefono', '$email', '$clave', '$rol')") or die ($conexion. "Problemas para insertar");

        // Verifica si el registro fue exitoso
        if ($registrar) {
            echo "<script>alert('Usuario registrado con éxito');</script>";
            echo "<script>window.location='index.php';</script>";
        } else {
            echo "<script>alert('Error al registrar');</script>";
            echo "<script>window.location='index.php';</script>";
        }
    } else {
        // Muestra error si las contraseñas no coinciden
        echo "<script>alert('Las contraseñas no coinciden');</script>";
        echo "<script>window.location='index.php';</script>";
    }
} else {
    // Muestra error si no se presionó el botón de registrar
    echo "<script>alert('Error');</script>";
    echo "<script>window.location='index.php';</script>";
}
?>