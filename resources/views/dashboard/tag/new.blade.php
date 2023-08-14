@extends('layout.index')

@section('title', 'Dashboard')
@section('content')
  <x-dashboard-layout tags="true">
    <div class="container py-2 border rounded my-1">
      <h1 class="text-center">Tambah Tag</h1>
      <form class="w-50 d-flex flex-column mx-auto" method="POST" action="{{ route('tags.store') }}">
        @csrf
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
        </div>
        <div class="mb-3">
          <label for="slug" class="form-label">Slug</label>
          <input type="text" class="form-control" name="slug" id="slug" value="{{ old('slug') }}">
        </div>
        <button type="submit" class="btn btn-primary">Tambah</button>
      </form>
    </div>
  </x-dashboard-layout>
@endsection
