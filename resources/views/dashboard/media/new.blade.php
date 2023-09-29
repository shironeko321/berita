<form action="{{ route('media.store') }}" method="post" enctype="multipart/form-data">
  @csrf
  <div class="mb-3">
    <label for="formFile" class="form-label">Image</label>
    <input type="file" class="form-control" name="image" id="image">
  </div>
  <button type="submit" class="btn btn-primary">Upload</button>
</form>
