@extends('layout.index')

@section('title', 'Dashboard')
@section('content')
  <x-dashboard-layout users="true">
    <div class="container py-2 border rounded my-1">
      <h1 class="text-center">Ubah Pengguna</h1>
      <form class="w-50 d-flex flex-column mx-auto" method="POST" action="{{ route('users.update', ['user' => $id]) }}">
        @csrf
        @method('put')
        <div class="row mb-3">
          <div class="col">
            <label for="firstname" class="form-label">Nama Depan</label>
            <input type="text" class="form-control" id="firstname" value="{{ $data->first_name }}" disabled>
          </div>
          <div class="col">
            <label for="lastname" class="form-label">Nama Belakang</label>
            <input type="text" class="form-control" id="lastname" value="{{ $data->last_name }}" disabled>
          </div>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" value="{{ $data->email }}" disabled>
        </div>
        <div class="mb-3">
          <label for="status" class="form-label">Status</label>
          <input type="number" class="form-control" name="status" value="{{ $data->status }}" id="status">
        </div>
        <div class="mb-3">
          <label for="access" class="form-label">Access</label>
          <input type="number" class="form-control" name="access" value="{{ $data->hak_akses }}" id="access">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" name="password" id="password">
        </div>
        <button type="submit" class="btn btn-primary">Ubah</button>
      </form>
    </div>
  </x-dashboard-layout>
@endsection
