@extends('layout.dashboard.main')
@section('title', 'Artikel')
@section('name', 'Artikel')
@section('content')
    <div class="row">
        <div class="col-12">
            <a href="{{ route('article.create') }}" class="btn btn-primary mb-3">Tambah</a>
            <div class="card">
                <div class="card-header">
                  <h3>Artikel</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <th>#</th>
                            <th>Title</th>
                            {{-- <th>Content</th> --}}
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
                                    {{-- <td>{{ Str::substr($item->content, 0, 25) }}</td> --}}
                                    <td>{{ $item->status_published == 1 ? 'Published' : 'Not Published' }}</td>
                                    <td>{{ $item->content_meta }}</td>
                                    <td>{{ $item->user[0]['first_name'] }} {{ $item->user[0]['last_name'] }}</td>
                                    <td>
                                        <a href="{{ route('article.show', ['article' => $item->id]) }}"
                                            class="btn btn-info"><i class="fa-solid fa-circle-info"></i> Detail</a>
                                        <a href="{{ route('article.edit', ['article' => $item->id]) }}"
                                            class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i> Edit</a>

                                        <button class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#delete{{ $loop->iteration }}"><i class="fa-solid fa-trash"></i> Delete</button>
                                        <div class="modal fade" id="delete{{ $loop->iteration }}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5">Warning</h1>
                                                        <button class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        are you sure you want to delete the content?
                                                        <b>{{ $item->title }}</b>?
                                                    </div>
                                                    <form class="modal-footer"
                                                        action="{{ route('article.destroy', ['article' => $item->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancel</button>
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
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>

    <div class="modal fade" id="modal-default" data-backdrop="static" data-keyboard="false" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Category</h4>
                    <button type="button" class="close" id="modal1" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('dashboard.tag.new')
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@endsection

@section('script')
    <script>
        let input = document.getElementById('modal1');
        input.addEventListener('click', function() {
            let title = document.getElementById('title');
            title.value = '';
        }, false);
    </script>
@endsection
