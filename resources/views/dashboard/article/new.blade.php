@extends('layout.index')

@section('title', 'editor')
@section('content')
  <x-dashboard-layout article="true">
    <main class="h-100 container d-flex gap-5">
      <form method="post" action="{{ route('store_article') }}" class="w-75 d-flex flex-column gap-2">
        @csrf
        <div class="w-full d-flex flex-column gap-2 border rounded py-2 px-3">
          <h1>Editor</h1>
          <div class="d-inline-flex align-items-center gap-2">
            <div class="w-100">
              <label for="title" class="form-label">Title</label>
              <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
            </div>
            <div class="w-100">
              <label for="slug" class="form-label">Slug</label>
              <input type="text" class="form-control" name="slug" id="slug" value="{{ old('slug') }}">
            </div>
            <div class="w-100">
              <label class="form-label">Status</label>
              <div class="form-check form-switch">
                <input type="checkbox" class="form-check-input publish" role="switch" name="status_published"
                  id="status_published" value="{{ old('status_published') }}">
                <label for="status_published" class="form-check-label not_publish">Not Published</label>
                <label for="status_published" class="form-check-label published">Published</label>
              </div>
            </div>
          </div>
        </div>
        <textarea id="mytextarea" name="content"></textarea>
        <div class="w-100 d-inline-flex align-items-center justify-content-end gap-2 bg-white border rounded py-2 px-3">
          <div class="d-inline-flex align-items-center gap-2">
            <a href="{{ route('dashboard_article') }}" name="submitbtn" class="btn btn-danger">Batal</a>
            <button type="submit" name="submitbtn" class="btn btn-primary">Simpan</button>
          </div>
        </div>
      </form>

      <div class="d-flex w-25 flex-column gap-2 position-sticky top-0">
        <div class="rounded border py-2 px-3 bg-white overflow-auto">
          <h3 class="border-bottom pb-2">Category</h3>
          <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Asperiores neque architecto tempora velit ad non,
            facere animi impedit nesciunt libero ipsa porro voluptate officiis consectetur? Recusandae ad sequi fuga
            omnis!</p>
        </div>
        <div class="rounded border py-2 px-3 bg-white overflow-auto">
          <h3 class="border-bottom pb-2">Tags</h3>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni, numquam aliquid aut expedita mollitia ipsam
            eaque architecto eos dolorem sed maiores culpa illo ut inventore asperiores ipsa, atque quam doloremque.</p>
        </div>
      </div>

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
          toolbar: 'undo redo save preview | styles fontsize | bold italic underline | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent | link'
        });
      </script>
    </main>
  </x-dashboard-layout>
@endsection
