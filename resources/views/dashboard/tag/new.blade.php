<form class="d-flex flex-column mx-auto" method="POST" action="{{ route('tags.store') }}">
  @csrf
  <div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" class="form-control" name="title" id="title"
      value="{{ old('title') }}" placeholder="Nama Tag" required>
  </div>
  <button type="submit" class="btn btn-success">Simpan</button>
</form>
