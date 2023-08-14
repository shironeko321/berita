@extends('layout.index')

@section('title', 'Dashboard')
@section('content')
  <x-dashboard-layout article="true">
    <div
      class="container py-2 border rounded my-1 d-inline-flex align-items-center justify-content-between position-sticky top-0 bg-white">
      <h3>Article</h3>
      <a href="{{ route('article.create') }}" class="btn btn-primary">Tambah</a>
    </div>
    <div class="container py-2 border rounded my-1 overflow-auto">
      <table class="table table-striped">
        <thead>
          <th>no</th>
          <th>id</th>
          <th>title</th>
          <th>slug</th>
          <th>content</th>
          <th>status published</th>
          <th>user id</th>
          <th>post meta id</th>
          <th>action</th>
        </thead>
        <tbody>
          @forelse ($data as $item)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $item->id }}</td>
              <td>{{ $item->title }}</td>
              <td>{{ $item->slug }}</td>
              <td>{{ $item->content }}</td>
              <td>{{ $item->status_published }}</td>
              <td>{{ $item->user_id }}</td>
              <td>{{ $item->post_meta_id }}</td>
              <td>
                <a href="{{ route('article.show', ['article' => $item->id]) }}" class="btn btn-success">Detail</a>
                <a href="{{ route('article.edit', ['article' => $item->id]) }}" class="btn btn-primary">Ubah</a>

                <button class="btn btn-danger" data-bs-toggle="modal"
                  data-bs-target="#delete{{ $loop->iteration }}">Hapus</button>
                <div class="modal fade" id="delete{{ $loop->iteration }}" tabindex="-1">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5">Peringatan</h1>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                      </div>
                      <div class="modal-body">
                        anda yakin ingin hapus item {{ $loop->iteration }}?
                      </div>
                      <form class="modal-footer" action="{{ route('article.destroy', ['article' => $item->id]) }}"
                        method="POST">
                        @csrf
                        @method('delete')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Ya</button>
                      </form>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="9" class="text-center">
                Data tidak ada
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </x-dashboard-layout>
@endsection
