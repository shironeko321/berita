@extends('layout.index')

@section('title', 'Article')
@section('content')
    <x-home-layout article>
        @forelse ($article as $item)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $item->title }}</h5>
                    <p class="card-text">{{ $item->content_meta }}</p>
                    <a href="{{ route('article.detail', ['slug' => $item->slug]) }}"
                        class="btn btn-primary">See More</a>
                </div>
            </div>
        @empty
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data tidak ada</h5>
                    <p class="card-text">data belum ada</p>
                </div>
            </div>
        @endforelse
    </x-home-layout>
@endsection
