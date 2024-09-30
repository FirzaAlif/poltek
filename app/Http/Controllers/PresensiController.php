<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use App\Models\Presensi;

class PresensiController extends Controller
{
    public function index()
    {
        // Ambil data user yang sedang login
        $user = Auth::user();

        $nim = $user->nim;

        // Ambil profil pengguna jika ada relasi
        $profile = $user->profile ?? null;

        // Ambil data presensi dari database
        $presensiData = Presensi::all(); // Mengambil semua data presensi

        // Perhitungan Data Kompen Sistem
        $totalAbsensi = $presensiData->sum('JamAlpa'); // Misalnya, jam alfa dianggap sebagai absensi
        $dataKompenSistem = $this->calculateKompenSistem($totalAbsensi);

        return view('presensi.index', [
            'presensi' => [
                'data' => $presensiData, // Data diambil dari database
            ],
            'user' => $user,
            'profile' => $profile,
            'kompenSistem' => $dataKompenSistem,
            'totalAbsensi' => $totalAbsensi,
        ]);
    }

    // Fungsi untuk menghitung Data Kompen Sistem
    private function calculateKompenSistem($totalAbsensi)
    {
        $kompenData = [];
        $currentValue = 2;

        for ($i = 1; $i <= $totalAbsensi; $i++) {
            $kompenData[] = [
                'kompen' => $currentValue,
                'result' => $currentValue * $i,
            ];
            $currentValue *= 2; // Kelipatan dua
        }

        return $kompenData;
    }

    public function fetchPresensi()
    {
        $client = new Client();
        $user = Auth::user()->nim;

        // URL dan credential untuk otentikasi dasar
        $url = 'http://api.polinema.ac.id/siakad/presensi/absensi/nim/{{$user}}/thnsem/20172/format/xml';
        $username = 'tugasakhir';
        $password = 'p0l1nema';

        try {
            // Mengirim request GET dengan otentikasi dasar
            $response = $client->request('GET', $url, [
                'auth' => [$username, $password], // Otentikasi dasar
                'headers' => [
                    'Accept' => 'application/xml', // Menerima respon dalam format XML
                ]
            ]);

            // Mengambil isi respon sebagai string
            $body = $response->getBody()->getContents();

            // Mengurai XML menjadi array
            $xml = simplexml_load_string($body);
            $json = json_encode($xml);
            $data = json_decode($json, true);

            // Ambil data presensi
            $presensiData = [];
            if (isset($data['record'])) {
                $presensiData = is_array($data['record']) ? $data['record'] : [$data['record']];
            }

            // Simpan data presensi ke database
            foreach ($presensiData as $presensi) {
                Presensi::create([
                    'nim' => $presensi['nim'],
                    'nama' => $presensi['nama'],
                    'JamAlpa' => $presensi['jam_alfa'],
                    'MenitAlpa' => $presensi['menit_alfa'],
                    'JamIjin' => $presensi['jam_ijin'],
                    'MenitIjin' => $presensi['menit_ijin'],
                    'JamSakit' => $presensi['jam_sakit'],
                    'MenitSakit' => $presensi['menit_sakit'],
                ]);
            }

            // Redirect kembali ke halaman index
            return redirect()->route('presensi.index');

        } catch (\Exception $e) {
            // Menangani error jika terjadi
            return view('presensi.index', ['error' => $e->getMessage()]);
        }
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'JamAlpa' => 'required|numeric',
            'MenitAlpa' => 'required|numeric',
            'JamIjin' => 'required|numeric',
            'MenitIjin' => 'required|numeric',
            'JamSakit' => 'required|numeric',
            'MenitSakit' => 'required|numeric',
        ]);

        // Simpan data ke database
        Presensi::create($request->all());

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('presensi.index')->with('success', 'Data presensi berhasil disimpan.');
    }
}

