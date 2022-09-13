<?php

declare(strict_types=1);

/**
 * Created by Yurii Moskaliuk
 */

namespace App\Http\Controllers\Api\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait ResponseTrait
{
    /**
     * @param $message
     * @param int $status
     * @return JsonResponse
     */
    public function success($message, int $status = Response::HTTP_OK): JsonResponse
    {
        $data = [
            'success' => true,
            'message' => $message,
            'status' => $status,
        ];

        return new JsonResponse($data, $status);
    }

    /**
     * @return JsonResponse
     */
    public function noContent(): JsonResponse
    {
        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * @param $message
     * @return JsonResponse
     */
    public function unauthorized($message): JsonResponse
    {
        $data = [
            'success' => false,
            'message' => $message,
            'status' => Response::HTTP_UNAUTHORIZED,
        ];

        return new JsonResponse($data, Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @param $message
     * @return JsonResponse
     */
    public function forbidden($message): JsonResponse
    {
        $data = [
            'success' => false,
            'message' => $message,
            'status' => Response::HTTP_FORBIDDEN,
        ];

        return new JsonResponse($data, Response::HTTP_FORBIDDEN);
    }

    /**
     * @param $message
     * @return JsonResponse
     */
    public function notFound($message): JsonResponse
    {
        $data = [
            'success' => false,
            'message' => $message,
            'status' => Response::HTTP_NOT_FOUND,
        ];

        return new JsonResponse($data, Response::HTTP_NOT_FOUND);
    }

    /**
     * @param $message
     * @param bool $key
     * @param int $status
     * @return JsonResponse
     */
    public function invalidate(
        $message,
        bool $key = false,
        int $status = Response::HTTP_UNPROCESSABLE_ENTITY
    ): JsonResponse
    {
        $data = [
            'success' => false,
            'message' => $message,
            'status' => $status,
        ];

        if ($key) {
            $data['errors'][$key] = $message;
        }

        return new JsonResponse($data, $status);
    }
}
