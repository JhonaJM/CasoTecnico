
<?php
include 'Views/shared/header.php';
include 'php/autocomplete.php';
?>
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-12">
            <div class="card">        
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-3 mb-1">
                            <label for="cboCategoria">Categoría</label>
                            <select class="form-control mt-1" name="cboCategoria" Id="cboCategoria">
                            <option value="0">TODOS</option>
                                <?php
                                    foreach($categorias as $categoria)
                                    {                                   
                                ?>
                                        <option value="<?php echo $categoria["IdCategoria"]?>"><?php echo $categoria["NombreCategoria"] ?></option>
                                <?php
                                    }
                                ?>                                                                                    
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-3 mb-1">
                        <label for="cboMarca">Marca</label>
                        <select class="form-control" name="cboMarca" Id="cboMarca">
                            <option value="0">TODOS</option>
                            <?php
                                foreach($marcas as $marca)
                                {                                   
                            ?>
                                    <option value="<?php echo $marca["IdMarca"]?>"><?php echo $marca["NombreMarca"] ?></option>
                            <?php
                                }
                            ?>                                                                                    
                        </select>
                            
                        </div>
                        <div class="col-sm-12 col-md-3 mb-1">
                            <label for="txtProducto">Producto</label>
                            <input type="text" class="form-control" placeholder="" id="txtProducto">
                        </div>        
                        <div class="col-sm-12 col-md-3 d-grid gap-2 d-md-block mb-1 pt-md-4" >
                            <button type="button" class="btn btn-dark btn-md btn-block" title="Filtrar" onclick="filtrarProductos(1)">
                                <i class="fa fa-filter">
                                </i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>                   
    </div>
   
    <div class="table-responsive">
        <table id="TableProducts" class="table">
            <thead>
                <tr>
                <th scope="col"></th>
                <th scope="col">#</th>
                <th scope="col">Categoría</th>
                <th scope="col">Marca</th>
                <th scope="col">Producto</th>
                <th scope="col">Stock</th>
                <th scope="col">Moneda</th>
                <th scope="col">Precio</th>                
                </tr>
            </thead>
            <tbody>
                                            
            </tbody>
        </table>

        <nav aria-label="Page navigation example mb-5">
            <ul class="pagination">
               
            </ul>
        </nav>
    </div>   
</div>


<div class="modal fade" id="ProductModal" tabindex="-1" aria-labelledby="ProductModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ProductModalLabel">Pro 1</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body">
            <div class="row g-3 align-items-center">
                <div class="col-auto">
                    <label for="CantidadProducto" class="col-form-label">Cantidad</label>
                </div>
                <div class="col-auto">
                    <input type="number" min="1" id="CantidadProducto" class="form-control">
                </div>            
            </div>
       </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="AgregarCarrito()">Agregar al carrito</button>
      </div>
    </div>
  </div>
</div>
<?php
include 'views/shared/footer.php';
?>

