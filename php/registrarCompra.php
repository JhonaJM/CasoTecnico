<?php  
include 'conexion.php';

try {
    // First of all, let's begin a transaction
    //$conexion->beginTransaction();
    
    $queryCorrelativo ="SELECT IdCorrelativo,Numero FROM Correlativo  WHERE NombreTabla = 'COMPRAS' ";    
    $stmtCorrelativo = $conexion->prepare($queryCorrelativo);    
    $stmtCorrelativo->execute();
    $resultCorrelativo = $stmtCorrelativo->store_result();
    $stmtCorrelativo->bind_result($Id,$n); 
    $IdCorrelativo = 0;
    $Numero = 0;
    while ($r = $stmtCorrelativo->fetch()) {        
        $IdCorrelativo = $Id;        
        $Numero = $n;        
    }  

    $Productos = json_decode($_POST["data"], true)   ;	

    $NumeroCompra = str_pad($Numero,10,"0",STR_PAD_LEFT) ;    
    $FechaCompra = date('Y-m-d');    
    $Moneda = $Productos[0]["moneda"];     
    $TotalCompra = array_sum(array_map(function($item) { 
        return  (float) (str_replace(",","",$item['precio']))  * $item['cantidad']; 
    }, $Productos)); 
           
    $FechaCreacion =  date('Y-m-d');
    $IdEstado = 1;
     
    $conexion->autocommit(FALSE);
    
    $sqlcompra  = "INSERT INTO compra (`NumeroCompra`,`FechaCompra`,`Moneda`,`TotalCompra`,`FechaCreacion`,`IdEstado`) VALUES ('".$NumeroCompra."','".$FechaCompra."','".$Moneda."',".$TotalCompra.",'".$FechaCreacion."',".$IdEstado.")";
    
    $stmtcompra = $conexion->prepare($sqlcompra);
    
    $stmtcompra->execute();
    $idCompra = $conexion->insert_id;
    
    
    $nuevocorrelativo =$Numero + 1;
    $sqlCorrelativo  = "UPDATE correlativo set Numero = ".$nuevocorrelativo." where IdCorrelativo =".$IdCorrelativo;
    $stmtCorrelativo2 = $conexion->prepare($sqlCorrelativo);
    
    $stmtCorrelativo2->execute();

    foreach($Productos as $producto)
    {        
        $IdProducto = $producto["IdProducto"];
        $cantidad = $producto["cantidad"];
        $stock = $producto["stock"];
        $precio =  (float) (str_replace(",","",$producto["precio"]));
        $NuevoStock =  $stock - $cantidad;        
        
        $sqlProducto  = " UPDATE producto set Stock =".$NuevoStock." where IdProducto=".$IdProducto ;
        $stmtProducto = $conexion->prepare($sqlProducto);        
        $stmtProducto->execute();               


        $queryproducto2 ="SELECT IdMarca,IdCategoria FROM Producto  WHERE IdProducto =".$IdProducto;    
        $stmtProducto2 = $conexion->prepare($queryproducto2);    
        $stmtProducto2->execute();
        $resultProducto2 = $stmtProducto2->store_result();
        $stmtProducto2->bind_result($Idm,$Idc); 
        $IdMarca = 0;
        $IdCategora = 0;
        while ($r = $stmtProducto2->fetch()) {        
            $IdMarca = $Idm;        
            $IdCategora = $Idc;        
        }  

        $sqlcompraDetalle  = "INSERT INTO compraDetalle (`IdCompra`,`IdProducto`,`IdMarca`,`IdCategoria`,`Cantidad`,`Precio`,`FechaCreacion`,`IdEstado`) VALUES (".$idCompra.",".$IdProducto.",".$IdMarca.",".$IdCategora.",".$cantidad.",".$precio.",'".$FechaCreacion."',1 )";
        $stmtcompraDetalle = $conexion->prepare($sqlcompraDetalle);
        //echo json_encode($sqlcompraDetalle);
       
        $stmtcompraDetalle->execute();
        
        

    }
    //exit();

    $resultados["code"] = 200;
    $resultados["mensaje"] = "Se realizó la compra correctamente!";   
    $conexion->commit();
   

} catch (\Throwable $e) {
   
    $conexion->rollback();
    $resultados["code"] = 400;
    $resultados["error"] = $e;
}

echo json_encode($resultados);
return $resultados;
        
?>