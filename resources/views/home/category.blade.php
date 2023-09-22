@extends('layout.index')

@section('title', 'Category')
@section('content')
    <x-home-layout category>
        <div class="row gap-2">
            @forelse ($category as $item)
                <a href="{{ route('category.detail', ['slug' => $item->slug]) }}"
                    class="btn btn-primary col-4 col-md-2">{{ $item->title }}</a>
            @empty
                <p class="col">data tidak ada</p>
            @endforelse
        </div>
    </x-home-layout>
@endsection
