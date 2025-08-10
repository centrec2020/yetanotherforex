<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rate;
use App\Support\Pagination;
use App\Support\RateTransformer;

class RateController extends Controller
{
    public function index(Request $request)
    {
        $date  = $request->query('date', now()->toDateString());
        $page  = max((int) $request->query('page', 1), 1);
        $limit = max((int) $request->query('limit', 12), 1);

        $offset = Pagination::offset($page, $limit);

        $query = Rate::with(['baseCurrency', 'targetCurrency'])
            ->where('effective_date', $date);

        $total = $query->count();

        $rates = $query
            ->skip($offset)
            ->take($limit)
            ->get()
            ->map(function ($rate) {
                return RateTransformer::toApi([
                    'base'   => $rate->baseCurrency->code,
                    'target' => $rate->targetCurrency->code,
                    'rate'   => $rate->rate,
                ]);
            })
            ->values();

        return response()->json([
            'success' => true,
            'total'   => $total,
            'data'    => $rates,
        ]);
    }
}
