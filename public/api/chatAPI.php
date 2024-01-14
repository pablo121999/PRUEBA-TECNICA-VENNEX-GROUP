<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $pregunta = $_POST['mensaje'];

    $openaiApiKey = "agrega la key aca";

    $url = 'https://api.openai.com/v1/chat/completions';

    $data = array(
        "model" => "gpt-3.5-turbo",
        "messages" => array(
            array(
                "role" => "system",
                "content" => "You are a helpful assistant."
            ),
            array(
                "role" => "user",
                "content" => $pregunta
            )
        )
    );

    $dataString = json_encode($data);

    $headers = array(
        'Content-Type: application/json',
        'Authorization: Bearer ' . $openaiApiKey
    );

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);

    $respuesta = '';
    $decoded_response = json_decode($response, true);

    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
    }

    if (isset($decoded_response['choices'][0]['message']['content'])) {
        $respuesta = $decoded_response['choices'][0]['message']['content'];
    }

    curl_close($ch);

    echo $respuesta;
   // echo $response;




    /*
    // Verificar si se recibió la pregunta del chat
    if (isset($_POST['mensaje'])) {
        // Obtener la pregunta del chat
        $pregunta = $_POST['mensaje'];

       // $api_key = "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";
        $api_key = "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";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/chat/completions');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $api_key,
        ]);

        $data = [
            'model' => 'gpt-3.5-turbo',
            'messages' => [],
        ];

       // $data['messages'][] = ['role' => 'system', 'content' => 'Actua como un experto '];
        $data['messages'][] = ['role' => 'user', 'content' => $pregunta];

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));


        $response = curl_exec($ch);
        $respuesta = '';
        $decoded_response = json_decode($response, true);

        if (isset($decoded_response['choices'][0]['message']['content'])) {
            $respuesta = $decoded_response['choices'][0]['message']['content'];
        }

        curl_close($ch);

        echo $respuesta;
    }



    */



}
?>
