@extends('layout.index')

@section('title', 'editor')
@section('content')
  <x-dashboard-layout article="true">
    <main class="h-100 container">
      <form method="post" action="{{ route('article.update', ['article' => $article->id]) }}"
        class="d-flex gap-5">
        @method('put')
        @csrf
        <div class="mh-100 w-75 d-flex flex-column gap-2 position-relative">
          <div class="rounded border py-2 px-3 bg-white">
            <h3>Editor</h3>
          </div>
          <textarea id="mytextarea" name="content">{{ $article->content }}</textarea>
          <div
            class="w-100 d-inline-flex align-items-center justify-content-end gap-2 bg-white border rounded py-2 px-3">
            <div class="d-inline-flex align-items-center gap-2">
              <a href="{{ route('article.index') }}" name="submitbtn"
                class="btn btn-danger">Cancel</a>
              <button type="submit" name="submitbtn" class="btn btn-success">Save</button>
            </div>
          </div>
        </div>
        <div class="d-flex w-25 flex-column gap-2 rounded border p-2 bg-white overflow-auto">
          <div class="nav nav-pills border-bottom pb-2" role="tablist">
            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#nav-article"
              type="button" role="tab">Article</button>
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#nav-category"
              type="button" role="tab">Category</button>
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#nav-tags" type="button"
              role="tab">Tags</button>
          </div>

          <div class="tab-content" id="navtabContent">
            <div class="tab-pane fade show active" id="nav-article" role="tabpanel" tabindex="0">
              <div class="d-flex flex-column gap-2">
                <div class="w-100">
                  <label for="title" class="form-label">Title</label>
                  <input type="text" class="form-control" name="title" id="title"
                    value="{{ $article->title }}">
                </div>
                <div class="w-100">
                  <label class="form-label">Status</label>
                  <div class="form-check form-switch">
                    <input type="checkbox" class="form-check-input publish" role="switch"
                      name="status_published" id="status_published" @checked($article->status_published)>
                    <label for="status_published" class="form-check-label not_publish">Not
                      Published</label>
                    <label for="status_published" class="form-check-label published">Published</label>
                  </div>
                </div>
                <div class="w-100">
                  <label for="content_meta" class="form-label">Content Meta</label>
                  <textarea class="form-control" id="content_meta" rows="3" name="content_meta">
                    {{ $article->content_meta }}
                  </textarea>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="nav-category" role="tabpanel" tabindex="0">
              <div class="d-flex flex-wrap gap-2">
                @forelse ($category as $item)
                  <input class="btn-check" type="checkbox" name="category[]"
                    id="category-{{ $item->id }}" value="{{ $item->id }}"
                    {{ in_array($item->id, $a_category) ? 'checked' : '' }}>
                  <label class="btn btn-outline-primary"
                    for="category-{{ $item->id }}">{{ $item->title }}</label>
                @empty
                  <p>Category does not exist</p>
                @endforelse
              </div>
            </div>
            <div class="tab-pane fade" id="nav-tags" role="tabpanel" tabindex="0">
              <div class="d-flex flex-wrap gap-2">
                @forelse ($tag as $item)
                  <input class="btn-check" type="checkbox" name="tags[]"
                    id="tag-{{ $item->id }}" value="{{ $item->id }}"
                    {{ in_array($item->id, $a_tag) ? 'checked' : '' }}>
                  <label class="btn btn-outline-primary"
                    for="tag-{{ $item->id }}">{{ $item->title }}</label>
                @empty
                  <p>Tag does not exist</p>
                @endforelse
              </div>
            </div>
          </div>
        </div>
      </form>

      @pushOnce('style')
        <style>
          .tox-promotion {
            display: none
          }

          .publish~.published {
            display: none;
          }

          .publish~.not_publish {
            display: inline-block;
          }

          .publish:checked~.published {
            display: inline-block;
          }

          .publish:checked~.not_publish {
            display: none;
          }
        </style>
      @endPushOnce
      @pushOnce('script')
        <script src="{{ asset('tinymce/js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
      @endPushOnce
      <script>
        tinymce.init({
          selector: '#mytextarea',
          statusbar: false,
          toolbar_sticky: true,
          plugins: 'link lists save preview',
          toolbar: 'undo redo save preview | styles fontsize | bold italic underline | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent | link',
          height: 450
        });
      </script>
    </main>
  </x-dashboard-layout>
@endsection
