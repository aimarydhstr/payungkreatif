@extends('layouts.app')

@section('title', 'Tag')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center">
        <h3 class="mb-4">Manajemen Tag</h3>
        <button class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#addTagModal">+ Tambah Data</button>
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
                        <th>Slug</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tags as $tag)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $tag->name }}</td>
                        <td>{{ $tag->slug }}</td>
                        <td width="160px">
                            <button 
                                class="btn btn-sm btn-warning editBtn"
                                data-id="{{ $tag->id }}"
                                data-name="{{ $tag->name }}"
                                data-slug="{{ $tag->slug }}"
                                data-bs-toggle="modal" 
                                data-bs-target="#editTagModal">
                                <i class="bi bi-pencil-square"></i> Edit
                            </button>
                            <button 
                                class="btn btn-danger btn-sm deleteBtn" 
                                data-id="{{ $tag->id }}"
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
<div class="modal fade" id="addTagModal" tabindex="-1" aria-labelledby="addTagModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('tags.store') }}" method="POST">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTagModalLabel">Tambah Tag</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
  </div>
</div>

{{-- Edit Modal --}}
<div class="modal fade" id="editTagModal" tabindex="-1" aria-labelledby="editTagModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="editTagForm" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTagModalLabel">Ubah Tag</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="edit_name" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="edit_name" name="name" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-warning">Update</button>
            </div>
        </div>
    </form>
  </div>
</div>

{{-- Delete Modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="deleteForm" method="POST">
        @csrf @method('DELETE')
        <div class="modal-header">
          <h5 class="modal-title">Konfirmasi Hapus</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p>Apakah Anda yakin ingin menghapus data ini?</p>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button class="btn btn-danger">Hapus</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    let updateUrl = "{{ route('tags.update', ':id') }}";
    let destroyUrl = "{{ route('tags.delete', ':id') }}";

    // Edit Modal
    $('.editBtn').on('click', function() {
        let id = $(this).data('id');
        let name = $(this).data('name');

        $('#edit_name').val(name);
        let finalUrl = updateUrl.replace(':id', id);
        $('#editTagForm').attr('action', finalUrl);
    });

    // Delete Modal
    $('.deleteBtn').on('click', function() {
        let id = $(this).data('id');
        let finalUrl = destroyUrl.replace(':id', id);
        $('#deleteForm').attr('action', finalUrl);
    });
});
</script>
@endpush
