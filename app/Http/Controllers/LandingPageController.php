<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Stock;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    //

    public function landingPage()
    {
        $assets = Asset::with('jenisObat')->get();
        $stocks = Stock::whereNotNull('asset_id')->get();

        return view('landingPage', compact('assets', 'stocks'));
    }
}
