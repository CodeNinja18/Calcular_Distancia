<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtén el nombre, número de teléfono y distancia desde el formulario
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $distanceInKm = isset($_POST['distanceInKm']) ? floatval($_POST['distanceInKm']) : 0;

    $ordenNumero = '#' . str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);

    // Mensaje a enviar (sin la información del total)
    $message = "¡Gracias $name por tu compra!\nEstado: enviado\nOrden: $ordenNumero\n¡Gracias por elegirnos!";

    // Configuración de la solicitud cURL
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://qr.chat.buho.la/api/create-message',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => array(
            'appkey' => 'e43cb2ab-3f06-4cd0-840e-4e3ac404e554',
            'authkey' => 'Y3vda2G1uoBW9sB8S4rl89Rc2u5F3xfDbYHaCFHgPqDg0H3sc3',
            'to' => $phone,
            'message' => $message,
            'sandbox' => 'false'
        ),
    ));

    // Ejecuta la solicitud cURL y obtén la respuesta
    $response = curl_exec($curl);

    // Verifica si la solicitud fue exitosa
    if ($response === false) {
        echo 'Error en la solicitud cURL: ' . curl_error($curl);
    } else {
        // Devuelve la respuesta
        echo $response;
    }

    // Cierra la sesión cURL
    curl_close($curl);
} else {
    // Si se intenta acceder directamente al script PHP, redirige o maneja el error según tus necesidades
    echo 'Acceso no permitido.';
}
?>
