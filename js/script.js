let form = document.getElementById('form-producto');
let inputCodigo = document.getElementById('codigo');
let inputNombre = document.getElementById('nombre');
let selectBodega = document.getElementById('bodega');
let selectSucursal = document.getElementById('sucursal');
let selectMoneda = document.getElementById('moneda');
let inputPrecio = document.getElementById('precio');
let inputDescripcion = document.getElementById('descripcion');

let cbxPlastico = document.getElementById('plastico');
let cbxMetal = document.getElementById('metal');
let cbxMadera = document.getElementById('madera');
let cbxVidrio = document.getElementById('vidrio');
let cbxTextil = document.getElementById('textil');


// ***** Funciones para la data Inicial
// Cargar Bodega
function cargarBodega() {
  fetch('./api/index.php?entidad=bodega')
  .then(response =>  response.json())
  .then(function(data) {
    selectBodega.innerHTML = '<option value=""></option>';
    
    if (!data || data.length === 0) return;
    
    data.map(item => 
      selectBodega.innerHTML += `<option value="${item.bodega_id}">${item.nombre}</option>`
    );
    
  })
  .catch(function(error) {
    console.error('Error al cargar las bodegas:', error);
  });
}
// Cargar Sucursal
function cargarSucursal(sucursal_id = '') {
  if( sucursal_id == '' ) return;

  fetch('./api/index.php?entidad=sucursal&bodega-id='+sucursal_id)
  .then(response =>  response.json())
  .then(function(data) {

    selectSucursal.innerHTML = '<option value=""></option>';
    
    if (!data || data.length === 0) return;
    
    data.map(item => 
      selectSucursal.innerHTML += `<option value="${item.sucursal_id}">${item.nombre}</option>`
    );
    
  })
  .catch(function(error) {
    console.error('Error al cargar las sucursales:', error);
  });
}
// Cargar Moneda
function cargarMoneda() {
  fetch('./api/index.php?entidad=moneda')
  .then(response =>  response.json())
  .then(function(data) {
    selectMoneda.innerHTML = '<option value=""></option>';
    
    if (!data || data.length === 0) return;
    
    data.map(item => 
      selectMoneda.innerHTML += `<option value="${item.moneda_id}">${item.nombre}</option>`
    );
    
  })
  .catch(function(error) {
    console.error('Error al cargar la moneda:', error);
  });
}

// ***** Funcion para crear el producto
form.onsubmit = (e) => {
  e.preventDefault();
  mostrarCargando();

  // validar campos
  if( !validaCampos() ){
    mostrarCargando(false);
    return;
  }
  
  const formData = new FormData(form);

  fetch('./api/index.php?entidad=producto', {
    method: 'POST',
    body: formData, 
  })
  .then(response => response.json())
  .then(data => {
    alert(data.message);
    if( data.status == 'success' ) limpiarFormulario(); 
  })
  .catch(error => {
    console.error('Error:', error);
  });

  mostrarCargando(false);
}


// ***** Restricciones al ingresar data
// Input codigo: Obligatorio, formato específico (letras, números), longitud mínima de 5 y máxima de 15 caracteres.
inputCodigo.oninput = () => {
  const valor = inputCodigo.value;
  const regex = /^[A-Za-z0-9]*$/;
  
  if(valor.length > 15) 
    inputCodigo.value = valor.slice(0,15);

  if (!regex.test(valor)) 
    inputCodigo.value = valor.replace(/[^A-Za-z0-9]/g, '');
};
// Input nombre: Validaciones: Obligatorio, longitud mínima de 2 y máxima de 50 caracteres.
inputNombre.oninput = () => {
  const valor = inputNombre.value;
  
  if(valor.length > 50) 
    inputNombre.value = valor.slice(0,50);
};
// Input precio: Validaciones: Obligatorio, formato de número positivo con hasta dos decimales.
inputPrecio.oninput = () => {
  inputPrecio.value = inputPrecio.value.replace(/[^0-9.]/g, '');
  
  // solo un punto
  const arrPrecio = inputPrecio.value.split('.');
  if (arrPrecio.length > 2) {
    inputPrecio.value = arrPrecio[0] + '.' + arrPrecio.slice(1).join('');
  }
};


// ***** Funcion para escuchar los cambios en el select de Bodega
selectBodega.onchange = () => {
  if( selectBodega.value == "" ) {
    selectSucursal.innerHTML = '';
    return;
  }
  cargarSucursal( selectBodega.value );
}

// ***** Carga inicial de los select
cargarBodega();
cargarMoneda();






