<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Rate;
use App\Models\Currency;

class RateApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_rates_api_returns_json_data()
    {
        $myr = Currency::create(['code' => 'MYR', 'name' => 'Malaysia Ringgit']);
        $chn = Currency::create(['code' => 'CHN', 'name' => 'China Yuan']);
        $test_data = '2023-06-01';

        Rate::factory()->count(10)->create([
            'base_currency_id' => $myr->id,
            'target_currency_id' => $chn->id,
            'rate' => 1.667000,
            'effective_date' => $test_data
        ]);

        $response = $this->getJson('/api/rates?date=' . $test_data . '&page=1&limit=5');

        $response->assertStatus(200)
                 ->assertJsonStructure(['data', 'total', 'success']);
    }
}
