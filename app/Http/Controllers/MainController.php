<?php
// *** Code for Additional Request: Add new rate upon form submission ***

namespace App\Http\Controllers;

use App\Models\Currency;

class MainController extends Controller
{
    public function index()
    {
        $currencies = Currency::orderby('code')->get(['code', 'name']);
        return view('app', compact('currencies'));
    }
}
