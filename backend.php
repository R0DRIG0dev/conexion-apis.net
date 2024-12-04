<?php

// Aun debes aplicar esto !!!!:
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $nombre = htmlspecialchars($_POST["nombre"]); // Evitar inyección XSS
//     if (!empty($nombre)) {
//         echo "¡Hola, " . $nombre . "! Bienvenido al mundo de PHP.";
//     } else {
//         echo "Por favor, ingresa un nombre.";
//     }
// } else {
//     echo "Método no permitido.";
// }

// Datos
$token = 'apis-token-11890.OmJCc2rKKa1kbqPSSR7TjS2ehCCrJnHY';
$fechaDigitada = new DateTime('2024-12-03');
$fechaDigitada_string = $fechaDigitada->format('Y-m-d');
// $todoBienOtodoMal = true;
$diesDiasEnTipoDeCambio = array();
$diesDiasEnTipoDeCambio['data'] = array();
$diesDiasEnTipoDeCambio['mensajes'] = array();

// Iniciar llamada a API (usar ¿cbs?)
$curl = curl_init();

// Llegar a los 10 dias:
for ($i = 1; $i <= 10; $i++) {
    curl_setopt_array($curl, array(
        // para usar la api versión 2
        CURLOPT_URL => 'https://api.apis.net.pe/v2/sunat/tipo-cambio?date=' . $fechaDigitada_string,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 2,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Referer: https://apis.net.pe/tipo-de-cambio-sunat-api',
            'Authorization: Bearer ' . $token
        ),
    ));

    $datos = curl_exec($curl);
    // Datos listos para usar:
    $tipoCambioSunat = json_decode($datos, true);
    // Asegurarse que no ingrese fechas que aun no han llegado:
    if (array_key_exists('message', $tipoCambioSunat)) {
        $unoDeLosDiesDiasConError = array(
            'fecha' => $fechaDigitada_string,
            'mensaje' => $tipoCambioSunat['message']
        );
        array_push($diesDiasEnTipoDeCambio['mensajes'],$unoDeLosDiesDiasConError);
    } else {
        // Armar el array de respuesta:
        $unoDeLosDiesDias = array(
            'fecha' => $tipoCambioSunat['fecha'],
            'moneda' => $tipoCambioSunat['moneda'],
            'precioCompra' => $tipoCambioSunat['precioCompra'],
            'precioVenta' => $tipoCambioSunat['precioVenta']
        );
        array_push($diesDiasEnTipoDeCambio['data'],$unoDeLosDiesDias);
    }
    // Sumarle un dia:
    $fechaDigitada->add(new DateInterval('P1D'));
    $fechaDigitada_string = $fechaDigitada->format('Y-m-d');
}
curl_close($curl);
ECHO json_encode($diesDiasEnTipoDeCambio);

?>