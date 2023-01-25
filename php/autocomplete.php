<?php
include 'conexion.php';


$queryMarca ="SELECT IdMarca,NombreMarca FROM `marca` WHERE IdEstado=1 ";

$stmtMarca = $conexion->prepare($queryMarca); 
//echo json_encode($query);

$stmtMarca->execute();
$resultMarca = $stmtMarca->store_result();
$stmtMarca->bind_result($id,$marca);

$marcas = array();

while ($r = $stmtMarca->fetch()) {        
    $marcas[] = [ "IdMarca" => $id, "NombreMarca" => $marca];        
}
    
//echo json_encode($marcas);
$resultados["marcas"] = $marcas;


$queryCategoria ="SELECT IdCategoria,NombreCategoria FROM `categoria` WHERE IdEstado = 1 ";

$stmtCategoria = $conexion->prepare($queryCategoria); 
//echo json_encode($query);

$stmtCategoria->execute();
$resultCategoria = $stmtCategoria->store_result();
$stmtCategoria->bind_result($idc,$categoria);

$categorias = array();


while ($r = $stmtCategoria->fetch()) {        
    $categorias[] = [ "IdCategoria" => $idc, "NombreCategoria" => $categoria];        
}
//echo json_encode($categorias);        
$resultados["categorias"] = $categorias;

?>