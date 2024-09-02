@if(isset($presensi) && is_array($presensi) && isset($presensi['data']) && count($presensi['data']) > 0)
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Mata Kuliah</th>
                <th>Presensi</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody>
            @foreach($presensi['data'] as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item['nama_mata_kuliah'] ?? 'N/A' }}</td>
                    <td>{{ $item['presensi'] ?? 'N/A' }}</td>
                    <td>{{ $item['waktu'] ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <div class="alert alert-warning">
        Tidak ada data presensi tersedia.
    </div>
@endif
