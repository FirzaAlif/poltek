@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- Data Kompen Siakad -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Data Kompen Siakad
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Semester</th>
                                <th>Lihat Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 1; $i <= 8; $i++)
                                <tr>
                                <td>Semester {{ $i }}</td>
                                <td>
                                    @php
                                    // Set tahun awal
                                    $tahun_awal = 20171;

                                    // Set perubahan tahun setiap 2 semesters
                                    $tahun = $tahun_awal + intdiv($i - 1, 2) * 10;

                                    // Jika semester adalah semester ganjil (1, 3, 5, 7), tambahkan 1 untuk mendapatkan 20172, 20182, dst.
                                    if (($i - 1) % 2 == 1) {
                                    $tahun += 1;
                                    }
                                    @endphp
                                    <!-- Generate the URL dynamically for each semester -->
                                    <a href="http://tugasakhir:p0l1nema@api.polinema.ac.id/siakad/presensi/absensi/nim/{{ $user->nim }}/thnsem/{{ $tahun }}/format/xml" class="btn btn-secondary btn-sm" target="_blank">
                                        Detail
                                    </a>
                                </td>
                                </tr>
                                @endfor
                        </tbody>
                    </table>
                    <p><strong>Nama:</strong> {{ $user ? $user->name : '-' }}</p>
                    <p><strong>Nim:</strong> {{ $user ? $user->nim : '-' }}</p>
                    <p><strong>Email:</strong> {{ $user ? $user->email : '-' }}</p>
                </div>
            </div>
        </div>

        <!-- Data Kompen Sistem -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-info text-white">
                    Data Kompen Sistem
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Total Kompen</th>
                                <th>Belum terkompen</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kompenSistem as $item)
                            <tr>
                                <td>{{ $item['kompen'] }} x {{ $loop->iteration }} = {{ $item['result'] }}</td>
                                <td>{{ $item['result'] }}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td><strong>Total</strong></td>
                                <td><strong>{{ array_sum(array_column($kompenSistem, 'result')) }}</strong></td>
                            </tr>
                            <tr>
                                <td><strong>Telah Kompen</strong></td>
                                <td><strong>{{ $totalAbsensi }}</strong></td>
                            </tr>
                            <tr>
                                <td><strong>Yang harus dikerjakan</strong></td>
                                <td><strong>{{ array_sum(array_column($kompenSistem, 'result')) - $totalAbsensi }}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    
    
    
    @if(isset($data) && isset($data->status) && $data->status == 'data valid')
    <table>
        <thead>
            <tr>
                <th>NIM</th>
                <th>Nama</th>
                <th>Jam Alpha</th>
                <th>Menit Alpha</th>
                <th>Jam Ijin</th>
                <th>Menit Ijin</th>
                <th>Jam Sakit</th>
                <th>Menit Sakit</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $data->data->nim }}</td>
                <td>{{ $data->data->nama }}</td>
                <td>{{ $data->data->JamAlpa }}</td>
                <td>{{ $data->data->MenitAlpa }}</td>
                <td>{{ $data->data->JamIjin }}</td>
                <td>{{ $data->data->MenitIjin }}</td>
                <td>{{ $data->data->JamSakit }}</td>
                <td>{{ $data->data->MenitSakit }}</td>
            </tr>
        </tbody>
    </table>
    @else
    <p>Data presensi tidak ditemukan atau tidak valid.</p>
    @endif
</div>
@endsection