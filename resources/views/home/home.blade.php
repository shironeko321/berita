@extends('layout.index')

@section('title', 'Home')
@section('content')
  <x-home-layout>
    <div class="row gap-3 justify-content-center">
      @forelse ($article as $item)
        <div class="card col-12 col-md-5">
          <div class="card-body">
            <h5 class="card-title">{{ $item->title }}</h5>
            <h6 class="card-subtitle mb-2 text-body-secondary">by:
              {{ $item->user[0]['first_name'] }} {{ $item->user[0]['last_name'] }}</h6>
            <p class="card-text">{{ $item->content_meta }}</p>
            <a href="{{ route('article.detail', ['slug' => $item->slug]) }}" class="card-link">See
              More</a>
          </div>
        </div>
      @empty
        <p>Data tidak ada</p>
      @endforelse
    </div>
  </x-home-layout>
@endsection
