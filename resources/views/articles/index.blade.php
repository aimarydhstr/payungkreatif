@extends('layouts.app')

@section('title', 'Manajemen Artikel')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Manajemen Artikel</h3>
        <a href="{{ route('articles.create') }}" class="btn btn-primary">+ Tambah Data</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <table id="datatable" class="table align-middle table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Penulis</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($articles as $article)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $article->title }}</td>
                        <td>{{ $article->category->name ?? '-' }}</td>
                        <td>{{ $article->author->display_name ?? '-' }}</td>
                        <td>
                            <span class="badge bg-{{ $article->status == 'published' ? 'success' : 'secondary' }}">
                                {{ ucfirst($article->status) }}
                            </span>
                        </td>
                        <td width="160px">
                            <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i> Edit</a>
                                
                            <button 
                                class="btn btn-danger btn-sm deleteBtn" 
                                data-id="{{ $article->id }}"
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
    let destroyUrl = "{{ route('articles.delete', ':id') }}";

    // Delete Modal
    $('.deleteBtn').on('click', function() {
        let id = $(this).data('id');
        let finalUrl = destroyUrl.replace(':id', id);
        $('#deleteForm').attr('action', finalUrl);
    });
});
</script>
@endpush
