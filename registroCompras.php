
<?php
include 'views/shared/header.php';
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <div class="card">        
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-3 mb-1">
                            <label for="datefechaInicial">Fecha Inicial</label>
                            <input type="date" class="form-control mt-1" placeholder="Fecha" id="datefechaInicial">
                        </div>
                        <div class="col-sm-12 col-md-3 mb-1">
                            <label for="datefechaFinal">Fecha Final</label>
                            <input type="date" class="form-control mt-1" placeholder="Fecha" id="datefechaFinal">
                        </div>
                        <div class="col-sm-12 col-md-3 mb-1">
                            <label for="datefechaFinal">N° Compra</label>
                            <input type="text" class="form-control mt-1" placeholder="" id="txtNumeroCompra">
                        </div>                              
                        <div class="col-sm-12 col-md-3 d-grid gap-2 d-md-block mb-1 pt-md-4">
                            <button type="button" class="btn btn-dark btn-md btn-block" title="Filtrar" onclick="filtrarCompras(1)">
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
        <table id="TableCompras" class="table">
            <thead>
           
                <tr>
                <th scope="col">#</th>
                <th scope="col">N° Compra</th>
                <th scope="col">Fecha</th>
                <th scope="col">Moneda</th>                
                <th scope="col">TotalCompra</th>
                <th scope="col">Estado</th>                
                </tr>
            </thead>
            <tbody>                
            </tbody>
        </table>
       

        <nav aria-label="Page navigation example">
            <ul class="pagination paginationCompras">
               
            </ul>
        </nav>        
    </div>   
</div>

<?php
include 'views/shared/footer.php';
?>

<script>
    var pageSize = 5;
    var currentPage=1;

    $(function() {     
        var fecIni = moment().add(-7, 'days');
        var fecFinal = moment().add(1, 'days');        
        $('#datefechaInicial').val(fecIni.format('YYYY-MM-DD'));       
        $('#datefechaFinal').val(fecFinal.format('YYYY-MM-DD'));

        
        filtrarCompras(1);
        
    });


    const filtrarCompras = (pagina) => {
        
        var datos = {
            "fechaInicial": $("#datefechaInicial").val() ?? '',
            "fechaFinal": $("#datefechaFinal").val()?? '',     
            "numeroCompra": $("#txtNumeroCompra").val() ?? '',       
            "pIndex": pagina,
            "pSize": pageSize,
        } 
           
        
        $.ajax({
            url: "php/listadoCompras.php",
            type: 'POST',
            data: datos,
            beforeSend: function() {           
            },
            complete: function() {            
            },
            success: function(r) {
              
                var result = JSON.parse(r);                
                $('#TableCompras tbody').html('');
                $.each(result.data, function(index, item) {
                    
                    $('#TableCompras tbody').append(
                       
                        `<tr >                            
                            <th scope="row">${item.RowIndex}</th>
                            <td>${item.NumeroCompra}</td>
                            <td>${moment(item.FechaCompra).format('DD/MM/yyyy')}</td>
                            <td>${item.Moneda}</td>
                            <td style="text-align: right;padding-right: 15%;">${numerosFormatos(item.TotalCompra)}</td>
                            <td>${item.NombreEstado}</td>                            
                        </tr>`                    
                    );

                });

                
                 let cantidadResultados = result.cantidadResultados;
                 $(".paginationCompras").html('');
                 //$(".paginationCompras").append(`<li class="page-item previous"><a class="page-link"  onclick="filtrarCompras(${currentPage - 1 > 0 ? (currentPage - 1) : 1  })" href="#">Previous</a></li>`)
                
                 let paginas = Math.ceil(cantidadResultados / pageSize) ;

                 if(cantidadResultados > 0)
                 {
                    

                    for (var i = 1; i <= paginas; i++) {
                      $(".paginationCompras").append(`<li class="page-item ${pagina == i ? 'active': ''} "><a class="page-link" onclick="filtrarCompras(${i})" href="#">${i}</a></li>`)
                    }

                 }

                 //$(".paginationCompras").append(`<li class="page-item next"><a class="page-link" onclick="filtrarCompras(${currentPage + 1 })" href="#">Next</a></li>`)

                 if(pagina == 1)
                 {
                    $(".previous").addClass("disabled");
                    
                 }

               
                 if(pagina == paginas)
                 {
                    $(".next").addClass("disabled");
                    
                 }

                                   
                //
                                                        
            },        
        });
    }

</script>