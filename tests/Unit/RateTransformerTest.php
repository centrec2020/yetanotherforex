<?php

namespace Tests\Unit;

use App\Support\RateTransformer;
use PHPUnit\Framework\TestCase;

class RateTransformerTest extends TestCase
{
    public function test_single_row_transform()
    {
        $row = ['base' => 'USD', 'target' => 'EUR', 'rate' => 1.23456789];
        $out = RateTransformer::toApi($row);

        $this->assertSame('USD', $out['base']);
        $this->assertSame('EUR', $out['target']);
        $this->assertSame('1.234568', $out['rate']); // rounded to 6dp
    }

    public function test_accepts_alt_keys()
    {
        $row = ['base_code' => 'USD', 'target_code' => 'JPY', 'rate' => '110.25'];
        $out = RateTransformer::toApi($row);

        $this->assertSame('USD', $out['base']);
        $this->assertSame('JPY', $out['target']);
        $this->assertSame('110.250000', $out['rate']);
    }

    public function test_defaults_when_missing()
    {
        $row = [];
        $out = RateTransformer::toApi($row);

        $this->assertSame('N/A', $out['base']);
        $this->assertSame('N/A', $out['target']);
        $this->assertSame('0.000000', $out['rate']);
    }

    public function test_collection_transform()
    {
        $rows = [
            ['base' => 'USD', 'target' => 'GBP', 'rate' => 1.1],
            ['base_code' => 'USD', 'target_code' => 'AUD', 'rate' => 1.5],
        ];

        $out = RateTransformer::collection($rows);

        $this->assertCount(2, $out);
        $this->assertSame('GBP', $out[0]['target']);
        $this->assertSame('1.500000', $out[1]['rate']);
    }
}
