<?php

namespace App\Http\Controllers;

use App\Asset;
// use Barryvdh\DomPDF\PDF;
use Barryvdh\DomPDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExportController extends Controller
{
    //
    // public function index()
    // {
    //     $assets = Asset::with('jenisObat')->get();

    //     return view('admin.assets.index', compact('assets'));
    //     // return view('landingPage', compact('assets'));
    // }

    public function exportPdf()
    {
        $assets = Asset::with('jenisObat')->get();
        $pdf = app('dompdf.wrapper');

        $pdf->loadView('assets_pdf', compact('assets'));

        return $pdf->download('laporan.pdf');
    }
}
