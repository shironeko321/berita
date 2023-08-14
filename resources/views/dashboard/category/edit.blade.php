@extends('layout.index')

@section('title', 'Dashboard')
@section('content')
  <x-dashboard-layout category="true">
    <div class="container py-2 border rounded my-1">
      <h1 class="text-center">Ubah Category</h1>
      <form class="w-50 d-flex flex-column mx-auto" method="POST"
        action="{{ route('category.update', ['category' => $id]) }}">
        @csrf
        @method('put')
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" class="form-control" name="title" id="title" value="{{ $data->title }}">
        </div>
        <div class="mb-3">
          <label for="slug" class="form-label">Slug</label>
          <input type="text" class="form-control" name="slug" id="slug" value="{{ $data->slug }}">
        </div>
        <button type="submit" class="btn btn-primary">Ubah</button>
      </form>
    </div>
  </x-dashboard-layout>
@endsection
