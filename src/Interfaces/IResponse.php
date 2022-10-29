<?php

namespace Marcelofabianov\Interfaces;

use Illuminate\Http\JsonResponse;

interface IResponse
{
    public function json(): JsonResponse;
}
