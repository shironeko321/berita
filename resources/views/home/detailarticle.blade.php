@extends('layout.home')

@section('title', 'Dashboard')
@section('content')
  <x-home-layout2 article="true">
    <div class=" px-10 py-5 mt-8 text-2xl">
      <div
        class="block p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
          {{ $article->title }}</h5>
        <p class="font-normal text-gray-700 dark:text-gray-400">
          {{ $article->user[0]['first_name'] }} {{ $article->user[0]['last_name'] }}
          <span> | </span>
          {{ date('d-m-Y H:i', strtotime($article->updated_at)) }}
        </p>
      </div>

      <br>

      <div class="flex flex-col px-5 justify-between gap-8 md:flex-row">
        <div class="prose lg:prose-xl dark:prose-invert">
          {!! $article->content !!}
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
      </div>

      <hr class="my-10">

      <div class="border p-3 rounded-lg">
        <h2>Comment</h2>
        @foreach ($categoryArray as $categoryArrays)
          @if ($categoryArrays == 'opini')
            @comments(['model' => $article])
          @endif
        @endforeach
      </div>

      <meta name="csrf-token" content="{{ csrf_token() }}">
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
  </x-home-layout2>
@endsection
