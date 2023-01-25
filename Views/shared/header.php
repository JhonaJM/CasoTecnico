

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Carrito de compras</title>
    <link rel="stylesheet" href="index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</head>
<style>
 .custom-toggler.navbar-toggler {
    border-color: white;
}
.custom-toggler .navbar-toggler-icon {
            background-image: url(
            "data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(255, 255, 255, 0.8)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 8h24M4 16h24M4 24h24'/%3E%3C/svg%3E");
        }

</style>
<body>

<div class="container-fluid text-white">
        <div class=" justify-content-center align-items-center mt-3 bg-dark row">
            <nav class="mb-2 pt-3 pb-3 navbar navbar-expand-sm navbar-light">
                <div class="container">
                  <a class="navbar-brand text-white" href="#">STORE</a>   
                  <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon text-white"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">                                                      
                      <ul class="navbar-nav">
                        <li class="nav-item">
                        <a href="index.php" <?php if($_SERVER['SCRIPT_NAME']=="/casotecnico/index.php") { ?>  class="text-white nav-link  activo"   <?php }else {?> class="text-white nav-link" <?php } ?>>Comprar</a>
                        </li>
                        <li class="nav-item">
                        <a href="registroCompras.php" <?php if($_SERVER['SCRIPT_NAME']!="/casotecnico/index.php") { ?>  class="text-white nav-link  activo"   <?php }else {?> class="text-white nav-link" <?php } ?>>Historial</a>                        
                        </li>                      
                      </ul>
                                                                           
                    <nav style="float:right" class="navbar navbar-expand-lg col-sm-10 justify-content-end  align-items-center d-flex flex-row navbar-nav">
                        <i style="cursor:pointer;" onclick="MostrarCarrito()" class=" fa-solid fa-cart-shopping btnIconsRounded text-decoration-none " data-bs-toggle="modal" data-bs-target="#CarritoModal">
                            <span id="" class="badge badge-secondary CantidadProductosCarrito"></span>
                        </i>
                        <div class="me-3 Verticalseparator me-3 ms-3"></div>
                        JM
                    </nav>
                </div>
            </nav>            
        </div>
</div>


<div class="modal fade" id="CarritoModal" tabindex="-1" aria-labelledby="CarritoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="CarritoModalLabel" class="CantidadProductosCarrito">Carrito de compras</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="MostrarCarrito">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="RegistrarCompra()">Comprar</button>
      </div>
    </div>
  </div>
</div>

<script>
   $(function() { 

    contarCarritoProductos();
      
});

const contarCarritoProductos = () =>{

  
  let data = [];
      let ProductsLocalStorage = localStorage.getItem("oProducts");
      if(ProductsLocalStorage)       
      {
          let storageProducts = $.parseJSON(ProductsLocalStorage);

          storageProducts.forEach(x => {                
              data.push(x)
          });
      }


      $(".CantidadProductosCarrito").html(data.length > 0 ? data.length : '');
}

const MostrarCarrito = () =>{
  
  
    $("#MostrarCarrito").html();
    let data = [];
        let ProductsLocalStorage = localStorage.getItem("oProducts");
        let content = '';
        if(ProductsLocalStorage)       
        {
            let storageProducts = $.parseJSON(ProductsLocalStorage);

            storageProducts.forEach(x => {  
                            
                content += `<div class="container align-items-center mb-1">
                            <div class="row" >
                                <div class="col-12">
                                    <div class="card">        
                                      <div class="card-body">
                                          <div class="row">
                                            <div class="col-sm-12 col-md-6 text-truncate">  (${x.cantidad})UND. ${x.producto} - ${x.marca} </div>            
                                            <div class="col-sm-12 col-md-6 align-items-center">
                                                <div class="row">
                                                  <div class="col-sm-12">
                                                    <div class="row">
                                                      <h4  class=" col-sm-10 col-md-9 me-4 me-4"><strong>${x.moneda} ${numerosFormatos(x.total)}</strong></h4>
                                                      <i style="color:red;" onclick="DeleteCarritoProducto(${x.IdProducto},${x.index})" class="  col-sm-1 fa-solid fa-trash fa-lg pt-3 "></i>
                                                    </div>
                                                  </div>                                                
                                                </div>              
                                            </div> 
                                          </div>           
                                      </div>
                                    </div>
                                </div>
                            </div>                            
                        </div>`
            });
        }

        $("#MostrarCarrito").html(content);
}

const DeleteCarritoProducto = (IdProducto,Index) =>{
        debugger;
        let data = [];
        let ProductsLocalStorage = localStorage.getItem("oProducts");
        if(ProductsLocalStorage)       
        {
            let storageProducts = $.parseJSON(ProductsLocalStorage);
            //let NewResult = storageProducts.filter(x=> {x.IdProducto != IdProducto && x.index != Index});
            let NewResult = storageProducts.filter(x=> x.IdProducto != IdProducto || x.index != Index);           
            let productoEliminado = storageProducts.filter(x=> x.IdProducto == IdProducto && x.index == Index);           

            let cantidadEliminada = parseInt(productoEliminado[0].cantidad);  
            
            let productosGrid = [];
            $("td", "#Producto_"+productoEliminado[0].IdProducto).each(function( j ) {
                productosGrid.push($(this).text());            
            });          
            let stock =  parseInt(productosGrid[4]);
            
            $("td", "#Producto_"+productoEliminado[0].IdProducto).eq(4).html(stock + cantidadEliminada);

            localStorage.setItem("oProducts",  JSON.stringify(NewResult));
            
        }
        MostrarCarrito();
        contarCarritoProductos();
}


const RegistrarCompra = () =>{
  
  let data = [];
  let ProductsLocalStorage = localStorage.getItem("oProducts");
  if(ProductsLocalStorage)       
  {
      let storageProducts = $.parseJSON(ProductsLocalStorage);      
      $.ajax({
            url: "php/registrarCompra.php",
            type: 'POST',
            data: { data : JSON.stringify(storageProducts)},
            beforeSend: function() {           
            },
            complete: function() {            
            },
            success: function(r) {
              
                var result = JSON.parse(r);
                //console.log(result);   
                
                if(result.code == 200)
                {

                  $('#CarritoModal').modal('hide');
                  localStorage.removeItem('oProducts');
                  contarCarritoProductos();
                  filtrarProductos(1);

                  alert("Se realizó la compra correctamente");

                }else
                  alert("Error al registrar la compra.");
                

            },        
        });

      
  }  
}

function numerosFormatos(x) {
  
  x = parseFloat(x).toFixed(2);
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

</script>



    
