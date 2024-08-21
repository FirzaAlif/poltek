@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-lg-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h2>Data Mahasiswa</h2>
                    <!-- Tombol Tambah Mahasiswa -->
                     @hasrole('super_admin|admin')
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createMahasiswaModal">
                        Tambah Mahasiswa
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
                            <th>Foto</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Jurusan</th>
                            <th>Telepon</th>
                            <th>Email</th>
                            <th width="280px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mahasiswas as $mahasiswa)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $mahasiswa->photo) }}" alt="{{ $mahasiswa->name }}"
                                        width="50">
                                </td>
                                <td>{{ $mahasiswa->nim }}</td>
                                <td>{{ $mahasiswa->name }}</td>
                                <td>{{ $mahasiswa->departements->name }}</td>
                                <!-- Asumsikan relasi Eloquent sudah diatur -->
                                <td>{{ $mahasiswa->phone }}</td>
                                <td>{{ $mahasiswa->email }}</td>
                                @hasrole('super_admin|admin')
                                <td>
                                    <!-- Tombol Edit -->

                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#editMahasiswaModal-{{ $mahasiswa->id }}">
                                        Edit
                                    </button>

                                    <!-- Tombol Hapus -->
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#deleteMahasiswaModal-{{ $mahasiswa->id }}">
                                        Hapus
                                    </button>
                                </td>
                                @endhasrole
                            </tr>

                            <!-- Modal Edit Mahasiswa -->
                            <div class="modal fade" id="editMahasiswaModal-{{ $mahasiswa->id }}" tabindex="-1"
                                role="dialog" aria-labelledby="editMahasiswaModalLabel-{{ $mahasiswa->id }}"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editMahasiswaModalLabel-{{ $mahasiswa->id }}">Edit
                                                Mahasiswa</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('mahasiswas.update', $mahasiswa->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="nim">NIM</label>
                                                    <input type="text" name="nim" value="{{ $mahasiswa->nim }}"
                                                        class="form-control" placeholder="Masukkan NIM">
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Nama</label>
                                                    <input type="text" name="name" value="{{ $mahasiswa->name }}"
                                                        class="form-control" placeholder="Masukkan Nama Mahasiswa">
                                                </div>
                                                <div class="form-group">
                                                    <label for="departement_id">Jurusan</label>
                                                    <select name="departement_id" class="form-control">
                                                        @forelse ($departements as $departement)
                                                            <option value="{{ $departement->id }}"
                                                                {{ $mahasiswa->departement_id == $departement->id ? 'selected' : '' }}>
                                                                {{ $departement->name }}
                                                            </option>
                                                        @empty
                                                            <option value="">Jurusan Tidak Ditemukan</option>
                                                        @endforelse
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="phone">Telepon</label>
                                                    <input type="text" name="phone" value="{{ $mahasiswa->phone }}"
                                                        class="form-control" placeholder="Masukkan No. Telepon">
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" name="email" value="{{ $mahasiswa->email }}"
                                                        class="form-control" placeholder="Masukkan Email">
                                                </div>
                                                <div class="form-group">
                                                    <label for="photo">Foto</label>
                                                    <input type="file" name="photo" class="form-control">
                                                    <small class="text-muted">Kosongkan jika tidak ingin mengganti
                                                        foto</small>
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

                            <!-- Modal Hapus Mahasiswa -->
                            <div class="modal fade" id="deleteMahasiswaModal-{{ $mahasiswa->id }}" tabindex="-1"
                                role="dialog" aria-labelledby="deleteMahasiswaModalLabel-{{ $mahasiswa->id }}"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteMahasiswaModalLabel-{{ $mahasiswa->id }}">
                                                Hapus Mahasiswa</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('mahasiswas.destroy', $mahasiswa->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-body">
                                                <p>Apakah Anda yakin ingin menghapus mahasiswa
                                                    <strong>{{ $mahasiswa->name }}</strong>?
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

    <!-- Modal Tambah Mahasiswa -->
    <div class="modal fade" id="createMahasiswaModal" tabindex="-1" role="dialog"
        aria-labelledby="createMahasiswaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createMahasiswaModalLabel">Tambah Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('mahasiswas.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nim">NIM</label>
                            <input type="text" name="nim" class="form-control" placeholder="Masukkan NIM">
                        </div>
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" name="name" class="form-control"
                                placeholder="Masukkan Nama Mahasiswa">
                        </div>
                        <div class="form-group">
                            <label for="departement_id">Jurusan</label>
                            <select name="departement_id" class="form-control">
                                @forelse ($departements as $departement)
                                    <option value="{{ $departement->id }}">
                                        {{ $departement->code }}-{{ $departement->name }}</option>
                                @empty
                                    <option value="">Jurusan Tidak Ditemukan</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="phone">Telepon</label>
                            <input type="text" name="phone" class="form-control"
                                placeholder="Masukkan No. Telepon">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Masukkan Email">
                        </div>
                        <div class="form-group">
                            <label for="photo">Foto</label>
                            <input type="file" name="photo" class="form-control">
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
