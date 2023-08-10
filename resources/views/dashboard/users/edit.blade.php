@extends('layout.index')

@section('title', 'Dashboard')
@section('content')
  <x-dashboard-layout users="true">
    <div class="container py-2 border rounded my-1">
      <h1>Edit Pengguna</h1>
      <form class="d-flex flex-column" method="POST">
        @method('put')
        @csrf
        <div class="mb-3">
          <label for="firstname" class="form-label">Nama Depan</label>
          <input type="text" class="form-control" name="firstname" id="firstname">
        </div>
        <div class="mb-3">
          <label for="lastname" class="form-label">Nama Belakang</label>
          <input type="text" class="form-control" name="lastname" id="lastname">
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" name="email" id="email">
        </div>
        <div class="mb-3">
          <label for="status" class="form-label">Status</label>
          <input type="number" class="form-control" name="status" id="status">
        </div>
        <div class="mb-3">
          <label for="access" class="form-label">Access</label>
          <input type="number" class="form-control" name="access" id="access">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" name="password" id="password">
        </div>
        <button type="submit" class="btn btn-primary">Edit</button>
      </form>
    </div>
  </x-dashboard-layout>
@endsection
