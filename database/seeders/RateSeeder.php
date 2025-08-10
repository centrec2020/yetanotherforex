<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RateSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('rates')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $today = Carbon::now()->toDateString();

        // Data from ureg-tech/fiddle.sql
        DB::table('rates')->insert([
            // Today's rates
            [
                'base_currency_id' => 1,
                'target_currency_id' => 2,
                'rate' => 0.85,
                'effective_date' => $today,
            ],
            [
                'base_currency_id' => 1,
                'target_currency_id' => 3,
                'rate' => 0.73,
                'effective_date' => $today,
            ],
            [
                'base_currency_id' => 1,
                'target_currency_id' => 4,
                'rate' => 110.25,
                'effective_date' => $today,
            ],
            [
                'base_currency_id' => 1,
                'target_currency_id' => 5,
                'rate' => 1.35,
                'effective_date' => $today,
            ],

            // Historical rates (2023-07-01)
            [
                'base_currency_id' => 1,
                'target_currency_id' => 2,
                'rate' => 0.81,
                'effective_date' => '2023-07-01',
            ],
            [
                'base_currency_id' => 1,
                'target_currency_id' => 3,
                'rate' => 0.68,
                'effective_date' => '2023-07-01',
            ],
            [
                'base_currency_id' => 1,
                'target_currency_id' => 4,
                'rate' => 109.31,
                'effective_date' => '2023-07-01',
            ],
            [
                'base_currency_id' => 1,
                'target_currency_id' => 5,
                'rate' => 1.25,
                'effective_date' => '2023-07-01',
            ],
        ]);

        // Testing data
        $specificDates = ['2025-07-07', '2025-08-08', $today];

        // Get all currency ids except USD (id = 1)
        $targetCurrencyIds = DB::table('currencies')
            ->where('id', '!=', 1)
            ->pluck('id')
            ->toArray();

        $rows = [];
        foreach ($specificDates as $specificDate) {
            
            $existingTargetIds = DB::table('rates')
                ->where('effective_date', $specificDate)
                ->pluck('target_currency_id')
                ->toArray();

            foreach ($targetCurrencyIds as $targetId) {
                
                if (in_array($targetId, $existingTargetIds)) {
                    continue;
                }

                $rows[] = [
                    'base_currency_id'   => 1,
                    'target_currency_id' => $targetId,
                    'rate'               => $this->randomRate(),
                    'effective_date'     => $specificDate,
                ];
            }
        }

        DB::table('rates')->insert($rows);
    }

    private function randomRate(): float
    {
        return round(mt_rand(10, 20000) / 100, 2);
    }
}
