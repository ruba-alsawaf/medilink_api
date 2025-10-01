<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class ApiException extends Exception
{
    private $error;

    public $message;

    public $statusCode;

    public $systemMessage;

    /**
     * @param  $status
     */
    public function __construct(mixed $message, string $error = 'INTERNAL_SERVER_ERROR', $statusCode = 500, $systemMessage = '')
    {
        $this->error = $error;
        $this->statusCode = $statusCode;
        $this->message = $message;
        $this->systemMessage = $systemMessage;
    }

    public function response(): JsonResponse
    {
        $message = json_decode($this->message) ? json_decode($this->message) : $this->message;

        return response()->json([
            'status' => 'fail',
            'error' => $this->error,
            'message' => $message,
        ])->setStatusCode($this->statusCode);
    }
}
