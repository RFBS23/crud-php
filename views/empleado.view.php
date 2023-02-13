<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados</title>

    <!-- Estilos Bootstrap 5.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    
    <!-- DataTable -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">

</head>
<body>

    <style>
        .bold{
            font-weight: bold;
        }
    </style>

    <div class="container mt-4">
        <h4>Gestión de empleados</h4>
        <h6>Acceso a datos utilizando PDO</h6>
        <hr>

        <div class="mb-3">
            <button type="button" class="btn btn-primary btn-sm" id="abrir-modal-registro" data-bs-toggle="modal" data-bs-target="#modal-registro-empleado">
                <i class="fa-sharp fa-solid fa-file"></i> Nuevo empleado
            </button>
    
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal-buscador">
                <i class="fa-sharp fa-solid fa-magnifying-glass"></i> Buscar empleado
            </button>
        </div>

        <table class="table table-striped mt-4" id="tabla-empleados" width="100%">
            <colgroup>
                <col width="5%">    <!-- ID -->
                <col width="15%">   <!-- Área -->
                <col width="15%">   <!-- Apellidos -->
                <col width="15%">   <!-- Nombres -->
                <col width="10%">   <!-- DNI -->
                <col width="10%">   <!-- Teléfono -->
                <col width="20%">   <!-- Email -->
                <col width="10%">   <!-- Comandos -->
            </colgroup>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Área</th>
                    <th>Apellidos</th>
                    <th>Nombres</th>
                    <th>DNI</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Comandos</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>

    </div> <!-- Fin container -->

    <!-- Zonal de modales -->

    <!-- Primer modal: REGISTRO DE EMPLEADOS -->
    <div class="modal fade novalidate" id="modal-registro-empleado" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content">
                <div id="modal-registro-header" class="modal-header bg-primary text-light">
                    <h5 class="modal-title" id="modal-registro-titulo">Registro de empleados</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" autocomplete="off" id="formulario-empleado">
                        <div>
                            <label for="areas" class="form-label bold">Área:</label>
                            <select name="areas" id="areas" class="form-select" required>
                                <option value="">Seleccione</option>
                            </select>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mt-3">
                                <label for="apellidos" class="form-label bold">Apellidos:</label>
                                <input type="text" class="form-control" id="apellidos" onkeypress="return SoloLetras(event);" required>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="nombres" class="form-label bold">Nombres:</label>
                                <input type="text" class="form-control" id="nombres" onkeypress="return SoloLetras(event);" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mt-3">
                                <label for="dni" class="form-label bold">DNI:</label>
                                <input type="text" class="form-control" id="dni" maxlength="8" onkeypress="return SoloNumeros(event);" required>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="telefono" class="form-label">Teléfono:</label>
                                <input type="text" class="form-control" id="telefono" maxlength="9" placeholder="Campo opcional" onkeypress="return SoloNumeros(event);" required>
                            </div>
                        </div>

                        <div class="mt-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" placeholder="Campo opcional">
                        </div>
                        <div class="mt-3">
                            <label for="direccion" class="form-label">Dirección:</label>
                            <input type="text" class="form-control" id="direccion" placeholder="Campo opcional">
                        </div>
                    </form> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-sm btn-primary" id="guardar">Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin primer modal -->

    <!-- Segundo modal: BUSCADOR DE EMPLEADOS -->
    <div class="modal fade" id="modal-buscador" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success text-light">
                    <h5 class="modal-title" id="modalTitleId">Buscador empleados</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="formulario-busqueda-empleado" autocomplete="off">

                        <div class="row mt-3">
                            <label for="b-dni" class="col-form-label col-sm-3 bold">Escriba DNI</label>
                            <div class="col-sm-9">
                                <input type="search" class="form-control" id="b-dni" maxlength="8" placeholder="Enter buscar">
                            </div>
                        </div>

                        <hr>

                        <div class="row mt-3">
                            <label for="b-area" class="col-form-label col-sm-3">Área</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="b-area" readonly>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <label for="b-apellidos" class="col-form-label col-sm-3">Apellidos</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="b-apellidos" readonly>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <label for="b-nombres" class="col-form-label col-sm-3">Nombres:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="b-nombres" readonly>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <label for="b-telefono" class="col-form-label col-sm-3">Teléfono:</label>
                            <div class="col-sm-9">
                                <input type="tel" class="form-control" id="b-telefono" maxlength="9" readonly>
                            </div>
                        </div>
                        
                        <div class="row mt-3">
                            <label for="b-email" class="col-form-label col-sm-3">Email:</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="b-email" readonly>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <label for="b-direccion" class="col-form-label col-sm-3">Dirección:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="b-direccion" readonly>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin del segundo modal -->
    <form class="container-sm" action="../index.php" method="post">
        <button class="btn btn-outline-danger">Salir</button>
    </form>
    <!-- Fin de zona modales 
    <button type="reset" class="btn btn-primary btn-sm" action="controller_login.php" method="post">
        <i class="fa-sharp fa-solid fa-magnifying-glass" ></i> CERRAR SESION
    </button>-->
    <!--Js Bootstrap 5.2-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    
    <!-- AJAX = JavaScript asincrónico-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <!-- Fontawesome -->
    <script src="https://kit.fontawesome.com/2927838564.js" crossorigin="anonymous"></script>

    <!-- DataTable -->
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

    <!-- Opcional -->
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>

    <script>
        //para nombres y apellidos
        function SoloLetras(e){
            key = e.keyCode || e.which;
            tecla = String.fromCharCode(key).toString();
            letras = "ABCDEFGHIJKLMNOPQRSTUVWXYZÁÉÍÓÚabcdefghijklmnopqrstuvwxyzáéíóú";
            especiales = [8,13];
            tecla_especial = false
            for(var i in especiales) {
                if(key == especiales[i]){
                    tecla_especial = true;
                    break;
                }
            }

            if(letras.indexOf(tecla) == -1 && !tecla_especial){
                alert("Ingresar solo letras");
                return false;
            }
        }

        //para ingresar solo numeros
        function SoloNumeros(evt){
            if(window.event){
                keynum = evt.keyCode;
            }
            else{
                keynum = evt.which;
            }
            if((keynum > 47 && keynum < 58) || keynum == 8 || keynum== 13){
                return true;
            }
            else{
                alert("Ingresar solo numeros");
                return false;
            }
        }

        $(document).ready(function (){

            //Global
            let datosNuevos = true;
            let idempleado = 0; //Actualizar - Eliminar

            function mostrarEmpleados(){
                $.ajax({
                    url: '../controllers/empleado.controller.php',
                    type: 'GET',
                    data: {'operacion': 'listarEmpleados'},
                    success: function (result){
                        
                        //Referencia al objeto DT
                        var tabla = $("#tabla-empleados").DataTable();
                        //Destruirlo
                        tabla.destroy();

                        //Poblar el cuerpo de la tabla
                        $("#tabla-empleados tbody").html(result);

                        //Reconstruimos la tabla
                        $("#tabla-empleados").DataTable({
                            dom: 'Bfrtip',
                            buttons: [
                                {
                                    extend: 'print',
                                    exportOptions: { columns: [0,1,2,3,4,5,6] }
                                }
                            ],
                            language: {
                                url: 'js/Spanish.json'
                            }
                        });
                    }
                });
            }

            function mostrarAreas(){
                $.ajax({
                    url: '../controllers/area.controller.php',
                    type: 'GET',
                    data: {'operacion': 'listarAreas'},
                    success: function (result){
                        $("#areas").html(result);
                    }
                });
            }

            //Este método, permitirá: DATOS NUEVOS / ACTUALIZADOS
            function registrarEmpleado(){
                //Array asociativo en JS (todo esto se recupera en el controlador)
                //utilizando $_GET['']
                let datosEnviar = {
                    'operacion'     : 'registrarEmpleado',
                    'idarea'        : $("#areas").val(),
                    'apellidos'     : $("#apellidos").val(),
                    'nombres'       : $("#nombres").val(),
                    'dni'           : $("#dni").val(),
                    'telefono'      : $("#telefono").val(),
                    'email'         : $("#email").val(),
                    'direccion'     : $("#direccion").val()
                };

                //Actualización...
                //... si no son datos nuevos ...
                if (!datosNuevos){
                    //Actualizando el array asociativo
                    datosEnviar["operacion"] = "actualizarEmpleado";
                    datosEnviar["idempleado"] = idempleado;
                }

                if (confirm("¿Está seguro de realizar esta acción?")){
                    $.ajax({
                        url: '../controllers/empleado.controller.php',
                        type: 'GET',
                        data: datosEnviar,
                        success: function(result){
                            //Reiniciar el formulario
                            $("#formulario-empleado")[0].reset();
                            
                            //Recargamos la tabla empleados
                            mostrarEmpleados();

                            //Cerramos el modal
                            $("#modal-registro-empleado").modal('hide');
                        }
                    });
                }
            }

            function buscarEmpleado(){
                let dni = $("#b-dni").val();

                if (dni.length == 8){
                    $.ajax({
                        url: '../controllers/empleado.controller.php',
                        type: 'GET',
                        dataType: 'JSON',
                        data: {
                            'operacion' : 'buscarEmpleado',
                            'dni'       : dni
                        },
                        success: function(result){
                            if (!result){
                                $("#formulario-busqueda-empleado")[0].reset();
                            }else{
                                $("#b-area").val(result.nombrearea);
                                $("#b-apellidos").val(result.apellidos);
                                $("#b-nombres").val(result.nombres);
                                $("#b-telefono").val(result.telefono);
                                $("#b-email").val(result.email);
                                $("#b-direccion").val(result.direccion);
                            }
                        }
                    });
                }
            }

            function eliminarEmpleado(id){
                if (confirm("¿Está seguro de eliminar el registro?")){
                    $.ajax({
                        url: '../controllers/empleado.controller.php',
                        type: 'GET',
                        data: {
                            'operacion' : 'eliminarEmpleado',
                            'idempleado': id
                        },
                        success: function(){
                            mostrarEmpleados();
                        }
                    });
                }
            }

            //El usuario pulsó clic en el botón EDITAR...
            function mostrarDatos(id){
                //1. Limpiar formulario
                $("#formulario-empleado")[0].reset();

                //2. Ejecutar una búsqueda de datos y mostrarlos en los controles
                $.ajax({
                    url: '../controllers/empleado.controller.php',
                    type: 'GET',
                    data: {
                        'operacion'     : 'getData',
                        'idempleado'    : id
                    },
                    dataType: 'JSON',
                    success: function (result){
                        $("#areas").val(result.idarea);
                        $("#apellidos").val(result.apellidos);
                        $("#nombres").val(result.nombres);
                        $("#dni").val(result.dni);
                        $("#telefono").val(result.telefono);
                        $("#email").val(result.email);
                        $("#direccion").val(result.direccion);
                    }
                });

                //3. Abrir modal
                $("#modal-registro-titulo").html("Actualización de datos");
                $("#modal-registro-header").removeClass("bg-primary");
                $("#modal-registro-header").addClass("bg-info");
                $("#guardar").html("Actualizar");
                datosNuevos = false;
                $("#modal-registro-empleado").modal("show");
            }

            //Proceso NUEVO registro
            function abrirModalRegistro(){
                $("#modal-registro-titulo").html("Registro de empleados");
                $("#modal-registro-header").removeClass("bg-info");
                $("#modal-registro-header").addClass("bg-primary");
                $("#guardar").html("Guardar");
                datosNuevos = true;
            }

            //Eventos de modal
            //Cuando el modal sea aperturado, enviaremos el enfoque a la primera caja de texto
            const modalBusqueda = document.getElementById("modal-buscador");
            modalBusqueda.addEventListener('shown.bs.modal', event => {
                $("#b-dni").focus();
            });

            //Proceso de eliminación (Funciona con datos SÍNCRONOS)
            //$(".eliminar").click(eliminarEmpleado);

            //Proceso de eliminación (Componente ASÍNCRONOS)
            //on asigna un evento a un objeto/grupo de objetos determinado
            $("#tabla-empleados tbody").on("click", ".eliminar", function (){
                idempleado = $(this).data("ideliminar");
                eliminarEmpleado(idempleado);
            });

            //Editar
            $("#tabla-empleados tbody").on("click",".editar", function (){
                idempleado =$(this).data("ideditar");
                mostrarDatos(idempleado);
            });

            $("#abrir-modal-registro").click(abrirModalRegistro);

            //Funciones asociadas a eventos
            $("#guardar").click(registrarEmpleado);
            
            //Al pulsar enter se ejecuta la función
            $("#b-dni").keypress(function (event){
                if (event.keyCode == 13){
                    buscarEmpleado();
                }
            });

            //Se ejecutan cuando la vista es mostrada
            mostrarEmpleados();
            mostrarAreas();

        });
    </script>

</body>
</html>