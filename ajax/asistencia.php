<?php 
require_once "../modelos/Asistencia.php";

$asistencia = new Asistencia();

$codigo_persona = isset($_POST["codigo_persona"]) ? limpiarCadena($_POST["codigo_persona"]) : "";
$iddepartamento = isset($_POST["iddepartamento"]) ? limpiarCadena($_POST["iddepartamento"]) : "";

// Verificar si se está enviando un registro de asistencia
if (isset($_POST["tipo_registro"])) {
    $tipo_registro = $_POST["tipo_registro"];

    // Si se selecciona "Registro de Ingreso"
    if ($tipo_registro == "ingreso") {
        $tipo = "Entrada";
        // Verificar si el empleado existe
        $result = $asistencia->verificarcodigo_persona($codigo_persona);
        if ($result > 0) {
            date_default_timezone_set('America/Lima');
            $hora = date("H:i:s");
            $rspta = $asistencia->registrar_entrada($codigo_persona, $tipo);
            echo $rspta ? '<h3><strong>Nombres: </strong> ' . $result['nombre'] . ' ' . $result['apellidos'] . '</h3><div class="alert alert-success">Ingreso registrado ' . $hora . '</div>' : 'No se pudo registrar el ingreso';
        } else {
            echo '<div class="alert alert-danger">
                        <i class="icon fa fa-warning"></i> No hay empleado registrado con ese código...!
                        </div>';
        }
    }
    // Si se selecciona "Registro de Salida"
    elseif ($tipo_registro == "salida") {
        $tipo = "Salida";
        $result = $asistencia->verificarcodigo_persona($codigo_persona);
        if ($result > 0) {
            date_default_timezone_set('America/Lima');
            $hora = date("H:i:s");
            $rspta = $asistencia->registrar_salida($codigo_persona, $tipo);
            echo $rspta ? '<h3><strong>Nombres: </strong> ' . $result['nombre'] . ' ' . $result['apellidos'] . '</h3><div class="alert alert-danger">Salida registrada ' . $hora . '</div>' : 'No se pudo registrar la salida';
        } else {
            echo '<div class="alert alert-danger">
                        <i class="icon fa fa-warning"></i> No hay empleado registrado con ese código...!
                        </div>';
        }
    }
}
?>
