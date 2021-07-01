<?php


namespace App\Services\Response;


class ResponseService
{
    private static function responseParams(bool $status, array $errors = [], array $data = [])
    {
        return [
            'status' => $status,
            'errors' => (object)$errors,
            'data' => (object)$data
        ];
    }

    public static function sendJsonResponse(int $status, int $code = 200, array $errors = [], array $data = [])
    {
        return response()->json(
            self::responseParams($status, $errors, $data),
            $code
        );
    }

    public static function success(array $data = [])
    {
        return self::sendJsonResponse(true, 200, [], $data);
    }

    public static function notFound(array $data = [])
    {
        return self::sendJsonResponse(false, 404, [], $data);
    }
}
