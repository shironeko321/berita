@extends('layout.index')

@section('title', 'Dashboard')
@section('content')
  <x-dashboard-layout article="true">
    <div
      class="container py-2 border rounded my-1 d-inline-flex align-items-center justify-content-between position-sticky top-0 bg-white">
      <h3>Article</h3>
      <a href="/dashboard/article/editor" class="btn btn-primary">Tambah</a>
    </div>
    <div class="container py-2 border rounded my-1 overflow-auto">
      <table class="table table-striped-column">
        <theader>
          <th>no</th>
          <th>title</th>
          <th>slug</th>
          <th>content</th>
          <th>status publish</th>
          <th>action</th>
        </theader>
        <tbody>
          {{-- @forelse ($collection as $item) --}}
          @for ($i = 1; $i <= 3; $i++)
            <tr>
              <td>{{ $i }}</td>
              <td>lorem</td>
              <td>#hello world</td>
              <td>some content</td>
              <td>true</td>
              <td>
                <a href="/dashboard/article/detail/{{ $i }}" class="btn btn-success">Detail</a>
                <a href="/dashboard/article/editor/{{ $i }}" class="btn btn-primary">Ubah</a>

                <button class="btn btn-danger" data-bs-toggle="modal"
                  data-bs-target="#delete{{ $i }}">Hapus</button>
                <div class="modal fade" id="delete{{ $i }}" tabindex="-1">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5">Peringatan</h1>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                      </div>
                      <div class="modal-body">
                        anda yakin ingin hapus item {{ $i }}?
                      </div>
                      <form class="modal-footer">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="id" value="1">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Ya</button>
                      </form>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
          @endfor
          {{-- @empty
            <p>data tidak ada</p>    
          @endforelse --}}
        </tbody>
      </table>
    </div>
  </x-dashboard-layout>
@endsection
