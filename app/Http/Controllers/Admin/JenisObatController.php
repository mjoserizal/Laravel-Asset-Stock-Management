<?php

namespace App\Http\Controllers\Admin;

use App\Asset;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAssetRequest;
use App\Http\Requests\StoreAssetRequest;
use App\Http\Requests\StoreJenisObatRequest;
use App\JenisObat;
use Symfony\Component\HttpFoundation\Response;

class JenisObatController extends Controller
{
    public function index()
    {
        $jenisobat = JenisObat::all();

        return view('admin.jenisobats.index', compact('jenisobat'));
    }
    public function destroy(JenisObat $jenisobat)
    {

        $jenisobat->delete();

        return back();

    }

    public function massDestroy(MassDestroyAssetRequest $request)
    {
        JenisObat::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);

    }
    public function create()
    {
//        abort_if(Gate::denies('asset_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.jenisobats.create');
    }
    public function store(StoreJenisObatRequest $request)
    {
        $jenisobat = JenisObat::create($request->all());

        return redirect()->route('admin.jenisobats.index');

    }
}
