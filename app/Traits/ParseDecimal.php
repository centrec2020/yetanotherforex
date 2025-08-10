<?php
// *** Code for Additional Request: Add new rate upon form submission ***

namespace App\Traits;

trait ParseDecimal
{
    protected function parseDecimal(mixed $value): float
    {
        $normalized = str_replace([',', ' '], ['', ''], (string) $value);
        return (float) $normalized;
    }
}