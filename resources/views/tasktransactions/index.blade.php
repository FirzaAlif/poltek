@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-lg-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Transaksi Tugas</h2>
                <!-- Button to trigger the Add Task Transaction modal -->
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createTaskTransactionModal">
                    Add Task Transaction
                </button>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>ID Tugas</th>
                        <th>NIM</th>
                        <th>Jam Kompen</th>
                        <th>Semester</th>
                        <th>Tanggal Input</th>
                        <th>Tanggal Validasi</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th width="280px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasktransactions as $tasktransaction)
                    <tr>
                        <td>{{ $tasktransaction->id }}</td>
                        <td>{{ $tasktransaction->id_tugas }}</td>
                        <td>{{ $tasktransaction->nim }}</td>
                        <td>{{ $tasktransaction->jam_kompen }}</td>
                        <td>{{ $tasktransaction->semester }}</td>
                        <td>{{ $tasktransaction->tanggal_input }}</td>
                        <td>{{ $tasktransaction->tanggal_validasi }}</td>
                        <td>{{ $tasktransaction->keterangan }}</td>
                        <td>
                            <span class="badge bg-{{ $tasktransaction->status == 'Completed' ? 'success' : 'warning' }}">
                                {{ $tasktransaction->status }}
                            </span>
                        </td>
                        <td>
                            <!-- Edit Button -->
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editTaskTransactionModal-{{ $tasktransaction->id }}">
                                Edit
                            </button>

                            <!-- Delete Button -->
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteTaskTransactionModal-{{ $tasktransaction->id }}">
                                Delete
                            </button>
                        </td>
                    </tr>

                    <!-- Edit Task Transaction Modal -->
                    <div class="modal fade" id="editTaskTransactionModal-{{ $tasktransaction->id }}" tabindex="-1" role="dialog" aria-labelledby="editTaskTransactionModalLabel-{{ $tasktransaction->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editTaskTransactionModalLabel-{{ $tasktransaction->id }}">Edit Task Transaction</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('tasktransactions.update', $tasktransaction->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="id_tugas">ID Tugas</label>
                                            <input type="text" name="id_tugas" value="{{ $tasktransaction->id_tugas }}" class="form-control" placeholder="Enter Task ID">
                                        </div>
                                        <div class="form-group">
                                            <label for="nim">NIM</label>
                                            <input type="text" name="nim" value="{{ $tasktransaction->nim }}" class="form-control" placeholder="Enter NIM">
                                        </div>
                                        <div class="form-group">
                                            <label for="jam_kompen">Jam Kompen</label>
                                            <input type="number" name="jam_kompen" value="{{ $tasktransaction->jam_kompen }}" class="form-control" placeholder="Enter Jam Kompen">
                                        </div>
                                        <div class="form-group">
                                            <label for="semester">Semester</label>
                                            <input type="text" name="semester" value="{{ $tasktransaction->semester }}" class="form-control" placeholder="Enter Semester">
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggal_input">Tanggal Input</label>
                                            <input type="date" name="tanggal_input" value="{{ $tasktransaction->tanggal_input }}" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggal_validasi">Tanggal Validasi</label>
                                            <input type="date" name="tanggal_validasi" value="{{ $tasktransaction->tanggal_validasi }}" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="keterangan">Keterangan</label>
                                            <textarea name="keterangan" class="form-control" placeholder="Enter Description">{{ $tasktransaction->keterangan }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select name="status" class="form-control">
                                                <option value="Pending" {{ $tasktransaction->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="Completed" {{ $tasktransaction->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-success">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Delete Task Transaction Modal -->
                    <div class="modal fade" id="deleteTaskTransactionModal-{{ $tasktransaction->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteTaskTransactionModalLabel-{{ $tasktransaction->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteTaskTransactionModalLabel-{{ $tasktransaction->id }}">Delete Task Transaction</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('tasktransactions.destroy', $tasktransaction->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete the task transaction with ID <strong>{{ $tasktransaction->id }}</strong>?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-danger">Delete</button>
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

<!-- Add Task Transaction Modal -->
<div class="modal fade" id="createTaskTransactionModal" tabindex="-1" role="dialog" aria-labelledby="createTaskTransactionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createTaskTransactionModalLabel">Add Task Transaction</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('tasktransactions.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id_tugas">ID Tugas</label>
                        <input type="text" name="id_tugas" class="form-control" placeholder="Enter Task ID">
                    </div>
                    <div class="form-group">
                        <label for="nim">NIM</label>
                        <input type="text" name="nim" class="form-control" placeholder="Enter NIM">
                    </div>
                    <div class="form-group">
                        <label for="jam_kompen">Jam Kompen</label>
                        <input type="number" name="jam_kompen" class="form-control" placeholder="Enter Jam Kompen">
                    </div>
                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <input type="text" name="semester" class="form-control" placeholder="Enter Semester">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_input">Tanggal Input</label>
                        <input type="date" name="tanggal_input" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_validasi">Tanggal Validasi</label>
                        <input type="date" name="tanggal_validasi" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan" class="form-control" placeholder="Enter Description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" class="form-control">
                            <option value="Pending">Pending</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
