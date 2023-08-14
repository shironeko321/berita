@extends('layout.index')

@section('title', 'Dashboard')
@section('content')
  <x-dashboard-layout users="true">
    <div
      class="container py-2 border rounded my-1 d-inline-flex align-items-center justify-content-between position-sticky top-0 bg-white">
      <h3>Users</h3>
      <a href="{{ route('users.create') }}" class="btn btn-primary">Tambah</a>
    </div>

    <div class="container py-2 border rounded my-1 overflow-auto">
      <table class="table table-striped">
        <thead>
          <th>no</th>
          <th>id</th>
          <th>nama depan</th>
          <th>nama belakang</th>
          <th>email</th>
          <th>password</th>
          <th>status</th>
          <th>hak akses</th>
          <th>action</th>
        </thead>
        <tbody>
          @forelse ($data as $item)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $item->id }}</td>
              <td>{{ $item->first_name }}</td>
              <td>{{ $item->last_name }}</td>
              <td>{{ $item->email }}</td>
              <td>{{ $item->password }}</td>
              <td>{{ $item->status }}</td>
              <td>{{ $item->hak_akses }}</td>
              <td>
                <div class="d-inline-flex align-items-center gap-2">
                  <a href="{{ route('users.show', ['user' => $item->id]) }}" class="btn btn-success">Detail</a>
                  <a href="{{ route('users.edit', ['user' => $item->id]) }}" class="btn btn-primary">Ubah</a>

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
                          anda yakin ingin hapus item {{ $item->id }}?
                        </div>
                        <form class="modal-footer" action="{{ route('users.destroy', ['user' => $item->id]) }}"
                          method="POST">
                          @csrf
                          @method('delete')
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                          <button type="submit" class="btn btn-primary">Ya</button>
                        </form>
                      </div>
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