<script>


    var oproducto = {};
    var pageSize = 5;
    var currentPage=1;
   
    $(function() { 

        //$('#cboMarca').select2();
        filtrarProductos(1);
        
    });

    const SeleccionarCarrito = (Id) =>{   
        
        let IdProducto = Id;        
        let productosGrid = [];
        $("td", "#Producto_"+Id).each(function( j ) {
            productosGrid.push($(this).text());            
        });

           
        
        let categoria= productosGrid[1];
        let marca= productosGrid[2];
        let producto= productosGrid[3];
        let stock=  productosGrid[4];
        let moneda= productosGrid[5];
        let precio= productosGrid[6];

        oproducto = {"IdProducto":IdProducto,"categoria":categoria,"marca" : marca,"producto" : producto,"stock" : stock,"precio" : precio,"moneda" : moneda}; 
        
        $("#CantidadProducto").attr({
            "max" : stock,
        });
        $("#CantidadProducto").val('');
        $("#ProductModalLabel").html(producto);

    }

    var index = 1;
    const AgregarCarrito = () =>{
        
        let cantidad = $("#CantidadProducto").val();
        if(!cantidad)
        {
            alert("ingrese la cantidad del producto");
            return;
        }
        cantidad = parseInt(cantidad);

        if(cantidad <= 0)
        {
            alert("La cantidad no puede ser inferior a 1");
            return;
        }

        if(cantidad > oproducto.stock)
        {
            alert("La cantidad supera el stock");
            return;
        }
        
        let ProductsLocalStorage = localStorage.getItem("oProducts");
        
        
        var data = [];
        oproducto.index = index ;
        oproducto.cantidad = cantidad ;
        oproducto.total = parseFloat(oproducto.precio.replaceAll(",","")) * oproducto.cantidad;
        data.push(oproducto);

        if(ProductsLocalStorage)       
        {        
            data = [...data,...$.parseJSON(ProductsLocalStorage)]
        }
        index = data.length + 1 ;
        
        $("td", "#Producto_"+oproducto.IdProducto).eq(4).html(oproducto.stock - oproducto.cantidad);

        localStorage.setItem("oProducts",  JSON.stringify(data));
        $('#ProductModal').modal('hide');
        contarCarritoProductos();

    }

    const filtrarProductos = (pagina) => {
        
        var datos = {
            "categoria": $("#cboCategoria").val(),
            "marca": $("#cboMarca").val(),
            "producto": $("#txtProducto").val()?? '',
            "pIndex": pagina,
            "pSize": pageSize,
        }    
        
        $.ajax({
            url: "php/carritoCompras.php",
            type: 'POST',
            data: datos,
            beforeSend: function() {           
            },
            complete: function() {            
            },
            success: function(r) {
              
                var result = JSON.parse(r);
                
                $('#TableProducts tbody').html('');
                let ArrayIds = [];
                $.each(result.data, function(index, item) {
                    ArrayIds.push(item.IdProducto);
                    $('#TableProducts tbody').append(

                        `<tr id="Producto_${item.IdProducto}" >
                            <td>
                                <button
                                    type="button"
                                    onclick="SeleccionarCarrito(${item.IdProducto})"
                                    style="color:green;border:none;"
                                    data-bs-toggle="modal"
                                    data-bs-target="#ProductModal"
                                >
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </td>
                            <th scope="row">${item.RowIndex}</th>
                            <td>${item.Categoria}</td>
                            <td>${item.Marca}</td>
                            <td>${item.Producto}</td>
                            <td style="text-align: right;padding-right: 5%;">${item.Stock}</td>
                            <td>${item.Moneda}</td>
                            <td style="text-align: right;padding-right: 5%;">${numerosFormatos(item.Precio)}</td>
                        </tr>   `                    
                    );

                });

                
                 let cantidadResultados = result.cantidadResultados;
                 $(".pagination").html('');
                 //$(".pagination").append(`<li class="page-item previous"><a class="page-link"  onclick="filtrarProductos(${currentPage - 1 > 0 ? (currentPage - 1) : 1  })" href="#">Previous</a></li>`)
                
                 let paginas = Math.ceil(cantidadResultados / pageSize) ;

                 if(cantidadResultados > 0)
                 {
                    

                    for (var i = 1; i <= paginas; i++) {
                      $(".pagination").append(`<li class="page-item ${pagina == i ? 'active': ''} "><a class="page-link" onclick="filtrarProductos(${i})" href="#">${i}</a></li>`)
                    }

                 }

                 //$(".pagination").append(`<li class="page-item next"><a class="page-link" onclick="filtrarProductos(${currentPage + 1 })" href="#">Next</a></li>`)

                 if(pagina == 1)
                 {
                    $(".previous").addClass("disabled");
                    
                 }

               
                 if(pagina == paginas)
                 {
                    $(".next").addClass("disabled");
                    
                 }

                                   
                //actualizar el stock
                
                let ProductsLocalStorage = localStorage.getItem("oProducts");
                if(ProductsLocalStorage)       
                {                    
                    // storageProducts.foreach(x=>
                    // {
                    //     
                    //     if($("#Producto_"+x.IdProducto))
                    //     {
                    //         let productosGrid = [];
                    //         $("td", "#Producto_"+x.IdProducto).each(function( j ) {
                    //             productosGrid.push($(this).text());            
                    //         });          
                    //         let stock =  parseInt(productosGrid[4]);

                    //         $("td", "#Producto_"+x.IdProducto).eq(4).html(stock - cantidadEliminada);
                    //     }
                        

                    // });

                  
                    let storageProducts = $.parseJSON(ProductsLocalStorage);                    
                    const groupByProduct = storageProducts.reduce((group, product) => {
                        
                        const { IdProducto } = product;
                        group[IdProducto] = group[IdProducto] ?? [];
                        group[IdProducto].push(product);
                        return group;
                    }, {});

                    if(ArrayIds.length > 0){
                       
                        ArrayIds.forEach(id => {
                           
                           productosAgrupadosgrupados = groupByProduct[id];
                           if(productosAgrupadosgrupados)
                           {
                                let cantidades = 0;
                                productosAgrupadosgrupados.map(x=> cantidades+= x.cantidad );
                                
                                
                                if($("#Producto_"+id))
                                { 
                                    let productosGrid = [];
                                    $("td", "#Producto_"+id).each(function( j ) {
                                        productosGrid.push($(this).text());            
                                    });          
                                    let stock =  parseInt(productosGrid[4]);

                                    $("td", "#Producto_"+id).eq(4).html(stock - cantidades);
                                }

                           }
                        });
                    }

                    
                }
                
                                                        
            },        
        });
    }

</script>