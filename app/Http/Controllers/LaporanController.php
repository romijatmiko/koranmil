<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laporan = Laporan::where('status', 'pending')->get();
    
    // Mengirimkan data laporan ke view
    return view('list-laporan-pending', compact('laporan'));
    }

    public function laporanDitolak()
    {
        // Mendapatkan daftar laporan dengan status 'ditolak'
        $laporanDitolak = Laporan::where('status', 'ditolak')->get();
    
        // Mengirimkan data laporan ditolak ke view
        return view('list-laporan-rejected', compact('laporanDitolak'));
    }

    /**
     * Display a listing of the resource.
     */
    public function laporanDiterima()
    {
        // Mendapatkan daftar laporan dengan status 'diterima'
        $laporanDiterima = Laporan::where('status', 'accepted')->get();
    
        // Mengirimkan data laporan diterima ke view
        return view('list-laporan-accepted', compact('laporanDiterima'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('laporan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validasi input data
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'isi' => 'required|string',
                
                'img' => 'required|string|max:255',
                'distrik' => 'required|string|max:255',
            ]);

            // Simpan data ke database
            Laporan::create($validatedData);

            return redirect()->route('dashboard')->with('success', 'Laporan berhasil ditambahkan');
        } catch (\Exception $e) {
            // Tangkap kesalahan dan catat ke log
            Log::error('Error while storing laporan: ' . $e->getMessage());

            // Redirect kembali ke halaman sebelumnya dengan pesan kesalahan
            return redirect()->back()->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $laporan = Laporan::find($id);

        if (!$laporan) {
            return redirect()->route('edit-laporan')->with('error', 'Data laporan tidak ditemukan.');
        }

        return view('edit-laporan', compact('laporan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Laporan $laporan)
{
    try {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'isi' => 'required|string',
            'img' => 'required|string',
            'status' => 'required|string',
            'distrik' => 'required|string',
        ]);

        $laporan->update($validatedData);

        // Tambahkan pesan log untuk memeriksa apakah fungsi update terpanggil
        Log::info('Laporan berhasil diperbarui: ' . $laporan->id);

        return redirect()->route('list-laporan')->with('success', 'Laporan berhasil diperbarui.');
    } catch (\Exception $e) {
        // Tangkap kesalahan dan catat ke log
        Log::error('Error while updating laporan: ' . $e->getMessage());

        // Redirect kembali ke halaman sebelumnya dengan pesan kesalahan
        return redirect()->back()->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Laporan $laporan)
    {
        $laporan->delete();

        return redirect()->route('list-laporan')->with('success', 'Laporan berhasil dihapus.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Laporan $laporan)
    {
        return view('laporan.show', compact('laporan'));
    }
}
