@extends('layout.index')

@section('title', 'Tags')
@section('content')
    <x-home-layout2 tags>
        <div class="row gap-2">
            @forelse ($tags as $item)
                <a href="{{ route('tags.detail', ['slug' => $item->slug]) }}"
                    class="btn btn-primary col-4 col-md-2">{{ $item->title }}</a>
            @empty
                <p class="col">data tidak ada</p>
            @endforelse
        </div>
    </x-home-layout2>
@endsection
