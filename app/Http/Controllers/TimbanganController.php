<?php

namespace App\Http\Controllers;

use App\Models\Timbangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TimbanganController extends Controller
{
public function halaman(Request $request)
{
    $query = Timbangan::query();

    // FILTER TANGGAL
    if ($request->filled('tanggal')) {
        $query->whereDay('created_at', $request->tanggal);
    }

    // FILTER BULAN
    if ($request->filled('bulan')) {
        $query->whereMonth('created_at', $request->bulan);
    }

    // FILTER TAHUN
    if ($request->filled('tahun')) {
        $query->whereYear('created_at', $request->tahun);
    }

    // Ambil data sesuai filter
    $dataTimbangan = $query
        ->latest()
        ->get();

    // Ambil tahun yang tersedia
    // SQLite menggunakan strftime(), bukan YEAR()
    $tahunTersedia = range(2030, 2020);

    return view('timbangan.index', compact(
        'dataTimbangan',
        'tahunTersedia'
    ));
    }


    // ==========================================
    // AMBIL BERAT DARI WEMOS
    // ==========================================

    public function berat()
    {
        try {

            $response = Http::timeout(3)
                ->get('http://192.168.1.24/berat');

            if ($response->successful()) {

                return response()->json(
                    $response->json()
                );
            }

            return response()->json([
                'success' => false,
                'message' => 'Wemos tidak memberikan response'
            ], 500);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Tidak dapat terhubung ke Wemos',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    // ==========================================
    // SIMPAN DATA TIMBANGAN
    // ==========================================

    public function store(Request $request)
    {
        $request->validate([
            'berat' => 'required|numeric|min:0',
        ]);

        $timbangan = Timbangan::create([
            'berat' => $request->berat,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data timbangan berhasil disimpan',
            'data' => $timbangan
        ], 201);
    }


    // ==========================================
    // API DATA TIMBANGAN
    // ==========================================

    public function index()
    {
        $data = Timbangan::latest()->get();

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function destroy($id)
{
    $timbangan = Timbangan::findOrFail($id);

    $timbangan->delete();

    return redirect('/')->with(
        'success',
        'Data timbangan berhasil dihapus'
    );
}
}