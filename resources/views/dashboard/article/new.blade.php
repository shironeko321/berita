@extends('layout.index')

@section('title', 'editor')
@section('content')
  <x-dashboard-layout article="true">
    <main class="h-100 container">
      <form method="post" action="{{ route('article.store') }}" class="d-flex gap-5">
        @csrf
        <div class="mh-100 w-75 d-flex flex-column gap-2 position-relative">
          <div class="rounded border py-2 px-3 bg-white">
            <h3>Tambah Artikel</h3>
          </div>
          <textarea id="mytextarea" name="content"></textarea>
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
                    value="{{ old('title') }}">
                </div>
                <div class="w-100">
                  <label class="form-label">Status</label>
                  <div class="form-check form-switch">
                    <input type="checkbox" class="form-check-input publish" role="switch"
                      name="status_published" id="status_published"
                      value="{{ old('status_published') }}" name="status_published">
                    <label for="status_published" class="form-check-label not_publish">Not
                      Published</label>
                    <label for="status_published" class="form-check-label published">Published</label>
                  </div>
                </div>
                <div class="w-100">
                  <label for="content_meta" class="form-label">Content Meta</label>
                  <textarea class="form-control" id="content_meta" rows="3" name="content_meta">
                    {{ old('content_meta') }}
                  </textarea>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="nav-category" role="tabpanel" tabindex="0">
              <div class="d-flex flex-wrap gap-2">
                @forelse ($category as $item)
                  <input class="btn-check" type="checkbox" name="category[]"
                    id="category-{{ $item->id }}" value="{{ $item->id }}">
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
                  <input class="btn-check" type="checkbox" name="tags[]" id="tag-{{ $item->id }}"
                    value="{{ $item->id }}">
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
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="{{ asset('tinymce/js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
        @endPushOnce
        <script>
          const example_image_upload_handler = (blobInfo, progress) => new Promise((resolve, reject) => {
    const xhr = new XMLHttpRequest();
    xhr.withCredentials = false;
    xhr.open('POST', '{{ route('upload.image.media') }}');
    xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    // xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  
    xhr.upload.onprogress = (e) => {
      progress(e.loaded / e.total * 100);
    };
  
    xhr.onload = () => {
      if (xhr.status === 403) {
        reject({ message: 'HTTP Error: ' + xhr.status, remove: true });
        return;
      }
  
      if (xhr.status < 200 || xhr.status >= 300) {
        reject('HTTP Error: ' + xhr.status);
        return;
      }
  
      const json = JSON.parse(xhr.responseText);
  
      if (!json || typeof json.location != 'string') {
        reject('Invalid JSON: ' + xhr.responseText);
        return;
      }
  
      resolve(json.location);
    };
  
    xhr.onerror = () => {
      reject('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
    };
  
    const formData = new FormData();
    formData.append('image', blobInfo.blob(), blobInfo.filename());
  
    xhr.send(formData);
  });
          tinymce.init({
            selector: 'textarea',
            toolbar_sticky: true,
            statusbar: false,
            plugins: 'link lists preview image code',
            toolbar: 'undo redo preview | styles fontsize | bold italic underline | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent | link image | code',
            height: 500,
            image_title: true,
            automatic_uploads: true,
            file_picker_types: 'image',
            images_upload_handler: example_image_upload_handler
          });
          </script>
    </main>
  </x-dashboard-layout>
@endsection
