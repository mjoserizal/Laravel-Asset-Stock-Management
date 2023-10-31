<?php

namespace App\Http\Controllers;

use App\Alat;
use App\Asset;
use App\Disposable;
use App\Stock;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    //

    public function landingPage()
    {
        $assets = Asset::with('jenisObat')->orderBY('name')->paginate(12);
        $stocks = Stock::whereNotNull('asset_id')->get();

        return view('landingPage', compact('assets', 'stocks'));
    }

    public function landingPageAlat()
    {
        $alat = Alat::orderBY('name')->paginate(12);
        $stocks = Stock::whereNotNull('alat_id')->get();

        return view('landingPageAlat', compact('alat', 'stocks'));
    }
    public function landingPageDisposable()
    {
        $disposable = Disposable::orderBY('name')->paginate(12);
        $stocks = Stock::whereNotNull('disposable_id')->get();

        return view('landingPageDisposable', compact('disposable', 'stocks'));
    }
}
