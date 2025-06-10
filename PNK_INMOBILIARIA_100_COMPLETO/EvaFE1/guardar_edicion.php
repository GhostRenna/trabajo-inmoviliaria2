<?php
session_start();
require 'login/db.php';

if (!isset($_SESSION['id_usuario'])) {
  header("Location: login/login.php");
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $campos = ['id_propiedad', 'tipo_propiedad', 'descripcion', 'banos', 'dormitorios', 'area_total',
             'area_construida', 'precio_clp', 'precio_uf', 'fecha_publicacion', 'solicita_visita',
             'bodega', 'estacionamiento', 'logia', 'cocina_amoblada', 'antejardin', 'patio_trasero', 'piscina'];

  foreach ($campos as $campo) {
    $$campo = $_POST[$campo] ?? '';
  }

  $stmt = $conn->prepare("UPDATE propiedades SET tipo_propiedad=?, descripcion=?, banos=?, dormitorios=?,
    area_total=?, area_construida=?, precio_clp=?, precio_uf=?, fecha_publicacion=?, solicita_visita=?,
    bodega=?, estacionamiento=?, logia=?, cocina_amoblada=?, antejardin=?, patio_trasero=?, piscina=?
    WHERE id_propiedad=?");

  $stmt->bind_param("ssiiddddsiiiiiiiiii", $tipo_propiedad, $descripcion, $banos, $dormitorios, $area_total,
    $area_construida, $precio_clp, $precio_uf, $fecha_publicacion, $solicita_visita,
    $bodega, $estacionamiento, $logia, $cocina_amoblada, $antejardin, $patio_trasero, $piscina, $id_propiedad);

  if ($stmt->execute()) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>Swal.fire('Actualizado', 'Propiedad modificada con éxito.', 'success').then(() => window.location.href='dashbord.php');</script>";
  } else {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>Swal.fire('Error', 'No se pudo actualizar.', 'error').then(() => window.location.href='dashbord.php');</script>";
  }
} else {
  header("Location: dashbord.php");
  exit;
}
?>