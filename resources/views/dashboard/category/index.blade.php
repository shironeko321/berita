@extends('layout.index')

@section('title', 'Dashboard')
@section('content')
  <x-dashboard-layout category="true">
    <div class="d-flex flex-column">
      <div
        class="container py-2 border rounded my-1 d-inline-flex align-items-center justify-content-between top-0 bg-white">
        <h3>Category</h3>

        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">Tambah</button>
        <div class="modal fade" id="tambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5">Tambah Category</h1>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              </div>
              <div class="modal-body">
                @include('dashboard.category.new')
              </div>
            </div>
          </div>
        </div>

        <script>
          const modalTambah = document.getElementById("tambah")
          modalTambah.addEventListener("hidden.bs.modal", () => {
            const input = modalTambah.querySelector("#title")
            input.value = ""
          })
        </script>
      </div>

      <div class="container py-2 border rounded my-1 overflow-auto">
        <table class="table table-striped">
          <thead>
            <th>no</th>
            <th>id</th>
            <th>title</th>
            <th>slug</th>
            <th>action</th>
          </thead>
          <tbody>
            @forelse ($data as $item)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->id }}</td>
                <td>{{ $item->title }}</td>
                <td>{{ $item->slug }}</td>
                <td>
                  <div class="d-inline-flex align-items-center gap-2">
                    <button class="btn btn-primary" data-bs-toggle="modal"
                      data-bs-target="#ubah-{{ $item->id }}">Ubah</button>
                    <div class="modal fade" id="ubah-{{ $item->id }}" data-bs-backdrop="static"
                      data-bs-keyboard="false" tabindex="-1">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5">Tambah Category</h1>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                          </div>
                          <div class="modal-body">
                            @include('dashboard.category.edit')
                          </div>
                        </div>
                      </div>
                    </div>

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
                          <form class="modal-footer" action="{{ route('category.destroy', ['category' => $item->id]) }}"
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
                <td colspan="5" class="text-center">
                  Data tidak ada
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </x-dashboard-layout>
@endsection
