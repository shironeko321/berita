@extends('layout.index')

@section('title', 'Dashboard')
@section('content')
  <x-dashboard-layout2 category="true">
    <div class="d-flex flex-column">
      <div
        class="container py-2 border rounded my-1 d-inline-flex align-items-center justify-content-between top-0 bg-white">
        <h3>Category</h3>

        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">New</button>
        <div class="modal fade" id="tambah" data-bs-backdrop="static" data-bs-keyboard="false"
          tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5">Add Category</h1>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
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
            <th>#</th>
            <th>Title</th>
            <th>Slug</th>
            <th>Action</th>
          </thead>
          <tbody>
            @forelse ($data as $item)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->title }}</td>
                <td>{{ $item->slug }}</td>
                <td>
                  <div class="d-inline-flex align-items-center gap-2">
                    <button class="btn btn-primary" data-bs-toggle="modal"
                      data-bs-target="#ubah-{{ $item->id }}">Edit</button>
                    <div class="modal fade" id="ubah-{{ $item->id }}" data-bs-backdrop="static"
                      data-bs-keyboard="false" tabindex="-1">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5">Edit Category
                            </h1>
                            <button type="button" class="btn btn-danger"
                              data-bs-dismiss="modal">Cancel</button>
                          </div>
                          <div class="modal-body">
                            @include('dashboard.category.edit')
                          </div>
                        </div>
                      </div>
                    </div>

                    <button class="btn btn-danger" data-bs-toggle="modal"
                      data-bs-target="#delete{{ $loop->iteration }}">Delete</button>
                    <div class="modal fade" id="delete{{ $loop->iteration }}" tabindex="-1">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5">Alert</h1>
                            <button class="btn-close" data-bs-dismiss="modal"></button>
                          </div>
                          <div class="modal-body">
                            are you sure you want to delete the item?
                          </div>
                          <form class="modal-footer"
                            action="{{ route('category.destroy', ['category' => $item->id]) }}"
                            method="POST">
                            @csrf
                            @method('delete')
                            <button type="button" class="btn btn-danger"
                              data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Yes</button>
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
  </x-dashboard-layout2>
@endsection
