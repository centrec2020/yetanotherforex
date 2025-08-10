<?php
// *** Code for Additional Request: Add new rate upon form submission ***

namespace App\Services;

use App\Models\Currency;
use App\Models\Rate;
use Illuminate\Support\Facades\DB;
use Throwable;
use App\Traits\ParseDecimal;

class RateService
{
    use ParseDecimal;

    public function createRate(string $baseCode, string $targetCode, float $rate, string $effectiveDate): Rate
    {
        $rate = $this->parseDecimal($rate);
        return DB::transaction(function () use ($baseCode, $targetCode, $rate, $effectiveDate) {
            $base   = Currency::firstOrCreate(['code' => $baseCode], ['name' => $baseCode]);
            $target = Currency::firstOrCreate(['code' => $targetCode], ['name' => $targetCode]);

            $existing = Rate::where('base_currency_id', $base->id)
                ->where('target_currency_id', $target->id)
                ->whereDate('effective_date', $effectiveDate)
                ->first();

            if ($existing) {
                throw new \RuntimeException("Rate already exists for {$baseCode} → {$targetCode} on {$effectiveDate}.");
            }

            return Rate::create([
                'base_currency_id'   => $base->id,
                'target_currency_id' => $target->id,
                'rate'               => $rate,
                'effective_date'     => $effectiveDate,
            ]);
        });
    }
}
