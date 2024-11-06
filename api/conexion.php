<?php

// ***** Funcion para obtener la conexion con la BD
function conectarBD() {

    $host = 'localhost';
    $dbname = 'test_desis2';
    $user = 'testuser';
    $password = 'testuser';

    $conn = pg_connect("host=$host dbname=$dbname user=$user password=$password");
    if (!$conn) {
        die("Error en la conexión: " . pg_last_error());
    }
    return $conn;
}

