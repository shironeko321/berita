@extends('layout.home')

@push('meta')
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="description" content="{{ $article->content_meta }}">
@endpush

@section('title', $article->title)
@section('content')
  <x-home-layout2 article="true">
    <div class="mt-8 text-2xl md:px-10">
      <div class="flex flex-col px-5 justify-between gap-8 md:flex-row">
        <div>
          {{ Breadcrumbs::render('articleDetail', $article) }}

          <div
            class="block p-6 bg-white border-b-2 border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
              {{ $article->title }}</h5>
            <p class="font-normal text-gray-700 dark:text-gray-400">
              {{ $article->user[0]['first_name'] }} {{ $article->user[0]['last_name'] }}
              <span> | </span>
              {{ date('d-m-Y H:i', strtotime($article->updated_at)) }}
            </p>
            <p class="py-2 text-sm font-normal text-gray-700 dark:text-gray-400">Categorys:
              @foreach ($categoryThisArticle as $item)
                <a href="{{ route('category.detail', ['slug' => $item->slug]) }}"
                  class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-gray-700 dark:text-gray-300">#{{ $item->title }}</a>
              @endforeach
            </p>
            <p class="text-sm font-normal text-gray-700 dark:text-gray-400">Tags:
              @foreach ($tagThisArticle as $item)
                <a href="{{ route('tags.detail', ['slug' => $item->slug]) }}"
                  class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-gray-700 dark:text-gray-300">#{{ $item->title }}</a>
              @endforeach
            </p>
          </div>

          <div class="prose lg:prose-xl dark:prose-invert">
            {!! $article->content !!}
          </div>
        </div>

        <div class="flex flex-col gap-5 pt-8">
          <div
            class="block p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 ">
            <h5 class="mb-4 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
              Category</h5>
            <hr class="mb-4">
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

          <div
            class="block p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <h5 class="mb-4 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
              Tags</h5>
            <hr class="mb-4">
            @forelse ($tags as $item)
              <a href="{{ route('tags.detail', ['slug' => $item->slug]) }}" type="button"
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
      </div>

      <hr class="my-10">

      <div class="p-3 rounded-lg">
        <h2 class="mb-5 text-4xl font-bold">Comment</h2>
        @foreach ($categoryArray as $categoryArrays)
          @if ($categoryArrays == 'opini')
            @comments(['model' => $article])
          @endif
        @endforeach
      </div>

      {{-- floating menu --}}
      <div data-dial-init class="fixed right-6 bottom-6 group">
        <div id="speed-dial-menu-default" class="flex-col items-center hidden mb-4 space-y-2">
          <button type="button" id="to-top" data-tooltip-target="tooltip-top"
            data-tooltip-placement="left"
            class="flex justify-center items-center w-[52px] h-[52px] text-gray-500 hover:text-gray-900 bg-white rounded-full border border-gray-200 dark:border-gray-600 dark:hover:text-white shadow-sm dark:text-gray-400 hover:bg-gray-50 dark:bg-gray-700 dark:hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 focus:outline-none dark:focus:ring-gray-400">
            <svg class="w-5 h-5" fill="currentColor" aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                stroke-width="2" d="M5 13V1m0 0L1 5m4-4 4 4"></path>
            </svg>
            <span class="sr-only">To Top</span>
          </button>
          <div id="tooltip-top" role="tooltip"
            class="absolute z-10 invisible inline-block w-auto px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
            To Top
            <div class="tooltip-arrow" data-popper-arrow></div>
          </div>

          <button type="button" id="theme-toggle" data-tooltip-target="tooltip-theme"
            data-tooltip-placement="left"
            class="flex justify-center items-center w-[52px] h-[52px] text-gray-500 hover:text-gray-900 bg-white rounded-full border border-gray-200 dark:border-gray-600 dark:hover:text-white shadow-sm dark:text-gray-400 hover:bg-gray-50 dark:bg-gray-700 dark:hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 focus:outline-none dark:focus:ring-gray-400">
            <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor"
              viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
            </svg>
            <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor"
              viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                fill-rule="evenodd" clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Theme</span>
          </button>
          <div id="tooltip-theme" role="tooltip"
            class="absolute z-10 invisible inline-block w-auto px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
            Theme
            <div class="tooltip-arrow" data-popper-arrow></div>
          </div>
        </div>

        <button type="button" data-dial-toggle="speed-dial-menu-default"
          aria-controls="speed-dial-menu-default" aria-expanded="false"
          class="flex items-center justify-center text-white bg-blue-700 rounded-full w-14 h-14 hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:focus:ring-blue-800">
          <svg class="w-5 h-5 transition-transform group-hover:rotate-45" aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
              stroke-width="2" d="M9 1v16M1 9h16" />
          </svg>
          <span class="sr-only">Open actions menu</span>
        </button>
      </div>

      <script>
        setTimeout(() => {
          const xhr = new XMLHttpRequest();
          xhr.withCredentials = false;
          xhr.open('PUT', '{{ route('update.view.content', ['id' => $article->id]) }}');
          xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]')
            .getAttribute(
              'content'));

          xhr.send();
        }, 30000);
      </script>
    </div>


    {{-- dark/light theme --}}
    <script>
      var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
      var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

      // Change the icons inside the button based on previous settings
      if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window
          .matchMedia('(prefers-color-scheme: dark)').matches)) {
        themeToggleLightIcon.classList.remove('hidden');
      } else {
        themeToggleDarkIcon.classList.remove('hidden');
      }

      var themeToggleBtn = document.getElementById('theme-toggle');

      themeToggleBtn.addEventListener('click', function() {

        // toggle icons inside button
        themeToggleDarkIcon.classList.toggle('hidden');
        themeToggleLightIcon.classList.toggle('hidden');

        // if set via local storage previously
        if (localStorage.getItem('color-theme')) {
          if (localStorage.getItem('color-theme') === 'light') {
            document.documentElement.classList.add('dark');
            localStorage.setItem('color-theme', 'dark');
          } else {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('color-theme', 'light');
          }

          // if NOT set via local storage previously
        } else {
          if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('color-theme', 'light');
          } else {
            document.documentElement.classList.add('dark');
            localStorage.setItem('color-theme', 'dark');
          }
        }

      });
    </script>

    {{-- to top --}}
    <script>
      const toTop = document.getElementById('to-top')
      toTop.addEventListener('click', () => {
        window.scrollTo({
          top: 0,
          behavior: 'smooth'
        });
      })
    </script>
  </x-home-layout2>
@endsection
