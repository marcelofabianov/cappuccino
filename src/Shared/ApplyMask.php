<?php

namespace Marcelofabianov\Shared;

class ApplyMask
{
    public static function custom(string $value, string $format): string
    {
        $mask = '';
        $k = 0;
        for ($i = 0; $i<=strlen($format)-1; $i++) {
            if ($format[$i] === '#') {
                if (isset($value[$k])) {
                    $mask .= $value[$k++];
                }
            } else if (isset($format[$i])) {
                $mask .= $format[$i];
            }
        }
        return $mask;
    }
}
