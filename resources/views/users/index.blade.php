@extends('layouts.app')

@section('title', 'User Management')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-4">Manajemen User</h3>
        <button class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#addUserModal">+ Tambah User</button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <table id="datatable" class="table align-middle table-hover">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th width="200px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ ucfirst($user->role) }}</td>
                        <td>
                            @if($user->status == 'active')
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <button 
                                class="btn btn-sm btn-warning editBtn"
                                data-id="{{ $user->id }}"
                                data-name="{{ $user->name }}"
                                data-username="{{ $user->username }}"
                                data-email="{{ $user->email }}"
                                data-role="{{ $user->role }}"
                                data-status="{{ $user->status }}"
                                data-bs-toggle="modal" 
                                data-bs-target="#editUserModal">
                                <i class="bi bi-pencil-square"></i> Edit
                            </button>
                            <button 
                                class="btn btn-sm btn-danger deleteBtn"
                                data-id="{{ $user->id }}"
                                data-bs-toggle="modal" 
                                data-bs-target="#deleteModal">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Add Modal --}}
<div class="modal fade" id="addUserModal" tabindex="-1">
  <div class="modal-dialog">
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3"><label class="form-label">Nama</label><input type="text" class="form-control" name="name" required></div>
                <div class="mb-3"><label class="form-label">Username</label><input type="text" class="form-control" name="username" required></div>
                <div class="mb-3"><label class="form-label">Email</label><input type="email" class="form-control" name="email" required></div>
                <div class="mb-3"><label class="form-label">Password</label><input type="password" class="form-control" name="password" required></div>
                <div class="mb-3"><label class="form-label">Ulangi Password</label><input type="password" class="form-control" name="password_confirmation" required></div>
                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select class="form-control" name="role" required>
                        <option value="" disabled selected>Pilih Role</option>
                        <option value="admin">Admin</option>
                        <option value="expert">Expert</option>
                        <option value="user">User</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select class="form-control" name="status" required>
                        <option value="" disabled selected>Pilih Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button class="btn btn-primary" type="submit">Simpan</button>
            </div>
        </div>
    </form>
  </div>
</div>

{{-- Edit Modal --}}
<div class="modal fade" id="editUserModal" tabindex="-1">
  <div class="modal-dialog">
    <form id="editUserForm" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3"><label class="form-label">Nama</label><input type="text" id="edit_name" class="form-control" name="name" required></div>
                <div class="mb-3"><label class="form-label">Username</label><input type="text" id="edit_username" class="form-control" name="username" required></div>
                <div class="mb-3"><label class="form-label">Email</label><input type="email" id="edit_email" class="form-control" name="email" required></div>
                <div class="mb-3"><label class="form-label">Password (opsional)</label><input type="password" class="form-control" name="password"></div>
                <div class="mb-3"><label class="form-label">Ulangi Password</label><input type="password" class="form-control" name="password_confirmation"></div>
                <div class="mb-3">
                    <label class="form-label">Role</label>
                    <select id="edit_role" class="form-control" name="role" required>
                        <option value="admin">Admin</option>
                        <option value="expert">Expert</option>
                        <option value="user">User</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select id="edit_status" class="form-control" name="status" required>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button class="btn btn-warning" type="submit">Update</button>
            </div>
        </div>
    </form>
  </div>
</div>

{{-- Delete Modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1">
  <div class="modal-dialog">
    <form id="deleteForm" method="POST">
        @csrf @method('DELETE')
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus user ini?</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-danger" type="submit">Hapus</button>
            </div>
        </div>
    </form>
  </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    let updateUrl = "{{ route('users.update', ':id') }}";
    let destroyUrl = "{{ route('users.delete', ':id') }}";

    $('.editBtn').on('click', function() {
        let id = $(this).data('id');
        $('#edit_name').val($(this).data('name'));
        $('#edit_username').val($(this).data('username'));
        $('#edit_email').val($(this).data('email'));
        $('#edit_role').val($(this).data('role'));
        $('#edit_status').val($(this).data('status'));
        $('#editUserForm').attr('action', updateUrl.replace(':id', id));
    });

    $('.deleteBtn').on('click', function() {
        let id = $(this).data('id');
        $('#deleteForm').attr('action', destroyUrl.replace(':id', id));
    });
});
</script>
@endpush
