<form class="d-flex flex-column mx-auto" method="POST" action="{{ route('tags.update', ['tag' => $item->id]) }}">
  @csrf
  @method('put')
  <div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" class="form-control" name="title" id="title" value="{{ $item->title }}">
  </div>
  <button type="submit" class="btn btn-primary">Ubah</button>
</form>
</div>
