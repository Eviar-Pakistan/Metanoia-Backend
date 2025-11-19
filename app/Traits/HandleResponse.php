<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait HandleResponse
{
    /**
     * Generic response formatter.
     */
    private function response($data, int $status): JsonResponse
    {
        return response()->json($data, $status);
    }

    /**
     * Success response with data.
     */
    public function successWithData($data, string $message = 'Success', int $statusCode = Response::HTTP_OK): JsonResponse
    {
        return $this->response([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    /**
     * Success response with message only.
     */
    public function successMessage(string $message = 'Success', int $statusCode = Response::HTTP_OK): JsonResponse
    {
        return $this->response([
            'success' => true,
            'message' => $message,
        ], $statusCode);
    }

    /**
     * Unauthorized access response.
     */
    public function unauthorizedResponse(string $message = 'Unauthorized'): JsonResponse
    {
        return $this->response([
            'success' => false,
            'message' => $message,
        ], Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Bad request response.
     */
    public function badRequestResponse(string $message = 'Bad Request'): JsonResponse
    {
        return $this->response([
            'success' => false,
            'message' => $message,
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Generic fail response for other errors.
     */
    public function fail(string $message = 'Internal Server Error', array $errors = [], int $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR): JsonResponse
    {
        return $this->response([
            'success' => false,
            'message' => $message,
            'errors' => $errors,
        ], $statusCode);
    }

    
    public function fail2($msg = 'Internal Server Error', $errors = [], $status_code = Response::HTTP_INTERNAL_SERVER_ERROR): JsonResponse
    {
        // Concatenating all error messages into a single string
        $StringErrors = implode(', ', $errors->all());

        return $this->response([
            'status' => false,
            'message' => $msg,
            'error' => $StringErrors,
        ], $status_code);
    }
}
