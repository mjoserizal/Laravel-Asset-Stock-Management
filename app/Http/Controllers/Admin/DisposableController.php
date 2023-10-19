<?php

namespace App\Http\Controllers\Admin;

use App\Asset;
use App\Disposable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDisposableRequest;
use App\JenisObat;
use App\Stock;

class DisposableController extends Controller
{
    public function index()
    {
        $disposable = Disposable::all();

        return view('admin.disposable.index', compact('disposable'));
    }

    public function create()
    {
//        abort_if(Gate::denies('asset_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.disposable.create');
    }

    public function store(StoreDisposableRequest $request)
    {

        $disposable = Disposable::create($request->all());

        // Membuat entri baru di stocks_disposables
        Stock::create([
            'disposable_id' => $disposable->id,
            'team_id' => 1, // Memeriksa apakah pengguna diautentikasi, jika iya gunakan team_id pengguna, jika tidak, gunakan nilai 1
            'current_stock' => 0, // Tentukan jumlah stok awal jika perlu
        ]);
        return redirect()->route('admin.disposable.index');
    }
}
