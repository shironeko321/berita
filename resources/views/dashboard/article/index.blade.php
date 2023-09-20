@extends('layout.index')

@section('title', 'Dashboard')
@section('content')
  <x-dashboard-layout article="true">
    <div
      class="container py-2 border rounded my-1 d-inline-flex align-items-center justify-content-between position-sticky top-0 bg-white">
      <h3>Article</h3>
      <a href="{{ route('article.create') }}" class="btn btn-primary">Add</a>
    </div>
    <div class="container py-2 border rounded my-1 overflow-auto">
      <table class="table table-striped">
        <thead>
          <th>#</th>
          <th>Title</th>
          <th>Content</th>
          <th>Status</th>
          <th>Post Meta</th>
          <th>Writer's name</th>
          <th>Action</th>
        </thead>
        <tbody>
          @forelse ($data as $item)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $item->title }}</td>
              <td>{{ Str::substr($item->content, 0, 25) }}</td>
              <td>{{ ($item->status_published == 1 ? 'Published' : 'Not Published') }}</td>
              <td>{{ $item->content_meta }}</td>
              <td>{{ $item->user[0]['first_name'] }} {{ $item->user[0]['last_name'] }}</td>
              <td>
                <a href="{{ route('article.show', ['article' => $item->id]) }}" class="btn btn-success">Details</a>
                <a href="{{ route('article.edit', ['article' => $item->id]) }}" class="btn btn-primary">Edit</a>

                <button class="btn btn-danger" data-bs-toggle="modal"
                  data-bs-target="#delete{{ $loop->iteration }}">Delete</button>
                <div class="modal fade" id="delete{{ $loop->iteration }}" tabindex="-1">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5">Warning</h1>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                      </div>
                      <div class="modal-body">
                        are you sure you want to delete the content? <b>{{ $item->title }}</b>?
                      </div>
                      <form class="modal-footer" action="{{ route('article.destroy', ['article' => $item->id]) }}"
                        method="POST">
                        @csrf
                        @method('delete')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Yes</button>
                      </form>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="9" class="text-center">
                Data is missing
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </x-dashboard-layout>
@endsection
