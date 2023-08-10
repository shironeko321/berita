@extends('layout.index')

@section('title', 'editor')
@section('content')
  <main class="container my-3">
    <form method="post">
      <div class="w-100 d-inline-flex align-items-center justify-content-between gap-2 position-sticky">
        <h1>Editor</h1>
        <div class="d-inline-flex align-items-center gap-2">
          <a href="/dashboard/article" name="submitbtn" class="btn btn-danger">Batal</a>
          <button type="submit" name="submitbtn" class="btn btn-primary">Simpan</button>
        </div>
      </div>
      @csrf
      <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
      </div>
      <div class="mb-3">
        <label for="slug" class="form-label">Slug</label>
        <input type="text" class="form-control" name="slug" id="slug" value="{{ old('slug') }}">
      </div>
      <div class="mb-3 form-check form-switch">
        <input type="checkbox" class="form-check-input" role="switch" name="status_published" id="status_published"
          value="{{ old('status_published') }}">
        <label for="status_published" class="form-check-label">Status Published</label>
      </div>
      <textarea id="mytextarea" name="content"></textarea>
    </form>

    <script src="{{ asset('tinymce/js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
    <script>
      tinymce.init({
        selector: '#mytextarea',
        statusbar: false,
        plugins: 'link lists save preview',
        toolbar: 'undo redo save preview | styles fontsize | bold italic underline | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent | link'
      });
    </script>

    <style>
      .tox-promotion {
        display: none
      }
    </style>
  </main>
@endsection
