@extends('layouts.app')

@section('title', 'Ubah Artikel')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="">Ubah Artikel</h3>
        <button type="submit" class="btn btn-primary" form="editArticle">Simpan Artikel</button>
    </div>

    <form id="editArticle" action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="d-flex justify-content-between align-items-start gap-4 mb-4">
            <div class="card shadow-sm border-0 rounded-3 w-75">
                <div class="card-body">
                    <div class="mb-3">
                        <label>Judul Artikel</label>
                        <input type="text" name="title" value="{{ old('title', $article->title) }}" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Isi Artikel</label>
                        <textarea name="body" id="editor" class="form-control ckeditor">{{ old('body', $article->body) }}</textarea>
                    </div>

                </div>
            </div>

            <div class="card shadow-sm border-0 rounded-3 w-25">
                <div class="card-body">
                    <div class="mb-3">
                        <label>Gambar Pratinjau</label>
                        @if($article->thumbnail_url)
                        <hr>
                            <div class="my-2">
                                <img class="w-100 mb-2" src="{{ asset('storage/uploads/' . $article->thumbnail) }}" alt="Thumbnail" width="150" class="rounded">
                            </div>
                        @endif
                        <input type="file" name="thumbnail" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Kategori</label><hr>
                        <select name="category_id" class="form-control select2" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $id => $name)
                                <option value="{{ $id }}" {{ old('category_id', $article->category_id) == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Tag</label><hr>
                        <select name="tags[]" class="form-control select2" multiple>
                            @foreach($tags as $id => $name)
                                <option value="{{ $id }}" 
                                    {{ in_array($id, old('tags', $article->tags->pluck('id')->toArray())) ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Status</label><hr>
                        <select name="status" class="form-control">
                            <option value="draft" {{ old('status', $article->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status', $article->status) == 'published' ? 'selected' : '' }}>Published</option>
                        </select>
                    </div>
                </div>        
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
    <!-- CKEditor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
    <script>
        class MyUploadAdapter {
            constructor(loader) {
                this.loader = loader;
            }

            upload() {
                return this.loader.file
                    .then(file => new Promise((resolve, reject) => {
                        const data = new FormData();
                        data.append('upload', file);

                        fetch("{{ route('ckeditor.upload') }}", {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: data
                        })
                        .then(response => response.json())
                        .then(result => {
                            resolve({ default: result.url });
                        })
                        .catch(err => reject(err));
                    }));
            }
            abort() {}
        }

        function MyCustomUploadAdapterPlugin(editor) {
            editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                return new MyUploadAdapter(loader);
            };
        }

        ClassicEditor.create(document.querySelector('#editor'), {
            extraPlugins: [MyCustomUploadAdapterPlugin],
        }).catch(error => {
            console.error(error);
        });
    </script>

    <!-- Select2 -->
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endpush
