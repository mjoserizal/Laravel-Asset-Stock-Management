<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Stock;
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
        // Validasi formulir yang sudah dihandle oleh StoreAssetRequest

        // Handle upload gambar
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Simpan gambar ke direktori 'images' dalam direktori public
            $image->move(public_path('images'), $imageName);

            // Simpan path gambar ke dalam database
            $assetData = $request->except('image'); // Ambil semua data kecuali gambar
            $assetData['image_path'] = 'images/' . $imageName;
            $asset = Asset::create($assetData);
        } else {
            // Jika pengguna tidak mengunggah gambar, simpan data tanpa kolom gambar
            $asset = Asset::create($request->all());
        }

        return redirect()->route('admin.assets.index')->with('success', 'Asset berhasil ditambahkan.');
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
        // Validasi formulir yang sudah dihandle oleh UpdateAssetRequest

        $data = $request->all();

        // Handle upload gambar jika ada gambar yang diunggah
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($asset->image_path) {
                File::delete(public_path($asset->image_path));
            }

            // Simpan gambar baru ke direktori 'images' dalam direktori public
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            file_put_contents(public_path('images/' . $imageName), file_get_contents($image));
            $data['image_path'] = 'images/' . $imageName;
        }

        // Perbarui asset dengan data yang sudah disiapkan
        $asset->update($data);

        return redirect()->route('admin.assets.index')->with('success', 'Asset berhasil diperbarui.');
    }


    public function show(Asset $asset)
    {
        abort_if(Gate::denies('asset_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.assets.show', compact('asset'));
    }

    public function destroy($id)
    {
        // Temukan asset berdasarkan ID
        $asset = Asset::findOrFail($id);

        // Hapus semua stok terkait dengan asset
        Stock::where('asset_id', $asset->id)->delete();

        // Hapus asset
        $asset->delete();

        // Redirect ke halaman sebelumnya atau ke halaman lain yang diinginkan
        return redirect()->back()->with('success', 'Asset berhasil dihapus beserta data terkait.');
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
