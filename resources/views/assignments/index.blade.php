@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Tugas</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Table Daftar Tugas -->
    <table class="table table-bordered mb-4">
        <thead>
            <tr>
                <th>ID Tugas</th>
                <th>NIP</th>
                <th>Judul Tugas</th>
                <th>Tipe Tugas</th>
                <th>Kuota</th>
                <th>Jumlah Kompen</th>
                <th>Tanggal</th>
                <th>Deskripsi</th>
                <th>Ditutup</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($assignments as $assignment)
                <tr>
                    <td>{{ $assignment->id_tugas }}</td>
                    <td>{{ $assignment->nip }}</td>
                    <td>{{ $assignment->judul_tugas }}</td>
                    <td>{{ $assignment->tipe_tugas }}</td>
                    <td>{{ $assignment->kuota }}</td>
                    <td>{{ $assignment->jumlah_kompen }}</td>
                    <td>{{ \Carbon\Carbon::parse($assignment->date)->format('d/m/Y') }}</td>
                    <td>{{ $assignment->deskripsi }}</td>
                    <td>{{ $assignment->ditutup ? 'Ya' : 'Tidak' }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick="editAssignment({{ json_encode($assignment) }})">Edit</button>
                        <form action="{{ route('assignments.destroy', $assignment->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus tugas ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Form Tambah/Edit Tugas -->
    <h2 id="form-title" class="mb-4">Tambah Tugas Baru</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('assignments.store') }}" method="POST" id="assignment-form">
        @csrf
        <input type="hidden" name="_method" value="POST" id="form-method">
        <input type="hidden" id="assignment-id" name="id">

        <div class="form-group mb-3">
            <label for="id_tugas">ID Tugas</label>
            <input type="number" class="form-control" id="id_tugas" name="id_tugas" required>
        </div>

        <div class="form-group mb-3">
            <label for="nip">NIP</label>
            <input type="number" class="form-control" id="nip" name="nip" required>
        </div>

        <div class="form-group mb-3">
            <label for="judul_tugas">Judul Tugas</label>
            <input type="text" class="form-control" id="judul_tugas" name="judul_tugas" required>
        </div>

        <div class="form-group mb-3">
            <label for="tipe_tugas">Tipe Tugas</label>
            <input type="text" class="form-control" id="tipe_tugas" name="tipe_tugas" required>
        </div>

        <div class="form-group mb-3">
            <label for="kuota">Kuota</label>
            <input type="number" class="form-control" id="kuota" name="kuota" required>
        </div>

        <div class="form-group mb-3">
            <label for="jumlah_kompen">Jumlah Kompen</label>
            <input type="number" class="form-control" id="jumlah_kompen" name="jumlah_kompen" required>
        </div>

        <div class="form-group mb-3">
            <label for="date">Tanggal</label>
            <input type="date" class="form-control" id="date" name="date" required>
        </div>

        <div class="form-group mb-3">
            <label for="deskripsi">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
        </div>

        <div class="form-group mb-3">
            <label for="ditutup">Ditutup</label>
            <select class="form-control" id="ditutup" name="ditutup" required>
                <option value="0">Tidak</option>
                <option value="1">Ya</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary" id="submit-button">Simpan</button>
    </form>
</div>

<script>
    function editAssignment(assignment) {
        // Set form title to 'Edit'
        document.getElementById('form-title').innerText = 'Edit Tugas';

        // Set form action to update route
        document.getElementById('assignment-form').action = `/assignments/${assignment.id}`;
        document.getElementById('form-method').value = 'PUT';

        // Populate form with existing data
        document.getElementById('id_tugas').value = assignment.id_tugas;
        document.getElementById('nip').value = assignment.nip;
        document.getElementById('judul_tugas').value = assignment.judul_tugas;
        document.getElementById('tipe_tugas').value = assignment.tipe_tugas;
        document.getElementById('kuota').value = assignment.kuota;
        document.getElementById('jumlah_kompen').value = assignment.jumlah_kompen;
        document.getElementById('date').value = assignment.date;
        document.getElementById('deskripsi').value = assignment.deskripsi;
        document.getElementById('ditutup').value = assignment.ditutup;

        // Scroll to the form
        window.scrollTo(0, document.getElementById('form-title').offsetTop);
    }
</script>
@endsection
