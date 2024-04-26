<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>IE | EABLS</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../admin/public/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../admin/public/css/font-awesome.css">
   
    <!-- Theme style -->
    <link rel="stylesheet" href="../admin/public/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../admin/public/css/blue.css">
    <link rel="shortcut icon" href="../admin/public/img/favicon.ico">
</head>
<body class="hold-transition lockscreen">

<!-- Automatic element centering -->
<div class="lockscreen-wrapper">
    <?php //include '../ajax/asistencia.php' ?>
    <div name="movimientos" id="movimientos"></div> 

    <div class="lockscreen-logo">
        <a href="#"><b>CONTROL DE ASISTENCIA</b></a>
    </div>
    <!-- User name -->
    <div class="lockscreen-name">ASISTENCIA</div>

    <!-- START LOCK SCREEN ITEM -->
    <div class="lockscreen-item">
        <!-- lockscreen image -->
        <div class="lockscreen-image">
            <img src="../admin/files/negocio/default.jpg" alt="User Image">
        </div>
        <!-- /.lockscreen-image -->

        <!-- lockscreen credentials (contains the form) -->
        <form  action="asistencia.php" class="lockscreen-credentials" name="formulario" id="formulario" method="POST">
            <div class="input-group">
                
            <select class="form-control" name="tipo_registro" id="tipo_registro">
                <option value="ingreso">Registro de Ingreso</option>
                <option value="salida">Registro de Salida</option>
            </select>
            <input type="password" class="form-control" name="codigo_persona" id="codigo_persona" placeholder="Código de Estudiante">

                <div class="input-group-btn">
                    <button type="submit" id="submitBtn" class="btn btn-primary"><i class="fa fa-arrow-right text-muted"></i></button>
                </div>
            </div>
        </form>
        
        <!-- /.lockscreen credentials -->
    </div>
    <!-- /.lockscreen-item -->
    <div class="help-block text-center">
        Escanear Código
    </div>
    <div class="text-center"></div>
    <div class="lockscreen-footer text-center">
        <a href="../admin/">Iniciar Sesión</a>
    </div>
</div>
<!-- /.center -->

<!-- jQuery -->
<script src="../admin/public/js/jquery-3.1.1.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="../admin/public/js/bootstrap.min.js"></script>
<!-- Bootbox -->
<script src="../admin/public/js/bootbox.min.js"></script>

<script type="text/javascript" src="scripts/asistencia.js"></script>

<script>
    $(document).ready(function() {
        // Enfocar el campo de entrada al cargar la página
        $('#codigo_persona').focus();

        // Restaurar la selección del usuario en el campo de selección
        var selectedOption = localStorage.getItem('selectedOption');
        if (selectedOption) {
            $('#tipo_registro').val(selectedOption);
        }

        // Agregar un evento al formulario para que se enfoque el campo de entrada después de enviarlo
        $('#formulario').submit(function(event) {
            // Guardar la selección del usuario en el campo de selección en el almacenamiento local
            localStorage.setItem('selectedOption', $('#tipo_registro').val());

            // Evitar el comportamiento predeterminado del formulario
            event.preventDefault();
            // Enviar el formulario mediante AJAX
            enviarFormulario();
        });

        // Función para enviar el formulario mediante AJAX
        function enviarFormulario() {
            // Obtener el valor del código del estudiante
            var codigoEstudiante = $('#codigo_persona').val();

            // Obtener el tipo de registro seleccionado
            var tipoRegistro = $('#tipo_registro').val();

            // Crear un objeto con los datos a enviar
            var datos = {
                codigo_persona: codigoEstudiante,
                tipo_registro: tipoRegistro
            };

            // Realizar la solicitud AJAX
            $.ajax({
                url: 'asistencia.php', // Reemplaza 'asistencia.php' con la ruta correcta de tu script PHP
                method: 'POST',
                data: datos,
                success: function(response) {
                    // Manejar la respuesta del servidor
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    // Manejar errores si es necesario
                    console.error(error);
                }
            });
        }
    });
</script>
</body>
</html>