<?php

namespace App\Support;

final class Pagination
{
    public static function offset(int $page, int $limit): int
    {
        if ($page < 1) $page = 1;
        if ($limit < 1) $limit = 1;
        return ($page - 1) * $limit;
    }

    public static function hasMore(int $currentCount, int $total): bool
    {
        if ($currentCount < 0) $currentCount = 0;
        if ($total < 0) $total = 0;
        return $currentCount < $total;
    }
}
