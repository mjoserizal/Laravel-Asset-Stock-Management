<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Stock;

class StockAlatController extends Controller
{
    public function index()
    {

        $stocks = Stock::whereNotNull('alat_id')->get();

        return view('admin.stocksAlat.index', compact('stocks'));
    }
}
