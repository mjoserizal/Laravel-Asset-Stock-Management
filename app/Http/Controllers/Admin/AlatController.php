<?php

namespace App\Http\Controllers\Admin;

use App\Alat;
use App\Asset;
use App\Disposable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDisposableRequest;
use App\Http\Requests\UpdateAlatRequest;
use App\Http\Requests\UpdateDisposableRequest;
use App\Stock;

class AlatController extends Controller
{
    public function index()
    {
        $alat = Alat::all();

        return view('admin.alat.index', compact('alat'));
    }

    public function create()
    {
//        abort_if(Gate::denies('asset_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.alat.create');
    }

    public function store(StoreDisposableRequest $request)
    {

        $alat = Alat::create($request->all());

        // Membuat entri baru di stocks_disposables
        Stock::create([
            'alat_id' => $alat->id,
            'team_id' => 1, // Memeriksa apakah pengguna diautentikasi, jika iya gunakan team_id pengguna, jika tidak, gunakan nilai 1
            'current_stock' => 0, // Tentukan jumlah stok awal jika perlu
        ]);
        return redirect()->route('admin.alat.index');
    }

    public function destroy($id)
    {
        // Temukan asset berdasarkan ID
        $alat = Alat::findOrFail($id);

        // Hapus semua stok terkait dengan asset
        Stock::where('alat_id', $alat->id)->delete();

        // Hapus asset
        $alat->delete();

        // Redirect ke halaman sebelumnya atau ke halaman lain yang diinginkan
        return redirect()->back()->with('success', 'Asset berhasil dihapus beserta data terkait.');
    }

    public function show(Alat $alat)
    {
        return view('admin.alat.show', compact('alat'));
    }

    public function edit(Alat $alat)
    {

        return view('admin.alat.edit', compact('alat'));
    }

    public function update(UpdateAlatRequest $request, Alat $alat)
    {
        $alat->update($request->all());

        return redirect()->route('admin.alat.index');

    }
}
