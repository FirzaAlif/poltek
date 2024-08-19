@extends('layouts.app')

@section('content')

<div class="container">
        <div class="row mb-3">
            <div class="col-lg-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>Data Prodi</h2>
                    <!-- Tombol Tambah Prodi -->
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createMajorModal">
                        Tambah Prodi
                    </button>
                </div>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Prodi</th>
                            <th>Jurusan</th>
                            <th width="280px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($majors as $major)

                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $major->name }}</td>
                                <td>{{ $major->departements->name}}</td>
                                
                                <td>
                                    <!-- Tombol Edit -->
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#editMajorModal-{{ $major->id }}">
                                        Edit
                                    </button>

                                    <!-- Tombol Hapus -->
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#deleteMajorModal-{{ $major->id }}">
                                        Hapus
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal Edit Prodi -->
                            <div class="modal fade" id="editMajorModal-{{ $major->id }}" tabindex="-1"
                                role="dialog" aria-labelledby="editMajorModalLabel-{{ $major->id }}"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editMajorModalLabel-{{ $major->id }}">Edit Prodi</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('majors.update', $major->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="name">Nama Prodi</label>
                                                    <input type="text" name="name" value="{{ $major->name }}"
                                                        class="form-control" placeholder="Masukkan Nama Prodi">
                                                </div>
                                                <div class="form-group">
                                                    <label for="departement_id">Jurusan</label>
                                                    <select name="departement_id" class="form-control">
                                                        @foreach ($departements as $departement)
                                                            <option value="{{ $departement->id }}"
                                                                {{ $major->departement_id == $departement->id ? 'selected' : '' }}>
                                                                {{ $departement->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-success">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Hapus Prodi -->
                            <div class="modal fade" id="deleteMajorModal-{{ $major->id }}" tabindex="-1"
                                role="dialog" aria-labelledby="deleteMajorModalLabel-{{ $major->id }}"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteMajorModalLabel-{{ $major->id }}">
                                                Hapus Prodi</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('majors.destroy', $major->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-body">
                                                <p>Apakah Anda yakin ingin menghapus prodi
                                                    <strong>{{ $major->name }}</strong>?
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Batal</button>
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

    <!-- Modal Tambah Prodi -->
    <div class="modal fade" id="createMajorModal" tabindex="-1" role="dialog"
        aria-labelledby="createMajorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createMajorModalLabel">Tambah Prodi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('majors.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nama Prodi</label>
                            <input type="text" name="name" class="form-control" placeholder="Masukkan Nama Prodi">
                        </div>
                        <div class="form-group">
                            <label for="departement_id">Jurusan</label>
                            <select name="departement_id" class="form-control">
                                @foreach ($departements as $departement)
                                    <option value="{{ $departement->id }}">
                                        {{ $departement->name }}
                                    </option>
                                @endforeach
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
