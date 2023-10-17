@extends('layout.home')

@section('title', 'Dashboard')
@section('content')
  <x-home-layout2 category="true">
    <x-slot name="header">
      {{ Breadcrumbs::render('categoryDetail', $article) }}
    </x-slot>
    <div class="mt-8 text-2xl">
      <div class="flex justify-between mb-8">
        <h2>Category {{ $article->title }}</h2>
        <h4>result: {{ count($article->posts) }}</h4>
      </div>
      <hr>
      <div class="mt-4 grid gap-3 grid-cols-2 md:grid-cols-3">
        @forelse ($article->posts as $item)
          <div
            class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-700 dark:border-gray-700">
            <a href="#">
              <img class="rounded-t-lg" src="/docs/images/blog/image-1.jpg" alt="" />
            </a>
            <div class="p-5">
              <a href="#">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                  {{ $item->title }}</h5>
              </a>
              <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $item->content_meta }}
              </p>
              <a href="{{ route('article.detail', ['slug' => $item->slug]) }}"
                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Read more
                <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                  fill="none" viewBox="0 0 14 10">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg>
              </a>
            </div>
          </div>
        @empty
          <p class="col">data tidak ada</p>
        @endforelse
      </div>
    </div>
  </x-home-layout2>
@endsection
