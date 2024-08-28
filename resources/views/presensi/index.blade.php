@if(isset($presensi) && is_array($presensi) && isset($presensi['data']) && is_array($presensi['data']))
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
                    <td>{{ $index }}</td>
                    <td>{{ $item['nama_mata_kuliah'] }}</td>
                    <td>{{ $item['presensi'] }}</td>
                    <td>{{ $item['waktu'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <div class="alert alert-warning">
        Tidak ada data presensi tersedia.
    </div>
@endif
