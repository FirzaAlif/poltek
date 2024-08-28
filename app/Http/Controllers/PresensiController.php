<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class PresensiController extends Controller
{
    public function fetchPresensi()
    {
        $client = new Client();

        // URL dan credential untuk otentikasi dasar
        $url = 'http://api.polinema.ac.id/siakad/presensi/absensi/nim/1741727001/thnsem/20172/format/xml';
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

            // Mengirim data ke view Blade
            return view('your_view', [
                'presensi' => [
                    'data' => $data, // Pastikan $dataArray adalah array
                ]
            ]);
            

        } catch (\Exception $e) {
            // Menangani error jika terjadi
            return view('presensi.index', ['error' => $e->getMessage()]);
        }
    }
}

?>