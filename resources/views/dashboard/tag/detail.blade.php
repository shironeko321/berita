@extends('layout.index')

@section('title', 'Dashboard')
@section('content')
  <x-dashboard-layout tags="true">
    <div class="container py-2 border rounded my-1">
      <h1 class="text-center">Detail Tag</h1>
      <div class="w-50 d-flex flex-column mx-auto">
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" class="form-control" name="title" id="title" value="{{ $data->title }}" disabled>
        </div>
        <div class="mb-3">
          <label for="slug" class="form-label">Slug</label>
          <input type="text" class="form-control" name="slug" id="slug" value="{{ $data->slug }}" disabled>
        </div>
        <a class="btn btn-primary" href="{{ route('tags.edit', ['tag' => $id]) }}">Edit</a>
      </div>
    </div>
  </x-dashboard-layout>
@endsection
