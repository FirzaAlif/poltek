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
                                        <!-- Generate the URL dynamically for each semester -->
                                        <a href="{{ url('https://tugasakhir:p0l1nema@api.polinema.ac.id/siakad/presensi/absensi/nim/1741727001/thnsem/20172/format/xml ') }}" class="btn btn-secondary btn-sm" target="_blank">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                    <p><strong>Nama:</strong> {{ $profile ? $profile->name : '-' }}</p>
                    <p><strong>Jalur Masuk:</strong> {{ $profile ? $profile->jalur_masuk : '-' }}</p>
                    <p><strong>Angkatan:</strong> {{ $profile ? $profile->angkatan : '-' }}</p>
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
</div>
@endsection
