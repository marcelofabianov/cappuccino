<?php

declare(strict_types=1);

namespace Cappuccino\Interfaces;

use Illuminate\Http\JsonResponse;

interface IResponse
{
    public function json(): JsonResponse;
}
