@extends('layouts.app')

@section('title', 'Knowledge Base')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center">    
        <h3 class="mb-4">Knowledge Base</h3>
        <button class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#createModal">+ Tambah Data</button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif


    <div class="card shadow-sm">
        <div class="card-body">
            <table id="datatable" class="table align-middle table-hover">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Pertanyaan</th>
                        <th>Jawaban</th>
                        <th>Sumber</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ Str::limit($item->question, 60) }}</td>
                            <td>{{ Str::limit($item->answer, 60) }}</td>
                            <td>{{ $item->sources ?? '-' }}</td>
                            <td width="160px">
                                <button class="btn btn-warning btn-sm editBtn" 
                                        data-id="{{ $item->id }}"
                                        data-question="{{ $item->question }}"
                                        data-answer="{{ $item->answer }}"
                                        data-sources="{{ $item->sources }}"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editModal"><i class="bi bi-pencil-square"></i> Edit</button>
                                <button class="btn btn-danger btn-sm deleteBtn" 
                                        data-id="{{ $item->id }}"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#deleteModal"><i class="bi bi-trash"></i> Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Create -->
<div class="modal fade" id="createModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ Auth::user()->role === 'admin' ? route('knowledge-bases.store') : route('expert.knowledge-bases.store') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Tambah Data</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label>Pertanyaan</label>
                <textarea name="question" class="form-control" rows="2" required></textarea>
            </div>
            <div class="mb-3">
                <label>Jawaban</label>
                <textarea name="answer" class="form-control" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label>Sumber</label>
                <input type="text" name="sources" class="form-control">
            </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button class="btn btn-success">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="editForm" method="POST">
        @csrf @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title">Edit Data</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label>Pertanyaan</label>
                <textarea name="question" id="editQuestion" class="form-control" rows="2" required></textarea>
            </div>
            <div class="mb-3">
                <label>Jawaban</label>
                <textarea name="answer" id="editAnswer" class="form-control" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label>Sumber</label>
                <input type="text" name="sources" id="editSources" class="form-control">
            </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button class="btn btn-success">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Delete -->
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
    $(function () {
        const role = "{{ Auth::user()->role }}"; 
        let updateRoute = "";
        let destroyRoute = "";

        if (role === "admin") {
            updateRoute = "{{ route('knowledge-bases.update', ':id') }}";
            destroyRoute = "{{ route('knowledge-bases.destroy', ':id') }}";
        } else if (role === "expert") {
            updateRoute = "{{ route('expert.knowledge-bases.update', ':id') }}";
            destroyRoute = "{{ route('expert.knowledge-bases.destroy', ':id') }}";
        }

        // Edit Modal
        $(document).on('click', '.editBtn', function () {
            let id = $(this).data('id');
            let url = updateRoute.replace(':id', id);

            $('#editForm').attr('action', url);
            $('#editQuestion').val($(this).data('question'));
            $('#editAnswer').val($(this).data('answer'));
            $('#editSources').val($(this).data('sources'));
        });

        // Event Delegation untuk Delete
        $(document).on('click', '.deleteBtn', function () {
            let id = $(this).data('id');
            let url = destroyRoute.replace(':id', id);

            $('#deleteForm').attr('action', url);
        });
    });
</script>

@endpush