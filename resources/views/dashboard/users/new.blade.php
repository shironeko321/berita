@extends('layout.index')

@section('title', 'Dashboard')
@section('content')
  <x-dashboard-layout users="true">
    <div class="container py-2 border rounded my-1">
      <h1 class="text-center">Tambah Pengguna</h1>
      <form class="w-50 d-flex flex-column mx-auto" method="POST" action="{{ route('store_user') }}">
        @csrf
        <div class="row mb-3">
          <div class="col">
            <label for="firstname" class="form-label">Nama Depan</label>
            <input type="text" class="form-control" name="firstname" id="firstname" value="{{ old('firstname') }}">
          </div>
          <div class="col">
            <label for="lastname" class="form-label">Nama Belakang</label>
            <input type="text" class="form-control" name="lastname" id="lastname" value="{{ old('lastname') }}">
          </div>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
        </div>
        <div class="mb-3">
          <label for="status" class="form-label">Status</label>
          <input type="number" class="form-control" name="status" id="status" value="{{ old('status') }}">
        </div>
        <div class="mb-3">
          <label for="access" class="form-label">Access</label>
          <input type="number" class="form-control" name="access" id="access" value="{{ old('access') }}">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" name="password" id="password">
        </div>
        @error('email')
          <span>{{ $error->email }}</span>
        @enderror
        <button type="submit" class="btn btn-primary">Tambah</button>
      </form>
    </div>
  </x-dashboard-layout>
@endsection
