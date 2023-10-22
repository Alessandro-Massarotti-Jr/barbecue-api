<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

final class ReturnApi
{
    /**
     * messageReturn
     *
     * @param  bool $error
     * @param  string $message
     * @param  \Exception $exception
     * @param  mixed $data
     * @param  int $statusHTTP
     */
    public static function messageReturn(bool $error, ?string $message, \Exception $exception, $data, int $statusHTTP): JsonResponse
    {
        $result = [
            'error' => $error,
            'message' =>  $message,
            'exception' => $exception,
            'data' => $data
        ];

        return response()->json($result,  $statusHTTP, [], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    /**
     * success
     *
     * @param  ?string $message
     * @param  mixed $data
     * @param  ?int $statusHTTP
     */
    public static function success(?string $message = "", $data = null, ?int $statusHTTP = 200): JsonResponse
    {
        $result = [
            'error' => false,
            'message' =>  $message,
            'exception' => null,
            'data' => $data
        ];

        return response()->json($result,  $statusHTTP, [], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }
}
