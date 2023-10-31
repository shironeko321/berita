@extends('layout.home')

@section('title', 'Dashboard')
@section('content')
  <x-home-layout2 category="true">
    <x-slot name="header">
      {{ Breadcrumbs::render('category') }}
    </x-slot>
    <div class="px-5">
      <h1 class="text-xl">Category</h1>
      <div class="my-4 text-2xl grid gap-3 grid-cols-4 md:grid-cols-8">
        @forelse ($category as $item)
          <a href="{{ route('category.detail', ['slug' => $item->slug]) }}" type="button"
            class="inline-flex items-center justify-between px-5 py-2.5 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            {{ $item->title }}
            <span
              class="inline-flex items-center justify-center w-4 h-4 ml-2 text-xs font-semibold text-blue-800 bg-blue-200 rounded-full">
              {{ $item->posts_count }}
            </span>
          </a>
        @empty
          <p class="col">data tidak ada</p>
        @endforelse
      </div>
    </div>
  </x-home-layout2>
@endsection
