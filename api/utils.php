<?php
// ***** Funcion para validar los campos
function validarCampos($codigo, $nombre, $precio, $descripcion, $bodega_id, $sucursal_id, $moneda_id, $plastico, $metal, $madera, $vidrio, $textil)
{
  // *** codigo
  // Este campo no debe quedar en blanco
  if (empty($codigo)) {
    return ['status' => 'error', 'message' => 'El código del producto no puede estar vacío.'];
  }
  // Debe contener al menos una letra y un número, y no debe contener otros caracteres diferentes
  $regexCodigo = '/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]+$/';
  if (!preg_match($regexCodigo, $codigo)) {
    return ['status' => 'error', 'message' => 'El código del producto debe contener letras y números'];
  }
	// Longitud: Debe tener entre 5 y 15 caracteres.
  $regexCodigo2 = '/^.{5,15}$/';
  if (!preg_match($regexCodigo2, $codigo)) {
    return ['status' => 'error', 'message' => 'El código del producto debe tener entre 5 y 15 caracteres.'];
  }

	// *** Nombre del Producto
	// Obligatorio: Este campo no debe quedar en blanco.
  if (empty($nombre)) {
    return ['status' => 'error', 'message' => 'El nombre del producto no puede estar vacío.'];
  }
	// Longitud: Debe tener entre 2 y 50 caracteres.
  if (strlen($nombre) < 2 || strlen($nombre) > 50) {
    return ['status' => 'error', 'message' => 'El nombre del producto debe tener entre 2 y 50 caracteres.'];
  }

	// *** Precio del Producto
	// Obligatorio: Este campo no debe quedar en blanco.
  if (empty($precio)) {
    return ['status' => 'error', 'message' => 'El precio del producto no puede estar en blanco.'];
  }
	// El precio debe ser un número positivo, con hasta dos decimales (por ejemplo, 19.99)
  if (!preg_match('/^\d+(\.\d{1,2})?$/', $precio)) {
    return ['status' => 'error', 'message' => 'El precio debe ser un número positivo con hasta dos decimales.'];
  }
  if (substr_count($precio, '.') > 1) {
    return ['status' => 'error', 'message' => 'El precio del producto debe ser un número positivo con hasta dos decimales.'];
  }



	// *** Material del producto
  $cbxSelected = 0;
	if ($plastico) $cbxSelected++;
	if ($metal) $cbxSelected++;
	if ($madera) $cbxSelected++;
	if ($vidrio) $cbxSelected++;
	if ($textil) $cbxSelected++;
	if ($cbxSelected < 2) {
    return ['status' => 'error', 'message' => 'Debe seleccionar al menos dos materiales para el producto.'];

	}

	// *** Bodega
	// Obligatorio: Este campo no debe quedar en blanco.
  if (empty($bodega_id)) {
    return ['status' => 'error', 'message' => 'Debe seleccionar una bodega.'];
  }

	// *** Sucursal
	// Obligatorio: Este campo no debe quedar en blanco.
  if (empty($sucursal_id)) {
    return ['status' => 'error', 'message' => 'Debe seleccionar una sucursal.'];
  }

	// *** Moneda
	// Obligatorio: Este campo no debe quedar en blanco.
  if (empty($moneda_id)) {
    return ['status' => 'error', 'message' => 'Debe seleccionar una moneda.'];
  }


  // *** Descripcion
	// Obligatorio: Este campo no debe quedar en blanco.
  if (empty($descripcion)) {
    return ['status' => 'error', 'message' => 'La descripción del producto no puede estar en blanco.'];
  }
	// Longitud: La descripción debe tener al menos 10 caracteres y no más de 1000,
  if (strlen($descripcion) < 10 || strlen($descripcion) > 1000) {
    return ['status' => 'error', 'message' => 'La descripción debe tener entre 10 y 1000 caracteres.'];
  }
  

  // Si todo es válido
  return ['status' => 'success', 'message' => 'Validaciones exitosas.'];
}
