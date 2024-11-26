<?php

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
$token = 'apis-token-11774.7RCfFIR9hHcb8LJNxRf7YXweP6kK047y';
$fecha = '2024-11-26';

// Iniciar llamada a API
$curl = curl_init();

curl_setopt_array($curl, array(
  // para usar la api versión 2
  CURLOPT_URL => 'https://api.apis.net.pe/v2/sunat/tipo-cambio?date=' . $fecha,
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

$response = curl_exec($curl);

curl_close($curl);
// Datos listos para usar
$tipoCambioSunat = json_decode($response);
ECHO json_encode($tipoCambioSunat);

?>