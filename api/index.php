<?php
require_once 'conexion.php'; 
require_once './funciones_db.php';
require_once './utils.php';


header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');


$entidad = $_GET['entidad'] ?? '';

// Si es POST y es entidad producto
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $entidad === 'producto') {
  // Obtener los datos
  $codigo = $_POST['codigo'] ?? '';
  $nombre = $_POST['nombre'] ?? '';
  $bodega_id = $_POST['bodega'] ?? '';
  $sucursal_id = $_POST['sucursal'] ?? '';
  $moneda_id = $_POST['moneda'] ?? '';
  $precio = $_POST['precio'] ?? '';
  $descripcion = $_POST['descripcion'] ?? '';
  $plastico = isset($_POST['plastico']) ? 1 : 0;
  $metal = isset($_POST['metal']) ? 1 : 0;
  $madera = isset($_POST['madera']) ? 1 : 0;
  $vidrio = isset($_POST['vidrio']) ? 1 : 0;
  $textil = isset($_POST['textil']) ? 1 : 0;

  $validacion = validarCampos($codigo, $nombre, $precio, $descripcion, $bodega_id, $sucursal_id, $moneda_id, $plastico, $metal, $madera, $vidrio, $textil);
  if ($validacion['status'] == 'error') {
    echo json_encode($validacion);
    return; 
  }

  insertarProducto($codigo, $nombre, $precio, $descripcion, $bodega_id, $sucursal_id, $moneda_id, $plastico, $metal, $madera, $vidrio, $textil);

} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {

  // Obtener datos de acuerdo a la entidad
  switch ($entidad) {
      case 'producto':
        echo obtener($entidad);
        break;

      case 'sucursal':
        $bodega_id = $_GET['bodega-id'] ?? '';
        if(empty($bodega_id)) {
          echo json_encode([]);
          return;
        }
        echo obtener($entidad, " where bodega_id='$bodega_id'");
        break;

      case 'moneda':
        echo obtener($entidad);
        break;

      case 'bodega':
        echo obtener($entidad);
        break;

      default:
          echo json_encode(['error' => 'Método no encontrado']);
          break;
  }
} else {
  echo json_encode(['error' => 'Método no permitido']);
}
