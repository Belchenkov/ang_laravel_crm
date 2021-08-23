<?php


namespace App\Services\Response;


use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ResponseService
{
    private static function responseParams(bool $status, array $errors = [], array $data = []): array
    {
        return [
            'status' => $status,
            'errors' => (object)$errors,
            'data' => (object)$data
        ];
    }

    public static function sendJsonResponse(
        int $status,
        int $code = 200,
        array $errors = [],
        array $data = []
    ): JsonResponse
    {
        return response()->json(
            self::responseParams($status, $errors, $data),
            $code
        );
    }

    public static function success(array $data = []): JsonResponse
    {
        return self::sendJsonResponse(true, Response::HTTP_OK, [], $data);
    }

    public static function notFound(array $data = []): JsonResponse
    {
        return self::sendJsonResponse(false, Response::HTTP_NOT_FOUND, [], $data);
    }

    public static function notAuthorize(): JsonResponse
    {
        return self::sendJsonResponse(false, Response::HTTP_UNAUTHORIZED, [], []);
    }
}
