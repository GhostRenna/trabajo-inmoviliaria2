<?php
require '../login/db.php';

$criterio = '%' . ($_POST['criterio'] ?? '') . '%';

$sql = "SELECT * FROM propiedades WHERE tipo_propiedad LIKE ? OR descripcion LIKE ? OR precio_clp LIKE ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sss', $criterio, $criterio, $criterio);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
  echo '<table border="1">';
  echo '<tr><th>Tipo</th><th>Descripción</th><th>Precio</th></tr>';
  while ($row = $resultado->fetch_assoc()) {
    echo '<tr>';
    echo '<td>' . htmlspecialchars($row['tipo_propiedad']) . '</td>';
    echo '<td>' . htmlspecialchars($row['descripcion']) . '</td>';
    echo '<td>$' . number_format($row['precio_clp'], 0, ',', '.') . '</td>';
    echo '</tr>';
  }
  echo '</table>';
} else {
  echo 'No se encontraron propiedades.';
}
?>
