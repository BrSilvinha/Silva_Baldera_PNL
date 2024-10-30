<?php
class Response {
    // Método para enviar una respuesta en formato JSON
    public static function json($status, $message, $data = null) {
        // Configurar el encabezado para JSON
        header('Content-Type: application/json');

        // Construir la respuesta
        $response = [
            'status' => $status,
            'message' => $message
        ];

        // Incluir datos adicionales si existen
        if ($data !== null) {
            $response['data'] = $data;
        }

        // Enviar respuesta en formato JSON
        echo json_encode($response);
        exit;
    }

    // Método para una respuesta exitosa
    public static function success($message, $data = null) {
        self::json('success', $message, $data);
    }

    // Método para una respuesta de error
    public static function error($message, $data = null) {
        self::json('error', $message, $data);
    }
}
?>
