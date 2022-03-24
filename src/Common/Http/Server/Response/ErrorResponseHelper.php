<?php

namespace App\Common\Http\Server\Response;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ErrorResponseHelper
{
    public static function createResponse(array $errors): JsonResponse
    {
        $result = [];
        foreach ($errors as $error) {
            if (is_array($error)) {
                $result[] = [
                    'message' => $error['message'],
                    'code' => $error['code'],
                ];
            } else {
                $result[] = [
                    'message' => $error,
                    'code' => Response::HTTP_BAD_REQUEST,
                ];
            }
        }

        return new JsonResponse([
            'errors' => $result,
        ]);
    }
}
