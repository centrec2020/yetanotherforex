<?php

namespace Tests\Unit;

use App\Support\Pagination;
use PHPUnit\Framework\TestCase;

class PaginationTest extends TestCase
{
    public function test_offset_basic()
    {
        $this->assertSame(0, Pagination::offset(1, 12));
        $this->assertSame(12, Pagination::offset(2, 12));
        $this->assertSame(24, Pagination::offset(3, 12));
    }

    public function test_offset_guards()
    {
        $this->assertSame(0, Pagination::offset(0, 10));  // page clamped to 1
        $this->assertSame(0, Pagination::offset(-5, 10)); // page clamped to 1
        $this->assertSame(0, Pagination::offset(1, 0));   // limit clamped to >=1
    }

    public function test_has_more()
    {
        $this->assertTrue(Pagination::hasMore(12, 30));   // 12 of 30
        $this->assertFalse(Pagination::hasMore(30, 30));  // done
        $this->assertFalse(Pagination::hasMore(31, 30));  // overcount safe-guard
        $this->assertFalse(Pagination::hasMore(-1, -1));  // guard negatives
    }
}
