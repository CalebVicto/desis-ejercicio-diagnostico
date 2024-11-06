<?php

// Funcion para insertar producto
function insertarProducto($codigo, $nombre, $precio, $descripcion, $bodega_id, $sucursal_id, $moneda_id, $plastico, $metal, $madera, $vidrio, $textil) {
  try {
      $conn = conectarBD();

      // Validar si no existe un producto con ese codigo
      $checkQuery = "SELECT COUNT(*) FROM producto WHERE codigo = $1";
      $resultCheck = pg_query_params($conn, $checkQuery, array($codigo));     
      $count = pg_fetch_result($resultCheck, 0, 0);
      if ($count > 0) {
          echo json_encode(['status' => 'error', 'message' => 'El código de producto ya existe.']);
          pg_close($conn);
          exit;
      }

      // Insertar data
      $query = "SELECT insertar_producto($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12)";
      $result = pg_query_params($conn, $query, array(
          $codigo, $nombre, $precio, $descripcion, 
          $bodega_id, $sucursal_id, $moneda_id, 
          $plastico, $metal, $madera, $vidrio, $textil
      ));

      // Validar Insercion
      if (!$result) {
          throw new Exception("Error en la inserción del producto: " . pg_last_error($conn));
      }


      echo json_encode(['status' => 'success', 'message' => 'Producto insertado correctamente.']);

  } catch (Exception $e) {
      echo json_encode(['status' => 'error', 'message' => 'Hubo un error al insertar el producto. Intente nuevamente.']);
  } finally {
      if ($conn) {
          pg_close($conn);
      }
  }
}


// ***** Obtiene los registros de acuerdo a la tabla y si es solicitado agrega un filtro (where)
function obtener($table, $where = '') {
  try {
      $conn = conectarBD();

      // Realizar la consulta
      $query = "SELECT * FROM $table $where";
      $result = pg_query($conn, $query);
      
      // Verificar la consulta
      if ($result) {
          $data = pg_fetch_all($result);
          pg_close($conn);
          return json_encode($data); 
      } else {
          throw new Exception("Error al obtener los datos: " . pg_last_error($conn));
      }
      
  } catch (Exception $e) {
      pg_close($conn); 
      return json_encode(['error' => 'Hubo un error al obtener los datos. Intente nuevamente.']);
  }
}
