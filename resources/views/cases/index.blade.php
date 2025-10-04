@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Daftar Case</h2>
        <!-- Tombol buka modal -->
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createCaseModal">
            Tambah Case
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($cases->count())
        <table id="datatable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Judul Case</th>
                    <th>Status</th>
                    <th>Tanggal Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cases as $index => $case)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $case->title }}</td>
                        <td>
                            <span class="badge bg-{{ $case->status === 'open' ? 'success' : 'secondary' }}">
                                {{ ucfirst($case->status) }}
                            </span>
                        </td>
                        <td>{{ $case->created_at->format('d M Y') }}</td>
                        <td>
                            <a href="{{ route('chats.index', $case->id) }}" class="btn btn-sm btn-primary">
                                <i class="bi bi-chat me-1"></i> Chat
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-info">Belum ada case. Buat case baru untuk memulai percakapan.</div>
    @endif

</div>

<!-- Modal Create Case -->
<div class="modal fade" id="createCaseModal" tabindex="-1" aria-labelledby="createCaseModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('cases.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createCaseModalLabel">Buat Case Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="caseTitle" class="form-label">Judul Case</label>
                        <input type="text" name="title" id="caseTitle" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Buat Case</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
