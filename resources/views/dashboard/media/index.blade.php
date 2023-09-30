@extends('layout.index')

@section('title', 'Dashboard')
@section('content')
  <x-dashboard-layout media="true">
    <div class="container">
      <div
        class="container py-2 border rounded my-1 d-inline-flex align-items-center justify-content-between top-0 bg-white">
        <h3>Media</h3>
        {{-- <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">New</button>
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
        </div> --}}
      </div>
<<<<<<< HEAD
      <div id="my-gallery">
        <div class="pswp-gallery pswp-gallery--single-column row gap-3" id="gallery--getting-started">
          @foreach ($collection as $item)
            <a href="{{ URL::asset("/images/$item->media_name") }}" class="col-2" data-pswp-width="750" data-pswp-height="500"
              target="_blank">
              <img src="{{ URL::asset("/images/$item->media_name") }}" class="w-100" style="height: 250" />
=======
      <div class="container border rounded py-2 my-1" id="my-gallery">
        <div class="pswp-gallery pswp-gallery--single-column row" id="gallery--getting-started">
          @foreach ($collection as $item)
            <a href="{{ asset($item) }}" class="col-3 overflow-hidden" style="height: 300px"
              data-pswp-width="750" data-pswp-height="500" target="_blank">
              <img src="{{ asset($item) }}" class="w-100" alt="gak ada" />
>>>>>>> 12cc508902a931dda119074ab39d84d7970cb9a5
            </a>
            <form action="#" method="post">
              @csrf
              @method('PUT')
              <button class="btn btn-danger btn-sm">Delete</button>
            </form>
          @endforeach
        </div>
      </div>
    </div>
  </x-dashboard-layout>
  @vite('resources/js/media.js')
@endsection
