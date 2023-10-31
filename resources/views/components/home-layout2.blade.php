<nav class="bg-white border-b border-gray-200 dark:bg-gray-900 md:border-0">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a class="flex items-center" href="{{ route('home') }}">
      <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white"> Berita
      </span>
    </a>

    <button data-collapse-toggle="navbar-default" type="button"
      class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
      aria-controls="navbar-default" aria-expanded="false">
      <span class="sr-only">Open main menu</span>
      <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
        viewBox="0 0 17 14">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M1 1h15M1 7h15M1 13h15" />
      </svg>
    </button>

    <div class="hidden w-full md:block md:w-auto" id="navbar-default">
      <ul
        class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
        <li>
          <a @class([
              'block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent',
              'block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500' => $article,
          ]) href="{{ route('article') }}">Article</a>
        </li>
        <li>
          <a @class([
              'block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent',
              'block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500' => $category,
          ]) href="{{ route('category') }}">Category</a>
        </li>
        <li>
          <a @class([
              'block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent',
              'block py-2 pl-3 pr-4 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500' => $tags,
          ]) href="{{ route('tags') }}">Tags</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

@if (isset($home))
  <header>
    {{ $home }}
  </header>
@endif

@if (isset($header))
  <header>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <h5 class="font-semibold text-xl text-gray-800 leading-tight dark:text-white">
        {{ $header }}
      </h5>
    </div>
  </header>
@endif

<main class="container px-2 py-3 mx-auto my-5 dark:bg-gray-800 dark:text-white">
  {{ $slot }}
</main>

<footer
  class="mt-5 px-10 container flex justify-center bg-white border-gray-200 dark:bg-gray-900 dark:text-white">
  &copy;2023
</footer>
