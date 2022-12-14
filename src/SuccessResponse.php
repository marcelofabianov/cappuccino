<?php

declare(strict_types=1);

namespace Cappuccino;

use Cappuccino\Interfaces\IResponse;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\JsonResponse;

class SuccessResponse implements IResponse
{
    private array $body;

    private readonly StatusCode $statusCode;

    private function __construct(array|Paginator $data, string $message, StatusCode|null $statusCode)
    {
        $this->statusCode = $statusCode ?? StatusCode::create(StatusCode::HTTP_OK);

        $this->body = [
            'status' => [
                'type' => 'success',
                'message' => $message ?? 'It worked out!',
                'statusCode' => $this->statusCode->code(),
            ],
        ];

        if (is_a($data, Paginator::class)) {
            $this->body['items'] = $data;
        } else {
            $this->body['data'] = $data;
        }
    }

    public function json(): JsonResponse
    {
        return new JsonResponse($this->body, $this->statusCode->code());
    }

    public static function create(
        array|Paginator $data = [],
        string|null $message = null,
        StatusCode|null $statusCode = null
    ): self {
        $message = $message ?? 'It worked out!';

        return new self($data, $message, $statusCode);
    }
}
