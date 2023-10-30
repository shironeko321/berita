@extends('layout.home')

@section('title', 'Home')
@section('content')
  <x-home-layout2>
    <x-slot name="home">
      <section class="bg-white dark:bg-gray-900">
        <div class="mx-auto max-w-screen-xl text-center">
          <div id="default-carousel" class="relative w-full" data-carousel="slide">
            <!-- Carousel wrapper -->
            <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
              @foreach ($popular as $item)
                <a class="hidden duration-1000 ease-in-out" data-carousel-item>
                  <img src="https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885_1280.jpg"
                    class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                    alt="...">
                  <span
                    class="absolute text-white text-2xl z-30 flex space-x-3 -translate-x-1/2 bottom-10 left-1/2">{{ $item->title }}</span>
                </a>
              @endforeach
            </div>
            <!-- Slider indicators -->
            <div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-5 left-1/2">
              @foreach ($popular as $item)
                @if ($loop->first)
                  <button type="button" class="w-3 h-3 rounded-full" aria-current="true"
                    aria-label="Slide {{ $loop->iteration }}"
                    data-carousel-slide-to="{{ $loop->index }}"></button>
                @else
                  <button type="button" class="w-3 h-3 rounded-full" aria-current="false"
                    aria-label="Slide {{ $loop->iteration }}"
                    data-carousel-slide-to="{{ $loop->index }}"></button>
                @endif
              @endforeach
            </div>
            <!-- Slider controls -->
            <button type="button"
              class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
              data-carousel-prev>
              <span
                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800" aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2" d="M5 1 1 5l4 4" />
                </svg>
                <span class="sr-only">Previous</span>
              </span>
            </button>
            <button type="button"
              class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
              data-carousel-next>
              <span
                class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800" aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2" d="m1 9 4-4-4-4" />
                </svg>
                <span class="sr-only">Next</span>
              </span>
            </button>
          </div>
        </div>
      </section>
    </x-slot>


    <div class="px-5">
      <h3 class="text-3xl">Popular</h3>
      <div class="text-2xl mt-4 grid gap-3 grid-cols-1 md:grid-cols-2">
        @forelse ($popular as $item)
          <div
            class="bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-700 dark:border-gray-700">
            <a href="#">
              <img class="rounded-t-lg" src="" alt="" />
            </a>
            <div class="p-5 flex flex-col h-full">
              <a href="#">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                  {{ $item->title }}</h5>
              </a>
              <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $item->content_meta }}
              </p>
              <a href="{{ route('article.detail', ['slug' => $item->slug]) }}"
                class="mt-auto ml-auto inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
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
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Data tidak ada</h5>
              <p class="card-text">data belum ada</p>
            </div>
          </div>
        @endforelse
      </div>
    </div>
  </x-home-layout2>
@endsection
