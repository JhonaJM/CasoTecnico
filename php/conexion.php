<?php 
 
$servidor = "localhost";
$usuario = "root";
$contrasenha = ""; 
$BD = "carritocompras";  

$conexion = new mysqli($servidor, $usuario, $contrasenha,$BD ); 

// if (mysqli_connect_errno()) {
//     printf("conexion fallida: %s\n", mysqli_connect_error());
//     exit();
// }else{
//  print('Ok');
// }

?>