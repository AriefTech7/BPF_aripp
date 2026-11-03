<?php

namespace App\Http\Controllers;

use App\Models\Portofolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Tambahkan ini untuk mengelola file gambar

class PortofolioController extends Controller
{
    public function index()
    {
        $porto = Portofolio::all();

        return view('Pages.index', compact('porto'));
    }

    public function create()
    {
        return view('Pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'technology'  => 'required|string',
            'image'       => 'required|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('portofolio', 'public');
        }

        Portofolio::create([
            'title'       => $request->title,
            'description' => $request->description,
            'technology'  => $request->technology,
            'image'       => $imagePath,
        ]);

        return redirect()->route('porto.index')->with('success', 'Data Proyek berhasil ditambahkan!');
    }

    public function show(Portofolio $portofolio)
    {
        // Opsional: Jika Anda ingin membuat halaman detail proyek
        return view('Pages.show', compact('portofolio'));
    }

    public function edit($id)
    {
        // Mencari data berdasarkan ID untuk ditampilkan di form edit
        $portofolio = Portofolio::findOrFail($id);
        return view('Pages.edit', compact('portofolio'));
    }

    public function update(Request $request, $id)
    {
        $portofolio = Portofolio::findOrFail($id);

        // 1. Validasi input (image menjadi 'nullable' karena user mungkin tidak ganti gambar)
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'technology'  => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        // 2. Ambil path gambar lama
        $imagePath = $portofolio->image;

        // 3. Jika user mengupload gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama dari storage jika ada
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            // Simpan gambar baru
            $imagePath = $request->file('image')->store('portofolio', 'public');
        }

        // 4. Update data ke database
        $portofolio->update([
            'title'       => $request->title,
            'description' => $request->description,
            'technology'  => $request->technology,
            'image'       => $imagePath,
        ]);

        return redirect()->route('porto.index')->with('success', 'Data Proyek berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $portofolio = Portofolio::findOrFail($id);

        // Hapus file gambar dari storage sebelum menghapus data dari database
        if ($portofolio->image && Storage::disk('public')->exists($portofolio->image)) {
            Storage::disk('public')->delete($portofolio->image);
        }

        $portofolio->delete();

        return redirect()->route('porto.index')->with('success', 'Data Proyek berhasil dihapus!');
    }
}
