<form class="d-flex flex-column mx-auto" method="POST" action="{{ route('category.store') }}">
  @csrf
  <div class="mb-3">
    <label for="title" class="form-label">Nama Category</label>
    <input type="text" class="form-control" name="title" id="title"
      value="{{ old('title') }}" placeholder="Nama Category" required>
  </div>
  <button type="submit" class="btn btn-success">Tambah</button>
</form>
