@extends('layout.index')

@section('title', 'Dashboard')
@section('content')
  <x-dashboard-layout2 users="true">
    <div class="container py-2 border rounded my-1">
      <h1 class="text-center">Edit User</h1>
      <form class="d-flex flex-column mx-auto" method="POST"
        action="{{ route('users.update', ['user' => $id]) }}">
        @csrf
        @method('put')
        <div class="row mb-3">
          <div class="col">
            <label for="firstname" class="form-label">First Name</label>
            <input type="text" class="form-control" id="firstname" value="{{ $data->first_name }}"
              disabled>
          </div>
          <div class="col">
            <label for="lastname" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="lastname" value="{{ $data->last_name }}"
              disabled>
          </div>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" value="{{ $data->email }}"
            disabled>
        </div>
        <div class="mb-3">
          <label for="status" class="form-label">Status</label>
          <input type="number" @class(['form-control', 'is-invalid' => $errors->has('status')]) name="status" id="status"
            value="{{ $data->status }}">
          @error('status')
            <span class="invalid-feedback">{{ $message }}</span>
          @enderror
        </div>
        <div class="mb-3">
          <label for="access" class="form-label">Access</label>
          <input type="number" @class(['form-control', 'is-invalid' => $errors->has('access')]) name="access" id="access"
            value="{{ $data->hak_akses }}">
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
        <button type="submit" class="btn btn-primary">Change</button>
      </form>
    </div>
  </x-dashboard-layout2>
@endsection
