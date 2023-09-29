@extends('layout.index')

@section('title', 'Dashboard')
@section('content')
  <x-dashboard-layout media="true">
    <div class="container border rounded">
      <div
        class="container py-2 border rounded my-1 d-inline-flex align-items-center justify-content-between top-0 bg-white">
        <h3>Media</h3>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">New</button>
        <div class="modal fade" id="tambah" data-bs-backdrop="static" data-bs-keyboard="false"
          tabindex="-1">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5">Add Media</h1>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
              </div>
              <div class="modal-body">
                @include('dashboard.media.new')
              </div>
            </div>
          </div>
        </div>
      </div>
      <div id="my-gallery">
        <div class="pswp-gallery pswp-gallery--single-column" id="gallery--getting-started">
          @foreach ($collection as $item)
            <a href="{{ asset($item) }}" data-pswp-width="750" data-pswp-height="500"
              target="_blank">
              <img src="{{ asset($item) }}" width="300" height="250" alt="gak ada" />
            </a>
          @endforeach
        </div>
      </div>
    </div>
  </x-dashboard-layout>
  @vite('resources/js/media.js')
@endsection
