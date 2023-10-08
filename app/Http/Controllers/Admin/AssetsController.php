<?php

namespace App\Http\Controllers\Admin;

use PDF;
use Milon\Barcode\DNS1D;
use App\Asset;
use App\JenisObat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreAssetRequest;
use App\Http\Requests\UpdateAssetRequest;
use App\Http\Requests\MassDestroyAssetRequest;
use Symfony\Component\HttpFoundation\Response;


class AssetsController extends Controller
{
    public function index()
    {
        $assets = Asset::with('jenisObat')->get();

        return view('admin.assets.index', compact('assets'));
    }


    public function create()
    {
//        abort_if(Gate::denies('asset_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $jenisobat = JenisObat::all()->pluck('name', 'id');
        return view('admin.assets.create', compact('jenisobat'));
    }

    public function store(StoreAssetRequest $request)
    {

        $asset = Asset::create($request->all());

        return redirect()->route('admin.assets.index');

    }

    public function assetsCodeExists($number)
    {
        return Asset::whereAssetsCode($number)->exists();
    }

    public function edit(Asset $asset)
    {

        $jenisobat = JenisObat::all()->pluck('name', 'id');
        return view('admin.assets.edit', compact('asset', 'jenisobat'));
    }

    public function update(UpdateAssetRequest $request, Asset $asset)
    {
        $asset->update($request->all());

        return redirect()->route('admin.assets.index');

    }

    public function show(Asset $asset)
    {
        abort_if(Gate::denies('asset_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.assets.show', compact('asset'));
    }

    public function destroy(Asset $asset)
    {
        abort_if(Gate::denies('asset_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $asset->delete();

        return back();

    }

    public function massDestroy(MassDestroyAssetRequest $request)
    {
        Asset::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }

    public function exportPdf()
    {
        $assets = Asset::all();

        $pdf = PDF::loadView('assets_pdf', compact('assets'));
        return $pdf->download('barcode-daftar-obat.pdf');
    }

}
