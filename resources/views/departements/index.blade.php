@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-lg-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>Data Jurusan</h2>
                    <!-- Tombol Tambah Jurusan -->
                    @hasrole('super_admin')
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createDepartmentModal">
                            Tambah Jurusan
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
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th width="280px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($departements as $departement)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $departement->code }}</td>
                                <td>{{ $departement->name }}</td>
                                <td>
                                    <!-- Tombol Edit -->
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#editDepartmentModal-{{ $departement->id }}">
                                        Edit
                                    </button>

                                    <!-- Tombol Hapus -->
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#deleteDepartmentModal-{{ $departement->id }}">
                                        Hapus
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal Edit Jurusan -->
                            <div class="modal fade" id="editDepartmentModal-{{ $departement->id }}" tabindex="-1"
                                role="dialog" aria-labelledby="editDepartmentModalLabel-{{ $departement->id }}"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editDepartmentModalLabel-{{ $departement->id }}">
                                                Edit Jurusan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('departements.update', $departement->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="code">Kode</label>
                                                    <input type="text" name="code" value="{{ $departement->code }}"
                                                        class="form-control" placeholder="Masukkan Kode Jurusan">
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Nama</label>
                                                    <input type="text" name="name" value="{{ $departement->name }}"
                                                        class="form-control" placeholder="Masukkan Nama Jurusan">
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

                            <!-- Modal Hapus Jurusan -->
                            <div class="modal fade" id="deleteDepartmentModal-{{ $departement->id }}" tabindex="-1"
                                role="dialog" aria-labelledby="deleteDepartmentModalLabel-{{ $departement->id }}"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteDepartmentModalLabel-{{ $departement->id }}">
                                                Hapus Jurusan</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('departements.destroy', $departement->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-body">
                                                <p>Apakah Anda yakin ingin menghapus jurusan
                                                    <strong>{{ $departement->name }}</strong>?</p>
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

    <!-- Modal Tambah Jurusan -->
    <div class="modal fade" id="createDepartmentModal" tabindex="-1" role="dialog"
        aria-labelledby="createDepartmentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    @hasrole('super_admin')
                        <h5 class="modal-title" id="createDepartmentModalLabel">Tambah Jurusan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    @endhasrole
                </div>
                <form action="{{ route('departements.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="code">Kode</label>
                            <input type="text" name="code" class="form-control"
                                placeholder="Masukkan Kode Jurusan">
                        </div>
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" name="name" class="form-control"
                                placeholder="Masukkan Nama Jurusan">
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
