<?php
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    echo json_encode(['error' => 'Método no permitido']);
    exit;
}

$accion = $_POST['accion'] ?? '';

switch ($accion) {
    case 'suma':
        $num1 = $_POST['num1'] ?? 0;
        $num2 = $_POST['num2'] ?? 0;
        $resultado = floatval($num1) + floatval($num2);
        echo json_encode(['resultado' => $resultado]);
        exit;

    case 'tabla':
        $num = isset($_POST['numTabla']) ? intval($_POST['numTabla']) : 0;
        $tabla = [];
        for ($i = 1; $i <= 10; $i++) {
            $tabla[] = [
                'operacion' => "$num x $i",
                'resultado' => $num * $i
            ];
        }
        echo json_encode(['tabla' => $tabla]);
        exit;

    case 'parimpar':
        $numero = $_POST['numParImpar'] ?? null;
        if (!is_numeric($numero)) {
            echo json_encode(['resultado' => 'Dato no válido']);
            exit;
        }
        $resultado = ((int)$numero % 2 === 0) ? "Es par" : "Es impar";
        echo json_encode(['resultado' => $resultado]);
        exit;

    case 'edad':
        $anioNacimiento = $_POST['anioNacimiento'] ?? null;
        if (!is_numeric($anioNacimiento)) {
            echo json_encode(['resultado' => 'Año no válido']);
            exit;
        }
        $anioActual = date("Y");
        $edad = $anioActual - intval($anioNacimiento);
        $mensaje = ($edad >= 0) ? "Tienes $edad años." : "Año no válido";
        echo json_encode(['resultado' => $mensaje]);
        exit;

    default:
        http_response_code(400);
        echo json_encode(['error' => 'Acción no válida']);
        exit;
}
