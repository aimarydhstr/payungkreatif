@extends('layouts.app')

@section('title', 'Konsultasi')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">Konsultasi dengan {{ Auth::user()->role === 'user' ? 'Pakar' : 'User' }}</h3>

    <div class="card shadow-sm">
        <div class="card-body">
            <table id="datatable" class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td width="5%">{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}" class="rounded-circle me-2" width="40" height="40" alt="profile">
                                    <div>
                                        <strong>{{ $user->name }}</strong><br>
                                        <span class="text-muted">{{ $user->email }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a href="{{ Auth::user()->role === 'user' 
                                    ? route('consult-chat.chat', $user->id) 
                                    : route('expert.consult-chat.chat', $user->id) }}" 
                                   class="btn btn-primary">
                                    <i class="bi bi-chat"></i> Chat
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
