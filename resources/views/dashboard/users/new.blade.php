@extends('layout.index')

@section('title', 'Dashboard')
@section('content')
  <x-dashboard-layout users="true">
    <div class="container py-2 border rounded my-1">
      <h1 class="text-center">Tambah Pengguna</h1>
      <form class="w-50 d-flex flex-column mx-auto" method="POST" action="{{ route('users.store') }}">
        @csrf
        <div class="row mb-3">
          <div class="col">
            <label for="firstname" class="form-label">Nama Depan</label>
            <input type="text" @class(['form-control', 'is-invalid' => $errors->has('firstname')]) name="firstname" id="firstname"
              value="{{ old('firstname') }}">
            @error('firstname')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>
          <div class="col">
            <label for="lastname" class="form-label">Nama Belakang</label>
            <input type="text" @class(['form-control', 'is-invalid' => $errors->has('lastname')]) name="lastname" id="lastname"
              value="{{ old('lastname') }}">
            @error('lastname')
              <span class="invalid-feedback">{{ $message }}</span>
            @enderror
          </div>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" @class(['form-control', 'is-invalid' => $errors->has('email')]) name="email" id="email" value="{{ old('email') }}">
          @error('email')
            <span class="invalid-feedback">{{ $message }}</span>
          @enderror
        </div>
        <div class="mb-3">
          <label for="status" class="form-label">Status</label>
          <input type="number" @class(['form-control', 'is-invalid' => $errors->has('status')]) name="status" id="status" value="{{ old('status') }}">
          @error('status')
            <span class="invalid-feedback">{{ $message }}</span>
          @enderror
        </div>
        <div class="mb-3">
          <label for="access" class="form-label">Access</label>
          <input type="number" @class(['form-control', 'is-invalid' => $errors->has('access')]) name="access" id="access" value="{{ old('access') }}">
          @error('access')
            <span class="invalid-feedback">{{ $message }}</span>
          @enderror
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" @class(['form-control', 'is-invalid' => $errors->has('password')]) name="password" id="password">
          @error('password')
            <span class="invalid-feedback">{{ $message }}</span>
          @enderror
        </div>
        <button type="submit" class="btn btn-primary">Tambah</button>
      </form>
    </div>
  </x-dashboard-layout>
@endsection
