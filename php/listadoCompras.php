<?php  
include 'conexion.php';

	$fechaInicial = $_POST["fechaInicial"];	
	$fechaFinal   = $_POST["fechaFinal"];	
    $numeroCompra = $_POST["numeroCompra"];	
	$pIndex	      = $_POST["pIndex"];
	$pSize	      = $_POST["pSize"];    
    $pageIndex    = ($pIndex - 1) * $pSize;
    $pageSize     = $pSize;

    $query ="SELECT ROW_NUMBER() OVER (ORDER BY c.NumeroCompra) RowIndex ,c.IdCompra IdCompra,c.NumeroCompra NumeroCompra,c.FechaCompra FechaCompra,c.Moneda Moneda,c.TotalCompra TotalCompra,e.NombreEstado NombreEstado FROM compra c INNER JOIN Estado e ON c.IdEstado = e.IdEstado WHERE  FechaCompra >= '".$fechaInicial."' AND FechaCompra <= '".$fechaFinal." 23:59:59' AND NumeroCompra like '%".$numeroCompra."%' LIMIT ".$pageIndex.",".$pageSize."";


    $stmt = $conexion->prepare($query); 
    //echo json_encode($query);
    
    $stmt->execute();
    $result = $stmt->store_result();
    $stmt->bind_result($RowIndexResponse,$IdCompraResponse, $NumeroCompraResponse, $FechaCompraResponse, $MonedaResponse,$TotalCompraResponse,$NombreEstadoResponse);
    $count = $stmt->num_rows;
   
    $compras = array();

    while ($prod = $stmt->fetch()) {        
        $compras[] = [ "RowIndex" => $RowIndexResponse, "IdCompra" => $IdCompraResponse, "NumeroCompra" => $NumeroCompraResponse,  "FechaCompra" => $FechaCompraResponse,  "Moneda" => $MonedaResponse, "TotalCompra" => $TotalCompraResponse, "NombreEstado" => $NombreEstadoResponse];        
    }        
    $resultados["data"] = $compras;


    $query2 =" SELECT COUNT(*) cantidad FROM compra c INNER JOIN Estado e ON c.IdEstado = e.IdEstado WHERE  FechaCompra >= '".$fechaInicial."' AND FechaCompra <= '".$fechaFinal." 23:59:59' AND NumeroCompra like '%".$numeroCompra."%' ";
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