<?php

namespace Cappuccino\Interfaces;

use Illuminate\Http\JsonResponse;

interface IResponse
{
    public function json(): JsonResponse;
}
