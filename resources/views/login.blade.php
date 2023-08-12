@extends('layout.index')

@section('title', 'Login')
@section('content')
  <div class="vh-100 d-flex justify-content-center align-items-center">
    <form action="{{ route('auth_login') }}" method="POST" style="width: 280px" class="d-flex flex-column px-3 py-4 shadow">
      @csrf
      <h1 class="text-center">Login</h1>
      @error('error')
        <span class="h-4 text-danger text-center">{{ $errors->first('error') }}</span>
      @enderror
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" id="password">
      </div>
      <button type="submit" class="btn btn-primary">Masuk</button>
    </form>
  </div>
@endsection
