<?php
if (isset($_POST['btn_registrar'])) {
    include 'conexion.php';

    $pass = $_POST['txt-ct'];
    $pass2 = $_POST['txt-ctc'];

    if ($pass === $pass2) {
        $clave = password_hash($pass, PASSWORD_DEFAULT);

        $tp = $_POST['cmb-tp']; // Ya recibe CC, TI, CE directamente
        $doc = $_POST['txt-id'];
        $pnombre = $_POST['txt-pn'];
        $snombre = $_POST['txt-sn'];
        $papellido = $_POST['txt-pa'];
        $sapellido = $_POST['txt-sa'];
        $telefono = $_POST['txt-tel'];
        $email = $_POST['txt-cr'];
        $rol = $_POST['cmb-rol'];
        $estado = 1;

        $verificar = mysqli_query($conexion, "SELECT * FROM usuarios WHERE doc = '$doc'");
        if (mysqli_num_rows($verificar) > 0) {
            echo "<script>alert('Este documento ya está registrado');</script>";
            echo "<script>window.location='index.php';</script>";
            exit;
        }

        // Ahora guardamos directamente $tp (CC, TI, CE)
        $registrar = mysqli_query($conexion, "INSERT INTO `usuarios` (`doc`, `tipo_documento`, `PNombre`, `SNombre`, `PApellido`, `SApellido`, `tel`, `email`, `clave`, `Id_rol`) 
        VALUES ('$doc', '$tp', '$pnombre', '$snombre', '$papellido', '$sapellido', '$telefono', '$email', '$clave', '$rol')") or die ($conexion. "Problemas para insertar");

        if ($registrar) {
            echo "<script>alert('Usuario registrado con éxito');</script>";
            echo "<script>window.location='index.php';</script>";
        } else {
            echo "<script>alert('Error al registrar');</script>";
            echo "<script>window.location='index.php';</script>";
        }
    } else {
        echo "<script>alert('Las contraseñas no coinciden');</script>";
        echo "<script>window.location='index.php';</script>";
    }
} else {
    echo "<script>alert('Error');</script>";
    echo "<script>window.location='index.php';</script>";
}
?>