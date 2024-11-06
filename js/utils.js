
// ***** Funcion para validar los campos
function validaCampos() {
	// *** codigo
	// Este campo no debe quedar en blanco
	if (inputCodigo.value == '') {
		alert('El código del producto no puede estar en blanco.');
		return false;
	}
	// Debe contener al menos una letra y un número, y no debe contener otros caracteres diferentes
	const regexCodigo = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]+$/;
	if (!regexCodigo.test(inputCodigo.value)) {
		alert('El código del producto debe contener letras y números');
		return false;
	}
	// Longitud: Debe tener entre 5 y 15 caracteres.
	const regexCodigo2 = /^.{5,15}$/;
	if (!regexCodigo2.test(inputCodigo.value)) {
		alert('El código del producto debe tener entre 5 y 15 caracteres.');
		return false;
	}
	// Unicidad: El código del producto debe ser único, es decir, no debe repetirse al registrar un nuevo producto -> Se valida en el backend

	// *** Nombre del Producto
	// Obligatorio: Este campo no debe quedar en blanco.
	if (inputNombre.value == '') {
		alert('El nombre del producto no puede estar en blanco.');
		return false;
	}
	// Longitud: Debe tener entre 2 y 50 caracteres.
	const regexNombre2 = /^.{2,50}$/;
	if (!regexNombre2.test(inputNombre.value)) {
		alert('El nombre del producto debe tener entre 2 y 50 caracteres.');
		return false;
	}

	// *** Precio del Producto
	// Obligatorio: Este campo no debe quedar en blanco.
	if (inputPrecio.value == '') {
		alert('El precio del producto no puede estar en blanco.');
		return false;
	}
	// El precio debe ser un número positivo, con hasta dos decimales (por ejemplo, 19.99)
	const regexPrecio = /^\d+(\.\d{1,2})?$/;
	if (!regexPrecio.test(inputPrecio.value)) {
		alert('El precio del producto debe ser un número positivo con hasta dos decimales');
		return false;
	}
	if (inputPrecio.value.split('.').length > 2) {
		alert('El precio del producto debe ser un número positivo con hasta dos decimales');
		return false;
	}

	// *** Material del producto
	let cbxSelected = 0;
	if (cbxPlastico.checked) cbxSelected++;
	if (cbxMetal.checked) cbxSelected++;
	if (cbxMadera.checked) cbxSelected++;
	if (cbxVidrio.checked) cbxSelected++;
	if (cbxTextil.checked) cbxSelected++;
	if (cbxSelected < 2) {
		alert('Debe seleccionar al menos dos materiales para el producto.');
		return false;
	}

	// *** Bodega
	// Obligatorio: Este campo no debe quedar en blanco.
	if (selectBodega.value == '') {
		alert('Debe seleccionar una bodega.');
		return false;
	}

	// *** Sucursal
	// Obligatorio: Este campo no debe quedar en blanco.
	if (selectSucursal.value == '') {
		alert('Debe seleccionar una sucursal para la bodega seleccionada');
		return false;
	}

	// *** Moneda
	// Obligatorio: Este campo no debe quedar en blanco.
	if (selectMoneda.value == '') {
		alert('Debe seleccionar una moneda para el producto.');
		return false;
	}

	// *** Descripcion
	// Obligatorio: Este campo no debe quedar en blanco.
	if (inputDescripcion.value == '') {
		alert('La descripción del producto no puede estar en blanco.');
		return false;
	}
	// Longitud: La descripción debe tener al menos 10 caracteres y no más de 1000,
	if (inputDescripcion.value.length < 10 || inputDescripcion.value.length > 1000) {
		alert('La descripción del producto debe tener entre 10 y 1000 caracteres.');
		return false;
	}
	
	// *** Solo returna 'true' si es que pasa las validaciones
	return true;
}

// ***** Funcion que maneja la pantalla de Cargando
function mostrarCargando(mostrar = true){
	mostrar 
		? document.getElementById('loading').style.display = 'flex'
		: document.getElementById('loading').style.display = 'none';
}

// ***** Funcion que limpia el formulario
function limpiarFormulario() {
	inputCodigo.value = '';
	inputNombre.value = '';
	selectBodega.value = '';
	selectSucursal.value = '';
	selectSucursal.innerHTML = '';
	selectMoneda.value = '';
	inputPrecio.value = '';
	inputDescripcion.value = '';
	cbxPlastico.checked = false;
	cbxMetal.checked = false;
	cbxMadera.checked = false;
	cbxVidrio.checked = false;
	cbxTextil.checked = false;
}