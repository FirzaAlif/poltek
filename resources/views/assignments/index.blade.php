@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-lg-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Daftar Tugas</h2>
                <!-- Button to trigger the Add Assignment modal -->
                 @hasrole('super_admin|admin')
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createAssignmentModal">
                    Tambah Tugas
                </button>
                @endhasrole
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover">
                <thead class="thead-light">
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
                        <th width="280px">Actions</th>
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
                        <td>
                            <span class="badge bg-{{ $assignment->ditutup ? 'danger' : 'success' }}">
                                {{ $assignment->ditutup ? 'Ditutup' : 'Aktif' }}
                            </span>
                        </td>
                        <td>
                            @hasrole ('super_admin|admin')
                            <!-- Edit Button -->
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editAssignmentModal-{{ $assignment->id }}">
                                Edit
                            </button>

                            <!-- Delete Button -->
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteAssignmentModal-{{ $assignment->id }}">
                                Hapus
                            </button>
                            @endhasrole
                        </td>
                    </tr>

                    <!-- Edit Assignment Modal -->
                    <div class="modal fade" id="editAssignmentModal-{{ $assignment->id }}" tabindex="-1" role="dialog" aria-labelledby="editAssignmentModalLabel-{{ $assignment->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editAssignmentModalLabel-{{ $assignment->id }}">Edit Tugas</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('assignments.update', $assignment->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="id_tugas">ID Tugas</label>
                                            <input type="text" name="id_tugas" value="{{ $assignment->id_tugas }}" class="form-control" placeholder="Enter Task ID">
                                        </div>
                                        <div class="form-group">
                                            <label for="nip">NIP</label>
                                            <input type="text" name="nip" value="{{ $assignment->nip }}" class="form-control" placeholder="Enter NIP">
                                        </div>
                                        <div class="form-group">
                                            <label for="judul_tugas">Judul Tugas</label>
                                            <input type="text" name="judul_tugas" value="{{ $assignment->judul_tugas }}" class="form-control" placeholder="Enter Task Title">
                                        </div>
                                        <div class="form-group">
                                            <label for="tipe_tugas">Tipe Tugas</label>
                                            <input type="text" name="tipe_tugas" value="{{ $assignment->tipe_tugas }}" class="form-control" placeholder="Enter Task Type">
                                        </div>
                                        <div class="form-group">
                                            <label for="kuota">Kuota</label>
                                            <input type="number" name="kuota" value="{{ $assignment->kuota }}" class="form-control" placeholder="Enter Quota">
                                        </div>
                                        <div class="form-group">
                                            <label for="jumlah_kompen">Jumlah Kompen</label>
                                            <input type="number" name="jumlah_kompen" value="{{ $assignment->jumlah_kompen }}" class="form-control" placeholder="Enter Compensation Hours">
                                        </div>
                                        <div class="form-group">
                                            <label for="date">Tanggal</label>
                                            <input type="date" name="date" value="{{ $assignment->date }}" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="deskripsi">Deskripsi</label>
                                            <textarea name="deskripsi" class="form-control" placeholder="Enter Description">{{ $assignment->deskripsi }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="ditutup">Ditutup</label>
                                            <select name="ditutup" class="form-control">
                                                <option value="0" {{ !$assignment->ditutup ? 'selected' : '' }}>Tidak</option>
                                                <option value="1" {{ $assignment->ditutup ? 'selected' : '' }}>Ya</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Delete Assignment Modal -->
                    <div class="modal fade" id="deleteAssignmentModal-{{ $assignment->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteAssignmentModalLabel-{{ $assignment->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteAssignmentModalLabel-{{ $assignment->id }}">Hapus Tugas</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('assignments.destroy', $assignment->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-body">
                                        <p>Apakah Anda yakin ingin menghapus tugas dengan ID <strong>{{ $assignment->id_tugas }}</strong>?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Assignment Modal -->
<div class="modal fade" id="createAssignmentModal" tabindex="-1" role="dialog" aria-labelledby="createAssignmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createAssignmentModalLabel">Tambah Tugas Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('assignments.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id_tugas">ID Tugas</label>
                        <input type="text" name="id_tugas" class="form-control" placeholder="Enter Task ID">
                    </div>
                    <div class="form-group">
                        <label for="nip">NIP</label>
                        <input type="text" name="nip" class="form-control" placeholder="Enter NIP">
                    </div>
                    <div class="form-group">
                        <label for="judul_tugas">Judul Tugas</label>
                        <input type="text" name="judul_tugas" class="form-control" placeholder="Enter Task Title">
                    </div>
                    <div class="form-group">
                        <label for="tipe_tugas">Tipe Tugas</label>
                        <input type="text" name="tipe_tugas" class="form-control" placeholder="Enter Task Type">
                    </div>
                    <div class="form-group">
                        <label for="kuota">Kuota</label>
                        <input type="number" name="kuota" class="form-control" placeholder="Enter Quota">
                    </div>
                    <div class="form-group">
                        <label for="jumlah_kompen">Jumlah Kompen</label>
                        <input type="number" name="jumlah_kompen" class="form-control" placeholder="Enter Compensation Hours">
                    </div>
                    <div class="form-group">
                        <label for="date">Tanggal</label>
                        <input type="date" name="date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" placeholder="Enter Description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="ditutup">Ditutup</label>
                        <select name="ditutup" class="form-control">
                            <option value="0">Tidak</option>
                            <option value="1">Ya</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
