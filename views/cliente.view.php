<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>

    <!-- Estilos Bootstrap 5.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    
</head>
<body>

    <!-- Aquí el contenido -->
    <div class="container mt-3">
        <h4>Administrador de clientes</h4>
        <h6>Sistema adinistrativo Ver. 1</h6>

        <button type="button" id="mostrar-clientes" class="btn btn-success btn-sm">Mostrar todos los clientes</button>
        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modal-buscador">Buscar cliente</button>

        <hr>

        <table class="table table-striped" id="tabla-clientes">
            <colgroup>
                <col width="5%">
                <col width="30%">
                <col width="25%">
                <col width="20%">
                <col width="20%">
            </colgroup>
            <thead class="table-success">
                <tr>
                    <th>#</th>
                    <th>Apellidos</th>
                    <th>Nombres</th>
                    <th>Teléfono</th>
                    <th>Operaciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="5" class="text-center">No hay datos para mostrar</td>
                </tr>
            </tbody>
        </table>

        <small style="display:none" id="load-clientes">Cargando datos, por favor espere...</small>

    </div> <!-- container -->

    <!-- Zona de MODALES -->
    <div class="modal fade" tabindex="-1" id="modal-buscador" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Buscador de clientes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="formulario-busqueda">
                        <label for="idbuscado" class="form-label">Escriba ID:</label>
                        <div class="input-group mb-3">
                            <input type="search" class="form-control" id="idbuscado">
                            <button type="button" class="btn btn-primary" id="boton-buscar">Buscar</button>
                        </div>
                        <div class="mb-3">
                            <label for="apellidos" class="form-label">Apellidos:</label>
                            <input type="text" class="form-control" id="apellidos" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="nombres" class="form-label">Nombres:</label>
                            <input type="text" class="form-control" id="nombres" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono:</label>
                            <input type="text" class="form-control" id="telefono" readonly>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin zona de modales -->
    
    <!-- js Bootstrap 5.2 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    
    <!-- AJAX = Javascript Asincrónico -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <!-- JS -->
    <script>
        $(document).ready(function (){

            //AJAX
            function obtenerDatos(){
                $("#load-clientes").css("display", "inline-block");

                $.ajax({
                    url: '../controllers/cliente.controller.php',
                    type: 'GET',
                    data: {'operacion' : 'listar'},
                    success: function (result) {
                        $("#tabla-clientes tbody").html(result);
                        $("#load-clientes").css("display", "none");
                    }
                });
            }

            //AJAX
            function buscarCliente(){
                $.ajax({
                    url: '../controllers/cliente.controller.php',
                    type: 'GET',
                    dataType: 'JSON',
                    data: {
                        'operacion' : 'buscar',
                        'id'        : $("#idbuscado").val()
                    },
                    success: function (result){
                        $("#apellidos").val(result.apellidos);
                        $("#nombres").val(result.nombres);
                        $("#telefono").val(result.telefono);
                    }
                });
            }

            $("#mostrar-clientes").click(obtenerDatos);
            $("#boton-buscar").click(buscarCliente);

        });
    </script>

</body>
</html>