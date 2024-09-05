<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Http\Requests\StoreMahasiswaRequest;
use App\Http\Requests\UpdateMahasiswaRequest;
use App\Models\Departement;
use Illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswas = Mahasiswa::all();
        $departements = Departement::all();
        return view('mahasiswas.index', compact('mahasiswas', 'departements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMahasiswaRequest $request)
    {
        // Menyimpan file foto dan mendapatkan path-nya
        $imagePath = $request->photo->store('photos', 'public');
        // Membuat data Mahasiswa baru
        Mahasiswa::create([
            'nim' => $request->nim,
            'name' => $request->name,
            'departement_id' => $request->departement_id,
            'phone' => $request->phone,
            'photo' => $imagePath,
            'email' => $request->email,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('mahasiswas.index')->with('success', 'Mahasiswa created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMahasiswaRequest $request, Mahasiswa $mahasiswa)
    {
        // Jika ada file foto baru di-upload
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($mahasiswa->photo) {
                Storage::disk('public')->delete($mahasiswa->photo);
            }

            // Simpan foto baru dan dapatkan path-nya
            $imagePath = $request->photo->store('photos', 'public');
        } else {
            // Jika tidak ada file baru, gunakan foto lama
            $imagePath = $mahasiswa->photo;
        }

        // Update data Mahasiswa
        $mahasiswa->update([
            'nim' => $request->nim,
            'name' => $request->name,
            'departement_id' => $request->departement_id,
            'phone' => $request->phone,
            'photo' => $imagePath,
            'email' => $request->email,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('mahasiswas.index')->with('success', 'Mahasiswa updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        try {
            // Hapus foto yang terkait dengan mahasiswa jika ada
            if ($mahasiswa->photo) {
                Storage::disk('public')->delete($mahasiswa->photo);
            }

            // Hapus data mahasiswa
            $mahasiswa->delete();

            // Redirect ke halaman index dengan pesan sukses
            return redirect()->route('mahasiswas.index')->with('success', 'Mahasiswa deleted successfully.');
        } catch (\Exception $e) {
            // Tangani jika ada kesalahan saat menghapus data
            return redirect()->route('mahasiswas.index')->with('error', 'Failed to delete mahasiswa: ' . $e->getMessage());
        }
    }
}
