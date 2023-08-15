<form class="d-flex flex-column mx-auto" method="POST" action="{{ route('tags.store') }}">
  @csrf
  <div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
  </div>
  <button type="submit" class="btn btn-primary">Tambah</button>
</form>
</div>
