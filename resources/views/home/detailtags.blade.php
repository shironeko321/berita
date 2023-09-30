@extends('layout.index')

@section('title', 'Category')
@section('content')
  <x-home-layout tags>
    <h2>Tags {{ $article->title }}</h2>
    <h4 class="text-secondary">result: {{ count($article->posts) }}</h4>
    <div class="row">
      @forelse ($article->posts as $item)
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">{{ $item->title }}</h5>
            <p class="card-text">{{ $item->content_meta }}</p>
            <a href="{{ route('article.detail', ['slug' => $item->slug]) }}" class="btn btn-primary">See
              More</a>
          </div>
        </div>
      @empty
        <p class="col">data tidak ada</p>
      @endforelse
    </div>
  </x-home-layout>
@endsection
