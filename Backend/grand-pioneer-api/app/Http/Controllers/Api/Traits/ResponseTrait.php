<?php

namespace App\Http\Controllers\Api\Traits;

trait ResponseTrait
{
    /**
     * @param bool $success
     * @param array $data
     * @param int $status
     * @param null $error_code
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function respond($success, $data = [], $status = 200, $error_code = null, $message = '')
    {
        return response()->json([
            'success' => $success,
            'message' => $message,
            'error_code' => $error_code,
            'data' => $data
        ], $status);
    }

    public function respondSuccess($data = [])
    {
        return $this->respond(true, $data);
    }

    /**
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondBadRequest($message = 'Bad Request')
    {
        return $this->respond(false, [], 400, 0, $message);
    }

    /**
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondUnauthorized($message = 'Unauthorized')
    {
        return $this->respond(false, [], 401, 0, $message);
    }

    /**
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondNotFound($message = 'Not found')
    {
        return $this->respond(false, [], 404, 0, $message);
    }

    /**
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondForbidden($message = 'Forbidden')
    {
        return $this->respond(false, [], 403, 0, $message);
    }

    /**
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondInternalServerError($message = 'Internal Server Error')
    {
        return $this->respond(false, [], 500, 0, $message);
    }
}
