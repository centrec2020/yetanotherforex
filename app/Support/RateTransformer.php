<?php

namespace App\Support;

final class RateTransformer
{
    public static function toApi(array $row): array
    {
        $base   = $row['base']   ?? $row['base_code']   ?? 'N/A';
        $target = $row['target'] ?? $row['target_code'] ?? 'N/A';
        $rate   = isset($row['rate']) ? (float) $row['rate'] : 0.0;

        return [
            'base'   => $base,
            'target' => $target,
            'rate'   => number_format($rate, 6, '.', ''),
        ];
    }

    public static function collection(iterable $rows): array
    {
        $out = [];
        foreach ($rows as $r) {
            $out[] = self::toApi((array) $r);
        }
        return $out;
    }
}
