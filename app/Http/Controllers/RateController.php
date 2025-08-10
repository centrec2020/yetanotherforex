<?php
// *** Code for Additional Request: Add new rate upon form submission ***

namespace App\Http\Controllers;

use App\Http\Requests\StoreRateRequest;
use App\Services\RateService;
use Illuminate\Http\RedirectResponse;

class RateController extends Controller
{
    public function __construct(private RateService $rateService)
    {
    }

    public function store(StoreRateRequest $request): RedirectResponse
    {
        try {
            $this->rateService->createRate(
                $request->string('base_code'),
                $request->string('target_code'),
                (float) $request->input('rate'),
                $request->date('effective_date')->format('Y-m-d'),
            );

            return back()->with('success', 'Rate added successfully.');
        } catch (\Throwable $e) {
            return back()
                ->withErrors(['add' => $e->getMessage()])
                ->withInput();
        }
    }
}
