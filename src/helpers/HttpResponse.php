<?php

class HttpResponse
{
    public static function sendSuccess(mixed $data, string $message = "Success", int $statusCode = 200): void
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode([
            'status'  => 'success',
            'message' => $message,
            'data'    => $data,
        ]);
        exit;
    }

    public static function sendError(string $message, int $statusCode): void
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode([
            'status'  => 'error',
            'message' => $message,
        ]);
        exit;
    }
}