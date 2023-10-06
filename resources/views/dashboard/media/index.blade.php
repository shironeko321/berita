@extends('layout.index')

@section('title', 'Dashboard')
@section('content')
    <x-dashboard-layout2 media="true">
        <div class="container">
            <div
                class="container py-2 border rounded my-1 d-inline-flex align-items-center justify-content-between top-0 bg-white">
                <h3>Media</h3>
            </div>
            <div id="my-gallery">
                <div class="pswp-gallery pswp-gallery--single-column row gap-3" id="gallery--getting-started">
                    @foreach ($collection as $item)
                        <a href="{{ URL::asset("/images/$item->media_name") }}" class="col-2" data-pswp-width="750"
                            data-pswp-height="500" target="_blank">
                            <img src="{{ URL::asset("/images/$item->media_name") }}" class="w-100" style="height: 250" />
                            <div class="container border rounded py-2 my-1" id="my-gallery">
                                <div class="pswp-gallery pswp-gallery--single-column row" id="gallery--getting-started">
                                    <form action="#" method="post">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </div>
                            </div>
                    @endforeach
                </div>
            </div>
        </div>
    </x-dashboard-layout2>
    @vite('resources/js/media.js')
@endsection
