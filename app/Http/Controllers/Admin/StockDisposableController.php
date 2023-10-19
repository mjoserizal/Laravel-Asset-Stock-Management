<?php

namespace App\Http\Controllers\Admin;

use App\Asset;
use App\Stock;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreStockRequest;

// use Gate;
use App\Http\Requests\UpdateStockRequest;
use App\Http\Requests\MassDestroyStockRequest;
use Symfony\Component\HttpFoundation\Response;

class StockDisposableController extends Controller
{
    public function index()
    {

        $stocks = Stock::whereNotNull('disposable_id')->get();

        return view('admin.stocksDisposable.index', compact('stocks'));
    }

    public function create()
    {
        abort_if(Gate::denies('stock_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assets = Asset::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.stocks.create', compact('assets'));
    }

    public function store(StoreStockRequest $request)
    {
        $stock = Stock::create($request->all());

        return redirect()->route('admin.stocks.index');

    }

    public function edit(Stock $stock)
    {
        abort_if(Gate::denies('stock_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $assets = Asset::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $stock->load('asset', 'team');

        return view('admin.stocks.edit', compact('assets', 'stock'));
    }

    public function update(UpdateStockRequest $request, Stock $stock)
    {
        $stock->update($request->all());

        return redirect()->route('admin.stocks.index');

    }

    public function show(Stock $stock)
    {
        abort_if(Gate::denies('stock_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $stock->load('asset.transactions.user.team');

        return view('admin.stocks.show', compact('stock'));
    }

    public function destroy(Stock $stock)
    {
        abort_if(Gate::denies('stock_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $stock->delete();

        return back();

    }

    public function massDestroy(MassDestroyStockRequest $request)
    {
        Stock::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
}
