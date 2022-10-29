<?php

namespace Marcelofabianov;

use Marcelofabianov\Exception\InvalidStatusCodeException;
use Marcelofabianov\Interfaces\IResponse;
use Marcelofabianov\StatusCode;
use Illuminate\Http\JsonResponse;

class ErrorResponse implements IResponse
{
    private readonly array $body;
    private readonly StatusCode $statusCode;

    private function __construct(string $message, StatusCode|null $statusCode)
    {
        $this->statusCode = $statusCode ?? StatusCode::create(StatusCode::HTTP_INTERNAL_SERVER_ERROR);

        $this->body = [
            'status' => [
                'type' => 'error',
                'message' => $message,
                'statusCode' => $this->statusCode->code()
            ],
            'data' => [],
        ];
    }

    public function json(): JsonResponse
    {
        return new JsonResponse($this->body, $this->statusCode->code());
    }

    public static function create(string $message, StatusCode|null $statusCode = null): ErrorResponse
    {
        return new ErrorResponse($message, $statusCode);
    }
}
