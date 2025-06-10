<?php
include_once("../config/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rut = $_POST['rut'];
    $nombre = $_POST['nombre'];
    $fecha = $_POST['fecha'];
    $correo = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $sexo = $_POST['sexo'];
    $telefono = $_POST['telefono'];

    // Manejo del archivo PDF
    $archivo = $_FILES['certificado'];
    $nombreArchivo = $archivo['name'];
    $rutaTemporal = $archivo['tmp_name'];
    $rutaDestino = "../uploads/" . basename($nombreArchivo);

    // Crear carpeta 'uploads' si no existe
    if (!is_dir("../uploads")) {
        mkdir("../uploads", 0755, true);
    }

    if (move_uploaded_file($rutaTemporal, $rutaDestino)) {
        $sql = "INSERT INTO usuarios (rut, nombre_completo, fecha_nacimiento, correo, password, sexo, telefono, archivo_certificado)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ssssssss", $rut, $nombre, $fecha, $correo, $password, $sexo, $telefono, $rutaDestino);

        if ($stmt->execute()) {
            echo "<script>
                    alert('Registro exitoso');
                    window.location.href = '../login.html';
                  </script>";
        } else {
            echo "<script>
                    alert('Error al registrar: " . $stmt->error . "');
                    window.history.back();
                  </script>";
        }

        $stmt->close();
    } else {
        echo "<script>
                alert('Error al subir el certificado.');
                window.history.back();
              </script>";
    }

    $conexion->close();
} else {
    echo "Acceso denegado.";
}
?>
