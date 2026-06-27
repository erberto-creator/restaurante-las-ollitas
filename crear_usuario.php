<?php

include("config/conexion.php");

$usuario = "rocio";


// AGREGAR UNA CONTRASEÑA SEGURA PARA EL USUARIO

$password = password_hash("lasollitas.2026", PASSWORD_DEFAULT);

$sql = "INSERT INTO usuarios(
usuario,
password
)

VALUES(
'$usuario',
'$password'
)";

if($conn->query($sql)){

    echo "Usuario creado correctamente";

}else{

    echo "Error: " . $conn->error;

}

?>