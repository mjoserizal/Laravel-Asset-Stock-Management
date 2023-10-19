<?php

namespace App\Http\Controllers\Admin;

use App\Asset;
use App\Disposable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDisposableRequest;
use App\Http\Requests\UpdateAssetRequest;
use App\Http\Requests\UpdateDisposableRequest;
use App\JenisObat;
use App\Stock;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

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

    public function show(Disposable $disposable)
    {
        return view('admin.disposable.show', compact('disposable'));
    }

    public function edit(Disposable $disposable)
    {

        return view('admin.disposable.edit', compact('disposable'));
    }

    public function update(UpdateDisposableRequest $request, Disposable $disposable)
    {
        $disposable->update($request->all());

        return redirect()->route('admin.disposable.index');

    }

    public function destroy($id)
    {
        // Temukan asset berdasarkan ID
        $disposable = Disposable::findOrFail($id);

        // Hapus semua stok terkait dengan asset
        Stock::where('disposable_id', $disposable->id)->delete();

        // Hapus asset
        $disposable->delete();

        // Redirect ke halaman sebelumnya atau ke halaman lain yang diinginkan
        return redirect()->back()->with('success', 'Asset berhasil dihapus beserta data terkait.');
    }
}
