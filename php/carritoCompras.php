<?php  
include 'conexion.php';

	$categoria = $_POST["categoria"];	
	$marca     = $_POST["marca"];
	$producto  = $_POST["producto"];
	$pIndex	   = $_POST["pIndex"];
	$pSize	   = $_POST["pSize"];
	
    
    $IdCategoria = (int)$categoria;
    $IdMarca = (int)$marca;
    $NombreProducto = strlen($producto) > 0 ? "'%".strtoupper($producto)."%'": "'%%'";
    $pageIndex = ($pIndex - 1) * $pSize;
    $pageSize = $pSize;

    $query ="SELECT ROW_NUMBER() OVER (ORDER BY p.NombreProducto) RowIndex  , p.IdProducto IdProducto , c.NombreCategoria Categoria , m.NombreMarca Marca , p.NombreProducto producto , p.Stock Stock , p.Moneda Moneda ,p.Precio FROM producto p INNER JOIN (select * from categoria where IdEstado = 1)  c ON p.IdCategoria = c.IdCategoria INNER JOIN (select * from marca where IdEstado = 1) m ON p.IdMarca = m.IdMarca WHERE  p.IdEstado = 1 AND c.IdCategoria ". ($IdCategoria > 0 ? "=":'>').$IdCategoria." AND m.IdMarca  ". ($IdMarca > 0 ? "=":'>').$IdMarca." AND p.NombreProducto like ".$NombreProducto." LIMIT ".$pageIndex.",".$pageSize."";

    

    $stmt = $conexion->prepare($query);    
    $stmt->execute();
    $result = $stmt->store_result();
    $stmt->bind_result($RowIndexResponse,$IdProductoResponse, $IdCategoriaResponse, $IdMarcaResponse, $NombreProductoResponse,$StockResponse,$MonedaResponse,$PrecioResponse);
    $count = $stmt->num_rows;
   
    $Productos = array();

    while ($prod = $stmt->fetch()) {        
        $Productos[] = [ "RowIndex" => $RowIndexResponse, "IdProducto" => $IdProductoResponse, "Categoria" => $IdCategoriaResponse,  "Marca" => $IdMarcaResponse,  "Producto" => $NombreProductoResponse, "Stock" => $StockResponse, "Moneda" => $MonedaResponse, "Precio" => $PrecioResponse];        
    }        
    $resultados["data"] = $Productos;


    $query2 ="SELECT COUNT(*) cantidad FROM producto p INNER JOIN (select * from categoria where IdEstado = 1) c ON p.IdCategoria = c.IdCategoria INNER JOIN (select * from marca where IdEstado = 1) m ON p.IdMarca = m.IdMarca WHERE  p.IdEstado = 1 AND c.IdCategoria ". ($IdCategoria > 0 ? "=":'>').$IdCategoria." AND m.IdMarca  ". ($IdMarca > 0 ? "=":'>').$IdMarca." AND p.NombreProducto like ".$NombreProducto;    
    //echo json_encode($query2);
    $stmt2 = $conexion->prepare($query2);    
    $stmt2->execute();
    $result2 = $stmt2->store_result();
    $stmt2->bind_result($cantidad);    
   
    $cantidadResultados = 0;

    while ($r = $stmt2->fetch()) {        
        $cantidadResultados = $cantidad;        
    }        
    $resultados["cantidadResultados"] = $cantidadResultados;

    echo json_encode($resultados);
    return $resultados;

?>